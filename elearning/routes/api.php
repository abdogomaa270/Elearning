<?php

use App\Http\Controllers\AuthController;
use App\project\Categories\Controllers\CategController;
use App\project\Courses\Controllers\CourseController;
use App\project\Instructors\Controllers\InstructorsController;
use App\project\Lessons\Controllers\LessonController;
use App\project\ManageCourses\Controllers\DashboardController;
use App\project\ManageCourses\Controllers\PayCourseController;
use App\project\MoneyRequests\controllers\RequestsController;
use App\project\pdf\Controllers\PdfContoller;
use App\project\Profile\Controllers\ProfileController;
use App\project\quizzes\Controller\QuizController;
use App\project\SubCategories\Controllers\SubCategController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
/*-----------------------------------------------------------------------------------------------------*/

Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);
Route::get('logout',[AuthController::class,'logout'])->middleware('verifyJwt');
Route::post('changePassword',[AuthController::class,'changePassword']);
Route::delete('deleteAccount',[AuthController::class,'deleteAccount']);

/*-----------------------------------------------------------------------------------------------------*/
Route::controller(CategController::class)->group(function () {
    Route::get('showall/categ', 'showall');
    Route::get('show/categ/{id}', 'show');
    Route::get('getrelated/categ/{id}', 'get_Related_Subcateg');

    Route::middleware(['verifyJwt','isAdmin'])->group(function () {
        Route::post('store/categ', 'store');
        Route::post('update/categ/{id}', 'update');
        Route::get('destroy/categ/{id}', 'destroy');
    });
});

/*-----------------------------------------------------------------------------------------------------*/

Route::controller(SubCategController::class)->group(function () {
    Route::get('showall/SubCateg','showall');
    Route::get('show/SubCateg/{id}', 'show');
    Route::get('getrelated/SubCateg/{id}','get_Related_courses');

    Route::middleware(['verifyJwt','isAdmin'])->group(function(){
        Route::get('destroy/SubCateg/{id}', 'destroy');
        Route::post('store/SubCateg', 'store');
        Route::post('update/SubCateg/{id}', 'update');

    });

});
/*-----------------------------------------------------------------------------------------------------*/
Route::controller(InstructorsController::class)->group(function () {
    Route::get('showall/instructors','showall');
    Route::get('show/instructors/{id}', 'show');
    Route::get('getrelated/instructors/{id}','get_Related_courses');

    Route::middleware(['verifyJwt','isAdmin'])->group(function(){
        Route::post('store/instructors', 'store');
        Route::post('update/instructors/{id}', 'update');
        Route::get('destroy/instructors/{id}', 'destroy');

    });

});
/*-----------------------------------------------------------------------------------------------------*/
Route::controller(CourseController::class)->group(function () {
    Route::get('showall/courses','showall');
    Route::get('show/courses/{id}', 'show');

    Route::middleware(['verifyJwt','isAdmin'])->group(function(){
        Route::get('destroy/courses/{id}', 'destroy');
        Route::post('store/courses', 'store');
        Route::post('update/courses/{id}', 'update');

    });

    Route::middleware(['verifyJwt','ispaid'])->group(function(){
        Route::get('getrelated/courses/{id}','get_Related_lessons');
     });

});
/*-----------------------------------------------------------------------------------------------------*/
Route::controller(LessonController::class)->group(function () {
    Route::get('showall/lessons','showall');
    Route::get('show/lessons/{id}', 'show');

    Route::middleware(['verifyJwt','isAdmin'])->group(function(){
        Route::get('destroy/lessons/{id}', 'destroy');
        Route::post('store/lessons', 'store');
        Route::post('update/lessons/{id}', 'update');

    });

});
/*------------------------------------------------------------------------------------------------------*/
Route::middleware(['verifyJwt','isAdmin'])->controller(DashboardController::class)->group(function () {
    Route::get('showall/users','users');
    Route::get('GetCourses', 'Courses_state');
    Route::get('GetUsers', 'User_state');
});
/*------------------------------------------------------------------------------------------------------*/
Route::get('payCourse/{id}',[PayCourseController::class,'PayCourse'])->middleware('verifyJwt');
/*------------------------------------------------------------------------------------------------------*/

Route::middleware('verifyJwt')->controller(QuizController::class)->group(function () {
    Route::get('show/quiz/{$courseId}', 'show'); // show quiz of specific course

    Route::middleware(['isAdmin'])->group(function(){
        Route::post('store/quiz', 'store');
        Route::get('showall/quiz','showall');
     });

});
/*------------------------------------------------------------------------------------------------------*/

Route::middleware('verifyJwt')->controller(PdfContoller::class)->group(function () {

    Route::middleware(['isAdmin'])->group(function(){
        Route::post('store/pdf', 'store');
        Route::get('showall/pdf','showall');
        Route::get('destroy/pdf/{id}','destroy');
    });

    Route::get('show/pdf/{courseId}', 'show');
});
/*------------------------------------------------------------------------------------------------------*/
// 15 may 2023  -> money_Request
//,'isAdmin'
Route::middleware(['verifyJwt'])->controller(RequestsController::class)->group(function () {
    Route::post('store/request', 'store');

    Route::middleware(['isAdmin'])->group(function(){
        Route::get('showallPending/requests','showallPending');
        Route::delete('destroy/request/{id}','destroy');
        Route::put('accept/request/{reqId}/{userId}','acceptRequest');;
        Route::get('show/request/{id}', 'show');
        Route::get('showall/requests','showall');
    });
});
/*------------------------------------------------------------------------------------------------------*/
Route::middleware(['verifyJwt'])->controller(ProfileController::class)->group(function () {
    Route::get('set/certi/{id}','setCerificate');
    Route::get('show/certi', 'getMyCertificates');
    Route::get('show/myCourses', 'getMyCourses');
    Route::get('myData','myData');

});

