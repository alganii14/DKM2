@if(isset($success))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ $success }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- Hero Section -->
<section id="home" class="slider-home-1 owl-carousel owl-theme">
    <div class="hero-section item">
        <img src="{{asset('masjid')}}/main_files/assets/img/masjid5.jpg" alt="hero-img" class="hero-img-style">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="hero-text">
                        <h1>Selamat Datang di Masjid Khairul Amal</h1>
                        <a href="#prayer-times" class="btn">Lihat Jadwal Sholat</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="hero-section item">
        <img src="{{asset('masjid')}}/main_files/assets/img/masjid6.jpg" alt="hero-img" class="hero-img-style">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="hero-text">
                        <h1>Jadwal Kajian Rutin</h1>
                        <p>Ikuti kajian rutin bersama ustadz-ustadz terpercaya untuk meningkatkan pemahaman Islam</p>
                        <a href="#kajian" class="btn">Lihat Jadwal Kajian</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="hero-section item">
        <img src="{{asset('masjid')}}/main_files/assets/img/masjid7.jpg" alt="hero-img" class="hero-img-style">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="hero-text">
                        <h1>Mari Berinfaq</h1>
                        <p>Salurkan infaq dan sedekah Anda untuk pembangunan dan operasional masjid</p>
                        <a href="#infaq" class="btn">Infaq Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Prayer Times Section -->
<section id="prayer-times" class="gap no-top">
    <div class="container">
        <div class="namaz-timing">
            @foreach ($sholats as $sholat)
            <div class="namaz-time">
                <img src="{{ asset('masjid/main_files/assets/img/namaz-time-icon-' . $loop->iteration . '.png') }}" alt="icon">
                <h4>{{ $sholat->nama_sholat }}</h4>
                <h5>{{ \Carbon\Carbon::parse($sholat->waktu_sholat)->format('h:i A') }}
                    <span>Iqamah:{{ \Carbon\Carbon::parse($sholat->waktu_iqomah)->format('h:i A') }}</span>
                </h5>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Inventory Section -->
<section id="inventory" class="gap no-top">
    <div class="container">
        <div class="text-center heading">
            <img src="{{ asset('masjid/main_files/assets/img/heading-img.png') }}" alt="icon" class="mb-3 img-fluid" style="max-width: 100px;">
            <p class="text-uppercase text-muted">Informasi Inventory</p>
            <h2 class="fw-bold">Daftar Inventory</h2>
        </div>

        <div class="row">
            @foreach ($inventories as $inventory)
                <div class="mb-4 col-lg-4 col-md-6">
                    <div class="p-3 bg-white rounded shadow-sm blog hoverimg">
                        <h4 class="text-primary">{{ $inventory->kategori }}</h4>
                        <figure class="mb-3">
                            @if($inventory->gambar)
                                <img src="{{ asset('storage/' . $inventory->gambar) }}" alt="{{ $inventory->nama }}" class="rounded img-fluid" style="max-height: 260px; object-fit: cover;">
                            @else
                                <img src="https://via.placeholder.com/300" alt="No Image" class="rounded img-fluid" style="max-height: 260px; object-fit: cover;">
                            @endif
                        </figure>
                        <h5 class="fw-bold"><a href="#" class="text-dark">{{ $inventory->nama }}</a></h5>
                        <p class="text-muted">Kondisi: {{ $inventory->kondisi }}</p>
                        <div class="blog-man d-flex align-items-center">
                            <i class="me-3 fa-solid fa-cogs fa-2x text-emerald-600"></i>
                            <h6 class="mb-0">Kode: <span class="text-primary">{{ $inventory->kode }}</span></h6>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>


