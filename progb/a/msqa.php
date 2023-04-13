<?php //microsql_admin

class msqa{
static function gpage($p=''){return $p?'&page='.get('page',$p):'';}

//msql_menu
static function menu($r,$type,$slct,$url){$r=explode(' ',$r); $ret='';
foreach($r as $k=>$v){if($v)$ret.=lkc($v==$slct?'txtnoir':'txtx',$url.$v,$v).br();}
return $ret;}

static function lnk($r,$nurl,$vf,$cs1,$cs2,$kv){
$nurl=str_replace('/msql/','',$nurl); $ret='';
foreach($r as $k=>$v){
	if($kv=='k')$v=$k; elseif($kv=='v')$k=$v;
	$lk=str_replace('#',$k,$nurl); $cs=$vf==$k?$cs1:$cs2; 
	if($k==$_SESSION['qb'] && $vf!=$k)$cs='txtblc';
	if($v=='lang' && strpos($lk,'lang')!==false)$lk=str_replace('lang','lang/'.prmb(25),$lk);
	if($v)$ret.=lj($cs,'msqdiv_msqa,home___'.ajx($lk),$v).' ';}
return $ret;}

static function slct($id,$k,$murl){
return select_j($id.$k,'msqlc','',$murl,'','2');}

static function menus($ra){
[$bases,$base,$dirs,$dir,$hubs,$hub,$files,$table,$ver,$folder]=$ra;
$rb=$files[$hub]??''; $rc=$rb[$table]??''; $url=self::sesm('url'); $ret='';
$b=$base.'/'; $d=$dir?$dir.'/':''; $p=$hub; $t='_'.$table; $tb=$table.'_'.$ver;
if(is_array($bases)){asort($bases); $nurl=$url.'#/'.$d.$p.$t;//base
	$rt['base']=self::lnk($bases,$nurl,$base,'txtnoir','txtx','k');}
if(is_array($dirs)){asort($dirs); $nurl=$url.$b.'#/'.$p.$t;//dir
	$rt['directory']=self::lnk($dirs,$nurl,$dir,'txtnoir','txtx','k');}
if($hubs){asort($hubs); $nurl=$url.$b.$d.'#'.$t;//hub
	$rt['hub']=self::lnk($hubs,$nurl,$hub,'txtnoir','txtx','v');}
if($rb){ksort($rb); $nurl=$url.$b.$d.$p.'_#';//table
	$rt['table']=self::lnk($rb,$nurl,$table,'txtnoir','txtx','k');}
if(is_array($rc)){//version
	foreach($rc as $k=>$v)$rs[$v]=strprm($v,1,'_'); ksort($rs);
	$nurl=$url.$b.$d.$p.'_#'; $bt=self::lnk($rs,$nurl,$tb,'txtnoir','txtx','');
	if($bt)$rt['version']=$bt;}
$s='display:table-cell; padding:5px; margin:5px; background:#ddd; border:1px solid #ccc;';
foreach($rt as $k=>$v)$ret.=divc('cell',$v);
return divc('table',$ret).divc('clear','');}

static function menusj($ra){$top='d';//rstr(69)?'':'d';
[$b,$d,$p,$t,$ver,$def]=ses('murl'); $ret='';
$bdr=$d?'/'.$d:''; $tn=$t; if($ver)$tn.='_'.$ver;
$ret.=popbub('admsq','',picto('msql'),$top,1);
if($d)$ret.=popbub('admsq',$b.$bdr,$d,$top,1);
else $ret.=popbub('admsq',$b.$bdr,$b,$top,1);
if($p)$ret.=popbub('admsq',$b.$bdr.'/'.$p,$p,$top,1);
if($t)$ret.=popbub('admsq',$b.$bdr.'/'.$p.'/'.$t,$tn,$top,1);
return $ret;}

#callbacks
static function normaliz($v){$v=normalize($v);
return str_replace(['-','_'],'',$v);}

static function prevnext($r,$d){$lk=self::sesm('lk'); $r=msql::prevnext($r,$d);
return lkc('txtblc',$lk.'&def='.$r[0],'prev').' '.lkc('txtblc',$lk.'&def='.$r[1],'next');}

static function search($murl){[$dr,$nd,$vn]=self::murlvars($murl);
$ret=inputb('msqsr','',10,nms(24),100,['class'=>'search']);
$ret.=lj('','admsql_msqa,find_msqsr__'.ajx($dr).'_'.ajx($nd),picto('ok'));
return $ret;}

static function find($dr,$nd,$prm){$sr=$prm[0]??'';
$r=msql::read_b($dr,$nd,'',1); $ret='';
if(!is_array($r) or !$sr)return;
foreach($r as $k=>$v)if(strpos($k,$sr)!==false)$ret[$k]=$v;
	else foreach($v as $ka=>$va)if(strpos($va,$sr)!==false)$ret[$k]=$v;
return !$ret?'no result':self::draw_table($ret,self::sesm('murl'),'');}

static function msqcall($g1,$g2,$g3,$g4){$ret='';
$r=msql::row($g1,$g2,$g3,1); $v=$r[$g4]??($r[0]??'');
if(auth(6))$ret=msqbt($g1,$g2,$g3).' '; $ret.=btn('small',nl2br($v)); return $ret;}
static function msqread($g1,$g2,$g3,$g4){$r=msql::goodtable_b($g1.'_'.$g2.'_'.$g3.'§'.$g4.'|'.$g4);
return conn::parser(stripslashes($r));}//unused
static function msqlp($g1,$g2,$g3,$g4){$r=msql::read($g1,$g2,$g3);
return is_array($r)?divtable($r,1):$r;}
static function syshlp($g1,$g2,$g3,$g4){$b='';
if(auth(6))$b=lj('','popup_msqa,editmsql___lang/fr/helps*txts_'.ajx($g1),picto('msql')).' ';
$ret=helps($g1);
if($ret)return divc('small',$b.conn::parser($ret));}

#draw 
static function tables($base){
$r=explore($base,'files',1); $rt=[];
if($r)foreach($r as $k=>$v){$v=substr($v,0,-4);
[$nd,$bs,$sv,$op]=expl('_',$v,4); if(!$nd)$nd='root';
if($nd && $sv!='sav' && $op!='sav')$rt[$nd][$bs][$sv]=$bs.($sv?'_'.$sv:'');}
return $rt;}

static function displaydata($d,$o=''){$d=stripslashes_b($d);
if(strpos($d,'<')!==false or strpos($d,'>')!==false)$d=str::htmlentities_a($d);//$d=str::htmlentities_b($d);
if($o)$d=nl2br($d); return $d;}

static function cutat($d){$r=explode(' ',$d); $n=count($r); $ret=''; $dot=''; $nb=0;
for($i=0;$i<$n;$i++){$nb+=strlen($r[$i]); if($nb<256)$ret.=$r[$i].' ';}
if($nb>=256)$dot=' (...)'; return $ret.$dot;}

static function tabler_bypage($r,$csa,$csb,$murl){$td=''; $tr='';
if(isset($r['_menus_'])){foreach($r['_menus_'] as $k=>$v)$td.=tagc('th',$csa,$v);
	$tr=tagb('tr',$td); unset($r['_menus_']);}
$n=count($r)+1; $page=get('page',1); $npg=500;
//$ret=nb_page($n,$npg,$page,'');
$bt=pop::btpages($npg,$page,$n,'msqdiv_msqa,home___'.ajx($murl).'_');//!
$min=($page-1)*$npg; $max=$page*$npg; $i=0;
if(is_array($r))foreach($r as $k=>$v){$td=''; $i++;
	if($i>=$min && $i<$max && is_array($v))
		foreach($v as $ka=>$va)$td.=tagc('td',$csb,$va);
	if($td)$tr.=tagb('tr',$td);}
return divd('msqpg',$bt.scroll($r,tag('table',[],$tr),500).$bt);}

static function draw_table($r,$murl,$adm=''){//adm=saving
[$dr,$nd,$n]=self::murlvars($murl); $jurl=ajx($murl); $def=get('def'); $i=0;
if($r)foreach($r as $k=>$v){$ra=[]; $i++;
	if(is_array($v))foreach($v as $ka=>$va)$ra[]=self::displaydata(self::cutat($va),1);
	$css=$k==$def?'popsav':'popbt';
	$open=lj($css,'popup_msqa,editmsql___'.$jurl.'_'.ajx($k),$k);
	//$edit=lk(self::sesm('url').$murl.':'.($k).self::gpage(),picto('editor'));
	if(auth(6))$del=lj('popdel','admsql_msqa,msqldel___'.$jurl.'_'.$k,pictit('del',nms(76))).' ';
	if($k=='_menus_' && $ra){
		foreach($ra as $ka=>$va)$ra[$ka]=lk(self::sesm('url').$murl.'&sort='.$ka,$ka.':'.$va);
		array_unshift($ra,lk(self::sesm('url').$murl.'&sort=k','keys'));}
	elseif(is_array($ra))if(auth(4)){if(get('del'))$open=$del.$open;
		foreach($ra as $ka=>$va){$rid=normalize('msqedt'.$k.'-'.$ka);
			$ra[$ka]=divd($rid,self::mdfcolbt(trim($va),$k,$ka,$murl,$rid));}
		array_unshift($ra,$open);}
	else array_unshift($ra,$k);
	$datas[$k]=$ra;}
return self::tabler_bypage($datas,'popw','',$murl);}

#sav
static function node_decompil($d){
$r=split_right('/',$d,1);
if(!$r[0])$r[0]='users';
return $r;}

static function msqlsav($id,$rg,$prm){geta('msql',$id);
[$dir,$node]=self::node_decompil($id); $rk=array_shift($prm);
if($rk!=$rg && substr($rg,0,1)!='@'){msql::modif($dir,$node,$rg,'mdfk',$rk); $rg=$rk;}
$r=msql::modif($dir,$node,$prm,$rg);
geta('def',$rg);
return self::editable($id,$r);}

static function msqldel($id,$va){
[$dir,$node]=self::node_decompil($id);
$r=msql::modif($dir,$node,$va,'del');
return self::editable($id,$r);}

static function msqldisplace($id,$va,$prm){$to=$prm[0]??'';
[$dir,$node]=self::node_decompil($id); geta('def',$va);
$r=msql::read($dir,$node);
$r=msql::displace($r,$va,$to);
$r=msql::modif($dir,$node,$r,'arr');
return self::editable($id,$r);}

static function editable($nod,$r=''){
[$dir,$node]=self::node_decompil($nod);
$defs=$r?$r:msql::read_b($dir,$node,'');
if($defs)return self::draw_table($defs,$nod,1);}

static function meditksav($murl,$key,$prm=[]){$rid=normalize($murl);
if($prm){[$dr,$nod]=self::node_decompil($murl); $d=$prm[0]??''; $r=msql::read_b($dr,$nod);
foreach($r as $k=>$v)if($k==$key)$ret[$d]=$v; else $ret[$k]=$v; msql::save($dr,$nod,$ret);}
$mx=strlen($key)>24?24:strlen($key); $ret=input($rid,$d?$d:$key,$mx);
$ret.=lj('small','edt'.$rid.'_msqa,meditksav_'.$rid.'__'.ajx($murl).'_'.$key,'ok');
return divd('edt'.$rid,$ret);}

#msqledit
static function mdfcol($murl,$k,$ka,$prm){$v=$prm[0]??''; $rid=randid('mdt');
[$dr,$nd,$n]=self::murlvars($murl); $id=normalize('msqedt'.$k.'-'.$ka);
$v=msql::val($dr,$nd,$k,$ka); $va=self::displaydata($v); if($va===null)$va='-'; $va=nl2br($va);
$j=$id.'_msqlmodif_'.$rid.'__'.ajx($murl).'_'.ajx($k).'_'.ajx($ka).'_'.$id;
return divarea($rid,$va,'','',sj($j),1);
return mc::assistant($rid,'SaveJ',$j,$va,'');}

static function mdfcolbt($va,$k,$ka,$murl,$rid){//randid().
if(!trim($va)==='')$va='-'; $j=ajx($murl).'_'.ajx($k).'_'.ajx($ka);//.$id
return '<a onclick="'.sj($rid.'_msqledit_'.$rid.'__'.$j).'">'.($va).'</a>';}

static function editmsql_defcons(){return 'line:1|line:last|line:title|del:|linewith:|boldline:1|linenolink:1|del-link:|striplink:|delconn:s|replconn-pre-q|stripconn|deltables|delqmark|delblocks|cleanmail|png2jpg|since:|to:|-??|???';}

static function msqlmdf($g1,$g2,$g3,$g4,$prm){
[$dr,$nd,$n]=self::murlvars($g1); $d=$prm[0]; $d=deln($d); $d=delbr($d,"\n");//$d=delr($d);
msql::modif($dr,$nd,trim(strip_tags($d)),'shot',$g3,$g2);
return self::mdfcolbt(nl2br(self::cutat($d)),$g2,$g3,$g1,$g4);}

static function mopen($g1,$g2,$g3,$g4){
if($g4)$g4='_'.$g4; [$w,$h]=arv(expl('-',get('sz')),[720,480]); ses::$r['popw']=$w;
$u=($g1=='lang'?$g1.'/'.prmb(25):$g1).'/'.$g2.($g3?'_'.$g3.$g4:'');//return self::home($u);
return iframe('/msql/'.$u,$w-20,$h-40);}

static function codearea($k,$v){$n=40; $h=20; $s=ceil(strlen($v)/$n); if($s>5)$s=5;
if(strpos($v,'<')!==false)$v=str::htmlentities_b($v);
$p=['style'=>'height:'.(($s?$s:1)*$h).'px;','onkeyup'=>'goodheight(this,'.($n).','.$h.');'];
return textarea($k,$v,$n,'1',$p);}

static function editmsql($nod,$va,$o,$ob){
$qb=$_SESSION['qb']; $tg=$ob?'socket':'admsql'; $rid=randid();
[$dir,$node]=self::node_decompil($nod); $nodb=ajx($nod); $pn=''; $rc=[]; $kb='';
$r=msql::read_b($dir,$node); $h=isset($r['_menus_'])?1:0; if($r)$rh=$h?$r['_menus_']:current($r);
if($r)$nxtk=msql::nextentry($r); $idn=randid();
if($va=='add'){$u=$o; $o=domain(strtolower($u));
	$va=$o?$o:self::findnextkey($r,0); $ry=array_fill(0,count($rh),'');
	if(is_array($rh))$ra[$va]=array_combine($rh,$ry); else $ra[$va]=$ry; if(!isset($r[$va]))$r=$ra;
	$rw=conv::recognize_defcon($u); //pr($rw);
	$ti='text start'; if(isset($r[$va][$ti]))$r[$va][$ti]=$rw[0]?$rw[0]:'entry-content::';
	$ti='title start'; if(isset($r[$va][$ti]))$r[$va][$ti]=$rw[2]?$rw[2]:'::h1';}
if($rh)$ntkp=1; else $ntkp=0; $i=0; $key=''; $def='';
if($r){foreach($r as $k=>$v){$i++; if($k==$va){$n=$i; $key=$k; $def=$v;}
	if(!$key){$key=$va; $n=$i+1; $def='';}}
	$keys=array_keys($r); $kyb=ajx($key); $na=$n-$ntkp;
	if(isset($keys[$na-1]) && $keys[$na-1]!='_menus_')$kt=$keys[$na-1]; else $kt=$keys[$na]??'';
		$pn.=lj('txtx','popup_msqa,editmsql__x_'.$nodb.'_'.ajx($kt),picto('before')); 
	if(isset($keys[$na+1]))$kt=$keys[$na+1]; else $kt=$keys[$na]??'';
		$pn.=lj('txtx','popup_msqa,editmsql__x_'.$nodb.'_'.ajx($kt),picto('after'));}
if(isset($ra))$r=$r[$va]; elseif($key)$r=msql::read_b($dir,$node,$key);
if(is_array($r)){$i=0; $kys[]='k'.$rid;//keys to shift from array
	foreach($r as $k=>$v){$kb=self::normaliz($idn.$k); $kys[]=$kb; $rhk=$rh[$k]??''; $i++;
		if(substr($node,-7)=='defcons'){
			if($rhk=='post-treat')$opt=br().jump_btns($kb,self::editmsql_defcons(),'|'); else $opt=''; 
			if($rhk=='last-update')$v=date('ymdHi',time());}
		else $opt=self::slct($idn,$k,$dir.'/'.$node.'-'.($i-1));//slct
		if($rhk=='icon')$opt.=' '.lj('txtx','popup_admx,sbmpct___'.$kb,'pictos');
		//elseif($rhk=='condition')$opt.=' '.jump_btns($kb,'menu|desk|boot|home|user',' ');
		//elseif($rhk=='context')$opt.=' '.jump_btns($kb,'home|art|cat',' ');
		//elseif($rhk=='icon')$opt.=' '.togbub('admx,sbmpct',$kb,'pictos','txtx');
		//elseif($rhk=='icon')$opt.=' '.admx::pictodrop($kb);
		if(!is_array($v)){$t=isset($rh[$i-1])&&$h?$rh[$i-1]:$k;
			$rc[$t]=self::codearea($kb,self::displaydata($v)).$opt;}}
	$keys=ajx(implode(',',$kys));}//
elseif($kb){$keys=$kb; $opt=self::slct($idn,$k,$dir.'/'.$node.'-0');
	$rc[$va-$ntkp]=self::codearea($keys,$def).$opt;}
else{$kb=randid('k'); $rc[1]=self::codearea($kb,''); $keys='k'.$rid.','.$kb;}//new
//$ret=self::medit_ksav($nod,$key,$res);
$ret=input('k'.$rid,$key,strlen($key));
$ret.=on2cols($rc,540,5);//render
$bt=divc('txtx',$nod);
if(auth(4)){
	$bt.=lj('popsav',$tg.'_msqa,msqlsav_'.$keys.'_x_'.$nodb.'_'.$kyb.'_'.$ob,nms(27)).' ';//sav
	$bt.=lj('popbt',$tg.'_msqa,msqlsav_'.$keys.'__'.$nodb.'_'.$kyb.'_'.$ob,nms(66)).' ';//apply
	$bt.=lj('popbt',$tg.'_msqa,msqlsav_'.$keys.'_x_'.$nodb.'_@'.$kyb,nms(98)).' ';//duplicate
	$bt.=$pn.' ';//prevnext
	if(strpos($nod,'_defcons'))$bt.=lj('popbt',$idn.'0,'.$idn.'1,'.$idn.'2,'.$idn.'3_conv,recognize*defcon___'.ajx($o),nms(195));//suggestions
	$bt.=select_j('pos'.$rid,'msql',$key,$nod,'');//displace
	$bt.=lj('popbt',$tg.'_msqa,msqldisplace_pos'.$rid.'__'.$nodb.'_'.ajx($key),nms(158)).' ';
	$bt.=lj('popdel',$tg.'_msqa,msqldel__x_'.$nodb.'_'.$kyb,pictit('del',nms(76))).' ';}//del
if(substr($nod,0,4)=='lang'){$lg=strprm($nod,1,'/'); if($lg=='en')$lg='fr'; else $lg='en';
$bt.=lj('popbt','popup_msqa,editmsql___lang/'.$lg.'/'.ajx(strend($node,'/')).'_'.ajx($va),$lg);}
$bt.=msqbt($dir,$node).hlpbt('defcons');
$ret=divs('padding-bottom:4px',btd('bts','').$bt).$ret;
return $ret;}

#operations
static function creatable($p){
[$dr,$nod]=self::node_decompil($p);
[$hub,$table,$version]=expl('_',$nod,3);
$hub=$hub?$hub:'hub';
$table=$table?$table:'table';
$idt=msql::findlast($dr,$hub,$table);
$ret=input('dir',$dr,8);
if(auth(5))$ret.=input('hub',$hub,8);
elseif($hub!=$_SESSION['USE'])return btn('txtyl','forbidden');
else $ret.=hidden('prfx',$hub);
$ret.=input('nod',$table,8);
$ret.=input('ver',$idt,4).' ';
$ret.=lj('','admsql_msqlops_dir,hub,nod,ver_url_'.ajx($p).'_creatable',picto('ok'));
return $ret;}

static function msqlops($p,$md,$oa,$ob,$prm=[]){
if($ob)return self::opsup($p,$md,$oa);//intercept action
[$dr,$nod]=self::node_decompil($p); $p1=$prm[0]??'';
if($md=='creatable')$p1=$prm;
if($md=='sort_table')$p1=$oa;
$r=self::tools($dr,$nod,$md,$p1);
if($md=='creatable'||$md=='del_file'||$md=='rename_table'||$md=='duplicate_table')return $r;//reload//
return self::editable($p,$r);}

static function opsup($p,$md,$oa){
if($md=='permut')$d='0/1';
elseif($md=='del_col')$d='0';
else $d=$p;
if($md=='export_csv' or $md=='sort_table'){
	[$dr,$nod]=self::node_decompil($p); $r=msql::read($dr,$nod);}
if($md=='export_csv')return csvfile($nod,$r,$nod,1);
$ret=input('msqop',$d,32);
$rl=$md=='rename_table'||$md=='duplicate_table'?'url':'x';
$ret.=lj('','admsql_msqlops_msqop_'.$rl.'_'.ajx($p).'_'.ajx($md).'_'.$oa,picto('ok'));
if($md=='sort_table'){$ret=''; $rm=array_keys($r['_menus_']??next($r)); array_unshift($rm,'k');
	foreach($rm as $v){if($v=='k')$t='keys'; elseif($v==0)$t=1; else $t=$v+1;
	$ret.=lj('','admsql_msqlops__x_'.ajx($p).'_'.ajx($md).'_'.$v,pictxt('ascending',$t)).' ';}}
return $ret;}

static function dump_a($r,$p){$ret=''; if($r)foreach($r as $k=>$v){$re=[];
if($v)foreach($v as $ka=>$va)$re[]="'".addslashes(stripslashes($va))."'";
$ret.='$r['.(is_numeric($k)?$k:'"'.$k.'"').']=['.implode(',',$re).'];'."\n";}
return "<?php //microsql/$p\n$ret";}

//edit
static function editors($p,$md,$prm=[]){
[$dr,$nod]=self::node_decompil($p);
$r=msql::read($dr,$nod); if(!$r)return;
if($md=='inject_defs')$d=str_replace('<?php ','',self::dump_a($r,$nod));
if($md=='inject_defs2')$d=str_replace('<?php ','',msql::dump($r,$nod));
if($md=='import_conn')$d=self::edtconn($r);//use "|" for cells and "¬" for lines
if($md=='import_csv')$d=self::mkcsv($r);
if($md=='import_json')$d=self::edtjson($r);
//if($prm[0]??'')$d.="\n".delbr($prm[0],"\n");//addcsv
$ret=textarea($md,$d,60,10);
$ret.=lj('','admsql_msqlops_'.ajx($md).'__'.ajx($p).'_'.ajx($md),picto('ok'));
return $ret;}

//msqlops
static function tools($dr,$nod,$md,$d){
$r=msql::read($dr,$nod); $ok=''; 
switch($md){
case('creatable'):[$dr,$nod,$r]=self::creatable_sav($d); $rl=1; break;
case('backup'):msql::save($dr,$nod.'_sav',$r); $ok=1; break;
case('restore'):$r=msql::read_b($dr,$nod.'_sav'); break;
case('add_row'):$r[]=array_fill(0,count(current($r)),''); break;
case('del_menus'):unset($r['_menus_']); break;
case('del_file'):msql::save($dr,$nod.'_sav',$r); self::deltable($dr,$nod); $ok=1; $rl=1; break;
case('trunc_table'):$ra['_menus_']=$r['_menus_']??''; $r=$ra; break;
case('append_update'):$r=self::append_update($r,$d); break;
case('import_defs'):$r=self::import_defs($r,$d); break;
case('import_keys'):$r=self::import_keys($r,$d); break;
case('merge_defs'):$r=self::merge_defs($r,$d); break;
case('permut'):$r=self::permut($r,$d); break;
case('reset_menus'):$r=self::reset_menus($r); break;
case('add_col'):$r=self::addcol($r); break;
case('del_col'):$r=self::delcol($r,$d); break;
case('repair_cols'):$r=self::repair_cols($r); break;
case('repair_enc'):$r=utf_r($r); break;
case('renove'):$r=self::import_defs($r,'msql/'.$dr.'/'.$nod); break;
case('sort'):$r=self::sort_table($r,$d,1); $ok=1; break;
case('sort_table'):$r=self::sort_table($r,$d); break;
case('append_values'):$r=self::append_values($r,$d); break;
case('del_multi'):$r=self::del_multi($r); break;
case('reorder'):$r=self::reorder($r); break;
case('add_keys'):$r=self::add_keys($r); break;
case('del_keys'):$r=self::del_keys($r); break;
case('import_conn'):$r=self::import_conn($r,$d,$aid=''); break;
case('inject_defs'):$r=self::inject_defs($r,$d); break;
case('inject_defs2'):$r=self::inject_defs($r,$d); break;
case('import_csv'):$r=self::import_csv($r,$d); break;
case('compare'):$r=self::compare($r,$d); $ok=1; break;
case('intersect'):$r=self::intersect($dr.'/'.$nod,$d); $ok=1; break;
case('addition'):$r=self::addition($r,$d); $ok=1; break;
case('average'):$r=self::average($r,$d); $ok=1; break;
case('connexions'):$r=self::connexions($dr.'/'.$nod,$d); $ok=1; break;
case('friends'):$r=self::friends($r,$d); $ok=1; break;
case('import_json'):$r=self::import_json($d); break;
case('import_jsonlk'):$r=self::import_json($d); break;
case('rename_table'):[$dr,$nod]=self::optable($dr,$nod,$d,0); $ok=1; $rl=1; break;
case('duplicate_table'):[$dr,$nod]=self::optable($dr,$nod,$d,1); $ok=1; $rl=1; break;
case('del_backup'):self::deltable($dr,$nod,1); break;
case('update'):$r=self::update_table($nod,$r); break;
case('repair'):$r=self::repair_table($r,$dr,$nod); $ok=1; break;}
if(!$ok && $r)$r=msql::save($dr,$nod,$r);
if(isset($rl))return 'msql/'.$dr.'/'.$nod;
return $r;}

//import
static function edtjson($r){$ret=''; if($r)foreach($r as $k=>$v)if($v)$ret.='"'.$k.'":'.(is_array($v)?'["'.implode('","',$v).'"]':'"'.htmlentities($v[0])).'",'; return '{'.$ret.'}';}
static function mkcsv($r){$rc=[]; //return array2csv($r);//import_csv
if($r)foreach($r as $k=>$v){$rb=[$k];
	if(is_array($v))foreach($v as $ka=>$va)$rb[]=str_replace([';',"\n"],[',','<br/>'],$va);
	else $rb[]=$v;
	$rc[]=implode(';',$rb);}
return implode("\n",$rc);}
static function edtconn($r){$ret=''; if($r)foreach($r as $k=>$v)$ret.=$k.'|'.implode('|',str_replace(['|','¬'],[':BAR:',':LINE:'],$v)).'¬'."\n"; return $ret;}

#modif apps
static function creatable_sav($r){if(!auth(6))return;
[$dir,$lang]=expl('/',$r[0]); $dir=self::normaliz($dir); if($lang)$dir.='/'.$lang;
$hub=self::normaliz($r[1]); $table=self::normaliz($r[2]);
if($r[3] && $r[3]!='version')$version=$r[3]; if(!$r[3])$version='';
$rb=self::auto_cols(1); $node=self::mnod($hub,$table,$version);
return [$dir,$node,$rb];}

static function auto_cols($n){$r['_menus_']=[];
for($i=1;$i<=$n;$i++)$r['_menus_'][]='col_'.$i;
return $r;}

static function del_multi($defs){
foreach($defs as $k=>$v){$g=$_POST['c'.$k]; if(!$g)$ret[$k]=$v;}
return $ret;}

static function import_defs($r,$d){$rh=$r['_menus_']??'';
if(strpos($d,'msql/')!==false){$r=explode('/',$d); $n=count($r)-1; $nod=$r[$n]; $dr=$r[$n-1];
	$u=srvmir().'/call/msqj/'.$dr.'|'.$nod; $r=self::import_json($u);
	return msql::save($dr,$nod,$r);}
else{[$a,$b]=split_one('/',$d,1); return msql::read($a,$b,'','',$rh);}}

static function import_json($d){
if(substr($d,0,4)=='http')$d=get_file($d);
$r=json_decode($d,true);
if(isset($r[0])){$rh['_menus_']=$r[0]; unset($r[0]); $r=$rh+$r;}
if(isset($r['_'])){$rh['_menus_']=$r['_']; unset($r['_']); $r=$rh+$r;}
return utf_r($r,1);}

static function optable($dr,$nd,$d,$o=0){
$u=msql::url($dr,$nd); [$dr,$nd]=split_right('/',$d,1); $ub=msql::url($dr,$nd);
if($o)copy($u,$ub); else rename($u,$ub);
return [$dr,$nd];}

static function deltable($dr,$nd,$o=0){
$u=msql::url($dr,$nd,$o); unlink($u);}

static function import_keys($r,$d){
[$a,$b]=split_one('/',$d,1); $rb=msql::read_b($a,$b);
if($rb['_menus_'])$r['_menus_']=$rb['_menus_']; return $r;}

static function merge_defs($r,$d){
[$a,$b]=split_one('/',$d,1); $rb=msql::read_b($a,$b,'',1);
return array_merge_b($r,$rb);}

static function append_values($r,$d){
[$a,$b]=split_one('/',$d,1); $rb=msql::read_b($a,$b); return array_append($r,$rb);}

static function reset_menus($r){
if($r){reset($r); $first=key($r);} $ret=[];
if($first=='_menus_'){next($r); $first=key($r);}
$nb=count($r[$first]??[]);
for($i=0;$i<$nb;$i++){$ret['_menus_'][]='val'.$i;}
if($ret && $r)return $ret+$r;
else return $r;}

static function permut($r,$mu){[$a,$b]=explode('/',$mu);
if($a!==false && $b!==false && $r){
foreach($r as $k=>$v){$obj=$v[$a]; $v[$a]=$v[$b]; $v[$b]=$obj; $ret[$k]=$v;}}
return $ret;}

static function addcol($r){
if(!isset($r['_menus_']))$r['_menus_']=msql::menus($r);
foreach($r as $k=>$v){$v[]=$k=='_menus_'?'col'.(count($v)+1):''; $ret[$k]=$v;}
return $ret;}

static function delcol($r,$n){$col=$n; 
foreach($r as $k=>$v){if($n=='=')$col=count($v)-1; unset($v[$col]); $ret[$k]=$v;}
return $ret;}

static function sort_table($r,$n,$y=''){$y=$y?yesnoses('sort'):'';
if(isset($r['_menus_'])){$ret['_menus_']=$r['_menus_']; unset($r['_menus_']);}
if(is_numeric($n) or !$n){foreach($r as $k=>$v)$re[$k]=$v[$n]; $y?arsort($re):asort($re);
	foreach($re as $k=>$v)$ret[$k]=$r[$k];}
else{$y?krsort($r):ksort($r); if(isset($ret))$ret+=$r; else $ret=$r;}
return $ret;}

static function repair_cols($r){
$rm=$r['_menus_']??[]; $n=1; $ret=[]; if(isset($rm))$n=count($rm);
else{foreach($r as $k=>$v)$n=count($v)>$n?count($v):$n; $ret['_menus_']=array_pad([],$n,'');}
foreach($r as $k=>$v)for($i=0;$i<$n;$i++)$ret[$k][]=$v[$i]??'';
return $ret;}

static function repair_table($r,$dr,$nod){$rb=[];
if($r)foreach($r as $k=>$v){if(!is_array($v))$v=[$v]; if($k && $v[0])$rb[$k]=$v;}
if(isset($rb[0]) && array_sum(array_keys($rb))>0)$rb=msql::reorder($rb);
if(isset($rb))return $rb;}

static function compare($ra,$d){
$rh=$ra['_menus_']; $n=1;
if(isset($ra['_menus_']))unset($ra['_menus_']);
[$b,$d]=explode('/',$d);
$rb=msql_read($b,$d,'','1');
$rka=array_keys_r($ra,$n);
$rkb=array_keys_r($rb,$n);
if($rka && $rkb){$r1=array_diff($rka,$rkb); $r2=array_diff($rkb,$rka); $r3=array_intersect($rka,$rkb);}
//eco($r1); eco($r2); eco($r3);
echo tabler($r1,['added']).tabler($r2,['removed']);//.tabler($r3,['intersection'])
$ret=[];
$ret[]=['added']+$rh; if($r1)foreach($r1 as $k=>$v)$ret[]=$ra[$k];
$ret[]=['removed']+$rh; if($r2)foreach($r2 as $k=>$v)$ret[]=$rb[$k];
return $ret;}

static function addition($r,$n){
$rh=$r['_menus_']??[$n=>'']; $rk=array_column($r,$n); //p($rk);
if(isset($rk['_menus_']))unset($rk['_menus_']);
echo tabler(['addition',$rh[$n],array_sum($rk)]);}

static function average($r,$n){
$rh=$r['_menus_']??[$n=>'']; unset($r['_menus_']); $rk=array_keys_r($r,$n);
if(isset($rk['_menus_']))unset($rk['_menus_']);
echo tabler(['addition',$rh[$n],array_sum($rk)/count($rk)]);}

static function intersecter($r){$ra=[]; $rb=[]; $rc=[]; $re=[]; $rt=[]; $rtb=[];
foreach($r as $k=>$v){[$dr,$nod]=split_right('/',$v,1); $r0=msql::read($dr,$nod,'',1);
	if($r0){$ra[$k]=array_column($r0,0); $re=array_merge($re,$r0);}else echo 'x:'.$dr.$nod.' ';}//
foreach($r as $k=>$v)foreach($ra[$k] as $ka=>$va)if($va!=$v && in_array($va,$ra[$k]))$rb[$va][]=1;//pr($rb);
foreach($rb as $k=>$v){$n=count($v); if($n>1)$rc[$k]=$n;} arsort($rc);//pr($rc);
foreach($re as $k=>$v)if($rc[$v[0]]??'')$rt[$v[0]]=$v;//pr($rt);
foreach($rc as $k=>$v)$rtb[$k]=$rt[$k];//pr($rt);
return [$rc,$rtb];}

static function intersect($d0,$d){
$r=explode(',',$d0.','.$d); $na=count($r);//echo self::opsup($d,'intersect');
[$dr0,$nod0]=self::node_decompil($d0); $nd=struntil($nod0,'_');
foreach($r as $k=>$v){[$dr,$nod]=split_right('/',$v,1); if(!$dr){$dr=$dr0; $nod=$nd.'_'.$nod;} $r[$k]=$dr.'/'.$nod;}
[$rc,$rtb]=self::intersecter($r);
$rid=substr(md5($d0.$d),0,6); $nodb=nod('frn_'.$rid); msql::save('',$nodb,$rtb);
$ret=divb(substr(md5($d0.$d),0,6).' - '.count($rc).' results ','popbt'); 
$ret.=textarea('msqop2',$d).lj('','admsql_msqlops_msqop2__'.ajx($d0).'_intersect',picto('ok'));
$ret.=lj('popbt','admsql_msqlops_msqop2_3_'.ajx($d0).'_connexions','iterate');
$ret.=lj('popbt','popup_datavue,call__3_'.ajx($d0.','.$d).'_','datas');
$ret.=lj('popbt','popup_datavue,call__3_'.$rid.'_2','iterated datas');
echo $ret.=eco($rc,1).msqbt('',$nodb); //ses::$r[]=$ret;
return $rtb;}

static function connexions($d0,$d){
$rtb=self::intersect($d0,$d); $ret='';
foreach($rtb as $k=>$v){$pb=msql::url('',nod('frn_'.str_replace('_','-',$v[1])).'-'.date('ymd'));
	if(!is_file($pb))$ret.=twit::call($v[1],'frnb'); else $ret.=btn('txtx','alx:'.$pb);}
echo $ret;
return $rtb;}

static function friends($r,$d){$ret='';
echo $rid=substr(md5($d),0,6); $nodb=nod('frn_'.$rid); msql::save('',$nodb,$r);
foreach($r as $k=>$v){$pb=msql::url('',nod('frn_'.str_replace('_','-',$v[1])).'-'.date('ymd'));
	if(!is_file($pb))$ret.=twit::call($v[1],'frnb'); else $ret.=btn('txtx','alx:'.$pb);}
echo $ret;
return $r;}

static function update_table($d,$r){
$ret['_menus_']=$r['_menus_'];
$defs=msql::read_b('system',$d);
foreach($defs as $k=>$v)$ret[$k]=isset($r[$k])?$r[$k]:array_pad(array(),count($r['_menus_']),'');
return $ret;}

static function import_conn($defs,$it,$aid){$ret=$defs['menus']??[];
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

static function findnextkey($r,$nb){$nb+=1;
if(isset($r[$nb]))$nb=self::findnextkey($r,$nb);
return $nb;}

static function append_update($defs,$d){
[$a,$b]=split_right('/',$d,1); $r=msql::read_b($a,$b);
if($a=='design')return sty::append_design($defs,$r);
foreach($r as $k=>$v){$up=$v['last-update']??''; $upa=valr($defs,$k,'last-update');
	if(($up && $up>=$upa) or !isset($defs[$k]))$defs[$k]=$v;}
return $defs;}

static function reorder($r){$i=0;
if(isset($r['_menus_'])){$rb['_menus_']=$r['_menus_']; unset($r['_menus_']);}//sort($r);
foreach($r as $k=>$v){$i++; $rb[$i]=$v;}
return $rb;}

static function add_keys($r){$i=1;
foreach($r as $k=>$v){if($k=='_menus_')$kb=$k; else $kb=$i++; 
	array_unshift($v,$k); $ret[$kb]=$v;}
return $ret;}

static function del_keys($r){
foreach($r as $k=>$v){
	if(is_array($v)){if($k==='_menus_')$kb='_menus_'; else $kb=$v[0]; array_shift($v);}
	$ret[$kb]=$v;}
return $ret;}

static function inject_defs($ra,$d){if(!$d)return $ra;
$f='_datas/defs/r.php'; mkdir_r($f); write_file($f,'<?php '.$d); require($f);
return $r;}

static function import_csv($r,$d){
$ra=explode("\n",$d); $rc=[];
foreach($ra as $k=>$v){$rb=explode(';',$v);
	foreach($rb as $kb=>$vb)$rc[$k][$kb]=trim(delbr($vb));}
$rc=self::del_keys($rc);
return $rc?$rc:$r;}

static function backup_msql(){if(!auth(7))return;
$f='_backup/msql/'.date('ymd',time()).'.tar.gz'; //unlink($f);
$r=tar::scan('msql'); //p($r);
if(auth(6))tar::folder($f,$r);
if(is_file($f))return lkt('txtyl',$f,$f); else return 'brrrr';}

#render
static function sesm($k,$v=''){return sesr('mu',$k,$v);}

static function murlread($u){
if(!$u)$u='users/'.ses('qb');//default
if(substr($u,0,4)=='lang')[$base,$dir,$node]=expl('/',$u,3);
else [$base,$node]=split_one('/',$u,1);
[$b,$d]=split_one('/',$base,0);
[$node,$row]=split_one('~',$node,1);
[$p,$t,$v,$l]=expl('_',$node,4);
if(!$b){$b=$p; $p='';} if(!$b)$b='users'; if($b=='lang')$d=$dir?$dir:prmb(25);
return [$b,$d,$p,ajx($t),ajx($v),ajx($row)];}

static function mnod($p,$t,$v){return $p.($t?'_'.$t:'').($v?'_'.$v:'');}
static function murl($b,$d,$p,$t,$v){return $u=($b?$b.'/':'').($d?$d.'/':'').self::mnod($p,$t,$v);}
static function murlvars($u){[$b,$d,$p,$t,$v,$n]=self::murlread($u);
return [$b.($d?'/'.$d:''),self::mnod($p,$t,$v),$n];}

static function murlboot(){
[$b,$dr,$nd,$pr,$tb,$vn]=self::murlread(self::sesm('murl'));
$ret=self::murl($b,$dr,$nd?$nd:ses('qb'),$pr,$tb);
return $ret;}

#boot
static function boot($msql){$auth=ses('auth'); $ath=6; $root='msql/';//self::sesm('root')
if(substr($msql,0,7)=='/?msql=')$msql=substr($msql,7);//patch local
$ru=self::murlread($msql); $_SESSION['murl']=$ru;
[$b,$dir,$hub,$table,$version,$def]=$ru;
if($def)geta('def',$def); $folder=$b.'/'.($dir?$dir.'/':'');
//echo $b.'-d:'.$dir.'-p:'.$hub.'-t:'.$table.'-v:'.$version.'-d:'.$def.br();
if($def=get($def))$def;
elseif(is_file($root.$folder.$hub.'_'.$table.'_'.$version.'.php'))geta('def',$def);
elseif(is_file($root.$folder.$hub.'_'.$table.'.php') && $version){
	geta('def',ajx($version,1)); $version='';}
if($dir && !is_dir($root.$folder)){$folder=$b.'/'; $dir='';}
$files=self::tables($root.$folder);
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
		if($k==ses('USE') && $k==ses('qb'))$filb[$k]=$v;
		elseif($k==ses('USE'))$filb[$k]=['public'];
		elseif($k=='public')$filb[$k]=$v;} 
	$files=$filb;}
$ra[7]=$table;
$ra[8]=ajx($version,1);
$ra[9]=$folder;
$ra[10]=self::mnod($ra[5],$ra[7],$ra[8]);
return $ra;}

