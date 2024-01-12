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
    protected $fillable = ['uuid', 'avatar', 'username', 'email', 'password', 'divisi_id', 'status', 'sekolah', 'peran_id', 'tlp', 'deskripsi', 'is_login', 'tanggal_bergabung', 'tanggal_lulus'];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * tim
     *
     * @return BelongsToMany
     */
    public function tim(): BelongsToMany
    {
        return $this->belongsToMany(Tim::class, 'anggotas', 'user_id', 'tim_id');
    }

    /**
     * aktifitas
     *
     * @return void
     */
    public function aktifitas()
    {
        return $this->hasMany(Aktifitas::class);
    }

    /**
     * tugas
     *
     * @return BelongsToMany
     */
    public function tugas(): BelongsToMany
    {
        return $this->belongsToMany(Tugas::class, 'penugasans');
    }

    /**
     * comments
     *
     * @return void
     */
    public function comments()
    {
        return $this->hasMany(Comments::class);
    }

    /**
     * peran
     *
     * @return HasOne
     */
    public function peran(): HasOne
    {
        return $this->hasOne(peran::class, 'id', 'peran_id');
    }

    /**
     * konfirmasi_presentasi
     *
     * @return HasMany
     */
    public function konfirmasi_presentasi(): HasMany
    {
        return $this->hasMany(Presentasi::class, 'user_approval_id');
    }

    /**
     * anggota
     *
     * @return BelongsTo
     */
    public function anggota(): BelongsTo
    {
        return $this->belongsTo(Anggota::class, 'id', 'user_id');
    }

    /**
     * anggotaReal
     *
     * @return HasMany
     */
    public function anggotaReal(): HasMany
    {
        return $this->hasMany(Anggota::class);
    }

    /**
     * notifikasi
     *
     * @return void
     */
    public function notifikasi()
    {
        return $this->hasMany(Notifikasi::class, 'user_id');
    }

    /**
     * divisi
     *
     * @return BelongsTo
     */
    public function divisi(): BelongsTo
    {
        return $this->belongsTo(Divisi::class, 'divisi_id');
    }
}
