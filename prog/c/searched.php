<?php 
class searched{
//tagsav
static function tagfull($cat,$tag){if(!meta::tag_auth($cat))return;
$r=sql::inner('art','qdsr','qdsra','ib','k','word="'.$tag.'" order by art desc');
if($r)foreach($r as $k=>$v)meta::sav_tag('',$k,$cat,$tag);}

static function tagfull_slct($srch,$rid){$r=explode(' ','tag '.prmb(18)); $ret='';
foreach($r as $v)$ret.=lj('',$rid.'_searched,tagfull___'.ajx($v).'_'.ajx($srch),$v);
return divc('list',$ret).divb('','alert','svtg');}

static function markers($n){$days=$n?$n:ses('nbj');
if(!rstr(3))return [0,ma::lastart()];
$daymin=timeago($days); $prev=time_prev($days); $daymax=$prev?timeago($prev):ses('daya');
$minid=sql('id','qda','v','day>"'.$daymin.'" limit 1');
$maxid=sql('id','qda','v','day<='.$daymax.' order by id desc limit 1');
return [$minid,$maxid];}

static function results($p,$minid,$maxid,$n=''){
if($n)[$minid,$maxid]=self::markers($n); $id=self::id_word($p);
return sql('art,nb','qdsra','kv','ib='.$id.' and art>'.$minid.' and art<='.$maxid);}

static function save_results($id,$ra,$rb=[]){
if(!is_numeric($id))$id=self::id_word($id); $r=[];
if(!$rb)$rb=sql('art','qdsra','rv','ib='.$id);
if(!$rb)$r=$ra; else foreach($ra as $k=>$v)if(!in_array($v[1],$rb))$r[]=$v;//new results of search
if($r)return sql::qrid('insert into '.qd('search_art').' values '.sql::atmrb($r,1));}

//search and add results
static function add($p,$n){//if(!rstr(3))self::save($p);
[$minid,$maxid]=self::markers($n); //echo $minid.'-'.$maxid;
$ret=self::results($p,$minid,$maxid); //p($ret);
$not=$ret?implode(',',array_keys($ret)):'';
$rb=self::build('',$p,$minid,$maxid,$not); //p($rb);
if($rb && !is_numeric($p))self::save_results($p,$rb);// && $n>7
if($rb)foreach($rb as $k=>$v)$ret[$v[1]]=$v[2];
if($ret)krsort($ret);
return $ret;}

//search
static function build($id,$p,$min,$max,$not=''){
$qda=ses('qda'); $qdm=ses('qdm'); $qds=ses('qdsra');
$wh=$not?'and '.$qda.'.id not in ('.$not.')':'';
//$nb='FLOOR((LENGTH('.$qdm.'.msg)-LENGTH(REPLACE('.$qdm.'.msg,"'.$rch.'","")))/(LENGTH("'.$rch.'")))';//,'.$nb.' as nb from
//$ret=sql::call($sql,'',0);//auth(6)?1:
$sql='select '.$qda.'.id,msg from '.$qda.' 
inner join '.$qdm.' on '.$qdm.'.id='.$qda.'.id
where nod="'.ses('qb').'" and substring(frm,1,1)!="_" and re>0 and '.$qda.'.id>'.$min.' and '.$qda.'.id<='.$max.' and (msg LIKE "%'.$p.'%" or suj LIKE "%'.$p.'%") '.$wh.' order by '.$qda.'.'.prmb(9);
$rq=sql::qr($sql); $rt=[];
if($p)while($r=sql::qrw($rq)){$msg=strtolower($r[1]);
	$rt[]=[isint($id),$r[0],substr_count($msg,strtolower($p))];}
return $rt;}

static function id_word($p){
$id=sql('id','qdsr','v','word="'.$p.'"');
if(!$id)$id=sql::sav('qdsr',[$p]);
return $id;}

static function saved_last($id){
return sql('art','qdsra','v','ib='.$id.' order by art desc limit 1');}

static function save($p,$o='',$prm=[]){
connect(); $p=$prm[0]??$p;
$id=self::id_word($p); //echo $p.'-'.$id;
//$minid=self::saved_last($id); //using add() will write recents after olders
$ra=sql('art','qdsra','rv','ib='.$id);
$minid=0; $maxid=ma::lastart(); 
$na=$maxid-$minid; $nb=200000; $n=ceil($na/$nb); $nt=0;
$ok='start:'.$minid.'-end:'.$maxid.' - loops:'.$n.br();
for($i=0;$i<$n;$i++){
	$min=$minid+$nb*$i; $max=$min+$nb;
	$ok.='from '.$min.' to '.$max.' : ';
	$ex=sql('art','qdsra','k','ib='.$id.' and art>'.$min.' and art<='.$max);
	$not=$ex?implode(',',array_keys($ex)):'';
	$ret=self::build($id,$p,$min,$max,$not);//pr($ret);
	$na=count($ret); $nt+=$na;
	$ok.=$na.' ref added '.br();
	if($ret)self::save_results($id,$ret,$ra);}
$ok.='- occurrences: '.$nt;
//return self::call($p,$o);
return $ok;}

static function look($id){
$ret=divc('txtcadr',nms(177)); $rc=[]; $rd=[];
$msg=sql('msg','qdm','v',$id); $r=sql('id,word','qdsr','kv',''); 
if($r)foreach($r as $k=>$v)if($v){$re='';
	$rb=str::detect_words($msg,$v,1);
	if($rb){$n=count($rb);
	$ex=sql('count(id)','qdsra','v',['ib'=>$k]);
	if($ex){$va=ajx($v); $rc[$k]=$ex;
	$re.=lj('','popup_mod,callmod__3_p:'.$va.',t:'.$va.',d:icons,m:searched*arts',picto('icons')).' ';
	$re.=lj('','popup_search,home__3_'.$va,$v).' ('.$n.') ';
	if(auth(4))$re.=lj('','popup_searched,call__3_'.$va,picto('search')).' ';
	if(auth(4))$re.=lj('','socket_searched,del___'.$k,picto('del')).' ';
	if(auth(6))$re.=lj('','popup_searched,save__3_'.$va,picto('save2'));
	$rd[$k]=div('',$re);}}}
if($rd){arsort($rc); foreach($rc as $k=>$v)$ret.=$rd[$k];}
else $ret.=btn('txtx',nmx([11,16]));
return divs('text-align:left',$ret);}

static function maintenance($d){
$r=qr('select word from pub_search p1 left outer join pub_search_art p2 on p1.id=p2.ib where p2.ib is null');
p($r);}

static function arts($d){
return sql::inner('art','qdsr','qdsra','ib','k','word="'.$d.'" order by art desc');}

static function del($p,$o){//connect();
$n=sql('count(id)','qdsra','v',['ib'=>$p]);
sql::del2('qdsra',['ib'=>$p]);
sql::del('qdsr',$p);
$ret=btn('txtyl',nms(43).' '.plurial($n,19));
return $ret.self::read($p,$o);}

static function read($p,$o){$ret='';//connect();
$r=sqb('id,word','qdsr','kv','order by id desc'); //sort($r);
if($r)foreach($r as $k=>$v){
	//$bt=lj('','srchd_searched,call__3_'.$v,$v).' ';//search__3_
	$bt=lj('','popup_searched,home__x_'.$v,$v).' ';//search__3_
	if(auth(6))$bt.=lj('','srchd_searched,del___'.$k,picto('del')).' ';
	$ret.=$bt.'- ';}
return divc('dlist',$ret);}

static function call($p,$o,$prm=[]){
$p=$prm[0]??$p; geta('page',$o?$o:1);
geta('search',$p);
$r=sql::inner('art','qdsr','qdsra','ib','k','word="'.$p.'" order by art desc'); //pr($r);
$ret=divc('',lkc('popbt','/search/'.$p,nbof(count($r),1)));
if($r)$ret.=ma::output_arts($r,'rch','art','popup_searched,call__x_'.ajx($p).'_');//look
return $ret;}

static function menu($p,$o,$rid){
$ret=lj('',$rid.'_searched,read__3',picto('menu')).' ';
$ret.=input('inp',$p,34).' ';
$ret.=lj('',$rid.'_searched,call_inp_3',picto('ok')).' ';
if($p && auth(4))$ret.=togbub('searched,tagfull*slct',ajx($p).'_'.$rid,picto('paste')).' ';
$ret.=lj('',$rid.'_searched,save_inp_3',picto('save')).' ';
return $ret;}

static function home($p,$o){$rid=('srchd');//randid
$bt=self::menu($p,$o,$rid);
$ret=self::call($p,$o);
ses::$r['popwm']=340;
ses::$r['pophm']=240;
return $bt.divd($rid,$ret);}
}
?>