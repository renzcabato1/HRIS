@extends('layouts.header')

@section('content')
@if(session()->has('status'))
<div class="alert alert-success alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
    {{session()->get('status')}}
</div>
@endif
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table  class="table table-striped table-bordered table-hover dataTables-example1" >
                            <button class="btn btn-primary" data-target="#upload_pdf" data-toggle="modal" type="button"><i class="fa fa-upload"></i>&nbsp;Upload PDF Billings</button>
                            @include('upload_pdf')                         
                            <thead>
                                <tr>
                                    
                                    <th >Company Line</th>
                                    {{-- <th >Account Number</th> --}}
                                    <th >Status</th>
                                    <th > Provider</th>
                                    <th > Service Number</th>
                                    <th > Name</th>
                                    <th > Last Period</th>
                                    <th > Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($inventories as $key => $inventory)
                                                           
                                <tr>
                                    <td >{{$inventory->company_line}}</td>
                                    {{-- <td >{{$inventory->account_number}}</td> --}}
                                    <td >{{$inventory->status}}</td>
                                    <td >{{$inventory->provider}}</td>
                                    <td >{{$inventory->service_number}}</td>
                                    @if(count($inventory->accountabilities))
                                    <td >{{$inventory->accountabilities[0]->user_info->first_name}} {{$inventory->accountabilities[0]->user_info->last_name}}</td>
                                    @else
                                    <td >
                                    </td>
                                    @endif
                                 
                                    <td>
                                    @foreach($inventory->pdf_module() as $pdf_module)
                                    <a href='http://10.96.4.118:8668/{{$pdf_module->file_path}}' target='_blank'> {{date('F Y',strtotime($pdf_module->date_from))}} </a> <br>
                                    @endforeach
                                    </td>
                                    <td>
                                        <button onclick="view_all_billings({{$inventory->service_number}})"  class="btn btn-sm btn-primary" data-target="#view" data-toggle="modal" >View all bills</button> 
                                        {{-- <a  data-target="#view" data-toggle="modal" type="button" class="btn btn-primary"> View Billings<br> --}}
                                        
                                    </td>
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
@include('view_billings')    
<div class="footer">
    
</div>
<script type='text/javascript'>
function view_all_billings(id)
{
   
    // alert($id);
    document.getElementById("myDiv").style.display="block";
    $.ajax({    //create an ajax request to load_page.php
    type: "GET",
    url: "{{ url('/get-all-history/') }}",            
    data: {
        "service_number": id,
    }     ,
    dataType: "json",   //expect html to be returned
    
    success: function(data){  
        $('#view_All_transaction').children().remove();
        jQuery.each(data, function(id) { 
            
        var details = "<div class='row border'>";
        details += "<div class='col-md-4 border'> Files ";
        details += "</div>";
        details += "<div class='col-md-4 border'> Period";
        details += "</div>";
        details += "<div class='col-md-4 border'> Uploaded By";
        details += "</div>";
        details += "</div>";

        $('#view_All_transaction').append(details);
             
        console.log(data[id].file_name);
        var url = '{{ url('') }}/'+data[id].file_path;
         
        var details = "<div class='row border'>";
            details += "<div class='col-md-4 border'> <a href='"+url+"' target='_blank'> File </a>";
            details += "</div>";
            details += "<div class='col-md-4 border'> "+data[id].date_from+" - " + data[id].date_to;
            details += "</div>";
            details += "<div class='col-md-4 border'> "+data[id].upload_info.name;
            details += "</div>";
            details += "</div>";

            $('#view_All_transaction').append(details);
        })
        document.getElementById("myDiv").style.display="none";
    },
    error: function(e)
    {
        alert(e);
    }

    });
    
}
    
</script>
@endsection
