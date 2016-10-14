<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enroll extends Model{
	/**
     * pre-work table associated with the model Prework.
     * @var string
     */
	protected $table = 'enroll';
	protected $primaryKey = 'id';

}
