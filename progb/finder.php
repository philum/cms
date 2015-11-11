<?php
//philum_finder

//utils
function normalize_s($n){//let the "/"
$n=str_replace(array(" ","'",'"',"?","§",",",";",":","!","%","&","$","#","_","+","!","\n","\r","\0","[\]","~","(",")","[","]",'{','}',"«","»"),"",($n));
return eradic_acc($n);}

function mkprm($r,$d='',$n='',$ar=''){
if(!is_array($r))$r=explode('/',$r);
for($i=0;$i<7;$i++){if($n==$i)$r[$n]=$d; else $r[$i]=$r[$i];}
if($ar)return $r; else return implode('/',$r);}

function fi_mnu($r,$p,$d,$n,$q='',$o=''){
if($o)$o='auto/'.$d.'/'.$n; else $o=mkprm($r,$d,$n); 
if($r[$n]==$d or(!$r[$n] && $q))$c='active';
return lj($c.'" title="'.$d,'finder_finder___'.$p.'_'.$o,fi_mimes($d,$t,16)).' ';}

/*function finder_combiner($p,$v){
$ra=explode('/',$p); $n=count($ra); $rb=explode('/',$v);
for($i=0;$i<$n;$i++){if(in_array($ra[$i],$rb))$o++;}
if($o==$n)return true;}*/

//menus
function finder_menu($r,$p){
if($r[0]=='shared' or $r[0]==''){if(auth(4)){
	$ret.=fi_mnu($r,'','local',1,1).fi_mnu($r,'','global',1).fi_mnu($r,'','distant',1);
	$ret.=' | ';
	$ret.=fi_mnu($r,$p,'virtual',2,1).fi_mnu($r,$p,'real',2).' | ';}}
elseif($r[3]=='list' or $r[3]==''){
	$ret.=fi_mnu($r,$p,'normal',4,1).fi_mnu($r,$p,'recursive',4).' | ';}
if(auth(4))$ret.=fi_mnu($r,'','shared',0,1).fi_mnu($r,$_SESSION['qb'],'disk',0).' | ';
$ret.=fi_mnu($r,$p,'flap',3,1).fi_mnu($r,$p,'icons',3); $ret.=' | ';
//$ret.=fi_mnu($r,$p,'panel',3).fi_mnu($r,$p,'list',3);
//$ret.=fi_mnu($r,$p,'pictos',6,1,1).fi_mnu($r,$p,'mini',6,'',1).' | ';
if($r[0]=='shared' or $r[0]==''){if(auth(4)){
	if($r[1]=='global')$ret.=fi_mnu($r,$p,'update',5);
	if($r[1]=='global')$ret.=msqlink('server','shared_files');
	elseif($r[1]!='distant')$ret.=msqlink('',$_SESSION['qb'].'_shared');}}
return $ret;}

function fi_nms($d){$r=array('new'=>44,'rename'=>72,'virtual_dir'=>73,'shared'=>74,'not'=>75,'delete'=>76,'upload'=>78);
return nms($r[$d]);}

function fi_pic($d,$sz=''){
$r=array('folder'=>'folder2','rename'=>'editxt','new'=>'add','delete'=>'no','upload'=>'upload','download'=>'download','url'=>'link','pdf'=>'txt','open'=>'popup','music'=>'music','play'=>'play','register'=>'connect','virtual_dir'=>'virtual'); 
return pictit($r[$d],fi_nms($d),$sz);}

function fi_mimes($d,$t,$sz){
$r=array('local'=>'local','global'=>'users','distant'=>'server','virtual'=>'virtual','real'=>'folder','normal'=>'topo','recursive'=>'topo-open','disk'=>'disk','shared'=>'finder','list'=>'list','panel'=>'folder','icons'=>'icons','flap'=>'flap','pictos'=>'file','mini'=>'mini','update'=>'upcloud'); if($r[$d])$t=$r[$d]; if(!$t)$t='file'; 
if($t)return picto($t,$sz);}
//if($t)return callico($t,$d,$sz);

