<?php
//philum_plugin_favs

//render
function fav_render_icons($r){req('spe');
return desktop_build_ico($r,'icones').divc('clear','');}

function fav_render_cols($r){req('spe');
if($r)foreach($r as $id=>$v)$ret.=fav_art($id);
return div(atc('cols').ats('width:640px;'),$ret);}

//likes
function fav_cart($cat){
return sql('ib','qdd','k','val="'.$cat.'" and msg="'.ses('iq').'" order by id desc');}

//polls
function fav_poll(){
return sql('ib','qdpl','k','iq="'.ses('iq').'" and poll=1');}

//com (api)
function fav_com_sav($p,$o,$res=''){$ra=ajxr($res);
$rb=array(ses('iq'),$ra[0],$ra[1]);
$r=modif_vars('',ses('qb').'_coms',$rb,'push',array('iq','name','value'));
return fav_com('',$r);}

function fav_com_del($d,$o,$res=''){
$r=modif_vars('',ses('qb').'_coms',$d,'del');
return fav_com('',$r);}

function fav_com_mdf($k,$o,$res=''){$ra=ajxr($res);
$r=modif_vars('',ses('qb').'_coms',array(ses('iq'),$ra[0],$ra[1]),$k);
return fav_com('',$r);}

function fav_com_form($p,$o){
return txarea('comv',$p,44,4,atb('placeholder','Api Command').atz('44')).br().
inp('comn',$o,atb('placeholder','name'));}

function fav_com_edt($k){
$r=msql_read('',ses('qb').'_coms',$k);
$ret.=fav_com_form($r[2],$r[1]);
$ret.=lj('','plgfavs_plug___favs_fav*com*mdf_'.$k.'__comn|comv',pictxt('save','modif'));
return $ret;}

function fac_com_add($p){$ret=fav_com_form($p,'');
$ret.=lj('','plgfavs_plug___favs_fav*com*sav___comn|comv',pictxt('add','save'));
return $ret;}

function fav_com($p,$r=''){$ret=fac_com_add($p);
if(!$r)$r=msq_where('',ses('qb').'_coms',0,ses('iq'));
if($r)foreach($r as $k=>$v)if($v){
	$del=lj('','plgfavs_plug___favs_fav*com*del_'.$k,picto('no')).' ';
	$edt=lj('','plgfavs_plug___favs_fav*com*edt_'.$k,picto('editxt')).' ';
	$exp=lj('','popup_plupin___api_'.ajx($v[2].',preview:full,file:'.$v[1]),pictxt('export')).' ';
	$re=lj('','popup_plupin___api_'.ajx($v[2].',t:'.$v[1]),pictxt('get',$v[1]));
	$ret.=divc('txtcadr',$del.$edt.$exp.$re);}
return $ret;}

//utags
function catagarts($cat){//return tag,idart
$ra=sql('id,tag','qdt','kv','cat="'.$cat.'"');
if($ra){$wh=implode(',',array_keys($ra));
$rb=sql('idtag,idart','qdta','kr','idtag IN ('.$wh.')');
return array_combine($ra,$rb);}}

function fav_tags(){req('spe');
$r=catagarts(ses('iq'));//tag,idarts
if($r)foreach($r as $tag=>$v)foreach($v as $id)$rtg[$id][$tag]=1;
if($r)foreach($r as $tag=>$v)foreach($v as $id)$ret[$tag].=fav_art($id,$rtg[$id]);
if($ret)foreach($ret as $k=>$v)$ret[$k]=divc('cols',$v);
return make_tabs($ret);}

function fav_tag_maker($r){if(!$r)return; //p($r);
foreach($r as $k=>$v)$rt.=$k;//lj('','popup_api___'.ses('iq').';'.ajx($k),$k).' ';
if($rt)return btn('nbp',picto('like',16).' '.$rt);}

//read
function fav_art($id,$rtg=''){
$im=minimg(sql('img','qda','v','id='.$id),'h');
$day=sql('day','qda','v','id='.$id); $dat=mkday($day).' ';
if($rtg)$tag=fav_tag_maker($rtg).' ';
//$del=plugin('like',$id,1).' ';
$suj=bal('h4',suj_of_id($id).' ');
if($id)return divc('txtcadr',$im.$dat.$tag.$del.lj('','popup_popart__3_'.$id.'_3',$suj));}

//menus
function fav_log(){$iqb=(ses('iq'));//base64_encode
$ret.=lj('txtx','popup_plupin__x_favs____favid',picto('logout'));
$ret.=input1('favid',$iqb,'4').hlpbt('flog'); $j='plgfavs_plug___favs_fav*build_';
$ret.=lj('txtx','popup_plup__x_favs___640',picto('refresh')).' ';
if(rstr(52))$ret.=lj('txtx',$j.'fav',pictxt('like','Favs')).' ';
if(rstr(90))$ret.=lj('txtx',$j.'like',pictxt('love','Likes')).' ';
if(ses('mem'))$ret.=lj('txtx',$j.'visited',pictxt('articles','Visited')).' ';
if(rstr(42))$ret.=lj('txtx',$j.'tags',pictxt('tag','Taged')).' ';
if(rstr(52))$ret.=lj('txtx',$j.'com',pictxt('list','Coms')).' ';
if(rstr(91))$ret.=lj('txtx',$j.'poll',pictxt('smile','Polls')).' ';
//if(rstr(90))$ret.=lj('txtx',$j.'like_no',pictxt('trash','Olds')).' ';
$ret.=lj('txtx','pagup_plup___book__'.ses('iq').'_640',pictxt('export','Book')).' ';
return $ret;}

function fav_flog($res){//echo genpswd();
if(is_numeric($res))$iq=sql('id','qdp','v','id="'.$res.'" LIMIT 1');
else $iq=sql('id','qdp','v','id="'.($res).'" LIMIT 1');//base64_decode
if(!$iq)$iq=sql('id','qdp','v','ip="'.ses('ip').'" LIMIT 1');
if($iq)$_SESSION['iq']=$iq;}

function fav_build($p,$o){
if($p=='tags')$ret=fav_tags();
elseif($p=='poll')$r=fav_poll();
elseif($p=='like')$r=fav_cart('like');
elseif($p=='visited')$r=ses('mem');
elseif($p=='com')$ret=fav_com($o);
else $r=fav_cart('fav');
if($r)$ret=fav_render_icons($r);
//if($r)$ret=fav_render_cols($r);
return $ret;}

function plug_favs($p,$o,$ob,$res=''){$res=ajxg($res);
if($res)fav_flog($res);
$menu=fav_log();
$ret=fav_build($p,$o);
return $menu.divd('plgfavs',$ret);}

?>