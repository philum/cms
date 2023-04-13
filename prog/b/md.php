<?php //md for modules
class md{

#commands
static function title($load,$t,$n='',$bt=''){$nb='';
$na=$load?count_r($load):''; if($na)$nb=btn('small',nbof($na,$n?$n:1)).' ';
return divd('titles',btn('txtcadr',$t).' '.$nb.$bt);}//pictxt('eye',)

static function art_viewer($r){$rid=randid('artv');
$id=key($r); $ret=art::playb($id,2); $i=0; $m='';
if(count($r)>1)foreach($r as $k=>$v){$i++; $m.=lj('',$rid.'_art,playb___'.$k.'_2',$i);}
return divc('nbp',$m).divd($rid,$ret);}

static function recents_arts($d,$o){
$o=is_numeric($o)?$o:10;
$wh['nod']=ses('qb');//slowlog
if($d=='auto')$wh['frm']=get('frm');
elseif($d!='all' && $d!=1 && $d)$wh['frm']=$d;
return sql('id','qda','k',$wh+['>=re('=>'1','_order'=>'id desc','_limit'=>$o]);}

static function pub_art_b($id,$t,$o){
[$dy,$frm,$suj,$amg]=ma::pecho_arts($id);
if(rstr(32))$img=minimg($amg,'hb'); $lnk=urlread($id);
return tagb('h2',lkc('',$lnk,$suj)).divc('panel',ma::read_msg($id,$o?$o:2));}

static function pub_img($id){
[$dy,$frm,$suj,$amg]=$_SESSION['rqt'][$id];
if(!$dy){$amg=sql('img','qda','v',$id);}
return lkc('',urlread($id),minimg($amg,'ban'));}

static function read_art($n,$t,$o){$in=ma::read_msg($n,'');
if(strlen($in)>1000)$nbc=['1','1']; $ret='';
if(is_numeric($n))$tit=ma::suj_of_id($n); else $tit=$n;
if($o)$in=scroll($nbc,$in,0);
if($t)$ret=divc('txtcadr',$t==1?$tit:$t);
$ret.=divc('panel',$in);
if(trim($in))return $ret;}

static function friend_rub($o){
$id=ma::id_of_suj(get('frm')); if(!$id)return;
$ok=sql('id','qda','v',['id'=>$id,'>re'=>'0']); if(!$ok)return;
$ret=sql('msg','qdm','v',$ok);
if(auth(4))$bt=ma::popart($id);
return divc($o,$bt.conn::read($ret,'',''));}

static function friend_art($o){$id=ses('read');
if($id){$id=ma::id_of_suj($id); $in=ma::read_msg($id,1,'');}
if(is_numeric($id))return divc($o,$in);}

static function timetravel_m(){$r=pop::timetravel();
$travel=date('Y',ses('daya')); $ret='';
foreach($r as $k=>$v){$c=$k==$travel?'active':''; $ic=$travel==$k?'clock':'hour'; $yr=date('Y',$v);
	$ret.=lj('','content_api___maxtime:'.$v.',t:'.$yr,pictxt($ic,$yr));}
return divc('menus',$ret);}

static function prevnext_art($b,$o,$id,$tg=''){$wh=''; $rb=[];
$id=$id?$id:ses('read'); $ta=picto('left'); $tb=picto('right'); $htacc=htacc('read');
if($b=='rub')$wh='and frm="'.get('frm').'" '; else $wh='and substring(frm,1,1)!="_"';
$ord=strtolower(prmb(9)); $col=strto($ord,' ');
$w='and nod="'.ses('qb').'" and re>"0" '.$wh;
if($col=='day'){$dy=sql('day','qda','v',$id); $w1='day<"'.$dy.'"'; $w2='day>"'.$dy.'"';}
else{$w1='id<"'.$id.'"'; $w2='id>"'.$id.'"';}
$k1=sql('id','qda','v',$w1.' '.$w.' order by '.$col.' desc limit 1');
$k2=sql('id','qda','v',$w2.' '.$w.' order by '.$col.' asc limit 1');
if(!rstr(8)){$ret=lkc($k1?'':'hide',$htacc.$k1,$ta).''.lkc($k2?'':'hide',$htacc.$k2,$tb);}
else{
	if($tg)$j='pagup_popart__x_'; elseif($o)$j='popup_popart__x_'; else $j='content_mod,playmod__u_read_';
	$ret=!$k1?btn('hide',$ta):lj('',$j.$k1,$ta);
	$ret.=!$k2?btn('hide',$tb):lj('',$j.$k2,$tb);}
if(!$o)return btn('nbp right',$ret);
return $ret;}

static function login_btn($p,$o){$t=$p!=1?$p:""; 
$ret=login::form(ses('USE'),ses('iq'),$t);
if($o)$ret=divc("imgr",$ret);
return $ret;}

//submenus
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
if(!$t)return; $nbo=0; $n="\n"; $r=explode("\n",$t.$n); $ret='';
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
if($r){$ret=self::title($r,$p,63);
$ret.=divc('taxonomy',md::menus_r($r));}
return $ret;}

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
$ra=sql('idtag','qdta','rv',['idart'=>$id]); $rb=[];
//$ra=sql::inner('idtag','qdt','qdta','idtag','rv',['idart'=>$id,'cat'=>'tag']);
if($ra)$rb=sql('idart,count(id) as nb','qdta','kv',['idtag in ('.implode(',',$ra).') group by idart order by nb desc limit 20'],0);//and idart!="'.$id.'"
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
$r=sql('word,count(idtag) as nb','qdtc','kv',['_group'=>'word','_order'=>'nb desc']);
$d=$d?$d:'lines'; $lin=[];//tags_list_nb
if($r)foreach($r as $k=>$va){if($o=='nb')$ka=$k.' ('.$va.')'; else $ka=$k;
	if($dig=get('dig'))$k.='/'.$dig;
	$lin[]=[get('cluster'),'cluster',$k,$ka];}
