<?php 
/*fill the table cron with [$tablename=>[$twitteruser]]*/
//cron: wget -i /home/umm/_backup/ 'http://site.com/call/cron' -O cron.txt
class cron{
static $cb='crn';
static $cr=[];

/**/static function followers($p){
$t=twit::init(); $qu=$t->followers($p,''); //pr($q);
$r=self::usrlist($q['ids']); //pr($q);
return;}

/**/static function favorites($p){
$t=twit::init(); $q=$t->favorites($p,$id,1); //pr($q);
$r=self::datas($q); //pr($r);
//$ret=twit::batch($q,'');
//$ret=twit::play($k,$r,$q,$o);
return;}

static function rapport($p){
$r=msql::kv('',nod('cron')); $ret=''; $rt=[];
foreach($r as $k=>$v){$nod=nod('cron_'.$k);
	$rb=msql::assoc('',$nod); if(!$rb)$rb=self::reload($k);
	$r0=array_shift($rb); $r0=array_shift($rb);
	foreach($rb as $kb=>$vb){$rd=array_diff($vb,$r0);
		$date=$rd['date']; unset($rd['date']);
		if($rd['status-id']??'')$rd['status-id']=pop::poptwit($rd['status-id']);
		$rt[$date]=divb($k.' / '.$date.' - '.key($rd).': '.current($rd));
		$r0=$vb;}}
krsort($rt);
return implode('',$rt);}

static function read($p){
if($p==2)self::call('','');
$r=msql::kv('',nod('cron')); $ret=''; $bt=''; $h=0;
$f='_backup/cron_last.txt'; if($p && is_file($f))$ret=btn('txtred',read_file($f)).' ';
foreach($r as $k=>$v){$nod=nod('cron_'.$k);
	$rb=msql::assoc('',$nod,'',1); if(!$rb)$rb=self::reload($k);
	$r2=array_pop($rb); $r1=array_pop($rb); $rd=array_diff($r2,$r1);
	$date=$rd['date']; unset($rd['date']); self::$cr[$k]=$date;
	if($date!=self::$cr[$k]){$h=1; self::$cr[$k]=$date;}//active then shutdown sound
	if($rd['status-id']??'')$rd['status-id']=pop::poptwit($rd['status-id']);
	if($p==1)$ret.=divc('frame-blue',$k).tabler(array_merge_cols($r2,$r1),['new','old'],1);
	$bt.=tabler($rd,[$date,$k]);}
$bt.=lj('','crn_cron,read___'.yesno($p),togon($p,'details')).' ';
$bt.=lj('','popup_cron,rapport',picto('script')).' ';
return $bt.$ret.hidden('dong',$h);}

static function play($p){$bt='';
$bt=lj('','crn_cron,read',picto('reload'),att('reload')).' ';
$bt.=lj('','crn_cron,call',picto('refresh'),att('run cron')).' ';
$bt.=btj(picto('start'),atjr('jtimbt',['crnbt','crn_cron,read__27_',60000]),'','crnbt',['title'=>'runtime']);
if(auth(6))$bt.=msqbt('',nod('cron'));
$ret=self::read($p);
return $bt.divd('crn',$ret);}

static function card($p){
$t=twit::init(); $q=$t->show($p); //pr($q);
unset($q['entities']);
$q['withheld_in_countries']=implode(',',$q['withheld_in_countries']);
$q['description']=($q['description']);//utf8dec_b
$q['location']=($q['location']);
$q['name']=utf2ascii($q['name']);
$q['status-created_at']=$q['status']['created_at']??'';
$q['status-id']=$q['status']['id']??'';
$q['status-reply-id']=$q['status']['in_reply_to_status_id']??'';
$q['status-reply_name']=$q['status']['in_reply_to_screen_name']??'';
if(isset($q['status']))unset($q['status']);
return $q;}

static function build($nm,$usr){$d=date('ymd.Hi');
$r=self::card($usr); $r['date']=$d; $rc=[]; $rd=[]; $bt='';
write_file('_backup/cron_last.txt',$d);
$rh=array_keys($r);
$nod=nod('cron_'.$nm);
$rb=msql::assoc('',$nod,'',1);
if($rb)$rc=array_pop($rb);
if(!$rc)$rc=array_flip($rh);
if($rc)$rd=array_diff($r,$rc); //$bt=tabler(array_merge_cols($r,$rc));
if(isset($rd['friends_count']) && $rd['friends_count']===0)unset($rd['friends_count']);
if(isset($rd['listed_count']) && $rd['listed_count']===0)unset($rd['listed_count']);
unset($rd['date']); //pr($rd);
if($rd or !$rb)$r=msql::modif('',$nod,$r,'push',$rh,'');
$ret=$d.'/'.$nm.': '.implode_k($rd,'; ','=');
//if($rd)mail(sesr('qbin','adminmail'),'cron',$ret);
return $ret.$bt;}

static function call($p,$o,$prm=[]){
$p=$prm[0]??$p; $rt=[];
$f='_backup/cron.txt'; if(is_file($f))unlink($f);
$r=msql::kv('',nod('cron')); //pr($r);
foreach($r as $k=>$v)$rt[]=self::build($k,$v);
$ret=implode(' | ',$rt);
return $ret;}

static function reload($k){
self::call('','');
$nod=nod('cron_'.$k);
return msql::assoc('',$nod,'',1);}

static function menu($p,$o){$bid='inp';
$j=self::$cb.'_cron,call_'.$bid.'_2__'.$o;
$ret=inputj($bid,$p,$j);
$ret.=lj('',$j,picto('ok')).' ';
return $ret;}

static function home($p,$o){
$bt=self::menu($p,$o);
$ret=self::call($p,$o);
return $bt.divd(self::$cb,$ret);}
}
?>