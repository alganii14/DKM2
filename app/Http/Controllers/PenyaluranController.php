<?php

namespace App\Http\Controllers;

use App\Models\Penyaluran;
use App\Models\PenyaluranPenerima;
use App\Models\Mustahik;
use App\Models\Zakat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PenyaluranController extends Controller
{
    public function index()
    {
        $penyalurans = Penyaluran::with('penerimas')->get();
<<<<<<< HEAD
        return view('penyaluran.index', compact('penyalurans'));
=======

        // Hitung total per jenis zakat (uang)
        $zakats = Zakat::all();
        $totalZakatFitrah = $zakats->where('jenis_zakat', 'Zakat Fitrah')
            ->where('jenis_bayar', 'uang')
            ->sum('jumlah_zakat');

        $totalZakatMal = $zakats->where('jenis_zakat', 'Zakat Mal')
            ->sum('jumlah_zakat');

        $totalZakatFidyah = $zakats->where('jenis_zakat', 'Zakat Fidyah')
            ->sum('jumlah_zakat');

        // Hitung total beras
        $totalBeras = $zakats->where('jenis_bayar', 'beras')
            ->sum('berat_beras');

        // Hitung total penyaluran per jenis zakat
        $penyaluranZakatFitrah = Penyaluran::where('jenis_zakat', 'Zakat Fitrah')->sum('total_penyaluran');
        $penyaluranZakatMal = Penyaluran::where('jenis_zakat', 'Zakat Mal')->sum('total_penyaluran');
        $penyaluranZakatFidyah = Penyaluran::where('jenis_zakat', 'Zakat Fidyah')->sum('total_penyaluran');

        // Kurangi saldo dengan penyaluran
        $totalZakatFitrah -= $penyaluranZakatFitrah;
        $totalZakatMal -= $penyaluranZakatMal;
        $totalZakatFidyah -= $penyaluranZakatFidyah;

        // Total saldo keseluruhan (uang + nilai beras) setelah dikurangi penyaluran
        $totalSaldo = $totalZakatFitrah + $totalZakatMal + $totalZakatFidyah + ($totalBeras * 14000);

        return view('penyaluran.index', compact(
            'penyalurans',
            'totalSaldo',
            'totalZakatFitrah',
            'totalZakatMal',
            'totalZakatFidyah',
            'totalBeras'
        ));
>>>>>>> a4508c7 (zakat)
    }

    public function create()
    {
        // Generate nomor penyaluran otomatis
        $lastPenyaluran = Penyaluran::latest()->first();
        $lastNumber = $lastPenyaluran ? intval(substr($lastPenyaluran->no_penyaluran, -3)) : 0;
        $newNumber = $lastNumber + 1;
        $no_penyaluran = 'PY' . date('dmy') . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        $mustahiks = Mustahik::all();
        $jenis_zakats = Zakat::distinct()->pluck('jenis_zakat');

<<<<<<< HEAD
        return view('penyaluran.create', compact('no_penyaluran', 'mustahiks', 'jenis_zakats'));
=======
        // Hitung saldo per jenis zakat (uang)
        $zakats = Zakat::all();

        // Zakat Fitrah - Uang
        $saldoZakatFitrahUang = $zakats->where('jenis_zakat', 'Zakat Fitrah')
            ->where('jenis_bayar', 'uang')
            ->sum('jumlah_zakat');

        // Zakat Fitrah - Beras (dalam kg)
        $saldoZakatFitrahBeras = $zakats->where('jenis_zakat', 'Zakat Fitrah')
            ->where('jenis_bayar', 'beras')
            ->sum('berat_beras');

        // Nilai beras dalam bentuk uang
        $nilaiBerasZakatFitrah = $saldoZakatFitrahBeras * 14000;

        // Zakat Mal (selalu uang)
        $saldoZakatMal = $zakats->where('jenis_zakat', 'Zakat Mal')
            ->sum('jumlah_zakat');

        // Zakat Fidyah (selalu uang)
        $saldoZakatFidyah = $zakats->where('jenis_zakat', 'Zakat Fidyah')
            ->sum('jumlah_zakat');

        // Hitung total penyaluran per jenis zakat
        $penyaluranZakatFitrah = Penyaluran::where('jenis_zakat', 'Zakat Fitrah')->sum('total_penyaluran');
        $penyaluranZakatMal = Penyaluran::where('jenis_zakat', 'Zakat Mal')->sum('total_penyaluran');
        $penyaluranZakatFidyah = Penyaluran::where('jenis_zakat', 'Zakat Fidyah')->sum('total_penyaluran');

        // Kurangi saldo dengan penyaluran
        // Untuk Zakat Fitrah, kurangi dari uang dulu, baru dari beras jika uang tidak cukup
        if ($penyaluranZakatFitrah <= $saldoZakatFitrahUang) {
            $saldoZakatFitrahUang -= $penyaluranZakatFitrah;
        } else {
            $sisaPenyaluran = $penyaluranZakatFitrah - $saldoZakatFitrahUang;
            $saldoZakatFitrahUang = 0;
            $nilaiBerasZakatFitrah -= $sisaPenyaluran;
            if ($nilaiBerasZakatFitrah < 0) $nilaiBerasZakatFitrah = 0;
            $saldoZakatFitrahBeras = $nilaiBerasZakatFitrah / 14000;
        }

        $saldoZakatMal -= $penyaluranZakatMal;
        if ($saldoZakatMal < 0) $saldoZakatMal = 0;

        $saldoZakatFidyah -= $penyaluranZakatFidyah;
        if ($saldoZakatFidyah < 0) $saldoZakatFidyah = 0;

        // Buat array saldo untuk digunakan di JavaScript
        $saldoPerJenisZakat = [
            'Zakat Fitrah' => [
                'uang' => $saldoZakatFitrahUang,
                'beras' => $saldoZakatFitrahBeras,
                'nilai_beras' => $nilaiBerasZakatFitrah,
                'total' => $saldoZakatFitrahUang + $nilaiBerasZakatFitrah
            ],
            'Zakat Mal' => [
                'uang' => $saldoZakatMal,
                'beras' => 0,
                'nilai_beras' => 0,
                'total' => $saldoZakatMal
            ],
            'Zakat Fidyah' => [
                'uang' => $saldoZakatFidyah,
                'beras' => 0,
                'nilai_beras' => 0,
                'total' => $saldoZakatFidyah
            ]
        ];

        return view('penyaluran.create', compact(
            'no_penyaluran',
            'mustahiks',
            'jenis_zakats',
            'saldoPerJenisZakat'
        ));
>>>>>>> a4508c7 (zakat)
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_penyaluran' => 'required|unique:penyalurans',
            'tanggal_penyaluran' => 'required|date',
            'jam_penyaluran' => 'required',
            'jenis_zakat' => 'required',
            'total_penyaluran' => 'required|integer',
            'status_penyaluran' => 'required',
            'penerimas' => 'required|array',
            'penerimas.*.no_mustahik' => 'required|exists:mustahiks,no_mustahik',
            'penerimas.*.jumlah_terima' => 'required|integer',
<<<<<<< HEAD
        ]);

