<?
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Stock;

class StockController extends Controller
{
	# For view database
	public function index() {
		$data = Stock::orderBy('id', 'desc')->get();
		return view('index', compact('data'));
	}

	# For exporting csv to database
	public function import() {
		$getFile = public_path('export.csv');
		$getData = $this->csvToArray($getFile);
		for ($i = 0; $i < count($getData); $i ++)
		{
			Stock::firstOrCreate($getData[$i]);
		}
		return 'Success';    
	}

	# For csv to array
	public function csvToArray($filename = '', $delimiter = ';') {
		if (!file_exists($filename) || !is_readable($filename))
			return false;

		$header = null;
		$data = array();
		if (($handle = fopen($filename, 'r')) !== false)
		{
			while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
			{
				if (!$header) {
					$header = $row;
				} else {
					$data[] = array_combine($header, $row);
				}
			}
			fclose($handle);
		}

		foreach($data as $key => $value){
			$data[$key]['url'] = $value['id'].'-'.$this->translit($value['name']);
			$data[$key]['start_at'] = date("dmY", strtotime($value['start_at']));
			$data[$key]['finish_at'] = date("dmY", strtotime($value['finish_at']));
		}
		return $data;
	}

	# For traslit name
	public function translit($text) {
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