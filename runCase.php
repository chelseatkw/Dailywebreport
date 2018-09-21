<?php
//exec("mkdir c:\\test3",$out);
//print_r($out);
//exec("cd C:\\Program Files\\curl",$out);
//exec("dir",$out);
//print_r($out);
//exec("curl --help",$out);
$jobName="";
$jobName=$_GET['jobName']; 
$load="";
$load=(int)$_GET['load']; 
echo ("<head>");
echo ("<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />");
echo ("<title>".$jobName."</title>");
echo ("<link rel='icon' href='/icons/terminal.png' type='image/x-icon' />");
echo ("</head>");

echo "running";
echo "-->";
echo $jobName;
echo "<br>";
$url ="http://william:85f34012cdbd865e24450b8f317bf860@192.168.18.131:8080/job/Origin_Latest_".$jobName;
 
if($load!=2)exec("curl -X POST ".$url."/build?token=6e5c0dcfe1e79d1d",$out); 
//if($load!=2)echo "first";
$url2="http://192.168.18.131:8080/job/Origin_Latest_".$jobName."/lastBuild/logText/progressiveText?start=0";
//$url2="http://baidu.com";
print_r("<pre>");

$s=file_get_contents($url2);
echo $s;
print_r("</pre>");
echo ("<form>");
echo ("<input type='checkbox' id='check1' />");
echo ("</form>");
echo ("<script type='text/javascript'>");
echo ("function setFocus()");
echo ("  {");
echo ("  document.getElementById('check1').focus()");
echo ("  }");
echo ("setFocus();");
echo ("</script>");




$t= time();
echo(date("l jS \of F Y h:i:s A",$t));

//<!--JS refresh -->
echo ("<script type=\"text/javascript\">");
echo ("function fresh_page()");    
echo ("{");
echo ("window.location.replace('./runCase.php?jobName=".$jobName."&load=2');");      
echo ("}"); 
echo ("setTimeout('fresh_page()',1000);");      
echo ("</script>");

?>