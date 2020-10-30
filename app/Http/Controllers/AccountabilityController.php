<?php

namespace App\Http\Controllers;
use App\Accountability;
use App\Inventory;
use App\Employee;
use App\InventoryType;
use App\EmployeeAccountability;
use Illuminate\Http\Request;

class AccountabilityController extends Controller
{
    //
    public function accountabilites()
    {   
        $inventories = Inventory::with('employee_info')
        ->with(['employee_info','accountabilities'=>function ($query) {
            $query->where('date_expired','=',null)
            ->orderBy('id','desc');
        },'accountabilities.user_info.EmployeeCompany'])->get();
        $inventory_types = InventoryType::orderBy('name','desc')->get();
        // dd($inventories);
        $employees = Employee::with('EmployeeCompany')->where('status','=','Active')->orderBy('first_name','asc')->get();

        return view('accountabilities',array(
            'header' => 'Accountabilities',
            'subheader' => 'Accountabilities',
            'inventories' => $inventories,
            'inventory_types' => $inventory_types,
            'employees' => $employees,
        ));
    }
    public function newType (Request $request)
    {
        $inventory = new Inventory;
        $inventory->company_line = $request->company;
        $inventory->account_number = $request->account_number;
        $inventory->type = $request->type;
        $inventory->provider = $request->provider;
        $inventory->service_number = $request->service_number;
        $inventory->plan_offer = $request->plan_offer;
        $inventory->plan_description = $request->plan_description;
        $inventory->status = 'Active';
        $inventory->phone_unit = $request->plan_unit;
        $inventory->remarks = $request->remarks;
        $inventory->save();

        if($request->account_holder != null)
        {
            $account = new EmployeeAccountability;
            $account->date_assigned = $request->date_assigned;
            $account->user_id = $request->account_holder;
            $account->budget_code = $request->budget_code;
            $account->monthly_budget = $request->monthly_budget;
            $account->add_by = auth()->user()->id;
            $account->inventory_id = $inventory->id;
            $account->save();
        }
        $request->session()->flash('status','Successfully Added.');
        return back(); 
        
    }
    public function editType(Request $request)
    {
        $inventory = Inventory::findOrfail($request->id);
        $inventory->type = $request->type;
        $inventory->provider = $request->provider;
        $inventory->service_number = $request->service_number;
        $inventory->plan_offer = $request->plan_offer;
        $inventory->plan_description = $request->plan_description;
        $inventory->phone_unit = $request->plan_unit;
        $inventory->remarks = $request->remarks;
        $inventory->save();
        $request->session()->flash('status','Successfully Edited.');
        return back(); 
    }
    public function transferAccount(Request $request)
    {
        $inventory_accountability = EmployeeAccountability::where('inventory_id','=',$request->id)->orderBy('id','desc')->first();
      
        $inventory_accountability->date_expired = $request->date_expired;
        $inventory_accountability->expired_by = auth()->user()->id;
        $inventory_accountability->save();

        $inventory = new EmployeeAccountability;
        $inventory->date_assigned = $request->date_transfer;
        $inventory->user_id = $request->transfer_to;
        $inventory->budget_code = $request->budget_code;
        $inventory->monthly_budget = $request->monthly_budget;
        $inventory->add_by = auth()->user()->id;
        $inventory->inventory_id = $request->id;
        $inventory->save();

        $request->session()->flash('status','Successfully Transfer.');
        return back(); 
    }
    public function assignAccount(Request $request)
    {
        $inventory = new EmployeeAccountability;
        $inventory->date_assigned = $request->date_transfer;
        $inventory->user_id = $request->transfer_to;
        $inventory->budget_code = $request->budget_code;
        $inventory->monthly_budget = $request->monthly_budget;
        $inventory->add_by = auth()->user()->id;
        $inventory->inventory_id = $request->id;
        $inventory->save();

        $request->session()->flash('status','Successfully Assigned.');
        return back(); 
    }
    public function removeAccount(Request $request)
    {
        // dd($request->all());
        $inventory_accountability = EmployeeAccountability::where('inventory_id','=',$request->id)->where('date_expired','=',null)->orderBy('id','desc')->first();
        $inventory_accountability->date_expired = $request->date_expired;
        $inventory_accountability->expired_by = auth()->user()->id;
        $inventory_accountability->remarks = $request->remarks;
        $inventory_accountability->save();
        $request->session()->flash('status','Successfully Remove Account.');
        return back(); 
    }
    public function getMobile(Request $request,$user_id)
    {
       $employee_activity = EmployeeAccountability::with('inventory_info')->where('user_id',$user_id)->where('date_expired','=',null)->get();
       return $employee_activity;
    }
    public function getMobileAll(Request $request)
    {
       $employee_activity = EmployeeAccountability::with('inventory_info')->where('date_expired','=',null)->get();
       return $employee_activity;
    }
    public function deactivate (Request $request)
    {
        $inventory_id = $request->id;
        $inventory_accountability = EmployeeAccountability::where('inventory_id','=',$inventory_id)->where('date_expired','=',null)->orderBy('id','desc')->first();
        if($inventory_accountability != null)
        {
        $inventory_accountability->date_expired = date('Y-m-d');
        $inventory_accountability->expired_by = auth()->user()->id;
        $inventory_accountability->remarks = $request->remarks;
        $inventory_accountability->save();
        }
        $inventory = Inventory::findOrfail($inventory_id);
        $inventory->deactivated_date =  date('Y-m-d');
        $inventory->deactivate_remarks =  $request->remarks;
        $inventory->remarks =  $request->remarks;
        $inventory->status =  'Inactive';
        $inventory->deactivated_by =  auth()->user()->id;
        $inventory->save();
        $request->session()->flash('status','Successfully Deactivated Account.');
        return back(); 

    }
}
