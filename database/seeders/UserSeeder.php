<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0; $i < 100 ; $i++) {

            DB::table('users')->insert([
                [
                    'uuid' => Str::uuid(),
                    'username' => fake()->name(),
                    'email' => fake()->email(),
                    'divisi_id' => '1',
                    'password' => Hash::make('password'),
                    'peran_id' => 1,
                    "tanggal_bergabung" => Carbon::now(),
                    "tanggal_lulus" => Carbon::now()->addDays(100)
                ]
            ]);

        }


    }
}
