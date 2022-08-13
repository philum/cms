<?php //md for modules
class md{

#commands
static function build_titl($load,$t,$n='',$bt=''){$nb='';
$na=$load?count_r($load):''; if($na)$nb=btn('small',nbof($na,$n?$n:1)).' ';
return divd('titles',btn('txtcadr',$t).' '.$nb.$bt);}//pictxt('eye',)

static function special_link($d,$o=''){
[$m,$v]=split_one('§',$d,0);
$m=str_replace('*',' ',$m);
switch($m){
case('lang'):$ra=explode(' ',prmb(26).' all');
	return slct_menus($ra,'/?lang=',$_SESSION['lang'],'active','','v');
	if(get('lang'))return lkc('txtx','/?module=All&refresh==',nms(60)); break;
case('time'):$ra=pop::define_digr(); $nbj=$_SESSION['nbj'];
	if($_SESSION['dayx']-$_SESSION['daya']>3600)$goto=art::target_date($_SESSION['daya']);
	else $goto=htac('nbj'); foreach($ra as $k=>$v){
		if($k==$nbj)$nm=' '.($k<365?plurial($v,3):plurial($v,7)); else $nm='';
		if($v)return lkc($k==$nbj?'active':'',$goto.$k,$v.$nm).' ';} break;
case('br'):return br(); break;}
$r=mod::mod_link_r($m,$v); $t=$r[3]; if($o)$sp=''; else $sp=($d=='cols'?br():' ');
if($r[1]=='j')return lj($r[0],$r[2],$t);
elseif($r[1]=='SaveJc')return ljb($r[0],$r[1],$r[2],$t);
else return lkc($r[0],$r[1].$r[2],$t).$sp;}//todo mang treatment

static function user_menu($p){$ret='';
if(!$p)$p='home hubs plan'; $r=explode(' ',$p); $n=count($r);
for($i=0;$i<$n;$i++)$ret.=self::special_link($r[$i],'').' ';
return $ret;}

static function art_viewer($r){$rid=randid('artv'); $id=key($r); $ret=art::playb($id,2);
if(count($r)>1)foreach($r as $k=>$v){$i++; $m.=lj('',$rid.'_art,playb___'.$k.'_2',$i);}
return divc('nbp',$m).divd($rid,$ret);}

static function recents_arts($d,$o){
$o=is_numeric($o)?$o:10;
$wh=' nod="'.ses('qb').'"';//slowlog
if($d=='auto')$wh.=' AND frm="'.$_SESSION['frm'].'"';
elseif($d!='all' && $d!=1 && $d)$wh.=' AND frm="'.$d.'"';
return sql('id','qda','k',$wh.' AND re>="1" ORDER BY id DESC LIMIT '.$o);}

static function pub_art_b($id,$t,$o){
[$dy,$frm,$suj,$amg]=ma::pecho_arts($id);
if(rstr(32))$img=minimg($amg,'hb'); $lnk=urlread($id);
return balb('h2',lkc('',$lnk,$suj)).divc('panel',ma::read_msg($id,$o?$o:2));}

static function pub_img($id){
[$dy,$frm,$suj,$amg]=$_SESSION['rqt'][$id];
if(!$dy){$amg=sql('img','qda','v','id='.$id);}
return lkc('',urlread($id),minimg($amg,'ban'));}

static function read_art($n,$t,$o){$in=ma::read_msg($n,'');
if(strlen($in)>1000)$nbc=['1','1']; $ret='';
if(is_numeric($n))$tit=ma::suj_of_id($n); else $tit=$n;
if($o)$in=scroll($nbc,$in,0);
if($t)$ret=divc('txtcadr',$t==1?$tit:$t);
$ret.=divc('panel',$in);
if(trim($in))return $ret;}

static function friend_rub($o){
$id=ma::id_of_suj($_SESSION['frm']);
$ok=sql('id','qda','v','id='.$id.' and re>0');
$ret=sql('msg','qdm','v','id='.$id);
if(auth(4))$bt=ma::popart($id);
if($ok)return divc($o,$bt.conn::read($ret,'',''));}

static function friend_art($o){
if($_SESSION['read']){$id=ma::id_of_suj($_SESSION['read']); $in=ma::read_msg($id,1,'');}
if(is_numeric($id)) return divc($o,$in);}

static function timetravel_m(){$r=pop::timetravel();
$travel=date('Y',ses('daya')); $ret='';
foreach($r as $k=>$v){$c=$k==$travel?'active':''; $ic=$travel==$k?'clock':'hour';
	$ret.=lj('','content_api___maxtime:'.$v,pictxt($ic,date('Y',$v)));}
return divc('menus',$ret);}

static function prevnext_art($b,$o,$id,$tg=''){$wh=''; $rb=[];
$id=$id?$id:ses('read'); $ta=picto('kleft'); $tb=picto('kright'); $htacc=htacc('read');
if($b=='rub')$wh='and frm="'.ses('frm').'" '; else $wh='and substring(frm,1,1)!="_"';
$ord=strtolower(prmb(9)); $col=strto($ord,' ');
$w='and nod="'.ses('qb').'" and re>"0" '.$wh;
if($col=='day'){$dy=sql('day','qda','v','id='.$id); $w1='day<"'.$dy.'"'; $w2='day>"'.$dy.'"';}
else{$w1='id<"'.$id.'"'; $w2='id>"'.$id.'"';}
$k1=sql('id','qda','v',$w1.' '.$w.' order by '.$col.' desc limit 1');
$k2=sql('id','qda','v',$w2.' '.$w.' order by '.$col.' asc limit 1');
if(!rstr(8)){$ret=lkc($k1?'':'hide',$htacc.$k1,$ta).''.lkc($k2?'':'hide',$htacc.$k2,$tb);}
else{
	if($tg)$j='pagup_popart__x_'; elseif($o)$j='popup_popart__x_'; else $j='content_mod,ajxlnk2__u_read_';
	$ret=!$k1?btn('hide',$ta):lj('',$j.$k1.'__'.$k1,$ta);
	$ret.=!$k2?btn('hide',$tb):lj('',$j.$k2.'__'.$k2,$tb);}
if(!$o)return btn('nbp right',$ret);
return $ret;}

static function login_btn($va,$o){$t=$p!=1?$p:""; 
$ret=login::form(ses('USE'),ses('iq'),$t);
if($o)$ret=divc("imgr",$ret);
return $ret;}

//menus
static function menus_r($r){$ret='';
$sty='border-left:1px dotted grey; margin:0 0 1px 0; padding-left:15px;';
foreach($r as $k=>$v){[$lk,$d]=self::submn_t($k); $ret.=divc('',lka($lk,$d));
if(is_array($v)){$ret.=divs($sty,md::menus_r($v));}}
return $ret;}//'&#9500;&#9472;'.

static function submn_t($va){[$k,$v]=cprm($va);
if(!is_numeric($k)){
	if(substr($k,0,1)=='?')return [$k,$v];
	//elseif(substr($k,0,1)=='/')return [$k,$v];
	elseif($_SESSION['line'][$v])return [htac('cat').$k,$v];
	elseif($_SESSION['line'][$k])return [htac('cat').$k,$k];
	elseif($v)return [$k,$v];
	elseif($k)return ['',$k];}
else{$tit=ma::suj_of_id($k);
	if($v)return [urlread($k),$v];
	elseif($_SESSION['line'][$k]??'')return [htac('cat').$k,$k];
	elseif($tit)return [urlread($k),picto('file').' '.$tit];
	else return [urlread($k),$k];}}//numeric name

static function bubble_menus($t,$inl=''){//mods/submenus
if(!$t)return; $nbo=0; $n="\n"; $r=explode("\n",$t.$n);
foreach($r as $n=>$k){
	$nb=substr_count(substr($k,0,9),'-'); $tit=substr($k,$nb); $tit=trim($tit);
	if($tit){[$lk,$d]=self::submn_t($tit); $cat[$nb]=$tit; $ct='';
	$ct=$cat[0]; for($i=2;$i<=$nb;$i++)$ct.='/'.$cat[$i-1];
	$isdir=substr($r[$n+1],0,1)=='-'?1:0;
	if($nb==0 && $isdir)$ret.=popbub('bubses',ajx($d),$d,'d');
	elseif($nb==0)$ret.=li(lkc('',$lk,$d));
	else $ra[]=[$d,'link','',$lk,'','',$ct,''];}}
$_SESSION['bubses']=$ra;
return mkbub($ret,$inl,1,'');}

static function mod_taxonomy($p,$o){$p=$p?$p:'taxonomy';
$r=self::collect_hierarchie_c('reverse',$o);
if($r){$ret=self::build_titl($r,$p,63);
$ret.=divc('taxonomy',md::menus_r($r));}
return $ret;}

static function rub_taxo($p,$t){$id=ses('read');
if($p==1)$p=ses('frm'); elseif($p=='art')$p=ma::ib_of_id($id);
if($p)$taxcat=supertriad_dig($p);//permanent
if($p>1){$t=lk(urlread($p),ma::suj_of_id($p)).br();
	$hie=self::collect_hierarchie_c(0,''); $taxcat=self::find_in_subarray($hie,$p);}
$t=self::build_titl($taxcat,$t,1);
if(is_array($taxcat))return $t.divc('taxonomy',md::menus_r($taxcat));}

static function taxo_arts($p){
if($p==1)$v=ses('frm'); if(!$p)$p=ma::ib_of_id(ses('read'));
$superline=self::collect_hierarchie(0);
if(!is_numeric($p))$taxcat=$superline[$p];
elseif(is_numeric($p)){$hie=self::supertriad_c(ses('dayb')); $taxcat=$hie[$p];}
return $taxcat;}

static function birthday($p){if(!$p)$p=date('d-m-Y'); $time=strtotime($p); $d=date('d-m',$time);
[$day,$month]=explode('-',$d); $day=(int)$day; $month=frdate((int)$month);
return search::call($day.' '.$month);}

static function cluster_tags($id){//arts with tags from cluster from tags from current art :)
$r=sql('idtag','qdta','rv',['idart'=>$id]); $rt=[];
$rc=sql('word,count(idtag) as nb','qdtc','rv','idtag in ('.implode(',',$r).') group by word order by nb desc');
if(isset($rc[0])){$rb=sql('idtag','qdtc','rv',['word'=>$rc[0]]);
	$r1=sql('idart,count(id) as nb','qdta','kv','idtag in ('.implode(',',$rb).') group by idart order by nb desc');}
if(isset($rc[1])){$rb=sql('idtag','qdtc','rv',['word'=>$rc[1]]);
	$r2=sql('idart,count(id) as nb','qdta','kv','idtag in ('.implode(',',$rb).') group by idart order by nb desc');}
if(isset($r1) && isset($r2)){foreach($r1 as $k=>$v)if(isset($r2[$k]))$r1[$k]+=$r2[$k]; arsort($r1);}
if(isset($r1)){$min=min($r1); $max=max($r1); foreach($r1 as $k=>$v)if($v>$min*3 && $k!=$id)$rt[$k]=$v;}
return $rt;}

static function same_tags($id){
$ra=sql('idtag','qdta','rv',['idart'=>$id]);
//$ra=sql_inner('idtag','qdt','qdta','idtag','rv',['idart'=>$id,'cat'=>'tag']);
$rb=sql('idart,count(id) as nb','qdta','kv','idtag in ('.implode(',',$ra).') group by idart order by nb desc limit 20');//and idart!="'.$id.'"
if(isset($rb[$id]))unset($rb[$id]);
return $rb;}

//sources
static function recup_src(){$r=$_SESSION['rqt']; $ret=[];
if($r)foreach($r as $k=>$v)if($v[9] && $v[9]!='mail'){$purl=domain($v[9]);
	$purl=str_replace(['.wordpress','.blogspot','.pagesperso-orange'],'',$purl);
	if($purl)$ret[$purl]=radd($ret,$purl,1);} return $ret;}

static function art_sources($o){$r=self::recup_src(); if($r){arsort($r);
foreach($r as $k=>$v){$ad=$o?' ('.$v.')':'';
$lin[]=[$k,'source',strto($k,'.'),$k.$ad];}}
return $lin;}

//tags
static function tag_mod($p,$o,$d){$nbj=ses('nbj'); if($nbj==7 or $nbj=='auto')$nbj=30;
$p=$p?$p:'tag'; $r=ma::tags_list($p,$nbj); $d=$d?$d:'lines'; $lin=[];//tags_list_nb
if($r)foreach($r as $k=>$va){if($o=='nb')$ka=$k.' ('.$va.')'; else $ka=$k;
	if($dig=get('dig'))$k.='/'.$dig;
	$lin[]=[get(eradic_acc($p)),$p,$k,$ka];}
return $lin;}

static function cluster_mod($p,$o,$d){$nbj=ses('nbj');
$r=sqb('word,count(idtag) as nb','qdtc','kv','group by word order by nb desc');
$d=$d?$d:'lines'; $lin=[];//tags_list_nb
if($r)foreach($r as $k=>$va){if($o=='nb')$ka=$k.' ('.$va.')'; else $ka=$k;
	if($dig=get('dig'))$k.='/'.$dig;
	$lin[]=[get('cluster'),'cluster',$k,$ka];}
return $lin;}

static function classtag_arts($cat){$dy='';
if(ses('nbj'))$dy=' and day<"'.ses('daya').'" AND day>"'.ses('dayb').'"';
$wh='and cat="'.$cat.'"'.$dy.' order by day desc';
return ma::artags('idart',$wh,'k');}

static function tags_cloud($p,$smin,$smax,$r=[]){
if(!$r)$r=ma::tags_list_nb($p,sesb('nbj',360)); $ret='';
if($r){arsort($r); $ratio=($smax-$smin)/log(max($r));
foreach($r as $k=>$fa){$size=round((log($fa)*$ratio)+$smin);
$ret.=lj('popbt','popup_api__3_'.$p.':'.$k,$k."&nbsp".'('.$fa.')',ats('font-size:'.$size.'px')).' ';}}
return $ret;}

static function last_tags($p,$o){$p=$p?$p:10;
$ord='order by '.ses('qdt').'.id desc limit '.$p;
if($o!='nb')$r=sqb('tag,cat','qdt','',$ord);
else $r=sql_inner('tag,cat,count(idart)','qdt','qdta','idtag','','group by idtag '.$ord);
if($r)foreach($r as $k=>$v){if($o=='nb')$n=' ('.$v[2].')';
	$lin[]=[get(eradic_acc($v[1])),$v[1],$v[0],$v[0]];}//eradic_acc()
return $lin;}

static function cat_mod($p,$o,$d){
$w='nod="'.ses('qb').'"'; $nbj=ses('nbj');
if($nbj==7 or $nbj=='auto')$w.=' and day>'.calctime(30);
$r=sql('distinct(frm)','qda','rv',$w); $d=$d?$d:'lines'; $lin=[]; $get=get('cat');
if($r)foreach($r as $k=>$v)$lin[]=[$get,'cat',$v,catpic($v,20)];//if(rstr(112))
return $lin;}

static function cat_mod_j($p,$prw,$d){$rid=randid('cats');
$w='nod="'.ses('qb').'"'; $nbj=ses('nbj'); $bt='';
if($nbj==7 or $nbj=='auto')$w.=' and day>'.calctime(30);
$r=sql('distinct(frm)','qda','rv',$w); $d=$d?$d:'lines';
if($r)foreach($r as $k=>$v)$bt.=lj(active($v,$p),$rid.'_mod,ajxlnk___'.ajx($v).'/'.$prw.'//////1:catj',catpic($v,20));
$prw=$prw?$prw:(rstr(41)?3:2);
$ret=api::arts($p,$prw,'');
return divd($rid,divc('nbp',$bt).$ret);}

static function last_search($p,$o){$ret='';
$r=sqb('id,word','qdsr','kv','order by id desc');
if($r)foreach($r as $k=>$v)$ret.=lj('','popup_search,home__3_'.$v,$v);
return divc('menus',$ret);}

static function frequent_tags($p,$o){
$ra=$p?[$p]:explode(' ',prmb(18)); $r=[];
foreach($ra as $ka=>$va){$rb=ma::tags_list_nb($va,ses('nbj')); if($rb){arsort($rb);
	foreach($rb as $kb=>$vb)$rc[$vb][]=['',$va,$kb,$kb.' ('.$vb.')'];}}
if($rc)krsort($rc);
foreach($rc as $k=>$v)foreach($v as $ka=>$va)$ret[]=$va;
return $ret;}

static function most_read($dyb,$mx=''){
$dayb=$dyb?calc_date($dyb):$_SESSION['dayb']; $mx=$mx?$mx:50;
return sql('id,lu','qda','kv','nod="'.ses('qb').'" and re>="1" and day>'.$dayb.' order by cast(lu as integer) desc limit '.$mx);}//unsigned integer

static function most_read_mod($p,$t,$d,$o,$m,$tp){
[$dyb,$mx]=explode('-',$p); $r=self::most_read($dyb,$mx); unset($r[80301]);
$ta=pop::dig_it_j($dyb,'mostread_mod,ajxlnk___VAR-'.$mx.'/'.ajx($t).'/'.$d.'/'.$o.':'.ajx($m));
$t=lkc('','/module/most_read/'.$p.'/'.$t.'/'.$d,$t!=1?$t:'most_read');
if($r)return divd('mostread',$ta.mod::mod_load($r,'',$t,$d,$o,1,$o,$tp,''));}

static function most_polled($p,$o){$qda=ses('qda'); if(!$o)$o=200;
$r=sql_inner($qda.'.id,count(poll) as nb','qda','qdf','ib','kv','order by cast(nb as integer) desc limit '.$o);
return $r;}

static function score_datas($p,$o){$qda=ses('qda'); if(!$o)$o=200;
$r=sql_inner($qda.'.id,msg','qda','qdd','ib','kv','where val="'.$p.'" order by cast(msg as integer) desc limit '.$o);
return $r;}

static function special_polls($id,$t,$o){
$n=sql('poll','qdf','v',['ib'=>$id,'type'=>$t,'iq'=>ses('iq')]);
$bt=btn('txtcadr',$t.' ['.str_replace('|',', ',$o).']');
$ret=art::favs_polls($id,$n,$t);
return $bt.divd($t.$id,$ret);}

static function quality_stats($id,$t,$o){//dev
return $id.'-'.$t.'-'.$o.br();}

static function short_arts($p=4000){$dayb=$dyb?calc_date($dyb):$_SESSION['dayb'];
return sql('id','qda','k','nod="'.ses('qb').'" AND re>="1" AND day>'.$dayb.' AND host<'.$p.' ORDER BY '.prmb(9));}

static function trkarts($p,$t,$d,$o,$rch=''){//see also api cmd:tracks
$qda=ses('qda'); $qdi=ses('qdi'); $pg=$o?$o:1; $tri=$d==1?$qdi:$qda;
$p=get('dig',$p); $p=is_numeric($p)?$p:ses('nbj'); if(!$p)$p=30; $np=time_prev($p);
if($rch)$w=' and msg like "%'.$rch.'%"';
else{$w=' and '.$tri.'.day>'.calc_date($p); if($p!=7 && $p!=1)$w.=' and '.$tri.'.day<'.calc_date($np);}
if(!auth(6))$w.=' and '.$qda.'.re>"0" and '.$qdi.'.re="1"';
$r=sql_inner($qdi.'.id,'.$qdi.'.ib','qda','qdi','ib','kv','where '.$qda.'.nod="'.ses('qb').'"'.$w.' and substring('.$qda.'.frm,1,1)!="_" order by '.$qdi.'.day desc');
if(!$d)$r=array_flip($r);//permut k and v in output_arts_trk
$bt=lj('txtbox','modtrk_mod,ajxlnk___'.$p.'/'.ajx($t).'/'.yesno($d).'/'.$o.':tracks',nmx([185,$d?22:2]));
$bt.=inputj('trkrch',$rch,'modtrk_md,trkrch_trkrch__'.ajx($t));
$ret=self::build_titl($r,$t?$t:'Tracks',1,$bt);
if(auth(6))$ret.=pop::dig_it_j($p,'modtrk_mod,ajxlnk___VAR/'.ajx($t).'/'.$d.'/:tracks').br();
$j='modtrk_md,trkmod___'.$p.'_'.$t.'_'.$d.'_';//$j='modtrk_mod,ajxlnk___'.$p.'/'.$t.'//VAR:tracks';
if($r)$ret.=self::output_arts_trk($r,$d,$pg,$j,1,($d?'desc limit 1':'asc'));//
return divd('modtrk',$ret);}

static function trkrch($g1,$g2,$prm){return self::trkarts('',$g1,'','',$prm[0]??'');}
static function trkmod($g1,$g2,$g3,$g4){return mod::mkmods(['tracks',$g1,$g2,'',$g3,$g4]);}

static function output_arts_trk($r,$mode,$page,$j,$re,$ord){
$npg=prmb(6); $ret=''; $min=($page-1)*$npg; $max=$page*$npg; $i=0;
if($r)foreach($r as $k=>$v){$id=$mode?$v:$k;
	if(is_numeric($id)){$i++;
	if($i>=$min && $i<$max){
		$rt=ma::read_idy($id,$ord,'',$re,$mode?$k:'');
		$ret.=art::playt($id,$rt,'');}}}
$nbpg=pop::btpages($npg,$page,$i,$j);
return $nbpg.$ret;}

static function related_art($id){if(!$id)$id=ses('read');
$d=sql('msg','qdd','v','val="related" and ib="'.$id.'"');
if($d)return array_flip(explode(' ',$d));}

static function related_by($id){if(!$id)$id=ses('read');//msg like "%'.ses('read').'%"');
return sql('ib','qdd','k','val="related" and (msg="'.$id.'" or msg like "'.$id.' %" or msg like "% '.$id.'")');}

static function child_art($id){if(!$id)$id=ses('read');
return sql('id','qda','k','ib="'.$id.'"');}

static function parent_art($id){if(!$id)$id=ses('read');
return sql('ib','qda','k','id="'.$id.'"');}

static function same_title($id){if(!$id)$id=ses('read');
return sql('id','qda','k','suj="'.$id.'" and nod="'.ses('qb').'" and id!="'.$id.'" order by id desc');}

static function call_context($cntx){$r=$_SESSION['mods']; $ret='';//context as module
if($r)foreach($r as $k=>$v)foreach($v as $ka=>$va)if($va[7]!=1 && $va[3]==$cntx)$ret.=mod::mkmods($va);
return $ret;}

static function see_also_rub($p){$frm=$p!=1?$p:$_SESSION['frm'];
$frmline=ma::tri_rqb($frm,'frm','frm');
return $frmline[$frm];}

static function see_also($r,$p,$d='',$o='',$tp=''){
foreach($r as $kb=>$pb){$t=lk(htac(eradic_acc($p)).$kb,$kb);
	if($pb)$rc[$kb]=mod::mod_load($pb,'',$t,$d,$o,0,'',$tp,'','');}
if(count($rc)>1)$ret=make_tabs($rc,randid('mod')); else $ret=$rc[$kb];
return $ret;}

static function see_also_tags($cat,$nbdays='30'){$id=ses('read');
$r=ses('artags'); $r=$r?$r:ma::art_tags($id); $rtag=val($r,$cat); $ret=[];
if($rtag)foreach($rtag as $tag=>$v){$ret[$tag]=[];
	$r=ma::tag_arts($tag,$cat,$nbdays); if(!$r)$r=ma::tag_arts($tag,$cat);
	if($r)foreach($r as $k=>$v)if($k!=$id)$ret[$tag][$k]=radd($ret[$tag],$k);}
return $ret;}

static function see_also_source($o=''){$o=$o?$o:10;
$id=ses('read'); $src=$_SESSION['rqt'][$id][9];
if(!$src)$src=sql('mail','qda','v','id='.ses('read'));
if($src){$src=preplink($src);
$r=$_SESSION['rqt']; $ret=[];
if($r)foreach($r as $k=>$v)if(preplink($v[9])==$src)$ret[$k]=radd($ret,$k);
if(!$ret && $src)$ret=sql('id','qda','k','mail like "%'.$src.'%" limit '.$o);
if($ret){unset($ret[$id]);
return [$ret,lk(htac('source').strto($src,'.'),$src)];}}}

static function siteclics($src){
$id=ses('read'); if($id)$src=$_SESSION['rqt'][$id][9];
$r=sql('lu','qda','rv','mail like "%'.$src.'%"');
foreach($r as $k=>$v)$n+=$v;
return balb('h3',$src).divc('',$n.' vues');}

static function rub_tags($cat){
$dayb=get('dig')?calc_date(get('dig')):ses('dayb');
$r=ma::tags_list($cat,$dayb,$_SESSION['frm']);
if($r)$tags=slct_menus($r,htac('rub_tag'),get('rub_tag'),'active','','k');
return divc('nbp',$tags);}

static function apichan($p,$t,$o,$tp){if(!$p)$p=1; $ret='';
$r=msql_read('',nod('apichan_'.$p),'',1);//api,button,icon,color,hide
if($r)foreach($r as $k=>$v)if(!$v[4])$ret.=lj('','apichan_api___'.ajx($v[0]),pictxt($v[2],$v[1],36),ats('background-color:#'.$v[3]));
return divc('apichan',$ret).divd('apichan','');}

static function cover($p,$o,$tp){
if(is_numeric($p))$p='id:'.$p; $r=api::mod_arts_row($p); //$ra=explode_k($p,',',':');
$ra['cmd']='panel'; $ra['template']=$tp?$tp:val($ra,'template','cover');//panart
if($p)return api::build($r,$ra);}

static function collect_board($prm){
$frm=$_SESSION['frm']; $dad=($_SESSION["daya"]-86400);
$thr=ma::tri_rqt('4','lu'); $two=ma::tri_rqt('3','lu'); $one=ma::tri_rqt('2','lu');
if($two){if($one)$one+=$two; else $one=$two;}
if($one){foreach($one as $id=>$nb){
	if($_SESSION['rqt'][$id][1]==$frm or $frm=='Home'){
		if($_SESSION['rqt'][$id][0]>=$dad){$v=mod::pub_art($id); if($v)$re[$id]=$v;}}}
if($re){krsort($re); $ret.=self::build_titl($re,'24h',1);
$ret.=pop::columns($re,$prm,'board','').br();}}
if($two){$re=""; foreach($two as $id=>$nb){
	if($_SESSION['rqt'][$id][1]==$frm or $frm=='Home'){
		if($_SESSION['rqt'][$id][0]<$dad){$v=mod::pub_art($id); if($v)$re[$id]=$v;}}}
if($re){krsort($re); $ret.=self::build_titl($re,nbof($_SESSION['nbj'],3),1);
	$ret.=pop::columns($re,$prm,'board','pubart').br();}}
if($thr){$re=""; foreach($thr as $id=>$nb){
	if($_SESSION['rqt'][$id][1]==$frm or $frm=='Home'){
		$v=mod::pub_art($id); if($v)$re[$id]=$v;}}
	if($re){krsort($re); $ret.=self::build_titl($re,'***',1);
	$ret.=pop::columns($re,$prm,'board','pubart').br();}}
if($ret){return $ret;}}

static function bridge($p,$t){
ses::$urlsrc=$p='http://'.$p.'/'.ajx($t,1);
$rea=conv::vacuum($p,''); $po['suj']=$rea[0];
$po['msg']=conn::read($rea[1],3,'');
$po['source']=picto('link').' '.art::pub_link($p);
return art::template($po,'');}

//m_suj
static function m_suj_r($r,$cs1,$cs2){
$id=ses('read'); $ret='';
foreach($r as $k=>$v){
$csb=$id==$k?$cs1:$cs2;
$ret.=llk($csb,urlread($k),'â?¢ '.ma::suj_of_id($k));
if(is_array($v)){
	if($id==$k or self::verif_array_exists_s($id,$v)){
		foreach($v as $ka=>$va){$csc=$id==$ka?$cs1:$cs2;
		$ret.=llk($csc,urlread($ka),'-- '.ma::suj_of_id($ka));}}}}
return $ret;}

static function suj_hierarchic($cs1,$cs2){
$rb=self::collect_hierarchie($rev); $ret='';
if($rb)foreach($rb as $k=>$v){
$csb=$_SESSION['frm']==$k?$cs1:$cs2;
$ret.=llk($csb,htac('cat').$k,$k);
if($_SESSION['frm']==$k && is_array($v))$ret.=m_suj_r($v,$cs1,$cs2);}
return $ret;}

static function nodes($mn,$o){//arsort($mn);
if($o)$nb=sql('name,nbarts','qdu','kr','active="1"'); $ret='';
if($mn)foreach($mn as $k=>$v){$css=$k==ses('qb')?'active':'';
	if($o)$add=' ('.$nb[$k][0].')'; if(!$v && $k)$v=$k;
	if($k)$r[]=llk($css,subdomain($k),$v.$add);}//#li
return $r;}

static function m_nodes_b($mn,$o){
return scroll($mn,implode('',self::nodes($mn,$o)),20);}

#hierarchies
static function verif_array_exists_s($v,$r){foreach($r as $ka=>$va)if($ka==$v)return true;}
static function find_in_subarray($r,$d){foreach($r as $k=>$v){if($k==$d)$ret=$v;
if(is_array($v) && !$ret)$ret=self::find_in_subarray($v,$d);} if($ret)return $ret;}

static function hierarchic_line($r,$line,$rev){$ret=[];
foreach($r as $k=>$v){
	if(is_array($v)){if(in_array_k($k,$line)!=true)$ret[$k]=self::hierarchic_line($v,$line,$rev);}
	elseif($lv=val($line,$v))$ret[$k]=self::hierarchic_line($lv,$line,$rev);
	elseif($lk=val($line,$k))$ret[$k]=self::hierarchic_line($lk,$line,$rev);
	else $ret[$k]=$v;}
if($rev && $ret)krsort($ret);
return $ret;}

static function supertriad(){//descend
if(is_array($_SESSION['rqt']))foreach($_SESSION['rqt'] as $k=>$v)
	if($v[10] && is_numeric($v[10]))$line[$v[1]][$v[10]][$k]=$v[2];
return $line;}

static function collect_hierarchie($rev){//by_cat
$rb=$_SESSION['line']; $r=self::supertriad();
if(is_array($r))foreach($r as $k=>$v)$rb[$k]=self::hierarchic_line($v,$v,$rev);
if($rev && $rb)ksort($rb);
return $rb;}

static function supertriad_b(){//descend
if(is_array($_SESSION['rqt']))foreach($_SESSION['rqt'] as $k=>$v)
if(is_numeric($v[10]))$line[$k][$v[10]][$k]=1;
return $line;}

static function collect_hierarchie_b($rev){//append
$r=self::supertriad_b(); if(is_array($r)){
	foreach($r as $k=>$v)$rb[$k]=self::hierarchic_line($v,$v,$rev);
	ksort($rb);}
return $rb;}

static function supertriad_c($d,$p=''){//descend
if($p=='Home'||$p=='user')$p='';
if($r=$_SESSION['rqt'])foreach($r as $k=>$v){
	if($v[10]>0 && (!$p or $v[1]==$p))$line[$v[10]][$k]=1;}
return $line;}

static function collect_hierarchie_c($rev,$o){//no_cat
$r=self::supertriad_c($o?$o:$_SESSION['dayb']);
if(is_array($r)){$rb=self::hierarchic_line($r,$r,$rev);}
if(is_array($rb)){if($rev)krsort($rb); else ksort($rb);}
return $rb;}

static function supertriad_ask($p,$o){
if(!is_numeric($p) or !$p)$p=ses('nbj'); if(!$p)$p=90;
$r=sql('id,ib','qda','kv','day>'.calctime($p)); $rb=[];
if(is_array($r))foreach($r as $k=>$v)if($v>0)$rb[$v]=radd($rb,$v);
if(is_array($rb))arsort($rb);
return $rb;}

static function supermenu($r){static $i; $i++;
if(is_array($r))foreach($r as $k=>$v){$ret.=nchar($i,"-");
	if(is_array($v))$ret.=$k.n().md::supermenu($v); else $ret.=$k.n();} $i--;
return $ret;}

//adm
static function modsee($id,$va){$u='';
$r=msql::row('',ses('modsnod'),$id); $rb=array_shift($r);
if(!$va)return mod::mkmods($r);
for($i=1;$i<12;$i++)if($i!=3)$u.=$r[$i].'/';//not use condition
$ret=divc('txtcadr','connector');
$ret.=str_replace(['/////:','////:','///:','//:','/:'],':',$u.':'.$r[0]).':module';
$ret.=divc('txtcadr','url');
$ret.='/module/'.$r[0].'/'.str_replace(',',';',$r[1]).'/'.$r[2].'/'.$r[4].'/'.$r[5]; //$lk=strto($lk,'§');
$ret.=divc('txtcadr','lj').'_mod,mkmodr___'.ajx($r[1]).'/'.ajx($r[2]).'/'.ajx($r[4]).'/'.$r[5].':'.$r[0];
return $ret;}

static function modj($id,$va){return mod::mkmods($_SESSION['modc'][$va][$id]);}
static function about(){ses::$r['popt']=nms(80); return conn::parser(helps('philum_pub_txt'));}

}
?>