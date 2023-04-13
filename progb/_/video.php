<?php //a/video
class video{
static $rp=['youtube','youtu','vimeo','rumble','vk','rutube','dailymotion','framatube','crowdbunker','ted','livestream'];

static function detect($f,$o='',$t='',$op=''){$fb=$f;
//if(strpos($f,'/')===false)return '['.$f.'§'.$t.':'.$o.'video]';
$f=nohttp($f); $fa=httproot($f); $ret='';
if(strpos($f,'#'))$f=strto($f,'#'); $f=urldecode($f);//if(strpos($f,'?'))$f=strend($f,'?');
if(in_array($fa,self::$rp))switch($fa){
	case('youtube'): $f=strend($f,'?'); //if(strpos($f,'channel')!==false)return http($f);
	$p=strpos($f,'v='); $f=substr($f,$p+2); $pe=strpos($f,'&'); $tm='';
		if($pt=strpos($f,'&t='))$tm=substr($f,$pt+3,-1); if($tm)$tm='|'.$tm; $f=trim($f);
		if($pe!==false)$ret=subtopos($f,0,$pe).$tm; else $ret=$f; break;
	case('youtu'):$f=strto($f,'?'); $p=strrpos($f,'/'); if($p)$f=substr($f,$p+1); $pe=strpos($f,'?'); $tm='';
		if($pt=strpos($f,'&t='))$tm=substr($f,$pt+3); if($tm)$tm='|'.$tm; $f=trim($f);
		if($pe!==false)$ret=subtopos($f,0,$pe).$tm; else $ret=$f; break;
	case('dailymotion'):$f=strend($f,'?'); $ret=between($f,'video/','-');
		if(!$ret)$ret=substr($f,strpos($f,'video/')+6); break;
	case('vimeo'):$f=strto($f,'?'); $ret=substr($f,strrpos($f,'/')+1); break;
	case('vk'):$ret=between($f,'/video','_'); break;
	case('rumble'):$ret=between($f,'rumble.com/','-'); break;
	case('livestream'):$ret=between($f,'com/','/'); break;
	case('rutube'):$ret=between($f,'tracks/','.'); break;
	case('framatube'):$ret=strend($f,'/',1); break;
	case('crowdbunker'):$ret=strend($f,'/',1); break;
	default:return $fb;}
//elseif(strpos($f,'.mp4'))return $fb;
if($ret){
	if(is_img($t))$t=''; else $t=$o?'§'.($t?$t:1):'';
	if($op==2)return $ret;
	else return '['.$ret.$t.':video]';}}

static function extractid($g1,$o,$prm=[]){$p1=$prm[0]??$g1;
$d=video::detect($p1,'','',''); if(!$d)$d='['.$g1.':video]';
return $d;}

static function extractpr($f){
foreach(self::$rp as $k=>$v)if(strpos($f,$v))return $v;}

static function providers($d){
[$d,$tm]=expl('|',$d); $nb=strlen($d);
if($nb==32)$vid='rutube';
elseif($nb==7 && is_numeric($d))$vid='rutube'; //elseif($nb==9)$vid='vk';
elseif($nb==9 && is_numeric($d))$vid='vimeo';
//elseif($nb==11)$vid='crowdbunker';//collision with yt
elseif($nb==11 or $nb==9)$vid='youtube';
elseif($nb==6)$vid='rumble';
elseif($nb==5 or $nb==6 or $nb==7 or $nb==18 or $nb==19)$vid='daily';
elseif($nb==36)$vid='peertube';//d2a5ec78-5f85-4090-8ec5-dc1102e022ea
//elseif(strpos($d,'_'))$vid='ted';
else $vid='';//livestream
return $vid;}

static function url($d,$p){
[$d,$t]=expl('|',$d); if($t)$t='&t='.$t.'s';
if($p=='vimeo')$u='vimeo.com/'.$d;
elseif($p=='youtube')$u='youtube.com/watch?v='.$d.$t;
elseif($p=='rumble')$u='rumble.com/embed/'.$d;
elseif($p=='daily')$u='dailymotion.com/video/'.$d;
elseif($p=='ted')$u='https://embed.ted.com/talks/'.$d;
elseif($p=='peertube')$u='https://framatube.org/videos/watch/'.$d;
elseif($p=='crowdbunker')$u='https://crowdbunker.com/v/'.$d;
else $u=''; return $u;}

static function lk($d){[$d,$t]=cprm($d);
[$d,$tm]=expl('|',$d); if($tm)$tm='&t='.$tm.'s';
$p=self::providers($d); $u=self::url($d,$p); if($u)$u=http($u);
return lkt('',$u,pictxt('chain',$t?$t:$p));}

static function imgurl($id,$p){$u='';
if($p=='youtube')$u='https://img.youtube.com/vi/'.$id.'/hqdefault.jpg';
//elseif($p=='vimeo')$u='https://vimeo.com/'.$id;
//elseif($p=='daily')$u='https://dailymotion.com/video/'.$id;
//elseif($p=='peertube')$u='https://framatube.org/videos/watch/'.$id;
//elseif($p=='ted')$u='https://embed.ted.com/talks/'.$id;
return $u;}

static function img($d,$id,$im){
$f=ses('qb').'_'.$id.'_'.$d.'.jpg';
//$f=ses('qb').'_'.$id.'_'.substr(md5($f),0,6).'.jpg';//cafouil-img
if(!is_file('img/'.$f) or ses('rebuild_img')){
	$ok=@copy($im,'img/'.$f);
	if($ok){conn::add_im_img($f,$id); $im='img/'.$f;}}
else $im='img/'.$f;
return $im;}

static function txt($d,$id){
$p=self::providers($d); $u=self::url($d,$p);
if($u)[$ti,$tx,$im]=web::read($u,0,$id);
return divc('twit',$tx);}

static function titlk($d,$id){
$p=self::providers($d); $u=self::url($d,$p);
if($u)[$ti,$tx,$im]=web::read($u,0,$id);
return lka(http($u),$ti??'');}

static function imlk($d,$id){
$p=self::providers($d); $u=self::url($d,$p);
if($u)[$ti,$tx,$im]=web::read($u,0,$id);
return lk(http($u),image($im));}

static function play($d,$id,$m){[$d,$o]=cprm($d); //[$d,$tm]=expl('|',$d);
if(substr($d,0,4)=='http'){$p=self::extractpr($d); $d=self::detect($d,$m,'',2);}
else $p=self::providers($d);
$u=self::url($d,$p); $rid=rid($d); $im=''; $tx='';
if($u)[$ti,$tx,$im]=web::read($u,0,$id); else $ti=$o&&$o!=1?$o:$p;
if($im)$im=self::img($d,$id,$im);
if($im && !$o && $m>2)$j=$rid.'_video,call___'.ajx($d).'_'.$p.'_640';//$m=idtrack
elseif($o)$j='popup_video,call___'.ajx($d).'_'.$p.'_640';
else $j=$rid.'_video,call___'.ajx($d).'_'.$p.'_640';
$t=$o&&$o!='1'?$o:($ti);
if($p=='youtube' or $p=='vimeo')$ic=$p; else $ic='video';
$lk=lkt('',http($u),$t);
if($im && ((!$o && $m>2) or $m=='vd'))$ic=image($im); else $ic=picto($ic,28);
$bt=lj('',$j,$ic).'&#8239;';
//if($tx)$lk.=' '.pop::bubble_note($tx,picto('lys')).' ';//toggle_note//togbth//togbt//pop::toggle_div($tx,1)
if($tx)$lk.=' '.togbub('video,txt',ajx($d).'_'.$id,picto('lys')).' ';
if(auth(4))$lk.=lj('','popup_web,redit___'.ajx($u).'_'.$rid.'_'.$id,picto('editxt'));
if($m=='vd')$ret=div(atc('video').atd($rid),$bt).$lk;
elseif($o)$ret=span(att($ti).atd($rid),$bt.$lk);
elseif($m<3 or $m=='noimages')$ret=btd($rid,$bt.$lk);
else $ret=div(atc('video').atd($rid),$bt).btn('small',$lk);
return $ret;}

static function any($d,$id,$m,$nl=''){//p§w/h
if($nl)return self::lk($d);
if(strpos($d,'.mp4') or strpos($d,'.m3u8'))return video($d);//if(!$d2)
if(rstr(132) or $id=='epub')return self::player($d2,$id);
if(substr($d,0,4)=='http'){[$d,$tx]=cprm($d);//contourne procédure
	$pr=self::extractpr($d); $d2=self::detect($d,$m,'',2);
	if($tx)return self::play($d,$id,$m?$m:3);
	else return self::reader($d2,$pr,'','',$id);}
else $d2=$d;
return self::play($d2,$id,$m?$m:3);}

static function call($d,$p,$w){
return self::reader($d,$p,$w,'','');}

static function player($d){
[$d,$o]=expl('§',$d);
if($o)return self::lk($d);
$p=self::providers($d); $w=prma('content')-80;
return self::reader($d,$p,$w,'','');}

static function reader($d,$p,$w,$h,$id){
if($id){$w='100%'; $h=($h?$h-10:320).'px';}
else{if($w==1)$w=''; if(!$h && $w)$h=$w*0.5; $w=$w?$w:440; $h=$h?$h:320; $w.='px'; $h.='px';}
[$d,$tm]=expl('|',$d); if($tm)$tm='?start='.$tm; else $tm='';
if($p=='youtube')return iframe('https://www.youtube.com/embed/'.$d.''.$tm,$w,$h);
elseif($p=='rumble')return iframe('https://rumble.com/embed/'.$d,$w,$h);
elseif($p=='daily')return iframe('https://www.dailymotion.com/embed/video/'.$d,$w,$h);
elseif($p=='vimeo'){return iframe('https://player.vimeo.com/video/'.$d,$w,$h);}
elseif($p=='vk')return iframe('https://vk.com/video_ext.php?oid='.$d.'&hd=2',$w,$h);
elseif($p=='peertube')return iframe('https://framatube.org/videos/embed/'.$d,$w,$h);
elseif($p=='crowdbunker')return iframe('https://crowdbunker.com/embed/'.$d,$w,$h);
elseif($p=='rutube')return iframe('https://video.rutube.ru/'.$d,$w,$h);//to verif
elseif($p=='ted')return iframe('https://video.ted.com/'.$d,$w,$h);//to verif
elseif($p=='vk')return iframe('https://video.vk.com/'.$d,$w,$h);//to verif
elseif(substr($d,0,4)=='http')return iframe($d);}
}
?>