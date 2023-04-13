<?php //disk_space_nav
class dsnav{
//unused
static function embedli($d,$v,$isr){$_SESSION["nbsd"]++; $ds=$_SESSION["ds"];
$qb=$_SESSION['qb']; $xt=substr($v,-4); if($v)$f=$d.'/'.$v; else $f=$d;
if($xt==".jpg" or $xt==".png" or $xt==".gif"){$img=img::make_thumb_c($f);
	if(is_file($f))[$w,$h]=getimagesize($f); $ww='_'.$w.'_'.$h;}
$f=str_replace(array('users/','imgb/icons/'),'',$f); $fb=ajx($f,0); 
if(is_numeric($ds)){//bkg
	if($isr)$ret=lj("popbt",'bkg'.$ds.'_dsnav,home___'.$fb.'_bkg',$v);
	//if($isr)$ret=toggle('popbt',$v.$ds.'_dsnav,home___'.$fb.'_bkg',$v).' '.btd($v.$ds,"");
	else{[$w,$h]=getimagesize($f); $tx=$v.' ('.$w.' * '.$h.')'; //if(is_file($f))
	$ret=lj('','css'.$ds.'_stylsav___'.$fb.'_'.$ds.'_2',$img.$tx).hr();}}
if($ds=="gl"){if($isr)$ret=lj("popbt",'popup_gallery__3x_'.$fb,$v);}//photo
if($ds=="dl"){$dlm=$_SESSION['qb'].'/'.$_SESSION['dlmod'];//dwnl
	if($isr)$ret=lj("popbt",'dsnavds_dsnav,home___'.$fb.'_users/'.$dlm,$v);
	elseif($img)$ret=ljb("popw",'SaveBf','users/'.$fb.$ww,$img.$v);
	else $ret=lkt("popw",$d.'/'.$v,$img.$v);}
if($ds=="ic" && !$isr)return $ret; elseif($ret)return '&#9500;'.$ret.br();}

static function topo($r,$d,$c){$ret='';
if($r)foreach($r as $k=>$v){
	if(is_array($v)){//asort($v);
		if($k!='_error')$ret.=embedli($d,$k,1).self::topo($v,$d.'/'.$k,$c);}
	elseif($v && str_replace(array('users/','imgb/icons/'),"",$d)==$c)
		$ret.=embedli($d,$v,0);}
return divb($ret,'Taxonomy','','margin-left:10px');}

static function home($c,$dir){$_SESSION["nbsd"]=0;
if(is_numeric($dir)){$_SESSION["ds"]=$dir; $dir='imgb/bkg';}
if(!$dir)$dir='users/'.$_SESSION['qb'];
if($c=='ds' or $c=='gl' or $c=='dl' or $c=='ic')$_SESSION["ds"]=$c;
if($c=='ic')$dir='imgb/icons';
$r=explore($dir);
$ret=self::topo($r,$dir,$c);
if($_SESSION["nbsd"]>15)$ret=divd("scroll",$ret);
return $ret;}
}
?>