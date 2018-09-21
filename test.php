<?php
$jobName="";
$jobName=$_GET['jobName']; 
$url2="http://192.168.18.131:8080/job/Origin_Latest_".$jobName."/lastBuild/logText/progressiveText?start=0";
//$url2="http://baidu.com";
$s=file_get_contents($url2);
print_r("<pre>");
echo $s;
print_r("</pre>");

echo time();
//<!--JS refresh -->
echo ("<script type=\"text/javascript\">");
echo ("function fresh_page()");    
echo ("{");
echo ("window.location.reload();");
echo ("}"); 
echo ("setTimeout('fresh_page()',1000);");      
echo ("</script>");

?>