=======
            'penerimas.*.jenis_terima' => 'required|in:uang,beras',
            'penerimas.*.jumlah_beras' => 'nullable|numeric',
        ]);

        // Validasi saldo mencukupi
        $jenisZakat = $request->jenis_zakat;
        $totalPenyaluran = $request->total_penyaluran;

        // Hitung saldo tersedia
        $zakats = Zakat::all();
        $saldoZakat = 0;
        $saldoUang = 0;
        $saldoBeras = 0;

        if ($jenisZakat === 'Zakat Fitrah') {
            $saldoUang = $zakats->where('jenis_zakat', 'Zakat Fitrah')
                ->where('jenis_bayar', 'uang')
                ->sum('jumlah_zakat');

            $saldoBeras = $zakats->where('jenis_zakat', 'Zakat Fitrah')
                ->where('jenis_bayar', 'beras')
                ->sum('berat_beras');

            $saldoZakat = $saldoUang + ($saldoBeras * 14000);
        } elseif ($jenisZakat === 'Zakat Mal') {
            $saldoUang = $zakats->where('jenis_zakat', 'Zakat Mal')
                ->sum('jumlah_zakat');
            $saldoZakat = $saldoUang;
        } elseif ($jenisZakat === 'Zakat Fidyah') {
            $saldoUang = $zakats->where('jenis_zakat', 'Zakat Fidyah')
                ->sum('jumlah_zakat');
            $saldoZakat = $saldoUang;
        }

        // Kurangi dengan penyaluran yang sudah ada
        $penyaluranSebelumnya = Penyaluran::where('jenis_zakat', $jenisZakat)->sum('total_penyaluran');
        $saldoZakat -= $penyaluranSebelumnya;

        // Hitung total yang akan disalurkan (97.5% dari total_penyaluran)
        $totalDisalurkan = $totalPenyaluran * 0.975; // 97.5% dari total

        // Cek saldo mencukupi
        if ($totalDisalurkan > $saldoZakat) {
            return back()->with('error', 'Saldo zakat tidak mencukupi untuk penyaluran ini.');
        }

        // Hitung total beras yang dibutuhkan
        $totalBerasDisalurkan = 0;
        foreach ($request->penerimas as $penerima) {
            if (isset($penerima['jenis_terima']) && $penerima['jenis_terima'] === 'beras') {
                $totalBerasDisalurkan += isset($penerima['jumlah_beras']) ? (float)$penerima['jumlah_beras'] : 0;
            }
        }

        // Cek saldo beras mencukupi
        if ($totalBerasDisalurkan > $saldoBeras) {
            return back()->with('error', 'Saldo beras tidak mencukupi untuk penyaluran ini.');
        }

