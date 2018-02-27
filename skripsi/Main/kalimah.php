<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class node_kalimah
{
	private static $_normalizeAlef       = array('ﺁ','ﺇ','ﺃ','أَ');
	private static $_normalizeDiacritics = array('َ','ً','ُ','ٌ','ِ','ٍ','ْ','ّ');

	function kalimah($awal,$kata){
		//echo '"title" : "irob imirit respons",';
		//echo '"description" : "Your app fetched this irob imiriti response",';
	//	echo    '"respond" :[';

		echo'"kalimah":{"debug":"on",';
		echo '"kata":{';
		echo '"text":';

		//normalisasi untuk hamzah
			$kata      = str_replace(self::$_normalizeAlef, 'ا', $kata);

			$kata		= trim($kata);

		//pemecahan kalimah berdasar spasi
			$words    = explode(' ', $kata);
            $prevWord = null;
		  	$results  = array();	
		 			echo '"';  
                    foreach ($words as $word) {
                	if ($word == '') {
                   	continue;
                	}
                
                        echo $word." ";
                             
                	}
                    echo '"';
                    echo "}},";
                    
	}

}
?>
