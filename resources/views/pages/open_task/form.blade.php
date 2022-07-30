@extends('master')

@section('title','Open Task')
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
                {{-- <li class="breadcrumb-item"><a href="javascript:void(0)">{{$title}}</a></li> --}}
            </ol>
        </div>
        <div class="col-lg-1 header-right">
            <a href="{{route('add-wo')}}" class="btn btn-success shadow btn-xs ">Tambah</a>
        </div>


    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Open Task</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-responsive-sm">
                            <caption class="ml-3 mt-3">{{ $data->appends($_GET)->links() }}</caption>
                            <thead>
                                <tr>
                                    <th style="width:80px;"><label class="title_th">No</label></th>
                                    <th><label class="title_th">No Ticket</label></th>
                                    <th><label class="title_th">Tanggal Masalah</label></th>
                                    <th><label class="title_th">Jam Masalah</label></th>
                                    <th><label class="title_th">Tanggal Selesai</label></th>
                                    <th><label class="title_th">Jam Selesai</label></th>
                                    <th><label class="title_th">Jenis Laporan</label></th>
                                    <th><label class="title_th">Project</label></th>
                                    <th><label class="title_th">Lokasi</label></th>
                                    <th><label class="title_th">Perangkat</label></th>
                                    <th><label class="title_th">Part</label></th>
                                    <th><label class="title_th">Masalah</label></th>
                                    <th><label class="title_th">Penyebab</label></th>
                                    <th><label class="title_th">Solusi</label></th>
                                    <th><label class="title_th">Sumber</label></th>
                                    <th><label class="title_th">Status</label></th>
                                    <th><label class="title_th">Keterangan</label></th>
                                    <th><label class="title_th">Aksi</label></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $item)
                                <tr>
                                    <td><strong>
                                            {{$data->firstItem() + $key}}
                                        </strong></td>
                                    <td> {{$item->kode_wo}} </td>
                                    <td> {{date('d/m/Y', strtotime($item->created_at))}} </td>
                                    <td> {{$item->jam_masalah}} </td>
                                    <td> {{date('d/m/Y', strtotime($item->updated_at))}} </td>
                                    <td> {{$item->jam_selesai }} </td>
                                    <td> {{$item->jenis_laporan }} </td>
                                    <td> {{$item->project}} </td>
                                    <td> {{$item->lokasi }} </td>
                                    <td> {{$item->perangkat }} </td>
                                    <td> {{$item->part }} </td>
                                    <td> {{$item->masalah }} </td>
                                    <td> {{$item->penyebab }} </td>
                                    <td> {{$item->solusi }} </td>
                                    <td> {{$item->sumber }} </td>
                                    <td>
                                        @switch($item->status)
                                        @case('done')
                                        <span class="badge light badge-success">SELESAI</span>
                                        @break
                                        @case('on progress')
                                        <span class="badge light badge-warning">ON PROGRESS</span>
                                        @break
                                        @case('waiting')
                                        <span class="badge light badge-info">WAITING</span>
                                        @break
                                        @case('open')
                                        <span class="badge light badge-danger">OPEN</span>
                                        @endswitch
                                        {{-- {{ $item->role }} --}}
                                    </td>
                                    <td> {{$item->keterangan }} </td>

                                    {{-- <td><span class="badge light badge-warning">{{$item->role}}</span></td> --}}

                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('wo-edit', $item->id) }}"
                                                class="btn btn-primary shadow btn-xs sharp me-1">
                                                <i class="fas fa-pencil-alt"></i></a>
                                            <a onclick="return confirm('Apakah Anda yakin?');"
                                                href="{{ route('wo-delete', $item->id) }}"
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

<style>
    .title_th {
        font-weight: 400;
        font-size: 14px;
    }
</style>

@endsection