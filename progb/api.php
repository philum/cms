<?php
//philum_api

#json
function json_encode_r($r){
$r1=array('ib','day','mail','frm','suj','img','nod','thm','name','lu','re','host','msg');
$r2=array('parent','time','url','category','title','image','hub','unused','admin','views','priority','length','content');
if($r)foreach($r as $k=>$v){$re='';
	foreach($v as $ka=>$va){
		if($ka=='msg')$va=htmlentities(format_txt($va,'nl',''));
		$ka=str_replace($r1,$r2,$ka);
		$re[]='"'.$ka.'":"'.addslashes($va).'"';}
	$ret[]='"'.$k.'":{'.implode(',',$re).'}';}
if($ret)return utf8_encode('{'.implode(',',$ret).'}');}

function api_file($ra){$ra['template']='fastart'; ses('nl',1);
$ret=api_callr($ra); $f='plug/_data/'.$ra['file'].'.html'; ses('nl',0);
write_file($f,$ret); return lkt('','/'.$f,$ra['file']);}

#sys
function api_search($d,$sq){$qda=ses('qda'); $qdm=ses('qdm');
$sq['inner'][]='inner join '.$qdm.' on '.$qdm.'.id='.$qda.'.id';
$sq['and'][]=$qdm.'.msg LIKE "%'.$d.'%"';
return $sq;}

function api_sql_tags($r){
$qdt=ses('qdt'); $qdta=ses('qdta'); $qda=ses('qda');
$ret='inner join '.$qdta.' on '.$qda.'.id='.$qdta.'.idart
inner join '.$qdt.' on '.$qdt.'.id='.$qdta.'.idtag and ';
foreach($r as $v)$rb[]='tag="'.$v.'"';
return $ret.'('.implode(' or ',$rb).')';}

function api_sql_tags_0($r){
$ra=array('a','b','c','d','e');
$qdt=ses('qdt'); $qdta=ses('qdta'); $qda=ses('qda');
$ret='inner join '.$qdta.' on '.$qda.'.id='.$qdta.'.idart ';
foreach($r as $k=>$v)$ret.='inner join '.$qdt.' as '.$ra[$k].' on '.$ra[$k].'.id='.$qdta.'.idtag and '.$ra[$k].'.tag="'.$v.'" ';
return $ret;}

function api_sql_lang($lg,$sq){if($lg=='all')return;
$qda=$_SESSION['qda']; $qdd=$_SESSION['qdd'];
$sq['inner'][]='inner join '.$qdd.' on '.$qdd.'.ib='.$qda.'.id and val="lang"';//
if($lg==prmb(25)){
	$lgs=str_replace(prmb(25),'',prmb(26)); $r=explode(' ',$lgs);
	foreach($r as $k=>$v)if($k)$sq['and'][]=$qdd.'.msg!="'.$v.'"';}
elseif($lg!='all')$sq['and'][]=$qdd.'.msg="'.$lg.'"';
return $sq;}

function api_sql_in($d,$o=''){if($o){$na=' not'; $nb='!';}
if(strpos($d,'|')!==false)return $na.' in ("'.str_replace('|','","',$d).'")';
elseif(substr($d,0,1)=='<' or substr($d,0,1)=='>')return $nb.''.$d.'';
else return $nb.'="'.$d.'"';}

function api_comp($v){$d=substr($v,0,1);
if($d=='>' or $d=='<')return $d.'"'.substr($v,1).'"';}

