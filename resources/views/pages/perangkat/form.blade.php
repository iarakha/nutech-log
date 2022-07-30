@extends('master')

@section('title','Perangkat')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Tambah Perangkat</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form enctype="multipart/form-data" method="POST" @if(!isset($id))
                            action="{{ route('save-perangkat') }}" @else
                            action="{{ route('perangkat-edit-save', $id) }}" @endif>
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label"> Nama Perangkat</label>
                                    <input type="text" name="nama" class="form-control" placeholder="Masukan Perangkat"
                                        @if(!isset($id)) value="{{ old('nama') }}" @else value="{{ $item->nama }}"
                                        @endif required autofocus>
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
</div>

<style>
    .form-label {
        margin-left: 20px;
    }
</style>
@endsection