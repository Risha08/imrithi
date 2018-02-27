<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class node_fiil_fungsi
{

	function cek_isimnya($kata, $prevWord){
		$Isim = new node_isim();
		if (($Isim->isim($kata, $prevWord))==true)
		{
			return false;
		}
		else{
			return true;
		}
	}

	private static $_normalizeAlef       = array('ﺁ','ﺇ','ﺃ','أَ');
    private static $_normalizeDiacritics = array('َ','ً','ُ','ٌ','ِ','ٍ','ْ','ّ');
    //huruf di isim dlomir
    private static $_isim_dlomir = array('هُوَ','هو',
        'هُمَا','هما',
        'هُمْ','هم',
        'هِيَ','هي',
        'هُمَا','هما',
        'هن','هُنَّ',
        'انْتَ','انت',
        'انْتُمَا','انتما',
        'انْتُمْ','انتم',
        'انْتِ','انت',
        'انْتُمَا','انتما',
        'انْتُنَّ','انتن',
        'انَا','انا',
        'نَحْنُ','نحن');
    //huruf nashob
    private static $_huruf_nashob = array('لَنْ','لن','ان','ان','كَيْ','كي','لِكَيْ',
                'لكيْ','كَيْ','كيْ','اَذَنْ','اذن','اذنْ');
    // huruf jazem
    private static $_huruf_jazem = array('لَمْ','لم','لما','لَمَا','ل',
                'لَ','الما','الَمَا','اَلَمْ','المْ','الم');
    // huruf jer
    private static $_huruf_jar = array('مِنْ','مِنَ','اِلَى','الى','الَى','الىَ',
        'في','فِيْ','فِي','عَنْ','عَنِ','عن','مِنَ','مِن','عَلَى','على','عَلى','رُبَّ',
        'رب', 'ب', 'بِ','فَوْقَ','فوق');
    //huruf inna wa akhatuha
    private static $_huruf_ina = array('اَنَّ','انّ','اِنَّ','لِكَنْ','لكنْ',
    	'كَاَنَّ','كَانَ','كانّ','كان','لعل','لَعَلَّ','كَانَتِ','كَانَت','لَيْتَ');
    // huruf nida 
    private static $_huruf_nida = array('يا','يَا','اَيَا','ايا','هَيَا','هيا','اَيَ','اي');
    // huruf istisna 
    private static $_huruf_istisna = array('اِلَّا','اِلاَّ','الا','الاّ','غَيْرَ','غَيْرِ','غَيْرُ',
        'سَوَي','سوي','عَدَ','عد','اَوْحَشَا','اوحشا','خلا','خَلاً');
    // huruf athof
    private static $_huruf_athof = array('و','وَ','ثُمَّ','ثمّ','ثم','اَوْ','او');
    //isim istifham
    private static $_isim_istifham = array('هل','هَلْ',
            'مَن','مَنْ',
            'مَا','ما',
            'متى','مَتَى',
            'أَيْنَ','أين',
            'ماذا','مَاذَا',
            'كيف','كَيْفَ',
            'أيان','أَيانَ');


    function bentuk_fiil($awal, $kata){
    	//normalisasi hamzah
    	$kata	= str_replace(self::$_normalizeAlef, 'ا', $kata);

    	$kata	= trim($kata);
    	//pecah array berdasarkan spasi
        $words    = explode(' ', $kata);
        $prevWord = null;
        $results  = array();  
        foreach ($words as $word) {
                  if ($word == '') {
                      continue;
                  }
        if((self::cek_isimnya($word, $prevWord))==true){

            //awal qod
            if((self::awal_qod($prevWord))==true)
           {
           	echo json_encode($word); echo ":{";
           	echo'"node"';echo":";echo'"3",';
           	echo'"bentuk"';echo":";echo'"fiil",';
            echo'"status":"true"';
           	echo "},";
           }
           //awal saufa
            if((self::awal_saufa($prevWord))==true)
           {
            echo json_encode($word); echo ":{";
            echo'"node"';echo":";echo'"3",';
            echo'"bentuk"';echo":";echo'"fiil",';
            echo'"status":"true"';
            echo "},";
           }
           //awal sin
            if((self::awal_sin($prevWord))==true)
           {
            echo json_encode($word); echo ":{";
            echo'"node"';echo":";echo'"3",';
            echo'"bentuk"';echo":";echo'"fiil",';
            echo'"status":"true"';
            echo "},";
           }
           //awal tanist sakinah
             if((self::tanist_sakinah($prevWord))==true)
           {
            echo json_encode($word); echo ":{";
            echo'"node"';echo":";echo'"3",';
            echo'"bentuk"';echo":";echo'"fiil",';
            echo'"status":"true"';
            echo "},";
           }
           //hukum jazem
            if ((self::huruf_mudloroah($word)==true) &&
            (self::hukum_jazm1($word))==true)
                {
            echo json_encode($word); echo ":{";
            echo'"node"';echo":";echo'"3",';
            echo'"bentuk"';echo":";echo'"fiil",';
            echo'"status":"true"';
            echo "},";
           }
            //tanda fiil madli
            if ((self::fiil_madli2($word)==true) 
            || (self::tanist_sakinah($word)==true) 
            || (self::tiga_kata($word)==true) 
            && (self::huruf_mudloroah($word)==false) 
            && (self::awal_qod($word)==false)
            && (self::awal_saufa($word)==false) 
            && (self::kategori_huruf($word)==false)) {
            echo json_encode($word); echo ":{";
            echo'"node"';echo":";echo'"3",';
            echo'"bentuk"';echo":";echo'"fiil",';
            echo'"status":"true"';
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
            echo'"node"';echo":";echo'"3",';
            echo'"bentuk"';echo":";echo'"fiil",';
            echo'"status":"true"';
            echo "},";
                }  
            //tanda fiil amar
            if ((self::harakat_depan_amr($word)==true) && 
            (self::sukun_amr_belakang($word)==true) && 
            (self::sukun_amr_depan($word)==true) && 
            (self::awal_ma_nafi($prevWord))==false) 
              {
            echo json_encode($word); echo ":{";
            echo'"node"';echo":";echo'"3",';
            echo'"bentuk"';echo":";echo'"fiil",';
            echo'"status":"true"';
            echo "},";
              }            

        }//if cek_isimnya
        $prevWord = $word;

		}//foreach
		$akhir = microtime(true);
		$lama  = $akhir - $awal;
		echo '"durasi_node_3":';
		echo '"'.$lama.'",';

    }//bentuk fiil

//level 2
   function fiil_madli($awal,$kata){
   	//normalisasi hamzah
   	$kata	=str_replace(self::$_normalizeAlef, 'ا', $kata);

   	$kata	= trim($kata);

    //pecah array berdasarkan spasi
    $words    = explode(' ', $kata);
    $prevWord = null;
    $results    = array();    
       foreach ($words as $word) {
            if ($word == '') {
                continue;
                    } 
    if ((self::cek_isimnya($word, $prevWord))==true ){
    	//awalnya berupa huruf qod
    	if((self::awal_qod($prevWord))==true){
            echo json_encode($word); echo ":{";
       		echo '"node"';echo ":";echo '"9",';
            echo '"bentuk"';echo ":";echo '"fiil",';
            echo '"kategori"';echo ":";echo '"fiil madli",'; 
            echo '"status":"true"';
            echo "},";
            
            }
        //tanda fiil madli
        if ((self::fiil_madli2($word)==true) 
        	|| (self::tanist_sakinah($word)==true) 
        	|| (self::tiga_kata($word)==true) 
        	&& (self::huruf_mudloroah($word)==false) 
        	&& (self::awal_qod($word)==false)
        	&& (self::awal_saufa($word)==false) 
        	&& (self::kategori_huruf($word)==false)) {
            echo json_encode($word); echo ":{";
            echo '"node"';echo ":";echo '"9",';
            echo '"bentuk"';echo ":";echo '"fiil",';
            echo '"kategori"';echo ":";echo '"fiil madli",'; 
            echo '"status":"true"';
            echo "},";
                    }
        //diakhiri dengan huruf madli
        if((self::huruf_madli($word)==true))
                {
			echo json_encode($word); echo ":{";
            echo '"node"';echo ":";echo '"9",';
            echo '"bentuk"';echo ":";echo '"fiil",';
            echo '"kategori"';echo ":";echo '"fiil madli",'; 
            echo '"status":"true"';
            echo "},";
					}                             
                        }
               
                       $prevWord = $word;
                             
                    }              
        $akhir = microtime(true);
    	$lama  = $akhir - $awal;
        echo '"durasi_node_9":';
        echo '"'.$lama.'",';
    }

    function fiil_mudhori($awal,$kata){
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
    if ((self::cek_isimnya($word, $prevWord))==true ){
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
                echo '"node"';echo ":";echo '"10",';
                echo '"bentuk"';echo ":";echo '"fiil",';
                echo '"kategori"';echo ":";echo '"fiil mudhari",'; 
                echo '"status":"true"';
                echo "},";
                
                } 
        //awalan ta dan sukun
         if ((self::huruf_mudloroah($word)==true) &&
            (self::hukum_jazm1($word))==true) 
                {
                echo json_encode($word); echo ":{";
                echo '"node"';echo ":";echo '"10",';
                echo '"bentuk"';echo ":";echo '"fiil",';
                echo '"kategori"';echo ":";echo '"fiil mudhari",'; 
                echo '"status":"true"';
                echo "},";
                }             
                        }
                     
                       $prevWord = $word;         
                    }

            $akhir = microtime(true);
            $lama = $akhir - $awal;
            echo '"durasi_node_10":';
            echo '"'.$lama.'",';
    }

    function fiil_amar($awal,$kata){
    //normalisasi hamzah 
    $kata = str_replace(self::$_normalizeAlef, 'ا', $kata);
    //normalisasi spasi
    $kata = trim($kata);
	//pecah array berdasarkan spasi
    $words 	  = explode(' ', $kata);
    $prevWord = null;
    $results  = array();    
        foreach ($words as $word) {
            if ($word == '') {
              continue;
                    } 
    if ((self::cek_isimnya($word, $prevWord))==true ){
    	//tanda fiil amar
        if ((self::harakat_depan_amr($word)==true) && 
        	(self::sukun_amr_belakang($word)==true) && 
        	(self::sukun_amr_depan($word)==true) && 
            (self::awal_ma_nafi($prevWord))==false) 
        	  {
              echo json_encode($word); echo ":{";
                echo '"node"';echo ":";echo '"11",';
                echo '"bentuk"';echo ":";echo '"fiil",';
                echo '"kategori"';echo ":";echo '"fiil amar",'; 
                echo '"status":"true"';
                echo "},";
              }
        //diakhiri dengan kata amr
        if((self::huruf_amr($word)==true) &&
        	(self::harakat_depan_amr($word))==true)
        	{
                echo json_encode($word); echo ":{";
                echo '"node"';echo ":";echo '"11",';
                echo '"bentuk"';echo ":";echo '"fiil",';
                echo '"kategori"';echo ":";echo '"fiil amar",'; 
                echo '"status":"true"';
                echo "},";
        	}                     
                        }
                  
            $prevWord = $word;
                             
                }
                    
        $akhir = microtime(true);
        $lama = $akhir - $awal;
        echo '"durasi_node_11":';
        echo '"'.$lama.'",';
    }

