<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'isim.php';
class node_isim_fungsi{

	function cek_isimnya($kata, $prevWord) {
	$Isim = new node_isim();
	
	if ( ($Isim->isim($kata, $prevWord))==true)
		{return false;}
		else {return true;}
     	} 

    private static $_normalizeAlef       = array('ﺁ','ﺇ','ﺃ');
     // asmaul khomsah
	private static $_asmaul_khomsah = array('اَبُوْكَ','اَبَاكَ','اباك','ابوك','اَخُوْكَ',
		'اَخَاكَ','اخاك','اخوك','حَمُوْكَ','حَمَاكَ','حماك','حموك','فُوْكَ','فَاكَ','فاك','فوك','ذُوْمَالٍ','ذومال');
   	// asmaul_khomsah_jer
	private static $_asmaul_khomsah_jer = array('اَبِيْكَ','ابيك','اَخِيْكَ',
		'اخيك','حَمِيْكَ','حميك','فِيْكَ','فيك');
    // huruf jer
    private static $_huruf_jar = array('مِنْ','مِنَ','اِلَى','الى','الَى','الىَ',
        'في','فِيْ','فِي','عَنْ','عَنِ','عن','مِنَ','مِن','عَلَى','على','عَلى','رُبَّ',
        'رب', 'ب', 'بِ','فَوْقَ','فوق');
    //huruf inna wa akhatuha
 	private static $_huruf_ina = array('اَنَّ','انّ','اِنَّ','لِكَنْ','لكنْ','كَاَنَّ',
 		'كانّ','كان','لعل','لَعَلَّ','كَانَتِ','كَانَت','لَيْتَ');
    // huruf nida 
    private static $_huruf_nida = array('يا','يَا','اَيَا','ايا','هَيَا','هيا','اَيَ','اي');
    // huruf istisna 
    private static $_huruf_istisna = array('اِلَّا','اِلاَّ','الا','الاّ','غَيْرَ','غَيْرِ','غَيْرُ',
    	'سَوَي','سوي','عَدَ','عد','اَوْحَشَا','اوحشا','خلا','خَلاً');
    // kalimah huruf pengecuali 	
    private static $_kalimahHuruf    = array('عن',  'مذ', 'منذ', 'من', 	
        'الى', 'على', 'حتى', 'الا', 
        'غير', 'سوى', 'خلا', 'عدا', 'حاشا', 'ليس');
    //huruf isim dlomir
    private static $_isim_dlomir = array('هُوَ','هو',
    	'هُمَا','هما',
    	'هُمْ','هم',
    	'هِيَ','هي',
    	'هُمَا','هما',
    	'هن','هُنَّ',
    	'أَنْتَ','أنت',
    	'أَنْتُمَا','أنتما',
    	'أَنْتُمْ','أنتم',
    	'أَنْتِ','أنت',
    	'أَنْتُمَا','أنتما',
    	'أَنْتُنَّ','أنتن',
    	'أَنَا','أنا',
    	'نَحْنُ','نحن');
    //huruf isim mausul	 
    private static $_isim_maushul = array('الَّذِيْ','الّذي',
    	'الَّتِيْ','الّتي',
    	'الَّذِيْنَ','الّذيْن',
    	'اللاَّتِيْ','اللاّتي',
    	'اللاَّئِيْ','اللاّئيْ');
    //huruf isim istifham
    private static $_isim_istifham = array('هل','هَلْ',
			'مَنْ','مَنْ',
			'مَا','ما',
			'متى','مَتَى',
			'أَيْنَ','أين',
			'ماذا','مَاذَا',
			'كيف','كَيْفَ',
			'أيان','نَأَيا','ايان','أَيانَ');
    //huruf isim isyaroh
    private static $_isim_isyarah = array('هَذَا', 'هذا',
     'هَذِهِ','هذه',
      'ذَلِكَ','ذلك',
       'تِلْكَ','تلْك');
    //jamak taksir
    private static $_jama_taksir = array('كفَّارٌ','اْلاوْلاَد','رُسُلٌ','عُلَمَاءُ','رِجَالٌ',
    	'نِسَاءٌ','الطُّللَّابُ','مَكَاتِبُ','كُتُبٌ','كَرَاسِيٌّ','أَسَاتِذُ','أَقْلاَمٌ');

    function bentuk_isim($awal, $kata){
    	echo '"bentuk":{';
    	echo '"debug":"on",';

    	$kata   = str_replace(self::$_normalizeAlef, 'ا', $kata);
    	$kata   = trim($kata);

    	//pecah array berdasarkan spasi
    	$words		=explode(' ', $kata);
    	$prevWord	=null;
    	$result		=array();

    	foreach ($words as $word) {
    		if ($word == ''){
    			continue;
    		}

    	//fungsi pemanggilan kefile isim
    	if((self::cek_isimnya($word, $prevWord))==false 
    		&& self::kategori_huruf($word)==false 
    		|| (self::awal_ba($word)==true)){
   			// echo '"kata":{';
   			// echo '"text"'; echo ":"; echo json_encode($word); echo ',';
   			echo json_encode($word); echo ":{";
    		echo '"node"';echo ":";echo'"2",';
    		echo '"bentuk"';echo":";echo'"isim",';
    		echo '"status":"true"';
    		echo "},";
    		
    		}

    	$prevWord = $word;	
    	}
    	$akhir	= microtime(true);
    	$lama	= $akhir - $awal;
    	echo '"durasi_node_2":';
    	echo '"'.$lama.'",';
    }

    function isim_mufrod ($awal, $kata){
    	echo '"kategori": {';
    	echo '"debug": "on",';

	 //normalisasi hamzah
	 $kata	= str_replace(self::$_normalizeAlef, 'ا', $kata);
	 $kata  =trim($kata);    
	 //pecah array berdasarkan spasi
	 $words    = explode(' ', $kata);
	 $prevWord = null;
	 $result   = array();
	 foreach ($words as $word) {
	 	if( $word == ''){
	 		continue;
	 	}
	 //terdapat huruf jer	
	 if (in_array($prevWord, self::$_huruf_jar) 
	 	&& self::kategori_asmaul_khomsah($word)==false) {
        echo json_encode($word); echo ":{";
		echo '"node"';echo ":";echo '"5",';
		echo '"bentuk"';echo ":";echo '"isim",';
		echo '"kategori"';echo ":";echo '"isim mufrod",';
		echo '"status":"true"';
		echo "},";
             	}
     //terdapat huruf nida
     if (in_array($prevWord, self::$_huruf_nida)) {       		
       echo json_encode($word); echo ":{";
		echo '"node"';echo ":";echo '"5",';
		echo '"bentuk"';echo ":";echo '"isim",';
		echo '"kategori"';echo ":";echo '"isim mufrod",';
		echo '"status":"true"';
		echo "},";
             	}
     //masuknya huruf jer yang idofah        	
	 if((self::masuknya_huruf_jer_idhofah($word)==true) 
	 	&& (mb_substr($word, -1, 1) == 'َ') 
	 	&& (self::kategori_huruf($word)==false)
        && (self::j_muannats_salim($word)==false)
        && (self::jama_taksir($word)==false) 
        && (self::isim_tasniyah2($word)==false) 
        && (self::isim_tasniyah_irob($word)==false) 
        &&(self::j_mudzakar_salim_irob($word)==false)
        &&(self::j_mudzakar_salim($word)==false)
        || (self::awal_ba($word)==true)
        &&(self::isim_maushul($word)==false))
	 	{
        echo json_encode($word); echo ":{";
		echo '"node"';echo ":";echo '"5",';
		echo '"bentuk"';echo ":";echo '"isim",';
		echo '"kategori"';echo ":";echo '"isim mufrod",';
		echo '"status":"true"';
		echo "},";
             	}
       //masuknya huruf jer yang idofah        	
	 if((self::mustasna($word)==true) )
	 	{
        echo json_encode($word); echo ":{";
		echo '"node"';echo ":";echo '"5",';
		echo '"bentuk"';echo ":";echo '"isim",';
		echo '"kategori"';echo ":";echo '"isim mufrod",';
		echo '"status":"true"';
		echo "},";
             	}       	
     // isim mufrod, dengan al
     if ( (self::huruf_al($word)==true) 
        && (self::tanwin_mufrod($word)==true) 
        && (self::j_muannats_salim($word)==false)
        && (self::j_muannats_salim_irob($word)==false)
        && (self::jama_taksir($word)==false) 
        && (self::isim_tasniyah2($word)==false) 
        && (self::isim_tasniyah_irob($word)==false) 
        &&(self::j_mudzakar_salim_irob($word)==false)
        &&(self::j_mudzakar_salim($word)==false)
        &&(self::isim_maushul($word)==false)
        &&(self::kategori_huruf($word)==false))
        {
		$results[] = $word;
		echo json_encode($word); echo ":{";
		echo '"node"';echo ":";echo '"5",';
		echo '"bentuk"';echo ":";echo '"isim",';
		echo '"kategori"';echo ":";echo '"isim mufrod",';
		echo '"status":"true"';
		echo "},";
	  if( empty($results) ) 
		{ echo 'No matches found.'; }
		    }
	 // isim mufrod tanpa al
	 if ( (self::huruf_al($word)==false) 
	 	&& (self::tanwin_akhir($word))==true 
	 	&& (self::j_muannats_salim($word)==false) 
	 	&& (self::jama_taksir($word)==false) 
	 	&& (self::kategori_huruf($word)==false)
	 	&&(self::kategori_huruf($word)==false)
	 	||(self::mustasna($word)==true))
          {
		   $results[] = $word;
		echo json_encode($word); echo ":{";
		echo '"node"';echo ":";echo '"5",';
		echo '"bentuk"';echo ":";echo '"isim",';
		echo '"kategori"';echo ":";echo '"isim mufrod",';
		echo '"status":"true"';
		echo "},";
	  if( empty($results) ) 
		{ echo 'No matches found.'; }
		    }


	 // isim dlomir
	 if (self::isim_dlomir($word)==true) 
                	  {
		$results[] = $word;
		echo json_encode($word); echo ":{";
		echo '"node"';echo ":";echo '"5",';
		echo '"bentuk"';echo ":";echo '"isim",';
		echo '"kategori"';echo ":";echo '"isim dlomir",';
		echo '"status":"true"';
		echo "},";
		   if( empty($results) ) 
		   { echo 'No matches found.'; }
		    }
	 // isim maushul
	 if (self::isim_maushul($word)==true) 
                	  {
		$results[] = $word;
		echo json_encode($word); echo ":{";
		echo '"node"';echo ":";echo '"5",';
		echo '"bentuk"';echo ":";echo '"isim",';
		echo '"kategori"';echo ":";echo '"isim maushul",';
		echo '"status":"true"';
		echo "},";
		   if( empty($results) ) 
		   { echo 'No matches found.'; }
		    }	 
	 // isim isyarah
	 if (self::isim_isyarah($word)==true) 
                	  {
		$results[] = $word;
		echo json_encode($word); echo ":{";
		echo '"node"';echo ":";echo '"5",';
		echo '"bentuk"';echo ":";echo '"isim",';
		echo '"kategori"';echo ":";echo '"isim isyaroh",';
		echo '"status":"true"';
		echo "},";
		   if( empty($results) ) 
		   { echo 'No matches found.'; }
		    }	
	 // isim istifham
	 if (self::isim_istifham($word)==true) 
                	  {
		$results[] = $word;
		echo json_encode($word); echo ":{";
		echo '"node"';echo ":";echo '"5",';
		echo '"bentuk"';echo ":";echo '"isim",';
		echo '"kategori"';echo ":";echo '"isim istifham",';
		echo '"status":"true"';
		echo "},";
		   if( empty($results) ) 
		   { echo 'No matches found.'; }
		    }		    	       
	  //end cek isim mufrod

		$prevWord = $word;                   
                	}
                	
        $akhir = microtime(true);
		$lama = $akhir - $awal;
		echo '"durasi_node_5":';
        echo '"'.$lama.'",';
	}


  function isim_tasniyah($awal,$kata){
	//normalisasi hamzah 
    $kata = str_replace(self::$_normalizeAlef, 'ا', $kata);
	$kata = trim($kata);
    //pecah array berdasarkan spasi
    $words    = explode(' ', $kata);
    $prevWord = null;
    $results    = array();	
    foreach ($words as $word) {
      if ($word == '') {
      continue;
        }
 	// tasniyah tanpa al 
    if ( (self::huruf_al($word)==false) 
    	&& (self::isim_tasniyah2($word))==true 
    	&& (self::harakat_kasroh($word))==true 
    	&&(self::huruf_mudloroah($word))==false )
                	  {
		$results[] = $word;
		echo json_encode($word); echo ":{";
		echo '"node"';echo ":";echo '"6",';
		echo '"bentuk"';echo ":";echo '"isim",';
		echo '"kategori"';echo ":";echo '"isim tasniyah",';
		echo '"status":"true"';
		echo "},";
		 
		   if( empty($results) ) 
		   { echo 'No matches found.'; }
		    }  
	// tasniyah tanpa al  irob
    if ( (self::huruf_al($word)==false) 
    	&& (self::isim_tasniyah_irob($word))==true)
                	  {
		$results[] = $word;
		echo json_encode($word); echo ":{";
		echo '"node"';echo ":";echo '"6",';
		echo '"bentuk"';echo ":";echo '"isim",';
		echo '"kategori"';echo ":";echo '"isim tasniyah",';
		echo '"status":"true"';
		echo "},";
		
		   if( empty($results) ) 
		   { echo 'No matches found.'; }
		    }
	//tasniyah dengan al 
	if ((self::huruf_al($word)==true) 
		&& (self::isim_tasniyah2($word))==true 
		&& (self::harakat_kasroh($word))==true ) 
                	  {
		$results[] = $word;
		echo json_encode($word); echo ":{";
		echo '"node"';echo ":";echo '"6",';
		echo '"bentuk"';echo ":";echo '"isim",';
		echo '"kategori"';echo ":";echo '"isim tasniyah",';
		echo '"status":"true"';
		echo "},";
		   if( empty($results) ) 
		   { echo 'No matches found.'; }
		    }
	//tasniyah dengan al irob
	if ((self::huruf_al($word)==true) 
		&& (self::isim_tasniyah_irob($word))==true 
		&& (self::harakat_kasroh($word))==true ) 
                	  {
		$results[] = $word;
		echo json_encode($word); echo ":{";
		echo '"node"';echo ":";echo '"6",';
		echo '"bentuk"';echo ":";echo '"isim",';
		echo '"kategori"';echo ":";echo '"isim tasniyah",';
		echo '"status":"true"';
		echo "},";
		   if( empty($results) ) 
		   { echo 'No matches found.'; }
		    } 
    //akhir kalimah berupa huruf alif dan nun tanpa al
    if((self::huruf_al($word)==false)
    	&&(self::akhir_alif_nun($word))==true){
    	$results[] = $word;
		echo json_encode($word); echo ":{";
		echo '"node"';echo ":";echo '"6",';
		echo '"bentuk"';echo ":";echo '"isim",';
		echo '"kategori"';echo ":";echo '"isim tasniyah",';
		echo '"status":"true"';
		echo "},";
		   if( empty($results) ) 
		   { echo 'No matches found.'; }
    	}
  	//akhir kalimah berupa huruf alif, nun dan awal al
    if((self::huruf_al($word)==true)
    	&&(self::akhir_alif_nun($word))==true){
    	$results[] = $word;
		echo json_encode($word); echo ":{";
		echo '"node"';echo ":";echo '"6",';
		echo '"bentuk"';echo ":";echo '"isim",';
		echo '"kategori"';echo ":";echo '"isim tasniyah",';
		echo '"status":"true"';
		echo "},";
		   if( empty($results) ) 
		   { echo 'No matches found.'; }
    	}  	
   	//akhir kalimah berupa huruf ya dan nun tanpa al
    if((self::huruf_al($word)==false)
    	&&(self::akhir_ya_nun($word))==true){
    	$results[] = $word;
		echo json_encode($word); echo ":{";
		echo '"node"';echo ":";echo '"6",';
		echo '"bentuk"';echo ":";echo '"isim",';
		echo '"kategori"';echo ":";echo '"isim tasniyah",';
		echo '"status":"true"';
		echo "},";
		   if( empty($results) ) 
		   { echo 'No matches found.'; }
    	}
 	//akhir kalimah berupa huruf ya, nun dan awal al
    if((self::huruf_al($word)==true)
    	&&(self::akhir_ya_nun($word))==true){
    	$results[] = $word;
		echo json_encode($word); echo ":{";
		echo '"node"';echo ":";echo '"6",';
		echo '"bentuk"';echo ":";echo '"isim",';
		echo '"kategori"';echo ":";echo '"isim tasniyah",';
		echo '"status":"true"';
		echo "},";
		   if( empty($results) ) 
		   { echo 'No matches found.'; }
    	}
        $prevWord = $word;
                             
                	}          	
        $akhir = microtime(true);
		$lama = $akhir - $awal;
		echo '"durasi_node_6":';
        echo '"'.$lama.'",';
	}
   function isim_jama($awal,$kata){
    //normalisasi hamzah 
    $kata      = str_replace(self::$_normalizeAlef, 'ا', $kata);   
    //normalisasi harokat
    $kata = trim($kata);
    //pecah array berdasarkan spasi
    $words    = explode(' ', $kata);
    $prevWord = null;
    $results    = array();    
    foreach ($words as $word) {
        if ($word == '') {
          continue;
      }
    //jama' muannat salim tanpa al
    if ((self::huruf_al($word)==false) 
    	&&(self::j_muannats_salim($word)==true)) 
                	  {
		$results[] = $word;
		echo json_encode($word); echo ":{";
		echo '"node"';echo ":";echo '"7",';
		echo '"bentuk"';echo ":";echo '"isim",';
		echo '"kategori"';echo ":";echo '"jama muannats salim",';
		echo '"status":"true"';
		echo "},";
		   if( empty($results) ) 
		   { echo 'No matches found.'; }
		    }
	//jama' muannat salim tanpa al (irob)
    if ((self::huruf_al($word)==false) 
    	&&(self::j_muannats_salim_irob($word)==true)) 
                	  {
		$results[] = $word;
		echo json_encode($word); echo ":{";
		echo '"node"';echo ":";echo '"7",';
		echo '"bentuk"';echo ":";echo '"isim",';
		echo '"kategori"';echo ":";echo '"jama muannats salim",';
		echo '"status":"true"';
		echo "},";
		   if( empty($results) ) 
		   { echo 'No matches found.'; }
		    }
	//jama' muannat salim dengan al
	if ((self::huruf_al($word)==true) 
		&&(self::j_muannats_salim($word)==true)) 
                	  {
		$results[] = $word;
		echo json_encode($word); echo ":{";
		echo '"node"';echo ":";echo '"7",';
		echo '"bentuk"';echo ":";echo '"isim",';
		echo '"kategori"';echo ":";echo '"jama muannats salim",';
		echo '"status":"true"';
		echo "},";
		   if( empty($results) ) 
		   { echo 'No matches found.'; }
		    }
	//jama' muannat salim dengan al
	if ((self::huruf_al($word)==true) 
		&&(self::j_muannats_salim_irob($word)==true)) 
                	  {
		$results[] = $word;
		echo json_encode($word); echo ":{";
		echo '"node"';echo ":";echo '"7",';
		echo '"bentuk"';echo ":";echo '"isim",';
		echo '"kategori"';echo ":";echo '"jama muannats salim",';
		echo '"status":"true"';
		echo "},";
		   if( empty($results) ) 
		   { echo 'No matches found.'; }
		    }
	//jama' mudzakar salim tanpa al
	if ((self::huruf_al($word)==false) 
		&&(self::j_mudzakar_salim($word)==true) 
		&&(self::huruf_mudloroah($word)==false)) 
                	  {
		$results[] = $word;
		echo json_encode($word); echo ":{";
		echo '"node"';echo ":";echo '"7",';
		echo '"bentuk"';echo ":";echo '"isim",';
		echo '"kategori"';echo ":";echo '"jama mudzakar salim",';
		echo '"status":"true"';
		echo "},";
		   if( empty($results) ) 
		   { echo 'No matches found.'; }
		    }
	//jama' mudzakar salim tanpa al (irob)
	if ((self::huruf_al($word)==false) 
		&&(self::j_mudzakar_salim_irob($word)==true) 
		&&(self::huruf_mudloroah($word)==false) ) 
                	  {
		$results[] = $word;
		echo json_encode($word); echo ":{";
		echo '"node"';echo ":";echo '"7",';
		echo '"bentuk"';echo ":";echo '"isim",';
		echo '"kategori"';echo ":";echo '"jama mudzakar salim",';
		echo '"status":"true"';
		echo "},";
		   if( empty($results) ) 
		   { echo 'No matches found.'; }
		    }
	//jama' mudzakar  al (irob)
	if ((self::huruf_al($word)==true) 
		&&(self::j_mudzakar_salim_irob($word)==true)) 
                	  {
		$results[] = $word;
		echo json_encode($word); echo ":{";
		echo '"node"';echo ":";echo '"7",';
		echo '"bentuk"';echo ":";echo '"isim",';
		echo '"kategori"';echo ":";echo '"jama mudzakar salim",';
		echo '"status":"true"';
		echo "},";
		   if( empty($results) ) 
		   { echo 'No matches found.'; }
		    }
	//jama' mudzakar salim dengan al
	if ((self::huruf_al($word)==true) 
		&&(self::j_mudzakar_salim($word)==true)  ) 
                	  {
		$results[] = $word;
		echo json_encode($word); echo ":{";
		echo '"node"';echo ":";echo '"7",';
		echo '"bentuk"';echo ":";echo '"isim",';
		echo '"kategori"';echo ":";echo '"jama mudzakar salim",';
		echo '"status":"true"';
		echo "},";
		   if( empty($results) ) 
		   { echo 'No matches found.'; }
		    }
	//jama' taksir
	if (self::jama_taksir($word)==true) 
                	  {
		$results[] = $word;
		echo json_encode($word); echo ":{";
		echo '"node"';echo ":";echo '"7",';
		echo '"bentuk"';echo ":";echo '"isim",';
		echo '"kategori"';echo ":";echo '"jama taksir",';
		echo '"status":"true"';
		echo "},";
		   if( empty($results) ) 
		   { echo 'No matches found.'; }
		    }
          $prevWord = $word;
                             
                    }       
        $akhir = microtime(true);
		$lama = $akhir - $awal;
		echo '"durasi_node_7":';
            echo '"'.$lama.'",';
    }


//pemanggilan fungsi
	function tanwin_akhir($kata){
		if (mb_substr($kata, -1, 1) == 'ً' 
			|| mb_substr($kata, -1, 1) == 'ٌ' 
			|| mb_substr($kata, -1, 1) == 'ٍ' ) 
            {
                return true;
            }
	}
	function tanwin_mufrod($kata){
		if (mb_substr($kata, -1, 1) == 'ُ' 
			|| mb_substr($kata, -1, 1) == 'ِ' 
			|| mb_substr($kata, -1, 1) == 'َ' ) 
            {
                return true;
            }
	}
	function harakat_kasroh($kata){
		if (mb_substr($kata, -1, 1) == 'ِ' )
		return true;
	}
	function j_muannats_salim($kata){
		if (mb_substr($kata, -3,1) == 'ا' 
			&& mb_substr($kata, -2,1)=='ت' 
			&& mb_substr($kata, -1,1)=='ُ')  
		{
			return true;
		}
	}
	function j_muannats_salim_irob($kata){
		if (mb_substr($kata, -3,1) == 'ا' 
			&& mb_substr($kata, -2,1)=='ت' 
			&& mb_substr($kata, -1,1)=='ِ')  
		{
			return true;
		}
	}
	function j_mudzakar_salim($kata){
		if (mb_substr($kata, -5,1) == 'ُ' 
			&& mb_substr($kata, -3,1) == 'ْ' 
			&& mb_substr($kata, -4,1) == 'و' 
			&& mb_substr($kata, -2,1)=='ن' 
			&& mb_substr($kata, -1,1)=='َ' )  
		{
			return true;
		}
	}
	function j_mudzakar_salim_irob($kata){
		if (mb_substr($kata, -5,1) == 'ِ' 
			&& mb_substr($kata, -3,1) == 'ْ' 
			&& mb_substr($kata, -4,1) == 'ي' 
			&& mb_substr($kata, -2,1)=='ن' 
			&& mb_substr($kata, -1,1)=='َ' 
			&& self::isim_maushul($kata)==false )  
		{
			return true;
		}
	}


