<?php
//philum_slider 

function correct_internal_url_b($f){//bug by mail
if(strpos($f,"http")!==false)return $f;
elseif(strpos($f,"/")===false)return 'img/'.$f;
elseif(strpos($f,"users/")===false && strpos($f,"img/")===false)return 'users/'.$f;
else return $f;}

function jimg($d,$t){$d=correct_internal_url_b($d); 
	if($d)list($w,$h)=getimagesize($d);
	return ljb('','SaveBf','photo_'.ajx($d).'_'.$w.'_'.$h,$t);}

function slider_build($dir,$id,$opt){//$dir.'+'.$id.'+'.$opt;
$hub=$_SESSION["qb"].'_'; //$ret.=divd('popslide',''); 
if($id=='base')$nod=$dir;
elseif(!$dir && $id){$r=rse("img",$_SESSION["qda"].' WHERE id="'.$id.'"');
	$re=explode("/",$r); $predir='img/'; $nod=$hub.$id;}
elseif($id=='manual'){// or (strpos($dir,'manual')!==false && $opt=='rebuild')
	$predir='img/'; $nod=$hub.$_SESSION['read'].'manual';
	$re=explode(",",str_replace("\n","",$dir)); $opt='rebuild';}
elseif(strpos($dir,"/")!==false){$predir='users/'.$dir.'/'; $re=explore($predir); 
	$nod=$hub.str_replace("/","",str_replace($_SESSION["qb"],"",$dir));}
else{$nod=$dir; $edit='ok'; list($hb,$nd)=split('_',$dir);
	if(is_numeric($nd))$dir=$dir;//elseif($id=='manual')$edit=''; 
	elseif(strpos($nd,'manual')!==false)$edit='ok';
	else{$rb=msql_read('gallery',$nod,''); 
		list($prd,$fil)=split_right('/',$rb[1][2],1); $predir=$prd.'/';
		$dir=str_replace("users/","",$prd); $re=explore($predir);}}
$dor=ajx($dir,'');
$ret.=lj('popbt','popup_gallery','<-').' ';
$ret.=lj('popbt','popup_slider__x_'.$dor.'_'.$id,picto('reload')).' ';
if($edit)$ret.=lj('popsav','popup_slider__3x_'.$dor.'_'.$id.'_rebuild',"Rebuild").' ';
list($base,$table)=split('_',$nod);
if($edit)$ret.=msqlink('gallery',$base.'_'.$table).br();
else{$ret.=ljb("popbt","insert_photo",$nod.'\',\'slider',"Slider (Flash)").' ';
	$ret.=ljb("popbt","insert_photo",$nod.'\',\'sliderJ',"SliderJ (Ajax)").' ';
	$ret.=ljb("popbt","insert_photo",$nod.'§1\',\'sliderJ',"SliderJ+thumbs").br();}
$ret.=br();
$dirg='msql/gallery/'; if(!is_dir($dirg))mkdir($dirg);
$file='msql/gallery/'.$nod.'.php';
if($re && (!is_file($file) or $opt=='rebuild'))$r=slider_builder($re,$predir,$nod);
else $r=msql_read('gallery',$nod,'');
$nodb=str_replace('_','*',$nod);
if($r['_menus_'])unset($r['_menus_']);
if($r)foreach($r as $k=>$v){$img=image('gallery/mini/'.$v[1],'','');
	$rj=array('edit'.$k,'plug','','','slider','slider*edit',$nodb,$k,'');
	$imgnma=str_replace('*','_',$v[0]);
	$imgnm=jimg($v[2],$img).br();
	$imgnm.=call_func('popbt',$rj,$imgnma);
	$datas[$imgnm]=array(divd('edit'.$k,$v[7]));}
$ret.=make_tables('',$datas,'txtred','txtblc" style="padding:4px;');
return popup($nod,$ret);}

function slider_thumbs_size($width,$height){$rh=75;
	$rl=$width/($height/$rh); $rapl=$width/$rl; $raph=$height/$rh;
	if($rapl>=$raph){$newl=round($width/$rapl); $newh=round($height/$rapl);}
	else{$newl=round($width/$raph); $newh=round($height/$raph);}
if($newl>100)$newl=100;
return array($newl,$newh);}

/*function barprogress($nb,$i){echo js_code('document.getElementById(\'barprogress\').innerHTML=\'<img src="bkg/shadow/_blk75.png" width="'.(($nb/$i)*400).'">\';');}*/

