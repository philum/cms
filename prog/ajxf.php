<?php
//philum_ajx_functions

#popup
function photos_art_bt($p,$sz,$id){$ret=''; $n=1;
$d=sql('img','qda','v','id='.$id); $r=explode('/',$d); $n=0;
foreach($r as $k=>$v)if($v==$p)$n=$k;
$ima=$r[$n-1]??''; $imb=$r[$n+1]??'';
if($ima){list($w,$h)=fwidth(gcim($ima)); $wd='_'.$w.'-'.$h.'_'.$sz;
	if($w)$ret=lj('','popup_photo__x_'.ajx($ima,'').$wd,picto('kleft')).' ';}
if($imb){list($w,$h)=fwidth('img/'.$imb); $wd='_'.$w.'-'.$h.'_'.$sz;
	if($w)$ret.=lj('','popup_photo__x_'.ajx($imb,'').$wd,picto('kright')).' ';}
if($k>1)return $ret;}

function photo_screen($ima,$dim,$sz){
$im=goodroot(strto($ima,'?')); $ng=ses('negcss')?'_neg':''; $w=$h=$w1=$h1='';
//if($dim)list($w,$h)=opt($dim,'-');//obs
if(is_file($im))list($w,$h)=getimagesize($im);
$klr=getclrs($_SESSION['prmd'].$ng); $o='';
if(!$sz)$sz='900-600'; list($sw,$sh,$ph,$id)=opt($sz,'-',4); $sw-=60; $sh-=40; 
$nw=$w>$sw?$sw:$w+10; $nh=$h>$sh?$sh:$h+4;
$id=is_numeric($id)?$id:$_SESSION['read']; if(!$id)list($hub,$id,$nm)=opt($ima,'_',3); 
/*if(!$w && !$h)list($w,$h)=fwidth($im); $r1=0;
if($w && $h)$r1=($w/$h); $r2=($sw/$sh); $ml=($sw-$w)/2; $mt=($sh-$h)/2; $nw=$w; $nh=$h;
if($r1>$r2){if($w>$sw){$ml=0; $nw=$sw; $nh=$h*($sw/$w); $mt=($sh-$nh)/2;}}
else{if($h>$sh){$mt=0; $nh=$sh; $nw=$w*($sh/$h); $ml=($sw-$nw)/2;}}*/
if(is_numeric($id))$o=photos_art_bt($ima,$sz,$id); $rid=randid('imz');
$o.=lkt('',$im,picto('url')).' '; $nw=round($nw); $nh=round($nh);
if($w>$nw or $h>$nh)$o.=lj('','pagup_overim__x_'.ajx($im).'_'.$dim.'_'.$sz,picto('fullscreen')).' ';
$cs1=atd('popu').ats('position:absolute; width:'.$w.'px; height:'.$nh.'px; box-shadow:0 0 100px 10px #000; z-index:-1; background:#000;"');//$nw:optimal width
$popa=popa(' ',$o); //if(substr($im,0,4)!='http')$im='/'.$im;
return $popa.div($cs1,div(atc('scroll').atd($rid).ats('max-height:'.$nh.'px'),image($im,'','')));}

function overim($im,$sz){//list($w,$sh)=opt($sz,'-');
$s='overflow:auto; text-align:center; width:100%; height:calc(100% - 28px); background:rgba(0,0,0,0.6);';
return div(ats($s),image($im),'');}

function video_viewer($iv,$cr_div,$n){
$r=$_SESSION['iv'.$iv]; $_SESSION['cur_div']=$cr_div;
$jx='iv'.$iv.'_vview___'.$iv.'_'.$cr_div.'_';
$ret.=divc('nbp right',nb_pages_j($r,$jx,$n));
$ret.=balb('h3',lk(htac('read').$r[$n][0],suj_of_id($r[$n][0])));
$ret.=video::any(strfrom($r[$n][1],'§'),$r[$n][0],3);
return $ret.br();}

#meca
//pages
function nb_pages_j($r,$jx,$n){$nb=1; $na=count($r);
if($n>=$nb && $n)$ret.=lj('',$jx.(0),1);//first
$nab=round($n/2); if($n-$nb>$nab)$ret.=lj('',$jx.($nab-1),$nab);
if($r[$n-1])$ret.=lj('',$jx.($n-1),picto('kleft'));
$ret.=lj('active',$jx.($n),$n+1);
if($r[$n+1])$ret.=lj('',$jx.($n+1),picto('kright'));
$nab=$n+round(($na-$n)/2); if($n+$nb<$nab)$ret.=lj('',$jx.($nab-1),$nab);
if($n<$na-$nb && $n!=$na-1)$ret.=lj('',$jx.($na-1),$na);//last
return $ret;}

//footnotes
function nbp($id,$read){
if(strpos($id,'-'))list($id,$i)=explode('-',$id);
$t=lkc('nbp',urlread($read).'#nb'.$id.'" name="nh'.$id,'['.$id.']');//nb($id,1)
$d=sql('msg','qdm','v','id="'.$read.'"');
$pos=strpos($d,'['.$id.':nb]'); $posb=0;
if(is_numeric($id))$posb=strpos($d,'['.($id+1).':nb]'); else $posb=strpos($d,"\n",$pos)+$pos;
$ret=subtopos($d,$pos,$posb);
$ret=str_replace('['.$id.':nb]','',$ret);
if(!is_numeric(substr($ret,0,1)))$ret=substr($ret,1);
if(!is_numeric(substr($ret,-1)))$ret=substr($ret,0,-1);
return divc('twit small scroll',$t.' '.conn::read(trim($ret),3,$id));}

function mbd_footnotes($n,$a){
$txt=helps('anchor_select').' "'.$n.'":'; $c='txtx';
if(!$a)$ret=ljb('popbt','insert_mbd','[\',\''.$n.'\',\':nb]',$txt).br().btn('txtsmall',helps('anchor_dbclic')).br().br();
else{$ret=lj('txtx','txarea_filters_txtarea__addanchors','auto_anchors').' ';
$ret.=ljb('','embed_slct','\',\'','()').br();
$ret.=btn('txtsmall',helps('anchor_auto')).br();
$ret.=ljb($c,'embed_slct','[\',\':nh]',':nh').' ';
$ret.=ljb($c,'embed_slct','[\',\':nb]',':nb').' ';
$ret.=btn('txtsmall',helps('anchor_manual')).br();
$ret.=ljb($c,'conn','_delconn_nh',':nh').' ';
$ret.=ljb($c,'conn','_delconn_nb',':nb').' ';
$ret.=btn('txtsmall',nms(76));}
return $ret;}

//menuder
function menuder_jb($r,$id,$rid,$opt='',$n=''){//AddCat//menuderj_prep
if($n)$vac=find_vaccum($n); else $vac=''; $ret='';
if($vac && isset($_SESSION['vac'][$vac]['c']))$slct=$_SESSION['vac'][$vac]['c']; else $slct='';
if($r){foreach($r as $k=>$v){$j='';
	if($opt)$j=atjr('jumphtml',['adcat'.$rid,$k]).'; ';
	$j.=atjr('jumpvalue',[$id,$k]).'; Close(\'popup\');';
	if($n)$j.=' SaveJ(\'socket_call___ajxf_newartcatset_'.ajx($n).'_'.ajx($k).'\')'; //wait url
	$c=$slct==$k?'active':'';
	$ret.=ljb($c,$j,'',$k);}}
$ret=divc('list',$ret);
if($opt==2)$ret.=menuder_form($id,$rid,'','adcat',$opt);
return $ret;}

