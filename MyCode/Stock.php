<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
	// Указываем таблицу
	protected $table = 'stock';
	
	// Отключаем время created & updated 
	public $timestamps = false;
	
	// Даем разрешение для массовой записи
	protected $fillable = [
		'id',
		'name',
		'start_at',
		'finish_at',
		'status',
		'url'
	];
}