return $lin;}

static function classtag_arts($cat){$dy='';
if(ses('nbj'))$dy=' and day<"'.ses('daya').'" and day>"'.ses('dayb').'"';
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
else $r=sql::inner('tag,cat,count(idart)','qdt','qdta','idtag','','group by idtag '.$ord);
if($r)foreach($r as $k=>$v){if($o=='nb')$n=' ('.$v[2].')';
	$lin[]=[get(eradic_acc($v[1])),$v[1],$v[0],$v[0]];}//eradic_acc()
return $lin;}

//todo:unify
static function cat_mod($p,$o,$d){
$w='nod="'.ses('qb').'"'; $nbj=ses('nbj');
if($nbj==7 or $nbj=='auto')$w.=' and day>'.calctime(30);
$r=sql('distinct(frm)','qda','rv',$w); $d=$d?$d:'lines'; $lin=[]; $get=get('cat');
if($r)foreach($r as $k=>$v)$lin[]=[$get,'cat',$v,catpic($v,20)];//if(rstr(112))
return $lin;}

static function cat_mod_j($p,$prw,$d,$tp){$rid=randid('cats');
$w='nod="'.ses('qb').'"'; $nbj=ses('nbj'); $bt='';
if($nbj==7 or $nbj=='auto')$w.=' and day>'.calctime(30);
$r=sql('distinct(frm)','qda','rv',$w); $d=$d?$d:'lines';
if($r)foreach($r as $k=>$v)//active($v,$p)
	$bt.=lj('',$rid.'_mod,callmod___m:category,p:'.ajx($v).',d:'.$prw.',tp:'.$tp,catpic($v,20));
$prw=$prw?$prw:(rstr(41)?3:2);
$ret=api::arts($p,$prw,'');
return divc('nbp',$bt).divd($rid,$ret);}

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
$dayb=$dyb?timeago($dyb):$_SESSION['dayb']; $mx=$mx?$mx:50;
return sql('id,lu','qda','kv','nod="'.ses('qb').'" and re>="1" and day>'.$dayb.' order by cast(lu as integer) desc limit '.$mx);}//unsigned integer

static function most_polled($p,$o){$qda=ses('qda'); if(!$o)$o=200;
$r=sql::inner($qda.'.id,count(poll) as nb','qda','qdf','ib','kv','order by cast(nb as integer) desc limit '.$o);
return $r;}

static function score_datas($p,$o){$qda=ses('qda'); if(!$o)$o=200;
$r=sql::inner($qda.'.id,msg','qda','qdd','ib','kv',['val'=>$p,'_order'=>'cast(msg as integer) desc','_limit'=>$o]);
return $r;}

static function special_polls($id,$t,$o){
$n=sql('poll','qdf','v',['ib'=>$id,'type'=>$t,'iq'=>ses('iq')]);
$bt=btn('txtcadr',$t.' ['.str_replace('|',', ',$o).']');
$ret=art::favs_polls($id,$n,$t);
return $bt.divd($t.$id,$ret);}

static function quality_stats($id,$t,$o){//dev
return $id.'-'.$t.'-'.$o.br();}

static function short_arts($p=4000){$dayb=$p?timeago($p):ses('dayb');
return sql('id','qda','k',['nod'=>ses('qb'),'>=re'=>'1','>day'=>$dayb,'<host'=>$p,'_order'=>prmb(9)]);}

static function home_plan($load){
if(!$load)return; ksort($load); $i=0; $ret=[];
foreach($load as $cat=>$ids){$i++;
	$line=sesr('line',$cat); $mn=sesr('mn',$cat);
	$re=img::outputimg($ids);
	if($cat!='_system' && $re && ($line or $mn)){
		if($line)$got=htac('cat').$cat; else $got=subdomain($cat);
	$nbt=btn('small',nbof(count($ids),1));
	$ret[$i]=lkc('txtcadr',$got,$cat).' '.$nbt.br();
	$ret[$i].=divc('tab',scroll($ids,$re,10,'',280)).br();}}
if($ret)return pop::columns($ret,1,'board','pubart');}

static function gallery($p,$o=''){$load=[];
$r=sql('frm,id,img','qda','kkv','nod="'.ses('qb').'" and re>"0" and lg="'.ses('lng').'"');
foreach($r as $ka=>$va)foreach($va as $k=>$v)if($v){$rb=explode('/',$v);
	if($rb)foreach($rb as $vb)if($vb && !is_numeric($vb)){
		$f='img/'.$vb; $s=is_file($f)?filesize($f):0;
		if($s>20480 or ($o && $s<20480))$load[$ka][$k][]=$vb;}}
if($load)$ret=self::home_plan($load);
if($rb)return md::title($load,'Gallery',61).$ret;}

static function trkarts($p,$t,$d,$o,$rch=''){//see also api cmd:tracks
$qda=ses('qda'); $qdi=ses('qdi'); $pg=$o?$o:1; $tri=$d==1?$qdi:$qda;
$p=get('dig',$p); $p=is_numeric($p)?$p:ses('nbj'); if(!$p)$p=30; $np=time_prev($p);
if($rch)$w=' and msg like "%'.$rch.'%"';
else{$w=' and '.$tri.'.day>'.timeago($p); if($p!=7 && $p!=1)$w.=' and '.$tri.'.day<'.timeago($np);}
if(!auth(6))$w.=' and '.$qda.'.re>"0" and '.$qdi.'.re="1"';
$r=sql::inner($qdi.'.id,'.$qdi.'.ib','qda','qdi','ib','kv',$qda.'.nod="'.ses('qb').'"'.$w.' and substring('.$qda.'.frm,1,1)!="_" order by '.$qdi.'.day desc');
if(!$d)$r=array_flip($r);//permut k and v in output_arts_trk
$j='modtrk_mod,callmod___m:tracks,p:'.$p.',t:'.ajx($t).',d:'.yesno($d).',o:'.$o;
$bt=lj('txtbox',$j,nmx([185,$d?22:2]));
$j='modtrk_md,trkrch_trkrch__'.ajx($t);
$bt.=inputj('trkrch',$rch,$j);
$ret=self::title($r,$t?$t:'Tracks',1,$bt);
if(auth(6))$ret.=pop::dig_it_j($p,'modtrk_mod,callmod___m:tracks,p:VAR,t:'.ajx($t).',d:'.$d).br();
$j='modtrk_md,trkmod___'.$p.'_'.$t.'_'.$d.'_';
if($r)$ret.=self::output_arts_trk($r,$d,$pg,$j,1,($d?'desc limit 1':'asc'));//
return divd('modtrk',$ret);}

