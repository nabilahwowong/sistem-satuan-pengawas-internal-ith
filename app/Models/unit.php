<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_unit',
        'nama_unit'
    ];

    // Relasi: Satu Unit memiliki banyak User
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function kepala()
    {
        return $this->belongsTo(User::class, 'kepala_unit_id');
    }

    // Relasi ke Laporan Audit (Untuk hitung temuan)
    public function auditReports()
    {
        return $this->hasMany(AuditReport::class);
    }

    // Relasi ke Reviu Keuangan
    public function financialReviews()
    {
        return $this->hasMany(FinancialReview::class);
    }

    // Relasi ke SAKIP (Untuk ambil nilai AKIP terakhir)
    public function sakipReviews()
    {
        return $this->hasMany(SakipReview::class);
    }
}
