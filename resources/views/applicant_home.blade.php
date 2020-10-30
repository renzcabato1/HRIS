@extends('layouts.header_applicant')
@section('content')
<div id='test'>
<a href='{{ url('/apply-applicant') }}' ><button type="button" class="btn btn-w-m btn-primary btn-xlarge" >Tap for Applicant <i class="fa fa-arrow-circle-o-right"></i></button></a>
<br>
{{-- <a href='{{ url('/take-exam') }}'><button type="button" class="btn btn-w-m btn-success btn-xlarge mt-2" >Take Exam <i class="fa fa-arrow-circle-o-right"></i></button></a> --}}
</div>
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" style='height:100%;'>
        <div class="carousel-inner bg-info" >
            @foreach($backgrounds as $key => $background)
            @if($key == 0)
                <div class="carousel-item active"  style=' height:100%;'>
                    <img class="d-block " src='{{URL::asset($background->image_path)}}'  >
                </div>
            @else
                <div class="carousel-item" style=' height:100%;'>
                    <img class="d-block" src='{{URL::asset($background->image_path)}}'  >
                </div>
            @endif
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
@endsection
