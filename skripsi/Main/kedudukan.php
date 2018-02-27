<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class node_kedudukan
{
    private static $_normalizeAlef       = array('ﺁ','ﺇ','ﺃ');
    private static $_normalizeDiacritics = array('َ','ً','ُ','ٌ','ِ','ٍ','ْ','ّ');

    //huruf inna wa akhatuha
    private static $_huruf_inna = array('اَنَّ','انّ','اِنَّ','لِكَنْ','لكنْ',
        'كَاَنَّ','كانّ','لعل','لَعَلَّ', 'إِنَّ','لَيْتَ');
    //huruf kana wa akhatuha
    private static $_huruf_kana = array('كَانَ','كان','كَانَتِ','كَانَت','اَضْحَى','ظَلَّ','اَمْسَى','اَصْبَحَ','بَاتَ','صَارَ','صَارَتْ','لَيْسَ','مَااَنْفَكَّ','مَازَالَ','مَابَرِحَ','ظَلَّتِ');
    //huruf istisna
    private static $_huruf_istisna = array('اِلَّا','اِلاَّ','الا','الاّ','غَيْرَ','غَيْرِ','غَيْرُ',
        'سَوَي','سوي','عَدَ','عد','اَوْحَشَا','اوحشا','خلا','خَلاً');
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
    //isim laa
    private static $_isim_la = array ('لا','لاَ');
    // huruf nida 
    private static $_huruf_nida = array('يا','يَا','اَيَا','ايا','هَيَا','هيا','اَيَ','اي');
    //huruf nashob
    private static $_huruf_nashob = array('لَنْ','لن','ان','اَنْ','كَيْ','كي','لِكَيْ',
                'لكيْ','كَيْ','كيْ','اَذَنْ','اذن','اذنْ','اِذَنْ');
    // huruf jer
    private static $_huruf_jar = array('مِنْ','مِنَ','اِلَى','الى','الَى','الىَ',
        'في','فِيْ','فِي','فِى','فِىْ','عَنْ','عَنِ','عن','مِنَ','مِن','عَلَى','على','عَلى','رُبَّ',
        'رب', 'ب', 'بِ','فَوْقَ','فوق','كَا');
    // huruf jazem
    private static $_huruf_jazem = array('لَمْ','لم','لما','لَمَا','ل',
                'لَ','الما','الَمَا','اَلَمْ','المْ','الم','اِنْ');
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
    //huruf isim isyaroh
    private static $_isim_isyarah = array('هَذَا', 'هذا',
     'هَذِهِ','هذه',
      'ذَلِكَ','ذلك',
       'تِلْكَ','تلْك');

 
    function cek_isimnya($kata, $prevWord) {
        $Isim = new node_isim();
        if (($Isim->isim($kata, $prevWord))==true){
            return false;
        } else {
            return true;
        }
    }

    public function mubtadakhobar_nashob($awal, $kata)
    {
        echo '"level": { "debug": "on",';

        $kata = str_replace(self::$_normalizeAlef, 'ا', $kata);

        $kata = trim($kata);
        
        //pecah array berdasarkan spasi
        $words      = explode(' ', $kata);

        $prevIsMubtada = false;
        $prevIsKhabar  = false;
        $firstIsInna   = false;
        $firstIsKana   = false;

        for($i=0; $i<count($words); $i++){
            
            if(array_key_exists(($i-1), $words)){
                $prevWord = $words[$i-1];
            } else {
                $prevWord = '';
            }

            $nowWord  = $words[$i];

            if(array_key_exists(($i+1), $words)){
                $nextWord = $words[$i+1];
            } else {
                $nextWord = '';
            }
            
            $kedudukan = '';
            // if(!self::cek_isim($kata, $prevWord)){
                    
                    if(empty($prevWord)){                        

                        if(in_array($nowWord, self::$_huruf_inna)){
            
                            $kedudukan = 'huruf inna';
                            $prevIsMubtada = false;
                            $firstIsInna = true;
        
                        } 
                    }
                     
                    elseif(in_array($prevWord, self::$_huruf_inna)){
            
                    $kedudukan = 'mubtada huruf inna';
                    $prevIsMubtada = true;
                     
                     }
                    elseif($prevIsMubtada == false && $prevIsKhabar == false){

                        if(in_array($nowWord, self::$_isim_dlomir)) {
                            $kedudukan = 'mubtada khobar';
                        } else {
                            $kedudukan = 'mubtada khobar';
                        }

                        $prevIsMubtada = true;

                    } else {

                        if($firstIsInna == true){
                        
                            $kedudukan = 'khabar huruf inna';
                            $prevIsKhabar = true;                            
                        
                        }  elseif(in_array($nowWord, self::$_isim_dlomir)) {

                            $kedudukan = 'khabar ghoiru mufrod';
                            $prevIsKhabar = true;

                        } else {

                            $kedudukan = 'khabar mufrod';
                            $prevIsKhabar = true;
                            
                        }

                        $prevIsMubtada = false;                    
                    }

                // }

                if(!empty($kedudukan)){
                    echo json_encode($nowWord); 
                    echo ":{";
                    echo '"node" : "25",';
                    echo '"kedudukan" : "'. $kedudukan .'",';   
                    echo '"status" : "true"';
                    echo "},";    
                }

        }

        $akhir = microtime(true);
        $lama = $akhir - $awal;  
        echo '"durasi_node_25":';
        echo '"'.$lama.'",';
      

    } // end fungsi mubtadakhobar nashob

    public function fiilfail($awal, $kata){

       
        $kata   = str_replace(self::$_normalizeAlef, 'ا', $kata);
        $kata   = trim($kata);

        $firstIsFiil = false;
        $nowIsFail = false;
        //pecah array berdasarkan spasi
        $words      =explode(' ', $kata);
        $prevWord   =null;
        $result     =array();

        foreach ($words as $word) {
            if ($word == ''){
                continue;
            }

        //fungsi pemanggilan kefile isim
        if((self::cek_isimnya($word, $prevWord))==true){
            $kedudukan = 'fiil';
            $firstIsFiil = true;
            $nowIsFail = false;
                    echo json_encode($word); 
                    echo ":{";
                    echo '"node" : "26",';
                    echo '"kedudukan" : "'. $kedudukan .'",';   
                    echo '"status" : "true"';
                    echo "},";   
            } 
            elseif($firstIsFiil == true){
                $kedudukan = 'fail';
                $nowIsFail = true;
                echo json_encode($word); 
                    echo ":{";
                    echo '"node" : "26",';
                    echo '"kedudukan" : "'. $kedudukan .'",';   
                    echo '"status" : "true"';
                    echo "},";   
            }
           
        $prevWord = $word;  
        
        }
                
        $akhir = microtime(true);
        $lama = $akhir - $awal;
        
        echo '"durasi_node_26":';
        echo '"'.$lama.'",';
     


    }//end fungsi fiil fail
    public function mubtadakhobar_tok($awal, $kata){
    
        $kata   = str_replace(self::$_normalizeAlef, 'ا', $kata);
        $kata   = trim($kata);

        $firstIsMubtadaa = false;
        $nowIsKhobarr = false;
        //pecah array berdasarkan spasi
        $words      =explode(' ', $kata);
        $prevWord   =null;
        $result     =array();

        foreach ($words as $word) {
            if ($word == ''){
                continue;
            }

        //fungsi pemanggilan kefile isim
        // if((self::cek_isimnya($word, $prevWord))==false){
        //     $kedudukan = 'mubtada khobar';
        //     $firstIsMubtadaa = true;
        //     $nowIsKhobarr = false;
        //             echo json_encode($word); 
        //             echo ":{";
        //             echo '"node" : "27",';
        //             echo '"kedudukan" : "'. $kedudukan .'",';   
        //             echo '"status" : "true"';
        //             echo "},";   
        //     } 
        //     elseif($firstIsMubtadaa == true){
        //         $kedudukan = 'khobar';
        //         $nowIsKhobarr = true;
        //         echo json_encode($word); 
        //             echo ":{";
        //             echo '"node" : "27",';
        //             echo '"kedudukan" : "'. $kedudukan .'",';   
        //             echo '"status" : "true"';
        //             echo "},";   
        //     }
           
        $prevWord = $word;  
        
        }
                
        $akhir = microtime(true);
        $lama = $akhir - $awal;
        
        echo '"durasi_node_27":';
        echo '"'.$lama.'",';
     


    }//end fungsi fiil fail

        public function istisna($awal, $kata){

        $kata = str_replace(self::$_normalizeAlef, 'ا', $kata);

        $kata = trim($kata);
        
        //pecah array berdasarkan spasi
        $words      = explode(' ', $kata);

        for($i=0; $i<count($words); $i++){
            
            if(array_key_exists(($i-1), $words)){
                $prevWord = $words[$i-1];
            } else {
                $prevWord = '';
            }

            $nowWord  = $words[$i];

            if(array_key_exists(($i+1), $words)){
                $nextWord = $words[$i+1];
            } else {
                $nextWord = '';
            }
            
            $kedudukan = '';
            // if(!self::cek_isim($kata, $prevWord)){  
                    
                     if(empty($prevWord)){                        

                        if(in_array($nowWord, self::$_huruf_istisna)){
            
                            $kedudukan = 'huruf istisna';
                            $prevIsIstisna = false;
                        } 

                     }
                     elseif(in_array($prevWord, self::$_huruf_istisna)){
            
                    $kedudukan = 'mustasna';
                    $prevIsIstisna = true;

                     } 

                // }

                if(!empty($kedudukan)){
                    echo json_encode($nowWord); 
                    echo ":{";
                    echo '"node" : "28",';
                    echo '"kedudukan" : "'. $kedudukan .'",';   
                    echo '"status" : "true"';
                    echo "},";    
                }

        }

        $akhir = microtime(true);
        $lama = $akhir - $awal;
        
        echo '"durasi_node_28":';
        echo '"'.$lama.'",';

    }//end fungsi istisna

    public function isim_la($awal, $kata){

        $kata = str_replace(self::$_normalizeAlef, 'ا', $kata);

        $kata = trim($kata);
        $prevIsLaa = false;
        $firstIsLaa = false;
        
        
        //pecah array berdasarkan spasi
        $words      = explode(' ', $kata);

        for($i=0; $i<count($words); $i++){
            
            if(array_key_exists(($i-1), $words)){
                $prevWord = $words[$i-1];
            } else {
                $prevWord = '';
            }

            $nowWord  = $words[$i];

            if(array_key_exists(($i+1), $words)){
                $nextWord = $words[$i+1];
            } else {
                $nextWord = '';
            }
            
            $kedudukan = '';
            // if(!self::cek_isim($kata, $prevWord)){  
                    
                  if(empty($prevWord)){                        

                        if(in_array($nowWord, self::$_isim_la)){
            
                            $kedudukan = 'la-linafyil jinsi';
                            $prevIsLaa = false;
                            $firstIsLaa = true;
                        } 

                     }
                     elseif(in_array($prevWord, self::$_isim_la)){
            
                    $kedudukan = 'isim laa';
                    $prevIsLaa = true;

                     } 
                     elseif($firstIsLaa == true){
                        $kedudukan = 'isim laa';
                        $prevIsLaa = true;
                     }
                if(!empty($kedudukan)){
                    echo json_encode($nowWord); 
                    echo ":{";
                    echo '"node" : "29",';
                    echo '"kedudukan" : "'. $kedudukan .'",';   
                    echo '"status" : "true"';
                    echo "},";    
                }

        }

        $akhir = microtime(true);
        $lama = $akhir - $awal;
        
        echo '"durasi_node_29":';
        echo '"'.$lama.'",';

    }//end fungsi isim laa

    public function munada($awal, $kata){

        $kata = str_replace(self::$_normalizeAlef, 'ا', $kata);

        $kata = trim($kata);

        $prevIsMunada = false;
        $firstIsNida = false;
        
        //pecah array berdasarkan spasi
        $words      = explode(' ', $kata);

        for($i=0; $i<count($words); $i++){
            
            if(array_key_exists(($i-1), $words)){
                $prevWord = $words[$i-1];
            } else {
                $prevWord = '';
            }

            $nowWord  = $words[$i];

            if(array_key_exists(($i+1), $words)){
                $nextWord = $words[$i+1];
            } else {
                $nextWord = '';
            }
            
            $kedudukan = '';
            // if(!self::cek_isim($kata, $prevWord)){  
                    
                  if(empty($prevWord)){                        

                        if(in_array($nowWord, self::$_huruf_nida)){
            
                            $kedudukan = 'huruf nida';
                            $prevIsMunada = false;
                            $firstIsNida = true;
                        } 

                     }
                     elseif(in_array($prevWord, self::$_huruf_nida)){
            
                    $kedudukan = 'munada';
                    $prevIsMunada = true;

                     } 
                      

                if(!empty($kedudukan)){
                    echo json_encode($nowWord); 
                    echo ":{";
                    echo '"node" : "30",';
                    echo '"kedudukan" : "'. $kedudukan .'",';   
                    echo '"status" : "true"';
                    echo "},";    
                }

        }

        $akhir = microtime(true);
        $lama = $akhir - $awal;
        
        echo '"durasi_node_30":';
        echo '"'.$lama.'",';

    }//end fungsi munada

    public function mubtadakhobar_rofa($awal, $kata)
    {
     

        $kata = str_replace(self::$_normalizeAlef, 'ا', $kata);

        $kata = trim($kata);
        
        //pecah array berdasarkan spasi
        $words      = explode(' ', $kata);

        $prevIsMubtada = false;
        $prevIsKhabar  = false;
        $firstIsInna   = false;
        $firstIsKana   = false;

        for($i=0; $i<count($words); $i++){
            
            if(array_key_exists(($i-1), $words)){
                $prevWord = $words[$i-1];
            } else {
                $prevWord = '';
            }

            $nowWord  = $words[$i];

            if(array_key_exists(($i+1), $words)){
                $nextWord = $words[$i+1];
            } else {
                $nextWord = '';
            }
            
            $kedudukan = '';
            // if(!self::cek_isim($kata, $prevWord)){
                    
                    if(empty($prevWord)){                        

                       if(in_array($nowWord, self::$_huruf_kana)){

                            $kedudukan = 'huruf kana';
                            $prevIsMubtada = false;
                            $firstIsKana = true;

                        }

                     }
                     elseif(in_array($prevWord, self::$_huruf_kana)){
    
                    $kedudukan = 'mubtada huruf kana';
                    $prevIsMubtada = true;

                    }
                    else {

                      if($firstIsKana == true){

                            $kedudukan = 'khabar huruf kana';
                            $prevIsKhabar = true;                            

                        } 

                        $prevIsMubtada = false;                    
                    }

                // }

                if(!empty($kedudukan)){
                    echo json_encode($nowWord); 
                    echo ":{";
                    echo '"node" : "31",';
                    echo '"kedudukan" : "'. $kedudukan .'",';   
                    echo '"status" : "true"';
                    echo "},";    
                }

        }

        $akhir = microtime(true);
        $lama = $akhir - $awal;  
        echo '"durasi_node_31":';
        echo '"'.$lama.'",';
             
      

    } // end fungsi mubtadakhobar

     public function bil_harfi($awal, $kata){

        $kata = str_replace(self::$_normalizeAlef, 'ا', $kata);

        $kata = trim($kata);
        
        //pecah array berdasarkan spasi
        $words      = explode(' ', $kata);

        for($i=0; $i<count($words); $i++){
            
            if(array_key_exists(($i-1), $words)){
                $prevWord = $words[$i-1];
            } else {
                $prevWord = '';
            }

            $nowWord  = $words[$i];

            if(array_key_exists(($i+1), $words)){
                $nextWord = $words[$i+1];
            } else {
                $nextWord = '';
            }
            
            $kedudukan = '';
            // if(!self::cek_isim($kata, $prevWord)){  
                    
                  if(empty($prevWord)){                        

                        if(in_array($nowWord, self::$_huruf_jar)){
            
                            $kedudukan = 'bil harfi jar';
                            $prevIsJar = false;
                        } 
                        elseif(in_array($nowWord, self::$_huruf_jazem)){

                            $kedudukan = 'bil harfi jazem';
                            $prevIsJazem = false;
                        }
                        elseif(in_array($nowWord, self::$_huruf_nashob)){

                            $kedudukan = 'bil harfi nashob';
                            $prevIsNashob = false;
                        }
                        elseif(in_array($nowWord, self::$_huruf_istifham)){

                            $kedudukan = 'bil harfi istifham';
                            $prevIsIstifham = false;
                        }
                        elseif(in_array($nowWord, self::$_huruf_athof)){

                            $kedudukan = 'bil harfi athof';
                            $prevIsAthof = false;
                            $firstIsAthof = true;
                        }
                     }

                     elseif(in_array($prevWord, self::$_huruf_jar)){
            
                    $kedudukan = 'jer majrur';
                    $prevIsJar = true;

                     }
                     elseif(in_array($prevWord, self::$_huruf_jazem)){
            
                    $kedudukan = 'majzum';
                    $prevIsJazem = true;

                     } 
                     elseif(in_array($prevWord, self::$_huruf_nashob)){
            
                    $kedudukan = 'manshub';
                    $prevIsJazem = true;

                     } 
                     elseif(in_array($prevWord, self::$_huruf_istifham)){
            
                    $kedudukan = 'mustafham';
                    $prevIsIstifham = true;

                     } 
                     elseif(in_array($prevWord, self::$_huruf_athof)){
            
                    $kedudukan = 'maathuf';
                    $prevIsAthof = true;

                     }


                if(!empty($kedudukan)){
                    echo json_encode($nowWord); 
                    echo ":{";
                    echo '"node" : "32",';
                    echo '"kedudukan" : "'. $kedudukan .'",';   
                    echo '"status" : "true"';
                    echo "},";    
                }

        }

        $akhir = microtime(true);
        $lama = $akhir - $awal;
        
        echo '"durasi_node_32":';
        echo '"'.$lama.'",';
        echo '"return":{"data":"ok"}';
           echo '}}';
          //echo '}';
           


    }//end fungsi bil harfi

    
}// end class

?>