<?php

namespace App\Http\Controllers;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = [
            'nama_instansi' => 'POLRES GUNUNGKIDUL',
            'kapolres' => 'AKBP DAMUS ASA, S.H., S.I.K., M.H.',
            'alamat' => 'Jl. Bhayangkara No.1, Wonosari, Gunungkidul',
            'telepon' => '0851-3375-0875',
            'email' => 'polresgunungkidul@polri.go.id',
            'jam_pelayanan' => '24 Jam',

            'visi' => 'Polres Gunungkidul bertekad mewujudkan postur Polri yang profesional, bermoral dan modern sebagai pelindung, pengayom dan pelayan masyarakat, yang terpercaya dalam memelihara kamtibmas dan menegakkan hukum di wilayah Gunungkidul sebagai Kota Pariwisata dalam suatu kehidupan sosial yang demokratis, berbudaya serta masyarakat yang sejahtera.',

            'misi' => [
                 'Memberikan perlindungan, pengayoman, dan pelayanan kepada seluruh masyarakat sehingga bebas dari gangguan fisik maupun psikis.',
                 'Memberikan bimbingan preventif kepada masyarakat untuk meningkatkan kesadaran dan kepatuhan hukum.',
                 'Menegakkan hukum secara profesional dan proporsional dengan menjunjung tinggi supremasi hukum dan Hak Asasi Manusia.',
                 'Memelihara keamanan dan ketertiban masyarakat dengan memperhatikan norma dan nilai yang berlaku di Gunungkidul.',
                 'Mengelola sumber daya personel secara profesional untuk mewujudkan keamanan wilayah dan kesejahteraan masyarakat.',
                 'Meningkatkan konsolidasi internal untuk menyamakan visi dan misi Polri sesuai harapan masyarakat.',
                 'Memelihara soliditas kesatuan Polres Gunungkidul dari pengaruh luar yang dapat merugikan organisasi.',
                 'Melaksanakan kebijakan Kapolda D.I. Yogyakarta dalam pelaksanaan tugas secara nyata dan terukur.',
                 'Meningkatkan kesadaran hukum dan berbangsa, mengingat Gunungkidul memiliki karakteristik wilayah yang khas.'
            ],

            'sejarah' => 'Polres Gunungkidul merupakan institusi kepolisian yang bertugas menjaga keamanan dan ketertiban masyarakat serta memberikan pelayanan hukum kepada masyarakat.',

            'statistik' => [
                'personel' => 350,
                'kasus_selesai' => 1240,
                'layanan_online' => 12,
                'pengaduan_masuk' => 540
            ]
        ];

        // TAMBAHKAN INI (tanpa ubah struktur profile)
        $contact = [
            'address' => $profile['alamat'],
            'city' => 'Gunungkidul',
            'email' => $profile['email'],
            'phone' => $profile['telepon'],
            'hotline' => '110 (Darurat)',
            'hours' => $profile['jam_pelayanan']
        ];

        $aboutLinks = [
            [
                'name' => 'Profil',
                'url' => route('profile')
            ],
            [
                'name' => 'Informasi Pelayanan',
                'url' => route('information')
            ],
            [
                'name' => 'Tribratanews',
                'url' => route('news')
            ],
        ];

        return view('profile.index', compact('profile', 'contact', 'aboutLinks'));
    }
}