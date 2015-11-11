<?php
//philum_plugin_tools
session_start();
error_reporting(6135);
if(!function_exists('p'))require('prog/lib.php');

function authok($d){
$ok=sql('id','qdu','v','name="'.$_SESSION['qb'].'" AND pass=PASSWORD("'.$d.'")');
if($ok)return true; else echo btn('txtyl','bruuu bad_password');}
function removef($j,$k,$v,$io){echo divc('txtyl',"$j/$k");
if($v)unlink($j.'/'.$v); else{rename($j.'/'.$k,$j.'/x'); rmdir($j.'/'.$k);}}

function tools_mdf_utags($da,$db,$dc){
	$sq=$_SESSION['qdd'].' WHERE qb="'.$_SESSION['qb'].'" AND cat="tables"';
	$rq=res("id,ib,msg",$sq.' AND val="'.$db.'" AND msg LIKE "%'.$da.'%"');
	while($data=mysql_fetch_array($rq)){
	$repl=tools_tags_op($data['msg'],$da,1);
	update('qdd','msg',$repl,"id",$data['id']);
	//utag_sav($data['ib'],$dc,($repl?$repl:' '),'tables');
	$new=rse("msg",$sq.' AND val="'.$dc.'" AND ib="'.$data['ib'].'"');
	//if(strpos($new,$da)===false)$repl=$new?$new.', '.$da:$da; else $repl=$new;
	//$repl=tools_tags_op($new,$da,$da);
	$ra=tri_tag($new);
	$k=in_array_b($da,$ra);
	if($k===false)$ra[]=$da;
	if($ra)$repl=implode(', ',$ra);
	utag_sav($data['ib'],$dc,($repl?$repl:' '),'tables');}
return $i;}

function tools_mdf_cat_to_tag($da,$db){req('meta');
	$sq=$_SESSION['qda'].' WHERE nod="'.$_SESSION['qb'].'"';
	$rq=res("id,thm",$sq.' AND frm="'.$da.'"');
	while($data=mysql_fetch_array($rq)){
	update('qda','frm',$db,"id",$data['id']);
	$repl=tools_tags_op($data['thm'],$da,$db);
	/*$ra=tri_tag($data['thm']);
	$k=in_array_b($da,$ra); if($k!==false)$ra[$k]=$db;
	if($ra)$repl=implode(', ',$ra);*/
	if($repl!=$data['thm']){$i++;
	update('qda','thm',$repl,"id",$data['id']);}}
return $i;}

function tools_mdf_tag_to_u($da,$db,$dc){req('meta');
	$sq=$_SESSION['qda'].' WHERE nod="'.$_SESSION['qb'].'"';
	$rq=res("id,thm",$sq.' AND thm LIKE "%'.$da.'%"');
	while($data=mysql_fetch_array($rq)){
	$repl=tools_tags_op($data['thm'],$da,1);
	/*$ra=tri_tag($data['msg']);
	$k=in_array_b($da,$ra); if($k)unset($ra[$k]);
	if($ra)$repl=implode(', ',$ra);*/
	if($repl!=$data['msg']){
	update('qda','thm',$repl,"id",$data['id']);
	$new=rse("msg",$_SESSION['qdd'].' WHERE qb="'.$_SESSION['qb'].'" AND cat="tables" AND val="'.$dc.'" AND ib="'.$data['id'].'"'); 
	if(strpos($new,$da)===false)$repl=$new?$new.', '.$da:$da; else $repl=$new;
	utag_sav($data['id'],$dc,($repl?$repl:' '),'tables');}}
return $i;}

