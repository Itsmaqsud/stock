<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
	protected $table = 'stock';

	public $timestamps = false;
	protected $fillable = [
		'id',
		'name',
		'start_at',
		'finish_at',
		'status',
		'url'
	];
}