<?php //newsletter
class newsletter{

static function nl_mklist(){$dpl=$_POST['dpl']; 
$dpl=str_replace(array("\n","\r"),',',$dpl); $r=explode(',',trim($dpl));
if($r)foreach($r as $v){$k=between($v,'<','>'); $ret[$k]=$v;}
return $ret;}

static function msav($d,$i){
if(!$d){$n=1;$c='';}elseif(!rstr($k)){$n=0;$c='active';}
$ret[]=offon($n).' '.btn($cx,lj('','rstr_params___'.$k.'_'.$n,$v)).br();}

static function edit(){$r=mails::datas();
$r=msql::read('',nod('mails'),'',1);
if($r)foreach($r as $k=>$v){$i++; $n='nl'.$i; $c=''; if($v[1])$c='active';
	$ret.=lj('',$n.'_newsletter,mmsav',$k).br();}
return div(atd('nldt').atc('nbp'),$ret);}

static function read(){$here=host();
geta('nl',1); $ret=mod::block('newsletter',''); getz('nl');
$ret=str_replace('img id="rez" src="imgc/','img src="'.$here.'/imgc/',$ret);
$ret=str_replace('img id="rez" src="img/','img src="'.$here.'/img/',$ret);
$ret=str_replace('img src="users/','img src="'.$here.'/users/',$ret);
$ret=str_replace('href="/','href="'.$here.'/',$ret);
return $ret;}

static function batch($p,$o,$rs=[]){$here=host();
$un=helps('newsletter_uns'); $url=htacc('hub').$_SESSION['qb']; 
$from=$_SESSION['qbin']['adminmail']; $ret=self::read();
$suj=$rs[0]?$rs[0]:$_SESSION['qb'].' '.mkday('',1);
if($rs[1])$r=nl_mklist(); else $r=mails::datas();
if($r)foreach($r as $k=>$to){$i++;
	$uns=lkc('txtx',$here.'/app/mailist/uns/'.$k,$un).br();
	if(trim($to))mails::send_html($to,$suj,$ret.$uns,$from,$url);}
return helps('newsletter_ok').' ('.$i.')';}

static function prep(){
$suj=$_SESSION['qb'].' '.mkday('',1);
$ret=input('suj',$suj,'40').br();
$ret.=textarea('dpl',mails::datas(1),40,10,['size'=>'40','maxlength'=>'10000']).br();
$ret.=lj('popsav','nws_newsletter,batch_suj,dpl','ok');
return divd('nws',$ret);}

static function home($d){$ret='';
if($d=='edit' && $_SESSION['auth']>5)$ret.=self::prep();
if($d=='batch' && $_SESSION['auth']>5)$ret.=self::batch();
if($d=='prep')$ret.=lj('popsav','popup_newsletter,batch',nms(28));
return $ret;}
}
?>