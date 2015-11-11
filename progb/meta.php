<?php
//philum_ajax_meta

function utag_sav($id,$val,$msg,$cat){$msg=trim($msg);//space mean erase
list($vrf,$msb)=sql('id,msg','qdd','r','ib="'.$id.'" AND val="'.$val.'"');
$dat=rse('day',$_SESSION['qda'].' WHERE id="'.$id.'"');//synchrone
if($val=='folder')$msg=ajx($msg,1);
if($vrf && !$msg)delete('qdd',$vrf);//delete //$val;
elseif(!$vrf && $msg)insert('qdd','("", "'.$id.'", "'.$_SESSION['qb'].'", "'.$dat.'", "'.$cat.'", "'.$val.'", "'.$msg.'");');//saved //$val
elseif($msb!=$msg)update("qdd","msg",$msg,"id",$vrf);//modif //$vrf->$msg
$_SESSION['daya']=time();}

function getjx($d){$d=$_GET[$d]; if($d==' ')return;
return ajx(str_replace(array("<",">","%u2019"),array("","","'"),$d),1);}
function cache_value($id,$n,$v){
if($_SESSION['rqt'][$id])$_SESSION['rqt'][$id][$n]=$v;}

function save_tits_j($id){$qda=$_SESSION['qda']; $wh='id='.$id.'';
if($ib=getjx('ib')){$sql.='ib="'.$ib.'", '; cache_value($id,10,$ib);}
if($cat=getjx('frm1')){$sql.='frm="'.$cat.'", '; cache_value($id,1,$cat);}
if($suj=clean_title(getjx('suj'))){$sql.='suj="'.$suj.'", '; cache_value($id,2,$suj);}
if($img=getjx('img')){$sql.='img="'.$img.'", '; cache_value($id,3,$img);}
if($src=getjx('src')){$sql.='mail="'.$src.'", '; cache_value($id,9,$src);}
$tag=getjx('frm2'); update('qda','thm',$tag,'id',$id); cache_value($id,5,$tag);
if($sql)msquery('UPDATE '.$qda.' SET '.substr($sql,0,-2).' WHERE '.$wh.';');
$chsup=explode(' ',prmb(18)); $nb=count($chsup);
for($i=0;$i<$nb;$i++){if($_GET['frm'.($i+3)])//user_tags
	utag_sav($id,$chsup[$i],getjx('frm'.($i+3)),'tables');}
$r=$_SESSION["art_options"];//art_options
if($r)foreach($r as $k=>$v){$val=data_val("msg",$id,"options",$v); $gv=ajx($_GET[$v],1);
	if($v=="related" or $v=="float_img" or $v=="template" or $v=="folder")$vrf=" ";
	if($v=="authlevel"){if(rstr(21))$vrf="1"; else $vrf="all";}
	if($v=="tracks"){if(rstr(1))$vrf='true'; else $vrf='false';
		$gv=$gv==1?'true':'false';}
	if($v=="2cols"){if(rstr(17))$vrf='true'; else $vrf='false';
		$gv=$gv==1?'true':'false';}
	if($v=="lang"){$vrf=prmb(25);
		$arr=explode(" ",prmb(26));
		if($arr)foreach($arr as $ka=>$va){
		$valb=data_val("msg",$id,"options",'lang'.$va);
		if($_GET['lang'.$va]==$vrf && $val)$_GET['lang'.$va]=" ";
		if($_GET['lang'.$va] && $_GET['lang'.$va]!=$valb){
			utag_sav($id,'lang'.$va,$_GET['lang'.$va],'options');}}}
	if(!$val)$val=$vrf;//permut value with global setting
	if($gv==$vrf && $val)$gv=" ";//erase if not usefull
	if($gv && $gv!=$val)utag_sav($id,$v,$gv,'options');}}

function same_suj($suj){
$r=sql('id','qda','k','suj="'.$suj.'" AND nod="'.$_SESSION['qb'].'" ORDER BY id DESC');
foreach($r as $k=>$v){if($k!=$_SESSION["read"])$ret.=lka('/?read='.$k,$k).' ';}
if($ret)return btn('txtsmall','with_same_title: '.$ret);}

