<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class node_isim
{
	private static $_normalizeAlef       = array('ﺁ','ﺇ','ﺃ');
    private static $_normalizeDiacritics = array('َ','ً','ُ','ٌ','ِ','ٍ','ْ','ّ');
    // huruf jer
    private static $_huruf_jar = array('مِنْ','مِنَ','اِلَى','الى','الَى','الىَ',
        'في','فِيْ','فِي','عَنْ','عَنِ','عن','مِنَ','مِن','عَلَى','على','عَلى','رُبَّ',
        'رب', 'ب', 'بِ','فَوْقَ','فوق');
    //huruf qosam
    private static $_huruf_qosam = array('وَاللّهِ','تَاللّهِ','بِاللّهِ');
    //kalimah huruf
    private static $_kalimahHuruf    = array('عن', 	 'مذ', 'منذ', 'من', 	
                                                  'الى', 'على', 'حتى', 'الا', 
                                                  'غير', 'سوى', 'خلا', 'عدا', 
                                                  'حاشا', 'ليس');
    // huruf nida 
    private static $_huruf_nida = array('يا','يَا','اَيَا','ايا','هَيَا','هيا','اَيَ','اي');
    // huruf istisna 
   	private static $_huruf_istisna = array('اِلَّا','اِلاَّ','الا','الاّ','غَيْرَ','غَيْرِ','غَيْرُ',
    	'سَوَي','سوي','عَدَ','عد','اَوْحَشَا','اوحشا','خلا','خَلاً');
   	// asmaul khomsah
	private static $_asmaul_khomsah = array('اَبُوْكَ','اَبَاكَ','اباك','ابوك','اَخُوْكَ',
		'اَخَاكَ','اخاك','اخوك','حَمُوْكَ','حَمَاكَ','حماك','حموك','فُوْكَ','فَاكَ','فاك','فوك','ذُوْمَالٍ','ذومال');
	// asmaul_khomsah_jer
	private static $_asmaul_khomsah_jer = array('اَبِيْكَ','ابيك','اَخِيْكَ','اخيك','حَمِيْكَ','حميك','فِيْكَ','فيك');
	//huruf inna wa akhatuha
  	private static $_huruf_ina = array('اَنَّ','انّ','اِنَّ','لِكَنْ','لكنْ','كَاَنَّ','كانّ',
  		'كان','لعل','لَعَلَّ','كَانَتِ','كَانَت');
  	//isim isyaroh
	private static $_isim_isyarah = array('هَذَا', 'هذا',
     'هَذِهِ','هذه',
      'ذَلِكَ','ذلك',
       'تِلْكَ','تلْك');
	//isim istifham
	private static $_isim_istifham = array('هل','هَلْ',
			'مَن','مَنْ',
			'مَا','ما',
			'متى','مَتَى',
			'أَيْنَ','أين',
			'ماذا','مَاذَا',
			'كيف','كَيْفَ',
			'أيان','أَيانَ');
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
	//huruf isim mausul	 
    private static $_isim_maushul = array('الَّذِيْ','الّذي',
    	'الَّتِيْ','الّتي',
    	'الَّذِيْنَ','الّذيْن',
    	'اللاَّتِيْ','اللاّتي',
    	'اللاَّئِيْ','اللاّئيْ');
	//jamak taksir
   	private static $_jama_taksir = array('كفَّارٌ','اْلاوْلاَد','رُسُلٌ','عُلَمَاءُ',
   		'رِجَالٌ','نِسَاءٌ','الطُّللَّابُ','مَكَاتِبُ','كُتُبٌ','كَرَاسِيٌّ','أَسَاتِذُ','أَقْلاَمٌ');

    public static function isim($kata, $prevWord)
    {
    	//normalisasi hamzah

	    $word      = str_replace(self::$_normalizeAlef, 'ا', $kata);
	    $prevWord  = str_replace(self::$_normalizeAlef, 'ا', $prevWord);

    	//normalisasi harakat
	    $word = trim($kata);
	    $prevWord = trim($prevWord);

	    //hitung jumlah kata
        $wordlen = mb_strlen($word);

        //tanda-tanda kalimah isim
        //berharakat tanwin
         if ((self::tanwin_akhir($word)==true)){
		 	return true;
		 }
		 //terdapat huruf al didepan
		 if ((self::huruf_al($word)==true)){
		 	return true;
		 }
		 //kemasukan huruf jar
		 if (in_array($prevWord, self::$_huruf_jar) || 
                	(self::isim_jar($word)==true) ) {
            		
            return true;
             	}
         //terdapat huruf qosam
         if (in_array($word, self::$_huruf_qosam)) {
            return true;
             	}    	
         //sebelumnya berupa huruf   	
         if (in_array($prevWord, self::$_kalimahHuruf)) {
            return true;
             	}   	
         //terdapat huruf nida
         if (in_array($prevWord, self::$_huruf_nida)) {		 
            return true;
             }
         // bisa kemasukan hruf istisna
         if (in_array($prevWord, self::$_huruf_istisna) ||
             		(self::isim_istisna($word)==true) ) {
            return true;
             	}
         //berupa asmaul khomsah    	
         if (in_array($word, self::$_asmaul_khomsah)) {
            return true;
             	}
         //berupa asmaul khomasah mabni jar
         if (in_array($word, self::$_asmaul_khomsah_jer)) {
            return true;
             	}  	
         // isim mufrod, dengan al
         if ( (self::huruf_al($word)==true) 
                	  	&& (self::tanwin_akhir($word)==true)){
		   	return true;
		 		 }     	
		  // isim mufrod, tanpa al
         if ( (self::huruf_al($word)==false) && (self::tanwin_akhir($word))==true && (self::j_muannats_salim($word)==false) && (self::jama_taksir($word)==false) 
		   	&&(self::kategori_huruf($word)==false)||(self::mustasna($word)==true))
                	  {
		   return true;
		    } 		 
		  // tasniyah tanpa al 
		  if ( (self::huruf_al($word)==false) && (self::isim_tasniyah($word))==true && (self::harakat_kasroh($word))==true &&(self::huruf_mudloroah($word))==false )
                	  {
		   return true;
		    }  
		  // tasniyah tanpa al  irob
		  if ( (self::huruf_al($word)==false) && (self::isim_tasniyah_irob($word))==true)
                	  {
		 	 return true;
		    } 
		  //tasniyah dengan al 
		  if ((self::huruf_al($word)==true) && (self::isim_tasniyah($word))==true && (self::harakat_kasroh($word))==true ) 
                	  {
		  	return true;
		    }
		   //tasniyah dengan al irob
		  if ((self::huruf_al($word)==true) && (self::isim_tasniyah_irob($word))==true && (self::harakat_kasroh($word))==true ) 
                	  {
		   	return true;
		    }
		    //jama' muannat salim tanpa al
		    if ((self::huruf_al($word)==false) &&(self::j_muannats_salim($word)==true)) 
                	  {
			return true;
		    }
		    //jama' muannat salim tanpa al (irob)
		    if ((self::huruf_al($word)==false) &&(self::j_muannats_salim_irob($word)==true)) 
                	  {
		  	return true;
		    }
		    //jama' muannat salim dengan al
		    if ((self::huruf_al($word)==true) &&(self::j_muannats_salim($word)==true)) 
                	  {
		   	return true;
		    }
		    //jama' muannat salim dengan al
		    if ((self::huruf_al($word)==true) &&(self::j_muannats_salim_irob($word)==true)) 
                	  {
		   	return true;
		    }
		    //jama' mudzakar salim tanpa al
		    if ((self::huruf_al($word)==false) &&(self::j_mudzakar_salim($word)==true) &&(self::huruf_mudloroah($word)==false)) 
                	  {
		   	return true;
		    }
		    //jama' mudzakar salim tanpa al (irob)
		    if ((self::huruf_al($word)==false) &&(self::j_mudzakar_salim_irob($word)==true) &&(self::huruf_mudloroah($word)==false) ) 
                	  {
			 return true;
		    }
		    //jama' mudzakar tanpa al (irob)
		    if ((self::huruf_al($word)==true) &&(self::j_mudzakar_salim_irob($word)==true)) 
                	  {
			return true;		    
		    }
		    //jama' mudzakar salim dengan al
		    if ((self::huruf_al($word)==true) &&(self::j_mudzakar_salim($word)==true)  ) 
                	  {
		  	return true;
		 	}
		    //jama' taksir
		    if (self::jama_taksir($word)==true) 
                	  {
		 	return true;
		    }
		    // isim dlomir
		  	if (self::isim_dlomir($word)==true) 
                	  {
		   	return true;
		    }
		    // isim istifham
		  	if (self::isim_istifham($word)==true) 
                	  {
		   	return true;
		    }
		    // bisa kemasukan huruf inna
            if (in_array($prevWord, self::$_huruf_ina) ||
             	 (self::isim_ina($word)==true)  ) {
            return true;
            }
            //isim isyaroh
            if (self::isim_isyarah($word)==true ) 
                	  {
		   return true;
		    }


		 return false;
    }

    public static function tanwin_akhir($kata){
	if (mb_substr($kata, -1, 1) == 'ً' || mb_substr($kata, -1, 1) == 'ٌ' || mb_substr($kata, -1, 1) == 'ٍ' ) 
            {
                return true;
            }
	}
	public static function huruf_al($kata){
	//kalo ada huruf ma'ruf al, ciri isim  
        	if ((mb_substr($kata, 0, 1) == 'ا' && mb_substr($kata, 1, 1) == 'ل') || (mb_substr($kata, 0, 1) == 'ا' && mb_substr($kata, 1, 1) == 'َ' && mb_substr($kata, 2, 1) == 'ل' && mb_substr($kata, 3, 1) == 'ْ') ) {
            return true;
        	}
	}
	public static function isim_jar($kata){
		if (in_array($kata, self::$_huruf_jar)){
			return true;
		}
	}
	public static function isim_istisna($kata){
		if (in_array($kata, self::$_huruf_istisna)){
			return true;
		}	
	}
	public static function mustasna($kata){
		 if ( (mb_substr($kata, -1, 1)) == 'ا' && (mb_substr($kata,-2, 1) == 'ً' ) ){
		 	return true;
		 }
	}
	public static function jama_taksir($kata){
		if (in_array($kata, self::$_jama_taksir)){
			return true;
		}
	}
	public static function kategori_huruf($kata){
		if (in_array($kata, self::$_huruf_nida) || 
		in_array($kata, self::$_huruf_jar) || 
		in_array($kata, self::$_huruf_istisna) || 
		in_array($kata, self::$_huruf_ina)|| 
		in_array($kata, self::$_isim_istifham)){
			return true;
		}
	}
	public static function isim_tasniyah($kata)
	{
		  if ( (mb_substr($kata, -1, 1)) == 'ِ' && (mb_substr($kata, -2, 1)) == 'ن' && (mb_substr($kata,-3, 1) == 'ا' ) ) {
            return true;
        	}
    }
    public static function harakat_kasroh($kata){
		if (mb_substr($kata, -1, 1) == 'ِ' )
			return true;
	}
	public static function huruf_mudloroah($kata){
        	if(mb_substr($kata, 0, 1) == 'ا' || mb_substr($kata, 0, 1) == 'ن' || mb_substr($kata, 0, 1) == 'ي' || mb_substr($kata, 0, 1) == 'ت'  ){
	 		return true; 
			}
	}	
	public static function isim_tasniyah_irob($kata)
	{
		if ( (mb_substr($kata, -1, 1)) == 'ِ' && (mb_substr($kata, -2, 1)) == 'ن' && (mb_substr($kata,-3, 1)) == 'ْ' && (mb_substr($kata,-4, 1)) == 'ي' && (mb_substr($kata,-5, 1)) == 'َ'  ) 
		{
			return true;
		}
	}
	public static function j_muannats_salim($kata){
		if (mb_substr($kata, -3,1) == 'ا' && mb_substr($kata, -2,1)=='ت' && mb_substr($kata, -1,1)=='ُ')  {
			return true;
		}
	}
	public static function j_muannats_salim_irob($kata){
		if (mb_substr($kata, -3,1) == 'ا' && mb_substr($kata, -2,1)=='ت' &&  mb_substr($kata, -1,1)=='ِ')  {
			return true;
		}
	}
	public static function j_mudzakar_salim($kata){
		if (mb_substr($kata, -5,1) == 'ُ' && mb_substr($kata, -3,1) == 'ْ' && mb_substr($kata, -4,1) == 'و' && mb_substr($kata, -2,1)=='ن' && mb_substr($kata, -1,1)=='َ' )  {
			return true;
		}

	}
	public static function j_mudzakar_salim_irob($kata){
		if (mb_substr($kata, -5,1) == 'ِ' && mb_substr($kata, -3,1) == 'ْ' && mb_substr($kata, -4,1) == 'ي' && mb_substr($kata, -2,1)=='ن' && mb_substr($kata, -1,1)=='َ' && self::isim_maushul($kata)==false )  {
			return true;
		}
	}
	public static function isim_dlomir($kata){
		if (in_array($kata, self::$_isim_dlomir)){
			return true;
		}
	}
	public static function isim_istifham($kata){
		if (in_array($kata, self::$_isim_istifham)){
			return true;
		}
	}
	public static function isim_ina($kata){
		if (in_array($kata, self::$_huruf_ina)){
			return true;
		}	
	}
	public static function isim_isyarah($kata){
		if (in_array($kata, self::$_isim_isyarah)){
			return true;
		}
	}
	public static function isim_nida($kata){
		if (in_array($kata, self::$_huruf_nida)){
			return true;
		}	
	}
	public static function isim_maushul($kata){
		if (in_array($kata, self::$_isim_maushul)){
			return true;
		}
		else{return false;}
	}

}
?>