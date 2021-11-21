<?php
//philum_microsql_admin

function gpage($p=''){return $p?'&page='.($p?$p:$_SESSION['page']):'';}

//msql_menu
function msql_menu($r,$type,$slct,$url){$r=explode(' ',$r);
foreach($r as $k=>$v){if($v)$ret.=lkc($v==$slct?'txtnoir':'txtx',$url.$v,$v).br();}
return $ret;}

function msqm_lnk($r,$nurl,$vf,$cs1,$cs2,$kv){
$nurl=str_replace('/msql/','',$nurl); $ret='';
foreach($r as $k=>$v){
	if($kv=='k')$v=$k; elseif($kv=='v')$k=$v;
	$lk=str_replace('#',$k,$nurl); $cs=$vf==$k?$cs1:$cs2; 
	if($k==$_SESSION['qb'] && $vf!=$k)$cs='txtblc';
	if($v=='lang' && strpos($lk,'lang')!==false)$lk=str_replace('lang','lang/'.prmb(25),$lk);
	//if($v)$ret.=lkc($cs,$lk,$v).' ';
	if($v)$ret.=lj($cs,'msqdiv_msqladm___'.ajx($lk),$v).' ';}
return $ret;}

function msql_slct($id,$k,$murl){
return select_j($id.$k,'msqlc','',$murl,'','2');}

function msql_menus($ra){
//$b=$base.'/'; if($dir)$d=$dir.'/'; $p=$hub; $t='_'.$table; $tb=$table.'_'.$ver;
list($bases,$base,$dirs,$dir,$hubs,$hub,$files,$table,$ver,$folder)=$ra;
$rb=$files[$hub]??''; $rc=$rb[$table]??''; $url=sesm('url'); $ret='';
$b=$base.'/'; $d=$dir?$dir.'/':''; $p=$hub; $t='_'.$table; $tb=$table.'_'.$ver;
if(is_array($bases)){asort($bases); $nurl=$url.'#/'.$d.$p.$t;//base
	$rt['base']=msqm_lnk($bases,$nurl,$base,'txtnoir','txtx','k');}
if(is_array($dirs)){asort($dirs); $nurl=$url.$b.'#/'.$p.$t;//dir
	$rt['directory']=msqm_lnk($dirs,$nurl,$dir,'txtnoir','txtx','k');}
if($hubs){asort($hubs); $nurl=$url.$b.$d.'#'.$t;//hub
	$rt['hub']=msqm_lnk($hubs,$nurl,$hub,'txtnoir','txtx','v');}
if($rb){ksort($rb); $nurl=$url.$b.$d.$p.'_#';//table
	$rt['table']=msqm_lnk($rb,$nurl,$table,'txtnoir','txtx','k');}
if(is_array($rc)){//version
	foreach($rc as $k=>$v)$rs[$v]=strprm($v,1,'_'); ksort($rs);
	$nurl=$url.$b.$d.$p.'_#'; $bt=msqm_lnk($rs,$nurl,$tb,'txtnoir','txtx','');
	if($bt)$rt['version']=$bt;}
$s='display:table-cell; padding:5px; margin:5px; background:#ddd; border:1px solid #ccc;';
foreach($rt as $k=>$v)$ret.=divc('cell',$v);
return divc('table',$ret).divc('clear','');}

function msql_menus_j($ra){$top='d';//rstr(69)?'':'d';
list($b,$d,$p,$t,$ver,$def)=$_SESSION['murl']; $ret='';
$bdr=$d?'/'.$d:''; $tn=$t; if($ver)$tn.='_'.$ver;
$ret.=popbub('admsq','',picto('msql'),$top,1);
if($d)$ret.=popbub('admsq',$b.$bdr,$d,$top,1);
else $ret.=popbub('admsq',$b.$bdr,$b,$top,1);
if($p)$ret.=popbub('admsq',$b.$bdr.'/'.$p,$p,$top,1);
if($t)$ret.=popbub('admsq',$b.$bdr.'/'.$p.'/'.$t,$tn,$top,1);
return $ret;}

#nav
function normaliz($v){$v=normalize($v);
return str_replace(['-','_'],'',$v);}

function prevnext($r,$d){$lk=sesm('lk'); $r=msql::prevnext($r,$d);
return lkc('txtblc',$lk.'&def='.$r[0],'prev').' '.lkc('txtblc',$lk.'&def='.$r[1],'next');}

function msql_search($murl){list($dr,$nd,$vn)=murl_vars($murl);
$ret=autoclic('msqsr','',10,100,'search',1).' ';
$ret.=lj('popbt','editmsql_msqlfind___'.ajx($dr).'_'.ajx($nd).'___msqsr',nms(24));
return $ret;}

function msql_find($dr,$nd,$o,$sr){$r=msql::read_b($dr,$nd,'',1); $sr=ajxg($sr); 
if(!is_array($r) or !$sr)return;
foreach($r as $k=>$v)if(strpos($k,$sr)!==false)$ret[$k]=$v;
	else foreach($v as $ka=>$va)if(strpos($va,$sr)!==false)$ret[$k]=$v;
return !$ret?'no result':draw_table($ret,sesm('murl'),'');}

#draw 
function tables($base){$r=explore($base,'files',1);
if($r){foreach($r as $k=>$v){$v=substr($v,0,-4);
list($nd,$bs,$sv,$op)=opt($v,'_',4); if(!$nd)$nd='root';
if($nd && $sv!='sav' && $op!='sav')$ret[$nd][$bs][$sv]=$bs.($sv?'_'.$sv:'');}
return $ret;}}

function displaydata($d,$o=''){$d=stripslashes_b($d);
if(strpos($d,'<')!==false or strpos($d,'>')!==false)$d=entities($d);//$d=htmlentities_b($d);
if($o)$d=nl2br($d); return $d;}

function cutat($d){$r=explode(' ',$d); $n=count($r); $ret=''; $dot=''; $nb=0;
for($i=0;$i<$n;$i++){$nb+=strlen($r[$i]); if($nb<256)$ret.=$r[$i].' ';}
if($nb>=256)$dot=' (...)'; return $ret.$dot;}

