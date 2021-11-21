<?php
//philum_plugin_umbin

function inv($n){return $n==1?0:1;}

function ub_op($r,$o=''){$d=$r[1].$r[2];  //pr($r);
	switch($d){//philum.fr/403 //tests
		case('11'):$ret=$r[0]; break;//true
		case('00'):$ret=inv($r[0]); break;//false
		case('10'):$ret='0'; break;//0=>1,0=>0
		case('01'):$ret='1'; break;//1=>1,0=>1
	}
if($o)echo $d.' transforme '.$r[0].' en '.($r[3]).br();//.', renvoie '.$ret
return $ret;}

function ub_isinv($r){
//détermine l'effet de l'opérande
$op=ub_op($r['a'],0);//applique l'opérande au secteur connu
//regarde le résultat
$inv=$op!=$r[3]?true:false;
//compare le résultat attendu au réel (renvoie 1/0)
$op=ub_op($r['b']);
//déduction
return $inv?inv($op):$op;}

function ub_addinv($r){
//détermine l'effet
$op=$r['a'][0]+$r['a'][1];
//verif véracité
$inv=$op==$r[3]?1:0;
//applique à b
$op=$r['b'][0]+$r['b'][1];
//déduction
return $inv?$op:inv($op);}

function ub_transp($r){static $i; $i++;
$ra=array(0,1,1,1,0,0,0,1,0,0,1,1,1);
return $ra[$i];}

function ub_equi($r){static $i; $i++;
$ra=array(0,0,1,1,0,0,0,1,0,0,1,0,1);
return $ra[$i];}

function ub_soluce($r){static $i; $i++;
$ra=array(1,0,1,1,0,1,0,0,0,0,1,1,0,0,1);
return $ra[$i];}

function door_and($a,$b){if($a && $b)return 1; else return 0;}
function door_or($a,$b){if($a or $b)return 1; else return 0;}
function door_nand($a,$b){if(!$a or !$b)return 1; else return 0;}
function door_nor($a,$b){if(!$a && !$b)return 1; else return 0;}
function door_xor($a,$b){if(($a && !$b) or (!$a && $b))return 1; else return 0;}
function door_xnor($a,$b){if((!$a && !$b) or ($a && $b))return 1; else return 0;}

