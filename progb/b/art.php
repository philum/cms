<?php //art
class art{

#template
static function mktmp($ret,$p){$r=sesmk2('tmp','vars','',0); $rb=[]; $rc=[]; $rd=[];
foreach($r as $k=>$v)if(!isset($p[$k]))$rb[]=$v; else{$rc[]=$v; $rd[]=$p[$k];}
$ret=str_replace($rb,'',$ret);//del_empty
if(isset($p['img1']))$ret=str_replace('_IMG1',$p['img1'],$ret);
$ret=codeline::parse($ret,'','template');//build
return str_replace($rc,$rd,$ret);}

static function tmpu($tpl){
$tmp=msql::val('',nod('template'),$tpl);
if(!$tmp)$tmp=msql::val('','public_template',$tpl);
if(!$tmp && $tpl && method_exists('tmp',$tpl))$tmp=tmp::$tpl();
return $tmp;}

static function template($p,$tpl){
//if(!$tpl)$tpl=$_SESSION['opts']['template']??'';//article
if(!$tpl)$tpl=prma('template'); $tmp=sesmk2('art','tmpu',$tpl,1);
if($tpl=='read' && rstr(88))$tmp=$tmp?$tmp:tmp::read();
elseif($tpl=='art')$tmp=rstr(55)?$tmp:tmp::art();
elseif($tpl=='pubart')$tmp=rstr(55)?$tmp:tmp::pubart();
elseif($tpl=='pubart_j')$tmp=rstr(55)?$tmp:tmp::pubart_j();
elseif($tpl=='pubart_b')$tmp=rstr(55)?$tmp:tmp::pubart_b();
elseif($tpl=='titles')$tmp=rstr(65)?$tmp:tmp::titles();
elseif($tpl=='tracks')$tmp=rstr(66)?$tmp:tmp::tracks();
elseif($tpl=='book')$tmp=rstr(67)?$tmp:tmp::book();
if(!$tmp){if(!empty($_SESSION['simplified']))$tmp=tmp::simple(); 
	elseif(rstr(88))$tmp=tmp::cat();
	else $tmp=tmp::art();}
//return vue::build($tmp,$p);
return self::mktmp($tmp,$p);}

#edit
static function btedit($kem,$id,$re,$prw){$USE=ses('USE'); $auth=$_SESSION['auth']; $ret='';
if($re==0){if(($USE==$kem && $auth>2) or $auth>3)//publish
	$ret=blj('txtyl','pba'.$id,'meta,priorsav__xd_1_'.$id,picto('minus'));
	elseif($USE==$kem && $auth==2)$ret.=btn('txtyl',nms(53)).' ';}
if(get('search') && $auth>4)
	$ret.=togbub('meta,tag*slct',$id.'_'.ajx(get('search')),picto('paste'));
if(($USE==$kem) or $auth>3){
	$ret.=togbub('meta,metall',$id.'_'.$prw,picto('tag')).' ';
	$ret.=togbub('meta,titedt',$id.'_'.$prw,picto('meta')).' ';
	//$ret.=toggle('','edt'.$id.'_meta,titedt_'.$id.'_'.$prw,picto('meta'));
	//if(auth(6))$ret.=lj('',$id.'_sav,recapart___'.$id,picto('refresh',16));
	//$ret.=toggle('','edt'.$id.'_edit,artform__'.$id,picto('edit')).' ';
	$ret.=lj('','popup_edit,artform____'.$id.'__autosize',picto('edit')).' ';
	$ret.=btd('adt'.$id,lja('',atj('editart',$id),picto('editor')));}
return btd('artmnu'.$id,$ret);}

#build
static function target_date($v,$n=''){return htac('timetravel').date('d-m-y',$v).($n?'&nbj='.$n:'');}
static function length($v){if($v>1400)return pictxt('time',ceil($v/1400).' min',16);}
/*static function suj_arts($suj,$id){
$r=sql('id','qda','k','nod="'.ses('qb').'" and suj="'.$suj.'" and id!="'.$id.'"');
if($r)return slctmenusj($r,'popup_popart___',$read,' ');}*/
static function pub_link($m){$j=ajx(domain($m)); $ret=lkt('',http($m),picto('home',16)).' ';
$ret.=lj('','popup_api___source:'.$j,preplink($m));
if(strpos($m,'twitter.com'))$ret.=' '.lj('','popup_twit,call___'.strend($m,'/'),picto('tw2',16));
return $ret;}

static function metart($id){
$ra=sql('val,msg','qdd','kv','ib="'.$id.'"');
if(rstr(17))$ret['2cols']=1;
return $ra;}

static function favs($id){
$ra=sql('type,poll','qdf','kv','ib="'.$id.'" and iq="'.ses('iq').'"');
$rb=['fav','like','poll','mood','agree'];
return valk($ra,$rb);}

static function lang_art($id,$lg){
if($lg && $lg!=ses('lng'))return ' '.flag($lg);}

static function lang_art_others($id,$lg,$rb){$ret='';
$r=explode(' ',prmb(26)); //$rb=sql('lang,id','ynd','kv','ref="art'.$id.'"');
foreach($r as $k=>$v)if($v!=$lg && isset($rb[$v]))
	$ret.=lj('','art'.$id.'_yandex,call___art'.$id.'_'.$v.'-'.$lg,flag($v));
return $ret;}

static function lang_rel_arts($id,$lg,$r,$rst101,$rst115){
$lng=ses('lng'); if(!$lg)$lg=$lng; $rb=[]; $ex=''; $ret='';
if($lg!=$lng && $lg)$ex=sql('lang,id','ynd','kv','ref="art'.$id.'"');//$ex=get('lang');
if($r && !$rst101)foreach($r as $k=>$v)if(substr($k,0,4)=='lang'){//arts
	$lga=substr($k,4); if($lga!=$lg)$ret.=ma::popart($v).flag($lga).' '; $rb[$lga]=$v;}
//$ja='suj'.$id.',art'.$id.'_yandex,artsuj__json_'.$id.'_'.$lng.'-'.$lg; $jb='suj'.$id.',art'.$id.'_ma,artsuj___'.$id;
$ja='art'.$id.'_yandex,call___art'.$id.'_'.$lng.'-'.$lg; $jb='art'.$id.'_ma,read*msg___'.$id;
if((!$rst115 && $ex && !isset($rb[$lng]))){// or $ex
	$rt=['fr'=>'&#127467;&#127479;','en'=>"&#127468;&#127463;",'es'=>'&#127466;&#127480;']; $ic=$rt[$lng]??'';
	$ret.=ljtog('',$ja,$jb,picto('translate').$ic,att(nms(153))).' ';}//trads
if(!$ret)$ret=self::lang_art_others($id,$lg,$ex);
return $ret;}

//tags
static function tagn(){
$rt=explode(' ','tag '.prmb(18)); $rn=[];
foreach($rt as $k=>$v)$rn[$v]=$k+1;
return $rn;}

static function tags($id,$o='',$lg=''){//$r=sesr('artags',$id); 
$r=ma::art_tags($id); if(!$r)return; $sep="&#8239;"; $ret=[];
$ica=explode(' ',prmb(18)); $ico=explode(' ',prmb(19)); if($lg)$rn=self::tagn();
if(count($ica)==count($ico))
$rico=['tag'=>'tag']+array_combine($ica,$ico); $rico['utag']='like';
if($r)foreach($rico as $cat=>$ico){$rt=[]; if(is_numeric($cat))$cat='utag';
	if(isset($r[$cat])){
		if($lg){$n=$rn[$cat]; $rb=msql::kx('',nod('tags_'.$n.$lg),0); $rc=[];
			foreach($rb as $k=>$v)if(in_array($k,$r[$cat]))$rc[$v]=$k; if($rc)$r[$cat]=$rc;}
		foreach($r[$cat] as $ka=>$va)
		$rt[$ka]=lj('','popup_api__3_'.$cat.':'.$va.',t:'.ajx($ka),$ka);}
	if($rt)$ret[$cat]=picto($ico,16).$sep.implode(' ',$rt);}
if($ret)return $o?$ret:implode(br(),$ret);}

static function back($id,$ib,$frm,$rst43){
$read=ses('read'); $lk=htac('cat').$frm; $t=picto('before');
if($read){$ibb=ma::ib_of_id($ib);
	if($id!=$read){
		if(!$rst43)$t=catpict($frm,36);
		if(is_numeric($ibb) && $ibb)$lk=urlread($ibb).'#'.$ib;
		else $lk.='#'.$id;}
	elseif($ib>0)$lk=urlread($ib).'#'.$id;
	else{$lk.='#'.$id; $t=!$rst43?catpict($frm):picto('left');}}
elseif(!$rst43)$t=catpict($frm,36); else $t=btn('txtbox',$frm);
return lk($lk,$t);}

static function opnart($id,$prw,$o,$rch=''){$c=$o?'active':'';//art_read_c
return ljb($c,'SaveBc','art_'.$id.'_'.$prw.'_'.$o.'_'.ajx($rch),picto('kdown'),'toggleart'.$id);}

static function priority_hands($d){
$r=[2=>'s1',3=>'s2',4=>'s3',5=>'stars'];
return isset($r[$d])?picto($r[$d],16):'';}

static function titles($id,$r,$rear,$nbtrk,$prw,$nl,$nb,$rb){
$rst=$_SESSION['rstr']; $USE=ses('USE'); $ib=$r['ib'];
$ro=valk($r['opts'],['fav','like','poll','2cols','artstat','authlevel','lastup','tracks','folder','bckp','plan','mood','agree']);// $ro=$r['opts'];
$rf=self::favs($id);//todo:come from pecho_arts and api
$read=ses('read'); $page=get('page'); $rb['words']='';
$rb['jurl']='content_mod,ajxlnk2__2_read_'.$id;
$rb['purl']=(!$rst[136]?'pagup':'popup').'_popart__3_'.$id.'_3';
$rb['day']=$r['day']; if($prw>2)$rb['artedit']=div(atd('edt'.$id).atc('sticky bkg'),'');
$http=$nl?host():''; $rb['open']=''; $rb['social']='';
if(!$rst[38]){//explicit url
	if(!$r['thm'])$r['thm']=ma::id_of_urlsuj($r['suj']); $rb['url']=$http.'/'.$r['thm'];}
else $rb['url']=$http.urlread($id);
if(!$rst[19])$rb['img1']=pop::art_img($r['img'],$id);//$rst[93])
if(!$rst[68] && $r['img'] && strpos($r['img'],'/'))//gallery
	$rb['btim']=lj('','popup_sav,art*gallery___'.$id.'_gallery',picto('img'));
//if(!$rst[43] or $nl)$rb['back']=lk(htac('cat').$r['frm'],catpict($r['frm'],36)); else
if(!$rst[31])$rb['back']=self::back($id,$ib,$r['frm'],$rst[43]);//back
if(!$rst[6] && $r['name'] && $r['name']!=$_SESSION['qb'])//author
	//$rb['author']=lk(htac('author').$r['name'],'@'.$r['name']);
	$rb['author']=lj('','popup_api___owner:'.ajx($r['name']),'@'.$r['name']);
if(!$rst[23] && $r['re']>1)$rb['priority']=self::priority_hands($r['re']);
if(!$rst[24]){$day=mkday($r['day'],1);//date
	if(!$rst[54])$rb['date']=lk(self::target_date($r['day']),$day); else $rb['date']=$day;} 
if(!$rst[26])$rb['pid']=btn('txtsmall2','#'.$id);//id
if(!$rst[29])$rb['tag']=self::tags($id,'',$r['lg']);//tags
if(!$nl)$rb['edit']=self::btedit($r['name'],$id,$r['re'],$prw,$ro['authlevel']);//edit
if($r['mail']){$mail=trim($r['mail']);
	if(!$rst[27])$rb['source']=self::pub_link($mail);//source
	if(!$rst[108])$rb['words'].=lj('','popup_sav,batchpreview__3_'.ajx($mail),picto('window')).' ';}
if($nb)$rb['search']=nbof($nb,19);//rech
//if($prw=='score')$rb['search']=$nb;//jda
if($rear>1 && !$rst[14])$rb['nbarts']=lj('','popup_api___parent:'.$id,nbof($rear,1));//nb_arts
if(!$rst[86] && is_array($nbtrk)){$nbtk=count($nbtrk);//tracks
	if($nbtk)$rb['tracks']=lj('','popup_usg,trkplay___'.$id,picto('forum',16).$nbtk);}
if($ib>0 && $read!=$id && $read!=$ib && $ib){$sujb=ma::suj_of_id($ib);//parent
	if($sujb)$rb['parent']=lk(urlread($ib),pictxt('topo',$sujb)).' '.ma::popart($ib);}
if(!$rst[58] && !$nl)$rb['open'].=lj('','popup_usg,editbrut___'.$id,picto('conn')).' ';
if(prma('art_mod')){
	if(!$rst[60])$rb['words'].=togbub('mod,popartmod',$id,picto('folder-chain')).' ';
	elseif($read==$id && $prw>2 && !$nl)$rb['float']=mod::build_artmod($id,1);}
if(!$rst[141] && $r['host']>1000)$rb['open'].=lj('','pagup_book,read__css_'.$id.'__1',picto('book')).' ';
if(!$rst[138])$rb['open'].=ljb('','toggleFullscreen',$id,picto('fscreen-op')).' ';
$rb['open'].=lk('/read/'.$r['thm'],picto('chain')).' ';//if(!$rst[38]) 
if($ro['plan'])$rb['open'].=lj('','popup_mk,plan___'.$id.'_3__1',picto('organigram'),att('Plan')).' ';
if(!$rst[37] && !$nl)$rb['open'].=ma::popart($id).' ';//popen
if(!$rst[28] && !$nl){//open
	if($prw==2 or $prw==1)$rb['open'].=self::opnart($id,$prw,0).' ';// && $rst[41]!='0' (full)
	elseif($prw==3 && $rear>1)$rb['open'].=self::opnart($id,2,1).' ';
	elseif($prw=='rch')$rb['open'].=self::opnart($id,$prw,0,get('search')).' ';}
if(!$rst[25] && $r['host']>1000)$rb['length']=self::length($r['host']);//length
if($prw==3){$j2='art'.$id.'_art,playc___'.$id.'_3_1';
	if(!$rst[109])$rb['words'].=ljtog('','art'.$id.'_mk,allquotes___'.$id,$j2,picto('discussion'),att(nms(167))).' ';
	if(!$rst[135] && auth(4))$rb['words'].=ljtog('','art'.$id.'_mk,xltags___'.$id.'_all',$j2,picto('highlight'),att(nms(190))).' ';}
if($ro['authlevel'])$rb['social']=asciinb($ro['authlevel']);
$rb['lang']=self::lang_art($id,$r['lg']);//lang of art
$rb['artlang']=self::lang_rel_arts($id,$r['lg'],$r['opts'],$rst[101],$rst[115]);//translate
if(!$nl){
	$rb['social']=self::social($id,$r['suj'],$ro,$rf,$prw);
	if(!$rst[42])$rb['social'].=togbub('meta,editag',$id.'_utag_tag',picto('diez'),'',att('usertags')).' ';
	if($d=$ro['lastup']){
		if($d==1){$d=time(); meta::utag_sav($id,'lastup',$d);}
		if($d && !$rst[113])$rb['lang'].=' '.btn('txtsmall',nms(118).' '.mkday($d,1));}
	if(!$rst[114])$rb['words'].=togbub('searched,look',$id,picto('search'),'',att(nms(177))).' ';
	if(!$rst[49])$rb['words'].=togbub('meta,uwords',$id,picto('tag2'),'',att(nms(47))).' ';
	if(!$rst[127])$rb['words'].=togbub('mod,playmod',$id.'_cluster*tags',picto('art-tags'),'',att(nms(187))).' ';
	if(!$rst[128])$rb['words'].=togbub('mod,playmod',$id.'_same*tags',picto('folder-tags'),'',att(nms(187))).' ';
	if($vr=$ro['folder'])$rb['words'].=popbt('modpop',$vr.'/'.$vr.'/icons:folders*varts',picto('virtual'),'','',att($vr)).' ';}
if($plgs=ses('plgs') && !$nl)$rb['social']=$plgs;
if(!$rst[50] or $USE)$rb['opt']=btn('txtsmall2',picto('view',16).' '.$r['lu']).' ';//nbof
$rb['sty']='';
return $rb;}

static function social($id,$suj='',$ro=[],$rf=[],$prw=''){
if(!$ro){$r=self::metart($id); $rf=self::favs($id); $suj=sql('suj','qda','v',$id);
$ro=valk($r,['fav','like','poll','2cols','artstat','authlevel','lastup','tracks','folder','bckp','plan','mood','agree']);}
$root=host().urlread($id); $rst=arr($_SESSION['rstr'],140); $ret='';
$rsoc=[44=>'http://www.facebook.com/sharer.php?u='.$root,45=>'http://twitter.com/intent/tweet?url='.$root.'&text='.utf8_encode_b($suj),46=>'http://wd.sharethis.com/api/sharer.php?destination=stumbleupon&url='.$root];
if(!$rst[100] && auth(6))$ret.=togbub('tlex,share',$id,picto('tlex')).' ';//,'color:gray'
if(!$rst[99] && auth(6))$ret.=togbub('twit,share',$id,picto('tw')).' ';//,'color:gray'
if(!$rst[45] && $prw>2)$ret.=lkt('',$rsoc[45],picto('tw2')).' ';
if(!$rst[44] && $prw>2)$ret.=lkt('',$rsoc[44],picto('fb2')).' ';
if(!$rst[46] && $prw>2)$ret.=lkt('',$rsoc[46],icon('stumble')).' ';
if(!$rst[118] && $prw>2)$ret.=lkt('','/apicom/id:'.$id.',json:1',picto('emission'),att('Api')).' ';
if(!$rst[130] && $prw>2)$ret.=lj('','popup_mkbook,call___'.$id.'_art',picto('book2'),att('Ebook')).' ';
if(!$rst[131] && $prw>2)$ret.=lj('','popup_api__3_id:'.$id.',preview:3,file:'.ajx($suj),picto('file-txt'),att('Html')).' ';
//if(!$rst[118])$ret.=lj('','popup_api___id:'.$id.',json:1',picto('rss2')).' ';
if(self::rstopt($rst[52],$ro['fav']))$ret.=self::favs_edt($id,'fav',$rf['fav']).' ';
if(self::rstopt($rst[90],$ro['like']))$ret.=self::favs_edt($id,'like',$rf['like']).' ';
if(self::rstopt($rst[91],$ro['poll']))$ret.=self::favs_edt($id,'poll',$rf['poll']).' ';
if(self::rstopt($rst[119],$ro['mood']))$ret.=self::favs_edt($id,'mood',$rf['mood']).' ';
if(self::rstopt($rst[125],$ro['agree']))$ret.=self::favs_edt($id,'agree',$rf['agree']).' ';
if(self::rstopt($rst[71],$ro['artstat']))$ret.=lj('','popup_stats,graph___nbp_'.$id,picto('stats',16)).' ';
//if(self::rstopt($rst[86],!$ro['tracks']))$ret.=lj($css,'popup_tracks,form___'.$id,picto('forum')).' ';
if(!$rst[47])$ret.=togbub('mails,sendart',$id,picto('mail')).' ';
if(!$rst[12])$ret.=lja('','window.print()',picto('print')).' ';
if(self::rstopt($rst[106],$ro['bckp']))$ret.=self::bckp_edit($id,$prw);
return $ret;}

static function rstopt($n,$d){//echo $n.'-'.$d.'_';
if($d=='false')$d='';
if($n && $d=='true')return true;
if(!$n && !$d)return true;}

//subarts
static function ib_arts_nb($id){$wh='ib="'.$id.'"';
if(!auth(1))$wh.=' and re>=1';// and substring(frm,1,1)!="_"
return $ids=sql('COUNT(id)','qda','v',$wh);}

static function ibload($id,$ord){$bt='';
$cnd=!auth(1)?'and re>="1" and substring(frm,1,1)!="_"':'';
$load=sql('id','qda','k','ib="'.$id.'" '.$cnd.' ORDER BY id '.($ord?'DESC':'ASC'));
if(count($load)>1)$bt=lj('txtbox','ch'.$id.'_art,ibload___'.$id.'_'.yesno($ord),nms($ord?41:40));
if(rstr(43))$bt=hr().div('',btn('txtcadr',nms(39)).' '.$bt);
if($load)return $bt.ma::output_arts($load,'flow','');}

static function ib_arts($id,$prw){//child
$ret=self::ibload($id,rstr(134));
if($ret)return divd('ch'.$id,$ret);}

//visitor
static function bckp_edit($id,$m){if($m<3)return;//bckread
$r=msql_read('',nod('backup_'.$id),'','1'); $na=count($r); $ret='';
if($r)foreach($r as $k=>$v){$n=count($v); if($n==2)$t=$v[0]; else $t=$k;
	$ret.=lj('"title="'.$t,'popup_sav,bckread___'.$id.'_'.$k,$k);}
if(isset($ret))return btn('nbp small',$ret);}//plurial(160,$na).

static function favsav($id,$type,$poll){$iq=ses('iq'); //$iq=2;
$rx=sql('id,poll','qdf','w',['ib'=>$id,'type'=>$type,'iq'=>ses('iq')]);
[$ex,$polb]=arr($rx,2);
if($ex && $polb==$poll){sqldel('qdf',$ex); $poll='';}
elseif($ex)update('qdf','poll',$poll,'id',$ex);
else $ex=sqlsav('qdf',[$id,$iq,$type,$poll]);
if($type=='fav' or $type=='like' or $type=='trkagree' or $type=='agree')
	return self::favs_edt($id,$type,$poll,1);
elseif($type=='mood')return self::favs_mood($id,$poll);
else return self::favs_polls($id,$poll,$type);}

static function favs_edt($id,$type,$poll,$o=''){$n='';
if($type=='fav'){$clr='#428a4a'; $ic='bookmark';}
elseif($type=='like'){$clr='#ee1111'; $ic='love';}
elseif($type=='poll'){$clr='#1111ee'; $ic='star1';}
elseif($type=='mood'){$clr='#8a424a'; $ic='smile';}
elseif($type=='agree'){$clr='#ee1111'; $ic='thumb-up';}
elseif($type=='trkagree'){$clr='#ee1111'; $ic='thumb-top';}
else{$clr='#8a424a'; $ic='star1';}//from quality_stats
//if(!$poll && $type=='trkagree')$poll=sql('poll','qdf','v',['ib'=>$id,'type'=>$type,'iq'=>ses('iq')]);
$s=$poll?'color:'.$clr:''; $j=$type.$id.'_art,favsav___'.$id.'_'.$type;
if($type=='poll')$ret=togbub('art,fav*polls',$id.'_'.$poll,picto($ic,$s),'',att(nms(143)));
if($type=='agree' or $type=='trkagree')$ret=self::favs_agree($id,$poll,$type);
elseif($type=='mood')$ret=togbub('art,favs*mood',$id.'_'.$poll,picto($ic,$s),'',att('mood'));
elseif($type=='like'){
	$n=sql('count(id)','qdf','v',['ib'=>$id,'type'=>$type]);
	$n=is_numeric($n)&&$n?btn('txtsmall',$n):'';
	$ret=lj('small',$j.'_1',picto($ic,$s),att($type)).$n;}
elseif($type=='fav')$ret=lj('small',$j.'_1',picto($ic,$s),att($type));
return $o?$ret:btd($type.$id,$ret);}

static function poll_stars($r,$n,$j,$poll){$ret='';
for($i=1;$i<=5;$i++){
	if($poll==$i)$sty='color:red;'; else $sty='color:black;';
	if($i<$n)$st=''; elseif($i>$n)$st='2'; if($i-1<$n && $i>$n)$st='1'; 
	$ret.=lj('',$j.'_'.$i,pictxt('star'.$st,'',$sty));}
return $ret;}

static function favs_polls($id,$poll,$type=''){$ret=''; if(!$type)$type='poll';
if(!$poll)$poll=sql('poll','qdf','v',['ib'=>$id,'iq'=>ses('iq'),'type'=>$type]);
$r=sql('poll','qdf','k',['type'=>$type,'ib'=>$id]); ksort($r); $median=0; $nc='';
if($r){$nc=array_sum($r); $sum=0; foreach($r as $k=>$v)$sum+=$k*$v; $median=round($sum/$nc,2);}
$j=$type.$id.'b_favs___'.$id.'_'.$type;
$ret=self::poll_stars($r,$median,$j,$poll);
$ret.=divc('small',nbof($nc,143).' / '.nms(164).': '.$median);
return divd($type.$id.'b',$ret);}

static function favs_mood($id,$poll){$ret=''; $j='mood'.$id.'b_art,favsav___'.$id.'_mood';
$ra=[128077,128078,128070,128071,128591,128075,128076,128079,128406,9994,129310,129305,129306,9995,129304,129311,129330,129307,129308,128512,128515,128516,128577,128578,127773,128124,128118,129505,128147,128148,128151,128152,128157,128158,128513,128514,128517,128518,128519,128520,128521,128522,128523,128539,128540,128541,128524,128525,128526,128527,128528,128529,128530,128531,128532,128533,128534,128535,128536,128537,128538,128542,128543,128544,128545,128546,128547,128548,128549,128550,128551,128552,128553,128554,128555,128556,128557,128558,128559,128560,128561,128562,128563,128564,128565,128566,128567,128579,129296,129298,129299,129297,129300,129301,129303,129319,129312,129313,129314,129315,129316,129317,129318,129319,129320,129321,129322,129323,129324,129325,129326,129327,129328,129329,129392,129395,129396,129397,129398,129402,129488]; $rk=array_flip($ra);
$rn=sql('poll,count(id)','qdf','kv','type="mood" and ib="'.$id.'" group by poll');
foreach($rn as $k=>$v)unset($rk[$k]); $rb=array_keys($rn+$rk);
foreach($rb as $k=>$v)$ret.=lj($v==$poll?'active':'',$j.'_'.$v,ascii($v).($rn[$v]??''));
return divd('mood'.$id.'b',$ret);}

static function favs_agree($id,$poll,$type=''){$ret=''; if(!$type)$type='agree';
if(!$poll)$poll=sql('poll','qdf','v',['ib'=>$id,'iq'=>ses('iq'),'type'=>$type]);
$na=sql('count(poll)','qdf','v',['type'=>$type,'ib'=>$id,'poll'=>1]);
$nb=sql('count(poll)','qdf','v',['type'=>$type,'ib'=>$id,'poll'=>-1]);
$j=$type.$id.'_art,favsav___'.$id.'_agree';
$ret.=lj($poll==1?'active':'',$j.'_1',pictxt('thumb-up',$na)).' ';
$ret.=lj($poll==-1?'active':'',$j.'_-1',pictxt('thumb-down',$nb)).' ';
return btd($type.$id,$ret);}

//displays
static function slct_media($v=''){if(rstr(5))$d=2; if(rstr(41))$d=3;
if($v=='read')$d=4; elseif($v=='full')$d=3; elseif($v=='true' or $v=='preview')$d=2; 
elseif($v=='false')$d=1; elseif($v=='auto')$d=$v; elseif($v=='score')$d=$v; 
elseif(substr($v,0,4)=='conn')$d=$v;
elseif(is_numeric($v))$d=$v; elseif($v=='flow' or !$v)$d=rstr(5)?2:1; else $d=1;
return $d;}

static function tometa($d){//$d=strip_tags($d);
$d=delconn($d); $d=deln($d,' '); $d=delsp($d); $lgh=strlen($d);
if($lgh>200)$n=strpos($d,'.',200); else $n=$lgh; $d=substr($d,0,$n+1);
ses::$r['title']=stripslashes($d);}

static function make_thumb_css($im){
if(!file_exists('imgc/'.$im) or ses('rebuild_img')){
	[$w,$h]=opt(prmb(27),'/');
	if(!file_exists('img/'.$im))conn::recup_image($im);
	make_mini('img/'.$im,'imgc/'.$im,$w,$h,0);}
return $im;}

static function prepare_thumb($d,$id,$nl){
if($_SESSION['rstr'][30]=='1')return; $im=''; $pr='';
if(rstr(93)){$mg=pop::art_img($d,$id); if($mg)$im=self::make_thumb_css($mg);
	if($im)$ret=div(ats('background-image:url(/imgc/'.$im.');').atc('thumb'),'');
	else $ret=divc('thumb',' ');}
else $ret=minimg($d,$pr,$nl);
$ret=lj('','popup_popart__3_'.$id.'_3',$ret);
return $ret;}

//msg img suit
static function prepare_msg($id,$msg,$r,$prw,$nl=''){
$read=get('read'); $USE=ses('USE'); $ath='';
if(rstr(21) && $prw>1)$ath=$r['opts']['authlevel']??'';
if(rstr(21) && $ath && $ath!='all' && $ath>$_SESSION['auth'])return few::restricted_area($ath);
if($psw=valr($r,'opts','password')){if(ses('psw'.$id)!=$psw)return few::restricted_pswd($id);}
if(isset($r['frm']) && substr($r['frm'],0,1)=='_' && $_SESSION['auth']<3)$msg=few::restricted_area(6);
elseif(($id==$read && $prw==3) or $prw==3 or $prw=='rch'){
	if(isset($r['opts']['plan']))$msg=self::hmarks($msg);
	qr('update '.ses('qda').' set lu=lu+1 where id='.$id);
	//json::add('','art'.mkday(),[mkday('','His'),$id,ses('iq')]);
	if(!$nl)self::tometa($msg);
	$msg=conn::read($msg,$prw,$id,$nl);}
elseif($prw==1)$msg='';
elseif(substr($prw,0,4)=='conn'){$cn=substr($prw,4);
	if($cn=='jpg' or $cn=='mp3' or $cn=='mp4' or $cn=='pdf')$cn='.'.$cn;
	elseif($cn=='img')$cn='.jpg'; else $cn=':'.$cn;
	$msg=conn::read(self::play_conn($msg,$cn),3,$id);}
elseif($id!=$read or $prw==2){
	if(strlen($r['host'])<15)if(strpos($msg,':import')){
		$msg=sql('msg','qdm','v','id="'.substr($msg,1,strpos($msg,']')).'"');}
	if(rstr(34)){$msg=codeline::parse($msg,'b i u h c l h1 h2 h3 h4 list numlist','corrfast');
		$msg=codeline::parse($msg,'color','corrfastb');}//bkgclr
	if(rstr(64))$msg=codeline::parse($msg,'figure q twitter fluid table plug msql','stripconn');//thumb
	if(rstr(117)){$msg=codeline::parse($msg,'striplink','correct');
		$msg=codeline::parse($msg,'stripimg','correct');//
		$msg=self::firstlines($msg);}
	else $msg=kmax($msg);
	$msg=conn::read($msg,'noimages',$id);//if(strlen($msg)>400)$msg=etc($msg);
	$msg=clean_br_lite($msg);}//if(rstr(9))
if($look=ses::r('look'))$msg=self::str_detect($msg,$look);
if(isset($r['opts']['2cols']) && $prw>2 && strlen($msg)>1000)$msg=divc('cols',$msg);
return $msg;}

static function hmarks($d){
$d=str_replace(':h]',':h2]',$d); $r=explode("\n",$d); $ret=[];
foreach($r as $k=>$v){$xt=substr($v,-3);
	if($xt=='h1]' or $xt=='h2]' or $xt=='h3]' or $xt=='h4]' or $xt=='h5]')$ret[]=lkn('h'.$k).$v;
	else $ret[]=$v;}
return implode("\n",$ret);}

static function firstlines($d){$r=explode("\n",$d); $rb=[];
foreach($r as $k=>$v)if(count($rb)<7 && trim($v)){
	$vb=substr($v,0,60); if(substr($v,60))$vb.='...';
	if(strlen($vb)>20)$rb[]=$vb;}
if($rb)return implode("\n",$rb);}

static function str_detect($msg,$d){
$r=detect_words($msg,$d,ses::r('seg')); $ret=''; $end='';
$sz=strlen($d); $len=strlen($msg); $nb=0; $nd=0; if(!$r)return $msg;
foreach($r as $k=>$v){$pos=$k; $ba=0; $bb=0; $nb+=1; //$sz=strlen($v);
	$part=substr($msg,$pos,$sz); $repl=$part;
	$deb=substr($msg,$nd,$pos-$nd); $end=substr($msg,$pos+$sz);
	$ba+=substr_count($deb,'<a'); $bb+=substr_count($deb,'</a');
	if($ba==$bb)$repl='<a name="'.$nb.'"></a>'.span(atd('look'.$nb).atc('stabilo'),$part);
	else $repl=$part;
	$ret.=$deb.$repl; $nd=$pos+$sz;}
return $ret.$end;}

static function find_word($msg,$rch,$n,$id){
$len=strlen($rch); $lenmsg=strlen($msg); $sz=100; $ret=''; $nd=0; $seg=ses::r('seg');
$r=detect_words($msg,$rch,$seg); $n=count($r); ses::$n+=$n; $look=$seg?'find':'look';
foreach($r as $k=>$v){$pos=$k; $nd+=1; //$len=strlen($v);
	$prev=$pos-$sz; $next=$pos+$len; if($prev<0)$prev=0; if($next>$lenmsg)$next=$lenmsg;
	$reta=substr($msg,$prev,$pos-$prev); $retb=substr($msg,$next,$sz);
	$posa=strrpos($reta,'. '); if(!$posa)$posa=strpos($reta,' '); if($posa<0)$posa=0;
	if($posa)$reta=substr($reta,$posa+1);
	$posb=strrpos($retb,'. '); if(!$posb)$posb=strrpos($retb,' '); if($posb>$lenmsg)$posb=false;
	if($posb)$retb=substr($retb,0,$posb+1);
	$bt=lkt('stabilo','/'.$id.'/'.$look.'/'.$rch.'#'.$nd,picto('chain'));
	$bt.=lj('stabilo','popup_art,look___'.$id.'_'.ajx($rch).'_'.$nd,substr($msg,$pos,$len));
	$ret.=divc('trkmsg',$reta.''.$bt.''.$retb);}
return $ret;}

static function prepare_rech($id,$msg,$out){
$rch=pop::good_rech(); $nbp=0; $ret=''; ses::$n=0;
if(get('bool')){$r=explode(' ',trim($rch)); $nbp=count($r);}
if(strpos($rch,'|')){$r=explode('|',$rch); $nbp=count($r);}
$msg=clean_internaltag($msg); $msgi=strtolower($msg); $msgb=$msg;//$msg=strip_tags($msg); 
if(get('titles'))$out['msg']='';
elseif($nbp>1){foreach($r as $k=>$v)if($v){$ret.=self::find_word($msg,$v,'',$id);}}
else $ret=self::find_word($msg,$rch,'',$id);
$out['count']=ses::$n; ses::$nb+=ses::$n;
$out['msg']=scroll($out['count'],clean_br_lite($ret),4,'','200');//610
return $out;}

static function prepare_tracks($id,$r,$opts){$ret=''; $trk='';
if($id==get('read')){$optk=$opts['tracks']??'';
	if(rstr(1) or $optk)$opt='true'; else $opt='';
	if($opt=='true'){$ret='<a name="track"></a>';
		$ret.=lj('popw','popup_tracks,form___'.$id,pictxt('forum',nms(168),24)).br();}
	if(count($r)>0)$trk=self::output_trk($r,$id); $_SESSION['cur_div']='content';
	$ret.=divd('track'.$id,$trk);}
return $ret;}

#article
static function build($id,$r,$msg,$prw,$tp='',$nl='',$n=''){if(!$id)return;
$rear=self::ib_arts_nb($id)+1; $otp=ma::read_idy($id,'ASC'); $trk=''; $nb='';
//cache needed for related, but stay sticked in threads
$r['opts']=self::metart($id);//$_SESSION['opts']?$_SESSION['opts']:
$tp=$tp?$tp:($r['opts']['template']??'');
$out['id']=$id; $out['suj']=$r['suj'];
if($r['re']==0)$out['css']='hide'; else $out['css']='';
if($prw==2)$out['thumb']=self::prepare_thumb($r['img'],$id,$nl);
if($prw=='rch')$out=self::prepare_rech($id,$msg,$out);
elseif($msg){$out['msg']=self::prepare_msg($id,$msg,$r,$prw,$nl);
	if(!$nl)$trk=self::prepare_tracks($id,$otp,$r['opts']);}
else $out['msg']=divd('art'.$id,'');
if(get('search'))$nb=$out['count']??'';
//elseif($prw=='score')$nb=sesr('score',$id);//jda
else $nb=$n;
$out=self::titles($id,$r,$rear,$otp,$prw,$nl,$nb,$out);
return bal('section',atd($id),self::template($out,$tp)).$trk."\n";}//.atn($id)//used by rstr31

//conn player
static function play_conn($msg,$conn){
$r=explode($conn,$msg); $n=count($r); $rb=[];
//if($conn=='.jpg')$conn='.jpg:exif';
if($r){for($i=0;$i<$n-1;$i++){$s=strrpos($r[$i],'[');
	if($s!==false){$id=substr($r[$i],$s+1);
		if($s2=strpos($id,'?'))$id=substr($id,0,$s2);
		if($id)$rb[$id]='['.$id.$conn.']';}}}
return implode("\n\n",$rb);}

#read
static function read($tp){$id=$_SESSION['read']; $tp=$tp?$tp:'read'; $prw=0;
$r=sql('ib,name,mail,day,nod,frm,suj,re,lu,img,thm,host,lg','qda','a','id='.$id); if(!$r)return;
ses::$r['imgrel']=pop::art_img($r['img'],$id); $nl=get('nl');
$msg=sql('msg','qdm','v','id="'.$id.'"');//msg
if($id && ($r['re']>='1' or auth(3) or ses('USE')==$r['name'])){$prw=3;
	$ret=self::build($id,$r,$msg,$prw,$tp,$nl);}
elseif($id && !$r['re'])$ret=divc('txtalert',helps('not_published'));
if(rstr(33))$ret.=self::ib_arts($id,$prw);
return $ret;}

//$r:day,frm,suj,img,nod,thm,lu,name,host,mail,ib,re,lg
//->ib,name,mail,day,nod,frm,suj,re,lu,img,thm,host,lg
static function art_datas($id){$r=ma::pecho_arts($id); if(!$r)return; $lg=$r[12]??'';
return ['ib'=>$r[10],'name'=>$r[7],'mail'=>$r[9],'day'=>$r[0],'nod'=>$r[4],'frm'=>$r[1],'suj'=>$r[2],'re'=>$r[11],'lu'=>$r[6],'img'=>$r[3],'thm'=>$r[5],'host'=>$r[8],'lg'=>$lg];}

//local_call/search/mod_load/popart
static function playb($id,$prw,$tp='',$nl='',$nb=''){if(!$id)return;
if($prw>2){geta('read',$id); $_SESSION['read']=$id; $tp=$tp?$tp:'read';}
if($id=='last')$id=ma::lastartid(); elseif(!is_numeric($id))$id=ma::id_of_suj($id);
$r=art::art_datas($id); $msg=''; ses::$r['suj']=$r['suj']??'';
if($id && !$r['re'] && !auth(4))return divc('txtalert',helps('not_published'));
if($prw>=2 or substr($prw,0,4)=='conn' or get('search'))
	$msg=sql('msg','qdm','v',$id);//1.2.3.nl//rstr(5)
$ret=art::build($id,$r,$msg,$prw,$tp,$nl,$nb);
if($prw==3)$ret.=art::ib_arts($id,$prw);//affiliates
return $ret;}

static function playc($id,$prw,$rch){//4ajax: only_content
if($prw>2)$_SESSION['read']=$id; else $_SESSION['read']='';
$r=art::art_datas($id); $r['opts']=art::metart($id);//$prw=art::slct_media($prw);
if(rstr(5) or $prw>2)$msg=sql('msg','qdm','v','id="'.$id.'"');
if($prw==3 && $rch)ses::$r['look']=$rch;
if($prw=='rch' && !$rch)$prw=2;//close after contradict rch
if($prw=='rch' && $rch){get('search',$rch); $out=art::prepare_rech($id,$msg,[]); $ret=$out['msg'];}
else $ret=art::prepare_msg($id,$msg,$r,$prw); $ret.=divc('clear','');
if(rstr(35))$ret=scroll(strlen($ret),$ret,1000,'','400',$id);//navig($id).
return $ret;}

static function playq($id,$prw,$r35,$quot=''){//quotes
if($prw>2)$_SESSION['read']=$id; else $_SESSION['read']='';
$r=art::art_datas($id); $r['opts']=art::metart($id);
$msg=sql('msg','qdm','v','id="'.$id.'"');
$msg=mk::apply_quote2($msg,$id,$prw,$r35,$quot);
$ret=art::prepare_msg($id,$msg,$r,$prw); $ret.=divc('clear','');
return $ret;}

static function playd($id,$prw,$tp='',$nl=''){//4ajax: reload inside
if($id=='last')$id=ma::lastartid(); elseif(!is_numeric($id))$id=ma::id_of_suj($id);
if($prw>2){geta('read',$id); $tp=$tp?$tp:'read';}//$prw=art::slct_media($prw);
$r=art::art_datas($id); if(!$r)return;
$r['opts']=art::metart($id);
$tp=$tp?$tp:($q['opts']['template']??''); $msg='';
if((rstr(5) or $prw>2) && $r['re'])$msg=sql('msg','qdm','v','id="'.$id.'"');// or auth(4)
$out['id']=$id; $out['suj']=$r['suj']; if(!$r['suj'])return 'not_exists';
$out['cat']=$r['frm'];
if(rstr(19))$out['img1']=pop::art_img($r['img'],$id);
if($prw==2)$out['thumb']=art::prepare_thumb($r['img'],$id,$nl);
$rear=art::ib_arts_nb($id)+1; $otp=ma::read_idy($id,'ASC');//tracks
$out=art::titles($id,$r,$rear,$otp,$prw,$nl,'',$out);
//if($prw=='rch')$out=self::prepare_rech($id,$msg,$out); else
if($msg)$out['msg']=art::prepare_msg($id,$msg,$r,$prw,$nl);//corps
$ret=art::template($out,$tp); //$ret=vue::build($tp,$out);
return $ret;}

static function playt($id,$otp,$tp=''){//tracks
$r=art::art_datas($id); //$otp=ma::read_idy($id,'ASC');
$r['opts']=art::metart($id); $trk=art::output_trk($otp,$id);
$out['id']=$id; $out['suj']=$r['suj'];
$out['css']=$r['re']==0?'hide':'';
$out=art::titles($id,$r,'',$otp,1,'',ses::$n,$out);
return bal('section',atd($id),art::template($out,$tp)).$trk."\n";}

static function look($id,$rch,$nb){
ses::$r['look']=$rch;
return art::playb($id,3);}

//tracks
static function trkone($id,$o=''){//,$lu,$img,$thm
$r=sql('id,ib,name,mail,day,nod,frm,suj,msg,re,host,lg','qdi','r','id='.$id);
return art::tracks_read($r,$o);}

static function trktxt($id){
$d=sql('msg','qdi','v','id='.$id);
//return conn::read($d,$id,'');
return codeline::call2($d,$id);}

#tracks
static function output_trk($r,$id=''){$ret='';
if(is_array($r))foreach($r as $k=>$v)$ret.=divd('trk'.$v[0],self::tracks_read($v));
return $ret;}

static function tracks_to($id){$to=sql('name','qdi','v','id='.$id);
return lj('popbt','popup_art,trkone___'.$id,'@'.$to);}

static function tracks_read($r,$o=''){
$USE=ses('USE'); $qb=ses('qb'); $read=ses('read');
$ip=hostname(); $out['css']='track'; $out['sty']='';
[$id,$ib,$name,$mail,$day,$nod,$frm,$suj,$msg,$re,$host,$lg]=$r;//frm=reply
if($re==0 && !auth(6))return;
if($id)$out['id']=$id;
$out['date']=mkday($day,'Y-m-d');//time_ago($day);
$out['url']=host().'/'.htacc('read').'/'.$id;
$out['edit']=''; $msgbt=''; $tks='';
if($re==0 && $host==$ip){$out['sty']='opacity:0.5;';
	$out['edit'].=btn('txtsmall',helps('trackbacks')).' ';}
if($re==2)$tks='20,240,20'; elseif($re==3)$tks='240,20,20'; elseif($re==4)$tks='20,20,240';
if($tks)$out['sty']='background-color:rgba('.$tks.',0.2);';
if($host==$ip && ($_SESSION['dayx']-$day)<600 or auth(6))//redit
	$out['edit'].=lj('','popup_tracks,redit___'.$id,picto('edit')).' ';
$out['author']=lj('','popup_tracks,form___'.$read.'_'.$id,$name==$qb?'admin':$name);
$rc=explode('/','/'.prmb(10));
$out['author'].=' '.btn('small','['.($rc[$re]??'').']');
$f='imgb/avatar_'.$name.'.gif';
if(is_file($f))$out['avatar']=image($f,48,48,ats('vertical-align:bottom;'));
$len=strlen($msg); 
if($re && $len>400 && !$o){$kmx=kmax_nb(800,$msg);
	if($len>$kmx){$msg=substr($msg,0,$kmx);
		$msgbt="\n".lj('','trkxt'.$id.'_art,trktxt___'.$id,nms(184));
		if($len>1000)$msgbt.=' '.btn('small',self::length($len));}}
//if($re!=0)$msg=conn::read($msg,'trk',$id); else $msg='';
if($re!=0)$msg=codeline::call2($msg,$id); else $msg='';
if(auth(4) && $frm!=$qb){$j='trk'.$id.'_tracks,publish___'.$id;
	if($re==0)$out['edit'].=lj('txtyl',$j.'_on',nms(29)).' ';
	else $out['edit'].=lj('',$j.'_off',offon(0)).' ';}
if((auth(4) or $USE==$name) && ($re==0 or auth(6)))$out['edit'].=lj('','trk'.$id.'_tracks,trash___'.$id,pictit('trash',nms(43),20)).' ';
$lng=ses('lng'); if(!$lg && rstr(129)){$lg=prmb(25);//yandex::detect('','',$msg);
	if($lg)update('qdi','lg',$lg,'id',$id);}
if($lg!=$lng)$out['edit'].=ljtog('','trkxt'.$id.'_yandex,call___trk'.$id.'_'.$lng.'-'.$lg,'trkxt'.$id.'_art,trktxt___'.$id,picto('translate')).' ';
if(auth(4)){$out['edit'].=togbub('tracks,trklang',$id,$lg?$lg:$lng).' ';
	$out['edit'].=togbub('tracks,trkstatus',$id,picto('category')).' ';
	$out['edit'].=togbub('tracks,trkowner',$id,picto('user',16)).' ';}
if(rstr(126)){$poll=sql('poll','qdf','v',['ib'=>$id,'type'=>'trkagree','iq'=>ses('iq')]);
	$out['edit'].=self::favs_edt($id,'trkagree',$poll);}
$out['msg']=divd('trkxt'.$id,$msg.$msgbt);
//$rb=ma::read_idy($read,'asc',$id); if($rb)$out['msg'].=self::output_trk($rb,$id);
if(is_numeric($frm))$out['edit'].=btn('small',nms(174)).' '.self::tracks_to($frm);//in_reply
return self::template($out,'tracks');}
}
?>