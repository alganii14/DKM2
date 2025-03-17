@extends('layouts.master')

@section('konten')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Daftar Penerimaan Infaq dan Shodaqoh</h1>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

<<<<<<< HEAD
=======
            <!-- Total Infaq Balance Card -->
            <div class="card bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Saldo Infaq</h5>
                    <h2 class="card-text">Rp {{ number_format($totalInfaq, 0, ',', '.') }}</h2>
                </div>
            </div>

>>>>>>> a4508c7 (zakat)
            <!-- Search Bar -->
            <form action="{{ route('infaq.index') }}" method="GET" class="mb-3">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Cari Penerimaan Infaq" value="{{ request('search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Cari</button>
                    </div>
                </div>
            </form>

            <!-- Button Tambah Data -->
            <div class="mb-3">
                <a href="{{ route('infaq.create') }}" class="btn btn-primary">Tambah Data</a>
            </div>

            <!-- Daftar Penerimaan -->
            <div class="card mt-4">
                <div class="card-header">
                    <h3 class="card-title">Daftar Penerimaan Infaq dan Shodaqoh</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No. Penerimaan</th>
                                <th>Petugas</th>
                                <th>Donatur</th>
                                <th>Jenis Penerimaan</th>
                                <th>Jumlah</th>
                                <th>Tanggal</th>
                                <th>Waktu</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($infaqs as $index => $infaq)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $infaq->no_penerimaan }}</td>
                                <td>{{ $infaq->petugas ? $infaq->petugas->name : '-' }}</td>
                                <td>{{ $infaq->donatur->nama }}</td>
                                <td>{{ $infaq->jenis_penerimaan }}</td>
                                <td>Rp {{ number_format($infaq->jumlah, 0, ',', '.') }}</td>
                                <td>{{ \Carbon\Carbon::parse($infaq->tanggal)->format('d-m-Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($infaq->waktu)->format('H:i') }}</td>
                                <td>
                                    <a href="{{ route('infaq.edit', $infaq->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('infaq.destroy', $infaq->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center">Tidak ada data.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
<<<<<<< HEAD
=======

>>>>>>> a4508c7 (zakat)
