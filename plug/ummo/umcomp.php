<?php
//philum_plugin_umcomp

function req_artrk($p){//relations art-trk
if($p=='All')$p='Oaxiiboo 6,Oolga Waam,Oomo Toa,Oyagaa Ayoo Yissaa';
$qda=ses('qda'); $qdm=ses('qdm'); $qdi=ses('qdi');
$sql='select '.$qda.'.id,'.$qda.'.day,'.$qda.'.suj,lg,'.$qdi.'.id as idb from '.$qda.'
inner join '.$qdi.' on '.$qdi.'.ib='.$qda.'.id 
where '.$qda.'.frm in ("'.implode('","',explode(',',$p)).'")
order by '.$qda.'.day asc,'.$qdi.'.id desc';
$r=sql_b($sql,'index',0); //pr($r);
return $r;}

function req_yndart($p,$lg){//relation art-ynd
if($p=='All')$p='Oaxiiboo 6,Oolga Waam,Oomo Toa,Oyagaa Ayoo Yissaa';
$qda=ses('qda'); $qdm=ses('qdm'); $qdi=ses('qdi'); $ynd=ses('ynd');
$sql='select '.$qda.'.id,'.$qda.'.day,'.$qda.'.suj,lg,'.$ynd.'.txt from '.$qda.' 
inner join '.$ynd.' on substring('.$ynd.'.ref,1,3)="art" and substring('.$ynd.'.ref,4)='.$qda.'.id and '.$ynd.'.lang="'.$lg.'" where '.$qda.'.frm in ("'.implode('","',explode(',',$p)).'") 
order by '.$qda.'.day asc';
$r=sql_b($sql,'index',0); //pr($r);
return $r;}

function req_yndtrk($p,$lg){//relation trk-ynd
if($p=='All')$p='Oaxiiboo 6,Oolga Waam,Oomo Toa,Oyagaa Ayoo Yissaa';
$qda=ses('qda'); $qdm=ses('qdm'); $qdi=ses('qdi'); $ynd=ses('ynd');
$sql='select '.$qda.'.id,'.$qdi.'.id as idb,'.$ynd.'.txt as trk from '.$qda.'
inner join '.$qdi.' on '.$qdi.'.ib='.$qda.'.id 
inner join '.$ynd.' on substring('.$ynd.'.ref,1,3)="trk" and substring('.$ynd.'.ref,4)='.$qdi.'.id and '.$ynd.'.lang="'.$lg.'" where '.$qda.'.frm in ("'.implode('","',explode(',',$p)).'")
order by '.$qda.'.day asc,'.$qdi.'.id desc';
$r=sql_b($sql,'index',0); //pr($r);
return $r;}

function req_compile($p,$lg){
$ra=req_yndart($p,$lg); //pr($ra); //id,day,suj,lg,txt
$rb=req_yndtrk($p,$lg); //pr($rb); //id,idb,trk
if($ra)foreach($ra as $k=>$v)$ra[$k][]=$rb[$k][2]; //pr($ra);
//$ret=tabler($r); //$id,$day,$suj,$msg,$lk,$lng
return $ra;}

//high speed
function umcomp_datas_fast($r,$id,$lang,$mode=''){
list($id,$day,$suj,$lng,$msg,$idy)=$r;
$rb=['id'=>$id,'url'=>'/'.$id,'suj'=>$suj,'day'=>localdate($day)];
$rb['lang']=umcomp_slctlng($id,'umcomp'.$id,$lang,$lng);//slctlng
$rtg=art_tags($id,'vv');
$rb['tag']=tglist($rtg);//tag
if($mode=='tags'){if($rtg)foreach($rtg as $k=>$v)$rb['tagr'][$v[1]][]=$id;}
$nfo=$rtg[0][1];//classtags info
if($nfo=='favoris')$from=embed_detect($msg,'twitter.com/','/status');
$n=substr_count($idy,':u');
$rb['msg']=conn::read($msg);
$rb['txtbrut']=$msg;
if($from && $idy && $n>1){$rb['source']='Questions'; $rb['author']='';}
elseif($from && $idy){$rb['source']='Question'; $rb['author']=$from;}
elseif($from && !$idy && $nfo!='favoris' && $nfo!='retweet'){
	$rb['source']='Question manquante'; $rb['author']=$from;}
if($nfo=='favoris'){$rb['opt']='Favoris'; $rb['player']=$from;}
elseif($nfo=='retweet'){$rb['opt']='Retweet'; $rb['player']=$from;}
elseif($nfo=='status')$rb['opt']='Statut du';
elseif($from)$rb['opt']='Réponse';
else $rb['opt']='Message';
if($idy)$rb['tracks']=conn::read_b($idy,1).n(); $rb['trkbrut']=$idy;
$rb['social']=popart($id);
return $rb;}

function umcomp_ret($r){
list($id,$day,$suj,$lg,$msg,$trk)=$r;
$ret='['.$suj.':h2]';
$ret.='['.$trk.':div]';
$ret.='['.($trk?'Réponse':'Message').':b] ('.localdate($day).')';
$ret.='['.$msg.':div]';
return $ret;}

function umrec_lng($p,$o,$rid){$r=['fr','en','es'];//'all',
foreach($r as $k=>$v)
$ret.=lj($v==$o?'active':'','umcomp_plug___umcomp_umcomp*j_'.$p.'_'.$v,$v).' ';
return btn('nbp',$ret);}

function umcomp_j($p,$o,$res=''){
//list($p,$o)=ajxp($res,$p,$o);
req('art,pop,spe');
if(!$o)$o='fr';
$bt=umrec_lng($p,$o,$rid);
if($p)$r=req_compile($p,$o); //pr($r);
if($r)foreach($r as $k=>$v)$ret.=umcomp_ret($v);
return $bt.conn::read($ret);}

function umcomp_r(){
$r=['O6'=>'Oaxiiboo 6','Oolga Waam','Oomo Toa','Oyagaa Ayoo Yissaa','All'];
foreach($r as $v)$ret[$v]=$v;
return $ret;}

function umcomp_menu($p,$o,$rid){
$ret=select_j('inp','pfunc','','umcomp/umcomp_r','','2').' ';
$ret.=input1('inp',$p).' ';
$ret.=lj('',$rid.'_plug__3_umcomp_umcomp*j___inp',picto('ok'));
return divc('',$ret).br();}

function plug_umcomp($p,$o){
$rid='umcomp'; //$p='All';
if(!$p)$bt=umcomp_menu($p,$o,$rid);
if($p)$ret=umcomp_j($p,$lg);
return $bt.divd($rid,$ret);}

?>