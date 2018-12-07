<?php

	namespace App\Http\Controllers;


	use App\Models\Book;
	use Illuminate\Http\Request;

	class BookController extends ApiController {

		/**
		 * Получить всех книги XML или JSON
		 **/
		public function getBooks( Request $request ) {
			try {
				$this->validate( $request, [
					'type' => 'max:255',
				] );
				$type  = $request->input( 'type' );
				$books = Book::with( 'author' )->get();

				return $type == 'xml' ? $this->respondXML( $books ) : $this->respond( $books );

			} catch ( ModelNotFoundException $e ) {
				return $this->respondNotFound( $e->getMessage() );
			} catch ( \Exception $e ) {
				return $this->respondFail500x( $e->getMessage() );
			}

		}


		/**  Добавления новой книги
		 *
		 * @param Request $request
		 *
		 * @return \Illuminate\Http\JsonResponse
		 */
		public function addBook( Request $request ) {
			try {
				$this->validate( $request, [
					'title' => 'required|unique|max:255',
				] );

				$title       = $request->input( 'title' );
				$book        = new Book;
				$book->title = $title;
				$book->save();

				return $this->respondCreated( 'Book is created' );

			} catch ( ModelNotFoundException $e ) {
				return $this->respondNotFound( $e->getMessage() );
			} catch ( \Exception $e ) {
				return $this->respondFail500x( $e->getMessage() );
			}


		}

		/** Обновление название книги
		 *
		 * @param Request $request
		 *
		 * @return \Illuminate\Http\JsonResponse
		 */
		public function updateBook( Request $request ) {
			try {
				$this->validate( $request, [
					'id'    => 'required|numeric',
					'title' => 'required|unique|max:255',
				] );

				$id          = $request->input( 'id' );
				$title       = $request->input( 'title' );
				$book        = Book::find( $id );
				$book->title = $title;
				$book->save();

				return $this->respondCreated( "Book id=$id is update" );

			} catch ( ModelNotFoundException $e ) {
				return $this->respondNotFound( $e->getMessage() );
			} catch ( \Exception $e ) {
				return $this->respondFail500x( $e->getMessage() );
			}


		}
	}