<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class node_huruf{

    //normalisasi hamzah
	  private static $_normalizeAlef       = array('ﺁ','ﺇ','ﺃ','أَ');
   	private static $_normalizeDiacritics = array('َ','ً','ُ','ٌ','ِ','ٍ','ْ','ّ');
    //huruf nashob
    private static $_huruf_nashob = array('لَنْ','لن','ان','اَنْ','كَيْ','كي','لِكَيْ',
                'لكيْ','كَيْ','كيْ','اَذَنْ','اذن','اذنْ','اِذَنْ');
	  // huruf jer
    private static $_huruf_jar = array('مِنْ','مِنَ','اِلَى','الى','الَى','الىَ',
        'في','فِيْ','فِي','عَنْ','عَنِ','عن','مِنَ','مِن','عَلَى','على','عَلى','رُبَّ',
        'رب', 'ب', 'بِ','فَوْقَ','فوق','كَا');
    // huruf jazem
    private static $_huruf_jazem = array('لَمْ','لم','لما','لَمَا','ل',
                'لَ','الما','الَمَا','اَلَمْ','المْ','الم','اِنْ');
    //huruf inna wa akhatuha
  	private static $_huruf_ina = array('اَنَّ','انّ','اِنَّ','لِكَنْ','لكنْ','كَاَنَّ','كانّ','كان','لعل','لَعَلَّ','كَانَتِ','كَانَت','لَيْتَ');
  	//huruf kana wa akhatuha
    private static $_huruf_kana = array('كَانَ','كان','كَانَتِ','كَانَت','اَضْحَى','ظَلَّ','اَمْسَى','اَصْبَحَ','بَاتَ','صَارَ','صَارَتْ','لَيْسَ','مَااَنْفَكَّ','مَازَالَ','مَابَرِحَ','ظَلَّتِ');
    // huruf athof
    private static $_huruf_athof = array('و','وَ','ثُمَّ','ثمّ','ثم','اَوْ','او');
    //huruf istifham
    private static $_huruf_istifham = array('هل','هَلْ',
            'مَنْ','مَنْ',
            'مَا','ما',
            'متى','مَتَى',
            'أَيْنَ','أين',
            'ماذا','مَاذَا',
            'كيف','كَيْفَ',
            'أيان','نَأَيا');
    // huruf istisna 
    private static $_huruf_istisna = array('اِلَّا','اِلاَّ','الا','الاّ','غَيْرَ','غَيْرِ','غَيْرُ',
        'سَوَي','سوي','عَدَ','عد','اَوْحَشَا','اوحشا','خلا','خَلاً');
    // huruf nida 
    private static $_huruf_nida = array('يا','يَا','اَيَا','ايا','هَيَا','هيا','اَيَ','اي');
    //isim laa
    private static $_isim_la = array ('لا','لاَ');

    function huruf($awal, $kata){
    	$cabang =$kata;

    //normalisasi hamzah 
        $kata      = str_replace(self::$_normalizeAlef, 'ا', $kata);

        $kata = trim($kata);
    //pecah array berdasarkan spasi
        $words    = explode(' ', $kata);
        $prevWord = null;
        $results    = array();    
          foreach ($words as $word) {
                    if ($word == '') {
                        continue;
                    }
                    
    //hitung jumlah kata
        $wordlen = mb_strlen($word);

    // huruf jar
    if (in_array($word, self::$_huruf_jar)){
        echo json_encode($word); echo ":{";
    	  echo '"node"';echo ":";echo '"4",';
        echo '"bentuk"';echo ":";echo '"huruf",'; 
        echo '"status":"true"';
        echo "},";
                        }
    //huruf nashob
    if (in_array($word, self::$_huruf_nashob)){
        echo json_encode($word); echo ":{";
    	  echo '"node"';echo ":";echo '"4",';
        echo '"bentuk"';echo ":";echo '"huruf",'; 
        echo '"status":"true"';
        echo "},";
                        }
    //huruf jazem
    if (in_array($word, self::$_huruf_jazem)){
        echo json_encode($word); echo ":{";
    	  echo '"node"';echo ":";echo '"4",';
        echo '"bentuk"';echo ":";echo '"huruf",'; 
        echo '"status":"true"';
        echo "},";
                        }
    // huruf nida
    if (in_array($word, self::$_huruf_nida)){
     	  echo json_encode($word); echo ":{";
   		  echo '"node"';echo ":";echo '"4",';
     	  echo '"bentuk"';echo ":";echo '"huruf",'; 
        echo '"status":"true"';
        echo "},";
                        }
    //huruf inna
    if (in_array($word, self::$_huruf_ina)){
    	  echo json_encode($word); echo ":{";
    	  echo '"node"';echo ":";echo '"4",';
        echo '"bentuk"';echo ":";echo '"huruf",'; 
        echo '"status":"true"';
        echo "},";
                        }
    //huruf kana
    if (in_array($word, self::$_huruf_kana)){
    	  echo json_encode($word); echo ":{";
    	  echo '"node"';echo ":";echo '"4",';
        echo '"bentuk"';echo ":";echo '"huruf",'; 
        echo '"status":"true"';
        echo "},";
                        } 
    //huruf istisna
    if (in_array($word, self::$_huruf_istisna)){
    	  echo json_encode($word); echo ":{";
    	  echo '"node"';echo ":";echo '"4",';
        echo '"bentuk"';echo ":";echo '"huruf",'; 
        echo '"status":"true"';
        echo "},";
                        }
    //huruf athof
    if (in_array($word, self::$_huruf_athof)){
    	  echo json_encode($word); echo ":{";
    	  echo '"node"';echo ":";echo '"4",';
        echo '"bentuk"';echo ":";echo '"huruf",'; 
        echo '"status":"true"';
        echo "},";
                        }
    //huruf istifham
    if (in_array($word, self::$_huruf_istifham)){
    	  echo json_encode($word); echo ":{";
    	  echo '"node"';echo ":";echo '"4",';
        echo '"bentuk"';echo ":";echo '"huruf",'; 
        echo '"status":"true"';
        echo "},";
                        } 
    //huruf laa
    if (in_array($word, self::$_isim_la)){
        echo json_encode($word); echo ":{";
        echo '"node"';echo ":";echo '"4",';
        echo '"bentuk"';echo ":";echo '"huruf",'; 
        echo '"status":"true"';
        echo "},";
                        }                                                      
    // qod
    if (self::awal_qod($word)==true){
    	  echo json_encode($word); echo ":{";
    	  echo '"node"';echo ":";echo '"4",';
        echo '"bentuk"';echo ":";echo '"huruf",'; 
        echo '"status":"true"';
        echo "},";
                        }            
                    }
        $akhir = microtime(true);
        $lama = $akhir - $awal;
		    echo '"durasi_node_4":';
        echo '"'.$lama.'",';
		    echo '"return":{"data":"ok"}},';
    }

function huruf_jar($awal, $kata){

      $cabang = $kata;
 	    //normalisasi hamzah 
      $kata      = str_replace(self::$_normalizeAlef, 'ا', $kata);

      $kata = trim($kata); 
      //pecah array berdasarkan spasi
      $words    = explode(' ', $kata);
      $prevWord = null;
      $results    = array();    
          foreach ($words as $word) {
                    if ($word == '') {
                        continue;
                    }
    //hitung jumlah kata
      $wordlen = mb_strlen($word);
    // haruf jar
    if (in_array($word, self::$_huruf_jar)){
        echo json_encode($word); echo ":{";
        echo '"node"';echo ":";echo '"13",';
        echo '"bentuk"';echo ":";echo '"huruf",';
        echo '"kategori"';echo ":";echo '"huruf jar"';
        echo "},";
                        }
    // haruf istisna
    if (in_array($word, self::$_huruf_istisna)){
        echo json_encode($word); echo ":{";
        echo '"node"';echo ":";echo '"13",';
        echo '"bentuk"';echo ":";echo '"huruf",';
        echo '"kategori"';echo ":";echo '"huruf Istisna"';
        echo "},";
                        }
                       
                    }
         $akhir = microtime(true);
    	   $lama  = $akhir - $awal;
         echo '"durasi_node_13":';
         echo '"'.$lama.'",';
                       
    }   

 function huruf_inna($awal, $kata){

    $cabang = $kata;
 	//normalisasi hamzah 
      $kata      = str_replace(self::$_normalizeAlef, 'ا', $kata);

      $kata = trim($kata); 
    //pecah array berdasarkan spasi
      $words    = explode(' ', $kata);
      $prevWord = null;
      $results    = array();    
          foreach ($words as $word) {
                    if ($word == '') {
                        continue;
                    }
    //hitung jumlah kata
      $wordlen = mb_strlen($word);
    // haruf jar
    if (in_array($word, self::$_huruf_ina)){
        echo json_encode($word); echo ":{";
        echo '"node"';echo ":";echo '"14",';
        echo '"bentuk"';echo ":";echo '"huruf",';
        echo '"kategori"';echo ":";echo '"huruf inna"';
        echo "},";
                        }
    // huruf laa
    if (in_array($word, self::$_isim_la)){
        echo json_encode($word); echo ":{";
        echo '"node"';echo ":";echo '"14",';
        echo '"bentuk"';echo ":";echo '"huruf",';
        echo '"kategori"';echo ":";echo '"huruf laa"';
        echo "},";
                        }
                       
                    }
         $akhir = microtime(true);
    	   $lama = $akhir - $awal;
         echo '"durasi_node_14":';
         echo '"'.$lama.'",';
                       
    }  
  function huruf_athof($awal, $kata){

    $cabang = $kata;
 	//normalisasi hamzah 
      $kata      = str_replace(self::$_normalizeAlef, 'ا', $kata);

      $kata = trim($kata); 
    //pecah array berdasarkan spasi
      $words    = explode(' ', $kata);
      $prevWord = null;
      $results    = array();    
          foreach ($words as $word) {
                    if ($word == '') {
                        continue;
                    }
    //hitung jumlah kata
      $wordlen = mb_strlen($word);
    // haruf jar
    if (in_array($word, self::$_huruf_athof)){
        echo json_encode($word); echo ":{";
        echo '"node"';echo ":";echo '"15",';
        echo '"bentuk"';echo ":";echo '"huruf",';
        echo '"kategori"';echo ":";echo '"huruf athof"';
        echo "},";
                        }
                       
                    }
         $akhir = microtime(true);
    	 $lama = $akhir - $awal;
         echo '"durasi_node_15":';
         echo '"'.$lama.'",';
                       
    } 
function huruf_nashob($awal, $kata){

    $cabang = $kata;
 	//normalisasi hamzah 
      $kata      = str_replace(self::$_normalizeAlef, 'ا', $kata);

      $kata = trim($kata); 
    //pecah array berdasarkan spasi
      $words    = explode(' ', $kata);
      $prevWord = null;
      $results    = array();    
          foreach ($words as $word) {
                    if ($word == '') {
                        continue;
                    }
    //hitung jumlah kata
      $wordlen = mb_strlen($word);
    // haruf nshob
    if (in_array($word, self::$_huruf_nashob)){
        echo json_encode($word); echo ":{";
        echo '"node"';echo ":";echo '"16",';
        echo '"bentuk"';echo ":";echo '"huruf",';
        echo '"kategori"';echo ":";echo '"huruf nashob"';
        echo "},";
                        }
                       
                    }
         $akhir = microtime(true);
    	 $lama = $akhir - $awal;
         echo '"durasi_node_16":';
         echo '"'.$lama.'",';
                       
    } 
function huruf_jazem($awal, $kata){

    $cabang = $kata;
 	//normalisasi hamzah 
      $kata      = str_replace(self::$_normalizeAlef, 'ا', $kata);

      $kata = trim($kata); 
    //pecah array berdasarkan spasi
      $words    = explode(' ', $kata);
      $prevWord = null;
      $results    = array();    
          foreach ($words as $word) {
                    if ($word == '') {
                        continue;
                    }
    //hitung jumlah kata
      $wordlen = mb_strlen($word);
    // haruf jazem
    if (in_array($word, self::$_huruf_jazem)){
        echo json_encode($word); echo ":{";
        echo '"node"';echo ":";echo '"17",';
        echo '"bentuk"';echo ":";echo '"huruf",';
        echo '"kategori"';echo ":";echo '"huruf jazem"';
        echo "},";
                        }
                       
                    }
         $akhir = microtime(true);
    	 $lama = $akhir - $awal;
         echo '"durasi_node_17":';
         echo '"'.$lama.'",';
                       
    } 
function huruf_istifham($awal, $kata){

    $cabang = $kata;
 	//normalisasi hamzah 
      $kata      = str_replace(self::$_normalizeAlef, 'ا', $kata);

      $kata = trim($kata); 
    //pecah array berdasarkan spasi
      $words    = explode(' ', $kata);
      $prevWord = null;
      $results    = array();    
          foreach ($words as $word) {
                    if ($word == '') {
                        continue;
                    }
    //hitung jumlah kata
      $wordlen = mb_strlen($word);
    // haruf istifham
    if (in_array($word, self::$_huruf_istifham)){
        echo json_encode($word); echo ":{";
        echo '"node"';echo ":";echo '"18",';
        echo '"bentuk"';echo ":";echo '"huruf",';
        echo '"kategori"';echo ":";echo '"huruf istifham"';
        echo "},";
                        }
                       
                    }
         $akhir = microtime(true);
    	 $lama = $akhir - $awal;
         echo '"durasi_node_18":';
         echo '"'.$lama.'",';
                       
    } 
function huruf_kana($awal, $kata){

    $cabang = $kata;
 	//normalisasi hamzah 
      $kata      = str_replace(self::$_normalizeAlef, 'ا', $kata);

      $kata = trim($kata); 
    //pecah array berdasarkan spasi
      $words    = explode(' ', $kata);
      $prevWord = null;
      $results    = array();    
          foreach ($words as $word) {
                    if ($word == '') {
                        continue;
                    }
    //hitung jumlah kata
      $wordlen = mb_strlen($word);
    // haruf kana
    if (in_array($word, self::$_huruf_kana)){
        echo json_encode($word); echo ":{";
        echo '"node"';echo ":";echo '"19",';
        echo '"bentuk"';echo ":";echo '"huruf",';
        echo '"kategori"';echo ":";echo '"huruf kana"';
        echo "},";
                        }
                       
                    }
         $akhir = microtime(true);
    	 $lama = $akhir - $awal;
         echo '"durasi_node_19":';
         echo '"'.$lama.'",';
                       
    } 
function huruf_nida($awal, $kata){

    $cabang = $kata;
 	//normalisasi hamzah 
      $kata      = str_replace(self::$_normalizeAlef, 'ا', $kata);

      $kata = trim($kata); 
    //pecah array berdasarkan spasi
      $words    = explode(' ', $kata);
      $prevWord = null;
      $results    = array();    
          foreach ($words as $word) {
                    if ($word == '') {
                        continue;
                    }
    //hitung jumlah kata
      $wordlen = mb_strlen($word);
    // haruf nida
    if (in_array($word, self::$_huruf_nida)){
        echo json_encode($word); echo ":{";
        echo '"node"';echo ":";echo '"20",';
        echo '"bentuk"';echo ":";echo '"huruf",';
        echo '"kategori"';echo ":";echo '"huruf nida"';
        echo "},";
                        }
                       
                    }
         $akhir = microtime(true);
    	 $lama = $akhir - $awal;
         echo '"durasi_node_20":';
         echo '"'.$lama.'",';
         echo '"return":{"data":"ok"}},';
                       
    } 

//coba


    function awal_qod($kata){
                if($kata=='قَدْ')
                {
                    return true;
                }
            }

}
?>