static function trkrch($g1,$g2,$prm){return self::trkarts('',$g1,'','',$prm[0]??'');}
static function trkmod($g1,$g2,$g3,$g4){return mod::build(['tracks',$g1,$g2,'',$g3,$g4]);}

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
$d=sql('msg','qdd','v',['val'=>'related','ib'=>$id]);
if($d)return array_flip(explode(' ',$d));}

static function related_by($id){if(!$id)$id=ses('read');//msg like "%'.ses('read').'%"');
return sql('ib','qdd','k','val="related" and (msg="'.$id.'" or msg like "'.$id.' %" or msg like "% '.$id.'")');}

static function child_arts($id){if(!$id)$id=ses('read');
return sql('id','qda','k',['ib'=>$id]);}

static function parent_art($id){if(!$id)$id=ses('read');
return sql('ib','qda','k',['id'=>$id]);}

static function same_title($id){if(!$id)$id=ses('read');
return sql('id','qda','k',['suj'=>$id,'nod'=>ses('qb'),'!id'=>$id,'_order'=>'id desc']);}

static function call_context($cntx){$r=$_SESSION['mods']; $ret='';//context as module
if($r)foreach($r as $k=>$v)foreach($v as $ka=>$va)if($va[7]!=1 && $va[3]==$cntx)$ret.=mod::build($va);
return $ret;}

static function see_also_rub($p){$frm=$p!=1?$p:get('frm');
$frmline=ma::tri_rqb($frm,'frm','frm');
return $frmline[$frm];}

static function see_also($r,$p,$d='',$o='',$tp=''){
foreach($r as $kb=>$pb){$t=lk(htac(eradic_acc($p)).$kb,$kb);
	if($pb)$rc[$kb]=mod::mod_load($pb,$t,$d,$o,0,'',$tp,'','');}
if(count($rc)>1)$ret=tabs($rc,randid('mod')); else $ret=$rc[$kb];
return $ret;}

static function see_also_tags($cat,$nbdays='30'){$id=ses('read');
$r=ma::art_tags($id); $rtag=val($r,$cat); $ret=[];//ses artag
if($rtag)foreach($rtag as $tag=>$v){$ret[$tag]=[];
	$r=ma::tag_arts($tag,$cat,$nbdays); if(!$r)$r=ma::tag_arts($tag,$cat);
	if($r)foreach($r as $k=>$v)if($k!=$id)$ret[$tag][$k]=radd($ret[$tag],$k);}
return $ret;}

static function see_also_source($o=''){$o=$o?$o:10;
$id=ses('read'); $src=$_SESSION['rqt'][$id][9];
if(!$src)$src=sql('mail','qda','v',ses('read'));
if($src){$src=preplink($src);
$r=$_SESSION['rqt']; $ret=[];
if($r)foreach($r as $k=>$v)if(preplink($v[9])==$src)$ret[$k]=radd($ret,$k);
if(!$ret && $src)$ret=sql('id','qda','k','mail like "%'.$src.'%" limit '.$o);
if($ret){unset($ret[$id]);
return [$ret,lk(htac('source').strto($src,'.'),$src)];}}}

static function siteclics($src){$n=0;
$id=ses('read'); if($id)$src=$_SESSION['rqt'][$id][9];
$r=sql('lu','qda','rv','mail like "%'.$src.'%"');
foreach($r as $k=>$v)$n+=$v;
return tagb('h3',$src).divc('',$n.' vues');}

static function rub_tags($cat){
$dayb=get('dig')?timeago(get('dig')):ses('dayb');
$r=ma::tags_list($cat,$dayb,get('frm'));
if($r)$tags=slctmnu($r,htac('rub_tag'),get('rub_tag'),'active','','k');
return divc('nbp',$tags);}

