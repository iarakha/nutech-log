@extends('master')

@section('title','Perangkat')
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
                <li class="breadcrumb-item active"><a href="javascript:void(0)">{{$page}}</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">{{$title}}</a></li>
            </ol>
        </div>
        <div class="col-lg-1 header-right">
            <a href="{{route('add-perangkat')}}" class="btn btn-success shadow btn-xs ">Tambah</a>
        </div>


    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Perangkat</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <caption class="ml-3 mt-3">{{ $data->appends($_GET)->links() }}</caption>
                            <thead>
                                <tr>
                                    <th style="width:100px;"><strong>No</strong></th>
                                    <th><strong>Nama Perangkat</strong></th>

                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $item)
                                <tr>
                                    <td><strong>
                                            {{$data->firstItem() + $key}}
                                        </strong></td>
                                    <td> {{$item->nama}} </td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('perangkat-edit', $item->id) }}"
                                                class="btn btn-primary shadow btn-xs sharp me-1">
                                                <i class="fas fa-pencil-alt"></i></a>
                                            <a onclick="return confirm('Apakah Anda yakin?');"
                                                href="{{ route('perangkat-delete', $item->id) }}"
                                                class="btn btn-danger shadow btn-xs sharp sweet-confirm">
                                                <i class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>

                    </div>
                    {{-- {{$data->links()}} --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection