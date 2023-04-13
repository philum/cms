<?php 
class umbin{
static function inv($n){return $n==1?0:1;}

static function op($r,$o=''){$d=$r[1].$r[2];  //pr($r);
	switch($d){//philum.fr/403 //tests
		case('11'):$ret=$r[0]; break;//true
		case('00'):$ret=self::inv($r[0]); break;//false
		case('10'):$ret='0'; break;//0=>1,0=>0
		case('01'):$ret='1'; break;//1=>1,0=>1
	}
if($o)echo $d.' transforme '.$r[0].' en '.($r[3]).br();//.', renvoie '.$ret
return $ret;}

static function isinv($r){
//détermine l'effet de l'opérande
$op=self::op($r['a'],0);//applique l'opérande au secteur connu
//regarde le résultat
$inv=$op!=$r[3]?true:false;
//compare le résultat attendu au réel (renvoie 1/0)
$op=self::op($r['b']);
//déduction
return $inv?inv($op):$op;}

static function addinv($r){
//détermine l'effet
$op=$r['a'][0]+$r['a'][1];
//verif véracité
$inv=$op==$r[3]?1:0;
//applique à b
$op=$r['b'][0]+$r['b'][1];
//déduction
return $inv?$op:inv($op);}

static function transp($r){static $i; $i++;
$ra=[0,1,1,1,0,0,0,1,0,0,1,1,1];
return $ra[$i];}

static function equi($r){static $i; $i++;
$ra=[0,0,1,1,0,0,0,1,0,0,1,0,1];
return $ra[$i];}

static function soluce($r){static $i; $i++;
$ra=[1,0,1,1,0,1,0,0,0,0,1,1,0,0,1];
return $ra[$i];}

static function door_and($a,$b){if($a && $b)return 1; else return 0;}
static function door_or($a,$b){if($a or $b)return 1; else return 0;}
static function door_nand($a,$b){if(!$a or !$b)return 1; else return 0;}
static function door_nor($a,$b){if(!$a && !$b)return 1; else return 0;}
static function door_xor($a,$b){if(($a && !$b) or (!$a && $b))return 1; else return 0;}
static function door_xnor($a,$b){if((!$a && !$b) or ($a && $b))return 1; else return 0;}

static function build_doors(){
$r=['and','or','nand','nor','xor','xnor'];
$rb['_k']=['(doors)','1,1','1,0','0,1','00'];
foreach($r as $k=>$v){$rb[$k][]=$v;
	$rb[$k][]=call_user_func('door_'.$v,1,1);
	$rb[$k][]=call_user_func('door_'.$v,1,0);
	$rb[$k][]=call_user_func('door_'.$v,0,1);
	$rb[$k][]=call_user_func('door_'.$v,0,0);
}
$ret=tabler($rb);
return $ret;}

static function doors($r,$door=''){//pr($r);
static $i; $i++; if($i==3)$i=0;
if($i==0)$ret=self::door_and($r['a'][0],$r['a'][2]);
if($i==1)$ret=self::door_or($r['a'][0],$r['a'][2]);
if($i==2)$ret=self::door_nand($r['a'][0],$r['a'][2]);
return $ret;}

//datas
static function bin_s(){
$r=array(
'aa'=>'001011010111',
'am'=>'000000100101',
'ab'=>'101000100111',
'x'=>'------------',
'ba'=>'110101111110',
'bm'=>'000000100111',
'bb'=>'100101110011');
/*$rx=array(//original
'aa'=>'001011010111',//+2 0 avant
'a'=>'000000100101',//+6 0 avant
'ab'=>'101000100111',//idem
'ba'=>'110101111110',//idem
'b'=>'000000100111',//+5 0 avant
'bb'=>'????????????');*/
foreach($r as $k=>$v)
	$r[$k]=str_split($v);
return $r;}

//design
static function clr(){
$r=array(
'aa'=>array('E7522E','DEC700','6BAF22','51A0D3'),
'am'=>array('C8CBCE','C8CBCE','339F2D','357CBA'),
'ab'=>array('BD261C','E9E45D','638025','07529C'),
'ba'=>array('E7522E','DEC700','6BAF22','51A0D3'),
'bm'=>array('111A19','111A19','339F2D','357CBA'),
'bb'=>array('BD261C','E9E45D','638025','07529C'));
$rb=[0,0,0,1,1,1,2,2,2,3,3,3];
foreach($r as $k=>$v)foreach($rb as $ka=>$va)$ret[$k][]=$v[$va];
return $ret;}

static function sty($d){return 'padding:10px; 
background-color:#'.$d.'; color:#'.invert_color($d,1).'';}

static function tabler_clr($r,$rb){$tr='';
if(is_array($r))foreach($r as $k=>$v){$td='';
	if(is_array($v))foreach($v as $ka=>$va)$td.=tag('td',ats(self::sty(valr($rb,$k,$ka))),$va);
	if($td)$tr.=tagb('tr',$td);}
return tagb('table',$tr);}

static function bin_answ(){return ['aa'=>'001011010111','am'=>'000000100101','ab'=>'101000100111','ba'=>'110101111110','bm'=>'000000100111','bb'=>'100101110011'];}

//encode
static function encode($d){$ret=''; if(!$d)return; $r=explode(' ',$d);
foreach($r as $k=>$v)$ret.=strlen($v)%2;
return $ret;}

//char to bin
static function c2b_find($r,$d,$v,$k){$n=strpos($d,$v); $nb=strlen($v);
if($n!==false){$rb=[];
	for($i=$n;$i<$n+$nb;$i++)$rb[]=val($r,$i);
	return $k.' matched: {'.implode(' ',$rb).'}'.br();}
else return $k.': nothing '.br();}

static function cartobin($p,$o,$id){
$ret=''; $ok=''; $r=[];
if(is_numeric($id))$d=sql('msg','qdm','v','id='.$id);
else $d=$p;
//$d=str_replace(['&nbsp;',"'",'"','-','/',',',';',':','$','#','_','+','=','!','?','\n','\r','\\','~','(',')','[',']','{','}','«','»'],'',($d));//'.','§','%','&',
//$ret=tagb('code',self::encode($d));
$rb=self::bin_answ(); //pr($rb);
foreach($rb as $k=>$v)$rc[]=[$k,$v];
$ok=tabler($rc);
$ret=self::encode($d); if($ret){
	msql::modif('',nod('carbin'),[$ret],'one','',$id);
	if($r)foreach($rb as $k=>$v)$ok.=self::c2b_find($r,$ret,$v,$k);}
if($ok)foreach($rb as $k=>$v)$ret=str_replace($v,btn('stabilo',$v),$ret);
return $ok.divs('word-wrap:break-word;',$ret);}

static function char2bin($p){$j='cr2bn_umbin,cartobin_c2b';
$ret=inputj('c2b','178',$j).lj('',$j,picto('ok'));
$ret.=msqbt('',nod('carbin'));
return $ret.divd('cr2bn',self::cartobin('','',$p));}

//decode
static function wordstobin($p,$o,$prm=[]){$r=[]; $d=$prm[0]??'';
$rb=self::bin_answ(); foreach($rb as $k=>$v)$rc[]=[$k,$v];
$ret=tabler($rc); $ok='';
$ret=self::encode($d);
if($ret)foreach($rb as $k=>$v)$ok.=self::c2b_find($r,$ret,$v,$k);
if($ok)foreach($rb as $k=>$v)$ret=str_replace($v,btn('stabilo',$v),$ret);
return $ok.divs('word-wrap:break-word;',$ret);}

static function chardecod($p){$j='cr2bn_umbin,wordstobin_c2b';
$ret=inputj('c2b','hello world',$j,'',60).lj('',$j,picto('ok'));
$ret.=msqbt('',nod('carbin'));
return $ret.divd('cr2bn',self::wordstobin('','',[$p]));}

//search
static function search($p,$o,$prm=[]){
[$p,$o]=prmp($prm,$p,$o); $enc=self::encode($p); $rb=[]; $ret='';
$r=msql::read('',nod('carbin'),'',1); //pr($r);
foreach($r as $k=>[$v])if($n=substr_count($v,$enc))$rb[$k]=$n; //pr($rt);
foreach($rb as $k=>$v)$ret.=divb(lj('','b2d_bincode,bin2txt___'.$k.'_'.$enc,pictxt('view',$k.' ('.$v.')')));
$ret.=divd('b2d','');
return divb('bincode: '.$enc).divb(count($rb).' articles').$ret;}

static function searchcod($p){$j='cr2bn_umbin,search_c2b';
$ret=textarea('c2b','hello world',60,4).lj('',$j,picto('ok'));
$ret.=msqbt('',nod('carbin'));
return $ret.divd('cr2bn',self::wordstobin('','',[$p]));}

//algo
static function ub_algo($r,$p){//pr($r);
if($p==0)return '';//test0
if($p==1)return self::isinv($r);//test1: utilise ma et mb comme opérande
if($p==2)return self::addinv($r);//test2: additionne aa+am=ab, si vrai alors bb=ba+bm
if($p==3)return self::transp($r);//test3: transpose
if($p==4)return self::equi($r);//test4: transpose
if($p==5)return self::doors($r);//test5: logical doors
if($p==6)return self::soluce($r);//soluce
else return self::op($r['b']);}

//load
static function home($p,$o){$r=self::bin_s(); $bt=''; $ret=''; $doors='';
foreach($r as $k=>$v)foreach($v as $ka=>$va)$rb[$ka][$k]=$va; //pr($rb);
/*[0]=[aa] => 0, [am] => 0, [ab] => 1, [ba] => 1, [bm] => 0, [bb] => ?)*/
foreach($rb as $k=>$v)$rc[]=array(
	'a'=>array($v['aa'],$v['am'],$v['ab']),
	'b'=>array($v['ba'],$v['bm'],$v['bb'])); //pr($rc);
/*[0][a]=[0] => 0,[1] => 0,[2] => 0,[3] => 1,))*/
//foreach($rc as $k=>$v)$rd[$k]=self::ub_algo($v,$p); //pr($rd);
//$r['bb']=$rd; $ret='';
//for($i=0;$i<=6;$i++)$ret.=lj('txtx','umbin_plugin___umbin_'.$i,$i)
//$bt.=lj('popbt','umbin_umbin,home','umbin');
if(auth(6))$bt.=lj('popbt','umbin_bincode,home','bincode');;
$bt.=lj('txtx','umbin_umbin,char2bin','idart to bin');
$bt.=lj('txtx','umbin_umbin,chardecod','words to bin');
$bt.=lj('txtx','umbin_umbin,searchcod','search');
//return tabler($r);
//$pub=ma::popart(1275); 
if($p==5)$doors=self::build_doors();
elseif(is_numeric($p))$ret=self::char2bin($p);
return $bt.divd('umbin',$ret).self::tabler_clr($r,self::clr()).br().$doors;}
}
?>