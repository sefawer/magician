<?php

namespace Database\Seeders;

use App\Models\Campaign;
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

        Campaign::create([
            'name' => 'Hoşgeldin Ocak',
            'month' => 1,
            'products' => '4',
            'min_order_cost' => 999.9
        ]);

        Campaign::create([
            'name' => 'Hoşgeldin Şubat',
            'month' => 2,
            'products' => '3',
            'min_order_cost' => 999.9
        ]);

        Campaign::create([
            'name' => 'Hoşgeldin Mart',
            'month' => 3,
            'products' => '2',
            'min_order_cost' => 1999.9
        ]);

        Campaign::create([
            'name' => 'Hoşgeldin Nisan',
            'month' => 4,
            'products' => '4',
            'min_order_cost' => 999.9
        ]);

        Campaign::create([
            'name' => 'Hoşgeldin Mayıs',
            'month' => 5,
            'products' => '4',
            'min_order_cost' => 999.9
        ]);

        Campaign::create([
            'name' => 'Hoşgeldin Haziran',
            'month' => 6,
            'products' => '4',
            'min_order_cost' => 999.9
        ]);

        Campaign::create([
            'name' => 'Hoşgeldin Temmuz',
            'month' => 7,
            'products' => '4',
            'min_order_cost' => 999.9
        ]);

        Campaign::create([
            'name' => 'Hoşgeldin Ağustos',
            'month' => 8,
            'products' => '4',
            'min_order_cost' => 999.9
        ]);

        Campaign::create([
            'name' => 'Hoşgeldin Eylül',
            'month' => 9,
            'products' => '4',
            'min_order_cost' => 999.9
        ]);

        Campaign::create([
            'name' => 'Hoşgeldin Ekim',
            'month' => 10,
            'products' => '4',
            'min_order_cost' => 999.9
        ]);

        Campaign::create([
            'name' => 'Hoşgeldin Kasım',
            'month' => 11,
            'products' => '4',
            'min_order_cost' => 999.9
        ]);

        Campaign::create([
            'name' => 'Hoşgeldin Aralık',
            'month' => 12,
            'products' => '4,3',
            'min_order_cost' => 3999.9
        ]);
    }
}
