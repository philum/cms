<?php
//philum_ajx_functions

#popup
function photos_art_bt($p,$sz,$id){
$d=sql('img','qda','v','id='.$id); $r=explode('/',$d);
//list($r,$dir)=decide_source($doc,$id);
foreach($r as $k=>$v)if($v==$p)$n=$k;
$ima=$r[$n-1]?$r[$n-1]:$r[$k]; $imb=$r[$n+1]?$r[$n+1]:$r[1];
if($ima){list($w,$h)=fwidth('img/'.$ima); $wd='_'.$w.'_'.$h.'_'.$sz;
	$ret=lj('','popup_photo__x_'.ajx('img/'.$ima,'').$wd,picto('kleft')).' ';}
if($imb){list($w,$h)=fwidth('img/'.$imb); $wd='_'.$w.'_'.$h.'_'.$sz;
	$ret.=lj('','popup_photo__x_'.ajx('img/'.$imb,'').$wd,picto('kright')).' ';}
if($k>1)return $ret;}

function photo_screen($im,$w,$h,$sz){$ng=ses('negcss')?'_neg':'';
$klr=$_SESSION['clrs'][$_SESSION['prmd'].$ng];
list($sw,$sh,$ph,$id)=explode('-',$sz); $sw-=60; $sh-=40;
$id=is_numeric($id)?$id:$_SESSION['read']; if(!$id)list($hub,$id,$nm)=explode('_',$im); 
if(!$w && !$h)list($w,$h)=fwidth($im);
if($w && $h)$r1=($w/$h); $r2=($sw/$sh); $ml=($sw-$w)/2; $mt=($sh-$h)/2; $nw=$w; $nh=$h;
if($r1>$r2){if($w>$sw){$ml=0; $nw=$sw; $nh=$h*($sw/$w); $mt=($sh-$nh)/2;}}
else{if($h>$sh){$mt=0; $nh=$sh; $nw=$w*($sh/$h); $ml=($sw-$nw)/2;}}
if($id)$o=photos_art_bt(substr($im,4),$sz,$id); $rid='imz'.randid();
$o.=lkt('',$im,picto('url')).' ';
if($w>$nw or $h>$nh)$o.=lj('','pagup_overim__x_'.ajx($im).'_'.$sz,picto('fullscreen')).' ';
$cs1=atd('popu').ats('position:absolute; width:'.($nw).'px; height:'.($nh).'px; box-shadow:0 0 100px 10px #000; z-index:-1;"');
$popa=popa(' ',$o);//strrchr_b($im,'/')
if(substr($im,0,4)!='http')$im='/'.$im;
return $popa.div($cs1,divd($rid,image($im,round($nw),round($nh))));}

function overim($im,$sz){//list($sw,$sh)=explode('-',$sz);
$s='overflow:auto; text-align:center; width:100%; height:calc(100% - 28px);';
return div(ats($s),img($im,''));}

function video_viewer($iv,$cr_div,$n){
$r=$_SESSION['iv'.$iv]; $_SESSION['cur_div']=$cr_div;
$jx='iv'.$iv.'_vview___'.$iv.'_'.$cr_div.'_';
$ret.=divc('nb_pages right',nb_pages_j($r,$jx,$n));
$ret.=bal('h3',lka(htac('read').$r[$n][0],suj_of_id($r[$n][0])));
$ret.=video_auto(str_extract('§',$r[$n][1],0,1),prma('content'),$r[$n][0],3);
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
$t=lkc('popbt',urlread($read).'#nb'.$id.'" name="#nh'.$id,$id);
$d=sql('msg','qdm','v','id="'.$read.'"');
$pos=strpos($d,'['.$id.':nb]'); $posb=strpos($d,'['.($id+1).':nb]');
if($posb===false)$posb=strpos($d,"\n",$pos);
	$ret=subtopos($d,$pos,$posb);
	$ret=str_replace('['.$id.':nb]',"",$ret);
	if(!is_numeric(substr($ret,0,1)))$ret=substr($ret,1);
	if(!is_numeric(substr($ret,-1)))$ret=substr($ret,0,-1);
return divc('tab justy',$t.format_txt($ret,3,$id));}

function mbd_footnotes($n,$a){
$txt=helps('anchor_select').' "'.$n.'":';
if(!$a)$ret.=ljb('popbt','insert_mbd','[\',\''.$n.'\',\':nb]',$txt).br().btn('txtsmall',helps('anchor_dbclic')).br().br();
else{$ret.=lj('txtx','txarea_filters_txtarea__addanchors','auto_anchors').' ';
$ret.=ljb('','embed_slct','\',\'','()').br();
$ret.=btn('txtsmall',helps('anchor_auto')).br();
$ret.=ljb('txtbox','embed_slct','[\',\':nh]',':nh').' ';
$ret.=ljb('txtbox','embed_slct','[\',\':nb]',':nb').' ';
$ret.=btn('txtsmall',helps('anchor_manual')).br();
$ret.=ljb('txtbox','conn','_delconn_nh',':nh').' ';
$ret.=ljb('txtbox','conn','_delconn_nb',':nb').' ';
$ret.=btn('txtsmall',nms(76));}
return $ret;}

//menuder
function menuder_jb($r,$id,$rid,$opt='',$n=''){//AddCat//menuderj_prep
if($n)$slct=$_SESSION['vaccat'][find_vaccum($n)];
if($r){foreach($r as $k=>$v){$j='';
	if($opt)$j='jumphtml(\'adcat'.$rid.'_'.addslashes($k).'\'); ';
	$j.='jumpvalue(\''.$id.'_'.addslashes($k).'\'); Close(\'popup\');';
	if($n)$j.=' SaveJ(\'socket_call___ajxf_newartcatset_'.$n.'_'.ajx($k).'\')'; //wait url
	$c=$slct==$k?'active':'';
	$ret.=ljb($c,$j,'',$k);}}
$ret=divc('list',$ret);
if($opt==2)$ret.=menuder_inp($id,$rid,'','adcat',$opt);
return $ret;}

