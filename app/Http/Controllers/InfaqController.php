<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Infaq;
use App\Models\User;
use App\Models\Donatur;
use Illuminate\Http\Request;

class InfaqController extends Controller
{
    /**
     * Menampilkan daftar infaq.
     */
    public function index(Request $request)
<<<<<<< HEAD
{
    $query = Infaq::query();

    if ($request->has('search') && $request->search) {
        $searchTerm = $request->search;
        $query->where(function ($q) use ($searchTerm) {
            $q->where('no_penerimaan', 'like', "%$searchTerm%")
              ->orWhereHas('petugas', function($q) use ($searchTerm) {
                  $q->where('name', 'like', "%$searchTerm%");
              })
              ->orWhereHas('donatur', function($q) use ($searchTerm) {
                  $q->where('nama', 'like', "%$searchTerm%");
              })
              ->orWhere('jenis_penerimaan', 'like', "%$searchTerm%");
        });
    }

    $infaqs = $query->get();

    return view('infaq.index', compact('infaqs'));
}

=======
    {
        $query = Infaq::query();

        if ($request->has('search') && $request->search) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('no_penerimaan', 'like', "%$searchTerm%")
                  ->orWhereHas('petugas', function($q) use ($searchTerm) {
                      $q->where('name', 'like', "%$searchTerm%");
                  })
                  ->orWhereHas('donatur', function($q) use ($searchTerm) {
                      $q->where('nama', 'like', "%$searchTerm%");
                  })
                  ->orWhere('jenis_penerimaan', 'like', "%$searchTerm%");
            });
        }

        $infaqs = $query->get();

        // Calculate total infaq balance
        $totalInfaq = Infaq::sum('jumlah');

        return view('infaq.index', compact('infaqs', 'totalInfaq'));
    }

>>>>>>> a4508c7 (zakat)

    /**
     * Menampilkan form untuk menambah data infaq.
     */
    public function create()
    {
        // Ambil data petugas dan donatur
        $petugas = User::all();
        $donaturs = Donatur::all();

        // Ambil nomor penerimaan terakhir
        $lastInfaq = Infaq::orderBy('id', 'desc')->first();

        // Tentukan nomor penerimaan otomatis
        $prefix = 'PD.';
        $date = date('dmy'); // Format tanggal: ddmmYY
        $lastNumber = 1; // Default jika tidak ada data sebelumnya

        if ($lastInfaq) {
            // Ambil nomor terakhir dan ekstrak angka urutnya
            $lastNumber = (int) substr($lastInfaq->no_penerimaan, -3) + 1;
        }

        // Format nomor penerimaan dengan menambahkan 3 digit angka urut
        $no_penerimaan = $prefix . $date . '.' . str_pad($lastNumber, 3, '0', STR_PAD_LEFT);

        return view('infaq.create', compact('petugas', 'donaturs', 'no_penerimaan'));
    }

    /**
     * Menyimpan data infaq.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'no_penerimaan' => 'required|unique:infaqs',
            'tanggal' => 'required|date',
            'waktu' => 'required',
            'donatur_id' => 'required|exists:donaturs,id',
            'jenis_penerimaan' => 'required|string',
            'jumlah' => 'required|numeric',
        ]);

        // Pastikan user sudah login
        if (auth()->check()) {
            $validated['petugas_id'] = auth()->id(); // ID petugas yang login
        } else {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        // Simpan data infaq baru
        Infaq::create($validated);

        return redirect()->route('infaq.index')->with('success', 'Data infaq berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit data infaq.
     */
   // Fungsi untuk menampilkan form edit
public function edit(Infaq $infaq)
{
    // Ambil data petugas dan donatur
    $petugas = User::all();
    $donaturs = Donatur::all();

    return view('infaq.edit', compact('infaq', 'petugas', 'donaturs'));
}

// Fungsi untuk mengupdate data infaq
public function update(Request $request, Infaq $infaq)
{
    // Validasi input, hanya memperbolehkan 'jenis_penerimaan' dan 'jumlah' untuk diubah
    $validated = $request->validate([
        'jenis_penerimaan' => 'required|string', // Hanya validasi untuk jenis penerimaan
        'jumlah' => 'required|numeric', // Hanya validasi untuk jumlah
    ]);

    // Pastikan user sudah login
    if (auth()->check()) {
        $validated['petugas_id'] = auth()->id(); // ID petugas yang login
    } else {
        return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
    }

    // Update hanya jenis_penerimaan dan jumlah
    $infaq->update($validated);

    // Redirect dengan pesan sukses
    return redirect()->route('infaq.index')->with('success', 'Data infaq berhasil diupdate.');
}



    /**
     * Menghapus data infaq.
     */
    public function destroy(Infaq $infaq)
    {
        // Hapus data infaq
        $infaq->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('infaq.index')->with('success', 'Data infaq berhasil dihapus.');
    }

    public function report(Request $request)
{
    $query = Infaq::query();

    // Apply date range filter
    if ($request->has('start_date') && $request->has('end_date')) {
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $query->whereBetween('tanggal', [$startDate, $endDate]);
    }

    $infaqs = $query->get();

    return view('infaq.report', compact('infaqs'));
}

public function generatePdfReport(Request $request)
{
    $query = Infaq::query();

    // Filter berdasarkan tanggal
    if ($request->has('start_date') && $request->has('end_date')) {
        $query->whereBetween('tanggal', [$request->start_date, $request->end_date]);
    }

    // Filter berdasarkan jenis penerimaan
    if ($request->has('jenis_penerimaan') && $request->jenis_penerimaan != 'all') {
        $query->where('jenis_penerimaan', $request->jenis_penerimaan);
    }

    $infaqs = $query->get();

    // Generate PDF
    $pdf = PDF::loadView('infaq.pdf_report', compact('infaqs'));
    return $pdf->download('laporan_infaq.pdf');
}



}
