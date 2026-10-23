<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul', 'kategori', 'file_path', 'tipe_file', 'keterangan'
    ];

    // Helper untuk menampilkan nama kategori yang rapi di View
    public function getKategoriLabelAttribute()
    {
        return match($this->kategori) {
            'pedoman_audit' => 'Pedoman Audit',
            'pedoman_reviu' => 'Pedoman Reviu',
            'template' => 'Template Dokumen',
            default => ucfirst($this->kategori),
        };
    }
}
