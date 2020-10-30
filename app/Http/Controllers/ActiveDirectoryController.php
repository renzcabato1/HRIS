<?php

namespace App\Http\Controllers;
use App\LdapServer;
use Illuminate\Http\Request;
use App\Company;
use App\Location;
use App\Department;

class ActiveDirectoryController extends Controller
{
    //
    public function viewDomainUsers()
    {
        $companies = Company::orderBy('name','asc')->get();
        $sites = Location::orderBy('name','asc')->get();
        $departments = Department::orderBy('name','asc')->get();
        $server = LdapServer::orderBy('id','desc')->where('active',1)->first();
        
        $adServer = $server->server;
        
        $ldap = ldap_connect($adServer);
        $username = $server->user_name;
        $password = $server->password;
        
        $ldaprdn = $username;
        
        ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);
        // ldap_set_option($ldap, LDAP_OPT_SIZELIMIT, 2000);
        $bind = @ldap_bind($ldap, $ldaprdn, $password);
        $dc = "dc=".$server->dc1.",dc=".$server->dc2."";
        $infos = [];
        $infos_ou = [];
        if ($bind){
            $alph = array('a', 'b', 'c', 'd', 'e',
        'f', 'g', 'h', 'i', 'j', 'k',
        'l', 'm', 'n', 'o', 'p', 'q', 'r', 's',
        't', 'u', 'y', 'v', 'w','x', 'z');
   
        foreach ($alph as $letter){
            $attributes = array();
            $attributes[] = 'givenname';
            $attributes[] = 'mail';
            $attributes[] = 'samaccountname';
            $attributes[] = 'sn';
            $result = ldap_search($ldap,$dc,'(&(givenname=*)(sn=*)(sAMAccountName=' . $letter . '*))');
            $infos[] = ldap_get_entries($ldap, $result);
            $filter ="(ou=*)";
            $justthese = array("ou");
            $result_ou=ldap_list($ldap, $dc, $filter, $justthese); 
            $infos_ou= ldap_get_entries($ldap, $result_ou);
        }
        ldap_unbind($ldap); // Clean up after ourselves.
        }
        return view('viewDomainUsers',array(
            'subheader' => 'Active Directory',
            'header' =>'On-boarding',
            'infos' => $infos,
            'infos_ou' => $infos_ou,
            'companies' => $companies,
            'sites' => $sites,
            'departments' => $departments,
            )
        );
    }
    public function enableAccount(Request $request, $AccountName)
    {
        $server = LdapServer::orderBy('id','desc')->where('active',1)->first();
        
        $adServer = $server->server;
        
        $ldap = ldap_connect($adServer);
        $username = $server->user_name;
        $password = $server->password;
        
        $ldaprdn = $username;
        $dc = "dc=".$server->dc1.",dc=".$server->dc2."";
        ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);
        // ldap_set_option($ldap, LDAP_OPT_SIZELIMIT, 2000);
        $bind = @ldap_bind($ldap, $ldaprdn, $password);
        if ($bind){
            $a = 1;
            $filter="(sAMAccountName=".$AccountName.")";
            $result = ldap_search($ldap,$dc,$filter);
            $info = ldap_get_entries($ldap, $result);
            $dn=$info[0]["dn"];
            $ac = $info[0]["useraccountcontrol"][0];
            $disable=($ac | 2); // set all bits plus bit 1 (=dec2)
            $enable =($ac & ~2); // set all bits minus bit 1 (=dec2)
            
            $userdata=array();
            if ($a==1) $new=$enable; else $new=$disable; 
            
        
            $userdata["useraccountcontrol"][0]=$new;
            ldap_modify($ldap,$dn, $userdata);
            $result = ldap_search($ldap,"dc=LFUGGOC,dc=NET",$filter);
            $info = ldap_get_entries($ldap, $result);
            ldap_close($ldap);
            $request->session()->flash('status',$AccountName.' enabled account.');
            return back(); 

        }
    }
    public function disableAccount(Request $request,$AccountName)
    {
        $server = LdapServer::orderBy('id','desc')->where('active',1)->first();
        
        $adServer = $server->server;
        $dc = "dc=".$server->dc1.",dc=".$server->dc2."";
        $ldap = ldap_connect($adServer);
        $username = $server->user_name;
        $password = $server->password;
        
        $ldaprdn = $username;
        
        ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);
        // ldap_set_option($ldap, LDAP_OPT_SIZELIMIT, 2000);
        $bind = @ldap_bind($ldap, $ldaprdn, $password);
        if ($bind){
            $a = 0;
            $filter="(sAMAccountName=".$AccountName.")";
            $result = ldap_search($ldap,$dc,$filter);
            $info = ldap_get_entries($ldap, $result);
            $dn=$info[0]["dn"];
            $ac = $info[0]["useraccountcontrol"][0];
            // dd('renz');
            $disable=($ac | 2); // set all bits plus bit 1 (=dec2)
            $enable =($ac & ~2); // set all bits minus bit 1 (=dec2)
            
            $userdata=array();
            if ($a==1) $new=$enable; else $new=$disable; 
            
        
            $userdata["useraccountcontrol"][0]=$new;
            ldap_modify($ldap,$dn, $userdata);
            $result = ldap_search($ldap,"dc=LFUGGOC,dc=NET",$filter);
            $info = ldap_get_entries($ldap, $result);
            ldap_close($ldap);
            $request->session()->flash('status',$AccountName.' disabled account.');
            return back(); 
        }
    }
    public function resetPassword(Request $request,$AccountName)
    {
        $server = LdapServer::orderBy('id','desc')->where('active',1)->first();
        
        $adServer = $server->server;
        $dc = "dc=".$server->dc1.",dc=".$server->dc2."";
        $ldap = ldap_connect($adServer);
        $username = $server->user_name;
        $password = $server->password;
        
        $ldaprdn = $username;
        ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);
        // ldap_set_option($ldap, LDAP_OPT_SIZELIMIT, 2000);
        $bind = @ldap_bind($ldap, $ldaprdn, $password);
        if ($bind){
            $filter="(sAMAccountName=".$AccountName.")";
            $result = ldap_search($ldap,$dc ,$filter);
            $info = ldap_get_entries($ldap, $result);
            $user_entry = ldap_first_entry($ldap, $result);
            $user_dn = ldap_get_dn($ldap, $user_entry);
            $user_id = $info;
            // dd($user_id[0]['userpassword'][0]);
            $user_entry = ldap_first_entry($ldap, $result);
            $user_dn = ldap_get_dn($ldap, $user_entry);
            $dn=$info[0]["dn"];
            $userdata=array();
            $new =  "{MD5}".base64_encode(pack("H*",md5('Welcome2')));
            $userdata["userPassword"][0]=$new;
            ldap_mod_replace ($ldap,$dn, $userdata);
            $result = ldap_search($ldap,$dc,$filter);
	        $info = ldap_get_entries($ldap, $result);
            dd($info);
        }
    }
    public function getOu(Request $request)
    {
        $server = LdapServer::orderBy('id','desc')->where('active',1)->first();
        
        $adServer = $server->server;
        $dc = "ou=".$request->value.",dc=".$server->dc1.",dc=".$server->dc2."";
        $ldap = ldap_connect($adServer);
        $username = $server->user_name;
        $password = $server->password;
        
        $ldaprdn = $username;
        ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);
        // ldap_set_option($ldap, LDAP_OPT_SIZELIMIT, 2000);
        $bind = @ldap_bind($ldap, $ldaprdn, $password);
        if ($bind){
            
            $filter ="(ou=*)";
            $justthese = array("ou");

            $result=ldap_list($ldap, $dc, $filter, $justthese) or die("No search data found."); 

            $info = ldap_get_entries($ldap, $result);
           
        }
        return $info;
    }
    public function getsubOu(Request $request)
    {
        
        $server = LdapServer::orderBy('id','desc')->where('active',1)->first();
        
        $adServer = $server->server;
        $dc = "ou=".$request->subou.",ou=".$request->mainOu.",dc=".$server->dc1.",dc=".$server->dc2."";
        $ldap = ldap_connect($adServer);
        $username = $server->user_name;
        $password = $server->password;
        
        $ldaprdn = $username;
        ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);
        // ldap_set_option($ldap, LDAP_OPT_SIZELIMIT, 2000);
        $bind = @ldap_bind($ldap, $ldaprdn, $password);
        if ($bind){
            
            $filter ="(ou=*)";
            $justthese = array("ou");

            $result=ldap_list($ldap, $dc, $filter, $justthese) or die("No search data found."); 

            $info = ldap_get_entries($ldap, $result);
           
        }
        return $info;
    }
    public function newADAccount(Request $request)
    {
        $dn_list = null;
        for($i=count($request->ou)-1; $i>=0; $i-- )
        {   
            if($i == count($request->ou)-1)
            {
                $dn_list = $dn_list."OU=".$request->ou[$i];
            } 
            else
            {

                $dn_list = $dn_list.",OU=".$request->ou[$i];
            }
        }
            $pwdtxt="Welcome1";
            $newPassword = '"' . $pwdtxt . '"';
   
            $newPass = iconv( 'UTF-8', 'UTF-16LE', $newPassword );  
         
        $server = LdapServer::orderBy('id','desc')->where('active',1)->first();
        $samaccountname =  strstr($request->email, '@', true);
        $cn = "".$request->first_name." ".$request->surname."";
        $adduserAD["cn"][0] = "".$request->first_name." ".$request->surname."";
        $adduserAD["instancetype"][0] = "4";
        $adduserAD["samaccountname"][0] =  $samaccountname;
        $adduserAD["objectclass"][0] = "top";
        $adduserAD["objectclass"][1] = "person";
        $adduserAD["objectclass"][2] = "organizationalPerson";
        $adduserAD["objectclass"][3] = "user";
        $adduserAD["displayname"][0] = "".$request->first_name." ".$request->surname."";
        $adduserAD["name"][0] = "".$request->first_name." ".$request->surname."";
        $adduserAD["givenname"][0] = $request->first_name;
        $adduserAD["sn"][0] = $request->surname;
        $adduserAD["company"][0] = $request->company;
        $adduserAD["department"][0] =  $request->department;
        $adduserAD["title"][0] = $request->job_title;
        $adduserAD["description"][0] = $request->jobDescription;
        $adduserAD["mail"][0] = $request->email;
        $adduserAD["initials"][0] = " ";
        $adduserAD["physicaldeliveryofficename"][0] = $request->location;
        $adduserAD["useraccountcontrol"][0] = 544;
        // $newPass ='{MD5}' . base64_encode(pack('H*',md5('Welcome1')));
        $adduserAD["userPassword"][0] = $newPass;
        $adduserAD["userprincipalname"][0] = $samaccountname."@lfuggoc.net";
        // $adduserAD["profilepath"][0] ="";
        $adduserAD["manager"][0] = $request->manager;
        // $adduserAD["unicodepwd"] = $newPass;
        $adServer = $server->server;
        $ldap = ldap_connect($adServer);
        $username = $server->user_name;
        $password = $server->password;
        
        $ldaprdn = $username;
        
        ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);
        // ldap_set_option($ldap, LDAP_OPT_SIZELIMIT, 2000);
        $bind = @ldap_bind($ldap, $ldaprdn, $password);
        $dc = "".$dn_list.",dc=".$server->dc1.",dc=".$server->dc2."";
        $dc = "CN=".$cn.",".$dn_list.",dc=".$server->dc1.",dc=".$server->dc2."";
        // dd($dc);
        // dd($dc);
        if ($bind){

            if (!(ldap_add ($ldap,$dc, $adduserAD))){
                echo "There is a problem to create the account";
                echo "Please contact your administrator !";
                exit;
           }
        }
        $request->session()->flash('status','new account created.');
            return back(); 

    }
    public function getAccountDetails(Request $request)
    {
        $server = LdapServer::orderBy('id','desc')->where('active',1)->first();
        
        $adServer = $server->server;
        $dc = "dc=".$server->dc1.",dc=".$server->dc2."";
        $ldap = ldap_connect($adServer);
        $username = $server->user_name;
        $password = $server->password;
        
        $ldaprdn = $username;
        ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);
        // ldap_set_option($ldap, LDAP_OPT_SIZELIMIT, 2000);
        $bind = @ldap_bind($ldap, $ldaprdn, $password);
        $info = [];
        if ($bind){
            $filter="(sAMAccountName=".$request->username.")";
            $result = ldap_search($ldap,$dc ,$filter);
            $info = ldap_get_entries($ldap, $result);
         
        }
        $data = mb_convert_encoding($info, 'UTF-8', 'UTF-8');
        return $data;
    }
}
