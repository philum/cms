<?php
//philum_plugin_mail

//deploy
function vmail($id){
$ids='vmfrom'.$id.'|vmto'.$id.'|vmsg'.$id;
$ret.=btn('right',lj('popsav','vsd'.$id.'_plug___mail_vmailsend_'.$id.'__'.$ids,nms(28)));
if($_SESSION['USE'])$ret.=hidden('','vmfrom'.$id,$_SESSION['qbin']['adminmail']);
else{$ret.=label('vmfrom'.$id,'popw','',nms(68).':').' ';
$ret.=input(1,'vmfrom'.$id,'','" size="24').br();}
if(auth(4))$ret.=lj('txtbox','popup_plup___mail_mail*prep_vmto'.$id,nms(36));
else $ret.=btn('txtx',nms(36));
$ret.=input(1,'vmto'.$id,'','" size="24').br();
$ret.=txarea('vmsg'.$id,'',44,2);
return divd('vsd'.$id,$ret);}

function vmailsend($id,$o,$res){
req('pop,spe,tri,mod');
$http=host(); $htacc=urlread($id);
list($from,$to,$txt,$suj)=ajxr($res);
if(strpos($to,"@")!==false){
$suj=sql('suj','qda','v','id="'.$id.'"');
$msg=divc("panel justy",$txt);
$msg.=lkc("",$http.$htacc,bal("h2",$suj));
$msg.=divc("panel justy",read_msg($id,"nlb"));
send_mail("html",$to,$suj,$msg,$from?$from:hostname(),$htacc);
return btn("popbt",nms(34).' '.nms(79).' '.nms(36).': '.$to);}
else return btn("popdel",'error'.$to);}

function mails_list(){
$r=msql_read('',$_SESSION['qb'].'_mails','',1);
if($r)foreach($r as $k=>$v){if($v[2])$ret[$v[0]]=$v[1].'<'.$v[0].'>';}
return $ret;}

function mail_list_tosend(){$r=mails_list();
if($r)return implode(",\n",$r);}

function mail_mails(){$r=mails_list(); 
if($r)foreach($r as $k=>$v){$vb=embed_detect($v,'<','>',''); $ret[$vb?$vb:$v]=1;}
if($ret)ksort($ret);
return $ret;}

function mail_prep($id){$r=mail_mails();
if($_SESSION['auth']<3)$r=array($_SESSION['qbin']['adminmail']=>1);
if($r){ksort($r); foreach($r as $k=>$v){
	$j='jumpvalue(\''.$id.'_'.addslashes($k).'\'); Close(\'popup\');';
	$ret.=ljb('txtx',$j,'',str_extract('@',$k,0,0)).' ';}
return divc('nb_pages',$ret);}}

function mail_send($id,$va,$res){
//if($_SESSION['auth']<3)return btn('txtred','bruuu must_be_loged');
$j='popup_plup__x_mail_plug*mail'; list($from,$to,$txt,$suj)=ajxr($res);
if(strpos($to,'@')!==false && $txt && $to && $from){
send_mail('html',$to,$suj?$suj:host(),divc('justy',$txt),$from?$from:hostname(),'');
return lj('txtyl',$j,nms(79).' '.nms(36).': '.$to);}
else return lj('txtyl',$j,'error');}

function plug_mail($to){$id=randid();
$adm=$to?$to:$_SESSION['qbin']['adminmail'];
$ids='vmfrom'.$id.'|vmto'.$id.'|vmsg'.$id.'|vmsuj'.$id;
$ret.=lj('txtbox','vsd'.$id.'_plug___mail_mail*send___'.$ids,nms(28)).' ';
if($_SESSION['auth']<3)$ret.=input(0,'vmto'.$id,$adm,'').btn('txtx',$adm);
else{$ret.=lj('txtbox','popup_plup___mail_mail*prep_vmto'.$id,nms(36));
$ret.=input(1,'vmto'.$id,$to.'" size="34','');} $ret.=br();
$ret.=input(1,'vmsuj'.$id,'" size="56" placeholder="'.nms(71),'').br();
$ret.=txarea('vmsg'.$id,'',54,8).br();
if($_SESSION['USE'])$ret.=hidden('','vmfrom'.$id,$adm);
else{$ret.=label('vmfrom'.$id,'txtblc','','From:').' '.input(1,'vmfrom'.$id,'').' ';}
return divd('vsd'.$id,$ret);}

?>