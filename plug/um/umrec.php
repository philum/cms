<?php //umrec
class umrec{
static $cats=['O6'=>'Oaxiiboo 6','OW'=>'Oolga Waam','OT'=>'Oomo Toa','OAY'=>'Oyagaa Ayoo Yissaa','312oay'=>'312oay','UM'=>'Unio Mentalis'];

static function cats($p){$r=self::$cats;
return $p=='All'?implode('","',$r):$r[$p];}

static function req_arts_c($p){$w=self::cats($p);
return sql('count(id)','qda','v','frm in ("'.$w.'")');}

static function req_last($p='All'){$w=self::cats($p);
return sql('id','qda','v','frm in ("'.$w.'") order by day desc limit 1');}

static function req_arts_y($p,$pg,$cat){$nbp=prmb(6);
if($pg!='all' && is_numeric($pg))$limit='limit '.(($pg-1)*20).',20'; else $limit='';//limit 10
$qda=ses('qda'); $qdm=ses('qdm'); $qdi=ses('qdi');
$wh=$qda.'.frm in ("'.self::cats($p).'") and '.$qda.'.re>1';
$sql='select '.$qda.'.id,'.$qda.'.day,'.$qda.'.suj,'.$qdm.'.msg,'.$qda.'.mail,lg,'.$qda.'.re from '.$qda.' inner join '.$qdm.' on '.$qdm.'.id='.$qda.'.id where '.$wh.' order by day desc '.$limit;
return sql::call($sql,'',0);}

static function req_arts_y2($p,$pg,$lg=''){$nbp=prmb(6);
if($pg!='all' && is_numeric($pg))$limit='limit '.(($pg-1)*20).',20'; else $limit='';//limit 10
$qda=ses('qda'); $qdm=ses('qdm'); $qdi=ses('qdi'); $ynd=ses('ynd');
if($lg=='all')$lg='(case '.$qda.'.lg when \'\' then \'fr\' else '.$qda.'.lg end)'; else $lg='"'.$lg.'"';
$in='inner join '.$ynd.' on ref=concat(\'art\','.$qda.'.id) and lang='.$lg.'';
//$in2='inner join pub_trk on pub_trk.ib=pub_art.id ';
$wh=$qda.'.frm in ("'.self::cats($p).'") and '.$qda.'.re>1';
$sql='select '.$qda.'.id,'.$qda.'.day,'.$qda.'.suj,txt as msg,'.$qda.'.mail,lg,'.$qda.'.re from '.$qda.' '.$in.' where '.$wh.' group by '.$qda.'.id order by day desc '.$limit.'';
return sql::call($sql,'',0);}

static function req_art_id($id){$nbp=prmb(6);
$qda=ses('qda'); $qdm=ses('qdm'); $qdi=ses('qdi');
$sql='select '.$qda.'.id,'.$qda.'.day,'.$qda.'.suj,'.$qdm.'.msg,'.$qda.'.mail,lg from '.$qda.' inner join '.$qdm.' on '.$qdm.'.id='.$qda.'.id where '.$qda.'.id='.$id.' and re>1 order by day asc';
return sql::call($sql,'r','0');}

static function req_arts_tag($id){
$qdt=$_SESSION['qdt']; $qdta=$_SESSION['qdta'];
$sql='select tag from '.$qdt.' inner join '.$qdta.' on '.$qdt.'.id='.$qdta.'.idart
where '.$qdta.'.idart="'.$id.'" and re>1';
return sql::call($sql,'');}

//select lang
static function slctlng($id,$rid,$lng,$lg,$mode){
$r=explode(' ',prmb(26)); //if($lng=='all')$lng=$lg;
$ret=lj($lg==$lng?'active':'',$rid.'_umrec,home___'.$id.'_'.$lg.'_'.$mode,flag($lg)).' &#8658; ';
foreach($r as $k=>$v)if($v!=$lg)
	$ret.=lj($v==$lng?'active':'',$rid.'_umrec,home___'.$id.'_'.$v.'_'.$mode,flag($v)).'';
return $ret;}

static function track($id,$lang){$idy=''; $lgb='';
$ra=sql('id,name','qdi','w','ib="'.$id.'" and re="2" order by id asc limit 1');//re in(1,2,3)
[$idb,$nm]=$ra;
if($lang=='all')[$idy,$lgb]=sql('msg,lg','qdi','w','id="'.$idb.'"');
return [$idb,$idy,$lgb,$nm];}

//'mentions'=>'var','retweeted'=>'bint',//geo,coordinates
static function umtwits_r(){return ['ib'=>'int','twid'=>'bint','name'=>'var','screen_name'=>'var','date'=>'int10','text'=>'var','media'=>'var','reply_id'=>'bint','reply_name'=>'var','favs'=>'int','retweets'=>'int','followers'=>'int','friends'=>'int','quote_id'=>'bint','quote_name'=>'var','lang'=>'var2'];}

static function umrec_twit_init(){
sqlop::install('umtwits',self::umtwits_r(),0);}

static function twit_mem($id){
ses('umt','pub_umtwits');
$ex=sql('id','umt','v',['twid'=>isbint($id)],0);
if($id && !$ex){$ra=self::umtwits_r(); $rb=[]; $nid='';
	$cl=implode(',',array_keys($ra));
	$rb=sql($cl,'qdtw','ar',['twid'=>isbint($id)],0); 
	if($rb[0]??[])$nid=sqlsav('umt',$rb[0],0,1);
	if($nid)return $id.' ';}}

static function pages($p,$pg){
$nb=self::req_arts_c($p); $ret='';
$nbyp=prmb(6); $nbyp=20; $nbp=ceil($nb/$nbyp);
if($nbp)$rp=api::pages_nb($nbp,$pg=='all'?1:$pg);
if($rp){foreach($rp as $i=>$v)
	$ret.=lj($i==$pg?'active':'','umrec_umrec,callj__3_'.ajx($p).'_'.$i,$i).' ';
$ret.=lj('all'==$pg?'active':'','umrec_umrec,callj__3_'.ajx($p).'_all',nms(100)).' ';
return divc('nbp',$ret);}}//btn('small','page ').

static function tglist($r){$ret='';
//$r=ma::artags('cat,tag','and '.ses('qda').'.id='.$id.' order by '.ses('qdta').'.id','kk');
//$r=ma::art_tags($id,'vv');
if($r)foreach($r as $k=>$v)$ret.=lj('','popup_api__3_'.ajx($v[0]).':'.ajx($v[1]),$v[1]).' ';
return btn('nbp',$ret);}

static function lgdate($d){
return date($p?$p:'d-m-Y',$d);}

static function playtx($id){$d=sql('msg','qdm','v',$id);
return trans::convert($d,$id);}

static function btredit($ref,$to,$from){$ret=''; if(auth(6) && $to!='all'){
$ret=lj('','ynd'.$ref.'_trans,redo___'.$ref.'_'.$to.'-'.$from.'-1',picto('refresh')).' ';
$ret.=lj('','popup_trans,redit___'.$ref.'_'.$to.'-'.$from.'-1',picto('edit'));}
return $ret;}

//datas
static function datas($r,$lang,$mode='',$q2=''){
[$id,$day,$suj,$msg,$lk,$lg]=$r;
if(!$lg)$lg='fr'; $nl=0;
$rb=['id'=>$id,'suj'=>$suj,'day'=>date('d-m-Y',$day),'source'=>'','author'=>'','tracks'=>'','player'=>''];
$rb['url']='/'.$id;//'/app/umcom/'.$id;
$msgb=str::clean_internaltag($msg); $msgb=trim($msgb); $from='';
if(substr($msgb,0,1)=='@')$from=strto($msgb,' ');
$rb['lang']=self::slctlng($id,'umrec'.$id,$lang,$lg,$mode);//slctlng
//$rb['lang']=ljtog('','umart'.$id.'_trans,callum___'.$id.'_'.$lang.'-'.$lg,'umart'.$id.'_umrec,playtx___'.$id,picto('translate'));
//$lnk=lka(urlread($id));
$rtg=ma::art_tags($id,'vv');
$rb['tag']=self::tglist($rtg);//tag
if($mode=='tags'){if($rtg)foreach($rtg as $k=>$v)$rb['tagr'][$v[1]][]=$id;}
$nfo=isset($rtg[0][1])?$rtg[0][1]:'';//classtags info
if($nfo!='favoris' && $nfo!='retweet')[$idb,$idy,$lgb,$nm]=self::track($id,$lang);//idy
else $idy=$idb=$lgb=$nm='';
$n=substr_count($idy,':u');
if($nfo=='favoris')$from='@'.between($msg,'twitter.com/','/status');
elseif(!$from && $nm)$from=$nm;
//if($lang!='all' && $idb){}// && $lg!=$lang
	if($mode=='brut' or $mode=='ebook' or $mode=='com2')$edt=2; else $edt=0;//2=no edit
	if($idb)$idy=trans::callum('trk'.$idb,$lang.'-'.$lgb,$edt);
//if($lang!='all'){}// && $lang!=$lg
	if($mode=='brut' or $mode=='ebook' or $mode=='com2')$edt=2; else $edt=0;
	$msg=trans::callum('art'.$id,$lang.'-'.$lg,$edt,$q2?$msg:'');//,$msg
	//$msg=divd('art'.$id,$msg);
if($mode=='com2')$msg=str_replace(':video',':videourl',$msg);
//$rb['msg']=conn::read($msg,'','',$nl);
$rb['msg']=$msg;//divd('umart'.$id,$msg);
$rb['txtbrut']=$msg;
if($from && $idy && $n>1){$rb['source']='Questions'; $rb['author']='';}//nms(171);
elseif($from && $idy){$rb['source']='Question de'; $rb['author']=$from;}//nmx([170,68])
elseif($from && !$idy && $nfo!='favoris' && $nfo!='retweet'){
	$rb['source']='Question manquante de'; $rb['author']=$from;}
if($nfo=='favoris'){$rb['opt']='Favoris'; $rb['player']=$from;}
elseif($nfo=='retweet'){$rb['opt']='Retweet'; $rb['player']=$from;}
elseif($nfo=='status')$rb['opt']='Statut du';
elseif($from)$rb['opt']='Réponse';
else $rb['opt']='Message';
$rb['btrk']=$rb['source']?self::btredit('trk'.$idb,$lang,$lg):'';
$rb['btxt']=self::btredit('art'.$id,$lang,$lgb);
if($mode=='com2')$idy=str_replace(':video',':videourl',$idy);
if($from)$rb['tracks']=$idy;//conn::read($idy,1,'',$nl); //ecko($idy);
if($from)$rb['trkbrut']=$idy;
$rb['social']=ma::popart($id).' '; //$rb['open']=lka($lk,picto('tw'));
$rb['pid']=lj('','popup_umrec,call___'.$id,$id);
$rb['title']=lk('/'.$id,$rb['suj']);
$idx=str_replace(['[',']'],'',strto($suj,']'));//substr($suj,1,-1)//
//$rb['social'].=lj('','popup_umrec,txtbrut___'.$idx,picto('txt'),att('brut'));
//$rb['social'].=lkt('','/context/compile/'.$idx,picto('chain'));
$rb['social'].=lkt('','/app/umcom/'.$idx,picto('chain'));
return $rb;}

static function template(){
return '[[_TITLE:h2][_SOCIAL #_PID _TAG§small:css][_LANG§nbp:divc]
[[_SOURCE:b] [_AUTHOR:u] _BTRK:div][_TRACKS:p]
[[_OPT:b] [_PLAYER:u] (_DAY) _BTXT:div][_MSG:p]:section]';}

static function temp_brut(){
return '[[_URL§_SUJ:url]:h2]
[[_SOURCE:b] [_AUTHOR:u]:p][_TRACKS:p]
[[_OPT:b] [_PLAYER:u] (_DAY) [#_ID§small:css]:p]
[_MSG:p]';}

static function temp_vue(){
return '[[[{url}§{suj}:url]:h2]
[{source}:b] [{author}:u][{tracks}:div][{opt}:b] [{player}:u] ({day}) [#{id}§small:css][{msg}:div]:section]';}

static function text($r){//umcom
$ret=divc('nbp',$r['lang']);
$ret.=tagb('h2',$r['suj']).' '.$r['social'].' '.btn('small','#'.$r['pid']).' '.$r['tag'];
$ret.=div('',tagb('b',$r['source']).' '.tagb('u',$r['author']));//.' '.$r['btrk']
$ret.=div('',$r['tracks']);
$ret.=div('',tagb('b',$r['opt']).' '.tagb('u',$r['player']).' ('.$r['day'].')');//.' '.$r['btxt']
$ret.=div('',$r['msg']);
return $ret;}

static function text_b($r){//brut/com2
$ret=tagb('h4',$r['suj']);
if($r['source'] or $r['author'])$ret.=tagb('b',$r['source']).' '.tagb('u',$r['author']).n();
if($r['tracks'])$ret.=$r['tracks'].n();
$ret.=tagb('b',$r['opt']).' '.tagb('u',$r['player']).' ('.$r['day'].')'.n();
$ret.=$r['msg'];
return $ret;}

static function brut($r){
$p=['txtbrut','trkbrut','suj','source','author','opt','player','day'];
[$txa,$txb,$suj,$src,$ath,$opt,$player,$day]=vals($r,$p);
$txa=str_replace(':video',':videourl',$txa);
$txa=str_replace(':mini','',$txa);
$txb=str_replace(':mini','',$txb);
$ret='['.$suj.':h2] ';
if($src or $ath)$ret.='['.$src.':b] ['.$ath.':u]'.n();
if($txb)$ret.='['.$txb.':p]'.n();
$ret.='['.$opt.':b] ['.$player.':u] ('.$day.')'.n();
$ret.='['.$txa.':p]'.n();
return '['.$ret.':section]';}

static function txtbrut($p,$o){
if(!is_numeric($p))$p=ma::id_of_urlsuj('['.$p.']');
$r=self::req_art_id($p);
$rb=self::datas($r,$p,$o,'brut');
return self::text_b($rb);}

static function build($p,$o){$pg=''; $q2=0;
if($o=='all'){$pg='all'; $o='list'; $q2=1;}
elseif(!$o or $o=='list' or is_numeric($o)){$pg=is_numeric($o)?$o:1; $o='list'; $q2=0;}
$lang=ses('umrlg'); $ret=''; $rc=[];
if($o=='brut')$tmp=self::temp_brut();//self::temp_vue
else $tmp=self::template();//list
if($q2)$r=self::req_arts_y2($p,$pg,$lang); else//
$r=self::req_arts_y($p,$pg,$lang); //if(auth(6))pr($r);
if($o=='table')$rc[]=['ID','Date','Question','Réponse','tags'];
//geta('nl',1);
if($o=='brut' or $o=='table')$save=1; else $save='';
if($r)foreach($r as $k=>$v){
	[$id,$day,$suj,$msg,$lk,$lg]=$v; //$_SESSION['memcom2'][$id]=1;
	//if((auth(6) && $id==1272) or !auth(6)){}
	$rb=self::datas($v,$lang,$o,$q2); //if(auth(6))echo pr($rb);
	if($o=='list')$ret.=divd('umrec'.$id,art::mktmp($tmp,$rb));
	//if($o=='list')$ret.=divd('umrec'.$id,vue::call($tmp,$rb));
	elseif($o=='text')$ret.=self::text($rb);//umcom
	//elseif($o=='brut')$ret.=art::mktmp($tmp,$rb);
	//elseif($o=='brut')$ret.=self::brut($rb);
	elseif($o=='brut'){$rb['suj']=segment($rb['suj'],'[',']'); $rc[]=$rb;}//codeline
	/*elseif($o=='brut'){//vue
		$rb['tracks']=codeline::parse($rb['tracks'],'','sconn');
		$rb['msg']=codeline::parse($rb['msg'],'','sconn'); $rc[]=$rb;}*/
	elseif($o=='ebook')$rc[]=[$id,$day,$suj.' ('.($lg?$lg:'fr').')',self::brut($rb),$lg];
	elseif($o=='table'){$t=tag('b',[],segment($rb['suj'],'[',']')); //pr($rb);
		$trk=''; if($rb['author'])$trk=divb(tag('b',[],$rb['author']).' : '); $trk.=$rb['tracks']??'';
		$rc[$day]=[$t,$rb['day'],$trk,$rb['msg'],$rb['tag']];}
	elseif($o=='tags')$rc[$day]=$rb;
	if(auth(6))echo self::twit_mem(strend($lk,'/'));}
//rstr(13)
//getz('nl');
if($o=='array')pr($rb);
elseif($o=='table')$ret=tabler($rc,'1','');
//elseif($o=='text')$ret=conn::read($ret);
//elseif($o=='brut')$ret=conn::read($ret,'','','');
elseif($o=='brut')$ret=codeline::call($tmp,$rc);
//elseif($o=='brut')$ret=vue::call($tmp,$rc);
elseif($o=='tags'){
	if($rc)foreach($rc as $k=>$v){$rd=$v['tagr']??[];
		if(is_array($rd))foreach($rd as $kb=>$vb)
			//$re[$kb][]=divd('umrec'.$id,vue::call($tmp,$v));
			$re[$kb][]=divd('umrec'.$id,art::mktmp($tmp,$v));}
	if($re)$ret=tabs($re);}
elseif($o=='ebook'){$t='Twits_'.$lang; $f='_datas/'.$t.'.epub'; $b=1;
	if(is_file($f) && $b)$ret=lkc('txtx','/'.$f,pictxt('book2',$t));
	else $ret=mkbook::build($rc,$t);}
if($o=='list')$bt=self::pages($p,$pg); else $bt='';
if($save){$f='_datas/twits_'.$o.'_'.ses('umrlg').'.htm';
	$doc='<head><style type="text/css">img{max-width:100%;} table,td,th{border:2px solid gray; border-collapse:collapse;}</style></head>
	<body>'.($ret).'</body>';//str_replace('img/',host().'/img/',
	write_file($f,$doc); $bt.=lkt('popbt','/'.$f,pictxt('file-word','html'));}
return $bt.$ret.$bt;}

static function date2id($p){
if(strlen($p)==6){[$y,$m,$d]=str_split($p,2); $ti=mktime(0,0,0,$m,$d,$y);
	return sql('id','qda','v','day>='.$ti.' limit 1');}
else return $p;}

static function call($p,$o,$mode=''){//p:suj,o:lg
if(is_numeric($p))$p=self::date2id($p);
else $p=ma::id_of_urlsuj('['.$p.']');
if(!$p)return 'nothing';
$o=setlng($o);//do not erase, do not let empty
if(!$o)$o='fr';
//timelang($o);//setlocale
$r=self::req_art_id($p); if(!$r)return 'nothing';
$rb=self::datas($r,$o,$mode);
Head::add('meta',['property','og:title',$rb['suj']]);
Head::add('meta',['property','og:description',trim(strip_tags($rb['txtbrut']))]);
if($mode=='brut' or $mode=='ebook')$tmp=self::temp_brut(); else $tmp=self::template();
if($mode=='com2')return self::text_b($rb);//!rstr8 (mode ajax)
elseif($mode=='com')return delbr(self::text($rb));//format_txt
//else return vue::call($tmp,$rb);
else return art::mktmp($tmp,$rb);}

static function callj($p,$o,$prm=[]){//p:cats,o:page
$p=$prm[0]??$p;
$lg=sesif('umrlg',ses('lang')?ses('lang'):'all');//set lang for thread
//timelang($lg);//setlocale
if(strpos($p,',')){$r=explode(',',$p); $lang=ses('umrlg');
	$rc[]=['ID','Date','Question','Réponse','tags'];
	foreach($r as $k=>$v){if(!is_numeric($v))$v=ma::id_of_urlsuj('['.$v.']');
		$r=self::req_art_id($v); [$id,$day,$suj,$msg,$lk,$lg]=$r;
		$rb=self::datas($r,$lang,$o);
		$rc[$day]=[segment($rb['suj'],'[',']'),$rb['day'],$rb['tracks']??'',$rb['msg'],$rb['tag']];}
	return $ret=tabler($rc,'1','');}
if(!is_numeric($p) && $p!='All' && $o!='table'){//passage délicat qui évite d'envoyer un id à call()
	$pb=ma::id_of_urlsuj('['.$p.']');
	if(is_numeric($pb))$p=$pb;}//when opt
if($opt=get('opt'))return divd('umrec'.$p,self::call($opt,$lg,''));
if(is_numeric($p))return divd('umrec'.$p,self::call($p,$lg,''));
if($p)return self::build($p,$o);
else return 'no';}

static function callint($p,$o,$prm=[]){
$p=$prm[0]??$p; $mode=''; $ret='';
if(strpos($p,',')){$r=explode(',',$p); foreach($r as $k=>$v)$ret.=self::callint($v,$o,''); return $ret;}
elseif($p=='last')$p=umrec::req_last('All');
elseif(!is_numeric($p)){$pb=ma::id_of_urlsuj('['.$p.']');
	if(!$pb)return umsearchlang::call($p,'');
	else $p=$pb;}
return divd('umrec'.$p,self::call($p,$o,$mode));}

static function umrec_r(){
foreach(self::$cats as $v)$ret[$v]=$v;
return $ret;}

static function search($p,$o,$rid){
$j=$rid.'_umrec,callint_umrsrch_3__'.$o;
$t='search (word in any language, title, ID, lists, or ymd date as 150706)';
$ret=inputj('umrsrch',$p,$j,nms(24));
$ret.=lj('',$j,picto('search'),att($t)).' ';
$ret.=hlpbt('umrsrch').' ';
$ret.=lj('',$rid.'_umrec,callj__3_All',picto('globe'),att('All')).' ';
$ret.=lj('',$rid.'_umrec,callj__3_O6','O6').' ';
$ret.=lj('',$rid.'_umrec,callj__3_OW','OW').' ';
$ret.=lj('',$rid.'_umrec,callj__3_OT','OT').' ';
$ret.=lj('',$rid.'_umrec,callj__3_OAY','OAY').' ';
$ret.=lj('',$rid.'_umrec,callj__3_UM','UM').' ';
$ret.=lj('',$rid.'_umrec,callj__3_312oay','312').' ';
//$ret.=lj('',$rid.'_umrec,callj__3_All_list',picto('filelist'),att('list')).' ';
$ret.=lj('',$rid.'_umrec,callj__3_All_brut',picto('txt'),att('brut')).' ';
$ret.=lj('',$rid.'_umrec,callj__3_All_table',picto('table'),att('table')).' ';
$ret.=lj('',$rid.'_umrec,callj__3_All_tags',picto('tag'),att('tags')).' ';
$ret.=lj('',$rid.'_umrec,callj__3_All_ebook',picto('book'),att('Ebook')).' ';
//$ret.=ljp(att('search words'),'popup_umsearchlang,home',picto('enquiry ')).' ';
$ret.=lka('/app/umrec',picto('link')).' ';
$ret.=hlpbt('umrec');
//$f='_datas/twits_fr.htm'; if(is_file($f))$ret.=lkt('',$f,pictxt('txt','fr')).' ';
//$f='_datas/twits_en.htm'; if(is_file($f))$ret.=lkt('',$f,pictxt('txt','en')).' ';
return divc('nbp',$ret);}

//global lang
static function lng($p,$o,$rid){$r=explode(' ','all '.prmb(26));//['all','fr','en','es'];
$lg=sesif('umrlg',ses('lang')?ses('lang'):'all');
$now=in_array_b($lg,$r); return radioj('umrlg',$r,$now);
//foreach($r as $k=>$v)$ret.=lj($v==$g?'active':'',$rid.'_umrec,home___'.$p.'_'.$v,$v).' ';
return btn('nbp',$ret);}

static function home($p,$o){$rid='umrec';
if(!$p)$bt=self::search($p,ses('umrlg'),'umrec'); else $bt='';
ses('umt','pub_umtwits');
//self::twit_init();
//if(auth(6))$bt.=self::menu($p,$o,$rid);
if(!$p)$bt.=self::lng($p,$o,$rid);
$c=$p?'popup':''; $c='';
if($p)$ret=self::callint($p,$o,'');
else{
	if(!$p && !$o){$p='All'; $o='list';}
	$ret=self::callj($p,$o);}
return $bt.divb($ret,$c,$rid);}

}
?>