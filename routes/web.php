<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/add-students', [StudentController::class, 'addStudents'])->name('students.add'); 
Route::get('/admin/student/create', [StudentController::class, 'create'])->name('student.create'); 
Route::get('students/json', [StudentController::class, 'getAllStudentsJson'])->name('student.json');
Route::get('/students', [StudentController::class, 'index'])->name('student.index'); 
Route::get('/students/{id}/edit', [StudentController::class, 'edit'])->name('student.edit'); 
Route::put('/students/{id}', [StudentController::class, 'update'])->name('student.update'); 
Route::delete('/students/{id}', [StudentController::class, 'destroy'])->name('student.destroy'); 
Route::post('/students/store', [StudentController::class, 'store'])->name('student.store');