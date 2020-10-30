<?php

namespace App\Http\Controllers;
use App\UserRole;
use App\Role;
use App\Account;
use App\Employee;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    //
    public function accounts(Request $request)
    {
        $users = UserRole::get();
        $accounts = Account::with('user_info.EmployeeUser','user_info.EmployeeCompany','user_info.EmployeeLocation','user_info.EmployeeDepartment','role_info.role_data')->get();

        $accounts_array  = $accounts->pluck('user_id')->toArray();
        // dd($accounts);
        $employees = Employee::with('EmployeeCompany')->where('status','=','Active')->whereNotIn('user_id',$accounts_array)->orderBy('first_name','asc')->get();
        $roles = Role::get();
        return view('users',array(
            'header' => 'Settings',
            'subheader' => 'Accounts',
            // 'previous_date' => $previous_date,
            'users' => $users,
            'employees' => $employees,
            'accounts' => $accounts,
            'roles' => $roles,
            // 'accounts' => $accounts,
            // 'accounts_array' => $accounts_array,
        ));
    }
    public function new_account(Request $request)
    {
        // dd($request->all());

        foreach($request->user as $user)
        {
                $account = new Account;
                $account->user_id = $user;
                $account->save();
                
                foreach($request->roles as $role)
                {
                    $user_role = new UserRole;
                    $user_role->user_id = $user;
                    $user_role->role_id = $role;
                    $user_role->save();
                }
        }
        $request->session()->flash('status','Successfully Added.');
        return back(); 
    }
   
}
