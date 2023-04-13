<?php 
class coreflush{

static function recup_func($dr,$p){
$d=read_file($dr.$p.'.php');
$r=explode('function ',$d); $n=count($r);
for($i=0;$i<$n;$i++){$v=$r[$i];
	$func=substr($v,0,strpos($v,'('));
	$var=between($v,'(',')'); $cat='';
	if($func!='\'.$name.$i.\'')$ret[$func]=[$var,$cat];
	if(strpos($v,"\n#"))$cat=between($v,'#',"\n");}
return $ret;}

static function detect_core(){$dr='progb/';
$rec=self::recup_func($dr,'lib'); //p($rec);
$r=msql::read('system','program_core','','1');
$rk=array_keys_r($r,0,'k'); $na=0; $nb=0;//p($r);
foreach($rec as $k=>$v){$ka=val($rk,$k); $rc=arr(val($r,$ka),4);
	$v=str_replace('$','',$v);
	if(!empty($rc[2]))$rc[2]=str_replace('$','',$rc[2]);
	if($k)$rb[]=[$k,$v[0],$rc[2],$rc[3],$v[1]];//$rc[4]?$rc[4]:
	if(!$ka)$na++;}
foreach($rk as $k=>$v)if(!isset($rec[$k]))$nb++; //p($rb);
$rb=msql::reorder($rb);//p($rb);//$rb=sort_table($rb,0); 
$rh=['function','variables','usage','return','context'];
msql::save('system','program_core',$rb,$rh);//,'input','output'
return 'program_core: added: '.($na?$na-1:0).' deleted: '.($nb?$nb:0).br();}

static function detect_plugable($f,$v){$d=read_file($f);
if(strpos($d,'plug_'.$v))return 1;}
static function detect_interface($f,$v){$d=read_file($f);
if(strpos($d,$v.'input'))return 1;}

static function update_table_lang($r,$d,$lg,$rh){//update_table in msql
if(isset($r['_menus_']))$ret['_menus_']=$r['_menus_']; else $ret=[];
$rb=msql::read_b('lang/'.$lg,$d); $ret=[];
if($r)foreach($r as $k=>$v)
$ret[$k]=$rb[$k]?$rb[$k]:array_pad(array(),count($rb["_menus_"]),"");
msql::save('lang/'.$lg,$d,$ret,$rh);
return $ret;}

static function batch_funcs($r,$rec,$rb,$rc,$dr){
if($rec)foreach($rec as $k=>$v)
	if(!is_numeric($k)){$ra=self::batch_funcs($r,$v,$rb,$rc,$dr.$k.'/'); $rb=$ra[0]; $rc=$ra[1];}
	else{
	$f=$dr.$v; $vb=strto($v,'.'); $xt=xt($v); $rc=val($r,$vb);
	$bo=self::detect_plugable($f,$vb); $iface=$rc[4]??'';//?$rc[4]:detect_interface($f,$vb); 
	$pb=substr($v,0,1)=='_'?'1':''; $na=0;
	if(is_file($f) && $v && $vb && $xt=='.php'){if(!$rc)$na++;
		[$rc0,$rc1,$rc2,$rc3,$rc4,$rc5]=arr($rc,6);
		$rb[$vb]=[$rc0,$rc1,$bo?$bo:'0',$rc3,$iface,$rc5,$pb];}//$vr,
	if(is_file($f) && $v && $vb)$rd[$vb]=[$rc[0]??''];}
return[$rb,$rc];}

static function detect_plugs(){$dr='plug/';
$r=msql::read('system','program_plugs','',1);//p($r);
$rec=explore($dr,'files',0); $rb=[]; $rc=[]; $rd=[]; $na=0;
$ra=self::batch_funcs($r,$rec,$rb,$rc,$dr); $rb=$ra[0]; $rc=$ra[1];
//$rb=msql::reorder($rb);//p($rb);
if($rb)ksort($rb);
$rh=['usage','dir','loadable','callable','interface','state','private'];//'vars',
msql::save('system','program_plugs',$rb,$rh);//,'input','output'
///?msql=lang/en/program_plugs&update==
self::update_table_lang($rd,'program_plugs','fr',array('usage'));
self::update_table_lang($rd,'program_plugs','en',array('usage'));
return 'program_plugs: added:'.($na?$na:0).', deleted:'.(count($r)-count($rb)).br();}

static function home(){
$ret=msqbt('system','program_core').' ';
$ret.=self::detect_core();
$ret.=msqbt('system','program_plugs_1').' ';
$ret.=self::detect_plugs();
return $ret;}
}
?>