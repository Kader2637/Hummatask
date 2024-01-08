<?php

namespace Database\Seeders;

use App\Models\Divisi;
use App\Models\User;
use Carbon\Carbon;
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

        $divisi_id = Divisi::query()
            ->create(['name' => 'mobile']);

        $divisi_id = Divisi::query()
            ->create(['name' => 'web']);

        $divisi_id = Divisi::query()
            ->create(['name' => 'ui/ux']);

        $divisi_id = Divisi::query()
            ->create(['name' => 'marketing_digital']);

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
                'username' => 'Mentor Mobile',
                'email' => 'mentormob@gmail.com',
                'divisi_id' => 1,
                'password' => Hash::make('password'),
                'peran_id' => 2,
            ]
        ]);

        DB::table('users')->insert([
            [
                'uuid' => Str::uuid(),
                'username' => 'Mentor Web',
                'email' => 'mentorweb@gmail.com',
                'divisi_id' => 2,
                'password' => Hash::make('password'),
                'peran_id' => 2,
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
                'divisi_id' => 1,
                'tlp' => "0845889288",
                'sekolah' => "SMKN 1 Banyuwangi",
                "tanggal_bergabung" => Carbon::now(),
                "tanggal_lulus" => Carbon::now()->addDays(100)
            ]
        )->assignRole($role);

        User::create(
            [
                'uuid' => Str::uuid(),
                'username' => 'Yafy Habibi Ramadhani',
                'email' => 'yafyhabibi@gmail.com',
                'password' => Hash::make('password'),
                'peran_id' => 1,
                'divisi_id' => 1,
                'tlp' => "08731859817",
                'sekolah' => "SMKN 1 Probolinggo",
                "tanggal_bergabung" => Carbon::now(),
                "tanggal_lulus" => Carbon::now()->addDays(100)
            ]
        )->assignRole($role);

        User::create(
            [
                'uuid' => Str::uuid(),
                'username' => 'Andika Riztanta Previan',
                'email' => 'VianRiztanta71@gmail.com',
                'password' => Hash::make('password'),
                'peran_id' => 1,
                'divisi_id' => 2,
                'tlp' => "08731859817",
                'sekolah' => "SMKN 1 Probolinggo",
                "tanggal_bergabung" => Carbon::now(),
                "tanggal_lulus" => Carbon::now()->addDays(100)
            ]
        )->assignRole($role);

        User::create(
            [
                'uuid' => Str::uuid(),
                'username' => 'Andi Rizki',
                'email' => 'bababboi@gmail.com',
                'password' => Hash::make('password'),
                'peran_id' => 1,
                'divisi_id' => 2,
                'tlp' => "08731859817",
                'sekolah' => "SMKN 1 Probolinggo",
                "tanggal_bergabung" => Carbon::now(),
                "tanggal_lulus" => Carbon::now()->addDays(100)
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
