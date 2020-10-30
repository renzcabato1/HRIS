<?php

namespace App\Http\Controllers;
use App\Company;
use App\Location;
use App\Department;
use App\DepartmentEmployee;
use App\Employee;
use App\Job;
use App\Manpower;
use App\ManpowerApprover;
use Illuminate\Http\Request;

class ManpowerController extends Controller
{
    //
    public function manpowerRequest()
    {
        $companies = Company::orderBy('name','asc')->get();
        $sites = Location::orderBy('name','asc')->get();
        $departments = Department::orderBy('name','asc')->get();
        $departmentId = DepartmentEmployee::where('employee_id',auth()->user()->employee_info()->id)->first();
        $jobs = Job::orderBy('job_title','asc')->get();
        
        $employeeDepartment = DepartmentEmployee::
        whereHas('EmployeeView',function ($query) {
            $query->where('status','=','Active');
        })
        ->with('EmployeeView','EmployeeView.EmployeeUser')
        ->where('department_id',$departmentId->department_id)
        ->get();
        $employees = Employee::where('status','=','Active')->orderBy('first_name')->orderBy('last_name')->get();
        $manpowers = Manpower::whereHas('manpower_approver',function ($query) {
            $query->where('date_verified','=',null)
            ;
        })->with('request_info','company_info','location_info','position_info')->get();
        $approved_manpower_requests = Manpower::whereDoesntHave('manpower_approver',function ($query) {
            $query->where('date_verified','=',null)
            ;
        })->with('request_info','company_info','location_info','position_info')->get();
        $for_approval = ManpowerApprover::with('manpower_infor.request_info','manpower_infor.company_info','manpower_infor.location_info','manpower_infor.position_info','user_info')->where('date_verified','=',null)->get();
        // dd($for_approval);
        $active = 1;
        return view('manpowerRequest',array(
            'subheader' => '',
            'header' =>'Manpower Request',
            'companies' => $companies,
            'sites' => $sites,
            'departments' => $departments,
            'employeeDepartments' => $employeeDepartment,
            'jobs' => $jobs,
            'employees' => $employees,
            'manpowers' => $manpowers,
            'approved_manpower_requests' => $approved_manpower_requests,
            'for_approval' => $for_approval,
            'active' => $active ,
            )
        );
    }
    public function saveManpower (Request $request)
    {   
        // dd($request->all());
        $manpower = new Manpower;
        $manpower->company_id = $request->company;
        $manpower->location_id = $request->location;
        $manpower->department_id = $request->department;
        $manpower->number_of_person = $request->personnel_needed;
        $manpower->reporting_to = $request->direct_employee;
        $manpower->cost_center = $request->cost_center;
        $manpower->position_title = $request->position_id;
        $manpower->type_of_hiring = $request->typeHiring;
        $manpower->type_of_requisition = $request->typeOfRequisition;
        $manpower->additional_reason = $request->reason;
        $manpower->replacement_id = $request->replacementEmployee;
        $manpower->status_of_employment = $request->status_of_employment;
        $manpower->project_based = $request->status_month;
        $manpower->request_by = auth()->user()->id;
        $manpower->status = 'For approval';
        $manpower->save();

        $manpower_approver = new ManpowerApprover;
        $manpower_approver->manpower_id = $manpower->id;
        $manpower_approver->type = "Immediate Manager";
        $manpower_approver->signatories = $request->immediate_manager;
        $manpower_approver->save();

        $manpower_approver = new ManpowerApprover;
        $manpower_approver->manpower_id = $manpower->id;
        $manpower_approver->type = "Department Head";
        $manpower_approver->signatories = $request->department_head;
        $manpower_approver->save();

        $manpower_approver = new ManpowerApprover;
        $manpower_approver->manpower_id = $manpower->id;
        $manpower_approver->type = "Finance Manager";
        $manpower_approver->signatories = $request->finance_manager;
        $manpower_approver->save();

        $manpower_approver = new ManpowerApprover;
        $manpower_approver->manpower_id = $manpower->id;
        $manpower_approver->type = "HR Operation";
        $manpower_approver->signatories = $request->hr_operation;
        $manpower_approver->save();

        $manpower_approver = new ManpowerApprover;
        $manpower_approver->manpower_id = $manpower->id;
        $manpower_approver->type = "HR Head";
        $manpower_approver->signatories = $request->hr_head;
        $manpower_approver->save();

 

        $request->session()->flash('status','Successfully Save Request.');
        return back();
    }
    public function getManpower(Request $request)
    {
        $manpower = Manpower::where('id',$request->manpowerId)
        ->with(
            'request_info',
            'manpower_approver.user_info',
            'company_info',
            'location_info',
            'position_info.qualifications',
            'department_info',
            'reporting_to_info',
            'replacement_info'
            )->first();

        return $manpower;
    }
    public function approveManpower(Request $request)
    {
            $approved_manpower_requests = Manpower::where('status','=','Approved')->with(
            'request_info',
            'company_info',
            'location_info',
            'location_info.address_info',
            'position_info',
            'position_info.qualifications',
            'department_info',
            'reporting_to_info',
            'manager_info',
            'department_head_info',
            'finance_manager_info',
            'hr_operation_info',
            'hr_head_info',
            'replacement_info')
            ->get();
        return view('approved_mrf',array(
            'subheader' => 'Approved MRF',
            'header' =>'Recruitment',
            'approved_manpower_requests' => $approved_manpower_requests,
            )
        );

    }
    public function approvedmanpower (Request $request,$manpower_id)
    {
        // dd($manpower_id);
        $manpowerApprover = ManpowerApprover::where('id',$manpower_id)->first();
        // dd($manpowerApprover);
        $manpowerApprover->date_verified = date('Y-m-d');
        $manpowerApprover->remarks = $request->remarks;
        $manpowerApprover->budget = $request->budget;
        $manpowerApprover->save();
        if($manpowerApprover->type == "Finance Manager")
        {
            if($request->budget == "without budget")
            {
                        $manpower_approver = new ManpowerApprover;
                        $manpower_approver->manpower_id = $manpowerApprover->manpower_id;
                        $manpower_approver->type = "President";
                        $manpower_approver->signatories = 1913;
                        $manpower_approver->save();
            }
        }
        $request->session()->flash('status','Successfully Verified.');
        $request->session()->flash('approve','approve');
        return back();
    }
}
