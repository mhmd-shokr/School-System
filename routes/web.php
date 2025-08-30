<?php

use App\Http\Controllers\Web\V1\Grades\GradeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\V1\classrooms\ClassroomController;
use App\Http\Controllers\Web\V1\sections\SectionController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Livewire\AddParent;
use Livewire\Livewire;

Route::middleware('guest')->group(function(){
    Route::get('/', function () {
        return view('auth.login');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [
        'localeSessionRedirect',
        'localizationRedirect',
        'localeViewPath',
        'auth',
        'verified'
    ]
], function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    Livewire::setUpdateRoute(function($handle){
        return Route::post('/livewire/update',$handle);
    });

    Route::resource('grade',GradeController::class);
    Route::resource('classrooms',ClassroomController::class);
    Route::delete('delete_all',[ClassroomController::class,'delete_all'])->name('delete_all');
    Route::get('filterClassRoom',[ClassroomController::class,'filterClassRoom'])->name('classrooms.filter');
    Route::resource('Sections',SectionController::class);
    Route::get('/classes/{id}',[SectionController::class,'getClasses']);


    Route::get('/Add_Parent', function () {
        return view('livewire.show_form');
    });


});




require __DIR__.'/auth.php';
