<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model{
	/**
     * pre-work table associated with the model Prework.
     * @var string
     */
	protected $table = 'grades';
	protected $primaryKey = 'id';

}
