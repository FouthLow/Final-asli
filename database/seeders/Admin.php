<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Gallery;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Admin extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'Admin123@gmail.com',
            'password' => Hash::make('admin1234'),
        ]);

        $categories = ['kegiatan' , 'Fasilitas' , 'Prestasi' , 'Ekstrakurikuler'];
        foreach ($categories as $category) {
            Category::create([
                'nama' => $category,
                'slug' => Str::slug($category),
            ]);
        }
    }
}
