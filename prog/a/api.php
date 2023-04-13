<?php 
class api{
static $o='';

static function official_cols($r){$ret=[];
$r1=['id','ib','day','mail','frm','suj','img','nod','thm','name','lu','re','host','msg','lg'];
$r2=['id','parent','time','url','category','title','image','hub','url-explicit','admin','views','priority','length','content','lang'];
if($r)foreach($r as $k=>$v)
	foreach($v as $ka=>$va){$kb=in_array_b($ka,$r1); $ka=$r2[$kb]; $ret[$k][$ka]=$va;}
return $ret;}

#export
static function json_prep($r,$ra){$ret=[];
header('Content-Type: application/json');
if($r)foreach($r as $k=>$v){$re=[];
	foreach($v as $ka=>$va){
		if($ka=='content' && !isset($ra['conn']))$va=conn::read($va,'3','','nl');
		elseif($ka=='image' && $va){$va=host().'/img/'.pop::art_img($va);}//$ka='lead_image_url';
		elseif($ka=='url-explicit')$va=host().'/art/'.$va;
		elseif($ka=='url'){$re[$ka]=host().'/'.$k; $ka='source';}
		elseif($ka=='lang' && !$va)$va=ses('lng');
		if($ka!='admin')$re[$ka]=utf8enc($va);}
	$ret[$k]=$re;}
return $ret;}

static function dump($ra,$o=''){
if($ra)$r=self::datas($ra);
$r=self::official_cols($r);
if($o=='conn')$ret=$r['msg'];
if($o=='json'){$r=self::json_prep($r,$ra);//JSON_HEX_QUOT
	$ret=json_encode($r,JSON_HEX_TAG);}//echo json_last_error_msg();
if($o=='sql')$ret=sql::atmra(array_keys(current($r)),1).' values '.sql::atmrb($r,1);
return $ret;}

static function file($ra){$ra['template']='file'; $ra['nl']=1; $ret='';//tagb('h2',$ra['file']);
$ret.=self::callr($ra); $f='_datas/html/'.str::hardurl($ra['file']).'.html'; $ret=wpg($ret); mkdir_r($f);
write_file($f,$ret); return lkt('popw','/'.$f,pictxt('url',$ra['file']));}

#sys
static function search($d,$sq,$sg=''){$qda=ses('qda'); $qdm=ses('qdm');
$sq['inner'][]='natural join '.$qdm;
$r=explode('|',$d); $seg=$sg?ses::$r['seg']=1:'';
foreach($r as $k=>$v)
	if($sg)$sq['and'][]=$qdm.'.msg REGEXP "[[:<:]]'.$v.'[[:>:]]"';
	else $sq['and'][]=$qdm.'.msg LIKE "%'.($seg?' '.$v.' ':$v).'%"';
return $sq;}

static function search2($d,$sq){$qdm=ses('qdm');
$a='MATCH (msg) AGAINST ("'.str_replace('|',' ',$d).'" IN BOOLEAN MODE)';
$sq['slct'][]=$a.' as nb'; $sq['and'][]=$a;
return $sq;}

static function avoid($d,$sq){$qda=ses('qda'); $qdm=ses('qdm');
$sq['inner'][]='natural join '.$qdm;
$r=explode('|',$d); foreach($r as $k=>$v)$sq['and'][]=$qdm.'.msg NOT LIKE "%'.$v.'%"';
return $sq;}

static function sql_tags_inner(){
$qdt=ses('qdt'); $qdta=ses('qdta'); $qda=ses('qda');
return 'inner join '.$qdta.' on '.$qda.'.id='.$qdta.'.idart
inner join '.$qdt.' on '.$qdt.'.id='.$qdta.'.idtag ';}

static function sql_date($date){$qda=ses('qda');
[$y,$m,$d]=expl('-',$date,3); $dtr=[]; $dyr=[];
if($y)$dtr[]=strlen($y)==4?'%Y':'%y'; if($m)$dtr[]='%m'; if($d)$dtr[]='%d'; $dt=implode('-',$dtr);
if($y)$dyr[]=$y; if($m)$dyr[]=$m; if($d)$dyr[]=$d; $dy=implode('-',$dyr);
//echo $ret='date_format(from_unixtime('.$qda.'.day),"'.$dt.'")="'.$dy.'"';
$ret='date_format(date_add("1970-01-01 00:00:00",INTERVAL '.$qda.'.day second),"'.$dt.'")="'.$dy.'"';//neg
//DATE_ADD('1970-01-01 00:00:00',INTERVAL pub_art.day SECOND
return $ret;}

static function sql_tags($tags,$cat){$r=explode('|',$tags);//accept negative -tags//!
$qdt=ses('qdt'); $qdta=ses('qdta'); $qda=ses('qda'); $ret=''; $rb=[]; $rc=[]; $rd=[]; $sc='';
if($cat=='utag')$ret.='cat>0 and '; elseif($cat)$sc='cat="'.$cat.'" and ';//$cat=ses('iq')
foreach($r as $k=>$v){$cl=is_numeric($v)?$qdt.'.id':'tag';
	if(substr($v,0,1)=='-')$rc[]=$cl.'!="'.substr($v,1).'"'; else $rb[]=$cl.'="'.$v.'"';}
if($rc)$ret.='('.implode(' and ',$rc).')'; if($rc && $rb)$ret.=' and '; if($rb)$ret.=$sc;
if($rb)$ret.='('.implode(' or ',$rb).')';
return $ret;}

static function sql_lang($lg,$sq){if($lg=='all')return $sq;
$qda=$_SESSION['qda'];
if(strpos($lg,'|'))$lg=str_replace('|','","',$lg);
$sq['and'][]=$qda.'.lg in ("'.$lg.'")';
return $sq;}

static function sql_in($d,$o='',$nb=''){if($o){$na=' not'; $nb='!';} else $na='';
if(strpos($d,'|')!==false)return $na.' in ("'.str_replace('|','","',$d).'")';//'REGEXP "'.$d.'"';
elseif(substr($d,0,1)=='<' or substr($d,0,1)=='>')return $nb.''.$d.'';
else return $nb.'="'.$d.'"';}

static function comp($v){$d=substr($v,0,1);
if($d=='>' or $d=='<')return $d.'"'.substr($v,1).'"';}

#sql
static function mksql($r){$qda=ses('qda'); $in=''; $gr=''; $rtg=[];
$p=valk($r,['count','select','json','sql','cat','nocat','nochilds','priority','notpublished','owner','hub','minday','maxday','from','until','mintime','maxtime','mindid','maxid','source','parent','nbchars','id','minid','lang','lg','search','search_whole','fullsearch','avoid','title','folder','related','relatedby','cmd','group','order','file','page','nbyp','idlist','media','catid','poll','cluster','date','msg','classtag','famous']);
if($p['count'])$sq['slct'][]='count('.$qda.'.id)';
elseif($p['select'])$sq['slct'][]=$p['select'];
elseif($p['idlist'])$sq['slct'][]=$qda.'.id';
else $sq['slct'][]=$qda.'.id,'.$qda.'.ib,'.$qda.'.day,'.$qda.'.mail,'.$qda.'.frm,'.$qda.'.suj,'.$qda.'.img,'.$qda.'.nod,'.$qda.'.thm,'.$qda.'.name,'.$qda.'.lu,'.$qda.'.re,'.$qda.'.host,'.$qda.'.lg';
if($p['json'] or $p['sql'] or $p['msg'])$sq['slct'][]='msg';
//if($p['catid']){$qdc=ses('qdc'); $sq['inner'][]='inner join '.$qdc.' on '.$qdc.'.id='.$qda.'.frm and '.$qda.'.frm="'.$p['catid'].'"';}
if($p['cat'])$sq['and'][]=$qda.'.frm'.self::sql_in($p['cat']);
//else $sq['and'][]='substring('.$qda.'.frm,1,1)!="_"';
else $sq['and'][]=$qda.'.frm not in ("_system","_trash")';
if($p['nocat'])$sq['and'][]=$qda.'.frm'.self::sql_in($p['nocat'],1);
if($p['nochilds'])$sq['and'][]=$qda.'.ib="0"';
if($p['priority'])$sq['re'][]=$qda.'.re'.self::sql_in($p['priority']); else $sq['re'][]=$qda.'.re>="1"';
if($p['notpublished']){if(auth(6))$sq['re'][]=$qda.'.re="0"';
	elseif(auth(4))$sq['re'][]='('.$qda.'.re="0" and '.$qda.'.name="'.ses('USE').'")';}
if($p['owner'])$sq['and'][]='name="'.$p['owner'].'"';
//if($p['owner'])$sq['inner'][]=sql('id','qdu','v',['name'=>$p['owner']]);
if($p['hub'])$sq['and'][]=$qda.'.nod="'.$p['hub'].'"'; //else $sq['and'][]=$qda.'.nod="'.ses('qb').'"';
//if($p['hub']){$qdu=ses('qdu'); $sq['inner'][]='inner join '.$qdu.' on '.$qdu.'.id='.$qda.'.nod';}
if($p['minday'])$sq['and'][]=$qda.'.day>"'.timeago($p['minday']).'"';
elseif($p['from'])$sq['and'][]=$qda.'.day>"'.strtotime($p['from']).'"';
elseif($p['mintime'])$sq['and'][]=$qda.'.day>"'.$p['mintime'].'"';
if($p['maxday'])$sq['and'][]=$qda.'.day<"'.timeago($p['maxday']).'"';
elseif($p['until'])$sq['and'][]=$qda.'.day<"'.strtotime($p['until']).'"';
elseif($p['maxtime'])$sq['and'][]=$qda.'.day<"'.$p['maxtime'].'"';
elseif($p['date'])$sq['and'][]=self::sql_date($p['date']);
if($p['minid'])$sq['and'][]=$qda.'.id>"'.$p['minid'].'"';
if($p['maxid'])$sq['and'][]=$qda.'.id<"'.$p['maxid'].'"';
if($p['source'])$sq['and'][]='mail like "%'.$p['source'].'%"';
if($p['parent'])$sq['and'][]=$qda.'.ib="'.$p['parent'].'"';
if($p['nbchars'])$sq['and'][]='host'.self::comp($p['nbchars']);
if($p['id'])$sq['and'][]=$qda.'.id'.self::sql_in($p['id']);
if($p['lang'] && !rstr(107))$sq=self::sql_lang($p['lang'],$sq);
if($p['search'])$sq=self::search($p['search'],$sq,$p['search_whole']);
if($p['fullsearch'])$sq=self::search2($p['search'],$sq);
if($p['avoid'])$sq=self::avoid($p['avoid'],$sq);
if($p['title'])$sq['and'][]='suj LIKE "%'.$p['title'].'%"';
if($p['folder']){$qdd=ses('qdd'); $sq['inner'][]='inner join '.$qdd.' on '.$qda.'.id='.$qdd.'.ib and val="folder" and '.$qdd.'.msg="'.$p['folder'].'"';}
if($p['related']){$qdd=ses('qdd'); $sq['inner'][]='inner join '.$qdd.' on '.$qda.'.id='.$qdd.'.ib and val="related" and '.$qdd.'.ib="'.$p['related'].'"';}
if($p['relatedby']){$qdd=ses('qdd'); $sq['inner'][]='inner join '.$qdd.' on '.$qda.'.id='.$qdd.'.ib and val="related" and '.$qdd.'.msg like "%'.$p['relatedby'].'%"';}
if($p['poll']){$qdf=ses('qdf'); $sq['slct'][]='poll as nb'; $p['order']='nb';
	if($p['poll']=='all')$wp=''; else $wp='and type="'.$p['poll'].'"';
	$sq['inner'][]='inner join '.$qdf.' on '.$qda.'.id='.$qdf.'.ib '.$wp;}
if($p['cluster']){$rt=sql::inner('tag','qdt','qdtc','idtag','rv',['word'=>$p['cluster']]);
	$rtg[]=self::sql_tags(implode('|',$rt),'');}
if($p['famous']??''){$rt=sql::inner('tag,count(tag) as n','qdt','qdta','idtag','kv',['cat'=>$p['famous'],'_group'=>'tag','_order'=>'n desc','_limit'=>'100']);
	$rtg[]=self::sql_tags(implode('|',array_keys($rt)),'');}
if($p['classtag']){$sq['inner'][]=self::sql_tags_inner(); $sq['slct'][]='tag';
	$sq['and'][]='cat="'.$p['classtag'].'"';}
if($p['lg']){$ynd=ses('ynd'); $sq['slct'][]='txt';
	$sq['inner'][]='inner join '.$ynd.' on ref=concat(\'art\','.$qda.'.id) and lang="'.$p['lg'].'"';}
$ut=explode(' ','utag tag '.prmb(18)); $ut[]=ses('iq'); $n=count($ut);
for($i=0;$i<$n;$i++)if($ut[$i]){$tags=$r[$ut[$i]]??'';
	if($tags)$rtg[]=self::sql_tags($tags,$ut[$i]);}
if($rtg){$sq['inner'][]=self::sql_tags_inner().' and (('.implode(') or (',$rtg).'))';
	$sq['slct'][]='tag';}//$p['group']=1;
if($p['cmd']=='tracks'){$qdi=ses('qdi'); //$sq['slct']=[$qda.'.id'];//todo:use datas
	$sq['inner'][]='inner join '.$qdi.' on '.$qdi.'.ib='.$qda.'.id';}
if($md=$p['media']){$qdm=ses('qdm');
	if($md=='mp3')$md='.'.$md; elseif($md=='img')$md='.jpg'; else $md=':'.$md.']';
	$sq['inner'][]='natural join '.$qdm;
	$sq['and'][]='msg like "%'.$md.'%"';}
if(($p['json'] or $p['sql'] or $p['msg']) && !$p['search']){$qdm=ses('qdm');
	//$sq['inner'][]='natural join '.$qdm;//not works
	$sq['inner'][]='inner join '.$qdm.' on '.$qdm.'.id='.$qda.'.id';}
if($p['group'])$sq['ord'][]='group by '.$qda.'.id';
if($p['order']=='mostread')$sq['ord'][]='order by cast('.$qda.'.lu as integer) desc';
elseif($p['order']=='nb')$sq['ord'][]='order by cast(nb as unsigned integer) desc';
elseif($p['order'])$sq['ord'][]='order by '.$qda.'.'.str_replace('-',' ',$p['order']);
if(!$p['file'] && $p['nbyp']>0 && is_numeric($p['page'])){if($p['page']==0)$p['page']=1;
	$sq['ord'][]='limit '.($p['page']-1)*$p['nbyp'].','.$p['nbyp'];}//nbmx
//build
$slct=implode(',',$sq['slct']);
if(!empty($sq['inner']))$in=' '.implode(' ',$sq['inner']);
if(!empty($sq['and']))$wh=implode(' and ',$sq['and']);
//if($sq['or'])$wh.=' and ('.implode(' or ',$sq['or']).')';
if(!empty($sq['re']))$wh.=' and ('.implode(' or ',$sq['re']).')'; else $wh.=' and re>0';
if(!empty($sq['ord']))$ord=' '.implode(' ',$sq['ord']); else $ord='';
return 'select '.$slct.' from '.$qda.''.$in.' where '.$wh.''.$ord;}

//dig
static function dig($ra){$r=pop::define_digr();
$n=$ra['minday']?$ra['minday']:ses('nbj'); $n=self::resetdig($n); $ret='';
if(!$r[$n])$r[$n]=$n>=365?round($n/365,2):$n; $cur=$r[$n];
$r[$n].=' '.($n<365?plurial($cur,3):plurial($cur,7));
$r['all']=nms(100);
$j=$ra['rid'].'_api,call2_hid'.$ra['rid'].'_exs__';
$rb=array_keys($r); $nb=count($rb);
for($i=0;$i<$nb;$i++)if($rb[$i]==$n)$kb=$i;
for($i=0;$i<$nb;$i++){$k=$rb[$i]; $v=$r[$k];
	if($i<3 or $i==$nb-1 or ($i>$kb-4 && $i<$kb+4)){
	$c=active($n,$k); $dt=date('Y',timeago($k));
	$ret.=lj($c,$j.'dig:'.ajx($k),$k>360&&$k!='all'?$dt:$v,att($dt)).' ';}}
return btn('nbp',$ret);}

//pages
static function pages_nb($nbp,$pg){
$left=$pg-1; $right=$nbp-$pg; $r[1]=1; $r[$nbp]=1;
for($i=0;$i<$left;$i++){$r[$pg-$i]=1; $i*=2;}
for($i=0;$i<$right;$i++){$r[$pg+$i]=1; $i*=2;}
if($r)ksort($r);
return $r;}

static function pages($ra){
$nbyp=$ra['nbyp']??20; $pg=$ra['page']?$ra['page']:1; $ret=''; $prw=''; $nbp=0;
if($ra['nbarts']>$nbyp)$nbp=ceil($ra['nbarts']/$nbyp);
if($nbp)$rp=self::pages_nb($nbp,$pg);
$j=$ra['rid'].'_api,call2_hid'.$ra['rid'].'_exs__';
if(rstr(110)){$prw=art::slct_media($ra['preview']??''); $prwa=art::slct_media($ra['prw']??'');
	$icr=[picto('filelist',16),picto('preview',16)]; if($prwa==1)$prwa=2;
	$rj=[$j.'pg:'.$pg.',prw:1',$j.'pg:'.$pg.',prw:'.$prwa]; $rb=['filelist','preview'];
	$ret.=swapbt($rj,$rb,1,$prw==1?0:1).' ';}
if(rstr(53)){$lg=$ra['lg']??''; $lng=ses('lng');
	if($lg==$lng){$c='active'; $lgb='';} else{$c=''; $lgb=$lng;}
	$ret.=lj($c,$j.'pg:'.$pg.',prw:'.$prw.',lg:'.$lgb,flag($lng)).' ';}//reset rq_nb
if(isset($rp))foreach($rp as $i=>$v)
	$ret.=lj($i==$pg?'active':'',$j.'pg:'.$i,$i).' ';
if($ret)return btn('nbp',$ret);}

#titles
static function head($ra){$ret=''; $dpg='';
if(empty($ra['nbarts']) or $ra['lg']??'')$ra['nbarts']=self::qr_nb($ra); $t=$ra['ti'];
if(rstr(3) && !isset($ra['minday']) && !isset($ra['nodig']))$ra['minday']=ses('nbj');
if($nb=ses::$nb)$nboc=' '.btn('small',nbof($nb,19)); else $nboc='';
if(!empty($ra['cat']) && rstr(112))$pic=catpict($ra['cat'],144).' ';
elseif(!empty($ra['cat']) && rstr(123))$ra['cat']=in_array_k($ra['cat'],ses('line'));//
else $pic='';
if($t && !empty($ra[$t])){$ti=$ra['t']??$ra[$t];//used for num tags
	if(is_numeric($ti))$ti=sql('tag','qdt','v',['id'=>$ti]);
	if(!empty($ra['minday']) && $ra['minday']>7)$dpg='/'.$ra['minday'];
	if($ra['page']>1)$dpg.='/page/'.$ra['page'];
	$lk=eradic_acc($t).'/'.str::protect_url($ra[$t]).$dpg;//eradic_acc
	$ret.=$pic.lka($lk,tagb('h3',$ti.$nboc)).' ';}
elseif(!empty($ra['t']))$ret.=divd('titles',tagb('h3',$ra['t'].$nboc));
$ret.=lj('popbt','popup_api,com_hid'.$ra['rid'],nbof($ra['nbarts'],1)).'';
if(rstr(3) && !isset($ra['nodig']))$ret.=self::dig($ra).br();
if(empty($ra['nopages']))$ret.=self::pages($ra);
$ra['page']=1;//reinit page 1 after dig //$ra['page']??1
$com=implode_k($ra,',',':');
$ret.=hidden('hid'.$ra['rid'],$com);
return tagb('header',$ret);}//['id'=>'ti'.$ra['rid']]

#build
static function build($r,$ra){$n=count($r); $rm=[]; $rd=[]; $rt=[];
$rk=['preview','template','nl','cmd','render','search','random'];
[$prw,$tp,$nl,$cmd,$rnd,$rch,$rid]=vals($ra,$rk);
$pr=art::slct_media($prw); $pr=art::slct_media($prw);
if($rch){$pr='rch'; geta('search',$rch); ses::$r['look']=$rch;}
if($rid){$n=array_rand($r); $rb[$n]=$r[$n]; $r=$rb;}
if($cmd=='panel')foreach($r as $k=>$v)$rt[]=mod::pane_art($k,'',$tp,'',$v);//cmd panel/cover
elseif($cmd=='tracks')foreach($r as $k=>$v)//cmd tracks
	$rt[]=art::playb($k,1).art::output_trk(ma::read_idy($k,'asc'));
else{foreach($r as $k=>$v){$prw=$pr=='auto'?($v['re']>=2?2:1):$pr; $id=$v['id']; $rc[$id]=$v;
		if($prw>1 or $prw=='rch' or substr($prw,0,4)=='conn')$rd[$id]=$id;}
	if($ra['lg']??'')foreach($r as $k=>$v){$id=$v['id']; $rm[$id]=$v['txt']; unset($rd[$id]);}
	if($rd)$rm+=sql('id,msg','qdm','kv','id in ("'.implode('","',$rd).'")');
	foreach($rc as $k=>$v){$v['img1']=pop::art_img($v['img']);
		$rt[]=art::build($v['id'],$v,$rm[$k]??'',$prw,$tp,$nl);}}
if(!empty($ra['cols']))return pop::columns($rt,$ra['cols']);
elseif($cmd=='panel')return divc('inline',implode('',$rt));
return implode('',$rt);}

#query
static function qr($sql){$rq=qr($sql,0); $ret=[];
if($rq){while($r=sql::qra($rq))$ret[$r['id']]=$r; sql::qrf($rq); return $ret;}}
static function qr_row($sql){return sql::call($sql,'kv');}
static function qr_nb($ra){$ra['count']=1; $ra['group']=''; $ra['page']=1;
$sql=self::mksql($ra); return sql::call($sql,'v',0);}

#datas
static function datas($ra){
if(isset($ra['verbose']))p($ra);
$sql=self::mksql($ra);
if(isset($ra['seesql']))echo $sql;
$r=self::qr($sql);
return $r;}

#com
static function callr($ra){
if($ra)$r=self::datas($ra);
if($ra['idlist']??'' && $r)return $r;
if($ra['results']??'' && $r)pr($r);
if($r)return self::build($r,$ra);}

static function callj($p,$b=''){
$ra=explode_k($p,',',':'); $rb=explode_k($b,',',':');
$ra=self::defaults_rq($ra,$rb);
if($ra)return self::callr($ra);}

#load //from url
static function load($ra){
$ra['rid']=$ra['rid']??randid('load');
if($md=$ra['media']??'')$ra['preview']='conn'.$md;
else $ra['preview']=art::slct_media($ra['preview']??'');
$ra['nl']=$ra['nl']??get('nl');
if(!($ra['ti']??''))$ra['ti']=self::tit($ra);
if($ra['id']??'' && !($ra['preview']??'')){$ra['nodig']=1; $ra['preview']=3; $ra['noheader']=1;}
$ret=self::callr($ra);
if($ra['noheader']??'')return $ret;
$nbpg=self::head($ra);
$js='addEvent(document,"scroll",function(){artlive2("'.$ra['rid'].'")});';
Head::add('jscode',$js); $jb='';
//$jb=jscode($js);
//if(!$ret)$ret=nmx([11,16]);
return divd($ra['rid'],$nbpg.$ret).$jb;}

#call
static function call($p){
$ra=explode_k($p,',',':');
$ra=self::defaults_rq($ra);
if($ra['file']??'')return self::file($ra);
elseif($ra['json']??'')return self::dump($ra,'json');
elseif($ra['conn']??'')return self::dump($ra,'conn');
elseif($ra['sql']??'')return self::dump($ra,'sql');
else return self::load($ra);}

static function call2($p,$b='',$prm=[]){$p=$prm[0]??$p;
$ra=explode_k($p,',',':'); $rb=explode_k($b,',',':');
$ra=self::defaults_rq($ra,$rb);
return self::load($ra);}

//frm mod
static function arts($frm,$pr,$tp,$od=''){
$ra=self::arts_rq($frm,get('dig'));
$ra['order']=$od?$od:prmb(9);
$ra['preview']=art::slct_media($pr);
$ra['prw']=$ra['preview'];//mem
$ra['nbyp']=prmb(6);
$ra['page']=get('page',1);
$ra['template']=$tp;
$ra['t']=$frm;
return self::load($ra);}

static function tracks($t){//tracks
$ra=self::arts_rq('',ses('nbj'));
//$ra['select']=ses('qda').'.id,'.ses('qdi').'.re';
$ra['cmd']='tracks'; $ra['preview']=1; $ra['t']=$t;
//$ra['seesql']=1; p($ra);
return self::load($ra);}

#get
static function defaults_rq($ra,$rb=[]){if(!$ra)$ra=[];
[$pg,$to,$dig,$prw,$lg]=vals($rb,['pg','to','dig','prw','lg']);
if($to){$ord=strtolower($ra['order']??prmb(9));
	if($ord=='id desc')$ra['maxid']=$to;
	elseif($ord=='day desc'){$ra['maxtime']=sql('day','qda','v',$to);}
	elseif($ord=='day asc'){$ra['mintime']=sql('day','qda','v',$to);}
	elseif($ord=='id asc'){$ra['minid']=$to;}}
if($ra['until']??'')$ra['nodig']=1;// or $ra['maxtime']??''
if(empty($ra['hub']) && !rstr(105))$ra['hub']=ses('qb');
if(!empty($ra['maxtime'])){$ra['nbdays']=30; $ra['mintime']=$ra['maxtime']-(84600*30);}
//$ra['maxday']=daysfrom($ra['maxtime']); $ra['maxtime']='';
if($ra['dig']??''){$dig=$ra['dig']; unset($ra['dig']);}
if($dig){$ra['nbarts']='';
	if($dig=='all'){$r=pop::define_digr(); $ra['minday']=max(array_flip($r)); unset($ra['maxday']);}
	else{$ra['minday']=$dig; $ra['maxday']=time_prev($dig);}
	unset($ra['mintime']); unset($ra['maxtime']);}
elseif(empty($ra['minday']) && !isset($ra['id']) && empty($ra['mintime']) && empty($ra['maxtime']) && empty($ra['from']) && empty($ra['nodig']) && rstr(3)){$ra['minday']=get('dig',ses('nbj'));
	$pday=time_prev($ra['minday']); if($pday==1)$pday=0; $ra['maxday']=$pday;}
$ra['page']=$pg?$pg:$ra['page']??sesif('page',1);
if($lg)$ra['lg']=$lg;
//if(!isset($ra['lg']) && ses('lang')!='all')$ra['lg']=ses('lang');
if($prw)$ra['preview']=$prw; //$ra['nl']=get('nl');
if(empty($ra['nbyp']) && !isset($ra['nopages']))$ra['nbyp']=prmb(6);
$ra['order']=$ra['order']??prmb(9);
//$ra['verbose']=1;
return $ra;}

static function tit($ra){
$r=explode(' ','cat tag search author source folder '.prmb(18)); $n=count($r);
for($i=0;$i<$n;$i++)if(isset($ra[$r[$i]]))return $r[$i];}

#config
static function resetdig($d){$r=pop::define_digr();
if($d=='all')return $d; $dig='';
foreach($r as $k=>$v)if($k<=$d)$dig=$k;
return $dig;}
static function mod_call($load){
$ra['id']=implode('-',array_keys($load));
return self::load($ra);}

//arts:thread,api_arts
static function arts_rq($frm,$dig){
if(!rstr(105))$ra['hub']=ses('qb');
if(!$frm)$ra['cat']='';
elseif(substr($frm,0,1)!='_' or $_SESSION['auth']>3){$ra['ti']='cat'; $ra['cat']=$frm;}
$ra['nochilds']=$_SESSION['rstr'][33]; $ra['notpublished']=1;
if($dig=='all'){$ra['minday']=max(array_flip($_SESSION['digr'])); unset($ra['maxday']);}
elseif($dig){$ra['minday']=$dig; $ra['maxday']=time_prev($dig);}
elseif(ses('nbj')){$ra['mintime']=ses('dayb'); $ra['maxtime']=ses('daya'); $ra['minday']='';}
else{$ra['mintime']=''; $ra['maxtime']=''; $ra['minday']='';}
$lg=ses('lang'); $ra['lang']=$lg!='all'?$lg:''; //$ra['nl']=get('nl');
$ra['order']=prmb(9); $ra['nbyp']=prmb(6); $ra['page']=get('page');
//$ra['verbose']=1;$ra['seesql']=1;//$ra['group']='id';
return $ra;}

static function tag_ci($d){return $d=str::protect_url($d,1);
return sql('tag','qdt','v','tag collate latin1_swedish_ci="'.$d.'"');}

static function tag_id($d){
return sql('cat,tag','qdt','w','id="'.$d.'"');}

static function detect_uget($d=''){$ut=explode(' ',$d.' '.prmb(18));
if($ut)foreach($ut as $k=>$v){$vb=eradic_acc($v); if($g=get($vb))
	return [$vb,urldecode($g),urldecode($v)];}}

//mod-articles
static function load_rq(){$g=ses::$r['get'];//boot build_content
$rb=valk($g,['tag','search','source','parent','folder','author','rubtag','tagid','utag','cluster'],0);
if($d=$rb['tag']){$ra['tag']=self::tag_ci($d); $ra['ti']='tag';}
elseif($d=$rb['search']){$ra['search']=str::protect_url($d,1); $ra['ti']='search';}
elseif($d=$rb['author']){$ra['owner']=str::protect_url($d,1); $ra['ti']='author';}
elseif($d=$rb['folder']){$ra['folder']=str::protect_url($d,1); $ra['ti']='folder';}
elseif($d=$rb['source']){$ra['source']=str::protect_url($d,1); $ra['ti']='source';}
elseif($d=$rb['cluster']){$ra['cluster']=str::protect_url($d,1); $ra['ti']='cluster';}
elseif($d=$rb['parent']){$ra['parent']=$d; $ra['ti']='parent';}
elseif($d=$rb['rubtag']){$ra['tag']=str::protect_url($d,1); $ra['cat']=ses('frm'); $ra['ti']='tag';}
elseif($d=$rb['tagid']){[$cat,$tag]=$d; $ra[$cat]=$tag; $ra['ti']=$cat;}
elseif($d=$rb['utag']){$ra['utag']=self::tag_ci($d); $ra['ti']='utag';}
elseif($gt=self::detect_uget()){$ra[$gt[2]]=self::tag_ci($gt[1]); $ra['ti']=$gt[2];}
elseif(ses::adm('timetravel'))$ra['maxtime']=ses('daya');
else return;
$ra['lang']=ses('lang'); if(!isset($ra['t']))$ra['t']=$d;
$dig=self::resetdig($g['dig']??'');
return self::defaults_rq($ra,['dig'=>$dig]);}

//mod
static function mod_rq($v){//mod
if(strpos($v,';'))$v=str_replace(';',',',$v);
if(strpos($v,'&'))$ra=explode_k($v,'&','=');//harmonization with old protocol, need &
else $ra=explode_k($v,',',':'); if(!rstr(105))$ra['hub']=ses('qb'); $ra['minday']='';
if($ra['nbdays']??''){$ra['minday']=$ra['nbdays']; unset($ra['nbdays']);}
if($ra['hours']??'')$ra['mintime']=timeago($ra['hours']/24);
$ra['order']=$ra['order']??prmb(9);
$ra['preview']=art::slct_media($ra['preview']??'');//$ra['preview']?:art::slct_media()
$ra['lang']=ses('lang');
//if(!get('frm'))$ra['t']=nms(69);
//$ra['seesql']=1;
return self::defaults_rq($ra);}

static function mod_arts_rq($p,$t,$d,$o,$tp){//api_arts
$ra=self::mod_rq($p); //echo $p;
$ra['rid']='loadmodart'; $ra['page']=1; //$ra['nbyp']=prmb(6);
$ra['t']=$ra['t']??$t; $ra['template']=$tp;
$ra['cmd']=$d; if($o=='cols')$ra['cols']=1;
//$ra['verbose']=1; //$ra['seesql']=1;
return $ra;}

static function mod_row_prw($r,$ra){$ret=[]; $pr=$ra['preview']??'';
if($ra['random']??''){$n=array_rand($r); $rb[$n]=$r[$n]; return $rb;}
if($r)foreach($r as $k=>$v)$ret[$k]=$pr=='auto'?($v>=2?2:1):$pr;
return $ret;}

static function mod_arts_row($v,$o=''){//old load
$ra=self::mod_rq($v); $ra['select']='id,re'; if($o)$ra['t']=$o;
$sql=self::mksql($ra);
$r=self::qr_row($sql);
return self::mod_row_prw($r,$ra);}

static function mod($p){
$ra=explode_k($p,',',':');
$ra=self::defaults_rq($ra); $ra['select']=ses('qda').'.id,re';
if($ra['verbose']??'')p($ra);
if($ra)$sql=self::mksql($ra);
if($ra['sql']??'')echo $sql;
if($sql)$r=self::qr_row($sql);
return self::mod_row_prw($r,$ra);}

static function com($p,$o='',$prm=[]){
$p=$prm[0]??$p; $ra=explode_k($p,',',':'); $rid=$ra['rid']??'heremjx1';//
foreach(['rid','notpublished','nbarts','ti','t'] as $v)unset($ra[$v]);
$com=implode_k($ra,',',':');
$bt=hlpbt('api').' '.lj('grey','popup_favs,home___com_'.ajx($com),picto('save')).' '.lj('grey','popup_apicom,home___'.ajx($com),picto('view')).' '.lkc('grey','/api/'.$com,picto('url')).' ';
$bt.=lj('','popup_apicom,menu___'.ajx($p).'_'.$rid,picto('menu'));
return $bt.divc('editor',$com);}
}
?>