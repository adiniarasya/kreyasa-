<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. User admin — aman di-run berkali-kali
        User::updateOrCreate(
            ['email' => 'admin@kreyasa.id'],
            [
                'name' => 'Admin KREYASA',
                'password' => Hash::make('kreyasa123'),
                'role' => 'admin',
            ]
        );

        // 2. Produk — matikan FK dulu biar truncate aman
        Schema::disableForeignKeyConstraints();
        Product::truncate();
        Schema::enableForeignKeyConstraints();

        Product::insert([
            [
                'name' => 'Paket Modul Ajar Interaktif',
                'category' => 'Design Pendidikan',
                'description' => 'Modul ajar interaktif untuk guru & sekolah.',
                'price' => 500000,
                'dp_percent' => 50,
                'badge' => 'Ready',
                'image' => 'https://via.placeholder.com/400x300/0F0F2D/8B5CF6?text=Design+Pendidikan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Desain Branding Lengkap',
                'category' => 'Custom Design',
                'description' => 'Paket branding lengkap: logo, kop surat, kartu nama.',
                'price' => 1500000,
                'dp_percent' => 50,
                'badge' => 'Custom',
                'image' => 'https://via.placeholder.com/400x300/0F0F2D/6C3CE1?text=Custom+Design',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'App Ready Multifungsi',
                'category' => 'Aplikasi Mobile',
                'description' => 'Aplikasi mobile siap pakai Android & iOS.',
                'price' => 3000000,
                'dp_percent' => 30,
                'badge' => 'Ready',
                'image' => 'https://via.placeholder.com/400x300/0F0F2D/8B5CF6?text=App+Ready',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}