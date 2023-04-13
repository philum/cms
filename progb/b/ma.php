<?php //arts_tools
class ma{

#arts
static function popart($id,$t=''){
if($t==1)$t=self::suj_of_id($id); $t=pictxt('articles',$t);
if(!rstr(8))return lkc('',htacc($id),$t);
if(rstr(136))return lj('','pagup_popart__3_'.$id.'_3',$t);
else return lj('','popup_popart__3_'.$id.'_3',$t);}//pagup

static function find_art_link($d){
if(is_numeric($d))$wh='id="'.$d.'"'; else $wh='suj="'.$d.'"';
return sql('id','qda','v',$wh.' AND nod="'.ses('qb').'"');}

static function jread($c,$id,$t){$ic=self::find_art_link($id);
if(!rstr(8) or !$ic)return lkc($c,urlread($id),$t);
else return self::popart(is_numeric($ic)?$ic:$id,$t);}

static function pecho_arts($id){$id=self::find_id($id); $r=[];
if(isset($_SESSION['rqt'][$id]))return $_SESSION['rqt'][$id];
if($id)$r=sql('day,frm,suj,img,nod,thm,lu,name,host,mail,ib,re,lg','qda','r',$id);
if($r)return arr($r,13);}

static function read_msg($d,$m){$id=self::find_id($d); if(!$id)return;// and substring(frm,1,1)!='_'
$ok=sql('id','qda','v','id='.$id.' and (re>0 or name="'.ses('USE').'")'); if(!$ok)return;
$ret=sql('msg','qdm','v',$id);
if($m==2 or $m=='noimages' or $m=='nl')$ret=art::preview($ret,$id);
if($m=='inner')$ret=conn::parser($ret,$m,$id);
elseif($m!='brut')$ret=conn::read($ret,$m,$id);
return $ret;}

/*static function artsuj($id){
$r[0]=sql('suj','qda','v',$id);
$r[1]=ma::read_msg($id,3);
return $r;}*/

static function rqt($id,$n=''){
$r=['day'=>0,'frm'=>1,'suj'=>2,'img'=>3,'nod'=>4,'tag'=>5,'lu'=>6,'name'=>7,'host'=>8,'mail'=>9,'ib'=>10,'lu'=>11]; if(!is_numeric($n))$n=$r[$n]; $r=$_SESSION['rqt'][$id]??[];
if($id)return $r[$n]??'';}

static function find_id($id){if($id=='last')return self::lastid();
elseif(!is_numeric($id))return self::id_of_suj($id); else return $id;}
static function lastid($bs){if($bs=='qda')$sq['>=id']=self::lastartid();
$sq['_order']='id desc'; $sq['_limit']='1'; return sql('id',$bs,'v',$sq);}
static function lastartid(){if(is_array($_SESSION['rqt']))return key($_SESSION['rqt']);}
static function lastartday(){if(isset($_SESSION['rqt'])){$id=key($_SESSION['rqt']); return self::rqt($id,'day');}}
static function lastart($d=''){$ld=$d?$d:self::lastartday(); return sql('id','qda','v','nod="'.ses('qb').'" and substring(frm,1,1)!="_" and day>="'.$ld.'" and re>="1" order by id desc limit 1');}
static function oldestart(){
return sql('day','qda','v','nod="'.ses('qb').'" and re>="1" and substring(frm,1,1)!="_" order by day asc limit 1');}
static function is_public($id){
return sql('id','qda','v','id='.$id.' and re>="1" and substring(frm,1,1)!="_"');}
static function maxdays(){$d=sesmk2('ma','oldestart'); if(!$d)$d=0;
$t=ses('daya'); if(!$t)$t=time(); $e=$t-$d; if($e)return round($e/84600);}
static function maxyears(){return ceil(self::maxdays()/365);}
static function id_of_suj($id){
return sql('id','qda','v','suj="'.$id.'" and nod="'.ses('qb').'" order by id asc limit 1');}// and re>0
static function ib_of_id($id){//if($id=='last')$id=self::lastart();
$ib=self::rqt($id,'ib'); if(!$ib)$ib=sql('ib','qda','v',$id);
if($ib && is_numeric($ib) && $ib!=$id)return $ib;}//!='/'&&!='last'
static function id_of_ib($ib){
return sql('id','qda','k','ib="'.$ib.'" and re>="1" and substring(frm,1,1)!="_"');}// limit 1
static function suj_of_id($id){$suj=self::rqt($id,'suj'); if($suj)return $suj;
$suj=sql('suj','qda','v','id="'.$id.'"'); if(is_string($suj))return $suj;}
static function related_arts($id){$d=sql('msg','qdd','v',['ib'=>$id,'val'=>'related']);
return $d?explode(' ',$d):[];}
static function data_val($v,$id,$val,$m=''){$sq=$id?['ib'=>$id]:[];
return sql($v,'qdd',$m?$m:'v',$sq+['val'=>$val]);}

static function find_cat($nbj){
if($nbj){$sq=['nod'=>ses('qb')];
	if(prmb(16))$sq['>day']=timeago($nbj);
	$r=sql('frm','qda','k',$sq,0);}
else $r=ses('line');
return $r;}

#outputs
static function output_arts($r,$md,$tp,$j=''){$rch=get('search');
if(rstr(39) or $md=='flow'){$fw=$j?0:1; geta('flow',1);}
$npg=prmb(6); $page=get('page',1); $ret='';
$min=($page-1)*$npg; $max=$page*$npg; $md=art::slct_media($md); $i=0;
if(is_array($r))foreach($r as $id=>$nb)if($id>0){$i++;
	if($md=='prw')$media=$nb; elseif($rch)$media='rch'; else $media=$md;
	if($i>=$min && $i<$max)$ret.=art::playb($id,$media,$tp,'',$nb);
	elseif($fw)$ret.=div(atd('d'.$id).atb('data-prw',$media),'');}
$nbpg=!$fw?pop::btpages($npg,$page,$i,$j):'';
return $nbpg.$ret.$nbpg;}

static function read_idy($ib,$o,$frm=0,$re='',$id=''){
$w='ib="'.$ib.'"'.($frm?' and frm="'.$frm.'"':'').''.($re?' and re="'.$re.'"':'').' '.($id?' and id="'.$id.'"':'').' order by day '.$o;
return sql('id,ib,name,mail,day,nod,frm,suj,msg,re,host,lg','qdi','',$w);}

//arts
static function import_art($d,$m){
[$dy,$nod,$frm,$suj]=sql('day,nod,frm,suj,img','qda','r','id="'.$d.'"');
return self::popart($d,$suj).n().n();}

static function id_of_urlsuj($d){$id='';
$id=sql('id','qda','v','nod="'.ses('qb').'" and thm="'.$d.'"');//if(rstr(38))
if(!$id){$id=sql('id','qda','v','nod="'.ses('qb').'" and re>="1" and suj like "%'.$d.'%" limit 1');
	if($id){$suj=self::suj_of_id($id); $thm=str::hardurl($suj); sql::upd('qda',['thm'=>$thm],$id);}}
return $id;}

#rqt
static function tri_norqt($vrf,$tri){
$ra=['day','frm','suj','img','nod','tag','lu','name','host','mail','ib','lu'];
$cl=is_numeric($tri)?$ra[$tri]:$tri; $dyb=ses('dayb');
$w=$vrf?' and '.$cl.'="'.$vrf.'"':''; $w.=$dyb?' and day>"'.$dyb.'"':'';
return sql('id,'.$cl,'qda','k','nod="'.ses('qb').'" and substring(frm,1,1)!="_" and re>0'.$w.' order by '.prmb(9));}

static function tri_rqt($vrf,$tri){
if(!rstr(3))return self::tri_norqt($vrf,$tri);
$r=$_SESSION['rqt']; $ret='';
if($r)foreach($r as $k=>$v){$vb=$v[$tri]??'';
	if($vrf && $vb==$vrf)$ret[$k]=$vrf;
	elseif(!$vrf)$ret[$k]=$vb;}
return $ret;}

static function tri_rqb($vrf,$tri,$trb){
$ret=[]; $dya=ses('daya'); $dyb=ses('dayb'); $qb=ses('qb');
$w=$vrf?' and '.$tri.'="'.$vrf.'"':''; $w.=$dyb?' and day>"'.$dyb.'"':'';
return sql('id,'.$tri.','.$trb,'qda','kkv','nod="'.ses('qb').'" and substring(frm,1,1)!="_" and re>0'.$w.' order by '.prmb(9));
return $ret;}

//tags
static function artags($slct,$wh,$how,$z=''){
$qdt=ses('qdt'); $qdta=ses('qdta'); $qda=ses('qda');
$sql='select '.$slct.' from '.$qdt.'
inner join '.$qdta.' on '.$qdt.'.id='.$qdta.'.idtag
inner join '.$qda.' on '.$qda.'.id='.$qdta.'.idart
'.$wh.'';
return sql::call($sql,$how,$z);}

static function art_tags($id,$o=''){
$wh='where '.ses('qda').'.id='.$id.' order by '.ses('qdta').'.id';
return self::artags('cat,tag,idtag',$wh,$o?$o:'kkv');}

static function tag_arts($tag,$cat='',$nbday='',$pday=''){
$wh='where tag="'.$tag.'"';
if($cat)$wh.=' and cat="'.$cat.'"';
if($nbday)$wh.=' and day>"'.timeago($nbday).'"';
if($pday)$wh.=' and day<"'.timeago($pday).'"';
if(prmb(9))$wh.=' order by '.ses('qda').'.'.prmb(9);
return self::artags('idart',$wh,'k');}

static function tags_list($cat,$nbday='',$rub=''){$w='';
if($nbday)$w='where day>"'.timeago($nbday).'"';
if($rub)$w.=' and frm="'.$rub.'"'; if(!$cat)$cat='tag';
$wh='and cat="'.$cat.'"'.$w.' group by tag order by tag';
return self::artags('tag',$wh,'k',0);}

static function tags_list_nb($cat,$nbday=30){$wh=$cat?'where cat="'.$cat.'" ':'';
$wh.='and day>"'.timeago($nbday).'" group by tag order by c desc';
return self::artags('tag,count(idart) as c',$wh,'kv',0);}

static function surcat_list(){$rb=[];
$r=sql('msg','qdd','rv','ib="'.ses('qbd').'" and val="surcat"');
if($r)foreach($r as $k=>$v){[$over,$cat]=split_right('/',$v,1); $rb[$cat]=$over;}
return $rb;}

/**/static function famous($cat){
$wh='where '.ses('qdt').'.cat='.$cat.' group by tag order by n desc limit 100';
return self::artags('tag,count(tag) as n',$wh,'kv');}

static function folderowner($id){
return sql('ib','qdd','rv',['val'=>'folder','msg'=>$id]);}

}
?>