<?php
//philum/b/favs

class favs{

//render
static function render_icons($r){req('spe');
return desktop_build_ico($r,'icones').divc('clear','');}

static function render_cols($r){req('spe');
if($r)foreach($r as $id=>$v)$ret.=self::art($id);
return div(atc('cols').ats('width:640px;'),$ret);}

static function com_reload($r){
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
static function com_sav($p,$o,$res=''){$ra=ajxr($res);
$rb=array(ses('iq'),$ra[0],$ra[1],$ra[2]);
$r=msql::modif('',nod('coms'),$rb,'push',['iq','name','value']);
return self::com_reload($r);}

static function com_del($d,$o,$res=''){
$r=msql::modif('',nod('coms'),$d,'del');
return self::com_reload($r);}

static function com_mdf($k,$o,$res=''){$ra=ajxr($res);
$r=msql::modif('',nod('coms'),[ses('iq'),$ra[0],$ra[1],$ra[2]],$k);
return self::com_reload($r);}

static function com_form($p,$o,$b){
$ret=input('comn',$o,atb('placeholder',nms(38))).hlpbt('fav_edit').' ';
$ret.=lj('','popup_plup__3_api_api*j___comv',picto('view')).' ';
$ret.=lj('','popup_plup___apicom_apicom*menu_'.ajx($p).'_loadself__injectjs',picto('menu')).' ';
$ret.=checkbox_j('comp',$b,'public').br();
$ret.=textarea('comv',$p,44,4,atb('placeholder','Api Command').atz('44'));
return $ret;}

static function com_edt($k){
$r=msql::read_b('',nod('coms'),$k);
$ret=self::com_form($r[2],$r[1],$r[3]);
$ret.=lj('popsav','plgfavcom_app___favs_com*mdf_'.$k.'__comn|comv|comp',pictxt('save',nms(57)));
return $ret;}

static function com_add($p){$ret=self::com_form($p,'','');
$ret.=lj('popsav','plgfavcom_app___favs_com*sav___comn|comv|comp',pictxt('save',nms(57)));
return divd('fvcmdt',$ret);}

static function com_pub($p){
$ra=msql::read_b('',nod('coms'),$p);
$r=msql::modif('',nod('coms'),[ses('iq'),$ra[1],$ra[2],yesno($ra[3])],$p);
return self::com_reload($r);}

static function bt($v){$a=ajx($v[2]); $t=ajx($v[1]);
$bt=lj('','popup_api__3_'.$a.',nbyp:20,preview:2,t:'.$t,btn('',pictxt('newspaper',$v[1],32))).' ';
$bt.=lj('','pagup_plup__3_book__'.$a.',idlist:1,nodig:1,nopages:1,t:'.$v[1].'_api',pictit('tv','Web-Book',24)).' ';
$bt.=lj('','popup_api__3_'.$a.',preview:3,nodig:1,nopages:1,file:'.$t,pictit('file-txt','Html',24)).' ';
//$bt.=lj('','popup_api__3_'.$a.',nodig:1,nopages:1,json:1',pictit('emission','Json',24)).' ';
$bt.=lkt('','/apicom/'.$v[2].',nodig:1,nopages:1,json:1',pictit('emission','Api',24)).' ';
$bt.=lj('','popup_mkbook,call__3_'.$a.',preview:3,nodig:1,nopages:1,msg:1,ti:'.$t.'_api',pictit('book2','Ebook',24)).' ';
$bt.=lkt('','/api/'.$v[2].',t:'.$t,picto('url')).' ';
//if(auth(6))$sql=lj('','popup_plupin___api_'.ajx($v[2].',sql:1'),pictxt('server','MySql')).' ';
return $bt;}

static function nav($p,$r=''){//$ret=self::com_add($p).br();
$ret=lj('popsav','popup_app___favs_com*add',pictxt('add',nms(92)));
if(!$r)$r=msql::select('',nod('coms'),ses('iq')); if($r)$r=array_reverse($r,true);
if($r)foreach($r as $k=>$v)if($v){
	$bt=self::bt($v).br();
	$bt.=lj('popbt','popup_app___favs_com*edt_'.$k,pictxt('edit',nms(107))).' ';
	$bt.=lj('popbt','plgfavcom_app___favs_com*pub_'.$k,offon($v[3],nms(106))).' ';
	$bt.=lj('popdel','plgfavcom_app___favs_com*del_'.$k,pictit('del',nms(43))).' ';
	$ret.=divc('track',$bt);}
if(auth(6))$bt=msqbt('',nod('coms')); else $bt='';
return divd('plgfavcom',$ret);}

static function shar($p){
$r=msql::read('',nod('coms'),'',1); $r=array_reverse($r,true);
$rb=array_keys_r($r,0,1); $rn=[]; $ret='';
foreach($rb as $k=>$v){$ip=sql('ip','qdp','v','id='.$k);
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
if($ra){$wh=implode(',',array_keys($ra));
$rb=sql('idtag,idart','qdta','kr','idtag IN ('.$wh.')');
return array_combine($ra,$rb);}}

static function tags(){req('spe'); $ret=[];
$r=self::catagarts(ses('iq'));//tag,idarts
if($r)foreach($r as $tag=>$v)foreach($v as $id)$rtg[$id][$tag]=1;
//if($r)foreach($r as $tag=>$v)foreach($v as $id)$ret[$tag].=self::art($id,$rtg[$id]);
//if($ret)foreach($ret as $k=>$v)$ret[$k]=divc('cols',$v);
if($r)foreach($r as $tag=>$v)$ret[$tag]=br().self::render_icons(array_flip($v));
return make_tabs($ret);}

static function tag_maker($r){if(!$r)return; //p($r);
foreach($r as $k=>$v)$rt.=$k;//lj('','popup_api___'.ses('iq').';'.ajx($k),$k).' ';
if($rt)return btn('nbp',picto('bookmark',16).' '.$rt);}

//read
static function art($id,$rtg=''){
$im=minimg(sql('img','qda','v','id='.$id),'h');
$day=sql('day','qda','v','id='.$id); $dat=mkday($day).' ';
if($rtg)$tag=self::tag_maker($rtg).' ';
//$del=plugin('like',$id,1).' ';
$suj=balb('h4',suj_of_id($id).' ');
if($id)return divc('txtcadr',$im.$dat.$tag.$del.lj('','popup_popart__3_'.$id.'_3',$suj));}

//menus
static function log(){
$iqb=ses('iq');//base64_encode
$ret=input1('favid',$iqb,'4');
$ret.=lj('popbt','plgfv_appin___favs____favid',picto('ok'));
$ret.=hlpbt('flog').' '.msqbt('',nod('coms'));
if(auth(1))$ret.=lj('popbt','popup_loged____'.$iqb,pictxt('logout',nms(54)));
return divc('',$ret);}

static function menu($p){$j='plgfavs_favs,build___'; $ret='';
//$ret=lj('txtx','popup_plup__x_favs___640',picto('refresh')).' ';
if(rstr(52))$ret=lj($p=='fav'?'active':'',$j.'fav',pictxt('bookmark',nms(108))).' ';//favs
if(rstr(90))$ret.=lj($p=='like'?'active':'',$j.'like',pictxt('love','likes')).' ';
if(rstr(91))$ret.=lj($p=='poll'?'active':'',$j.'poll',pictxt('like',nms(144))).' ';//polls
if(rstr(42))$ret.=lj($p=='tags'?'active':'',$j.'tags',pictxt('diez','tags')).' ';
if(ses('mem'))$ret.=lj($p=='visit'?'active':'',$j.'visit',pictxt('articles',nms(33))).' ';
if(rstr(52))$ret.=lj($p=='com'?'active':'',$j.'com',pictxt('work','com')).' ';
$ret.=lj($p=='shar'?'active':'',$j.'shar',pictxt('people',nms(74))).' ';
$ret.=lj('','popup_app___favs_log',picto('logout')).' ';
//if(rstr(90))$ret.=lj('txtx',$j.'like_no',pictxt('trash','Olds')).' ';
if($p=='fav' or $p=='like' or $p=='poll' or $p=='visit'){
	$ret.=lj('txtx','pagup_plup__3_book__'.ses('iq').'_'.$p,pictxt('tv','Web-Book')).' ';
	$ret.=lj('txtx','popup_app__3_favs_mklist_'.$p,pictxt('emission','Api'));
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
if(isset($r))$ret=self::render_icons($r);
//if($r)$ret=self::render_cols($r);
return $menu.divc('',$ret);}

static function home($p,$o,$ob='',$res=''){$res=ajxg($res);
if($res)self::flog($res);
//$bt=self::log();
$ret=self::build($p,$o);
return divd('plgfv',divd('plgfavs',$ret));}

}

function plug_favs($p,$o){
return favs::home($p,$o);}

?>