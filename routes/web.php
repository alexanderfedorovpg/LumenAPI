<?php
	/*
	|--------------------------------------------------------------------------
	| Application Routes
	|--------------------------------------------------------------------------
	|
	| Here is where you can register all of the routes for an application.
	| It is a breeze. Simply tell Lumen the URIs it should respond to
	| and give it the Closure to call when that URI is requested.
	|
	*/

	$router->group( [ 'prefix' => 'api' ], function ( $group ) {
		$group->options( '/{any:.*}', function () {
			$headers =
				[
					'Access-Control-Allow-Origin'   => '*',
					'Access-Control-Allow-Headers'  => [ 'Content-Type, Api-Token' ],
					'Access-Control-Request-Method' => [ 'POST, GET, PUT, OPTIONS, DELETE' ],
					'Access-Control-Allow-Methods'  => [ 'POST, GET, OPTIONS, PUT, DELETE' ],

				];

			return response()->json( [], 200, $headers );
		} );
		$group->get( '/author', 'AuthorController@getAuthors' );    // получить всех авторов
		$group->post( '/author', 'AuthorController@addAuthor' );    // добавить автора
		$group->put( '/author', 'AuthorController@updateAuthor' );  // обновить автора

		$group->get( '/books', 'BookController@getBooks' );         // получить все книги и их авторов
		$group->post( '/book', 'BookController@addBook' );          //добавить книгу
		$group->put( '/book', 'BookController@updateBook' );        // обновить книгу

	} );


	$router->get( '/{any:.*}', function () {
		return response()->json( '404 Not found!', 404 );
	} );

