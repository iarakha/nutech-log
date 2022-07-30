@extends('master')

@section('title','Log Trouble')
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
                    <h4 class="card-title">Log Trouble</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-responsive-sm">
                            <caption class="ml-3 mt-3">{{ $data->appends($_GET)->links() }}</caption>
                            <thead class="table-secondary">
                                <tr>
                                    <th style="width:80px;"><label class="title_th">No</label></th>
                                    <th style="width:200px;"><label class="title_th">No Ticket</label></th>
                                    <th><label class="title_th">Tanggal Masalah</label></th>
                                    <th><label class="title_th">Jam Masalah</label></th>
                                    <th><label class="title_th">Tanggal Selesai</label></th>
                                    <th><label class="title_th">Jam Selesai</label></th>
                                    <th><label class="title_th">Jenis Laporan</label></th>
                                    <th><label class="title_th">Project</label></th>
                                    <th style="width:150px;"><label class="title_th">Lokasi</label></th>
                                    <th style="width:150px;"><label class="title_th">Perangkat</label></th>
                                    <th><label class="title_th">Part</label></th>
                                    <th><label class="title_th">Masalah</label></th>
                                    <th><label class="title_th">Penyebab</label></th>
                                    <th><label class="title_th">Solusi</label></th>
                                    <th><label class="title_th">Sumber</label></th>
                                    <th><label class="title_th">Status</label></th>
                                    <th><label class="title_th">Keterangan</label></th>
                                    <th><label class="title_th">User</label></th>
                                    <th><label class="title_th">Aksi</label></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($join as $key => $item)
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
                                    <td> {{$item->jenis_masalah }} </td>
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
                                    <td> {{$item->user_name }} </td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="" data-bs-toggle="modal"
                                                data-bs-target="#modal-edit{{ $item->id }}"
                                                class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
                                                data-original-title="Edit user">
                                                Open
                                            </a>
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

    <!-- Modal Open -->

    @foreach ($join as $item)
    <form action="" method="post" enctype="multipart/form-data" role="form text-left">
        @csrf<div class="col-md-4">
            <div class="modal fade" id="modal-edit{{ $item->id }}" tabindex="-1" role="dialog"
                aria-labelledby="modal-edit" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ganti Status</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>
                                Mengubah status ke open.
                            </p>
                            <div class="row">
                                <div class="col-xl-6">
                                    No Tiket :
                                    <span class="fw-bold">
                                        {{$item->kode_wo}}
                                    </span>
                                </div>
                                <div class="col-xl-6">
                                    Jenis Laporan :
                                    <span class="fw-bold">
                                        {{$item->jenis_laporan}}
                                    </span>
                                </div>
                                <div class="col-xl-6">
                                    Project :
                                    <span class="fw-bold">
                                        {{$item->project}}
                                    </span>
                                </div>
                                <div class="col-xl-6">
                                    Lokasi :
                                    <span class="fw-bold">
                                        {{$item->lokasi}}
                                    </span>
                                </div>
                                <div class="col-xl-6">
                                    Perangkat :
                                    <span class="fw-bold">
                                        {{$item->perangkat}}
                                    </span>
                                </div>
                                <div class="col-xl-6">
                                    Part :
                                    <span class="fw-bold">
                                        {{$item->part}}
                                    </span>
                                </div>
                                <div class="col-xl-6">
                                    Masalah :
                                    <span class="fw-bold">
                                        {{$item->jenis_masalah}}
                                    </span>
                                </div>
                                <div class="col-xl-6">
                                    Sumber :
                                    <span class="fw-bold">
                                        {{$item->sumber}}
                                    </span>
                                </div>
                                <div class="col-xl-12">
                                    Keterangan :
                                    <span class="fw-bold">
                                        {{$item->keterangan}}
                                    </span>
                                </div>
                            </div>
                            <p class="mt-2">
                                Apakah anda ingin mengubah status ke <span class="fw-bold">
                                    OPEN? </span>
                            </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            {{-- <a type="button" class="btn btn-lg btn-danger" data-bs-toggle="popover"
                                data-bs-html="true" data-bs-sanitize="true" title="Dismissible popover"
                                data-bs-content='
                                    <div> Apakah anda yakin ingin mengubah status ke open ? <a href="#"> Ya </a>.</div>'>
                                popover</a> --}}

                            <a id="example" tabindex="0" class="btn btn-lg btn-danger" role="button"
                                data-bs-toggle="popover" title="Default: Html inside popover">Html inside popover</a>


                            <div hidden>
                                <div data-name="popover-content">
                                    <div class="input-group">
                                        <p> Apakah anda yakin ??
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

            </div>
        </div>
    </form>
    @endforeach

</div>

<script>
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
  return new bootstrap.Popover(popoverTriggerEl)
})


</script>

<script>
    $(document).ready(function() { 
                      var options = {
                          html: true,
                          title: "Optional: HELLO(Will overide the default-the inline title)",
                          //html element
                          //content: $("#popover-content")
                          content: $('[data-name="popover-content"]')
                          //Doing below won't work. Shows title only
                          //content: $("#popover-content").html()
              
                      }
                      var exampleEl = document.getElementById('example')
                      var popover = new bootstrap.Popover(exampleEl, options)
                  })
</script>


<style>
    .title_th {
        font-weight: 400;
        font-size: 14px;
    }
</style>

@endsection