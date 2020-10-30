<?php

namespace App\Http\Controllers;
use App\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    //
    public function employeeView()
    {
        $activeCount = Employee::with('EmployeeUser','EmployeeCompany','EmployeeLocation','EmployeeDepartment')->orderBy('first_name')->where('first_name','!=',' ')->where('status','=','Active')->count();
        $inactiveCount = Employee::with('EmployeeUser','EmployeeCompany','EmployeeLocation','EmployeeDepartment')->orderBy('first_name')->where('first_name','!=',' ')->where('status','=','Inactive')->count();
        $provitionaryCount = Employee::where('status','=','Active')->where(function($q){
            $q->where('classification', 'Probationary')
              ->orWhere('classification', ' ');
       })->count();
        $regularCount = Employee::where('status','=','Active')->where(function($q){
            $q->where('classification', 'Regular');
       })->count();
        $projectCount = Employee::where('status','=','Active')->where(function($q){
            $q->where('classification', 'Project');
       })->count();
        $consultantCount = Employee::where('status','=','Active')->where(function($q){
            $q->where('classification', 'Consultant');
       })->count();
        return view('employeeView',array(
            'subheader' => '',
            'header' =>'Employees',
            'activeCount' => $activeCount,
            'inactiveCount' => $inactiveCount,
            'provitionaryCount' => $provitionaryCount,
            'regularCount' => $regularCount,
            'projectCount' => $projectCount,
            'consultantCount' => $consultantCount,
            )
    );
    }
    public function activeEmployee()
    {
        $activeCount = Employee::with('EmployeeUser','EmployeeCompany','EmployeeLocation','EmployeeDepartment')->orderBy('first_name')->where('first_name','!=',' ')->where('status','=','Active')->get();
        return $activeCount;
    }
    public function inactiveEmployee()
    {
        $inactiveCount = Employee::with('EmployeeUser','EmployeeCompany','EmployeeLocation','EmployeeDepartment')->orderBy('first_name')->where('first_name','!=',' ')->where('status','=','Inactive')->get();
        return $inactiveCount;
    }
    public function regularActive()
    {
        $regularActive = Employee::with('EmployeeUser','EmployeeCompany','EmployeeLocation','EmployeeDepartment')->where('status','=','Active')->where(function($q){
            $q->where('classification', 'Regular');
       })
       ->orderBy('first_name','asc')
       ->get();
        return $regularActive;
    }
    public function probationaryActive()
    {
        $probationaryActive = Employee::with('EmployeeUser','EmployeeCompany','EmployeeLocation','EmployeeDepartment')
        ->where('status','=','Active')
        ->where(function($q){
            $q->where('classification', 'Probationary')
              ->orWhere('classification', ' ');
       })
       ->orderBy('date_hired','asc')
       ->get();
        return $probationaryActive;
    }
    public function projectActive()
    {
        $projectActive = Employee::with('EmployeeUser','EmployeeCompany','EmployeeLocation','EmployeeDepartment')->where('status','=','Active')->where(function($q){
            $q->where('classification', 'Project');
       })
       ->orderBy('first_name','asc')
       ->get();
        return $projectActive;
    }
    public function consultantActive()
    {
        $consultantActive = Employee::with('EmployeeUser','EmployeeCompany','EmployeeLocation','EmployeeDepartment')->orderBy('first_name')->where('status','=','Active')->where(function($q){
            $q->where('classification', 'Consultant');
       })->get();
        return $consultantActive;
    }
}