<!-- Add this CSS in your styles -->
<style>
    .inventory-slider {
        display: flex;
        overflow-x: auto; /* Allow horizontal scrolling */
        scroll-snap-type: x mandatory; /* Smooth scrolling */
    }

    .inventory-item {
        scroll-snap-align: start;
    }

    .inventory-slider::-webkit-scrollbar {
        height: 8px;
    }

    .inventory-slider::-webkit-scrollbar-thumb {
        background: #ccc;
        border-radius: 4px;
    }

    .inventory-slider::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    /* Styles for infaq balance card */
    .infaq-balance-card {
        background: linear-gradient(135deg, #4CAF50, #2E7D32);
        color: white;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 30px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .infaq-balance-card h3 {
        font-size: 1.5rem;
        margin-bottom: 10px;
        font-weight: 600;
    }

    .infaq-balance-card .amount {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .infaq-balance-card .description {
        font-size: 1rem;
        opacity: 0.9;
    }
</style>




<!-- Kajian Section -->
<section id="kajian" class="gap no-top">
    <div class="container">
        <div class="text-center heading">
            <img src="{{ asset('masjid/main_files/assets/img/heading-img.png') }}" alt="icon" class="mb-3 img-fluid" style="max-width: 100px;">
            <p class="text-uppercase text-muted">Informasi Kegiatan</p>
            <h2 class="fw-bold">Kegiatan</h2>
        </div>

        <div class="row">
            @foreach ($kajians as $kajian)
                <div class="mb-4 col-lg-4 col-md-6">
                    <div class="p-3 bg-white rounded shadow-sm blog hoverimg">
                        <h4 class="text-primary">{{ date('d', strtotime($kajian->tanggal_kajian)) }}<span class="d-block text-muted">{{ date('M, Y', strtotime($kajian->tanggal_kajian)) }}</span></h4>
                        <figure class="mb-3">
                            <img src="{{ asset('storage/' . $kajian->foto_kajian) }}" alt="img" class="rounded img-fluid" style="max-height: 260px; object-fit: cover;">
                        </figure>
                        <h5 class="fw-bold"><a href="#" class="text-dark">{{ $kajian->judul_kajian }}</a></h5>
                        <p class="text-muted">{{ Str::limit($kajian->deskripsi_kajian, 150) }}</p>
                        {{-- <div class="blog-man d-flex align-items-center">
                            <img alt="img" class="me-3 rounded-circle" src="{{ asset('storage/' . $kajian->foto_ustad) }}" style="width: 60px; height: 60px; object-fit: cover;">
                            <h6 class="mb-0"><a href="#" class="text-primary">{{ $kajian->nama_ustad }}</a></h6>
                        </div> --}}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Zakat Calculator Section -->
<section id="zakat" class="py-5 gap no-top bg-light">
    <div class="container">
        <div class="text-center heading">
            <img src="{{ asset('masjid/main_files/assets/img/heading-img.png') }}" alt="icon" class="mb-3 img-fluid" style="max-width: 100px;">
            <p class="text-uppercase text-muted">Kalkulator Zakat</p>
            <h2 class="fw-bold">Hitung Zakat Anda</h2>
        </div>
        <div class="text-center zakat-calculator">
            <button class="m-2 btn btn-primary" onclick="showCalculator('mal')">Zakat Mal</button>
            <button class="m-2 btn btn-secondary" onclick="showCalculator('fidyah')">Zakat Fidyah</button>
            <div id="zakatMalCalculator" class="p-4 mt-4 bg-white rounded shadow-sm" style="display:none;">
                <h3 class="fw-bold text-primary">Kalkulator Zakat Mal</h3>
                <label class="fw-bold">Jumlah Harta (Rp):</label>
                <input type="text" id="hartaMal" class="mb-3 form-control" oninput="formatInputRupiah(this); calculateMal()">
                <p class="text-muted">Nisab Per Tahun: <strong>Rp 85.685.972</strong></p>
                <p class="text-muted">Nisab Per Bulan: <strong>Rp 7.140.498</strong></p>
                <p class="fw-bold">Zakat yang Harus Dibayar: Rp <span id="resultMal" class="text-primary">0</span></p>
            </div>
            <div id="zakatFidyahCalculator" class="p-4 mt-4 bg-white rounded shadow-sm" style="display:none;">
                <h3 class="fw-bold text-secondary">Kalkulator Zakat Fidyah</h3>
                <label class="fw-bold">Jumlah Hari Tidak Puasa:</label>
                <input type="number" id="hariFidyah" class="mb-3 form-control" oninput="calculateFidyah()">
                <p class="text-muted">Besaran Fidyah Per Hari: <strong>Rp 15.000</strong></p>
                <p class="fw-bold">Total Zakat Fidyah: Rp <span id="resultFidyah" class="text-secondary">0</span></p>
            </div>
        </div>
    </div>
</section>

<!-- Infaq Section -->
<section id="infaq" class="gap">
    <div class="container">
        <div class="text-center heading">
            <img src="{{ asset('masjid/main_files/assets/img/heading-img.png') }}" alt="icon" class="mb-3 img-fluid" style="max-width: 100px;">
            <p class="text-uppercase text-muted">Infaq & Sedekah</p>
            <h2 class="fw-bold">Salurkan Infaq Anda</h2>
        </div>
        <!-- Total Infaq Balance Card -->
        <div class="infaq-balance-card">
            <h3>Total Saldo Infaq & Sedekah Terkumpul</h3>
            <div class="amount">Rp {{ number_format($totalInfaq, 0, ',', '.') }}</div>
            <p class="description">Dana ini digunakan untuk pembangunan dan operasional masjid. Terima kasih atas kontribusi Anda.</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <div class="mb-4 qris-container">
                    <img src="{{ asset('masjid/main_files/assets/img/qris-code.png') }}" alt="QRIS Code" class="mb-3 img-fluid" style="max-width: 300px;">
                    <h4 class="mb-2">Scan QRIS untuk Berinfaq</h4>
                    <p class="text-muted">Semua pembayaran digital diterima (GoPay, OVO, DANA, dll)</p>
                </div>
                <div class="p-4 rounded bank-details bg-light">
                    <h5 class="mb-3">Rekening Bank</h5>
                    <div class="mb-2">
                        <p class="mb-1">Bank Syariah Indonesia (BSI)</p>
                        <p class="mb-1 fw-bold">1234567890</p>
                        <p class="text-muted">a.n. Yayasan Masjid Khairul Amal</p>
                    </div>
                </div>
            </div>

            {{-- <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Form Infaq</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('frontend.storeInfaq') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="no_penerimaan">No. Penerimaan</label>
                                <input type="text" class="form-control" id="no_penerimaan" name="no_penerimaan" value="{{ old('no_penerimaan', $no_penerimaan ?? '') }}" readonly>
                            </div>
                            <div class="form-group mb-3">
                                <label for="tanggal">Tanggal</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ old('tanggal') }}" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="waktu">Waktu</label>
                                <input type="time" class="form-control" id="waktu" name="waktu" value="{{ old('waktu') }}" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="donatur_id">Donatur</label>
                                <select class="form-control" id="donatur_id" name="donatur_id" required>
                                    <option value="" disabled selected>- Pilih Donatur -</option>
                                    @foreach ($donaturs as $donatur)
                                        <option value="{{ $donatur->id }}"
                                                data-telp="{{ $donatur->no_telepon }}"
                                                data-pekerjaan="{{ $donatur->pekerjaan }}"
                                                data-alamat="{{ $donatur->alamat }}">
                                                {{ $donatur->no_donatur }} - {{ $donatur->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="jenis_penerimaan">Jenis Penerimaan</label>
                                <select class="form-control" id="jenis_penerimaan" name="jenis_penerimaan" required>
                                    <option value="" disabled selected>- Pilih Jenis Penerimaan -</option>
                                    <option value="Transfer" {{ old('jenis_penerimaan') == 'Transfer' ? 'selected' : '' }}>Transfer</option>
                                    <option value="QRIS" {{ old('jenis_penerimaan') == 'QRIS' ? 'selected' : '' }}>QRIS</option>
                                    <option value="Kotak Amal" {{ old('jenis_penerimaan') == 'Kotak Amal' ? 'selected' : '' }}>Kotak Amal</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="jumlah">Jumlah (Rp)</label>
                                <input type="number" class="form-control" id="jumlah" name="jumlah" value="{{ old('jumlah') }}" required>
                            </div>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </form>
                    </div>
                </div>

            </div> --}}
        </div>
    </div>
</section>



<!-- Zakat Calculator Script -->
<script>
    function showCalculator(type) {
        document.getElementById('zakatMalCalculator').style.display = (type === 'mal') ? 'block' : 'none';
        document.getElementById('zakatFidyahCalculator').style.display = (type === 'fidyah') ? 'block' : 'none';
    }

    function calculateMal() {
        let harta = document.getElementById('hartaMal').value.replace(/\./g, '');
        let nisab = 85685972;
        let zakat = (harta >= nisab) ? harta * 0.025 : 0;
        document.getElementById('resultMal').innerText = formatRupiah(zakat);
    }

    function calculateFidyah() {
        let hari = document.getElementById('hariFidyah').value;
        let fidyahPerHari = 15000;
        let totalFidyah = hari * fidyahPerHari;
        document.getElementById('resultFidyah').innerText = formatRupiah(totalFidyah);
    }

    function formatRupiah(angka) {
        return new Intl.NumberFormat('id-ID').format(angka);
    }

    function formatInputRupiah(input) {
        let value = input.value.replace(/[^0-9]/g, '');
        input.value = new Intl.NumberFormat('id-ID').format(value);
    }
</script>
<script>
    // Set Tanggal otomatis ke hari ini
    document.addEventListener('DOMContentLoaded', function() {
        if(document.getElementById('tanggal')) {
            document.getElementById('tanggal').value = new Date().toISOString().split('T')[0];
        }

        // Set Waktu otomatis ke saat ini dalam format yang benar (HH:mm)
        if(document.getElementById('waktu')) {
            let currentTime = new Date().toTimeString().split(' ')[0].substring(0, 5);
            document.getElementById('waktu').value = currentTime;
        }

        if(document.getElementById('donatur_id')) {
            document.getElementById('donatur_id').addEventListener('change', function() {
                // Ambil data dari pilihan donatur
                const selectedOption = this.options[this.selectedIndex];
                const telp = selectedOption.getAttribute('data-telp');
                const pekerjaan = selectedOption.getAttribute('data-pekerjaan');
                const alamat = selectedOption.getAttribute('data-alamat');

                // Masukkan data ke input form
                // Note: These fields are not in the form, so you might want to add them or remove this part
                // document.getElementById('no_telp').value = telp;
                // document.getElementById('pekerjaan').value = pekerjaan;
                // document.getElementById('alamat').value = alamat;
            });
        }
    });
</script>

