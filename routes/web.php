<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\ViewController;
use App\Models\Bumdesa;
use App\Models\Desa;
use App\Models\Laporan;
use App\Models\Umkm;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/index');
});


Route::middleware(['guest'])->group(function () {

    Route::get('/index', function () {
        return redirect('/login');
    });

    Route::get('/admin', function () {
        return redirect(('/admin/login'));
    });

    //HALAMAN LUPA PASSWORD
    Route::get('/lupa_password', function () {
        return view('auth/forget_password');
    })->name('lupa_password');

    //Proses Masukan Email untuk Ganti Password
    Route::post('/lupa_password', [AuthController::class, 'forget_password'])->name('password.email');
    //Proses Reset Password
    Route::post('/reset-password', [AuthController::class, 'reset_password'])->name('password.update');
    //Halaman Reset Password
    Route::get('/reset-password/{token}', function (string $token) {
        return view('auth.reset_password', ['token' => $token]);
    })->name('password.reset');

    //HALAMAN REGISTRASI PENGGUNA DESA
    Route::get('/registrasi', function () {
        $desas = Desa::all();
        return view('auth/registrasi', ['desas' => $desas]);
    })->name('registrasi');
    //PROSES REGISTRASI PENGGUNA DESA
    Route::post('/registrasi', [AuthController::class, 'registrasi']);


    //HALAMAN LOGIN DESA
    Route::get('/login', function () {
        return view('auth/login');
    })->name('login');
    //PROSES LOGIN DESA
    Route::post('/login', [AuthController::class, 'login']);

    //HALAMAN LOGIN ADMIN
    Route::get('/admin/login', function () {
        return view('auth/admin_login');
    })->name('admin.login');
    //PROSES LOGIN DESA
    Route::post('/admin/login', [AuthController::class, 'admin_login']);

    //HALAMAN REGISTRASI PENGGUNA ADMIN
    Route::get('/admin/registrasi', function () {
        return view('auth/admin_registrasi');
    })->name('admin.registrasi');
    //PROSES REGISTRASI PENGGUNA ADMIN
    Route::post('/admin/registrasi', [AuthController::class, 'admin_registrasi']);

    //HALAMAN LOGIN SUPER_ADMIN
    Route::get('/super_admin/login', function () {
        return view('auth/super_admin_login');
    });
    //PROSES LOGIN SUPER_ADMIN
    Route::post('/super_admin/login', [AuthController::class, 'super_admin_login']);

    //HALAMAN REGISTRASI PENGGUNA ADMIN
    Route::get('/super_admin/registrasi', function () {
        return view('auth/super_admin_registrasi');
    })->name('super_admin.registrasi');
    //PROSES REGISTRASI PENGGUNA ADMIN
    Route::post('/super_admin/registrasi', [AuthController::class, 'super_admin_registrasi']);
});

//HALAMAN CEK EMAIL
Route::get('/email/verify', function () {
    return view('auth.verify_email');
})->middleware('auth')->name('verification.notice');

