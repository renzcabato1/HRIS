<?php

namespace App\Http\Controllers;
use App\Employee;
use App\Manpower;
use App\ManpowerApplicant;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        
        $employee_date_hired = Employee::orderBy('date_hired','desc')->where('status','!=','Inactive')->first();
        $employee_date = date('Y-m-d',strtotime($employee_date_hired->date_hired));
        $employees = Employee::with('EmployeeCompany','EmployeeLocation')->whereDate('date_hired','=',$employee_date)->orderBy('first_name','asc')->get();
        // dd($employees);
        $manpowers = Manpower::whereHas('manpower_approver',function ($query) {
            $query->where('date_verified','=',null)
            ;
        })->with('request_info','company_info','location_info','position_info')->count();

        $approved_manpower_requests = Manpower::whereDoesntHave('manpower_approver',function ($query) {
            $query->where('date_verified','=',null)
            ;
        })->with('request_info','company_info','location_info','position_info')->count();

        $monday_month = date('m',strtotime('monday this week'));
        $sunday_month = date('m',strtotime('sunday this week'));
        $monday_day = date('d',strtotime('monday this week'));
        $sunday_y = date('d',strtotime('sunday this week'));
        $employee_active = Employee::where('status','=','Active')->get();
        // dd($sunday_month);
        $birth_date_celebrants = Employee::with('EmployeeCompany','EmployeeLocation')
        ->where('status','!=','Inactive')
        ->whereMonth('birthdate','>=',$monday_month)
        ->whereMonth('birthdate','<=',$sunday_month)
        ->whereDay('birthdate','>=',$monday_day)
        ->whereDay('birthdate','<=',$sunday_y)
        ->whereYear('birthdate','<',2004)
        ->orderByRaw('DAYOFYEAR(birthdate)')
        ->get();
      
        $manpowerapplicants = ManpowerApplicant::with([
            'manpower_info',
            'manpower_info.position_info',
            'applicant_info',
            'applicant_info.work_experience_info',
            'applicant_info.education_info',
            ]
        )->where('status','=','Pending')->count();
        $header ='Home';
        return view('home',array(
            'subheader' => '',
            'header' => $header,
            'employees' => $employees,
            'employee_date_hired' => $employee_date_hired,
            'employee_active' => $employee_active,
            'birth_date_celebrants' => $birth_date_celebrants,
            'manpowerapplicants' => $manpowerapplicants,
            'manpowers' => $manpowers,
            'approved_manpower_requests' => $approved_manpower_requests,
        ));
    }
}
