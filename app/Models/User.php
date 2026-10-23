<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

   protected $fillable = [
        'name',
        'email',
        'password',
        'role',          // Wajib
        'unit_id',       // Wajib
        'is_active',     // Wajib
        'nip',           // Opsional (sesuai migrasi terakhir)
        'gelar_depan',   // Opsional
        'gelar_belakang', // Opsional
        'foto_profil',    // Opsional
    ];

    protected $hidden = ['password', 'remember_token'];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
