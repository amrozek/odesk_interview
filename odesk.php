<style type="text/css">
	body {
	  font-family: monospace; 	
	}
	.name {
		color: red;	
	}
	.color {
		color: green;	
	}
	.element {
		color: blue;	
	}
	.likes {
		color: orange;	
	}
</style>


<?
$input = array(
    array(
        'Name' => 'Trixie',
        'Color' => 'Green',
        'Element' => 'Earth',
        'Likes' => 'Flowers'
        ),
    array(
        'Name' => 'Tinkerbell',
		'Element' => 'Air',
        'Likes' => 'Singning',
        'Color' => 'Blue'
        ), 
    array(
        'Element' => 'Water',
        'Likes' => 'Dancing',
        'Name' => 'Blum',
        'Color' => 'Pink'
        ),
);

function get_keys($input){
	$keys = array();
	foreach ($input as $inner) {
		foreach ($inner as $key => $value) {
			if(!in_array($key, $keys))
				array_push($keys, $key);
    	}
	}
	return $keys;
}

// Sort the inner array into groups by key so we don't have to worry about them being out of order
function sort_array_by_key($input, $keys){
	$sorted = array();
	$i = 0;
	foreach ($input as $inner) {		
		uksort($inner, function($a, $b) use ($keys) {
			$a_index = array_search($a, $keys);
			$b_index = array_search($b, $keys);
			if ($a_index == $b_index) return 0;
  			return ($a_index < $b_index) ? -1 : 1;
		});
		foreach ($inner as $key => $value) {
			$sorted[$i][$key] = add_cell_padding($value);
    	}
		$i++;
	}
	return $sorted;
}

function print_top_and_bottom_borders($columns) {
	foreach($columns as $c){
		echo "+----------";
	}
	echo "+<br />";
}

function add_cell_padding($value) {
	if(strlen($value) > 8)
		$value = substr($value,0,6);
	$j = 0;
	$str_length = strlen($value);
	while($j < 9 - $str_length) {
		$value = $value."&nbsp;";
		$j++;
	}
	return $value;
}

$columns = get_keys($input);
$data = sort_array_by_key($input, $columns);
$last_column = end($columns);

print_top_and_bottom_borders($columns);

foreach($columns as $c){
	echo "|&nbsp;<span class='".strtolower($c)."'>".add_cell_padding($c)."</span>";
	if($last_column === $c)
		echo "|";
}
echo "<br />";

print_top_and_bottom_borders($columns);

foreach($data as $row){
	foreach ($row as $key => $value) {
		echo "|&nbsp;<span class='".strtolower($key)."'>".$value."</span>";
		if($last_column === $key)
			echo "|";
	}
	echo "<br />";
}

print_top_and_bottom_borders($columns);