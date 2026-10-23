<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewSchedule extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    // Perhatikan: Anda menamai relasinya 'creator', jadi nanti di controller/view panggilnya 'creator'
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // --- TAMBAHAN PENTING ---
    // Accessor untuk warna badge otomatis di Blade
    // Panggil dengan: {{ $schedule->status_badge }}
    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'Terjadwal' => 'bg-gray-100 text-gray-600 border-gray-200',
            'Berjalan'  => 'bg-blue-100 text-blue-700 border-blue-200',
            'Selesai'   => 'bg-green-100 text-green-700 border-green-200',
            'Ditunda'   => 'bg-yellow-100 text-yellow-700 border-yellow-200',
            default     => 'bg-gray-100 text-gray-600',
        };
    }
}