//url
function finder_url($r,$rb){$o=mkprm($rb,'',5);
if($rb[0]=='disk' && auth(6))
	$ret.=lj('fipop','finder_finder__3__'.$o,'root').' ';
if($rb[0]=='shared')array_unshift($r,''); $n=count($r);
for($i=0;$i<$n;$i++){$cur.=($i&&$n>1?'/':'').$r[$i]; 
	if(!$i)$r[$i]=pictxt('reload',$r[$i]?$r[$i]:'root'); $j=ajx($cur).'_'.$o;
	if($i==$n-1)$c='active';
	if($r[$i])$ret.=lj($c,'finder_finder___'.$j,$r[$i]).' ';}
return btn('nbp',$ret);}

//virtual_dir
function virtual_array($r,$o){$ret=array();
foreach($r as $k=>$v){$do[$v[$o]][]=$v[0];}
foreach($do as $k=>$v){$rb=explode('/',$k); $n=count($rb)-1; 
	$n=$o==0?$n-1:$n; $rc=$v;
	for($i=$n;$i>=0;$i--){$rd=$rc; $rc=''; $rc[$rb[$i]]=$rd;}
	$ret=array_add_r($ret,$rc);}
return $ret;}

function select_subarray($p,$r,$o){
$ra=explode('/',$p); $n=count($ra);
for($i=0;$i<$n;$i++){if($ra[$i] && strpos($ra[$i],'.')===false)$r=$r[$ra[$i]];}//
return $r;}

//shared
function distrib_virtual_dir(){$rc=array(); $dr='users'; $nd='shared';
$ra=msq_select($dr,'',$nd); $n=count($ra);
for($i=0;$i<$n;$i++){$r=msql_read($dr,$ra[$i],'',1);
	if($r)$rc=array_merge($rc,$r);}
return $rc;}

function distrib_share(){
$r=distrib_virtual_dir(); $dr='server'; $nod='shared_files';
if($r){$ra['_menus_']=array('url','vurl'); $ra+=$r;
modif_vars($dr,$nod,$ra,'repl');}}

function shared_files(){
$_SESSION['curdir']=msql_read('users',$_SESSION['qb'].'_shared','',1);}

function share_file($d,$p,$b){$mnu['_menus_']=array('url','vurl');
$_SESSION['curdir']=msql_modif('users',$_SESSION['qb'].'_shared',array($d,$p),$mnu,$b,$b=='del'?$p:0); distrib_share();}

function share_rename($d,$old){$mnu['_menus_']=array('url','vurl'); 
$r=msql_read('users',$_SESSION['qb'].'_shared','');
if($r)foreach($r as $k=>$v){$ret[$k]=array(str_replace($old,$d,$v[0]),$v[1]);}
$_SESSION['curdir']=msql_modif('users',$_SESSION['qb'].'_shared',$ret,$mnu,'add','mdf');
distrib_share();}

//distant
function finder_distant($p){require_once('plug/microxml.php');//server
$h=split_only('/',$p,0,0); if(strpos($h,'.')!==false)
return clkt('http://'.$h.'/msql/server/shared_files'); unset($r['_menus_']);}

function finder_shared($p,$rb){//select
if(substr($p,0,1)=='/')$p=substr($p,1).'/'; $o=$rb[2]=='real'?0:1;
if($rb[1]=='distant')$r=finder_distant($p);
elseif($rb[1]=='global')$r=msql_read('server','shared_files','',1);
else $r=msql_read('users',$_SESSION['qb'].'_shared','',1);//$_SESSION['curdir'];
if($r)$r=virtual_array($r,$o);
$r=select_subarray($p,$r,$o);
return $r;}

