<?php 
class addfonts{

static function copy($u,$f){
if(!is_file($f)){$d=read_file($u); write_file($f,$d); return lka($f);}
else return $f.' '.btn('txtyl','already_exists');}

static function inject(){$ret='';
$ra=msql::read('server','edition_typos','');
if($ra)$vra=array_keys_r($ra,0,'k');
$r=msql::read('','public_addfonts',''); if($r){$vr=array_shift($r);}
$dir='fonts/'; $diru='users/'.$_SESSION['qb'].'/fonts/'; if(!is_dir($diru))mkdir($diru);
if($r)foreach($r as $k=>$v){$font=normalize($v[0]); 
	if(!$vra[$font]){$rb=[$font,'','','','']; 
		for($i=1;$i<count($v);$i++){$f=$font.'.'.$vr[$i]; $rc[]=$dir.$f; 
			$ret.=self::copy($v[$i],$dir.$f).br();}//u
		//msql::modif('server','edition_typos',$rb,'push',$dfb,'');
		//msql::modif('','public_addfonts',$k,'del');
		if($rc)tar::files($diru.$font.'.tar.gz',$rc,0);//tar::create($f,$r)
		$ret.=btn('txtblc',lka($diru.$font.'.tar.gz')).' '.btn('txtx','saved').br();}
	else $ret.=$font.' already_exists'.br();}
//if($rb)msql::modif('server','edition_typos',$rb,'add',$dfb,'');
$ret.=lkc('txtbox','/?admin=fonts&inject==','inject datas (admin/fonts)').br();
return $ret;}

static function call($var1,$var2,$prm=[]){$res=$prm[0]??'';
$r=msql::read('','public_addfonts',''); if($r)$rk=array_keys_r($r,0,'k');
$res=ajx(substr($res,0,-1),1); $res=between($res,'{','}','');
$res=str_replace(array('"',"'",' ',"\n","\r","\t","?#iefix","?","!"),'',$res);
$ra=explode(';',$res); $nb=count($ra);
for($i=0;$i<$nb;$i++){
[$attrb,$value]=split_right(':',$ra[$i],0);
	if($attrb=='font-family')$rb['name']=$value;
	$rab=explode(',',$ra[$i]); if($rab)foreach($rab as $k=>$va){
		$rt=between($va,'url(',')',''); //echo $rt.br().br();
		if($rt && !$rk[$rb['name']]){$rs=strto($rt,'#');
			$xt=strend($rt,'.'); if(strpos($xt,'#'))$xt=strend($rt,'#');
			if($xt && substr($rs,0,4)=='http' && $xt!='eot?')$rb[$xt]=$rs;
			else $noturl=1;}}}
//if($rb[0])$rb=msql::reorder($rb); //pr($rb);
$dfb['_menus_']=array_keys($rb);
if(count($rb)>1){$r=msql::modif('users','public_addfonts',$rb,'push',$dfb,''); //pr($r);
	return self::read($r);}
else return btn('txtred',$noturl?'not absolte url':'already_exists');}

static function read($r){$n=count($r)-1;
if($n>0)$ret=lj('txtbox','cbk_addfonts,inject','add '.$n.' typos').br().br();//xd
return $ret.tabler($r,0,1);}

static function home($d){$here='addfonts';
//Head::add('css','../css/_admin.css')); Head::add('js','../progb/ajx.js'));
$r=msql::read('','public_addfonts','');
$ret=divc('txtalert','coller la classe @face-font (avec url absolue)').br();
$ret.=textarea('txtcss','',60,10);
$ret.=lj('txtbox','cbk_addfonts,call_txtcss__1_2','save').br().br();//xd
if($_SESSION['auth']>4)$ret.=divd('cbk',self::read($r));
$ret.=msqbt('','public_addfonts');
$ret=divd('page',divd('content',$ret));
return $ret;}
}
?>