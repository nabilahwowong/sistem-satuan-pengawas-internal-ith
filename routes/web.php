<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LandingPageController;

// Admin Controllers
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AccessController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\ArchiveController;
use App\Http\Controllers\Admin\AuditFindingController;
use App\Http\Controllers\Admin\ReviewScheduleController;
use App\Http\Controllers\Admin\DashboardController;

// Anggota Controllers
use App\Http\Controllers\Anggota\DashboardController as AnggotaDashboardController;
use App\Http\Controllers\Anggota\ReviewScheduleController as AnggotaReviewScheduleController;
use App\Http\Controllers\Anggota\AuditWorkController;
use App\Http\Controllers\Anggota\DocumentController as AnggotaDocumentController;
use App\Http\Controllers\Anggota\FindingController;
use App\Http\Controllers\Anggota\ReportController;
use App\Http\Controllers\Anggota\NewsController;
use App\Http\Controllers\Anggota\ContentManagerController;
use App\Http\Controllers\Anggota\ProfileController as AnggotaProfileController;

// Kepala Unit Controllers
use App\Http\Controllers\KepalaUnit\DashboardController as KepalaUnitDashboardController;
use App\Http\Controllers\KepalaUnit\DocumentRequestController;
use App\Http\Controllers\KepalaUnit\AuditFindingController as KepalaUnitAuditFindingController;
use App\Http\Controllers\KepalaUnit\ReportController as KepalaUnitReportController;
use App\Http\Controllers\KepalaUnit\ScheduleController;
use App\Http\Controllers\KepalaUnit\ProfileController as KepalaUnitProfileController;

// Pimpinan Controllers
use App\Http\Controllers\Pimpinan\DashboardController as PimpinanDashboardController;
use App\Http\Controllers\Pimpinan\LeadershipReportController;
use App\Http\Controllers\Pimpinan\LeadershipFinanceController;
use App\Http\Controllers\Pimpinan\LeadershipSakipController;
use App\Http\Controllers\Pimpinan\LeadershipUnitController;
use App\Http\Controllers\Pimpinan\LeadershipFindingController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/berita/{slug}', [LandingController::class, 'showBerita'])->name('berita.show');
Route::get('/kontak', function () { return view('kontak.kontak'); })->name('kontak');
Route::get('/informasi/{slug}', [LandingPageController::class, 'show'])->name('landing.show');

/*
|--------------------------------------------------------------------------
| Authentication (Guest)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // --- ADMIN ---
    Route::prefix('admin')->name('admin.')->middleware('role:admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('users', UserController::class);
        Route::resource('units', UnitController::class);
        Route::resource('archives', ArchiveController::class)->only(['index', 'create', 'store', 'destroy']);
        Route::resource('schedules', ReviewScheduleController::class)->only(['index', 'store', 'destroy']);

        Route::get('/access', [AccessController::class, 'index'])->name('access.index');
        Route::get('/access/{id}/edit', [AccessController::class, 'edit'])->name('access.edit');
        Route::put('/access/{id}', [AccessController::class, 'update'])->name('access.update');

        Route::resource('audit-findings', AuditFindingController::class)->names('audit');
        Route::resource('documents', DocumentController::class);
    });

    // --- ANGGOTA ---
    Route::prefix('anggota')->name('anggota.')->middleware('role:anggota')->group(function () {
        Route::get('/dashboard', [AnggotaDashboardController::class, 'index'])->name('dashboard');

        // Profil
        Route::get('/profil', [AnggotaProfileController::class, 'index'])->name('profil');
        Route::put('/profil/update', [AnggotaProfileController::class, 'update'])->name('profil.update');
        Route::put('/profil/password', [AnggotaProfileController::class, 'updatePassword'])->name('profil.password');

        // CMS & Berita
        Route::resource('cms', ContentManagerController::class);
        Route::resource('portal', NewsController::class);

        // Jadwal & Kerja Audit
        Route::resource('schedules', AnggotaReviewScheduleController::class);
        Route::prefix('audit')->name('audit.')->controller(AuditWorkController::class)->group(function () {
            Route::get('/pedoman', 'pedoman')->name('pedoman');
            Route::get('/templates', 'templates')->name('templates');
            Route::get('kka', 'kkaIndex')->name('kka-index');
            Route::post('kka', 'kkaStore')->name('kka.store');
            Route::get('kda', 'kdaIndex')->name('kda-index');
            Route::post('kda', 'kdaStore')->name('kda.store');
        });

        // REVISI TOTAL: Dokumen menggunakan penamaan eksplisit agar tidak error
        Route::prefix('documents')->controller(AnggotaDocumentController::class)->group(function () {
            Route::get('/request', 'create')->name('documents.request.create');
            Route::post('/request', 'store')->name('documents.request.store');
            Route::get('/responses', 'responses')->name('documents.responses.index'); // <-- Ini yang memicu error sebelumnya
            Route::patch('/responses/{id}/verify', 'verify')->name('documents.verify');
        });

        // Temuan
        Route::prefix('findings')->name('findings.')->controller(FindingController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create'); // Rute yang dicari tombol Catat Temuan
            Route::post('/', 'store')->name('store'); // Rute untuk menyimpan form temuan
            Route::get('/responses', 'responses')->name('responses');
            Route::patch('/{id}/verify', 'verify')->name('verify');
            Route::patch('/{id}/close', 'closeFinding')->name('close'); // Rute untuk tombol Verifikasi & Selesai
        });

        // Laporan (LHA/LHR)
        Route::prefix('reports')->name('reports.')->controller(ReportController::class)->group(function() {
            Route::get('/lha', 'indexLHA')->name('lha');
            Route::get('/lhr', 'indexLHR')->name('lhr');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
        });
    });

    // --- KEPALA UNIT ---
    Route::prefix('kepala_unit')->name('kepala_unit.')->middleware('role:kepala_unit')->group(function () {
        Route::get('/dashboard', [KepalaUnitDashboardController::class, 'index'])->name('dashboard');
        Route::get('/profil', [KepalaUnitProfileController::class, 'index'])->name('profil');
        Route::put('/profil/update', [KepalaUnitProfileController::class, 'update'])->name('profil.update');
        Route::put('/profil/password', [KepalaUnitProfileController::class, 'updatePassword'])->name('profil.password');

        Route::get('/permintaan-dokumen', [DocumentRequestController::class, 'index'])->name('dokumen');
        Route::post('/permintaan-dokumen/{id}/upload', [DocumentRequestController::class, 'upload'])->name('dokumen.upload');
        Route::get('/tanggapan-temuan', [KepalaUnitAuditFindingController::class, 'index'])->name('temuan');
        Route::get('/jadwal-reviu', [ScheduleController::class, 'index'])->name('jadwal');
        Route::get('/laporan-unit', [KepalaUnitReportController::class, 'index'])->name('laporan');
    });

    // --- PIMPINAN ---
    Route::prefix('pimpinan')->name('pimpinan.')->middleware('role:pimpinan')->group(function () {
        Route::get('/dashboard', [PimpinanDashboardController::class, 'index'])->name('dashboard');
        Route::get('/laporan-audit', [LeadershipReportController::class, 'index'])->name('laporan.index');
        Route::get('/status-temuan', [LeadershipFindingController::class, 'index'])->name('temuan.index');
    });
});
