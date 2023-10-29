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

        $peran_id_siswa = Str::uuid();
        $peran_id_mentor = Str::uuid();

        DB::table('perans')->insert([
            [
                'id' => $peran_id_siswa,
                'peran' => "siswa",
            ],
            [
                'id' => $peran_id_mentor,
                'peran' => "mentor",
            ],
        ]);


        DB::table('users')->insert([
            [
                'id' => Str::uuid(),
                'username' => 'Rafliansyah',
                'email' => 'Rafliansyah@gmail.com',
                'password' => Hash::make('password'),
                'peran_id' => $peran_id_siswa,
                'deskripsi' => 'none',
            ],
            [
                'id' => Str::uuid(),
                'username' => 'Saputra',
                'email' => 'Saputra@gmail.com',
                'password' => Hash::make('password'),
                'peran_id' => $peran_id_siswa,
                'deskripsi' => 'none',
            ],
            [
                'id' => Str::uuid(),
                'username' => 'Jefri',
                'email' => 'Jefri@gmail.com',
                'password' => Hash::make('password'),
                'peran_id' => $peran_id_siswa,
                'deskripsi' => 'none',
            ],
            [
                'id' => Str::uuid(),
                'username' => 'Yafy',
                'email' => 'Yafy@gmail.com',
                'password' => Hash::make('password'),
                'peran_id' => $peran_id_siswa,
                'deskripsi' => 'none',
            ],
            [
                'id' => Str::uuid(),
                'username' => 'Mas Jefri',
                'email' => 'mentor@gmail.com',
                'password' => Hash::make('password'),
                'peran_id' => $peran_id_mentor,
                'deskripsi' => 'none',
            ],
        ]);

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'kelola siswa']);

        $role = Role::create(['name' => 'ketua magang']);
        $role->givePermissionTo('kelola siswa');
        User::create(
            [
                'id' => Str::uuid(),
                'username' => 'Adi Kurniawan',
                'email' => 'kurniawan@gmail.com',
                'password' => Hash::make('password'),
                'peran_id' => $peran_id_siswa,
                'deskripsi' => 'none',
            ]
        )->assignRole($role);


        for ($i=0; $i <100 ; $i++) {
            # code...

        User::create(
            [
                'id' => Str::uuid(),
                'username' => fake()->name(),
                'email' => fake()->email(),
                'password' => Hash::make('password'),
                'peran_id' => $peran_id_siswa,
                'deskripsi' => 'none',
            ]);
        }


        // $role->givePermissionTo(Permission::all());
    }
}
