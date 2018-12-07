<?php

	namespace App\Http\Controllers;


	use App\Models\Author;
	use Illuminate\Http\Request;

	class AuthorController extends ApiController {
		/**
		 * Получить всех авторов
		 **/
		public function getAuthors() {
			try {
				$author = Author::all()->sortBy( 'name' );

				return $this->respond( $author );
			} catch ( ModelNotFoundException $e ) {
				return $this->respondNotFound( $e->getMessage() );
			} catch ( \Exception $e ) {
				return $this->respondFail500x( $e->getMessage() );
			}

		}

		/** Добавление автора
		 *
		 * @param Request $request
		 *
		 * @return \Illuminate\Http\JsonResponse
		 */
		public function addAuthor( Request $request ) {
			try {
				$this->validate( $request, [
					'name' => 'required|unique|max:255',
				] );

				$name         = $request->input( 'name' );
				$author       = new Author();
				$author->name = $name;
				$author->save();

				return $this->respondCreated( 'Author is created' );

			} catch ( ModelNotFoundException $e ) {
				return $this->respondNotFound( $e->getMessage() );
			} catch ( \Exception $e ) {
				return $this->respondFail500x( $e->getMessage() );
			}

		}

		/** Обновление автора
		 *
		 * @param Request $request
		 *
		 * @return \Illuminate\Http\JsonResponse
		 */
		public function updateAuthor( Request $request ) {
			try {
				$this->validate( $request, [
					'id'   => 'required|numeric',
					'name' => 'required|unique|max:255',
				] );

				$id           = $request->input( 'id' );
				$name         = $request->input( 'name' );
				$author       = Author::find( $id );
				$author->name = $name;
				$author->save();

				return $this->respondCreated( "Author id=$id is update" );

			} catch ( ModelNotFoundException $e ) {
				return $this->respondNotFound( $e->getMessage() );
			} catch ( \Exception $e ) {
				return $this->respondFail500x( $e->getMessage() );
			}


		}

		public function getq() {
			return $this->respondCreated( "Author id= is update" );
		}
	}