function tools_mdf_u_to_tag($da,$db,$dc){
	$sq=$_SESSION['qdd'].' WHERE qb="'.$_SESSION['qb'].'" AND cat="tables"';
	$rq=res("id,ib,msg",$sq.' AND val="'.$db.'" AND msg LIKE "%'.$da.'%"');
	while($data=mysql_fetch_array($rq)){
	$repl=tools_tags_op($data['msg'],$da,1);
	/*$ra=tri_tag($data['msg']);
	$k=in_array_b($da,$ra); if($k)unset($ra[$k]);
	if($ra)$repl=implode(', ',$ra);*/
	if($repl!=$data['msg']){
	update('qdd','msg',$repl,"id",$data['id']);
	//utag_sav($data['ib'],$dc,($repl?$repl:' '),'tables');
	$new=rse("thm",$_SESSION['qda'].' WHERE id="'.$data['ib'].'"'); 
	if(strpos($new,$da)===false)$repl=$new?$new.', '.$da:$da; else $repl=$new;
	if($repl!=$data['msg']){$i++;
	update('qda','thm',$repl,"id",$data['ib']);}}}
return $i;}

function tool_replacetag($da,$db){
	$sq=$_SESSION['qda'].' WHERE nod="'.$_SESSION['qb'].'"';
	$rq=res("id,thm",$sq.' AND thm LIKE "%'.$da.'%"');
	while($data=mysql_fetch_array($rq)){
	$repl=tools_tags_op($data['thm'],$da,$db);
	/*$ra=tri_tag($data['thm']);
	$k=in_array_b($da,$ra); if($k!==false)$ra[$k]=$db;
	if($ra)$repl=implode(', ',$ra);*/
	if($repl!=$data['thm']){$i++;
	update('qda','thm',$repl,"id",$data['id']);
	}}
return $i;}

function tool_replace_utag($da,$db,$dc){
	$sq=$_SESSION['qdd'].' WHERE qb="'.$_SESSION['qb'].'" AND cat="tables"';
	$rq=res("id,ib,msg",$sq.' AND val="'.$da.'" AND msg LIKE "%'.$db.'%"');
	while($data=mysql_fetch_array($rq)){
	$repl=tools_tags_op($data['msg'],$db,$dc);
	/*$ra=tri_tag($data['msg']);
	$k=in_array_b($db,$ra); if($k!==false)$ra[$k]=$dc;
	if($ra)$repl=implode(', ',$ra);*/ 
	if($repl!=$data['msg']){$i++;
	update('qdd','msg',$repl,"id",$data['id']);
	}}
return $i;}

/*function tool_special($da,$db){
	$sq=$_SESSION['qda'].' WHERE nod="'.$_SESSION['qb'].'"';
	$rq=res("id,thm",$sq.' AND thm LIKE "%'.$da.'%"');
	while($data=mysql_fetch_array($rq)){
	$new=rse("msg",$_SESSION['qdd'].' WHERE qb="'.$_SESSION['qb'].'" AND cat="tables" AND val="type" AND ib="'.$data['id'].'"');
	if(strpos($new,$db)!==false){$i++;
	$repl=str_replace(', '.$da,'',$data['thm']);
	$repl=str_replace($da.', ','',$data['thm']);
	if($data['thm']==$da)$repl='';
	update('qda','thm',$repl,"id",$data['id']);}}
return $i;}*/

function tools_replace_utag_class($da,$db){
	$sq='qb="'.$_SESSION['qb'].'" AND cat="tables" AND val="'.$da.'"';
	msquery('UPDATE '.$_SESSION['qdd'].' SET val="'.$db.'" WHERE '.$sq.'');
	$prms=rse('config',$_SESSION['qdu'].' WHERE name="'.$_SESSION['qb'].'"');
	$prms=str_replace($da,$db,$prms);
	msquery('UPDATE '.$_SESSION['qdu'].' SET config="'.$prms.'" WHERE name="'.$_SESSION['qb'].'"');
	$_SESSION['prmb'][18]=str_replace($da,$db,$_SESSION['prmb'][18]);	
return 'ok';}

