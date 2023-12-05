<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
        'tanggal_lulus',
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
        return $this->belongsToMany(Tim::class, 'anggotas','user_id','tim_id');
    }

    public function aktifitas()
    {
        return $this->hasMany(Aktifitas::class);
    }



    public function tugas():BelongsToMany
    {
        return $this->belongsToMany(Tugas::class,'penugasans');
    }

    public function comments()
    {
        return $this->hasMany(Comments::class);
    }

    public function peran(): HasOne
    {
        return $this->hasOne(peran::class, 'id', 'peran_id');
    }

    public function konfirmasi_presentasi(): HasMany
    {
        return $this->hasMany(Presentasi::class,'user_approval_id');
    }

    public function anggota():BelongsTo
    {
        return $this->belongsTo(Anggota::class,'id','user_id');
    }

    public function anggotaReal():HasMany
    {
        return $this->hasMany(Anggota::class);
    }
}
