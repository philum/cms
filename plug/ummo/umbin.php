<?php
//philum_plugin_umbin

function inv($n){return $n==1?0:1;}

function ub_op($r,$o=''){$d=$r[1].$r[2];  //pr($r);
	switch($d){//philum.org/403 //tests
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

function ub_transp($r){
static $i; $i++;
$ra=array(0,1,1,1,0,0,0,1,0,0,1,1,1);
return $ra[$i];}

function ub_equi($r){
static $i; $i++;
$ra=array(0,0,1,1,0,0,0,1,0,0,1,0,1);
return $ra[$i];}

//traitement

function ub_algo($r,$p){//pr($r);
if($p==1)return ub_isinv($r);//test1: utilise ma et mb comme opérande
if($p==2)return ub_addinv($r);//test2: additionne aa+am=ab, si vrai alors bb=ba+bm
if($p==3)return ub_transp($r);//test3: transpose
if($p==4)return ub_equi($r);//test3: transpose
else return ub_op($r['b']);//test0
}

//datas

function bin_s(){
$r=array(
'aa'=>'001011010111',
'am'=>'000000100101',
'ab'=>'101000100111',
'x'=>'------------',
'ba'=>'110101111110',
'bm'=>'000000100111',
'bb'=>'????????????');
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

//load

function plug_umbin($p,$o){
$r=bin_s();

foreach($r as $k=>$v)
	foreach($v as $ka=>$va)
		$rb[$ka][$k]=$va; //pr($rb);

/*[0] => Array
        (
            [aa] => 0
            [am] => 0
            [ab] => 1
            [ba] => 1
            [bm] => 0
            [bb] => ?
        )*/
		
foreach($rb as $k=>$v)
	$rc[]=array(
		'a'=>array($v['aa'],$v['am'],$v['bm'],$v['ba']),
		'b'=>array($v['ab'],$v['am'],$v['bm'],$v['bb'])); //pr($rc);

/*[0] => Array
	(
		[a] => Array
			(
				[0] => 0
				[1] => 0
				[2] => 0
				[3] => 1
			)

		[b] => Array
			(
				[0] => 1
				[1] => 0
				[2] => 0
				[3] => ?
			)

	)*/

foreach($rc as $k=>$v)
	$rd[$k]=ub_algo($v,$p); //pr($rd);

$r['bb']=$rd;
for($i=0;$i<=4;$i++)$ret.=lkc('txtx','/plug/umbin/'.$i,$i);

//return make_table($r);
//$pub=popart(1275); 
return $ret.br().make_table_clr($r,ub_clr()).$pub;
}

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
background-color:#'.$d.'; color:'.invert_color($d,1).'';}

function make_table_clr($r,$rb){
if(is_array($r))foreach($r as $k=>$v){$td='';
	if(is_array($v))foreach($v as $ka=>$va)$td.=balb('td',ats(ub_sty($rb[$k][$ka])),$va);
	if($td)$tr.=balb('tr',ats($rb[$k][$ka]),$td);}
return balb('table','',$tr);}
?>