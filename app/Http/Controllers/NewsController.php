<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Data berita statis — nanti ganti dengan query dari DB:
     * use App\Models\News;
     * $news = News::published()->latest()->get();
     */
    private function getAllNews(): array
    {
        return [
            [
                'slug'     => 'operasi-ketertiban-lalu-lintas',
                'title'    => 'Operasi Ketertiban Lalu Lintas Gabungan',
                'excerpt'  => 'Kepolisian mengadakan operasi gabungan untuk meningkatkan keselamatan dan ketertiban masyarakat di seluruh wilayah Gunungkidul.',
                'content'  => 'Kepolisian Resort Gunungkidul mengadakan operasi gabungan yang melibatkan berbagai unit untuk meningkatkan keselamatan dan ketertiban masyarakat di seluruh wilayah. Operasi ini menggunakan teknologi modern dan melibatkan ratusan personel yang tersebar di titik-titik strategis.',
                'date'     => '10 Februari 2026',
                'category' => 'lalu_lintas',
                'icon'     => '🚦',
                'images'   => ['images/news/traffic-1.jpg', 'images/news/traffic-2.jpg'],
                'source'   => 'Humas Polres Gunungkidul',
            ],
            [
                'slug'     => 'pelayanan-sim-online',
                'title'    => 'Pelayanan SIM Online Kini Lebih Mudah',
                'excerpt'  => 'Kini masyarakat dapat memperpanjang SIM secara online melalui layanan resmi Digital Korlantas Polri tanpa antrian panjang.',
                'content'  => 'Polres Gunungkidul terus berinovasi dalam pelayanan publik. Kini masyarakat dapat memperpanjang SIM secara online melalui aplikasi Digital Korlantas Polri. Prosesnya cepat, mudah, dan SIM akan dikirimkan langsung ke alamat rumah.',
                'date'     => '08 Februari 2026',
                'category' => 'pelayanan',
                'icon'     => '🆔',
                'images'   => ['images/news/sim-1.jpg'],
                'source'   => 'Satlantas Polres Gunungkidul',
            ],
            [
                'slug'     => 'program-polisi-sahabat-anak',
                'title'    => 'Program Polisi Sahabat Anak Hadir di Gunungkidul',
                'excerpt'  => 'Inisiatif terbaru untuk mendekatkan diri dengan generasi muda dan memberikan edukasi keamanan sejak dini.',
                'content'  => 'Polres Gunungkidul meluncurkan Program Polisi Sahabat Anak sebagai inisiatif untuk mendekatkan diri dengan generasi muda. Program ini memberikan edukasi keamanan, bahaya narkoba, dan pentingnya tertib berlalu lintas sejak usia dini.',
                'date'     => '05 Februari 2026',
                'category' => 'sosial',
                'icon'     => '👮',
                'images'   => ['images/news/child-1.jpg', 'images/news/child-2.jpg'],
                'source'   => 'Bhabinkamtibmas Polres Gunungkidul',
            ],
            [
                'slug'     => 'bakti-sosial-polres-gunungkidul',
                'title'    => 'Bakti Sosial Polres Gunungkidul untuk Warga Kurang Mampu',
                'excerpt'  => 'Polres Gunungkidul menggelar bakti sosial pembagian sembako dan layanan kesehatan gratis bagi warga yang membutuhkan.',
                'content'  => 'Dalam rangka meningkatkan kedekatan dengan masyarakat, Polres Gunungkidul menggelar bakti sosial berupa pembagian sembako dan layanan kesehatan gratis. Kegiatan ini diikuti ratusan warga dari berbagai kecamatan.',
                'date'     => '02 Februari 2026',
                'category' => 'sosial',
                'icon'     => '🤝',
                'images'   => [],
                'source'   => 'Humas Polres Gunungkidul',
            ],
            [
                'slug'     => 'patroli-malam-kamtibmas',
                'title'    => 'Patroli Malam Rutin Jaga Keamanan Wilayah',
                'excerpt'  => 'Unit Samapta Polres Gunungkidul rutin melaksanakan patroli malam untuk memastikan keamanan di seluruh wilayah.',
                'content'  => 'Unit Samapta Bhayangkara Polres Gunungkidul secara konsisten melaksanakan patroli malam di seluruh wilayah hukum. Patroli ini bertujuan untuk memberikan rasa aman kepada masyarakat dan mencegah tindak kejahatan.',
                'date'     => '28 Januari 2026',
                'category' => 'umum',
                'icon'     => '🚓',
                'images'   => [],
                'source'   => 'Sat Samapta Polres Gunungkidul',
            ],
            [
                'slug'     => 'sosialisasi-narkoba-di-sekolah',
                'title'    => 'Sosialisasi Bahaya Narkoba di SMA se-Gunungkidul',
                'excerpt'  => 'Satuan Narkoba Polres Gunungkidul menggelar sosialisasi bahaya narkoba kepada pelajar di berbagai sekolah menengah atas.',
                'content'  => 'Satnarkoba Polres Gunungkidul aktif melakukan sosialisasi bahaya penyalahgunaan narkoba kepada pelajar SMA. Kegiatan ini melibatkan lebih dari 500 siswa dari 10 sekolah di seluruh wilayah Gunungkidul.',
                'date'     => '25 Januari 2026',
                'category' => 'sosial',
                'icon'     => '📢',
                'images'   => [],
                'source'   => 'Satnarkoba Polres Gunungkidul',
            ],
            [
                'slug'     => 'penangkapan-pelaku-curanmor',
                'title'    => 'Polres Gunungkidul Berhasil Tangkap Pelaku Curanmor',
                'excerpt'  => 'Tim Reskrim Polres Gunungkidul berhasil mengungkap jaringan pencurian kendaraan bermotor di tiga kecamatan.',
                'content'  => 'Tim Reserse Kriminal Polres Gunungkidul berhasil mengungkap jaringan pencurian kendaraan bermotor yang telah beroperasi di tiga kecamatan selama beberapa bulan. Dua orang tersangka berhasil diamankan beserta barang bukti.',
                'date'     => '20 Januari 2026',
                'category' => 'kriminal',
                'icon'     => '🔒',
                'images'   => [],
                'source'   => 'Satreskrim Polres Gunungkidul',
            ],
            [
                'slug'     => 'skck-online-gunungkidul',
                'title'    => 'Layanan SKCK Online Semakin Cepat dan Mudah',
                'excerpt'  => 'Polres Gunungkidul terus berinovasi dalam pelayanan SKCK online agar masyarakat tidak perlu antri lama.',
                'content'  => 'Polres Gunungkidul terus meningkatkan inovasi layanan publik, khususnya SKCK Online. Kini prosesnya lebih cepat dengan verifikasi digital dan masyarakat cukup datang untuk pengambilan dokumen final.',
                'date'     => '15 Januari 2026',
                'category' => 'pelayanan',
                'icon'     => '📋',
                'images'   => [],
                'source'   => 'SPKT Polres Gunungkidul',
            ],
            [
                'slug'     => 'apel-perdana-tahun-2026',
                'title'    => 'Apel Perdana 2026: Polres Siap Tingkatkan Profesionalisme',
                'excerpt'  => 'Kapolres memimpin apel perdana 2026 dan menegaskan komitmen personel untuk meningkatkan kualitas pelayanan.',
                'content'  => 'Kapolres Gunungkidul memimpin apel perdana tahun 2026 yang diikuti seluruh personel. Dalam arahannya, Kapolres menegaskan komitmen untuk meningkatkan profesionalisme dan kualitas pelayanan kepada masyarakat.',
                'date'     => '02 Januari 2026',
                'category' => 'umum',
                'icon'     => '🏋️',
                'images'   => [],
                'source'   => 'Humas Polres Gunungkidul',
            ],
            [
                'slug'     => 'pengamanan-nataru-2025',
                'title'    => 'Pengamanan Natal dan Tahun Baru 2025 Berjalan Aman',
                'excerpt'  => 'Seluruh personel Polres Gunungkidul berhasil mengamankan perayaan Natal dan Tahun Baru dengan zero insiden.',
                'content'  => 'Operasi Lilin Progo 2025 yang digelar Polres Gunungkidul berjalan sukses. Seluruh rangkaian perayaan Natal dan Tahun Baru berlangsung aman dan tertib berkat pengamanan ketat dari ratusan personel yang disiagakan.',
                'date'     => '01 Januari 2026',
                'category' => 'umum',
                'icon'     => '🛡️',
                'images'   => [],
                'source'   => 'Humas Polres Gunungkidul',
            ],
            [
                'slug'     => 'tilang-elektronik-mulai-berlaku',
                'title'    => 'Tilang Elektronik (ETLE) Mulai Berlaku di Gunungkidul',
                'excerpt'  => 'Polres Gunungkidul resmi mengoperasikan sistem tilang elektronik untuk meningkatkan kepatuhan berlalu lintas.',
                'content'  => 'Polres Gunungkidul resmi mengaktifkan sistem Electronic Traffic Law Enforcement (ETLE) di beberapa titik strategis. Sistem ini secara otomatis merekam pelanggaran lalu lintas dan mengirimkan surat tilang ke alamat kendaraan.',
                'date'     => '20 Desember 2025',
                'category' => 'lalu_lintas',
                'icon'     => '📷',
                'images'   => [],
                'source'   => 'Satlantas Polres Gunungkidul',
            ],
            [
                'slug'     => 'donor-darah-polres-gunungkidul',
                'title'    => 'Donor Darah Massal: Polres Sumbang 150 Kantong Darah',
                'excerpt'  => 'Polres Gunungkidul menggelar donor darah massal yang diikuti 200 personel dan masyarakat umum.',
                'content'  => 'Dalam rangka HUT Bhayangkara ke-79, Polres Gunungkidul menyelenggarakan kegiatan donor darah massal yang berhasil mengumpulkan 150 kantong darah. Kegiatan ini melibatkan personel Polri, keluarga besar, dan masyarakat umum.',
                'date'     => '10 Desember 2025',
                'category' => 'sosial',
                'icon'     => '💉',
                'images'   => [],
                'source'   => 'Biddokkes Polres Gunungkidul',
            ],
        ];
    }

    // ─── GET /news ───────────────────────────────────────────────────────────
    public function index(): \Illuminate\View\View
    {
        $news = $this->getAllNews();

        // Ambil kategori unik untuk filter tab
        $categories = collect($news)
            ->pluck('category')
            ->unique()
            ->values()
            ->toArray();

        return view('news.index', compact('news', 'categories'));
    }

    // ─── GET /news/{slug} ────────────────────────────────────────────────────
    public function show(string $slug): \Illuminate\View\View
    {
        $allNews = $this->getAllNews();

        // Cari berita berdasarkan slug
        $news = collect($allNews)->firstWhere('slug', $slug);

        if (!$news) {
            abort(404, 'Berita tidak ditemukan.');
        }

        // Berita terkait (kategori sama, exclude yang sedang dibuka)
        $related = collect($allNews)
            ->where('category', $news['category'])
            ->where('slug', '!=', $slug)
            ->take(3)
            ->values()
            ->toArray();

        return view('news.show', compact('news', 'related'));
    }
}