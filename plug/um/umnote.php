<?php //umnote
class umnote{

static function r(){
return msql::read('users',ses('umncnod'),'',1);}

static function umnr(){$r=self::r();
foreach($r as $k=>$v)$rb[$v[0]]=$v[0]; sort($rb);
return $rb;}

static function bt($r){
$rb=['vocable','name','planet','unit','math'];
$ret=isset($rb[$r[2]])?' ('.$rb[$r[2]].') ':' ';
$ret.=lj('','popup_search,home___'.ajx($r[0]),picto('search',16)).' ';
if($r[3])$ret.=' ['.$r[3].'] ';
//$ret.=ud_glyphe($r[0]).br();
return hr().tagb('b',$r[0]).$ret.divc('justy',nl2br(stripslashes($r[1])));}

//edit
static function sav($p,$o,$prm){$def=$prm[0]??'';
$rb=sql::inner('frm','qdm','qda','id','k','nod="ummo" and substring(frm,1,1)!="_" and frm!="Etudes" and substring(frm,1,2)!="ES" and re>0 and msg like "% '.$p.' %"',''); if($rb)$ref=implode(' ',array_keys($rb));
$defs=[$p,$def,'',$ref];
msql::modif('',ses('umncnod'),$defs,'push','','');
return self::search($p,'1',$prm);}

static function add($p){
$ret=textarea('addvoc','',40,4);
$ret.=lj('popsav','uncbk_umnote,sav___'.ajx($p).'__addvoc',pictxt('save',nms(92)));
return $ret;}

//glossaire
static function between($id,$pos){
$d=sql('msg','qdm','v','id='.$id);
$t=sql('suj','qda','v','id='.$id); 
$ret=lj('txtcadr','popup_popart__3_'.$id.'_3',$t).br();
$ret.=substr($d,$pos-50,100);
return $ret;}

//search
static function search($p,$o,$prm=[]){[$p,$o]=arr($prm,2);
$p=strtolower(trim($p)); $ps=soundex($p); $r=self::r(); if(!$p)return;
if($r)foreach($r as $k=>$v){$voc=strtolower($v[0]); $vcb=soundex($voc);
	if($voc==$p or $vcb==$ps or strpos($voc,$p)!==false)$ret[]=self::bt($v);}
$n=count($ret);
$search=lj('popbt','popup_search,home___'.ajx(strtoupper($p)),pictxt('search',nms(24))).br();
if($ret)$ret=implode('',$ret).br();
if(auth(2))$sav=self::add($p).br();
if(!$ret)return btn('txtcadr',nms(11).' '.nms(16)).' '.$search.br().$sav;
return btn('txtcadr',$n.' '.plurial($n,16)).' '.$search.$ret.$sav;}

static function slctjr($p,$o){$r=self::r(); $ret='';
if($r)foreach($r as $k=>$v){$d=addslashes($v[0]);
$ret.=ljb('',atjr('jumpvalue',['unrch',$d]).' '.sj('uncbk_umnote,search___'.$d.'_1').' clpop(event);','',$v[0]);}
return divc('nbp list',$ret);}

static function slctj($d){$rid='bt'.randid(); $bt=btn('popbt','select...');
return togbub('umnote,slctjr',$d.'_'.$rid,$bt);}

static function home($p,$o){
ses('umncnod','ummo_umnote_1');
$ret=self::slctj($p).' ';
$ret.=input('unrch',$p,'').' ';
$ret.=lj('popsav','uncbk_umnote,search_unrch_15_'.ajx($p),'chercher').' ';
$ret.=divd('uncbk',umvoc::search($p,'1','')).br();
$ret.=msqbt('',ses('umncnod'),'').' ';
$ret.=lkt('','/app/umnote',picto('link'));
return $ret;}
}
?>