<?php
$AT1 ;
$AT2 ;
$AT3;
$AT4 ;
$AT5 ;
$return = array();
$filetime = array();
function delLastLine($file_path) {
    $file = $fp = fopen($file_path, 'r') or die("Unable to open file!");
    while (!feof($file)) {
        $fp = fgets($file);
        if ($fp) {
            $content[] = $fp;
        }
    }
    array_pop($content);
    fclose($file);
    $file = fopen($file_path, 'w+');
    fwrite($file, implode("", $content));
    fclose($file);
}
function read_all($dir) {
    if (!is_dir($dir)) return false;
    $handle = opendir($dir);
    $k = 0;
    if ($handle) {
        while (($fl = readdir($handle)) !== false) {
            $temp = $dir . DIRECTORY_SEPARATOR . $fl;
            global $return;
            global $filetime;
            //echo $return[0];
            //$url="";
            if (is_dir($temp) && $fl != '.' && $fl != '..') {
                read_all($temp);
            } else {
                if ($fl != '.' && $fl != '..' && stripos($temp, "html.data") !== false) {
                    $source = $temp;
                    //echo "yes";
                    // echo  date ( "Y-m-d H:i:s", filemtime ($temp));
                    $filetime[$k] = date("Y-m-d H:i:s", filemtime($temp));
                    //   $filetime= date ( "Y-m-d H:i:s", filemtime ($temp));
                    $return[$k] = $temp;
                    // echo $return[$k];
                    //echo($temp);
                    //$string = json_decode(xml_to_json($source), true);
                    //echo($x);
                    //echo("</br>");
                    //echo("<pre>");
                    //$x;
                    //echo("</pre>");
                    //echo($temp);
                    //echo "FIND";
                    //echo("</br>");
                    //  echo   $filetime[$k];
                    //  echo("</br>");
                    $k++;
                }
            }
        }
    }
    array_multisort($filetime, SORT_DESC, SORT_STRING, $return); //time sort
    //var_dump($return);
    $length = count($return);
   // echo $length;
   // echo "</br>";
    for ($x =0;$x <=$length;$x++) {
     //   echo $return[$x];
    //    echo "</br>";
    }
    //return $return;
}

function readLastest() {
    global $AT1;
    global $AT2;
    global $AT3;
    global $AT4;
    global $AT5;
    global $return;
    read_all("C:\owncloud\JenkinsReports");
    $length = count($return);
    //echo $length;
    for ($x =0;$x<$length;$x++) {
          
          $str2=$return[$x];

          if (file_exists($str2))
          {
          $xml = simplexml_load_file($str2);
          $xmlstr = $xml->activity["screenresolution"];
          //echo $xmlstr;
          //var_dump($xml);
          }
       
         if(stripos($str2, "AT1_GZ")!==false&&empty($AT1)){
            echo "first-";
            echo $AT1;
              echo "</br>";
            echo $return[$x];
            echo "</br>";
            $AT1=$xmlstr;}
         if(stripos($str2, "AT2_GZ")!==false&&empty($AT2)){
             echo $return[$x];
            echo "</br>";
            $AT2=$xmlstr;}
         if(stripos($str2, "AT3_GZ")!==false&&empty($AT3)){
             echo $return[$x];
            echo "</br>";
            $AT3=$xmlstr;}
         if(stripos($str2, "AT4_GZ")!==false&&empty($AT4)){
             echo $return[$x];
            echo "</br>";
            $AT4=$xmlstr;}
        if(stripos($str2, "AT5_GZ")!==false&&empty($AT5)){
             echo $return[$x];
            echo "</br>";
            $AT5=$xmlstr;}
    }
}
//read_all("C:\owncloud\JenkinsReports");
readLastest();
echo ($AT1);
echo ("</br>");
echo ($AT2);
echo ("</br>");
echo ($AT3);
echo ("</br>");
echo ($AT4);
echo ("</br>");
echo ($AT5);
echo ("</br>");
delLastLine("screen.json");
file_put_contents("screen.json", json_encode(array('AT1_GZ' => $AT1, 'AT2_GZ' => $AT2, 'AT3_GZ' => $AT3, 'AT4_GZ' => $AT4, 'AT5_GZ' => $AT5)), FILE_APPEND);

?>