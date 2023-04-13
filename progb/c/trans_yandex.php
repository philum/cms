<?php 
//https://tech.yandex.com/translate/doc/dg/reference/translate-docpage
class trans_yandex{

static function api($prm,$mode,$txt=''){//return ['text'=>0=>[$txt]];
$txt=utf8enc($txt); $r=[];
//$id='enp573c2837f7lt7sg51';
//$key='AgAAAAAbqMMQAATuwcEeqCewDEHen-4Tj6PZ_8M';
if($_SERVER['HTTP_HOST']=='newsnet.fr')//newsnet
$key='trnsl.1.1.20180424T143921Z.e47210bce651eadc.f1434d1d227b66402fc4bf8f44f82f0f85ed75b6';
elseif($_SERVER['HTTP_HOST']=='oumo.fr')//oomo-dhoy2
$key='trnsl.1.1.20180424T143830Z.66e290d02ce3a559.adc6066d788696b551be9734420c4ad9b7061dbc';
//$key='trnsl.1.1.20180424T150654Z.ad62660ecf66eace.b9aae90ac4dc2fb31c0391fe393f2b84e6a14208';//oomo-dhoy
else//tlex
$key='trnsl.1.1.20170206T173119Z.092e1dd0a9954253.db344b1e497240fb68fd4b1f5150a3d25d9c4e95';
$prm.='&key='.$key;
//$prm.='&text='.rawurlencode($txt);
if(!$mode)$mode='translate';//detect//getLangs
$u='https://translate.yandex.net/api/v1.5/tr.json/'.$mode.'?'.$prm;//old
//$u='https://iam.api.cloud.yandex.net/iam/v1/tokens/tr.json/'.$mode.'?'.$prm;
$ret=trans::post($u,$txt);
$r=json_decode($ret,true);
if(isset($r['code']) && $r['code']=='404')$r=['text'=>$txt];//echo $r['message'];
return $r;}

static function getlangs(){$rb=[];
$r=self::api('','getLangs');
	foreach($r['dirs'] as $v)$rb=array_merge_b($rb,explode('-',$v));
return implode(',',$rb);}

static function detect($p,$o,$prm=[]){//return prmb(25);
$var='detect'; $p=$prm[0]??$p;
if($p){$r=self::api('',$var,$prm[0]); return $r['lang']??'';}
else return ses('lang');}

static function build($from,$format,$txt,$to){
if(!$to)$to=ses('lng');//$to=setlng($to);
$options=$from?'':'&options=1';
if($from)$lang=$from.'-'.$to; else $lang=$to;
$prm='lang='.$lang.'&format='.$format.$options;
$r=self::api($prm,'translate',$txt);
$from=$r['detected_source_language']; $txt=$r['text'];
return ['text'=>$txt,'from'=>$from];}

}
?>