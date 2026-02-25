@extends('layouts.app')
@section('title', 'Penerimaan Polri - Informasi Pelayanan')
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
    .page-hero { background: linear-gradient(135deg, #b71c1c, #e53935); padding: 60px; text-align: center; position: relative; overflow: hidden; }
    .page-hero-content { position: relative; z-index: 1; }
    .hero-icon { font-size: 64px; margin-bottom: 16px; display: block; }
    .page-hero h1 { font-size: 46px; font-weight: 800; color: #fff; text-shadow: 3px 3px 12px rgba(0,0,0,0.4); margin-bottom: 10px; }
    .page-hero p { font-size: 17px; color: rgba(255,255,255,0.85); max-width: 560px; margin: 0 auto; }
    .breadcrumb { display: flex; align-items: center; justify-content: center; gap: 8px; margin-top: 18px; font-size: 13px; color: rgba(255,255,255,0.6); }
    .breadcrumb a { color: #ffd700; text-decoration: none; }
    .container { max-width: 960px; margin: 0 auto; padding: 60px 40px 100px; }
    .info-block { background: #fff; border-radius: 20px; box-shadow: 0 8px 30px rgba(0,0,0,0.08); padding: 32px 36px; margin-bottom: 24px; opacity: 0; transform: translateY(30px); transition: all 0.6s ease; }
    .info-block.visible { opacity: 1; transform: translateY(0); }
    .block-title { display: flex; align-items: center; gap: 12px; font-size: 18px; font-weight: 700; color: #b71c1c; margin-bottom: 20px; padding-bottom: 14px; border-bottom: 2px solid #ffebee; }
    .block-title-icon { width: 40px; height: 40px; border-radius: 12px; background: linear-gradient(135deg, #b71c1c, #e53935); display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0; }
    /* Jalur kartu */
    .jalur-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px; }
    .jalur-card { background: linear-gradient(135deg, #b71c1c, #e53935); color: #fff; border-radius: 16px; padding: 20px; }
    .jalur-card h3 { font-size: 18px; font-weight: 800; margin-bottom: 6px; }
    .jalur-card p { font-size: 13px; opacity: 0.9; line-height: 1.6; }
    .jalur-card .jalur-edu { display: inline-block; background: rgba(255,255,255,0.2); font-size: 11px; padding: 3px 10px; border-radius: 20px; margin-top: 8px; font-weight: 600; }
    .req-list { list-style: none; padding: 0; display: flex; flex-direction: column; gap: 12px; }
    .req-list li { display: flex; align-items: flex-start; gap: 12px; font-size: 15px; color: #444; line-height: 1.7; padding: 10px 14px; border-radius: 10px; background: #fff5f5; border: 1px solid #ffcdd2; }
    .req-num { width: 26px; height: 26px; border-radius: 50%; background: linear-gradient(135deg, #b71c1c, #e53935); color: #fff; font-size: 12px; font-weight: 700; display: flex; align-items: center; justify-content: center; flex-shrink: 0; margin-top: 1px; }
    .warning-box { background: linear-gradient(135deg, #fff8e1, #fff3cd); border: 1px solid #ffd54f; border-left: 5px solid #f44336; border-radius: 14px; padding: 18px 22px; display: flex; align-items: flex-start; gap: 14px; }
    .warning-icon { font-size: 28px; flex-shrink: 0; }
    .warning-text strong { display: block; font-size: 16px; color: #c62828; margin-bottom: 6px; }
    .warning-text p { font-size: 14px; color: #666; line-height: 1.7; }
    .steps { display: flex; flex-direction: column; gap: 16px; }
    .step { display: flex; align-items: flex-start; gap: 16px; }
    .step-num { width: 36px; height: 36px; border-radius: 50%; background: linear-gradient(135deg, #b71c1c, #e53935); color: #fff; font-size: 16px; font-weight: 800; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .step-content h4 { font-size: 15px; font-weight: 700; color: #b71c1c; margin-bottom: 4px; }
    .step-content p { font-size: 14px; color: #666; line-height: 1.7; }
    .action-buttons { display: flex; gap: 14px; flex-wrap: wrap; }
    .btn-main { flex: 1; display: inline-flex; align-items: center; justify-content: center; gap: 10px; padding: 15px 24px; border-radius: 50px; background: linear-gradient(135deg, #b71c1c, #e53935); color: #fff; font-size: 15px; font-weight: 700; text-decoration: none; box-shadow: 0 8px 24px rgba(183,28,28,0.35); transition: all 0.3s; }
    .btn-main:hover { transform: translateY(-3px); filter: brightness(1.1); }
    .btn-back { display: inline-flex; align-items: center; gap: 8px; padding: 15px 22px; border-radius: 50px; background: #f0f4ff; color: #0d47a1; border: 2px solid #e3f2fd; font-size: 14px; font-weight: 600; text-decoration: none; transition: all 0.3s; }
    .btn-back:hover { background: #e3f2fd; transform: translateY(-3px); }
    footer { background: linear-gradient(135deg, #0d47a1 0%, #1565c0 50%, #1976d2 100%); color: #fff; padding: 60px 60px 35px; }
    .footer-content { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 40px; max-width: 1200px; margin: 0 auto 35px; }
    .footer-section h4 { font-size: 18px; margin-bottom: 18px; color: #ffd700; font-weight: 700; }
    .footer-section p, .footer-section a { color: rgba(255,255,255,0.8); line-height: 2.2; font-size: 14px; text-decoration: none; display: block; transition: all 0.3s; }
    .footer-section a:hover { color: #ffd700; padding-left: 6px; }
    .footer-bottom { text-align: center; padding-top: 28px; border-top: 1px solid rgba(255,255,255,0.2); font-size: 14px; }
    @media (max-width: 768px) { header { padding: 15px 20px; flex-direction: column; gap: 15px; } nav ul { flex-wrap: wrap; justify-content: center; } .container { padding: 40px 20px 70px; } .page-hero { padding: 50px 25px; } .page-hero h1 { font-size: 32px; } .info-block { padding: 24px 20px; } .jalur-grid { grid-template-columns: 1fr; } }
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
        <span class="hero-icon">👮</span>
        <h1>Penerimaan Polri</h1>
        <p>Informasi lengkap rekrutmen anggota Polri — jujur, transparan, dan bebas biaya</p>
        <div class="breadcrumb">
            <a href="{{ route('home') }}">🏠 Beranda</a> <span>›</span>
            <a href="{{ route('information') }}">Informasi Pelayanan</a> <span>›</span>
            <span>Penerimaan Polri</span>
        </div>
    </div>
</div>

<div class="container">

    <div class="info-block">
        <div class="block-title"><div class="block-title-icon">🎓</div>Jalur Penerimaan</div>
        <div class="jalur-grid">
            <div class="jalur-card"><h3>Akpol</h3><p>Akademi Kepolisian, pendidikan 4 tahun dan langsung berpangkat Inspektur Polisi Dua.</p><span class="jalur-edu">📚 Min. SMA/Sederajat</span></div>
            <div class="jalur-card"><h3>SIPSS</h3><p>Sekolah Inspektur Polisi Sumber Sarjana, untuk lulusan D4/S1/S2.</p><span class="jalur-edu">🎓 Min. D4 / S1</span></div>
            <div class="jalur-card"><h3>Bintara</h3><p>Pendidikan pembentukan Bintara Polri reguler dan Bintara kompetensi khusus.</p><span class="jalur-edu">📚 Min. SMA/Sederajat</span></div>
            <div class="jalur-card"><h3>Tamtama</h3><p>Pendidikan pembentukan Tamtama Polri untuk mendukung tugas kepolisian lapangan.</p><span class="jalur-edu">📚 Min. SMP/Sederajat</span></div>
        </div>
    </div>

    <div class="info-block">
        <div class="block-title"><div class="block-title-icon">📄</div>Persyaratan Umum</div>
        <ul class="req-list">
            <li><span class="req-num">1</span>Warga Negara Indonesia (WNI)</li>
            <li><span class="req-num">2</span>Beriman dan bertakwa kepada Tuhan Yang Maha Esa</li>
            <li><span class="req-num">3</span>Setia kepada NKRI berdasarkan Pancasila dan UUD 1945</li>
            <li><span class="req-num">4</span>Sehat jasmani dan rohani (dibuktikan dengan surat keterangan dokter)</li>
            <li><span class="req-num">5</span>Tidak pernah dipidana penjara karena melakukan tindak pidana</li>
            <li><span class="req-num">6</span>Berwibawa, jujur, adil, dan berkelakuan tidak tercela</li>
            <li><span class="req-num">7</span>Memiliki ijazah sesuai jalur yang dipilih</li>
            <li><span class="req-num">8</span>Belum pernah menikah (untuk Akpol dan Bintara jalur tertentu)</li>
        </ul>
    </div>

    <div class="info-block">
        <div class="block-title"><div class="block-title-icon">📝</div>Tahapan Seleksi</div>
        <div class="steps">
            <div class="step"><div class="step-num">1</div><div class="step-content"><h4>Pendaftaran Online</h4><p>Daftar di portal resmi <strong>penerimaan.polri.go.id</strong> dan lengkapi seluruh data diri.</p></div></div>
            <div class="step"><div class="step-num">2</div><div class="step-content"><h4>Seleksi Administrasi</h4><p>Verifikasi dokumen dan persyaratan oleh panitia di Polres setempat.</p></div></div>
            <div class="step"><div class="step-num">3</div><div class="step-content"><h4>Tes Kompetensi Dasar</h4><p>Ujian tertulis meliputi TIU, TWK, dan TKP (sesuai jalur masing-masing).</p></div></div>
            <div class="step"><div class="step-num">4</div><div class="step-content"><h4>Tes Kesehatan & Jasmani</h4><p>Pemeriksaan kesehatan menyeluruh dan tes kesamaptaan jasmani.</p></div></div>
            <div class="step"><div class="step-num">5</div><div class="step-content"><h4>Psikologi & Wawancara</h4><p>Tes psikologi dan wawancara untuk menilai kepribadian dan motivasi.</p></div></div>
            <div class="step"><div class="step-num">6</div><div class="step-content"><h4>Pengumuman & Pendidikan</h4><p>Peserta yang lulus mengikuti pendidikan pembentukan di sekolah Polri.</p></div></div>
        </div>
    </div>

    <div class="info-block">
        <div class="block-title"><div class="block-title-icon">⚠️</div>Peringatan Penting</div>
        <div class="warning-box">
            <span class="warning-icon">🚨</span>
            <div class="warning-text">
                <strong>Waspadai Calo & Penipuan!</strong>
                <p>Penerimaan Polri tidak dipungut biaya apapun. Jika ada yang meminta uang dengan dalih meloloskan seleksi, segera laporkan ke Polres Gunungkidul atau hubungi hotline Propam Polri. Seleksi dilaksanakan secara jujur, bersih, transparan, dan akuntabel (JBTAA).</p>
            </div>
        </div>
    </div>

    <div class="info-block">
        <div class="block-title"><div class="block-title-icon">🔗</div>Akses Layanan</div>
        <div class="action-buttons">
            <a href="https://penerimaan.polri.go.id" target="_blank" class="btn-main">🌐 Buka Portal Penerimaan Polri</a>
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