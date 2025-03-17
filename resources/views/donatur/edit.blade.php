@extends('layouts.master')

@section('konten')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Edit Donatur</h1>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Form Edit Donatur</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('donatur.update', $donatur->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="no_donatur">No Donatur</label>
                            <input type="text" name="no_donatur" class="form-control" id="no_donatur"
                                value="{{ $donatur->no_donatur }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama Donatur</label>
                            <input type="text" name="nama" class="form-control" id="nama" value="{{ $donatur->nama }}"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="no_telepon">No Telepon</label>
                            <input type="text" name="no_telepon" class="form-control" id="no_telepon"
                                value="{{ $donatur->no_telepon }}" required>
                        </div>
                        <div class="form-group">
                            <label for="pekerjaan">Pekerjaan</label>
                            <input type="text" name="pekerjaan" class="form-control" id="pekerjaan"
                                value="{{ $donatur->pekerjaan }}">
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" class="form-control" id="alamat"
                                rows="3">{{ $donatur->alamat }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <a href="{{ route('donatur.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection