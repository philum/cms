<?php
//philum_microsql_admin

function msqlang(){return msql_read('lang','helps_msql','');}
function gpage($p=''){return $p?'/page/'.($p?$p:$_SESSION['page']):'';}

//msql_menu
function msql_menu($r,$type,$slct,$url){$r=explode(' ',$r);//j
foreach($r as $k=>$v){if($v)$ret.=lkc($v==$slct?'txtnoir':'txtx',$url.$v,$v).br();}
return $ret;}

function msql_repair($dr,$nod){$f=$dr.$nod.'.php'; 
if(is_file($f)){require($f); if($$nod)save_vars($dr,$nod,$$nod);}}

function msqm_lnk($r,$nurl,$vf,$cs1,$cs2,$kv){
foreach($r as $k=>$v){
	if($kv=="k")$v=$k; elseif($kv=="v")$k=$v;
	$lk=str_replace('#',$k,$nurl); $cs=$vf==$k?$cs1:$cs2; 
	if($k==$_SESSION['qb'] && $vf!=$k)$cs='txtblc';
	if($v=='lang' && strpos($lk,'lang'))$lk=str_replace('lang','lang/'.prmb(25),$lk);
	if($v)$ret.=lkc($cs,$lk,$v).' ';}
return $ret;}

function msql_menus($ra){
list($bases,$base,$dirs,$dir,$prefixes,$prefix,$files,$table,$ver,$folder)=$ra;
$rb=$files[$prefix]; $rc=$rb[$table]; $url=sesm('url');
$b=$base.'/'; if($dir)$d=$dir.'/'; $p=$prefix; $t='_'.$table; $tb=$table.'_'.$ver; 
if(is_array($bases)){asort($bases); $nurl=$url.'#/'.$d.$p.$t;//base
	$rt['base']=msqm_lnk($bases,$nurl,$base,'txtnoir',"txtx","k");}
if(is_array($dirs)){asort($dirs); $nurl=$url.$b.'#/'.$p.$t;//dir
	$rt['directory'].=msqm_lnk($dirs,$nurl,$dir,"txtnoir","txtx","k");}
if($prefixes){asort($prefixes); $nurl=$url.$b.$d.'#'.$t;//prefix
	$rt['prefix']=msqm_lnk($prefixes,$nurl,$prefix,'txtnoir','txtx','v');}
if($rb){asort($rb); $nurl=$url.$b.$d.$p.'_#';//table
	$rt['table']=msqm_lnk($rb,$nurl,$table,'txtnoir','txtx','k');}
if(count($rc)>0){//version
	foreach($rc as $k=>$v)$rs[$v]=strprm($v,1,'_'); ksort($rs);
	$nurl=$url.$b.$d.$p.'_#'; $btn=msqm_lnk($rs,$nurl,$tb,'txtnoir','txtx','');
	if($btn)$rt['version']=$btn;}
$s='display:table-cell; padding:5px; margin:5px; background:#ddd; border:1px solid #ccc;';
foreach($rt as $k=>$v)$ret.=divc('cell',$v);
//$ret=onxcols($rt,4,'',''); //$ret=implode(br(),$rt); $ret=msq_flap($rt);
//return divc('menu',lka('msql/','root')).$ret);
return divc('table',$ret).divc('clear','');}

function msql_menus_j($ra){$top=rstr(69)?'':'d';
list($b,$d,$p,$t,$ver,$def)=$_SESSION['murl'];
if($d)$bdr='/'.$d; $tn=$t; if($ver)$tn.='_'.$ver;
$ret.=popbub('admsq','',picto('msql'),$top,1);
if($d)$ret.=popbub('admsq',$b.$bdr,$d,$top,1);
else $ret.=popbub('admsq',$b.$bdr,$b,$top,1);
if($p)$ret.=popbub('admsq',$b.$bdr.'/'.$p,$p,$top,1);
if($t)$ret.=popbub('admsq',$b.$bdr.'/'.$p.'/'.$t,$tn,$top,1);
return $ret;}

#admin 
//lists
function slctmenuder($r,$h){
$ret='<form><select onchange="MM_jumpMenu(\'parent\',this,1)">';
foreach($r as $k=>$v){$chk=$k==$h?'" selected="selected':'';
	$ret.='<option value="'.($k).$chk.'">'.($k).'</option>';}
return $ret.'</select></form>'."\n";}

function normaliz_c($v){$v=normalize($v);
return str_replace(array("-","_"),"",$v);}

function array_list($r,$n){
foreach($r as $k=>$v){if($k!="_menus_" && $v[$n])$ret[$v[$n]]+=1;}
if($ret)ksort($ret); //arsort($ret,SORT_NUMERIC); 
return $ret;}

/*function add_after_x($defs){$ret=' '.btn('txtsmall2',nms(127));//after
$ra['']=0; if(is_array($defs))$ra+=array_flip(array_keys($defs));
return $ret.balise("select",array(2=>'pos',16=>"width:100px;"),batch_defil($ra));}*/

function add_after($defs){
return btn('txtsmall2',nms(127)).' '.select_j('pos','msql','',sesm('murl'));}

function f_inp_m($defs,$defsb,$def){
$vals=$defs[$def]; if(!$vals)$vals=$defsb; $lk=sesm('lk');
if($defs['_menus_'] && $def!='_menus_')
	if(in_array('last-update',$defs['_menus_']))
		$dateup=array_search('last-update',$defs['_menus_']);
$ret.=btn('imgr',prevnext($defs,$def));
if(auth(4) or $_SESSION['ex_atz']){
	$ret.=hidden('def','',$def);
	if($def!="_menus_")$ret.=input2('text','dfn',$def,'').' ';
	$ret.=add_after($defs).' ';
	if(auth(4)){
		$ret.=checkbox('erase',$def,nms(43),'').' ';
		//$ret.=checkbox_j('erase',$def,nms(43)).' ';
		$ret.=input2("submit",'save',nms(57),'').' ';
		if(auth(5))$ret.=lkc("txtx",$lk.'&newfrom='.$def,nms(44)).' ';
		$ret.=lkc('txtx',$lk,'x');}}
$ret.=br().br();
foreach($vals as $k=>$v){$v=msq_data($v);
	if($k==$dateup && $dateup)$v=date('ymdHi',time());
	$retb=btn('txtsmall" style="float:left; width:100px;',$defsb[$k]);
	$retb.=goodarea($v,'val'.$k,'','',60);
	if(auth(6))$retb.=msql_slct('val',$k,sesm('murl').':'.$k);
	//$retb.=togbub('hidden','val'.$k.'_msqlc__'.ajx(sesm('murl').':'.$k).'_'.'val'.$k,$k);
$ret.=divc('',$retb);}
$cl=$_GET['called']?'&called='.$_GET['called']:'';
return divc('menu',form($lk.'&def='.$def.$cl,$ret));}

function prevnext($r,$d){$lk=sesm('lk'); $r=msq_prevnext($r,$d);
return lkc('txtblc',$lk.'&def='.$r[0],'prev').' '.lkc('txtblc',$lk.'&def='.$r[1],'next');}

function f_inp_add($defs,$defsb,$def){
$ret.=autoclic('add','auto-increment',10,100,'',1).' '.hidden('def','',$def);
$ret.=input2('submit','save',nms(92),'').' '.add_after($defs); 
return form(sesm('lk').'&def='.$def,$ret);}

function msq_search($murl){list($dr,$nd,$vn)=murl_vars($murl);
$ret=autoclic('msqsr','',10,100,'search',1).' ';
$ret.=lj('popbt','editmsql_msqlfind___'.ajx($dr).'_'.ajx($nd).'___msqsr',nms(24));
return $ret;}

function msql_find($dr,$nd,$o,$sr){$r=msql_read_b($dr,$nd,'',1); $sr=ajxg($sr); 
if(!is_array($r) or !$sr)return;
foreach($r as $k=>$v)if(strpos($k,$sr)!==false)$ret[$k]=$v;
	else foreach($v as $ka=>$va)if(strpos($va,$sr)!==false)$ret[$k]=$v;
return !$ret?'no result':draw_table($ret,sesm('murl'),'');}

function save_defs($fld,$node,$defs,$def,$base){
$f=$fld.$node.'.php'; $p=$_POST; $dfn=$p["dfn"]; $lk=sesm('lk');
$add=str_replace(array('"',"'",),'',$p["add"]);
if($add){if($add!="auto-increment" && !$defs[$add])$def=$add; 
	else $def=findnextkey($defs,1);
	if($cn=count($defs["_menus_"]))$defs[$def]=array_fill(0,$cn,'');}// $relod=1;
elseif($p["erase"]){
	if($def=="_menus_"){unlink($f); exit(relod($lk));}
	else{unset($defs[$def]);}}// $relod=1;
if($defs[$def]){
	if($p["pos"]){unset($defs[$def]);
		foreach($defs as $k=>$v){$defc[$k]=$v; $i++;
			if($i+2==$p["pos"]+2)foreach($v as $ka=>$va)$defc[$def][$ka]=$p['val'.$ka];}
		$defs=$defc;}
	else foreach($defs[$def] as $k=>$v)$defs[$def][$k]=$p['val'.$k];}
if($dfn && $dfn!=$def){$defs=rename_array($defs,$def,$dfn); $def=$dfn;}
unset($defs[0]); if($def)$lk.='_'.$def; if($cd=get('called'))$lk.='&called='.$cd;
save_vars($fld,$node,$defs); $_GET['def']=$def;
//if($relod)relod($lk);
return array($defs,$def);}

function rename_array($defs,$def,$d){
foreach($defs as $k=>$v)if($k==$def)$ret[$d]=$v; else $ret[$k]=$v;
return $ret;}

function newbase($base,$prefix,$table,$version){
$prefix=$prefix?$prefix:'prefix';
$table=$table?$table:'table';
$version=msq_find_last($base,$prefix,$table);
$idt=$version?$version:'version';
if(auth(5))$ret.=input2(1,'prfx',$prefix).'';
elseif($prefix!=$_SESSION['USE'])return btn('txtx','forbidden');
else $ret.=input2('text','prfx',$prefix,'').btn('txtx',$prefix).'';
$ret.=input2(1,'hbname',$table).'';
$ret.=input2(1,'hbnb',$idt).' ';
$ret.=autoclic('nbc','nb cols',4,255,'txtx',1).' ';
$ret.=input2('submit','save',nms(99),'txtbox');
$go=sesm('url').murl_build($base,'',$prefix,$table,$version).'&create=='.gpage();
return form($go,$ret);}

#draw 
function tables($base){$r=explore($base,'files',1);
if($r){foreach($r as $k=>$v){$v=substr($v,0,-4);
list($nd,$bs,$sv,$op)=split('_',$v); if(!$nd)$nd='root';
if($nd && $sv!='sav' && $op!='sav')$ret[$nd][$bs][$sv]=$bs.($sv?'_'.$sv:'');}
return $ret;}}

