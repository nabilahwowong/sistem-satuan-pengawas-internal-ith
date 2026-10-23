<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentRequest extends Model
{
    // Mengizinkan semua kolom diisi kecuali ID
    protected $guarded = ['id'];

    // Ubah format tanggal otomatis jadi Carbon
    protected $casts = [
        'responded_at' => 'datetime',
        'deadline'     => 'date', // Tambahan: agar deadline bisa langsung diformat
    ];

    // --- RELASI (RELATIONSHIPS) ---

    // 1. Relasi ke Jadwal
    public function schedule()
    {
        return $this->belongsTo(ReviewSchedule::class, 'review_schedule_id');
    }

    // 2. Relasi ke Auditor (User pembuat)
    public function auditor()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // 3. Relasi ke Unit (PENTING: Tambahan baru)
    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'pending'   => 'bg-yellow-100 text-yellow-700 border-yellow-200',
            'terkirim'  => 'bg-blue-100 text-blue-700 border-blue-200',
            'fulfilled' => 'bg-green-100 text-green-700 border-green-200',
            'rejected'  => 'bg-red-100 text-red-700 border-red-200',
            default     => 'bg-gray-100 text-gray-600',
        };
    }
}