function tabler_bypage($r,$csa,$csb,$murl){$td=''; $tr='';
if(isset($r['_menus_'])){foreach($r['_menus_'] as $k=>$v)$td.=balc('th',$csa,$v);
	$tr=balc('tr','',$td); unset($r['_menus_']);}
$n=count($r)+1; $page=$_SESSION['page']; $npg=500;
req('spe'); //$ret=nb_page($n,$npg,$page,'');
$ret=btpages($npg,$page,$n,'msqdiv_msqladm___'.ajx($murl).'_');//!
$min=($page-1)*$npg; $max=$page*$npg; $i=0;
if(is_array($r))foreach($r as $k=>$v){$td=''; $i++;
	if($i>=$min && $i<$max && is_array($v))
		foreach($v as $ka=>$va)$td.=balc('td',$csb,$va);
	if($td)$tr.=balc('tr','',$td);}
return divd('msqpg',$ret.balc('table','',$tr).$ret);}

function draw_table($r,$murl,$adm=''){//adm=saving
list($dr,$nd,$n)=murl_vars($murl); $jurl=ajx($murl); $def=get('def'); $i=0;
if($r)foreach($r as $k=>$v){$ra=[]; $i++;
	if(is_array($v))foreach($v as $ka=>$va)$ra[]=displaydata(cutat($va),1);
	$css=$k==$def?'popsav':'popbt';
	$open=lj($css,'popup_editmsql___'.$jurl.'_'.ajx($k),$k);
	//$edit=lk(sesm('url').$murl.':'.($k).gpage(),picto('editor'));
	if(auth(6))$del=lj('popdel','editmsql_delmsql___'.$jurl.'_'.$k,pictit('del',nms(76))).' ';
	if($k=='_menus_' && $ra){
		foreach($ra as $ka=>$va)$ra[$ka]=lk(sesm('url').$murl.'&sort='.$ka,$ka.':'.$va);
		array_unshift($ra,lk(sesm('url').$murl.'&sort=k','keys'));}
	elseif(is_array($ra))if(auth(4)){if(get('del'))$open=$del.$open;
		foreach($ra as $ka=>$va){$rid=normalize('msqedt'.$k.'-'.$ka);
			$ra[$ka]=divd($rid,medit_shot_bt(trim($va),$k,$ka,$murl,$rid));}
		array_unshift($ra,$open);}
	else array_unshift($ra,$k);
	$datas[$k]=$ra;}
return tabler_bypage($datas,'popw','',$murl);}

#sav
function node_decompil($d){
$r=split_right('/',$d,1);
if(!$r[0])$r[0]='users';
return $r;}

function edit_msql_sav($id,$rg,$res){$_GET['msql']=$id;
list($dir,$node)=node_decompil($id); $r=ajxr($res); $rk=array_shift($r);
if($rk!=$rg && substr($rg,0,1)!='@'){msql::modif($dir,$node,$rg,'mdfk',$rk); $rg=$rk;}
return msql::modif($dir,$node,$r,$rg);}

function edit_msql_del($id,$va){//delmsql
list($dir,$node)=node_decompil($id);
$r=msql::modif($dir,$node,$va,'del');
return edit_microsql($id,$r);}

function edit_msql_displace($id,$va,$res){$to=ajxg($res);
list($dir,$node)=node_decompil($id); $_GET['def']=$va;
$r=msql::read($dir,$node);
$r=msql::displace($r,$va,$to);
$r=msql::modif($dir,$node,$r,'arr');
return edit_microsql($id,$r);}

function edit_microsql($nod,$r=''){
list($dir,$node)=node_decompil($nod);
$defs=$r?$r:msql::read_b($dir,$node,'');
if($defs)return draw_table($defs,$nod,1);}

/*function msq_slct_displace($dr,$nod){
$r=msql::read_b($dr,$nod);
foreach($r as $k=>$v)
return $ret;}*/

function medit_ksav($murl,$key,$res=''){$rid=normalize($murl);
if($res){list($dr,$nod)=node_decompil($murl); $d=ajxg($res); $r=msql::read_b($dr,$nod);
foreach($r as $k=>$v)if($k==$key)$ret[$d]=$v; else $ret[$k]=$v; msql::save($dr,$nod,$ret);}
$mx=strlen($key)>24?24:strlen($key); $ret=input1($rid,$d?$d:$key,$mx);
$ret.=lj('small','edt'.$rid.'_call___msql_medit*ksav_'.ajx($murl).'_'.$key.'_'.$rid,'ok');
return divd('edt'.$rid,$ret);}

#msqledit
function medit_shot($murl,$k,$ka,$res){$v=ajxg($res); $rid=randid('mdt');
list($dr,$nd,$n)=murl_vars($murl); $id=normalize('msqedt'.$k.'-'.$ka);
$v=msql::val($dr,$nd,$k,$ka); $va=displaydata($v); if($va==='')$va='-';
$j=ajx($murl).'_'.ajx($k).'_'.ajx($ka).'_'.$id.'_'.$rid; //$va=deln($va); 
$va=nl2br($va);
return divarea($rid,'','',sj($id.'_msqlmodif___'.$j),$va,1);
//return divarea('','','',sj($id.'_msqlmodif___'.$j),$va,1);
//return input1($rid,$va).lj('popbt',ajx($k.'-'.$ka).'_msqlmodif__x_'.$j,'save');
return assistant($rid,'SaveJ',$id.'_msqlmodif___'.$j,$va,'');}

function medit_shot_bt($va,$k,$ka,$murl,$rid){//randid().
if(!trim($va)==='')$va='-'; $j=ajx($murl).'_'.ajx($k).'_'.ajx($ka).'_'.$rid;//.$id
//return divarea($rid,'','',sj($rid.'_msqlmodif___'.$j),$va,1);
//return togbub('msqledit',$j,$va);
return '<a onclick="'.sj($rid.'_msqledit___'.$j).'">'.($va).'</a>';}

function editmsql_defcons(){return 'line:1|line:last|line:title|del:|linewith:|boldline:1|linenolink:1|del-link:|striplink:|delconn:s|replconn-pre-q|deltables|delqmark|delblocks|cleanmail|since:|to:|-??|???';}

function codearea($k,$v){$n=40; $h=20; $s=ceil(strlen($v)/$n); if($s>5)$s=5;
if(strpos($v,'<')!==false)$v=htmlentities_b($v);
$p='style="height:'.(($s?$s:1)*$h).'px;" onkeyup="goodheight(this,'.($n).','.$h.');"';
return textarea($k,$v,$n,'1',$p);}

