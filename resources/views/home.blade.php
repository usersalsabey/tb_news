@extends('layouts.app')

@section('title', 'TB News - Portal Kepolisian Indonesia')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=DM+Serif+Display:ital@0;1&display=swap" rel="stylesheet">
<style>
    *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

    :root {
        --navy:    #0a1628;
        --blue:    #1a3a6e;
        --mid:     #1e4da1;
        --accent:  #2563eb;
        --gold:    #f0a500;
        --gold-lt: #fbbf24;
        --surface: #f4f6fa;
        --white:   #ffffff;
        --text:    #1a1f2e;
        --muted:   #6b7280;
        --border:  #e2e8f0;
        --radius:  16px;
    }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: var(--surface);
        color: var(--text);
        overflow-x: hidden;
    }

    html { scroll-behavior: smooth; }

    /* ===== HEADER ===== */
    header {
        background: var(--navy);
        padding: 0 56px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        height: 72px;
        position: sticky;
        top: 0;
        z-index: 1000;
        border-bottom: 1px solid rgba(255,255,255,0.06);
    }

    .logo {
        display: flex;
        align-items: center;
        gap: 14px;
        text-decoration: none;
    }
    .logo img {
        width: 44px;
        height: 44px;
        object-fit: contain;
    }
    .logo-text { display: flex; flex-direction: column; }
    .logo-text span:first-child {
        font-size: 15px; font-weight: 800; color: var(--white);
        letter-spacing: 0.3px; line-height: 1.2;
    }
    .logo-text span:last-child {
        font-size: 11px; color: var(--gold); font-weight: 500;
        letter-spacing: 0.8px; text-transform: uppercase;
    }

    nav ul { display: flex; list-style: none; gap: 4px; }
    nav ul li a {
        text-decoration: none; color: rgba(255,255,255,0.65);
        font-size: 13.5px; font-weight: 600; padding: 8px 16px;
        border-radius: 8px; transition: all 0.2s; display: block;
    }
    nav ul li a:hover { color: var(--white); background: rgba(255,255,255,0.08); }
    nav ul li a.active { color: var(--white); background: var(--accent); }

    /* ===== HERO SLIDESHOW ===== */
    .hero {
        position: relative;
        height: 580px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .hero-slides-wrapper {
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 100%;
        z-index: 0;
    }

    .hero-slides-wrapper .hero-slide {
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 100%;
        opacity: 0;
        transition: opacity 1.2s ease-in-out;
    }
    .hero-slides-wrapper .hero-slide.active { opacity: 1; }
    .hero-slides-wrapper .hero-slide img {
        display: block; width: 100%; height: 100%;
        object-fit: cover; object-position: center;
    }

    .hero-slides-wrapper .hero-slide.active:nth-child(1) img { animation: kb1 20s ease-in-out infinite alternate; }
    .hero-slides-wrapper .hero-slide.active:nth-child(2) img { animation: kb2 20s ease-in-out infinite alternate; }
    .hero-slides-wrapper .hero-slide.active:nth-child(3) img { animation: kb3 20s ease-in-out infinite alternate; }
    .hero-slides-wrapper .hero-slide.active:nth-child(4) img { animation: kb4 20s ease-in-out infinite alternate; }

    @keyframes kb1 { 0% { transform: scale(1)    translate(0,0); }    100% { transform: scale(1.12) translate(-2%,-1%); } }
    @keyframes kb2 { 0% { transform: scale(1.1)  translate(-2%,0); }  100% { transform: scale(1)    translate(2%,-2%); } }
    @keyframes kb3 { 0% { transform: scale(1)    translate(2%,1%); }  100% { transform: scale(1.1)  translate(-1%,-2%); } }
    @keyframes kb4 { 0% { transform: scale(1.08) translate(1%,-1%); } 100% { transform: scale(1)    translate(-2%,1%); } }

    .hero-overlay {
        position: absolute; inset: 0;
        background: linear-gradient(
            135deg,
            rgba(10,22,40,0.80) 0%,
            rgba(26,58,110,0.65) 60%,
            rgba(10,22,40,0.78) 100%
        );
        z-index: 1;
    }

    .hero-content {
        position: relative; z-index: 2;
        text-align: center; color: var(--white);
        max-width: 820px; padding: 40px;
    }

    .hero-tag {
        display: inline-flex; align-items: center; gap: 8px;
        background: rgba(240,165,0,0.12);
        border: 1px solid rgba(240,165,0,0.3);
        color: var(--gold-lt);
        font-size: 11px; font-weight: 700; letter-spacing: 1.2px;
        text-transform: uppercase; padding: 6px 14px;
        border-radius: 100px; margin-bottom: 22px;
    }
    .hero-tag::before { content: '●'; font-size: 8px; }

    .hero-content h1 {
        font-family: 'DM Serif Display', serif;
        font-size: 62px; font-weight: 400;
        line-height: 1.1; margin-bottom: 18px;
        letter-spacing: -0.5px;
    }
    .hero-content h1 em { font-style: italic; color: var(--gold-lt); }

    .hero-content p {
        font-size: 16px; color: rgba(255,255,255,0.65);
        line-height: 1.8; margin-bottom: 32px;
        max-width: 520px; margin-left: auto; margin-right: auto;
    }

    .hero-btn {
        display: inline-block; padding: 14px 36px;
        background: var(--gold); color: var(--navy);
        font-weight: 700; font-size: 14px; border-radius: 10px;
        text-decoration: none; transition: all 0.25s;
        letter-spacing: 0.3px;
    }
    .hero-btn:hover {
        background: var(--gold-lt);
        transform: translateY(-3px);
        box-shadow: 0 12px 32px rgba(240,165,0,0.35);
    }

    /* Arrow buttons */
    .hero-arrow {
        position: absolute; top: 50%; transform: translateY(-50%);
        z-index: 3;
        background: rgba(255,255,255,0.1);
        border: 1px solid rgba(255,255,255,0.2);
        color: var(--white); width: 46px; height: 46px;
        border-radius: 50%; display: flex; align-items: center;
        justify-content: center; font-size: 18px; cursor: pointer;
        backdrop-filter: blur(8px); transition: all 0.25s; outline: none;
    }
    .hero-arrow:hover {
        background: var(--gold); border-color: var(--gold);
        color: var(--navy); transform: translateY(-50%) scale(1.08);
    }
    .hero-arrow.prev { left: 28px; }
    .hero-arrow.next { right: 28px; }

    /* Dots */
    .hero-dots {
        position: absolute; bottom: 24px; left: 50%;
        transform: translateX(-50%); z-index: 3;
        display: flex; gap: 8px; align-items: center;
    }
    .hero-dot {
        width: 8px; height: 8px; border-radius: 50%;
        background: rgba(255,255,255,0.35);
        border: 1.5px solid rgba(255,255,255,0.5);
        cursor: pointer; transition: all 0.35s;
    }
    .hero-dot.active {
        background: var(--gold); border-color: var(--gold);
        width: 24px; border-radius: 4px;
    }

    /* Caption */
    .hero-caption {
        position: absolute; bottom: 58px;
        left: 0; right: 0; z-index: 3; text-align: center;
    }
    .hero-caption-text {
        display: inline-block;
        background: rgba(10,22,40,0.55);
        backdrop-filter: blur(6px);
        color: rgba(255,255,255,0.85);
        font-size: 13px; font-weight: 500; letter-spacing: 0.8px;
        padding: 5px 18px; border-radius: 20px;
        border: 1px solid rgba(255,255,255,0.15);
        opacity: 0; transition: opacity 0.6s ease;
    }
    .hero-caption-text.visible { opacity: 1; }

    /* Progress */
    .hero-progress {
        position: absolute; bottom: 0; left: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--gold), var(--gold-lt));
        z-index: 3; width: 0%;
    }

    /* ===== SECTION WRAPPER ===== */
    .section-wrap {
        max-width: 1100px;
        margin: 0 auto;
        padding: 72px 40px;
    }

    .section-header {
        margin-bottom: 44px;
    }
    .section-header .eyebrow {
        display: inline-block;
        font-size: 11px; font-weight: 700; letter-spacing: 1.5px;
        text-transform: uppercase; color: var(--accent);
        margin-bottom: 10px;
    }
    .section-header h2 {
        font-family: 'DM Serif Display', serif;
        font-size: 38px; color: var(--text);
        line-height: 1.15; font-weight: 400;
    }
    .section-header p {
        font-size: 15px; color: var(--muted);
        line-height: 1.75; margin-top: 10px;
        max-width: 480px;
    }
    .section-divider {
        width: 48px; height: 3px;
        background: linear-gradient(90deg, var(--accent), var(--gold));
        border-radius: 2px; margin-top: 14px;
    }

    /* ===== VISION & MISSION ===== */
    .vm-section { background: var(--white); }

    .vm-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
    }

    .vm-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 20px;
        padding: 36px 32px;
        position: relative;
        overflow: hidden;
        transition: box-shadow 0.25s, transform 0.25s;
    }
    .vm-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 16px 40px rgba(10,22,40,0.1);
    }
    .vm-card::before {
        content: '';
        position: absolute; top: 0; left: 0;
        width: 4px; height: 100%;
        background: linear-gradient(180deg, var(--accent), var(--gold));
    }

    .vm-card-icon {
        width: 48px; height: 48px; border-radius: 14px;
        background: #dbeafe;
        display: flex; align-items: center; justify-content: center;
        font-size: 22px; margin-bottom: 18px;
    }

    .vm-card h3 {
        font-size: 20px; font-weight: 800; color: var(--text);
        margin-bottom: 14px;
    }
    .vm-card p {
        font-size: 14px; line-height: 1.85; color: var(--muted);
    }

    .mission-list {
        list-style: none; display: flex; flex-direction: column; gap: 10px;
    }
    .mission-list li {
        display: flex; align-items: flex-start; gap: 10px;
        font-size: 13.5px; color: #4b5563; line-height: 1.65;
    }
    .mission-list li::before {
        content: '✓';
        width: 18px; height: 18px; border-radius: 50%;
        background: var(--accent); color: var(--white);
        font-size: 9px; font-weight: 900; flex-shrink: 0;
        display: flex; align-items: center; justify-content: center;
        margin-top: 2px;
    }

    /* ===== NEWS ===== */
    .news-section { background: var(--surface); }

    .news-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }

    .news-card {
        background: var(--white);
        border-radius: 18px;
        border: 1px solid var(--border);
        overflow: hidden;
        display: flex; flex-direction: column;
        transition: transform 0.25s, box-shadow 0.25s, border-color 0.25s;
        text-decoration: none; color: inherit;
    }
    .news-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 18px 44px rgba(10,22,40,0.11);
        border-color: transparent;
    }

    .news-image {
        width: 100%; height: 200px;
        position: relative; overflow: hidden;
        background: var(--blue);
    }
    .news-image > img,
    .news-slide img {
        width: 100%; height: 100%; object-fit: cover; display: block;
        transition: transform 0.4s ease;
    }
    .news-card:hover .news-image > img { transform: scale(1.05); }

    .news-slideshow {
        position: relative; width: 100%; height: 100%;
    }
    .news-slide {
        position: absolute; width: 100%; height: 100%;
        opacity: 0; transition: opacity 1s ease-in-out;
    }
    .news-slide.active { opacity: 1; }

    .slideshow-dots {
        position: absolute; bottom: 10px; left: 50%;
        transform: translateX(-50%);
        display: flex; gap: 6px; z-index: 10;
    }
    .dot {
        width: 7px; height: 7px; border-radius: 50%;
        background: rgba(255,255,255,0.5); cursor: pointer;
        transition: all 0.3s;
    }
    .dot.active { background: var(--white); width: 20px; border-radius: 3px; }

    .news-icon-placeholder {
        width: 100%; height: 100%;
        background: linear-gradient(135deg, var(--blue), var(--accent));
        display: flex; align-items: center; justify-content: center;
        font-size: 60px;
    }

    .news-body { padding: 22px 22px 18px; flex: 1; display: flex; flex-direction: column; gap: 8px; }

    .news-date {
        font-size: 11.5px; font-weight: 700; letter-spacing: 0.8px;
        text-transform: uppercase; color: var(--accent);
    }
    .news-title {
        font-size: 16px; font-weight: 800; color: var(--text); line-height: 1.35;
    }
    .news-excerpt {
        font-size: 13.5px; color: var(--muted); line-height: 1.7; flex: 1;
    }
    .news-readmore {
        display: inline-flex; align-items: center; gap: 6px;
        font-size: 13px; font-weight: 700; color: var(--accent);
        text-decoration: none; margin-top: 8px; transition: gap 0.2s;
    }
    .news-readmore:hover { gap: 10px; }

    /* ===== WEATHER BAR (compact) ===== */
    .wx-bar {
        background: #0d1e38;
        border-bottom: 1px solid rgba(255,255,255,0.07);
        padding: 0 56px;
        height: 52px;
        display: flex;
        align-items: center;
        gap: 0;
        overflow: hidden;
        position: relative;
    }
    /* Kiri: cuaca sekarang */
    .wx-bar-current {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-shrink: 0;
        padding-right: 20px;
        border-right: 1px solid rgba(255,255,255,0.08);
        height: 32px;
    }
    .wx-bar-icon   { font-size: 22px; line-height: 1; }
    .wx-bar-temp   { font-size: 18px; font-weight: 800; color: var(--white); letter-spacing: -0.5px; }
    .wx-bar-info   { display: flex; flex-direction: column; gap: 1px; }
    .wx-bar-desc   { font-size: 11.5px; font-weight: 600; color: rgba(255,255,255,0.75); line-height: 1; }
    .wx-bar-meta   {
        display: flex; gap: 10px;
        font-size: 10px; color: rgba(255,255,255,0.35); font-weight: 500;
    }
    .wx-bar-meta span { display: flex; align-items: center; gap: 3px; }

    /* Kanan: 7 hari mini pills */
    .wx-bar-days {
        display: flex;
        align-items: center;
        gap: 4px;
        flex: 1;
        overflow-x: auto;
        padding: 0 16px;
        scrollbar-width: none;
    }
    .wx-bar-days::-webkit-scrollbar { display: none; }

    .wx-bar-day {
        display: flex;
        align-items: center;
        gap: 6px;
        padding: 5px 12px;
        border-radius: 100px;
        background: rgba(255,255,255,0.04);
        border: 1px solid rgba(255,255,255,0.06);
        flex-shrink: 0;
        transition: background 0.2s, border-color 0.2s;
        cursor: default;
    }
    .wx-bar-day:hover {
        background: rgba(37,99,235,0.18);
        border-color: rgba(37,99,235,0.3);
    }
    .wx-bar-day.wx-today-pill {
        background: rgba(37,99,235,0.2);
        border-color: rgba(37,99,235,0.45);
    }
    .wx-bar-day-name {
        font-size: 10.5px; font-weight: 700; letter-spacing: 0.5px;
        text-transform: uppercase; color: rgba(255,255,255,0.45);
        min-width: 26px;
    }
    .wx-bar-day.wx-today-pill .wx-bar-day-name { color: var(--gold-lt); }
    .wx-bar-day-icon  { font-size: 16px; line-height: 1; }
    .wx-bar-day-temps {
        font-size: 11px; font-weight: 700; color: var(--white);
        white-space: nowrap;
    }
    .wx-bar-day-lo { color: rgba(255,255,255,0.35); font-weight: 500; }

    /* Refresh btn */
    .wx-bar-refresh {
        flex-shrink: 0;
        background: none;
        border: none;
        color: rgba(255,255,255,0.25);
        cursor: pointer;
        padding: 6px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        transition: color 0.2s;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
    .wx-bar-refresh:hover { color: rgba(255,255,255,0.7); }
    .wx-bar-refresh svg { transition: transform 0.5s; }
    .wx-bar-refresh.spinning svg { animation: wxSpin 0.7s linear infinite; }
    @keyframes wxSpin { to { transform: rotate(360deg); } }

    /* Skeleton pulse */
    .wx-sk {
        background: rgba(255,255,255,0.07);
        border-radius: 6px;
        animation: wxPulse 1.6s ease-in-out infinite;
        display: inline-block;
    }
    @keyframes wxPulse { 0%,100%{opacity:.4} 50%{opacity:.9} }

    /* ===== SOCIAL MEDIA ===== */
    .social-section { background: var(--white); }

    .social-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
    }

    .social-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 24px 20px;
        display: flex; align-items: center; gap: 16px;
        text-decoration: none; color: var(--text);
        transition: all 0.25s; cursor: pointer;
    }
    .social-card:hover {
        background: var(--navy); color: var(--white);
        border-color: var(--navy);
        transform: translateY(-4px);
        box-shadow: 0 12px 32px rgba(10,22,40,0.15);
    }
    .social-card:hover .social-handle { color: rgba(255,255,255,0.55); }

    .social-icon-wrap {
        width: 46px; height: 46px; border-radius: 12px;
        background: var(--white); display: flex;
        align-items: center; justify-content: center;
        font-size: 22px; flex-shrink: 0;
        border: 1px solid var(--border);
    }
    .social-card:hover .social-icon-wrap {
        background: rgba(255,255,255,0.1);
        border-color: rgba(255,255,255,0.15);
    }

    .social-name { font-size: 14px; font-weight: 700; }
    .social-handle { font-size: 12px; color: var(--muted); margin-top: 2px; }

    /* ===== FOOTER ===== */
    footer { background: var(--navy); color: var(--white); padding: 0; }
    .footer-location { background: #0d1e38; border-bottom: 1px solid rgba(255,255,255,0.06); padding: 20px 56px; }
    .footer-location-inner { max-width: 1100px; margin: 0 auto; display: flex; align-items: center; justify-content: space-between; gap: 20px; flex-wrap: wrap; }
    .footer-location-left { display: flex; align-items: center; gap: 14px; }
    .location-icon-wrap { width: 44px; height: 44px; background: rgba(37,99,235,0.15); border: 1px solid rgba(37,99,235,0.3); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0; }
    .location-label { font-size: 10.5px; font-weight: 700; letter-spacing: 1.2px; text-transform: uppercase; color: var(--gold); margin-bottom: 3px; }
    .location-address { font-size: 13.5px; color: rgba(255,255,255,0.85); font-weight: 600; line-height: 1.4; }
    .location-city { font-size: 12px; color: rgba(255,255,255,0.4); margin-top: 2px; }
    .maps-btn { display: inline-flex; align-items: center; gap: 9px; padding: 11px 20px; background: var(--accent); color: var(--white); font-size: 13px; font-weight: 700; border-radius: 10px; text-decoration: none; transition: all 0.25s; white-space: nowrap; flex-shrink: 0; border: 1px solid rgba(255,255,255,0.1); }
    .maps-btn:hover { background: #1d4ed8; transform: translateY(-2px); box-shadow: 0 8px 24px rgba(37,99,235,0.4); }
    .footer-main { padding: 52px 56px 32px; }
    .footer-grid { max-width: 1100px; margin: 0 auto; display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 48px; padding-bottom: 40px; border-bottom: 1px solid rgba(255,255,255,0.08); margin-bottom: 28px; }
    .footer-brand p { font-size: 13.5px; color: rgba(255,255,255,0.45); line-height: 1.9; margin-top: 14px; max-width: 280px; }
    .footer-col h5 { font-size: 11px; font-weight: 700; letter-spacing: 1.2px; text-transform: uppercase; color: var(--gold); margin-bottom: 18px; }
    .footer-col a, .footer-col p { display: block; font-size: 13.5px; color: rgba(255,255,255,0.5); text-decoration: none; line-height: 2.2; transition: color 0.2s; }
    .footer-col a:hover { color: var(--white); }
    .footer-bottom { max-width: 1100px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; font-size: 12.5px; color: rgba(255,255,255,0.3); }

    /* ===== SCROLL ANIMATION ===== */
    .fade-up {
        opacity: 0; transform: translateY(32px);
        transition: opacity 0.65s ease, transform 0.65s ease;
    }
    .fade-up.visible { opacity: 1; transform: translateY(0); }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 1024px) {
        .news-grid { grid-template-columns: repeat(2, 1fr); }
        .social-grid { grid-template-columns: repeat(2, 1fr); }
        .vm-grid { grid-template-columns: 1fr; }
        .footer-grid { grid-template-columns: 1fr 1fr; }
    }
    @media (max-width: 768px) {
        header { padding: 0 24px; height: auto; padding-top: 14px; padding-bottom: 14px; flex-direction: column; gap: 12px; }
        .hero { height: 480px; }
        .hero-content h1 { font-size: 40px; }
        .hero-arrow { display: none; }
        .section-wrap { padding: 52px 24px; }
        .news-grid { grid-template-columns: 1fr; }
        .social-grid { grid-template-columns: repeat(2, 1fr); }
        .footer-grid { grid-template-columns: 1fr; }
        .footer-location { padding: 18px 28px; }
        .footer-main { padding: 44px 28px 28px; }
        .footer-bottom { flex-direction: column; gap: 8px; text-align: center; }
        .wx-bar { padding: 0 20px; }
        .wx-bar-current { padding-right: 12px; }
        .wx-bar-desc { display: none; }
    }
    @media (max-width: 480px) {
        .hero-content h1 { font-size: 30px; }
        .social-grid { grid-template-columns: 1fr; }
        nav ul li a { padding: 7px 11px; font-size: 12px; }
        .wx-bar-meta { display: none; }
    }

    /* ===== INSTAGRAM FEED ===== */
    .ig-section {
        background: var(--surface);
        border-top: 1px solid var(--border);
    }

    .ig-header-row {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        margin-bottom: 28px;
        gap: 20px;
        flex-wrap: wrap;
    }

    .ig-profile {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .ig-avatar {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        background: linear-gradient(135deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888);
        padding: 2.5px;
        flex-shrink: 0;
    }
    .ig-avatar-inner {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background: var(--white);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        overflow: hidden;
    }
    .ig-avatar-inner img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
    }

    .ig-profile-text {}
    .ig-username {
        font-size: 15px;
        font-weight: 800;
        color: var(--text);
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .ig-verified {
        width: 16px; height: 16px;
        background: #2563eb;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 9px;
        font-weight: 900;
    }
    .ig-stats {
        display: flex;
        gap: 16px;
        margin-top: 4px;
    }
    .ig-stat {
        font-size: 12px;
        color: var(--muted);
    }
    .ig-stat strong {
        color: var(--text);
        font-weight: 700;
    }

    .ig-follow-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 22px;
        background: linear-gradient(135deg, #f09433, #dc2743, #bc1888);
        color: var(--white);
        font-size: 13px;
        font-weight: 700;
        border-radius: 10px;
        text-decoration: none;
        transition: all 0.25s;
        letter-spacing: 0.2px;
        flex-shrink: 0;
    }
    .ig-follow-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 28px rgba(220,39,67,0.35);
        filter: brightness(1.05);
    }

    /* Grid feed */
    .ig-feed {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 6px;
        border-radius: 16px;
        overflow: hidden;
    }

    .ig-item {
        position: relative;
        aspect-ratio: 1 / 1;
        overflow: hidden;
        cursor: pointer;
        background: var(--blue);
    }

    .ig-item:nth-child(1)  { background: linear-gradient(135deg, #0a1628, #1e4da1); }
    .ig-item:nth-child(2)  { background: linear-gradient(135deg, #1a3a6e, #2563eb); }
    .ig-item:nth-child(3)  { background: linear-gradient(135deg, #064e3b, #10b981); }
    .ig-item:nth-child(4)  { background: linear-gradient(135deg, #7f1d1d, #ef4444); }
    .ig-item:nth-child(5)  { background: linear-gradient(135deg, #78350f, #f59e0b); }
    .ig-item:nth-child(6)  { background: linear-gradient(135deg, #312e81, #6366f1); }
    .ig-item:nth-child(7)  { background: linear-gradient(135deg, #1e3a5f, #3b82f6); }
    .ig-item:nth-child(8)  { background: linear-gradient(135deg, #134e4a, #14b8a6); }
    .ig-item:nth-child(9)  { background: linear-gradient(135deg, #4a1d96, #a78bfa); }
    .ig-item:nth-child(10) { background: linear-gradient(135deg, #1c1917, #78716c); }
    .ig-item:nth-child(11) { background: linear-gradient(135deg, #0f172a, #1e40af); }
    .ig-item:nth-child(12) { background: linear-gradient(135deg, #052e16, #16a34a); }

    .ig-item img {
        width: 100%; height: 100%; object-fit: cover; display: block;
        transition: transform 0.4s ease; position: relative; z-index: 1;
    }

    .ig-placeholder {
        width: 100%; height: 100%;
        display: flex; flex-direction: column;
        align-items: center; justify-content: center;
        gap: 6px; font-size: 28px; color: rgba(255,255,255,0.7);
    }
    .ig-placeholder span {
        font-size: 11px; font-weight: 600;
        color: rgba(255,255,255,0.45); letter-spacing: 0.5px;
        text-align: center; padding: 0 8px;
    }

    .ig-overlay {
        position: absolute; inset: 0;
        background: rgba(10,22,40,0.7);
        display: flex; flex-direction: column;
        align-items: center; justify-content: center;
        gap: 8px; opacity: 0; transition: opacity 0.25s ease;
    }
    .ig-item:hover .ig-overlay { opacity: 1; }
    .ig-item:hover img { transform: scale(1.08); }

    .ig-overlay-stats { display: flex; gap: 16px; }
    .ig-overlay-stat {
        display: flex; align-items: center; gap: 5px;
        color: var(--white); font-size: 13px; font-weight: 700;
    }

    .ig-overlay-caption {
        font-size: 11px; color: rgba(255,255,255,0.6);
        text-align: center; padding: 0 12px; line-height: 1.5;
        max-width: 140px; overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }

    .ig-footer-row {
        margin-top: 20px;
        display: flex; align-items: center; justify-content: center;
    }
    .ig-view-all {
        display: inline-flex; align-items: center; gap: 8px;
        font-size: 13.5px; font-weight: 700; color: var(--muted);
        text-decoration: none; padding: 10px 24px;
        border: 1.5px solid var(--border); border-radius: 10px;
        background: var(--white); transition: all 0.25s;
    }
    .ig-view-all:hover { border-color: #dc2743; color: #dc2743; background: #fff5f5; }

    @media (max-width: 900px) {
        .ig-feed { grid-template-columns: repeat(4, 1fr); }
        .ig-item:nth-child(n+9) { display: none; }
    }
    @media (max-width: 560px) {
        .ig-feed { grid-template-columns: repeat(3, 1fr); }
        .ig-item:nth-child(n+7) { display: none; }
        .ig-header-row { flex-direction: column; align-items: flex-start; }
    }
</style>
@endpush

@section('content')

{{-- ===== HEADER ===== --}}
<header>
    <a href="{{ route('home') }}" class="logo">
        <img src="{{ asset('images/new.PNG') }}" alt="Logo Polri">
        <div class="logo-text">
            <span>Tribun News Gunungkidul</span>
            <span>Polres Gunungkidul</span>
        </div>
    </a>
    <nav>
        <ul>
            <li><a href="{{ route('home') }}" class="active">Beranda</a></li>
            <li><a href="{{ route('profile') }}">Profil</a></li>
            <li><a href="{{ route('news') }}">Tribratanews</a></li>
            <li><a href="{{ route('information') }}">Informasi Pelayanan</a></li>
        </ul>
    </nav>
</header>

{{-- ===== WEATHER BAR (compact, real-time) ===== --}}
<div class="wx-bar" id="wxBar">
    <div class="wx-bar-current">
        <div class="wx-bar-icon" id="wxIcon">⏳</div>
        <div class="wx-bar-info">
            <div style="display:flex;align-items:baseline;gap:6px;">
                <span class="wx-bar-temp" id="wxTemp"><span class="wx-sk" style="width:42px;height:16px;border-radius:4px;display:inline-block;vertical-align:middle;"></span></span>
            </div>
            <div class="wx-bar-desc" id="wxDesc">Memuat…</div>
            <div class="wx-bar-meta" id="wxMeta">
                <span id="wxHum">💧 --</span>
                <span id="wxWnd">💨 --</span>
                <span id="wxPrcp">☔ --</span>
            </div>
        </div>
    </div>
    <div class="wx-bar-days" id="wxDays">
        @for($i = 0; $i < 7; $i++)
        <div class="wx-bar-day">
            <span class="wx-bar-day-name"><span class="wx-sk" style="width:26px;height:9px;border-radius:3px;display:inline-block;"></span></span>
            <span class="wx-bar-day-icon"><span class="wx-sk" style="width:16px;height:16px;border-radius:50%;display:inline-block;"></span></span>
            <span class="wx-bar-day-temps"><span class="wx-sk" style="width:38px;height:9px;border-radius:3px;display:inline-block;"></span></span>
        </div>
        @endfor
    </div>
    <button class="wx-bar-refresh" id="wxRefresh" title="Refresh cuaca">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M23 4v6h-6"/><path d="M1 20v-6h6"/>
            <path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"/>
        </svg>
    </button>
</div>

{{-- ===== HERO ===== --}}
<section class="hero">
    <div class="hero-slides-wrapper" id="heroSlidesWrapper">
        <div class="hero-slide active" data-caption="Melayani Masyarakat Gunungkidul">
            <img src="{{ asset('images/hero/slide1.jpg') }}" alt="Slide 1">
        </div>
        <div class="hero-slide" data-caption="Keamanan & Ketertiban Bersama">
            <img src="{{ asset('images/hero/slide2.jpeg') }}" alt="Slide 2">
        </div>
        <div class="hero-slide" data-caption="Profesional dalam Bertugas">
            <img src="{{ asset('images/hero/slide3.jpg') }}" alt="Slide 3">
        </div>
        <div class="hero-slide" data-caption="Bersama Menjaga Nusantara">
            <img src="{{ asset('images/hero/slide4.jpg') }}" alt="Slide 4">
        </div>
    </div>

    <div class="hero-overlay"></div>

    <div class="hero-content">
        <div class="hero-tag">Portal Resmi Polres Gunungkidul</div>
        <h1>TB News <em>Polri</em></h1>
        <p>Melayani Dengan Sepenuh Hati, Menjaga Dengan Tanggung Jawab</p>
        <a href="#berita" class="hero-btn">Lihat Berita Terbaru</a>
    </div>

    <button class="hero-arrow prev" id="heroPrev" aria-label="Sebelumnya">&#8592;</button>
    <button class="hero-arrow next" id="heroNext" aria-label="Selanjutnya">&#8594;</button>
    <div class="hero-dots" id="heroDots"></div>
    <div class="hero-caption"><span class="hero-caption-text" id="heroCaption"></span></div>
    <div class="hero-progress" id="heroProgress"></div>
</section>

{{-- ===== VISI & MISI ===== --}}
<section class="vm-section" id="profil">
    <div class="section-wrap">
        <div class="section-header fade-up">
            <span class="eyebrow">Tentang Kami</span>
            <h2>Visi & Misi</h2>
            <p>Fondasi kami dalam melayani bangsa dan negara dengan profesional dan berintegritas.</p>
            <div class="section-divider"></div>
        </div>
        <div class="vm-grid fade-up">
            <div class="vm-card">
                <div class="vm-card-icon">🎯</div>
                <h3>Visi Kami</h3>
                <p>{{ $vision }}</p>
            </div>
            <div class="vm-card">
                <div class="vm-card-icon">🚀</div>
                <h3>Misi Kami</h3>
                <ul class="mission-list">
                    @foreach($mission as $point)
                    <li>{{ $point }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>

{{-- ===== BERITA ===== --}}
<section class="news-section" id="berita">
    <div class="section-wrap">
        <div class="section-header fade-up">
            <span class="eyebrow">Informasi Terkini</span>
            <h2>Berita Terbaru</h2>
            <p>Informasi terkini seputar kegiatan dan layanan kepolisian Gunungkidul.</p>
            <div class="section-divider"></div>
        </div>
        <div class="news-grid fade-up">
            @foreach($news as $item)
            <a href="{{ route('news.show', $item['slug']) }}" class="news-card">
                <div class="news-image">
                    @if(isset($item['images']) && count($item['images']) > 0)
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
                        <div class="news-icon-placeholder">{{ $item['icon'] }}</div>
                    @endif
                </div>
                <div class="news-body">
                    <span class="news-date">{{ $item['date'] }}</span>
                    <div class="news-title">{{ $item['title'] }}</div>
                    <p class="news-excerpt">{{ Str::limit($item['content'], 130) }}</p>
                    <span class="news-readmore">Selengkapnya →</span>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>

{{-- ===== INSTAGRAM FEED ===== --}}
<section class="ig-section">
    <div class="section-wrap">
        <div class="ig-header-row fade-up">
            <div class="ig-profile">
                <div class="ig-avatar">
                    <div class="ig-avatar-inner">
                        <img src="{{ asset('images/new.PNG') }}" alt="IG Profile" onerror="this.parentElement.innerHTML='📷'">
                    </div>
                </div>
                <div class="ig-profile-text">
                    <div class="ig-username">
                        polres.gunungkidul
                        <span class="ig-verified">✓</span>
                    </div>
                    <div class="ig-stats">
                        <span class="ig-stat"><strong>2.4K</strong> postingan</span>
                        <span class="ig-stat"><strong>18.7K</strong> followers</span>
                        <span class="ig-stat"><strong>412</strong> following</span>
                    </div>
                </div>
            </div>
            <a href="https://www.instagram.com/polres.gunungkidul/" target="_blank" rel="noopener" class="ig-follow-btn">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>
                </svg>
                Follow di Instagram
            </a>
        </div>

        <div class="ig-feed fade-up">
            <a href="https://www.instagram.com/polres.gunungkidul/" target="_blank" rel="noopener" class="ig-item">
                <img src="{{ asset('images/ig/post1.jpg') }}" alt="" onerror="this.style.display='none'">
                <div class="ig-placeholder">👮<span>Operasi Kamtibmas</span></div>
                <div class="ig-overlay">
                    <div class="ig-overlay-stats"><span class="ig-overlay-stat">❤️ 312</span><span class="ig-overlay-stat">💬 24</span></div>
                    <p class="ig-overlay-caption">Operasi keamanan dan ketertiban masyarakat</p>
                </div>
            </a>
            <a href="https://www.instagram.com/polres.gunungkidul/" target="_blank" rel="noopener" class="ig-item">
                <img src="{{ asset('images/ig/post2.jpg') }}" alt="" onerror="this.style.display='none'">
                <div class="ig-placeholder">🚦<span>Lalu Lintas</span></div>
                <div class="ig-overlay">
                    <div class="ig-overlay-stats"><span class="ig-overlay-stat">❤️ 278</span><span class="ig-overlay-stat">💬 18</span></div>
                    <p class="ig-overlay-caption">Pengaturan arus lalu lintas di pusat kota</p>
                </div>
            </a>
            <a href="https://www.instagram.com/polres.gunungkidul/" target="_blank" rel="noopener" class="ig-item">
                <img src="{{ asset('images/ig/post3.jpg') }}" alt="" onerror="this.style.display='none'">
                <div class="ig-placeholder">🤝<span>Bakti Sosial</span></div>
                <div class="ig-overlay">
                    <div class="ig-overlay-stats"><span class="ig-overlay-stat">❤️ 445</span><span class="ig-overlay-stat">💬 36</span></div>
                    <p class="ig-overlay-caption">Kegiatan bakti sosial bersama masyarakat</p>
                </div>
            </a>
            <a href="https://www.instagram.com/polres.gunungkidul/" target="_blank" rel="noopener" class="ig-item">
                <img src="{{ asset('images/ig/post4.jpg') }}" alt="" onerror="this.style.display='none'">
                <div class="ig-placeholder">🏫<span>Polisi Sahabat Anak</span></div>
                <div class="ig-overlay">
                    <div class="ig-overlay-stats"><span class="ig-overlay-stat">❤️ 521</span><span class="ig-overlay-stat">💬 47</span></div>
                    <p class="ig-overlay-caption">Program Polisi Sahabat Anak di sekolah</p>
                </div>
            </a>
            <a href="https://www.instagram.com/polres.gunungkidul/" target="_blank" rel="noopener" class="ig-item">
                <img src="{{ asset('images/ig/post5.jpg') }}" alt="" onerror="this.style.display='none'">
                <div class="ig-placeholder">📋<span>Pelayanan SKCK</span></div>
                <div class="ig-overlay">
                    <div class="ig-overlay-stats"><span class="ig-overlay-stat">❤️ 198</span><span class="ig-overlay-stat">💬 12</span></div>
                    <p class="ig-overlay-caption">Pelayanan SKCK cepat dan transparan</p>
                </div>
            </a>
            <a href="https://www.instagram.com/polres.gunungkidul/" target="_blank" rel="noopener" class="ig-item">
                <img src="{{ asset('images/ig/post6.jpg') }}" alt="" onerror="this.style.display='none'">
                <div class="ig-placeholder">🌄<span>Gunungkidul</span></div>
                <div class="ig-overlay">
                    <div class="ig-overlay-stats"><span class="ig-overlay-stat">❤️ 387</span><span class="ig-overlay-stat">💬 29</span></div>
                    <p class="ig-overlay-caption">Menjaga keindahan wisata Gunungkidul</p>
                </div>
            </a>
            <a href="https://www.instagram.com/polres.gunungkidul/" target="_blank" rel="noopener" class="ig-item">
                <img src="{{ asset('images/ig/post7.jpg') }}" alt="" onerror="this.style.display='none'">
                <div class="ig-placeholder">🏋️<span>Apel Pagi</span></div>
                <div class="ig-overlay">
                    <div class="ig-overlay-stats"><span class="ig-overlay-stat">❤️ 234</span><span class="ig-overlay-stat">💬 15</span></div>
                    <p class="ig-overlay-caption">Apel pagi seluruh personel Polres</p>
                </div>
            </a>
            <a href="https://www.instagram.com/polres.gunungkidul/" target="_blank" rel="noopener" class="ig-item">
                <img src="{{ asset('images/ig/post8.jpg') }}" alt="" onerror="this.style.display='none'">
                <div class="ig-placeholder">🚓<span>Patroli</span></div>
                <div class="ig-overlay">
                    <div class="ig-overlay-stats"><span class="ig-overlay-stat">❤️ 302</span><span class="ig-overlay-stat">💬 21</span></div>
                    <p class="ig-overlay-caption">Patroli malam menjaga keamanan warga</p>
                </div>
            </a>
            <a href="https://www.instagram.com/polres.gunungkidul/" target="_blank" rel="noopener" class="ig-item">
                <img src="{{ asset('images/ig/post9.jpg') }}" alt="" onerror="this.style.display='none'">
                <div class="ig-placeholder">📢<span>Sosialisasi</span></div>
                <div class="ig-overlay">
                    <div class="ig-overlay-stats"><span class="ig-overlay-stat">❤️ 176</span><span class="ig-overlay-stat">💬 9</span></div>
                    <p class="ig-overlay-caption">Sosialisasi keamanan kepada warga desa</p>
                </div>
            </a>
            <a href="https://www.instagram.com/polres.gunungkidul/" target="_blank" rel="noopener" class="ig-item">
                <img src="{{ asset('images/ig/post10.jpg') }}" alt="" onerror="this.style.display='none'">
                <div class="ig-placeholder">🏆<span>Prestasi</span></div>
                <div class="ig-overlay">
                    <div class="ig-overlay-stats"><span class="ig-overlay-stat">❤️ 489</span><span class="ig-overlay-stat">💬 53</span></div>
                    <p class="ig-overlay-caption">Penghargaan untuk anggota berprestasi</p>
                </div>
            </a>
            <a href="https://www.instagram.com/polres.gunungkidul/" target="_blank" rel="noopener" class="ig-item">
                <img src="{{ asset('images/ig/post11.jpg') }}" alt="" onerror="this.style.display='none'">
                <div class="ig-placeholder">💉<span>Vaksinasi</span></div>
                <div class="ig-overlay">
                    <div class="ig-overlay-stats"><span class="ig-overlay-stat">❤️ 265</span><span class="ig-overlay-stat">💬 18</span></div>
                    <p class="ig-overlay-caption">Polres mendukung program vaksinasi</p>
                </div>
            </a>
            <a href="https://www.instagram.com/polres.gunungkidul/" target="_blank" rel="noopener" class="ig-item">
                <img src="{{ asset('images/ig/post12.jpg') }}" alt="" onerror="this.style.display='none'">
                <div class="ig-placeholder">🌿<span>Lingkungan</span></div>
                <div class="ig-overlay">
                    <div class="ig-overlay-stats"><span class="ig-overlay-stat">❤️ 341</span><span class="ig-overlay-stat">💬 27</span></div>
                    <p class="ig-overlay-caption">Polres peduli lingkungan hidup</p>
                </div>
            </a>
        </div>

        <div class="ig-footer-row fade-up">
            <a href="https://www.instagram.com/polres.gunungkidul/" target="_blank" rel="noopener" class="ig-view-all">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>
                </svg>
                Lihat semua di Instagram
            </a>
        </div>
    </div>
</section>

{{-- ===== SOSIAL MEDIA ===== --}}
<section class="social-section" id="informasi">
    <div class="section-wrap">
        <div class="section-header fade-up">
            <span class="eyebrow">Media Sosial</span>
            <h2>Ikuti Kami</h2>
            <p>Tetap terhubung dan dapatkan informasi terbaru melalui media sosial resmi kami.</p>
            <div class="section-divider"></div>
        </div>
        <div class="social-grid fade-up">
            @foreach($socialMedia as $social)
            <a href="{{ $social['url'] }}" target="_blank" rel="noopener" class="social-card">
                <div class="social-icon-wrap">{{ $social['icon'] }}</div>
                <div>
                    <div class="social-name">{{ $social['name'] }}</div>
                    <div class="social-handle">{{ $social['handle'] }}</div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>

{{-- ===== FOOTER ===== --}}
<footer id="kontak">
    <div class="footer-location">
        <div class="footer-location-inner">
            <div class="footer-location-left">
                <div class="location-icon-wrap">📍</div>
                <div>
                    <div class="location-label">Lokasi Polres Gunungkidul</div>
                    <div class="location-address">Jln. MGR Sugiyopranoto No.15, Wonosari</div>
                    <div class="location-city">Kabupaten Gunungkidul, D.I. Yogyakarta 55813</div>
                </div>
            </div>
            <a href="https://maps.app.goo.gl/Xv8tKdyoVjMf4DkRA" target="_blank" rel="noopener" class="maps-btn">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/>
                </svg>
                Buka di Google Maps
            </a>
        </div>
    </div>
    <div class="footer-main">
        <div class="footer-grid">
            <div class="footer-brand">
                <a href="{{ route('home') }}" class="logo">
                    <img src="{{ asset('images/new.PNG') }}" alt="Logo">
                    <div class="logo-text">
                        <span>Tribun News Gunungkidul</span>
                        <span>Polres Gunungkidul</span>
                    </div>
                </a>
                <p>{{ $contact['address'] }}, {{ $contact['city'] }}. Melayani seluruh masyarakat Gunungkidul dengan profesional dan terpercaya.</p>
            </div>
            <div class="footer-col">
                <h5>Kontak</h5>
                <p>📧 {{ $contact['email'] }}</p>
                <p>📞 {{ $contact['phone'] }}</p>
                <p>🚨 {{ $contact['hotline'] }}</p>
                <p>🕐 {{ $contact['hours'] }}</p>
            </div>
            <div class="footer-col">
                <h5>Navigasi</h5>
                @foreach($aboutLinks as $link)
                <a href="{{ $link['url'] }}">{{ $link['name'] }}</a>
                @endforeach
            </div>
        </div>
        <div class="footer-bottom">
            <span>© {{ date('Y') }} Polres Gunungkidul — Melayani Dengan Hati</span>
            <span>Tribun News Gunungkidul</span>
        </div>
    </div>
</footer>

@endsection

@push('scripts')
<script>
// ===== HERO SLIDESHOW =====
(function () {
    const wrapper     = document.getElementById('heroSlidesWrapper');
    const slides      = wrapper.querySelectorAll('.hero-slide');
    const dotsWrapper = document.getElementById('heroDots');
    const captionEl   = document.getElementById('heroCaption');
    const progressEl  = document.getElementById('heroProgress');
    const prevBtn     = document.getElementById('heroPrev');
    const nextBtn     = document.getElementById('heroNext');

    const INTERVAL = 5000;
    let current = 0, timer = null;

    if (!slides.length) return;

    slides.forEach((_, i) => {
        const dot = document.createElement('span');
        dot.className = 'hero-dot' + (i === 0 ? ' active' : '');
        dot.addEventListener('click', () => goTo(i, true));
        dotsWrapper.appendChild(dot);
    });

    const getDots = () => dotsWrapper.querySelectorAll('.hero-dot');

    function goTo(index, resetTimer = false) {
        slides[current].classList.remove('active');
        getDots()[current].classList.remove('active');
        current = ((index % slides.length) + slides.length) % slides.length;
        slides[current].classList.add('active');
        getDots()[current].classList.add('active');

        const caption = slides[current].dataset.caption || '';
        captionEl.textContent = caption;
        captionEl.classList.remove('visible');
        requestAnimationFrame(() => requestAnimationFrame(() => captionEl.classList.add('visible')));
        startProgress();
        if (resetTimer) restartTimer();
    }

    function startProgress() {
        progressEl.style.transition = 'none';
        progressEl.style.width = '0%';
        void progressEl.offsetWidth;
        progressEl.style.transition = `width ${INTERVAL}ms linear`;
        progressEl.style.width = '100%';
    }

    function pauseProgress() {
        const w = getComputedStyle(progressEl).width;
        progressEl.style.transition = 'none';
        progressEl.style.width = w;
    }

    function startTimer()   { timer = setInterval(() => goTo(current + 1), INTERVAL); }
    function stopTimer()    { clearInterval(timer); }
    function restartTimer() { stopTimer(); startTimer(); }

    prevBtn.addEventListener('click', () => goTo(current - 1, true));
    nextBtn.addEventListener('click', () => goTo(current + 1, true));

    const heroEl = document.querySelector('.hero');
    heroEl.addEventListener('mouseenter', () => { stopTimer(); pauseProgress(); });
    heroEl.addEventListener('mouseleave', () => { startProgress(); restartTimer(); });

    let touchStartX = 0;
    heroEl.addEventListener('touchstart', e => { touchStartX = e.changedTouches[0].clientX; }, { passive: true });
    heroEl.addEventListener('touchend', e => {
        const diff = touchStartX - e.changedTouches[0].clientX;
        if (Math.abs(diff) > 50) diff > 0 ? goTo(current + 1, true) : goTo(current - 1, true);
    }, { passive: true });

    document.addEventListener('keydown', e => {
        if (e.key === 'ArrowLeft')  goTo(current - 1, true);
        if (e.key === 'ArrowRight') goTo(current + 1, true);
    });

    goTo(0);
    startTimer();
})();

// ===== NEWS SLIDESHOW =====
function initNewsSlideshow() {
    document.querySelectorAll('[data-slideshow]').forEach(slideshow => {
        const slides = slideshow.querySelectorAll('.news-slide');
        const dots   = slideshow.querySelectorAll('.dot');
        let current  = 0, interval;

        function showSlide(index) {
            slides.forEach(s => s.classList.remove('active'));
            dots.forEach(d => d.classList.remove('active'));
            current = ((index % slides.length) + slides.length) % slides.length;
            slides[current].classList.add('active');
            if (dots[current]) dots[current].classList.add('active');
        }

        function start() { interval = setInterval(() => showSlide(current + 1), 3000); }
        function stop()  { clearInterval(interval); }

        dots.forEach((dot, i) => {
            dot.addEventListener('click', e => { e.preventDefault(); stop(); showSlide(i); start(); });
        });

        slideshow.addEventListener('mouseenter', stop);
        slideshow.addEventListener('mouseleave', start);

        if (slides.length > 1) start();
    });
}
document.addEventListener('DOMContentLoaded', initNewsSlideshow);

// ===== INSTAGRAM FEED — hide placeholder when real image loads =====
document.querySelectorAll('.ig-item img').forEach(img => {
    if (img.complete && img.naturalWidth > 0) {
        const placeholder = img.nextElementSibling;
        if (placeholder && placeholder.classList.contains('ig-placeholder')) {
            placeholder.style.display = 'none';
        }
    } else {
        img.addEventListener('load', function () {
            const placeholder = this.nextElementSibling;
            if (placeholder && placeholder.classList.contains('ig-placeholder')) {
                placeholder.style.display = 'none';
            }
        });
    }
});

// ===== CUACA REAL-TIME (compact bar) =====
(function () {
    const LAT = -7.9408, LON = 110.5993, TZ = 'Asia%2FJakarta';

    const WMO = {
        0:{e:'☀️',d:'Cerah'}, 1:{e:'🌤️',d:'Umumnya Cerah'}, 2:{e:'⛅',d:'Berawan Sebagian'},
        3:{e:'☁️',d:'Berawan'}, 45:{e:'🌫️',d:'Berkabut'}, 48:{e:'🌫️',d:'Kabut Beku'},
        51:{e:'🌦️',d:'Gerimis Ringan'}, 53:{e:'🌦️',d:'Gerimis Sedang'}, 55:{e:'🌧️',d:'Gerimis Lebat'},
        61:{e:'🌧️',d:'Hujan Ringan'}, 63:{e:'🌧️',d:'Hujan Sedang'}, 65:{e:'🌧️',d:'Hujan Lebat'},
        80:{e:'🌦️',d:'Hujan Lokal'}, 81:{e:'🌧️',d:'Hujan Lokal Sedang'}, 82:{e:'⛈️',d:'Hujan Lokal Lebat'},
        95:{e:'⛈️',d:'Hujan Petir'}, 96:{e:'⛈️',d:'Petir + Es'}, 99:{e:'⛈️',d:'Petir + Es Besar'},
    };
    const HARI = ['Min','Sen','Sel','Rab','Kam','Jum','Sab'];
    function wmo(c) { return WMO[c] || {e:'🌡️',d:'—'}; }

    const API =
        'https://api.open-meteo.com/v1/forecast' +
        '?latitude=' + LAT + '&longitude=' + LON +
        '&current=temperature_2m,relative_humidity_2m,weather_code,wind_speed_10m,precipitation' +
        '&daily=weather_code,temperature_2m_max,temperature_2m_min,precipitation_probability_max' +
        '&timezone=' + TZ + '&forecast_days=7';

    const $icon = document.getElementById('wxIcon');
    const $temp = document.getElementById('wxTemp');
    const $desc = document.getElementById('wxDesc');
    const $hum  = document.getElementById('wxHum');
    const $wnd  = document.getElementById('wxWnd');
    const $prcp = document.getElementById('wxPrcp');
    const $days = document.getElementById('wxDays');
    const $btn  = document.getElementById('wxRefresh');

    async function load() {
        $btn.classList.add('spinning');
        try {
            const r = await fetch(API);
            if (!r.ok) throw new Error(r.status);
            const d = await r.json();
            const c = d.current, dl = d.daily;
            const w = wmo(c.weather_code);

            $icon.textContent = w.e;
            $temp.textContent = Math.round(c.temperature_2m) + '°C';
            $desc.textContent = w.d;
            $hum.textContent  = '💧 ' + c.relative_humidity_2m + '%';
            $wnd.textContent  = '💨 ' + Math.round(c.wind_speed_10m) + ' km/h';
            $prcp.textContent = '☔ ' + c.precipitation + ' mm';

            $days.innerHTML = '';
            dl.time.forEach((dt, i) => {
                const isToday = i === 0;
                const day = new Date(dt + 'T00:00:00');
                const dw  = wmo(dl.weather_code[i]);
                const hi  = Math.round(dl.temperature_2m_max[i]);
                const lo  = Math.round(dl.temperature_2m_min[i]);
                const pil = document.createElement('div');
                pil.className = 'wx-bar-day' + (isToday ? ' wx-today-pill' : '');
                pil.title = dw.d + ' · Hujan: ' + (dl.precipitation_probability_max[i] ?? 0) + '%';
                pil.innerHTML =
                    '<span class="wx-bar-day-name">' + (isToday ? 'Hari ini' : HARI[day.getDay()]) + '</span>' +
                    '<span class="wx-bar-day-icon">'  + dw.e + '</span>' +
                    '<span class="wx-bar-day-temps">' + hi + '° <span class="wx-bar-day-lo">/ ' + lo + '°</span></span>';
                $days.appendChild(pil);
            });
        } catch(e) {
            $icon.textContent = '⚠️';
            $temp.textContent = '--';
            $desc.textContent = 'Gagal memuat';
        } finally {
            $btn.classList.remove('spinning');
        }
    }

    $btn.addEventListener('click', load);
    load();
    setInterval(load, 10 * 60 * 1000); // refresh tiap 10 menit
})();

// ===== SCROLL ANIMATION =====
const observer = new IntersectionObserver(entries => {
    entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); });
}, { threshold: 0.12, rootMargin: '0px 0px -80px 0px' });

document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));

// Smooth anchor scroll
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) target.scrollIntoView({ behavior: 'smooth', block: 'start' });
    });
});
</script>
@endpush