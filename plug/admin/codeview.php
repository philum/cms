<?php
//philum_codeview
#not work with bad number of {}, verify code under comments
ini_set("memory_limit","1200M");

function scrut_dira($dr){//file_infos
if(is_dir($dr)){$dir=opendir($dr);
	while($f=readdir($dir)){$drb=$dr.'/'.$f; 
	$fb=str_replace(array('.php','.js'),'',$f);
	if(is_file($drb) && $f!='..' && $f!='.' && $f!='.php' && $f!='userdl.tar.gz')$ret[$fb]=$f;}}
return $ret;}

//lists
function slct_sj($r,$h,$tg=''){
if($r)foreach($r as $k=>$v){$chk=$v==$h?'" selected="selected':'';
	$ret.='<option value="'.(ajx($v)).$chk.'">'.(!is_numeric($k)?$k:$v).'</option>'."\n";}
return '<select onchange="callSaveJ(\''.$tg.'\',this,1)">'.$ret.'</select>'."\n";}

#save
function save_funcs($f,$page){//echo $f.'-'.$p.br();;
$day=$_SESSION['philum']; //$day=mkday(time());
if(is_file($f)){//echo $f.br();
	if(substr($f,0,1)!='_')$v=read_file($f);
	list($rea,$reb)=splitfuncs($v);
	if(is_array($reb)){//pr($reb);
	foreach($reb as $func){
	if($func){
		list($id,$maj)=sql_b('select id,maj from _sys where name="'.$func.'"','r');
		$res=find_end($rea,'function '.$func.'(','{','}'); 
		//$res=substr($res,strpos($res,'{')+1,strrpos($res,'}'-1)); //eco($res,1);
		$resav=addslashes($res);
		if(!$id && $maj!=$day)
		msquery('INSERT INTO _sys VALUES ("","'.$func.'","'.$page.'","'.$day.'","'.$resav.'")');
		elseif($maj!=$day)
		msquery('UPDATE _sys SET maj="'.$day.'", func="'.$resav.'" WHERE id='.$id);
		$ret.='//'.$func."\n";
		$ret.=$res."\n\n";}}
	if(!$id or $maj!=$day)echo "$page $k : saved \n".br();}}
return $ret;}

function save_funcs_all($j,$k,$v,$i){//dr,file.php,1,nb
save_funcs($j.'/'.$k,substrpos($k,'.'));}

function sql_init($t){$db=plugin_func('install','install_db',ses('qd'));
if($db['_'.$t])mysql_query($db['_'.$t]) or die(mysql_error().$db['_'.$t]);}

function savefunc(){//save_all
sql_init('sys');
msquery('TRUNCATE TABLE _sys');
$r=array('admin','adminx','ajax','ajxf','api','art','boot','bubs','finder','lib','meta','mod','msql','pop','sav','spe','styl','tri');//,'ajx.js','utils.js'
foreach($r as $v)save_funcs('progb/'.$v.'.php',$v);}

function savefunc_plug(){//save_all
$r=explore('plug','full',1); //pr($r);
$ra=array('edit','dev','admin','ummo','photo'); //$ra=explore('plug','dirs',1);
if($ra)foreach($ra as $v){$rb=explore('plug/'.$v,'full'); p($rb);
//if($rb)foreach($rb as $vb)$r[]=$vb;
}
foreach($r as $v)if($v!='userdl.tar.gz'){
	$p=strrchr_b($v,'/'); $p=strdeb($p,'.'); save_funcs($v,$p);}}

#read
function find_end($ret,$start,$a,$b){
	$posa=strpos($ret,$start);
	$posb=strpos($ret,'}',$posa);
	$temp=subtopos($ret,$posa,$posb);
	$nbop=substr_count($temp,'{');
	for($i=1;$i<$nbop;$i++){$posb=strpos($ret,'}',$posb+1);
		$temp=subtopos($ret,$posa,$posb);
		$nbop=substr_count($temp,'{');}
	return subtopos($ret,$posa,$posb+1);}