function fi_distant($fa,$g,$fb){//client
if(substr($fa,0,4)!='http')$fa='http://'.$fa;
$fd=$fa.'/plug/microsql.php?'.$g.'='.$fb; return read_file($fd);}
function fi_info_dist($f,$g){$fa='http://'.strprm($f,2); $fb=str_replace($fa.'/','',$f);
return fi_distant($fa,$g,'../'.$fb);}
function fi_dist_reg(){
return fi_distant($_SESSION['prmb'][24],'addserver',$_SERVER['HTTP_HOST']);}

function fi_dist_list(){$h=$_SERVER['HTTP_HOST'];
$rt=fi_distant($_SESSION['prmb'][24],'getservers','=');
$r=explode(';',$rt); //$r=msql_read('server','shared_servers','',1); 
if($r)foreach($r as $k=>$v){if($v==$h)$cur='ok';
	if($v)$ret.=divc('fipop',lj('popbt','finder_finder___'.$v.'_auto',$v));}
if(!$cur)$ret.=blj('','fisrv','fifunc___fi*dist*reg',fi_pic('register')).' ';
return $ret?br().br().$ret:'';}

//process
function fi_parent($p,$id,$t,$sc=''){
if($sc)$p=split_only('/',$p,1,0); $j=ajx($p); $o=$_SESSION['fio'];
if(strprm($o)=='shared')$p=$id; elseif(strpos($p,'/')===false){$p='finder'; $_SESSION['fio']=mkprm($o,'',5);} else $p=normalize($p); 
if(strprm($o,1)=='distant')return btn('txtyl',$t);
return lj('txtyl',$p.'_finder___'.$j.'_auto',$t);}

function fi_rename($d,$id,$res){$dr='users/'; $res=normalize_s(ajxg($res)); 
if(!$res){$j=$id.'firnm_fifunc___fi*rename_'.ajx($d).'_'.$id.'__'.$id.'frnm';
	$ret=input(1,$id.'frnm',$d).' '.lj('popsav',$j,'ok');}
elseif(auth(3)){mkdir_r($dr.$res); $ra=explode('/',$res);
	if($ra[0]==$_SESSION['qb']){$ok=rename($dr.$d,$dr.$res);//chmod($dr.$res,0775); 
		if($ok)share_rename($res,$d);} else $not='not_';
	$ret=fi_parent($d,$id.'firnm',$not.'saved',1);}
return $ret;}

function fi_del($d,$id){
if($id!='go')return blj('txtyl',$id.'fidel','fifunc___fi*del_'.ajx($d).'_go',pictxt('alert','really?'));
$f='users/'.$d; $nod=$_SESSION['qb'].'_shared';
if(auth(3))msql_modif('users',$nod,array($d),'','del',1);
if(is_file($f))unlink($f); shared_files(); distrib_share();
return fi_parent($d,$id.'fidel','deleted',1);}

function fi_vdir($sh,$id,$res){$v=$_SESSION['curdir'][$sh];
if(!$res){$j=$id.'fivrd_fifunc___fi*vdir_'.$sh.'_'.$id.'__'.$id.'fvdr';
	$ret=input(1,$id.'fvdr',$v[1]).' '.lj('popsav',$j,'ok').ljb('popbt','Close',$id.'fivrd','x');}
elseif(auth(3)){$res=ajxg($res); $v[1]=$res;
	$_SESSION['curdir']=msql_modif('users',$_SESSION['qb'].'_shared',$v,'','one',$sh);
	distrib_share(); $ret=fi_parent($v[0],$id.'fivrd','saved');}
return $ret;}

function fi_share($d,$id,$res){$sh=in_array_r($_SESSION['curdir'],$d,0);
$sbdr=split_only('/',$d,0,1); $sbdr=split_only('/',$sbdr,1,0); 
if(auth(3)){if($sh)share_file($d,$sh,'del'); else share_file($d,$sbdr,'push');}
return fi_info_shared($d,$id);}

