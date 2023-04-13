<?php 
class finder{
//utils
static function normalize($n){//let the "/"
$n=str_replace([" ","'",'"',"?","ï¿½",",",";",":","!","%","&","$","#","_","+","!","\n","\r","\0","[\]","~","(",")","[","]",'{','}',"§","§"],"",($n));
return eradic_acc($n);}

static function mkprm($r,$d='',$n='',$ar=''){
if(!is_array($r))$r=opt('','/',7);//$d?
for($i=0;$i<7;$i++)if($n==$i)$r[$n]=$d;
if($ar)return $r; else return implode('/',$r);}

static function mnu($r,$p,$d,$n,$q='',$o=''){
if($o)$o='auto/'.$d.'/'.$n; else $o=self::mkprm($r,$d,$n); 
if($r[$n]==$d or(!$r[$n] && $q))$c='active'; else $c='';
return lj($c,'fndr_finder,home___'.$p.'_'.$o,self::mimes($d,'',16),$d).' ';}

//menus
static function menu($r,$p){$ret='';
if($r[0]=='shared' or $r[0]==''){if(auth(4)){
	$ret.=self::mnu($r,'','local',1,1).self::mnu($r,'','global',1).self::mnu($r,'','distant',1);
	$ret.=' | ';
	$ret.=self::mnu($r,$p,'virtual',2,1).self::mnu($r,$p,'real',2).' | ';}}
//elseif($r[3]=='list' or $r[3]=='')
//	$ret.=self::mnu($r,$p,'normal',4,1).self::mnu($r,$p,'recursive',4).' | ';
if(auth(4))$ret.=self::mnu($r,'','shared',0,1).self::mnu($r,$_SESSION['qb'],'disk',0).' | ';
$ret.=self::mnu($r,$p,'flap',3,1).self::mnu($r,$p,'icons',3); $ret.=' | ';
//$ret.=self::mnu($r,$p,'panel',3).self::mnu($r,$p,'list',3);
//$ret.=self::mnu($r,$p,'pictos',6,1,1).self::mnu($r,$p,'mini',6,'',1).' | ';
if($r[0]=='shared' or $r[0]==''){if(auth(4)){
	if($r[1]=='global')$ret.=self::mnu($r,$p,'update',5);
	if($r[1]=='global')$ret.=msqbt('server','shared_files');
	elseif($r[1]!='distant')$ret.=msqbt('',$_SESSION['qb'].'_shared');}}
return $ret;}

static function nms($d){
$r=['new'=>44,'rename'=>72,'virtual_dir'=>73,'shared'=>74,'not'=>75,'delete'=>76,'upload'=>78];
return isset($r[$d])?nms($r[$d]):$d;}

static function pic($d,$sz=''){
$r=['folder'=>'folder2','rename'=>'editxt','new'=>'add','delete'=>'no','upload'=>'upload','download'=>'download','url'=>'link','pdf'=>'txt','open'=>'popup','music'=>'music','play'=>'play','register'=>'connect','virtual_dir'=>'virtual']; 
return pictit($r[$d],self::nms($d),$sz);}

static function mimes($d,$t,$sz){
$r=['local'=>'local','global'=>'users','distant'=>'server','virtual'=>'virtual','real'=>'folder','normal'=>'topo','recursive'=>'topo-open','disk'=>'disk','shared'=>'finder','list'=>'list','panel'=>'folder','icons'=>'icons','flap'=>'flap','pictos'=>'file','mini'=>'mini','update'=>'upcloud']; if($r[$d])$t=$r[$d]; if(!$t)$t='file'; 
if($t)return picto($t,$sz);}

//url
static function url($r,$rb){$o=self::mkprm($rb,'',5); $ret='';
if($rb[0]=='disk' && auth(6))$ret=lj('fipop','fndr_finder,home__3__'.$o,'root').' ';
if($rb[0]=='shared')array_unshift($r,''); $n=count($r); $cur='';
for($i=0;$i<$n;$i++){$cur.=($i&&$n>1?'/':'').$r[$i]; 
	if(!$i)$r[$i]=pictxt('reload',$r[$i]?$r[$i]:'root'); $j=ajx($cur).'_'.$o;
	if($i==$n-1)$c='active';
	if($r[$i])$ret.=lj('','fndr_finder,home___'.$j,$r[$i]).' ';}
return btn('nbp',$ret);}

//virtual_dir
static function virtual_array($r,$o){$ret=[]; $rc=[];
foreach($r as $k=>$v){$do[$v[$o]][]=$v[0];}
foreach($do as $k=>$v){$rb=explode('/',$k); $n=count($rb)-1; 
	$n=$o==0?$n-1:$n; $rc=$v;
	for($i=$n;$i>=0;$i--){$rd=$rc; $rc=[]; $k=$rb[$i]??''; if(is_string($k))$rc[$k]=$rd;}
	if($rc)$ret+=$rc;}
return $ret;}

static function select_subarray($p,$r,$o){
$ra=explode('/',$p); $n=count($ra);
for($i=0;$i<$n;$i++){if($ra[$i] && strpos($ra[$i],'.')===false)$r=$r[$ra[$i]];}//
return $r;}

//shared
static function unset_nofile($r){
if($r)foreach($r as $k=>$v)if(isset($v[0]) && !is_file('users/'.$v[0]))unset($r[$k]);
return is_array($r)?$r:[];}

static function distrib_virtual_dir(){$rc=[]; $dr='users'; $nd='shared';
$ra=msql::choose($dr,'',$nd); $n=count($ra);
for($i=0;$i<$n;$i++)if(isset($ra[$i])){
	$r=msql_read($dr,$ra[$i],'',1); $r=self::unset_nofile($r);
	if($r)$rc=array_merge($rc,$r);}
return $rc;}

static function distrib_share(){
$r=self::distrib_virtual_dir(); $dr='server'; $nod='shared_files';
if($r){$ra['_menus_']=['url','vurl']; $ra+=$r;
msql::modif($dr,$nod,$ra,'arr');}}

static function shared_files(){
$r=msql_read('',nod('shared'),'',1); $rb=self::unset_nofile($r);
if(count($r)>count($rb))msql::modif('',nod('shared'),$rb,'arr');
$_SESSION['curdir']=$rb;}

static function share_file($d,$p,$b){$h=['url','vurl'];
$_SESSION['curdir']=msql::modif('',nod('shared'),[$d,$p],$b,$h,$b=='del'?$p:0);
self::distrib_share();}

static function share_rename($d,$old){$h=['url','vurl']; 
$r=msql_read('',nod('shared'),'');
if($r)foreach($r as $k=>$v){$ret[$k]=[str_replace($old,$d,$v[0]),$v[1]];}
$_SESSION['curdir']=msql::modif('',nod('shared'),$ret,'mdf',$h,'');
self::distrib_share();}

//distant
static function fdistant($p){//server
$h=strto($p,'/');  $u='http://'.$h.'/call/msqj/server|shared_files';
if(strpos($h,'.')!==false)return msqa::import_json($u);}

static function shared($p,$rb){//select
if(substr($p,0,1)=='/')$p=substr($p,1).'/'; $o=$rb[2]=='real'?0:1;
if($rb[1]=='distant')$r=self::fdistant($p);
elseif($rb[1]=='global')$r=msql_read('server','shared_files','',1);
else $r=msql_read('',nod('shared'),'',1);//$_SESSION['curdir'];
if($r)$r=self::virtual_array($r,$o);
$r=self::select_subarray($p,$r,$o);
return $r;}

static function distant($fa,$g,$fb){//client
if(substr($fa,0,4)!='http')$fa='http://'.$fa;
$fd=$fa.'/call/microsql/'.$g.'/'.$fb; return read_file($fd);}
static function info_dist($f,$g){$fa='http://'.strprm($f,2); $fb=str_replace($fa.'/','',$f);
return self::distant($fa,$g,'../'.$fb);}
static function dist_reg(){
return self::distant($_SESSION['prmb'][24],'addserver',$_SERVER['HTTP_HOST']);}

static function dist_list(){$h=$_SERVER['HTTP_HOST'];
$rt=self::distant($_SESSION['prmb'][24],'getservers','=');
$r=explode(';',$rt); $cur=''; $ret=''; //$r=msql_read('server','shared_servers','',1); 
if($r)foreach($r as $k=>$v){if($v==$h)$cur='ok';
	if($v)$ret.=divc('fipop',lj('popbt','fndr_finder,home___'.$v.'_auto',$v));}
if(!$cur)$ret.=blj('','fisrv','finder,dist*reg',self::pic('register')).' ';
return $ret?br().br().$ret:'';}

//process
static function fparent($p,$id,$t,$sc=''){
if($sc)$p=struntil($p,'/'); $j=ajx($p); $o=$_SESSION['fio'];
if(strprm($o)=='shared')$p=$id; elseif(strpos($p,'/')===false){
	$p='fndr'; $_SESSION['fio']=self::mkprm($o,'',5);} else $p=normalize($p); 
if(strprm($o,1)=='distant')return btn('txtyl',$t);
return lj('txtyl',$p.'_finder,home___'.$j.'_auto',$t);}

static function rename($d,$id,$prm=[]){
$dr='users/'; $res=$prm?self::normalize($prm[0]):''; $not='';
if(!$res){$j=$id.'firnm_finder,rename_'.$id.'frnm__'.ajx($d).'_'.$id;
	$ret=input($id.'frnm',$d).' '.lj('popsav',$j,'ok');}
elseif(auth(3)){mkdir_r($dr.$res); $ra=explode('/',$res);
	if($ra[0]==$_SESSION['qb']){$ok=rename($dr.$d,$dr.$res);//chmod($dr.$res,0775); 
		if($ok)self::share_rename($res,$d);} else $not='not_';
	$ret=self::fparent($d,$id.'firnm',$not.'saved',1);}
return $ret;}

static function del($d,$id){
if($id!='go')return blj('txtyl',$id.'fidel','finder,del___'.ajx($d).'_go',pictxt('alert','really?'));
$f='users/'.$d; $nod=nod('shared');
if(auth(3))msql::modif('',$nod,[$d],'del','',1);
if(is_file($f))unlink($f); self::shared_files(); self::distrib_share();
return self::fparent($d,$id.'fidel','deleted',1);}

static function vdir($sh,$id,$prm){$v=sesr('curdir',$sh);
if(!$prm){$j=$id.'fivrd_finder,vdir_fvdr__'.$sh.'_'.$id.'__'.$id;
	$ret=input($id.'fvdr',$v[1]??'').' '.lj('popsav',$j,'ok').ljb('popbt','Close',$id.'fivrd','x');}
elseif(auth(3)){$res=$prm[0]??''; $v[1]=$res;
	$_SESSION['curdir']=msql::modif('',nod('shared'),$v,'one','',$sh);
	self::distrib_share(); $ret=self::fparent($v[0],$id.'fivrd','saved');}
return $ret;}

static function share($d,$id,$res){$sh=in_array_r(ses('curdir'),$d,0);
$sbdr=strfrom($d,'/'); $sbdr=struntil($sbdr,'/'); 
if(auth(3)){if($sh)self::share_file($d,$sh,'del'); else self::share_file($d,$sbdr,'push');}
return self::info_shared($d,$id);}

static function sharedir($dr,$o){$r=explore('users/'.$dr);
$sbdr=strfrom($dr,'/'); $sbdr=struntil($sbdr,'/');
$dfb['_menus_']=['url','vurl'];
foreach($r as $k=>$v)$ra[]=[$dr.'/'.$v,$sbdr];
$_SESSION['curdir']=msql::modif('',nod('shared'),$ra,'add',$dfb);
self::distrib_share();
return self::flapf($dr,'disk/////alone/');}

static function newdir($d,$id,$prm){$dr='users/'; $res=$prm[0]??'';//!is_dir($d)?'../'
if(!$res){$j=$id.'finew_finder,newdir_fnew__'.$d.'_'.$id.'__'.$id;
$ret=input($id.'fnew',$d.'/new').' '.lj('popsav',$j,'ok');}//chmod($dr.$d,0777);
elseif(strprm($res,0)==$_SESSION['qb']){mkdir_r($dr.$res);
$ret=self::fparent($d,$id.'finew','ok');} else $ret=btn('txtyl','forbidden');
return $ret;}

static function removef($j,$k,$v,$io){//chmod($j.'/'.$k,0777);
if($v)unlink($j.'/'.$v); else rmdir($j.'/'.$k);}

static function deldir($d,$id){$j='users/'.$d;
if($id!='go')return blj('popdel',$id.'fidld','finder,deldir___'.ajx($d).'_go',pictxt('alert','really delete directory?'));
walk_dir($j,"removef"); rmdir($j);
return self::fparent($d,$id.'fidld','deleted',1);}

static function download($d,$id,$prm){$dr='users/'; $drd=self::droot();
if(!$prm){$nnm=$_SESSION['qb'].'/downoalds/'.strend($d,'/');
	$j=$id.'fidwn_finder,download_'.$id.'fdwn__'.ajx($d).'_'.$id;
	$ret=btn('txtsmall','target:').input($id.'fdwn',$nnm).' '.lj('txtbox',$j,'ok');}
elseif(auth(3)){$res=$prm[0]??''; $ra=explode('/',$res);
	if($ra[0]==$_SESSION['qb']){mkdir_r($dr.$res); copy($drd.$d,$dr.$res);} 
	else $not='not_'; $ret=self::fparent($d,$id.'fidwn',$not.'saved',1);}
return $ret;}

//read
static function sizes($f){$w=''; $h='';
if(is_file($f))[$w,$h]=getimagesize($f); 
else $w=self::info_dist($f,'fwidth');
return [$w,$h];}
/*static function show_img($f,$s){$img=img::make_thumb_c($f,$s,1); [$w,$h]=self::sizes($f);
return ljb('','SaveBf',ajx($f).'_'.($w).'_'.($h),$img);}*/
static function show_img_b($f){[$w,$h]=self::sizes($f); $img=image($f,$w>600?'600px':$w);
return ljb('','SaveBf',ajx($f).'_'.$w.'_'.$h,$img);}

static function info_shared($d,$id){
$sh=in_array_r($_SESSION['curdir'],$d,0); $dj=ajx($d).'_'.$id;
if($sh)$t=nms(74); else $t=nms(75); $c=($sh?'color:#bd0000':''); 
$ret=blj('',$id.'fishr','finder,share___'.$dj,picto('share',$c)).' ';
if($sh)$ret.=blj('',$id.'fivrd','finder,vdir___'.$sh.'_'.$id,self::pic('virtual_dir')).' ';
return $ret;}

static function finfo($d,$id,$f,$dj){$ra=explode('/',$d); $nm=strend($f,'/');
$ret=lkt('popw" title="'.$f,$f,picto('url').' '.$nm).br();
if(substr(self::droot(),0,4)=='http'){$size=self::info_dist($f,'fsize'); 
	$date=mkday(self::info_dist($f,'fdate'));} else{$date=ftime($f,'ymd'); $size=fsize($f,1);}
$ret.=btn('txtsmall2',$size.' '.$date.' '.strprm($d));
return $ret;}

static function reader($d,$dist){$id=randid();
$dr=self::droot(); $f=$dr.$d; $dj=ajx($d).'_'.$id; $xt=xtb($f); $ret='';
//$ret.=blj('',randid().'fidel','finder,del___'.ajx($d),self::pic('delete')).br();
if($xt && is_file($f)){
	if(strpos('.jpg.png.gif',$xt)!==false)$ret.=self::show_img_b($f,'').' ';
	elseif(strpos('.mp3.mid.flac',$xt)!==false)$ret.=audio($f);
	else switch($xt){
	case('.txt'):$ret.=lj('','popup_usg,poptxt___'.ajx($f,''),self::pic('pdf',32)); break;
	case('.mp4'):$ret.=lj('','popup_usg,video___'.ajx($f),self::pic('play',32)); break;
	case('.mkv'):$ret.=lj('','popup_usg,video___'.ajx($f),self::pic('play',32)); break;
	case('.ogv'):$ret.=lj('','popup_usg,video___'.ajx($f),self::pic('play',32)); break;
	case('.pdf'):$ret.=lj('','popup_mk,pdfplayer___'.ajx(host().'/'.$f),self::pic('pdf',32)); break;}}
return self::finfo($d,$id,$f,$dj).br().$ret;}

static function dirinfo($d,$o){$id='fed'.normalize($d); $s=strpos($d,'/'); $ret='';
//$ret=btn('popbt',pictxt('folder2',$d)).' ';
if($s)$ret.=blj('',$id.'firnm','finder,rename___'.ajx($d).'_'.$id,self::pic('rename')).' ';
$ret.=blj('',$id.'finew','finder,newdir___'.ajx($d).'_'.$id,self::pic('new')).' ';
if($s)$ret.=blj('',$id.'fidld','finder,deldir___'.ajx($d).'_'.$id,self::pic('delete')).' ';
$ret.=self::plnk($d,$o).' ';
$ret.=lj('','ffils_finder,sharedir___'.ajx($d),picto('share')).' ';
$ret.=blj('',$id.'upurl','finder,home_upurl__'.ajx($d).'_'.$id,picto('photo')).' ';
$ret.=upload_j('upl'.str_replace('/','',$d),'disk',$d).' ';
return $ret;}

//upurl
static function upurlsav($dr,$o,$prm=[]){$u=$prm[0]??'';
if(!is_img($u))return'no'; $ret=get_file($u); $nm=strrchr($u,'/');
$f='users/'.$dr.'/'.$nm; write_file($f,$ret);
return 'ok';}
static function upurl($p,$id){
$j=$id.'upurl_finder,upurlsav_'.$id.'__'.ajx($p);
return mc::assistant($id,'SaveJ',$j,'http://','');}

//render
static function data($r,$p,$rb){
if(!$r)return [['f'=>'empty']]; if($p)$p.='/'; //ksort($r);
foreach($r as $k=>$v){$rc=[]; $rc['id']=normalize($p.$k); $rc['pid']=normalize($p);
if(!is_numeric($k) or is_array($v)){$rc['r']=1; $rc['f']=$k; $nf=count($v); $nbd=0;
	if(is_array($v)){foreach($v as $ka=>$va){if(!is_numeric($ka))$nbd++;}}
	$rc['nbd']=$nbd; $rc['opt']=btn('txtsmall2','('.$nf.')');//nbof(,51)
	$rc['typ']='folder'; $rc['j']=ajx($p.$k).'_';}//if($nf)!
else{if($rb[0]=='shared'){$url=$v; $f=strpos($v,'/')!==false?strend($v,'/'):$v;}
	else{$url=$p.$v; $f=$v;}
	$fb=self::droot().$url; $xt=xtb($f);
	$rc['url']=$rc['url']=$url; $rc['prop']=strprm($p);
	if($rb[1]=='distant'){$rc['dist']=1;} 
	else{$rc['opt']=btn('txtsmall2',fsize($fb,1)).' ';
		$rc['date']=btn('txtsmall2',ftime($fb,'ymd')).' ';}
	$rc['xt']=$xt; $rc['r']=0; $rc['j']=ajx($url).'_'; $rc['f']=$f;
	if($rb[0]=='shared')$rc['prop']=btn('txtsmall',strprm($v)).' ';
	if(is_file($fb) && $xt)if(strpos('.jpg.png.gif',$xt)!==false && $rb[6]!='pictos' && substr(self::droot(),0,4)!='http')//set as mini
		$rc['img']=img::make_thumb_c($fb,'48/48',''); //self::show_img($fb,'48/48')
		else $rc['typ']=$xt;
	if($rb[3]=='icon'){if($xt){[$fd,$fl]=split_one('/',$url,1);
		if($xt=='.svg'){$fsvg=substr($url,0,-4);
			$rc['conn']='['.$fsvg.'§24:svg]'; $rc['img']=svg($fsvg.'§24');}
		elseif(strpos('.jpg.png.gif',$xt)!==false)
			$rc['conn']='['.substr($fl,0,-4).'ï¿½'.$fd.':icon]';}}
	if($rb[3]=='disk')$rc['conn']='['.$url.']';}
$ret[]=$rc;}
return $ret;}

//modes
static function flist($r,$p,$rb){
$o=self::mkprm($rb,'alone',5); $ret='';
foreach($r as $k=>$v){
	[$url,$img,$j,$xt,$dist,$prop,$f,$typ,$id]=vals($v,['url','img','j','xt','dist','prop','f','typ','id']); 
	$ico=$img?$img:mimes($typ,'',18);
	$div=div(atc('fisub').atd($id),'');
	if($v['r'])$lk=toggle('',$v['id'].'_finder,home___'.$j.$o,$f);//'&#9658; '.
	else{$lk=toggle('',$v['id'].'_finder,reader___'.$j.$dist,$f);}
	$ret.=divc('fipop',$ico.' '.$lk.' '.$div);}//.' '.$v['opt']
return $ret;}

static function panel($r,$p,$rb){
$o=self::mkprm($rb,'',4); $ret='';
foreach($r as $k=>$v){$div=divd($v['id'],'');
	$ico=$v['img']?$v['img']:mimes($v['typ'],'',18);
	if($v['r'])$lk=lj('','fndr_finder,home___'.$v['j'].$o,$v['f']);
	else $lk=toggle('',$v['id'].'_finder,reader___'.$v['j'].$v['dist'],$v['f']);
	$ret.=divc('fipop',$ico.' '.$lk.$div);}//.' '.$v['opt']
return $ret;}

static function icons($r,$p,$rb){
$o=self::mkprm($rb,'',4); $ret='';
foreach($r as $k=>$v){$dst=$v['dist']??'';
	$thumb=$v['img']??mimes($v['typ'],'',32);
	if($v['r'])$lk='fndr_finder,home__15_'.$v['j'].$o;
	else $lk='popup_finder,reader__15_'.$v['j'].$dst.'_1';
	$ret.=lj('icones',$lk,$thumb.br().$v['f']);}
return divc('',$ret);}

static function recursive($r,$p,$rb){
$o=self::mkprm($rb,'alone',5); $ret='';
foreach($r as $k=>$v){$id=normalize($p.$k);
	$lk=toggle('',$id.'_finder,home___'.ajx($p.'/'.$k).'_'.$o,$k);
	if(is_array($v))$rte=self::recursive($v,$p.'/'.$k,$rb); else $rte='';
		$div=div(atc('fisub').atd($id),$rte);
	$ret.=divc('fipop',' &#9658; '.$lk.' '.$div);}
return $ret;}

static function conn($r,$p,$rb){
$o=self::mkprm($rb,'alone',5).'_1'; $ret='';//1=popup
foreach($r as $k=>$v){if(isset($v['j'])){
	$ico=$v['img']??''; if(!$ico)$ico=mimes($v['typ'],'','32');
	//$ico=isset($v['typ'])?$im:'';
	$conn=$v['conn']??'';
	//$div=span(atc('').atd($v['id']),'');
	//if($v['r'])$lk=toggle('icones','popup_finder,home___'.$v['j'].$o,$ico.br().$v['f']);
	if($v['r'])$lk=lj('icones','popup_finder,home___'.$v['j'].$o,$ico.br().$v['f']);
	else $lk=ljb('icones','insert',$conn,$ico.br().$v['f']).' ';
	if(isset($v['r']) or $conn)$ret.=$lk;}}
return $ret;}

//flap
static function fiflap($p,$o){$rb=explode('/',$o);
[$r,$rb]=self::slct($p,$rb); if($r)ksort($r);
return self::data($r,$p,$rb);}

static function flapf($p,$o){$r=self::fiflap($p,$o); $ret='';
if(strprm($o,0)=='disk' && auth(4))$ret=self::dirinfo($p,$o);
$ret.=self::flap_files($r,$o,$p);
return $ret;}

static function flap_dirs($r,$p,$o){ksort($r); static $i; $ret='';
foreach($r as $k=>$v){if(is_array($v)){$np=$p.'/'.$k; $i++;
	$j='active_list_finder(\'fdirs\','.$i.'); ';
	$j.=sj('ffils_finder,flapf___'.ajx($np).'_'.$o);
	$lk=ljb('',$j,'',$k);
	$ul=tag('ul',['style'=>'display:none;'],self::flap_dirs($v,$np,$o));
	$ret.=li($lk.$ul);}}
return $ret;}

static function flap_files($r,$o,$p){
$jc=self::droot(); $ret=''; $mp3=''; $jpg=''; $rt=''; $sh=''; $furl='';
foreach($r as $k=>$v){if(isset($v['r'])){
	[$url,$img,$j,$xt,$dist,$prop,$f]=vals($v,['url','img','j','xt','dist','prop','f']);
	$furl=$jc.$url;
	if($img){[$w,$h]=self::sizes($furl);
	$ico=ljb('','SaveBf','users(slash)'.$j.''.$w.'_'.$h,$img).' ';}
	else $ico=mimes($xt,'',18).' ';
	$op=lkt('txtsmall',$furl,picto('url')).' ';//url
	if($xt=='.mp3')$mp3=1; if($xt=='.jpg')$jpg=1; 
	$lk=lj('','popup_finder,reader___'.$j.$dist,etc($f,40)).' ';
	if(!auth(4))$sh=lkc('','app/download/'.base64_encode($furl),self::pic('download'));
	elseif($prop==$_SESSION['qb']){
		$sh=self::info_shared($url,randid());//share
		$sh.=blj('',$k.'firnm','finder,rename___'.ajx($url).'_'.$k,self::pic('rename')).' ';
		$sh.=blj('',$k.'fidel','finder,del___'.ajx($url).'_'.$k,self::pic('delete')).' ';}
	$ret.=divc('',$ico.$op.$sh.$lk);}}
$dir='../'.struntil($furl,'/');
if($mp3)$rt=lj('','popupmk,jukebox___'.$dir.'_autosize',picto('play'));
if($jpg)$rt=lj('','popup_mk,gallery___'.$dir.'_autosize',picto('play'));
return $rt.$ret;}

static function flap($r,$p,$rb){$o=self::mkprm($rb,'alone',5);
$reta=self::flap_dirs($r,$p,$o);
$rb=self::data($r,$p,$rb); $retb=self::flap_files($rb,$o,$p);
$csa=atc('flap').ats('width:140px; margin-right:10px;');
$csb=atc('flapf').ats('width:calc(100% - 160px);');
return div($csa,divd('fdirs',$reta)).div($csb,divd('ffils',$retb));}

//render
static function design($fi,$rb){$id=randid(); $ret='';
if($rb[4]!='conn')$ret=divc('fimnu imgr',$fi['menu'].hlpbt('finder')); 
[$u,$fl,$rg,$ac]=vals($fi,['url','flap','reg','act']);
$ret.=$u.$fl.$rg.$ac;
$ret.=($ret?br():'').($fi['win']??'');
return div(atd('fndr'),$ret);}//.ats('width:640px;')

static function plnk($p,$o){$o=self::mkprm($o,'',5); $rb='';//?
if(strprm($o,0)=='')$o=self::mkprm($rb,'disk',0); $o=str_replace('/','|',$o);
return lkc('grey','/?module='.str_replace('/','|',$p).'///'.$o.':finder',picto('link'));}

//define
static function define($p,$o){$jc='users/';
if($o=='auto')$o=$_SESSION['fio']; 
if(strprm($o)=='auto'){$p=$_SESSION['fip'];//restitution
	$o=self::mkprm(self::mkprm($_SESSION['fio'],'',5),strprm($o,1),strprm($o,2));}
if(strprm($o)=='shared')$o=self::mkprm(explode('/',$o),'',4);
if($o)$_SESSION['fio']=$o; $_SESSION['fip']=$p; $rb=opt($o,'/',7);
if($rb[1]!='distant' && strpos($p,'.')!==false)$p='';//good_p//not for distant and .
if($rb[0]=='disk' && $rb[3]!='icon'){$rb[1]='';
	if(!$p && !auth(6))$p=$_SESSION['qb']?$_SESSION['qb']:'dev';}
$ra=explode('/',$p);
$_SESSION['droot']=$rb[1]=='distant'?'http://'.$ra[0].'/'.$jc:$jc;
if($rb[5]=='update'){self::shared_files(); self::distrib_share(); $rb[5]='';}
return [$p,$o,$ra,$rb];}

static function droot(){return $_SESSION['droot']??'users/';}

static function slct($p,$rb){
if($rb[3]=='icon')$_SESSION['droot']=$jc='imgb/icons/'; else $jc='users/';
if(!ses('curdir'))self::shared_files();// or get('admin')=='finder'
if($rb[4]=='recursive')$r=explore('users/'.$p,'dirs');
elseif($rb[0]=='disk')$r=explore($jc.$p,'');//all
elseif($rb[0]=='flap')$r=explore($jc.$p,'');
else{$r=self::shared($p,$rb); $rb[0]='shared';}
if(is_array($r))ksort($r);
return [$r,$rb];}

//options: (first=default)
//0=disk/shared/icons
//1=local/global/distant
//2=virtual/real
//3=list/panel/flap/icons/icon-disk
//4=normal/recursive/conn
//5=update/alone
//6=pictos/mini

static function home($p,$o){
[$p,$o,$ra,$rb]=self::define($p,$o);
[$r,$rb]=self::slct($p,$rb); $fi=[]; $ret='';
if($rb[5]!='alone' && $rb[4]!='conn'){
	$fi['menu']=self::menu($rb,$p); $fi['url']=self::url($ra,$rb);}
if($rb[0]!='shared' && auth(4) && $rb[4]!='conn')$fi['act']=self::dirinfo($p,$o);
elseif($rb[4]!='conn' && $rb[5]!='alone')$fi['act']=self::plnk('',$o);
if($r){$rb[5]=='';//read
	$rr=self::data($r,$p,$rb);
	if($rb[3]=='icons')$fi['win']=self::icons($rr,$p,$rb);
	elseif($rb[3]=='panel')$fi['win']=self::panel($rr,$p,$rb);
	elseif($rb[4]=='recursive'){$fi['win']=self::recursive($r,$p,self::mkprm($rb,'',4,1));}
	elseif($rb[3]=='icon' or $rb[3]=='disk')$fi['win']=self::conn($rr,$p,$rb);
	elseif($rb[3]=='list')$fi['win']=self::flist($rr,$p,$rb);
	else $fi['win']=self::flap($r,$p,$rb);}//if($rb[3]=='flap')
if($rb[5]!='alone'){//$fi['flap']=flap($r,$p,$rb);
	if($rb[1]=='distant' && strpos($p,'.')===false)$fi['reg']=self::dist_list();
	if(count($fi)>0)$ret=self::design($fi,$rb);}
else $ret=($fi['act']??'').($fi['win']??'');
//$ret.=jscode('autoscroll(\'finder\');');
return $ret.divc('clear','');}

}
?>