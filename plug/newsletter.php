<?php
//philum_plugin_newsletter

function nl_mklist(){$dpl=$_POST['dpl']; 
$dpl=str_replace(array("\n","\r"),",",$dpl); $r=explode(',',trim($dpl));
if($r)foreach($r as $v){$k=embed_detect($v,"<",">",""); $ret[$k]=$v;}
return $ret;}

/*function newsletter_msav($d,$i){
if(!$d){$n=1;$c='';}elseif(!rstr($k)){$n=0;$c='active';}
$ret[]=offon($n).' '.btn($cx,lj('','rstr_params___'.$k.'_'.$n,$v)).br();}*/

function newsletter_edit(){reqp('mail'); $r=mails_list();
$r=msql_read('',$_SESSION['qb'].'_mails','',1);
if($r)foreach($r as $k=>$v){$i++; $n='nl'.$i; $c=''; if($v[1])$c='active';
	$ret.=lj('',$n.'_newsletter___newsletter*mmsav',$k).br();}
return div(atd('nldt').atc('nbp'),$ret);}

function newsletter_read(){$here=host(); req('mod,art,pop,spe,tri',1);
$_SESSION['nl']='nl'; $ret=build_modules('newsletter',''); $_SESSION['nl']='';
$ret=str_replace('img src="img','img src="'.$here.'/img',$ret);
$ret=str_replace('img src="users/','img src="'.$here.'/users/',$ret);
$ret=str_replace('href="/','href="'.$here.'/',$ret);
return $ret;}

function newsletter_batch($p,$o,$res){$here=host(); $rs=ajxr($res);

$un=helps('newsletter_uns'); $url=htacc('id').$_SESSION['qb']; 
$from=$_SESSION['qbin']['adminmail']; $ret=newsletter_read();
$suj=$rs[0]?$rs[0]:$_SESSION['qb'].' '.mkday('',1);
if($rs[1])$r=nl_mklist(); else{reqp('mail'); $r=mails_list();}
if($r)foreach($r as $k=>$to){$i++;
	$uns=lkc('txtx',$here.'/?plug=mailist&p=uns&o='.$k,$un).br();
	if(trim($to))send_mail_html($to,$suj,$ret.$uns,$from,$url);}
return helps('newsletter_ok').' ('.$i.')';}

/*function newsletter_prep(){$suj=$_SESSION['qb'].' '.mkday('',1); reqp('mail');
return form("/?plug=newsletter&p=batch",input2(1,'suj',$suj,'" size="40').br().txarea('dpl',mail_list_tosend(),40,10,ats('40').atb('maxlength','10000')).br().input2('submit',"send",":: send ::",""));}*/

function newsletter_prep(){$suj=$_SESSION['qb'].' '.mkday('',1); reqp('mail');
$ret=inp('suj',$suj,sz(40)).txarea('dpl',mail_list_tosend(),40,10,ats('40').atb('maxlength','10000').br().lj('popsav','nws_plug___newsletter_newsletter*batch___suj|dpl','ok');
return divd('nws',$ret);}

function plug_newsletter($d){
if($d=='edit' && $_SESSION['auth']>5)$ret.=newsletter_prep();
if($d=='batch' && $_SESSION['auth']>5)$ret.=newsletter_batch();
if($d=='prep')$ret.=lj('popsav','popup_newsletter___newsletter*batch',nms(28));
return $ret;}

?>