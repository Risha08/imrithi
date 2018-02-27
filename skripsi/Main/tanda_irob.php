<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class node_tanda_irob
{
	function cek_isimnya($kata, $prevWord){
	$Isim = new node_isim();
	if ( ($Isim->isim($kata, $prevWord))==true)
		{
			return false;
		}
		else {return true;}
	}

	private static $_normalizeAlef       = array('ﺁ','ﺇ','ﺃ');
  private static $_normalizeDiacritics = array('َ','ً','ُ','ٌ','ِ','ٍ','ْ','ّ');
	// asmaul khomsah
	private static $_asmaul_khomsah = array('اَبُوْكَ','اَبَاكَ','اباك','ابوك','اَخُوْكَ',
		'اخوك','حَمُوْكَ','حموك','فُوْكَ','فوك','ذُوْمَالٍ','ذومال');
	// asmaul_khomsah_nashob
	private static $_asmaul_khomsah_nashob = array('اَبَاكَ','اباك','اَخَاكَ','اخاك',
		'حَمَاكَ','حماك','فَاكَ','فاك');
	// asmaul khomsah jer
   	private static $_asmaul_khomsah_jer = array('اَبِيْكَ','ابيك','اَخِيْكَ','اخيك',
   		'حَمِيْكَ','حميك','فِيْكَ','فيك');
  // huruf jer
  private static $_huruf_jar = array('مِنْ','مِنَ','اِلَى','الى','الَى','الىَ',
        'في','فِيْ','فِي','عَنْ','عَنِ','عن','مِنَ','مِن','عَلَى','على','عَلى',
        'رُبَّ','رب', 'ب', 'بِ','فَوْقَ','فوق');
  //huruf nashob
  private static $_huruf_nashob = array('لَنْ','لن','ان','اَنْ','كَيْ','كي','لِكَيْ',
                'لكيْ','كَيْ','كيْ','اَذَنْ','اذن','اذنْ');
  // huruf jazem
  private static $_huruf_jazem = array('لَمْ','لم','لما','لَمَا','ل',
                'لَ','الما','الَمَا','اَلَمْ','المْ','الم');
  //huruf inna wa akhatuha
 	private static $_huruf_ina = array('اَنَّ','انّ','اِنَّ','لِكَنْ','لكنْ','كَاَنَّ',
 		'كانّ','كان','لعل','لَعَلَّ','كَانَتِ','كَانَت');
  // huruf nida 
  private static $_huruf_nida = array('يا','يَا','اَيَا','ايا','هَيَا','هيا','اَيَ','اي');
  // huruf istisna 
  private static $_huruf_istisna = array('اِلَّا','اِلاَّ','الا','الاّ','غَيْرَ','غَيْرِ',
    	'غَيْرُ','سَوَي','سوي','عَدَ','عد','اَوْحَشَا','اوحشا','خلا','خَلاً');
  // kalimah huruf pengecuali 	
  private static $_kalimahHuruf    = array('عن',  'مذ', 'منذ', 'من', 	
                                                  'الى', 'على', 'حتى', 'الا', 
                                                  'غير', 'سوى', 'خلا', 'عدا', 
                                                  'حاشا', 'ليس');
  //bagian isim maushul
  private static $_isim_maushul = array('الَّذِيْ','الّذي',
    	'الَّتِيْ','الّتي',
    	'الَّذِيْنَ','الّذيْن',
    	'اللاَّتِيْ','اللاّتي',
    	'اللاَّئِيْ','اللاّئيْ');
  //bagian isim istifham
  private static $_isim_istifham = array('هل','هَلْ',
			'مَنْ','مَنْ',
			'مَا','ما',
			'متى','مَتَى',
			'أَيْنَ','أين',
			'ماذا','مَاذَا',
			'كيف','كَيْفَ',
			'أيان','نَأَيا');
  //isim dlomir
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
  //bentuk jamak taksir
  private static $_jama_taksir = array('كفَّارٌ','اْلاوْلاَد','رُسُلٌ','عُلَمَاءُ',
    	'رِجَالٌ','نِسَاءٌ','الطُّللَّابُ','مَكَاتِبُ','كُتُبٌ','كَرَاسِيٌّ','أَسَاتِذُ','أَقْلاَمٌ');

  //fungsi isim irob rofa
	function rofa($awal,$kata){
		echo '"irob": {';
		echo '"debug":"on",';
	//normalisasi hamzah
	$kata =str_replace(self::$_normalizeAlef, 'ا', $kata);
	$kata =trim($kata);
	//pecah array berdasarkan spasi
	$words		= explode(' ', $kata);
	$prevWord	= null;
	$results	=array();
		foreach ($words as $word){
			if ($word == ''){
				continue;
			}
    //hitung jumlah kata
    $wordlen = mb_strlen($word);

     if ((self::cek_isimnya($word, $prevWord))==false )
        {

          if (in_array($prevWord, self::$_kalimahHuruf)) {
                //echo $word." isim";
                 //return true;
              }

              if (in_array($prevWord, self::$_huruf_jar)) {
                 //echo $word." isim mufrod";
                 //return true;
              }
              if (in_array($prevWord, self::$_huruf_nida)) {
                // echo $word."rofa" ."";
                 //return true;
              }
        //berupa huruf afalul khomsah     	
		if (in_array($word, self::$_asmaul_khomsah)) {
           	echo json_encode($word); echo ":{";
           	echo '"node"'; echo ":"; echo '"21",';
           	echo '"irob"'; echo ":"; echo '"rofa",';
           	echo '"tanda"'; echo ":"; echo '"wawu",';
           	echo '"nadzom"'; echo ":"; echo '"2"';
           	echo "},";
             	}
        //jika hurufnya ada salah satu kata:
        if (mb_substr($word, 0, 1) == 'ب' ||
        	mb_substr($word, 0, 1) == 'م' && 
		    mb_substr($word, 1, 1) == 'ب' || 
		    mb_substr($word, 1, 1) == 'ف' || 
		    mb_substr($word, 1, 1) == 'م' && 
		    $wordLen > 3) 
        		{
		            return true;
		        }
        //bisa kemasukan huruf nida'
        if (in_array($prevWord, self::$_huruf_nida)) {
                return true;
              }
        // isim mufrod, dengan al
        if ( (self::huruf_al($word)==true) 
            && (self::tanwin_mufrod_rofa($word)==true) 
            && (self::j_muannats_salim($word)==false)
            && (self::jama_taksir($word)==false) 
            && (self::isim_tasniyah($word)==false) 
            && (self::isim_tasniyah_irob($word)==false) 
            && (self::j_mudzakar_salim_irob($word)==false)
            &&(self::j_mudzakar_salim($word)==false)
            &&(self::isim_maushul($word)==false)
            &&(self::kategori_huruf($word)==false)
                	  	)
           {
		   $results[] = $word;
		 	echo json_encode($word); echo ":{";
           	echo '"node"'; echo ":"; echo '"21",';
           	echo '"irob"'; echo ":"; echo '"rofa",';
           	echo '"tanda"'; echo ":"; echo '"dlommah",';
           	echo '"nadzom"'; echo ":"; echo '"1"';
           	echo "},";
		 	if( empty($results) ) 
		  	{ echo 'No matches found.'; }
		    }
		// isim mufrod tanpa al
		if ((self::huruf_al($word)==false) && 
			(self::tanwin_akhir_rofa($word)==true) && 
			(self::j_muannats_salim($word)==false) && 
			(self::jama_taksir($word)==false) &&
			(self::kategori_huruf($word)==false))
                	  {
		   $results[] = $word;
		    echo json_encode($word); echo ":{";
           	echo '"node"'; echo ":"; echo '"21",';
           	echo '"irob"'; echo ":"; echo '"rofa",';
           	echo '"tanda"'; echo ":"; echo '"dlommah",';
           	echo '"nadzom"'; echo ":"; echo '"1"';
           	echo "},";
		    if( empty($results) ) 
		    { echo 'No matches found.'; }
		    }
		// tasniyah tanpa al 
		if ((self::huruf_al($word)==false) && 
			(self::isim_tasniyah($word))==true && 
			(self::harakat_kasroh($word))==true  )
                	  {
		   $results[] = $word;
		    echo json_encode($word); echo ":{";
           	echo '"node"'; echo ":"; echo '"21",';
           	echo '"irob"'; echo ":"; echo '"rofa",';
           	echo '"tanda"'; echo ":"; echo '"alif",';
           	echo '"nadzom"'; echo ":"; echo '"3"';
           	echo "},";
		    if( empty($results) ) 
		    { echo 'No matches found.'; }
		    }  
		//tasniyah dengan al 
		if ((self::huruf_al($word)==true) && 
			(self::isim_tasniyah($word))==true && 
			(self::harakat_kasroh($word))==true ) 
                	  {
		   $results[] = $word;
		        echo json_encode($word); echo ":{";
           	echo '"node"'; echo ":"; echo '"21",';
           	echo '"irob"'; echo ":"; echo '"rofa",';
           	echo '"tanda"'; echo ":"; echo '"alif",';
           	echo '"nadzom"'; echo ":"; echo '"3"';
           	echo "},";
		    if( empty($results) ) 
		    { echo 'No matches found.'; }
		    }
		//jama' muannat salim tanpa al
		if ((self::huruf_al($word)==false) &&
			(self::j_muannats_salim($word)==true)) 
                	  {
		   $results[] = $word;
		        echo json_encode($word); echo ":{";
           	echo '"node"'; echo ":"; echo '"21",';
           	echo '"irob"'; echo ":"; echo '"rofa",';
           	echo '"tanda"'; echo ":"; echo '"dlommah",';
           	echo '"nadzom"'; echo ":"; echo '"1"';
           	echo "},";
		    if( empty($results) ) 
		    { echo 'No matches found.'; }
		    }
		//jama' muannat salim dengan al
		if ((self::huruf_al($word)==true) &&
			(self::j_muannats_salim($word)==true)) 
                	  {
		   $results[] = $word;
		    echo json_encode($word); echo ":{";
           	echo '"node"'; echo ":"; echo '"21",';
           	echo '"irob"'; echo ":"; echo '"rofa",';
           	echo '"tanda"'; echo ":"; echo '"dlommah",';
           	echo '"nadzom"'; echo ":"; echo '"1"';
           	echo "},";
		    if( empty($results) ) 
		    { echo 'No matches found.'; }
		    }
		//jama' mudzakar salim tanpa al
		if ((self::huruf_al($word)==false) &&
			(self::j_mudzakar_salim($word)==true) &&
			(self::huruf_mudloroah($word)==false)) 
                	  {
		   $results[] = $word;
		    echo json_encode($word); echo ":{";
           	echo '"node"'; echo ":"; echo '"21",';
           	echo '"irob"'; echo ":"; echo '"rofa",';
           	echo '"tanda"'; echo ":"; echo '"wawu",';
           	echo '"nadzom"'; echo ":"; echo '"2"';
           	echo "},";
		    if( empty($results) ) 
		    { echo 'No matches found.'; }
		    }
		//jama' mudzakar salim dengan al
		if ((self::huruf_al($word)==true) &&
			(self::j_mudzakar_salim($word)==true)) 
                	  {
		   $results[] = $word;
		    echo json_encode($word); echo ":{";
           	echo '"node"'; echo ":"; echo '"21",';
           	echo '"irob"'; echo ":"; echo '"rofa",';
           	echo '"tanda"'; echo ":"; echo '"wawu",';
           	echo '"nadzom"'; echo ":"; echo '"2"';
           	echo "},";
		    if( empty($results) ) 
		    { echo 'No matches found.'; }
		    }
		//jama' taksir
		if (self::jama_taksir($word)==true) 
                	  {
		  $results[] = $word;
		   	echo json_encode($word); echo ":{";
           	echo '"node"'; echo ":"; echo '"21",';
           	echo '"irob"'; echo ":"; echo '"rofa",';
           	echo '"tanda"'; echo ":"; echo '"dlommah",';
           	echo '"nadzom"'; echo ":"; echo '"1"';
           	echo "},";
		   if( empty($results) ) 
		   { echo 'No matches found.'; }
		   }
		}//end cek
	
    else{
		//dari fiil

		//ciri rafa berharakat dlummah        		
		if ((self::huruf_mudloroah($word)==true) &&
            (self::akhir_rofa_dlommah($word)==true) &&
            (self::masuk_amil_nashob($prevWord)==false) &&
            (self::kategori_huruf($word)==false) && 
            (self::isim_dlomir($word)==false) &&  
            (self::sukun_amr_belakang($word)==false)  &&
            (self::awal_qod($prevWord))!=true && 
            (self::fiil_madli($word))==false || 
            (self::awal_saufa($prevWord))==true ||
            (self::awal_ma_nafi($prevWord))==true)
             {
            echo json_encode($word); echo ":{";
           	echo '"node"'; echo ":"; echo '"21",';
           	echo '"irob"'; echo ":"; echo '"rofa",';
           	echo '"tanda"'; echo ":"; echo '"dlommah",';
           	echo '"nadzom"'; echo ":"; echo '"1"';
           	echo "},";               
             }
        //berupa huruf nun, qod, saufa     
        if ((self::huruf_mudloroah($word)==true) &&
        	(self::rofa_nun($word)==true) &&
            (self::kategori_huruf($word)==false) && 
            (self::isim_dlomir($word)==false) &&  
            (self::sukun_amr_belakang($word)==false)  &&
            (self::awal_qod($prevWord))!=true && 
            (self::fiil_madli($word))==false || 
            (self::awal_saufa($prevWord))==true ||
            (self::awal_ma_nafi($prevWord))==true) 
             { 
            echo json_encode($word); echo ":{";
           	echo '"node"'; echo ":"; echo '"21",';
           	echo '"irob"'; echo ":"; echo '"rofa",';
           	echo '"tanda"'; echo ":"; echo '"nun",';
           	echo '"nadzom"'; echo ":"; echo '"4"';
           	echo "},";                      
             }         
		 }//end fiil

		$prevWord = $word;
		}
		$akhir = microtime(true);
		$lama  = $akhir - $awal;
		echo '"durasi_node_21":';
		echo'"'.$lama.'",';	 
	}//end isim rafa

	// fungsi irob nashob
	function nashob($awal,$kata){

	//normalisasi hamzah
	$kata =str_replace(self::$_normalizeAlef, 'ا', $kata);
	$kata =trim($kata);
	//pecah array berdasarkan spasi
	$words		= explode(' ', $kata);
	$prevWord	= null;
	$results	=array();
		foreach ($words as $word){
			if ($word == ''){
				continue;
			}
    //hitung jumlah kata
    $wordlen = mb_strlen($word);

     if ((self::cek_isimnya($word, $prevWord))==false){
		// isim mufrod, dengan al
        if ( (self::huruf_al($word)==true) 
          	&& (self::tanwin_akhir_nashob($word)==true) 
            && (self::j_muannats_salim($word)==false)
            && (self::jama_taksir($word)==false) 
            && (self::isim_tasniyah($word)==false) 
            && (self::isim_tasniyah_irob($word)==false) 
            && (self::j_mudzakar_salim_irob($word)==false)
            &&(self::j_mudzakar_salim($word)==false)
            &&(self::masuk_amil_jar($prevWord)==false)
            &&(self::isim_maushul($word)==false)
            &&(self::kategori_huruf($word)==false))	 
                	  {
		   $results[] = $word;
		 	      echo json_encode($word); echo ":{";
           	echo '"node"'; echo ":"; echo '"22",';
           	echo '"irob"'; echo ":"; echo '"nashob",';
           	echo '"tanda"'; echo ":"; echo '"fathah",';
           	echo '"nadzom"'; echo ":"; echo '"5"';
           	echo "},";
             if( empty($results) ) 
       { echo 'No matches found.'; }   
		    }
		// isim mufrod tanpa al
		if ( (self::huruf_al($word)==false) && 
			 (self::tanwin_mufrod_nashob($word)==true) && 
			 (self::j_muannats_salim($word)==false) && 
			 (self::jama_taksir($word)==false) && 
			 (self::kategori_huruf($word)==false)&&
			 (self::kategori_huruf($word)==false)||
			 (self::mustasna($word)==true) )
                	  {
		   $results[] = $word;
		    echo json_encode($word); echo ":{";
           	echo '"node"'; echo ":"; echo '"22",';
           	echo '"irob"'; echo ":"; echo '"nashob",';
           	echo '"tanda"'; echo ":"; echo '"fathah",';
           	echo '"nadzom"'; echo ":"; echo '"5"';
           	echo "},";
             if( empty($results) ) 
       { echo 'No matches found.'; } 
		    }
		// tasniyah tanpa al nashob
		if ((self::huruf_al($word)==false) && 
			(self::isim_tasniyah_irob($word))==true && 
			(self::masuknya_huruf_jer_idhofah($word))==false)
                	  {
		   $results[] = $word;
		    echo json_encode($word); echo ":{";
           	echo '"node"'; echo ":"; echo '"22",';
           	echo '"irob"'; echo ":"; echo '"nashob",';
           	echo '"tanda"'; echo ":"; echo '"ya",';
           	echo '"nadzom"'; echo ":"; echo '"8"';
           	echo "},";
             if( empty($results) ) 
       { echo 'No matches found.'; }
		    }  
		//terdapat huruf asmaul khomsah    
 		if (in_array($word, self::$_asmaul_khomsah_nashob)) 
 			  {
            echo json_encode($word); echo ":{";
           	echo '"node"'; echo ":"; echo '"22",';
           	echo '"irob"'; echo ":"; echo '"nashob",';
           	echo '"tanda"'; echo ":"; echo '"alif",';
           	echo '"nadzom"'; echo ":"; echo '"6"';
           	echo "},";
              }
		//tasniyah dengan al 
		if ((self::huruf_al($word)==true) && 
			(self::isim_tasniyah_irob($word))==true && 
			(self::harakat_kasroh($word))==true ) 
                	  {
		   $results[] = $word;
		    echo json_encode($word); echo ":{";
           	echo '"node"'; echo ":"; echo '"22",';
           	echo '"irob"'; echo ":"; echo '"nashob",';
           	echo '"tanda"'; echo ":"; echo '"ya",';
           	echo '"nadzom"'; echo ":"; echo '"8"';
           	echo "},";
             if( empty($results) ) 
       { echo 'No matches found.'; }
		    }
		//jama' muannat salim tanpa al
		if ((self::huruf_al($word)==false) &&
			(self::j_muannats_salim_irob($word)==true)&&
			(self::masuknya_huruf_jer_idhofah($word)==false)) 
                	  {
		   $results[] = $word;
		    echo json_encode($word); echo ":{";
           	echo '"node"'; echo ":"; echo '"22",';
           	echo '"irob"'; echo ":"; echo '"nashob",';
           	echo '"tanda"'; echo ":"; echo '"kasroh",';
           	echo '"nadzom"'; echo ":"; echo '"7"';
           	echo "},";
             if( empty($results) ) 
       { echo 'No matches found.'; }
            		    }	
		//jama' muannat salim dengan al
		if ((self::huruf_al($word)==true) &&
			(self::j_muannats_salim_irob($word)==true)) 
                	  {
		   $results[] = $word;
		    echo json_encode($word); echo ":{";
           	echo '"node"'; echo ":"; echo '"22",';
           	echo '"irob"'; echo ":"; echo '"nashob",';
           	echo '"tanda"'; echo ":"; echo '"kasroh",';
           	echo '"nadzom"'; echo ":"; echo '"7"';
           	echo "},";
             if( empty($results) ) 
       { echo 'No matches found.'; }
		    }
		//jama' mudzakar salim tanpa al
		if ((self::huruf_al($word)==false) &&
			(self::j_mudzakar_salim_irob($word)==true) &&
			(self::huruf_mudloroah($word)==false) &&
			(self::masuknya_huruf_jer_idhofah($word)==false)) 
                	  {
		   $results[] = $word;
		    echo json_encode($word); echo ":{";
           	echo '"node"'; echo ":"; echo '"22",';
           	echo '"irob"'; echo ":"; echo '"nashob",';
           	echo '"tanda"'; echo ":"; echo '"ya",';
           	echo '"nadzom"'; echo ":"; echo '"8"';
           	echo "},";
             if( empty($results) ) 
       { echo 'No matches found.'; }
		    }			
		//jama' mudzakar salim dengan al
		if ((self::huruf_al($word)==true) &&
			(self::j_mudzakar_salim_irob($word)==true)  ) 
                	  {
		   $results[] = $word;
		        echo json_encode($word); echo ":{";
           	echo '"node"'; echo ":"; echo '"22",';
           	echo '"irob"'; echo ":"; echo '"nashob",';
           	echo '"tanda"'; echo ":"; echo '"ya",';
           	echo '"nadzom"'; echo ":"; echo '"8"';
           	echo "},";
         if( empty($results) ) 
       { echo 'No matches found.'; }
      }
         echo " "; 
		}//end cek isim

		else{

		// tanda fiil nashob berakhiran fathah       		   	  
		if ((self::huruf_mudloroah($word)==true) &&
		   	(self::akhir_nashob_fathah($word)==true) &&
		   	(self::masuk_amil_nashob($prevWord)==true) &&
			(self::kategori_huruf($word)==false) && 
            (self::isim_dlomir($word)==false) &&  
            (self::sukun_amr_belakang($word)==false)  &&
            (self::awal_qod($prevWord))!=true && 
            (self::fiil_madli($word))==false || 
            (self::awal_saufa($prevWord))==true ||
            (self::awal_ma_nafi($prevWord))==true)
             {
            echo json_encode($word); echo ":{";
           	echo '"node"'; echo ":"; echo '"22",';
           	echo '"irob"'; echo ":"; echo '"nashob",';
           	echo '"tanda"'; echo ":"; echo '"fathah",';
           	echo '"nadzom"'; echo ":"; echo '"5"';
           	echo "},";               		
             }
        //berupa huruf afalul khomsah
        if ((self::nashob_hadz_nun($word)==true) &&
		   	(self::masuk_amil_nashob($prevWord)==true)) 
             {	
            echo json_encode($word); echo ":{";
           	echo '"node"'; echo ":"; echo '"22",';
           	echo '"irob"'; echo ":"; echo '"nashob",';
           	echo '"tanda"'; echo ":"; echo '"hadzfun nun",';
           	echo '"nadzom"'; echo ":"; echo '"9"';
           	echo "},";                		
             }
        //terdapat huruf mudloroah
        if ((self::huruf_mudloroah($word)==true) &&
            (self::kategori_huruf($word)==false) && 
            (self::isim_dlomir($word)==false) &&  
            (self::sukun_amr_belakang($word)==false) &&
            (self::awal_qod($prevWord))!=true && 
            (self::fiil_madli2($word))==false || 
            (self::awal_saufa($prevWord))==true ||
            (self::awal_ma_nafi($prevWord))==true ||
            (self::hukum_jazm($prevWord,$word))==true) 
            { 
            echo json_encode($word); echo ":{";
            echo '"node"'; echo ":"; echo '"22",';
            echo '"irob"'; echo ":"; echo '"nashob",';
            echo '"tanda"'; echo ":"; echo '"fathah",';
            echo '"nadzom"'; echo ":"; echo '"9"';
            echo "},";                    
             }                    
		}//else

		$prevWord = $word;
	  }
		$akhir = microtime(true);
		$lama  = $akhir - $awal;
		echo '"durasi_node_22":';
		echo '"'.$lama.'",';	  
	}//end isim nashob

	//fungsi isim irob jer
	function jar($awal,$kata){
	
	//normalisasi hamzah
	$kata =str_replace(self::$_normalizeAlef, 'ا', $kata);
	$kata =trim($kata);
	//pecah array berdasarkan spasi
	$words		= explode(' ', $kata);
	$prevWord	= null;
	$results	=array();
		foreach ($words as $word){
			if ($word == ''){
				continue;
			}
    //hitung jumlah kata
    $wordlen = mb_strlen($word);

     if ((self::cek_isimnya($word, $prevWord))==false ){
                        //bisa kemasukan jer
                  if (in_array($prevWord, self::$_kalimahHuruf)) {
                //echo $word." isim";
                 //return true;
              }

              if (in_array($prevWord, self::$_huruf_jar)) {
                 //echo $word." isim mufrod";
                 //return true;
              }
              if (in_array($prevWord, self::$_huruf_nida)) {
                // echo $word."rofa" ."";
                 //return true;
              }
        //terdapat asmaul khomsah jer
		if (in_array($word, self::$_asmaul_khomsah_jer)) {
            echo json_encode($word); echo ":{";
           	echo '"node"'; echo ":"; echo '"23",';
           	echo '"irob"'; echo ":"; echo '"jar",';
           	echo '"tanda"'; echo ":"; echo '"ya",';
           	echo '"nadzom"'; echo ":"; echo '"11"';
           	echo "},";   
             	}
        //terdapat salah satu huruf dari ini:
        if ((mb_substr($word, 0, 1) == 'ب' || 
        	 mb_substr($word, 0, 1) == 'م') && 
		    (mb_substr($word, 1, 1) == 'ب' || 
		     mb_substr($word, 1, 1) == 'ف'  ||
		     mb_substr($word, 1, 1) == 'م') && 
		     $wordLen > 3)
		       {
		            return true;
		        }
        // isim mufrod jer, dengan al
        if ( (self::huruf_al($word)==true) 
          && (self::tanwin_akhir_jar($word)==true) 
          && (self::masuk_amil_jar($prevWord)==true)
          && (self::j_muannats_salim($word)==false)
          && (self::jama_taksir($word)==false) 
          && (self::isim_tasniyah($word)==false) 
          && (self::isim_tasniyah_irob($word)==false) 
          && (self::j_mudzakar_salim_irob($word)==false)
          && (self::j_mudzakar_salim($word)==false)
          && (self::isim_maushul($word)==false)
          && (self::kategori_huruf($word)==false)) 	
                	  {
		   $results[] = $word;
		        echo json_encode($word); echo ":{";
           	echo '"node"'; echo ":"; echo '"23",';
           	echo '"irob"'; echo ":"; echo '"jar",';
           	echo '"tanda"'; echo ":"; echo '"kasroh",';
           	echo '"nadzom"'; echo ":"; echo '"10"';
           	echo "},";  
		    if( empty($results) ) 
		    { echo 'No matches found.'; }
		    }
	    // isim mufrod tanpa al
		   if ((self::huruf_al($word)==false) 
		   	&& (self::tanwin_mufrod_jar($word)==true)
		   	&& (self::masuknya_huruf_jer_idhofah($word)==true 
		    || self::masuk_amil_jar($prevWord)==true) 
		   	&& (self::j_muannats_salim($word)==false) 
		   	&& (self::jama_taksir($word)==false) 
		   	&& (self::kategori_huruf($word)==false)
		   	&& (self::kategori_huruf($word)==false) )
                	  {
		   $results[] = $word;
		        echo json_encode($word); echo ":{";
           	echo '"node"'; echo ":"; echo '"23",';
           	echo '"irob"'; echo ":"; echo '"jar",';
           	echo '"tanda"'; echo ":"; echo '"kasroh",';
           	echo '"nadzom"'; echo ":"; echo '"10"';
           	echo "},";   
		    if( empty($results) ) 
		    { echo 'No matches found.'; }
		    }
    // isim mufrod
       if ((self::huruf_al($word)==false) 
        && (self::tanwin_mufrod_jar($word)==true))
                    {
       $results[] = $word;
            echo json_encode($word); echo ":{";
            echo '"node"'; echo ":"; echo '"23",';
            echo '"irob"'; echo ":"; echo '"jar",';
            echo '"tanda"'; echo ":"; echo '"kasroh",';
            echo '"nadzom"'; echo ":"; echo '"10"';
            echo "},";   
        if( empty($results) ) 
        { echo 'No matches found.'; }
        }
    // isim mufrod
       if ((self::huruf_al($word)==true) 
        && (self::tanwin_akhir_jar($word)==true))
                    {
       $results[] = $word;
            echo json_encode($word); echo ":{";
            echo '"node"'; echo ":"; echo '"23",';
            echo '"irob"'; echo ":"; echo '"jar",';
            echo '"tanda"'; echo ":"; echo '"kasroh",';
            echo '"nadzom"'; echo ":"; echo '"10"';
            echo "},";   
        if( empty($results) ) 
        { echo 'No matches found.'; }
        }
		// isim mufrod tanpa al  tanda fathah
		if ( (self::huruf_al($word)==false) 
		   && (self::tanwin_akhir_jar_fathah($word)==true)
		   && (self::masuknya_huruf_jer_idhofah($word)==true 
		   || self::masuk_amil_jar($prevWord)==true) 
		   && (self::j_muannats_salim($word)==false) 
		   && (self::j_muannats_salim_irob($word)==false) 
		   && (self::j_mudzakar_salim_irob($word)==false) 
		   && (self::jama_taksir($word)==false) 
		   && (self::kategori_huruf($word)==false)
		   &&(self::kategori_asmaul_khomsah($word)==false))	    
                	  {
		   $results[] = $word;
		        echo json_encode($word); echo ":{";
           	echo '"node"'; echo ":"; echo '"23",';
           	echo '"irob"'; echo ":"; echo '"jar",';
           	echo '"tanda"'; echo ":"; echo '"fathah",';
           	echo '"nadzom"'; echo ":"; echo '"12"';
           	echo "},";  
		    if( empty($results) ) 
		    { echo 'No matches found.'; }
		    }
		// isim mufrod with al  tanda fathah
		if ( (self::huruf_al($word)==true) 
		   && (self::tanwin_akhir_jar_fathah($word)==true)
		   && (self::masuknya_huruf_jer_idhofah($word)==true 
		   || self::masuk_amil_jar($prevWord)==true) 
		   && (self::j_muannats_salim($word)==false) 
		   && (self::jama_taksir($word)==false) 
		   && (self::kategori_huruf($word)==false)
		   &&(self::kategori_asmaul_khomsah($word)==false) )
                	  {
		   $results[] = $word;
		        echo json_encode($word); echo ":{";
           	echo '"node"'; echo ":"; echo '"23",';
           	echo '"irob"'; echo ":"; echo '"jar",';
           	echo '"tanda"'; echo ":"; echo '"fathah",';
           	echo '"nadzom"'; echo ":"; echo '"12"';
           	echo "},";  
		    if( empty($results) ) 
		    { echo 'No matches found.'; }
		    }
		// tasniyah tanpa al jer
		if ((self::huruf_al($word)==false) && 
			(self::isim_tasniyah_irob($word))==true && 
			(self::harakat_kasroh($word))==true && 
			(self::masuknya_huruf_jer_idhofah($word))==true )
                	  {
		   $results[] = $word;
		        echo json_encode($word); echo ":{";
           	echo '"node"'; echo ":"; echo '"23",';
           	echo '"irob"'; echo ":"; echo '"jar",';
           	echo '"tanda"'; echo ":"; echo '"ya",';
           	echo '"nadzom"'; echo ":"; echo '"11"';
           	echo "},";  
		    if( empty($results) ) 
		    { echo 'No matches found.'; }
		    }  
		//jama' muannat salim tanpa al jer
		if ((self::huruf_al($word)==false) &&
			(self::j_muannats_salim_irob($word)==true)&&
			(self::masuknya_huruf_jer_idhofah($word)==true)) 
                	  {
		   $results[] = $word;
		        echo json_encode($word); echo ":{";
           	echo '"node"'; echo ":"; echo '"23",';
           	echo '"irob"'; echo ":"; echo '"jar",';
           	echo '"tanda"'; echo ":"; echo '"kasroh",';
           	echo '"nadzom"'; echo ":"; echo '"10"';
           	echo "},";  
		   if( empty($results) ) 
		   { echo 'No matches found.'; }
		    }
		//jama' mudzakar salim tanpa al
		if ((self::huruf_al($word)==false) &&
			(self::j_mudzakar_salim_irob($word)==true) &&
			(self::huruf_mudloroah($word)==false)&&
			(self::masuknya_huruf_jer_idhofah($word)==true)) 
                	  {
		   $results[] = $word;
		    echo json_encode($word); echo ":{";
           	echo '"node"'; echo ":"; echo '"23",';
           	echo '"irob"'; echo ":"; echo '"jar",';
           	echo '"tanda"'; echo ":"; echo '"ya",';
           	echo '"nadzom"'; echo ":"; echo '"11"';
           	echo "},";  
		    if( empty($results) ) 
		    { echo 'No matches found.'; }
		    }

	    }//end cek
       else{

        }
		$prevWord	= $word;
		}
		$akhir      = microtime(true);
		$lama		= $akhir - $awal;
		echo '"durasi_node_23":';
		echo '"'.$lama.'",';
	}//end isim jer

	//fungsi fiil irob jazem
	function jazem($awal,$kata){

	//normalisasi hamzah
	$kata =str_replace(self::$_normalizeAlef, 'ا', $kata);
	$kata =trim($kata);
	//pecah array berdasarkan spasi
	$words		= explode(' ', $kata);
	$prevWord	= null;
	$results	=array();
		foreach ($words as $word){
			if ($word == ''){
				continue;
			}
    //hitung jumlah kata
    $wordlen = mb_strlen($word);	
  
    if ((self::cek_isimnya($word, $prevWord))==true )
           {  
        // tanda irob jazem pada fiil mudlori, sukun
        if ((self::huruf_mudloroah($word)==true) &&
        	(self::akhir_jazem_sukun($word)==true) &&
        	(self::masuk_amil_jazem($prevWord)==true) &&
        	(self::kategori_huruf($word)==false) &&
            (self::tengah_ya_afalul_khomsah($word)==false)&&                                       
            (self::isim_dlomir($word)==false) &&
            (self::awal_qod($prevWord))!=true && 
            (self::fiil_madli($word))==false || 
            (self::awal_saufa($prevWord))==true)                                           
              {
            echo json_encode($word); echo ":{";
           	echo '"node"'; echo ":"; echo '"24",';
           	echo '"irob"'; echo ":"; echo '"jazem",';
           	echo '"tanda"'; echo ":"; echo '"sukun",';
           	echo '"nadzom"'; echo ":"; echo '"14"';
           	echo "},";  
              }
        // tanda irob jazem pada fiil mudlori, fathah
        if ((self::huruf_mudloroah($word)==true) &&
        	(self::akhir_jazem_fathah($word)==true) &&
        	(self::masuk_amil_jazem($prevWord)==true) &&
            (self::kategori_huruf($word)==false) &&
            (self::isim_dlomir($word)==false) &&
            (self::awal_qod($prevWord))!=true && 
            (self::fiil_madli($word))==false || 
            (self::awal_saufa($prevWord))==true)                                            
             {
            echo json_encode($word); echo ":{";
           	echo '"node"'; echo ":"; echo '"24",';
           	echo '"irob"'; echo ":"; echo '"jazem",';
           	echo '"tanda"'; echo ":"; echo '"hadz huruf illat",';
           	echo '"nadzom"'; echo ":"; echo '"15"';
           	echo "},";
             }
        // tanda irob jazem pada afalul khomsah, hadz
        if ((self::jazem_hadz_nun($word)==true) &&             
            (self::depan_afalul_khomsah($word)==true)&&
            (self::masuk_amil_jazem($prevWord)==true))                                                            
             {
            echo json_encode($word); echo ":{";
           	echo '"node"'; echo ":"; echo '"24",';
           	echo '"irob"'; echo ":"; echo '"jazem",';
           	echo '"tanda"'; echo ":"; echo '"hadz nun",';
           	echo '"nadzom"'; echo ":"; echo '"13"';
           	echo "},";
             }    
  		}//end cek
  		$prevWord	= $word;
  		}
  		$akhir 		= microtime(true);
  		$lama		= $akhir - $awal;
  		echo '"durasi_node_24":';
  		echo '"'.$lama.'",';
  		echo '"return":{"data":"ok"}},';
	 }

	//pemanggilan fungsi
    function masuk_amil_jar($prevWord){
        if (in_array($prevWord, self::$_huruf_jar)) 
        	{
            	return true;
             }
        }
    function masuknya_huruf_jer_idhofah($kata){
     	if ( (mb_substr($kata, 0, 1) == 'ب' && mb_substr($kata, 1, 1) == 'ِ') ||
     	     (mb_substr($kata, 0, 1) == 'ل' && mb_substr($kata, 1, 1) == 'ِ'))
     		{
     			return true;
     		}
     }
    function tanwin_mufrod_jar($kata){
		if ( mb_substr($kata, -1, 1) == 'ٍ' ) 
            {
                return true;
            }
	}
	function tanwin_akhir_jar($kata){
	if (mb_substr($kata, -1, 1) == 'ِ' ) 
            {
                return true;
            }
	}
	function tanwin_akhir_jar_fathah($kata){
	if (mb_substr($kata, -1, 1) == 'َ' ) 
            {
                return true;
            }
	}          
	function tanwin_akhir_rofa($kata){
	if (mb_substr($kata, -1, 1) == 'ٌ') 
            {
                return true;
            }
	}
	function tanwin_mufrod_rofa($kata){
		if (mb_substr($kata, -1, 1) == 'ُ' ) 
            {
                return true;
            }
	}
	function tanwin_mufrod_nashob($kata){
		if ( (mb_substr($kata, -1, 1) == 'ا' && mb_substr($kata, -2, 1) == 'ً') || ( mb_substr($kata, -1, 1) == 'ً') ) 
            {
                return true;
            }
	}
	function tanwin_akhir_nashob($kata){
		if (mb_substr($kata, -1, 1) == 'َ' ) 
            {
                return true;
            }
	}
	function harakat_kasroh($kata){
		if (mb_substr($kata, -1, 1) == 'ِ' )
		return true;
	}
	function j_muannats_salim($kata){
		if (mb_substr($kata, -3,1) == 'ا' && mb_substr($kata, -2,1)=='ت' && mb_substr($kata, -1,1)=='ُ')  
		{
			return true;
		}
	}
	function j_muannats_salim_irob($kata){
		if (mb_substr($kata, -3,1) == 'ا' && mb_substr($kata, -2,1)=='ت' &&  mb_substr($kata, -1,1)=='ِ')  
		{
			return true;
		}
	}
	function j_mudzakar_salim($kata){
		if (mb_substr($kata, -5,1) == 'ُ' && 
			mb_substr($kata, -3,1) == 'ْ' && 
			mb_substr($kata, -4,1) == 'و' && 
			mb_substr($kata, -2,1)==  'ن' && 
			mb_substr($kata, -1,1)=='َ' )  
		{
			return true;
		}
	}
	function j_mudzakar_salim_irob($kata){
		if (mb_substr($kata, -5,1) == 'ِ' && 
			mb_substr($kata, -3,1) == 'ْ' && 
			mb_substr($kata, -4,1) == 'ي' && 
			mb_substr($kata, -2,1)==  'ن' && 
			mb_substr($kata, -1,1)==  'َ' && 
			self::isim_maushul($kata)==false )  
		{
			return true;
		}
	}
	function isim_tasniyah($kata){
		if ((mb_substr($kata, -1, 1)) == 'ِ' && 
		  	(mb_substr($kata, -2, 1)) == 'ن' && 
		  	(mb_substr($kata,-3, 1) == 'ا' ) ) 
		{
            return true;
        }
	}
	function mustasna($kata){
		 if ((mb_substr($kata, -1, 1)) == 'ا' && 
		 	(mb_substr($kata,-2, 1) == 'ً' ) )
		{
		 	return true;
		}
	}
	function isim_tasniyah_irob($kata){
		if ((mb_substr($kata, -1, 1)) == 'ِ' && 
			(mb_substr($kata, -2, 1)) == 'ن' && 
			(mb_substr($kata,-3, 1)) == 'ْ' && 
			(mb_substr($kata,-4, 1)) == 'ي' && 
			(mb_substr($kata,-5, 1)) == 'َ'  ) 
		{
			return true;
		}
	}
	function huruf_al ($kata){
        if ((mb_substr($kata, 0, 1) == 'ا' && 
        	mb_substr($kata, 1, 1) == 'ل') || 
        	(mb_substr($kata, 0, 1) == 'ا' && 
        	mb_substr($kata, 1, 1) == 'َ' && 
        	mb_substr($kata, 2, 1) == 'ل' && 
        	mb_substr($kata, 3, 1) == 'ْ') ) 
        {
            return true;
        }
	}
	function jama_taksir($kata){
		if (in_array($kata, self::$_jama_taksir))
		{
			return true;
		}
	}
	function isim_maushul($kata){
		if (in_array($kata, self::$_isim_maushul))
		{
			return true;
		}
		else{return false;}
	}
	function kategori_huruf($kata){
		if (in_array($kata, self::$_huruf_nida) || 
			in_array($kata, self::$_huruf_jar) || 
			in_array($kata, self::$_huruf_istisna) || 
			in_array($kata, self::$_huruf_ina)|| 
			in_array($kata, self::$_isim_istifham)|| 
			in_array($kata, self::$_isim_dlomir))
		{
			return true;
		}
	}
	function kategori_asmaul_khomsah($kata){
		if (in_array($kata, self::$_asmaul_khomsah) || 
		in_array($kata, self::$_asmaul_khomsah_jer))
		{
			return true;
		}
	}
	function huruf_mudloroah($kata){
        if(mb_substr($kata, 0, 1) == 'أ' || 
           mb_substr($kata, 0, 1) == 'ن' || 
           mb_substr($kata, 0, 1) == 'ي' || 
           mb_substr($kata, 0, 1) == 'ت'  )
		{ 
			return true; 
		}
	}
	function akhir_nashob_fathah($kata){
        if (mb_substr($kata, -1, 1) == 'َ' || 
        	mb_substr($kata, -1, 1) == 'ى' ) 
                {
                return true;
                }
            }
    function masuk_amil_nashob($prevWord){
        if (in_array($prevWord, self::$_huruf_nashob)) 
        	 	{
            		 return true;
             	}
        }
    function nashob_hadz_nun($kata){
		if ((mb_substr($kata, -1,1)=='ا' || 
			 mb_substr($kata, -1,1)=='ْ') &&
			(mb_substr($kata, -2,1)=='ْ' || 
			 mb_substr($kata, -2,1)=='َ'  || 
			 mb_substr($kata, -2,1)=='ي'  || 
			 mb_substr($kata, -2,1)=='ى') ||
			(mb_substr($kata, -3,1) == 'م' || 
			 mb_substr($kata, -3,1) == 'و' || 
			 mb_substr($kata, -3,1) == 'ِ' )||
			(mb_substr($kata, -4,1) == 'م' || 
			 mb_substr($kata, -4,1) == 'َ'|| 
			 mb_substr($kata, -4,1) == 'ُ' )&&
			 self::isim_maushul($kata)==false || 
			(self::isim_tasniyah($kata))==	true )  
				{
					return true;
				}
		}
    function fiil_madli2($kata){
        if (mb_substr($kata, 1, 1) == 'َ' && 
          mb_substr($kata, 3, 1) == 'َ' && 
          mb_substr($kata, 4, 1) == 'َ' )
        {
          return true;
        }
      }
  	function depan_afalul_khomsah($kata){
        if(  (mb_substr($kata, 0, 1) == 'ي' || 
        	mb_substr($kata, 0, 1) == 'ت'  ))
			    {
			      return true;
			    }
	    }
	function tengah_ya_afalul_khomsah($kata){
	    if (mb_substr($kata, -2,1)=='ي'  || 
	    	mb_substr($kata, -2,1)=='ى')
			    {
			      return true;
			    } 
		}
    function akhir_jazem_fathah($kata){
        if (mb_substr($kata, -1, 1) == 'َ' ) 
                {
                return true;
                }
        }
    function akhir_jazem_sukun($kata){
                if (mb_substr($kata, -1, 1) == 'ْ' ) 
                {
                return true;
                }
        }
    function masuk_amil_jazem($prevWord){
        if (in_array($prevWord, self::$_huruf_jazem)) 
        	 	{
            		 return true;
             	}
        }
    function jazem_hadz_nun($kata){
        if ((mb_substr($kata, 0, 1) == 'ي' || mb_substr($kata, 0, 1) == 'ت'  )&&
            (mb_substr($kata, -1,1)=='ا' || mb_substr($kata, -1,1)=='ْ') &&
            (mb_substr($kata, -2,1)=='ْ' || mb_substr($kata, -2,1)=='َ'  || 
             mb_substr($kata, -2,1)=='ي'  || mb_substr($kata, -2,1)=='ى') ||
            (mb_substr($kata, -3,1) == 'م' || mb_substr($kata, -3,1) == 'و'  || 
             mb_substr($kata, -3,1) == 'ِ' )|| (mb_substr($kata, -4,1) == 'م' || 
             mb_substr($kata, -4,1) == 'َ'|| mb_substr($kata, -4,1) == 'ُ' )&&
             self::isim_maushul($kata)==false || (self::isim_tasniyah($kata))== true )  
              {
                return true;
              }
	    } 
	function isim_dlomir($kata){
		if (in_array($kata, self::$_isim_dlomir)){
				return true;
			}
		}
	function awal_qod($kata){
        if($kata=='قَدْ')
                {
                    return true;
                }
            }
  function hukum_jazm($prevWord,$kata){
                if (in_array($prevWord, self::$_huruf_jazem) && 
                  mb_substr($kata, -1, 1) == 'ْ')
                {
                    return true;
                }
            }
    function awal_saufa($kata){
        if($kata=='سَوْفَ')
                {
                    return true;
                }
            }
    function awal_ma_nafi($kata){
        if($kata=='ما' || $kata=='مَا')
                {
                    return true;
                }
            }
    function akhir_rofa_dlommah($kata){
        if (mb_substr($kata, -1, 1) == 'ٌ' || 
        	mb_substr($kata, -1, 1) == 'ُ' || 
        	mb_substr($kata, -1, 1) == 'ى' ) 
                {
                return true;
                }
            }
    function fiil_madli($kata){
		if (mb_substr($kata, 1, 1) == 'َ' && 
			mb_substr($kata, 3, 1) == 'َ' && 
			mb_substr($kata, 5, 1) == 'َ' )
				{
					return true;
				}
			}
    function sukun_amr_belakang($kata){
		if (mb_substr($kata, -1, 1) == 'ْ' ) 
	            {
	                return true;
	            }
			}
	function rofa_nun($kata){
			if ((mb_substr($kata, -1,1)=='ِ' || 
				 mb_substr($kata, -1,1)=='َ') &&
				(mb_substr($kata, -2,1)=='ن') &&
				(mb_substr($kata, -3,1) == 'ْ' || 
				 mb_substr($kata, -3,1) == 'ا' )&&
				(mb_substr($kata, -4,1) == 'و' || 
				 mb_substr($kata, -4,1) == 'َ'|| 
				 mb_substr($kata, -4,1) == 'ي' )&&
				(mb_substr($kata, -5,1) == 'ِ' || 
				 mb_substr($kata, -5,1) == 'َ'|| 
				 mb_substr($kata, -5,1) == 'ُ' )&&
				 self::isim_maushul($kata)==false || 
				(self::isim_tasniyah($kata))==	true )  
				{
					return true;
				}
			}
}//class isim irob
?>