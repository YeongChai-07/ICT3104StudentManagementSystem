<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model{
	/**
     * pre-work table associated with the model Prework.
     * @var string
     */
	protected $table = 'module';
	protected $primaryKey = 'id';

}
