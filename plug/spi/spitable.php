<?php //spitable
class spitable{
static $max=118;

static function js($n=1){
$j='spit_spitable,call__2';
return 'var n='.($n?$n:118).';
addEvent(document,"DOMMouseScroll",function(){wheelcount(event,"'.$j.'","")});';}

static function origin_label(){
return msql::read('','public_atomic_6');}

static function origin($p){
$r=msql::row('','public_atomic_5',$p);
$rb=self::origin_label();
$n=$r[1]??'';//value(s)
if(strpos($n,'/')){[$a,$b]=expl('/',$n); $res=join(' + ',[$rb[$a][1]??'',$rb[$b][1]??'']);}
else $res=$rb[$n][1]??'';
return $res;}

static function infos($p){
$r=msql::row('','public_atomic',$p,1);
if(!$r)return btn('txtx','Element '.$p);
$r['origin']=self::origin($p);
return on2cols($r,470,3);}

static function ring_b($rg){
if($rg==1)return [1=>44,2=>45];
elseif($rg==2)return [1=>35,2=>34,3=>43,4=>54,5=>55,6=>46];
elseif($rg==3)return [1=>36,2=>25,3=>24,4=>33,5=>42,6=>53,7=>64,8=>65,9=>56,10=>47];
elseif($rg==4)return [1=>37,2=>26,3=>15,4=>14,5=>23,6=>32,7=>41,8=>52,9=>63,10=>74,11=>75,12=>66,13=>57,14=>48];
elseif($rg==5)return [1=>38,2=>27,3=>16,4=>'05',5=>'04',6=>13,7=>22,8=>31,9=>40,10=>51,11=>62,12=>73,13=>84,14=>85,15=>76,16=>67,17=>58,18=>49];}

static $clr=[''=>'ccc','Nonmetals'=>'5FA92E','Nobles Gasses'=>'00D0F9','Alkali Metals'=>'FF0008','Alkali Earth Metals'=>'FF00FF','Metalloids'=>'1672B1','Halogens'=>'F6E617','Metals'=>'999999','Transactinides'=>'FF9900','Lanthanides'=>'666698','Actinides'=>'9D6568','undefined'=>'ffffff'];

static function atom($r,$n,$max){
if(!$r)$r=[1=>'-',11=>$n]; $clr=self::$clr;//color:#'.invert_color($clr[$r[2]],1).';
$sty='padding:2px; background-color:#'.$clr[$r[2]].'; border:1px solid black;';
if($r[11]>$max)$sty.=' opacity:0.4;';
//$nb=divs('text-align:right',lj('','spit_spitable,build___'.$r[11],$r[11]));
$bt=lj('','spit_spitable,build___'.$n,$r[11]);
$tit=att($r[0].' ('.$r[11].')');
$ret=lj('','popup_spitable,infos___'.$r[11],$r[1],$tit);
return divs($sty,$bt.br().$ret);
//return divs($sty,$r[11].br().lkc('','https://fr.wikipedia.org/wiki/'.$r[0],$r[1]));
//return divs($sty,$r[11].br().'[[https://fr.wikipedia.org/wiki/'.urlencode($r[0]).' '.$r[1].']]');
}

static function nextsubrg($rb,$rg,$subrg){
if($subrg==1){
	for($i=1;$i<9;$i++){$ri=val($rb,$i,0);
		if($ri<$i){$rg=$i;
			$subrg=$ri+1;
			return [$rg,$subrg];}}}
else{return [$rg+1,$subrg-1];}}

static function subring($r,$ra,$rb,$rg,$subrg,$n,$max){//echo $rg.':'.$subrg.'_';
$rc=self::ring_b($subrg);
if($rc)foreach($rc as $k=>$v){$n++;
if($n<=220){
	[$x,$y]=split_r($v,1); $x+=1; //$y+=1;
	//if($rg>3){$x+=12; $y+=(($rg-4)*8);} else //2_rows
	$y+=(($rg-1)*10);//matrice_width
	$ra[$x][$y]=self::atom($r[$n],$n,$max);}}
$rb[$rg]=$subrg;
if($n<$max){
	[$rg,$subrg]=self::nextsubrg($rb,$rg,$subrg);
	[$ra,$n]=self::subring($r,$ra,$rb,$rg,$subrg,$n,$max);}
return [$ra,$n];}

static function fams(){
$r=self::$clr; $ret='';
foreach($r as $k=>$v){$s='padding:2px 4px; background-color:#'.$v.'; border:1px solid #000; display:inline-block; color:'.invert_color($v,1); if($k)$ret.=bts($s,$k).' ';}
return $ret;}

static function levels($p){$ret=' ';
$r=[2,4,10,12,18,20,30,36,38,48,54,56,70,80,86,88,102,112,118];
foreach($r as $k=>$v){$c=$v<=$p?'active':'';
	$ret.=lj($c,'spit_spitable,call___'.$v,btn('',$v)).' ';}
return $ret;}

static function menu($p){
$j='spit_spitable,call_inpst_2_'; $pr=['onchange'=>sj($j),'type'=>'number'];
$ret=inputb('inpst',$p,4,'number',$pr);
$ret.=lj('popbt',$j,picto('ok')).' ';
$ret.=lk('/app/spt',picto('organigram'));
return $ret;}

static function nav($p){$ret=self::menu($p);
$js1=atmp(atjr('jumpvalue',['inpst',$p-1]));
$js2=atmp(atjr('jumpvalue',['inpst',$p+1]));
if($p>1)$ret.=lj('txtx','spit_spitable,call__2_'.($p-1),picto('before'),$js1).' ';
else $ret.=btn('grey',picto('before'));
if($p<self::$max)$ret.=lj('txtx','spit_spitable,call__2_'.($p+1),picto('after'),$js2);
else $ret.=btn('grey',picto('after'));
$ret.=self::levels($p);
return divc('nbp',$ret).br();}

static function build($p){$p=$p?$p:118;
$r=msql::read('','public_atomic','');
[$ra,$n]=self::subring($r,[],[],1,1,0,$p); //pr($ra);
return self::nav($p).self::mktable_empty($ra);}//divs('overflow-y:auto;',)

static function call($p,$o,$prm=[]){
[$p,$o]=prmp($prm,$p,$o);
return self::build($p);}

static function mktable_empty($r){//p($r);
$n=max(array_keys($r)); ksort($r); $tr='';
for($i=1;$i<=$n;$i++){$td='';
	if(val($r,$i)){$nb=max(array_keys($r[$i])); $td=''; ksort($r[$i]); 
	for($o=1;$o<=$nb;$o++)$td.=tagb('td',valr($r,$i,$o));
	$tr.=tagb('tr',$td);}}
return tagb('table',$tr);}

static function home($p){$p=$p?$p:118;
Head::add('csscode','td{margin:0; padding:1px;}');
Head::add('jscode',self::js($p));
$pub=msqbt('','public_atomic','');
//$bt=self::menu($p);
$ret=self::build($p);
return divd('spit',$ret).br().self::fams().br().$pub;}
}
?>