@extends('layouts.master')

@section('konten')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Daftar Donatur</h1>
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

            <!-- Button Tambah Donatur -->
            <div class="mb-3">
                <a href="{{ route('donatur.create') }}" class="btn btn-success">Tambah Donatur</a>
            </div>

            <!-- Daftar Donatur -->
            <div class="card mt-4">
                <div class="card-header">
                    <h3 class="card-title">Daftar Donatur</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>No Donatur</th>
                                <th>Nama</th>
                                <th>No Telepon</th>
                                <th>Pekerjaan</th>
                                <th>Alamat</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($donaturs as $index => $donatur)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $donatur->no_donatur }}</td>
                                <td>{{ $donatur->nama }}</td>
                                <td>{{ $donatur->no_telepon }}</td>
                                <td>{{ $donatur->pekerjaan }}</td>
                                <td>{{ $donatur->alamat }}</td>
                                <td>
                                    <a href="{{ route('donatur.edit', $donatur->id) }}"
                                        class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('donatur.destroy', $donatur->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Hapus donatur?')">Delete</button>
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