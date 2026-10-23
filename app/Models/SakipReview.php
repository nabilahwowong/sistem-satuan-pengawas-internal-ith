<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SakipReview extends Model
{
    protected $guarded = ['id'];

    public function unit() {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    // Helper Warna Predikat SAKIP
    public function getPredikatBadgeAttribute() {
        return match($this->predikat) {
            'AA' => 'bg-green-100 text-green-700 border-green-200',
            'A'  => 'bg-green-50 text-green-600 border-green-200',
            'BB' => 'bg-blue-100 text-blue-700 border-blue-200',
            'B'  => 'bg-blue-50 text-blue-600 border-blue-200',
            'CC' => 'bg-yellow-100 text-yellow-700 border-yellow-200',
            'C'  => 'bg-yellow-50 text-yellow-600 border-yellow-200',
            'D'  => 'bg-red-100 text-red-700 border-red-200',
            default => 'bg-gray-100 text-gray-600',
        };
    }
}
