<?php

namespace Database\Seeders;

use App\Models\Subkategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubkategoriSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    //
    $subkategoriData = [
      [
        'id_kategori' => 1,
        'name' => 'DATA TERPADU KESEJAHTERAAN SOSIAL (DTKS)',
      ],
      [
        'id_kategori' => 1,
        'name' => 'REKOMENDASI KARTU INDONESIA PINTAR (KIP)',
      ],
      [
        'id_kategori' => 1,
        'name' => 'REKOMENDASI REAKTIVASI KARTU INDONESIA SEHAT (KIS)',
      ],
      [
        'id_kategori' => 1,
        'name' => 'REKOMENDASI ADOPSI ANAK',
      ],
      [
        'id_kategori' => 1,
        'name' => 'PENDIRIAN PANTI LKS/LKSA',
      ],
      [
        'id_kategori' => 1,
        'name' => 'PERPANJANGAN STD PANTI LKS/LKSA/LKSLU',
      ],
      [
        'id_kategori' => 1,
        'name' => 'PEMBINAAN LKS/LKSA/LKSLU',
      ],
      [
        'id_kategori' => 1,
        'name' => 'REKOMENDASI BANTUAN SATU ORANG SATU HARI (SOSH)',
      ],
      [
        'id_kategori' => 1,
        'name' => 'REKOMENDASI KERINGANAN BIAYA PAJAK KENDARAAN BERMOTOR YANG DIGUNAKAN UNTUK KEGIATAN SOSIAL',
      ],
      [
        'id_kategori' => 1,
        'name' => 'FASILITASI BANTUAN HUKUM UNTUK MASYARAKAT MISKIN YANG BERMASALAH DENGAN HUKUM',
      ],
      [
        'id_kategori' => 1,
        'name' => 'REKOMENDASI AKREDITASI LKS/LKSA/LKSLU',
      ],
      [
        'id_kategori' => 2,
        'name' => 'FASILITASI BANTUAN SOSIAL PENANGGULANGAN PROGRAM KEMISKINAN (PKH)',
      ],
      [
        'id_kategori' => 2,
        'name' => 'FASILITASI BANTUAN SOSIAL PENANGGULANGAN PROGRAM KEMISKINAN (PROGRAM SEMBAKO)',
      ],
      [
        'id_kategori' => 2,
        'name' => 'BANTUAN SOSIAL PERAWATAN DI RUMAH SAKIT',
      ],
      [
        'id_kategori' => 2,
        'name' => 'LAYANAN BANTUAN SOSIAL RTLH WILAYAH KELURAHAN',
      ],
      [
        'id_kategori' => 2,
        'name' => 'LAYANAN ALAT BANTU DISABILITAS',
      ],
      [
        'id_kategori' => 2,
        'name' => 'PENINGKATAN KETERAMPILAN KEPADA PENYANDANG DISABILITAS',
      ],
      [
        'id_kategori' => 2,
        'name' => 'LAYANAN KEPADA ORANG TERLANTAR',
      ],
      [
        'id_kategori' => 2,
        'name' => 'REKOMENDASI LAYANAN LANSIA TERLANTAR',
      ],
      [
        'id_kategori' => 2,
        'name' => 'REKOMENDASI KE PANTI REHABILIATSI UNTUK PENYANDANG DISABILITAS',
      ],
      [
        'id_kategori' => 2,
        'name' => 'LAYANAN KELOMPOK RENTAN KESEJAHTERAAN SOSIAL',
      ],
      [
        'id_kategori' => 2,
        'name' => 'REKOMENDASI ANAK TERLANTAR',
      ],
      [
        'id_kategori' => 2,
        'name' => 'REKOMENDASI PENDAMPINGAN ANAK DENGAN HUKUM',
      ],
      [
        'id_kategori' => 2,
        'name' => 'REKOMENDASI ANAK KORBAN TINDAKAN KEKERASAN',
      ],
    ];

    foreach ($subkategoriData as $data) {
      Subkategori::create($data);
    }
  }
}