function editmsql($nod,$va,$o,$ob){
$qb=$_SESSION['qb']; $tg=$ob?'socket':'editmsql'; $rid=randid();
list($dir,$node)=node_decompil($nod); $nodb=ajx($nod); $pn=''; $rc=[]; $kb='';
$r=msql::read_b($dir,$node); $h=isset($r['_menus_'])?1:0; if($r)$rh=$h?$r['_menus_']:current($r);
if($r)$nxtk=msql::nextentry($r); $idn=randid();
if($va=='add'){$u=$o; $o=domain(strtolower($u));
	$va=$o?$o:findnextkey($r,0); $ry=array_fill(0,count($rh),'');
	if(is_array($rh))$ra[$va]=array_combine($rh,$ry); else $ra[$va]=$ry; if(!isset($r[$va]))$r=$ra;
	$rw=conv::recognize_defcon($u); //pr($rw);
	$ti='text start'; if(isset($r[$va][$ti]))$r[$va][$ti]=$rw[0]?$rw[0]:'entry-content::';
	$ti='title start'; if(isset($r[$va][$ti]))$r[$va][$ti]=$rw[2]?$rw[2]:'::h1';}
if($rh)$ntkp=1; else $ntkp=0; $i=0; $key=''; $def='';
if($r){foreach($r as $k=>$v){$i++; if($k==$va){$n=$i; $key=$k; $def=$v;}
	if(!$key){$key=$va; $n=$i+1; $def='';}}
	$keys=array_keys($r); $kyb=ajx($key); $na=$n-$ntkp;
	if(isset($keys[$na-1]) && $keys[$na-1]!='_menus_')$kt=$keys[$na-1]; else $kt=$keys[$na];
		$pn.=lj('txtx','popup_editmsql__x_'.$nodb.'_'.ajx($kt),picto('before')); 
	if(isset($keys[$na+1]))$kt=$keys[$na+1]; else $kt=$keys[$na];
		$pn.=lj('txtx','popup_editmsql__x_'.$nodb.'_'.ajx($kt),picto('after'));}
if(isset($ra))$r=$r[$va]; elseif($key)$r=msql::read_b($dir,$node,$key);
if(is_array($r)){$i=0; $kys[]='k'.$rid;//keys to shift from array
	foreach($r as $k=>$v){$kb=normaliz($idn.$k); $kys[]=$kb; $i++;
		if(substr($node,-7)=='defcons'){$rhk=$rh[$k]??'';
			if($rhk=='post-treat')$opt=br().jump_btns($kb,editmsql_defcons(),'|'); else $opt=''; 
			if($rhk=='last-update')$v=date('ymdhi',time());}
		else $opt=msql_slct($idn,$k,$dir.'/'.$node.':'.($i-1));//slct
		if(!is_array($v)){$t=isset($rh[$i-1])&&$h?$rh[$i-1]:$k;
			$rc[$t]=codearea($kb,displaydata($v)).$opt;}}
	$keys=ajx(implode('|',$kys));}//
elseif($kb){$keys=$kb; $opt=msql_slct($idn,$k,$dir.'/'.$node.'-0');
	$rc[$va-$ntkp]=codearea($keys,$def).$opt; $keys=ajx($keys);}
else{$kb=randid('k'); $rc[1]=codearea($kb,''); $keys='k'.$rid.'|'.$kb;}//new
//$ret=medit_ksav($nod,$key,$res);
$ret=input1('k'.$rid,$key,strlen($key));
$ret.=on2cols($rc,470,5);//render
if(substr($nod,0,4)=='lang'){$lg=strprm($nod,1,'/'); if($lg=='fr')$lg='en'; else $lg='fr';
$bt=lj('popbt','popup_editmsql___lang/'.$lg.'/helps*txts_'.ajx($va),$lg);}
if(auth(4)){
	$jx=$nodb.'_'.$kyb.'_'.$ob.'__'.$keys;//edit_msql_sav
	$bt=lj('popsav',$tg.'_savmsql__x_'.$jx,nms(57)).' ';//sav
	$bt.=lj('popbt',$tg.'_savmsql___'.$jx,nms(66)).' ';//apply
	//$bt.=lj('popbt',$tg.'_savmsql__x_'.$nodb.'_'.$nxtk.'___'.$keys,nms(44)).' ';//new
	$bt.=lj('popbt',$tg.'_savmsql__x_'.$nodb.'_@'.$kyb.'___'.$keys,nms(44)).' ';//new
	$bt.=$pn.' ';//prevnext
	if(strpos($nod,'_defcons'))$bt.=lj('popbt',$idn.'0,'.$idn.'1,'.$idn.'2,'.$idn.'3_conv,recognize*defcon___'.ajx($o),nms(195));//suggestions
	$bt.=select_j('pos'.$rid,'msql',$key,$nod,'');//displace
	$bt.=lj('popbt',$tg.'_dismsql___'.$nodb.'_'.ajx($key).'___pos'.$rid,nms(158)).' ';
	$bt.=lj('popdel',$tg.'_delmsql___'.$nodb.'_'.$kyb,pictit('del',nms(76))).' ';}//del
$bt.=msqbt($dir,$node);
$ret=divs('padding-bottom:4px',btd('bts','').$bt).$ret;
return $ret;
return popup($dir.'/'.$node.'§'.$key,$ret,550);}

#operations
function create_table($p){
list($dr,$nod)=node_decompil($p);
list($hub,$table,$version)=opt($nod,'_',3);
$hub=$hub?$hub:'hub';
$table=$table?$table:'table';
$idt=msql::findlast($dr,$hub,$table);
$ret=input1('dir',$dr,8);
if(auth(5))$ret.=input1('hub',$hub,8);
elseif($hub!=$_SESSION['USE'])return btn('txtyl','forbidden');
else $ret.=hidden('prfx',$hub);
$ret.=input1('nod',$table,8);
$ret.=input1('ver',$idt,4).' ';
$ret.=lj('','editmsql_msqlops__url_'.ajx($p).'_create*table___dir|hub|nod|ver',picto('ok'));
return $ret;}

function msql_ops($p,$md,$res='',$o=''){
if($o)return msql_opsup($p,$md,$res);//intercept action
list($dr,$nod)=node_decompil($p);
if(strpos($res,'_'))$d=ajxr($res); else $d=ajxg($res);
$r=msql_tools($dr,$nod,$md,$d);
if($md=='create_table'||$md=='del_file'||$md=='del_backup'||$md=='rename_table'||$md=='duplicate_table')return $r;//reload
return edit_microsql($p,$r);}