function slider_builder($re,$predir,$nod){
require('progb/spe.php'); $minidir='gallery/mini/'; $sqdir='msql/gallery/';
$ref=plug_motor($sqdir,$nod,'');
$ret['_menus_']=array('name','mini','img','width','height','mini_w','mini_h','text','size','color','align','position','alpha');
//echo divd('barprogress','');
$nb=count($re); //p($re);
foreach($re as $k=>$v){
	if(is_file($predir.$v) && stristr('jpggifpng',substr($v,-3))!==false){$i++;
	//echo js_code('barprogress('.$nb.'_'.$i.');'); //barprogress($nb,$i);
	if(substr($v,-1)=="/") $v=substr($v,0,-1);
	$nnm=str_replace(array('users/',"/"),"",$predir.$v);
	list($width,$height)=getimagesize($predir.$v);
	list($newl,$newh)=slider_thumbs_size($width,$height); //echo $newl;
	//if(!is_file($minidir.$nnm)){}
		$reb=make_mini($predir.$v,$minidir.$nnm,$newl,$newh,1);
	if(is_array($ref)){
	if($ref[$i][0]!=$v && $ref[$i][0])$vb=$ref[$i][0]; else $vb=$v;
	$txt=$ref[$i][7]; $size=$ref[$i][8]; $clr=$ref[$i][9]; $alg=$ref[$i][10];
	$pos=$ref[$i][11]; $alp=$ref[$i][12];} else $vb=$v;
	$ret[$i]=array($vb,$nnm,$predir.$v,$width,$height,$newl,$newh,$txt,$siz,$clr,$alg,$pos,$alp);}}
save_vars($sqdir,$nod,$ret);
return $ret;}

function slider_params(){return array(
'size'=>array('',12,14,16,20,24,32),
'color'=>array('','000000','ff0000','00ff00','0000ff','ffff00','ff00ff','00ffff','ffffff'),
'align'=>array('','left','center','right'),
'position'=>array('','inside','outside'),
'alpha'=>array('',0,10,25,33,50,66,75,90,100));}

function slider_edit($nod,$n){
//name,mini,img,width,height,mini_w,mini_h,text,size,color,align,position,alpha
$r=msql_read('gallery',$nod,$n); $get=$n.'nam|'.$n.'txt';
$sets=slider_params(); $sty=' style="border:1px solid grey;"';
$sets['size'][]=$r['size']; $sets['color'][]=$r['color']; $sets['alpha'][]=$r['alpha'];
foreach($sets as $k=>$v){$entry=$r[$k]; $get.='|'.$n.$k;//echo $r[$k];
	$rb=batch_defil_kv($sets[$k],$entry,"vv");
$set.=balise("select",array(3=>$n.$k,"selected"=>$entry),$rb).' '.$k.br();}
$ret=input2('text','"'.$sty.' size="17" id="'.$n.'nam',$r['name'],'').' name'.br();
$ret.=txarea('"'.$sty.' id="'.$n.'txt',$r['text'],20,3).' text'.br();
$ret.=$set.br();
$nodb=str_replace('_','*',$nod);
	$rj=array('edit'.$n,'plug','','','slider','slider*sav',$nodb,$n,$get);
	$ret.=call_func('popbt',$rj,'Save').' ';
	$rj[7]='mdf-'.$n; $ret.=call_func('popbt',$rj,'Apply to All').' ';
	$rj[7]='del-'.$n; $ret.=call_func('popbt',$rj,'Delete').' ';
$ret.=lj('popbt','edit'.$n.'_msqlcall___gallery_'.$nodb.'_'.$n.'_text','X');
return $ret;}

function slider_sav($nod,$n){$rb=explode('_',$nod);
$rb=ajxr($_GET['res']); $nb=count($rb); //preload("","","")
$r=msql_read('gallery',$nod,(substr($n,0,3)=='mdf'?'':$n));
if(substr($n,0,3)=='mdf'){list($n,$nb)=split('-',$n);
foreach($r as $k=>$v){if($k=='_menus_')$rc[$k]=$v; else $rc[$k]=array($v[0],$v[1],$v[2],$v[3],$v[4],$v[5],$v[6],$v[7],($rb[2]),($rb[3]),($rb[4]),($rb[5]),($rb[6]));}}
//?$rb[2]:$v[8]//?$rb[3]:$v[9]//?$rb[4]:$v[10]//?$rb[5]:$v[11]//?$rb[6]:$v[12]
elseif(substr($n,0,3)=='del'){list($n,$rc)=split('-',$n);
	msql_modif('gallery',$nod,'','','del',$rc); return '';}
else $rc=array($rb[0],$r['mini'],$r['img'],$r['width'],$r['height'],$r['mini_w'],$r['mini_h'],$rb[1],$rb[2],$rb[3],$rb[4],$rb[5],$rb[6]);
modif_vars('gallery',$nod,$rc,$n);
if($n=='mdf')return slider_edit($nod,$nb); else return slider_edit($nod,$n);}

?>