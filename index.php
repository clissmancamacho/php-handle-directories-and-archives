<?php

/*
* This function receives the name of a directory as parameter and iterates for each file and moves it and changes its name
*
*/
function changeNames($nameDir) {
	$dir = opendir($nameDir);
	while ($archive = readdir($dir)) // Get One file and then another one
	{
	    if (is_dir($archive)) // Verify if its a directory or not
	    {
	    	/*
	    	* If you want to do something with the sub-directories, put your code here
	    	*
	    	*/
	    }
	    else
	    {
	    	// Obtain the name without accents
	        $normalizedArchive = remove_accents($archive);
	        // Move and Rename the archive
	        rename($nameDir . $archive, "./" . $normalizedArchive);
	    }
	}
}

/*
* This function removes the accents of a string
*/
function remove_accents($str) {
	$not_allowed= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹");
	$allowed= array ("a","e","i","o","u","A","E","I","O","U","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E");
	$new_str = str_replace($not_allowed, $allowed ,$str);
	return $new_str;
}

/*
* This function receives two directories by parameters and verifies that the files are called equal
*/
function validate_names($firstDir, $secondDir) {
	$openFirstDir = opendir($firstDir);
	$openSecondDir = opendir($secondDir);
	$notFound = true;

	while (true)
	{
		// Get the file of the first dir
		$nameArchiveFirstDir = readdir($openFirstDir);
		// If there is no more I leave the cycle
		if(!$nameArchiveFirstDir) {
			break;
		}
		// for each file of the first directory I go through those of the second in search of equal names
		while (true) {
			// Get the file of the second dir
			$nameArchiveSecondDir = readdir($openSecondDir);
			// If there is no more archives, leave the cycle
			if (!$nameArchiveSecondDir) {
				// If I did not find any file of the same name, print the name of the file that was not found
				if($notFound){
					echo $nameArchiveFirstDir . "\n";
					echo "<br />";
				}
				break;
			}
			$notFound = true;
			// Check if the files are called the same, if so, leave the cycle
			if($nameArchiveSecondDir == $nameArchiveFirstDir) {
	 			$notFound = false;
	 			break;
		 	}
		}
		// I open the second directory again
		$openSecondDir = opendir($secondDir);
	}
}
?>