function cutat($d){$r=explode(' ',$d); $n=count($r);
for($i=0;$i<$n;$i++){$nb+=strlen($r[$i]); if($nb<256)$ret.=$r[$i].' ';}
if($nb>=256)$dot=' (...)'; return $ret.$dot;}

function medit_shot($d,$nd,$k,$ka,$res){$v=ajxg($res); $rid='mdt'.randid();
$r=msql_read_b($d,$nd,$k,'',$ka); $va=msq_data($r[$ka]);
$j=ajx($d).'_'.ajx($nd).'_'.ajx($k).'_'.ajx($ka).'_'.$rid;
return assistant($rid,'SaveJ',ajx($k.'-'.$ka).'_msqlmodif__x_'.$j,$va,'');}
//return input(1,$rid,$va).lj('popbt',ajx($k.'-'.$ka).'_msqlmodif__x_'.$j,'save');

function medit_shot_bt($va,$k,$ka,$b,$nd){$id=ajx($k.'-'.$ka); if(!trim($va))$va='-';
return  '<a id="'.$id.'" ondblclick="'.sj('popup_msqledit___'.$b.'_'.$nd.'_'.ajx($k).'_'.ajx($ka)).'">'.$va.'</a>';}
//return togbub('msqledit',$b.'_'.$nd.'_'.$k.'_'.$ka,$val);

function draw_table($r,$murl,$adm=''){//adm=saving
list($dr,$nd,$n)=murl_vars($murl);
foreach($r as $k=>$v){$ra='';$i++;
	if(is_array($v))foreach($v as $ka=>$va)$ra[]=msq_data(cutat($va),1);
	$css=$k==$_GET['def']?'txtyl':'txtbox'; $jurl=ajx($murl).'_'.ajx($k);
	$edit=lka(sesm('url').$murl.':'.($k).gpage(),picto('editor'));//ajx
	if($k=='_menus_' && $ra){
		foreach($ra as $ka=>$va)$ra[$ka]=lka(sesm('url').$murl.'&sort='.$ka,$ka.':'.$va);
		array_unshift($ra,lka(sesm('url').$murl.'&sort=k','keys')); 
		if(auth(4))array_unshift($ra,ljb('','chkall','','²'));}
	elseif(is_array($ra)){
		foreach($ra as $ka=>$va)$ra[$ka]=medit_shot_bt($va,$k,$ka,$dr,ajx($nd));
		if(auth(4))array_unshift($ra,$edit.lj($css,'popup_editmsql___'.$jurl,$k));
		else array_unshift($ra,$k);
		if($k!="_menus_" && auth(4))array_unshift($ra,checkbox('c'.$k,$k,'',0));}
	$datas[$k]=$ra;}
return make_table_bypage($datas,'txtblc','');}//txtx

function make_table_bypage($r,$csa,$csb){
if($r["_menus_"]){foreach($r["_menus_"] as $k=>$v)$td.=balc("td",$csa,$v);
	$tr=balc("tr",'',$td); unset($r["_menus_"]);}
$n=count($r)+1; $page=$_SESSION['page']; $npg=1000;
req('spe'); $ret=nb_page($n,$npg,$page,'');
$min=($page-1)*$npg; $max=$page*$npg;
if(is_array($r))foreach($r as $k=>$v){$td=""; $i++;
	if($i>=$min && $i<$max && is_array($v))
		foreach($v as $ka=>$va)$td.=balc("td",$csb,$va);
	if($td)$tr.=balc("tr","",$td);}
return $ret.balc("table",'',$tr).$ret;}

#tools 

function find_command(){$g=$_POST&&$_GET?$_POST+$_GET:($_GET?$_GET:$_POST);
$arr=array_flip(array('','restore','import_old','import_defs','import_keys','merge_defs','append_update','import_conn','inject_defs','edit_csv','reset_menus','del_menus','permut','add_col','del_col','sort','sort_table','del_file','repair','repair_cols','update','append_values','del_table','del_multi','newfrom','reorder','add_keys','del_keys'));//detect 0
foreach($g as $k=>$v)if($arr[$k])return $k;}

function msq_filters($r,$d){$g=$_GET[$d];
return call_user_func($d,$r,$g);}

function msql_modifs($defs,$defsb,$folder,$pre,$node,$basename,$modif){
switch($modif){
case('restore'): $defs=read_vars($folder,$node.'_sav',$defsb); break;
case('import_old'):$defs=$$table; break;
case('del_menus'):unset($defs['_menus_']); break;
case('del_file'): save_vars($folder,$node.'_sav',$defs);
	unlink($basename.'.php'); relod('/'.$folder.$pre); break;
case('del_table'):$r["_menus_"]=$defs["_menus_"]; $defs=$r; break;
//auto
case('append_update'):$defs=append_update($defs,$_GET["append_update"]); break;
case('import_defs'):$defs=import_defs($defsb,$_GET["import_defs"]); break;
case('import_keys'):$defs=import_keys($defs,$_GET["import_keys"]); break;
case('merge_defs'):$defs=merge_defs($defs,$_GET["merge_defs"]); break;
case('permut'):$defs=permut($defs,$_GET["permut"]); break;
case('reset_menus'):$defs=reset_menus($defs); break;
case('add_col'):$defs=add_col($defs); break;
case('del_col'):$defs=del_col($defs,$_GET["del_col"]); break;
case('repair_cols'):$defs=repair_cols($defs); break;
case('sort'):$defs=sort_table($defs,$_GET['sort'],1); $_GET['del_file']=1; break;
case('sort_table'):$defs=sort_table($defs,$_GET['sort_table']); break;
case('append_values'):$defs=append_values($defs,$_GET["append_values"]); break;
case('del_multi'):$defs=del_multi($defs); break;
case('reorder'):$defs=reorder($defs); break;
case('add_keys'):$defs=add_keys($defs); break;
case('del_keys'):$defs=del_keys($defs); break;
//post
case('import_conn'):$defs=import_conn($defs,$_POST["import_conn"],$_POST["aid"]); break;
case('inject_defs'):$defs=inject_defs($defs,$_POST["inject_defs"]); break;
case('edit_csv'):$defs=edit_csv($defs,$_POST["edit_csv"]); break;
case('update'):$defs=update_table($node,$defs); break;
case('repair'):$defs=repair($defs); break;
case('newfrom'):$defs=new_from_defs($defs,$_GET["newfrom"],$folder,$node);break;
//default:msq_filters($defs,$modif); break;
}
if(!$_GET["del_file"] && $defs)save_vars($folder,$node,$defs);
return $defs;}

function new_from_defs($r,$d){$nb=findnextkey($r,1); $r[$nb]=$r[$d]; //p($r[$d]);
	save_vars($folder,$node,$r); relod(sesm('lk').'&def='.$nb);}

function del_multi($defs){
foreach($defs as $k=>$v){$g=$_POST['c'.$k]; if(!$g)$ret[$k]=$v;}
return $ret;}

function import_defs($defsb,$d){
if(strpos($d,'msql/')!==false){require('plug/microxml.php'); return clkt($d);}
else{list($a,$b)=split_one('/',$d,1); if(substr($a,5)!='msql/')$a=sesm('root').$a;
return read_vars($a.'/',$b,$defsb);}}

function import_keys($r,$d){
list($a,$b)=split_one('/',$d,1); $rb=msql_read_b($a,$b);
if($rb['_menus_'])$r['_menus_']=$rb['_menus_']; return $r;}

function merge_defs($r,$d){
list($a,$b)=split_one('/',$d,1); $rb=msql_read_b($a,$b,'',1);
return array_merge_b($r,$rb);}

function append_values($r,$d){
list($a,$b)=split_one('/',$d,1); $rb=msql_read_b($a,$b);
foreach($r as $k=>$v){$vb=$rb[$k]; $n=count($vb);
	for($i=0;$i<$n;$i++){$r[$k][]=$vb[$i];}}
return $r;}

function reset_menus($r){
if($r){reset($r); $first=key($r);}
if($first=='_menus_'){next($r); $first=key($r);}
$nb=count($r[$first]);
for($i=0;$i<$nb;$i++){$ret["_menus_"][]='val'.$i;}
if($ret && $r)return $ret+$r;
else return $r;}

function permut($r,$mu){list($a,$b)=split("/",$mu);
if($a!==false && $b!==false && $r){
foreach($r as $k=>$v){$obj=$v[$a]; $v[$a]=$v[$b]; $v[$b]=$obj; $ret[$k]=$v;}}
return $ret;}

function add_col($r){
if(!$r['_menus_'])$r['_menus_']=msq_menus($r);
foreach($r as $k=>$v){$v[]=$k=='_menus_'?'val'.(count($v)+1):''; $ret[$k]=$v;}
return $ret;}

function del_col($r,$n){$col=$n; 
foreach($r as $k=>$v){if($n=='=')$col=count($v)-1; unset($v[$col]); $ret[$k]=$v;}
return $ret;}

function sort_table($r,$n,$y=''){$y=$y?yesnoses('sort'):'';
$ret["_menus_"]=$r["_menus_"]; unset($r["_menus_"]);
if(is_numeric($n) or !$n){foreach($r as $k=>$v)$re[$k]=$v[$n]; $y?arsort($re):asort($re);
	foreach($re as $k=>$v)$ret[$k]=$r[$k];}
else{$y?krsort($r):ksort($r); $ret+=$r;}
return $ret;}

function repair_cols($r){$nb=count($r['_menus_']);
foreach($r as $k=>$v){$ra='';
	for($i=0;$i<$nb;$i++)$ra[$i]=$v[$i];
	$ret[$k]=$ra;}
return $ret;}

function repair($r){
if($r)foreach($r as $k=>$v){
	if(!is_array($v))$v=array($v);
	if($k && $v[0])$rb[$k]=$v;}
if($rb[0])unset($rb[0]);
return $rb;}

function update_table($d,$r){
$ret["_menus_"]=$r["_menus_"];
$defs=msql_read_b('system',$d);
foreach($defs as $k=>$v)
$ret[$k]=$r[$k]?$r[$k]:array_pad(array(),count($r["_menus_"]),"");
return $ret;}

function import_conn($defs,$it,$aid){$ret=$defs['menus'];
if(substr($it,0,1)=='[')$it=substr($it,1); $it=str_replace(':table]','',$it); 
$r=explode("¬",$it);
foreach($r as $k=>$v){$ra=explode("|",$v);
	if(is_array($ra)){$rb=''; 
		foreach($ra as $ka=>$va){
			$va=str_replace(array(':BAR:',':LINE:'),array('|','¬'),$va);
			$rb[]=trim($va);} $ra=$rb;}
	if($aid=='ok')$ret[$k+1]=$ra;
	else{$va=$ra[0]; unset($ra[0]); $ret[$va]=$ra;}}
return $ret;}

