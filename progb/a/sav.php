<?php //a/sav
class sav{
static $r=[];
static $er='';

static function save_art(){$dayx=ses('dayx'); $frm=ses('frm');
$qb=ses('qb'); $USE=ses('USE'); self::$er=''; $lg=''; $mail=''; $nid='';
if(!$frm)$frm='public'; if(!auth(2))return;
$rc=['suj','msg','name','mail','ib','pdat','pub','sub'];
[$suj,$d,$name,$mail,$ib,$pdat,$pub,$sub]=vals(self::$r,$rc);
$suj=str::clean_title($suj); $suj=etc($suj,240); $urlsrc=ses::$urlsrc; 
if(!$ib)$ib=0; if($ib)$ib=trim($ib); if($pub)$re=1; else $re=0;
if($urlsrc){$mail=http($urlsrc); $mail=utmsrc($mail);} if(!$ib)$ib='0';//!$sub or 
if(!$name or $name==nms(38)){self::$er.='miss:name;';}//alert('empty_name $name'); 
if($mail=='mail' or $mail=='url'){$mail='';$urlsrc='';}
if($d){$d=nl2br($d); $d=str_replace(['<br />','<br/>','<br>','<BR>'],"\n",$d);}
if(!$d && $urlsrc)[$suj,$d]=conv::vacuum($mail,$suj);
$d=str::html_entity_decode_b($d); $d=str::embed_links($d);//$d=goodpar($d); 
$d=str::decode_unicode($d); $d=str::clean_br_lite($d); $d=str::clean_punct($d);
if($pdat)$pdt=strtotime($pdat); else $pdt=$dayx;
if(empty($suj))$suj='forbidden title';
if(empty($d)){self::$er='miss::msg;';}//alert('msg forbidden'); 
if(!self::$er){
	$sz=mb_strlen($d); $img=''; $thm=str::hardurl($suj);//if(rstr(38))
	if(rstr(129))$lg=trans::detect('','',$suj); if($lg==ses('lng'))$lg='';
	$rw=[$ib,$name,$mail,$pdt,$qb,$frm,$suj,$re,0,$img,$thm,$sz,$lg];
	$nid=sqlsav('qda',$rw,0); if($nid)sql::savi('qdm',[$nid,$d],0);}
//if($nid && $USE!=$qb && $_SESSION['auth']<6){mail($_SESSION['qbin']['adminmail'],'new article: '.stripslashes($suj),host().'/'.$nid.',auth_level: '.$_SESSION['auth']."\n",'From: '.$USE);}
vacses($urlsrc,'u','x');
if($nid){$rc=[$pdt,$frm,$suj,$img,$qb,$thm,0,$name,$sz,$urlsrc,$ib,$re,$lg];
	$rc[3]=pop::art_img($img);
	if(!isset($_SESSION['rqt'][$nid]))$_SESSION['rqt'][$nid]=$rc; 
	msql::modif('',nod('cache'),$rc,'one','',$nid);
	$d=codeline::parse($d,$nid,'savimg');
	geta('read',$nid); boot::deductions($nid,''); self::$r=[];}
$_SESSION['dayx']=time(); $_SESSION['daya']=ses('dayx');
return $nid;}

static function saveart_url($u){$cat=vacses($u,'c'); if(!auth(4))return;
$qda=ses('qda'); $qdm=ses('qdm'); $qb=$name=ses('qb'); 
$pdt=ses('dayx'); $frm=$cat?$cat:'public'; $re=rstr(11)?1:0;
ses::$urlsrc=$u; [$suj,$d]=conv::vacuum($u,''); $ib='0'; $lg='';
$d=str::embed_links($d); $d=str::clean_br_lite($d); $d=str::clean_punct($d);//$d=goodpar($d); 
$sz=mb_strlen($d); $img=''; $lg='';
$thm=str::hardurl($suj);//if(rstr(38))
//$lg=ses('lang')!='all'?ses('lang'):substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2);
//if(rstr(129))$lg=trans::detect('','',$suj); if($lg==ses('lng'))$lg='';
$rw=[$ib,$name,$u,$pdt,$qb,$frm,$suj,$re,0,$img,$thm,$sz,$lg];
$nid=sqlsav('qda',$rw); if($nid)sql::savi('qdm',[$nid,$d]);
if($nid)vacses($u,'b','x');
$d=codeline::parse($d,$nid,'savimg');
$img1=sql('img','qda','v',$nid); $img=pop::art_img($img1);
//day,frm,suj,img,nod,thm,lu,name,host,mail,ib,re,lg
$_SESSION['rqt'][$nid]=[$pdt,stripslashes($frm),stripslashes($suj),$img,$qb,'','','',$sz,$u,$ib,$re,''];
$_SESSION['daya']=ses('dayx');
return $nid;}

static function modif_art($id,$d){$qdm=$_SESSION['qdm']; if(!auth(3))return; //$d=delr($d);
$d=str::clean_acc($d); $d=str::stupid_acc($d); $d=str::embed_links($d);//$d=goodpar($d); 
$d=str::decode_unicode($d); $d=codeline::parse($d,$id,'savimg'); $d=str::clean_br_lite($d);
$d=str::clean_punct($d); $d=str::repair_tags($d);//if(rstr(70))$d=conn::retape($d,$id);
if(is_numeric($id))sqlup('qdm',['msg'=>$d],$id);
$sz=mb_strlen($d??''); sql::upd('qda',['host'=>$sz],$id); cachevs($id,8,$sz);
return stripslashes($d??'');}

static function editart($id,$cont,$prm){$p1=$prm[0]??'';
if($p1)$d=self::modif_art($id,$p1);
//if(ses::$enc=='utf-8')$d=utf8dec_b($d);//devutf
$edt=txarea1($d); $txt=ma::read_msg($id,3);
//if(ses::$enc=='utf-8')$txt=utf8dec_b($txt);//devutf
return $cont?[$edt,$txt]:$txt;}

static function publish_art($d,$id,$bs){
if(!auth(4))return;
if($d=='on')sql::upd($bs,['re'=>'1'],$id);
//if($d=='on'){mails::send_user_mail(ses('read'),'published_art');
//	if($bs=='qdi')mails::sendtrk($id);}
elseif($d=='off')sql::upd($bs,['re'=>'0'],$id);}

static function uploadsav($id,$type,$dsk){$rid='upfile'.$id;
$f=$_FILES[$rid]['name']; $f_tmp=$_FILES[$rid]['tmp_name'];
if(!$f)return 'no file uploaded '; $er=''; $rep=''; $w='';
$f=normalize($f); $xt=xt($f); $qb=ses('qb'); if(!auth(4))return;
$goodxt='.mp4.m4a.mov.mpg.mp3.mkv.mid.wav.jpg.png.gif.pdf.txt.docx.rar.zip.tar.gz.svg.webp.webm.ods.odt';
$goodxt.=$_SESSION['prmb'][23];
if(stristr($goodxt,$xt)===false)$er=$xt.'=forbidden; authorized='.$goodxt.br();
if(stristr('.jpg.png.gif.mp3.mp4.pdf',$xt)===false)$w=':w';
$fsize=$_FILES[$rid]['size']/1024; $uplimit=prms('uplimit');
if($fsize>=$uplimit || $fsize==0)$er.='>'.$uplimit.'Ko';
if(stristr('.m4a.mpg.mp4.webm',$xt)!==false)$rep='users/'.$qb.'/video/';
elseif(stristr('.rar.txt.pdf.svg',$xt)!==false)$rep='users/'.$qb.'/docs/';
elseif(stristr('.mp3.mid',$xt)!==false)$rep='users/'.$qb.'/mp3/'; 
if($type=='banim'){$fb='ban/'.$qb.'.jpg'; $dir='imgb/';}
elseif($type=='avnim'){$fb='usr/'.ses('USE').'_avatar.gif'; $dir='imgb/';}
elseif($type=='css'){$fb='usr/'.$qb.'_css_'.$f; $dir='imgb/';}
elseif($type=='bkgim'){$fb='usr/'.$qb.'_bkg.jpg'; $dir='imgb/';}
elseif($type=='disk'){$dir='users/'.$dsk.'/'; $fb=$f; if($dsk!=$qb)mkdir_r($dir);}
elseif($type=='trk'){$fb=$qb.'_'.substr($id,2).'_'.substr(md5($f),0,6).$xt; $dir=$rep?$rep:'img/';}
else{$fb=$qb.'_'.$id.'_'.substr(md5($f),0,6).$xt; $dir=$rep?$rep:'img/';}
if(!is_dir($dir))mkdir_r($dir); $fc=$dir.$fb;
if(is_uploaded_file($f_tmp) && !$er){
	if(!move_uploaded_file($f_tmp,$fc))$er.='not saved';
	if($type=='art' && is_img($fc)){conn::add_im_img($fb,$id);}//conn::add_im_msg($id,'',$fb.$w);
	if($xt=='.tar' or $xt=='.gz')unpack_gz($fc,$dir);}
else $er.='upload refused: '.$fb;
if(!$er && $type=='avnim')make_mini($fc,$fc,72,72,2);
if($er)return btn('txtyl',picto('false').' '.$fc.': '.$er);
elseif($type=='disk' or !is_img($fc))return btn('txtyl',picto('true').' '.$fc);
elseif($type=='art')return self::placeim($id);
elseif($type=='trk')return self::placeimtrk($fb,$id);
else return image($fc,48,48).btn('txtx',picto('true').' '.$fc);}

/*static function upimg($p,$o,$prm){$p1=$prm[0]??'';
if($p1)write_file('users/'.ses('qb').'/'.$p,base64_decode($p1)); break;}*/

#visitor
static function bckread($id,$idb){
$r=msql_read('',nod('backup_'.$id),$idb); $txt=is_array($r)?$r[1]:$r;
return conn::read($txt,3,$id);}

#vacuum
static function find_vaccum($n){$i=0; foreach($_SESSION['vac'] as $k=>$v){$i++; if($i==$n)return $k;}}
static function newartcatset($n,$d){$u=self::find_vaccum($n); $_SESSION['vac'][$u]['c']=$d;}
//static function newartparentset($u,$d){return vacses($u,'p',$d);}
static function newartparent(){$r=array_keys_r($_SESSION['rqt'],10); $rb=[];
//if($read=ses('read'))if($read!=get('read'))$ret[$read]='(current) '.ma::suj_of_id($read);
if(isset($r))foreach($r as $k=>$v)if($v!='/')$rb[$v]=radd($rb,$v); if($rb)arsort($rb);
if(isset($rb))foreach($rb as $k=>$v)$ret[$k]='('.$v.') '.ma::suj_of_id($k);
return $ret;}

static function saveiec($j,$cat,$rid,$cid='',$v='',$x='',$c='',$suj=''){
$p=[$j,$cat,$rid,$cid,$x,ajx($suj)]; $h=$rid?hidden($rid,''):'';
return ljb($c,'SaveIec',$p,$v?$v:picto('download')).$h;}

static function newartcat($url){
$r=ma::find_cat(30); ksort($r); $u=ajx($url);
$head=select_j('addib','parent','',0,picto('topo'),1).' ';//parent_slct('addib')
$vrf=vacses($url,'c'); $ret='';
foreach($r as $k=>$v){if($k==$vrf)$c='active'; else $c='';
	$ret.=self::saveiec($u,ajx($k),'','addib',$k,'',$c).' ';}//addart
return $head.divc('nbp',$ret);}//savart
//scroll($r,,24,'',400)

#batch
static function batchsav(){$r=ses('vac'); $rb=[]; $_SESSION['vac2']=$r;
if($r)foreach($r as $k=>$v){$rb[]=self::saveart_url($v['u']); $_SESSION['dayx']=time();}
if($rb)return implode(',',array_reverse($rb));}//ind arts

static function batchadd($p,$o,$prm){$d=$prm[0]??$p;
$r=explode("\n",$d); foreach($r as $k=>$v){$f=utmsrc($v);
	[$t,$d]=conv::vacuum($f); vacses($f,'b',$d); vacses($f,'t',$t);}
return self::batch('','');}

static function batch($f,$d){
$f=utmsrc($f); $fb=vacurl($f);
$idt='adc'; if($d=='c')$idt.='p';//bub
if(substr($f??'',0,4)!='http' && $f && $f!='x' && $f!='1')$f=http($f);
if($f=='x')$_SESSION['vac']=[]; $ret='';
if(trim($f??'') && $f!='1' && $d!='1' && $f!='x' && $d!='x' && !isset($_SESSION['vac'][$fb]['b']))
	if(joinable($f)){[$t,$tx]=conv::vacuum($f); vacses($f,'t',$t);}
if($d=='x')unset($_SESSION['vac'][$fb]);
if($d=='n')return textarea('bad',$f,44,12).' '.lj('',$idt.'_sav,batchadd_bad_3',picto('ok')).' ';
if($d=='p')return 'ok';
if($d=='c')$ret=btj(picto('popup'),sj('popup_sav,batch____c').' closebub(this);').' ';
$ret.=lj('',$idt.'_sav,batch____in_'.$d,picto('reload')).' ';
$ret.=lj('','popup_sav,batch____n',picto('add')).' ';
$ret.=lj('',$idt.'_sav,batch___x_1',picto('del')).' ';
$ret.=lj('','popup_rssin,home___rssurl_',picto('rss')).' ';
$ret.=lj('',$idt.'_sav,batchfbi__3',picto('update')).' ';
$ret.=lj('','page_desk,deskbkg',picto('desktop')).' ';
$ret.=msqbt('',ses('qb').'_rssurl').' ';
$r=ses('vac'); //if($r)$r=array_reverse($r);
if($r)$ret.=lj('popsav',$idt.'_sav,batchsav__arts',picto('save')); $i=0;
if($r)foreach($r as $k=>$v){$i++;//
	//if(!$v['b'] && $u!='http://loading...'){[$t,$msg]=conv::vacuum($u,'');
	//vacses($f,'t',$t); vacses($f,'v',$msg);}
	if(!isset($v['t']))$suj='no_title'; else $suj=$v['t'];
	$u=$v['u']??''; $kb=ajx($u); $cat=$v['c']??'';
	$rid=randid('bth');
	$btb=lj('','popup_sav,batchpreview___'.$kb,picto('view')).' ';
	$btb.=self::slct_cat($rid,$cat,$i).' ';
	//$btb.=select_j($rid,'category',$cat,3,$cat?$cat:picto('filelist'));
	$btb.=self::saveiec($kb,$cat,$rid).' ';
	$btb.=lj('','popup_search,home__3_'.ajx($suj).'_',picto('search'));
	if($u)$btb.=lkt('small',$u,pictxt('url',domain($u)),att(preplink($u).' '.$suj));
	$btb.=lj('',$idt.'_sav,batch___'.$kb.'_x',picto('del')).br();
	$ret.=divc('small',$btb.$suj);}
if($d!='in')$ret=div(atd($idt).ats('padding:2px; min-width:320px;'),$ret);
return scroll($i,$ret,10);}

static function slct_cat($id,$t,$n){//dropmenu_jb//catslct
$bt=hidden($id,$t); if(!$t)$t=picto('filelist'); $opt='adcat';//innerhtml
//return $bt.ljp(atd('adcat'.$id),'popup_sav,catslct___'.$id.'_'.$id.'_'.$opt.'_'.$n,$t);
return $bt.togbub('sav,catslct',$id.'_'.$id.'_'.$opt.'_'.$n,btd($opt.$id,$t));}

static function catslct($btid,$hid,$opt,$n){$frm=ses('frm');
$r=sql('frm','qda','k','nod="'.ses('qb').'" and frm not in ("_system","_trash") and day>"'.timeago(360).'" order by frm');
if(auth(3))$r['_system']=1; if(!isset($r[$frm]))$r[$frm]=1; $r['public']=1;
return usg::dropmenu_jb($r,$hid,$btid,'adcat',$n);}

static function batchprep($v){$http=strto($v,'/'); 
$rss=rssin::load(http($v)); $vac=$_SESSION['vac'];
foreach($rss as $k=>$v){[$suj,$f,$dat,$id]=$v; $f=(string)$f;
if($id)break; elseif($f && !vacses($f,'u')){$fb=vacurl($f);
$_SESSION['vac'][$fb]=['t'=>$suj,'d'=>$dat,'u'=>$f];}}}

static function batchfbi(){$ret=hlpbt('rssurl_1').br();
$r=msql::read('',nod('rssurl'),'',1); $r=msql::tri($r,3,1);
if($r)foreach($r as $k=>$v)self::batchprep($v[0]);
return self::batch('','in');}

static function artpreview($f){$fb=http($f); ses::$urlsrc=$fb;
[$t,$d]=conv::vacuum($fb); vacses($fb,'t',$t); $d=str::clean_html($d,1); $d=str::embed_links($d);
$d=str::clean_br_lite($d); $d=str::clean_punct($d); $d=conn::read($d,'','test');
return tagb('section',tagb('h1',$t).tagc('article','justy',$d));}

static function batchpreview($f,$sug='',$prm=[]){$f=$prm[0]??$f; $d=''; $t='';
$f=trim($f); $fb=http($f); ses::$urlsrc=$fb; $ret=''; //if(!auth(4))return;
if($f){[$t,$d]=conv::vacuum($fb); vacses($fb,'t',$t);} if(!$d)$d='nothing';
if($sug){$r=msql::read('',nod('suggest'),$sug); [$day,$ok,$url,$mail,$t,$d,$iq]=$r;}
$d=str::clean_html($d,1); $d=str::embed_links($d); $d=str::clean_br_lite($d); $d=str::clean_punct($d);
$d=conn::read($d,'','test');$ti=tagb('h2',$t);
ses::$r['sugm']=$sug; $rid=randid('btch');
if(auth(6)){$ti.=lj('','popup_sav,batchpreview__x_'.ajx($f).'_',pictit('reload',nms(101))).' ';
	$ti.=lj('','popup_edit,artform__x_'.ajx($f),picto('edit')).' ';
	$ti.=self::urledt($f).' ';
	$ti.=lkt('',$fb,picto('url')).' ';
	$ti.=lj('','socket_sav,batch___'.ajx($f).'_x',picto('del')).' ';
	$ti.=self::newartcat($fb);}
$sty=atc('justy'); if(mb_strlen($d)>400)$sty.=atd('scroll');
$ret.=tagb('section',tagb('header',$ti).tag('article',$sty,$d));
return $ret;}

#savart
static function addurlsav($f,$va,$pub,$ib){if(!$f)return;//SaveIec
ses::$urlsrc=$f; self::$r['name']=$_SESSION['USE']; $_SESSION['frm']=$va;
if(substr($f,0,4)!='http' && $f)$f='http://'.$f;
//[$defid,$r]=conv::verif_defcon($f); if($f)$auv=video::detect($f); //if(rstr(10))
self::$r['ib']=$ib; self::$r['pub']=$pub; $nid=self::save_art(); $ret=$nid;
if(!$nid)$ret=popup(edit::artform($f,self::$er),'Article'); else geta('read',$nid);
if(rstr(147))codeline::png2jpg($nid);
return $ret;}

static function createart($id,$o,$prm){
[$d,$suj,$frm,$urlsrc,$date,$name,$mail,$ib,$pub]=arr($prm,9);//,$sub
if(strpos($d,'</'))$d=conv::call($d);
self::$r['msg']=$d; self::$r['suj']=$suj; $_SESSION['frm']=$frm; 
ses::$urlsrc=$urlsrc; self::$r['pdat']=$date; self::$r['mail']=$mail; 
self::$r['name']=$name; self::$r['ib']=$ib; self::$r['pub']=$pub; //self::$r['sub']=$sub;
return self::save_art();}

//urlsrc
static function webread($f){//SaveI()
$f=trim($f); $f=utmsrc($f); $f=http($f); ses::$urlsrc=$f;
[$t,$d]=conv::vacuum($f,''); $ud=self::urledt($f);//$d=str::embed_links($d);//double-emploi=crash
return [$t,$d,$ud];}

static function websav($id,$f){
[$t,$d]=self::webread($f);
$sq=['suj'=>$t,'mail'=>$f,'img'=>'','thm'=>str::hardurl($t)];//if(rstr(38))
sqlup('qda',$sq,$id);
self::modif_art($id,$d); cachevs($id,2,$t);
if(rstr(147))codeline::png2jpg($id);
vacses($f,'t','x');
return $d;}

static function art_mirror($id,$prw){
$u=srvmir().'/apicom/id:'.$id.',json:1,conn:1'; $d=read_file($u);
$r=json_decode($d,true); $r=$r[$id]??[]; $r=utf_r($r,1);
if($r){$t=$r['title']; $d=$r['content'];
$sq=['suj'=>$t,'mail'=>$r['url'],'img'=>$r['image']??'','thm'=>str::hardurl($t),'ib'=>$r['parent'],'re'=>$r['priority']];
sqlup('qda',$sq,$id); self::modif_art($id,$d);}
return art::playd($id,$prw,'');}

static function reimport($id,$prw=1,$prm=[]){
$u=sql('mail','qda','v',$id); $u=$prm[0]??$u;
if(auth(4))$ret=self::websav($id,$u);
return art::playd($id,$prw,'');}

static function bckpart($id){
$d=sql('msg','qdm','v',$id);
msql::modif('',nod('backup_'.$id),[mkday(),$d],'push');}

static function recapart($id,$prw=1){
$url=sql('mail','qda','v',$id);
if($url)self::bckpart($id);
if($url && auth(4))self::websav($id,$url);
return art::playd($id,$prw,'');}

static function urledt($u){$f=domain($u);
$b=rstr(18)?'public':ses('qb'); if(!auth(4))return;
[$id]=conv::verif_defcon($f);
if($id)$j=$id.'_'; else $j='add_';
$ret=lj('','popup_msqa,editmsql___users/'.$b.'*defcons_'.$j.ajx($f),picto('config')).' ';
$ret.=lj('','popup_few,seesrc___'.ajx($u),pictit('file-html','code')).' ';
$ret.=lj('','popup_few,insrc__x_'.ajx($u),pictit('window','src')).' ';
//$ret.=lj('','socket_sav,batch___'.ajx($link).'_x',picto('del')).' ';
return $ret;}

#edit
//upload
static function uplim($g1,$g2,$prm=[]){
$u=$prm[0]??$g1; //$u=utf8dec_b($u);//do htent_b
$im=conn::get_image($u,ses('read'));
if($im)return '['.$im.']';}

static function recenseim($id,$imx=''){
$msg=sql('msg','qdm','v',$id); $r=[]; $rb=[]; $re=[]; $ret='';
$ims=codeline::parse($msg,$id,'extractimg'); //echo $ims.'--';
if($ims){$ra=explode('/',$ims); foreach($ra as $k=>$v)$re[$v]=$v;}
if(!$imx)$imx=sql('img','qda','v',$id); if($imx)$r=explode('/',$imx);
if($r)foreach($r as $k=>$v)$rb[$v]=$v;//im in msg
if($rb)foreach($rb as $k=>$v)if($v && !is_numeric($v)){$w=1;//del bad img
	if(!is_file('img/'.$v))unset($rb[$k]);
	else [$w]=getimagesize('img/'.$v); if(!$w)unset($rb[$k]);}// or !isset($re[$v])
if($re)foreach($re as $k=>$v)if($v){//add forgotten img
	if(!isset($rb[$v]) && is_file('img/'.$v))$rb[$v]=$v;}
if($rb)$ret=implode('/',$rb); //sql::upd('qda',['img'=>$ret],$id);
return '/'.$ret;}

static function orderim($id){
$ims=sql('img','qda','v',$id); $r=explode('/',$ims); 
if($r)foreach($r as $v)if(is_file('img/'.$v)){[$w,$h]=getimagesize('img/'.$v); $rb[$w]=$v;}
if(isset($rb)){krsort($rb); return '/'.implode('/',$rb);}}

static function placeimdel($id,$x){
$ims=sql('img','qda','v',$id); $r=explode('/',$ims);
if(auth(5) && $x){img::rm($id,$x); 
	if(is_file('img/'.$x))unlink('img/'.$x); if(is_file('imgc/'.$x))unlink('imgc/'.$x);
	if($k=in_array_b($x,$r))unset($r[$k]); 
	$ims=implode('/',$r); if(is_numeric($ims))$ims='';
	sql::upd('qda',['img'=>$ims],$id); conn::replaceinmsg($id,'['.$x.']','');
	$rb[0]=self::placeim($id); $rb[1]=$ims; return $rb;}}

static function placeim($id){$ret='';
$ims=sql('img','qda','v',$id); $r=explode('/',$ims);
if($r)foreach($r as $k=>$v)if(is_img($v)){
	$im=make_mini('img/'.$v,'imgc/'.$v,'','',$_SESSION['rstr'][16]);
	$ret.=ljb('','insert','['.$v.']',image($im,'72',att($v)));
	if(auth(6))$ret.=lj('popdel','pim'.$id.',img'.$id.'_sav,placeimdel__json_'.$id.'_'.ajx($v),'x');}
return scroll($r,$ret,12,320,320);}

static function placeimtrk($f,$id){$ret=''; $fb=img::thumbname($f,72,72);
$im=make_mini('img/'.$f,$fb,'','',1);
$ret=ljb('','insert_b',['['.$f.']',$id],image('/'.$im,'72','72',att($f)));
//if(auth(6))$ret.=lj('popdel','pim'.$id.',img'.$id.'_sav,placeimdel__json_'.$id.'_'.ajx($f),'x');
return $ret;}

static function art_gallery($id){$ret='';
$d=sql('img','qda','v',$id); $r=explode('/',$d);
if($r)foreach($r as $v)if($v)$ret.=mk::popim($v,img::make_thumb($v,$id),$id);
return $ret;}

static function art_retape($ret,$id){
$r=msql::ses('oldconn','system','connectors_old',1); if($r)$rk=array_keys($r);
$ret=delbr($ret,"\n"); $ret=str::clean_br($ret); return str_replace($rk,$r,$ret);}

static function rectifart($id,$prw=3){
$d=sql('msg','qdm','v',$id);
$d=str_replace("&#13;",'',$d??'');
$d=delnl($d); //$d=str::clean_lines($d); //$d=trim($d); //delsp($d)
$d=self::modif_art($id,$d);
return ma::read_msg($id,$prw);}

}
?>