function msql_opsup($p,$md,$res=''){
if($md=='sort_table')$d='k or col number';
elseif($md=='permut')$d='0/1';
elseif($md=='del_col')$d='0';
else $d=$p;
if($md=='export_csv'){list($dr,$nod)=node_decompil($p); $r=msql::read($dr,$nod); return csvfile($nod,$r,$nod,1);}
$ret=input1('msqop',$d,32);
$rl=$md=='rename_table'||$md=='duplicate_table'?'url':'x';
$ret.=lj('','editmsql_msqlops__'.$rl.'_'.ajx($p).'_'.ajx($md).'_'.$res.'__msqop',picto('ok'));
return $ret;}

function msq_dump_a($r,$p){$ret=''; if($r)foreach($r as $k=>$v){$re=[];
if($v)foreach($v as $ka=>$va)$re[]="'".addslashes(stripslashes($va))."'";
$ret.='$r['.(is_numeric($k)?$k:'"'.$k.'"').']=['.implode(',',$re).'];'."\n";}
return "<?php //philum/microsql/$p\n$ret";}

//edit
function msql_editors($p,$md){
list($dr,$nod)=node_decompil($p);
$r=msql::read($dr,$nod); if(!$r)return;
if($md=='inject_defs')$d=str_replace('<?php ','',msq_dump_a($r,$nod));
if($md=='inject_defs2')$d=str_replace('<?php ','',msql::dump($r,$nod));
if($md=='import_conn')$d=msqdt_conn($r);//use "|" for cells and "¬" for lines
if($md=='import_csv')$d=msqdt_csv($r);
if($md=='import_json')$d=msqdt_json($r);
$ret=textarea($md,$d,60,10);
$ret.=lj('','editmsql_msqlops___'.ajx($p).'_'.ajx($md).'___'.ajx($md),picto('ok'));
return $ret;}

//msqlops
function msql_tools($dr,$nod,$md,$d){
$r=msql::read($dr,$nod); $ok='';
switch($md){
case('create_table'):list($dr,$nod,$r)=create_table_sav($d); $rl=1; break;
case('backup'):$r=msql::save($dr,$nod.'_sav',$r); $ok=1; break;
case('restore'):$r=msql::read_b($dr,$nod.'_sav'); break;
case('add_row'):$r[]=array_fill(0,count(current($r)),''); break;
case('del_menus'):unset($r['_menus_']); break;
case('del_file'):msql::save($dr,$nod.'_sav',$r); del_table($dr,$nod); $ok=1; $rl=1; break;
case('trunc_table'):$ra['_menus_']=$r['_menus_']??''; $r=$ra; break;
case('append_update'):$r=append_update($r,$d); break;
case('import_defs'):$r=import_defs('',$d); break;
case('import_keys'):$r=import_keys($r,$d); break;
case('merge_defs'):$r=merge_defs($r,$d); break;
case('permut'):$r=permut($r,$d); break;
case('reset_menus'):$r=reset_menus($r); break;
case('add_col'):$r=add_col($r); break;
case('del_col'):$r=del_col($r,$d); break;
case('repair_cols'):$r=repair_cols($r); break;
case('repair_enc'):$r=utf_r($r); break;
case('renove'):$r=import_defs('','philum.fr/msql/'.$dr.'/'.$nod); break;
case('sort'):$r=sort_table($r,$d,1); $ok=1; break;
case('sort_table'):$r=sort_table($r,$d); break;
case('append_values'):$r=append_values($r,$d); break;
case('del_multi'):$r=del_multi($r); break;
case('reorder'):$r=reorder($r); break;
case('add_keys'):$r=add_keys($r); break;
case('del_keys'):$r=del_keys($r); break;
case('import_conn'):$r=import_conn($r,$d,$aid=''); break;
case('inject_defs'):$r=inject_defs($r,$d); break;
case('inject_defs2'):$r=inject_defs($r,$d); break;
case('import_csv'):$r=import_csv($r,$d); break;
case('compare'):$r=msql_compare($r,$d); $ok=1; break;
case('intersect'):$r=msql_intersect($dr.'/'.$nod,$d); $ok=1; break;
case('connexions'):$r=msql_connexions($dr.'/'.$nod,$d); $ok=1; break;
case('import_json'):$r=import_json($d); break;
case('import_jsonlk'):$r=import_json($d); break;
case('rename_table'):list($dr,$nod)=op_table($dr,$nod,$d,0); $ok=1; $rl=1; break;
case('duplicate_table'):list($dr,$nod)=op_table($dr,$nod,$d,1); $ok=1; $rl=1; break;
case('del_backup'):del_table($dr,$nod,1); break;
case('update'):$r=update_table($nod,$r); break;
case('repair'):$r=repair($r,$dr,$nod); $ok=1; break;}
if(!$ok && $r)$r=msql::save($dr,$nod,$r);
if(isset($rl))return 'msql/'.$dr.'/'.$nod;
return $r;}

//import
function msqdt_export_mysql($r,$p){$ok=plugin_func('mysql','import_msql',$r,$p);
return divc('txtalert','create table '.$node.': '.$ok);}
function msqdt_mysql($r){$ret=''; if($r)foreach($r as $k=>$v)if($v)$ret.='"'.$k.'":'.(is_array($v)?'["'.implode('","',$v).'"]':'"'.htmlentities($v[0])).'",'; return $ret;}
function msqdt_json($r){$ret=''; if($r)foreach($r as $k=>$v)if($v)$ret.='"'.$k.'":'.(is_array($v)?'["'.implode('","',$v).'"]':'"'.htmlentities($v[0])).'",'; return '{'.$ret.'}';}
function msqdt_csv($r){$rc=[]; //return array2csv($r);//import_csv
if($r)foreach($r as $k=>$v){$rb=[$k];
	foreach($v as $ka=>$va)$rb[]=str_replace([';',"\n"],[',','<br/>'],$va);
	$rc[]=implode(';',$rb);}
return implode("\n",$rc);}
function msqdt_conn($r){$ret=''; if($r)foreach($r as $k=>$v)$ret.=$k.'|'.implode('|',str_replace(['|','¬'],[':BAR:',':LINE:'],$v)).'¬'."\n"; return $ret;}

