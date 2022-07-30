@extends('master')

@section('title','Report')
@section('content')


<div class="container-fluid" style="padding-top: 20px">

    @if (session()->has('success'))
    <div class="alert alert-success solid alert-end-icon alert-dismissible fade show mt-0">
        <span><i class="mdi mdi-check"></i></span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
        </button> {{session('success')}}
    </div>
    @endif

    @if (session()->has('error'))
    <div class="alert alert-danger solid alert-end-icon alert-dismissible fade show mt-0">
        <span><i class="mdi mdi-alert"></i></span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
        </button> {{session('error')}}
    </div>
    @endif


    <div class="row page-titles justify-content-between">
        <div class="col-lg-11">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">{{$page}}</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form enctype="multipart/form-data" method="GET" action="{{route('report-export')}}">
                        @csrf
                        <div class="row justify-content-between">
                            <div class="col-xl-4 mb-3">
                                <div class="example">
                                    <p class="mb-1">tanggal dari</p>
                                    <input class="form-control input-daterange-datepicker" type="date" name="startdate"
                                        value="">
                                </div>
                            </div>
                            <div class="col-xl-4 mb-3">
                                <div class="example">
                                    <p class="mb-1">tanggal sampai</p>
                                    <input class="form-control input-daterange-datepicker" type="date" name="todate"
                                        value="">
                                </div>
                            </div>
                            <div class="col-xl-1 header-right">
                                <button class="btn btn-primary shadow btn-md ">
                                    <i class="fas fa-print"></i>
                                    <span style="margin-left: 10px">Export</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



</div>

@endsection

@section('custom-js')

<script>
    $(function(){
  $('#datepicker').datepicker();
});
</script>

@endsection