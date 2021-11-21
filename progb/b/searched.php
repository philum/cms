<?php
//philum/b/searched

class searched{

//tagsav
static function tagfull($cat,$tag){req('meta');
if(!tag_auth($cat))return;
$r=sql_inner('art','qdsr','qdsra','ib','k','where word="'.$tag.'" order by art desc');
if($r)foreach($r as $k=>$v)sav_tag('',$k,$cat,$tag);}

static function tagfull_slct($srch,$rid){$r=explode(' ','tag '.prmb(18)); $ret='';
foreach($r as $v)$ret.=lj('',$rid.'_app___searched_tagfull_'.ajx($v).'_'.ajx($srch),$v);
return divc('list',$ret).divb('','alert','svtg');}

static function markers($n){$days=$n?$n:ses('nbj');
if(!rstr(3))return [0,last_art('qda')];
$daymin=calc_date($days); $prev=time_prev($days); $daymax=$prev?calc_date($prev):ses('daya');
$minid=sql('id','qda','v','day>"'.$daymin.'" limit 1');
$maxid=sql('id','qda','v','day<='.$daymax.' order by id desc limit 1');
return [$minid,$maxid];}

static function results($p,$minid,$maxid,$n=''){
if($n)list($minid,$maxid)=self::markers($n); $id=self::id_word($p);
return sql('art,nb','qdsra','kv','ib='.$id.' and art>'.$minid.' and art<='.$maxid);}

static function save_results($id,$ra,$rb=[]){
if(!is_numeric($id))$id=self::id_word($id); $r=[];
if(!$rb)$rb=sql('art','qdsra','rv','ib='.$id);
if(!$rb)$r=$ra; else foreach($ra as $k=>$v)if(!in_array($v[1],$rb))$r[]=$v;//new results of search
if($r)return qrid('insert into '.qd('search_art').' values '.mysqlrb($r,1));}

//search and add results
static function search_add($p,$n){//if(!rstr(3))self::save($p);
list($minid,$maxid)=self::markers($n); //echo $minid.'-'.$maxid;
$ret=self::results($p,$minid,$maxid); //p($ret);
$not=$ret?implode(',',array_keys($ret)):'';
$rb=self::rech('',$p,$minid,$maxid,$not); //p($rb);
if($rb && !is_numeric($p))self::save_results($p,$rb);// && $n>7
if($rb)foreach($rb as $k=>$v)$ret[$v[1]]=$v[2];
if($ret)krsort($ret);
return $ret;}

//search
static function rech($id,$p,$min,$max,$not=''){
$qda=ses('qda'); $qdm=ses('qdm'); $qds=ses('qdsra');
$wh=$not?'and '.$qda.'.id not in ('.$not.')':'';
//$nb='FLOOR((LENGTH('.$qdm.'.msg)-LENGTH(REPLACE('.$qdm.'.msg,"'.$rch.'","")))/(LENGTH("'.$rch.'")))';//,'.$nb.' as nb from
//$ret=sql_b($sql,'',0);//auth(6)?1:
$sql='select '.$qda.'.id,msg from '.$qda.' 
inner join '.$qdm.' on '.$qdm.'.id='.$qda.'.id
where nod="'.ses('qb').'" and substring(frm,1,1)!="_" and re>0 and '.$qda.'.id>'.$min.' and '.$qda.'.id<='.$max.' and (msg LIKE "%'.$p.'%" or suj LIKE "%'.$p.'%") '.$wh.' order by '.$qda.'.'.prmb(9);
$rq=qr($sql);
$p=strtolower($p); $ret=[];
if($p)while($r=mysqli_fetch_row($rq)){$msg=strtolower($r[1]);
	$ret[]=array($id,$r[0],substr_count($msg,$p));}
return $ret;}

static function id_word($p){
$id=sql('id','qdsr','v','word="'.$p.'"');
if(!$id)$id=insert('qdsr',mysqlra([$p],1));
return $id;}

static function saved_last($id){
return sql('art','qdsra','v','ib='.$id.' order by art desc limit 1');}

static function save($p,$o='',$res=''){
list($p,$o)=ajxp($res,$p,$o);
connect(); req('spe');
$id=self::id_word($p); //echo $p.'-'.$id;
//$minid=self::saved_last($id); //using search_add() will write recents after olders
$ra=sql('art','qdsra','rv','ib='.$id);
$minid=0; $maxid=last_art('qda'); 
$na=$maxid-$minid; $nb=200000; $n=ceil($na/$nb); $nt=0;
$ok='start:'.$minid.'-end:'.$maxid.' - loops:'.$n.br();
for($i=0;$i<$n;$i++){
	$min=$minid+$nb*$i; $max=$min+$nb;
	$ok.='from '.$min.' to '.$max.' : ';
	$ex=sql('art','qdsra','k','ib='.$id.' and art>'.$min.' and art<='.$max);
	$not=$ex?implode(',',array_keys($ex)):'';
	$ret=self::rech($id,$p,$min,$max,$not);//pr($ret);
	$na=count($ret); $nt+=$na;
	$ok.=$na.' ref added '.br();
	if($ret)self::save_results($id,$ret,$ra);}
$ok.='- occurrences: '.$nt;
//return self::call($p,$o);
return $ok;}

static function look($id){
$ret=divc('txtcadr',nms(177)); $rc=[]; $rd=[];
$msg=sql('msg','qdm','v','id='.$id); $r=sql('id,word','qdsr','kv',''); 
if($r)foreach($r as $k=>$v)if($v){$re='';
	$rb=detect_words($msg,$v,1);
	if($rb){$n=count($rb);
	$ex=sql('count(id)','qdsra','v',['ib'=>$k]);
	if($ex){$va=ajx($v); $rc[$k]=$ex;
	$re.=lj('','popup_modpop__3_'.$va.'/'.$va.'/icons:searched*arts',picto('icons')).' ';
	$re.=lj('','popup_search__3_'.$va,$v).' ('.$n.') ';
	if(auth(4))$re.=lj('','popup_app__3_searched_call_'.$va,picto('search')).' ';
	if(auth(4))$re.=lj('','socket_app___searched_del_'.$k,picto('del')).' ';
	if(auth(6))$re.=lj('','popup_searched,save__3_'.$va,picto('save2'));
	$rd[$k]=div('',$re);}}}
if($rd){arsort($rc); foreach($rc as $k=>$v)$ret.=$rd[$k];}
else $ret.=btn('txtx',nmx([11,16]));
return divs('text-align:left',$ret);}

static function maintenance($d){
$r=qr('select word from pub_search p1 left outer join pub_search_art p2 on p1.id=p2.ib where p2.ib is null');
p($r);
}

static function arts($d){
return sql_inner('art','qdsr','qdsra','ib','k','where word="'.$d.'" order by art desc');}

static function del($p,$o){//connect();
$n=sql('count(id)','qdsra','v','ib='.$p);
qr('delete from '.ses('qdsra').' where ib="'.$p.'"');
sqldel('qdsr',$p);
$ret=btn('txtyl',nms(43).' '.plurial($n,19));
return $ret.self::read($p,$o);}

static function read($p,$o){//connect();
$r=sqb('id,word','qdsr','kv','order by id desc'); //sort($r);
if($r)foreach($r as $k=>$v){
	//$bt=lj('','srchd_app__3_searched_call_'.$v,$v).' ';//search__3_
	$bt=lj('','popup_plupin__x_searched_'.$v,$v).' ';//search__3_
	if(auth(6))$bt.=lj('','srchd_app___searched_del_'.$k,picto('del')).' ';
	$ret.=$bt.'- ';}
return divc('dlist',$ret);}

static function call($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o); ses('page',$o?$o:1);
req('spe,art,tri,pop'); getb('search',$p);
$r=sql_inner('art','qdsr','qdsra','ib','k','where word="'.$p.'" order by art desc'); //pr($r);
$ret=divc('',lkc('popbt','/search/'.$p,nbof(count($r),1)));
if($r)$ret.=output_arts($r,'rch','art','popup_app__x_searched_call_'.ajx($p).'_');//look
return $ret;}

static function menu($p,$o,$rid){
$ret=lj('',$rid.'_app__3_searched_read',picto('menu')).' ';
$ret.=input('inp',$p).' ';
$ret.=lj('',$rid.'_app__3_searched_call___inp',picto('ok')).' ';
$ret.=lj('',$rid.'_app__3_searched_save___inp',picto('save')).' ';
if($p && auth(4))$ret.=togbub('app','searched_tagfull*slct_'.ajx($p).'_'.$rid,picto('paste')).' ';
return $ret;}

static function install(){
//$qd=ses('qd'); ses('qdsr',$qd.'_search'); ses('qdsra',$qd.'_search_art');
mysql::install('search',['word'=>'var'],0);//1=drop table on change $r !
mysql::install('search_art',['ib'=>'int','art'=>'int','nb'=>'int'],0);}

function searched_add($p,$o){
//self::install();
$ret=self::search_add($p,$o);
return $ret;}

static function home($p,$o){$rid=('srchd');//randid
//self::install();
$bt=self::menu($p,$o,$rid);
$ret=self::call($p,$o);
return $bt.divd($rid,$ret);}
}

function plug_searched($p,$o){
return searched::home($p,$o);}

?>