#modif apps
function create_table_sav($r){if(!auth(6))return;
list($dir,$lang)=opt($r[0],'/'); $dir=normaliz($dir); if($lang)$dir.='/'.$lang;
$hub=normaliz($r[1]); $table=normaliz($r[2]);
if($r[3] && $r[3]!='version')$version=$r[3]; if(!$r[3])$version='';
$rb=auto_cols(1); $node=mnod($hub,$table,$version);
return [$dir,$node,$rb];}

function auto_cols($n){$r['_menus_']=[];
for($i=1;$i<=$n;$i++)$r['_menus_'][]='col_'.$i;
return $r;}

function del_multi($defs){
foreach($defs as $k=>$v){$g=$_POST['c'.$k]; if(!$g)$ret[$k]=$v;}
return $ret;}

function import_defs($defsb,$d){
if(strpos($d,'msql/')!==false){reqp('microxml'); return mx_call($d);}
else{list($a,$b)=split_one('/',$d,1);
//return msql::read_b($a,$b,$defsb);//??
return msql::read($a,$b,'','',$defsb);}}

function import_json($d){
if(substr($d,0,4)=='http')$d=get_file($d);
$r=json_decode($d,true);
if(isset($r[0])){$rh['_menus_']=$r[0]; unset($r[0]); $r=$rh+$r;}
if(isset($r['_'])){$rh['_menus_']=$r['_']; unset($r['_']); $r=$rh+$r;}
return utf_r($r,1);}

function op_table($dr,$nd,$d,$o=0){
$u=msql::url($dr,$nd); list($dr,$nd)=split_right('/',$d,1); $ub=msql::url($dr,$nd);
if($o)copy($u,$ub); else rename($u,$ub);
return [$dr,$nd];}

function del_table($dr,$nd,$o=0){
$u=msql::url($dr,$nd,$o); unlink($u);}

function import_keys($r,$d){
list($a,$b)=split_one('/',$d,1); $rb=msql::read_b($a,$b);
if($rb['_menus_'])$r['_menus_']=$rb['_menus_']; return $r;}

function merge_defs($r,$d){
list($a,$b)=split_one('/',$d,1); $rb=msql::read_b($a,$b,'',1);
return array_merge_b($r,$rb);}

function append_values($r,$d){
list($a,$b)=split_one('/',$d,1); $rb=msql::read_b($a,$b); return array_append($r,$rb);}

function reset_menus($r){
if($r){reset($r); $first=key($r);}
if($first=='_menus_'){next($r); $first=key($r);}
$nb=count($r[$first]);
for($i=0;$i<$nb;$i++){$ret['_menus_'][]='val'.$i;}
if($ret && $r)return $ret+$r;
else return $r;}

function permut($r,$mu){list($a,$b)=explode('/',$mu);
if($a!==false && $b!==false && $r){
foreach($r as $k=>$v){$obj=$v[$a]; $v[$a]=$v[$b]; $v[$b]=$obj; $ret[$k]=$v;}}
return $ret;}

function add_col($r){
if(!isset($r['_menus_']))$r['_menus_']=msql::menus($r);
foreach($r as $k=>$v){$v[]=$k=='_menus_'?'col'.(count($v)+1):''; $ret[$k]=$v;}
return $ret;}

function del_col($r,$n){$col=$n; 
foreach($r as $k=>$v){if($n=='=')$col=count($v)-1; unset($v[$col]); $ret[$k]=$v;}
return $ret;}

function sort_table($r,$n,$y=''){$y=$y?yesnoses('sort'):'';
$ret['_menus_']=$r['_menus_']; unset($r['_menus_']);
if(is_numeric($n) or !$n){foreach($r as $k=>$v)$re[$k]=$v[$n]; $y?arsort($re):asort($re);
	foreach($re as $k=>$v)$ret[$k]=$r[$k];}
else{$y?krsort($r):ksort($r); $ret+=$r;}
return $ret;}

function repair_cols($r){
$rm=$r['_menus_']??[]; $n=1; $ret=[]; if(isset($rm))$n=count($rm);
else{foreach($r as $k=>$v)$n=count($v)>$n?count($v):$n; $ret['_menus_']=array_pad([],$n,'');}
foreach($r as $k=>$v)for($i=0;$i<$n;$i++)$ret[$k][]=$v[$i]??'';
return $ret;}

function repair($r,$dr,$nod){
if(!$r)msql_repair($dr,$nod);
else foreach($r as $k=>$v){
	if(!is_array($v))$v=array($v);
	if($k && $v[0])$rb[$k]=$v;}
if(isset($rb[0]) && array_sum(array_keys($rb))>0)$rb=msql::reorder($rb);
if(isset($rb))return $rb;}

function msql_repair($dr,$nod){$f=msql::url($dr,$nod); if(!is_file($f))return;
require($f); if(isset($$nod))return msql::save($dr,$nod,$$nod);
$d=read_file($f); if(strpos($d,'<?php')===false)write_file($f,'<?php'.substr($d,2));
require($f); if(isset($r))return $r;}

function msql_compare($ra,$d){
$rh=$ra['_menus_']; $n=1;
if(isset($ra['_menus_']))unset($ra['_menus_']);
list($b,$d)=explode('/',$d);
$rb=msql_read($b,$d,'','1');
//if(is_array(current($ra)))
$ra=array_keys_r($ra,$n);
//if(is_array(current($rb)))
$rb=array_keys_r($rb,$n);
if($ra && $rb){$r1=array_diff($ra,$rb); $r2=array_diff($rb,$ra); $r3=array_intersect($ra,$rb);}
eco($r1); eco($r2); eco($r3);
if($r1)foreach($r1 as $v)$ret[]=[$v]; $ret[]=$rh;
if($r2)foreach($r2 as $v)$ret[]=[$v];
//echo tabler($ret);
//echo div('',array_conn($r1));
return $ret;}