function fi_newdir($d,$id,$res){$dr='users/'; $res=ajxg($res);//!is_dir($d)?'../'
if(!$res){$j=$id.'finew_fifunc___fi*newdir_'.$d.'_'.$id.'__'.$id.'fnew';
$ret=input(1,$id.'fnew',$d.'/new').' '.lj('popsav',$j,'ok');}//chmod($dr.$d,0777);
elseif(strprm($res,0)==$_SESSION['qb']){mkdir_r($dr.$res);
$ret=fi_parent($d,$id.'finew','ok');} else $ret=btn('txtyl','forbidden');
return $ret;}

function removef($j,$k,$v,$io){//chmod($j.'/'.$k,0777);
if($v)unlink($j.'/'.$v); else rmdir($j.'/'.$k);}

function fi_deldir($d,$id){$j='users/'.$d;
if($id!='go')return blj('popdel',$id.'fidld','fifunc___fi*deldir_'.ajx($d).'_go',pictxt('alert','really delete directory?'));
walk_dir($j,"removef"); rmdir($j);
return fi_parent($d,$id.'fidld','deleted',1);}

function fi_download($d,$id,$res){$dr='users/'; $drd=fi_droot();
if(!$res){$nnm=$_SESSION['qb'].'/downoalds/'.strrchr_b($d,'/');
	$j=$id.'fidwn_fifunc___fi*download_'.ajx($d).'_'.$id.'__'.$id.'fdwn';
	$ret=btn('txtsmall','target:').input(1,$id.'fdwn',$nnm).' '.lj('txtbox',$j,'ok');}
elseif(auth(3)){$res=ajxg($res); $ra=explode('/',$res);
	if($ra[0]==$_SESSION['qb']){mkdir_r($dr.$res); copy($drd.$d,$dr.$res);} 
	else $not='not_'; $ret=fi_parent($d,$id.'fidwn',$not.'saved',1);}
return $ret;}

//read
function fi_sizes($f){if(is_file($f))list($w,$h)=getimagesize($f); 
else $w=fi_info_dist($f,'fwidth'); return array($w,$h);};
/*function fi_show_img($f,$s){$img=make_thumb_c($f,$s,1); list($w,$h)=fi_sizes($f);
return ljb('','SaveBf','photo_'.ajx($f).'_'.($w).'_'.($h),$img);}*/
function fi_show_img_b($f){list($w,$h)=fi_sizes($f); $img=image($f,$w>600?'600px':$w);
return $ret.ljb('','SaveBf','photo_'.ajx($f).'_'.($w).'_'.($h),$img);}
function fi_show_swf($f){list($w,$h)=fi_sizes($f);
return lj('','popup_swf___'.ajx($f).'_'.$w.'_'.$h,fi_pic('play'));}

function fi_info_shared($d,$id){
$sh=in_array_r($_SESSION['curdir'],$d,0); $j='fifunc___fi*'; $dj=ajx($d).'_'.$id;
if($sh)$t=nms(74); else $t=nms(75); $c=($sh?'color:#bd0000':''); 
$ret.=blj('',$id.'fishr',$j.'share_'.$dj,picto('share',$c));
if($sh)$ret.=blj('',$id.'fivrd',$j.'vdir_'.$sh.'_'.$id,fi_pic('virtual_dir')).' ';
return $ret;}

function fi_finfo($d,$id,$f,$dj){$ra=explode('/',$d); $nm=strrchr_b($f,'/');
$ret.=lkt('popw" title="'.$f,$f,picto('url').' '.$nm).br();
if(!auth(4))$ret.=lkc('','plug/download.php?file='.$f,fi_pic('download'));
elseif($ra[0]==$_SESSION['qb']){$ret.=fi_info_shared($d,$id).' ';
$ret.=blj('',$id.'firnm','fifunc___fi*rename_'.$dj,fi_pic('rename')).' ';
$ret.=blj('',$id.'fidel','fifunc___fi*del_'.$dj,fi_pic('delete')).' ';}
else $ret.=blj('',$id.'fidwn','fifunc___fi*download_'.$dj,fi_pic('download')).' ';
if(substr(fi_droot(),0,4)=='http'){$size=fi_info_dist($f,'fsize'); 
	$date=mkday(fi_info_dist($f,'fdate'));} else{$date=ftime($f,'ymd'); $size=fsize($f);}
$ret.=btn('txtsmall2',$size.' '.$date.' '.strprm($d));
return $ret;}