function scrut_func($r,$i,$deb,$end){
	$deb+=substr_count($r[$i],'{');
	$end+=substr_count($r[$i],'}');
	if($r[$i])$ret.=$r[$i]."\n";
	if($deb>$end){
		$reb=scrut_func($r,$i+1,$deb,$end);
		if($reb[0])$ret.=$reb[0];
		$i=$reb[1];}
return array($ret,$i);}

function splitfuncs($v){
$r=explode("\n",$v); $n=count($r);
for($i=0;$i<$n;$i++){$v=$r[$i];
	if(substr($v,0,2)=='//')$ret[$i]=$v."\n";
	elseif(substr($v,0,1)=='#')$ret[$i]=$v."\n";
	elseif(!$v)$ret[$i]="\n";
	elseif(substr($v,0,9)=='function '){
		$c=embed_detect($v,'function ',')','').')';
		$rec[$c]=embed_detect($v,'function ','(','');
		$reb=scrut_func($r,$i,0,0);
		$ret[$i]=$reb[0];
		unset($r[$i]);
		$i=$reb[1];}}
if(is_array($ret))$rea=implode('',$ret);
return array($rea,$rec);}

function treat_funcs($j,$k,$v,$i){$f=$j.'/'.$v;//dr,nm,nm.php,nb
if(is_file($f) && $v==$_SESSION['file'] or !$_SESSION['file']){
	$v=read_file($f); $na=substr_count($v,'{'); $nb=substr_count($v,'}');
	if($na!=$nb)return '//error: illegal nb of {'.$na.'/'.$nb.'}';
	$reb=splitfuncs($v); //p($reb);
	$rea=$reb[0];
	if(is_array($reb[1]))$_SESSION['rec']+=$reb[1];
	if($_SESSION['func']){
		$ret=find_end($rea,'function '.$_SESSION['func'].'(','{','}');
		$ret=str_replace(array('<'.'?php','?'.'>'),'',$ret);}
	else $ret=$v;}
return $ret;}

function save_funcs_one($d){
$version=$_SESSION['philum'];//mkday(time());
	$posa=strrpos($d,'/'); $posb=strrpos($d,'.');
	$page=substr($d,$posa+1,$posb-$posa-1);
return save_funcs($d,$page);}

#pub
function function_aff($v,$t=''){
if(substr($v,0,2)!='<'.'?')$v='<'.'?php '.$t."\n".$v."\n".'?'.'>';
/*ini_set("highlight.comment", "#008000");
ini_set("highlight.default", "#000000");
ini_set("highlight.html", "#808080");
ini_set("highlight.keyword", "#0000BB; font-weight: bold");
ini_set("highlight.string", "#DD0000");*/
$ret=highlight_string($v,true);
$ret=str_replace(array('FF8000','007700','0000BB','DD0000','0000BB'),array('FF8000','00ee00','afafff','eeeeee','ffbf00'),$ret);
return '<div class="console" style="max-width:100%; max-height:400px; overflow:auto; wrap:true; padding:10px; border:1px solid black; font-size:medium;">'.$ret.'</div>';}

function functions_list($dr,$f){
$_SESSION['rec']=array();
$rep=scrut_dira($dr);
$r=explode_dir($rep,$dr,'treat_funcs');
if($r)$doc=implode('',$r);
//if($_SESSION['rec'])asort($_SESSION['rec']);
if($_GET['sav'] && !$f)$doc=save_funcs_one($dr);
if($f)$ret=function_aff($doc,'//philum/'.$dr.'/'.$f);
return array($rep,$ret);}

function cv_btn($p,$h){
return lj(''.($p==$h?'active':''),'codeview_plugin___codeview_'.$p,$p);}

