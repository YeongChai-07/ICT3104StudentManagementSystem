<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recommendation extends Model{
	/**
     * pre-work table associated with the model Prework.
     * @var string
     */
	protected $table = 'recommendation';
	protected $primaryKey = 'id';

}
