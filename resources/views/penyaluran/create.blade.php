@extends('layouts.master')

@section('konten')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Tambah Penyaluran Zakat</h1>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Form Tambah Penyaluran Zakat</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('penyaluran.store') }}" method="POST" id="penyaluranForm">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_penyaluran">Nomor Penyaluran</label>
                                    <input type="text" class="form-control" id="no_penyaluran" name="no_penyaluran" value="{{ $no_penyaluran }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="tanggal_penyaluran">Tanggal Penyaluran</label>
                                    <input type="date" class="form-control" id="tanggal_penyaluran" name="tanggal_penyaluran" required>
                                </div>

                                <div class="form-group">
                                    <label for="jam_penyaluran">Jam Penyaluran</label>
                                    <input type="time" class="form-control" id="jam_penyaluran" name="jam_penyaluran" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jenis_zakat">Jenis Zakat</label>
                                    <select class="form-control" id="jenis_zakat" name="jenis_zakat" required>
                                        <option value="">Pilih Jenis Zakat</option>
                                        @foreach($jenis_zakats as $jenis)
                                            <option value="{{ $jenis }}">{{ $jenis }}</option>
                                        @endforeach
                                    </select>
                                </div>

<<<<<<< HEAD
                                <div class="form-group">
                                    <label for="total_penyaluran">Total Penyaluran</label>
                                    <input type="number" class="form-control" id="total_penyaluran" name="total_penyaluran" required>
=======
                                <!-- Informasi Saldo -->
                                <div id="info-saldo" class="mb-3" style="display: none;">
                                    <div class="card bg-light">
                                        <div class="card-body">
                                            <h5 class="card-title">Informasi Saldo</h5>
                                            <div id="saldo-uang-container">
                                                <p>Saldo Uang: <span id="saldo-uang">Rp 0</span></p>
                                            </div>
                                            <div id="saldo-beras-container" style="display: none;">
                                                <p>Saldo Beras: <span id="saldo-beras">0 kg</span> (Rp <span id="nilai-beras">0</span>)</p>
                                            </div>
                                            <p>Total Saldo: <span id="total-saldo">Rp 0</span></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="total_penyaluran">Total Penyaluran</label>
                                    <input type="number" class="form-control" id="total_penyaluran" name="total_penyaluran" required>
                                    <small class="text-muted">Catatan: 2,5% dari total akan dikembalikan ke saldo</small>
>>>>>>> a4508c7 (zakat)
                                </div>

                                <div class="form-group">
                                    <label for="status_penyaluran">Status Penyaluran</label>
                                    <select class="form-control" id="status_penyaluran" name="status_penyaluran" required>
                                        <option value="Selesai">Selesai</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Dibatalkan">Dibatalkan</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
                        </div>

                        <!-- Kalkulator Penyaluran -->
                        <div class="mt-4 card">
                            <div class="card-header">
                                <h3 class="card-title">Kalkulator Penyaluran Zakat</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
<<<<<<< HEAD
                                    <div class="col-md-6">
                                        <div class="info-box">
                                            <div class="info-box-content">
                                                <span class="info-box-text">Bagian Fakir/Miskin (62.5%)</span>
                                                <span class="info-box-number" id="bagianFakirMiskin">0</span>
                                                <small>Bagian per KK: <span id="bagianPerKK">0</span></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-box">
                                            <div class="info-box-content">
                                                <span class="info-box-text">Bagian Amilin (37.5%)</span>
                                                <span class="info-box-number" id="bagianAmilin">0</span>
