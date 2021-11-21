<?php //philum/c
class mk{

static function xx($id,$va,$opt,$optb,$res=''){
return $ret;}

static function plan($id,$m,$d,$lk=''){
list($t,$o)=cprm($d); if($t)$t=btn('txtcadr',$t);
if(!is_numeric($id) or $m<3)return;
$d=sql('msg','qdm','v','id="'.$id.'"');
$r=explode("\n",$d); $ret=[]; $rb=[]; $rt=[]; $n1=0; $n2=0; $n3=0; $n4=0;
foreach($r as $k=>$v)switch(substr($v,-3)){
	case('h1]'):$rb[0][$k]=1; $rt[$k]=substr($v,1,-4); $n1=$k; break;
	case('h2]'):$rb[$n1][$k]=1; $rt[$k]=substr($v,1,-4); $n2=$k; break;
	case(':h]'):$rb[$n1][$k]=1; $rt[$k]=substr($v,1,-3); $n2=$k; break;
	case('h3]'):$rb[$n2][$k]=1; $rt[$k]=substr($v,1,-4); $n3=$k; break;
	case('h4]'):$rb[$n3][$k]=1; $rt[$k]=substr($v,1,-4); $n4=$k; break;
	case('h5]'):$rb[$n4][$k]=1; $rt[$k]=substr($v,1,-4); break;}
if(!isset($rb))return; $ret=taxonomy($rb,1);
if($lk && $rt)foreach($rt as $k=>$v)$rt[$k]=lk('/'.$id.'#h'.$k,$v);
if($o)return $t.divc('ulnone',make_ulb($ret[0],$rt,'ul'));
if(is_array($ret[0]))return $t.divc('topology',make_ul($ret[0],$rt,'ol'));}

static function progcode($d){$d=delbr($d,"\n");
ini_set('highlight.comment','orange');
ini_set('highlight.default','silver');
ini_set('highlight.html','red');
ini_set('highlight.keyword','cyan');
ini_set('highlight.string','silver; font-weight:bold');
$d=highlight_string('<'.'?php'."\n".$d,true);
return divs('overflow:auto; wrap:true; background:#222244;',trim($d));}

static function typo($d,$o){$ret='';
$ra=str_split($d); $n=count($ra);
$rb=msql::read('system','edition_ascii_8');
if(!is_numeric($o)){$k=in_array_r($rb,$o,1); $o=$rb[$k][0];} $na=$rb[$o][0];
$rd=array_flip(str_split('ARCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'));
foreach($ra as $k=>$v)if(is_numeric($v))$ret.=asciinb($v);
else $ret.=strpos(' ?./§,;:!$*',$v)!==false?$v:chr_b($na+$rd[$v]);
return $ret;}

static function scan_txt($d,$m){
list($f,$t)=split_one('§',$d,1); $ret='';
$f=goodroot($f); $tb=strend($f,'/'); if($t && $t!=1)$tb=$t;
if($m<3 or $t)return lj('txtx','popup_callp___pop-tri_scan*txt_'.ajx($f).'_3',pictxt('doc',$tb));
else{$ret=read_file($f); if($t==1)$ret=conn::read(conv::call($ret,1),'','');}
return $ret."\n\n".lkt('txtx',$f,$tb);}

static function translate($d,$m){if($m<3)return $d;
list($d,$lg)=cprm($d,'§');
$lng=ses('lng'); $setlg=$lng.'-'.$lg; $ref=rid($d,11);
$ret=yandex::callxt($d,$ref,$setlg,0);
return bal('blockquote','',$ret);}

//:msql
static function msqplay($r,$o=''){
$head=isset($r['_menus_'])?array_shift($r):'';
if(is_array($r)){
	if($o)$r=array_reverse($r);
	$ret=tabler($r,$head);
	return scroll($r,$ret,20);}
return $r;}

static function msqcall($com,$id,$o){
if(strpos($com,'§'))list($d,$p)=split_one('§',$com,1); else $d=$com; if(isset($p))$o=$p;
if(strpos($o,'|'))list($oa,$ob)=opt($o,'|'); else{$oa=$o; $ob='';}
switch($oa){
	case('pop'):return self::microread_pop($d); break;
	case('tmp'):return self::microread($d); break;
	case('conn'):return self::msqconn($d,$id,$ob); break;
	case('last'):return self::msqlasts($d,$ob); break;
	case('count'):return self::msqcount($d); break;
	case('bin'):return self::msqbin($d); break;
	case('graph'):return self::msqgraph($d); break;
	case('data'):return self::msqdata($d,$id); break;
	case('form'):return plugin('microform',$d,$id); break;
	case('twit'):return self::msqtwit($d); break;}
list($b,$nd)=split_right('/',$d);
$r=msql::goodtable_b($com);
if(auth(6))$bt=msqbt($b,$nd);
if(is_array($r))return self::msqplay($r,$o).$bt; else return $r;}

static function microread_pop($d){list($p,$o)=cprm($d);
return lj('','popup_msql___'.ajx($p),pictxt('msql2',$o));}

static function msqconn($d,$id,$ob){ $bt='';
list($d,$p)=split_one('§',$d);
$r=msql::goodtable($d);
list($b,$nd)=split_right('/',$d);
if(auth(6))$bt=msqbt($b,$nd);
if($r)foreach($r as $k=>$v)foreach($v as $kb=>$vb)$r[$k][$kb]=conn::parser(embed_links($vb));
return self::msqplay($r,$ob).$bt;}

static function msqlasts($d,$ob){list($d,$l)=split_one('§',$d,1);
$r=msql::goodtable($d); $n=count($r); $l=$l?$l:10; $l*=-1;
$r=array_slice($r,$l,$n,true); arsort($r);
return self::msqplay($r,$ob);}

static function msqcount($d){$r=msql::goodtable($d); $n=count($r);
if($n)return $n-1;}

static function msqbin($d){
$r=msql::goodtable($d);
$ima=picto('no'); $imb=picto('valid');
if(is_array($r)){
foreach($r as $k=>$v){
	if(is_array($v)){foreach($v as $ka=>$va){
		if($va=='0')$r[$k][$ka]=$ima; elseif($va==1)$r[$k][$ka]=$imb;}}
	else{if($v==0)$r[$k]=$ima; elseif($v==1)$r[$k]=$imb;}}
return tabler($r,1);}}

static function msqgraph($d){static $n; $n++; $pw=prma('content');
list($da,$rep)=split_one('§',$d,1); list($nd,$bs,$va,$op)=explode('_',$da);
if($bs){$nd=$nd?$nd:ses('qb');}else{$nd=ses('qb'); $bs=$d;}
$r=msql::goodtable($da); $menu=$r['_menus_']; unset($r['_menus_']);
if($r && $rep)foreach($r as $k=>$v){$i++; $bit[$k]=$v[$rep];}
elseif($r && $op){foreach($r as $k=>$v){$i++; $bit[$k]=$v;}}
$output='/imgc/'.ses('qd').'_'.$_SESSION['read'].'_graph_'.$n.'.png';
graphics($output,$pw,140,$bit,getclrs('',7),'yes');///
if($_GET['read'])return image($output,'','" style="border:0;')."\n";}

static function microread($d){list($nod,$tmp)=cprm($d);
return msqlvue::call($nod,$tmp);}

static function msqdata($d,$id){
list($v,$k)=split_right('§',$d); $k=$k?$k:1;
if($v){$ra=[$v];
	if($k){$msg=sql('msg','qdm','v','id='.$id);
	$msg=str_replace($d.':msq_data',$k.':msq_data',$msg); 
	update('qdm','msg',$msg,'id',$id);}
$r=msql::create('art_'.$id,$ra,['txt'],$k); return $r[$k][0];}
else $ret=msql::row('',nod('art_'.$id),$k);
if(auth(3))$ret.=msqbt('',ses('qb').'_art_'.$id,$k);
return $ret;}

//:thumb
static function thumb_d($im,$sz,$id){//web,vue,codeline
list($w,$h)=opt($sz,'/'); if(!$w)$w=cw();
if(substr($im,0,4)=='http')$imn=ses('qb').'_'.$id.'_'.substr(md5($sz),0,6).xt($im);
elseif(strpos($im,'/')!==false)$imn=str_replace('/','',$im); else $imn=$im;
$imb=img::thumbname($imn,$w,$h); $im=goodroot($im);
if(is_file($im) or substr($im,0,4)=='http'){$lmt='';//$_SESSION['rstr'][16];
	if(!file_exists($imb) or ses('rebuild_img'))make_mini($im,$imb,$w,$h,$lmt);
	return image($imb,$w,$h);}
else return picto('img',48);}

static function mini_d($da,$id,$nl){//im§w/h//conn_thumb//codeline
list($v,$p)=split_one('§',$da,1); $img=self::thumb_d($v,$p,$id);
if($nl)return image(goodroot($v),cw(),'');
else return popim($v,$img,$id);}

//:mini
static function mini_b($d,$id){//mode w/h max//adlin
list($im,$sz)=split_one('§',$d,1); if(!$sz)$sz='320/320';//prmb(27);
list($w,$h)=explode('/',$sz); list($wo,$ho,$ty)=getimagesize('img/'.$im);
list($w,$h)=img::sz($wo,$ho,$w,$h); $imb=img::thumbname($im,$w,$h);
if(!file_exists($imb) or ses('rebuild_img'))make_mini('img/'.$im,$imb,$w,$h,'');
return popim('img/'.$im,img('/'.$imb),$id);}

//:photos
static function thumb_b($f,$id){$xt=xt($f); $w=200; $h=140;
$imb=img::thumbname(str_replace('/','',$f),$w,$h);
if(!file_exists($imb) or ses('rebuild_img'))make_mini($f,$imb,$w,$h,$_SESSION['rstr'][16]);
return ljb('','SaveBf','photo_'.ajx($f).'___'.$id,img($imb));}

static function photos($da,$id){
list($r,$src)=good_src($da,$id); $ret='';
if(is_array($r))foreach($r as $k=>$v){$xt=xt($v);
	if(!$src)$dir=jcim($v); else $dir=$src; 
	if($xt=='jpg' or $xt=='gif' or $xt=='png')$ret.=self::thumb_b($dir.$v,$id);}
return $ret;}

//:gallery
static function gallery($d,$id){
list($r,$src)=good_src($da,$id);
if($r){rsort($r); foreach($r as $k=>$v){$f=$src.'/'.$v; if(is_file($f))$ret.=image($f);}}
return $ret;}

//:sliderj//old
static function sliderj($d,$id,$nl){if($nl)return;
list($f,$o)=split_one('§',$d,1);
return plugin('sliderJ',$f,$id,$o);}

static function slider_slct($da,$id,$d){$w=''; $h=''; $pw='';//ajax
list($id,$idn)=explode('-',$id); $dcb=ajx($da,''); $mp='impos'.$idn;
list($r,$src)=good_src($da,$id); $nb=count($r);
if(is_numeric($d))$_SESSION[$mp]=$d;
	elseif($d=='next')$_SESSION[$mp]++; elseif($d=='prev')$_SESSION[$mp]--;
if($_SESSION[$mp]>=$nb)$_SESSION[$mp]=0;
if($_SESSION[$mp]<0)$_SESSION[$mp]=$nb-1;
if(!$src)$dir=jcim($r[$_SESSION[$mp]]); else $dir=$src;
if(!isset($r[$_SESSION[$mp]]))return 1;
$im=$dir.$r[$_SESSION[$mp]]; $img=image($im,$pw,'');
if(is_file($im))list($w,$h)=getimagesize($im);
if($w>$pw)$ret=ljb('','SaveBf','photo_'.ajx($im,'').'_'.($w).'_'.($h),$img);
else $ret=$img;
return $ret;}

//:slieder
static function slider($da,$id,$nl){static $i; $i++; $rid='sldr'.$id.'-'.$i;
$j=$rid.'_slider___'.$id.'-'.$i.'_'.ajx($da,''); $_SESSION['impos'.$i]=0; if($nl)return;
$ret=divc('',lj('popbt',$j.'_prev',picto('kleft')).lj('popbt',$j.'_next',picto('kright')));
$img=self::slider_slct($da,$id.'-'.$i,0); if($img==1)return;
$ret.=divd($rid,$img);
return $ret;}

//:juke
static function jukebox($f,$m,$id){list($f,$t)=cprm($f);
if($m<3)return lj('','popup_callp___pop_jukebox_'.ajx($f).'_3',pictxt('music',$t?$t:'Jukebox'));
$r=explore('users/'.$f); $ret=''; $rb=[];
if($r)foreach($r as $k=>$v)$rb[ftime('users/'.$f.'/'.$v)]=$v; if($rb)krsort($rb);
if($rb)foreach($rb as $k=>$v)$ret.=lj('','juke'.$id.'_call___pop_audio_'.ajx('users/'.$f.'/'.$v).'§'.ajx($v).'_'.$id,ascii('speaker').' '.$v);//pictxt('music',$v)
$bt=divd('juke'.$id,audio('users/'.$f.'/'.$r[0],$id,$r[0]));
return $bt.divc('list',$ret);}

//:form
//$d='date=date,choix1/choix2=list,entrée1,entrée2,message=text,image=upload,mail=mail,ok=button';
static function form($d,$div,$jx){
$prod=explode(',',$d);$n=count($prod);
for($i=0;$i<$n;$i++){list($val,$type)=explode('=',$prod[$i]); $vb=normalize($val); 
if($type=='check'){$chk='chk'.$ia++; $hn[]=$chk;} elseif($type!='button')$hn[]=$vb;
switch($type){
	case('text'):$ret.=textarea($vb,'',44,8);break;
	case('check'):$ret.=checkbox($chk,'no','',''); break;
	case('hidden'):$ret.=hidden('',$vb,$val);break;
	case('uniqid'):$ret.=hidden('',$vb,ses('iq'));break;
	case('list'):$ret.=select(atd($vb),explode('/',$val),'vv'); break;
	case('date'):$ret.=hidden('',$vb,mkday('','ymd.his')); break;
	case('upload'):$ret.=input1($vb,'url','','',1); break;
	case('button'):$btn=$val;break;
	case('mail'):$ret.=bal('input',['type'=>'text','id'=>$vb,'size'=>20,'placeholder'=>$val,'onkeyup'=>'num_mail(\''.$vb.'\');'],''); break;
	default:$ret.=autoclic($val.'" id="'.$vb,'',20,255,'');break;}
if($type!='button' && $type!='date' && $type!='hidden' && $type!='uniqid')
	$ret.=' '.label($vb,$val,'txtsmall2').br();}
$ret.=lj('popsav',$div.$jx.implode('|',$hn),$btn?$btn:picto('after'));
return divd($div,$ret);}

}
?>