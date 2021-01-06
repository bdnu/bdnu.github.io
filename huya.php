<?php
$id=$_GET[id];
$url = "https://www.huya.com/".$id;
$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, $url); 
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); 
$re = curl_exec($ch); 
$re = htmlspecialchars($re);
curl_close($ch);
preg_match('|stream&quot;: &quot;(.*?)&quot;        };|i',$re,$play);
$play = base64_decode($play[1]);
preg_match('|sStreamName":"(.*?)","|i',$play,$name);
preg_match('|m3u8","sHlsAntiCode":"(.*?)","|i',$play,$pam);
$pam = str_replace("&amp;","&",$pam[1]);
$playurl = "http://migu-bd.hls.huya.com/src/".$name[1].".m3u8?".$pam;
header('Location:'.$playurl);
?>
