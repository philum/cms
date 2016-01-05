<?php
//philum_plugin_smsreader

/*<Root
<Item>
<eLocation>1</eLocation>
<uSize>0</uSize>
<eMsgHead>
<uIndex>214511</uIndex>
<uBoxID>0</uBoxID>
<eType>1</eType>
<eStatus>1</eStatus>
<szFromNumber>+33687419210</szFromNumber>
<szToNumber/>
<szScaNumber/>
<uSizeofMsgTitle>0</uSizeofMsgTitle>
<pTitle/>
<uYear>2013</uYear>
<uMonth>10</uMonth>
<uDay>17</uDay>
<uHour>18</uHour>
<uMinute>15</uMinute>
<uSecond>25</uSecond>
<uMillisecond>0</uMillisecond>
<nMinutesFromUTC>0</nMinutesFromUTC>
<uIsConcat>0</uIsConcat>
<uConcatSum>1</uConcatSum>
</eMsgHead>
<pMsgData>Mdr, c'est dans ses habitudes de te demander Ça ??</pMsgData>
<uSizeofMsgData>51</uSizeofMsgData>
</Item>*/

/*$r=array('eLocation','uSize','eMsgHead','uIndex','uBoxID','eType','eStatus','szFromNumber'
'szToNumber','szScaNumber','uSizeofMsgTitle','pTitle','uYear','uMonth',
'uDay','uHour','uMinute','uSecond','uMillisecond','nMinutesFromUTC','uIsConcat'
'uConcatSum','eMsgHead','pMsgData');*/

/*function smsreader_read_rss_data($data,$t,$r){//lit_rss
$encoding=embed_detect(strtolower($data),'encoding="','"',"");
if(strtolower($encoding)=="utf-8")// or mb_detect_encoding_b($data,'UTF-8',true)
	$data=utf8_decode_b($data);//or 
$tmp=preg_split("/<\/?".$t.">/",$data);
foreach($r as $v){$tmp2=preg_split("/<\/?".$v.">/",$tmp[0]); $ret[0][]=@$tmp2[1];}
for($i=1;$i<sizeof($tmp)-1;$i+=1){
	if($r){foreach($r as $v){$tmp2=preg_split("/<\/?".$v.">/",$tmp[$i]);
	$ret[$i][$tmp[$i]]=str_replace(array('<![CDATA[',']]>'),'',$tmp2[1]);}}}
return $ret;}*/

function smsreader($r,$p,$o){$o='+'.$o;
foreach($r as $k=>$v){
$numbr=$v[0]?$v[0]:$v[1]; $numb=substr($numbr,1);
$day=$v[2].$v[3].$v[4].$v[5].$v[6].$v[7];
if($v[7])$time=mktime($v[5],$v[6],$v[7],$v[3],$v[4],$v[2]);
if($v[0] && $v[0]==$o or $v[1] && $v[1]==$o){//szFromNumber
	//$day=$v['uYear'].$v['uMonth'].$v['uDay'].$v['uHour'].$v['uMinute'].$v['uSecond'];
	if($time)$realday=mkday($time,'ymd.hi');
	$ret.=$day.br().$v[8].br().hr();
	$who=($v[0]?'From':'To').':'.$numbr;
	$rb[$time]=divc('panel',$who.', '.$realday.br().divc('justy',$v[8]));}//pMsgData
else $rb[$time].=lkc('','/plugin/smsreader/'.$p.'/'.$numb,$numb).' ';}
ksort($rb); //p($rb);
$ret=implode(hr(),$rb); //echo $ret;
return $ret;}

function plug_smsreader($p,$o){echo $o; //$p=130911;//131016
/*$d='<?php'.'xml version="1.0" encoding="iso-8859-1"'.'?>';*/
$d.=read_file('data/sms_'.$p.'.xml');
$r=array('szFromNumber','szToNumber','uYear','uMonth','uDay','uHour','uMinute','uSecond','pMsgData');
$rss=read_rss_data($d,'Item',$r); //p($rss);
$ret=smsreader($rss,$p,$o);
$ret=utf8_decode($ret);
//echo $ret;
return $ret;}

?>