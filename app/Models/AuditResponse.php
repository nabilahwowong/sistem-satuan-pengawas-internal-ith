<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditResponse extends Model
{
    use HasFactory;

    // 1. Kolom yang boleh diisi (Mass Assignment)
    protected $fillable = [
        'review_schedule_id', // Foreign Key: Link ke Jadwal Audit
        'user_id',            // Foreign Key: Siapa yang upload (Auditee)
        'judul',              // Judul Tanggapan
        'file_path',          // Lokasi file fisik
        'keterangan',         // Catatan tambahan
        'status',             // status: 'draft', 'dikirim', 'diterima', 'revisi'
    ];


    // Relasi ke Jadwal: "Tanggapan ini milik jadwal audit X"
    public function schedule()
    {
        return $this->belongsTo(ReviewSchedule::class, 'review_schedule_id');
    }

    // Relasi ke User: "Tanggapan ini diupload oleh Bapak Y"
    public function uploader()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    // Fitur tambahan: Agar di Blade nanti gampang kasih warna badge status
    // Cara panggil di blade: {{ $response->status_badge }}
    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'diterima' => 'bg-green-100 text-green-800', // Hijau
            'revisi'   => 'bg-red-100 text-red-800',     // Merah
            'dikirim'  => 'bg-blue-100 text-blue-800',   // Biru
            default    => 'bg-gray-100 text-gray-600',   // Abu-abu (Draft)
        };
    }
}
