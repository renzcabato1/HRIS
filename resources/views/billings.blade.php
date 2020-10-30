@extends('layouts.header')

@section('content')

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-content">
                    <div class="table-responsive">
                        @include('upload_billing')    
                        <button class="btn btn-primary" data-target="#upload_billing" data-toggle="modal" type="button"><i class="fa fa-upload"></i>&nbsp;Upload Billing</button>
                            
                        <table  class="table table-striped table-bordered table-hover dataTables-example" >
                                          
                            <thead>
                                <tr>
                                    
                                    <th > Corporate </th>
                                    <th > Account Number</th>
                                    <th > Account Holder</th>
                                    <th > Budget Code</th>
                                    <th > Monthly Budget </th>
                                    
                                    <th > Current Charges  </th>
                                    <th > Bill Number</th>
                                    <th > Total Amount Due  </th>
                                    <th > Bill Date </th>
                                    <th > Bill Period </th>
                                    <th > Dute Date </th>
                                    <th > Uploaded By </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($billings as $billing)
                                    <tr>
                                        <td>{{$billing->corporate_name}}</td>
                                        <td>{{$billing->account_number}}</td>
                                        @if($billing->bill_info)
                                            @if(count($billing->bill_info->accountabilities))
                                            <td >{{$billing->bill_info->accountabilities[0]->user_info->first_name.' '.$billing->bill_info->accountabilities[0]->user_info->last_name}}</td>
                                            <td >{{$billing->bill_info->accountabilities[0]->budget_code}}</td>
                                            <td > {{$billing->bill_info->accountabilities[0]->monthly_budget}}</td>
                                            @else
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            @endif
                                            @else
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        @endif
                                        
                                        <td>{{$billing->current_charges}}</td>
                                        <td>{{$billing->bill_number}}</td>
                                        <td>{{$billing->total_amount_due}}</td>
                                        <td>{{$billing->bill_date}}</td>
                                        <td>{{$billing->bill_period}}</td>
                                        <td>{{$billing->due_date}}</td>
                                        <td>{{$billing->upload_info->name}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="footer">

</div>
<script type='text/javascript'>

</script>
@endsection
