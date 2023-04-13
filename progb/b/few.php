<?php //few usited
class few{

#transports
//export
static function exportation($id,$node,$frm,$sub){
$USE=$_SESSION['USE']; $mn=$_SESSION['mn']; $qb=$_SESSION['qb']; $dy=$_SESSION['dayb'];
$j='exp'.$id.'_few,exportation___'; $ret=''; $rte='';
if($frm)$ret.=lj('popbt',$j.$id.'_'.$node,picto('left')).' ';
if($node!=$qb && $mn)$ret.=slctmnuj($mn,$j.$id.'_',$qb,' ','k');
$r=sql('distinct(frm)','qda','rv','nod="'.$node.'" and day>'.(timeago(360)).' order by frm');	
if($r && !$frm)$ret.=slctmnuj($r,$j.$id.'_'.$node.'_',$frm,' ','v');
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
static function hubimport($node,$id,$use,$frm,$qb,$suj){$tim=ses('dayx');
$r=sql('name,auth','qdb','kv',['hub'=>$node]);
if($r)foreach($r as $k=>$v)$ath=$k==$use?$v:'';
$rw=sql('*','qda','a',$id); $re=$ath>4?1:0; unset($rw['id']);
$rw['ib']=$suj!='ok'?$suj:''; $rw['nod']=!$node?$qb:$node; $day=$rw['day']; $rw['frm']='frm';
$rw['day']=time();
$nid=sql::sav('qda',$rw,0,1);
$ret='['.$id.'§'.mkday($day).':art]'.n().n().'['.$id.':read]';
if($nid)return sql::savi('qdm',[$nid,$ret]);}

static function importation($id){
$d=sql('msg','qdm','v',$id); $idb=between($d,'[',':import]');
if(is_numeric($idb)){
$day=sql('day','qda','v',$idb);
$ret=sql('msg','qdm','v',$idb);
$ret='['.$id.'§'.mkday($day).':art]'.n().n().$ret;
sql::upd('qdm',['msg'=>$ret],$id);}
return $ret;}

#art
static function asciinb($n,$s=16){return bts('font-size:'.$s.'px',asciinb($n));}
static function restricted_area($n){$msg=msql::val('lang','helps_authlevel',$n,0);
return divc('frame-red',picto('protect').' '.nms(55).' '.self::asciinb($n,20).' '.$msg);}//nameofauthes
static function restricted_pswd($id){$j='socket_sesmake_artpswd_self_psw'.$id;
return divc('txtcadr',picto('lock').' '.nms(137).' : '.inputj('artpswd','',$j).lj('',$j,picto('ok')));}

#seesrc
static function seesrc($f){
$bt=lj('','popup_few,seesrc2__3_'.ajx($f),pictit('file-html','code')).' ';
[$title,$ret,$d,$defid,$defs]=conv::vacuum($f); $d=self::progcode($d);
return $bt.tagc('code','console',$d);}

static function seesrc2($f){$d=get_file($f); 
$enc=detect_enc($d); if($enc=='UTF-8')$d=utf8dec_b($d); $d=self::progcode($d);
return tagc('code','console',$d);}

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
$dy=date('d',$mk); if($dy==$dcible)$cssb='style="background-color: #'.getclrs('',4).';'; else $cssb='';
if(self::is_arts('',$mk+86400,$mk))$lnk=lkc('linc"'.$cssb,'/timetravel/'.$dy.'-'.$dyam.'-'.$gd['year'],$dy);
else $lnk=btn('lina"'.$cssb,$dy);
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
$ts_year=date('y',ses('daya'));
$nbsec_in_month=86400*30;//60*60*24;
$nbsec_in_year=31536000;//60*60*24*365=mktime(0,0,0,1,1,1);
$current_year=$cyear?$cyear:$ts_year;
	for($year=$actual_year;$year>=$first_year;$year--){
	$mk=mktime(0,0,0,1,1,$year);
	$y_name=date('Y',$mk);
	$nbay=self::nb_arts($mk+$nbsec_in_year,$mk);
	$css=date('y',$mk)==$current_year?'active':'';
	$ret.=tagc('li',$css,lj('','archives_few,archives___'.$year,$y_name.' ('.$nbay.')'));
	if($year==$current_year){
	$goto='/?module=All&nbj=30';
		for($ia=12;$ia>0;$ia--){
		$month=mktime(0,0,1,$ia,1,$year);
		$nbdayinmonth=date('t',$month);
		$m_name=date('M',$month); $m_nb=date('m',$month);
		$nbam=self::nb_arts($month+$nbsec_in_month,$month);//$monthbefore
		$css=date('Ym',ses('daya'))==$y_name.$m_nb?'active':'';
		if($nbam)$ret.=llk($css,$goto.'&timetravel='.$nbdayinmonth.'-'.$ia.'-'.$year,'- '.$m_name.' ('.$nbam.')');}}}
return $ret;}


#fonts
static function inject_fonts(){$dr='fonts/'; $ret='';
$ra=msql::read('server','edition_typos',''); $vra=array_keys_r($ra,0);
$rb=msql::read('system','edition_typos',''); $vrb=array_keys_r($rb,0);
$rc=explore($dr,'files',1); $vrf[]=1;
if($rc)foreach($rc as $k=>$v){[$nm,$xt]=split_right('.',$v,1,1);//add
	if($xt=='woff' or $xt=='eot' or $xt=='svg'){// or $xt=='ttf'
	if(!in_array($nm,$vra) && !in_array($nm,$vrb) && !in_array($nm,$vrf)){
		$rb[]=[$nm,'user','','','']; $vrf[]=$nm; $add[]=$nm;}
	elseif(!in_array($nm,$vra) && in_array($nm,$vrb)){$kb=in_array_b($nm,$vrb);
		$rb[]=$ra[$kb]; $vrf[]=$nm; $add[]=$nm;}}}
foreach($rb as $k=>$v){if($k!='_menus_'){//del
	if(!is_file($dr.$v[0].'.woff') && !is_file($dr.$v[0].'.eot') && !is_file($dr.$v[0].'.svg')){unset($rb[$k]); $del[]=$v[0];}}}
if(!is_dir('msql/server'))mkdir('msql/server');//sav
msql::save('server','edition_typos',$rb);
msql::save('system','edition_typos',$rb);
$ret.='table server/edition_typos updated'.br().br();
$ret.=count($add).' elements added: '.br().($add?implode(br(),$add).br():'').br();
$ret.=count($del).' elements deleted:'.br().($del?implode(br(),$del).br():'').br();
return $ret;}

static function inject_typos($v){$dr='plug/tar/'; include($dr.'pclerror.lib.php');
include($dr.'pcltrace.lib.php');include($dr.'pcltar.lib.php');
PclTarExtract($v,'fonts','','');
return lka($v).' installed'.br();}

static function edit_fonts(){$dir='users/'.ses('qb').'/fonts';
$ret=divc('panel',helps('fontserver')).br();
if($ins=get('install_packfont'))$ret.=self::inject_typos($dir.'/'.$ins);
if(get('inject'))$ret.=self::inject_fonts().br();
$r=explore($dir); if($r)$ret.='packages_found: ';
if($r)$ret.=slctmnu($r,'/?admin=fonts&install_packfont=','','txtx','txtx','v').br().br();//
$ret.=lkc('txtbox','/?admin=fonts&inject==','inject').' ';
$ret.=lkt('txtx','/plug/addfonts','add_from_web').' ';
$ret.=lj('txtx','app','Font-Face').' ';
$ret.=msqbt('server','edition_typos');
return $ret;}

}
?>