function finder_reader($d,$dist){require('prog/pop.php'); $id=randid();
$dr=fi_droot(); $f=$dr.$d; $dj=ajx($d).'_'.$id; $xt=xtb($f);
$ret.=blj('',randid().'fidel','fifunc___fi*del_'.ajx($d),fi_pic('delete')).br();
if($xt)if(strpos('.jpg.png.gif',$xt)!==false && is_file($f))$ret.=fi_show_img_b($f,'').' ';
switch($xt){case('.swf'):$ret.=fi_show_swf(host().'/'.$f); break;//popswf($d);
case('.mp3'):$ret.=embed_flsh_obj('../fla/mp3.swf',300,40,'soundFile='.$f); break;
case('.txt'):$ret.=lj('','popup_poptxt___'.ajx($f,''),fi_pic('pdf',32)); break;
case('.flv'):$ret.=lj('','popup_popvideo___'.ajx($f),fi_pic('play',32)); break;
case('.mp4'):$ret.=lj('','popup_popvideo___'.ajx($f),fi_pic('play',32)); break;
case('.pdf'):$ret.=lj('','popup_poppdf___'.ajx(host().'/'.$f),fi_pic('pdf',32)); break;}
//if($ret)$ret=br().br().$ret;
return fi_finfo($d,$id,$f,$dj).$ret;}

function fi_reader_pop($d,$dist){
$ret=finder_reader($d,$dist); return popup('document',$ret);}

function fi_dirinfo($d,$o){$id='fed'.normalize($d); $s=strpos($d,'/');
$j='fifunc___'; $jx=ajx($d); //$ret=btn('popbt',pictxt('folder2',$d)).' ';
if($s)$ret.=blj('',$id.'firnm',$j.'fi*rename_'.$jx.'_'.$id,fi_pic('rename')).' ';
$ret.=blj('',$id.'finew',$j.'fi*newdir_'.$jx.'_'.$id,fi_pic('new')).' ';
if($s)$ret.=blj('',$id.'fidld',$j.'fi*deldir_'.$jx.'_'.$id,fi_pic('delete')).' ';
$ret.=upload_btn($id.'fiupl',ajx('opdir='.$d.'&mode=disk'),fi_pic('upload')).' ';
$ret.=blj('',$id.'upurl','plug___upload_upurl_'.ajx($d).'_'.$id,picto('photo')).' ';
$ret.=fi_plnk($d,$o);
return $ret;}

