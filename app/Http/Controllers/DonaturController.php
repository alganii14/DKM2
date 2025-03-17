<?php

namespace App\Http\Controllers;

use App\Models\Donatur;
use Illuminate\Http\Request;

class DonaturController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $donaturs = Donatur::all();
        return view('donatur.index', compact('donaturs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mengambil nomor donatur terakhir dan generate nomor berikutnya
        $lastDonatur = Donatur::latest()->first();
        $lastNoDonatur = $lastDonatur ? $lastDonatur->no_donatur : null;
        $newNoDonatur = $this->generateNoDonatur($lastNoDonatur);

        return view('donatur.create', compact('newNoDonatur'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'no_telepon' => 'required|max:15',
            'pekerjaan' => 'nullable|max:255',
            'alamat' => 'nullable|max:500',
        ]);

        // Generate nomor donatur otomatis
        $lastDonatur = Donatur::latest()->first(); // Mengambil donatur terakhir
        $lastNoDonatur = $lastDonatur ? $lastDonatur->no_donatur : null;
        $newNoDonatur = $this->generateNoDonatur($lastNoDonatur);

        // Simpan data donatur baru
        Donatur::create([
            'no_donatur' => $newNoDonatur,
            'nama' => $request->nama,
            'no_telepon' => $request->no_telepon,
            'pekerjaan' => $request->pekerjaan,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('donatur.index')->with('success', 'Donatur berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $donatur = Donatur::findOrFail($id);
        return view('donatur.show', compact('donatur'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $donatur = Donatur::findOrFail($id);
        return view('donatur.edit', compact('donatur'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'no_telepon' => 'required|max:15',
            'pekerjaan' => 'nullable|max:255',
            'alamat' => 'nullable|max:500',
        ]);

        $donatur = Donatur::findOrFail($id);
        $donatur->update($request->except('no_donatur')); // Exclude no_donatur from being updated
        return redirect()->route('donatur.index')->with('success', 'Donatur berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $donatur = Donatur::findOrFail($id);
        $donatur->delete();
        return redirect()->route('donatur.index')->with('success', 'Donatur berhasil dihapus.');
    }

    /**
     * Generate nomor donatur otomatis.
     */
    private function generateNoDonatur($lastNoDonatur)
    {
        if ($lastNoDonatur) {
            $number = (int) substr($lastNoDonatur, 2); // Ambil angka terakhir
            $number++;
            return 'Dt' . str_pad($number, 3, '0', STR_PAD_LEFT); // Tambahkan padding
        }
        return 'Dt001'; // Nomor pertama jika belum ada donatur
    }
}