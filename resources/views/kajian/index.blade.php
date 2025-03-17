@extends('layouts.master')

@section('konten')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
<<<<<<< HEAD
            <h1>Daftar Kajian</h1>
=======
            <h1>Daftar Kegiatan</h1>
>>>>>>> a4508c7 (zakat)
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            <div class="mb-3">
<<<<<<< HEAD
                <a href="{{ route('kajian.create') }}" class="btn btn-success">Tambah Kajian</a>
=======
                <a href="{{ route('kajian.create') }}" class="btn btn-success">Tambah Kegiatan</a>
>>>>>>> a4508c7 (zakat)
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Kajian</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
<<<<<<< HEAD
                                <th>Judul Kajian</th>
                                <th>Nama Ustad</th>
                                <th>Tanggal Kajian</th>
                                <th>Deskripsi Kajian</th>
                                <th>Foto Kajian</th>
=======
                                <th>Judul Kegiatan</th>
                                <th>Nama Ustad</th>
                                <th>Tanggal Kegiatan</th>
                                <th>Deskripsi Kegiatan</th>
                                <th>Foto Kegiatan</th>
>>>>>>> a4508c7 (zakat)
                                <th>Foto Ustad</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kajians as $index => $kajian)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $kajian->judul_kajian }}</td>
                                <td>{{ $kajian->nama_ustad }}</td>
                                <td>{{ date('d-m-Y', strtotime($kajian->tanggal_kajian)) }}</td>
                                <td>{{ $kajian->deskripsi_kajian }}</td>
                                <td>
                                    @if($kajian->foto_kajian)
                                        <img src="{{ asset('storage/' . $kajian->foto_kajian) }}" width="100">
                                    @else
                                        <span>Tidak Ada</span>
                                    @endif
                                </td>
                                <td>
                                    @if($kajian->foto_ustad)
                                        <img src="{{ asset('storage/' . $kajian->foto_ustad) }}" width="100">
                                    @else
                                        <span>Tidak Ada</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('kajian.edit', $kajian->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('kajian.destroy', $kajian->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus data?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
