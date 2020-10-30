@extends('layouts.header')

@section('content')

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-9">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Headlines</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="lightBoxGallery">
                        @foreach($headlines as $headline)
                            <a  href="{{('http://10.96.4.70/'.$headline->tile_url)}}" title="" data-gallery=""><img src="{{('http://10.96.4.70/'.$headline->tile_url)}}" class='img-md'></a>
                        @endforeach
                        <!-- The Gallery as lightbox dialog, should be a child element of the document body -->
                        <div id="blueimp-gallery" class="blueimp-gallery">
                            <div class="slides"></div>
                            <h3 class="title"></h3>
                            <a class="prev">‹</a>
                            <a class="next">›</a>
                            <a class="close">×</a>
                            <a class="play-pause"></a>
                            <ol class="indicator"></ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Bulletin</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        
                    </div>
                </div>
                <div class="ibox-content">
                    <ol>
                        @foreach($bulletins as $bulletin)
                        <li> <a href="{{('http://10.96.4.70/'.$bulletin->file_path)}}" target="_blank">{{$bulletin->title}}  </a> <br> posted by {{$bulletin->created_by->name}}</li>
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="footer">
    
</div>



@endsection
