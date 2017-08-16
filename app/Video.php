<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
	protected $table = 'videos';

	protected $fillable = [
	'id', 'title', 'logo', 'description', 'channel_id', 'is_active', 'is_deleted' ];


	        public function channel(){
            return $this->belongsTo('\App\Channel');
        }

}