	function isim_tasniyah2($kata)
	{
		  if ( (mb_substr($kata, -1, 1)) == 'ِ' 
		  	&& (mb_substr($kata, -2, 1)) == 'ن' 
		  	&& (mb_substr($kata,-3, 1) == 'ا' ) ) 
		  {
            return true;
          }
	}
	function mustasna($kata){
		 if ( (mb_substr($kata, -1, 1)) == 'ا' 
		 	&& (mb_substr($kata,-2, 1) == 'ً' ) )
		 {
		 	return true;
		 }
	}
	function awal_ba($kata){
                if($kata=='بِسْمِ')
                {
                    return true;
                }
    }
	function isim_tasniyah_irob($kata)
	{
		if ( (mb_substr($kata, -1, 1)) == 'ِ' 
			&& (mb_substr($kata, -2, 1)) == 'ن' 
			&& (mb_substr($kata,-3, 1)) == 'ْ' 
			&& (mb_substr($kata,-4, 1)) == 'ي' 
			&& (mb_substr($kata,-5, 1)) == 'َ'  ) 
		{
			return true;
		}
	}
	    //ba,la,ro
     function masuknya_huruf_jer_idhofah($kata){
     	if ( (mb_substr($kata, 0, 1) == 'ب' && mb_substr($kata, 1, 1) == 'ِ') ||
     	     (mb_substr($kata, 0, 1) == 'ل' && mb_substr($kata, 1, 1) == 'ِ') ||
     	     (mb_substr($kata, 0, 1) == 'ر' && mb_substr($kata, 1, 1) == 'ِ'))
     		{
     			return true;
     		}
     }
	function huruf_al ($kata){
	//kalo ada huruf ma'ruf al, ciri isim  
        if ((mb_substr($kata, 0, 1) == 'ا' 
        	&& mb_substr($kata, 1, 1) == 'ل') 
        	|| (mb_substr($kata, 0, 1) == 'ا' 
        	&& mb_substr($kata, 1, 1) == 'َ' 
        	&& mb_substr($kata, 2, 1) == 'ل' 
        	&& mb_substr($kata, 3, 1) == 'ْ') ) 
        	{
            	return true;
        	}
	}
	function jama_taksir($kata){
		if (in_array($kata, self::$_jama_taksir)){
			return true;
		}
	}
	function isim_maushul($kata){
		if (in_array($kata, self::$_isim_maushul)){
			return true;
		}
		else{return false;}
	}
	function kategori_huruf($kata){
		if (in_array($kata, self::$_huruf_nida) 
			|| in_array($kata, self::$_huruf_jar) 
			|| in_array($kata, self::$_huruf_istisna) 
			|| in_array($kata, self::$_huruf_ina)
			|| in_array($kata, self::$_isim_istifham))
		{
			return true;
		}
	}
	function kategori_asmaul_khomsah($kata){
		if (in_array($kata, self::$_asmaul_khomsah) 
			||in_array($kata, self::$_asmaul_khomsah_jer))
		{
			return true;
		}
	}
	function huruf_mudloroah($kata){
        if(mb_substr($kata, 0, 1) == 'ا' 
           || mb_substr($kata, 0, 1) == 'ن' 
           || mb_substr($kata, 0, 1) == 'ي' 
           || mb_substr($kata, 0, 1) == 'ت'  )
		{ 
			return true; 
		}
	}
	function akhir_alif_nun($kata){
		if(mb_substr($kata, -2, 1) == 'ا' 
           || mb_substr($kata, -1, 1) == 'ن' )
		{
			return true;
		}
	}
	function akhir_ya_nun($kata){
		if(mb_substr($kata, -2, 1) == 'ي'
		   || mb_substr($kata, -1, 1) == 'ن')
		{
			return true;
		}
	}
	function isim_dlomir($kata){
		if(in_array($kata, self::$_isim_dlomir))
		{
			return true;
		}
	}
	function isim_istifham($kata){
		if(in_array($kata, self::$_isim_istifham))
		{
			return true;
		}
	}
	function isim_isyarah($kata){
		if(in_array($kata, self::$_isim_isyarah))
		{
			return true;
		}	
	}
	//end pemanggilan fungsi
}

?>