@extends('layouts.app')

@section('title', 'TB News - Portal Kepolisian Indonesia')

@push('styles')
<style>
    /* ===== RESET & GENERAL ===== */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
        color: #333;
        overflow-x: hidden;
    }

    html {
        scroll-behavior: smooth;
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
        backdrop-filter: blur(10px);
        animation: slideDown 0.8s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }

    @keyframes slideDown {
        0% {
            transform: translateY(-100%);
            opacity: 0;
        }
        100% {
            transform: translateY(0);
            opacity: 1;
        }
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
        transition: transform 0.4s ease;
    }

    .logo:hover img {
        transform: rotate(360deg) scale(1.1);
    }

    .logo h2 {
        font-size: 32px;
        font-weight: 800;
        letter-spacing: 3px;
        color: #fff;
        text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.4);
        background: linear-gradient(to right, #ffffff, #ffd700, #ffffff);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        animation: shimmer 3s infinite;
    }

    @keyframes shimmer {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    /* ===== NAVIGATION ===== */
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
        position: relative;
        overflow: hidden;
        display: inline-block;
    }

    nav ul li a::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.3);
        transform: translate(-50%, -50%);
        transition: width 0.5s ease, height 0.5s ease;
    }

    nav ul li a:hover::before {
        width: 300px;
        height: 300px;
    }

    nav ul li a:hover {
        background: rgba(255, 215, 0, 0.9);
        color: #0d47a1;
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(255, 215, 0, 0.4);
    }

    nav ul li a.active {
        background: rgba(255, 215, 0, 0.2);
    }

    /* ===== HERO/SLIDESHOW ===== */
    .hero {
        position: relative;
        height: 600px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(13, 71, 161, 0.85), rgba(25, 118, 210, 0.75));
        z-index: 1;
    }

    .hero img {
        position: absolute;
        width: 100%;
        height: 100%;
        object-fit: cover;
        animation: kenBurns 20s ease-in-out infinite alternate;
    }

    @keyframes kenBurns {
        0% {
            transform: scale(1) translateX(0);
        }
        100% {
            transform: scale(1.15) translateX(-20px);
        }
    }

    .hero-content {
        position: relative;
        z-index: 2;
        text-align: center;
        color: #fff;
        max-width: 900px;
        padding: 40px;
        animation: fadeInUp 1.2s ease;
    }

    @keyframes fadeInUp {
        0% {
            opacity: 0;
            transform: translateY(60px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .hero-content h1 {
        font-size: 68px;
        font-weight: 800;
        text-shadow: 4px 4px 15px rgba(0, 0, 0, 0.6);
        margin-bottom: 20px;
        letter-spacing: 2px;
    }

    .hero-content p {
        font-size: 24px;
        text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.5);
        margin-bottom: 35px;
        font-weight: 300;
    }

    .hero-button {
        display: inline-block;
        padding: 16px 45px;
        background: linear-gradient(135deg, #ffd700, #ffed4e);
        color: #0d47a1;
        font-weight: 700;
        font-size: 18px;
        border-radius: 50px;
        text-decoration: none;
        box-shadow: 0 10px 30px rgba(255, 215, 0, 0.4);
        transition: all 0.4s ease;
    }

    .hero-button:hover {
        transform: translateY(-5px) scale(1.05);
        box-shadow: 0 15px 40px rgba(255, 215, 0, 0.6);
        background: linear-gradient(135deg, #ffed4e, #ffd700);
    }

    /* ===== CONTAINER ===== */
    .container {
        max-width: 1300px;
        margin: 0 auto;
        padding: 80px 40px;
    }

    /* ===== SECTION TITLE ===== */
    .section-title {
        text-align: center;
        margin-bottom: 60px;
        animation: fadeIn 1s ease;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .section-title h2 {
        font-size: 48px;
        color: #0d47a1;
        font-weight: 700;
        margin-bottom: 15px;
        position: relative;
        display: inline-block;
    }

    .section-title h2::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 5px;
        background: linear-gradient(90deg, #0d47a1, #ffd700);
        border-radius: 5px;
    }

    .section-title p {
        font-size: 18px;
        color: #666;
        margin-top: 20px;
    }

    /* ===== VISION MISSION ===== */
    .vision-mission {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(450px, 1fr));
        gap: 35px;
        margin-bottom: 80px;
    }

    .vm-card {
        background: #fff;
        padding: 45px;
        border-radius: 20px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
        transition: all 0.4s ease;
        position: relative;
        overflow: hidden;
    }

    .vm-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 6px;
        height: 100%;
        background: linear-gradient(180deg, #0d47a1, #ffd700);
    }

    .vm-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.18);
    }

    .vm-card h3 {
        font-size: 32px;
        color: #0d47a1;
        margin-bottom: 20px;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .vm-card h3 span {
        font-size: 40px;
    }

    .vm-card p {
        font-size: 17px;
        line-height: 1.9;
        color: #555;
    }

    /* ===== NEWS SECTION ===== */
    .news-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 35px;
        margin-bottom: 80px;
    }

    .news-card {
        background: #fff;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 35px rgba(0, 0, 0, 0.12);
        transition: all 0.4s ease;
        cursor: pointer;
    }

    .news-card:hover {
        transform: translateY(-12px);
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
    }

    .news-image {
        width: 100%;
        height: 220px;
        position: relative;
        overflow: hidden;
    }

    .news-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .news-card:hover .news-image img {
        transform: scale(1.1);
    }

    /* Slideshow for news thumbnails */
    .news-slideshow {
        position: relative;
        width: 100%;
        height: 100%;
    }

    .news-slide {
        position: absolute;
        width: 100%;
        height: 100%;
        opacity: 0;
        transition: opacity 1s ease-in-out;
    }

    .news-slide.active {
        opacity: 1;
    }

    .news-slide img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Slideshow navigation dots */
    .slideshow-dots {
        position: absolute;
        bottom: 10px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 8px;
        z-index: 10;
    }

    .dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.5);
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .dot.active {
        background: #fff;
        width: 24px;
        border-radius: 4px;
    }

    /* Icon overlay for news without images */
    .news-icon-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #1976d2, #42a5f5);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 80px;
        color: #fff;
    }

    .news-icon-overlay::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.6s ease;
    }

    .news-card:hover .news-icon-overlay::before {
        left: 100%;
    }

    .news-content {
        padding: 30px;
    }

    .news-date {
        color: #1976d2;
        font-size: 13px;
        font-weight: 600;
        text-transform: uppercase;
        margin-bottom: 12px;
        display: inline-block;
    }

    .news-content h3 {
        font-size: 24px;
        color: #0d47a1;
        margin-bottom: 15px;
        font-weight: 700;
    }

    .news-content p {
        font-size: 16px;
        line-height: 1.8;
        color: #666;
        margin-bottom: 20px;
    }

    .read-more {
        color: #1976d2;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
    }

    .read-more:hover {
        gap: 15px;
        color: #0d47a1;
    }

    /* ===== SOCIAL MEDIA ===== */
    .social-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 25px;
    }

    .social-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 35px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        gap: 25px;
        color: #fff;
        box-shadow: 0 12px 30px rgba(102, 126, 234, 0.3);
        transition: all 0.4s ease;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    .social-card::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        transform: translate(-50%, -50%);
        transition: width 0.6s ease, height 0.6s ease;
    }

    .social-card:hover::before {
        width: 500px;
        height: 500px;
    }

    .social-card:hover {
        transform: translateX(12px) scale(1.02);
        box-shadow: 0 18px 40px rgba(102, 126, 234, 0.5);
    }

    .social-icon {
        width: 70px;
        height: 70px;
        background: rgba(255, 255, 255, 0.25);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 36px;
        flex-shrink: 0;
        position: relative;
        z-index: 1;
    }

    .social-info {
        position: relative;
        z-index: 1;
    }

    .social-info strong {
        display: block;
        font-size: 20px;
        margin-bottom: 6px;
    }

    .social-info span {
        font-size: 15px;
        opacity: 0.9;
    }

    /* ===== FOOTER ===== */
    footer {
        background: linear-gradient(135deg, #0d47a1 0%, #1565c0 50%, #1976d2 100%);
        color: #fff;
        padding: 70px 60px 40px;
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

        .hero-content h1 {
            font-size: 48px;
        }

        .hero-content p {
            font-size: 18px;
        }

        .container {
            padding: 60px 25px;
        }

        .vision-mission,
        .news-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 600px) {
        .logo h2 {
            font-size: 24px;
        }

        .hero {
            height: 450px;
        }

        .hero-content h1 {
            font-size: 36px;
        }

        .section-title h2 {
            font-size: 36px;
        }

        .stat-card {
            padding: 30px 20px;
        }
    }

    /* ===== SCROLL ANIMATION ===== */
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
            <li><a href="{{ route('home') }}" class="active">Beranda</a></li>
            <li><a href="{{ route('profile') }}">Profil</a></li>
            <li><a href="{{ route('news') }}">Tribratanews</a></li>
            <li><a href="{{ route('information') }}">Informasi Pelayanan</a></li>
        </ul>
    </nav>
</header>

<!-- ===== HERO SECTION ===== -->
<section class="hero">
    <img src="{{ asset('images/hero-bg.jpg') }}" alt="Police Background">
    <div class="hero-content">
        <h1>TB NEWS POLRI</h1>
        <p>Melayani Dengan Sepenuh Hati, Menjaga Dengan Tanggung Jawab</p>
        <a href="#berita" class="hero-button">Lihat Berita Terbaru</a>
    </div>
</section>

<!-- ===== MAIN CONTENT ===== -->
<div class="container">

    <!-- VISION & MISSION -->
    <div id="profil" class="section-title animate-on-scroll">
        <h2>Visi & Misi</h2>
        <p>Fondasi kami dalam melayani bangsa dan negara</p>
    </div>

    <div class="vision-mission animate-on-scroll">
        <div class="vm-card">
            <h3><span>🎯</span> Visi Kami</h3>
            <p>{{ $vision }}</p>
        </div>
        <div class="vm-card">
            <h3><span>🚀</span> Misi Kami</h3>
            <p>{{ $mission }}</p>
        </div>
    </div>

    <!-- NEWS -->
    <div id="berita" class="section-title animate-on-scroll">
        <h2>Berita Terbaru</h2>
        <p>Informasi terkini seputar kegiatan kepolisian</p>
    </div>

    <div class="news-grid animate-on-scroll">
        @foreach($news as $item)
        <div class="news-card">
            <div class="news-image">
                @if(isset($item['images']) && count($item['images']) > 0)
                    <!-- Slideshow jika ada multiple images -->
                    <div class="news-slideshow" data-slideshow>
                        @foreach($item['images'] as $index => $image)
                        <div class="news-slide {{ $index === 0 ? 'active' : '' }}">
                            <img src="{{ asset($image) }}" alt="{{ $item['title'] }}">
                        </div>
                        @endforeach
                        @if(count($item['images']) > 1)
                        <div class="slideshow-dots">
                            @foreach($item['images'] as $index => $image)
                            <span class="dot {{ $index === 0 ? 'active' : '' }}" data-slide="{{ $index }}"></span>
                            @endforeach
                        </div>
                        @endif
                    </div>
                @else
                    <!-- Icon fallback jika tidak ada gambar -->
                    <div class="news-icon-overlay">{{ $item['icon'] }}</div>
                @endif
            </div>
            <div class="news-content">
                <span class="news-date">{{ $item['date'] }}</span>
                <h3>{{ $item['title'] }}</h3>
                <p>{{ Str::limit($item['content'], 150) }}</p>
                <a href="{{ route('news.show', $item['slug']) }}" class="read-more">Selengkapnya →</a>
            </div>
        </div>
        @endforeach
    </div>

    <!-- SOCIAL MEDIA -->
    <div id="informasi" class="section-title animate-on-scroll">
        <h2>Ikuti Kami</h2>
        <p>Tetap terhubung dengan kami melalui media sosial</p>
    </div>

    <div class="social-grid animate-on-scroll">
        @foreach($socialMedia as $social)
        <div class="social-card" onclick="window.open('{{ $social['url'] }}', '_blank')">
            <div class="social-icon">{{ $social['icon'] }}</div>
            <div class="social-info">
                <strong>{{ $social['name'] }}</strong>
                <span>{{ $social['handle'] }}</span>
            </div>
        </div>
        @endforeach
    </div>

</div>

<!-- ===== FOOTER ===== -->
<footer id="kontak">
    <div class="footer-content">
        <div class="footer-section">
            <h4>Kontak Kami</h4>
            <p>
                📧 Email: {{ $contact['email'] }}<br>
                📞 Telp: {{ $contact['phone'] }}<br>
                🚨 Hotline: {{ $contact['hotline'] }}<br>
                💬 WhatsApp: {{ $contact['whatsapp'] }}
            </p>
        </div>

        <div class="footer-section">
            <h4>Alamat Kantor</h4>
            <p>
                {{ $contact['address'] }}<br>
                {{ $contact['city'] }}<br>
                {{ $contact['country'] }}<br>
                🕐 {{ $contact['hours'] }}
            </p>
        </div>

        <div class="footer-section">
            <h4>Tentang Kami</h4>
            @foreach($aboutLinks as $link)
            <a href="{{ $link['url'] }}">{{ $link['name'] }}</a>
            @endforeach
        </div>
    </div>

    <div class="footer-bottom">
        <p>© {{ date('Y') }} Tribun News Gunungkidul - Kepolres Gunungkidul | Melayani Dengan Hati ❤️</p>
    </div>
</footer>
@endsection

@push('scripts')
<script>
    // ===== SLIDESHOW FUNCTIONALITY =====
    function initSlideshows() {
        const slideshows = document.querySelectorAll('[data-slideshow]');
        
        slideshows.forEach(slideshow => {
            const slides = slideshow.querySelectorAll('.news-slide');
            const dots = slideshow.querySelectorAll('.dot');
            let currentSlide = 0;
            let slideInterval;

            // Function to show specific slide
            function showSlide(index) {
                slides.forEach(slide => slide.classList.remove('active'));
                dots.forEach(dot => dot.classList.remove('active'));
                
                currentSlide = index;
                if (currentSlide >= slides.length) currentSlide = 0;
                if (currentSlide < 0) currentSlide = slides.length - 1;
                
                slides[currentSlide].classList.add('active');
                if (dots[currentSlide]) {
                    dots[currentSlide].classList.add('active');
                }
            }

            // Auto advance slides
            function startSlideshow() {
                slideInterval = setInterval(() => {
                    showSlide(currentSlide + 1);
                }, 3000); // Change slide every 3 seconds
            }

            // Stop slideshow
            function stopSlideshow() {
                clearInterval(slideInterval);
            }

            // Dot click handlers
            dots.forEach((dot, index) => {
                dot.addEventListener('click', () => {
                    stopSlideshow();
                    showSlide(index);
                    startSlideshow();
                });
            });

            // Pause on hover
            slideshow.addEventListener('mouseenter', stopSlideshow);
            slideshow.addEventListener('mouseleave', startSlideshow);

            // Start the slideshow if there are multiple slides
            if (slides.length > 1) {
                startSlideshow();
            }
        });
    }

    // Initialize slideshows when DOM is ready
    document.addEventListener('DOMContentLoaded', initSlideshows);

    // ===== SMOOTH SCROLL ANIMATION =====
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

    // Observe all elements with animate-on-scroll class
    document.querySelectorAll('.animate-on-scroll').forEach(element => {
        observer.observe(element);
    });

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Add active state to navigation
    const sections = document.querySelectorAll('section, div[id]');
    const navLinks = document.querySelectorAll('nav a');

    window.addEventListener('scroll', () => {
        let current = '';
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.clientHeight;
            if (scrollY >= (sectionTop - 200)) {
                current = section.getAttribute('id');
            }
        });

        navLinks.forEach(link => {
            link.style.background = '';
            link.classList.remove('active');
            if (link.getAttribute('href').slice(1) === current) {
                link.style.background = 'rgba(255, 215, 0, 0.2)';
                link.classList.add('active');
            }
        });
    });
</script>
@endpush