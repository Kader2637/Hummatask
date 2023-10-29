<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;

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
        'peran_id',
        'tlp',
        'deskripsi',
        'is_login',
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


    public function tim():BelongsToMany
    {
        return $this->belongsToMany(Tim::class, 'anggotas');
    }

     /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    /**
     * Get the primary key type.
     *
     * @return string
     */
    protected $keyType = 'string';

    /**
     * Get the key name for the model.
     *
     * @return string
     */
    public function getKeyName()
    {
        return 'id';
    }
}



