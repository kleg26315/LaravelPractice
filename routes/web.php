<?php

use Illuminate\Support\Facades\Route;
use Http\Controllers\HomeController;

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

// 무조건 get 요청
Route::get('/', function () {
    return view('welcome');
})->name('home');
// 라우트 이름 부여하기
// 이름을 지정하면 나중에 라우트가 변경되더라도
// 그저 이름으로 접근하기 때문에 유지보수성 향상
// 방법 : ->name('')

// 모든 HTTP Method 대응
Route::any('/', function(){
    return view('welcome');
});

// Route::match()는 특정 메소드에서만
Route::match(['get', 'post'], '/', function(){
    return view('welcome');
});

// 라우트에 매치가 되지 않았을 때 = fallback
Route::fallback(function(){
    return view('welcome');
});


// 라우트 그룹
// 여러 개의 라우트를 묶을 때 사용
// Route::group(function(){
//     Route::get('/', function(){
//         return view('welcome');
//     });
// });

// Route prefix 'users'
Route::prefix('users')->group(function(){
    Route::get('/', function(){
        return view('welcome');
    });
});

// With 'auth' middleware
Route::middleware('auth')->group(function(){
    Route::get('/', function(){
        return view('welcome');
    });
});

// 뷰
// 간단하게 페이지만을 띄우기 위함이라면 Route::view()를 이용
Route::view('/csrf', 'csrf');

// 라우트에서 컨트롤러로 바로 쏘기
// 네임스페이스를 포함한 컨트롤러의 경로와 메소드의 이름을 튜플로 전달하면 됨
Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

// 리소스 컨트롤러
// 리소스 컨트롤러는 라우트 구성을 RESTful 한 URL 인터페이스로 구성할 수 있다.
// RESTful한 구조에서는 하나의 리소스에 대해 라우트를 알기 쉽도록 구성한다.
Route::resource('tasks', App\Http\Controllers\TaskController::class);

// php artisan route:list 명령어를 치면 라우트 목록을 볼 수 있다
/*
+--------+-----------+-------------------+---------------+---------------------------------------------+------------+
| Domain | Method    | URI               | Name          | Action                                      | Middleware |
+--------+-----------+-------------------+---------------+---------------------------------------------+------------+
|        | GET|HEAD  | tasks             | tasks.index   | App\Http\Controllers\TaskController@index   | web        |
|        | POST      | tasks             | tasks.store   | App\Http\Controllers\TaskController@store   | web        |
|        | GET|HEAD  | tasks/create      | tasks.create  | App\Http\Controllers\TaskController@create  | web        |
|        | GET|HEAD  | tasks/{task}      | tasks.show    | App\Http\Controllers\TaskController@show    | web        |
|        | PUT|PATCH | tasks/{task}      | tasks.update  | App\Http\Controllers\TaskController@update  | web        |
|        | DELETE    | tasks/{task}      | tasks.destroy | App\Http\Controllers\TaskController@destroy | web        |
|        | GET|HEAD  | tasks/{task}/edit | tasks.edit    | App\Http\Controllers\TaskController@edit    | web        |
+--------+-----------+-------------------+---------------+---------------------------------------------+------------+
*/

// 파라미터
// 라우트에는 파라미터를 받을 수 있다.
// 예를 들어 위와 같은 라우트에서 {task}가 바로 파라미터에 해당한다.
// tasks.show에 해당하는 컨트롤러 코드를 보면 파라미터로 $id가 있는 것을 볼 수 있는데
// GET tasks/27로 요청했다면 27가 할당된다.

// + 파라미터를 정의할 때 정규표현식을 사용하여 패턴에 일치하는 경우에만 일치시킬 수도 있다.
// 정규표현식
Route::get('posts/{id}/{slug}', function ($id, $slug) {

})->where(['id' => '[0-9]+', 'slug' => '[a-Za-z]+']);
// 그 외에 whereNumber(), whereAlpha(), whereAlphaNumber() 도 존재하여
// 라우트 파라미터에 따라 사용할 수 있다.

