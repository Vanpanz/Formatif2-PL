<?php

use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

//Manajemen Data Siswa (Action Controller)
Route::name('students.')->prefix('students')->group(function(){

    //Halaman Daftar Siswa
    Route::get('/', [StudentController::class, 'index'])->name('index');

    //Halaman Tambah Siswa
    Route::get('/create', [StudentController::class, 'create'])->name('create');

    //Halaman Detail Siswa
    Route::get('/{id}', [StudentController::class, 'show'])->name('show');

    //Halaman Edit Siswa
    Route::get('/{id}/edit', [StudentController::class, 'edit'])->name('edit');

    //Logika Tambah Siswa
    Route::post('/', [StudentController::class, 'store'])->name('store');

    //Logika Edit Siswa
     Route::put('/{$id}', [StudentController::class, 'update'])->name('update');

    //Logika Menghapus Siswa
     Route::delete('/{$id}', [StudentController::class, 'destroy'])->name('destroy');
});

Route::name('teachers.')->prefix('teachers')->group(function(){
    Route::get('/', [TeacherController::class, 'index'])->name('index');
        
    Route::get('/create', [TeacherController::class, 'create'])->name('create');

    Route::get('/{id}', [TeacherController::class, 'show'])->name('show');  

    Route::get('/{id}/edit', [TeacherController::class, 'edit'])->name('edit');

    Route::post('/', [TeacherController::class, 'store'])->name('store');

    Route::put('/{$id}', [TeacherController::class, 'update'])->name('update');

    Route::delete('/{$id}', [TeacherController::class, 'destroy'])->name('destroy');        
    
});