//render
function finder_data($r,$p,$rb){
if(!$r)return array(array('f'=>'empty')); if($p)$p.='/'; //ksort($r);
foreach($r as $k=>$v){$rc=''; $rc['id']=normalize($p.$k); $rc['pid']=normalize($p);
if(!is_numeric($k) or is_array($v)){$rc['r']=1; $rc['f']=$k; $nf=count($v); $nbd=0;
	if(is_array($v)){foreach($v as $ka=>$va){if(!is_numeric($ka))$nbd++;}}
	$rc['nbd']=$nbd; $rc['opt']=btn('txtsmall2','('.$nf.')');//nbof(,51)
	$rc['typ']='folder'; $rc['j']=ajx($p.$k).'_';}//if($nf)!
else{if($rb[0]=='shared'){$url=$v; $f=strpos($v,'/')!==false?strrchr_b($v,'/'):$v;}
	else{$url=$p.$v; $f=$v;}
	$fb=fi_droot().$url; $xt=xtb($f); $rc['url']=
	$rc['url']=$url; $rc['prop']=strprm($p);
	if($rb[1]=='distant'){$rc['dist']=1;} 
	else{$rc['opt']=btn('txtsmall2',fsize($fb)).' ';
		$rc['date']=btn('txtsmall2',ftime($fb,'ymd')).' ';}
	$rc['xt']=$xt; $rc['r']=0; $rc['j']=ajx($url).'_'; $rc['f']=$f;
	if($rb[0]=='shared')$rc['prop']=btn('txtsmall',strprm($v)).' ';
	if(is_file($fb) && $xt)if(strpos('.jpg.png.gif',$xt)!==false && $rb[6]!='pictos' 
		&& substr(fi_droot(),0,4)!='http')//set as mini
		$rc['img']=make_thumb_c($fb,'48/48'); //fi_show_img($fb,'48/48')
		else $rc['typ']=$xt;
	if($rb[3]=='icon'){if($xt){list($fd,$fl)=split_one('/',$url,1);
		if($xt=='.svg'){$fsvg=substr($url,0,-4);
			$rc['conn']='['.$fsvg.'§24:svg]'; $rc['img']=svg($fsvg.'§24');}
		elseif(strpos('.jpg.png.gif',$xt)!==false)
			$rc['conn']='['.substr($fl,0,-4).'§'.$fd.':icon]';}}
	if($rb[3]=='disk')$rc['conn']='['.$url.']';}
$ret[]=$rc;}
return $ret;}

//modes
function finder_list($r,$p,$rb){
$o=mkprm($rb,'alone',5);
foreach($r as $k=>$v){$jx=$v['id'].'_fifunc_'; 
	$ico=$v['img']?$v['img']:mimes($v['typ'],'',18);
	$div=div(atc('fisub').atd($v['id']),'');
	if($v['r'])$lk=toggle('',$jx.'finder_'.$v['j'].$o,$v['f']);//'&#9658; '.
	else{$lk=toggle('',$jx.'finder*reader_'.$v['j'].$v['dist'],$v['f']);}
	$ret.=divc('fipop',$ico.' '.$lk.' '.$div);}//.' '.$v['opt']
return $ret;}

function finder_panel($r,$p,$rb){
$o=mkprm($rb,'',4);
foreach($r as $k=>$v){$jx=$v['id'].'_fifunc_'; $div=divd($v['id'],'');
	$ico=$v['img']?$v['img']:mimes($v['typ'],'',18);
	if($v['r'])$lk=lj('','finder_finder___'.$v['j'].$o,$v['f']);
	else $lk=toggle('',$jx.'finder*reader_'.$v['j'].$v['dist'],$v['f']);
	$ret.=divc('fipop',$ico.' '.$lk.$div);}//.' '.$v['opt']
return $ret;}

function finder_icons($r,$p,$rb){
$o=mkprm($rb,'',4);
foreach($r as $k=>$v){
	$thumb=$v['img']?$v['img']:mimes($v['typ'],'',32);
	if($v['r'])$lk='finder_finder___'.$v['j'].$o;
	else $lk='popup_fifunc___finder*reader_'.$v['j'].$v['dist'].'_1';
	$ret.=lj('icones',$lk,$thumb.br().$v['f']);}
return divc('',$ret);}

function finder_recursive($r,$p,$rb){$o=mkprm($rb,'alone',5);
foreach($r as $k=>$v){$id=normalize($p.$k);
	$lk=toggle('',$id.'_finder_'.ajx($p.'/'.$k).'_'.$o,$k);
	if(is_array($v))$rte=finder_recursive($v,$p.'/'.$k,$rb); else $rte='';
		$div=div(atc('fisub').atd($id),$rte);
	$ret.=divc('fipop',$img.' &#9658; '.$lk.' '.$size.$div);}
return $ret;}