//HALAMAN SETELAH VERIFIKASI EMAIL
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/home', function () {
        return view('beranda');
    })->name('beranda');

    //HALAMAN EDIT USER
    Route::get('/edit/user', function () {
        $user = Auth::user();
        $desas = Desa::all();
        return view('edit_user', ['user' => $user, 'desas' => $desas]);
    })->name('halaman.edit.user');

    //LOGOUT
    Route::get('/signout', [AuthController::class, 'logout'])->name('signout');

    //HALAMAN DESA
    Route::get('/desa', [ViewController::class, 'desa'])->name('desa');


    //MIDDLEWARE ROLE: SUPER_ADMIN, ADMIN
    Route::middleware(['role_not:desa'])->group(function () {
        //DELETE DESA
        Route::delete('desa/delete/{desa}', [ContentController::class, 'delete_desa'])->name('delete.desa');
        //HALAMAN EDIT DESA
        Route::get('/edit/desa/{desa}', [ViewController::class, 'edit_desa'])->name('halaman.edit.desa');
        //PROSES EDIT DESA
        Route::post('/edit/desa/{desa}', [ContentController::class, 'edit_desa'])->name('edit.desa');
        //PROSES TAMBAH DESA
        Route::post('/tambah/desa', [ContentController::class, 'create_desa'])->name('tambah.desa');
        //HALAMAN TAMBAH DESA
        Route::get('/tambah/desa', [ViewController::class, 'tambah_desa'])->name('halaman.tambah.desa');

        //EXPORT EXCEL LAPORAN
        Route::get('/laporan/export-excel', [ContentController::class, 'export_excel_laporan'])->name('export.excel.laporan');

        //EXPORT PDF LAPORAN
        Route::get('/laporan/export-pdf', [ContentController::class, 'export_pdf_laporan'])->name('export.pdf.laporan');
    });



    //UMKM, DESA or ALL
    Route::get('/halaman_umkm', [ViewController::class, 'umkm_desa_xor_all'])->name('halaman_umkm');

    //HALAMAN UMKM ALL
    Route::get('/umkm', [ViewController::class, 'umkm'])->name('umkm');

    //HALAMAN UMKM DESA
    Route::get('/umkm_desa', [ViewController::class, 'umkm_desa'])->name('umkm_desa');

    //HALAMAN RINCIAN DESA
    Route::get('/rincian/desa/{desa}', [ViewController::class, 'rincian_desa'])->name('halaman.rincian.desa');

    //HALAMAN EDIT atau RINCIAN, DESA
    Route::get('/details/desa/{desa}', [ContentController::class, 'desa_details'])->name('desa.details');

    //MIDDLEWARE ROLE: SUPER_ADMIN, DESA
    Route::middleware(['role_not:admin'])->group(function () {
        //DELETE UMKM
        Route::delete('umkm/delete/{umkm}', [ContentController::class, 'delete_umkm'])->name('delete.umkm');
        //HALAMAN TAMBAH UMKM
        Route::get('/tambah/umkm', [ViewController::class, 'tambah_umkm'])->name('halaman.tambah.umkm');

        //PROSES TAMBAH UMKM
        Route::post('/tambah/umkm', [ContentController::class, 'create_umkm'])->name('tambah.umkm');
        //PROSES EDIT UMKM
        Route::post('/edit/umkm/{umkm}', [ContentController::class, 'edit_umkm'])->name('edit.umkm');
        //DELETE BUMDES
        Route::delete('/bumdesa/delete/{bumdesa}', [ContentController::class, 'delete_bumdesa'])->name('delete.bumdesa');
        //HALAMAN TAMBAH BUMDESA
        Route::get('/tambah/bumdesa', [ViewController::class, 'tambah_bumdesa'])->name('halaman.tambah.bumdesa');

        //PROSES TAMBAH BUMDESA
        Route::post('/tambah/bumdesa', [ContentController::class, 'create_bumdesa'])->name('tambah.bumdesa');

        //PROSES EDIT BUMDES
        Route::post('/edit/bumdesa/{bumdesa}', [ContentController::class, 'edit_bumdesa'])->name('edit.bumdesa');

        //HALAMAN EDIT UMKM
        Route::get('/edit/umkm/{umkm}', [ViewController::class, 'edit_umkm'])->name('halaman.edit.umkm');

        //HALAMAN EDIT BUMDESA
        Route::get('/edit/bumdesa/{bumdesa}', [ViewController::class, 'edit_bumdesa'])->name('halaman.edit.bumdesa');

        //HALAMAN EDIT LAPORAN
        Route::get('/edit/laporan/{laporan}', [ViewController::class, 'edit_laporan'])->name('halaman.edit.laporan');

        //HALAMAN TAMBAH LAPORAN
        Route::get('/tambah/laporan', [ViewController::class, 'tambah_laporan'])->name('halaman.tambah.laporan');

        //PROSES EDIT LAPORAN
        Route::post('/rincian/laporan/{laporan}', [ContentController::class, 'edit_laporan'])->name('edit.laporan');

        //PROSES DELETE LAPORAN
        Route::delete('/laporan/delete/{laporan}', [ContentController::class, 'delete_laporan'])->name('delete.laporan');

        //PROSES TAMBAH LAPORAN
        Route::post('/tambah/laporan', [ContentController::class, 'create_laporan'])->name('tambah.laporan');
    });

    //HALAMAN LAPORAN, DESA or ALL
    Route::get('/halaman_laporan', [ViewController::class, 'laporan_desa_xor_all'])->name('halaman_laporan');

    //HALAMAN RINCIAN LAPORAN
    Route::get('/rincian/laporan/{laporan}', [ViewController::class, 'rincian_laporan'])->name('halaman.rincian.laporan');

    //HALAMAN RINCIAN atau EDIT, UMKM
    Route::get('/details/laporan/{laporan}', [ViewController::class, 'laporan_details'])->name('laporan.details');

    //HALAMAN RINCIAN atau EDIT, UMKM
    Route::get('/details/umkm/{umkm}', [ViewController::class, 'umkm_details'])->name('umkm.details');

    //HALAMAN RINCIAN atau EDIT, BUMDESA
    Route::get('/details/bumdesa/{bumdesa}', [ViewController::class, 'bumdesa_details'])->name('bumdesa.details');


    //HALAMAN RINCIAN UMKM
    Route::get('/rincian/umkm/{umkm}', [ViewController::class, 'rincian_umkm'])->name('halaman.rincian.umkm');

    //BUMDESA, DESA or ALL
    Route::get('/halaman_bumdesa', [ViewController::class, 'bumdesa_desa_xor_all'])->name('halaman_bumdesa');
    //HALAMAN BUMDESA
    Route::get('/bumdesa', [ViewController::class, 'bumdesa'])->name('bumdesa');

    //HALAMAN BUMDESA DESA
    Route::get('/bumdesa_desa', [ViewController::class, 'bumdesa_desa'])->name('bumdesa_desa');

    //HALAMAN RINCIAN BUMDESA
    Route::get('/rincian/bumdesa/{bumdesa}', [ViewController::class, 'rincian_bumdesa'])->name('halaman.rincian.bumdesa');

    //EXPORT EXCEL DESA
    Route::get('/desa/export-excel', [ContentController::class, 'export_excel_desa'])->name('export.excel.desa');

    //EXPORT PDF DESA
    Route::get('/desa/export-pdf', [ContentController::class, 'export_pdf_desa'])->name('export.pdf.desa');

    //EXPORT PDF BUMDESA
    Route::get('/bumdesa/export-pdf', [ContentController::class, 'export_pdf_bumdesa'])->name('export.pdf.bumdesa');

    //EXPORT EXCEL BUMDesa
    Route::get('/bumdesa/export-excel', [ContentController::class, 'export_excel_bumdesa'])->name('export.excel.bumdesa');


    //EXPORT EXCEL UMKM
    Route::get('/umkm/export-excel', [ContentController::class, 'export_excel_umkm'])->name('export.excel.umkm');

    //EXPORT PDF UMKM
    Route::get('/umkm/export-pdf', [ContentController::class, 'export_pdf_umkm'])->name('export.pdf.umkm');


    //EXPORT PDF UMKM DESA
    Route::get('/umkm/export-pdf/desa', [ContentController::class, 'export_pdf_umkm_desa'])->name('export.pdf.umkm.desa');

    //EXPORT PDF BUMDESA DESA
    Route::get('/bumdesa/export-pdf/desa', [ContentController::class, 'export_pdf_bumdesa_desa'])->name('export.pdf.bumdesa.desa');

    //EXPORT EXCEL LAPORAN
    Route::get('/umkm/export-excel/desa', [ContentController::class, 'export_excel_umkm_desa'])->name('export.excel.umkm.desa');

    //EXPORT EXCEL LAPORAN
    Route::get('/bumdesa/export-excel/desa', [ContentController::class, 'export_excel_bumdesa_desa'])->name('export.excel.bumdesa.desa');

    //EXPORT EXCEL LAPORAN
    Route::get('/laporan/export-pdf/desa', [ContentController::class, 'export_pdf_laporan_desa'])->name('export.pdf.laporan.desa');

    //EXPORT EXCEL LAPORAN
    Route::get('/laporan/export-excel/desa', [ContentController::class, 'export_excel_laporan_desa'])->name('export.excel.laporan.desa');
});



Route::get('/belajar', function () {
    dd((Auth::user()->desa));
});
