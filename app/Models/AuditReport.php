<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ReviewSchedule; // Pastikan ini di-use

class AuditReport extends Model
{
    protected $guarded = ['id'];
    protected $casts = ['tanggal_laporan' => 'date'];

    public function unit() {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function auditor() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function schedule() {
    return $this->belongsTo(ReviewSchedule::class, 'review_schedule_id');
    }

    public function getJenisBadgeAttribute()
    {
        return match($this->jenis) {
            'LHA' => 'bg-blue-100 text-blue-700 border-blue-200',
            'LHR' => 'bg-purple-100 text-purple-700 border-purple-200',
            default => 'bg-gray-100 text-gray-600',
        };
    }
}