function msq_intersect($r){$ra=[]; $rb=[]; $rc=[]; $re=[]; $rt=[]; $rtb=[];
foreach($r as $k=>$v){[$dr,$nod]=split_right('/',$v,1); $r0=msql::read($dr,$nod,'',1);
	if($r0){$ra[$k]=array_column($r0,0); $re=array_merge($re,$r0);}else echo 'x:'.$dr.$nod.' ';}//
foreach($r as $k=>$v)foreach($ra[$k] as $ka=>$va)if($va!=$v && in_array($va,$ra[$k]))$rb[$va][]=1;//pr($rb);
foreach($rb as $k=>$v){$n=count($v); if($n>1)$rc[$k]=$n;} arsort($rc);//pr($rc);
foreach($re as $k=>$v)if($rc[$v[0]]??'')$rt[$v[0]]=$v;//pr($rt);
foreach($rc as $k=>$v)$rtb[$k]=$rt[$k];//pr($rt);
return [$rc,$rtb];}

function msql_intersect($d0,$d){
$r=explode(',',$d0.','.$d); $na=count($r);//echo msql_opsup($d,'intersect');
[$dr0,$nod0]=node_decompil($d0); $nd=struntil($nod0,'_');
foreach($r as $k=>$v){[$dr,$nod]=split_right('/',$v,1); if(!$dr){$dr=$dr0; $nod=$nd.'_'.$nod;} $r[$k]=$dr.'/'.$nod;}
[$rc,$rtb]=msq_intersect($r);
$rid=substr(md5($d0.$d),0,6); $nodb=nod('frn_'.$rid); msql::save('',$nodb,$rtb);
$ret=divb(substr(md5($d0.$d),0,6).' - '.count($rc).' results ','popbt'); 
$ret.=textarea('msqop2',$d).lj('','editmsql_msqlops___'.ajx($d0).'_intersect___msqop2',picto('ok'));
$ret.=lj('popbt','editmsql_msqlops__3_'.ajx($d0).'_connexions___msqop2','iterate');
$ret.=lj('popbt','popup_datavue,call__3_'.ajx($d0.','.$d).'_','datas');
$ret.=lj('popbt','popup_datavue,call__3_'.$rid.'_2','iterated datas');
echo $ret.=eco($rc,1).msqbt('',$nodb); //ses::$r[]=$ret;
return $rtb;}

function msql_connexions($d0,$d){
$rtb=msql_intersect($d0,$d); $ret='';
foreach($rtb as $k=>$v){$pb=msql::url('',nod('frn_'.str_replace('_','-',$v[1])).'-'.date('ymd'));
	if(!is_file($pb))$ret.=twit::call($v[1],'frnb'); else $ret.=btn('txtx','alx:'.$pb);}
echo $ret;
return $rtb;}

function update_table($d,$r){
$ret['_menus_']=$r['_menus_'];
$defs=msql::read_b('system',$d);
foreach($defs as $k=>$v)$ret[$k]=isset($r[$k])?$r[$k]:array_pad(array(),count($r['_menus_']),'');
return $ret;}

function import_conn($defs,$it,$aid){$ret=$defs['menus']??[];
if(substr($it,0,1)=='[')$it=substr($it,1); $it=str_replace(':table]','',$it); 
if(strpos($it,'¬')===false)$r=explode("\n",$it); else $r=explode('¬',$it);
foreach($r as $k=>$v)if(trim($v) && $v!='//'){$ra=explode('|',$v);
	if(is_array($ra)){$rb=[]; 
		foreach($ra as $ka=>$va){
			$va=str_replace([':BAR:',':LINE:'],['|','¬'],$va);
			$rb[]=trim($va);} $ra=$rb;}
	if($aid=='ok')$ret[$k+1]=$ra;
	else{$ret[]=$ra;}} //$va=$ra[0]??$k; unset($ra[0]); $va
return $ret;}

function findnextkey($r,$nb){$nb+=1;
if(isset($r[$nb]))$nb=findnextkey($r,$nb);
return $nb;}

function append_update($defs,$d){
list($a,$b)=split_right('/',$d,1); $r=msql::read_b($a,$b);
if($a=='design'){req('styl'); return append_design($defs,$r);}
foreach($r as $k=>$v){$up=$v['last-update']??''; $upa=valr($defs,$k,'last-update');
	if(($up && $up>=$upa) or !isset($defs[$k]))$defs[$k]=$v;}
return $defs;}

function reorder($r){$i=0;
if(isset($r['_menus_'])){$rb['_menus_']=$r['_menus_']; unset($r['_menus_']);}//sort($r);
foreach($r as $k=>$v){$i++; $rb[$i]=$v;}
return $rb;}

function add_keys($r){$i=1;
foreach($r as $k=>$v){if($k=='_menus_')$kb=$k; else $kb=$i++; 
	array_unshift($v,$k); $ret[$kb]=$v;}
return $ret;}

function del_keys($r){
foreach($r as $k=>$v){
	if(is_array($v)){if($k==='_menus_')$kb='_menus_'; else $kb=$v[0]; array_shift($v);}
	$ret[$kb]=$v;}
return $ret;}

function inject_defs($ra,$d){if(!$d)return $ra;
$f='_datas/r.php'; write_file($f,'<?php '.$d); require($f);
return $r;}

function import_csv($r,$d){
$ra=explode("\n",$d); $rc=[];
foreach($ra as $k=>$v){$rb=explode(';',$v);
	foreach($rb as $kb=>$vb)$rc[$k][$kb]=delbr($vb,"\n");}
$rc=del_keys($rc);
return $rc?$rc:$r;}

function backup_msql(){
if(auth(7))return plugin('backup_msql','');}

#render
function sesm($k,$v=''){return sesr('mu',$k,$v);}

function murl_read($u){
if(!$u)$u='users/'.ses('qb');//default
if(substr($u,0,4)=='lang')list($base,$dir,$node)=explode('/',$u);
else list($base,$node)=split_one('/',$u,1);
list($node,$row)=split_one('|',$node,1);
list($node,$line)=split_one(':',$node,1);
list($b,$d)=split_one('/',$base,0); 
list($p,$t,$v,$l)=opt($node,'_',4); $l=$l?$l:$line;
if(!$b){$b=$p; $p='';} if(!$b)$b='users'; if($b=='lang')$d=$dir?$dir:prmb(25);
return [$b,$d,$p,ajx($t),ajx($v),ajx($l)];}

function mnod($p,$t,$v){return $p.($t?'_'.$t:'').($v?'_'.$v:'');}
function murl($b,$d,$p,$t,$v){
if($_SESSION['htacc'])return ($b?$b.'/':'').($d?$d.'/':'').mnod($p,$t,$v);
else return '/?msql='.$b.'&dir='.$d.'&msql='.mnod($p,$t,$v);}
function murl_vars($u){list($b,$d,$p,$t,$v,$n)=murl_read($u);
return [$b.($d?'/'.$d:''),mnod($p,$t,$v),$n];}

