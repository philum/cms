<?php
//philum_ajax_storage
session_start();
$nb=$_GET['nb'];
$_SESSION['memtmp'][$nb]=$_GET['callj']; echo $nb;
//$ix=$_GET['ix']; $nb=$_GET['nb'];
//$_SESSION['mem'][$ix][$nb]=$_GET['mem']; echo $ix.'-'.$nb;
?>