function findnextkey($r,$nb){
static $nb; $nb+=1; if($r[$nb])$nb=findnextkey($r,$nb);
return $nb;}

function app_des_free($da,$db){
$a=explode(';',str_replace(array('; ',";\n","\n"),array(';',';',''),$da)); 
$b=explode(';',str_replace(array('; ',";\n","\n"),array(';',';',''),$db)); 
if($b)foreach($b as $k=>$v){if($a)$in=in_array($v,$a); 
	if(trim($v) && (($a && !$in) or !$a))$a[]=trim($v);}
if($a){$n=count($a); for($i=0;$i<$n;$i++)if($a[$i])$ret.=$a[$i].'; ';
	return $ret;}}

function append_design($a,$b){
foreach($a as $k=>$v){$va=trim($v[0].$v[1].$v[2]); $vrf[$va]=$k;}
foreach($b as $k=>$v){$va=trim($v[0].$v[1].$v[2]); $kb=$vrf[$va];
	if($kb){$a[$k][6]=app_des_free($a[$k][6],$v[6]);}
	else $a[]=$v;}
return $a;}

function append_update($defs,$d){
list($a,$b)=split_right('/',$d,1); $r=msql_read_b($a,$b);
if($a=='design')return append_design($defs,$r);
foreach($r as $k=>$v)if(($v['last-update'] && $v['last-update']>=$defs[$k]['last-update']) or !$defs[$k])$defs[$k]=$v;
return $defs;}

function reorder($r){$i=0; 
if($r['_menus_'])$rb['_menus_']=array_shift($r);//sort($r);
foreach($r as $k=>$v){$i++; $rb[$i]=$v;}
return $rb;}

function add_keys($r){$i=1;
foreach($r as $k=>$v){if($k=='_menus_')$kb=$k; else $kb=$i++; 
	array_unshift($v,$k); $ret[$kb]=$v;}
return $ret;}

function del_keys($r){
foreach($r as $k=>$v){
if(is_array($v)){
	if($k=='_menus_')$kb='_menus_'; else $kb=$v[0]; 
	array_shift($v);}
$ret[$kb]=$v;}
return $ret;}

function inject_mono($r,$d){//verticalize
$d=embed_detect($d,'array(',');',''); $rb=explode(',',$d);
foreach($rb as $k=>$v){
	if(strpos($v,'=>'))list($ka,$va)=split("=>",$v); else $va=$v;
	$ka=str_replace(array('"',"'",' '),'',$ka);
	$r[$ka]=array(str_replace(array('"',"'",' '),'',$va));}
return $r;}

function inject_sql($r,$d){
$d=str_replace(') VALUES','),',$d); 
$d=str_replace(array('`',", ''","''"),array('',", '-'","\'"),$d);
$rb=explode("), '",$d);//very bad
foreach($rb as $k=>$v){
	if(substr($v,0,6)=='INSERT')$m=1; else $m=0;
	$v=str_extract('(',$v,0,1);
	list($key,$v)=split_right(", '",$v); //echo $key.'-'.$v.br();
	$v=trim($v); $rd='';
	if($m)$rc=explode(',',$v); elseif($v)$rc=explode("', '",$v); //p($rc);
	foreach($rc as $vc){
		if(substr($vc,0,1)=="'")$vc=substr($vc,1);
		if(substr($vc,-1)=="'")$vc=substr($vc,0,-1);
		$rd[]=trim($vc);}
	if($m)$r['_menus_']=$rd; elseif($key && $rd)$r[trim($key)]=$rd;}
return $r;}

function inject_defs($r,$d){if(!$d)return $r;
if($_POST['sql'])return inject_sql($r,$d);
if($_POST['mono'])return inject_mono($r,$d);
$rb=explode('$',$d); echo $_POST['save'];
foreach($rb as $k=>$v){
	$key=embed_detect($v,'[',']',''); $key=str_replace(array("'",'"'),'',$key);
	$value=embed_detect($v,'array(',');',''); $value=str_replace(array("'",'"'),'',$value);
	if(substr($value,0,1)=="#")$value='&'.$value;
	if(strpos($value,",")!==false)$rc=explode(',',$value); else $rc=array($value);
	if($key && $value)$rd[$key]=$rc;}
if($_POST['replace'])$r=$rd; else $r+=$rd;
return $r;}

function edit_csv($r,$d){if(!$d)return $r; 
$ra=explode("\n",$d); $rb['menus']=$r['menus'];
if($ra)foreach($ra as $k=>$v)$rb[]=explode(",",$v); p($rb);
if($rb[0]){$rb['menus']=$rb[0]; unset($rb[0]);}
return $rb?$rb:$r;}

function backup_msql(){
if(auth(7))return plugin('backup_msql','');}

