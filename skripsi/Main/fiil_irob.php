<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class node_fiil_irob
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
  private static $_asmaul_khomsah_nashob = array('اَبَاكَ','اباك','اَخَاكَ','اخاك',
    'حَمَاكَ','حماك','فَاكَ','فاك');
  // asmaul khomsah jer
  private static $_asmaul_khomsah_jer = array('اَبِيْكَ','ابيك','اَخِيْكَ','اخيك',
    'حَمِيْكَ','حميك','فِيْكَ','فيك');
  //huruf nashob
  private static $_huruf_nashob = array('لَنْ','لن','ان','اَنْ','كَيْ','كي','لِكَيْ',
                'لكيْ','كَيْ','كيْ','اَذَنْ','اذن','اذنْ');
  // huruf jazem
  private static $_huruf_jazem = array('لَمْ','لم','لما','لَمَا','ل',
                'لَ','الما','الَمَا','اَلَمْ','المْ','الم');
  // huruf jer
  private static $_huruf_jar = array('مِنْ','مِنَ','اِلَى','الى','الَى','الىَ',
        'في','فِيْ','فِي','عَنْ','عَنِ','عن','مِنَ','مِن','عَلَى','على','عَلى','رُبَّ',
        'رب', 'ب', 'بِ','فَوْقَ','فوق');
  //huruf inna wa akhatuha
  private static $_huruf_ina = array('اَنَّ','انّ','اِنَّ','لِكَنْ','لكنْ','كَاَنَّ',
    'كانّ','كان','لعل','لَعَلَّ','كَانَتِ','كَانَت');
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
  //isim maushul 
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
  private static $_jama_taksir = array('كفَّارٌ','اْلاوْلاَد','رُسُلٌ','عُلَمَاءُ','رِجَالٌ','نِسَاءٌ','الطُّللَّابُ');
    
  private static $_normalizeAlef       = array('ﺁ','ﺇ','ﺃ');
  private static $_normalizeDiacritics = array('َ','ً','ُ','ٌ','ِ','ٍ','ْ','ّ');


    function fiil_irob($awal,$kata){
    echo '"irob_fiil": {';
    //normalisasi hamzah 
    $kata      = str_replace(self::$_normalizeAlef, 'ا', $kata);
       
    $kata = trim($kata);

    //pecah array berdasarkan spasi
    $words    = explode(' ', $kata);
    $prevWord = null;
    $results  = array();    
    foreach ($words as $word) {
        if ($word == '') {
        continue;
                    }
    //pembagian irob fiil
    if(self::rofa($prevWord,$word)==true){
        echo json_encode($word); echo ":{";
        echo '"node"';echo ":";echo '"12",';
        echo '"irob"';echo ":";echo '"rofa"';
        echo "},";
        }
    if(self::nashob($prevWord,$word)==true){
        echo json_encode($word); echo ":{";
        echo '"node"';echo ":";echo '"12",';
        echo '"irob"';echo ":";echo '"nashob"';
        echo "},";
        }
    if(self::jazem($prevWord,$word)==true){
        echo json_encode($word); echo ":{";
        echo '"node"';echo ":";echo '"12",';
        echo '"irob"';echo ":";echo '"jazem"';
        echo "},";
        }
        
        $prevWord = $word;                   
      }             
        echo '"debug":{"data":"ok"}';
        $akhir = microtime(true);
        $lama  = $akhir - $awal;
        echo "},";
        echo '"durasi_node_12":';
        echo '"'.$lama.'",';
    }//end fiil irob

   //fungsi fiil irob rafa
  function rofa($prevWord,$word){

    if ((self::cek_isimnya($word, $prevWord))==true )
                  {
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
                return true;                
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
                return true;                    
             }                
       }//end cek
  }

// fungsi fiil irob nashob
  function nashob($prevWord,$word){
          
    if ((self::cek_isimnya($word, $prevWord))==true )
                  { 
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
                return true;                  
             }
        //berupa huruf afalul khomsah
        if ((self::nashob_hadz_nun($word)==true) &&
        (self::masuk_amil_nashob($prevWord)==true)) 
             {  
                return true;                    
             }                  
    }//end cek
  }
  //fungsi fiil irob jazem
  function jazem($prevWord,$word){
  
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
                return true;
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
                return true;
             }
        // tanda irob jazem pada afalul khomsah, hadz
        if ((self::jazem_hadz_nun($word)==true) &&             
            (self::depan_afalul_khomsah($word)==true)&&
            (self::masuk_amil_jazem($prevWord)==true))                                                            
             {
                return true;
             }    
      }//end cek
   }


 //pemanggilan fungsi

      function akhir_nashob_fathah($kata){
                if (mb_substr($kata, -1, 1) == 'َ' || 
                    mb_substr($kata, -1, 1) == 'ى' ) 
                {
                return true;
                }
            }
      function masuk_amil_nashob($prevWord){
                if (in_array($prevWord, self::$_huruf_nashob)) {
                    //echo $word." isim";
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
                (self::isim_tasniyah($kata))==  true )  
                  {
                    return true;
                  }
              }
      function depan_afalul_khomsah($kata){
              if(  (mb_substr($kata, 0, 1) == 'ي' || 
                    mb_substr($kata, 0, 1) == 'ت'  )){
                return true;
              }
            }
      function tengah_ya_afalul_khomsah($kata){
              if (mb_substr($kata, -2,1)=='ي'  || mb_substr($kata, -2,1)=='ى'){
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
      function isim_tasniyah($kata){
      
            if ( (mb_substr($kata, -1, 1)) == 'ِ' && 
                 (mb_substr($kata, -2, 1)) == 'ن' && 
                 (mb_substr($kata,-3, 1) == 'ا' ) ) 
                {
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
              in_array($kata, self::$_asmaul_khomsah_jer)){
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
              if (mb_substr($kata, 0, 1) == 'س'  && 
                  self::awal_saufa($kata)!= true)
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
      function sukun_amr_depan($kata){
              if (mb_substr($kata, 3, 1) == 'ْ' ) 
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
          (self::isim_tasniyah($kata))==  true )  
          {
            return true;
          }
        }


}//akhir fungsi



?>