function murl_build($b,$d,$p,$t,$v){
list($base,$dir,$node,$pr,$tb,$vn)=murl_read(sesm('murl'));
$base=$b?$b:$base; $dir=$d?$d:$dir; 
$hub=$p?$p:$pr; $table=$t?$t:$tb; $version=$v?$v:$vn;
return murl($base,$dir,$hub,$table,$version);}

function murl_boot(){
list($b,$dr,$nd,$pr,$tb,$vn)=murl_read(sesm('murl'));
$ret=murl($b,$dr,$nd?$nd:ses('qb'),$pr,$tb);
return $ret;}

#boot
function msql_boot($msql){$auth=$_SESSION['auth']; $ath=6; $root='msql/';//sesm('root')
$_SESSION['murl']=murl_read($msql);
list($b,$dir,$hub,$table,$version,$def)=$_SESSION['murl'];
if($def)$_GET['def']=$def; $folder=$b.'/'.($dir?$dir.'/':'');
//echo $b.'-d:'.$dir.'-p:'.$hub.'-t:'.$table.'-v:'.$version.'-d:'.$def.br();
if($def=get($def))$def;
elseif(is_file($root.$folder.$hub.'_'.$table.'_'.$version.'.php'))$_GET['def']=$def;
elseif(is_file($root.$folder.$hub.'_'.$table.'.php') && $version){
	$_GET['def']=ajx($version,1); $version='';}
if($dir && !is_dir($root.$folder)){$folder=$b.'/'; $dir='';}
$files=tables($root.$folder);
$ra[0]=explore($root,'dirs',1);//bases
	if($auth<6){$rdel=['lang','server','clients','radio','stats','gallery','db','system'];
		foreach($rdel as $v)unset($ra[0][$v]);}
$ra[1]=$b;//base
$ra[2]=$dir?explore($root.$b.'/','dirs',1):'';//dirs
$ra[3]=$dir;//dir
if($files && $b){$ra[4]=array_keys($files);//hubes
	foreach($ra[4] as $k=>$v)
		if(($b=='users' && $v!='public' && $v!=ses('qb')) or 
			($auth<6 && $v!='public'))unset($ra[4][$k]);}
else $ra[4]='';
$ra[5]=$hub;
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

/*//structure: root/base/dir/hub_table_version //b/d/p_t_v
//où b=niveau 0 et d=option root
root: /msql, /msql/db
base: default:users //p
dir: fr/en/es, auto with lang
folder:root+base+dir+/
1: hub
2: table
3: version
nod: hub+table: nod
node: hub+table+version: //o
murl: base/dir/hub_table_version (msql url)
url: ?msql=
lk: url+murl*/

//ses('msql','db/');

function bt_msqop($d,$jurl,$lh,$o=''){$a=$o?'popup':'editmsql';//msql_opsup
$rl=$d=='del_file'||$d=='del_backup'?'url':'';
return lj('txtx',$a.'_msqlops__'.$rl.'_'.$jurl.'_'.ajx($d).'__'.$o,$lh[0],att($lh[1])).' ';}
function bt_msqdt($d,$jurl,$lh,$o=''){$a=$o?'popup':'editmsql';//msql_opsup
return lj('txtx','popup_callp___msql_msql*editors_'.$jurl.'_'.ajx($d),$lh[0],att($lh[1])).' ';}

#ok, go
function msql_adm($msql='',$pg=''){
$root=sesm('root','msql/');
$auth=$_SESSION['auth']; $ath=6;//auth_level_mini
$wsz=sesg('wsz',700);
$msql=$msql?$msql:get('msql');
$_SESSION['page']=$pg?$pg:1;
#boot
if($msql && $msql!='='){
	if($_SESSION['htacc'])$url=sesm('url','/msql/'); else $url=sesm('url','/?msql=');
	$ra=msql_boot($msql); $_SESSION['msql_boot']=$ra;
	list($bases,$base,$dirs,$dir,$hubs,$hub,$files,$table,$version,$folder,$node)=$ra;
	//build url
	$murl=sesm('murl',murl($base,$dir,$hub,$table,$version));//b/d/p_t_v
	$basename=$root.$folder.$node;
	$is_file=is_file($basename.'.php');
	$lk=sesm('lk',$url.$folder.$node.gpage());
	$folder=$root.$folder;}//conformity
$def=ajx(get('def'),1);
if(get('see'))$ret[]=verbose($ra,'dirs');
//auth
if($base=='users' && $hub==$_SESSION['USE'])$_SESSION['ex_atz']=1;
if($auth>=$ath && ses('ex_atz') or $auth>=6)$authorized=true;
#load
//if($is_file)$defs=msql::read($base,$node);
if(get('repair'))msql_repair($folder,$node);//old
$defs=[];
//if($is_file)$defs=msql::read_b($dir?$dir:$base,$node); //pr($defs);
if($is_file)$defs=msql::read_b($base.($dir?'/'.$dir:''),$node); //pr($defs);
//if(!$defs)$ret[]=verbose($ra,'');
if(isset($defs['_menus_']))$defsb['_menus_']=$defs['_menus_'];
//savb
//if(get('sav'))write_file($folder.$node.'.php',msql::dump($r,$node))
if(get('sav'))msql::save($dir?$dir:$base,$node.'_sav',$defs);
#render
$lh=sesmk('msqlang','helps_msql',0);
$lkb=$lk.'&';
$jurl=ajx($murl);
#-menus
if(!$def && auth(6)){//called
	$ret['menus']=msql_menus($ra); $ret['fls']='';
	#-files
	if(auth(4))$ret['fls']=lj('txtblc','popup_callp___msql_create*table_'.$jurl,$lh[9][0]).' ';
	if($table && $authorized && $hub && $is_file){//$defs && 
		$ret['fls'].=bt_msqop('backup',$jurl,$lh[2]).' ';//sav==
		if(is_file($basename.'_sav.php')){
			$ret['fls'].=bt_msqop('restore',$jurl,$lh[3]).' ';
			$ret['fls'].=bt_msqop('del_backup',$jurl,$lh[30],1);}
		$ret['fls'].=bt_msqop('import_defs',$jurl,$lh[5],1).' ';
		$ret['fls'].=bt_msqop('import_keys',$jurl,$lh[17],1).' ';
		$ret['fls'].=bt_msqop('merge_defs',$jurl,$lh[6],1).' ';
		$ret['fls'].=bt_msqop('append_update',$jurl,$lh[7],1).' ';
		$ret['fls'].=bt_msqop('append_values',$jurl,$lh[8],1).' ';}
	if(isset($files[$hub]) && ($auth>$ath or $hub==$_SESSION['USE']))
	if($auth>=$ath && $table && $hub && $is_file){
		$ret['fls'].=bt_msqop('rename_table',$jurl,$lh[31],1);
		$ret['fls'].=bt_msqop('duplicate_table',$jurl,$lh[32],1);
		$ret['fls'].=bt_msqop('trunc_table',$jurl,$lh[10]).' ';
		$ret['fls'].=bt_msqop('del_file',$jurl,$lh[11]).' ';
		if(!$defs or isset($defs[0]))
			$ret['fls'].=bt_msqop('repair',$jurl,$lh[12]).' ';}
		if(auth(6))//($base=='system' or $hub=='public') && 
			$ret['fls'].=bt_msqop('renove',$jurl,['renove','import from philum.fr']);
	if($ret['fls'])$ret['fls'].=br();
	#-util
	$ret['utl']='';
	if($table && $authorized && $hub && $is_file){
		$ret['utl']=lj('txtblc','popup_editmsql___'.$jurl.'_*menus*',$lh[1][0]).' ';
		$ret['utl'].=bt_msqop('reset_menus',$jurl,$lh[22]);
		$ret['utl'].=bt_msqop('del_menus',$jurl,$lh[23]);
		$ret['utl'].=bt_msqop('add_keys',$jurl,$lh[24]);
		$ret['utl'].=bt_msqop('del_keys',$jurl,$lh[25]);
		$ret['utl'].=bt_msqop('add_col',$jurl,$lh[14]);
		$ret['utl'].=bt_msqop('del_col',$jurl,$lh[15],1);
		if($is_file)$ret['utl'].=bt_msqop('repair_cols',$jurl,$lh[13]);
		if($is_file)$ret['utl'].=bt_msqop('repair_enc',$jurl,['enc','repair utf8']);
		$ret['utl'].=bt_msqop('compare',$jurl,$lh[29],1);
		$ret['utl'].=bt_msqop('intersect',$jurl,$lh[33],1);
		//$ret['utl'].=bt_msqop('connexions',$jurl,['connexions','connexions'],1);
		$ret['utl'].=br();
		if($base!='system' && is_file(sesm('root').'system/'.$node.'.php'))
			$ret['utl'].=bt_msqop('update',$jurl,$lh[26]);
		$ret['utl'].=bt_msqop('sort_table',$jurl,$lh[19],1);
		if($table!='restrictions' && $table!='params')
			$ret['utl'].=bt_msqop('reorder',$jurl,$lh[20]);
		$ret['utl'].=bt_msqop('permut',$jurl,$lh[21],1);
		$ret['utl'].=bt_msqdt('import_conn',$jurl,$lh[16],1);
		$ret['utl'].=bt_msqdt('inject_defs',$jurl,$lh[18],1);
		$ret['utl'].=bt_msqdt('inject_defs2',$jurl,$lh[18],1);
		$ret['utl'].=bt_msqdt('import_csv',$jurl,['csv',''],1);
		$ret['utl'].=bt_msqdt('import_json',$jurl,['json',''],1);
		$ret['utl'].=bt_msqop('import_jsonlk',$jurl,['jsonlink',''],1);
		$ret['utl'].=bt_msqop('export_csv',$jurl,['export_csv',''],1);
		if(auth(6))$ret['utl'].=bt_msqdt('export_mysql',$jurl,['mysql',''],1);
		$ret['utl'].=lj('txtx','popup_msql___lang_helps_msql','?');}
	#-fieldset
	if($ret['fls'].$ret['utl'])
		$ret['utils']=divc('menu',$ret['fls'].$ret['utl']); $ret['fls']=$ret['utl']='';
	//if($ret['nfo'])$ret['nfo'].=br();
}//called
#-infos
$ret['nfo']='';
if($table && $is_file){
	$ret['nfo']=lkc('popbt',$lk,pictxt('msql',$murl)).' ';
	if($authorized)//add
		$ret['nfo'].=lj('txtblc','popup_editmsql___'.$jurl.'_add',pictit('add',$lh[28][0])).' ';
	$ret['nfo'].=lj('txtx','editmsql_call___msql_edit*microsql_'.$jurl,picto('refresh')).' ';
	$wurl=$_SERVER['HTTP_HOST'].'/msql/'.$murl;
	$ret['nfo'].=lj('popbt','popup_text___'.ajx($wurl).'_weburl_console',pictit('link','web url'));
	$wcon='['.$murl.($def?':'.$def:'').':msql]';
	$ret['nfo'].=lj('popbt','popup_text___'.ajx($wcon).'_connector_console',pictit('conn','connector'));
	$ret['nfo'].=lkt('popbt','/plug/microxml.php?table='.$murl,pictit('rss','xml'));
	$ret['nfo'].=lkt('popbt','/call/msqj/'.str_replace('/','|',$murl),pictit('emission','json')).' - ';
	if(is_array($defs))$n=count($defs); else $n=0; if(isset($defs['_menus_']))$n-=1;
	$ret['nfo'].=btn('txtsmall2',$n.' '.plurial($n,116)).' - ';
	if($is_file)$ret['nfo'].=btn('txtsmall2',fsize($basename.'.php',1)).' - ';
	$ret['nfo'].=btn('txtsmall2',ftime($basename.'.php')).' ';
	$ret['nfo'].=msql_search($murl);}
if($ret['nfo'])$ret['nfo']=divc('menu',$ret['nfo']);

#see_table
if($defs && !get('def')){
$out=divd('editmsql',draw_table($defs,$murl,''));
$ret[]=$out.br();}
else $ret[]=divd('editmsql','');

if($auth>6)$ret[]=lkc('txtx',$lkb.'backup_msql==','backup').' ';
if(get('backup_msql'))$ret[]=backup_msql();
return divd('msqdiv',implode('',$ret));}//end msql_adm

?>