function prior_sav($v,$id){update('qda',"re",$v,"id",$id); cache_value($id,11,$v);
//if($v)cache_art($id); else 
return prior_edit($v,$id);}

function prior_edit($va,$id){$css='popbt';
$r=array(2=>picto('s1'),3=>picto('s2'),4=>picto('s3'));//0=>nms(30),1=>nms(29),
if($va==0)$ret.=lkc($css,'/?read='.$id.'&trash_art='.$id,picto('trash')).'';
if($va==0)$ret.=lkc($css.' active" title="'.nms(43),'/?read='.$id.'&delete_art='.$id,picto('del')).'';
$ret.=ljc($css,'rdbt'.$id,'meta_prior*sav_'.($va==0?1:0).'_'.$id,offon($va)).' ';
foreach($r as $k=>$v){$c=$k==$va?'active':''; 
	$j='rdbt'.$id.'_call___meta_prior*sav_'.($k==$va?1:$k).'_'.$id;
	$js=' var ob=document.getElementById(\'art\'+'.$id.'); ';
	if($k)$js.='ob.className=ob.className.replace(\'tab hide\',\'tab\');';
	else $js.='ob.className=ob.className.replace(\'tab\',\'tab hide\');';
	$ret.=balb('a',atc($css.' '.$c).atb('onclick',sj($j).$js),$v).'';}
return $ret;}

function edit_day($d,$id){
if($id && auth(5)){$r=explode('-',$d); 
$day=mktime($r[3],$r[4],0,$r[1],$r[2],$r[0]); update("qda","day",$day,"id",$id);
return lj('popw','chday'.$id.'_chday___'.$id,'date');}
else{$day=date('Y-m-d-H-i',rse("day", $_SESSION['qda'].' WHERE id="'.$d.'"'));
return input(1,'chd'.$d,$day,'').lj('popw','chday'.$d.'_chday_chd'.$d.'__'.$d,'ok');}}

function edit_dpl($id,$css){$use=$_SESSION['USE'];
if(auth(5)){$ret.=lj($css,'popup_deploy___'.$id,picto('mail')).'';
	$ret.=lj($css,'popup_export___'.$id,picto('export')).'';}
//if($_SESSION['mn'][$use] && $use!=$_SESSION['qb'])
///	$ret.=lj('','popup_export___'.$id.'_'.$use,picto('download')).' ';
return $ret;}

function jholder_b($v){return atv($v).atb('onFocus','if(this.value==\'/\')this.value=\'\'').atb('onBlur','if(this.value==\'\')this.value=\''.$v.'\'');}

function edit_tits($id,$prw){$css='poph';
list($ib,$day,$src,$suj,$frm,$img,$thm,$re)=sql('ib,day,mail,suj,frm,img,thm,re','qda','r','id="'.$id.'" LIMIT 1'); $csb='';
$nk='checkEnter(event,\'formtit'.$id.'\');';
$dn=array('ib','suj','img','src','frm1','frm2');
$ret.=submitj('','formtit'.$id,pictxt('save',nms(57)));//save
$ret.=select_j('ib'.$id,'parent',$ib,'',picto('topo'),1);
$ret.=ljb($css,"jumpvalue",'ib'.$id.'_/',picto('no')).' ';
if(auth(2))$ret.=btd('rdbt'.$id,prior_edit($re,$id)).' ';//priority
$ret.=lj($css,'popup_track___'.$id,picto('forum')).'';
$ret.=edit_dpl($id,$css).'';//deploy
if(auth(2))$ret.=btd('chday'.$id,lj('','chday'.$id.'_chday___'.$id,picto('time'))).'';
$ret.=balise("textarea",array(3=>'suj'.$id,16=>'height:34px; width:100%;'),$suj).br();//suj
$ret.=lj('poph','popup_placeim___'.$id,picto('img')).balise("input",array('','text','','img'.$id,$img,$csb,'36',255,$nk),'').lj('poph','img'.$id.'_recenseim__4_'.$id,picto('up')).br();//img
$ret.=lj('poph','',picto('link')).balise("input",array('','text','','src'.$id,$src,$csb,'36',255,$nk),'').br();//src
$ret.=cmption('cat',$id,$frm,0,'folder2');
$ret.=cmption('tag',$id,$thm,1,'tag');
if(prmb(18)){$ret.=utags($id);//usertags
	$r=explode(" ",prmb(18));//user_tags
	for($i=3;$i<count($r)+3;$i++)$dn[]='frm'.$i;}
$ret.=art_options($id);//art_options
foreach($_SESSION['art_options'] as $k=>$v)$dn[]=$v;
$r=explode(" ",prmb(26));//lang
if($r)foreach($r as $k=>$v)$dn[]='lang'.$v;
$js='SaveTits(\''.$id.'\',\''.implode('|',$dn).'\',\''.$prw.'\')';
$ret='<form id="formtit'.$id.'" action="javascript:'.$js.'">'.$ret.'</form>';
return $ret;}

