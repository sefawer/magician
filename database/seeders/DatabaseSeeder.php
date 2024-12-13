<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Product::create([
            'name' => 'HOMM LIFE RELUAN 50 ML ERKEK EDP PARFÜM',
            'code' => 5006,
            'price' => 764.4,
            'image_url' => 'https://hommcdn.com/upload/urunler/homm-life-reluan-50-ml-erkek-edp.jpg'
        ]);

        Product::create([
            'name' => 'HOMM LIFE GLİSERİNLİ ALOE VERA SABUNU',
            'code' => 1007,
            'price' => 250.9,
            'image_url' => 'https://hommcdn.com/upload/urunler/homm-life-gliserinli-aloe-vera-sabunu-0Cm0V.jpg'
        ]);

        Product::create([
            'name' => 'HOMM VITA SHAKE & DRINK DİYET YERİNE GEÇEN GIDA',
            'code' => 1525,
            'price' => 1033.5,
            'image_url' => 'https://hommcdn.com/upload/urunler/homm-vita-shake-drink-diyet-yerine-gecen-gida.jpeg?v=1685573973'
        ]);

        Product::create([
            'name' => 'BEŞİ BİR YERDE BEREKET KAMPANYASI',
            'code' => 2530,
            'price' => 1163.5,
            'image_url' => 'https://hommcdn.com/upload/urunler/1734091875Dz17u.jpeg'
        ]);
    }
}
