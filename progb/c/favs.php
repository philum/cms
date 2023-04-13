<?php 
class favs{
//render
static function icons($r){
return desk::pane_icons($r,'icones').divc('clear','');}

static function cols($r){$ret='';
if($r)foreach($r as $id=>$v)$ret.=self::art($id);
return div(atc('cols').ats('width:640px;'),$ret);}

static function reload($r){
foreach($r as $k=>$v)if($v[0]==ses('iq'))$rb[$k]=$v;
return self::nav('',$rb);}

//likes
static function cart($cat){
return sql('ib','qdf','k','type="'.$cat.'" and iq="'.ses('iq').'" order by id desc');}

static function mklist($p){
if($p=='poll')$r=self::cart('poll');
elseif($p=='like')$r=self::cart('like');
elseif($p=='visit')$r=ses('mem');
else $r=self::cart('fav');
if($r)return textarea('','id:'.implode('|',array_keys($r)),40,4);}

//com (api)
static function sav($p,$o,$ra){
$rb=array(ses('iq'),$ra[0],$ra[1],$ra[2]);
$r=msql::modif('',nod('coms'),$rb,'push',['iq','name','value']);
return self::reload($r);}

static function del($d,$o){
$r=msql::modif('',nod('coms'),$d,'del');
return self::reload($r);}

static function mdf($k,$o,$prm){[$ti,$tx,$tp]=arr($prm,3);
$r=msql::modif('',nod('coms'),[ses('iq'),$ti,$tx,$tp],$k);
return self::reload($r);}

static function form($p,$o,$b){
$ret=inputb('comn',$o,'',nms(38)).hlpbt('fav_edit').' ';
$ret.=lj('','popup_api_comv',picto('view')).' ';
$ret.=lj('','popup_apicom,menu__loadself_'.ajx($p),picto('menu')).' ';
$ret.=checkbox_j('comp',$b,'public').br();
$ret.=textarea('comv',$p,44,4,['placeholder'=>'Api Command','size'=>'44']);
return $ret;}

static function edt($k){
$r=msql::read_b('',nod('coms'),$k);
$ret=self::form($r[2],$r[1],$r[3]);
$ret.=lj('popsav','plgfavcom_favs,mdf_comn,comv,comp__'.$k,pictxt('save',nms(27)));
return $ret;}

static function add($p){$ret=self::form($p,'','');
$ret.=lj('popsav','plgfavcom_favs,sav_comn,comv,comp',pictxt('save',nms(27)));
return divd('fvcmdt',$ret);}

static function pub($p){
$ra=msql::read_b('',nod('coms'),$p);
$r=msql::modif('',nod('coms'),[ses('iq'),$ra[1],$ra[2],yesno($ra[3])],$p);
return self::reload($r);}

static function bt($v){$a=ajx($v[2]); $t=ajx($v[1]);
$bt=lj('','popup_api__3_'.$a.',nbyp:20,preview:2,t:'.$t,btn('',pictxt('newspaper',$v[1],32))).' ';
$bt.=lj('','pagup_book,home__3_'.$a.',idlist:1,nodig:1,nopages:1,t:'.$v[1].'_api',pictit('book','Web-Book',24)).' ';
$bt.=lj('','popup_api__3_'.$a.',preview:3,nodig:1,nopages:1,file:'.$t,pictit('file-txt','Html',24)).' ';
//$bt.=lj('','popup_api__3_'.$a.',nodig:1,nopages:1,json:1',pictit('emission','Json',24)).' ';
$bt.=lkt('','/apicom/'.$v[2].',nodig:1,nopages:1,json:1',pictit('emission','Api',24)).' ';
$bt.=lj('','popup_mkbook,call__3_'.$a.',preview:3,nodig:1,nopages:1,msg:1,ti:'.$t.'_api',pictit('book2','Ebook',24)).' ';
$bt.=lkt('','/api/'.$v[2].',t:'.$t,picto('url')).' ';
return $bt;}

static function nav($p,$r=''){//$ret=self::add($p).br();
$ret=lj('popsav','popup_favs,add',pictxt('add',nms(92)));
if(!$r)$r=msql::select('',nod('coms'),ses('iq')); if($r)$r=array_reverse($r,true);
if($r)foreach($r as $k=>$v)if($v){
	$bt=self::bt($v).br();
	$bt.=lj('popbt','popup_favs,edt___'.$k,pictxt('edit',nms(107))).' ';
	$bt.=lj('popbt','plgfavcom_favs,pub___'.$k,offon($v[3],nms(106))).' ';
	$bt.=lj('popdel','plgfavcom_favs,del___'.$k,pictit('del',nms(43))).' ';
	$ret.=divc('track',$bt);}
if(auth(6))$bt=msqbt('',nod('coms')); else $bt='';
return divd('plgfavcom',$ret);}

static function shar($p){
$r=msql::read('',nod('coms'),'',1); $r=array_reverse($r,true);
$rb=array_keys_r($r,0,1); $rn=[]; $ret='';
foreach($rb as $k=>$v){$ip=sql('ip','qdp','v',$k);
	$rn[$k]=sql('name','qdu','v','ip="'.$ip.'"');}
foreach($r as $k=>$v)if(!empty($v[3]) && !empty($v[2])){$bt='';
	if($rn[$v[0]])$bt.=btn('txtx',$rn[$v[0]]).' ';
	$bt.=self::bt($v);
	$ret.=divc('track',$bt);}
if(!$r)$ret=divc('txtit',nms(11).' '.nms(1));
if(auth(6))$bt=msqbt('',nod('coms')); else $bt='';
return $bt.$ret;}

//utags
static function catagarts($cat){//return tag,idart
$ra=sql('id,tag','qdt','kv','cat="'.$cat.'"');
if($ra){$rk=array_keys($ra); $wh=implode(',',$rk); $rt=[];
$rb=sql('idtag,idart','qdta','kr','idtag IN ('.$wh.')');
if($rb)foreach($rb as $k=>$v)$rt[$ra[$k]]=$v;
return $rt;}}

static function tags(){$ret=[];
$r=self::catagarts(ses('iq'));//tag,idarts
if($r)foreach($r as $tag=>$v)foreach($v as $id)$rtg[$id][$tag]=1;
//if($r)foreach($r as $tag=>$v)foreach($v as $id)$ret[$tag].=self::art($id,$rtg[$id]);
//if($ret)foreach($ret as $k=>$v)$ret[$k]=divc('cols',$v);
if($r)foreach($r as $tag=>$v)$ret[$tag]=br().self::icons(array_flip($v));
return tabs($ret);}

static function mktag($r){if(!$r)return; $ret='';
foreach($r as $k=>$v)$ret.=$k;//lj('','popup_api___'.ses('iq').';'.ajx($k),$k).' ';
if($ret)return btn('nbp',picto('bookmark',16).' '.$ret);}

//read
static function art($id,$rtg=''){
$im=minimg(sql('img','qda','v',$id),'h');
$day=sql('day','qda','v',$id); $dat=mkday($day).' ';
if($rtg)$tag=self::mktag($rtg).' ';
$suj=tagb('h4',ma::suj_of_id($id).' ');
if($id)return divc('txtcadr',$im.$dat.$tag.lj('','popup_popart__3_'.$id.'_3',$suj));}

//menus
static function log(){
$iqb=ses('iq');//base64_encode
$ret=input('favid',$iqb,'4');
$ret.=lj('popbt','plgfv_fav,home_favid',picto('ok'));
$ret.=hlpbt('flog').' '.msqbt('',nod('coms'));
if(auth(1))$ret.=lj('popbt','popup_login,form____'.$iqb,pictxt('logout',nms(54)));
return divc('',$ret);}

static function menu($p){$j='plgfavs_favs,build___'; $ret='';
//$ret=lj('txtx','popup_art,home__x___640',picto('refresh')).' ';
if(rstr(52))$ret=lj(active($p,'fav'),$j.'fav',pictxt('bookmark',nms(108))).' ';//favs
if(rstr(90))$ret.=lj(active($p,'like'),$j.'like',pictxt('love','likes')).' ';
if(rstr(91))$ret.=lj(active($p,'poll'),$j.'poll',pictxt('like',nms(144))).' ';//polls
if(rstr(42))$ret.=lj(active($p,'tags'),$j.'tags',pictxt('diez','tags')).' ';
if(ses('mem'))$ret.=lj(active($p,'visit'),$j.'visit',pictxt('articles',nms(33))).' ';
if(rstr(52))$ret.=lj(active($p,'com'),$j.'com',pictxt('work','com')).' ';
$ret.=lj(active($p,'shar'),$j.'shar',pictxt('people',nms(74))).' ';
$ret.=lj('','popup_favs,log',picto('logout')).' ';
//if(rstr(90))$ret.=lj('txtx',$j.'like_no',pictxt('trash','Olds')).' ';
if($p=='fav' or $p=='like' or $p=='poll' or $p=='visit'){
	$ret.=lj('txtx','pagup_book,home__3_'.ses('iq').'_'.$p,pictxt('book','Web-Book')).' ';
	$ret.=lj('txtx','popup_favs,mklist__3_'.$p,pictxt('emission','Api'));
	$ret.=lj('txtx','popup_mkbook,call___'.$p.'_favs_',pictxt('book2','Ebook'));}
return divc('txtit',helps('fav_'.$p)).divc('nbp',$ret);}

static function flog($res){//echo genpswd();
if(is_numeric($res))$iq=sql('id','qdp','v','id="'.$res.'" LIMIT 1');
else $iq=sql('id','qdp','v','id="'.($res).'" LIMIT 1');//base64_decode
if(!$iq)$iq=sql('id','qdp','v','ip="'.ses('ip').'" LIMIT 1');
if($iq){$_SESSION['iq']=$iq; cookie('iq',$iq);}}

static function build($p,$o){
if(!$p)$p='fav';
$menu=self::menu($p); $ret='';
if($p=='tags')$ret=self::tags();
elseif($p=='poll')$r=self::cart('poll');
elseif($p=='like')$r=self::cart('like');
elseif($p=='visit')$r=ses('mem');
elseif($p=='com')$ret=self::nav($o);
elseif($p=='shar')$ret=self::shar($o);
else $r=self::cart('fav');
if(isset($r))$ret=self::icons($r);
//if($r)$ret=self::cols($r);
return $menu.divc('',$ret);}

static function home($p,$o,$prm=[]){$res=$prm[0]??'';
if($res)self::flog($res);
//$bt=self::log();
$ret=self::build($p,$o);
return divd('plgfv',divd('plgfavs',$ret));}

}
?>