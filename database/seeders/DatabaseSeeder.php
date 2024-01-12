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
                'divisi_id' => $divisi_id->id,
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
                'divisi_id' => $divisi_id->id,
                'tlp' => "0845889288",
                'sekolah' => "SMKN 1 Banyuwangi",
                "tanggal_bergabung" => Carbon::now(),
                "tanggal_lulus" => Carbon::now()->addDays(100)
            ]
        )->assignRole($role);
        User::create(
            [
                'uuid' => Str::uuid(),
                'username' => 'Andi Rizki Ramadhani',
                'email' => 'andirizki1305@gmail.com',
                'password' => Hash::make('password'),
                'peran_id' => 1,
                'divisi_id' => $divisi_id->id,
                'tlp' => "0845889288",
                'sekolah' => "SMKN 1 Banyuwangi",
                "tanggal_bergabung" => Carbon::now(),
                "tanggal_lulus" => Carbon::now()->addDays(100)
            ]
        )->assignRole($role);
        User::create(
            [
                'uuid' => Str::uuid(),
                'username' => 'Yafy Habibi Riza Putra',
                'email' => 'yafihabibi22@gmail.com',
                'password' => Hash::make('password'),
                'peran_id' => 1,
                'divisi_id' => $divisi_id->id,
                'tlp' => "0845889288",
                'sekolah' => "SMKN 1 Banyuwangi",
                "tanggal_bergabung" => Carbon::now(),
                "tanggal_lulus" => Carbon::now()->addDays(100)
            ]
        )->assignRole($role);
        User::create(
            [
                'uuid' => Str::uuid(),
                'username' => 'Andika Riztanta Previan',
                'email' => 'andika@gmail.com',
                'password' => Hash::make('password'),
                'peran_id' => 1,
                'divisi_id' => $divisi_id->id,
                'tlp' => "0845889288",
                'sekolah' => "SMKN 1 Banyuwangi",
                "tanggal_bergabung" => Carbon::now(),
                "tanggal_lulus" => Carbon::now()->addDays(100)
            ]
        )->assignRole($role);



        // $data1 = [
        //     [
        //         'Nama' => 'Raditya Adi Pratama',
        //         'Email' => 'gembes4565@gmail.com',
        //         'sekolah' => 'SMKS MUHAMMADIYAH 6 ROGOJAMPI',
        //         'tanggal_bergabung' => '20/01/2023',
        //         'tanggal_lulus' => '15/12/2023',
        //     ],
        //     [
        //         'Nama' => 'Felix Alberta Jevon',
        //         'Email' => 'luxoqwasery@gmail.com',
        //         'sekolah' => 'SMKN 1 KEPANJEN',
        //         'tanggal_bergabung' => '09/01/2023',
        //         'tanggal_lulus' => '31/12/2023',
        //     ],
        //     [
        //         'Nama' => 'Adi Alfa Rizki',
        //         'Email' => 'adialfa1203@gmail.com',
        //         'sekolah' => 'SMKN 1 Kepanjen',
        //         'tanggal_bergabung' => '09/01/2023',
        //         'tanggal_lulus' => '31/12/2023',
        //     ],
        //     [
        //         'Nama' => 'Mohammad Reno Dzuhri Pratama',
        //         'Email' => 'renotamvan87@gmail.com',
        //         'sekolah' => 'SMKN 1 Kepanjen',
        //         'tanggal_bergabung' => '09/01/2023',
        //         'tanggal_lulus' => '31/12/2023',
        //     ],
        //     [
        //         'Nama' => 'Yafy Habibi Riza Putra',
        //         'Email' => 'yafihabibi22@gmail.com',
        //         'sekolah' => 'SMKN 1 Probolinggo',
        //         'tanggal_bergabung' => '01/08/2023',
        //         'tanggal_lulus' => '30/12/2024',
        //     ],
        //     [
        //         'Nama' => 'Yassa Aji Panuntun',
        //         'Email' => 'yassa.aji@gmail.com',
        //         'sekolah' => 'SMKN 1 Probolinggo',
        //         'tanggal_bergabung' => '01/08/2023',
        //         'tanggal_lulus' => '31/01/2024',
        //     ],
        //     [
        //         'Nama' => 'Andi Rizki Ramadhani',
        //         'Email' => 'andirizki1305@gmail.com',
        //         'sekolah' => 'SMKN 1 Probolinggo',
        //         'tanggal_bergabung' => '01/08/2023',
        //         'tanggal_lulus' => '31/01/2024',
        //     ],
        //     [
        //         'Nama' => 'Moh Roihan Dany',
        //         'Email' => 'mroihandany@gmail.com',
        //         'sekolah' => 'SMKN 1 Probolinggo',
        //         'tanggal_bergabung' => '01/08/2023',
        //         'tanggal_lulus' => '31/01/2024',
        //     ],
        //     [
        //         'Nama' => 'Adi Kurniawan',
        //         'Email' => 'adikurniawan190506@gmail.com',
        //         'sekolah' => 'SMKN 1 Mejayan',
        //         'tanggal_bergabung' => '04/09/2023',
        //         'tanggal_lulus' => '31/12/2023',
        //     ],
        //     [
        //         'Nama' => 'Rizki ananta sakila',
        //         'Email' => 'akunrizky85@gmail.com',
        //         'sekolah' => 'SMKN MUHHAMMADIYA 1 GENTENG',
        //         'tanggal_bergabung' => '01/08/2023',
        //         'tanggal_lulus' => '31/01/2024',
        //     ],
        //     [
        //         'Nama' => 'Silvi Nur Hidayah',
        //         'Email' => 'hidayahsilvi627@gmail.com',
        //         'sekolah' => 'SMK MUHI 1 GENTENG',
        //         'tanggal_bergabung' => '01/08/2023',
        //         'tanggal_lulus' => '31/01/2024',
        //     ],
        //     [
        //         'Nama' => 'Octa Nandika Ardhiansyah',
        //         'Email' => 'octanandika29@gmail.com',
        //         'sekolah' => 'SMK PGRI 2 Ponorogo',
        //         'tanggal_bergabung' => '14/09/2023',
        //         'tanggal_lulus' =>'31/03/2024',
        //     ],
        //     [
        //         'Nama' => 'Rahmat Mahendra',
        //         'Email' => 'rahmatmahendra888@gmail.com',
        //         'sekolah' => 'SMKN 1 Kepanjen',
        //         'tanggal_bergabung' => '09/01/2023',
        //         'tanggal_lulus' => '31/12/2023',
        //     ],
        //     [
        //         'Nama' => 'Rendi Dwi Saputra',
        //         'Email' => 'rendydwisaputra250@gmail.com',
        //         'sekolah' => 'SMK PGRI 2 Ponorogo',
        //         'tanggal_bergabung' => '14/09/2023',
        //         'tanggal_lulus' => '31/03/2024',
        //     ],
        //     [
        //         'Nama' => 'Muhammad Hadi Nurrokhim',
        //         'Email' => 'rokhimcyber3@gmail.com',
        //         'sekolah' => 'SMK MUHI 1 GENTENG',
        //         'tanggal_bergabung' => '01/08/2023',
        //         'tanggal_lulus' => '31/01/2024',
        //     ],
        //     [
        //         'Nama' => 'Juangga Deka Danuarta',
        //         'Email' => 'dekapro21@gmail.com',
        //         'sekolah' => 'SMK PGRI WLINGI',
        //         'tanggal_bergabung' => '16/10/2023',
        //         'tanggal_lulus' => '31/03/2024',
        //     ],
        //     [
        //         'Nama' => 'Zanuar Ade Andriyan',
        //         'Email' => 'adezanuar9@gmail.com',
        //         'sekolah' => 'SMK PGRI 3 MALANG',
        //         'tanggal_bergabung' => '09/01/2023',
        //         'tanggal_lulus' => '31/12/2023',
        //     ],
        //     [
        //         'Nama' => 'Muhammad Ibnu Zauzi',
        //         'Email' => 'muhammadibnzzi@gmail.com',
        //         'sekolah' => 'SMKN 2 Trenggalek',
        //         'tanggal_bergabung' => '09/01/2023',
        //         'tanggal_lulus' => '31/12/2023',
        //     ],
        //     [
        //         'Nama' => 'Sofyan Gio Verdiansyah',
        //         'Email' => 'gioverdiansyh@gmail.com',
        //         'sekolah' => 'SMKN 1 Mejayan',
        //         'tanggal_bergabung' => '01/03/2023',
        //         'tanggal_lulus' => '31/12/2023',
        //     ],
        //     [
        //         'Nama' => 'Abdul kader',
        //         'Email' => 'abdulkader0126@gmail.com',
        //         'sekolah' => 'SMKN 1 KRAKSAAN',
        //         'tanggal_bergabung' => '01/03/2023',
        //         'tanggal_lulus' => '31/12/2023',
        //     ],
        //     [
        //         'Nama' => 'Mohamad Arif',
        //         'Email' => 'mohamadarif5392@gmail.com',
        //         'sekolah' => 'SMKN 1 Kepanjen',
        //         'tanggal_bergabung' => '09/01/2023',
        //         'tanggal_lulus' => '31/12/2023',
        //     ],
        //     [
        //         'Nama' => 'Tri Aldy Kurniawan',
        //         'Email' => 'aldykuniawan94@gmail.com',
        //         'sekolah' => 'SMKN 1 Kepanjen',
        //         'tanggal_bergabung' => '09/01/2023',
        //         'tanggal_lulus' => '31/12/2023',
        //     ],
        //     [
        //         'Nama' => 'Syerli Nindi Pratiwi',
        //         'Email' => 'serlynindi680@gmail.com',
        //         'sekolah' => 'SMKN 1 PROBOLINGGO',
        //         'tanggal_bergabung' => '01/08/2023',
        //         'tanggal_lulus' => '31/01/2024',
        //     ],
        //     [
        //         'Nama' => 'Mohammad Daffa Prasetyo',
        //         'Email' => 'unitedkuryu@gmail.com',
        //         'sekolah' => 'SMKN 1 Kepanjen',
        //         'tanggal_bergabung' => '09/01/2023',
        //         'tanggal_lulus' => '02/01/2024',
        //     ],
        // ];

        // $data2 = [
        //     [
        //         'Nama' => 'Hafidz Navidha Rizky',
        //         'Email' => 'hafidznavidhar@gmail.com',
        //         'sekolah' => 'SMKN 1 Kepanjen',
        //         'tanggal_bergabung' => '05/07/2023',
        //         'tanggal_lulus' => '02/01/2024'
        //     ],
        //     [
        //         'Nama' => 'Irsyad Andhika Ariadi',
        //         'Email' => 'irsyadandandhika@gmail.com',
        //         'sekolah' => 'SMK PGRI WLINGI',
        //         'tanggal_bergabung' => '16/10/2023',
        //         'tanggal_lulus' => '31/03/2024'
        //     ],
        //     [
        //         'Nama' => 'Ahmad Ilyas Fitono',
        //         'Email' => 'ahmadilyasfitono@gmail.com',
        //         'sekolah' => 'Smkn 1 Gending',
        //         'tanggal_bergabung' => '18/07/2023',
        //         'tanggal_lulus' => '31/12/2023'
        //     ],
        //     [
        //         'Nama' => 'Kevin amavisca pratama',
        //         'Email' => 'kevinamaviscapratama@gmail.com',
        //         'sekolah' => 'Smkn 2 singosari',
        //         'tanggal_bergabung' => '03/07/2023',
        //         'tanggal_lulus' => '31/12/2023'
        //     ],
        //     [
        //         'Nama' => 'Khalifatul Mufrida',
        //         'Email' => 'ifamufrida03@gmail.com',
        //         'sekolah' => 'SMKN 2 SINGOSARI',
        //         'tanggal_bergabung' => '03/07/2023',
        //         'tanggal_lulus' => '31/12/2023'
        //     ],
        //     [
        //         'Nama' => 'Fira Cindy Elva Nathania',
        //         'Email' => 'firaelfa12345@gmail.com',
        //         'sekolah' => 'SMK PGRI 3 MALANG',
        //         'tanggal_bergabung' => '09/01/2023',
        //         'tanggal_lulus' => '15/12/2023'
        //     ],
        //     [
        //         'Nama' => 'Shobibun Niam',
        //         'Email' => 'niamxiomi86@gmail.com',
        //         'sekolah' => 'SMKN TAMBAKBOYO',
        //         'tanggal_bergabung' => '1/11/2023',
        //         'tanggal_lulus' => '31/3/2024'
        //     ],
        //     [
        //         'Nama' => 'Andika Riztanta Previan',
        //         'Email' => 'VianRiztanta71@gmail.com',
        //         'sekolah' => 'SMKN 1 Probolinggo',
        //         'tanggal_bergabung' => '01/08/2023',
        //         'tanggal_lulus' => '31/01/2024'
        //     ],
        //     [
        //         'Nama' => 'Cinta Rahmalya Syifa',
        //         'Email' => 'cintarahmaliyasyifa04@gmail.com',
        //         'sekolah' => 'SMKN 1 KEPANJEN',
        //         'tanggal_bergabung' => '24/10/2023',
        //         'tanggal_lulus' => '31/12/2024'
        //     ],
        //     [
        //         'Nama' => 'Very Yuasdhi Akbar',
        //         'Email' => 'veryyuasdiakbar@gmail.com',
        //         'sekolah' => 'SMK PGRI 2 PONOROGO',
        //         'tanggal_bergabung' => '14/09/2023',
        //         'tanggal_lulus' => '31/03/2024'
        //     ],
        //     [
        //         'Nama' => 'Lintang Permata Sabrina',
        //         'Email' => 'permatalintang29@gmail.com',
        //         'sekolah' => 'SMKN 12 MALANG',
        //         'tanggal_bergabung' => '10/07/2023',
        //         'tanggal_lulus' => '31/12/2023'
        //     ],
        //     [
        //         'Nama' => 'Meilani Safira Putri',
        //         'Email' => 'meilanisafiraputri@gmail.com',
        //         'sekolah' => 'SMKN 1 PROBOLINGGO',
        //         'tanggal_bergabung' => '01/08/2023',
        //         'tanggal_lulus' => '31/01/2024'
        //     ],
        //     [
        //         'Nama' => 'Alfian Fahrul Rifa\'i',
        //         'Email' => 'fahrulrifaialfian@gmail.com',
        //         'sekolah' => 'SMKN 1 KEPANJEN',
        //         'tanggal_bergabung' => '24/10/23',
        //         'tanggal_lulus' => '31/12/2024'
        //     ],
        //     [
        //         'Nama' => 'Siti Aisyah',
        //         'Email' => 'aisyahfeny2019@gmail.com',
        //         'sekolah' => 'SMKN 1 PROBOLINGGO',
        //         'tanggal_bergabung' => '01/08/2023',
        //         'tanggal_lulus' => '31/01/2024'
        //     ],
        //     [
        //         'Nama' => 'Bagus Rayhan Maulana',
        //         'Email' => 'rehankong1@gmail.com',
        //         'sekolah' => 'SMKS PGRI 3 MALANG',
        //         'tanggal_bergabung' => '06/02/2023',
        //         'tanggal_lulus' => '15/12/2023'
        //     ],
        //     [
        //         'Nama' => 'Ilya Halimatus Sa\'diyah',
        //         'Email' => 'ilyahalimatussadyah@gmail.com',
        //         'sekolah' => 'SMKN 1 PROBOLINGGO',
        //         'tanggal_bergabung' => '01/08/2023',
        //         'tanggal_lulus' => '31/01/2024'
        //     ],
        //     [
        //         'Nama' => 'Rahayu Dwi Prasinta',
        //         'Email' => 'rahayuprasinta@gmail.com',
        //         'sekolah' => 'SMKN 1 KEPANJEN',
        //         'tanggal_bergabung' => '09/01/2023',
        //         'tanggal_lulus' => '31/12/2023'
        //     ],
        //     [
        //         'Nama' => 'Putra Pratama',
        //         'Email' => 'putra09prtama@gmail.com',
        //         'sekolah' => 'SMKN 1 GENDING',
        //         'tanggal_bergabung' => '18/07/2023',
        //         'tanggal_lulus' => '31/12/2023'
        //     ],
        //     [
        //         'Nama' => 'Muhammad Jefri Dwi Nur Cahyo',
        //         'Email' => 'muhammadjefridwinurcahyo@gmail.com',
        //         'sekolah' => 'SMKN 1 GENDING',
        //         'tanggal_bergabung' => '18/07/2023',
        //         'tanggal_lulus' => '31/12/2023'
        //     ],
        //     [
        //         'Nama' => 'Susilowati',
        //         'Email' => 'susilow020@gmail.com',
        //         'sekolah' => 'SMKN TAMBAKBOYO',
        //         'tanggal_bergabung' => '1/11/2023',
        //         'tanggal_lulus' => '31/03/2024'
        //     ],
        //     [
        //         'Nama' => 'Yuni kamiasti',
        //         'Email' => 'yunikakanoman@gmail.com',
        //         'sekolah' => 'SMKN TAMBAKBOYO',
        //         'tanggal_bergabung' => '01/11/2023',
        //         'tanggal_lulus' => '31/03/2024'
        //     ],
        //     [
        //         'Nama' => 'Tiyan Lestari',
        //         'Email' => 'redmitiyan@gmail.com',
        //         'sekolah' => 'SMKN TAMBAKBOYO',
        //         'tanggal_bergabung' => '12/12/2023',
        //         'tanggal_lulus' => '31/03/2024'
        //     ],
        //     [
        //         'Nama' => 'Ibrahim Akhdaan Fathurrozzaq',
        //         'Email' => 'ibrahimakhdaan935@gmail.com',
        //         'sekolah' => 'SMKN 11 MALANG',
        //         'tanggal_bergabung' => '07/08/2023',
        //         'tanggal_lulus' => '22/12/2023'
        //     ],
        //     [
        //         'Nama' => 'El Zaim Gibbrian Islamy Arifin',
        //         'Email' => 'gibbrianarifin@gmail.com',
        //         'sekolah' => 'SMK TELKOM MALANG',
        //         'tanggal_bergabung' => '03/11/2023',
        //         'tanggal_lulus' => '01/04/2024'
        //     ],
        //     [
        //         'Nama' => 'Rizky Iqbal Sudrajat',
        //         'Email' => 'rizkyiqbal2005@gmail.com',
        //         'sekolah' => 'SMK TELKOM MALANG',
        //         'tanggal_bergabung' => '03/11/2023',
        //         'tanggal_lulus' => '01/04/2024'
        //     ]
        // ];

        // $data3 = [
        //     [
        //         'Nama' => 'trisqitegarv@gmail.com',
        //         'Email' => 'trisqitegarv@gmail.com',
        //         'sekolah' => 'SMK PGRI 3 MALANG',
        //         'tanggal_bergabung' => '06/02/2023',
        //         'tanggal_lulus' => '15/12/2023'
        //     ],
        //     [
        //         'Nama' => 'blitaryanendipratama@gmail.com',
        //         'Email' => 'blitaryanendipratama@gmail.com',
        //         'sekolah' => 'SMK PGRI WLINGI',
        //         'tanggal_bergabung' => '16/10/2023',
        //         'tanggal_lulus' => '31/03/2024'
        //     ]
        // ];

        // $data4 = [...$data1,...$data2];
        // $siswaMagang = [...$data4,...$data3];

        // foreach ($siswaMagang as $key => $row) {
        //     $user = new User;
        //     $user->uuid = Str::uuid();
        //     $user->username = $row['Nama'];
        //     $user->email = $row['Email'];
        //     $user->sekolah = $row['sekolah'];

        //     $date1 = date_create_from_format("d/m/Y", $row['tanggal_bergabung']);
        //     $date2 = date_create_from_format("d/m/Y",$row['tanggal_lulus']);
        //     $user->tanggal_bergabung = date_format($date1, "Y-m-d");
        //     $user->tanggal_lulus = date_format($date2, "Y-m-d");
        //     $user->password = Hash::make('password');
        //     $user->peran_id = 1;
        //     $user->save();
        //  }

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
