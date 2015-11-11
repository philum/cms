<?php
//philum_plugin_ftp

function ftp_act($p,$f,$res){$res=ajxg($res);
if(!is_file($f))$ret='not exists';
elseif(!auth(7))$ret='no';
else switch($p){
	case('rename'):$fc=$p; $ret='renamed as '.$res;break;
	case('delete'):$fc='unlink'; $ret='was deleted'; $res=''; break;
	case('copy'):$fc=$p; $ret='copied at '.$res;break;
	case('infos'):$ret='infos: '.fsize($f).' '.ftime($f);break;
}
if($fc)$ok=call_user_func($fc,$f,$res);
if($fc && !$ok)return btn('txtyl','error');
return btn('txtyl',$ret);}

function ftp_ops($p,$f){$rid='inp'.randid();
$j='ops'.$rid.'_plug__2_ftp_ftp*act_'.ajx($p).'_'.ajx($f).'_'.$rid;
if($p=='rename' or $p=='copy')$ret=input(1,$rid,$f,'','',16).' '; 
else $ret=hidden('',$rid,$f).btn('txtx',$f).' ';
$ret.=lj('popbt',$j,pictxt('reload',$p));
return $ret.divd('ops'.$rid,'');}

function ftp_render($r){
$j='popup_plup___ftp_ftp*ops_';
if($r)foreach($r as $k=>$v){$f=$v[2]; $t=$v[3];
	$rb[$k][]=lkc('txtbox',$f,$t);
	$rb[$k][]=lj('txtx',$j.'rename_'.ajx($f),'rename');
	$rb[$k][]=lj('txtx',$j.'delete_'.ajx($f),'del');
	$rb[$k][]=lj('txtx',$j.'copy_'.ajx($f),'copy to');
	$rb[$k][]=lj('txtx',$j.'infos_'.ajx($f),'infos');
}
return make_divtable($rb);}

function ftp_j($p,$o,$res=''){list($p,$o)=ajxp($res,$p,$o); //$p='/'.$p;
sesv('pp',$p);
$r=explore($p,'',1);//pr($r);
if($r)foreach($r as $k=>$v)//p,v,f,t
	$rb[$k]=array($p,$v,$p.'/'.$v,strdeb($v,'.'));
return ftp_render($rb);}

/*function ftp_urls(){
foreach($r as $k=>$v)$ret.=;
return $ret;}*/

//plugin('ftp',$p,$o)
function plug_ftp($p,$o){$rid='plg'.randid(); 
$p=sesv('pp',$p);
//$ret=menuderj_prep('backup|progb|plug','inp',$p,1);
$ret=select_jb('inp','progb|plug',$p,1,'');
$j=$rid.'_plug__2_ftp_ftp*j___inp';
//$ret.=input(1,'inp',$p,'').' ';
$ret.=lj('',$j,picto('reload')).' ';
//$ret.=msqlink('',ses('qb').'_ftp').' ';
return $ret.divd($rid,ftp_j($p,$o));}

?>