function menuder_pop($d,$id,$rid,$opt){
if(strpos($d,'|'))$r=explode('|',$d); elseif(strpos($d,' '))$r=explode(' ',$d);
if(!$r)$r=slct_r($d,'',$opt); $r=array_flip($r);
return menuder_jb($r,$id,$rid,$opt);}

function menuder_form($id,$rid,$v,$pre,$o){//assistant($id,$j,$jv,$va,$chk);
if($o==1 or $o==3)$bt='getbyid(\''.$pre.$rid.'\').innerHTML=val;'; else $bt='';
return input('adc'.$rid,$v).lja('popbt','var val=getbyid(\'adc'.$rid.'\').value; 
if(val){'.$bt.' getbyid(\''.$id.'\').value=val;} Close(\'popup\');','ok');}

function slct_r($d,$o,$vrf=''){$cl=0;
switch($d){case('parent'):$r=newartparent(); break;
	case('cat'):$r=$_SESSION['line']; if($r)array_unshift($r,''); if($r)ksort($r); break;
	case('tag'):$r=tags_list_nb($o=='utag'?ses('iq'):$o,rstr(3)&&!is_numeric($o)?60:maxdays()); if($r)ksort($r); break;//'tag'=>1 
	case('vfld'):$r=sql('msg','qdd','k','val="folder"'); $cl=0; break;
	case('lang'):$r=array_flip(explode(' ',prmb(26))); $cl=0; break;
	case('msql'):req('msql'); list($dr,$nd,$vn)=murl_vars($o); $r=msql::read($dr,$nd,'',1);
		if($r)$r=array_flip(array_keys($r)); break;
	case('msqlb'):req('msql'); list($dr,$nd,$vn)=murl_vars($o); $r=msql::kx($dr,$nd,$vn?$vn:0); break;
	case('msqlc'):req('msql'); list($dr,$nd,$vn)=murl_vars($o);
		$ra=msql::read($dr,$nd,'',1); $vrf=$vn?$vn:0;
		if($ra)foreach($ra as $k=>$v){$v=htmlentities_b($v[$vrf]); $r[$v]=$v;}
		if($r)ksort($r); break;
	case('plug'):$r=msql_read('system','program_plugs'); if($r)ksort($r); break;
	case('func'):if($o)$r=call_user_func($o); $r=array_keys($r); if($r)ksort($r); break;
	case('pfunc'): list($plg,$fnc,$prm)=opt($o,'/',3); $r=plugin_func($plg,$fnc,$prm); break;
	case('pfuncb'): list($plg,$fnc,$prm)=opt($o,'/',3); $r=plugin_func($plg,$fnc,$prm); break;
	default: if(strpos($d,'|'))$r=array_flip(explode('|',$d));
		else $r=array_flip(explode(' ',$d)); break;}
if($r && $cl)$r=array_unshift_b($r,'','x');
return $r;}

function getparent($id){
$r=newartparent(); $ib=sql('ib','qda','v',$id); $ret='';
if($r)foreach($r as $k=>$v)$ret.=lja(active($k,$ib),'selectprnt(\''.$id.'\',\''.$k.'\');',$v);
return scroll_b($r,divc('list',$ret),10,'','240');}

function hidslct_j($id,$d,$vrf='',$o=''){//select_j//hidden
if($d=='date')return menuder_form($id,$id,$vrf,'bt',$o);
$r=slct_r($d,$o,$vrf); $ret='';
if($d=='msql')$o='1'; elseif($d=='msqlb' or $d=='msqlc')$o=''; 
elseif($d=='pfuncb')$o=3; //elseif($d=='tag')$o=1;// elseif($d=='pfunc')$o=1;
if(is_array($r))foreach($r as $k=>$v){$c=$k==$vrf?'active':''; $k=addslashes($k);
	if(is_array($v) or is_numeric($v))$v=$k; $v=stripslashes($v);
	if(strpos($d,'|')===false)$t=$k?$k:$d; elseif($k)$t=$k; elseif($vrf)$t=$vrf; else $t='';
	if($t=='-')$t='...';
	if($v)$ret.=ljb($c,'selectj',[$id,$k,ajx($t),$o],$v);}
if($o>=2)$ret.=menuder_form($id,$id,$vrf,'bt',$o);
//$ret=scroll($r,$ret,40,'');
return divc('list',$ret);}

function chkslct_j($id,$d,$vrf='',$o=''){//chk_j
$r=slct_r($d,$o,$vrf); $i='0'; $ra=explode('~',$vrf); $ret='';
foreach($ra as $v){$ad=substr($v,0,1); if($ad=='+' or $ad=='-')$vb=substr($v,1); else $vb=$v; $rb[$vb]=$v;}
if($d=='msql')$o='1'; elseif($d=='msqlc')$o=''; 
elseif($d=='pfuncb')$o=3; elseif($d=='pfunc')$o=1; elseif($d=='tag')$o=1; 
if(is_array($r))foreach($r as $k=>$v){$c=$k==$vrf?'active':''; $k=addslashes($k);
	if(is_array($v) or is_numeric($v))$v=$k; $v=stripslashes($v);
	if(strpos($d,'|')===false)$t=$k?$k:$d; elseif($k)$t=$k; elseif($vrf)$t=$vrf; else $t='';
	if($t=='-')$t='...'; $c=''; $vb=$v; if(isset($rb[$v])){$vb=$rb[$v]; $c='active';}
	if($v)$ret.=ljb($c.'" id="bt'.$id.$i,'cases_j',[$id,$v,$i],$vb);
	$i++;}
if($o>=2)$ret.=menuder_form($id,$id,$vrf,'bt',$o);
return divc('list',$ret);}

function checkbox_case($id,$v,$t='',$b='',$j=''){$h=hidden($id,$id,$v?$v:0);
return ljb('popbt','checkbox',[$id,$t,$j],offon($v,$t),$id,att($b)).$h;}

//read_backup
function bckread($id,$idb){req('spe,pop,art,tri');
$r=msql_read('',nod('backup_'.$id),$idb);
$txt=is_array($r)?$r[1]:$r;
return conn::read($txt,3,$id);}

//addart
function addart_sav($f,$va,$pub,$ib){if($f=='Url')return;
$_GET['urlsrc']=$f; $_POST['name']=$_SESSION['USE']; $_SESSION['frm']=$va;
if(substr($f,0,4)!='http' && $f)$f='http://'.$f;
//list($defid,$r)=conv::verif_defcon($f); if($f)$auv=video::detect($f);
req('sav,boot'); //if(rstr(10))
$_POST['ib']=$ib; $_POST['pub']=$pub; $nid=save_art(); $ret=$nid;
if(!is_numeric($nid))$ret=popup('Article',artform($f,''));
return $ret;}

function addart_new($d,$id,$res){req('boot');
list($suj,$frm,$urlsrc,$date,$name,$mail,$ib,$pub)=ajxr($res,8);//,$sub
if(strpos($d,'<'))$d=conv::call($d);
$_POST['msg']=str_replace("\n","\r",$d); $_POST['suj']=$suj; $_SESSION['frm']=$frm; 
$_GET['urlsrc']=$urlsrc; $_POST['postdat']=$date; $_POST['mail']=$mail; 
$_POST['name']=$name; $_POST['ib']=$ib; $_POST['pub']=$pub; //$_POST['sub']=$sub;
return save_art();}

/*function addart_new0($id,$res){req('boot');
list($d,$suj,$frm,$urlsrc,$date,$name,$mail,$ib,$pub)=ajxr($res,9);//,$sub
if(strpos($d,'<'))$d=conv::call($d,1);
$_POST['msg']=str_replace("\n","\r",$d); $_POST['suj']=$suj; $_SESSION['frm']=$frm; 
$_GET['urlsrc']=$urlsrc; $_POST['postdat']=$date; $_POST['mail']=$mail; 
$_POST['name']=$name; $_POST['ib']=$ib; $_POST['pub']=$pub; //$_POST['sub']=$sub;
return save_art();}*/

//urlsrc
function web_import($f,$json=''){//SaveI()
$f=utmsrc($f); $f=http($f); $_GET['urlsrc']=$f;
list($t,$d)=conv::vacuum($f,''); //$d=embed_links($d);//double-emploi=crash
if($json)return mkjson([$t,$d,urledt($f)]);
return [$t,$d];}

function art_import($id,$f){
list($t,$d)=web_import($f);
$sq=['suj'=>$t,'mail'=>$f,'img'=>'','thm'=>hardurl($t)];//if(rstr(38))
sqlup('qda',$sq,'id',$id);
req('sav,pop'); modif_art($id,$d);
vacses($f,'t','x');
return $d;}

function art_mirror($id,$prw){
$d=read_file('http://newsnet.fr/apicom/id:'.$id.',json:1,conn:1');
$r=json_decode($d,true); $r=$r[$id]; $r=utf_r($r,1); $t=$r['title']; $d=$r['content'];
$sq=['suj'=>$t,'mail'=>$r['url'],'img'=>$r['image']??'','thm'=>hardurl($t),'ib'=>$r['parent'],'re'=>$r['priority']]; //pr($sq);
sqlup('qda',$sq,'id',$id);
req('sav,pop,art,spe,mod,tri'); modif_art($id,$d);
return art_read_d($id,$prw,'');}

function reimport($id,$prw=1,$edt='',$res=''){
$u=sql('mail','qda','v','id='.$id); if($res)$u=ajxg($res);
if($edt)return btn('',input('rmp',$u).lj('',$id.'_reimport__3_'.$id.'_'.$prw.'___rmp',picto('ok')));
elseif(auth(4))$ret=art_import($id,$u);
return art_read_d($id,$prw,'');}

function import_get($id){$ret='';
$d=sql('msg','qdm','v','id='.$id); $idb=embed_detect($d,'[',':import]');
if(is_numeric($idb)){
$hub=sql('nod','qda','v','id='.$idb);
$ret=sql('msg','qdm','v','id='.$idb);
$ret.="\n".'['.$idb.'§'.$hub.':pub]';
update('qdm','msg',$ret,'id',$id);}
return $ret;}

function bckpart($id){
$d=sql('msg','qdm','v','id='.$id);
msql::modif('',nod('backup_'.$id),[mkday(),$d],'push');}

function recapart($id,$prw=1){
$url=sql('mail','qda','v','id='.$id);
if($url)bckpart($id);
if($url && auth(4))art_import($id,$url);
return art_read_d($id,$prw,'');}

function art_import_meta($res){$f=ajxg(trim($res));//urledt()
if(!$_GET['ti']){list($tit,$txt,$img)=web::metas($f); 
if($img)$ret='['.$img.']'; $ret.=$txt."\n".$f; //return $ret;
vacses($f,'t',clean_title($tit));}
else $ret=vacses($f,'t','x'); return $ret;}

function bub_adm_addart(){
$t=autoclic('" id="addsrc" onClick="SaveIeb()" onContextMenu="SaveIeb()','Url',44,256,'');
$h=hidden('','addop',rstr(57)).hidden('','addsrt',$_SESSION['frm']).hidden('','addpub',$_SESSION['auth']>2?rstr(11):0).hidden('','addib','');//rstr(10)
return span(atc('search').atd('adb').ats('width:106px;'),$t).$h;}

function find_vaccum($n){$i=0; foreach($_SESSION['vac'] as $k=>$v){$i++; if($i==$n)return $k;}}
function newartcatset($n,$d){$u=find_vaccum($n); $_SESSION['vac'][$u]['c']=$d;}
function newartparentset($u,$d){return vacses($u,'p',$d);}
function newartparent(){$r=array_keys_r($_SESSION['rqt'],10); $rb=[];
if($read=ses('read'))if($read!=get('read'))$ret[$read]='(current) '.suj_of_id($read);
if(isset($r))foreach($r as $k=>$v)if($v!='/')$rb[$v]=radd($rb,$v); if($rb)arsort($rb);
if(isset($rb))foreach($rb as $k=>$v)$ret[$k]='('.$v.') '.suj_of_id($k);
return $ret;}

function newartcat($url){$r=find_cat(30); ksort($r); $u=ajx($url);//saveiec
$head=select_j('addib','parent','',0,picto('topo'),1).' ';//parent_slct('addib')
$vrf=vacses($url,'c'); $ret='';
foreach($r as $k=>$v){if($k==$vrf)$c='active'; else $c='';
	//$ret.=ljc($c,'socket',ajxf'_newartcatset_'.$u.'_'.ajx($k),$k,'x');//flag
	$ret.=saveiec($u,ajx($k),'','addib',$k,'',$c).' ';}//addart//spe-ajxf_newartcat
$ret=scroll_b($r,$head.divc('nbp',$ret),24,'',400);//savart
return $ret;}

//msqbt('',$b.'_defcons',domain(strtolower($u))).hlpbt('defcons')//obsolete
function urledt($u){$b=rstr(18)?'public':ses('qb'); if(!auth(4))return;
list($id,$v)=conv::verif_defcon($u);
if($id)$j=$id.'_'; else $j='add_';
$ret=lj('','popup_editmsql___users/'.$b.'*defcons_'.$j.ajx($u),picto('config')).' ';
//$ret.=lja('','SaveI(\'urlmeta\')',pictxt('kdown')).' ';
$ret.=lj('','popup_callp___ajxf_seesrc_'.ajx($u),pictit('file-html','code')).' ';
//$ret.=lj('','socket_batch___'.ajx($link).'_x',picto('del')).' ';
$u=vacurl($u); //if($_SESSION['vac'][$u])
//$ret.=lj('','urledt_sesmake____vac',picto('no')).' ';//erase all batch
return $ret;}

function seesrc($f){
$bt=lj('','popup_callp___ajxf_seesrc2_'.ajx($f),pictit('file-html','code')).' ';
req('tri,pop,art,spe,mod'); list($title,$ret,$d,$defid,$defs)=conv::vacuum($f); $d=mk::progcode($d);
return $bt.balc('code','console',$d);}

function seesrc2($f){$d=get_file($f); req('pop'); 
$enc=detect_enc($d); if($enc=='UTF-8')$d=utf8_decode_b($d); $d=mk::progcode($d);
return balc('code','console',$d);}

#transports
//export
function exportation($id,$node,$frm,$sub){
$USE=$_SESSION['USE']; $mn=$_SESSION['mn']; $qb=$_SESSION['qb']; $dy=$_SESSION['dayb'];
$j='exp'.$id.'_export___'; $ret=''; $rte='';
if($frm)$ret.=lj('popbt',$j.$id.'_'.$node,picto('left')).' ';
if($node!=$qb && $mn)$ret.=slctmenusj($mn,$j.$id.'_',$qb,' ','k');
$r=sql('distinct(frm)','qda','rv','nod="'.$node.'" and day>'.(calc_date(360)).' order by frm');	
if($r && !$frm)$ret.=slctmenusj($r,$j.$id.'_'.$node.'_',$frm,' ','v');
if($frm && !$sub){//topic
	$lk=$j.$id.'_'.$node.'_'.$frm.'_';
	$ret.=lj('popsav',$lk.'ok','save in: '.$frm);
	$w=$dy?' and day>'.$dy:'';
	$r=sql('id,suj','qda','kv','nod="'.$node.'" and frm="'.$frm.'"'.$w.' order by id desc limit 100');
	if($r)foreach($r as $k=>$v)$rte.=lj('',$lk.$k,$v).br();
	if($rte)$ret.=' '.btn('txtx','or affiliate to:').br().divc('nbp',$rte);}
if($sub){$nid=hub_import($node,$id,$USE,$frm,$qb,$sub);//sub
$ret=lkc('popw','/'.$nid,'saved in '.$node.'/'.$frm.'/'.$nid);}
return $ret;}

//import
function hub_import($node,$id,$use,$frm,$qb,$suj){$tim=$_SESSION['dayx'];
$r=sql('name,auth','qdb','kv','hub="'.$node.'"');
if($r)foreach($r as $k=>$v)$ath=$k==$use?$v:'';
$rw=sql('*','qda','a','id="'.$id.'"'); $re=$ath>4?1:0; unset($rw['id']);
$rw['ib']=$suj!='ok'?$suj:''; $rw['nod']=!$node?$qb:$node;
$nid=sqlsav('qda',$rw); if($nid)return sqlsavi('qdm',[$nid,'['.$id.':import]']);}

#assistants
function assistant($id,$j,$jv,$va,$chk){
$idb=is_array($jv)?$jv[0]:strto($jv,"'"); $bi='';
if($jv)$help=msql::val('lang','connectors_all',$idb);
if($help && !is_array($help))$bi=strpos($help,'§');//prop_detect
$ret=goodarea($id,!is_numeric($va)?$va:'',36,0);
if($chk or $bi)$ret.='§'.input('cnp',$chk); 
else $ret.=hidden('','cnp','');
$ret.=ljj('popsav',$j,$jv,'ok');
return divs('width:320px;',$ret);}

function mbd_conn($p,$va,$pid='',$rid=''){$ret=''; switch($p){
case('url'): $ret=mbd_url($va,$rid); $t='URL or ID article'; break;
case('art'): $ret=mbd_art($va,$rid); $t='ID article'; break;
case('img'): $ret=mbd_upload($va); $t=nms(78); break;
case('table'): $ret=mbd_mktable($va); $t='table'; break;
case('nh'): $ret=mbd_footnotes($va,1); $t='footnotes'; break;
case('css'): $ret=assistant('cnn','embed_css',$p,'',''); break;
case('color'): $ret=mbd_color($p); break;
case('bkgclr'): $ret=mbd_color($p); break;
case('conn'): $p=''; break;
case('video'): $ret=mbd_video($va); break;
case('popvideo'): $ret=mbd_video($va); break;
case('replace'): $ret=mbd_replace($va); break;
case("delconn"): $ret=mbd_delconn($va); break;
case('book'): $ret=mbd_book($p); $t='mk_book'; break;
case('paste'): $ret=mbd_paste(); $t=nms(86); $s=600; break;
case('microform'): $ret=mbd_forms($p); $t='user_form'; break;
case('microsql'): $ret=mbd_msql(); $t='select_microbase'; break;
case('formail'): $ret=mbd_forms($p); $t='form_for_mail'; break;
case("call_url"): $ret=mbd_vacuum(); $t=helps('import_art'); break;//from embpop
//case("import"): $ret=mbd_vacuum(); $t=helps('import_art'); break;
case("importart"): $ret=mbd_importart(); $t=helps('import_art'); break;////to do
case('radio'): require('plug/radio.php'); $ret=radio_select(); $t='mp3 directory '; break;
case('module'): $ret=mbd_editcomm($p); break;
case('ajax'): $ret=mbd_editcomm($p); break;
case('articles'): $ret=mbd_editcomm($p); break;
//case('svg'): $ret=mbd_editsvg($p); break;
case('search'): $t=nms(26); break;
case('rss_art'): $t='xml_url'; break;
case('rss_read'): $t='philum distant_article'; break;
case('iframe'): $t=nms(51).' (.txt)'; break;
case('scan'): $t=nms(51).' (.txt)'; break;
case('preview'): req('pop,art,tri,spe'); $t=nms(65); $va=embed_links($va); 
	$ret=conn::read($va,'',''); break;
case('display'): $ret=divc('panel',$va); break;}
if($p)if(strpos('forumchatpetitionlast-update',$p)!==false)$va=ses('read');
if(!$ret)$ret=assistant('cnv','insert_conn',$p,$va,'');
return $ret;}

//command
function mbd_editcomm($d){req('adminx');
if($d=='module')return mod_edit_pop(1);
if($d=='ajax')return mod_edit_pop(0);
if($d=='articles')return artmod_edit($d);}

//links//jr:future connedit will need refer id
function mbd_url($d,$id){return assistant('url','embed_url_j',['url',$id],'http://','');}
function mbd_art($d,$id){return assistant('art','embed_art_j',['art',$id],'ID article','');}
function mbd_vacuum(){$id=$_SESSION['read'];
	//$va=$_SESSION['rqt'][$_SESSION['read']][9];
	$va=sql('mail','qda','v','id='.$id);
	return assistant('urlsrc','SaveIb',$id,$va,'');}
function mbd_importart(){//to do
	return assistant('urlsrc','SaveI','','','');}

function mbd_msql(){//insert
$r=explore('msql/users','files',1);
if($r)foreach($r as $k=>$v){$v=substr($v,0,-4); list($nd,$bs,$sv,$svv)=explode('_',$v);
	if($nd==$_SESSION['qb'] && $sv!='sav' && $svv!='sav')$rb[$v]=$bs.($sv?'_'.$sv:'');}
asort($rb); if($r)foreach($rb as $k=>$v){if($v)
	$ret.=ljb('popbt','insert_close','['.$k.':microsql]',$v).br();}
return scroll($r,$ret,22);}

function mbd_video($v){
$ret=divc('small',helps('video'));
if($v)$ret.=input1('url',$v); 
else $ret.=autoclic('" id="url','ID / URL','','100','');
$ret.=lj('popsav','url_extractid_url_5_','ok').' ';
if(auth(4))$ret.=hlpbt('popvideo');
return $ret;}

//user_forms
//'[day=date,choice1/choice2=list,entry1=entry,message=text,mail=mail,ok=button:microform]';
//'[case=check,Name,Email=email,Message=text,Send=button:formail]';
function mbd_forms($d){
if($d=='microform')$r=['button'=>'ok','input'=>'value','text'=>'message','mail'=>'mail','date'=>'day','list'=>'choice1/choice2','radio'=>'choice1/choice2','hidden'=>'value','uniqid'=>'uid'];
if($d=='formail')$r=['check'=>'case','input'=>'Name','mail'=>'Email','text'=>'Message','button'=>'Send'];
$ret=select(['id'=>'cna','onchange'=>'jumpslct(\'cnb\',this)'],array_flip($r),'kv');
$ret.=input1('cnb','').' ';
$ret.=ljb('popbt','jumpMenu_addtext','cnv_cna_cnb_=_,','add').br();
$ret.=assistant('cnv','insert_conn',$d,'','');
return $ret;}

function mbd_color($cnn){$klr=msql_read('system','edition_colors','',1);
$sty='padding:0 5px; background-color:#'; foreach($klr as $k=>$v){
	$ret.=ljj($k,'jumpvalue',['cnp',$k],bts($sty.$v,'.')).' ';}
return $ret.br().br().assistant('cnv','insert_conn',$cnn,'','');}

function mbd_replace($d){
$ret='search: '.textarea('resr',$d,25,1).br().' replace: '.textarea('repl','',25,1);
$ret.=lj('popsav','txarea_filters_txtarea__replace____resr|repl','ok');
return $d?$ret:'select text to replace';}

function mbd_delconn($d){
$ret='del conn: '.input('dlc','');
$ret.=ljb('popsav','delconnx','dlc','ok');
return $d?$ret:'select text to replace';}

function mbd_paste(){$ret=diveditbt('');
$ret=btn('right',lj('popbt" id="bts','txtarea_convhtml_txtareb_5',nms(86)));
$ret.=div(' contenteditable id="txtareb" class="panel justy" style="padding:10px; border:1px dotted grey; min-width:550px; min-height:240px;"','<br>');
return $ret;}

function mbd_book($cnn){req('adminx');
$ret=btn('txtcadr','param [,]');
$ret.=divd('amc',artmod_edit_l('cnv','',''));
$ret.=assistant('cnv','insert_conn','book','','title/1/book');
$ret.=br().helps('book');
return $ret;}

//upload
function uplim($a,$b,$res){
req('spe,tri'); $u=ajxg($res);
//$u=html_entity_decode($u);
//$u=html_entity_decode_b($u);
$u=utf8_decode_b($u);//do htent_b
$im=conn::get_image($u,ses('read'));
if($im)return '['.$im.']';}

function mbd_upload($id){
req('spe'); $id=ses('read');
$id=$id?$id:lastid('qda')+1;
$ret=input1('upim','Url','32','',1).' ';
$ret.=ljc('popsav','popb','pop-ajxf_uplim___upim',nms(132),5).br();
$ret.=toggle('txtx',$id.'up_placeim_'.$id,'portfolio').' ';
$ret.=upload_j($id,'art');
return divs('width:320px;',$ret);}

function recenseim($id,$imx=''){req('tri');
$msg=sql('msg','qdm','v','id='.$id); $r=[]; $rb=[]; $re=[]; $ret='';
$ims=codeline::parse($msg,$id,'extractimg'); //echo $ims.'--';
if($ims){$ra=explode('/',$ims); foreach($ra as $k=>$v)$re[$v]=$v;}
if(!$imx)$imx=sql('img','qda','v','id='.$id); if($imx)$r=explode('/',$imx);
if($r)foreach($r as $k=>$v)$rb[$v]=$v;//im in msg
if($rb)foreach($rb as $k=>$v)if($v && !is_numeric($v)){$w=1;//del bad img
	if(!is_file('img/'.$v))unset($rb[$k]);
	else list($w)=getimagesize('img/'.$v); if(!$w)unset($rb[$k]);}// or !isset($re[$v])
if($re)foreach($re as $k=>$v)if($v){//add forgotten img
	if(!isset($rb[$v]) && is_file('img/'.$v))$rb[$v]=$v;}
if($rb)$ret=implode('/',$rb); //update('qda','img',$ret,'id',$id);
return '/'.$ret;}

function orderim($id){
$ims=sql('img','qda','v','id='.$id); $r=explode('/',$ims); 
if($r)foreach($r as $v)if(is_file('img/'.$v)){list($w,$h)=getimagesize('img/'.$v); $rb[$w]=$v;}
if(isset($rb)){krsort($rb); return '/'.implode('/',$rb);}}

function placeimdel($id,$x){
$ims=sql('img','qda','v','id='.$id); $r=explode('/',$ims);
if(auth(5) && $x){img::rm($id,$x); req('tri');
	if(is_file('img/'.$x))unlink('img/'.$x); if(is_file('imgc/'.$x))unlink('imgc/'.$x);
	if($k=in_array_b($x,$r))unset($r[$k]); 
	$ims=implode('/',$r); if(is_numeric($ims))$ims='';
	update('qda','img',$ims,'id',$id); conn::replaceinmsg($id,'['.$x.']','');
	$rb[0]=placeim($id); $rb[1]=$ims; return mkjson($rb);}}

function placeim($id){$ret='';
$ims=sql('img','qda','v','id='.$id); $r=explode('/',$ims);
if($r)foreach($r as $k=>$v)if(is_image($v)){
	$im=make_mini('img/'.$v,'imgb/'.$v,'','',$_SESSION['rstr'][16]);
	$ret.=ljb('','insert','['.$v.']',image($im,'72','',att($v)));
	if(auth(6))$ret.=lj('popdel','pim'.$id.',img'.$id.'_placeimdel__json_'.$id.'_'.ajx($v),'x');}
return scroll_b($r,$ret,12,320,320);}

function placeimtrk($f,$id){$ret=''; $fb=img::thumbname($f,72,72);
$im=make_mini('img/'.$f,$fb,'','',1);
$ret=ljb('','insert_b',['['.$f.']',$id],image('/'.$im,'72','72',att($f)));
//if(auth(6))$ret.=lj('popdel','pim'.$id.',img'.$id.'_placeimdel__json_'.$id.'_'.ajx($f),'x');
return $ret;}

function art_gallery($id){
if(!$d)$d=sql('img','qda','v','id='.$id); $r=explode('/',$d);
if($r)foreach($r as $v)if($v)$ret.=popim($v,make_thumb($v,$id),$id);
return $ret;}

function art_retape($ret,$id){
$r=msq_ses('oldconn','system','connectors_old',1); if($r)$rk=array_keys($r);
$ret=delbr($ret,"\n"); $ret=clean_br($ret); return str_replace($rk,$r,$ret);}

//table
function mktc($na,$nb,$o,$d){$r=ajxr($d); $i=0; $opt=$o?'§'.$o:''; $ret='';
for($b=0;$b<$nb;$b++){for($a=0;$a<$na;$a++){$ret.=$r[$i].'|'; $i++;} $ret.='¬';}
return '['.$ret.$opt.':table]';}

function mktb($na,$nb,$d){
list($na,$nb)=ajxp($d,$na,$nb); $bt=''; $md='';
for($b=0;$b<$nb;$b++){$td='';
	for($a=0;$a<$na;$a++){$id='r'.$b.'c'.$a; $md.=$id.'|';
		$cell=ceil((40/$na)-($na/7));
		$td.=balb('td',input1($id,'',$cell>0?$cell:1));}//
	$bt.=balb('tr',$td);}
$ret=balb('table',$bt);
$j='mkb_mktable__5_'.$na.'_'.$nb;
$ret.=lj('popsav',$j.'___'.$md,'table').' ';
$ret.=lj('popsav',$j.'_1__'.$md,'+headers').' ';
$ret.=lj('popsav',$j.'_div__'.$md,'divtable');
$ret.=divd('mkb','');
return $ret;}

function mkt_build($d){
$d=str_replace(',','|',$d); $d=str_replace("\n",'¬',$d); $h=hidden('','mktb',$d);
return lj('popbt','socket_jump__5_____mktb','ok').$h;
return ljb('popbt','insert',ajx($d),'ok');}

function mbd_mktable($d){
if($d)return mkt_build($d);
$j=sj('mkt_call___ajxf_mktb___col|row');
$p=atz('2').atb('onkeyup',$j).atb('onclick',$j);
$ret='cols: '.input('col',2,$p).' ';
$ret.='rows: '.input('row',3,$p).' ';
//$ret.=hlpbt('tables');
$ret.=divd('mkt',mktb(2,3,'2|3'));
return $ret;}

#admin

//cook
function cookprefs($p){
$r=['iq'=>ses('iq')];
$ex=sql('id','qdk','v',$r);
if($ex)sqlup('qdk',['ok'=>$p],'id',$ex);
else{$r+=['ok'=>$p,'usr'=>'','time'=>mysqldate()]; $ex=sqlsav('qdk',$r,1);}
if($ex)ses('iqa',$p);}

//admin
function admin_call($d,$va,$opt){
if($d=='all')return admin('');
$_GET['admin']=$d;
if($d=='design')$d='css';
if($d=='newsletter')req('mod,art');
if($d=='desktop'){req('adminx'); $ret=adm_desktop('','',$va);}
elseif($d=='Microsql'){req('msql'); $ret=msql_adm($va?$va:murl_boot());}
elseif($d=='editor'){$ret=plugin('editor');}
elseif($d=='action'){req('adminx'); $ret=adm_actions($va,$opt);}
elseif($d=='css')return '/admin/css';
elseif($d=='css')$ret=adm_editcss();
elseif($d=='conn_help')$ret=conn_help();
elseif($d=='txt' or $d=='pad')$ret=$d::home($opt,'');
elseif($d=='plug')$ret=plugin($d,$opt,'');
elseif($d=='api')$ret=plugin('apicom','',1);
elseif(function_exists('adm_'.$d))$ret=call_user_func('adm_'.$d,$va,$opt);
else return admin('nohead');
$admin_lg=voc($d,'admin_authes');
$t=divc('txtit',lk('/admin/'.$d,$admin_lg));
return divd('admcnt',$t.$ret);}

//rstr
function rstr_sav($d){
if($d)$_SESSION['rstr'][$d]=rstr($d)?'1':'0';
if(auth(6))backup_rstr('save');
return 'rstr'.$d.': '.offon(rstr($d));}

#apps
//desktop
function medium_clr($g){$r=explode(',',$g); $oa=0; $ob=0;
foreach($r as $k=>$v){if(substr($v,0,1)=='#'){$oa+=hexdec(substr($v,1)); $ob++;}}
if($ob)return dechex($oa/$ob);}

function randimg($dr){
$r=explore($dr); $n=count($r); return $dr.'/'.$r[rand(0,$n-1)];}

function desk_css(){$klr='';
$prmd=$_SESSION['prmd']; if(isset($_SESSION['negcss']))$prmd.='_neg';
$clr=getclrs($prmd); req('styl');
$g=prma('desktop'); //sesmk('desklr');
if($g){req('spe'); $g=goodroot($g);}
if(is_dir($g))$ret='background:url('.randimg($g).') no-repeat center fixed; background-size:cover;';
elseif(is_image($g))$ret='background:url('.goodroot($g).') no-repeat center fixed; background-size:cover;';
elseif(strpos($g,',')===false && $g){$ret='background-color:'.affect_rgba($g,$clr).';'; $klr=$g;}
else{$g=affect_rgba($g,$clr); $gh=$g?$g:'#'.$clr[4].',#'.$clr[2]; $klr=medium_clr($gh);
	if(!$g)$g='to bottom, '.hexrgb($clr[4],0.4).', '.hexrgb($clr[1],1).'';
$ret='height:100%; background:linear-gradient('.$g.') no-repeat fixed;';}
return css_code('body {'.$ret.'}
	#desktop a, #desktop .philum {color:#'.invert_color($klr,1).';}
	#desktop #page {padding:0; margin:0 40px 0 0; border:0; box-shadow:none;}');}

function desktop_root($id,$va,$opt,$optb){poplist();
if($id=='varts' or $id=='files' or $id=='explore' or $id=='menubub' or $id=='overcats')req('mod');
if($id=='arts')req('pop,spe,art,mod');//,tri
$r=desktop_apps($id,$va,$opt,$optb); $ret=desktop_build_ico($r,'icones');
return $ret.divs('clear:left;','');}

function desktop_ico($id){$r=desktop_apps($id,'','','');
return desktop_build_ico($r,'');}

function desktop_load($id){if($id)$r=desktop_cond($id);//deskload
else $r=['desktop_desk___desk','page_deskbkg','popup_site___desktop_ok__autosize'];
//$r[]='bub_';//del admin
if($r)return implode(';',$r);}

function apps_read($id){
$r=msql::row('',nod('apps'),$id); $ra[$id]=$r;
$ret=m_apps($ra,$r[5],$r[6],$r[3],$r[4]);
return desktop_build_ico($ret,'icones').divc('clear','');}

#wyg
function wygbt($id,$o){
if($o)return lja('',atj('saveart',$id),picto('save','','active'));
else return lja('',atj('editart',$id),picto('editor'));}

function artsconn($id){
$d=sql('msg','qdm','v','id='.$id); $d=codeline::parse($d,'','sconn'); 
$d=embed_p($d); return nl2br($d);}

function wygopn($id){
$bt=wygbt($id,1);
$edt=diveditbt($id);
$d=artsconn($id);
$ret=mkjson([$d,$edt,$bt,$bt]); //$er=json_error(); if($er)echo $er; else
return $ret;}

function savwyg($d,$id,$o=''){//continue
$_GET['urlsrc']=host(); ses('read',$id);
$d=html2conn_b($d); $d=modif_art($id,$d);
if($o==1)$ret=artsconn($id); else $ret=conn::read($d,3,$id);
return $ret;}

function wygsav($d,$id){//terminate
$bt=wygbt($id,0); $edt=''; $d=savwyg($d,$id);
return mkjson([$d,$edt,$bt,$bt]);}

#connectors
//convhtml
function html2conn_b($ret){//$ret=str_replace('<br />',"\n",$ret);
//$ret=str_replace("\r","\n",$ret); $ret=preg_replace("/(\n){2,}/","\n\n",$ret);
$ret=decode_unicode($ret); $ret=embed_links($ret); $ret=conv::call($ret);
$ret=html_entity_decode_b($ret); $ret=html_entity_decode($ret); $ret=clean_prespace($ret);
$ret=str_replace(['img/','users/'],'',$ret); //$ret=str_replace('[users/','[',$ret);
return $ret;}

function edit_filters($id,$va,$opt,$res){
if($va=='cleanbr')$rt=clean_br($id);
elseif($va=='cleanmail')$rt=cleanmail($id);
elseif($va=='cleanpunct')$rt=clean_punct($id,2);
elseif($va=='cleanpdf')$rt=clean_pdf($id);
elseif($va=='striplink')$rt=codeline::parse($id,'striplink','correct');
elseif($va=='converthtml'){$rt=conv::call(nl2br($id)); $rt=post_treat_repair($rt);}
//elseif($va=='easytables')$rt=str_replace("\n","¬\n",$id);
elseif($va=='addlines')$rt=add_lines($id);
elseif($va=='addanchors')$rt=add_anchors($id);
elseif($va=='deltables')$rt=del_tables($id);
elseif($va=='delqmark')$rt=del_qmark($id);//old
elseif($va=='imglabel')$rt=add_comments($id);
elseif($va=='oldconn'){req('pop'); $rt=art_retape($id,$va);}
elseif($va=='replace'){list($rep,$by)=ajxr($res); $rt=str_replace($rep,$by,$id);}
elseif($va=='randim'){$_POST['randim']=1; $read=$_SESSION['read'];
	if(is_numeric($read))update('qdm','msg',$id,'id',$read);
	req('spe,pop'); $ret=conn::read($id,3,$read);
	$rt=sql('msg','qdm','v','id='.$read); $_POST['randim']=0;}
elseif($va=='revert')$rt=sql('msg','qdm','v','id='.$_SESSION['read']);
elseif($va=='postreat')$rt=conv::post_treat($id,$va,$opt);
elseif($va=='delh')$rt=str_replace([':h1',':h2',':h3',':h4',':h5'],':h',$id);
elseif($va=='inclusive')$rt=clean_inclusive($id);
elseif($va=='citai')$rt=mk::citations($id,'i');
elseif($va=='citaq')$rt=mk::citations($id,'q');
return txarea1($rt);}

//dsnav
function conn_props_b($n){$ret='';
$r=msql_read('system','connectors_all','',1); ksort($r);
foreach($r as $k=>$v)if($v[2]==$n)$rb[$k]=[$v[0],$v[1]];
$help=msql_read('lang','connectors_all','');
if($rb)foreach($rb as $k=>$v){
	if($help[$k])$hlp=stripslashes($help[$k]); else $hlp='';
	if($v[0]=='embed'){if($v[1])$v[0]='embed_slct'; else $v[1]=$k;}
	$ret.=ljb('',$v[0],$v[1],$k,'',att($hlp)).' ';}
return divc('list',$ret);}

function conn_del($d,$id){$ret='';
$r=msql_read('system','connectors_all','',1); ksort($r); $hlp=nms(76);
$ret.=lj('','cnndl_navs___del2_'.$id,'media');
foreach($r as $k=>$v)if($v[2]==$d)$ret.=ljb('','conn','_delconn_'.$k,$k,'',att($hlp.' '.$k)).' ';
$ret.=ljb('','captslct','delconn','any','',att('del any'));
$ret.=ljb('','conn','_delconn','all','',att('del all'));
return divb($ret,'list','cnndl');}

//ascii
function ascii4($p,$id){$ret=lj('txtx','nvascii4_navs___ascii4__'.$id,picto('back'));
$r=msql::read('system','edition_ascii_11','',1);
foreach($r as $k=>$v)if($v[1]==$p){
	if(is_numeric($v[0]))$va='&#'.$v[0].';'; elseif(mb_strlen($v[0])==1)$va=$v[0]; else $va='&'.$v[0].';';
	$ret.=ljb('','insert_b',[$va,$id],$va,'',att($v[0])).' ';}
return $ret;}

function unicodeslct($p,$id){
$r=msql::read('system','edition_ascii_10',$p,1);
$ret=divb($r[0],'tit'); $a=hexdec($r[1]); $b=hexdec($r[2]);
for($i=$a;$i<=$b;$i++){$va='&#'.$i.'; ';
$ret.=btj($va,atjr('insert',[$va,$id]),'ascii','',$i).' ';}
return $ret;}

function unicode($p,$id){
$r=msql::read_b('system','edition_ascii_10','',1);
$ret=lj('txtx','nvascii4_navs___ascii4_'.$id,picto('back')).' ';
$ret.=lj('txtx','nvascii4_call___ajxf_unicode__'.$id,'nocat').' ';
$rc=msql::cat($r,3); foreach($rc as $k=>$v)$ret.=lj('txtblc','nvascii4_call___ajxf_unicode_'.$k.'_'.$id,$k).' ';
foreach($r as $k=>$v)if((!$p && !$v[3]) or $p==$v[3])$ret.=lj('','asc4_call___ajxf_unicodeslct_'.$k.'_'.$id,$v[0]).' ';
if(auth(6))$ret.=msqbt('system','edition_ascii_10');
$ret.=divd('asc4','');
return $ret;}

function navs($op,$id=''){$ret='';
if(is_numeric($id)){$read=$id; $id='';} else $read='';
if($op=='ascii4'){$r=msql::read_b('system','edition_ascii_11','',1); $r=msql::cat($r,1);
	$ret.=lj('','nv'.$op.'_call___ajxf_unicode__'.$id,picto('globe')).' ';
	foreach($r as $k=>$v)$ret.=lj('','asc4_call___ajxf_ascii4_'.$k.'_'.$id,$k).' ';
	$ret.=lj('txtx','popup_plup___ascii',picto('icons'));
	if(auth(6))$ret.=msqbt('system','edition_ascii_11');
	$ret.=divd('asc4','');}
elseif($op=='pictos'){$r=msql_read('system','edition_pictos','',1);
	foreach($r as $k=>$v)$ret.=ljb('','insert_b',['['.$k.'§16:picto]',$id],picto($k),'',att($k)).' ';
	$ret.=lj('txtx','popup_plup___pictocss','table');
	if(auth(6))$ret.=msqbt('system','edition_pictos');}
elseif($op=='glyphs'){$r=msql_read('system','edition_glyphes_1','',1);
	if($r)foreach($r as $k=>$v)$ret.=ljb('','insert_b',['['.$v.'§32:glyph]',$id],glyph($k)).' ';}
elseif($op=='oomo'){$r=msql_read('system','edition_pictos_2','',1);
	if($r)foreach($r as $k=>$v)$ret.=ljb('','insert_b',['['.$k.'§32:oomo]',$id],oomo($k,32),'',att($k.' ('.$v[1].')')).' ';}
elseif($op=='uc'){$r=msql_read('',$_SESSION['qb'].'_connectors','',1);
	if($r)foreach($r as $k=>$v)$ret.=ljb('','insert_mbd','[\',\'\',\':'.$k.']',$k).' ';}
elseif($op=='sc'){$r=msql_read('','public_connectors','',1);
	if($r)foreach($r as $k=>$v)$ret.=ljb('','insert_mbd','[\',\'\',\':'.$k.']',$k).' ';}
elseif($op=='codeline'){$bt='';
	$r=msql_read('system','connectors_codeline','',1); ksort($r);
	$rb=msql_read('lang','connectors_codeline','',1);
	if($r)foreach($r as $k=>$v){$tt=isset($rb[$k])?att($rb[$k]):'';
		$ret.=ljb('','insert_b',['['.$v.':'.$k.']',$id],$k,'',$tt).' ';}}
elseif($op=='backup'){//$read=$_SESSION['read'];//$id?$id:
	$nod=$_SESSION['qb'].'_backup_'.$read; $nodb=ajx($nod,'');
	if($read){$r=msql_read('',$nod,'',1); $k=0;
		if($r)foreach($r as $k=>$v)$rb[$k]=['bckp_backup_txtarea_3_'.$nodb.'_'.$k.'_','txarea_restore___users_'.$nodb.'_'.$k,'bckp_backdel___'.$nodb.'_del_'.$k];//txtarea
		if(isset($rb))foreach($rb as $k=>$v)
			$ret.=lj('',$v[0],'backup'.$k).lj('',$v[1],'restore'.$k).lj('',$v[2],'delete '.$k).br();
		$ret.=lj('popbt','bckp_backup_txtarea__'.$nodb.'_'.($k+1),'+ new').' ';//txtarea
		$ret.=lj('popbt','txarea_filters_txtarea__revert','/ revert').' ';
		$ret.=lja('popbt','revert()','<- last saved').' ';
		$ret.=msqbt('',$nod);}
	if($ret)$ret=divb($ret,'','bckp'); else 'available only while editing';}
elseif($op=='del')$ret=conn_del('html',$id);
elseif($op=='del2')$ret=conn_del('media',$id);
elseif($op=='disk')$ret=finder::home(ses('qb'),'disk///disk/conn//mini');
elseif($op=='icons')$ret=finder::home('','disk///icon/conn//mini');
else $ret=conn_props_b($op);
return divb($ret,'nbp','nv'.$op,'min-width:300px; max-width:680px;');}

#batch
function batch_add($p,$o,$res){$f=ajxg($res); $f=utmsrc($f);
list($t,$d)=conv::vacuum($f); vacses($f,'b',$d); vacses($f,'t',$t);
return batch('','');}

function batch($f,$d){$f=utmsrc($f); $fb=vacurl($f);
$idt='adc'; if($d=='c')$idt.='p';//bub
if($f=='z'){req('sav,spe,art,tri,mod'); return save_art_batch();}
if(substr($f,0,4)!='http' && $f && $f!='x' && $f!='1')$f=http($f);
if($f=='x')$_SESSION['vac']=[]; $ret='';
if(trim($f) && $f!='1' && $d!='1' && $f!='x' && $d!='x' && !isset($_SESSION['vac'][$fb]['b']))
	if(joinable($f)){list($t,$tx)=conv::vacuum($f); vacses($f,'t',$t);}
if($d=='x')unset($_SESSION['vac'][$fb]);
if($d=='n')return input('bad',$p).' '.lj('',$idt.'_call__3_ajxf-tri_batch*add___bad',picto('ok')).' ';
if($d=='p')return 'ok';
if($d=='c')$ret=lja('',sj('popup_batch').' closebub(this);',picto('popup')).' ';
$ret.=lj('',$idt.'_batch____in_'.$d,picto('reload')).' ';
$ret.=lj('',$idt.'_batch____n',picto('add')).' ';
$ret.=lj('',$idt.'_batch___x_1',picto('del')).' ';
$ret.=lj('','popup_rssjb___rssurl_',picto('rss')).' ';
$ret.=lj('',$idt.'_batchfbi__3',picto('update')).' ';
$ret.=lj('','page_deskbkg',picto('desktop')).' ';
$ret.=msqbt('',ses('qb').'_rssurl').' ';
$r=ses('vac'); //if($r)$r=array_reverse($r);
if($r)$ret.=lj('popsav',$idt.'_batch___z_1',picto('save')); $i=0;
if($r)foreach($r as $k=>$v){$i++;//
	//if(!$v['b'] && $u!='http://loading...'){list($t,$msg)=conv::vacuum($u,'');
	//	vacses($f,'t',$t); vacses($f,'v',$msg);}
	if(!isset($v['t']))$suj='no_title'; else $suj=$v['t'];
	$u=$v['u']??''; $kb=ajx($u); $cat=$v['c']??'';
	$rid=randid('bth');
	$btb=lj('','popup_vacuum___'.$kb,picto('view')).' ';
	$btb.=slct_cat($rid,$cat,$i).' ';
	//$btb.=select_j($rid,'category',$cat,3,$cat?$cat:picto('filelist'));
	$btb.=saveiec($kb,$cat,$rid).' ';
	$btb.=lj('','popup_search__3_'.ajx($suj).'_',picto('search'));
	$btb.=lkt('small',$u,pictxt('url',domain($u)),att(preplink($u).' '.$suj));
	$btb.=lj('',$idt.'_batch___'.$kb.'_x',picto('del')).br();
	$ret.=divc('small',$btb.$suj);}
if($d!='in')$ret=div(atd($idt).ats('padding:2px; min-width:320px;'),$ret);
return scroll_b($i,$ret,10);}

function slct_cat($id,$t,$n){return hidden($id,$id,$t).ljp(atd('adcat'.$id),'popup_addCat___'.$id.'_'.$id.'_'.$n,$t?$t:picto('filelist'));}//menuder_jb//slct_category

function batch_prep($v){$http=strto($v,'/'); req('pop'); 
$rss=rss::load(http($v)); $vac=$_SESSION['vac'];//pr($rss);
foreach($rss as $k=>$v){list($suj,$f,$dat,$id)=$v; $f=(string)$f;
if($id)break; elseif($f && !vacses($f,'u')){$fb=vacurl($f);
$_SESSION['vac'][$fb]=['t'=>$suj,'d'=>$dat,'u'=>$f];}}}

function batchfbi(){req('pop'); $ret=hlpbt('rssurl_1').br();
$r=msql::read('',nod('rssurl'),'',1); $r=msql::tri($r,3,1);
if($r)foreach($r as $k=>$v)batch_prep($v[0]);
return batch('','in');}

function art_preview($f){req('pop,spe,tri');
$fb=http($f); $_GET['urlsrc']=$fb;
list($t,$d)=conv::vacuum($fb); vacses($fb,'t',$t); $d=clean_html($d,1); $d=embed_links($d);
$d=clean_br_lite($d); $d=clean_punct($d); $d=conn::read($d,'','test');
return balb('section',balb('h1',$t).bal('article',atc('justy'),$d));}

function batch_preview($f,$sug=''){req('pop,spe,tri');
$fb=http($f); $_GET['urlsrc']=$fb; $ret=''; //if(!auth(4))return;
list($t,$d)=conv::vacuum($fb); vacses($fb,'t',$t); $d=clean_html($d,1); $d=embed_links($d);
$d=clean_br_lite($d); $d=clean_punct($d);
$d=conn::read($d,'','test');
$sty=atc('justy'); if(strlen($d)>400)$sty.=atd('scroll'); $titl=balb('h2',$t);
$_SESSION['sugm']=$sug; $rid=randid('btch');
if(auth(6)){$rel=lj('','popup_vacuum__x_'.ajx($f).'_',pictit('reload',nms(101))).' ';
	$rel.=lj('','socket_batch___'.ajx($f).'_x',picto('del')).' ';
	$rel.=lj('','popup_addArt__x_'.ajx($f).'_1',picto('edit')).' ';
	$titl.=$rel.urledt($f).' '; $titl.=lkt('',$fb,picto('url')).' ';
	$titl.=newartcat($fb);}
$ret.=balb('section',balb('header',$titl).bal('article',$sty,$d));
return $ret;}

function putses($d,$v){
if($d!='auth' && $d!='USE')$_SESSION[$d]=$v;}

function wyg_preview(){
$j='popup_sitewatch__inpsit';
$bt=inputj('inp',$p,$j);
$bt.=lj('popbt',$j,picto('ok'));
return $bt;}

?>