<?php //umvoc
class umvoc{

static function r(){
return msql::read('users','ummo_umvoc_1','',1);}

static function umvr(){$r=self::r();
foreach($r as $k=>$v)$rb[$v[0]]=$v[0]; sort($rb);
return $rb;}

static function bt($k,$r){
//$rb=['word','name','expression','unit','math'];
$ret=isset($r[2])?' ('.$r[2].') ':' ';
$ret.=lj('','popup_search,home___'.ajx($r[0]),picto('search',16)).' ';
if($r[3])$ret.=' ['.$r[3].'] ';
if(auth(6))$ret.=lj('popbt','popup_umvoc,cmdf___'.$k,picto('editxt'));
$ret.=self::glyphe($r[0]).br();
return hr().tagb('b',$r[0]).$ret.divc('panel',nl2br(stripslashes($r[1])));}

//edit
static function sav($p,$o,$prm){$def=$prm[0]??'';
$rb=sql::inner('distinct(frm)','qdm','qda','id','rv','nod="ummo" and substring(frm,1,1)!="_" and frm!="Etudes" and frm!="Blog" and substring(frm,1,2)!="ES" substring(frm,1,2)!="EN" and re>0 and msg like "%'.$p.' %"','');
if($rb)$ref=implode(' ',$rb); else $ref='';
$defs=[strtoupper($p),$def,'word',$ref];
$r=msql::modif('','ummo_umvoc_1',$defs,'push','','');
return self::search($p,'1','');}

static function add($p){$ret=textarea('addvoc','',34,1).' ';
$ret.=lj('popsav','ucbk_umvoc,sav_addvoc__'.ajx($p),pictxt('save',nms(92)));
return $ret;}

static function cmdfsav($p,$o,$prm){$r=arr($prm,4);
msql::modif('','ummo_umvoc_1',$r,'row','',$p);
return self::search($r[0],'1','');}

static function cmdf($p){
$r=msql::read('users','ummo_umvoc_1',$p);
$ret=input('mdfvoc',$r[0]).' ';
$ret.=select(['id'=>'mdftyp'],['word','name','expression','unit','number'],'vv',$r[2]).br();
$ret.=textarea('mdftxt',$r[1],40,4).br();
$ret.=hidden('mdfref',$r[3]);
$ret.=lj('popsav','ucbk_umvoc,cmdfsav_mdfvoc,mdftxt,mdftyp,mdfref__'.ajx($p),pictxt('save',nms(27)));
return $ret;}

static function imz($f,$n='2'){
[$w,$h]=fwidth($f);
$w=round($w/$n);$h=round($h/$n);
return image('/'.$f,$w,$h);}

static function glyphe($p){
$f='users/ummo/glyphes/'.strtoupper($p).'.png';
if(is_file($f))return self::imz($f,6);
return oomo(strtoupper(str_replace(' ','-',$p)),36,'bkg');}

//glossaire
static function between($id,$pos){
$d=sql('msg','qdm','v','id='.$id);
$t=sql('suj','qda','v','id='.$id); 
$ret=lj('txtcadr','popup_popart__3_'.$id.'_3',$t).br();
$ret.=substr($d,$pos-50,100);
return $ret;}

static function segments($p){//occurrences
$r=sql::inner('idart,pos','qdvoc','qdvoc_b','idvoc','','voc="'.$p.'" group by pos order by idart');
$ret=divc('txtcadr',$p.' : '.nbof(count($r),19)).br();
if($r)foreach($r as $k=>$v){
	$va=self::between($v[0],$v[1]); $va=str_replace($p,btn('stabilo',$p),$va);
	$ret.=divc('tracks',$va).br();}
return $ret;}

static function glossary($p,$o){$ps=soundex($p);//search likes
$r=sql::call('select voc from pub_umvoc where SOUNDEX(voc)="'.$ps.'";','rv');
$r=self::levenstein($p,$r); $ret='';
if($r)foreach($r as $k=>$v)$ret.=lj('','popup_umvoc,segments___'.$v,$v);
if(!$ret)$ret=btn('txtcadr',$p.': '.nms(11).' '.nms(16));
return divc('list',$ret);}

static function levenstein($p,$r){$rb=[]; $rc=[];
if($r)foreach($r as $v){$lev=levenshtein($p,$v); $rb[$lev][]=$v;}
if($rb){ksort($rb); foreach($rb as $v)foreach($v as $vb)$rc[]=$vb;}
return $rc;}

/*static function levenstein($p,$r){//correction orthographique
foreach($r as $v){$lev=levenshtein($p,$v);
	if($lev==0){$closest=$v; $shortest=0; break;}
	if($lev<=$shortest || $shortest<0){$closest=$word; $shortest=$lev;}}
if($shortest)echo 'nearest existing word';
return $closest;}*/

//search
static function result($p,$r,$ka){$n=count($r);
$t1='Recherche littérale'; $t2='Glossaire';
$search=lj('popbt','popup_search,home___'.ajx(strtolower($p)),pictxt('search',$t1)).' ';
//$search.=lj('popbt','popup_umvoc,glossary___'.$p.'_'.$o,pictxt('view',$t2)).' ';
$search.=lj('popbt','popup_bdvoc,home___'.ajx($p),pictxt('search','BD-voc')).' ';
//$search.=togbub('umvoc,glossary',$p,picto('view')).' ';
$glyphe=self::glyphe($p);
$ret=implode('',$r).br();
if(auth(6))$sav=self::add(strtoupper($p)).br();
if(!$ret)return btn('txtcadr',$search.$glyphe.' '.nms(11).' '.nms(16)).br().$sav;
return btn('txtcadr',$n.' '.plurial($n,16)).' '.$search.$glyphe.$sav.$ret;}

static function find($p,$o,$prm){[$p,$o]=arr($prm);
$p=trim($p); $r=self::r(); if(!$p)return; $ret=[];
if($r)foreach($r as $k=>$v){$v=arr($v,4);
	if(strpos($v[1],$p)!==false)$ret[]=self::bt($k,$v);}
return self::result($p,$ret,'');}

static function search($p,$o,$prm=[]){$p=$prm[0]??$p; $o=$prm[1]??$o;
$p=strtolower(trim($p)); $ps=soundex($p); $r=self::r(); if(!$p)return; $ret=[]; $rb=[]; $ka=0;
if($r)foreach($r as $k=>$v){$voc=strtolower($v[0]); $vcb=soundex($voc); $v=arr($v,4);
	if($o){if($vcb==$ps){$ret[]=self::bt($k,$v); $rb[]=levenshtein($p,$voc);}}
	elseif(strpos($voc,$p)!==false){$ret[]=self::bt($k,$v); $ka=$k;}}
if($rb){$rc=[]; asort($rb); foreach($rb as $k=>$v)$rc[]=$ret[$k]; $ret=$rc;}
return self::result($p,$ret,$ka);}

static function slctjr($p,$o){$r=self::r(); $ret='';
if($r)foreach($r as $k=>$v){$d=addslashes($v[0]);
$ret.=ljb('',atjr('jumpvalue',['usrch',$d]).'; '.sj('ucbk_umvoc,search___'.$d.'_1').' clpop(event);','',$v[0]);}
return divc('nbp list',$ret);}

static function slctj($d){$rid='bt'.randid(); $bt=btn('popbt','select...');
return togbub('umvoc,slctjr',$d.'_'.$rid,$bt);}

static function home($p,$o){
ses('qdvoc',qd('umvoc'));
ses('qdvoc_b',qd('umvoc_arts'));
ses('dico','dicoum');
$ret=self::slctj($p).' ';
//$ret.=lj('','usrch___4',picto('del')).' ';
$j='ucbk_umvoc,search_usrch,udsnd__'.ajx($p);
$ret.=inputj('usrch',$p,$j).' ';
$ret.=checkbox_j('udsnd',1,'soundex');//|chk
$ret.=lj('popsav',$j,'chercher').' ';
$j='ucbk_umvoc,find_usrch,udsnd__'.ajx($p);
$ret.=lj('popsav',$j,'trouver').' ';
$ret.=hlpbt('levenshtein').br().br();
$ret.=divd('ucbk',self::search($p,'1','')).br();
$ret.=msqbt('','ummo_umvoc_1','').' ';
$ret.=lkt('','/app/umvoc',picto('link'));
return $ret;}
}
?>