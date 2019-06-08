<?php

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

// Route::get('/', function () {
    // return view('home');

    // return view('welcome');
    // echo "
    //   <p><a href='/contacto'>Contacto</a></p>
    //   <p><a href='/contacto'>Contacto</a></p>
    //   <p><a href='/contacto'>Contacto</a></p>
    //   <p><a href='/contacto'>Contacto</a></p>
    //   <p><a href='/contacto'>Contacto</a></p>
    // ";
    // echo "
    //   <p><a href='".route('contact')."'>Contacto</a></p>
    //   <p><a href='".route('contact')."'>Contacto</a></p>
    //   <p><a href='".route('contact')."'>Contacto</a></p>
    //   <p><a href='".route('contact')."'>Contacto</a></p>
    //   <p><a href='".route('contact')."'>Contacto</a></p>
    // ";
// })->name('home');

// Route::get('/', function () {
//     $name = 'Samuel';
//     return view('home', compact('name'));
// })->name('home');

// Route::view('/', 'home', ['name'=>'Samuel'])->name('home'); // Usar este método en páginas con poca o nula información como políticas de privacidad, terminos y condiciones de servicio, etc.

// Route::get('contacto', function () {
//     return 'Hola desde la página de contacto';
// })->name('contact'); // Rute con nombre buena practica

// // Ruta con parametro
// Route::get('saludo2/{name}', function (String $name='Invitado') {
//     return "Hola {$name}";
// });
// // Ruta con parametro no obligatorio
// Route::get('saludo/{name?}', function (String $name='Invitado') {
//     return "Hola {$name}";
// })->where(['name'=>'a-zA-Z']);

// Routes
// Route::get()
// Route::post()
// Route::put()
// Route::patch()
// Route::delete()

// Route::view('/', 'home')->name('home');
// Route::view('about', 'about')->name('about');
// Route::view('contact', 'contact')->name('contact');
// Route::post('contact', 'MessagesController@store')->name('contact.store');

// Route::get('portfolio', 'PortfolioController@index')->name('portfolio'); // ->only([]) ->except([])
// Route::resource(routeNameByLang('portfolio', $lang), 'PortfolioController', [
//             'names' => [
//                 'index' => "{$lang}.portfolio.index",
//             ]
//             ]);


// Default route
// Route::get('/', function () {
//     return redirect('/es');
// });

// Langs for routing
// $langs = ['es','en'];

// foreach ($langs as $key => $lang) {
//     Route::group(
//         [
//           'prefix'=> $lang,
//           'middleware' => 'localization',
//         ],
//         function () use ($lang) {
//             Route::view('/', 'home')->name("{$lang}.home"); //->middleware('example');
//             Route::view(getUriByLang('about', $lang), 'about')->name(getRouteNameByLang('about', $lang));
//             // Route::view(getUriByLang('contact', $lang), 'contact')->name(getRouteNameByLang('contact', $lang));
//             Route::get(getUriByLang('portfolio', $lang), 'ProjectController@index')->name(getRouteNameByLang('projects.index', $lang));
//             /**
//              * ! Las rutas deben estar ordenadas
//              * ! Las rutas funcionan como un switch y el orden es importante
//              */
//             Route::get(getUriByLang('portfolio', $lang).'/'.__('create', [], $lang), 'ProjectController@create')->name(getRouteNameByLang('projects.create', $lang));
//             Route::post(getUriByLang('portfolio', $lang).'/', 'ProjectController@store')->name(getRouteNameByLang('projects.store', $lang));
//             Route::get(getUriByLang('portfolio', $lang).'/{project}', 'ProjectController@show')->name(getRouteNameByLang('projects.show', $lang));

//             Route::get(getUriByLang('messages', $lang), 'MessageController@index')->name(getRouteNameByLang('messages.index', $lang));
//             Route::get(getUriByLang('messages', $lang).'/'.__('create', [], $lang), 'MessageController@create')->name(getRouteNameByLang('messages.create', $lang));
//             Route::get(getUriByLang('messages', $lang).'/{id}', 'MessageController@show')->name(getRouteNameByLang('messages.show', $lang));
//             Route::get(getUriByLang('messages', $lang).'/{id}/'.__('edit', [], $lang), 'MessageController@edit')->name(getRouteNameByLang('messages.edit', $lang));
//             Route::post(getUriByLang('messages', $lang), 'MessageController@store')->name(getRouteNameByLang('messages.store', $lang));
//             Route::put(getUriByLang('messages', $lang).'/{id}', 'MessageController@update')->name(getRouteNameByLang('messages.update', $lang));
//             Route::delete(getUriByLang('messages', $lang).'/{id}', 'MessageController@destroy')->name(getRouteNameByLang('messages.destroy', $lang));
//             // Route::resource(getUriByLang('messages', $lang), 'MessageController');
//         }
//     );
// }
// Route::get('test', function () {
//     $user = new \App\User();
//     $user->name = 'Samuel';
//     $user->email = 'samuel@gmail.com';
//     $user->password = \Hash::make('password');
//     $user->save();

//     return $user;
// });

Route::view('/', 'home')->name("home");
Route::view('/acerca-de', 'about')->name('about');
Route::resource('portafolio', 'ProjectController')->names('projects');
Route::resource('mensajes', 'MessageController')->names('messages');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout');
