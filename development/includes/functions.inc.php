<?php

function pvd($string)
{
    echo "<pre>";
    var_dump($string);
    echo "</pre>";
}


function autoloadClass($class_name)
{
	$class_name_exploded = explode("\\", $class_name);
	$path_to_file = './classes/' . $class_name_exploded[1] . '.class.php';

	if (file_exists($path_to_file)) {
		require $path_to_file;
	}
}




spl_autoload_register('autoloadClass');

?>