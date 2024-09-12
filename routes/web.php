<?php
use App\Http\Controllers\CalculationController;
use Illuminate\Support\Facades\Route;
use App\Models\Student;
use App\Models\Course;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::get('/calculate', [CalculationController::class, 'showForm'])->name('calculate.form');
Route::post('/calculate', [CalculationController::class, 'calculate'])->name('calculate.result');


Route::get('/saludo', [App\Http\Controllers\mensajesController::class, 'saludo'])->name('saludo.form');


Route::get('/create-student', function() {
     $student = new Student();
     $student->name = 'Mariano Espinoza';
     $student->email = 'mariano.espinoza@example.com';
     $student->course_id = 2; // Asegúrate de que el curso con ID 1 exista
     $student->save();
        return 'Estudiante creado exitosamente';
    });


    Route::get('/create-course', function() {
        $course = new Course();
        $course->name = 'Programación';        
        $course->save();
           return 'Curso creado exitosamente';
       });
    

       Route::get('/student', function () {
        $students = Student::all();
    
        foreach ($students as $student) {
            echo  $student->id.'-'.$student->name.'-'.$student->email .'-'.$student->course_id. '<br>';
        }
       });


      Route::get('/course', function() {
        $courses = Course::all();
    
        foreach ($courses as $course) {
            echo $course->id . ' - ' . $course->name . ' - ' . '<br>';
        }
        });


     Route::get('/add-student-to-course/{student_id}/{course_id}', function ($student_id, $course_id) {
            $student = Student::find($student_id);
            $course = Course::find($course_id);
        
            if ($student && $course) {
                $student->course()->associate($course);
                $student->save();
                return "El estudiante ha sido agregado al curso.";
            } else {
                return "El estudiante o el curso no se encontraron.";
            }
        });



Route::get('/get-course-with-students/{course_id}', function ($course_id) {
    $course = Course::with('students')->find($course_id);
    
    if ($course) {
        return $course->students;  // Muestra la lista de estudiantes
    } else {
        return "El curso no se encontró.";
    }
});