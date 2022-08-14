<?php //few usited
class few{

#transports
//export
static function exportation($id,$node,$frm,$sub){
$USE=$_SESSION['USE']; $mn=$_SESSION['mn']; $qb=$_SESSION['qb']; $dy=$_SESSION['dayb'];
$j='exp'.$id.'_few,exportation___'; $ret=''; $rte='';
if($frm)$ret.=lj('popbt',$j.$id.'_'.$node,picto('left')).' ';
if($node!=$qb && $mn)$ret.=slctmenusj($mn,$j.$id.'_',$qb,' ','k');
$r=sql('distinct(frm)','qda','rv','nod="'.$node.'" and day>'.(calc_date(360)).' order by frm');	
if($r && !$frm)$ret.=slctmenusj($r,$j.$id.'_'.$node.'_',$frm,' ','v');
if($frm && !$sub){//topic
	$lk=$j.$id.'_'.$node.'_'.$frm.'_';
	$ret.=lj('popsav',$lk.'ok','save in: '.$frm);
	$w=$dy?' and day>'.$dy:'';
	$r=sql('id,suj','qda','kv','nod="'.$node.'" and frm="'.$frm.'"'.$w.' order by id desc limit 100');
	if($r)foreach($r as $k=>$v)$rte.=lj('',$lk.$k,$v).br();
	if($rte)$ret.=' '.btn('txtx','or affiliate to:').br().divc('nbp',$rte);}
if($sub){$nid=self::hubimport($node,$id,$USE,$frm,$qb,$sub);//sub
$ret=lkc('popw','/'.$nid,'saved in '.$node.'/'.$frm.'/'.$nid);}
return divd('exp'.$id,$ret);}

//import
static function hubimport($node,$id,$use,$frm,$qb,$suj){$tim=$_SESSION['dayx'];
$r=sql('name,auth','qdb','kv',['hub'=>$node]);
if($r)foreach($r as $k=>$v)$ath=$k==$use?$v:'';
$rw=sql('*','qda','a',$id); $re=$ath>4?1:0; unset($rw['id']);
$rw['ib']=$suj!='ok'?$suj:''; $rw['nod']=!$node?$qb:$node; $day=$rw['day']; $rw['frm']='frm';
$rw['day']=time();
$nid=db::sav('qda',$rw);
$ret='['.$id.'§'.mkday($day).':art]'.n().n().'['.$id.':read]';
if($nid)return sqlsavi('qdm',[$nid,$ret]);}

static function importation($id){
$d=sql('msg','qdm','v','id='.$id); $idb=between($d,'[',':import]');
if(is_numeric($idb)){
$day=sql('day','qda','v',$idb);
$ret=sql('msg','qdm','v',$idb);
$ret='['.$id.'§'.mkday($day).':art]'.n().n().$ret;
update('qdm','msg',$ret,'id',$id);}
return $ret;}

#art
static function restricted_area($n){$ret=ma::read_msg('restricted_area',''); if(!$ret)$ret=nms(55); 
return divc('txtcadr',picto('protect').' '.$ret);}//nameofauthes
static function restricted_pswd($id){$j='socket_sesmake_artpswd_self_psw'.$id;
return divc('txtcadr',picto('lock').' '.nms(137).' : '.inputj('artpswd','',$j).lj('',$j,picto('ok')));}

#seesrc
static function seesrc($f){
$bt=lj('','popup_few,seesrc2__3_'.ajx($f),pictit('file-html','code')).' ';
[$title,$ret,$d,$defid,$defs]=conv::vacuum($f); $d=self::progcode($d);
return $bt.balc('code','console',$d);}

static function seesrc2($f){$d=get_file($f); 
$enc=detect_enc($d); if($enc=='UTF-8')$d=utf8_decode_b($d); $d=self::progcode($d);
return balc('code','console',$d);}

static function insrc($f){
$bt=lj('popsav','popup_edit,com_insrc_x_'.ajx($f),pictxt('save','take it'));
return divb($bt).textarea('insrc','',64,8);}

static function progcode($d){$d=delbr($d,"\n");
ini_set('highlight.comment','orange');
ini_set('highlight.default','silver');
ini_set('highlight.html','red');
ini_set('highlight.keyword','cyan');
ini_set('highlight.string','silver; font-weight:bold');
$d=highlight_string('<?php '.$d,true);
$s='overflow:auto; wrap:true; background:#222244; padding:0 8px; font-size:14px;';
$d=str_replace('<span style="color: silver">&lt;?php&nbsp;</span>','',$d);
$d=str_replace("\n",'',$d);
return divs($s,$d);}

#calendar
static function is_arts($frm,$daya,$dayb){
if($frm)$fr='AND frm="'.$frm.'" '; if($dayb)$df='AND day>"'.$dayb.'" ';
$n=sql('id','qda','v','nod="'.ses('qb').'" '.$fr.' AND day<"'.$daya.'" '.$df.' ORDER BY day DESC LIMIT 1'); 
if($n)return true;}

static function nb_arts($daya,$dayb){return sql('COUNT(id)','qda','v','nod="'.ses('qb').'" AND re>0 AND day<'.$daya.' AND day>'.$dayb.'');}

static function calendar($date){$ret='';
$gd=getdate($date); $dcible=date('d',$_SESSION['daya']); $dyam=$gd['mon'];
$ret.='<table style="font:smaller Arial; text-align:center;">';
$ret.='<tr><td>L</td><td>M</td><td>M</td><td>J</td><td>V</td><td>S</td><td>D</td></tr><tr>';
$first=date('w',mktime(1,1,1,$dyam,1,$gd['year'])); if($first==0)$first=7;
$nbdy=date('t',mktime(1,1,1,$dyam,1,$gd['year']));
for($a=1;$a<$first;$a++)$ret.='<td></td>';
for($i=1;$i<=$nbdy;$i++){$mk=mktime(0,0,0,$dyam,$i,$gd['year']);
$dy=date('d',$mk); if($dy==$dcible)$cssb='style="background-color: #'.getclrs('',4).';'; else $cssb="";
if(self::is_arts('',$mk+86400,$mk)===true)$lnk=lkc('linc"'.$cssb,'/?module=Home&nbj=1&timetravel='.$dy.'-'.$dyam.'-'.$gd['year'],$dy)."\n";
else $lnk=btn('lina"'.$cssb,$dy)."\n";
$ret.='<td>'.$lnk.'</td>'; 
$a++;if($a==8){$a=1;$ret.='</tr><tr>';}}
$ret.='</tr></table>';
return $ret;}

static function archives($cyear){
$first=ma::oldestart(); $ret='';
//$last=ma::lastart();
if(!$first)$first=0; 
$first_year=date('y',$first); 
$actual_year=date('y');
$ts_year=date('y',$_SESSION['daya']);
$nbsec_in_month=86400*30;//60*60*24;
$nbsec_in_year=31536000;//60*60*24*365=mktime(0,0,0,1,1,1);
$current_year=$cyear?$cyear:$ts_year;
	for($year=$actual_year;$year>=$first_year;$year--){
	$mk=mktime(0,0,0,1,1,$year);
	$y_name=date('Y',$mk);
	$nbay=self::nb_arts($mk+$nbsec_in_year,$mk);
	$css=date('y',$mk)==$current_year?'active':'';
	$ret.=balc('li',$css,lj('','archives_few,archives___'.$year,$y_name.' ('.$nbay.')'));
	if($year==$current_year){
	$goto='/?module=All&nbj=30';
		for($ia=12;$ia>0;$ia--){
		$month=mktime(0,0,1,$ia,1,$year);
		$nbdayinmonth=date('t',$month);
		$m_name=date('M',$month); $m_nb=date('m',$month);
		$nbam=self::nb_arts($month+$nbsec_in_month,$month);//$monthbefore
		$css=date('Ym',$_SESSION['daya'])==$y_name.$m_nb?'active':'';
		if($nbam)$ret.=llk($css,$goto.'&timetravel='.$nbdayinmonth.'-'.$ia.'-'.$year,'- '.$m_name.' ('.$nbam.')');}}}
return $ret;}

}
?>