function build_doors(){
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

function ub_doors($r,$door=''){//pr($r);
static $i; $i++; if($i==3)$i=0;
if($i==0)$ret=door_and($r['a'][0],$r['a'][2]);
if($i==1)$ret=door_or($r['a'][0],$r['a'][2]);
if($i==2)$ret=door_nand($r['a'][0],$r['a'][2]);
return $ret;}

//datas
function bin_s(){
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
function ub_clr(){
$r=array(
'aa'=>array('E7522E','DEC700','6BAF22','51A0D3'),
'am'=>array('C8CBCE','C8CBCE','339F2D','357CBA'),
'ab'=>array('BD261C','E9E45D','638025','07529C'),
'ba'=>array('E7522E','DEC700','6BAF22','51A0D3'),
'bm'=>array('111A19','111A19','339F2D','357CBA'),
'bb'=>array('BD261C','E9E45D','638025','07529C'));
$rb=array(0,0,0,1,1,1,2,2,2,3,3,3);
foreach($r as $k=>$v)foreach($rb as $ka=>$va)$ret[$k][]=$v[$va];
return $ret;}

function ub_sty($d){return 'padding:10px; 
background-color:#'.$d.'; color:#'.invert_color($d,1).'';}

function tabler_clr($r,$rb){$tr='';
if(is_array($r))foreach($r as $k=>$v){$td='';
	if(is_array($v))foreach($v as $ka=>$va)$td.=bal('td',ats(ub_sty(valr($rb,$k,$ka))),$va);
	if($td)$tr.=bal('tr','',$td);}
return bal('table','',$tr);}

function bin_answ(){return ['aa'=>'001011010111','am'=>'000000100101','ab'=>'101000100111','ba'=>'110101111110','bm'=>'000000100111','bb'=>'100101110011'];}

//char to bin
function c2b_find($r,$d,$v,$k){$n=strpos($d,$v); $nb=strlen($v);
if($n!==false){$rb=[];
	for($i=$n;$i<$n+$nb;$i++)$rb[]=val($r,$i);
	return $k.' matched: {'.implode(' ',$rb).'}'.br();}
else return $k.': nothing '.br();}

function cartobin($p,$o,$id){
$ret=''; $ok=''; $r=[];
if(is_numeric($id))$d=sql('msg','qdm','v','id='.$id);
else $d=$p;
//$d=str_replace(['&nbsp;',"'",'"','-','/',',',';',':','$','#','_','+','=','!','?','\n','\r','\\','~','(',')','[',']','{','}','«','»'],'',($d));//'.','§','%','&',
//$ret=bal('code','','algo: foreach(explode(' ',$d) as $v)$ret.=strlen($v)%2;');
$rb=bin_answ(); //pr($rb);
foreach($rb as $k=>$v)$rc[]=[$k,$v];
$ok=tabler($rc);
if($d)$r=explode(' ',$d);
if($r){foreach($r as $k=>$v)$ret.=strlen($v)%2;
msql::modif('',nod('carbin'),[$ret],'one','',$id);}
if($r)foreach($rb as $k=>$v)$ok.=c2b_find($r,$ret,$v,$k);
if($ok)foreach($rb as $k=>$v)$ret=str_replace($v,btn('stabilo',$v),$ret);
return $ok.divs('word-wrap:break-word;',$ret);}

function char2bin($p){$j='cr2bn_plug___umbin_cartobin___c2b';
$ret=inputj('c2b','178',$j).lj('',$j,picto('ok'));
$ret.=msqbt('',nod('carbin'));
return $ret.divd('cr2bn',cartobin('','',$p));}

//decode
function wordstobin($p,$o,$d){$r=[];
$rb=bin_answ(); foreach($rb as $k=>$v)$rc[]=[$k,$v];
$ret=tabler($rc); $ok='';
if($d)$r=explode(' ',$d);
if($r)foreach($r as $k=>$v)$ret.=strlen($v)%2;
if($r)foreach($rb as $k=>$v)$ok.=c2b_find($r,$ret,$v,$k);
if($ok)foreach($rb as $k=>$v)$ret=str_replace($v,btn('stabilo',$v),$ret);
return $ok.divs('word-wrap:break-word;',$ret);}

function chardecod($p){$j='cr2bn_plug___umbin_wordstobin___c2b';
$ret=inputj('c2b','hello world',$j,60).lj('',$j,picto('ok'));
$ret.=msqbt('',nod('carbin'));
return $ret.divd('cr2bn',wordstobin('','',$p));}

//algo
function ub_algo($r,$p){//pr($r);
if($p==0)return '';//test0
if($p==1)return ub_isinv($r);//test1: utilise ma et mb comme opérande
if($p==2)return ub_addinv($r);//test2: additionne aa+am=ab, si vrai alors bb=ba+bm
if($p==3)return ub_transp($r);//test3: transpose
if($p==4)return ub_equi($r);//test4: transpose
if($p==5)return ub_doors($r);//test5: logical doors
if($p==6)return ub_soluce($r);//soluce
else return ub_op($r['b']);}

//load
function plug_umbin($p,$o){$r=bin_s(); $bt=''; $ret=''; $doors='';
foreach($r as $k=>$v)foreach($v as $ka=>$va)$rb[$ka][$k]=$va; //pr($rb);
/*[0]=[aa] => 0, [am] => 0, [ab] => 1, [ba] => 1, [bm] => 0, [bb] => ?)*/
foreach($rb as $k=>$v)$rc[]=array(
	'a'=>array($v['aa'],$v['am'],$v['ab']),
	'b'=>array($v['ba'],$v['bm'],$v['bb'])); //pr($rc);
/*[0][a]=[0] => 0,[1] => 0,[2] => 0,[3] => 1,))*/
//foreach($rc as $k=>$v)$rd[$k]=ub_algo($v,$p); //pr($rd);
//$r['bb']=$rd; $ret='';
//for($i=0;$i<=6;$i++)$ret.=lj('txtx','umbin_plugin___umbin_'.$i,$i);
$bt.=lj('txtx','umbin_plug___umbin_char2bin','idart to bin');
$bt.=lj('txtx','umbin_plug___umbin_chardecod','words to bin');
//return tabler($r);
//$pub=popart(1275); 
if($p==5)$doors=build_doors();
elseif(is_numeric($p))$ret=char2bin($p);
return $bt.divd('umbin',$ret).tabler_clr($r,ub_clr()).br().$doors;
}
?>