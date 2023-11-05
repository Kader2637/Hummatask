<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

// $ketuaMagang = Role::create(['name'=>'Ketua']);
// $wakilKetuaMagang = Role::create(['name'=>'Wakil Ketua Magang']);
// $permission = Permission::create(['name'=>'kelola siswa']);

// $permission->syncRoles([$ketuaMagang,$wakilKetuaMagang]);

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'avatar',
        'username',
        'email',
        'password',
        'status',
        'sekolah',
        'peran_id',
        'tlp',
        'deskripsi',
        'is_login',
        'tanggal_bergabung',
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function tim(): BelongsToMany
    {
        return $this->belongsToMany(Tim::class, 'anggotas');
    }

    public function peran(): HasOne
    {
        return $this->hasOne(peran::class, 'id', 'peran_id');
    }
}