=======
                                    <div class="col-md-4">
                                        <div class="info-box">
                                            <div class="info-box-content">
                                                <span class="info-box-text">Bagian Fakir/Miskin (65%)</span>
                                                <span class="info-box-number" id="bagianFakirMiskin">0</span>
                                                <small>Bagian per KK: <span id="bagianPerKK">0</span></small>
                                                <div id="beras-fakir-container" style="display: none;">
                                                    <small>Beras per KK: <span id="berasPerKK">0 kg</span></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="info-box">
                                            <div class="info-box-content">
                                                <span class="info-box-text">Bagian Amilin (32.5%)</span>
                                                <span class="info-box-number" id="bagianAmilin">0</span>
                                                <small>Bagian per Amilin: <span id="bagianPerAmilin">0</span></small>
                                                <div id="beras-amilin-container" style="display: none;">
                                                    <small>Beras per Amilin: <span id="berasPerAmilin">0 kg</span></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="info-box">
                                            <div class="info-box-content">
                                                <span class="info-box-text">Sisa Zakat (2.5%)</span>
                                                <span class="info-box-number" id="sisaZakat">0</span>
                                                <small class="text-success">Dikembalikan ke saldo</small>
>>>>>>> a4508c7 (zakat)
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Penerima Zakat -->
                        <div class="mt-4 card">
                            <div class="card-header">
                                <h3 class="card-title">Penerima Zakat</h3>
                            </div>
                            <div class="card-body">
                                <div id="penerima-container">
                                    <!-- Penerima rows will be added here -->
                                </div>
                                <button type="button" class="btn btn-success" id="tambah-penerima">
                                    <i class="fas fa-plus"></i> Tambah Penerima
                                </button>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('penyaluran.index') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let counter = 0;
    const container = document.getElementById('penerima-container');
    const form = document.getElementById('penyaluranForm');
    let selectedMustahiks = new Set();
    let mustahikData = @json($mustahiks);

<<<<<<< HEAD
=======
    // Saldo per jenis zakat
    const saldoPerJenisZakat = @json($saldoPerJenisZakat);

    // Debugging
    console.log('Saldo Per Jenis Zakat:', saldoPerJenisZakat);

>>>>>>> a4508c7 (zakat)
    // Set default date and time
    document.querySelector('input[name="tanggal_penyaluran"]').value = new Date().toISOString().split('T')[0];
    document.querySelector('input[name="jam_penyaluran"]').value = new Date().toLocaleTimeString('en-GB').slice(0, 5);

