<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditFinding extends Model
{
    use HasFactory;

    // Pastikan nama tabel benar
    protected $table = 'audit_findings';

    // Kita gunakan guarded id agar semua kolom lain bisa diisi (mass assignment)
    protected $guarded = ['id'];

    // Casting tanggal agar otomatis jadi objek Carbon
    protected $casts = [
        'tanggal_tanggapan' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];


    // 1. Relasi ke Jadwal Audit
    public function schedule()
    {
        return $this->belongsTo(ReviewSchedule::class, 'review_schedule_id');
    }

    // 2. Relasi ke Auditor (Pembuat Temuan)
    // Pastikan kolom di database adalah 'auditor_id' sesuai migrasi terakhir Anda
    public function auditor()
    {
        return $this->belongsTo(User::class, 'auditor_id');
    }

    // 3. Relasi ke Unit (Agar Kepala Unit bisa filter data)
    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }


    // Helper untuk Warna Badge Status
    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'open'      => 'bg-red-100 text-red-700 border-red-200',
            'responded' => 'bg-yellow-100 text-yellow-700 border-yellow-200',
            'closed'    => 'bg-green-100 text-green-700 border-green-200',
            default     => 'bg-gray-100 text-gray-600',
        };
    }

    public function getKategoriBadgeAttribute()
    {
    return match($this->kategori) {
            'ringan' => 'bg-green-100 text-green-700 border-green-200',
            'sedang' => 'bg-yellow-100 text-yellow-700 border-yellow-200',
            'berat'  => 'bg-red-100 text-red-700 border-red-200',
            default  => 'bg-gray-100 text-gray-600',
        };
    }

}
