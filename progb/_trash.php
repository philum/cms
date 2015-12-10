<?php
//1511

//app/clock	
/*		function detectDegrees(){
			var el=document.getElementById("needleSec");
			var st=window.getComputedStyle(el, null);
			var tr=st.getPropertyValue("transform");
			var matrix=tr.substring(7,tr.length-1); //alert(matrix);
			var trx=matrix.split(","); //alert(trx[2]);
			var a = trx[0];
			var b = trx[1];
			var c = trx[2];
			var d = trx[3];
			var scale = Math.sqrt(a*a + b*b);
			//arc sin, convert from radians to degrees, round
			//DO NOT USE: see update below
			var sin = b/scale;
			var angleSec = Math.round(Math.asin(sin) * (180/Math.PI));
			//console.log("Rotate: "+angleSec+"deg"); //works!
			//document.getElementById("angleSec").innerHTML=angleSec;
		}*/

//1509

//tri
///auto_video
	//case('ted'):$ret=embed_detect($f,'talks/','html'); break;
	//case('google'):$ret=embed_detect($f,'docid=','&'); break;

//ajx

//if(obj)if(obj.attachEvent)obj.attachEvent('on'+event,func); else 
//window.onresize=function(){popu=getbyid('pop'+popnb); var pos=ppos(popu,0);}
	//if(typeof x!=='undefined'){curi=0; clearInterval(x); var start=curi;}
//ob.filter="alpha(opacity="+op+")";

//index
/*	$ret.=meta('property','twitter:title',$meta["title"]);
	$ret.=meta('property','twitter:image:src',$meta["img"]);
	$ret.=meta('property','twitter:description',$meta["descript"]);*/

//pop
/*function weblink_a($u,$o=''){$_GET['urlsrc']=$u; $r=vacuum($u,'');
if($r[0]){if($o)return divc('track',format_txt('['.$r[0].':h]'.$r[1],'',''));
else return lka($u,pictxt('url',$r[0]));}
return lka($u);}*/

//1508

///pop//connectors
	//if(rstr(17) or $_SESSION['opts']['2cols'])$large=$largb=round(($large/2)-16);//2cols
	//if($pos=strrpos($pdoc,':'))$pdoc=connectors($pdoc,$media,$id);//join

///art///prepare_msg
	//if(rstr(17) or $_SESSION['opts']['2cols'])$msg=paocols($msg,2,1);//2cols
	//if(rstr(17) or $_SESSION['opts']['2cols'])$msg=divs('-moz-column-count:2; -moz-column-gap: 20px;',$msg);

//1506

//spe

//tri_rqt_d
/*function tri_rqt_d($vrf,$tri,$dya,$dyb){if(!$dyb)$dyb=1;
if($dya)$wh='day < '.$dya.' AND day > '.$dyb.'';
if($vrf)$wh.=' AND '.$tri.' LIKE "%'.$vrf.'%"';
//if($tri=='thm')$wh.=' AND LOCATE("'.$vrf.'",thm)>0'; 
$rq=res('id,'.$tri,$_SESSION['qda'].' WHERE nod="'.$_SESSION['qb'].'" AND '.$wh.' ORDER BY '.prmb(9).'');
if($rq){while($data=mysql_fetch_array($rq)){if($vrf)$curr=$vrf; else $curr="";
	if($curr==$vrf){$i++; if($i<10000)$ret[$data["id"]]=$data[$tri];}}
return $ret;}}*/

//pop
/*function msqlread($d,$id){$r=;//msqlread($d,$id)
return msqread(msq_goodtable_b($d),$id);}*/

//utils
/*function fixsearch(){var scrl=pageYOffset;
	var div=getbyid('srch'); var pdiv=getPosition(div);
	if(scrl>pdiv.y)div.style.position='fixed'; 
	else{div.style.position='relative';
	//div.style.position='relative';
	}}
//if(getbyid('srch'))
addEvent(document,'scroll',function(event){fixsearch()});*/

//ajxf
/*function rstr_sav($d){
$r=msql_read('system','admin_restrictions');
foreach($r as $k=>$v){
	if($k==$d)$_SESSION['rstr'][$k]=rstr($k)?'1':'0';
	elseif(!$_SESSION['rstr'][$k])$_SESSION['rstr'][$k]=$v[2];}
$rstbr=implode("",$_SESSION['rstr']);
update("qdu","rstr",$rstbr,"name",ses('qb'));
return 'rstr'.$d.': '.offon(rstr($d));}*/

//spe
#design
/*function content_width(){$_SESSION['cur_div']='content'; return currentwidth();}*/
/*function pagewidth($d,$f=''){$f=$f?$f:'css/'.ses('qb').'_design_'.ses('prmd').'.css';
if(is_file($f))$v=read_file($f); $v=embed_detect($v,'#'.($d?$d:'content').' {','}',''); 
return trim(embed_detect($v,'width:','px;',''));}*/

//plug///statsrv
/*function readfile_part($f){
$context=array('http'=>array('header'=>'Range: bytes=1024-2048',),);
$xcontext=stream_context_create($context);
$str=file_get_contents($f,FALSE,$xcontext);
return $ret;}*/
//echo $d=readfile_part($dr.'/'.$f);

//lib

function picto($d,$c=''){@list($d,$p)=explode('§',$d);
if($p)$s='" style="font-size:'.$p.'px;'; elseif($c)$s='" style="'.$c; else $s='';
$dc=$_SESSION['picto'][$d]; return $dc!=false?btn('philum'.$s,$dc):'';}

function picto($d,$c=''){list($v,$p)=explode('§',$d); if($p or $c)$s='" style="';
if($p)$s.='font-size:'.$p.'px; '; if($c)$s.=$c; if($_SESSION['nl'])return;
$dc=$_SESSION['picto'][$v]; return $dc!=false?btn('philum'.$s,$dc):'';}

function plug_motor($dr,$nod,$defsb){if($_GET["restore"])$sav='_sav';
$f=$dr.$nod.$sav.'.php'; if(is_file($f)){require($f); return $r?$r:$$nod;}
else echo save_vars($dr,$nod,$defsb); return $defsb;}

//function hardurl($d){return eradic_acc(str_replace(array(" ","'",'"',"?","/","§",",",";",":","!","%","&","$","#","_","+","=","!","\n","\r","\0","[\]","~","(",")","[","]",'{','}',"«","»","&nbsp;","-","."),"-",($d)));}

//lib
//function lien($c,$l,$v){return '<a href="'.$l.'"'.atc($c).'>'.$v.'</a>';}

//trackedt
///ajax
//case("trackedt"):req('pop,spe'); $ret=plugin_func('tracks','f_inp_track',$id,$va); break;
///ajx////savebbd
	//Toggle('trkop'+dn[4]+'_trackedt_'+dn[4],'bt1','');
	//setTimeout(function(){Close('trkop'+dn[1])},1000);

//lib
function balm($b,$r){return '<'.$b.attr($r).' />';}


///edit_msql_j
//$btn.=ljb('popbt','Close','popup',nms(67)).' ';//annule //$nxtk=$kyb;
//$btn.=ljb('popbt','SaveJb',$tg.'_savmsql___'.$nod.'_'.$nxtk.'___'.$keys.'\',\'popup_'.$tg.'__x_'.$nod.'_'.($nxtk+$ntkp),nms(44)).' ';//new


?>