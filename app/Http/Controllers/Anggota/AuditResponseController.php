<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\DocumentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuditResponseController extends Controller
{
    public function index()
    {
        $responses = DocumentRequest::with(['schedule.unit', 'unit'])
                        ->where('status', '!=', 'pending') // Hanya tampilkan yang sudah direspon
                        ->latest('updated_at')
                        ->paginate(10);

        return view('anggota.documents.responses', compact('responses'));
    }

}
