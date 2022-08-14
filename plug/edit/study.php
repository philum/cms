<?php //study
class study{
static function sav($p,$o,$prm=[]){
[$nod,$row,$col]=explode('-',$p);
$ret=$prm[0]??''; $d=deln($ret);  $d=delbr($d,"\n"); //$d=delr($d);
//eco($d,1);//$ret=utf82ascii($ret);
msql::modif('',nod('study_'.$nod),$d,'shot',trim($col),trim($row));
return $ret;}

static function read($r,$p=1){
$s='border:1px dotted silver; width:22vw; min-height:22px;';
foreach($r as $k=>$v){
	if(auth(3) && $k!='_menus_')for($i=0;$i<4;$i++){//nb of columns to add
		$j='stda'.$k.$i.'_study,sav_stda'.$k.$i.'__'.$p.'-'.$k.'-'.$i;
		//$bt=lj('',$j,picto('save')).' ';.$bt
		$t=isset($v[$i])?$v[$i]:'';//stripslashes
		$t=codeline::parse($t,'','sconn'); //$t=htmlentities($t);
		$t=nl2br($t);
		if($i==0)$v[$i]=divc('track',$t);
		else $v[$i]=divarea('stda'.$k.$i,$t,'track',$s,sj($j),1);}
	$rb[]=[$v[0],$v[1],$v[2],$v[3]];}
return tabler($rb,'txtbox');}

static function call($p,$rid){
//$bt=self::menu($p,$rid);
$bt=pop::pubart($p);
$r=msql_read('',nod('study_'.$p));
return $bt.self::read($r,$p);}

static function hash($d,$p){
$d=str_replace('.<','. <',$d);
$d=str_replace(array('<p>','</p>','<br>','<br />'),'',$d);
$d=str_replace(array('. ',".\n"),'#nl#',$d);
$d=str_replace("\n",'#nl#',$d);
$r=explode('#nl#',$d);
foreach($r as $v)if($v)$rb[]=[trim(addslashes($v)).'.','','',''];
$rb=msql::save('',nod('study_'.$p),$rb,['text','description','commentaires','references']);
return self::read($rb,$p);}

static function build($p,$o,$res=''){
$id=ajxg($res);
$d=sql('msg','qdm','v','id='.$id);
if(is_array($d))return 'no';
$d=codeline::parse($d,'','delconn');
$ret=self::hash($d,$id);
return $ret;}

static function input($p,$o){
$next=msql::findlast('',ses('qb'),'study');
$j=$p.'_study,build___'.$next.'__stdy';
$ret=inputj('stdy','',$j,'id of art');
$ret.=lj('poph',$j,picto('ok'));
//$ret.=divarea('stdy','','tab justy','border:1px dotted silver; min-height:22px;',$j);
return $ret;}

static function menu($p,$rid){$ret='';
$r=msql::choose('',ses('qb'),'study'); if($r)sort($r);//$v==$p?'active':
if($r)foreach($r as $v)$ret.=lj($p==$v?'active':'',$rid.'_study,call___'.$v.'_'.$rid,$v);
return btn('nbp',$ret).' ';}

static function home($p,$o){$rid=randid('plg');
Head::add('jscode','function stydiv(d){}'); $bt=''; $ret='';
if(auth(4))$bt=lj('',$rid.'_study,input___'.$rid,picto('add')).' ';
if(auth(4))$bt.=msqbt('',nod('study_'.$p)).' ';
$bt.=hlpbt('study');
if($p)$ret=self::call($p,$rid);
else $bt.=self::menu($p,$rid);
return $bt.divd($rid,$ret);}
}
?>