//p:2=completion,1=popup,0=cat
function cmption_call($d,$id,$p,$ob){//SaveComp
if($p==2)$ret=br(); $css=$p!=2?'list':'nbp';
if(trim($ob) && $ob!='undefined'){
	if(strpos($ob,','))list($oa,$ob)=split_right(',',$ob,1); $ob=trim($ob);
	if(strlen($ob)<3)return; $wh=' AND msg LIKE "%'.$ob.'%"';}
if($p!=2)$cl=' Close(\'popup\');';
switch($d){
	case('cat'):$r=rech_meta('cat',30); break;
	case('tag'):$r=rech_meta('tag',90); if(!$r)rech_meta('tag',360); break;
	default:$ra=sql('msg','qdd','k','qb="'.$_SESSION['qb'].'" AND cat="tables" AND val="'.$d.'"'.$wh); if($ra)$r=tri_tags($ra); break;}
if($r){ksort($r); if($d=='cat'){$r["_system"]=1; $r["_trash"]=1;}
	foreach($r as $k=>$v){$kb=strtolower($k); //$ka=ajx($k); 
	$va=$oa?$oa.', '.$k:$k; if($ob)$ex=strpos($kb,strtolower($ob));
	if($ex!==false or !$ob)$rb[stripslashes($k)]=$va;}
	if($rb)foreach($rb as $k=>$v){$v=ajx($v); $k=str_replace(' ','&nbsp;',$k);
	$ret.=ljb('','jumpMenu_text(\'frm'.$id.'_'.addslashes($v).'_'.($p==1?', ':'').'\');'.$cl,'',$k).' ';}}
return scroll($rb,btn($css,$ret),30,300,$p==2?100:200);}

function cmption($d,$id,$v,$p,$ic){static $n; $n++;
//$ret=toggle('popw','slctj'.$n.$id.'_cmption_'.$d.'_'.$n.$id.'_'.$p,$d.'...');
$js='" onkeyup="SaveComp(\''.$d.'_'.$n.$id.'_2\');';//" autocomplete="off
$input=input(1,'frm'.$n.$id.'" style="width:280px;'.$js,$v,'');
$auto=toggle('poph','slctj'.$n.$id.'_autotag_'.$n.'_'.$id,$d);
$etc=lj('','popup_cmption___'.$d.'_'.$n.$id.'_'.$p,picto($ic?$ic:'folder'));//...
if($p)$del=ljb("poph","jumpvalue",'frm'.$n.$id.'_ ','x');
$div=span(atd('slctj'.$n.$id.'').atc('nbp'),'');
return $etc.' '.$auto.' '.$del.' '.$input.' '.$div.br();}

function utags($id){$ico=explode(' ',prmb(19));
$chsup=explode(' ',prmb(18)); $val=implode('" OR val="',$chsup);
$r=sql('val,msg','qdd','kv','ib="'.$id.'" AND (val="'.$val.'")'); 
if($chsup)foreach($chsup as $k=>$v)$ret.=cmption($v,$id,$r[$v],1,$ico[$k]);
return $ret;}

function lang_arts($id){$r=explode(' ',prmb(26));
if($r)foreach($r as $k=>$v){if($v)$ret[$v]=data_val('msg',$id,'options','lang'.$v);}
return $ret;}