#sql
function api_sql($r){$qda=ses('qda');
if($r['count'])$slct='count('.$qda.'.id)';
elseif($r['select'])$slct=$r['select'];
else $slct=$qda.'.id,'.$qda.'.ib,'.$qda.'.day,mail,frm,suj,img,nod,thm,name,lu,re,host';
//if($r['json'])$slct.=',msg';
if($r['cat'])$sq['and'][]='frm'.api_sql_in($r['cat']);
else $sq['and'][]='substring(frm,1,1)!="_"';
if($r['nocat'])$sq['and'][]='frm'.api_sql_in($r['nocat'],1);
if($r['nochilds'])$sq['and'][]=$qda.'.ib="0"';
if($r['priority'])$sq['re'][]='re'.api_sql_in($r['priority']); else $sq['re'][]='re>="1"';
if($r['notpublished']){if(auth(6))$sq['re'][]='re="0"';
	elseif(auth(4))$sq['re'][]='(re="0" and name="'.ses('USE').'")';}
if($r['owner'])$sq['and'][]='name="'.$r['owner'].'"';
if($r['hub'])$sq['and'][]='nod="'.$r['hub'].'"'; else $sq['and'][]='nod="'.ses('qb').'"';
if($r['minday'])$sq['and'][]='day>"'.calc_date($r['minday']).'"';
elseif($r['from'])echo $sq['and'][]='day>"'.strtotime($r['from']).'"';
elseif($r['mintime'])$sq['and'][]='day>"'.$r['mintime'].'"';
if($r['maxday'])$sq['and'][]='day<"'.calc_date($r['maxday']).'"';
elseif($r['until'])$sq['and'][]='day<"'.strtotime($r['until']).'"';
elseif($r['maxtime'])$sq['and'][]='day<"'.$r['maxtime'].'"';
if($r['minid'])$sq['and'][]=$qda.'.id>"'.$r['minid'].'"';
if($r['maxid'])$sq['and'][]=$qda.'.id<"'.$r['maxid'].'"';
if($r['source'])$sq['and'][]='mail like "%'.$r['source'].'%"';
if($r['parent'])$sq['and'][]=$qda.'.ib="'.$r['parent'].'"';
if($r['nbchars'])$sq['and'][]='host'.api_comp($r['nbchars']);
if($r['id'])$sq['and'][]=$qda.'.id'.api_sql_in($r['id']);
if($r['lang'])$sq=api_sql_lang($r['lang'],$sq);
if($r['search'])$sq=api_search($r['search'],$sq);
if($r['title'])$sq['and'][]='suj LIKE "%'.$r['title'].'%"';
$ut=explode(' ','utag tag '.prmb(18)); $n=count($ut);
for($i=0;$i<$n;$i++)if($ut[$i])if($r[$ut[$i]])$tg[]=$r[$ut[$i]];
if($tg)$sq['inner'][]=api_sql_tags($tg);
if($r['cmd']=='tracks'){$qda=ses('qda'); $qdi=ses('qdi');
	$sq['inner'][]='inner join '.$qdi.' on '.$qdi.'.frm='.$qda.'.id';}
if($r['json'] && !$r['search']){$qda=ses('qda'); $qdm=ses('qdm');
	$sq['inner'][]='inner join '.$qdm.' on '.$qdm.'.id='.$qda.'.id';}
if($r['group'])$sq['ord'][]='group by '.$qda.'.id';
if($r['order'])$sq['ord'][]='order by '.$qda.'.'.str_replace('-',' ',$r['order']);
if(!$r['file'] && $r['nbyp'])$sq['ord'][]='limit '.($r['page']-1)*$r['nbyp'].','.$r['nbyp'];
//build
if($sq['inner'])$in=implode(' ',$sq['inner']);
if($sq['and'])$wh=implode(' and ',$sq['and']);
//if($sq['or'])$wh.=' and ('.implode(' or ',$sq['or']).')';
if($sq['re'])$wh.=' and ('.implode(' or ',$sq['re']).')'; else $wh.=' and re>0';
if($sq['ord'])$ord=' '.implode(' ',$sq['ord']);
return 'select '.$slct.' from '.$qda.' '.$in.' where '.$wh.$ord;}

#build
function api_build_arts($r,$prw,$tp){
if($prw>1 or $prw=='rch')$msg=sql('msg','qdm','v','id="'.$r['id'].'"');//msg
$r['img1']=first_img($r['img']);
return art_read_mecanics($r['id'],$r,$msg,'',$prw,$tp);}

function api_build($r,$ra){$n=count($r);
$pr=$ra['preview']; $tp=$ra['template']; $cmd=$ra['cmd'];
if($rch=$ra['search']){$pr='rch'; $_GET['search']=$rch; $_GET['look']=$rch;}
if($cmd=='panel')foreach($r as $k=>$v)$re[]=pane_art($k,$o);//cmd panel
elseif($cmd=='track')foreach($r as $k=>$v)//cmd tracks
	$re[]=art_read_b($k,'',1,'').output_trk(read_idy($k,'asc'));
else foreach($r as $k=>$v){$prw=$pr=='auto'?($v['re']>2?2:1):$pr;
	$re[]=api_build_arts($v,$prw,$tp);}
if($ra['cols'])return columns($re,$ra['cols']);
return implode('',$re);}

#titles
//dig
function api_dig($ra){$r=define_digr(); $n=$ra['minday'];
if(!$r[$n])$r[$n]=$n>=365?round($n/365,2):$n; $cur=$r[$n]; $nprev=time_prev($n);
$r[$n].=' '.($n<365?plurial($cur,3):plurial($cur,7));
if($n!=1 && $n!=7)$r[$n]=$r[$nprev].' '.nms(36).' '.$r[$n];
if($n>365)$r[$n]=date('Y',calc_date($n)); $r['all']=nms(100);
$ret=slctmenusja($r,$ra['rid'].'_api_hid'.$ra['rid'].'_exs__',$n);
return btn('nb_pages',$ret);}

