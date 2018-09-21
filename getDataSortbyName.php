<?php
// This is just an example of reading server side data and sending it to the client.
// It reads a json formatted text file and outputs it.
$source = "Origin_Latest_BlogTesting.xml";
$json = "";
$jsonArray;
function xml_to_json($source) {
    if (is_file($source)) {
        $xml_array = simplexml_load_string(file_get_contents($source));
    } else {
        $xml_array = simplexml_load_string(file_get_contents($source));
    }
    $json = json_encode($xml_array);
    return $json;
}
function read_all($dir) {
    if (!is_dir($dir)) return false;
    $handle = opendir($dir);
    $i = 0;
    global $jsonArray;
    if ($handle) {
        while (($fl = readdir($handle)) !== false) {
            $temp = $dir . DIRECTORY_SEPARATOR . $fl;
            if (is_dir($temp) && $fl != '.' && $fl != '..' && stripos($temp, "Ir")!==false) {
                // global $Tests;
                //$Tests=str_replace("C:/Results\\",'',$temp);
                read_all($temp);
            } else {
                if ($fl != '.' && $fl != '..' && stripos($temp, "Ir")!==false) {
                    $source = $temp;
                    $string = json_decode(xml_to_json($source), true);
                    if ($i == 0) $jsonArray = array($string);
                    else array_push($jsonArray, $string);
                    $i++;
                }
            }
        }
    }
}
function sortStrArray($jsonArray) {
    $jsonArrayResult;
    $jsonArrayResult = $jsonArray;
    $count = COUNT($jsonArrayResult);
    $k = 1;
    for ($i = 0;$i <= $count - 1;$i++) {
        for ($j = $i + 1;$j <= $count - 1;$j++) {
            if (!empty($jsonArrayResult[$i]['caseTester']) && !empty($jsonArrayResult[$j]['caseTester']) && strnatcmp($jsonArrayResult[$i]['caseTester'], $jsonArrayResult[$j]['caseTester']) < 0) {
                // echo $k;
                // echo  $jsonArrayResult[$i]['caseTester'];
                // echo  $jsonArrayResult[$j]['caseTester'];
                // echo "<br>";
                $k++;
                $temp = array();
                $temp = $jsonArrayResult[$j];
                $jsonArrayResult[$j] = $jsonArrayResult[$i];
                $jsonArrayResult[$i] = $temp;
                // echo "<---->";
                //echo  $jsonArrayResult[$i]['caseTester'];
                //echo $jsonArrayResult[$j]['caseTester'];
                
            }
        }
    }
    return $jsonArrayResult;
}
read_all('C:/Results');
//echo $jsonArray[0]['caseTester'];
$sortArray = sortStrArray($jsonArray);
//echo  $sortArray;
$strjson = json_encode($sortArray);
echo $strjson
?>





