@extends('layouts.app')

@section('title', 'Informasi Pelayanan - TB News Gunungkidul')

@push('styles')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
        color: #333;
    }

    /* ===== HEADER ===== */
    header {
        background: linear-gradient(135deg, #0d47a1 0%, #1565c0 50%, #1976d2 100%);
        padding: 18px 60px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 8px 32px rgba(13, 71, 161, 0.3);
        position: sticky;
        top: 0;
        z-index: 1000;
    }

    .logo {
        display: flex;
        align-items: center;
        gap: 18px;
        cursor: pointer;
    }

    .logo img {
        width: 75px;
        height: 75px;
        filter: drop-shadow(0 5px 15px rgba(255, 215, 0, 0.6));
    }

    .logo h2 {
        font-size: 32px;
        font-weight: 800;
        letter-spacing: 3px;
        color: #fff;
        text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.4);
    }

    nav ul {
        display: flex;
        list-style: none;
        gap: 10px;
    }

    nav ul li a {
        text-decoration: none;
        color: #fff;
        font-weight: 600;
        font-size: 15px;
        padding: 12px 24px;
        border-radius: 30px;
        transition: all 0.4s ease;
    }

    nav ul li a:hover,
    nav ul li a.active {
        background: rgba(255, 215, 0, 0.9);
        color: #0d47a1;
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(255, 215, 0, 0.4);
    }

    /* ===== PAGE HEADER ===== */
    .page-header {
        background: linear-gradient(135deg, #0d47a1 0%, #1976d2 100%);
        padding: 80px 60px;
        text-align: center;
        color: #fff;
        position: relative;
        overflow: hidden;
    }

    .page-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="40" fill="rgba(255,255,255,0.05)"/></svg>');
        opacity: 0.3;
    }

    .page-header h1 {
        font-size: 56px;
        font-weight: 800;
        margin-bottom: 15px;
        position: relative;
        z-index: 1;
        text-shadow: 3px 3px 10px rgba(0, 0, 0, 0.3);
    }

    .page-header p {
        font-size: 20px;
        position: relative;
        z-index: 1;
        opacity: 0.95;
    }

    /* ===== CONTAINER ===== */
    .container {
        max-width: 1300px;
        margin: -50px auto 0;
        padding: 0 40px 80px;
        position: relative;
        z-index: 10;
    }

    /* ===== SERVICES GRID ===== */
    .services-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 35px;
        margin-top: 40px;
    }

    .service-card {
        background: #fff;
        border-radius: 25px;
        overflow: hidden;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
        transition: all 0.4s ease;
        cursor: pointer;
        position: relative;
    }

    .service-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 6px;
        background: linear-gradient(90deg, #0d47a1, #ffd700);
    }

    .service-card:hover {
        transform: translateY(-15px);
        box-shadow: 0 25px 60px rgba(0, 0, 0, 0.2);
    }

    .service-icon {
        background: linear-gradient(135deg, #1976d2, #42a5f5);
        padding: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 90px;
        position: relative;
        overflow: hidden;
    }

    .service-icon::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.2), transparent);
        animation: rotate 10s linear infinite;
    }

    @keyframes rotate {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .service-content {
        padding: 35px;
    }

    .service-content h3 {
        font-size: 26px;
        color: #0d47a1;
        margin-bottom: 15px;
        font-weight: 700;
    }

    .service-content p {
        font-size: 16px;
        line-height: 1.8;
        color: #666;
        margin-bottom: 25px;
    }

    .service-features {
        list-style: none;
        margin-bottom: 25px;
    }

    .service-features li {
        padding: 10px 0;
        color: #555;
        font-size: 15px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .service-features li::before {
        content: '✓';
        color: #1976d2;
        font-weight: 800;
        font-size: 18px;
        background: rgba(25, 118, 210, 0.1);
        width: 28px;
        height: 28px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .service-button {
        display: inline-block;
        padding: 14px 35px;
        background: linear-gradient(135deg, #ffd700, #ffed4e);
        color: #0d47a1;
        font-weight: 700;
        font-size: 16px;
        border-radius: 50px;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 8px 20px rgba(255, 215, 0, 0.3);
    }

    .service-button:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(255, 215, 0, 0.5);
        background: linear-gradient(135deg, #ffed4e, #ffd700);
    }

    /* ===== INFO SECTION ===== */
    .info-section {
        background: #fff;
        border-radius: 25px;
        padding: 50px;
        margin-top: 50px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
    }

    .info-section h2 {
        font-size: 36px;
        color: #0d47a1;
        margin-bottom: 25px;
        font-weight: 700;
        position: relative;
        display: inline-block;
    }

    .info-section h2::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 0;
        width: 80px;
        height: 4px;
        background: linear-gradient(90deg, #0d47a1, #ffd700);
        border-radius: 2px;
    }

    .info-section p {
        font-size: 17px;
        line-height: 1.9;
        color: #555;
        margin-bottom: 20px;
    }

    .contact-info {
        background: linear-gradient(135deg, #e3f2fd, #bbdefb);
        padding: 30px;
        border-radius: 15px;
        margin-top: 30px;
    }

    .contact-info h3 {
        font-size: 24px;
        color: #0d47a1;
        margin-bottom: 20px;
        font-weight: 700;
    }

    .contact-info p {
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 16px;
    }

    .contact-info p strong {
        color: #0d47a1;
        min-width: 100px;
    }

    /* ===== FOOTER ===== */
    footer {
        background: linear-gradient(135deg, #0d47a1 0%, #1565c0 50%, #1976d2 100%);
        color: #fff;
        padding: 70px 60px 40px;
        margin-top: 80px;
    }

    .footer-content {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 50px;
        max-width: 1300px;
        margin: 0 auto 40px;
    }

    .footer-section h4 {
        font-size: 22px;
        margin-bottom: 25px;
        color: #ffd700;
        font-weight: 700;
    }

    .footer-section p,
    .footer-section a {
        color: rgba(255, 255, 255, 0.85);
        line-height: 2.2;
        font-size: 15px;
        text-decoration: none;
        display: block;
        transition: all 0.3s ease;
    }

    .footer-section a:hover {
        color: #ffd700;
        padding-left: 8px;
    }

    .footer-bottom {
        text-align: center;
        padding-top: 35px;
        border-top: 2px solid rgba(255, 255, 255, 0.2);
        font-size: 15px;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 992px) {
        header {
            padding: 15px 30px;
            flex-direction: column;
            gap: 20px;
        }

        nav ul {
            flex-wrap: wrap;
            justify-content: center;
        }

        .page-header {
            padding: 60px 30px;
        }

        .page-header h1 {
            font-size: 40px;
        }

        .container {
            padding: 0 25px 60px;
        }

        .services-grid {
            grid-template-columns: 1fr;
        }

        .info-section {
            padding: 35px 25px;
        }
    }

    @media (max-width: 600px) {
        .logo h2 {
            font-size: 24px;
        }

        .page-header h1 {
            font-size: 32px;
        }

        .page-header p {
            font-size: 16px;
        }
    }

    /* ===== ANIMATION ===== */
    .animate-on-scroll {
        opacity: 0;
        transform: translateY(50px);
        transition: all 0.8s ease;
    }

    .animate-on-scroll.visible {
        opacity: 1;
        transform: translateY(0);
    }
</style>
@endpush

@section('content')
<!-- ===== HEADER ===== -->
<header>
    <div class="logo">
        <img src="{{ asset('images/new.PNG') }}" alt="Logo Polri">
        <h2>Tribun News Gunungkidul</h2>
    </div>
    <nav>
        <ul>
            <li><a href="{{ route('home') }}">Beranda</a></li>
            <li><a href="{{ route('profile') }}">Profil</a></li>
            <li><a href="{{ route('news') }}">Tribratanews</a></li>
            <li><a href="{{ route('information') }}" class="active">Informasi Pelayanan</a></li>
        </ul>
    </nav>
</header>

<!-- ===== PAGE HEADER ===== -->
<div class="page-header">
    <h1>Informasi Pelayanan</h1>
    <p>Layanan Kepolisian untuk Kemudahan Masyarakat</p>
</div>

<!-- ===== MAIN CONTENT ===== -->
<div class="container">

    <!-- SERVICES GRID -->
    <div class="services-grid animate-on-scroll">
        
        <!-- SKCK ONLINE -->
        <div class="service-card">
            <div class="service-icon">📄</div>
            <div class="service-content">
                <h3>SKCK Online</h3>
                <p>Layanan pembuatan Surat Keterangan Catatan Kepolisian secara online tanpa perlu antri.</p>
                
                <ul class="service-features">
                    <li>Proses cepat dan mudah</li>
                    <li>Tanpa antrian panjang</li>
                    <li>Bisa diakses 24/7</li>
                    <li>Hasil dapat diambil di kantor</li>
                </ul>

                <a href="{{ route('services.skck') }}" class="service-button">Buat SKCK →</a>
            </div>
        </div>

        <!-- SIM ONLINE -->
        <div class="service-card">
            <div class="service-icon">🆔</div>
            <div class="service-content">
                <h3>SIM Online</h3>
                <p>Perpanjang atau buat SIM baru secara online dengan mudah dan praktis.</p>
                
                <ul class="service-features">
                    <li>Perpanjangan SIM A, B, C</li>
                    <li>Pembuatan SIM baru</li>
                    <li>Jadwal tes online</li>
                    <li>Tracking status permohonan</li>
                </ul>

                <a href="{{ route('services.sim') }}" class="service-button">Kelola SIM →</a>
            </div>
        </div>

        <!-- PENERIMAAN POLRI -->
        <div class="service-card">
            <div class="service-icon">👮</div>
            <div class="service-content">
                <h3>Penerimaan Polri</h3>
                <p>Informasi lengkap tentang pendaftaran dan seleksi penerimaan anggota Polri.</p>
                
                <ul class="service-features">
                    <li>Pendaftaran Akpol</li>
                    <li>Pendaftaran Bintara</li>
                    <li>Pendaftaran Tamtama</li>
                    <li>Info jadwal & persyaratan</li>
                </ul>

                <a href="{{ route('services.recruitment') }}" class="service-button">Info Lengkap →</a>
            </div>
        </div>

        <!-- WBS (WHISTLEBLOWING SYSTEM) -->
        <div class="service-card">
            <div class="service-icon">🚨</div>
            <div class="service-content">
                <h3>WBS - Pengaduan</h3>
                <p>Whistleblowing System untuk pelaporan pelanggaran atau pengaduan masyarakat.</p>
                
                <ul class="service-features">
                    <li>Laporan dijamin kerahasiaannya</li>
                    <li>Tersedia fitur anonim</li>
                    <li>Tracking status laporan</li>
                    <li>Respon cepat dari pihak berwajib</li>
                </ul>

                <a href="{{ route('services.wbs') }}" class="service-button">Buat Laporan →</a>
            </div>
        </div>

    </div>

    <!-- INFO SECTION -->
    <div class="info-section animate-on-scroll">
        <h2>Tentang Layanan Kami</h2>
        <p>
            Kepolisian Gunungkidul berkomitmen untuk memberikan pelayanan terbaik kepada masyarakat 
            melalui sistem digital yang modern dan terintegrasi. Semua layanan dirancang untuk 
            memudahkan masyarakat dalam mengurus keperluan administrasi kepolisian.
        </p>
        <p>
            Kami terus berinovasi dan meningkatkan kualitas layanan untuk mewujudkan pelayanan 
            publik yang profesional, transparan, dan akuntabel. Kepuasan masyarakat adalah 
            prioritas utama kami.
        </p>

        <div class="contact-info">
            <h3>Butuh Bantuan?</h3>
            <p><strong>📞 Telp:</strong> 0812-3456-7890</p>
            <p><strong>📧 Email:</strong> layanan@polres-gunungkidul.id</p>
            <p><strong>🚨 Hotline:</strong> 110 (Emergency)</p>
            <p><strong>💬 WhatsApp:</strong> 0812-3456-7890</p>
            <p><strong>🕐 Jam Layanan:</strong> Senin - Jumat: 08.00 - 16.00 WIB</p>
        </div>
    </div>

</div>

<!-- ===== FOOTER ===== -->
<footer>
    <div class="footer-content">
        <div class="footer-section">
            <h4>Kontak Kami</h4>
            <p>
                📧 Email: info@tbnews.com<br>
                📞 Telp: 0812-3456-7890<br>
                🚨 Hotline: 110 (Darurat)<br>
                💬 WhatsApp: 0812-3456-7890
            </p>
        </div>

        <div class="footer-section">
            <h4>Alamat Kantor</h4>
            <p>
                Jl. Kepolisian No. 123<br>
                Gunungkidul, Yogyakarta<br>
                Indonesia 55800<br>
                🕐 Senin - Jumat: 08.00 - 17.00 WIB
            </p>
        </div>

        <div class="footer-section">
            <h4>Layanan</h4>
            <a href="{{ route('services.skck') }}">📄 SKCK Online</a>
            <a href="{{ route('services.sim') }}">🆔 SIM Online</a>
            <a href="{{ route('services.recruitment') }}">👮 Penerimaan Polri</a>
            <a href="{{ route('services.wbs') }}">🚨 WBS - Pengaduan</a>
        </div>

        <div class="footer-section">
            <h4>Tentang Kami</h4>
            <a href="{{ route('profile') }}">Profil Lembaga</a>
            <a href="#">Struktur Organisasi</a>
            <a href="#">Kebijakan Privasi</a>
            <a href="#">Syarat & Ketentuan</a>
        </div>
    </div>

    <div class="footer-bottom">
        <p>© {{ date('Y') }} TB News Gunungkidul - Kepolisian Republik Indonesia | Melayani Dengan Hati ❤️</p>
    </div>
</footer>
@endsection

@push('scripts')
<script>
    // Scroll Animation
    const observerOptions = {
        threshold: 0.15,
        rootMargin: '0px 0px -100px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, observerOptions);

    document.querySelectorAll('.animate-on-scroll').forEach(element => {
        observer.observe(element);
    });
</script>
@endpush