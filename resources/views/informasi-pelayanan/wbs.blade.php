@extends('layouts.app')
@section('title', 'WBS - Informasi Pelayanan')
@push('styles')
<style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: 'Poppins', sans-serif; background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%); color: #333; overflow-x: hidden; }
    header { background: linear-gradient(135deg, #0d47a1 0%, #1565c0 50%, #1976d2 100%); padding: 18px 60px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 8px 32px rgba(13,71,161,0.3); position: sticky; top: 0; z-index: 1000; }
    .logo { display: flex; align-items: center; gap: 18px; text-decoration: none; }
    .logo img { width: 60px; height: 60px; filter: drop-shadow(0 4px 12px rgba(255,215,0,0.5)); transition: transform 0.4s; }
    .logo:hover img { transform: rotate(360deg) scale(1.1); }
    .logo h2 { font-size: 24px; font-weight: 800; letter-spacing: 2px; background: linear-gradient(to right, #fff, #ffd700, #fff); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; background-size: 200%; animation: shimmer 3s infinite; }
    @keyframes shimmer { 0%,100%{background-position:0% 50%} 50%{background-position:100% 50%} }
    nav ul { display: flex; list-style: none; gap: 10px; }
    nav ul li a { text-decoration: none; color: #fff; font-weight: 600; font-size: 14px; padding: 10px 20px; border-radius: 30px; transition: all 0.3s; }
    nav ul li a:hover, nav ul li a.active { background: rgba(255,215,0,0.9); color: #0d47a1; }
    .page-hero { background: linear-gradient(135deg, #e65100, #f57c00); padding: 60px; text-align: center; position: relative; overflow: hidden; }
    .page-hero-content { position: relative; z-index: 1; }
    .hero-icon { font-size: 64px; margin-bottom: 16px; display: block; }
    .page-hero h1 { font-size: 46px; font-weight: 800; color: #fff; text-shadow: 3px 3px 12px rgba(0,0,0,0.4); margin-bottom: 10px; }
    .page-hero p { font-size: 17px; color: rgba(255,255,255,0.85); max-width: 560px; margin: 0 auto; }
    .breadcrumb { display: flex; align-items: center; justify-content: center; gap: 8px; margin-top: 18px; font-size: 13px; color: rgba(255,255,255,0.6); }
    .breadcrumb a { color: #ffd700; text-decoration: none; }
    .container { max-width: 960px; margin: 0 auto; padding: 60px 40px 100px; }
    .info-block { background: #fff; border-radius: 20px; box-shadow: 0 8px 30px rgba(0,0,0,0.08); padding: 32px 36px; margin-bottom: 24px; opacity: 0; transform: translateY(30px); transition: all 0.6s ease; }
    .info-block.visible { opacity: 1; transform: translateY(0); }
    .block-title { display: flex; align-items: center; gap: 12px; font-size: 18px; font-weight: 700; color: #e65100; margin-bottom: 20px; padding-bottom: 14px; border-bottom: 2px solid #fff3e0; }
    .block-title-icon { width: 40px; height: 40px; border-radius: 12px; background: linear-gradient(135deg, #e65100, #f57c00); display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0; }
    .req-list { list-style: none; padding: 0; display: flex; flex-direction: column; gap: 12px; }
    .req-list li { display: flex; align-items: flex-start; gap: 12px; font-size: 15px; color: #444; line-height: 1.7; padding: 10px 14px; border-radius: 10px; background: #fff8f0; border: 1px solid #ffe0b2; }
    .req-num { width: 26px; height: 26px; border-radius: 50%; background: linear-gradient(135deg, #e65100, #f57c00); color: #fff; font-size: 12px; font-weight: 700; display: flex; align-items: center; justify-content: center; flex-shrink: 0; margin-top: 1px; }
    /* Shield cards */
    .shield-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; }
    .shield-card { background: linear-gradient(135deg, #e65100, #f57c00); color: #fff; border-radius: 16px; padding: 22px 18px; text-align: center; }
    .shield-icon { font-size: 36px; display: block; margin-bottom: 10px; }
    .shield-card h4 { font-size: 14px; font-weight: 700; margin-bottom: 6px; }
    .shield-card p { font-size: 12px; opacity: 0.9; line-height: 1.6; }
    .steps { display: flex; flex-direction: column; gap: 16px; }
    .step { display: flex; align-items: flex-start; gap: 16px; }
    .step-num { width: 36px; height: 36px; border-radius: 50%; background: linear-gradient(135deg, #e65100, #f57c00); color: #fff; font-size: 16px; font-weight: 800; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .step-content h4 { font-size: 15px; font-weight: 700; color: #e65100; margin-bottom: 4px; }
    .step-content p { font-size: 14px; color: #666; line-height: 1.7; }
    .action-buttons { display: flex; gap: 14px; flex-wrap: wrap; }
    .btn-main { flex: 1; display: inline-flex; align-items: center; justify-content: center; gap: 10px; padding: 15px 24px; border-radius: 50px; background: linear-gradient(135deg, #e65100, #f57c00); color: #fff; font-size: 15px; font-weight: 700; text-decoration: none; box-shadow: 0 8px 24px rgba(230,81,0,0.35); transition: all 0.3s; }
    .btn-main:hover { transform: translateY(-3px); filter: brightness(1.1); }
    .btn-back { display: inline-flex; align-items: center; gap: 8px; padding: 15px 22px; border-radius: 50px; background: #f0f4ff; color: #0d47a1; border: 2px solid #e3f2fd; font-size: 14px; font-weight: 600; text-decoration: none; transition: all 0.3s; }
    .btn-back:hover { background: #e3f2fd; transform: translateY(-3px); }
    footer { background: linear-gradient(135deg, #0d47a1 0%, #1565c0 50%, #1976d2 100%); color: #fff; padding: 60px 60px 35px; }
    .footer-content { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 40px; max-width: 1200px; margin: 0 auto 35px; }
    .footer-section h4 { font-size: 18px; margin-bottom: 18px; color: #ffd700; font-weight: 700; }
    .footer-section p, .footer-section a { color: rgba(255,255,255,0.8); line-height: 2.2; font-size: 14px; text-decoration: none; display: block; transition: all 0.3s; }
    .footer-section a:hover { color: #ffd700; padding-left: 6px; }
    .footer-bottom { text-align: center; padding-top: 28px; border-top: 1px solid rgba(255,255,255,0.2); font-size: 14px; }
    @media (max-width: 768px) { header { padding: 15px 20px; flex-direction: column; gap: 15px; } nav ul { flex-wrap: wrap; justify-content: center; } .container { padding: 40px 20px 70px; } .page-hero { padding: 50px 25px; } .page-hero h1 { font-size: 32px; } .info-block { padding: 24px 20px; } .shield-grid { grid-template-columns: 1fr; } }
</style>
@endpush

@section('content')
<header>
    <a href="{{ route('home') }}" class="logo"><img src="{{ asset('images/new.PNG') }}" alt="Logo Polri"><h2>Tribrata News Gunungkidul</h2></a>
    <nav><ul>
        <li><a href="{{ route('home') }}">Beranda</a></li>
        <li><a href="{{ route('profile') }}">Profil</a></li>
        <li><a href="{{ route('news') }}">Tribratanews</a></li>
        <li><a href="{{ route('information') }}" class="active">Informasi Pelayanan</a></li>
    </ul></nav>
</header>

<div class="page-hero">
    <div class="page-hero-content">
        <span class="hero-icon">🔒</span>
        <h1>Whistle Blowing System</h1>
        <p>Sarana pelaporan pengaduan yang aman, rahasia, dan terpercaya</p>
        <div class="breadcrumb">
            <a href="{{ route('home') }}">🏠 Beranda</a> <span>›</span>
            <a href="{{ route('information') }}">Informasi Pelayanan</a> <span>›</span>
            <span>WBS</span>
        </div>
    </div>
</div>

<div class="container">

    <div class="info-block">
        <div class="block-title"><div class="block-title-icon">📢</div>Apa itu WBS?</div>
        <p style="font-size:15px; line-height:1.9; color:#555;">
            Whistle Blowing System (WBS) adalah sistem pelaporan yang disediakan oleh Polri untuk menerima pengaduan dari masyarakat maupun anggota internal mengenai dugaan pelanggaran, penyimpangan, atau tindak pidana yang dilakukan oleh anggota Polri. Semua laporan ditangani secara profesional, rahasia, dan bebas dari intervensi.
        </p>
    </div>

    <div class="info-block">
        <div class="block-title"><div class="block-title-icon">📋</div>Yang Dapat Dilaporkan</div>
        <ul class="req-list">
            <li><span class="req-num">1</span>Dugaan pelanggaran kode etik profesi Polri</li>
            <li><span class="req-num">2</span>Penyalahgunaan wewenang atau jabatan oleh petugas</li>
            <li><span class="req-num">3</span>Dugaan tindak pidana korupsi, pungli, atau gratifikasi</li>
            <li><span class="req-num">4</span>Pelayanan yang tidak profesional, diskriminatif, atau sewenang-wenang</li>
            <li><span class="req-num">5</span>Pemerasan atau intimidasi oleh oknum anggota Polri</li>
            <li><span class="req-num">6</span>Pelanggaran HAM dalam pelaksanaan tugas kepolisian</li>
        </ul>
    </div>

    <div class="info-block">
        <div class="block-title"><div class="block-title-icon">🛡️</div>Jaminan Perlindungan Pelapor</div>
        <div class="shield-grid">
            <div class="shield-card"><span class="shield-icon">🔐</span><h4>Identitas Rahasia</h4><p>Nama dan data pelapor dijamin kerahasiaannya sepenuhnya</p></div>
            <div class="shield-card"><span class="shield-icon">⚖️</span><h4>Perlindungan Hukum</h4><p>Pelapor dilindungi dari tindakan balasan atau ancaman</p></div>
            <div class="shield-card"><span class="shield-icon">🏛️</span><h4>Ditangani Profesional</h4><p>Laporan diproses secara objektif oleh tim khusus</p></div>
        </div>
    </div>

    <div class="info-block">
        <div class="block-title"><div class="block-title-icon">📝</div>Cara Melapor</div>
        <div class="steps">
            <div class="step"><div class="step-num">1</div><div class="step-content"><h4>Buka Portal WBS</h4><p>Kunjungi <strong>wbs.polri.go.id</strong> melalui browser atau klik tombol di bawah.</p></div></div>
            <div class="step"><div class="step-num">2</div><div class="step-content"><h4>Pilih Jenis Laporan</h4><p>Pilih kategori pelanggaran yang sesuai dengan dugaan yang ingin dilaporkan.</p></div></div>
            <div class="step"><div class="step-num">3</div><div class="step-content"><h4>Isi Formulir Laporan</h4><p>Ceritakan kronologi kejadian secara jelas dan lengkap. Sertakan bukti pendukung jika ada (foto, video, dokumen).</p></div></div>
            <div class="step"><div class="step-num">4</div><div class="step-content"><h4>Simpan Nomor Tiket</h4><p>Setelah laporan terkirim, simpan nomor tiket untuk memantau perkembangan laporan.</p></div></div>
            <div class="step"><div class="step-num">5</div><div class="step-content"><h4>Pantau Tindak Lanjut</h4><p>Gunakan nomor tiket untuk memantau status penanganan laporan secara berkala.</p></div></div>
        </div>
    </div>

    <div class="info-block">
        <div class="block-title"><div class="block-title-icon">🔗</div>Akses Layanan</div>
        <div class="action-buttons">
            <a href="https://wbs.polri.go.id" target="_blank" class="btn-main">🔒 Buka Portal WBS Polri</a>
            <a href="{{ route('information') }}" class="btn-back">← Kembali ke Layanan</a>
        </div>
    </div>

</div>

<footer>
    <div class="footer-content">
        <div class="footer-section"><h4>Kontak Kami</h4><p>📧 {{ $contact['email'] }}<br>📞 {{ $contact['phone'] }}<br>🚨 {{ $contact['hotline'] }}<br>💬 {{ $contact['whatsapp'] }}</p></div>
        <div class="footer-section"><h4>Alamat</h4><p>{{ $contact['address'] }}<br>{{ $contact['city'] }}<br>{{ $contact['country'] }}<br>🕐 {{ $contact['hours'] }}</p></div>
        <div class="footer-section"><h4>Tentang Kami</h4>@foreach($aboutLinks as $link)<a href="{{ $link['url'] }}">{{ $link['name'] }}</a>@endforeach</div>
    </div>
    <div class="footer-bottom"><p>© {{ date('Y') }} Tribrata News Gunungkidul - Kepolres Gunungkidul | Melayani Dengan Hati ❤️</p></div>
</footer>
@endsection
@push('scripts')
<script>
    const obs = new IntersectionObserver(entries => { entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); }); }, { threshold: 0.1 });
    document.querySelectorAll('.info-block').forEach((b, i) => { b.style.transitionDelay = (i * 0.1) + 's'; obs.observe(b); });
</script>
@endpush