static function apichan($p,$t,$o,$tp){if(!$p)$p=1; $ret='';
$r=msql::read('',nod('apichan_'.$p),'',1);//api,button,icon,color,hide
if($r)foreach($r as $k=>$v)if(!$v[4])$ret.=lj('','apichan_api___'.ajx($v[0]),pictxt($v[2],$v[1],36),ats('background-color:#'.$v[3]));
return divc('apichan',$ret).divd('apichan','');}

static function cover($p,$o,$tp){
if(is_numeric($p))$p='id:'.$p; $r=api::mod_arts_row($p); //$ra=explode_k($p,',',':');
$ra['cmd']='panel'; $ra['template']=$tp?$tp:val($ra,'template','cover');//panart
if($p)return api::build($r,$ra);}

static function bridge($p,$t){
ses::$urlsrc=$p='http://'.$p.'/'.ajx($t,1);
$rea=conv::vacuum($p,''); $po['suj']=$rea[0];
$po['msg']=conn::read($rea[1],3,'');
$po['source']=picto('link').' '.art::pub_link($p);
return art::template($po,'');}

static function modlk($p,$t,$o=''){
if(is_numeric($p)){$u='/'.$p; $ic='article';}
elseif(sesr('line',$p)){$u='/cat/'.$p; $ic=catpic($p,20);}
elseif($p=='home'){$u='/home'; $ic='home';}
if($o)$t=pictxt($ic,$t);
return lh('/'.$p,$t);}

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
$rb=self::collect_hierarchie(''); $frm=get('frm'); $ret='';
if($rb)foreach($rb as $k=>$v){
$csb=$frm==$k?$cs1:$cs2;
$ret.=llk($csb,htac('cat').$k,$k);
if($frm==$k && is_array($v))$ret.=m_suj_r($v,$cs1,$cs2);}
return $ret;}

static function nodes($mn,$o){//arsort($mn);
if($o)$nb=sql('name,nbarts','qdu','kr','active="1"'); $ret='';
if($mn)foreach($mn as $k=>$v){$css=active($k,ses('qb'));
	if($o)$add=' ('.$nb[$k][0].')'; if(!$v && $k)$v=$k;
	if($k)$r[]=llk($css,subdomain($k),$v.$add);}//#li
return $r;}

static function m_nodes_b($mn,$o){
return scroll($mn,implode('',self::nodes($mn,$o)),20);}

#hierarchies
static function verif_array_exists_s($v,$r){foreach($r as $ka=>$va)if($ka==$v)return true;}
static function find_in_subarray($r,$d){$rt=[]; foreach($r as $k=>$v){if($k==$d)$rt=$v;
if(is_array($v) && !$rt)$rt=self::find_in_subarray($v,$d);} return $rt;}

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

static function collect_hierarchie_b($rev){$rt=[];//append
$r=self::supertriad_b(); if(is_array($r)){
	foreach($r as $k=>$v)$rt[$k]=self::hierarchic_line($v,$v,$rev);
	ksort($rt);}
return $rt;}

static function supertriad_c($d,$p=''){$rt=[];//descend
if($r=$_SESSION['rqt'])foreach($r as $k=>$v){
	if($v[10]>0 && (!$p or $v[1]==$p))$rt[$v[10]][$k]=1;}
return $rt;}

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

static function supermenu($r){static $i; $i++; $ret='';
if(is_array($r))foreach($r as $k=>$v){$ret.=nchar($i,"-");
	if(is_array($v))$ret.=$k.n().md::supermenu($v); else $ret.=$k.n();} $i--;
return $ret;}

//adm
static function modsee($id){
$r=msql::row('',ses('modsnod'),$id); array_shift($r);
$rb=mod::mkcmd('',$r,1); return implode_k($rb,',',':');}

static function modj($id,$va){return mod::build($_SESSION['modc'][$va][$id]);}
static function about(){ses::$r['popt']=nms(80); return conn::parser(helps('philum_pub_txt'));}
}
?>