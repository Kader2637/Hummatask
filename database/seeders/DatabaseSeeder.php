<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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

        DB::table('status_tims')->insert([
            [
                'status' => 'solo'
            ],
            [
                'status' => 'pre_mini'
            ],
            [
                'status' => 'mini'
            ],
            [
                'status' => 'big'
            ]
        ]);

        

        DB::table('users')->insert([
            [
                'uuid' => Str::uuid(),
                'username' => 'mentor',
                'email' => 'mentor@gmail.com',
                'password' => Hash::make('password'),
                'peran_id' => 2,
                'deskripsi' => 'none',
            ]
        ]);

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'kelola siswa']);

        $role = Role::create(['name' => 'ketua magang']);
        $role->givePermissionTo('kelola siswa');
        User::create(
            [
                'uuid' => Str::uuid(),
                'username' => 'Adi Kurniawan',
                'email' => 'kurniawan@gmail.com',
                'password' => Hash::make('password'),
                'peran_id' => 1,
                'tlp' => "845889288",
                'sekolah' => "SMKN 1 Banyuwangi",
                'deskripsi' => 'none',
            ]
        )->assignRole($role);

        DB::table('jabatans')->insert([
            [
                'code' => Str::uuid(),
                'nama_jabatan' => 'Ketua Kelompok'
            ],
            [
                'code' => Str::uuid(),
                'nama_jabatan' => 'Ketua Project'
            ],
            [
                'code' => Str::uuid(),
                'nama_jabatan' => 'Anggota'
            ],
        ]);


    }
}