<<<<<<< HEAD
    function calculateDistribution() {
        const totalPenyaluran = parseFloat(document.getElementById('total_penyaluran').value) || 0;

        // Calculate portions
        const bagianFakirMiskin = totalPenyaluran * 0.625;
        const bagianAmilin = totalPenyaluran * 0.375;

        // Count Fakir/Miskin recipients
        const fakirMiskinCount = Array.from(container.querySelectorAll('.mustahik-select')).filter(select => {
            const mustahik = mustahikData.find(m => m.no_mustahik === select.value);
            return mustahik && mustahik.asnaf === 'Fakir/Miskin';
        }).length || 1; // Prevent division by zero

        // Calculate base amount per KK
        const bagianPerKK = bagianFakirMiskin / fakirMiskinCount;
=======
    // Auto-fill total_penyaluran when jenis_zakat changes
    document.getElementById('jenis_zakat').addEventListener('change', function() {
        const jenisZakat = this.value;
        const totalPenyaluranInput = document.getElementById('total_penyaluran');
        const infoSaldo = document.getElementById('info-saldo');
        const saldoUangContainer = document.getElementById('saldo-uang-container');
        const saldoBerasContainer = document.getElementById('saldo-beras-container');
        const saldoUangSpan = document.getElementById('saldo-uang');
        const saldoBerasSpan = document.getElementById('saldo-beras');
        const nilaiBerasSpan = document.getElementById('nilai-beras');
        const totalSaldoSpan = document.getElementById('total-saldo');
        const berasFakirContainer = document.getElementById('beras-fakir-container');
        const berasAmilinContainer = document.getElementById('beras-amilin-container');

        if (jenisZakat && saldoPerJenisZakat[jenisZakat]) {
            // Tampilkan informasi saldo
            infoSaldo.style.display = 'block';

            // Tampilkan saldo uang
            saldoUangSpan.textContent = formatRupiah(saldoPerJenisZakat[jenisZakat].uang);

            // Tampilkan saldo beras jika ada
            if (saldoPerJenisZakat[jenisZakat].beras > 0) {
                saldoBerasContainer.style.display = 'block';
                saldoBerasSpan.textContent = saldoPerJenisZakat[jenisZakat].beras.toFixed(2) + ' kg';
                nilaiBerasSpan.textContent = formatRupiah(saldoPerJenisZakat[jenisZakat].nilai_beras);
                berasFakirContainer.style.display = 'block';
                berasAmilinContainer.style.display = 'block';
            } else {
                saldoBerasContainer.style.display = 'none';
                berasFakirContainer.style.display = 'none';
                berasAmilinContainer.style.display = 'none';
            }

            // Tampilkan total saldo
            totalSaldoSpan.textContent = formatRupiah(saldoPerJenisZakat[jenisZakat].total);

            // Isi total penyaluran dengan total saldo
            totalPenyaluranInput.value = saldoPerJenisZakat[jenisZakat].total;
            calculateDistribution();
        } else {
            infoSaldo.style.display = 'none';
            totalPenyaluranInput.value = '';
        }
    });

    function calculateDistribution() {
        const totalPenyaluran = parseFloat(document.getElementById('total_penyaluran').value) || 0;
        const jenisZakat = document.getElementById('jenis_zakat').value;

        // Calculate portions with new percentages
        const bagianFakirMiskin = totalPenyaluran * 0.65;  // 65%
        const bagianAmilin = totalPenyaluran * 0.325;      // 32.5%
        const sisaZakat = totalPenyaluran * 0.025;         // 2.5%

        // Count Fakir/Miskin recipients
        const fakirMiskinSelects = Array.from(container.querySelectorAll('.mustahik-select')).filter(select => {
            if (!select.value) return false;
            const mustahik = mustahikData.find(m => m.no_mustahik === select.value);
            return mustahik && (mustahik.asnaf === 'Fakir' || mustahik.asnaf === 'Miskin');
        });

        // Count Amilin recipients
        const amilinSelects = Array.from(container.querySelectorAll('.mustahik-select')).filter(select => {
            if (!select.value) return false;
            const mustahik = mustahikData.find(m => m.no_mustahik === select.value);
            return mustahik && (mustahik.asnaf === 'Amilin' || mustahik.asnaf === 'Amilin Lainnya');
        });

        const fakirMiskinCount = fakirMiskinSelects.length || 1; // Prevent division by zero
        const amilinCount = amilinSelects.length || 1; // Prevent division by zero

        // Calculate base amount per KK
        const bagianPerKK = bagianFakirMiskin / fakirMiskinCount;
        const bagianPerAmilin = bagianAmilin / amilinCount;

        // Calculate beras equivalents if applicable
        let berasPerKK = 0;
        let berasPerAmilin = 0;

        if (jenisZakat === 'Zakat Fitrah' && saldoPerJenisZakat[jenisZakat].beras > 0) {
            // Hitung berapa kg beras yang setara dengan bagian uang
            berasPerKK = bagianPerKK / 14000; // Asumsi 1 kg beras = Rp 14.000
            berasPerAmilin = bagianPerAmilin / 14000;
        }
>>>>>>> a4508c7 (zakat)

        // Update display
        document.getElementById('bagianFakirMiskin').textContent = formatRupiah(bagianFakirMiskin);
        document.getElementById('bagianAmilin').textContent = formatRupiah(bagianAmilin);
<<<<<<< HEAD
        document.getElementById('bagianPerKK').textContent = formatRupiah(bagianPerKK);
=======
        document.getElementById('sisaZakat').textContent = formatRupiah(sisaZakat);
        document.getElementById('bagianPerKK').textContent = formatRupiah(bagianPerKK);
        document.getElementById('bagianPerAmilin').textContent = formatRupiah(bagianPerAmilin);
        document.getElementById('berasPerKK').textContent = berasPerKK.toFixed(2) + ' kg';
        document.getElementById('berasPerAmilin').textContent = berasPerAmilin.toFixed(2) + ' kg';
>>>>>>> a4508c7 (zakat)

        // Update jumlah_terima for each recipient
        container.querySelectorAll('.row').forEach(row => {
            const select = row.querySelector('.mustahik-select');
            const jumlahInput = row.querySelector('input[name$="[jumlah_terima]"]');
<<<<<<< HEAD
            const mustahik = mustahikData.find(m => m.no_mustahik === select.value);

            if (mustahik) {
                let jumlah = 0;
                if (mustahik.asnaf === 'Fakir/Miskin') {
                    // Calculate with children
                    const baseAmount = bagianPerKK;
                    const childrenBonus = mustahik.jumlah_anak > 0 ? (baseAmount / mustahik.jumlah_anak) : 0;
                    jumlah = baseAmount + childrenBonus;
                } else if (mustahik.asnaf === 'Amilin' || mustahik.asnaf === 'Amilin Lainnya') {
                    jumlah = bagianAmilin;
                }
                jumlahInput.value = Math.round(jumlah);
=======
            const jenisTerimaSelect = row.querySelector('select[name$="[jenis_terima]"]');
            const jumlahBerasInput = row.querySelector('input[name$="[jumlah_beras]"]');
            const berasContainer = row.querySelector('.beras-container');

            if (select.value) {
                const mustahik = mustahikData.find(m => m.no_mustahik === select.value);

                if (mustahik) {
                    console.log('Processing mustahik:', mustahik.nama_mustahik, 'Asnaf:', mustahik.asnaf);

                    let jumlah = 0;

                    if (mustahik.asnaf === 'Fakir' || mustahik.asnaf === 'Miskin') {
                        // Bagian untuk Fakir/Miskin
                        jumlah = Math.round(bagianPerKK);
                        console.log('Fakir/Miskin amount:', jumlah);
                    } else if (mustahik.asnaf === 'Amilin' || mustahik.asnaf === 'Amilin Lainnya') {
                        // Bagian untuk Amilin
                        jumlah = Math.round(bagianPerAmilin);
                        console.log('Amilin amount:', jumlah);
                    }

                    jumlahInput.value = jumlah;

                    // Show beras option if Zakat Fitrah and has beras
                    if (jenisZakat === 'Zakat Fitrah' && saldoPerJenisZakat[jenisZakat].beras > 0) {
                        jenisTerimaSelect.style.display = 'block';

                        // Update jumlah_beras when jenis_terima changes
                        jenisTerimaSelect.onchange = function() {
                            if (this.value === 'beras') {
                                berasContainer.style.display = 'block';
                                if (mustahik.asnaf === 'Fakir' || mustahik.asnaf === 'Miskin') {
                                    jumlahBerasInput.value = berasPerKK.toFixed(2);
                                } else if (mustahik.asnaf === 'Amilin' || mustahik.asnaf === 'Amilin Lainnya') {
                                    jumlahBerasInput.value = berasPerAmilin.toFixed(2);
                                }
                            } else {
                                berasContainer.style.display = 'none';
                            }
                        };

                        // Trigger change event to set initial state
                        jenisTerimaSelect.dispatchEvent(new Event('change'));
                    } else {
                        jenisTerimaSelect.style.display = 'none';
                        berasContainer.style.display = 'none';
                    }
                } else {
                    console.log('Mustahik not found for:', select.value);
                    jumlahInput.value = '';
                }
            } else {
                jumlahInput.value = '';
>>>>>>> a4508c7 (zakat)
            }
        });
    }

    function formatRupiah(amount) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
<<<<<<< HEAD
            currency: 'IDR'
=======
            currency: 'IDR',
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
>>>>>>> a4508c7 (zakat)
        }).format(amount);
    }

    // Add event listener for total_penyaluran changes
    document.getElementById('total_penyaluran').addEventListener('input', calculateDistribution);

    function updateMustahikOptions() {
        const allSelects = container.querySelectorAll('select[name^="penerimas"][name$="[no_mustahik]"]');

        allSelects.forEach(select => {
            const currentValue = select.value;

            // Store all options
            const options = Array.from(select.options);

            // Hide selected options in all selects except current
            options.forEach(option => {
                if (option.value && option.value !== currentValue) {
                    option.disabled = selectedMustahiks.has(option.value);
                } else {
                    option.disabled = false;
                }
            });
        });
    }

    function addPenerimaRow() {
        const row = document.createElement('div');
        row.className = 'row mb-3';
        row.innerHTML = `
<<<<<<< HEAD
            <div class="col-md-6">
=======
            <div class="col-md-4">
>>>>>>> a4508c7 (zakat)
                <div class="form-group">
                    <label>Mustahik</label>
                    <select class="form-control mustahik-select" name="penerimas[${counter}][no_mustahik]" required>
                        <option value="">Pilih Mustahik</option>
                        @foreach($mustahiks as $mustahik)
                            <option value="{{ $mustahik->no_mustahik }}"
<<<<<<< HEAD
                                    data-asnaf="{{ $mustahik->asnaf }}"
                                    data-jumlah-anak="{{ $mustahik->jumlah_anak }}">
=======
                                    data-asnaf="{{ $mustahik->asnaf }}">
>>>>>>> a4508c7 (zakat)
                                {{ $mustahik->nama_mustahik }} ({{ $mustahik->asnaf }})
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
<<<<<<< HEAD
            <div class="col-md-5">
                <div class="form-group">
                    <label>Jumlah Terima</label>
                    <input type="number" class="form-control" name="penerimas[${counter}][jumlah_terima]" required>
=======
            <div class="col-md-3">
                <div class="form-group">
                    <label>Jumlah Terima</label>
                    <input type="number" class="form-control jumlah-terima" name="penerimas[${counter}][jumlah_terima]" required>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Jenis Penerimaan</label>
                    <select class="form-control" name="penerimas[${counter}][jenis_terima]" style="display: none;">
                        <option value="uang">Uang</option>
                        <option value="beras">Beras</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2 beras-container" style="display: none;">
                <div class="form-group">
                    <label>Jumlah Beras (kg)</label>
                    <input type="number" step="0.01" class="form-control" name="penerimas[${counter}][jumlah_beras]">
>>>>>>> a4508c7 (zakat)
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <label>&nbsp;</label>
                    <button type="button" class="btn btn-danger btn-block hapus-penerima">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        `;

        container.appendChild(row);

        // Add change event listener to new select
        const newSelect = row.querySelector('.mustahik-select');
        newSelect.addEventListener('change', function() {
            const oldValue = this.dataset.previousValue;
            const newValue = this.value;

            // Remove old value from selected set if it exists
            if (oldValue) {
                selectedMustahiks.delete(oldValue);
            }

            // Add new value to selected set if it's not empty
            if (newValue) {
                selectedMustahiks.add(newValue);
<<<<<<< HEAD
=======
                console.log('Selected mustahik:', newValue);

                // Get the mustahik data
                const mustahik = mustahikData.find(m => m.no_mustahik === newValue);
                if (mustahik) {
                    console.log('Mustahik found:', mustahik.nama_mustahik, 'Asnaf:', mustahik.asnaf);
                } else {
                    console.log('Mustahik not found for:', newValue);
                }
>>>>>>> a4508c7 (zakat)
            }

            // Store current value as previous value for next change
            this.dataset.previousValue = newValue;

            updateMustahikOptions();
            calculateDistribution();
        });

        // Add event listener to delete button
        row.querySelector('.hapus-penerima').addEventListener('click', function() {
            const select = this.closest('.row').querySelector('.mustahik-select');
            const value = select.value;
            if (value) {
                selectedMustahiks.delete(value);
            }
            this.closest('.row').remove();
            updateMustahikOptions();
            calculateDistribution();
        });

        counter++;
        updateMustahikOptions();
    }

    // Add first row on page load
    addPenerimaRow();

    // Add row when button is clicked
    document.getElementById('tambah-penerima').addEventListener('click', addPenerimaRow);

    // Form validation
    form.addEventListener('submit', function(e) {
        const rows = container.children.length;
        if (rows === 0) {
            e.preventDefault();
            alert('Minimal harus ada satu Penerima Zakat!');
        }
    });
});
</script>
@endsection
<<<<<<< HEAD

=======
>>>>>>> a4508c7 (zakat)
