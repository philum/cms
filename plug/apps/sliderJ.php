<?php //sliderJ
class sliderJ{
//name,1mini,2img,3width,4height,5mini_w,6mini_h,7text,8size,9color,10align,11position,alpha
static function img($f,$n){$w=cw(); 
[$n,$na]=explode('-',$n); $sdj='sdjp'.$na;
if(is_numeric($n))$_SESSION[$sdj]=$n;
elseif($n=='next')$_SESSION[$sdj]++; elseif($n=='prev')$_SESSION[$sdj]--;
$ra=msql::read('gallery',$f,''); 
if($ra){unset($ra['_menus_']); $ra=msql::reorder($ra); $nb=max(array_keys($ra));}
if($_SESSION[$sdj]>$nb)$_SESSION[$sdj]=1;
if($_SESSION[$sdj]<1)$_SESSION[$sdj]=$nb;
$r=$ra[$_SESSION[$sdj]]; //p($r);
if(!is_file($r[2]))return btn('txtsmall','no_file: '.$r[2]);
$h=round($r[4]*($w/$r[3])); $r[7]=stripslashes($r[7]);
if($h>=$r[4]){$wb=($w-$r[3])/2; $wa=$r[3];$ha=$r[4];} else{$wa=$w;$ha=$h;}
$im=image($r[2],$wa,$ha);
if($r[3]>$wa)$im=ljb('','SaveBf',ajx($r[2]).'_'.$r[3].'_'.$r[4],$im);
$sty='padding:4px; width:'.($w-8).'px; ';// margin:0 auto;
if($r[8])$font='font-size:'.$r[8].'px; ';
if($r[9])$color='color:#'.$r[9].'; ';
if($r[10])$align='text-align:'.$r[10].'; ';
$alp=($r[12]<33?20:($r[12]<66?50:($r[12]<90?75:90)));
if($r[12]!==false)$alpha='background-image:url(bkg/shadow/black'.$alp.'.png); ';
else $sty.='background-color:#'.$_SESSION['clrs'][$_SESSION['prmd']][6].'; ';
if($r[11]=='inside')$pos='position:absolute; margin-left:'.$wb.'px;';
$ret=self::nav($_SESSION[$sdj],$na,$nb,$f);
if($r[7])$ret=divs($sty.$width.$font.$color.$align.$alpha.$pos,$ret.$r[7]);
return div('',$ret.$im);}//style="text-align:center;"

static function thumbs($r,$f,$a){$w=cw(); if($r)unset($r['_menus_']);
if($r)$rb=array_keys_r($r,5); if($rb)$wt=array_sum($rb); $limit=0-($wt-$w+22);
if($r)foreach($r as $k=>$v){$i++; $imn='gallery/mini/'.$v[1];
	if(is_file($imn)){$im=image($imn,$v[5],$v[6]);
	$gdp=(0-$wa+(($w/2)-($v[5]/2))); if($gdp<$limit)$gdp=$limit; if($gdp>0)$gdp=0;
	$ret.=ljb('','sliderjnav_'.$a,[$gdp,$k],$im); $wa+=$v[5];}}
$ret=divb($ret,'sdjv'.$a,'','margin-left:0px;',$ret);
$ret=divb($ret,'','','overflow:hidden; width:'.($w).'px; height:75px;',$ret);
return $ret;}

static function js($f,$a){
Head::add('jscode','
static function sliderjnav_'.$a.'(v,i){
	SaveJ("sdj"+'.$a.'+"_sliderJ,img___'.ajx($f,"").'_"+i+"-'.$a.'");
	var curv=Number(document.getElementById("sdjv"+"'.$a.'").style.marginLeft.replace("px",""));
	Timer("slide","sdjv"+"'.$a.'",curv,v,2);}');}

static function nav($n,$na,$nb,$f){
$j='sdj'.$na.'_sliderJ,img___'.ajx($f,'').'_';
	$ret.=lj('',$j.'prev-'.$na,picto('previous')).' ';
	$ret.=lj('',$j.'next-'.$na,picto('next')).' ';
	$ret.='('.$n.'/'.$nb.') ';
return $ret.br();}

static function home($f,$id,$o){$w=cw(); static $i; $i++; 
$r=msql::read('gallery',$f,'');
if($o){self::js($f,$i); $ret=self::thumbs($r,$f,$i);}
//else $ret.=self::nav($i,$f,$r);
if($r)$ret.=divd('sdj'.$i,self::img($f,'1-'.$i));
if(auth(4))$ret.=lj('','popup_mk,sliderslct___'.ajx($f,'').'_'.$id,picto('edit'));
return $ret;}
}
?>