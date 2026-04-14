<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\AlumniForumDashboardController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\ForumLikeController;
use App\Http\Controllers\InformasiLokerController;
use App\Http\Controllers\KategoriForumController;
use App\Http\Controllers\KategoriLokerController;
use App\Http\Controllers\KomentarForumController;
use App\Http\Controllers\KomentarLikeController;
use App\Http\Controllers\LowonganController;
use App\Http\Controllers\ModeratorForumController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'showApprovedOnWelcome'])->name('welcome');

Auth::routes();

Route::middleware(['auth', 'check.banned'])->group(function () {
    // Semua route yang perlu user tidak banned
});
Route::get('/profil-awal', function () {
    return view('user.profil-awal');
})
    ->middleware('auth')
    ->name('user.profil-awal');

Route::post('/alumni/update-password', [AlumniController::class, 'updatePassword'])
    ->name('alumni.update-password')
    ->middleware('auth');

Route::get('/alumni', [AlumniController::class, 'index'])->name('alumni.index');
Route::get('/lowongan', [LowonganController::class, 'index'])
    ->name('lowongan.index');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/forum/{forum}', [ForumController::class, 'show'])->name('forum.show');

// Route admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::resource('kategori_loker', KategoriLokerController::class);
    Route::resource('informasi_loker', InformasiLokerController::class);
    Route::resource('kategori_forum', KategoriForumController::class);
    Route::get('users', [AlumniController::class, 'index'])
        ->name('users.index');
        

});

// Route alumni untuk forum diskusi
Route::middleware(['auth', 'role:alumni'])->group(function () {
    Route::get('/alumni/forums/dashboard', [AlumniForumDashboardController::class, 'index'])->name('alumni.forums.dashboard');
    Route::post('/notif-komentar/baca', [AlumniForumDashboardController::class, 'bacaNotif'])->name('alumni.bacaNotif');
    Route::post('/forum/{id}/like', [ForumLikeController::class, 'toggle'])->name('forum.like');
    Route::post('/komentar/{id}/like', [KomentarLikeController::class, 'toggle'])->name('komentar.like');
    Route::get('/berita', [ForumController::class, 'berita'])->name('forums.index');

    // Simpan forum baru
    Route::post('/forum/store', [ForumController::class, 'store'])->name('forum.store');

    Route::get('/loker/{id}', [InformasiLokerController::class, 'show'])->name('loker.show');

    Route::post('/forum/{id}/komentar', [KomentarForumController::class, 'store'])->name('forum.komentar.store');
    Route::get('/komentar/{komentar}/edit', [KomentarForumController::class, 'edit'])->name('forum.komentar.edit');
    Route::put('/komentar/{komentar}', [KomentarForumController::class, 'update'])->name('forum.komentar.update');
    Route::get('/komentar/read/{id}', [KomentarForumController::class, 'read'])->name('komentar.read');
    Route::delete('/komentar/{komentar}', [KomentarForumController::class, 'destroy'])->name('forum.komentar.destroy');
});

// Route moderator untuk approve/reject forum dan manage komentar
Route::middleware(['auth', 'role:moderator'])->prefix('moderator')->name('moderator.')->group(function () {
    Route::get('/forums', [ModeratorForumController::class, 'index'])->name('moderator.forums.index');

    Route::post('/forums/{forum}/approve', [ModeratorForumController::class, 'approve'])->name('forums.approve');
    Route::post('/forums/{forum}/reject', [ModeratorForumController::class, 'reject'])->name('forums.reject');

    Route::delete('/komentar/{id}', [ModeratorForumController::class, 'destroy'])->name('komentar.destroy');

    Route::post('/user/{id}/ban', [ModeratorForumController::class, 'banUser'])->name('user.ban');
    Route::post('/user/{id}/unban', [ModeratorForumController::class, 'unbanUser'])->name('user.unban');

    Route::get('/forums/{id}', [ModeratorForumController::class, 'show'])->name('forums.show');
});
