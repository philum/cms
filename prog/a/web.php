<?php //a/web

class web{

static function pao($r,$u){
//$im=mk::thumb_d($r[2],'90/90');
$tit=$r[0]; $txt=$r[1]; $img=$r[2]; $im='';
if(!empty($r[2]))$im=divs('float:left; margin-right:10px',image(goodroot($img),90));
//if(strpos($txt,'[')!==false){$txt=kmax($txt); $txt=conn::read($txt,3,'');}
$ret=$im.lka($u,$tit).divc('',$txt).divc('small grey',lkt('',$u,pictxt('url',preplink($u))));
return balb('blockquote',$ret.divc('clear',''));}

static function imgyt($u){return 'https://img.youtube.com/vi/'.segment($u,'=','&').'/hqdefault.jpg';}

static function metas2($f,$d,$dom){$ti=''; $tx='';
[$defid,$defs]=conv::verif_defcon($f);//defcons
if(!empty($defs[2])){
	//if(strpos($defs[2],':')!==false)$ti=dom::detect($d,$defs[2]);
	if(strpos($defs[2],':')!==false)$ti=dom::extract($dom,$defs[2]);
	elseif(empty($defs[3]))$ti=conv::html_detect($d,$defs[2]);
	else $ti=embed_detect($d,$defs[2],$defs[3]);
	$ti=del_n($ti); $ti=strip_tags(trim($ti??''));}
if(!empty($defs[0])){
	//if(strpos($defs[0],':')!==false)$tx=dom_detect($d,$defs[0]);
	if(strpos($defs[2],':')!==false)$rec=dom::extract($dom,$defs[0]);
	elseif(empty($defs[1]))$tx=conv::html_detect($d,$defs[0]);
	else $tx=embed_detect($d,$defs[0],$defs[1]); $tx=strip_tags($tx??'');}
return [$ti,$tx];}

static function metas($u,$d=''){
if(!$d)$d=vaccum_ses(http($u),''); //$d=utf82ascii($d);//eco($d);
if(!$d)return ['','','']; $dom=dom($d); $ti=''; $tx='';
[$ti,$tx]=self::metas2($u,$d,$dom);
if(!$ti)$ti=dom::extract($dom,'title:property:meta');
if(!$ti)$ti=dom::extract($dom,'name:itemprop:meta');
if(!$ti)$ti=dom::extract($dom,'og(ddot)title:property:meta');
if(!$ti)$ti=dom::extract($dom,'::title');
if(!$ti)$ti=dom::extract($dom,'::h1');
if(!$tx)$tx=dom::extract($dom,'description:name:meta'); //$x=''; if($tx)$x.=1;
if(!$tx)$tx=dom::extract($dom,'og(ddot)description:property:meta');
if(!$tx)$tx=dom::extract($dom,'description:itemprop:meta');
$im=dom::extract($dom,'image:name:meta');
if(!$im)$im=dom::extract($dom,'og(ddot)image:property:meta');
if(!$im)$im=dom::extract($dom,'og(ddot)image:itemprop:meta');
if(!$im)$im=dom::extract($dom,'thumbnailUrl:itemprop:link:href');
if(strpos($u,'youtube')!==false)$im=self::imgyt($u);
///$ti=html_entity_decode($ti); $tx=html_entity_decode($tx); eco($ti);
///$ti=utf8_decode_a($ti); $tx=utf8_decode_a($tx); //eco($ti);//do it
$ti=html_entity_decode_b($ti); $tx=html_entity_decode_b($tx); //eco($ti);
if(is_utf($ti) or is_utf($tx)){$ti=utf8_decode($ti); $tx=utf8_decode_b($tx);}//eco($ti);
$tx=clean_br($tx); //$ti=ascii2utf8($ti); $tx=ascii2utf8($tx);
return [$ti,etc($tx),$im];}

static function read($u,$o='',$id=0){$k=nohttp(utmsrc($u));
$r=sql('tit,txt,img,ib,id','qdw','w','url="'.$k.'" limit 1',0); //$o=1;
if(!$r or $o==1){$ra=$r; //pr($r);// or !$r[0]
	[$ti,$tx,$im]=self::metas($k);//p($r);
	if(!$ti && $r[0]??'')$ti=$r[0];
	if(!$im && strpos($u,'youtube')!==false)$im=self::imgyt($u);
	if(!$ti && rstr(133) && substr($u,0,7)=='youtube')$r=self::kit($k,$id);//p($r);
	if($ti)$ti=strip_tags($ti); if($tx)$tx=strip_tags($tx); //setutf8();
	//json::add('','web'.mkday(),[$ti,$tx,$im,$id,mkday('','Ymd:His')]);
	if($ra && $ti)sqlup('qdw',db::vrfr(['tit'=>$ti,'txt'=>$tx,'img'=>$im],'web'),'url',$k.'',0);
	elseif(!$ra)sqlsav('qdw',db::vrfr(['ib'=>$id,'url'=>$k,'tit'=>$ti,'txt'=>$tx,'img'=>$im],'web'),0);
	if($ti)$r=[$ti,$tx,$im,$id];}
if(!$r)$r=['','','',$id]; setlatin();
return $r;}

static function kit($f,$id){
$http='http://newsnet.ovh'; if(host()==$http)return;
if(substr($u,0,7)=='youtube')$u=strend($f,'=');
$u='http://newsnet.ovh/call/yt,build/'.str_replace('/','|',$u);
//$u=$http.'/call/yt,build/'.$f.'/'.$id;
$u='http://logic.ovh/api/web/p1:'.segment($f,'=','&');
if(auth(6))echo $u.' ';
$d=file_get_contents($u);
$r=json_decode($d,true);
$r[0]=$r[0]??'';
$r[1]=$r[1]??'';
$r[2]=$r[2]??'';
return utf_r($r,1);}

static function resav($u,$o,$r){$k=nohttp(utmsrc($u));
if($o)$r=self::read($u,$o);
if($u){[$ti,$tx,$im,$ib]=arr($r,4);
	//if($ti)$ti=utf8_decode_b($ti); if($tx)$tx=utf8_decode_b($tx);
	$ex=sql('id','qdw','v',['url'=>$k],0); setutf8();
	$rs=db::vrfr(['ib'=>$ib,'tit'=>$ti,'txt'=>$tx,'img'=>$im],'web');
	if($ex)sqlup('qdw',$rs,'url',$k,0);
	else sqlsav('qdw',$rs,0);}
if(strpos($u,'youtube.com')!==false)return video::any(http($u),$ib,3);
setlatin();
return self::com($u);}

static function redit($u,$rid,$id){$r=self::read($u,'',$id);
$ret=lj('popbt',$rid.'_web,com___'.ajx($u).'__'.$id,picto('back'));
$ret.=lj('popbt',$rid.'_web,resav___'.ajx($u).'_1',picto('refresh'));
$ret.=lj('popsav',$rid.'_web,resav_edtit,edtxt,edtim,edtid__'.ajx($u),pictxt('save',nms(57))).br();
$ret.=goodarea('edtit',$r[0]).'tit'.br();
$ret.=goodarea('edtxt',$r[1]).'txt'.br();
$ret.=input('edtim',$r[2]).'img'.br();
$ret.=input('edtid',$r[3]?$r[3]:($id?$id:0)).'ib';
return $ret;}

static function del($u,$d){$k=nohttp(utmsrc($u)); //echo $k;
$ex=sql('id','qdw','v','url="'.$k.'"'); if($ex)sqldel('qdw',$ex);
return 'deleted';}

static function wmenu($p,$rid,$id){
$bt=lj('txtx small','popup_sav,artpreview__3_'.ajx($p),pictxt('view',nms(45))).' ';
if(auth(4))$bt.=lj('',$rid.'_web,resav___'.ajx($p).'_1_'.$id,picto('reload')).' ';
if(auth(4))$bt.=lj('',$rid.'_web,redit___'.ajx($p).'_'.$rid.'_'.$id,picto('editxt')).' ';
if(auth(6))$bt.=lj('',$rid.'_web,del___'.ajx($p).'_'.$rid,picto('del')).' ';
return $bt;}

static function com($u,$o='',$id=''){
if(strpos($u,'pbs.twimg')!==false)return;
$r=self::read($u,$o,$id);
$ret=self::pao($r,$u);
if($r)return $ret;}

static function call($p,$o='',$id=''){$rid=randid('wb');
if(substr($p,0,4)!='http')$p=http($p);
if(!is_url($p))return 'nothing';
$ret=self::com($p,$o,$id);
$bt=self::wmenu($p,$rid,$id);
return div('',div(atd($rid).ats('min-width:320px;'),$ret).$bt);}

static function j($p,$o,$prm=[]){$p=$prm[0]??$p;
return self::call($p,$o);}

static function stream($d,$n=''){
if(!$n)$n=100; $ret=''; $w=''; $rid=randid('wb');
if(is_numeric($d))$w='where id<"'.$d.'" '; elseif($d)$w='where url like "%'.$d.'%"';
$r=sqb('id,url,tit,txt,img','qdw','',$w.'order by id desc limit '.$n);
if($r)foreach($r as $k=>$v){$wid=randid('wb'); [$id,$u,$ti,$tx,$im]=$v; $u=http($u);
	$ret.=divd($wid,self::pao([$ti,$tx,$im],$u).self::wmenu($u,$wid,$d));}
if($ret)$ret.=lj('',$rid.'_web,stream__3_'.$id.'_'.$n,divc('txtcadr',picto('down')));
return $ret.divd($rid,'');}

static function erasex($p,$o,$prm=[]){
$p=$prm[0]??'plug'; //$p='twimg';
$nbd=360; $ret='';//twid,media,quote_id
$r=sqb('id,url','qdw','kv','where (url like "%'.$p.'%" or txt like "%'.$p.'%" or tit like "%'.$p.'%")');
if($r)foreach($r as $k=>$v)//$ret.=self::call($v);
sqldel('qdw',$k);
echo count($r);
return $ret;}

static function menu($p,$o,$rid){$j=$rid.'_web,j_inp_3';
$ret=inputj('inp',$p,$j).lj('',$j,picto('ok')).' ';
if(auth(6))$ret.=lj('',$rid.'_web,stream__3',picto('web2'),att('all')).' ';
if(auth(6))$ret.=lj('',$rid.'_web,erasex_inp_3',picto('rain'),att('erase things')).' ';
return $ret;}

static function install(){
mysql::install('web',['ib'=>'int','url'=>'var','tit'=>'var','txt'=>'var','img'=>'var'],0);}

static function home($p,$o){$rid=randid('wb');
//if($p=='install')self::install();
$bt=self::menu($p,$o,$rid);
if($p)$ret=self::com($p,$o); else $ret='';
//$bt.=msqbt('',nod('web_1'));
return $bt.divd($rid,$ret);}
}

?>