//pages
function api_pages_nb($nbp,$pg){
$cases=5; $left=$pg-1; $right=$nbp-$pg; $r[1]=1; $r[$nbp]=1;
for($i=0;$i<$left;$i++){$r[$pg-$i]=1; $i*=2;}
for($i=0;$i<$right;$i++){$r[$pg+$i]=1; $i*=2;}
if($r)ksort($r);
return $r;}

function api_pages($ra){
$nbyp=$ra['nbyp']; $pg=$ra['page'];
if($ra['nbarts']>$nbyp)$nbp=ceil($ra['nbarts']/$nbyp);
if($nbp)$rp=api_pages_nb($nbp,$pg);
if($rp){foreach($rp as $i=>$v)
	$ret.=lj($i==$pg?'active':'',$ra['rid'].'_api_hid'.$ra['rid'].'_exs_'.$i,$i).' ';
return btn('nb_pages',btn('small','page ').$ret);}}

function api_titles($ra){
if(!$ra['nbarts'])$ra['nbarts']=api_query_nb($ra); $t=$ra['link'];
if(rstr(3) && !$ra['minday'] && !$ra['nodig'])$ra['minday']=ses('nbj');
$com=implode_k($ra,',',':'); $ret=hidden('','hid'.$ra['rid'],$com);
if($nb=$_GET['nboc'])$nboc=' '.btn('small',nbof($nb,19));
if($t && $ra[$t]){
	if($ra['minday']>1)$pg='/'.$ra['minday'];
	if($ra['page']>1)$pg.='/page/'.$ra['page'];
	$lk=eradic_acc($t).'/'.$ra[$t].$pg;
	$ret.=bal('h3',lka($lk,$ra[$t].$nboc));}
elseif($ra['t'])$ret.=divd('titles',bal('h3',$ra['t'].$nboc));
$ret.=lj('popbt','popup_apicom_hid'.$ra['rid'],nbof($ra['nbarts'],1)).' ';
if(rstr(3) && !$ra['nodig'])$ret.=api_dig($ra).br();
if(!$ra['nopages'])$ret.=api_pages($ra);
return bal('header',$ret);}

#query
function api_query($sql){$rq=mysql_query($sql) or die(mysql_error());
if($rq)while($r=mysql_fetch_assoc($rq))$ret[$r['id']]=$r;
if($rq)mysql_free_result($rq);
return $ret;}

function api_query_row($sql){$rq=mysql_query($sql) or die(mysql_error());
if($rq)while($r=mysql_fetch_row($rq))$ret[$r[0]]=$r[1];
if($rq)mysql_free_result($rq);
return $ret;}

function api_query_nb($ra){
$ra['count']=1; $ra['group']=''; $sql=api_sql($ra);
return sql_b($sql,'v');}

#datas
function api_datas($ra){
if($ra['verbose'])p($ra);
$sql=api_sql($ra);
if($ra['seesql'])echo $sql;
$r=api_query($sql);
return $r;}

#ajax
function api_callr($ra){
if($ra)$r=api_datas($ra);
if($r)return api_build($r,$ra);}

function api_callj($p,$pg,$to){
$ra=explode_k($p,',',':');
$ra=api_defaults_rq($ra,$pg,$to);
if($ra)return api_callr($ra);}

#load
function api_load($ra){
$ra['rid']=$ra['rid']?$ra['rid']:randid('load');
$ra['preview']=slct_media($ra['preview']);
if(!$ra['link'])$ra['link']=api_tit($ra);
$ret=api_callr($ra);
$nbpg=api_titles($ra);
Head::add('jscode','addEvent(document,"scroll",function(){artlive2("'.$ra['rid'].'")});');
//if(!$ret)$ret=nms(11).' '.nms(16);
return divd($ra['rid'],$nbpg.$ret);}

#call
function api_call($p,$pg='',$dig=''){//plug
$ra=explode_k($p,',',':');
$ra=api_defaults_rq($ra,$pg,'',$dig);
if($ra['json'])return json_encode_r(api_datas($ra));
if($ra['file'])return api_file($ra);
return api_load($ra);}

function api_arts($frm,$pr,$tp){
$ra=api_arts_rq($frm,get('dig'));
$ra['preview']=slct_media($pr);
$ra['template']=$tp;
return api_load($ra);}

function api_tracks($t){//tracks
$ra=api_arts_rq('',ses('nbj'));
//$ra['select']=ses('qda').'.id,'.ses('qdi').'.re';
$ra['cmd']='tracks'; $ra['preview']=1; $ra['t']=$t;
$ra['seesql']=1; p($ra);
return api_load($ra);}

