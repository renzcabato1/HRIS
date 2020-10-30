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
                        @include('new_exam')    
                        <button class="btn btn-primary" data-target="#new_exam" data-toggle="modal" type="button">+&nbsp;New Exam</button>
                            
                        <table  class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th > Number </th>
                                    <th > Question </th>
                                    <th > Answer</th>
                                    <th > Choices</th>
                                    <th > Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
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


@endsection