function finder_conn($r,$p,$rb){$o=mkprm($rb,'alone',5).'_1';//1=popup
foreach($r as $k=>$v){if($v['j']){$jx='popup_fifunc___';//$v['id'].
	$ico=$v['img']?$v['img']:mimes($v['typ'],'','32');
	//$div=span(atc('').atd($v['id']),'');
	//if($v['r'])$lk=toggle('icones',$jx.'finder_'.$v['j'].$o,$ico.br().$v['f']);
	if($v['r'])$lk=lj('icones',$jx.'finder_'.$v['j'].$o,$ico.br().$v['f']);
	else $lk=ljb('icones','insert',$v['conn'],$ico.br().$v['f']).' ';
	if($v['r'] or $v['conn'])$ret.=$lk;}}
return $ret;}

//flap
function fi_flap($p,$o){$rb=explode('/',$o);
list($r,$rb)=fi_slct($p,$rb); if($r)ksort($r);
return finder_data($r,$p,$rb);}

function fi_flapf($p,$o){$r=fi_flap($p,$o);
if(strprm($o,0)=='disk' && auth(4))$ret=fi_dirinfo($p,$o);
$ret.=finder_flap_files($r,$o,$p);
return $ret;}

function finder_flap_dirs($r,$p,$o){ksort($r); static $i;
foreach($r as $k=>$v){if(is_array($v)){$np=$p.'/'.$k; $i++;
	$j='active_list_finder(\'fdirs\','.$i.'); ';
	$j.=sj('ffils_fifunc___fi*flapf_'.ajx($np).'_'.$o);
	$lk=ljb('',$j,'',$k);
	$ul=balb('ul','style="display:none;"',finder_flap_dirs($v,$np,$o));
	$ret.=li($lk.$ul);}}
return $ret;}

function finder_flap_files($r,$o,$p){$jc=fi_droot();
foreach($r as $k=>$v){if(!$v['r']){$furl=$jc.$v['url'];
	if($v['img']){list($w,$h)=fi_sizes($furl);
	$ico=ljb('','SaveBf','photo_users(slash)'.$v['j'].''.$w.'_'.$h,$v['img']).' ';}
	else $ico=mimes($v['xt'],'',18).' ';
	$op=lkt('txtsmall',$furl,picto('url')).' ';
	if($v['xt']=='.mp3')$mp3=1; if($v['xt']=='.jpg')$jpg=1; 
	$lk=lj('','popup_fifunc___fi*reader*pop_'.$v['j'].$v['dist'],etc($v['f'],40)).' ';
if(!auth(4))$sh=lkc('','plug/download.php?file='.$furl,fi_pic('download'));
elseif($v['prop']==$_SESSION['qb'])$sh=fi_info_shared($v['url'],randid());
	$ret.=divc('',$ico.$op.$sh.$lk);}}
$dir='../'.split_only('/',$furl,1,0);
if($mp3)$rt=lj('','popup_callp___pop_jukebox_'.$dir.'_autosize',picto('play'));
if($jpg)$rt=lj('','popup_callp___pop_gallery*j_'.$dir.'_autosize',picto('play'));
return $rt.$ret;}

function finder_flap($r,$p,$rb){$o=mkprm($rb,'alone',5);
$reta=finder_flap_dirs($r,$p,$o);
$rb=finder_data($r,$p,$rb); $retb=finder_flap_files($rb,$o,$p);
$csa='class="flap" style="width:140px;"';
$csb='class="flapf" style="width:390px;"';
return div($csa,divd('fdirs',$reta)).div($csb,divd('ffils',$retb));}

//render
function fi_design($fi,$rb){$id=randid();
if($rb[4]!='conn')$ret=divc('fimnu imgr',$fi['menu'].hlpbt('finder')); 
$ret.=$fi['url'].$fi['flap'].$fi['reg'].$fi['act'];
$ret.=($ret?br().br():'').$fi['win'];
return div('id="finder" style="width:550px;"',$ret);}//float:left; 

function fi_plnk($p,$o){$o=mkprm($o,'',5);
if(strprm($o,0)=='')$o=mkprm($rb,'disk',0); $o=str_replace('/','|',$o);
return lkc('grey','/?module='.str_replace('/','|',$p).'///'.$o.':finder',picto('link'));}

