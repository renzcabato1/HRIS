<?php

namespace App\Http\Controllers;
use App\Billing;
use App\UploadBilling;
use App\BillUpload;
use App\PdfBilling;
use App\Inventory;
use DB;
use Excel;
use Illuminate\Http\Request;
use Spatie\PdfToText\Pdf;
use Symfony\Component\HttpFoundation\Response;
use Smalot\PdfParser\Parser;
use Gufy\PdfToHtml\Config;
use Ottosmops\Pdftotext\Extract;

class BillingController extends Controller
{
    //
    public function billingView ()
    {
        
    
        $billings = UploadBilling::with('upload_info','bill_info.accountabilities.user_info')->get();
        return view('billings',array(
            'header' => 'Accountabilities',
            'subheader' => 'Billings',
            'billings' => $billings,
        ));
    }
    public function upload_billing(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'upload_billing'  => 'required|mimes:xls,xlsx'
           ]);
           $path = $request->file('upload_billing')->getRealPath();
           $datas = Excel::load($path)->get();
        //    dd($datas);
            // return ($datas);
           foreach($datas as $data)
           {
                // dd(date('Y-m-d',strtotime($data->bill_date)));
                $upload_billing = new UploadBilling;
                $upload_billing->corporate_name = $data->corporate_name;
                $upload_billing->department_divison = $data->departmentdivision;
                $upload_billing->contact_person = $data->contact_person;
                $upload_billing->account_number = $data->account_number;
                $upload_billing->account_name = $data->account_name;
                $upload_billing->assignee_name = $data->assignee_name;
                $upload_billing->mobile_number = $data->mobile_number;
                $upload_billing->bill_number = $data->billing_number;
                $upload_billing->bill_type = $data->bill_type;
                $upload_billing->credit_limit = $data->credit_limit;
                $upload_billing->plan_id = $data->plan_id;
                $upload_billing->balance = $data->balance;
                $upload_billing->payments = $data->payments;
                $upload_billing->credits_prior_adj = $data->credits_prior_adj;
                $upload_billing->over_due = $data->overdue;
                $upload_billing->msf = $data->msf;
                $upload_billing->other_charges = $data->other_char;
                $upload_billing->debit_adj = $data->debit_adj;
                $upload_billing->credit_adj = $data->credit_adj;
                $upload_billing->local = $data->local;
                $upload_billing->ndd = $data->ndd;
                $upload_billing->idd = $data->idd;
                $upload_billing->roam = $data->roam;
                $upload_billing->sms = $data->sms;
                $upload_billing->gprs = $data->gprs;
                $upload_billing->wiz_usage = $data->wiz_usage;
                $upload_billing->loading_charges = $data->loading_charges;
                $upload_billing->vat = $data->vat;
                $upload_billing->oct = $data->oct;
                $upload_billing->current_charges = $data->current_charges;
                $upload_billing->total_amount_due = $data->total_amount_due;
                $upload_billing->bill_date = date('Y-m-d',strtotime($data->bill_date));
                $upload_billing->bill_period = $data->bill_period;
                $upload_billing->due_date = date('Y-m-d',strtotime($data->due_date));
                $upload_billing->upload_by = auth()->user()->id;
                $upload_billing->save();
           }
           $request->session()->flash('status','Successfully Uploaded.');
           return back(); 
    }
    public function billingPdf(Request $request)
    {
        
        $inventories = Inventory::with('employee_info')
        // ->leftJoin('bill_uploads', 'inventories.service_number', 'like', DB::raw("CONCAT('%', bill_uploads.content, '%')"))
        ->with(['employee_info','accountabilities'=>function ($query) {
            $query->where('date_expired','=',null)
            ->orderBy('id','desc');
        },'accountabilities.user_info.EmployeeCompany'])->get();
        // dd($inventories[1]);
        // dd($inventories->pdf_module());
      
    return view('pdf_billings',array(
            'header' => 'Accountabilities',
            'subheader' => 'PDF',
            'inventories' => $inventories,
            // 'pdf_billings' => $pdf_billings,
            // 'pdf_final' => $pdf_final,
            // 'pdf_last_billing' => $pdf_last_billing,
        ));
    }
    public function uploadPdfBilling(Request $request)
    {
        // dd();
        foreach($request->upload_pdf as $attachment)
        {

            $original_name = str_replace('.', 'a',$attachment->getClientOriginalName());
            $name = time();
            
            $attachment->move(public_path().'/billing_upload/', $name.$original_name.".pdf");
            $file_name = '/billing_upload/'.$name.$original_name.".pdf";
            
          
            try 
            {
                $inside_file = "";
                $PDFParser = new Parser();
                $pdf = $PDFParser->parseFile(url($file_name));
                $text = $pdf->getText();
                $pages  = $pdf->getPages();
                $totalPages = count($pages);
                $inside_file = $pages[0]->getText();
                $data = new BillUpload;
                $data->date_from =date('Y-m-01',strtotime($request->period));
                $data->date_to =date('Y-m-t',strtotime($request->period));
                $data->content  = $inside_file;
                $data->file_name  = $original_name;
                $data->file_path  = $file_name ;
                $data->uploaded_by  = auth()->user()->id ;
                $data->save();
            }
            catch (\Exception $e) {
                $inside_file = "";
               
                $data = new BillUpload;
                $data->date_from =date('Y-m-01',strtotime($request->period));
                $data->date_to =date('Y-m-t',strtotime($request->period));
                $data->content  = $file_name;
                $data->file_name  = $original_name;
                $data->file_path  = $file_name ;
                $data->uploaded_by  = auth()->user()->id ;
                $data->save();
            }
           
        }
        
        $request->session()->flash('status','Successfully Uploaded.');
        return back(); 
    }
    public function view_billings (Request $request)
    {

        $all_billings = BillUpload::with('upload_info')->where('content','like','%'.$request->service_number.'%')->orderBy('created_at','desc')->get();

        return $all_billings;
    }
    
}
