<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class node_isim_irob
{
function cek_isimnya($kata, $prevWord) {
	$Isim = new node_isim();
	//$kata = 'هُوَ';
	if ( ($Isim->isim($kata, $prevWord))==true)
		{return false;}
		else {return true;}
     	} 

	// asmaul khomsah
	private static $_asmaul_khomsah = array('اَبُوْكَ','اَبَاكَ','اباك','ابوك','اَخُوْكَ',
		'اخوك','حَمُوْكَ','حموك','فُوْكَ','فوك','ذُوْمَالٍ','ذومال');
	// asmaul_khomsah_nashob
	private static $_asmaul_khomsah_nashob = array('اَبَاكَ','اباك','اَخَاكَ','اخاك','حَمَاكَ',
		'حماك','فَاكَ','فاك');
	// asmaul khomsah jer
   	private static $_asmaul_khomsah_jer = array('اَبِيْكَ','ابيك','اَخِيْكَ','اخيك','حَمِيْكَ',
   		'حميك','فِيْكَ','فيك');
   	//huruf nashob
    private static $_huruf_nashob = array('لَنْ','لن','ان','اَنْ','كَيْ','كي','لِكَيْ',
                'لكيْ','كَيْ','كيْ','اَذَنْ','اذن','اذنْ');
    // huruf jazem
    private static $_huruf_jazem = array('لَمْ','لم','لما','لَمَا','ل','لَ','الما','الَمَا','اَلَمْ','المْ','الم');
    // huruf jer
    private static $_huruf_jar = array('مِنْ','مِنَ','اِلَى','الى','الَى','الىَ','في','فِيْ',
    	'فِي','عَنْ','عَنِ','عن','مِنَ','مِن','عَلَى','على','عَلى','رُبَّ',
        'رب', 'ب', 'بِ','فَوْقَ','فوق');
    //huruf inna wa akhatuha
    private static $_huruf_ina = array('اَنَّ','انّ','اِنَّ','لِكَنْ','لكنْ','كَاَنَّ','كانّ','كان',
    	'لعل','لَعَلَّ','كَانَتِ','كَانَت');
    // huruf nida 
    private static $_huruf_nida = array('يا','يَا','اَيَا','ايا','هَيَا','هيا','اَيَ','اي');
    // huruf istisna 
    private static $_huruf_istisna = array('اِلَّا','اِلاَّ','الا','الاّ','غَيْرَ','غَيْرِ','غَيْرُ',
    	'سَوَي','سوي','عَدَ','عد','اَوْحَشَا','اوحشا','خلا','خَلاً');
    // kalimah huruf pengecuali 	
    private static $_kalimahHuruf    = array('عن',  'مذ', 'منذ', 'من', 	
                                                  'الى', 'على', 'حتى', 'الا', 
                                                  'غير', 'سوى', 'خلا', 'عدا', 
                                                  'حاشا', 'ليس');
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
    //isim mausul
    private static $_isim_maushul = array('الَّذِيْ','الّذي',
    	'الَّتِيْ','الّتي',
    	'الَّذِيْنَ','الّذيْن',
    	'اللاَّتِيْ','اللاّتي',
    	'اللاَّئِيْ','اللاّئيْ');
    //isim istifham
    private static $_isim_istifham = array('هل','هَلْ',
			'مَنْ','مَنْ',
			'مَا','ما',
			'متى','مَتَى',
			'أَيْنَ','أين',
			'ماذا','مَاذَا',
			'كيف','كَيْفَ',
			'أيان','نَأَيا');
    //isim isyaroh
    private static $_isim_isyarah = array('هَذَا', 'هذا',
     'هَذِهِ','هذه',
      'ذَلِكَ','ذلك',
       'تِلْكَ','تلْك');
    //jama taksir
    private static $_jama_taksir = array('كفَّارٌ','اْلاوْلاَد','رُسُلٌ','عُلَمَاءُ','رِجَالٌ',
    	'نِسَاءٌ','الطُّللَّابُ','مَكَاتِبُ','كُتُبٌ','كَرَاسِيٌّ','أَسَاتِذُ','أَقْلاَمٌ');
    
    private static $_normalizeAlef       = array('ﺁ','ﺇ','ﺃ');
    private static $_normalizeDiacritics = array('َ','ً','ُ','ٌ','ِ','ٍ','ْ','ّ');


 	function isim_irob($awal,$kata){
  	echo '"irob_isim": {';
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
        //output irob isim rafa
        if(self::rofa($prevWord,$word)==true){
           echo json_encode($word); echo ":{";
           echo '"node"';echo ":";echo '"8",';
           echo '"irob"';echo ":";echo '"rofa"';
           echo "},";
           }
        //output irob isim nashob
        if(self::nashob($prevWord,$word)==true){
           echo json_encode($word); echo ":{";
           echo '"node"';echo ":";echo '"8",';
           echo '"irob"';echo ":";echo '"nashob"';
           echo "},";
           }
        //output irob isim jar
        if(self::jar($prevWord,$word)==true){
           echo json_encode($word); echo ":{";
           echo '"node"';echo ":";echo '"8",';
           echo '"irob"';echo ":";echo '"jar"';
           echo "},";
            }
                    
        $prevWord = $word;                     
                    }
      	echo '"debug":{"data":"ok"}';
        $akhir = microtime(true);
        $lama = $akhir - $awal;
        echo "},";
        echo '"durasi_node_8":';
        echo '"'.$lama.'",';
    }

	  //fungsi isim irob rofa
	function rofa($prevWord,$word){
   
     if ((self::cek_isimnya($word, $prevWord))==false )
        {
        //berupa huruf nida
        if (in_array($prevWord, self::$_huruf_nida)) {
            return true;
             	}
        //berupa huruf afalul khomsah     	
		if (in_array($word, self::$_asmaul_khomsah)) {
            return true;
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
		 	return true;
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
		    return true;
		    if( empty($results) ) 
		    { echo 'No matches found.'; }
		    }
		// tasniyah tanpa al 
		if ((self::huruf_al($word)==false) && 
			(self::isim_tasniyah($word))==true && 
			(self::harakat_kasroh($word))==true  )
                	  {
		   $results[] = $word;
		    return true;
		    if( empty($results) ) 
		    { echo 'No matches found.'; }
		    }  
		//tasniyah dengan al 
		if ((self::huruf_al($word)==true) && 
			(self::isim_tasniyah($word))==true && 
			(self::harakat_kasroh($word))==true ) 
                	  {
		   $results[] = $word;
		    return true;
		    if( empty($results) ) 
		    { echo 'No matches found.'; }
		    }
		//jama' muannat salim tanpa al
		if ((self::huruf_al($word)==false) &&
			(self::j_muannats_salim($word)==true)) 
                	  {
		   $results[] = $word;
		    return true;
		    if( empty($results) ) 
		    { echo 'No matches found.'; }
		    }
		//jama' muannat salim dengan al
		if ((self::huruf_al($word)==true) &&
			(self::j_muannats_salim($word)==true)) 
                	  {
		   $results[] = $word;
		    return true;
		    if( empty($results) ) 
		    { echo 'No matches found.'; }
		    }
		//jama' mudzakar salim tanpa al
		if ((self::huruf_al($word)==false) &&
			(self::j_mudzakar_salim($word)==true) &&
			(self::huruf_mudloroah($word)==false)) 
                	  {
		   $results[] = $word;
		    return true;
		    if( empty($results) ) 
		    { echo 'No matches found.'; }
		    }
		//jama' mudzakar salim dengan al
		if ((self::huruf_al($word)==true) &&
			(self::j_mudzakar_salim($word)==true)) 
                	  {
		   $results[] = $word;
		    return true;
		    if( empty($results) ) 
		    { echo 'No matches found.'; }
		    }
		//jama' taksir
		if (self::jama_taksir($word)==true) 
                	  {
		  $results[] = $word;
		   return true;
		   if( empty($results) ) 
		   { echo 'No matches found.'; }
		   }
		
		   }//end cek      
	}//end isim rafa

	// fungsi irob nashob
	function nashob($prevWord,$word){

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
		 	return true;
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
		    return true;
		    }
		// tasniyah tanpa al nashob
		if ((self::huruf_al($word)==false) && 
			(self::isim_tasniyah_irob($word))==true && 
			(self::masuknya_huruf_jer_idhofah($word))==false)
                	  {
		   $results[] = $word;
		    return true;
		    }  
		//terdapat huruf asmaul khomsah    
 		if (in_array($word, self::$_asmaul_khomsah_nashob)) 
 			  {
                 return true;
              }
		//tasniyah dengan al 
		if ((self::huruf_al($word)==true) && 
			(self::isim_tasniyah_irob($word))==true && 
			(self::harakat_kasroh($word))==true ) 
                	  {
		   $results[] = $word;
		    return true;
		    }
		//jama' muannat salim tanpa al
		if ((self::huruf_al($word)==false) &&
			(self::j_muannats_salim_irob($word)==true)&&
			(self::masuknya_huruf_jer_idhofah($word)==false)) 
                	  {
		   $results[] = $word;
		   return true;
		    }	
		//jama' muannat salim dengan al
		if ((self::huruf_al($word)==true) &&
			(self::j_muannats_salim_irob($word)==true)) 
                	  {
		   $results[] = $word;
		   return true;
		    }
		//jama' mudzakar salim tanpa al
		if ((self::huruf_al($word)==false) &&
			(self::j_mudzakar_salim_irob($word)==true) &&
			(self::huruf_mudloroah($word)==false) &&
			(self::masuknya_huruf_jer_idhofah($word)==false)) 
                	  {
		   $results[] = $word;
		    return true;
		    }			
		//jama' mudzakar salim dengan al
		if ((self::huruf_al($word)==true) &&
			(self::j_mudzakar_salim_irob($word)==true)  ) 
                	  {
		   $results[] = $word;
		    return true;
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
            $results[] = $word;
		    return true;             
             }          
		}//end cek isim
	}//end isim nashob

	//fungsi isim irob jer
	function jar($prevWord,$word){
	
     if ((self::cek_isimnya($word, $prevWord))==false ){
        //bisa kemasukan jer
        if (in_array($prevWord, self::$_kalimahHuruf)) {
             return true;
             	}
        //terdapat huruf jar
        if (in_array($prevWord, self::$_huruf_jar)) {
             return true;
             	}
        //terdapat huruf nida     	
        if (in_array($prevWord, self::$_huruf_nida)) {
             return true;
             	}
        //terdapat asmaul khomsah jer
		if (in_array($word, self::$_asmaul_khomsah_jer)) {
            		return true;
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
		    return true;
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
		    return true; 
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
		    return true;
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
		    return true;
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
		    return true;
		    if( empty($results) ) 
		    { echo 'No matches found.'; }
		    }  
		//jama' muannat salim tanpa al jer
		if ((self::huruf_al($word)==false) &&
			(self::j_muannats_salim_irob($word)==true)&&
			(self::masuknya_huruf_jer_idhofah($word)==true)) 
                	  {
		   $results[] = $word;
		   return true;
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
		    return true;
		    if( empty($results) ) 
		    { echo 'No matches found.'; }
		    }
	    }//end cek
		
	}//end isim jer