//define
function fi_define($p,$o){$jc='users/';
if($o=='auto')$o=$_SESSION['fio']; 
if(strprm($o)=='auto'){$p=$_SESSION['fip'];//restitution
	$o=mkprm(mkprm($_SESSION['fio'],'',5),strprm($o,1),strprm($o,2));}
if(strprm($o)=='shared')$o=mkprm(explode('/',$o),'',4);
if($o)$_SESSION['fio']=$o; $_SESSION['fip']=$p; $rb=explode('/',$o);
if($rb[1]!='distant' && strpos($p,'.')!==false)$p='';//good_p//not for distant and .
if($rb[0]=='disk' && $rb[3]!='icon'){$rb[1]='';
	if(!$p && !auth(6))$p=$_SESSION['qb']?$_SESSION['qb']:'dev';}
$ra=explode('/',$p);
$_SESSION['droot']=$rb[1]=='distant'?'http://'.$ra[0].'/'.$jc:$jc;
if($rb[5]=='update'){shared_files(); distrib_share(); $rb[5]='';}
return array($p,$o,$ra,$rb);}

function fi_droot(){return $_SESSION['droot']?$_SESSION['droot']:'users/';}

function fi_slct($p,$rb){
if($rb[3]=='icon')$_SESSION['droot']=$jc='imgb/icons/'; else $jc='users/';
if(!$_SESSION['curdir'])shared_files();// or $_GET['admin']=='finder'
if($rb[4]=='recursive')$r=explore('users/'.$p,'dirs');
elseif($rb[0]=='disk')$r=explore($jc.$p,'');//all
elseif($rb[0]=='flap')$r=explore($jc.$p,'');
else{$r=finder_shared($p,$rb); $rb[0]='shared';} 
if(is_array($r))natsort($r); //p($r); 
return array($r,$rb);}

function fi_normalize($p,$o){}

function finder($p,$o){
list($p,$o,$ra,$rb)=fi_define($p,$o);
list($r,$rb)=fi_slct($p,$rb);
if($rb[5]!='alone' && $rb[4]!='conn'){
	$fi['menu']=finder_menu($rb,$p); $fi['url']=finder_url($ra,$rb);}
if($rb[0]!='shared' && auth(4) && $rb[4]!='conn')$fi['act']=fi_dirinfo($p,$o);
elseif($rb[4]!='conn' && $rb[5]!='alone')$fi['act']=fi_plnk($d,$o);
if($r){$rb[5]=='';//read
	$rr=finder_data($r,$p,$rb);
	if($rb[3]=='icons')$fi['win']=finder_icons($rr,$p,$rb);
	elseif($rb[3]=='panel')$fi['win']=finder_panel($rr,$p,$rb);
	elseif($rb[4]=='recursive'){$fi['win']=finder_recursive($r,$p,mkprm($rb,'',4,1));}
	elseif($rb[3]=='icon' or $rb[3]=='disk')$fi['win']=finder_conn($rr,$p,$rb);
	elseif($rb[3]=='list')$fi['win']=finder_list($rr,$p,$rb);
	else $fi['win']=finder_flap($r,$p,$rb);}//if($rb[3]=='flap')
if($rb[5]!='alone'){//$fi['flap']=finder_flap($r,$p,$rb);
	if($rb[1]=='distant' && strpos($p,'.')===false)$fi['reg']=fi_dist_list();
	if(count($fi)>0)$ret=fi_design($fi,$rb);}
else $ret=$fi['act'].$fi['win'];
//$ret.=js_code('autoscroll(\'finder\');');
return $ret.divc('clear','');}

//options: (first=default)
//0=disk/shared/icons
//1=local/global/distant
//2=virtual/real
//3=list/panel/flap/icons/icon-disk
//4=normal/recursive/conn
//5=update/alone
//6=pictos/mini

?>