@extends('master')

@section('title','User')
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
                        @endif User</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form enctype="multipart/form-data" method="POST" @if(!isset($id))
                            action="{{ route('save-user') }}" @else action="{{ route('user-edit-save', $id) }}" @endif>
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label"> Nama</label>
                                    <input type="text" name="name" class="form-control" placeholder="Masukan nama anda"
                                        @if(!isset($id)) value="{{ old('name') }}" @else value="{{ $item->name }}"
                                        @endif required autofocus>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Username</label>
                                    <input type="text" name="username" class="form-control" placeholder="Username"
                                        @if(!isset($id)) value="{{ old('username') }}" @else
                                        value="{{ $item->username }}" @endif required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="Email"
                                        @if(!isset($id)) value="{{ old('email') }}" @else value="{{ $item->email }}"
                                        @endif required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Password"
                                        @if(!isset($id)) value="{{ old('password') }}" @else value="" @endif required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Role</label>
                                    <select name="role" class="default-select wide form-control mb-2"
                                        id="validationCustom05" @if(!isset($id)) value="{{ old('role') }}" @else
                                        value="{{ $item->role }}" @endif required>
                                        <option data-display="Select">Please select</option>
                                        <option value="1" @if(isset($id)) @if($item->role == 'superadmin')
                                            selected
                                            @endif @endif>Superadmin</option>
                                        <option value="2" @if(isset($id)) @if($item->role == 'cs')
                                            selected
                                            @endif @endif>CS</option>
                                        <option value="3" @if(isset($id)) @if($item->role == 'teknisi')
                                            selected
                                            @endif @endif>Teknisi</option>
                                        <option value="4" @if(isset($id)) @if($item->role == 'it')
                                            selected
                                            @endif @endif>IT Support</option>
                                        <option value="4" @if(isset($id)) @if($item->role == 'analis')
                                            selected
                                            @endif @endif>Project Manager</option>
                                    </select>
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