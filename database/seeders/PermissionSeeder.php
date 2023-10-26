<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
         // Buat role
         $ketuaMagang = Role::create(['name' => 'ketua magang','team_id'=>null]);
        //  $editorRole = Role::create(['name' => 'editor']);

         // Buat permission
         $kelolasiswa = Permission::create(['name' => 'kelola siswa','team_id'=>null]);
        //  $editPostPermission = Permission::create(['name' => 'edit post']);
        //  $deletePostPermission = Permission::create(['name' => 'delete post']);

         // Assign permission ke role
         $ketuaMagang->givePermissionTo($kelolasiswa);
        //  $editorRole->givePermissionTo($createPostPermission, $editPostPermission);

         // Assign role ke user
         $user = User::where('email','Yafy@gmail.com')->first(); // Ganti dengan instance User yang sesuai
         $user->assignRole('ketua magang');
    }
}
