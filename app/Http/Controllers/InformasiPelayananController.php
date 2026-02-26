<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InformasiPelayananController extends Controller
{
    // Data bersama yang dipakai semua halaman
    private function sharedData(): array
    {
        return [
            'contact' => [
                'email' => 'ppidgunungkidul@gmail.com', 
                'phone' => '0851-3375-0875',
                'hotline' => '110 (Darurat)',
                'address' => 'Jln. MGR Sugiyopranoto No.15',
                'city' => 'Wonosari,Gunungkidul,Yogyakarta',
                'hours' => '24 Jam'
            ],
            'aboutLinks' => [
            ['name' => 'Profil',               'url' => route('profile')],
            ['name' => 'Informasi Pelayanan',  'url' => route('information')],
            ['name' => 'Tribratanews',         'url' => route('news')],
            ],
        ];
    }

    // Halaman index — 4 kartu layanan
    public function index()
    {
        return view('informasi-pelayanan.index', $this->sharedData());
    }

    // Halaman detail SKCK
    public function skck()
    {
        return view('informasi-pelayanan.skck', $this->sharedData());
    }

    // Halaman detail SIM
    public function sim()
    {
        return view('informasi-pelayanan.sim', $this->sharedData());
    }

    // Halaman detail Penerimaan Polri
    public function penerimaan()
    {
        return view('informasi-pelayanan.penerimaan', $this->sharedData());
    }

    // Halaman detail WBS
    public function wbs()
    {
        return view('informasi-pelayanan.wbs', $this->sharedData());
    }
}
