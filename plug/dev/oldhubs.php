<?php
//philum_plugin_oldhubs

function oldhubs_build($p,$o){
//$r=msql_read('',nod('umnum'),$p);
//$r=sqb('name,count(name)','qda','kv','group by name');

//$r=sqb('id','qda','rv','where frm="ES" or frm="_system"'); //pr($r);
//$r=sqb('id,tag','qdt','kv',''); pr($r);
//$r=sqb('id,idtag','qdta','kv',''); //pr($r);
//$r=sqb('id,suj','qda','kv','where frm="ES"'); //pr($r);
//$r=sql_inner('id,msg','qda','qdm','id','kv','limit 100',1);//,"C","E","H","NR","GR"
$r=sql('id','qda','rv','mail="" and frm in("D","C","E","H","NR","GR","ES");');//
//p($r);

//$id=445;
//$f='http://www.ummo-ciencias.org/Cartas/D58-5%20Bases%20biogeneticas%20del%20Cosmos%20-%20Informe%20a%20Alicia%20Araujo%20[4].htm';
//$f=utf8_encode($f);
//$f=rawurlencode($f);
//$f=htmlentities($f);
//$d=file_get_context($f);//
//if($d)art_import($d,$id);

//hooks
if($r)foreach($r as $k=>$v){
	$d=sql('msg','qdm','v','id='.$v);
	$ra=explode("\n",$d);
	$last=array_pop($ra);
	if(substr($last,1,4)=='http')$lk=delhook($last); else $lk='';
	echo popart($v).'-'.$lk.br();
	//if($lk)update('qda','mail',$lk,'id',$v);

	//$rb=sqb('id,val','qdd','kv','where ib='.$k.' and val="related"'); pr($rb);
	//if($rb)foreach($rb as $kb=>$vb)echo $kb.'-';//sqldel('qdd',$kb);

/*
$pos=strpos($v,' ');
if($pos){
$suj=substr($v,0,$pos);
$sujb=substr($v,$pos);
$ret='['.$suj.']'.$sujb;
//update('qda','suj',$ret,'id',$k);
echo $ret.br();}*/

//echo $k.'-'.$v.br();
//$v=urlencode($v);
//echo file_get_context($v);//

	//$sq='frm="_ES",suj="'.$v[0].'",thm="'.$v[0].'",day="'.$day.'",mail="'.urldecode($v[2]).'" where id='.$idb.'';
	//qr('update pub_art set '.$sq);
	//$rb=sqb('id,idtag','qdta','kv','where idart='.$v,1); pr($rb);
	//$rb=sqb('id','qdta','rv','where idtag='.$k); //pr($rb);
	//$va=sqb('id','qdt','v','where id='.$v); //pr($rb);
	//foreach($rb as $kb=>$vb){sqldel('qdta',$vb); sqldel('qdt',$k);}
	//if(!$va)echo $v.br();
	//if(!$va)sqldel('qdta',$k);
	
}
/*
//install art
$r=sqb('nod,name,id,suj,frm','qda','ar','where nod="ummo" and frm="_system" and suj="free" and id>100');
$rb=msql_read('',nod('es_3'),'',1); //pr($rb);
//echo count($rb);//647/191
foreach($rb as $k=>$v){
	$idb=$r[$k]['id'];
	$fr=sql('id,suj,day','qda','r','suj like "%'.$v[0].'%"');
	$ida=$fr[0]; $suj=$fr[1]; $day=$fr[2];
	$sq='frm="_ES",suj="'.$v[0].'",thm="'.$v[0].'",day="'.$day.'",mail="'.urldecode($v[2]).'" where id='.$idb.'';
	//if(substr($suj,1,strlen($v[0]))!=$v[0] && $suj && $v[0]!='D60' && $v[0]!='D61' && $v[0]!='D94' && $v[0]!='D95')
	if((substr($suj,1,strlen($v[0]))==$v[0] && $suj) or $v[0]=='D91' or $v[0]=='D518'){
	echo $v[0].':'.$suj.' '.$ida.br().$sq.br().br();
	//qr('update pub_art set '.$sq);
	//utag_sav($idb,'langfr',$ida);//ref to fr
	//utag_sav($ida,'langesp',$idb);//ref from fr
	//langslct($idb,'es');
	}
}*/

//isole old hub
/*foreach($r as $k=>$v){
//qr('update pub_art_a set ib="",name="ummo",nod="ummo",mail="",frm="_system",suj="free",re="1",lu="0",img="",host="0",thm="",day="" where id="'.$v['id'].'"');
//qr('update pub_txt_a set msg="" where id="'.$v['id'].'"');
//ib="",`name`="ummo",`nod`="ummo",mail="",day="0",`frm`="_system",`suj`="free",`re`=1,`lu`=0,`img`="",`thm`="",img="",`host`=0 WHERE nod="_ummo"name
//qr('update pub_art set frm="_ES",suj="free",re="1",lu="0",img="",host="0",thm="",day="" where id="'.$v['id'].'"');
}*/
return tabler($r);}

function oldhubs_j($p,$o,$res=''){
list($p,$o)=ajxp($res,$p,$o);
$ret=oldhubs_build($p,$o);
return $ret;}

function oldhubs_r(){
return ['aa'=>'a','bb'=>'b'];}

function oldhubs_menu($p,$o,$rid){
$ret=select_j('inp','pfunc','','oldhubs/oldhubs_r','','2');
//$ret.=togbub('plug','oldhubs_oldhubs*r',btn('popbt','select...'));
$ret.=input('inp',$p).' ';
$ret.=lj('',$rid.'_plug__2_oldhubs_oldhubs*j___inp',picto('ok')).' ';
//$ret.=lj('','popup_plupin___msqedit_oldhubs*1_id,val',picto('edit')).' ';
return $ret;}

function plug_oldhubs($p,$o){$rid=randid('plg');
req('meta,art,pop,spe');
ses('qdaa','pub_art_a');
$bt=oldhubs_menu($p,$o,$rid);
$ret=oldhubs_build($p,$o);
//$bt.=msqbt('',nod('oldhubs'));
return $bt.divd($rid,$ret);}

?>