#render 
function msql_adm_head($u,$base,$prefix,$table,$version){
Head::add('jscode','//slctmenuder
	function MM_jumpMenu(targ,selObj,restore){
	eval(targ+".location=\''.$u.'&def="+selObj.options[selObj.selectedIndex].value+"\'");
 	if(restore)selObj.selectedIndex=0;}
function goto(g){
	if(g=="sort_table")var aff="k or col number";
	else if(g=="permut")var aff="0/1";
	else if(g=="del_col")var aff="0";	
	else var aff="'.$base.'/'.$prefix.'_'.$table.'_'.$version.'";
	var go=prompt(g,aff);
	if(go!=null && go!="'.$base.'/'.$prefix.'_'.$table.'_'.$version.'" && go!="")
		window.location="'.$u.'&"+g+"="+go;}
function delfile(g){var ok=confirm("'.nms(43).'?"); if(ok)window.location=g;;}
function jumpMenu(n,selObj){
	var add=selObj.form.elements["c"+n].options[selObj.form.elements[\'c\'+n].selectedIndex].value;
	document.getElementById("val"+n).value=add;}
function display_all(k){val=document.getElementById(\'cln\'+k).value;
	document.getElementById(\'cnt\'+k).innerHTML=val;}
function chkall(){var inp=document.getElementsByTagName("input");
	for(i=0;i<inp.length;i++){if(inp[i].type=="checkbox"){
	if(inp[i].checked=="")inp[i].checked="checked"; else inp[i].checked="";}}}');}

#core
function sesm($k,$v=''){return sesr('mu',$k,$v);}

function murl_read($u){
if(substr($u,0,4)=='lang')list($base,$dir,$node)=explode('/',$u);
else list($base,$node)=split_one('/',$u,1);
list($node,$row)=split_one('|',$node,1);
//92,190:no,191,657,msqlink,admin:msqlj:54,ajax:"msql"
list($node,$line)=split_one(':',$node,1);
list($b,$d)=split_one('/',$base,0); 
list($p,$t,$v,$l)=explode('_',$node); $l=$l?$l:$line;
if(!$b){$b=$p; $p='';} if(!$b)$b='users'; if($b=='lang')$d=$dir?$dir:prmb(25);
return array($b,$d,$p,ajx($t),ajx($v),ajx($l));}

function mnod($p,$t,$v){return $p.($t?'_'.$t:'').($v?'_'.$v:'');}
function murl($b,$d,$p,$t,$v){
if($_SESSION['htacc'])return ($b?$b.'/':'').($d?$d.'/':'').mnod($p,$t,$v);
else return '/?msql='.$b.'&dir='.$d.'&msql='.mnod($p,$t,$v);}
function murl_vars($u){list($b,$d,$p,$t,$v,$n)=murl_read($u);
return array($b.($d?'/'.$d:''),mnod($p,$t,$v),$n);}

function murl_build($b,$d,$p,$t,$v){
list($base,$dir,$node,$pr,$tb,$vn)=murl_read(sesm('murl'));
$base=$b?$b:$base; $dir=$d?$d:$dir; 
$prefix=$p?$p:$pr; $table=$t?$t:$tb; $version=$v?$v:$vn;
return murl($base,$dir,$prefix,$table,$version);}

#boot
function msql_boot($msql){$auth=$_SESSION['auth']; $ath=6; $root='msql/';//sesm('root')
$_SESSION['murl']=murl_read($msql);
list($base,$dir,$prefix,$table,$version,$def)=$_SESSION['murl'];
if($def)$_GET['def']=$def; $folder=$base.'/'.($dir?$dir.'/':'');
//echo $base.'-d:'.$dir.'-p:'.$prefix.'-t:'.$table.'-v:'.$version.'-d:'.$def.br();
if($_GET['def'])$def=$_GET['def'];
elseif(is_file(sesm('root').$folder.$prefix.'_'.$table.'_'.$version.'.php'))$_GET['def']=$def;
elseif(is_file(sesm('root').$folder.$prefix.'_'.$table.'.php') && $version){
	$_GET['def']=ajx($version,1); $version='';}
elseif(is_file(sesm('root').$folder.$prefix.'.php') && $table){
	$_GET['def']=$table; $table=''; $version='';}
if($dir && !is_dir($root.$folder)){$folder=$base.'/'; $dir='';}
$files=tables($root.$folder); //pr($files);
$ra[0]=explore($root,'dirs',1); //bases
	if($auth<6){$rdel=array('lang','server','clients','radio','stats','gallery','db');//'system',
		foreach($rdel as $v)unset($ra[0][$v]);}
$ra[1]=$base;//base
if($dir)$ra[2]=explore($root.$base.'/','dirs',1);//dirs
$ra[3]=$dir;//dir
if($files && $base){$ra[4]=array_keys($files);//prefixes
	foreach($ra[4] as $k=>$v)
		if(($base=='users' && $v!='public' && $v!=ses('qb')) or 
			($auth<6 && $v!='public' && $base!='system'))unset($ra[4][$k]);}
$ra[5]=$prefix;
$ra[6]=$files;
	if($files && $auth<=$ath){foreach($files as $k=>$v){
		if($k==$_SESSION['USE'] && $k==$_SESSION['qb'])$filb[$k]=$v;
		elseif($k==$_SESSION['USE'])$filb[$k]=array('public');
		elseif($k=='public')$filb[$k]=$v;} 
	$files=$filb;}
$ra[7]=$table;
$ra[8]=ajx($version,1);
$ra[9]=$folder;
$ra[10]=mnod($ra[5],$ra[7],$ra[8]);
return $ra;}

/*
//structure: root/base/dir/prefix_table_version //b/d/p_t_v
//où b=niveau 0 et d=option root
root: /msql, /msql/db
base: default:users //p
dir: fr/eng, auto with lang
folder:root+base+dir+/
1: prefix
2: table
3: version
nod: prefix+table: nod
node: prefix+table+version: //o
murl: base/dir/prefix_table_version (msql url)
url: ?msql=
lk: url+murl
*/

#ok, go

function lj_goto($d,$n){$lh=sesmk('msqlang');
return ljb('txtx" title="'.$lh[$n][1],'goto',$d,$n?$lh[$n][0]:$d).' ';}

function msql_adm($msql=''){//echo br();
$root=sesm('root','msql/');
$auth=$_SESSION['auth']; $ath=6;//auth_level_mini
$wsz=define_s('wsz',700);
$msql=$msql?$msql:$_GET['msql'];
$_SESSION['page']=$_GET['page']?$_GET['page']:1;
#boot
if($msql && $msql!='='){$url=sesm('url','/msql/');
	$ra=msql_boot($msql); $_SESSION['msql_boot']=$ra;
	list($bases,$base,$dirs,$dir,$prefixes,$prefix,$files,$table,$version,$folder,$node)=$ra;
	//build url
	$murl=sesm('murl',murl($base,$dir,$prefix,$table,$version));//b/d/p_t_v
	$basename=$root.$folder.$node;
	$is_file=is_file($basename.'.php');
	$lk=sesm('lk',$url.$folder.$node.gpage());
	$folder=$root.$folder;//conformity
	msql_adm_head($lk,$base,$prefix,$table,$version);}
$def=ajx($_POST['def']?$_POST['def']:$_GET['def'],1);
if($_GET['see'])$ret[]=verbose($ra,'dirs');
//auth
if($base=='users' && $prefix==$_SESSION['USE'])$_SESSION['ex_atz']=1;
if($auth>=$ath && $_SESSION['ex_atz'] or $auth>=6)$authorized=true;
$lkb=$lk.'&';
#load
//reqp('msql'); $msq=new msql($base,$node); if($is_file)$defs=$msq->load();
if(get('repair'))msql_repair($folder,$node);//old
if($is_file)$defs=read_vars($folder,$node,$defsb);
//if(!$defs)$ret[]=verbose($ra,'');
if($defs['_menus_'])$defsb['_menus_']=$defs['_menus_'];
//save
if($def && !$defs[$def])$_POST['add']=$def;
if(($_POST['def'] or $_POST['add']) && $authorized)
	list($defs,$def)=save_defs($folder,$node,$defs,$def,$base);
//savb
if($_GET['sav'])save_vars($folder,$node.'_sav',$defs,1);
//create
if($_GET['create'] && $authorized){
	$prefix=normaliz_c($_POST['prfx']);
	$table=normaliz_c($_POST['hbname']);
	if($_POST['hbnb'] && $_POST['hbnb']!='version')$version=$_POST['hbnb'];
	if(!$_POST['hbnb'])$version='';
	if(is_numeric($_POST['nbc'])){$defsb['_menus_']='';
		$nbc=$_POST['nbc']; $nbc=$nbc>1?$nbc:1;
		for($i=1;$i<=$nbc;$i++)$defsb['_menus_'][]='col_'.$i;}
	elseif($defs['_menus_'])$defsb['_menus_']=$defs['_menus_'];
	else $defsb['_menus_']=array('');
	$node=mnod($prefix,$table,$version);
	if($folder && $prefix)read_vars($folder,$node,$defsb);
	relod(sesm('url').murl_build('','',$prefix,$table,$version));}
#modifs
//save_modif
$do=find_command(); if($do && $auth>=$ath)
	$defs=msql_modifs($defs,$defsb,$folder,$prefix.'_'.$table,$node,$basename,$do);

#render
$lh=sesmk('msqlang');
	#-menus
	if(!$_GET['def'])$ret['menus']=msql_menus($ra);//auth(3) && 
if(!$_GET['def']){//called
	#-files
	//add
	if(auth(4))$ret['fls']=lkc('txtblc',$lkb.'new==',pictxt('add',$lh[9][0])).' ';
	if($table && $authorized && $prefix && $is_file){//$defs && 
		$ret['fls'].=lkc('txtx',$lkb.'sav==',$lh[2][0]);
		if(is_file($basename.'_sav.php'))
			$ret['fls'].=lkc('txtx',$lkb.'restore==',$lh[3][0]).' ';
		$ret['fls'].=lj_goto('import_defs',5);
		//$ret['fls'].=lj_goto('import_old','');
		$ret['fls'].=lj_goto('import_keys',17);
		$ret['fls'].=lj_goto('merge_defs',6);
		$ret['fls'].=lj_goto('append_update',7);
		$ret['fls'].=lj_goto('append_values',8);}
	else $ret['fls'].=$bckp;
	if($files[$prefix] && ($auth>$ath or $prefix==$_SESSION['USE']))
	if($auth>=$ath && $table && $prefix && $is_file){
		$ret['fls'].=lkc('txtx',$lkb.'del_table==',$lh[10][0]).' ';
		$ret['fls'].=ljb('txtblc','delfile',$lkb.'del_file==',$lh[11][0]).' ';
		//$ret['fls'].=lkc('txtyl',$lkb.'del_file==',$lh[11][0]).' ';
		if(!$defs or isset($defs[0]))$ret['fls'].=lkc('txtyl',$lkb.'repair==',$lh[12][0]).' ';}
	if($ret['fls'])$ret['fls'].=br();
	//$ret['fls']=divc('menu',$ret['fls']);
	//new
	if($_GET['new'])$ret['fls'].=newbase($base,$prefix,$table,$version);
	#-util
	if($table && $authorized && $prefix && $is_file){
		$ret['utl'].=lkc('txtblc',$lkb.'def=_menus_',$lh[1][0]).' ';
		$ret['utl'].=lkc('txtx',$lkb.'reset_menus==',$lh[22][0]).' ';
		$ret['utl'].=lkc('txtx',$lkb.'del_menus==',$lh[23][0]).' ';
		$ret['utl'].=lkc('txtx',$lkb.'add_keys==',$lh[24][0]).' ';
		$ret['utl'].=lkc('txtx',$lkb.'del_keys==',$lh[25][0]).' ';
		$ret['utl'].=lkc('txtx',$lkb.'def=_menus_&add_col==',$lh[14][0]).' ';
		$ret['utl'].=lj_goto('del_col',15);
		if($is_file)$ret['utl'].=lkc('txtx" title="'.$lh[13][1],$lkb.'repair_cols==',$lh[13][0]).' ';
		if($base!='system' && is_file(sesm('root').'system/'.$node.'.php'))
			$ret['utl'].=lkc('txtblc',$lkb.'update==',$lh[26][0]).' ';
		$ret['utl'].=lj_goto('sort_table',19);
		if($table!='restrictions' && $table!='params')
			$ret['utl'].=lkc('txtx',$lkb.'reorder==',$lh[20][0]).' ';
		$ret['utl'].=lj_goto('permut',21);
		$ret['utl'].=lkc('txtx',$lkb.'edit_conn==',$lh[16][0]).' ';
		$ret['utl'].=lkc('txtx" title="'.$lh[6][1],$lkb.'inject_defs==',$lh[18][0]).' ';
		$ret['utl'].=lkc('txtx',$lkb.'edit_csv==','csv').' ';
		$ret['utl'].=lj('txtx','popup_msql___lang_helps_msql','?');
	}
	#-fieldset
	if($ret['fls'].$ret['utl'])
		$ret['utils']=divc('menu',$ret['fls'].$ret['utl']); $ret['fls']=$ret['utl']='';
	//if($ret['nfo'])$ret['nfo'].=br();
}//called
#-infos
if($table && $is_file){
	$ret['nfo']=lkc('popsav',$lk,$murl).' ';
	$wurl=$_SERVER['HTTP_HOST'].'/msql/'.$murl;
	$ret['nfo'].=lj('popbt','popup_text___'.ajx($wurl).'_weburl_console',pictit('link','web url'));
	$wcon='['.$murl.$kdef.($def?':'.$def:'').':microsql]';
	$ret['nfo'].=lj('popbt','popup_text___'.ajx($wcon).'_connector_console',pictit('conn','connector'));
	$ret['nfo'].=lkt('popbt','/plug/microxml.php?table='.$murl,pictit('rss','xml')).' - ';
	$ret['nfo'].=btn('txtsmall2',count($defs).' '.plurial(count($defs),116)).' - ';
	if($is_file)$ret['nfo'].=btn('txtsmall2',fsize($basename.'.php')).' - ';
	$ret['nfo'].=btn('txtsmall2',ftime($basename.'.php')).' ';
	$ret['nfo'].=msq_search($murl);}
if($ret['nfo'])$ret['nfo']=divc('menu',$ret['nfo']);

//entries
//if($defs)$ret['edt'].=slctmenuder($defs,$def?$def:'_menus_');
//add
if($is_file && $authorized && !$_GET['called'] && $defs && !$_GET['def'])
	$ret['edt'].=divc('menu',f_inp_add($defs,$defsb,$def)).br();
//edit
//echo verbose($ra,'');
if($def && $defs[$def])$ret['edt'].=f_inp_m($defs,$defsb['_menus_'],$def);
//edit_conn
if($_GET['edit_conn']=='='){
	if($defs)foreach($defs as $k=>$v){
		$v=str_replace(array('|','¬'),array(':BAR:',':LINE:'),$v);
		$edittable.=implode('|',$v).'¬'."\n";}//(!is_numeric($k)?$k.'|':'')
	$ret[]=divc('','paste a table as created by transductor from html table :: use "|" for cells and "¬" for lines of cells').form($lkb.'def='.$def,txarea('import_conn',$edittable,60,14).br().checkbox('aid','ok','auto_increment','1').input2('submit','save','import','txtbox')).hr().br();}
//array
if($_GET['inject_defs']=='='){
	$datas=str_replace(array('<'.'?php','?'.'>'),'',read_file($basename.'.php'));
	$ret[]=divc('','paste $r[1]=array(1,2,3)').form($lkb,txarea('inject_defs',$datas,60,14).br().input2('submit','replace','replace','txtbox').input2('submit','inject','inject','txtbox').checkbox('mono','1','key=>value','').checkbox('sql','1','mysql','')).hr().br();}

//csv
if($_GET['edit_csv']=='='){
	foreach($defs as $k=>$v)if($v)$edittable.=(is_array($v)?implode(',',$v):$v)."\n";
	$ret[]=divc('','paste csv using "," for cells and lines for rows').form($lkb.'def='.$def,txarea('edit_csv',$edittable,60,14).br().checkbox('aid','ok','auto_increment','1').input2('submit','save','import','txtbox')).hr().br();}

//see_table
if($defs && !$_GET['def']){// && (!$def or $_POST['save'])//called
$out=divd('editmsql',draw_table($defs,$murl,''));
if($auth>4)$out=form($lkb.'del_multi==&page='.ses('page'),$out.input2('submit','del',nms(76),''));
$ret[]=$out.br();}
else $ret[]=divd('editmsql','');

if($auth>6)$ret[]=lkc('txtx',$lkb.'backup_msql==','backup').' ';
	if($_GET['backup_msql'])$ret[]=backup_msql();
return divd('content',implode('',$ret));}//end msql_adm

?>