function lang_arts_auto($id,$va){req('spe');
$artlang=data_val("msg",$id,"options",'lang');
if(!$artlang)$artlang=prmb(25);
$r=sql('ib','qdd','k','val="lang'.$artlang.'" AND msg="'.$id.'"');
if($r)foreach($r as $k=>$v){
	$artref=data_val("msg",$k,"options",'lang');
	if(!$artref && $va==prmb(25))$ret=$k;
	if($artref==$va)$ret=$k;}
if(!$ret && $k)$ret=data_val("msg",$k,"options",'lang'.$va);
return $ret;}

function each_words($d){$r=explode(' ',$d); $n=count($r);
for($i=0;$i<$n;$i++)$ret[$r[$i]]+=1;
return $ret;}

function autotag($n,$id){
$chsup=explode(" ",prmb(18));
$msg=rse("msg",$_SESSION['qdm'].' WHERE id="'.$id.'"');
$msg=html_entity_decode($msg);
if(strpos($msg,':import') or strpos($msg,':read'))$msg=strip_tags(format_txt($msg,$id,3));
else $msg=clean_internaltag($msg); $msg=strtolower(eradic_acc($msg)); $msg=deln($msg,' ');
$msg=str_replace("&nbsp;"," ",$msg);
if($n==2){$tagtype="tags"; //$words=$_SESSION['interm']; 
	$words=sql('thm','qda','k','nod="'.$_SESSION['qb'].'" AND day>"'.calc_date(30).'"');
	if(!$words)$words=sql('thm','qda','k','nod="'.$_SESSION['qb'].'" AND day>"'.calc_date(90).'"');
	if($words)$words=tri_tags($words);
	$current_tag=rse("thm",$_SESSION['qda'].' WHERE id="'.$id.'"');}
else{$tagtype=$chsup[$n-3];
	$current_tag=data_val("msg",$id,"options",$tagtype);
	$words=sql('msg','qdd','k','qb="'.$_SESSION['qb'].'" AND cat="tables" AND val="'.$tagtype.'"');}
	if($words){$words=tri_tags($words); $ra=each_words($msg);
		foreach($words as $k=>$v){
		$k=deln($k,''); $kb=strtolower(eradic_acc($k));
		if($ra[$kb])$currents[$k]=$ra[$kb]; 
		elseif(strpos($msg,$kb)!==false)$currents[$k]=0;}}
if($currents)foreach($currents as $k=>$v)if($k)$re[$k]=$v;//trim()
if($re)arsort($re); return $re;}

function auto_tag_j($n,$id){$r=autotag($n,$id);
if($r)foreach($r as $k=>$v)$ret.=addslashes($k).'|';
return br().jump_btns('frm'.$n.$id,substr($ret,0,-1),', ');}

function u_words($id){
$champs=explode(" ",'0 0 tags '.prmb(18));
$ico=explode(" ",'0 0 tag '.prmb(19));
foreach($champs as $k=>$v){$r=autotag($k,$id); $rt='';
	if($r){$rta=picto($ico[$k],24).' '; $tg=$k==2?'tag':eradic_acc($v);
	foreach($r as $ka=>$va){if($va)
	$rt.=lj('','popup_getcontent___'.$tg.'_'.$ka,$ka.' ('.$va.')').' ';}
		if($rt)$ret.=divc('nbp',$rta.$rt);}}
return $ret?$ret:nms(11);}

