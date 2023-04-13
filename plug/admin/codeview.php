<?php //codeview
#not work with bad number of {}, verify code under comments
ini_set("memory_limit","1200M");
class codeview{
static function scrut_dira($dr,$fa=''){$ret=[];//file_infos
if(is_dir($dr)){$dir=opendir($dr);
	while($f=readdir($dir))if($f!='..' && $f!='.'){$drb=$dr.'/'.$f;
	$fb=str_replace(['.php','.js'],'',$f);
	if(is_dir($drb))$ret=array_merge($ret,self::scrut_dira($drb,$f.'/')); else
	if(is_file($drb) && $f!='.php' && $f!='userdl.tar.gz')
		$ret[$fb]=$fa.$f;}}
return $ret;}

//lists
static function slct_sj($r,$h,$tg=''){$ret='';
if($r)foreach($r as $k=>$v){$chk=$v==$h?'" selected="selected':'';
	$ret.='<option value="'.(ajx($v)).$chk.'">'.(!is_numeric($k)?$k:$v).'</option>'."\n";}
return '<select onchange="callSaveJ(\''.$tg.'\',this,1)">'.$ret.'</select>'."\n";}

#save
static function save_funcs($f,$page){//echo $f.'-'.$p.br();;
$day=$_SESSION['philum']; $ret=''; $k=''; $id='';//$day=mkday(time());
if(is_file($f)){//echo $f.br();
	if(substr($f,0,1)!='_')$v=read_file($f);
	[$rea,$reb]=self::splitfuncs($v);
	if(is_array($reb)){//pr($reb);
	foreach($reb as $func){
	if($func){
		[$id,$maj]=sql::call('select id,maj from _sys where name="'.$func.'"','r');
		$res=self::find_end($rea,'static function '.$func.'(','{','}'); 
		//$res=substr($res,strpos($res,'{')+1,strrpos($res,'}'-1)); //eco($res,1);
		$resav=addslashes($res);
		if(!$id && $maj!=$day)
		qr('INSERT INTO _sys VALUES ("","'.$func.'","'.$page.'","'.$day.'","'.$resav.'")');
		elseif($maj!=$day)
		qr('UPDATE _sys SET maj="'.$day.'", func="'.$resav.'" WHERE id='.$id);
		$ret.='//'.$func."\n";
		$ret.=$res."\n\n";}}
	if(!$id or $maj!=$day)echo $page.' '.$k.' : saved'."\n".br();}}
return $ret;}

static function save_funcs_all($j,$k,$v,$i){//dr,file.php,1,nb
self::save_funcs($j.'/'.$k,strto($k,'.'));}

static function sql_init($t){$db=install::db(ses('qd'));
if($db['_'.$t])qr($db['_'.$t]);}

static function savefunc(){//save_all
self::sql_init('sys');
qr('TRUNCATE TABLE _sys');
$r=['admin','ajax','api','art','bubs','finder','lib','pop','sav','spe','tri'];//,'ajx.js','utils.js'
foreach($r as $v)self::save_funcs('progb/'.$v.'.php',$v);}

static function savefunc_plug(){//save_all
$r=explore('plug','full',1); //pr($r);
$ra=['edit','dev','admin','ummo','photo']; //$ra=explore('plug','dirs',1);
if($ra)foreach($ra as $v){$rb=explore('plug/'.$v,'full');}
//if($rb)foreach($rb as $vb)$r[]=$vb;
foreach($r as $v)if($v!='userdl.tar.gz'){$p=strend($v,'/'); $p=strto($p,'.'); self::save_funcs($v,$p);}}

#read
static function find_end($ret,$start,$a,$b){
$posa=strpos($ret,$start);
$posb=strpos($ret,'}',$posa);
$temp=subtopos($ret,$posa,$posb);
$nbop=substr_count($temp,'{');
for($i=1;$i<$nbop;$i++){$posb=strpos($ret,'}',$posb+1);
	$temp=subtopos($ret,$posa,$posb);
	$nbop=substr_count($temp,'{');}
return subtopos($ret,$posa,$posb+1);}

static function scrut_func($r,$i,$deb,$end){$ret='';
$deb+=substr_count($r[$i],'{');
$end+=substr_count($r[$i],'}');
if(isset($r[$i]))$ret=$r[$i]."\n";
if($deb>$end){
	$reb=self::scrut_func($r,$i+1,$deb,$end);
	if($reb[0])$ret.=$reb[0];
	$i=$reb[1];}
return[$ret,$i];}

static function splitfuncs($v){
$r=explode("\n",$v); $n=count($r); $ret=[]; $rec=[]; $rea='';
for($i=0;$i<$n;$i++){$v=$r[$i];
	if(substr($v,0,2)=='//')$ret[$i]=$v."\n";
	elseif(substr($v,0,1)=='#')$ret[$i]=$v."\n";
	elseif(!$v)$ret[$i]="\n";
	elseif(substr($v,0,9)=='static function ' or substr($v,0,16)=='static static function '){
		$c=between($v,'static function ',')','').')';
		$rec[$c]=between($v,'static function ','(','');
		$reb=self::scrut_func($r,$i,0,0);
		$ret[$i]=$reb[0];
		unset($r[$i]);
		$i=$reb[1];}}
if($ret)$rea=implode('',$ret);
return [$rea,$rec];}

static function treat_funcs($j,$k,$v,$i){$f=$j.'/'.$v; $ret='';//dr,nm,nm.php,nb
if(is_file($f) && $v==$_SESSION['file'] or !$_SESSION['file']){
	if(is_file($f))$v=read_file($f); $na=substr_count($v,'{'); $nb=substr_count($v,'}');
	if($na!=$nb)return '//error: illegal nb of {'.$na.'/'.$nb.'}';
	$reb=self::splitfuncs($v); //p($reb);
	$rea=$reb[0];
	if(is_array($reb[1]))$_SESSION['rec']+=$reb[1];
	if($_SESSION['func']){
		$ret=self::find_end($rea,'static function '.$_SESSION['func'].'(','{','}');
		$ret=str_replace(array('<'.'?php','?'.'>'),'',$ret);}
	else $ret=$v;}
return $ret;}

static function save_funcs_one($d){
$version=$_SESSION['philum'];//mkday(time());
	$posa=strrpos($d,'/'); $posb=strrpos($d,'.');
	$page=substr($d,$posa+1,$posb-$posa-1);
return self::save_funcs($d,$page);}

#pub
static function function_aff($v,$t=''){
if(substr($v,0,2)!='<'.'?')$v='<'.'?php '.$t."\n".$v."\n".'?'.'>';
/*ini_set("highlight.comment", "#008000");
ini_set("highlight.default", "#000000");
ini_set("highlight.html", "#808080");
ini_set("highlight.keyword", "#0000BB; font-weight: bold");
ini_set("highlight.string", "#DD0000");*/
$ret=highlight_string($v,true);
$ret=str_replace(array('FF8000','007700','0000BB','DD0000','0000BB'),array('FF8000','00ee00','afafff','eeeeee','ffbf00'),$ret);
return '<div class="console" style="max-width:100%; max-height:400px; overflow:auto; wrap:true; padding:10px; border:1px solid black; font-size:medium;">'.$ret.'</div>';}

static function functions_list($dr,$f){
$_SESSION['rec']=[];
$rep=self::scrut_dira($dr); $ret='';
$r=explode_dir($rep,$dr,'treat_funcs');
if($r)$doc=implode('',$r);
//if($_SESSION['rec'])asort($_SESSION['rec']);
if($_GET['sav'] && !$f)$doc=self::save_funcs_one($dr);
if($f)$ret=self::function_aff($doc,'//'.$dr.'/'.$f);
return [$rep,$ret];}

static function cv_btn($p,$h){
return lj(''.($p==$h?'active':''),'codeview_codeview,'.$p,$p);}

static function ffunc_row($v){
$func=$v[0].'('.between($v[2],'(',')','').')';
return array(
lj('','popup_codev,home___progb_'.ajx($v[1]).'_'.ajx($v[0]),picto('edit')).
lj('','edc_dev,func*edit*j___progb|'.ajx($v[1]).'|'.ajx($v[0]),picto('editxt')),
lj('','codeview_codeview,home___progb_'.$v[1],$v[1]),
lj('','popup_codeview,home___progb_'.ajx($v[1]).'_'.ajx($v[0]),$func));}

static function findfunc($p,$o,$prm){[$p,$o]=arr($prm);
$sql='select name,page,func from _sys where name="'.$p.'"'; $r=sql::call($sql,'');
$rb[]=['edit','page','static function']; if($r)$rb[]=self::ffunc_row($r[0]);
$sql='select name,page,func from _sys where func like "%='.$p.'(%" or  func like "%.'.$p.'(%" or  func like "%('.$p.'(%" or  func like "\n'.$p.'(%"'; $r=sql::call($sql,'');
if(!$r)return 'null'; 
foreach($r as $k=>$v)$rb[]=self::ffunc_row($v); $n=count($rb);
return btn('txtcadr','static function '.$p.'() '.$n.' '.plurial($n,19).'').tabler($rb,'txtblc');}

static function home($dr,$f,$fc=''){connect();
if($dr=='param')$dr=$f=''; $ret=''; $res='';
if(!$f && $fc)$f=sql::call('select page from _sys where name="'.$fc.'"','v');
if(strpos($f,'.')===false && $f)$f.='.php'; if($fc=='all')$fc='';
if(auth(6))$ret=lj('','codeview_codeview,home___'.$dr.'_'.$f.'_'.ajx($fc),picto('reload')).' ';
if($dr=='save'){$_GET['sav']=1; $dr=$_SESSION['dr'];
	$dr=='plug'?self::savefunc_plug():self::savefunc();}
else $_GET['sav']=0; //if($dr=='all')$dr='';
$dr=$dr?$dr:'progb'; $_SESSION['dr']=$dr; $_SESSION['file']=$f; $_SESSION['func']=$fc;
if($dr!='params')[$rep,$res]=self::functions_list($dr,$f);
if(auth(5)){
	$ret.=btn('nbp',self::cv_btn('progb',$dr).self::cv_btn('plug',$dr).self::cv_btn('save',$dr)).' ';//self::cv_btn('all',$dr).
	$nbfunc=count($_SESSION['rec']);
	if(!$nbfunc)$nbfunc=sqb('count(id)','_sys','v','');
	$ret.=tagb('small',$nbfunc.' static functions').' ';
	$jp=ajx(strto($f,'.'));
	//list
	if($rep){ksort($rep); array_unshift($rep,'...');} else $rep[]='...';
	$ret.=self::slct_sj($rep,$f,'codeview_codeview,home__15_'.ajx($dr).'_');
	//page
	if($f && auth(6)){$ret.=lj('','popup_codev,home___'.$dr.'_'.$jp,picto('editxt')).' '; 
	if($dr=='plug')$ret.=lj('','popup_plugin___'.$jp,picto('window')).' ';}
	//list
	$rec=array_values($_SESSION['rec']); array_unshift($rec,'all'); //if($rec)ksort($rec);
	if($f)$ret.=self::slct_sj($rec,$fc,'codeview_codeview,home__15_'.ajx($dr).'_'.ajx($f).'_');
	//func
	if($fc && auth(6)){$ret.=lj('','popup_codev,home___'.$dr.'_'.$jp.'_'.ajx($fc),picto('editxt')).' ';
		if($dr=='plug')$ret.=lj('','popup_plug___'.$jp.'_'.ajx($fc),picto('window')).' ';}
	//search
	$ret.=input('funcsrch',$fc,8).' '.lj('popbt','popup_codeview,findfunc_funcsrch','find').' '.lj('popbt','popup_coremap,map_funcsrch','map');
}
if($dr!='save_all')return divd('codeview',$ret.$res);}
}
?>