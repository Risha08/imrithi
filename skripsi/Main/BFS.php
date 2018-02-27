<?php

header('Content-Type:application/json');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../Arabic.php';
//pemanggilan class
$kalimah	= new node('kalimah');
$huruf		= new node('huruf');
$isim 		= new node('isim_fungsi');
$fiil		= new node('fiil_fungsi');
$isim_irob	= new node('isim_irob');
$fiil_irob	= new node('fiil_irob');
$kedudukan 	= new node('kedudukan');
$tanda_irob	= new node('tanda_irob');


$incidenceList	= array(
	1 => array(
		 'vertex'	  => 1,
		 'visited'	  => false,
		 'letter'	  => 1,
		 'class'	  => $kalimah,
		 'fungsi'	  => "kalimah",
		 'neighbours' => array(2,3,4)	
		),
	2 => array(
		 'vertex'	  => 2,
		 'visited'	  => false,
		 'letter'	  => 2,
		 'class'	  => $isim,
		 'fungsi'	  => 'bentuk_isim',
		 'neighbours' => array(1,5,6,7,8)
		),
	3 => array(
		'vertex'	  => 3,
		'visited'	  => false,
		'letter'	  => 3,
		'class'		  => $fiil,
		'fungsi'	  => 'bentuk_fiil',
		'neighbours'  => array(1,9,10,11,12)
		),
	4 => array(
		 'vertex'	  => 4,
		 'visited'	  => false,
		 'letter'	  => 4,
		 'class'	  => $huruf,
		 'fungsi'	  => "huruf",
		 'neighbours' => array(1,13,14,15,16,17,18,19,20)	
		),
	5 => array(
		 'vertex'	  => 5,
		 'visited'	  => false,
		 'letter'	  => 5,
		 'class'	  => $isim,
		 'fungsi'	  => "isim_mufrod",
		 'neighbours' => array(2)
		),
	6 => array(
		'vertex'	  => 6,
		'visited'	  => false,
		'letter'	  => 6,
		'class'		  => $isim,
		'fungsi'	  => "isim_tasniyah",
		'neighbours'  => array(2)
		),
	7 => array(
		'vertex'	  => 7,
		'visited'	  => false,
		'letter'	  => 7,
		'class'		  => $isim,
		'fungsi'	  => "isim_jama",
		'neighbours'  => array (2)
		),
	8 => array(
		'vertex'	  => 8,
		'visited'	  => false,
		'letter'	  => 8,
		'class'		  => $isim_irob,
		'fungsi'	  => "isim_irob",
		'neighbours'  => array (2,21,22,23,24)
		),
	9 => array(
		'vertex'	  => 9,
		'visited'	  => false,
		'letter'	  => 9,
		'class'		  => $fiil,
		'fungsi'	  => "fiil_madli",
		'neighbours'  => array (3)
		),
	10 => array(
		'vertex'	  => 10,
		'visited'	  => false,
		'letter'	  => 10,
		'class'		  => $fiil,
		'fungsi'	  => "fiil_mudhori",
		'neighbours'  => array (3)
		),
	11 => array(
		'vertex'	  => 11,
		'visited'	  => false,
		'letter'	  => 11,
		'class'		  => $fiil,
		'fungsi'	  => "fiil_amar",
		'neighbours'  => array (3)
		),
	12 => array(
		'vertex'	  => 12,
		'visited'	  => false,
		'letter'	  => 12,
		'class'		  => $fiil_irob,
		'fungsi'	  => "fiil_irob",
		'neighbours'  => array (3,21,22,23,24)
		),
	13 => array(
		'vertex'	  => 13,
		'visited'	  => false,
		'letter'	  => 13,
		'class'		  => $huruf,
		'fungsi'	  => "huruf_jar",
		'neighbours'  => array (4)
		),
	14 => array(
		'vertex'	  => 14,
		'visited'	  => false,
		'letter'	  => 14,
		'class'		  => $huruf,
		'fungsi'	  => "huruf_inna",
		'neighbours'  => array (4)
		),
	15 => array(
		'vertex'	  => 15,
		'visited'	  => false,
		'letter'	  => 15,
		'class'		  => $huruf,
		'fungsi'	  => "huruf_athof",
		'neighbours'  => array (4)
		),
	16 => array(
		'vertex'	  => 16,
		'visited'	  => false,
		'letter'	  => 16,
		'class'		  => $huruf,
		'fungsi'	  => "huruf_nashob",
		'neighbours'  => array (4)
		),
	17 => array(
		'vertex'	  => 17,
		'visited'	  => false,
		'letter'	  => 17,
		'class'		  => $huruf,
		'fungsi'	  => "huruf_jazem",
		'neighbours'  => array (4)
		),
	18 => array(
		'vertex'	  => 18,
		'visited'	  => false,
		'letter'	  => 18,
		'class'		  => $huruf,
		'fungsi'	  => "huruf_istifham",
		'neighbours'  => array (4)
		),
	19 => array(
		'vertex'	  => 19,
		'visited'	  => false,
		'letter'	  => 19,
		'class'		  => $huruf,
		'fungsi'	  => "huruf_kana",
		'neighbours'  => array (4)
		),
	20 => array(
		'vertex'	  => 20,
		'visited'	  => false,
		'letter'	  => 20,
		'class'		  => $huruf,
		'fungsi'	  => "huruf_nida",
		'neighbours'  => array (4)
		),
	21 => array(
		'vertex'	  => 21,
		'visited'	  => false,
		'letter'	  => 21,
		'class'		  => $tanda_irob,
		'fungsi'	  => "rofa",
		'neighbours'  => array (8,25,26,27)
		),
	22 => array(
		'vertex'	  => 22,
		'visited'	  => false,
		'letter'	  => 22,
		'class'		  => $tanda_irob,
		'fungsi'	  => "nashob",
		'neighbours'  => array (8,28,29,30,31)
		),
	23 => array(
		'vertex'	  => 23,
		'visited'	  => false,
		'letter'	  => 23,
		'class'		  => $tanda_irob,
		'fungsi'	  => "jar",
		'neighbours'  => array (8,32)
		),
	24 => array(
		'vertex'	  => 24,
		'visited'	  => false,
		'letter'	  => 24,
		'class'		  => $tanda_irob,
		'fungsi'	  => "jazem",
		'neighbours'  => array (8)
		),
	25 => array(
		'vertex'	  => 25,
		'visited'	  => false,
		'letter'	  => 25,
		'class'		  => $kedudukan,
		'fungsi'	  => "mubtadakhobar_nashob",
		'neighbours'  => array (21)
		),
	26 => array(
		'vertex'	  => 26,
		'visited'	  => false,
		'letter'	  => 26,
		'class'		  => $kedudukan,
		'fungsi'	  => "fiilfail",
		'neighbours'  => array (21)
		),
	27 => array(
		'vertex'	  => 27,
		'visited'	  => false,
		'letter'	  => 27,
		'class'		  => $kedudukan,
		'fungsi'	  => "mubtadakhobar_tok",
		'neighbours'  => array (21)
		),
	28 => array(
		'vertex'	  => 28,
		'visited'	  => false,
		'letter'	  => 28,
		'class'		  => $kedudukan,
		'fungsi'	  => "istisna",
		'neighbours'  => array (22)
		),
	29 => array(
		'vertex'	  => 29,
		'visited'	  => false,
		'letter'	  => 29,
		'class'		  => $kedudukan,
		'fungsi'	  => "isim_la",
		'neighbours'  => array (22)
		),
	30 => array(
		'vertex'	  => 30,
		'visited'	  => false,
		'letter'	  => 30,
		'class'		  => $kedudukan,
		'fungsi'	  => "munada",
		'neighbours'  => array (22)
		),	
	31 => array(
		'vertex'	  => 31,
		'visited'	  => false,
		'letter'	  => 31,
		'class'		  => $kedudukan,
		'fungsi'	  => "mubtadakhobar_rofa",
		'neighbours'  => array (22)
		),
	32 => array(
		'vertex'	  => 32,
		'visited'	  => false,
		'letter'	  => 32,
		'class'		  => $kedudukan,
		'fungsi'	  => "bil_harfi",
		'neighbours'  => array (23)
		),
	


	);

$awal 	= microtime(true);

//perhitungan durasi setiap node
$bil 	= 2;
$hasil	= 1;
for ($i=1; $i<=100000; $i++)
{
	$hasil	.= $bil;
}
$kata	= $_GET['kata'];

//algoritma BFS

echo "{";
	$queue	= array();
	//tambah elemen diawal
	array_unshift($queue, $incidenceList[1]); //array dari depan tambahnya
	//awal antrian dalam keadaan open
	$incidenceList[1]['visited']= true; //node yg akan dikunjungi
	while (sizeof($queue)){ //selama antrian masih ada 
		//delete antrian paling belakang
		$vertex = array_pop($queue); 
		$vertex['class']->{$vertex['fungsi']}($awal,$kata); //mengunjungi node antrian yg paling belakang 
		foreach ($vertex['neighbours'] as $neighbour) { 
			//mengunjungi mana yang belum dikunjungi
			if(!$incidenceList[$neighbour]['visited']){ 
				//vertex yang sudah dikunjungi
				$incidenceList[$neighbour]['visited']=true; //node yg akan dikunjungi 
				array_unshift($queue, $incidenceList[$neighbour]); //masukin ke antrian
			}
		}
	}

?>