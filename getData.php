<?php
// This is just an example of reading server side data and sending it to the client.
// It reads a json formatted text file and outputs it.
$source = "Origin_Latest_BlogTesting.xml";
$json = "";
$jsonArray;
$Tests = "";
$Sucess = 0;
$Fail = 0;
$Percentage = 0;
$totalSucess = 0;
$totalFail = 0;
$flag = 1;
$StartTime;
//echo $StartTime;
$totalduration = 0;
function xml_to_json($source) {
    if (is_file($source)) {
        //echo is_file($source);
        $xml_array = simplexml_load_string(file_get_contents($source));
    } else {
        $xml_array = simplexml_load_string(file_get_contents($source));
    }
    $json = json_encode($xml_array);
    return $json;
}
function secToTime($times) {
    $result = '00:00:00';
    if ($times > 0) {
        $hour = floor($times / 3600);
        $minute = floor(($times - 3600 * $hour) / 60);
        $second = floor((($times - 3600 * $hour) - 60 * $minute) % 60);
        $result = $hour . ' hr ' . $minute . ' min ' . $second.' sec ';
    }
    return $result;
}
function timeTosec($time) {
    $result = 0;
    $newm = "";
    $news = "";
    $newh = "";
    //hr
    $newh = substr($time, 0, strrpos($time, 'hr'));
    //echo $newh;
    //echo "hr";
    //min
    //echo strrpos($time,"min");
    //echo "<--num";
    //echo "<br>";
    if (strrpos($time, "min") == 2) {
        $newm = substr($time, (strrpos($time, "min") - 2), 2);
    } elseif (empty(strrpos($time, "min"))) {;
    }
    //elseif(explode(substr($time,(strrpos($time,"min")-3),3),".")){$newm =  substr($time,(strrpos($time,"min")-4),4);}
    else {
        $newm = substr($time, (strrpos($time, "min") - 3), 3);
    }
    //echo  $newm;
    //echo "min";
    //sec
    //echo "<--num";
    //echo strrpos($time,"sec");
    //echo "<br>";
    if (strrpos($time, "sec") == 2) {
        $news = substr($time, (strrpos($time, "sec") - 2), 2);
    } elseif (empty(strrpos($time, "sec"))) {;
    } elseif (stripos(substr($time, (strrpos($time, "sec") - 3), 3), ".")!==false) {
        $news = substr($time, (strrpos($time, "sec") - 4), 4);
    } else {
        $news = substr($time, (strrpos($time, "sec") - 3), 3);
    }
    //echo $news;
    //echo "sec";
    $news1 = ( int )$news;
    $newm1 = ( int )$newm;
    $newh1 = ( int )$newh;
    $result = $news1 + $newm1 * 60 + $newh1 * 60 * 60;
    //echo $result;
    //echo "<br>";
    return $result;
}
function read_all($dir) {
    if (!is_dir($dir)) return false;
    $handle = opendir($dir);
    global $totalSucess, $totalFail, $totalduration;
    global $StartTime;
    $totalduration=timeTosec("0 s");
    $StartTime = "23:59";
   
    if ($handle) {
        while (($fl = readdir($handle)) !== false) {
            $temp = $dir . DIRECTORY_SEPARATOR . $fl;
            if (is_dir($temp) && $fl != '.' && $fl != '..' && stripos($temp, "Ir")!==false) {
                global $Tests;
                $Tests = str_replace("C:/Results\\", '', $temp);
                read_all($temp);
            } else {
                if ($fl != '.' && $fl != '..' && stripos($temp, "Ir")!==false) {
                    $source = $temp;
                    $string = json_decode(xml_to_json($source), true);

                    if(!empty($string['startTime'])&&!empty($string['duration'])){
                       // echo "k";
                       // echo $k;
                     
                            $r = (int)timeTosec($string['duration']);
                            //echo $r;
                            //echo "<br>";
                            
                            $totalduration = $totalduration + $r;
                        
                        // echo "start";
                        // echo $string['startTime'];
                       //  echo "</br>";
                         $x=strtotime($string['startTime']) - strtotime($StartTime);
                       //  echo "x";  //always bigger than 0??
                       //  echo $x;
                       //  echo "</br>";
                      if (strtotime($string['startTime']) - strtotime($StartTime) <0) $StartTime = $string['startTime'];
                        //echo $totalduration;
                        //echo "<br>";
                   //   echo "early";
                    //  echo $StartTime;
                   //   echo "</br>";
                }
                    $Sucess = ( int )$string['success'];
                    //echo "<br>";
                    $totalSucess = $totalSucess + $Sucess;
                    $Fail = ( int )$string['failed'];
                    //echo "<br>";
                    $totalFail = $totalFail + $Fail;
                  
                }
            }
        }
    }
}
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
function readData($filename, $Tests) {
    $handle = fopen($filename, "r");
    $i = 0;
    global $flag;
    global $jsonArray;
    //global $jsonArray[];
    while (!feof($handle)) {
        $buffer = fgets($handle);
        $arr1 = json_decode($buffer, true);
        if ($arr1['Tests'] == $Tests) $flag = 0;
        if ($i == 0) $jsonArray = array($arr1);
        else array_push($jsonArray, $arr1);
        $i++;
    }
    fclose($handle);
    return $jsonArray;
    //echo $i;
    
}
read_all('C:/Results');
//echo $Tests;
//ECHO "sucess".$totalSucess;
//ECHO "Fail".$totalFail;
if($totalSucess!==0 or $totalFail!==0)$Percentage = $totalSucess / ($totalSucess + $totalFail);
// $Percentage = $Percentage* 100;
//$Percentage=round($Percentage,2);
// $Percentage=(int)($Percentage."%");
//echo "Percentage".$Percentage;
//['Tests', 'Sucess',     'Fail', 'Percentage'],
//         ['Ir96Sr0_57',  293,       61,    0.83],
//cho $totalduration;
$totalduration1 = $totalduration;
$totalduration = secToTime($totalduration1);
$arr = array('Tests' => $Tests, 'Sucess' => $totalSucess, 'Fail' => $totalFail, 'Percentage' => $Percentage);
//$arr2=array ('Tests'=>$Tests,'Sucess'=>$totalSucess,'Fail'=>$totalFail,'Percentage'=>$Percentage,'StartTime'=>$StartTime);
//file_put_contents("sampleData.json", json_encode($arr), FILE_APPEND);
$jsonArray = readData('sampleData.json', $Tests);
for ($x = 0;$x <= count($jsonArray);$x++) {
    //echo $jsonArray[$x]['Tests'];
    //echo "HENG";
    
}
$len = count($jsonArray);
$index = $len - 1;
if ($flag == 1) {
    array_push($jsonArray, $arr);
    $len1 = count($jsonArray);
    $index1 = $len1 - 1;
    file_put_contents("sampleData.json", PHP_EOL, FILE_APPEND);
    file_put_contents("sampleData.json", json_encode($arr), FILE_APPEND);
     if(!empty($StartTime)){$jsonArray[$index1]['StartTime'] = $StartTime;}
    // echo "start";
     //echo $StartTime;
     if(!empty($totalduration)){$jsonArray[$index1]['totalduration'] = $totalduration;}
} else {
    delLastLine("sampleData.json");
    //file_put_contents("sampleData.json", PHP_EOL, FILE_APPEND);
    file_put_contents("sampleData.json", json_encode($arr), FILE_APPEND);
    if(!empty($StartTime)){$jsonArray[$index]['StartTime'] = $StartTime;}
     //echo "start";
     //echo $StartTime;
    if(!empty($totalduration)){$jsonArray[$index]['totalduration'] = $totalduration;}
}
$strjson = json_encode($jsonArray);
//echo $StartTime;
//echo $totalduration;
echo $strjson;
//$json="{Tests:".$Tests. ",Sucess:".$totalSucess.",Fail:".$totalFail.",Percentage:" .$Percentage."}";
//echo json_encode($json);

?>





