<?php
/**
* raw utility to delete deprecated thumbnail files
* to move into a plugin at some point
*/

// comment following line and move to WordPress root
if ( !defined('ABSPATH') ) die;

function files($base) { 
	$root = scandir($base); 
	foreach($root as $dir) {
		if ( $dir === '.' || $dir === '..') {
			continue;
		} 
		
		if ( is_file("$base/$dir") ) {
			$result[] = "$base/$dir";
			continue;
		} 
		
		foreach( files("$base/$dir") as $dir) { 
			$result[]=$dir; 
		} 
	} 
	return $result; 
}

$uploads = '/media'; // by default" /wp-content/uploads
$files = files( dirname(__FILE__) . $uploads );

$thumbnails = array();

foreach ($files as $key => $file ) {
	if ( 1 == preg_match('#-\d+x\d+\.#', $file) ) {
			$thumbnails[] = $file;
			// uncomment following line to delete files
			// unlink($file);
	}
}

echo '<pre>';
print_r($thumbnails);
echo '</pre>';
?>