#get
function api_defaults_rq($ra,$pg='',$to='',$dig=''){if(!$ra)$ra=array();
if($to){$ord=strtolower($ra['order']);
	if($ord=='id desc')$ra['maxid']=$to; elseif($ord=='id asc')$ra['minid']=$to;
	elseif($ord=='day desc')$ra['maxtime']=sql('day','qda','v','id='.$to); 
	elseif($ord=='id asc')$ra['mintime']=sql('day','qda','v','id='.$to);}
if(!$ra['hub'])$ra['hub']=ses('qb');
if($dig){$ra['nbarts']='';
	if($dig=='all'){$ra['minday']=max(array_flip($_SESSION['digr'])); unset($ra['maxday']);}
	else{$ra['minday']=$dig; $ra['maxday']=time_prev($dig);}
	unset($ra['mintime']); unset($ra['maxtime']);}
elseif(!$ra['minday'] && !$ra['mintime'] && !$ra['from'] && !$ra['nodig'] && rstr(3)){
	$ra['minday']=get('dig')?get('dig'):ses('nbj');
	$pday=time_prev($ra['minday']); if($pday==1)$pday=0; $ra['maxday']=$pday;}
$ra['page']=$pg?$pg:($ra['page']?$ra['page']:(ses('page')?ses('page'):1));
if(!$ra['nbyp'])$ra['nbyp']=prmb(6);
$ra['order']=$ra['order']?$ra['order']:prmb(9);
//$ra['verbose']=1;
return $ra;}

function api_tit($ra){
$r=explode(' ','category tag search '.prmb(18)); $n=count($r);
for($i=0;$i<$n;$i++)if($ra[$r[$i]])return $r[$i];}

#config

//arts
function api_arts_rq($frm,$dig){$ra['hub']=ses('qb');
if($frm=='Home' or $frm=='All')$ra['cat']='';
elseif(substr($frm,0,1)!='_' or $_SESSION['auth']>3){$ra['link']='cat'; $ra['cat']=$frm;}
$ra['nochilds']=$_SESSION['rstr'][33]; $ra['notpublished']=1;
if($dig){$ra['minday']=$dig; $ra['maxday']=time_prev($dig);}
else{$ra['mintime']=ses('dayb'); $ra['maxtime']=ses('daya');}
if($_SESSION['lang']!='all')$ra['lang']=$_SESSION['lang'];
$ra['order']=prmb(9); $ra['nbyp']=prmb(6); $ra['page']=ses('page');
//$ra['group']='id';
return $ra;}

//Load
function api_load_rq(){$g=$_GET;//boot build_content
if($g['tag']){$ra['tag']=$g['tag']; $ra['link']='tag';}
elseif($g['search']){$ra['search']=$g['search']; $ra['link']='search';}
elseif($g['source']){$ra['source']=$g['source']; $ra['link']='source';}
elseif($g['parent']){$ra['parent']=$g['parent']; $ra['link']='parent';}
elseif($g['author']){$ra['owner']=$g['author']; $ra['link']='author';}
elseif($g['rub_tag']){$ra['tag']=$g['rub_tag']; $ra['cat']=ses('frm'); $ra['link']='tag';}
elseif($gets=detect_uget()){$ra[$gets[2]]=$gets[1]; $ra['link']=$gets[2];}
else return;
return api_defaults_rq($ra);}

function api_mod_call($load){
$ra['id']=implode('-',array_keys($load));
return api_load($ra);}

//mod
function api_mod_rq($v){
$ra=explode_k($v,'&','='); $ra['hub']=ses('qb');
if($ra['nbdays']){$ra['minday']=$ra['nbdays']; unset($ra['nbdays']);}
if($ra['hours'])$ra['mintime']=calc_date($ra['hours']/24);
$ra['order']=$ra['order']?$ra['order']:prmb(9);
$ra['preview']=$ra['preview']?slct_media($ra['preview']):slct_media();
//if(ses('frm')=='Home')$ra['t']=nms(69);
return api_defaults_rq($ra);}

function api_mod_arts($p,$t='',$tp=''){//module api_arts
$ra=api_mod_rq($p);
$ra['rid']='loadmodart';
$ra['nbyp']=prmb(6); $ra['page']=1;
$ra['t']=$ra['t']?$ra['t']:$t;
$ra['template']=$tp;
//$ra['seesql']=1;
return $ra;}

function api_mod_row_prw($r,$pr){
if($r)foreach($r as $k=>$v)$ret[$k]=$pr=='auto'?($v>=2?2:1):$pr;
return $ret;}

function api_mod_arts_row($v,$o=''){//old load
$ra=api_mod_rq($v); $ra['select']='id,re'; if($o)$ra['t']=$o;
$sql=api_sql($ra);
$r=api_query_row($sql);
return api_mod_row_prw($r,$ra['preview']);}

function api_mod($p){
$ra=explode_k($p,',',':');
$ra=api_defaults_rq($ra); $ra['select']='id,re';
if($ra)$sql=api_sql($ra);
if($sql)$r=api_query_row($sql);
return api_mod_row_prw($r,$ra['preview']);}

?>