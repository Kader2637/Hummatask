<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('perans')->insert([
            [
                'uuid' => Str::uuid(),
                'peran' => "siswa",
            ],
            [
                'uuid' => Str::uuid(),
                'peran' => "mentor",
            ],
        ]);

        DB::table('users')->insert([
            [
                'uuid' => Str::uuid(),
                'username' => 'Rafliansyah',
                'email' => 'Rafliansyah@gmail.com',
                'password' => Hash::make('password'),
                'peran_id' => 1,
                'deskripsi' => 'none',
            ],
            [
                'uuid' => Str::uuid(),
                'username' => 'Adi Kurniawan',
                'email' => 'Kurniawan@gmail.com',
                'password' => Hash::make('password'),
                'peran_id' => 1,
                'deskripsi' => 'none',
            ],
            [
                'uuid' => Str::uuid(),
                'username' => 'Saputra',
                'email' => 'Saputra@gmail.com',
                'password' => Hash::make('password'),
                'peran_id' => 1,
                'deskripsi' => 'none',
            ],
            [
                'uuid' => Str::uuid(),
                'username' => 'Jefri',
                'email' => 'Jefri@gmail.com',
                'password' => Hash::make('password'),
                'peran_id' => 1,
                'deskripsi' => 'none',
            ],
            [
                'uuid' => Str::uuid(),
                'username' => 'Yafy',
                'email' => 'Yafy@gmail.com',
                'password' => Hash::make('password'),
                'peran_id' => 1,
                'deskripsi' => 'none',
            ],
            [
                'uuid' => Str::uuid(),
                'username' => 'Mas Jefri',
                'email' => 'mentor@gmail.com',
                'password' => Hash::make('password'),
                'peran_id' => 2,
                'deskripsi' => 'none',
            ],
        ]);
    }
}
