<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class node_fiil
{

	function cek_isimnya($word, $kata){
	$Isim	= new node_isim();
	if (($Isim ->isim($kata, $prevWord))==true){
		return false;
	}
	else {
		return true;}
	}

	private static $_normalizeAlef       = array('ﺁ','ﺇ','ﺃ','أَ');
    private static $_normalizeDiacritics = array('َ','ً','ُ','ٌ','ِ','ٍ','ْ','ّ');
    //huruf nashob
    private static $_huruf_nashob = array('لَنْ','لن','ان','ان','كَيْ','كي','لِكَيْ',
                'لكيْ','كَيْ','كيْ','اَذَنْ','اذن','اذنْ');
    // huruf jazem
    private static $_huruf_jazem = array('لَمْ','لم','لما','لَمَا','ل',
                'لَ','الما','الَمَا','اَلَمْ','المْ','الم');

    public static function fiil($kata, $prevWord){
		//normalisasi hamzah 
        $kata      = str_replace(self::$_normalizeAlef, 'ا', $kata);
       	$prevWord     = str_replace(self::$_normalizeAlef, 'ا', $prevWord);
       	//nirmalisasi harokat
		$kata = trim($kata);
		$prevWord = trim($prevWord);
        //hitung jumlah kata
        $wordlen = mb_strlen($word); 

      if ((self::cek_isimnya($word, $prevWord))==true )
             {
      //bisa kemasukan  nashob
       if (in_array($prevWord, self::$_huruf_nashob)) {
           return true;
           }                  	
       // bisa kemasukan huruf jazm
	    if (in_array($prevWord, self::$_huruf_jazem)) {
	        return true;
	    	}
	    //cek qod
        if((self::awal_qod($prevWord))==true){
                                    	return true;
                                   }
        //cek saufa 
        if((self::awal_saufa($prevWord))==true){
                                    	return true;
                                   }
        //cek sin 
        if ((self::awal_sin($word))==true){
                                   		return true;
                                   }
        // cek ta'tanist sakinah
        if ((self::tanist_sakinah($word))==true) {
                                      return true;
                                   } 
        // cek ta' fail
        if ((self::ta_fail($word))==true) {
                                      return true;
                                   }                 
        // cek ya' muanast mukhotobah
        if ((self::ya_muanast($word))==true) {
                                      return true;
                                   }                 
        // cek nun taukid
        if ((self::nun_taukid($word)==true) &&
        	(self::huruf_mudloroah($word)==true)) {
                                      return true;
                                   }                                             
		// tanda fiil madli
        if ((self::fiil_madli($word)==true) ||
        	(self::tanist_sakinah($word)==true) ||  
        	(self::tiga_kata($word)==true) && 
        	(self::huruf_mudloroah($word)==false)&& 
        	(self::awal_saufa($word)==false)) {
                			return true;           
                		}
        // tanda fiil mudlori
        if ((self::huruf_mudloroah($word)==true) &&
            (self::sukun_amr_belakang($word)==false) &&
            (self::awal_qod($prevWord))!=true && 
            (self::fiil_madli($word))==false || 
            (self::awal_saufa($prevWord))==true ||
            (self::awal_ma_nafi($prevWord))==true) {
                			return true;     		
                		}


                }//end cek    

        return false;           
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
    function fiil_madli($kata)	{

				if (mb_substr($kata, 1, 1) == 'َ' && mb_substr($kata, 3, 1) == 'َ' && mb_substr($kata, 5, 1) == 'َ' )
					{
					return true;
					}
				}  
	function tiga_kata($kata){
				$panjang = mb_strlen($kata);
				if (($panjang >= 3)) {
					return true;
					}
				}
	function huruf_mudloroah($kata){
	        	if(mb_substr($kata, 0, 1) == 'ا' || mb_substr($kata, 0, 1) == 'ن' || mb_substr($kata, 0, 1) == 'ي' || mb_substr($kata, 0, 1) == 'ت'){ 
					return true; 
					}
				}
	function sukun_amr_belakang($kata){
				if (mb_substr($kata, -1, 1) == 'ْ' ) 
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
	function ta_fail($kata){
                if (mb_substr($kata, -1, 1) == 'َ' &&mb_substr($kata, -2, 1) == 'ت' ||mb_substr($kata, -1, 1) == 'ِ' && mb_substr($kata, -2, 1) == 'ت'|| mb_substr($kata, -1, 1) == 'ُ'&& mb_substr($kata, -2, 1) == 'ت') 
                {
                return true;
                }

            }
    function ya_muanast($kata){
                if (mb_substr($kata, -1, 1) == 'ْ' && mb_substr($kata, -2, 1) == 'ى' ) 
                {
                return true;
                }
            }
    function nun_taukid($kata){
                if (mb_substr($kata, -1, 1) == 'ْ' &&mb_substr($kata, -2, 1) == 'ن'||mb_substr($kata, -1, 1) == 'ّ' &&mb_substr($kata, -2, 1) == 'ن'  ) 
                {
                return true;
                }
            }

}
?>