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



	public static function translit($text, $lang) {
		$alphabet = ["а" => "a","ый" => "iy","ые" => "ie","б" => "b","в" => "v","г" => "g","д" => "d","е" => "e","ё" => "yo","ж" => "zh","з" => "z",
				"и" => "i","й" => "y","к" => "k","л" => "l","м" => "m","н" => "n","о" => "o","п" => "p","р" => "r","с" => "s","т" => "t","у" => "u",
				"ф" => "f","х" => "kh","ц" => "ts","ч" => "ch","ш" => "sh","щ" => "shch","ь" => "","ы" => "y","ъ" => "","э" => "e","ю" => "yu",
				"я" => "ya","йо" => "yo","ї" => "yi","і" => "i","є" => "ye","ґ" => "g"];
		$text = strtr($text, $alphabet);
		$text = preg_replace('/\s+/', ' ', $text);
		$text = strtolower($text);
		$text = preg_replace("/[^a-z0-9\s]+/", '', $text); 
		$array = preg_split('/\s+/', $text);
		$array = array_filter($array, function($item) {
			return trim($item) !== "";
		});
		$array = array_unique($array);
		$text = implode('-', $array);
		return $text;
	}
}