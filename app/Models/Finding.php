<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finding extends Model
{
    use HasFactory;

    // Pastikan semua kolom ini ada di sini!
    protected $fillable = [
        'review_schedule_id',
        'kode_temuan',
        'kondisi',
        'kriteria',
        'sebab',
        'akibat',
        'rekomendasi',
        'status',
        'tanggapan_auditi',
        'created_by',
        'kategori',
    ];

    // ... relasi ke user/schedule
    public function schedule()
    {
        return $this->belongsTo(ReviewSchedule::class, 'review_schedule_id');
    }
}
