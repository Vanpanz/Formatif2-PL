<?php

use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SchoolClass\IndexController;
use App\Http\Controllers\SchoolClass\CreateController;
use App\Http\Controllers\SchoolClass\ShowController;
use App\Http\Controllers\SchoolClass\EditController;
use App\Http\Controllers\SchoolClass\StoreController;
use App\Http\Controllers\SchoolClass\UpdateController;
use App\Http\Controllers\SchoolClass\DestroyController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

//Authentication
Route::get('/login', [AuthController::class, 'loginView'])->name('login-view')->middleware('guest');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login-post')->middleware('guest');
Route::get('/register', [AuthController::class, 'registerView'])->name('register-view')->middleware('guest');
Route::post('/register', [AuthController::class, 'registerPost'])->name('register-post')->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');


//Manajemen Data Siswa (Action Controller)
Route::name('students.')->middleware(['role:student,teacher', 'auth'])->prefix('students')->group(function(){

    //Halaman Daftar Siswa
    Route::get('/', [StudentController::class, 'index'])->name('index');

    //Halaman Tambah Siswa
    Route::get('/create', [StudentController::class, 'create'])->name('create');

    //Halaman Detail Siswa
    Route::get('/{student}', [StudentController::class, 'show'])->name('show');

    //Halaman Edit Siswa
    Route::get('/{student}/edit', [StudentController::class, 'edit'])->name('edit');

    //Logika Tambah Siswa
    Route::post('/', [StudentController::class, 'store'])->name('store');

    //Logika Edit Siswa
     Route::put('/{student}', [StudentController::class, 'update'])->name('update');

    //Logika Menghapus Siswa
     Route::delete('/{student}', [StudentController::class, 'destroy'])->name('destroy');
});

//Manajemen Data Guru (Action Controller)
Route::name('teachers.')->middleware(['role:teacher', 'auth'])->prefix('teachers')->group(function(){
    Route::get('/', [TeacherController::class, 'index'])->name('index');
        
    Route::get('/create', [TeacherController::class, 'create'])->name('create');

    Route::get('/{id}', [TeacherController::class, 'show'])->name('show');  

    Route::get('/{id}/edit', [TeacherController::class, 'edit'])->name('edit');

    Route::post('/', [TeacherController::class, 'store'])->name('store');

    Route::put('/{$id}', [TeacherController::class, 'update'])->name('update');

    Route::delete('/{$id}', [TeacherController::class, 'destroy'])->name('destroy');        
    
});

//Manajemen School Class (Invokable)
Route::name('classes.')->middleware(['role:teacher', 'auth'])->prefix('classes')->group(function(){

    
    Route::get('/', IndexController::class)->name('index');

    Route::get('/create', CreateController::class)->name('create');

    Route::get('/{id}', ShowController::class)->name('show');

    Route::get('/{id}/edit', EditController::class)->name('edit');

    Route::post('/', StoreController::class)->name('store');

    Route::put('/{$id}', UpdateController::class)->name('update');

    Route::delete('/{$id}', DestroyController::class)->name('destroy');
});

//manajemen major controller (resource)
Route::resource('majors', MajorController::class)->middleware(['role:teacher', 'auth'])
    ->parameters(['majors' => 'id']);