function menuder_pop($d,$id,$rid,$opt){
if(strpos($d,'|'))$r=explode('|',$d); elseif(strpos($d,' '))$r=explode(' ',$d);
if(!$r)$r=slct_r($d,'',$opt); $r=array_flip($r);
return menuder_jb($r,$id,$rid,$opt);}

function menuder_inp($id,$rid,$v,$pre,$o){//assistant($id,$j,$jv,$va,$chk);
if($o==1 or $o==3)$bt='getbyid(\''.$pre.$rid.'\').innerHTML=val;';
return input(1,'adc'.$rid,'').lja('popbt','var val=getbyid(\'adc'.$rid.'\').value; 
if(val){'.$bt.' getbyid(\''.$id.'\').value=ajx(val);} Close(\'popup\');','ok');}

function slct_r($d,$o,$vrf=''){
switch($d){case('parent'):$r=newartparent(); break;
	case('category'):$r=$_SESSION['line']; if($r)ksort($r); break;//$r=array(nms(9)=>1); 
	case('tag'):$r=tags_list_nb($o,30); break;//$r=array('tag'=>1); 
	case('lang'):$r=array_flip(explode(' ',prmb(26))); $cl=1; break;
	case('msql'):req('msql'); list($dr,$nd,$vn)=murl_vars($o); $r=msql_read($dr,$nd,'',1);
		//echo $o.'-'.$vrf.':'.$dr.'/'.$nd.'='.$vn.br(); 
		if($r)ksort($r); if($r)$r=array_flip(array_keys($r)); break;
	case('msqlc'):req('msql'); list($dr,$nd,$vn)=murl_vars($o);
		$ra=msql_read($dr,$nd,'','k',1); $vrf=$vn?$vn:0;
		if($ra)foreach($ra as $k=>$v){$v=parse($v[$vrf]); $r[$v]=$v;}
		if($r)ksort($r); break;
	case('plug'):$r=msql_read('system','program_plugs'); if($r)ksort($r); break;
	case('func'):if($o)$r=call_user_func($o); $r=array_keys($r); if($r)ksort($r); break;
	case('pfunc'): list($plg,$fnc,$prm)=explode('/',$o); $r=plugin_func($plg,$fnc,$prm); break;
	case('pfuncb'): list($plg,$fnc,$prm)=explode('/',$o); $r=plugin_func($plg,$fnc,$prm); break;
	default: if(strpos($d,'|'))$r=array_flip(explode('|',$d));
		else $r=array_flip(explode(' ',$d)); break;}
if($r && $cl)$r=array_unshift_b($r,'','x'); //if($r[0])unset($r[0]);
return $r;}

function hidslct_j($id,$d,$vrf='',$o=''){//select_j
if($d=='date')return menuder_inp($id,$id,$vrf,'bt',$o); $r=slct_r($d,$o,$vrf);
if($d=='msql')$o='1'; elseif($d=='msqlc')$o=''; 
elseif($d=='pfuncb')$o=3; elseif($d=='pfunc')$o=1; elseif($d=='tag')$o=1; 
if(is_array($r))foreach($r as $k=>$v){$c=$k==$vrf?'active':''; $k=addslashes($k);
	if(is_array($v) or is_numeric($v))$v=$k; $v=stripslashes($v);
	if(strpos($d,'|')===false)$t=$k?$k:$d; elseif($k)$t=$k; elseif($vrf)$t=$vrf; else $t='';
	if($t=='-')$t='...';
	if($v)$ret.=ljb($c,'selectj',$id.'\',\''.$k.'\',\''.ajx($t).'\',\''.$o,$v);}
if($o>=2)$ret.=menuder_inp($id,$id,$vrf,'bt',$o);
return divc('list',$ret);}

//addart
function addart_sav($f,$va,$pub,$ib){if($f=='Url')return;
$_POST['urlsrc']=$f; $_POST['name']=$_SESSION['USE']; $_SESSION['frm']=$va;
if(substr($f,0,4)!='http' && $f)$f='http://'.$f; //$read=$_SESSION['read']; 
list($defid,$r)=verif_defcon($f); if($f)$auv=auto_video($f);
if($defid or $auv){req('sav,boot'); //if(rstr(10))
	$_POST['ib']=$ib; $_POST['pub']=$pub; save_art(); $ret=$_GET['read'];}//
else $ret=popup('Article',f_inp('',$f));
return $ret;}

function addart_new($msg,$id,$res){req('boot');
list($suj,$frm,$urlsrc,$date,$name,$mail,$ib,$pub)=ajxr($res);//,$sub
$_POST['msg']=str_replace("\n","\r",$msg); $_POST['suj']=$suj; $_SESSION['frm']=$frm; 
$_POST['urlsrc']=$urlsrc; $_POST['postdat']=$date; $_POST['mail']=$mail; 
$_POST['name']=$name; $_POST['ib']=$ib; $_POST['pub']=$pub; //$_POST['sub']=$sub;
return save_art();}

//urlsrc
function art_import($res){$f=ajx(trim($res),1); 
$f=utmsrc($f); $f=http($f); $_GET['urlsrc']=$f; $fb=nohttp($f);
if(!$_GET['ti']){list($sujb,$msg,$rec,$current,$defid)=vacuum($f,$suj); 
	$msg=embed_links($msg); $ret=$msg; $_SESSION['vacti'][$f]=$sujb;}
else{$ret=clean_title($_SESSION['vacti'][$f]);$_SESSION['vacti'][$f]='';}
if($_GET['import'] && $sujb){$wh='WHERE id = "'.$_GET['import'].'" LIMIT 1;'; 
	$sq='suj="'.clean_title($sujb).'", mail="'.$f.'", img="" ';//ib="0",
	msquery('UPDATE '.$_SESSION['qda'].' SET '.$sq.$wh.'');
	req('sav,pop'); modif_art($_GET['import'],$msg);}
if($_SESSION['vacuum'][$fb]){unset($_SESSION['vacuum'][$fb]);}
return $ret;}

function bub_adm_addart(){
$t.=autoclic('" id="addsrc" onClick="SaveIeb()" onContextMenu="SaveIeb()','Url',10,256,'');
$h=hidden('','addop',rstr(57)).hidden('','addsrt',$_SESSION['frm']).hidden('','addpub',$_SESSION['auth']>2?rstr(11):0).hidden('','addib','');//rstr(10)
return span(atc('search').atd('adb').ats('width:106px;'),$t).$h;}

function find_vaccum($n){
foreach($_SESSION['vacuum'] as $k=>$v){$i++; if($i==$n)return $k;}}
function newartcatset($ud,$d){$_SESSION['vaccat'][find_vaccum($ud)]=$d;}
function newartparentset($u,$d){return $_SESSION['vacpar'][$u]=$d;}
function newartparent(){$r=array_keys_r($_SESSION['rqt'],10);
foreach($r as $k=>$v)if($v!='/')$rb[$v]+=1; arsort($rb);
foreach($rb as $k=>$v)$ret[$k]='('.$v.') '.suj_of_id($k);
return $ret;}

function newartcat($url){$r=find_cat(30); ksort($r); $u=ajx($url);//saveiec
$head=select_j('addib','parent',$v,0,picto('topo'),1).' '; //parent_slct('addib')
$vrf=$_SESSION['vaccat'][$url];
foreach($r as $k=>$v){if($k==$vrf)$c='active'; else $c='';
	//$ret.=ljc($c,'socket',ajxf'_newartcatset_'.$u.'_'.ajx($k),$k,'x');//flag
	$ret.=saveiec($u,ajx($k),'','addib',$k,'',$c).' ';}//addart//spe-ajxf_newartcat
$ret=scroll_b($r,$head.divc('nbp',$ret),24,'',400);//savart
return $ret;}

function urledt($u){$b=rstr(18)?'public':ses('qb'); if(!auth(4))return;
list($id,$v)=verif_defcon($u); if(!$v)$v=known_defcon($f,'');
$see=lj('','popup_callp___ajxf_seesrc_'.ajx($u),pictit('view','code'));
if($id)return lj('','popup_editmsql___users/'.$b.'*defcons_'.$id,pictit('txt','defs')).' '.$see;
else return msqlink('',$b.'_defcons',http_domain(strtolower($u))).hlpbt('defcons').' '.$see;}

function seesrc($f){//return $d=highlight_file($f,true);
$d=@file_get_contents($f); 
$enc=mb_detect_encoding($d); if($enc=='UTF-8')$d=utf8_decode($d); 
$d=delbr($d,"\n");
$d=substr($d,strpos($d,'<body')); //$d=addslashes($d);
$d=highlight_string($d,true);
//$d=entities($d);
//$d=nl2br($d);
return $d;}

#transports
//deploy
function vmail($id){
$ids='vmfrom'.$id.'|vmto'.$id.'|vmsg'.$id;
$ret.=btn('right',lj('popsav','vsd'.$id.'_vmailsend___'.$id.'____'.$ids,nms(28)));
if($_SESSION['USE'])$ret.=hidden('','vmfrom'.$id,$_SESSION['qbin']['adminmail']);
else{$ret.=label('vmfrom'.$id,'popw','',nms(68).':').' ';
$ret.=input(1,'vmfrom'.$id,'','" size="24').br();}
if(auth(0))$ret.=lj('txtbox','popup_plup___mail_mail*prep_vmto'.$id,nms(36));
else $ret.=btn('txtx',nms(36));
$ret.=input(1,'vmto'.$id,'','" size="24').br();
$ret.=txarea('vmsg'.$id,'',44,2);
return divd('vsd'.$id,$ret);}

function vmailsend($id,$res){
$http=host(); $htacc=urlread($id);
list($from,$to,$txt,$suj)=ajxr($res);
if(strpos($to,"@")!==false){
$suj=sql('suj','qda','v','id="'.$id.'"');
$msg=divc("panel justy",$txt);
$msg.=lkc("",$http.$htacc,bal("h2",$suj));
$msg.=divc("panel justy",read_msg($id,"nlb"));
send_mail("html",$to,$suj,$msg,$from?$from:hostname(),$htacc);
return btn("popbt",nms(34).' '.nms(79).' '.nms(36).': '.$to);}
else return btn("popdel",'error'.$to);}

//export
function exportation($pub,$node,$topic,$sub){
$USE=$_SESSION['USE']; $go='popup_export__pop_';
if($USE!=""){
	if($part!="" or $pub!=""){
		if($node!=$USE)$ret.=lj("popw",$go.$pub,"export:");
		else $ret.=btn("popw","import:");
		if($node)$ret.=lj("popbt",$go.$pub.'_'.$node,$node);
		if($topic)$ret.=lj("popbt",$go.$pub.'_'.$node.'_'.$topic,$topic).' :: ';
		if(!$node){//menus:hubs && count($_SESSION['mn'])>1
		$ret.=slctmenusj($_SESSION['mn'],$go.$pub.'_',$_SESSION['qb'],' ');}}
	$lineb=sql('frm','qda','k',"nod='$node' AND day>".(calc_date(360)).' ORDER BY frm');	
	if(count($_SESSION['mn'])>1 && $lineb) 
		$ret.=slctmenusj($lineb,$go.$pub.'_'.$node.'_','',' ');}
if($topic!="" && !$sub){//topic
	$sqlt=$_SESSION['sqlimit'];
	$lk=$go.$pub.'_'.$node.'_'.$topic.'_';
	$ret.=lj("popdel",$lk.'ok','save in: '.$topic);
	$req=sq('id,suj','qda',"where nod='$node' AND frm='$topic' $sqlt ORDER BY id DESC LIMIT 100");
	while($data=mysql_fetch_array($req)){
		$rte.=lj('',$lk.$data["id"],$data["suj"]).br();}
	if($rte) $ret.=' '.btn('txtx','or affiliate to:').br().divc('nbp',$rte);}
if($sub!=""){$tosave=import($node,$pub,$USE,$topic,$_SESSION['qb'],$sub);//sub
$ret=lkc("popw",'/?read='.$tosave,'saved in '.$node.'/'.$topic.'/'.$tosave);}
return $ret;}

//transport
function import($node,$part,$use,$frm,$qb,$suj){$tim=$_SESSION['dayx'];
$mmb=sql('members','qdu','v','name="'.$node.'"'); $r=explode(",",$mmb); 
foreach($r as $k=>$v){list($ath,$muser)=explode("::",$v); if($muser==$use)$auth=$ath;}
list($name,$mail,$tit,$thm,$hst,$img)=sql('name,mail,suj,thm,host,img','qda','r','id="'.$part.'"'); $re=$auth>4?1:0;
if($suj!="ok")$ib=$suj; else $ib='/'; if(!$node)$node=$qb; if(!$suj)return;
$msg='['.($part.':import]'); $suj=mysql_real_escape_string(stripslashes($tit));
$nread=insert('qda','("","'.$ib.'","'.$use.'","'.$mail.'","'.$tim.'","'.$node.'","'.$frm.'","'.$suj.'","'.$re.'","0","'.$img.'","'.$thm.'","'.$hst.'")');
return insert('qdm',"('$nread','$msg')");}

#assistants
function assistant($id,$j,$jv,$va,$chk){
if($jv)if(strpos('iframeswf',$jv)!==false)$dim=1;
$nk='checkEnter(event,\'chkenter'.$id.'\')'; if($jv)$jx='\''.$jv.'\'';
$ret.='<form id="chkenter'.$id.'" action="javascript:'.$j.'('.$jx.')">';
if($dim){$p1='cnp'; $p2=$id;} else{$p1=$id; $p2='cnp';}
$idb=strdeb($jv,"'");//is_numeric($jv)?'import':
if($jv)$help=msql_read('lang','connectors_all',$idb);
if($help && !is_array($help)){$bi=strpos($help,'§');//prop_detect
	$ret.=divc('small',nl2br($help));}
$ret1=goodarea(!is_numeric($va)?$va:'',$p1,'','',40);//$nk
//$ret1=balise($type,array('','text','',$p1,$va==1?url:$va,'',32,255,$nk),"").' ';
if($chk or $bi){$ret2=input(1,$p2,$chk,'').' '; $sep='§';} 
else $ret.=hidden('','cnp','');
if($dim)$ret.=$ret2.$sep.$ret1; else $ret.=$ret1.$sep.$ret2;
$ret.=submitj('','chkenter'.$id,'ok').'</form>';
return $ret;}

function mbd_conn($id,$va,$pid=''){switch($id){
case('url'): $ret=mbd_url(); $t='URL or ID_article'; break;
case('img'): $ret=mbd_upload($va); $t=nms(78); break;
case('table'): $ret=mbd_mktable($va); $t='table'; break;
case('nh'): $ret=mbd_footnotes($va,1); $t='footnotes'; break;
case('css'): $ret=mbd_css($id); break;
case('color'): $ret=mbd_color($id); break;
case('conn'): $id=''; break;
case('video'): $ret=mbd_video($va); break;
case('popvideo'): $ret=mbd_video($va); break;
case("replace"): $ret=mbd_replace($va); break;
case('book'): $ret=mbd_book($id); $t='mk_book'; break;
case('paste'): $ret=mbd_paste(); $t=nms(86); $s=600; break;
case('microform'): $ret=mbd_forms($id); $t='user_form'; break;
case('microsql'): $ret=mbd_msql(); $t='select_microbase'; break;
case('formail'): $ret=mbd_forms($id); $t='form_for_mail'; break;
case("call_url"): $ret=mbd_vacuum(); $t=helps('import_art'); break;
//case("import"): $ret=mbd_vacuum(); $t=helps('import_art'); break;
case("importart"): $ret=mbd_importart(); $t=helps('import_art'); break;////to do
case('radio'): require('plug/radio.php'); $ret=radio_select(); $t='mp3 directory '; break;
case("module"): $ret=mbd_editcomm($id); break;
case("ajax"): $ret=mbd_editcomm($id); break;
case("articles"): $ret=mbd_editcomm($id); break;
//case('svg'): $ret=mbd_editsvg($id); break;
case('search'): $t=nms(26); break;
case('rss_art'): $t='xml_url'; break;
case('rss_read'): $t='philum distant_article'; break;
case('iframe'): $t=nms(51).' (.txt)'; break;
case('scan'): $t=nms(51).' (.txt)'; break;
case('preview'): req('pop,art,tri,spe'); $t=nms(65); $va=embed_links($va); 
	$ret=format_txt($va,'',''); break;
case('display'): $ret=divc('panel',$va); break;}
if($id)if(strpos('forumchatpetitionlast-update',$id)!==false)$va=ses('read');
if(!$ret)$ret=assistant('cnv','insert_conn',$id,$va,'');
return $ret;
return popup($t?$t:'connector:'.$id,$ret,$s?$s:440);}

//command
function mbd_editcomm($d){req('adminx');
if($d=='module')return mod_edit_pop(1);
if($d=='ajax')return mod_edit_pop(0);
if($d=='articles')return artmod_edit($d);}

//links
function mbd_url(){
	return assistant('url','embed_url_j','','1','');}
function mbd_vacuum(){$va=$_SESSION['rqt'][$_SESSION['read']][9];
	return assistant('urlsrc','SaveIb',$_SESSION['read'],$va,'');}
function mbd_importart(){//to do
	return assistant('urlsrc','SaveI','','','');}

function mbd_msql(){//insert
$r=explore('msql/users','files',1);
if($r)foreach($r as $k=>$v){$v=substr($v,0,-4); list($nd,$bs,$sv,$svv)=explode('_',$v);
	if($nd==$_SESSION['qb'] && $sv!='sav' && $svv!='sav')$rb[$v]=$bs.($sv?'_'.$sv:'');}
asort($rb); if($r)foreach($rb as $k=>$v){if($v)
	$ret.=ljb('popbt','insert_close','['.$k.':microsql]',$v).br();}
return scroll($r,$ret,22);}

function mbd_video($v){$ret.=divc('small',helps('video'));
if($v)$ret.=input1('url',$v,34,''); 
else $ret.=autoclic('" id="url','ID / URL','34','100','');
$ret.=lj('popbt','url_extractid_url_5_','ok').' ';
if(auth(4))$ret.=hlpbt('popvideo');
return $ret;}

//user_forms
//'[day=date,choice1/choice2=list,entry1=entry,message=text,mail=mail,ok=button:microform]';
//'[case=check,Name,Email=email,Message=text,Send=button:formail]';
function mbd_forms($d){
if($d=='microform')$r=array('button'=>'ok','input'=>'value','text'=>'message','mail'=>'mail','date'=>'day','list'=>'choice1/choice2','radio'=>'choice1/choice2','hidden'=>'value','uniqid'=>'uid');
if($d=='formail')$r=array('check'=>'case','input'=>'Name','mail'=>'Email','text'=>'Message','button'=>'Send');
$ret=select(array('id'=>'cna','onchange'=>'jumpslct(\'cnb\',this)'),array_flip($r),'kv');
$ret.=input(1,'cnb','','').' ';
$ret.=ljb('popbt','jumpMenu_addtext','cnv_cna_cnb_=_,','add').br();
$ret.=assistant('cnv','insert_conn',$d,'','');
return $ret;}

function mbd_css($cnn){//pub_css
$r=msql_read('design',$_SESSION['qb'].'_design_'.$_SESSION['prmd'],'');
if($r)$r=array_keys_r($r,1,'k');
if($r)foreach($r as $k=>$v){
	if(strpos($k,':')===false && strpos($k,'.')===false && trim($k))
		$ret.=ljb('','jumpvalue','cnn_'.$k,$k).' ';}
return divc('nbp',$ret).br().assistant('cnn','embed_css',$cnn,'','');}

function mbd_color($cnn){$klr=msql_read('system','edition_colors','',1);
$sty='padding:0 5px; background-color:#'; foreach($klr as $k=>$v){
	$ret.=ljb($k,'jumpvalue','cnp_'.$k,bts($sty.$v,'.')).' ';}
return $ret.br().br().assistant('cnn','embed_css',$cnn,'','');}

function mbd_replace($d){
$ret.='search: '.txarea('resr',$d,25,1).br().' replace: '.txarea('repl','',25,1);
$ret.=lj('popbt','txarea_filters_txtarea__replace____resr|repl','ok');
return $d?$ret:'select text to replace';}

function mbd_paste(){$ret=txareac_btns();
$ret.=btn('right',lj('popbt" id="bts','txtarea_convhtml_txtareb_5',nms(86)));
$ret.=div('contenteditable id="txtareb" class="panel justy" style="padding:10px; border:1px dotted grey; min-width:550px; min-height:240px;"','<br>');
return $ret;}

function mbd_book($cnn){req('adminx');
$ret.=btn('txtcadr','param [,]');
$ret.=divd('amc',artmod_edit_l('cnv','',''));
$ret.=assistant('cnv','insert_conn','book','','title/1/book');
$ret.=br().helps('book');
return $ret;}

//upload
function uplim($a,$b,$v){req('spe');
$v=ajx($v,1); $_POST['randim']=1;
$im=vacuum_image($v,$_SESSION['read']);
if($im)return '['.$im.']';}

function mbd_upload($id){$id=ses('read');
$id=$id?$id:lastid('qda')+1;
$ret=input(1,'upim','Url" size="40','',1).' ';
$ret.=ljc('','popb','pop-ajxf_uplim___upim',"ok",5).br();//?
$ret.=upload_btn('upl','read='.$id.'_1','upload').' ';
$ret.=lj('txtx','popup_placeim___'.$id,'portfolio');
return $ret;}

function recenseim($id){req('tri');
$msg=sql('msg','qdm','v','id='.$id); 
$ims=correct_txt($msg,'','extractimg'); $ra=explode('/',$ims); //pr($ra);
$ims=sql('img','qda','v','id='.$id); $r=explode('/',$ims); 
foreach($ra as $k=>$v)if(!in_array($v,$r))$r[]=$v;
//if(count($ra)>count($r))update('qda','img',implode('/',$r),'id',$id);
return implode('/',$r);}

function placeim($id){
$ims=sql('img','qda','v','id='.$id); $r=explode('/',$ims); foreach($r as $k=>$v)if($v){
	$im=make_mini('img/'.$v,'imgb/'.$v,$w,$h,$_SESSION['rstr'][16]);
	$ret.=ljb('','insert','['.$v.']',image($im,'',''));}
return popup('place images',$ret,440);}

function art_gallery($id){
if(!$d)$d=sql('img','qda','v','id='.$id); $r=explode('/',$d);
if($r)foreach($r as $v)if($v)$ret.=popim(goodroot($v),make_thumb($v,$id),$id);
return $ret;}

//table
function mktc($na,$nb,$o,$d){$r=ajxr($d); $i=0; $opt=$o?'§'.$o:'';
for($b=0;$b<$nb;$b++){for($a=0;$a<$na;$a++){$ret.=$r[$i].'|'; $i++;} $ret.='¬';}
return '['.$ret.$opt.':table]';}

function mktb($na,$nb,$d){
list($na,$nb)=ajxp($d,$na,$nb);
for($b=0;$b<$nb;$b++){$td='';
	for($a=0;$a<$na;$a++){$id='r'.$b.'c'.$a; $md.=$id.'|';
		$cell=ceil((40/$na)-($na/7));
		$td.=bal('td',input(1,$id,'','" size="'.($cell>0?$cell:1)));}//
	$ret.=bal('tr',$td);}
$ret=bal('table',$ret);
$ret.=lj('','mkb_mktable__5_'.$na.'_'.$nb.'___'.$md,'normal').' ';
$ret.=lj('','mkb_mktable__5_'.$na.'_'.$nb.'_1__'.$md,'titles').' ';
$ret.=lj('','mkb_mktable__5_'.$na.'_'.$nb.'_2__'.$md,'alternate');
$ret.=lj('','mkb_mktable__5_'.$na.'_'.$nb.'_div__'.$md,'divtable');
$ret.=divd('mkb','');
return $ret;}

function mkt_build($d){
$d=str_replace(',','|',$d); $d=str_replace("\n",'¬',$d); $h=hidden('','mktb',$d);
return lj('','socket_jump__5_____mktb','ok').$h;
return ljb('','insert',ajx($d),'ok');}

function mbd_mktable($d){
if($d)return mkt_build($d);
$j='SaveJ(\'mkt_mktable_______col|row\')';
$c='popw" size="2" onkeyup="'.$j.'" onclick="'.$j.'" ';
$ret='cols: '.input(1,'col',2,$c).' ';
$ret.='rows: '.input(1,'row',3,$c).' ';
$ret.=divd('mkt',mktb('','','2|3'));
return $ret;}

#admin
//edit_art
function artedit($id,$sz=''){
$_SESSION['read']=$id; $_GET['continue']="edit";
//list($w,$h)=explode('-',$sz); $mxw=currentwidth(); if($w>$mxw)$w=$mxw;
//if($w)$sty='width:'.($w-26).'px;';
return divs($sty,f_inp('',''));}

function artwedit($id){req('tri,pop');
$clr=$_SESSION['clrs'][$_SESSION['prmd']];
$d=correct_txt($id,'','sconn'); $d=nl2br($d);
$sav=lj('popsav" id="bts','txtarea_convhtml_txtareb_4x',nms(121));
//$bt.=lj('txtbox" id="bts','txtarea_convhtml_txtareb_5x',nms(86));//paste
$ret=divs('',$sav.' '.$bt.txareac_btns());
$ret.=div(atb('contenteditable','true').atd('txtareb').atc('panel justy').ats('min-width:550px; height:400px; overflow-y:scroll;'),' '.$d);
return $ret;}

function save_clr_j($tosave){
req('styl'); $base='msql/design/'; $qb=$_SESSION['qb'];
$ndd=$_SESSION['desgn']?$_SESSION['desgn']:$_SESSION['prmd'];
$ndc=$_SESSION['clrset']?$_SESSION['clrset']:$_SESSION['prmd'];
$nod=$qb.'_design_'.$ndd; $f_c=$qb.'_clrset_'.$ndc;
if(!$_SESSION['desgn'])$f_css_temp='css/'.$qb.'_design_'.$ndd.'.css';
else $f_css_temp='css/'.$qb.'_design_dev_'.$ndd.'.css';
$defs=read_vars($base,$nod,""); unset($defs["_menus_"]);
$tosave=str_replace("/","_",$tosave);
if(substr($tosave,-1)=="_")$tosave=substr($tosave,0,-1);
$_SESSION['clrs'][$_SESSION['prmd']]=explode("_",$tosave);
if($_SESSION["auth"]>=6)save_clr($f_c);
build_css($f_css_temp,$defs);
return btn("popdel","saved");}

//mod
function modsee($r){for($i=1;$i<10;$i++){$u.=$r[$i].'/';}
$ret=btn('txtcadr','connector').' '.str_replace(array('/////:','////:','///:','//:','/:'),':',$u.':'.$r[0]).':module'.br().br();
$lk='/module/'.$r[0].'/'.$r[1].'/'.$r[2].'/'.$r[4].'/'.$r[5]; $lk=strdeb($lk,'§');
$ret.=btn('txtcadr','url').' '.$lk;
return $ret;}

function modj($id,$va){return build_mods($_SESSION['modc'][$va][$id]);}

//admin
function admin_call($id,$va,$opt){$_GET['admin']=$id; $sz=550;
if($id=='css' or $id=='colors' or $id=='console' or $id=='htaccess' or $id=='code' 
	or $id=='pictos' or $id=='stats')$sz=680; if($id=='editor')$sz=640;
elseif($id=='design' or $id=='colors' or $id=='restrictions' or $id=='params' 
	or $id=='hubs' or $id=='editor' or $id=='update' or $id=='msql' or $id=='updb' 
	or $id=='console' or $id=='finder' or $id=='messages' or $id=='plugin')
		$reb=call_user_func('adm_'.($id=='design'?'css':$id),$va,$opt);
elseif($id=='apps'){req('adminx'); $reb=adm_apps('','',$va);}
elseif($id=='css')$reb=adm_admin($id,$va);
else $reb=admin();
return popup($id,$reb,$sz);}

//rstr
function rstr_sav($d){
if($d)$_SESSION['rstr'][$d]=rstr($d)?'1':'0';
if(auth(6))backup_rstr('save');
return 'rstr'.$d.': '.offon(rstr($d));}

#apps
//desktop
function medium_clr($g){$r=explode(',',$g);
foreach($r as $k=>$v){if(substr($v,0,1)=='#'){$oa+=hexdec(substr($v,1)); $ob++;}}
if($ob)return dechex($oa/$ob);}

function desk_css(){
$prmd=$_SESSION['prmd']; if($_SESSION['negcss'])$prmd.='_neg';
$clr=$_SESSION['clrs'][$prmd]; req('styl');
$g=prma('desktop'); //sesmk('desklr');
if(is_image($g))$ret='background:url('.goodroot($g).');';
elseif(strpos($g,',')===false && $g){
	$ret='background-color:'.affect_rgba($g,$clr).';'; $klr=$g;}
else{$g=affect_rgba($g,$clr); $gh=$g?$g:'#'.$clr[4].',#'.$clr[2]; $klr=medium_clr($gh);
	if(!$g)$g='to bottom, '.hexrgb($clr[4],0.4).', '.hexrgb($clr[1],1).'';
$ret='height:100%; 
	background:linear-gradient('.$g.') no-repeat fixed;';}
return css_code('body {'.$ret.'}
	#desktop a, .philum {color:#'.invert_color($klr,1).';}
	#page {padding:0; margin:0 40px 0 0; border:0; box-shadow:none;}');}

function desktop_root($id,$va,$opt,$optb){poplist();
if($id=='varts' or $id=='files')req('mod');
if($id=='arts')req('api,pop,spe,art,tri,mod');
$r=desktop_apps($id,$va,$opt,$optb); $ret=desktop_build_ico($r,'icones');
return $ret.divs('clear:left;','');}

function desktop_ico($id){$r=desktop_apps($id,$va,$opt,$optb);
return desktop_build_ico($r,'');}

function desktop_load($id){if($id)$r=desktop_cond($id);//deskload
else $r=array('desktop_desk___desk','page_deskbkg','popup_site___desktop_ok__autosize');
return implode(';',$r);}

#connectors

//convhtml
function convhtml_b($ret){//$ret=nl2br($ret); $ret=str_replace('<br />','',$ret);
$ret=unescape($ret); $ret=converthtml($ret); $ret=html_entity_decode_b($ret); 
$ret=html_entity_decode($ret); $ret=clean_prespace($ret); return $ret;}

//dsnav
function conn_props_b($n){
$r=msql_read('system','connectors_all',"",1); ksort($r);
foreach($r as $k=>$v){if($v[2]==$n)$rb[$k]=array($v[0],$v[1]);}
$help=msql_read("lang","connectors_all","");
if($rb)foreach($rb as $k=>$v){
	if($help[$k])$hlp='" title="'.stripslashes($help[$k]); else $hlp='';
	if($v[0]=='embed'){if($v[1])$v[0]='embed_slct'; else $v[1]=$k;}
	$ret.=ljb(''.$hlp,$v[0],$v[1],$k).' ';}
return $ret;}

function navs($op){
if($op=="ascii"){$r=msql_read('system',"edition_chars","",1);
	foreach($r as $k=>$v)$ret.=ljb('',"insert",$v,$v).' ';
	$ret.=lj('txtx','popup_plup___ascii','table');}
elseif($op=="pictos"){$r=$_SESSION['picto'];
	foreach($r as $k=>$v)$ret.=ljb('','insert','['.$k.'§16:picto]',picto($k)).' ';}
elseif($op=="uc"){$r=msql_read('',$_SESSION['qb'].'_connectors',"",1);
	if($r){$ret.=btn('txtx',$_SESSION['qb'].':').' ';
	foreach($r as $k=>$v)$ret.=ljb('',"insert_mbd",'[\',\'\',\':'.$k.']',$k).' ';}
	$r=msql_read("",'public_connectors',"",1);
	if($r){$ret.=br().btn('txtx','public:').' ';
	foreach($r as $k=>$v)$ret.=ljb('',"insert_mbd",'[\',\'\',\':'.$k.']',$k).' ';}
	$ret=divs('min-width:440px;',$ret);}
elseif($op=="codeline"){$bt='';
	$r=msql_read('system','connectors_codeline',"",1); ksort($r);
	$rb=msql_read("lang",'connectors_codeline',"",1);
	if($r)foreach($r as $k=>$v)
		$ret.=ljb('" title="'.$rb[$k],"insert",'['.$v.':'.$k.']',$k).' ';}
elseif($op=="backup"){$id=$_SESSION["read"];
	$nod=$_SESSION['qb'].'_backup_'.$id; $nodb=ajx($nod,'');
	if($id){$r=msql_read('',$nod,'',1);
		if($r)foreach($r as $k=>$v)$rb[$k]=array('txarea_restore___users_'.$nodb.'_'.$k,'bckp_backup___'.$nodb.'_'.$k.'_','bckp_backup___'.$nodb.'_del_'.$k);//txtarea
		if($rb)foreach($rb as $k=>$v)$ret.=lj('',$v[0],'restore'.$k).lj('',$v[1],'backup'.$k).lj('',$v[2],'delete'.$k).br();
		$ret.=lj('popbt','bckp_backup___'.$nodb.'_'.($k+1),'new').' ';//txtarea
		$ret.=lj('popbt','txarea_filters___revert','revert').' ';}
	if($ret)$ret=divb('|bckp',$ret); else 'availale only while editing';}
elseif($op=='disk')$ret=call_finder(ses('qb'),'disk///disk/conn//mini');
elseif($op=='icons')$ret=call_finder('','disk///icon/conn//mini');
else $ret=conn_props_b($op);
return divs('min-width:300px;',$ret);}

//pdf
function pdfreader_j($d,$t){
$url='http://docs.google.com/viewer?url='.urlencode($d).'&embedded=true'.$sz;
return popup($t,iframe($url,prma('content')));}

#batch
function batch($f,$d){$f=utmsrc($f); $fb=nohttp($f);
$idt='adc'; //if($d=='c')$idt.='p';
if($f=='z'){req('sav'); return save_art_batch();}
if(substr($f,0,4)!='http' && $f && $f!='x' && $f!='1')$f='http://'.$f;
if($f=='x')$_SESSION['vacuum']=''; //p($_SESSION['vacuum']);
if(trim($f) && $f!='1' && $d!='1' && $f!='x' && $d!='x' && !@$_SESSION['vacuum'][$fb])
	if(joinable($f))$_SESSION['vacuum'][$fb]=read_file($f);//
if($d=='x')unset($_SESSION['vacuum'][$fb]); //echo $f; //p($_SESSION['vacuum']);
if($d=='p')return 'ok';
if($d=='c')$ret=lj('',sj('popup_batch').' closebub(this);',picto('get'));
$ret.=lj('',$idt.'_batch____in_'.$d,picto('reload'));
$ret.=lj('',$idt.'_batch___x_1',picto('del'));
$ret.=lj('','popup_rssjb___rssurl_1',picto('rss'));
$ret.=lj('',$idt.'_batchfbi__3',picto('update'));
$ret.=lj('','page_deskbkg',picto('desktop'));
$ret.=msqlink('',ses('qb').'_rssurl');
$r=$_SESSION['vacuum']; if($r)$r=array_reverse($r);
if($r)$ret.=lj('bkg',$idt.'_batch___z_1',nms(57));
if($r)foreach($r as $k=>$v){$i++;
	if((!$_SESSION['vacsuj'][$k] or $k==$f) && $k!=1 && $k && $k!='http://loading...'){
		list($_SESSION['vacsuj'][$k],$msg)=vacuum($k,'');}
	if(!$_SESSION['vacsuj'][$k] && $v)$suj='no_title'; else $suj=$_SESSION['vacsuj'][$k];
	$kb=ajx($k,''); $cat=$_SESSION['vaccat'][$k];
	$rid='bth'.randid(); 
	$btb=ljc('','popup','ajxf_batch*preview_'.$kb,picto('view'));
	$btb.=slct_cat($rid,$cat,$i);
	//$btb.=select_j($rid,'category',$cat,3,$cat?$cat:picto('list'));
	$btb.=saveiec($kb,$cat,$rid);
	$btb.=lj('','popup_search__3_'.ajx($suj).'_',picto('search'));
	$btb.=lkt('" title="'.preplink($k).' '.$_SESSION['vacdat'][$k],http($k),picto('url'));
	$btb.=lj('',$idt.'_batch___'.$kb.'_x',picto('del')).' ';
	$btb.=btn('small',http_domain($k)).br();
	$ret.=divc('small',$btb.$suj);}
if($d!='in')$ret=div(atd($idt).ats('padding:2px; min-width:240px;'),$ret);
return scroll_b($i,$ret,10);}

function slct_cat($id,$t,$n){return hidden($id,$id,$t).lj('" id="adcat'.$id,'popup_addCat___'.$id.'_'.$id.'_'.$n,$t?$t:picto('list'));}//menuder_jb

function batch_prep($v){$http=strdeb($v,'/'); req('pop'); 
$rss=rssin_load(http($v)); $vac=$_SESSION['vacuum'];//pr($rss);
foreach($rss as $k=>$v){list($suj,$f,$dat,$id)=$v; $f=(string)$f;
	if($id)break; elseif($f && !isset($vac[$f])){$f=nohttp($f);
	@$_SESSION['vacsuj'][$f]=$suj; @$_SESSION['vacdat'][$f]=$dat; @$_SESSION['vacuum'][$f]='';}}}

function batchfbi(){req('pop'); $ret=hlpbt('rssurl_1').br();
$r=msql_read('',$_SESSION['qb'].'_rssurl',"",1); $r=msq_tri($r,3,1);
if($r)foreach($r as $k=>$v)batch_prep($v[0]);
return batch('','in');}

function batch_preview($f,$sug=''){req('pop,spe,tri');
$f=http($f); $_GET['urlsrc']=$f; $w=prma('content');
list($suj,$msg)=vacuum($f);
$msg=embed_links($msg); $msg=clean_br_lite($msg); $msg=clean_punct($msg);
$msg=format_txt($msg,'','test');
$sty=atc('justy').ats('width:'.$w.'px;');
if(strlen($msg)>400)$sty.=atd('scroll'); $titl=bal('h2',$suj);
$_SESSION['sugm']=$sug; $rid='btch'.randid();
$rel=lj('','popup_call__x_ajxf_batch*preview_'.ajx($f).'_',pictit('reload',nms(101))).' ';
if(auth(6))$titl.=$rel.urledt($f).' '; $titl.=lkt('',$f,picto('url'));
if(auth(6))$titl.=newartcat($f);
$ret.=bal('section',bal('header',$titl).balb('article',$sty,$msg)); //$_SESSION['vacuum'][$f]='';
return popup(preplink($f),$ret,$w);}

function forbidden_sessions($d){if($d!='auth' && $d!='USE')return true;}

?>