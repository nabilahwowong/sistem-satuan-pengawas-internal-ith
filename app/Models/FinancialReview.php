<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinancialReview extends Model
{
    protected $guarded = ['id'];

    // Relasi
    public function unit() {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function auditor() {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Helper Format Rupiah
    public function getPaguRupiahAttribute() {
        return 'Rp ' . number_format($this->pagu_anggaran, 0, ',', '.');
    }

    public function getRealisasiRupiahAttribute() {
        return 'Rp ' . number_format($this->realisasi_anggaran, 0, ',', '.');
    }

    // Helper Warna Badge Serapan (Sesuai Pedoman Hal 55: >90% Bagus)
    public function getSerapanBadgeAttribute() {
        if ($this->persentase_serapan >= 90) return 'text-green-600 bg-green-50 border-green-200';
        if ($this->persentase_serapan >= 70) return 'text-yellow-600 bg-yellow-50 border-yellow-200';
        return 'text-red-600 bg-red-50 border-red-200';
    }
}
