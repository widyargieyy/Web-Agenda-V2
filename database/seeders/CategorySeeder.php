<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Category::truncate();
        $datas = [
            [
                'name' => 'Rapat Koordinasi',
                'description' => 'Rapat koordinasi internal maupun lintas instansi',
            ],
            [
                'name' => 'Kunjungan Lapangan',
                'description' => 'Kegiatan kunjungan langsung ke lokasi proyek atau wilayah',
            ],
            [
                'name' => 'Survei Lapangan',
                'description' => 'Kegiatan survei teknis untuk pengumpulan data lapangan',
            ],
            [
                'name' => 'Monitoring & Evaluasi',
                'description' => 'Monitoring dan evaluasi kegiatan atau proyek infrastruktur',
            ],
            [
                'name' => 'Koordinasi OPD',
                'description' => 'Pertemuan koordinasi dengan Organisasi Perangkat Daerah',
            ],
            [
                'name' => 'Presentasi / Paparan',
                'description' => 'Kegiatan paparan perencanaan atau laporan kegiatan',
            ],
        ];

        foreach ($datas as $data) {
            Category::create($data);
        }
    }
}