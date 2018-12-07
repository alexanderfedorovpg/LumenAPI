<?php

	namespace App\Models;


	use Illuminate\Database\Eloquent\Model;

	class Author extends Model {

		protected $fillable = [ 'name' ];
		protected $hidden = [ 'created_at', 'updated_at' ];

		public function books() {

			return $this->belongsToMany( Book::class );

		}


	}