function ffunc_row($v){
$func=$v[0].'('.embed_detect($v[2],'(',')','').')';
return array(
lj('','popup_plupin__3_codev_progb_'.ajx($v[1]).'_'.ajx($v[0]),picto('edit')).
lj('','edc_plug__2_dev_func*edit*j_progb|'.ajx($v[1]).'|'.ajx($v[0]),picto('editxt')),
lj('','codeview_plugin__3_codeview_progb_'.$v[1],$v[1]),
lj('','popup_plupin__3_codeview_progb_'.ajx($v[1]).'_'.ajx($v[0]),$func));}

function findfunc($p,$o,$res){list($p,$o)=ajxp($res,$p,$o);
$sql='select name,page,func from _sys where name="'.$p.'"'; $r=sql_b($sql,'');
$rb[]=array('edit','page','function'); if($r)$rb[]=ffunc_row($r[0]);
$sql='select name,page,func from _sys where func like "%='.$p.'(%" or  func like "%.'.$p.'(%" or  func like "%('.$p.'(%" or  func like "\n'.$p.'(%"'; $r=sql_b($sql,'');
if(!$r)return 'null'; 
foreach($r as $k=>$v)$rb[]=ffunc_row($v); $n=count($rb);
return btn('txtcadr','function '.$p.'() '.$n.' '.plurial($n,19).'').make_table($rb,'txtblc');}

function plug_codeview($dr,$f,$fc=''){if($dr=='param')$dr=$f='';
require_once('params/_connectx.php');
if(!$f && $fc)$f=sql_b('select page from _sys where name="'.$fc.'"','v');
if(strpos($f,'.')===false && $f)$f.='.php'; if($fc=='all')$fc='';
$ret.=lj('','codeview_plugin___codeview_'.$dr.'_'.$f.'_'.ajx($fc),picto('reload')).' ';
if($dr=='save'){$_GET['sav']=1; $dr=$_SESSION['dr'];
$dr=='plug'?savefunc_plug():savefunc();}
else $_GET['sav']=0; //if($dr=='all')$dr='';
$dr=$dr?$dr:'progb'; $_SESSION['dr']=$dr; $_SESSION['file']=$f; $_SESSION['func']=$fc;
if($dr!='params')list($rep,$res)=functions_list($dr,$f);
if(auth(6))$ret.=btn('nbp',cv_btn('progb',$dr).cv_btn('plug',$dr).(auth(5)?cv_btn('save',$dr):'')).' ';//cv_btn('all',$dr).
$nbfunc=count($_SESSION['rec']);
if(!$nbfunc)$nbfunc=rse('COUNT(id)','_sys');
$ret.=bal('small',$nbfunc.' functions').' ';
$jp=ajx(substrpos($f,'.'));
//list
if($rep){ksort($rep); array_unshift($rep,'...');} else $rep[]='...';
$ret.=slct_sj($rep,$f,'codeview_plugin__15_codeview_'.ajx($dr).'_');
//page
if($f && auth(6)){$ret.=lj('','popup_plupin___codev_'.$dr.'_'.$jp,picto('editxt')).' '; 
if($dr=='plug')$ret.=lj('','popup_plupin___'.$jp,picto('window')).' ';}
//list
$rec=array_values($_SESSION['rec']); array_unshift($rec,'all'); //if($rec)ksort($rec);
if($f)$ret.=slct_sj($rec,$fc,'codeview_plugin__15_codeview_'.ajx($dr).'_'.ajx($f).'_');
//func
if($fc && auth(6)){$ret.=lj('','popup_plupin___codev_'.$dr.'_'.$jp.'_'.ajx($fc),picto('editxt')).' '; if($dr=='plug')$ret.=lj('','popup_plup___'.$jp.'_'.ajx($fc),picto('window')).' ';}
//search
$ret.=input1('funcsrch',$fc,8).' '.lj('popbt','popup_plup___codeview_findfunc___funcsrch','find').' '.lj('popbt','popup_plup___coremap_coremap___funcsrch','map');
if($dr!='save_all')return divd('codeview',$rea.$ret.$res);}

?>