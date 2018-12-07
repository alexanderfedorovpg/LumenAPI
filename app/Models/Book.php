<?php

	namespace App\Models;


	use Illuminate\Database\Eloquent\Model;

	class Book extends Model {

		protected $fillable = [ 'title' ];
		protected $hidden = [ 'created_at', 'updated_at' ];

		public function author() {

			return $this->belongsToMany( Author::class );

		}

	}