static function opbt($d,$jurl,$lh,$o=''){$a=$o?'popup':'admsql';//msql_opsup
$rl=$d=='del_file'||$d=='del_backup'?'url':'';
return lj('txtx',$a.'_msqlops__'.$rl.'_'.$jurl.'_'.ajx($d).'__'.$o,$lh[0],att($lh[1])).' ';}

static function opedt($d,$jurl,$lh,$o=''){$a=$o?'popup':'admsql';//msql_opsup
return lj('txtx','popup_msqa,editors___'.$jurl.'_'.ajx($d),$lh[0],att($lh[1])).' ';}

#ok, go
static function home($cmd='',$pg=''){
$root=self::sesm('root','msql/');
$cmd=$cmd?$cmd:get('msql');
geta('page',$pg?$pg:1);
$ath=auth(6);
#boot
if($cmd && $cmd!='='){
	if(ses('htacc'))$url=self::sesm('url','/msql/'); else $url=self::sesm('url','/?msql=');
	$ra=self::boot($cmd); $_SESSION['msql_boot']=$ra;
	[$bases,$base,$dirs,$dir,$hubs,$hub,$files,$table,$version,$folder,$node]=$ra;
	//build url
	$murl=self::sesm('murl',self::murl($base,$dir,$hub,$table,$version));//b/d/p_t_v
	$basename=$root.$folder.$node;
	$is_file=is_file($basename.'.php');
	$lk=self::sesm('lk',$url.$folder.$node.self::gpage());
	$folder=$root.$folder;}//conformity
$def=ajx(get('def'),1);
if(get('see'))$ret[]=verbose($ra,'dirs');
//auth
if($base=='users' && $hub==ses('USE'))$_SESSION['ex_atz']=1;
if($ath && ses('ex_atz') or $ath)$authorized=true;
#load
$defs=[];
if($is_file)$defs=msql::read_b($base.($dir?'/'.$dir:''),$node);
if(get('sav'))msql::save($dir?$dir:$base,$node.'_sav',$defs);
#render
$lh=sesmk('msqlang','helps_msql',1);
$lkb=$lk.'&';
$jurl=ajx($murl);
#-menus
if(!$def && auth(6)){
	$ret['menus']=self::menus($ra); $ret['fls']='';
	if(auth(4))$ret['fls']=lj('txtblc','popup_msqa,creatable___'.$jurl,$lh[9][0]).' ';
	if($table && $authorized && $hub && $is_file){//$defs && 
		$ret['fls'].=self::opbt('backup',$jurl,$lh[2]).' ';//sav==
		if(is_file($basename.'_sav.php')){
			$ret['fls'].=self::opbt('restore',$jurl,$lh[3]).' ';
			$ret['fls'].=self::opbt('del_backup',$jurl,$lh[30],1);}
		$ret['fls'].=self::opbt('import_defs',$jurl,$lh[5],1).' ';
		$ret['fls'].=self::opbt('import_keys',$jurl,$lh[17],1).' ';
		$ret['fls'].=self::opbt('merge_defs',$jurl,$lh[6],1).' ';
		$ret['fls'].=self::opbt('append_update',$jurl,$lh[7],1).' ';
		$ret['fls'].=self::opbt('append_values',$jurl,$lh[8],1).' ';}
	//if(isset($files[$hub]) && $hub==ses('USE'))
	if($ath && $table && $hub && $is_file){
		$ret['fls'].=self::opbt('rename_table',$jurl,$lh[31],1);
		$ret['fls'].=self::opbt('duplicate_table',$jurl,$lh[32],1);
		$ret['fls'].=self::opbt('trunc_table',$jurl,$lh[10]).' ';
		$ret['fls'].=self::opbt('del_file',$jurl,$lh[11]).' ';
		if(!$defs or isset($defs[0]))
			$ret['fls'].=self::opbt('repair',$jurl,$lh[12]).' ';}
		if(auth(6))//($base=='system' or $hub=='public') && 
			$ret['fls'].=self::opbt('renove',$jurl,['renove','import from '.prms('srvmirror')]);
	if($ret['fls'])$ret['fls'].=br();
	#-util
	$ret['utl']='';
	if($table && $authorized && $hub && $is_file){
		$ret['utl']=lj('txtblc','popup_msqa,editmsql___'.$jurl.'_*menus*',$lh[1][0]).' ';
		$ret['utl'].=self::opbt('reset_menus',$jurl,$lh[22]);
		$ret['utl'].=self::opbt('del_menus',$jurl,$lh[23]);
		$ret['utl'].=self::opbt('add_keys',$jurl,$lh[24]);
		$ret['utl'].=self::opbt('del_keys',$jurl,$lh[25]);
		$ret['utl'].=self::opbt('add_col',$jurl,$lh[14]);
		$ret['utl'].=self::opbt('del_col',$jurl,$lh[15],1);
		if($is_file)$ret['utl'].=self::opbt('repair_cols',$jurl,$lh[13]).' ';
		if($is_file)$ret['utl'].=self::opbt('repair_enc',$jurl,['enc','repair utf8']);
		$ret['utl'].=self::opbt('compare',$jurl,$lh[29],1);
		$ret['utl'].=self::opbt('intersect',$jurl,$lh[33],1);
		$ret['utl'].=self::opbt('addition',$jurl,['addition',''],1);
		$ret['utl'].=self::opbt('average',$jurl,['average',''],1);
		//$ret['utl'].=self::opbt('connexions',$jurl,['connexions','connexions'],1);
		$ret['utl'].=self::opbt('friends',$jurl,['friends','friends'],1);
		$ret['utl'].=br();
		if($base!='system' && is_file(self::sesm('root').'system/'.$node.'.php'))
			$ret['utl'].=self::opbt('update',$jurl,$lh[26]);
		$ret['utl'].=self::opbt('sort_table',$jurl,$lh[19],1);
		if($table!='restrictions' && $table!='params')
			$ret['utl'].=self::opbt('reorder',$jurl,$lh[20]);
		$ret['utl'].=self::opbt('permut',$jurl,$lh[21],1);
		$ret['utl'].=self::opedt('import_conn',$jurl,$lh[16],1);
		$ret['utl'].=self::opedt('inject_defs',$jurl,$lh[18],1);
		$ret['utl'].=self::opedt('inject_defs2',$jurl,$lh[18],1);
		$ret['utl'].=self::opedt('import_csv',$jurl,['csv',''],1);
		$ret['utl'].=self::opedt('import_json',$jurl,['json',''],1);
		$ret['utl'].=self::opbt('import_jsonlk',$jurl,['jsonlink',''],1);
		$ret['utl'].=self::opbt('export_csv',$jurl,['export_csv',''],1);
		if(auth(6))$ret['utl'].=self::opedt('export_mysql',$jurl,['mysql',''],1);
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
		$ret['nfo'].=lj('popbt','popup_msqa,editmsql___'.$jurl.'_add',pictit('add',$lh[28][0])).' ';
	$ret['nfo'].=lj('txtx','admsql,editable___'.$jurl,picto('refresh')).' ';
	$wcon='['.$murl.($def?':'.$def:'').':msql]';
	$ret['nfo'].=lj('popbt','popup_usg,txt___'.ajx($wcon).'_console',pictit('conn','connector'));
	//$ret['nfo'].=lkt('popbt',host().'/msql/'.$murl,pictit('link','web url'));
	$ret['nfo'].=lkt('popbt','/call/microxml,stream/'.str_replace('/','|',$murl),pictit('rss','xml'));
	$ret['nfo'].=lkt('popbt','/call/msqj/'.str_replace('/','|',$murl),pictit('emission','json')).' - ';
	if(is_array($defs))$n=count($defs); else $n=0; if(isset($defs['_menus_']))$n-=1;
	$ret['nfo'].=btn('txtsmall2',$n.' '.plurial($n,116)).' - ';
	if($is_file)$ret['nfo'].=btn('txtsmall2',fsize($basename.'.php',1)).' - ';
	$ret['nfo'].=btn('txtsmall2',ftime($basename.'.php')).' ';
	$ret['nfo'].=self::search($murl);}
if($ret['nfo'])$ret['nfo']=divc('menu',$ret['nfo']);

#see_table
if($defs && !get('def')){
$out=divd('admsql',self::draw_table($defs,$murl,''));
$ret[]=$out.br();}
else $ret[]=divd('admsql','');

if($ath)$ret[]=lkc('txtx',$lkb.'backup_msql==','backup').' ';
if(get('backup_msql'))$ret[]=self::backup_msql();
return divd('msqdiv',implode('',$ret));}//end msql_adm

}
?>