function art_options($id){
$r=$_SESSION["art_options"]; $arl=lang_arts($id);
if($r)foreach($r as $k=>$v){$val=data_val("msg",$id,"options",$v); $hlp='';
	if($v=='folder')$j='popup_addfolder___'.$id; else $j=''; 
	if($j)$ret.=picto('virtual').lj('poph',$j,$v).' '; 
	if($v=='related'){$picto='articles'; $hlp=hlpbt('meta_related');}
	elseif($v=='lang')$picto='global'; elseif($v=='template')$picto='conn'; else $picto='file';
	if(!$j)$ret.=picto($picto).btn('poph',$v).' ';
if($v=='authlevel')$ret.=menuderj_prep('all|1|2|3|4|5|6|7|8',$v.$id,$val,'1').' ';
elseif($v=="template"){$val=$val?$val:" ";
	$tmpub=msql_read('','public_template',$tpl,1);
	$tmprv=msql_read('',$_SESSION['qb'].'_template',$tpl,1);
	$arr=array_merge_b($tmpub,$tmprv); $arr[" "]=array(""=>1);
	$ret.=menuderj_prep(implode('|',array_keys($arr)),$v.$id,$val?trim($val):$v,'1').' ';}
elseif($v=="tracks"){if((rstr(1) && $val=="") or $val=='true')$chk=1; else $chk=0;
	$ret.=checkbox_j($v.$id,$chk).' ';}
elseif($v=="2cols"){if((rstr(17) && $val=="") or $val=='true')$chk=1; else $chk=0;
	$ret.=checkbox_j($v.$id,$chk);}
elseif($v=="lang"){if($arl){
	foreach($arl as $ka=>$va){
		if(($val!="" && $ka!=$val) or ($val=="" && $ka!=prmb(25))){
		$ret.=lj('txtsmall2',$v.$ka.$id.'_autolang__4_'.$id.'_'.$ka,$ka);
		$ret.=input(1,$v.$ka.$id,$va,'" size="4');}
		else $ret.=hidden('',$v.$ka.$id,'');}
	$ret.=hlpbt('meta_lang');
	$lang=data_val('msg',$id,'options','lang');//lang
	//$ret.=select_j('lang'.$id,'lang',$lang,1,$lang,0);
	$ret.=radiobtj($arl,$lang,'lang'.$id,1);}
	else $ret.=hidden('',$v.$id,''); $ret.=br();}
else $ret.=ljb('poph','jumpvalue',$v.$id.'_ ','x').' '.balise('input',array(1=>'text',3=>$v.$id,4=>$val,5=>'',6=>'14',7=>'255','autocomplete'=>'off'),'').$hlp.br();}
return $ret;}

//category
function slct_category($btid,$hid,$n){$frm=$_SESSION['frm'];
$r=sql('frm','qda','k','nod="'.$_SESSION['qb'].'" AND frm!="_system" AND frm!="_trash" AND day>"'.calc_date("360").'" ORDER BY frm');
if(auth(3))$r['_system']=1; if(!$r[$frm])$r[$frm]=1; $r['public']=1; unset($r['Home']); 
$ret=menuder_jb($r,$hid,$btid,2,$n);
return $ret;}

//folder
function slct_folder($id){
$r=sql('msg','qdd','k','qb="'.ses('qb').'" AND cat="options" AND val="folder"');
if($r)foreach($r as $k=>$v)
	$ret.=ljb('','jumpvalue(\'folder'.$id.'_'.addslashes($k).'\'); Close(\'popup\');','',$k);
return divc('list',$ret);}

//savetag
function tag_slct($id,$srch){$r=explode(' ','tag '.prmb(18));
foreach($r as $v)$ret.=lj('','svtg_savtag__x_'.ajx($v).'_'.$id.'_'.ajx($srch),$v).br();
return divc('nbp',$ret).divb('alert|svtg','');}

function tag_add($d,$v){
if(strpos($d,$v)!==false)return $d; 
elseif($d && $v)return $d.', '.$v;
elseif($v)return $v; else return $d;}

function savtag($t,$id,$v){
if($t=='tag'){$d=sql('thm','qda','v','id='.$id); $ret=tag_add($d,$v);
	squ('qda','thm="'.$ret.'"','id='.$id);}
elseif($t){$d=sql('msg','qdd','v','ib="'.$id.'" AND val="'.$t.'"'); $ret=tag_add($d,$v);
if($ret)utag_sav($id,$t,$ret,"tables");}
return $t.' set as: '.$ret;}

/*function tag_sav($id,$val,$msg,$cat){
$idtag=sql('id','qdt','v','tag="'.$val.'"');
if(!$idtag)$idtag=insert('idt','("","'.$val.'")');
$idmeta=sql('id','qdmt','v','ida="'.$id.'" and idt="'.$idtag.'"');
if(!$idmeta)$idmeta=insert('qdmt','("","'.$id.'","'.$idtag.'")');}*/

?>