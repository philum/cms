<?php //bincode
class bincode{
static function bin_answ(){return ['aa'=>'001011010111','am'=>'000000100101','ab'=>'101000100111','ba'=>'110101111110','bm'=>'000000100111','bb'=>'100101110011'];}

static function tabler(){
$r=umbin::bin_s();
$clr=umbin::clr();
return umbin::tabler_clr($r,$clr);}

//char to bin
static function c2b_find($r,$d,$v,$k){$n=strpos($d,$v); $nb=strlen($v);
if($n!==false){$rb=[];
	for($i=$n;$i<$n+$nb;$i++)$rb[]=$r[$i]??'';
	return $k.' matched: {'.implode(' ',$rb).'}'.br();}
else return $k.': nothing '.br();}

//find bin in txt
static function bin2txt($id,$bin){//cartobin
$ret=''; $ok=''; $r=[]; $ok='';
if(is_numeric($id))$d=sql('msg','qdm','v',$id);
//self::art2bin($id,$d);//save
$d=self::cleanup($d); //echo $d;
if($d)$r=explode(' ',$d);
if($r)foreach($r as $k=>$v)$ret.=strlen($v)%2;
if($r)$ok=self::c2b_find($r,$ret,$bin,$id);
if($ok)$ret=str_replace($ok,btn('stabilo',$ok),$ret);
return divs('word-wrap:break-word;',$ret);}

//null
/*static function char2bin($p){$j='cr2bn_bincode,bin2txt_c2b';
$ret=inputj('c2b','178',$j).lj('',$j,picto('ok'));
$ret.=msqbt('',nod('carbin'));
return $ret.divd('cr2bn',self::bin2txt('','',$p));}*/

static function cleanup($d){return str_replace(['&nbsp;',"'",'"','-','/',',',';',':','$','#','_','+','=','!','?','\n','\r','\\','~','(',')','[',']','{','}','§','%','&'],'',$d);}

static function art2bin($id,$d){$ret=''; $r=[];
$d=self::cleanup($d);
if($d)$r=explode(' ',$d);
if($r){foreach($r as $k=>$v)$ret.=strlen($v)%2;
msql::modif('',nod('carbin'),[$ret],'one','',$id);}
return $ret;}

static function bindatas($p,$o){
$r=sql_inner('pub_art.id,msg','qda','qdm','id','kv',['frm'=>'ES-D']);//
foreach($r as $k=>$v)self::art2bin($k,$v);
return 'ok: '.implode(' ',array_keys($r));}

//decode
static function txt2bin($p,$o,$prm=[]){
[$p,$o]=prmp($prm,$p,$o);
$r=explode(' ',$p); $ret='';
if($r)foreach($r as $k=>$v)$ret.=strlen($v)%2;
return $ret;}

static function chardecod($p){$j='cr2bn_bincode,wordstobin_c2b';
$ret=inputj('c2b','hello world',$j,60).lj('',$j,picto('ok'));
$ret.=msqbt('',nod('carbin'));
return $ret.divd('cr2bn',umbin::wordstobin('','',$p));}

//find bin in datas
static function bin2datas($p,$o,$prm=[]){
[$p,$o]=prmp($prm,$p,$o); $ret=''; $rb=[];
$r=msql::col('','ummo_carbin',0);
foreach($r as $k=>$v)if(strpos($p,$v)!==false)$rb[]=$k; //pr($r);
//$ret=tabler($rb);
foreach($rb as $k=>$v)$ret.=divb(lj('','b2d_bincode,bin2txt___'.$v.'_'.$p,pictxt('view',$v)));
$ret.=divd('b2d','');
return $ret;}

static function menu($p,$rid){
//$ret=self::tabler();
$ret=tabler(self::bin_answ());
$ret.=input('inp1',$p);
$ret.=lj('popsav',$rid.'_bincode,bin2datas_inp1_2__'.$rid,'bin=>text').br();
$ret.=textarea('inp2',$p,40,4);
$ret.=lj('popsav',$rid.'_bincode,txt2bin_inp2_2__'.$rid,'text=>bin').' ';
if(auth(6))$ret.=lj('popdel',$rid.'_bincode,bindatas__2__'.$rid,'create_bindatas').' ';
$ret.=msqbt('',nod('carbin'));
return $ret;}

//load
static function home($p,$o){
$rid=randid('bc');
$bt=self::menu($p,$rid);
if(is_numeric($p))$ret=self::bin2datas($p,$o);
elseif($p)$ret=self::txt2bin($p,$o);
else $ret='';
return $bt.divd($rid,'');}
}
?>