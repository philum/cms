<?php
//philum_plugin_coreflush

function recup_func($dr,$p){
$d=read_file($dr.$p.'.php');
$r=explode('function ',$d); $n=count($r);
for($i=0;$i<$n;$i++){$v=$r[$i];
	$func=substr($v,0,strpos($v,'('));
	$var=embed_detect($v,'(',')','');
	if($func!='\'.$name.$i.\'')$ret[$func]=array($var,$cat);
	if(strpos($v,"\n#"))$cat=embed_detect($v,'#',"\n",'');}
return $ret;}

function detect_core(){$dr='progb/';
$rec=recup_func($dr,'lib'); //p($rec);
$r=msql_read('system','program_core','','1');
$rk=array_keys_r($r,0,'k'); //p($r);
foreach($rec as $k=>$v){$rc=$r[$rk[$k]]; $v=str_replace('$','',$v);
	$rc[2]=str_replace('$','',$rc[2]);
	if($k)$rb[]=array($k,$v[0],$rc[2],$rc[3],$v[1]);//$rc[4]?$rc[4]:
	if(!$rk[$k])$na++;}
foreach($rk as $k=>$v)if(!$rec[$k])$nb++; //p($rb);
$rb=msq_reorder($rb);//p($rb); //req('msql'); //$rb=sort_table($rb,0); 
$rh=array('function','variables','usage','return','context');
msql_save('system','program_core',$rb,$rh);//,'input','output'
return 'program_core: added: '.($na?$na-1:0).' deleted: '.($nb?$nb:0).br();}

function detect_plugable($f,$v){$d=read_file($f);
if(strpos($d,'plug_'.$v))return 1;}
function detect_interface($f,$v){$d=read_file($f);
if(strpos($d,$v.'input'))return 1;}

function update_table_lang($r,$d,$lg,$rh){//update_table in msql
$ret["_menus_"]=$r["_menus_"]; $rb=msql_read_b('lang/'.$lg,$d);//
foreach($r as $k=>$v)
$ret[$k]=$rb[$k]?$rb[$k]:array_pad(array(),count($rb["_menus_"]),"");
msql_save('lang/'.$lg,$d,$ret,$rh);
return $ret;}

function detect_plugs(){$dr='plug/';
$r=msql_read('system','program_plugs','',1);//p($r);
$rec=explore($dr,files,1);//p($rec);
foreach($rec as $k=>$v){
	$f=$dr.$v; $vb=strdeb($v,'.'); $xt=xt($v); $rc=$r[$vb];
	$bo=detect_plugable($f,$vb); $iface=$rc[4];//?$rc[4]:detect_interface($f,$vb); 
	$pb=substr($v,0,1)=='_'?'1':'';
	if(is_file($f) && $v && $vb && $xt=='.php'){if(!$rc)$na++;
		$rb[$vb]=array($rc[0],$rc[1],$bo?$bo:'0',$rc[3],$iface,$rc[5],$pb);}//$vr,
	if(is_file($f) && $v && $vb)$rd[$vb]=array($rc[0]);
	}
//$rb=msq_reorder($rb);//p($rb);
ksort($rb); //p($rf);
$rh=array('usage','dir','loadable','callable','interface','state','private');//'vars',
msql_save('system','program_plugs',$rb,$rh);//,'input','output'
///?msql=lang/eng/program_plugs&update==
update_table_lang($rd,'program_plugs','fr',array('usage'));
update_table_lang($rd,'program_plugs','eng',array('usage'));
return 'program_plugs: added:'.($na?$na:0).', deleted:'.(count($r)-count($rb)).br();}

function plug_coreflush(){
//lib (core)
$ret.='core: '.msqlink('system','program_core').' ';
$ret.=detect_core();
//plugins
$ret.='plugs: '.msqlink('system','program_plugs_1').' ';
$ret.=detect_plugs();
return $ret;}

?>