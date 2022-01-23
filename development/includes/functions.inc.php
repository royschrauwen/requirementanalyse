<?php

function pvd($string)
{
    echo "<pre>";
    var_dump($string);
    echo "</pre>";
}


function autoloadClass($class_name)
{
	$path_to_file = './classes/' . $class_name . '.class.php';

	if (file_exists($path_to_file)) {
		require $path_to_file;
	}
}




spl_autoload_register('autoloadClass');

?>