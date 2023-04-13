<?php //a/vue
//build html from template of connectors with vars

class vue{
static $r=[];

static function readconn($d){$p=''; $c='';
$s=strrpos($d,':'); if($s!==false){$c=substr($d,$s+1); $d=substr($d,0,$s);
$s=strrpos($d,'$'); if($s!==false){$p=substr($d,$s+1); $d=substr($d,0,$s);}}
$r=[$d,$p,$c]; return $r;}

static function setvar($d){$n=strpos($d,'=');
if($n!==false && $d){$a=substr($d,0,$n); $b=substr($d,$n+1); self::$r[]=$d;}}

static function setvars($d){$r=explode(',',$d); foreach($r as $v)self::setvar($v);}

//read
static function parser($msg,$r){
$st='['; $nd=']'; $deb=''; $mid=''; $end='';
$in=strpos($msg,$st);
if($in!==false){
	$deb=substr($msg,0,$in);
	$out=strpos(substr($msg,$in+1),$nd);
	if($out!==false){
		$nb_in=substr_count(substr($msg,$in+1,$out),$st);
		if($nb_in>=1){
			for($i=1;$i<=$nb_in;$i++){$out_tmp=$in+1+$out+1;
				$out+=strpos(substr($msg,$out_tmp),$nd)+1;
				$nb_in=substr_count(substr($msg,$in+1,$out),$st);}
			$mid=substr($msg,$in+1,$out);
			$mid=self::parser($mid,$r);}
		else $mid=substr($msg,$in+1,$out);
			$mid=self::conns($mid,$r);
		$end=substr($msg,$in+1+$out+1);
		$end=self::parser($end,$r);}
	else $end=substr($msg,$in+1);}
else $end=$msg;
return $deb.$mid.$end;}

static function conns($da,$r){//v$p:c
[$d,$p,$c]=self::readconn($da); $ret='';
//echo utf8enc('--var:'.$d.' --opt:'.$p.' --conn:'.$c).br();//
switch($c){
//elements
case('br'):return br(); break;
case('hr'):return hr(); break;
case('div'):if($d)return div($p,$d); break;
case('divc'):if($d)return divc($p,$d); break;
case('divd'):if($d)return divd($p,$d); break;
case('span'):if($d)return span($p,$d); break;
case('spanc'):if($d)return btn($p,$d); break;
case('css'):if($d)return btn($p,$d); break;
case('clear'):return divc($c,$d); break;
case('grid'):if($d)return divs(gridpos($p),$d); break;
case('img'):if($d)return img($d); break;
case('distimg'):if($d)return twit::img($d); break;
//attributs
case('id'):return atd($d); break;
case('class'):return atc($d); break;
case('style'):return ats($d); break;
case('name'):return atn($d); break;
case('js'):return atk($d); break;
case('font-size'):return atb($c,$d); break;
case('font-family'):return atb($c,$d); break;
//apps
case('text'):return $d?$d:$p; break;
case('url'):return lka($d,$p?$p:preplink($d)); break;
case('lj'):return lj('',$d,$p); break;
case('link'):return md::special_link($d.'§'.$p); break;
case('anchor'):return '<a name="'.$d.'"></a>'; break;
case('date'):return mkday(is_numeric($d)?$d:'',$p); break;
case('title'):return ma::suj_of_id($d); break;
case('read'):return ma::read_msg($d,3); break;
case('image'):return image($d); break;
case('thumb'):return mk::thumb_d($d,$p,''); break;
case('picto'):return picto($d,$p); break;
//high_level
case('cut'):[$s,$e]=explode('/',$p); return between($d,$s,$e); break;
case('split'):return explode($p,$d); break;
case('conn'):return conn::connectors($d.':'.$p,3,'','',''); break;//from pop
//case('exec'):return self::exec_run($d,$id); break;
case('core'):if(is_array($d))return call_user_func($p,$d,'','');
	else{$db=explode('/',$d); return call_user_func_array($p,$db);}break;
case('app'):return appin($d,$p); break;
case('each'):foreach($d as $v)$ret.=codeline::cbasic_exec($v,'','',''); return $ret; break;
case('var'):return $r[$d]??''; break;//here is the core//str_replace('$',"&dollar;",$r[$d]??'')
case('getvar'):return self::$r[$d]; break;
case('setvar'):return self::setvar($d);break;
case('setvars'):return self::setvars($d);break;}
if(strpos($p,',')){[$css,$sty,$id]=expl(',',$p,3);
	if($css)$rb['class']=$css; if($sty)$rb['style']=$sty; if($id)$rb['id']=$id;
	return tag($c,$rb,$d);}
//if(function_exists($c))return call_user_func_array($c,opt(',',$d)); break;
if($d && $c)return tagb($c,$d);
return $d;}

static function build($tmp,$r){
$tmp=str_replace('§','$',$tmp);//patch
//foreach($r as $k=>$v){$tmp=str_replace('['.$k.':var]','{'.$k.'}',$tmp);}//patch
foreach($r as $k=>$v)if(!$v)$tmp=str_replace($v,'',$tmp);//del empty
$tmp=str::repair_tags($tmp); $d=delsp($tmp); $tmp=str::clean_lines($tmp); $tmp=delnl($tmp);
$d=self::parser($tmp,$r);
foreach($r as $k=>$v)$d=str_replace('{'.$k.'}',$v,$d);
return nl2br($d);}

static function call($tmp,$r){$ret='';//self::$r=$r;
$tmp=utf8enc($tmp);//used for §
//$r=array_chunk($r,100); $r=$r[7];//pr($r);
foreach($r as $k=>$v)$ret.=self::build($tmp,$v);
return $ret;}

#interface
static function calli($p,$o,$prm=[]){$p=$prm[0]??$p;
return textarea('',self::build($p,[]),60,4);}

static function home($p,$o){
$rid='plg'.randid();
$p='[[hello:span]$[tit:class]:div]';
$j=$rid.'_vue,calli_inp'.$rid;
$js=['onkeyup'=>sj($j),'onclick'=>sj($j)];
$bt=editarea('inp'.$rid,$p,54,8,$js,1);
$ret=self::calli($p,$o);
return $bt.div(atd($rid),$ret);}

}
?>