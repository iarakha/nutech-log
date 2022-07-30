@extends('master')

@section('title','Tiket Laporan')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@if (!isset($id))
                        Tambah
                        @else
                        Ubah
                        @endif Tiket Laporan</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form enctype="multipart/form-data" method="POST" @if(!isset($id))
                            action="{{ route('save-wo') }}" @else action="{{ route('wo-edit-save', $id) }}" @endif>
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Nomor Laporan</label>
                                    <input type="text" name="kode_wo" class="form-control" placeholder="{{$kode_wo}}"
                                        value="{{$kode_wo}}" disabled required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Pelapor</label>
                                    <input type="text" name="id_user" class="form-control"
                                        placeholder="{{$users->name}}" disabled required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Jenis Laporan</label>
                                    <input type="text" name="jenis_laporan" class="form-control"
                                        placeholder="Masukan Jenis Laporan" @if(!isset($id))
                                        value="{{ old('jenis_laporan') }}" @else value="{{ $item->jenis_laporan }}"
                                        @endif required autofocus>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Project</label>
                                    <input type="text" name="project" class="form-control" placeholder="Masukan Project"
                                        @if(!isset($id)) value="{{ old('project') }}" @else value="{{ $item->project }}"
                                        @endif required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Lokasi</label>
                                    <select name="id_lokasi" class="default-select wide form-control mb-2"
                                        id="validationCustom05" @if(!isset($id)) value="{{ old('id_lokasi') }}" @else
                                        value="{{ $item->lokasi }}" @endif required>
                                        <option data-display="Pilih Lokasi">Pilih Lokasi</option>
                                        @foreach ($lokasi as $lks )
                                        <option value="{{$lks->id}}">{{$lks->lokasi}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Perangkat</label>
                                    <select name="id_perangkat" class="default-select wide form-control mb-2"
                                        id="validationCustom05" @if(!isset($id)) value="{{ old('id_perangkat') }}" @else
                                        value="{{ $item->perangkat }}" @endif required>
                                        <option data-display="Pilih Perangkat">Pilih Perangkat</option>
                                        @foreach ($perangkat as $prngkt )
                                        <option value="{{$prngkt->id}}">{{$prngkt->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Part</label>
                                    <select name="id_part" class="default-select wide form-control mb-2"
                                        id="validationCustom05" @if(!isset($id)) value="{{ old('id_part') }}" @else
                                        value="{{ $item->part }}" @endif required>
                                        <option data-display="Pilih Part">Pilih Part</option>
                                        @foreach ($part as $prt )
                                        <option value="{{$prt->id}}">{{$prt->part}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Masalah</label>
                                    <select name="id_masalah" class="default-select wide form-control mb-2"
                                        id="validationCustom05" @if(!isset($id)) value="{{ old('id_masalah') }}" @else
                                        value="{{ $item->nama }}" @endif required>
                                        <option data-display="Pilih Jenis Masalah">Pilih Masalah</option>
                                        @foreach ($masalah as $mslh )
                                        <option value="{{$mslh->id}}">{{$mslh->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Penyebab</label>
                                    <input type="penyebab" name="penyebab" class="form-control" placeholder="Penyebab"
                                        @if(!isset($id)) value="{{ old('penyebab') }}" @else value="" @endif required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Solusi</label>
                                    <input type="solusi" name="solusi" class="form-control" placeholder="Solusi"
                                        @if(!isset($id)) value="{{ old('solusi') }}" @else value="" @endif required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Sumber</label>
                                    <input type="sumber" name="sumber" class="form-control" placeholder="Sumber"
                                        @if(!isset($id)) value="{{ old('sumber') }}" @else value="" @endif required>
                                </div>
                                @if (!isset($id))
                                <input type="hidden" name="status" value="1">
                                @else
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="default-select wide form-control mb-2"
                                        id="validationCustom05" @if(!isset($id)) value="{{ old('status') }}" @else
                                        value="{{ $item->status }}" @endif required>

                                        <option data-display="Pilih Status">Pilih Status</option>
                                        <option value="on progress" @if(isset($id)) @if($item->status == 'on progress')
                                            selected
                                            @endif @endif>On Progress</option>
                                        <option value="pending" @if(isset($id)) @if($item->status == 'pending')
                                            selected
                                            @endif @endif>Pending</option>
                                        <option value="selesai" @if(isset($id)) @if($item->status == 'selesai')
                                            selected
                                            @endif @endif>Selesai</option>d
                                    </select>
                                </div>
                                @endif
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="">Tanggal Masalah</label>
                                    <div class="col-xl-4 mb-3">
                                        <div class="example">
                                            <p class="mb-1">tanggal dari</p>
                                            <input class="form-control input-daterange-datepicker" type="date"
                                                name="tanggal_masalah" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="">Jam Masalah</label>
                                    <input type="time" name="jam_masalah" class="form-control form-control-sm"
                                        placeholder="0" @if (!isset($id)) value="{{ old('jam_masalah') }}" @else
                                        value="{{ $item->jam_masalah }}" @endif>
                                </div>
                                @if ($id)
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="">Jam Selesai</label>
                                    <input type="time" name="jam_selesai" class="form-control form-control-sm"
                                        placeholder="0" @if (!isset($id)) value="{{ old('jam_selesai') }}" @else
                                        value="{{ $item->jam_selesai }}" @endif>
                                </div>
                                @endif
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="">Keterangan</label>
                                    <textarea name="keterangan" id="keterangan" placeholder="Deskripsi Lengkap"
                                        style="height: 100px"
                                        class="form-control form-control-sm">@if (!isset($id)) {{ old('keterangan') }} @else {{ $item->keterangan }} @endif</textarea>

                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('custom-js')
<style>
    .form-label {
        margin-left: 20px;
    }
</style>


<script>
    CKEDITOR.replace('keterangan'); 
</script>



<script>
    $(function(){
  $('#datepicker').datepicker();
});
</script>

@endsection