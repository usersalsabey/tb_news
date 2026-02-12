<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the home page
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Vision & Mission
        $vision = 'Menjadi institusi kepolisian yang profesional, modern, dan terpercaya dalam melayani masyarakat dengan integritas tinggi dan komitmen penuh terhadap keamanan dan ketertiban umum di seluruh Indonesia.';
        
        $mission = 'Memberikan pelayanan terbaik kepada masyarakat, menegakkan hukum dengan adil, serta menciptakan lingkungan yang aman dan nyaman bagi seluruh warga negara melalui inovasi teknologi dan peningkatan kualitas SDM.';

        // News data
        $news = [
            [
                'icon' => '🚦',
                'date' => '10 Februari 2026',
                'title' => 'Operasi Ketertiban Lalu Lintas',
                'content' => 'Kepolisian mengadakan operasi gabungan untuk meningkatkan keselamatan dan ketertiban masyarakat di seluruh wilayah. Operasi ini melibatkan berbagai unit dengan teknologi modern.',
                'slug' => 'operasi-ketertiban-lalu-lintas',
                'images' => [
                    'images/news/traffic-1.jpg',
                    'images/news/traffic-2.jpg',
                    'images/news/traffic-3.jpg',
                ]
            ],
            [
                'icon' => '🆔',
                'date' => '08 Februari 2026',
                'title' => 'Pelayanan SIM Online',
                'content' => 'Kini masyarakat dapat memperpanjang SIM secara online melalui layanan resmi TB News. Proses cepat, mudah, dan tanpa antrian panjang. Daftar sekarang dan nikmati kemudahan layanan digital.',
                'slug' => 'pelayanan-sim-online',
                'images' => [
                    'images/news/sim-1.jpg',
                    'images/news/sim-2.jpg',
                ]
            ],
            [
                'icon' => '👮',
                'date' => '05 Februari 2026',
                'title' => 'Program Polisi Sahabat Anak',
                'content' => 'Inisiatif terbaru untuk mendekatkan diri dengan generasi muda dan memberikan edukasi keamanan sejak dini. Mari bersama membangun masa depan yang lebih aman untuk anak-anak Indonesia.',
                'slug' => 'program-polisi-sahabat-anak',
                'images' => [
                    'images/news/child-1.jpg',
                    'images/news/child-2.jpg',
                    'images/news/child-3.jpg',
                    'images/news/child-4.jpg',
                ]
            ]
        ];

        // Social Media
        $socialMedia = [
            [
                'icon' => '📷',
                'name' => 'Instagram',
                'handle' => '@tbnews_official',
                'url' => 'https://instagram.com/tbnews_official'
            ],
            [
                'icon' => '👍',
                'name' => 'Facebook',
                'handle' => 'TB News Official',
                'url' => 'https://facebook.com/tbnewsofficial'
            ],
            [
                'icon' => '▶️',
                'name' => 'YouTube',
                'handle' => 'TB News Channel',
                'url' => 'https://youtube.com/@tbnewschannel'
            ],
            [
                'icon' => '🐦',
                'name' => 'Twitter',
                'handle' => '@TBNewsPolri',
                'url' => 'https://twitter.com/tbnewspolri'
            ]
        ];

        // Contact Information
        $contact = [
            'email' => 'info@tbnews.com',
            'phone' => '0812-3456-7890',
            'hotline' => '110 (Darurat)',
            'whatsapp' => '0812-3456-7890',
            'address' => 'Jl. Kepolisian No. 123',
            'city' => 'Jakarta Pusat, DKI Jakarta',
            'country' => 'Indonesia 10110',
            'hours' => 'Senin - Jumat: 08.00 - 17.00 WIB'
        ];

        // Services
        $services = [
            [
                'icon' => '📋',
                'name' => 'Laporan Online',
                'url' => route('services.report')
            ],
            [
                'icon' => '🆔',
                'name' => 'Perpanjangan SIM',
                'url' => route('services.sim')
            ],
            [
                'icon' => '📄',
                'name' => 'SKCK Online',
                'url' => route('services.skck')
            ],
            [
                'icon' => '🚨',
                'name' => 'Pengaduan Masyarakat',
                'url' => route('services.complaint')
            ]
        ];

        // About Links
        $aboutLinks = [
            ['name' => 'Profil Lembaga', 'url' => route('about.profile')],
            ['name' => 'Struktur Organisasi', 'url' => route('about.structure')],
            ['name' => 'Kebijakan Privasi', 'url' => route('about.privacy')],
            ['name' => 'Syarat & Ketentuan', 'url' => route('about.terms')]
        ];

        return view('home', compact(
            'vision',
            'mission',
            'news',
            'socialMedia',
            'contact',
            'services',
            'aboutLinks'
        ));
    }
}