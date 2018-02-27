
<!DOCTYPE html>
<html lang="en">

  <head>
    <title>I'rob - Bi Imrithi</title>
    <!-- Bootstrap core CSS -->
    <link href="js/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template -->
    <meta charset="utf-8">
    <script type="text/javascript" src="./js/jquery.min.js"></script>
    <script type="text/javascript" src="./js/bootstrap.js"></script>


    <style type="text/css">
    textarea {
        font-size: 20pt;
        font-family: Arial;
         } 
      body {
        padding-top: 20px;  
        padding-bottom: 40px;
      }

      /* Custom container */
      .container-narrow {
        margin: 0 auto;
        max-width: 700px;
      }
      .container-narrow > hr {
        margin: 30px 0;
      }

      .isim { background-color:#FF0000; }
      .fiil { background-color:#009900  ; }
      .huruf { background-color:#003399; }
      .duaisim { background-color:#FF6600; }
      .duafiil { background-color:#00CC00 ; }
      .duahuruf { background-color:#00CCCC; }
      .irob9 { background-color:#FF6600; }
      .irob13{ background-color:#00CC00 ; }
      .irob{ background-color:#CC9900 ; }
      .node5{ background-color:#FF3300 ; }
      .node6{ background-color:#FF6600 ; }
      .node7{ background-color:#FF9900 ; }
      .node8{ background-color:#FFCC00; }
      .node9{ background-color:#FFFF00; }

      .node10{ background-color:#00CC00; }
      .node11{ background-color:#00FF00; }
      .node12{ background-color:#00CC33; }
      .node13{ background-color:#00FF33; }

      .node14{ background-color:#0033CC; }
      .node15{ background-color:#0033FF; }
      .node16{ background-color:#006699; }
      .node17{ background-color:#0066CC; }
      .node18{ background-color:#0066FF; }
      .node19{ background-color:#0099CC; }
      .node20{ background-color:#0099FF; }
      .node21{ background-color:#00CCFF; }

      .nodes5{ color:#FF3300 ; }
      .nodes6{ color:#FF6600 ; }
      .nodes7{ color:#FF9900 ; }
      .nodes8{ color:#FFCC00; }
      .nodes9{ color:#FFFF00; }

      .nodes10{ color:#00CC00; }
      .nodes11{ color:#00FF00; }
      .nodes12{ color:#00CC33; }
      .nodes13{ color:#00FF33; }

      .nodes14{ color:#0033CC; }
      .nodes15{ color:#0033FF; }
      .nodes16{ color:#006699; }
      .nodes17{ color:#0066CC; }
      .nodes18{ color:#0066FF; }
      .nodes19{ color:#0099CC; }
      .nodes20{ color:#0099FF; }
      .nodes21{ color:#00CCFF; }
    </style>

  </head>

  <body>
  <center>
    <div class="container-narrow">
      <div class="masthead">
          <h1 class="mb-0">I'rob bi Imrithi</h1>
      </div><br><br>

      <form action="" method="post" onkeypress="return arabicOnly(event)" onsubmit="return validasi()">
      <div>     
      <table   border=1 width="10%">       
      <tr>
      <td colspan="2">
      <textarea id="YourId" value=""  dir="rtl" class="keyboardInput"  name="kata" id="text" rows="6" style="width: 640px;" ><?php if(!empty($_POST['kata'])) echo $_POST['kata'];?></textarea>
              
      </tr>
      <tr><td>
          <button class="btn btn-success" type="submit" name="submit">Proses</button> &nbsp
          <a href='index.php' <i class='fa fa-refresh'></i> Reset </a>
           
      <link rel="stylesheet" type="text/css" href="http://www.arabic-keyboard.org/keyboard/keyboard.css"> 
      <script type="text/javascript" src="http://www.arabic-keyboard.org/keyboard/keyboard.js" charset="UTF-8"></script>

          </td>
          </tr> 

  </center>
  </table>
  </form>          
<br><br>
                  <?php 
error_reporting(0);
if(isset($_POST['submit'])){
  $k = $_POST['kata'];

  $kata = trim($k);

  //pecah array berdasarkan spasi
 $words    = explode(' ', $kata);
$createNew = array();
 foreach ($words as $word) {
             
    $createNew[]=$word;
  //echo $word." ";
}

$kas = implode($createNew,JSON_UNESCAPED_UNICODE);

$jsonUrl = file_get_contents('http://localhost/skripsi/Main/BFS.php?kata='.urlencode($kata));
$json_idr = json_decode($jsonUrl, true); //array

 ?>
 

   <?php 
   echo"<h3>";
   foreach ($words as $word) 
      {
   $nodenya = ($json_idr['kategori'][$word]['node']); 
   echo "<span class=nodes";echo $nodenya;echo ">"; 
   echo $word." ";                 
        }
   echo"</span>";
   echo"</h3>";
?>

<br>
  <span align="left">
  <div class="tab-content">
    <div class="tab-pane active">
    <table class="table table-hover table-bordered">                     
             <?php 
                      
        echo"<tr><th>Kalimah</th><th>Bentuk</th><th>Kategori</th><th>I'rob</th><th>Tanda I'rob</th><th>kedudukannya</th></tr>";
        foreach ($words as $word) {

        $bentuk = ($json_idr['bentuk'][$word]['bentuk']); 
        $cari_node = ($json_idr['bentuk'][$word]['node']);
        echo "<tr><td><h4><span class=";echo $bentuk;echo ">"; echo $word; echo"</span></h4></td>";
        echo "<td><h4>";

        //bentukknya
        echo $bentuk;
        echo "<br>";
        echo "</h4></td>";

        //echo $kategori;
        echo "<td><h4>";
        $nodenya = ($json_idr['kategori'][$word]['node']); 
        $durasi_node = $json_idr['bentuk'][$word]['node'];
        echo($json_idr['kategori'][$word]['kategori']); 
        echo "<br>";
        echo "</h4></td>";
        
        //echo $i'rob;
        echo "<td><h4>";
        if(($json_idr['kategori']['irob_'.$bentuk][$word]['irob'])==true){
        $node_irob = ($json_idr['kategori']['irob_'.$bentuk][$word]['node']);
        $bentuk = ($json_idr['bentuk'][$word]['bentuk']); 
        echo($json_idr['kategori']['irob_'.$bentuk][$word]['irob']); 
        echo "<br>";
        }
        echo "</h4></td>"; 

        //echo $tanda i'rob;
        echo "<td><h4>";
        if(($json_idr['irob'][$word]['tanda'])==true){
        echo($json_idr['irob'][$word]['tanda']); 
        echo "<br>";
        }
        echo "</h4></td>";

        //kedudukannya
        echo "<th><h4>";
        echo ($json_idr['level'][$word]['kedudukan']);
        echo "<br>";
        echo "</h4></th>";
        echo '';
        echo '</ul>';
      }
                    ?>  

    </div>               
    </table>
        <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"> Durasi </a> <br> <br>

    <div class="collapse" id="collapseExample">
    <table class="table table-hover table-bordered"> 
                              
                <?php 
                      
        echo"<tr><th>Kalimah</th><th>Bentuk</th><th>Kategori</th><th>I'rob</th><th>Tanda I'rob</th><th>kedudukannya</th></tr>";
        foreach ($words as $word) {

        $bentuk = ($json_idr['bentuk'][$word]['bentuk']); 
        $cari_node = ($json_idr['bentuk'][$word]['node']);
        echo "<tr><td><h4><span class=";echo $bentuk;echo ">"; echo $word; echo"</span></h4></td>";
        echo "<td><h4>";

        //bentukknya
        echo $bentuk;
        echo "<br>";
        echo "(";
        $durasi_node_bentuk = $json_idr['bentuk'][$word]['node'];
        echo($json_idr['bentuk']['durasi_node_'.$durasi_node_bentuk]);
        echo ")";
        echo "</h4></td>";

        //echo $kategori;
        echo "<td><h4>";
        $nodenya = ($json_idr['kategori'][$word]['node']); 
        $durasi_node = $json_idr['bentuk'][$word]['node'];
        echo($json_idr['kategori'][$word]['kategori']); 
        echo "<br>";
        echo "(";
        $durasi_node = $json_idr['bentuk'][$word]['node'];
        echo($json_idr['bentuk']['durasi_node_'.$durasi_node]); 
        echo ")";
        echo "</h4></td>";
        
        //echo $i'rob;
        echo "<td><h4>";
        if(($json_idr['kategori']['irob_'.$bentuk][$word]['irob'])==true){
        $node_irob = ($json_idr['kategori']['irob_'.$bentuk][$word]['node']);
        $bentuk = ($json_idr['bentuk'][$word]['bentuk']); 
        echo($json_idr['kategori']['irob_'.$bentuk][$word]['irob']); 
        echo "<br>";
        echo "(";
        $no = ($json_idr['kategori']['irob_'.$bentuk][$word]['node']);
        echo($json_idr['kategori']['durasi_node_'.$no]); 
        echo ")";
        }
        echo "</h4></td>"; 

        //echo $tanda i'rob;
        echo "<td><h4>";
        if(($json_idr['irob'][$word]['tanda'])==true){
        echo($json_idr['irob'][$word]['tanda']); 
        echo "<br>";
        echo "(";
        $durasi_node_ini =  ($json_idr['irob'][$word]['node']); 
        echo($json_idr['irob']['durasi_node_'.$durasi_node_ini]); 
        echo ")";
        }
        echo "</h4></td>";

        //kedudukannya
        echo "<td><h4>";
        echo ($json_idr['level'][$word]['kedudukan']);
        echo "<br>";
        echo "(";
        $node_level =($json_idr['level'][$word]['node']);
        echo ($json_idr['level']['durasi_node_'.$node_level]);
        echo ")";
        echo "</h4></td>";
        echo '';
        echo '</ul>';
      }
                    ?>  

    </div>               
    </table>
    </div></div><br>
                  
    <h3 class="mb-0">
    <span class="text-primary">Nadzom Imrithinya</span>
    </h3> <br>   
    <table class="table table-hover table-bordered"> 
                  <?php 

        echo"<tr><th>Kalimah</th><th>Nadom</th></tr>";
        echo"<td><h4>";
        echo"<h3>";
        foreach ($words as $word) {
        $nodenya = ($json_idr['kategori'][$word]['node']); 
        echo "<span class=nodes";echo $nodenya;echo ">"; 
        echo $word." ";                       
                              }
        echo"</span>";
        echo"</h3>";
        echo"</td></h4>";

        //nadzomnya
        echo "<td><h4>";
        $json = file_get_contents('http://localhost/skripsi/Main/nadzom.php');
        $json_nadzom = json_decode($json, true);
        $nomor_nadzom = ($json_idr['irob'][$word]['nadzom']);            
        echo($json_nadzom['nadzomnya'][$nomor_nadzom]['text']);
        echo "<br>";
        echo "</h4></td>";
        echo '';
        echo '</ul>';
                      ?>
    </table>
    </div>
    </span>
          <?php  }
      ?>
    </div> <!-- /tabbable -->
  </div>
    <hr>
    </div> <!-- /container -->

    <script type="text/javascript">
/**
          *  Collects all selected filters and changes available layouts
          */
        function numbersonly(e){
            var unicode=e.charCode? e.charCode : e.keyCode
            if (unicode!=8){ //if the key isn't the backspace key (which we should allow)
            if (unicode<48||unicode>57) //if not a number
            return false //disable key press
              }
            }
        function arabicOnly(e){
            var unicode=e.charCode? e.charCode : e.keyCode
            if (unicode!=8 && unicode!=32){ 
            // if the key isn't the backspace key (which we should allow)
            if ((unicode < 1536 || unicode > 1791)) 
            {//if not a number or arabic
            alert("Harus Menggunakan Huruf Hijaiyah");
            return false //disable key press       
              }
            }

            }
        function validasi(){
                var kata = document.getElementById('kata');
                if (harusDiisi(kata, "tidak boleh kosong")) {      
                }; 

                if (countHarokat(kata) <1){
                  alert("harus berharokat");
                  return false;
                } 

                  return false;       
            }
        function harusDiisi(att, msg){
                if (att.value.length == 0) {
                    alert(msg);
                    att.focus();
                    return false;
                }
                return true;
            }
        function countHarokat(kata){
        var harakat = 0;
        for (var i = 0; i < kata.length; i++) {
          var unicode = kata.charCodeAt(i);
          if ((unicode > 1611 && unicode < 1621)){
                  harakat =+ 1;
          }
        }
        return harakat;
          }
  

    </script>

  </body>
</html>