//
function tools_del_tag($da){
	$sq=$_SESSION['qda'].' WHERE nod="'.$_SESSION['qb'].'"';
	$rq=res("id,thm",$sq.' AND thm LIKE "%'.$da.'%"');
	while($data=mysql_fetch_array($rq)){
	$repl=tools_tags_op($data['thm'],$da,1);
	/*$ra=tri_tag($data['thm']);
	$k=in_array_b($da,$ra); if($k!==false)unset($ra[$k]);
	if($ra)$repl=implode(', ',$ra);*/
	if($repl!=$data['thm']){$i++;
	update('qda','thm',$repl,"id",$data['id']);
	}}
return $i;}
function tools_del_utag($da,$db){
	$sq=$_SESSION['qdd'].' WHERE qb="'.$_SESSION['qb'].'" AND cat="tables"';
	$rq=res("id,ib,msg",$sq.' AND val="'.$da.'" AND msg LIKE "%'.$db.'%"');
	while($data=mysql_fetch_array($rq)){
	$repl=tools_tags_op($data['msg'],$db,1);
	/*$ra=tri_tag($data['msg']);
	$k=in_array_b($db,$ra); if($k!==false)unset($ra[$k]);
	if($ra)$repl=implode(', ',$ra); */
	if($repl!=$data['msg']){$i++;
	update('qdd','msg',$repl,"id",$data['id']);
	}}
return $i;}

function tools_tags_op($d,$db,$op){
	$ra=tri_tag($d);
	$k=in_array_b($db,$ra);
	if($k!==false){
		if($op==1)unset($ra[$k]); else $ra[$k]=$op;}
	if($ra)return implode(', ',$ra);}

function tools_edit($a,$b,$res){$rb=ajxr($res);
if($_SESSION['auth']<7 or !authok($rb[0]))return; //req('meta');
$da=ajx($rb[1],1); $db=ajx($rb[2],1); $dc=ajx($rb[3],1); $dd=ajx($rb[4],1);
switch($a){
	case('del'): unlink($da); break;
	//case('deldir'): walk_dir($da,"removef"); break;
	case('rep'): if($da && $db && $dc && $dd)patch_replace($da,$db,$dc,$dd); break;
	case('rnm'): if($da && $db)$ret=tool_replacetag($da,$db); break;
	case('rnmu'): if($da && $db && $dc)$ret=tool_replace_utag($da,$db,$dc); break;
	case('mut'): if($da && $db && $dc){
		if($db=='tag')$ret=tools_mdf_tag_to_u($da,$db,$dc);
		elseif($dc=='tag')$ret=tools_mdf_u_to_tag($da,$db,$dc);
		else $ret=tools_mdf_utags($da,$db,$dc);}
		break;
	case('catag'): if($da && $db)$ret=tools_mdf_cat_to_tag($da,$db); break;
	case('rncl'): if($da && $db)$ret=tools_replace_utag_class($da,$db); break;
	case('dltg'): if($da && $db){
		if($da=='tag')$ret=tools_del_tag($db); 
		else $ret=tools_del_utag($da,$db);}
		break;
	//case('one'): $ret=tool_special('manifestation','manif'); break;
}
$ret=btn('txtalert',($ret?$ret:'0').' modifs');
return btn('txtred',$a.': '.$da.' completed').' '.$ret;}

