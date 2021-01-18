<?php // string to search in a filename. 
$searchString = 'php'; 
// all files in my/dir with the extension // .php 
$files = glob('public_html/*.php'); 
// array populated with files found // containing the search string. 
$filesFound = array(); 
// iterate through the files and determine // if the filename contains the search string. 
foreach($files as $file) { $name = pathinfo($file, PATHINFO_FILENAME); 
// determines if the search string is in the filename. 
if(strpos(strtolower($name), strtolower($searchString))) { $filesFound[] = $file; } } 
// output the results. 
print_r($filesFound); ?>