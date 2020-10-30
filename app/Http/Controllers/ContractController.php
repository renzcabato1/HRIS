<?php

namespace App\Http\Controllers;
use PDF;
use App\Inventory;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    //
    public function contractView  ($inventoryId)
    {
        $inventory = Inventory::
        with('employee_info')
        ->with(['employee_info','accountabilities'=>function ($query) {
            $query->where('date_expired','=',null)
            ->orderBy('id','desc');
        },'accountabilities.user_info'])
        ->where('id',$inventoryId)->first();

        $pdf = PDF::loadView('contract_printing',array(
           'inventory' =>$inventory,
        ))
        ->setPaper('letter', '');
    
        return $pdf->stream('contract_printing.pdf');

        // return view('contract_printing');
    }
    public function contractallView  (Request $request)

    {
        $inventories = Inventory::
        with('employee_info')
        ->with(['employee_info','accountabilities'=>function ($query) {
            $query->where('date_expired','=',null)
            ->orderBy('id','desc');
        },'accountabilities.user_info'])
        ->whereIn('id',$request->print_id)->get();

        // dd($inventories);
        $pdf = PDF::loadView('contract_all',array(
            'inventories' => $inventories,
         ))
         ->setPaper('letter', '');
     
         return $pdf->stream('inventories.pdf');
        
    }
}
