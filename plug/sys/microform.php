<?php //microform
class microform{
static $conn=1;

static function form($p,$id,$prm=[]){
if(!$r[0])return lj('txtbox',ses('mformj'),pictxt('reload','error')); 
$r=msql::modif('',ses('mform'),$prm,'push');
return lj('txtbox',ses('mformj'),pictxt('smile',nms(139)));
return lj('txtbox','mfr'.$id.'_microform,read___'.$id,pictxt('smile',nms(139)));}

static function tab(){}

static function mr($d){$r=explode(',',$d);$n=count($r);
for($i=0;$i<$n;$i++){
	[$v,$type]=opt($r[$i],'='); $vb=normalize($v); 
	if($type!='button')$rb[]=$vb;}
//$rb[]='day';
return $rb;}

static function read($id){
$r=msql::read('',ses('mform'));
//if(auth(6))$ret.=lj('','mfr'.$id.'_microform,read___'.$id,picto('ok'));
if(auth(6))$ret.=lj('',ses('mformj'),picto('ok'));
$ret.=tabler($r,'txtcadr','').br();
return $ret;}

static function home($p,$id){$rid='mfr'.randid(); //echo $p.'-'.$id;
$nod=ses('mform',ses('qb').'_microform_'.$id); 
ses('mformj',$rid.'_microform,home___'.ajx($p).'_'.$id);
[$p,$tp]=opt($p,'§'); $rb=self::mr($p); //p($rb);
msql::read('',$nod,'','',$rb);
$ret.=mk::form($p,'mfr'.$id.'_microform,form',ajx($p).'_'.$id).br();
if(auth(4))$ret.=msqbt('users',ses('mform')).' '.btn('txtsmall2',$nod).' ';
if($tp==1)$ret.=self::read($id); elseif($tp)$ret.=msqtemplate::home($nod,$tp);
return divd($rid,$ret.$bt);}
}
?>