<?php

/**
 * 
 */
class Text
{
	private $row = [];
	
	function __construct()
	{
		$this->row = [
			["1", "2", "3", "4", "5", "6", "7", "8", "9", "0"],
			["q", "w", "e", "r", "t", "y", "u", "i", "o", "p"],
			["a", "s", "d", "f", "g", "h", "j", "k", "l", ";"],
			["z", "x", "c", "v", "b", "n", "m", ",", ".", "/"]
		];
	}

	private function flipHorizontal($input)
	{
		$output = [
			'row' 			=> $input['row'],
			'charInArray' 	=> 9 - $input['charInArray'],
			'input'			=> $this->row[$input['row']][9 - $input['charInArray']]
		];

		return $output;
	}

	private function flipVertical($input)
	{
		$output = [
			'row' 			=> 3 - $input['row'],
			'charInArray' 	=> $input['charInArray'],
			'input'			=> $this->row[3 - $input['row']][$input['charInArray']]
		];

		return $output;
	}

	private function shift($input, $shiftNumber)
	{
		$output = [
			'row'			=> $input['row'],	
			'charInArray'	=> $input['charInArray'] + $shiftNumber
		];	

		if ($output['charInArray'] > 9) {
			$output['row'] 			= $input['row'] + 1;
			$output['charInArray']  = $output['charInArray'] - 10; 
		}

		if ($output['row'] > 3) {
			$output['row'] = $input['row'] - 4;
		}

		$output['input'] = $this->row[$output['row']][$output['charInArray']];

		return $output;
	}

	private function getCharInArray($input)
	{
		$output = [];
		$found = false;
		for ($i=0; $i < count($input); $i++) {

			foreach ($this->row as $key => $value) {
			 	if( in_array($input[$i], $this->row[$key]) ){
					$charInArray = array_search($input[$i], $this->row[$key]);
					$output[$i]['row'] 		 	= $key;
					$output[$i]['charInArray'] 	= $charInArray;
					$output[$i]['input'] 		= $input[$i];

					$found = true;
					break;
				}
			}

			if (!$found) {
				$output[$i] = $input[$i];
			}
		}

		return $output;
	}

	public function process($textInput, $transformInput)
	{
		$textInput = strtolower($textInput);
		$textInput = str_split($textInput);

		$transformInput = str_replace(' ', '', $transformInput);
		$transformInput = strtoupper($transformInput);
		$transformInput = explode(',', $transformInput);

		$textInput = $this->getCharInArray($textInput);

		$output = [];
		foreach ($textInput as $key => $value) {
			foreach ($transformInput as $key2 => $value2) {
				if ($value2 === 'H') {
			        $value = $this->flipHorizontal($value);
		      	} else if ($value2 === 'V') {
			        $value = $this->flipVertical($value);
		      	} else if (is_numeric($value2) && $value2 < 10){
			        $value = $this->shift($value, $value2);
		      	}
			}

			$output[] = $value['input'];
		}
		
		return $output;
	}


	public function print_mem()
	{
	   /* Currently used memory */
	   $mem_usage = memory_get_usage();
	   
	   /* Peak memory usage */
	   $mem_peak = memory_get_peak_usage();

	   echo 'The script is now using: <strong>' . round($mem_usage / 1024) . 'KB</strong> of memory.<br>';
	   echo 'Peak usage: <strong>' . round($mem_peak / 1024) . 'KB</strong> of memory.<br><br>';
	}

	public function dd($input)
	{
		highlight_string("<?php\n\$data =\n" . var_export($input, true) . ";\n?>");
	}
}

?>