//coba 
    
//end level2
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
            function tanist_sakinah($kata){
                if (mb_substr($kata, -1, 1) == 'ْ' && 
                	mb_substr($kata, -2, 1) == 'ت' ) 
                {
                return true;
                }
            }
			function huruf_mudloroah($kata){
        		if(mb_substr($kata, 0, 1) == 'ا' || 
        		   mb_substr($kata, 0, 1) == 'ن' || 
        		   mb_substr($kata, 0, 1) == 'ي' || 
        		   mb_substr($kata, 0, 1) == 'ت'  )
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
			function tiga_kata($kata){
			$panjang = mb_strlen($kata);
				if (($panjang >= 3)) 
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
            function hukum_jazm1($kata){
                if (mb_substr($kata, -1, 1) == 'ْ')
                {
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
            function huruf_madli($kata){
                if (mb_substr($kata, -1, 1) == 'ا' && mb_substr($kata, -2, 1) == 'َ' && mb_substr($kata, -3, 1) == 'ن'||
                    mb_substr($kata, -1, 1) == 'ا' && mb_substr($kata, -2, 1) == 'َ' && mb_substr($kata, -3, 1) == 'ت'||
                    mb_substr($kata, -1, 1) == 'َ' && mb_substr($kata, -2, 1) == 'ن' && mb_substr($kata, -3, 1) == 'ْ'||
                    mb_substr($kata, -1, 1) == 'ِ' && mb_substr($kata, -2, 1) == 'ت' && mb_substr($kata, -3, 1) == 'ْ'||
                    mb_substr($kata, -1, 1) == 'ُ' && mb_substr($kata, -2, 1) == 'ت' && mb_substr($kata, -3, 1) == 'ْ'||
                    mb_substr($kata, -1, 1) == 'ْ' && mb_substr($kata, -2, 1) == 'م' && mb_substr($kata, -3, 1) == 'ت'||
                    mb_substr($kata, -1, 1) == 'ُ' && mb_substr($kata, -2, 1) == 'ت' && mb_substr($kata, -3, 1) == 'ْ'||
                    mb_substr($kata, -1, 1) == 'ا' && mb_substr($kata, -2, 1) == 'و'||
                    mb_substr($kata, -1, 1) == 'ت' && mb_substr($kata, -2, 1) == 'ْ') 
                {
                    return true;
                }
            }
            function huruf_amr($kata){
                if (mb_substr($kata, -1, 1) == 'ن' && mb_substr($kata, -2, 1) == 'َ'||
                    mb_substr($kata, -1, 1) == 'ا' && mb_substr($kata, -2, 1) == 'و'||
                    mb_substr($kata, -1, 1) == 'ت' && mb_substr($kata, -2, 1) == 'ْ'||
                    mb_substr($kata, -1, 1) == 'ا' ||
                    mb_substr($kata, -1, 1) == 'ي') 
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
            function  awal_sin ($kata){
                 if (mb_substr($kata, 0, 1) == 'س'  && self::awal_saufa($kata)!= true)
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
	        function kategori_huruf($kata){
		        if (in_array($kata, self::$_huruf_nida) ||
		         	in_array($kata, self::$_huruf_jar) || 
		         	in_array($kata, self::$_huruf_istisna) ||
		          	in_array($kata, self::$_huruf_ina)||
		           	in_array($kata, self::$_huruf_jazem)||
		            in_array($kata, self::$_huruf_nashob)||
		            in_array($kata, self::$_isim_istifham)||
		            in_array($kata, self::$_huruf_athof))
		        {
		            return true;
		        }  
	    	}
	        function isim_dlomir($kata){
	            if (in_array($kata, self::$_isim_dlomir))
	            {
	                return true;
	            }
	        }
	//end pemangilan fungsi

}
?>