//pemanggilan fungsi
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
			if ((mb_substr($kata, -1,1)=='ا' || mb_substr($kata, -1,1)=='ْ') &&
			    (mb_substr($kata, -2,1)=='ْ' || mb_substr($kata, -2,1)=='َ' || 
			     mb_substr($kata, -2,1)=='ي'  || mb_substr($kata, -2,1)=='ى') ||
			    (mb_substr($kata, -3,1) == 'م' || mb_substr($kata, -3,1) == 'و'  || 
			     mb_substr($kata, -3,1) == 'ِ' )||(mb_substr($kata, -4,1) == 'م' || 
			     mb_substr($kata, -4,1) == 'َ'|| mb_substr($kata, -4,1) == 'ُ' )&&
			     self::isim_maushul($kata)==false || (self::isim_tasniyah($kata))==	true )  
		{
			return true;
		}
	}
    function depan_afalul_khomsah($kata){
	    if(  (mb_substr($kata, 0, 1) == 'ي' || mb_substr($kata, 0, 1) == 'ت'  ))
	    {
	      return true;
	    }
	  }
    function tengah_ya_afalul_khomsah($kata){
	    if (mb_substr($kata, -2,1)=='ي'  || mb_substr($kata, -2,1)=='ى')
	    {
	      return true;
	    } 
	  }
    function masuk_amil_jar($prevWord){
        if (in_array($prevWord, self::$_huruf_jar)) 
        		{
            		 return true;
             	}
        }
    function masuknya_huruf_jer_idhofah($kata){
     	if ( (mb_substr($kata, 0, 1) == 'ب' && mb_substr($kata, 1, 1) == 'ِ') ||
     	     (mb_substr($kata, 0, 1) == 'ل' && mb_substr($kata, 1, 1) == 'ِ')
     	 )
     		{return true;}
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
        	 	if (in_array($prevWord, self::$_huruf_jazem)) {
            		//echo $word." isim";
            		 return true;
             	}
        }
    function jazem_hadz_nun($kata){
              if (
                (mb_substr($kata, 0, 1) == 'ي' || mb_substr($kata, 0, 1) == 'ت'  )&&
                (mb_substr($kata, -1,1)=='ا' || mb_substr($kata, -1,1)=='ْ') &&
                (mb_substr($kata, -2,1)=='ْ' || mb_substr($kata, -2,1)=='َ'  || 
                 mb_substr($kata, -2,1)=='ي'  || mb_substr($kata, -2,1)=='ى') ||
                (mb_substr($kata, -3,1) == 'م' || mb_substr($kata, -3,1) == 'و'  || 
                 mb_substr($kata, -3,1) == 'ِ' )||(mb_substr($kata, -4,1) == 'م' || 
                 mb_substr($kata, -4,1) == 'َ'|| mb_substr($kata, -4,1) == 'ُ' )&&
                 self::isim_maushul($kata)==false || (self::isim_tasniyah($kata))== true )  
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
		if ((mb_substr($kata, -1, 1) == 'ا' && 
			 mb_substr($kata, -2, 1) == 'ً') || 
			(mb_substr($kata, -1, 1) == 'ً')) 
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
	function ta_marbutah($kata){
		if(mb_substr($kata, -2,1)=='ة' || mb_substr($kata, -2,1)=='ت')
		{
			return true;
		}
	}
	function ya_akhir($kata){
		if (mb_substr($kata, -1,1) == 'ى' || mb_substr($kata, -1,1) == 'ي'  ) 
		{
			return true;
		}
	}
	function j_muannats_salim($kata){
		if (mb_substr($kata, -3,1) == 'ا' && 
			mb_substr($kata, -2,1)=='ت' && 
			mb_substr($kata, -1,1)=='ُ')  
		{
			return true;
		}
	}
	function j_muannats_salim_irob($kata){
		if (mb_substr($kata, -3,1) == 'ا' && 
			mb_substr($kata, -2,1)=='ت' &&  
			mb_substr($kata, -1,1)=='ِ')  
		{
			return true;
		}
	}
	function j_mudzakar_salim($kata){
		if (mb_substr($kata, -5,1) == 'ُ' && 
			mb_substr($kata, -3,1) == 'ْ' && 
			mb_substr($kata, -4,1) == 'و' && 
			mb_substr($kata, -2,1)=='ن' && 
			mb_substr($kata, -1,1)=='َ' )  
		{
			return true;
		}
	}
	function j_mudzakar_salim_irob($kata){
		if (mb_substr($kata, -5,1) == 'ِ' && 
			mb_substr($kata, -3,1) == 'ْ' && 
			mb_substr($kata, -4,1) == 'ي' && 
			mb_substr($kata, -2,1)=='ن' && 
			mb_substr($kata, -1,1)=='َ' && 
			self::isim_maushul($kata)==false )  
		{
			return true;
		}
	}
	function isim_tasniyah($kata){
		  if ((mb_substr($kata, -1, 1)) == 'ِ' && 
		  	  (mb_substr($kata, -2, 1)) == 'ن' && 
		  	  (mb_substr($kata,-3, 1) == 'ا' )) 
		{
            return true;
        }
	}
	function mustasna($kata){
		 if ( (mb_substr($kata, -1, 1)) == 'ا' && (mb_substr($kata,-2, 1) == 'ً' ) ){
		 	return true;
		 }
	}
	function isim_tasniyah_irob($kata)
	{
		if ((mb_substr($kata, -1, 1)) == 'ِ' && (mb_substr($kata, -2, 1)) == 'ن' && 
			(mb_substr($kata,-3, 1)) == 'ْ' && (mb_substr($kata,-4, 1)) == 'ي' && 
			(mb_substr($kata,-5, 1)) == 'َ' ) 
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
        		 mb_substr($kata, 3, 1) == 'ْ') ) {
            return true;
        	}
	}
	function jama_taksir($kata){
		if (in_array($kata, self::$_jama_taksir)){
			return true;
		}
	}
	function isim_dlomir($kata){
		if (in_array($kata, self::$_isim_dlomir)){
			return true;
		}
	}
	function isim_istifham($kata){
		if (in_array($kata, self::$_isim_istifham)){
			return true;
		}
	}
	function isim_maushul($kata){
		if (in_array($kata, self::$_isim_maushul)){
			return true;
		}
		else{return false;}
	}
	function isim_isyarah($kata){
		if (in_array($kata, self::$_isim_isyarah)){
			return true;
		}	
	}
	function kategori_huruf($kata){
		if (in_array($kata, self::$_huruf_nida) || in_array($kata, self::$_huruf_jar) || 
			in_array($kata, self::$_huruf_istisna) || in_array($kata, self::$_huruf_ina)|| 
			in_array($kata, self::$_isim_istifham)|| in_array($kata, self::$_isim_dlomir))
		{
			return true;
		}
	}
	function kategori_asmaul_khomsah($kata){
		if (in_array($kata, self::$_asmaul_khomsah) || 
		in_array($kata, self::$_asmaul_khomsah_jer)){
			return true;
		}
	}
	function huruf_mudloroah($kata){
        	if(mb_substr($kata, 0, 1) == 'ا' || mb_substr($kata, 0, 1) == 'ن' || 
        	   mb_substr($kata, 0, 1) == 'ي' || mb_substr($kata, 0, 1) == 'ت'  )
        	{
        	 return true; 
			}
		}
    function awal_qod($kata){
                if($kata=='قَدْ')
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
    function  awal_sin ($kata){
                 if (mb_substr($kata, 0, 1) == 'س'  && self::awal_saufa($kata)!= true)
                {
                    return true;
                }
            }
    function tanist_sakinah($kata){
                if (mb_substr($kata, -1, 1) == 'ْ' && mb_substr($kata, -2, 1) == 'ت' ) 
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
	function hukum_jazm($prevWord,$kata){
                if (in_array($prevWord, self::$_huruf_jazem) && 
                	mb_substr($kata, -1, 1) == 'ْ'){
                    return true;
                }
            }
    function harakat_depan_amr($kata){
			if (mb_substr($kata, 1, 1) == 'ُ' || 
				mb_substr($kata, 1, 1) == 'ِ' && 
				mb_substr($kata, 0, 1) == 'ا'  ) 
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
	function sukun_amr_depan($kata){
			if (mb_substr($kata, 3, 1) == 'ْ' ) 
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
	function rofa_nun($kata){
		if ((mb_substr($kata, -1,1)=='ِ' || mb_substr($kata, -1,1)=='َ') &&
			(mb_substr($kata, -2,1)=='ن') &&(mb_substr($kata, -3,1) == 'ْ' || 
		     mb_substr($kata, -3,1) == 'ا' )&& (mb_substr($kata, -4,1) == 'و' || 
		     mb_substr($kata, -4,1) == 'َ'|| mb_substr($kata, -4,1) == 'ي' )&&
			(mb_substr($kata, -5,1) == 'ِ' || mb_substr($kata, -5,1) == 'َ'|| 
			 mb_substr($kata, -5,1) == 'ُ' )&&
			 self::isim_maushul($kata)==false || (self::isim_tasniyah($kata))==	true )  
		{
			return true;
		}
	}


}//end irob isim
?>