function tools_menus($d){$ret=btn('txtcadr',$d).br().br();
$ret.=input('password','lm0','password','').br();
switch($d){
case('del_file'): $vars='lm0|lm1'; $ind='del'; $ret.=input(1,'lm1','path','').br();
	$r=array('cbk','plug','','xd','tools','tools*edit',$ind,'',$vars); break;
case('replace'): $vars='lm0|lm1|lm2|lm3|lm4'; $ind='rep';
	$ret.=input(1,'lm3','replace','').br();
	$ret.=input(1,'lm4','by','').br();
	$ret.=input(1,'lm1','table','').br();
	$ret.=input(1,'lm2','entry','').br();
	$r=array('cbk','plug','','xd','tools','tools*edit',$ind,'',$vars); break;
case('rename_tag'): $vars='lm0|lm1|lm2'; $ind='rnm'; 
	$ret.=input(1,'lm1','tag','').br().input(1,'lm2','replace by','').br();
	$r=array('cbk','plug','','xd','tools','tools*edit',$ind,'',$vars); break;
case('rename_utag'): $vars='lm0|lm1|lm2|lm3'; $ind='rnmu'; 
	$jmp=str_replace(' ','|',$_SESSION['prmb'][18]);
	$ret.=input(1,'lm1','utag_classename','').jump_btns('lm1',$jmp,'').br();
	$ret.=input(1,'lm2','replace','').' '.input(1,'lm3','by','');
	$r=array('cbk','plug','','xd','tools','tools*edit',$ind,'',$vars); break;
case('deplace_tag'): $vars='lm0|lm1|lm2|lm3'; $ind='mut';
	$jmp='tag|'.str_replace(' ','|',$_SESSION['prmb'][18]);
	$ret.=input(1,'lm1','deplace','').'(keyword)'.br();
	$ret.=input(1,'lm2','from','').jump_btns('lm2',$jmp,'').br();
	$ret.=input(1,'lm3','to','').jump_btns('lm3',$jmp,'').br(); break;
case('deplace_cat'): $vars='lm0|lm1|lm2'; $ind='catag'; 
	$ret.=input(1,'lm1','cat','').br().input(1,'lm2','newcat','').br();
	$r=array('cbk','plug','','xd','tools','tools*edit',$ind,'',$vars); break;
case('rename_ucl'): $vars='lm0|lm1|lm2'; $ind='rncl'; 
	$jmp=str_replace(' ','|',$_SESSION['prmb'][18]);
	$ret.=input(1,'lm1','utag_classename','').jump_btns('lm1',$jmp,'').br();
	$ret.=input(1,'lm2','new name','');
	$r=array('cbk','plug','','xd','tools','tools*edit',$ind,'',$vars); break;
case('del_tag'): $vars='lm0|lm1|lm2'; $ind='dltg'; 
	$jmp='tag|'.str_replace(' ','|',$_SESSION['prmb'][18]);
	$ret.=input(1,'lm1','utag_classename','').jump_btns('lm1',$jmp,'').br();
	$ret.=input(1,'lm2','tag to del','');
	$r=array('cbk','plug','','xd','tools','tools*edit',$ind,'',$vars); break;
/*case('special'): $vars='lm0'; $ind='one';
	$r=array('cbk','plug','','xd','tools','tools*edit',$ind,'',$vars); break;*/
}
$r=array('cbk','plug','','xd','tools','tools*edit',$ind,'',$vars);
$ret.=call_func('txtbox',$r,'save').br();
return $ret;}

function plug_tools($d,$p=''){$here='tools';
$ret.=icon('alert').' '.btn('txtcadr','critical_operations').br().br();
$ret.=call_plug_f('txtx','ret','tools','menus','del*file','del_file').' ';
$ret.=call_plug_f('txtx','ret','tools','menus','replace','replace').' ';
$ret.=call_plug_f('txtx','ret','tools','menus','rename*tag','rename_tag').' ';
$ret.=call_plug_f('txtx','ret','tools','menus','rename*utag','rename_utag').' ';
$ret.=call_plug_f('txtx','ret','tools','menus','deplace*tag','deplace_tag').' ';
$ret.=call_plug_f('txtx','ret','tools','menus','deplace*cat','deplace_cat').' ';
$ret.=call_plug_f('txtx','ret','tools','menus','rename*ucl','rename_classe').' ';
$ret.=call_plug_f('txtx','ret','tools','menus','del*tag','del_tag').' ';
//$ret.=call_plug_f('txtx','ret','tools','menus','special','special').' ';
$ret=$ret.divd('cbk','').br().divd('ret','').br();
return $ret;}

?>