>>>>>>> a4508c7 (zakat)
        DB::beginTransaction();
        try {
            // Create penyaluran
            $penyaluran = Penyaluran::create([
                'no_penyaluran' => $request->no_penyaluran,
                'tanggal_penyaluran' => $request->tanggal_penyaluran,
                'jam_penyaluran' => $request->jam_penyaluran,
                'petugas_penyaluran' => Auth::user()->name,
                'jenis_zakat' => $request->jenis_zakat,
<<<<<<< HEAD
                'total_penyaluran' => $request->total_penyaluran,
=======
                'total_penyaluran' => $totalDisalurkan, // Hanya 97.5% yang disalurkan
>>>>>>> a4508c7 (zakat)
                'status_penyaluran' => $request->status_penyaluran,
                'keterangan' => $request->keterangan,
            ]);

            // Create penerimas
            foreach ($request->penerimas as $penerima) {
<<<<<<< HEAD
=======
                $jenisTerima = $penerima['jenis_terima'] ?? 'uang';
                $jumlahBeras = isset($penerima['jumlah_beras']) ? (float)$penerima['jumlah_beras'] : 0;

>>>>>>> a4508c7 (zakat)
                PenyaluranPenerima::create([
                    'no_penyaluran' => $penyaluran->no_penyaluran,
                    'no_mustahik' => $penerima['no_mustahik'],
                    'jumlah_terima' => $penerima['jumlah_terima'],
<<<<<<< HEAD
=======
                    'jenis_terima' => $jenisTerima,
                    'jumlah_beras' => $jenisTerima === 'beras' ? $jumlahBeras : 0,
>>>>>>> a4508c7 (zakat)
                    'status_penerima' => 'Diterima'
                ]);
            }

            DB::commit();
            return redirect()->route('penyaluran.index')
                           ->with('success', 'Data penyaluran zakat berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollback();
<<<<<<< HEAD
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data');
=======
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
>>>>>>> a4508c7 (zakat)
        }
    }

    public function edit(Penyaluran $penyaluran)
    {
        $mustahiks = Mustahik::all();
        $jenis_zakats = Zakat::distinct()->pluck('jenis_zakat');
        return view('penyaluran.edit', compact('penyaluran', 'mustahiks', 'jenis_zakats'));
    }

    public function update(Request $request, Penyaluran $penyaluran)
    {
        $request->validate([
            'tanggal_penyaluran' => 'required|date',
            'jam_penyaluran' => 'required',
            'jenis_zakat' => 'required',
            'total_penyaluran' => 'required|integer',
            'status_penyaluran' => 'required',
            'penerimas' => 'required|array',
            'penerimas.*.no_mustahik' => 'required|exists:mustahiks,no_mustahik',
            'penerimas.*.jumlah_terima' => 'required|integer',
<<<<<<< HEAD
        ]);

        DB::beginTransaction();
        try {
=======
            'penerimas.*.jenis_terima' => 'required|in:uang,beras',
            'penerimas.*.jumlah_beras' => 'nullable|numeric',
        ]);

        // Validasi saldo mencukupi jika ada perubahan jumlah atau jenis zakat
        if ($penyaluran->jenis_zakat !== $request->jenis_zakat || $penyaluran->total_penyaluran !== $request->total_penyaluran) {
            $jenisZakat = $request->jenis_zakat;
            $totalPenyaluran = $request->total_penyaluran;

            // Hitung saldo tersedia
            $zakats = Zakat::all();
            $saldoZakat = 0;
            $saldoUang = 0;
            $saldoBeras = 0;

            if ($jenisZakat === 'Zakat Fitrah') {
                $saldoUang = $zakats->where('jenis_zakat', 'Zakat Fitrah')
                    ->where('jenis_bayar', 'uang')
                    ->sum('jumlah_zakat');

                $saldoBeras = $zakats->where('jenis_zakat', 'Zakat Fitrah')
                    ->where('jenis_bayar', 'beras')
                    ->sum('berat_beras');

                $saldoZakat = $saldoUang + ($saldoBeras * 14000);
            } elseif ($jenisZakat === 'Zakat Mal') {
                $saldoUang = $zakats->where('jenis_zakat', 'Zakat Mal')
                    ->sum('jumlah_zakat');
                $saldoZakat = $saldoUang;
            } elseif ($jenisZakat === 'Zakat Fidyah') {
                $saldoUang = $zakats->where('jenis_zakat', 'Zakat Fidyah')
                    ->sum('jumlah_zakat');
                $saldoZakat = $saldoUang;
            }

            // Kurangi dengan penyaluran yang sudah ada (kecuali penyaluran yang sedang diedit)
            $penyaluranSebelumnya = Penyaluran::where('jenis_zakat', $jenisZakat)
                ->where('no_penyaluran', '!=', $penyaluran->no_penyaluran)
                ->sum('total_penyaluran');
            $saldoZakat -= $penyaluranSebelumnya;

            // Hitung total yang akan disalurkan (97.5% dari total_penyaluran)
            $totalDisalurkan = $totalPenyaluran * 0.975; // 97.5% dari total

            // Cek saldo mencukupi
            if ($totalDisalurkan > $saldoZakat) {
                return back()->with('error', 'Saldo zakat tidak mencukupi untuk penyaluran ini.');
            }

            // Hitung total beras yang dibutuhkan
            $totalBerasDisalurkan = 0;
            foreach ($request->penerimas as $penerima) {
                if (isset($penerima['jenis_terima']) && $penerima['jenis_terima'] === 'beras') {
                    $totalBerasDisalurkan += isset($penerima['jumlah_beras']) ? (float)$penerima['jumlah_beras'] : 0;
                }
            }

            // Cek saldo beras mencukupi
            if ($totalBerasDisalurkan > $saldoBeras) {
                return back()->with('error', 'Saldo beras tidak mencukupi untuk penyaluran ini.');
            }
        }

        DB::beginTransaction();
        try {
            // Hitung total yang akan disalurkan (97.5% dari total_penyaluran)
            $totalDisalurkan = $request->total_penyaluran * 0.975; // 97.5% dari total

>>>>>>> a4508c7 (zakat)
            $penyaluran->update([
                'tanggal_penyaluran' => $request->tanggal_penyaluran,
                'jam_penyaluran' => $request->jam_penyaluran,
                'jenis_zakat' => $request->jenis_zakat,
<<<<<<< HEAD
                'total_penyaluran' => $request->total_penyaluran,
=======
                'total_penyaluran' => $totalDisalurkan, // Hanya 97.5% yang disalurkan
>>>>>>> a4508c7 (zakat)
                'status_penyaluran' => $request->status_penyaluran,
                'keterangan' => $request->keterangan,
            ]);

            // Delete existing penerimas
            $penyaluran->penerimas()->delete();

            // Create new penerimas
            foreach ($request->penerimas as $penerima) {
<<<<<<< HEAD
=======
                $jenisTerima = $penerima['jenis_terima'] ?? 'uang';
                $jumlahBeras = isset($penerima['jumlah_beras']) ? (float)$penerima['jumlah_beras'] : 0;

>>>>>>> a4508c7 (zakat)
                PenyaluranPenerima::create([
                    'no_penyaluran' => $penyaluran->no_penyaluran,
                    'no_mustahik' => $penerima['no_mustahik'],
                    'jumlah_terima' => $penerima['jumlah_terima'],
<<<<<<< HEAD
=======
                    'jenis_terima' => $jenisTerima,
                    'jumlah_beras' => $jenisTerima === 'beras' ? $jumlahBeras : 0,
>>>>>>> a4508c7 (zakat)
                    'status_penerima' => 'Diterima'
                ]);
            }

            DB::commit();
            return redirect()->route('penyaluran.index')
                           ->with('success', 'Data penyaluran zakat berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollback();
<<<<<<< HEAD
            return back()->with('error', 'Terjadi kesalahan saat memperbarui data');
=======
            return back()->with('error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage());
>>>>>>> a4508c7 (zakat)
        }
    }

    public function destroy(Penyaluran $penyaluran)
    {
        $penyaluran->delete();
        return redirect()->route('penyaluran.index')
                       ->with('success', 'Data penyaluran zakat berhasil dihapus');
    }
}
