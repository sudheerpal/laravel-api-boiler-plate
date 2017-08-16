<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
	protected $table = 'channels';

	protected $fillable = [
	'id', 'title', 'logo', 'description', 'is_active', 'is_deleted' ];

	public function videos(){
	return $this->hasMany('\App\Video');
	}
	

}
