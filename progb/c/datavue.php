<?php 
class datavue{
static $a=__CLASS__;
static $cb='mdl';
static $ret='';

function __construct(){self::$cb=randid();}

/*BarackObama-210822,BillGates-210822,BorisJohnson-210822,David-Cameron-210822,DavidMalpassWBG-190903,EricPickles-210820,George-Osborne-210820,GordonBrown-210822,HillaryClinton-190911,JMDBarroso-210820,JoJohnsonUK-210426,JoeBiden-210822,Lagarde-210822,MedvedevRussiaE-210822,ProfKlausSchwab-210910,WilliamJHague-210820,antonioguterres-210820,dav8119-200628,davidbrockdc-190910,fillasaufical-191115,natrothschild1-210426,zbig-190903*/

static function tag($id){
$r=['bigboss'=>[14224719,103065157,813286,14104027,112398730,810372954,3131144855,2653613168,54532241033,492285158,2425571623,939091,58836363,304909941,822215679726100480,1349149096909668363,532247573,22499765,482866177,932446861,17380167,1225696320,460163041,13623532,153810519,85436197,18549724,121127090,20796069],
'org'=>[148517828,18904582,14353202,950249762,14499829,34889448,438355707,61731614,17137628,69231187,6467332,14361155,14159148,97219875,14810076],
'medias'=>[02612,16558943,612473,8170292,16343974,127503320,117428743,102707504,15438913,607698782,34655603,38142380,47636400,25098482,87416722,498986721,2467791],
'journalists'=>[22812734,47921172,158038382,66673916,16133363,136004952,16139649,14073022,117366399,78433570,56169454,130104942,130104942,338335964,140955302,14085096,162044153,27695248,52418188,2814778367,5838002,26985345,19530134,53887085,20598137,131859965],
'persons'=>[796375792099979265,14700117,125270251,61183568,245513323,19825835,556719361,20768539,50393960,22776133,748453510048518145,195037431,187561714,1548391070,14431416,19644592,189868631,111013369],
'parties'=>[56679400,14281853,159992511]];
foreach($r as $k=>$v)if(in_array($id,$v))return $k; return 'unclassified';}

static function rid($n){return substr($n,0,9);}

static function sav($rca,$rcb,$p,$b=''){
$noda=nod('frnb_'.$p); $nodb=nod('frnc_'.$p); if($b)$noda=nod('taxo_'.$p);
$rh=['Id','Label','timeset','modularity_class']; //array_unshift($rca,[$rh]);
msql::save('',$noda,$rca,$rh);
$rh=['Source','Target','Type','Id','Label','timeset','Weight']; //array_unshift($rcb,[$rh]);
msql::save('',$nodb,$rcb,$rh);
$ret=msqbt('',$noda).msqbt('',$nodb);
$ret.=lj('txtx','popup_msqlops___'.ajx($noda).'_export*csv__1','nodes');
$ret.=lj('txtx','popup_msqlops___'.ajx($nodb).'_export*csv__1','links');
$ret.=divc('scroll',tabler($rca));
$ret.=divc('scroll',tabler($rcb));
return $ret;}

//take all children
static function build2($p,$o){$ret=''; $rc=[]; $rca=[]; $rcb=[]; $rcc=[]; $dt='211103'; 
$nod=nod('frn_'.$p);//$p='bebd9b';
$r=msql::read('',$nod,'',1); //eco($r);
foreach($r as $k=>$v){
	$nd=nod('frn_'.$v[1]).'-'.$dt; //echo $nod.' ';
	$rb=msql::read('',$nd,'',1);
	if($rb)foreach($rb as $kb=>$vb){$ida=self::rid($v[0]); $idb=self::rid($vb[0]); 
		$tag=self::tag($vb[0]);
		$rca[$idb]=[$idb,$vb[1],'0',$tag];
		$rcb[]=[$ida,$idb,'Undirected','','','0','0'];
		$rc[$idb][]=1;}}
foreach($rcb as $k=>$v){
	$n=count($rc[$v[1]]); $rcb[$k][6]=$n*10; if($n<2){unset($rcb[$k]); unset($rca[$v[1]]);}}
$ret=self::sav($rca,$rcb,$p);
return $ret;}

//selected tables
static function build($p,$o){$ret='rr';
$r=explode(',',$p); $rab=[]; $rca=[]; $rcb=[]; $rc=[]; $rb=[]; $rk=[]; $re=[]; $rn=[]; $kb='';
[$dr0,$nod0]=split_right('/',$r[0]); $nd0=struntil($nod0,'_');
//build names from heterogen src
foreach($r as $k=>$v){[$dr,$nod]=split_right('/',$v,1); $nod=strend($nod,'_'); $nd=strto($nod,'-');
	$r[$k]=$dr.'/'.$nd0.'_'.$nod; $rk[$k]=$nd;} //pr($r);
//datas
foreach($r as $k=>$v){[$dr,$nod]=split_right('/',$v,1);//rca
	$ra=msql::read($dr,$nod,'',1); $rab[$rk[$k]]=$ra; if($ra)$re=array_merge($re,$ra);
	if($ra)foreach($ra as $ka=>$va){$ida=self::rid($v[0]); $idb=self::rid($va[0]); 
		$rb[$ida]=$v[1];
		$tag=self::tag($va[0]);
		$rca[$idb]=[$idb,$va[1],'0',$tag];
		$rc[$idb][]=1;}} //pr($re);
//l'id des pusr n'apparaît que s'ils sont suivis par un des suivis du groupe
foreach($rk as $k=>$v){$ka=in_array_r($re,$v,1); if($ka){$kb=$re[$ka][0]; if($kb)$rn[$v]=$kb;}} //pr($rn); //[usr]=id
foreach($rab as $k=>$v)if($v)foreach($v as $ka=>$va){$kb=$rn[$k]??'';
	$ida=self::rid($kb); $idb=self::rid($va[0]); $n=count($rc[$idb]);
	if($kb)$rcb[]=[$ida,$idb,'Undirected','','','',$n*10];}//if($n>2) else unset($rca[$idb]);
//[$rc,$rtb]=msqa::intersecter($r);
$rid=substr(md5($p),0,6);
$ret=self::sav($rca,$rcb,$rid);
return $ret;}

static function taxoarts($p){$rca=[]; $rcb=[];
$r=$_SESSION['rqt'];
$r=taxonav::collect_hierarchie_d('reverse');
//$r=tri_hierarchic($r,$h); p($r);
//mk::taxonomy($r)
//$ida=ma::id_of_ib($k);
//$r=ibofid_r($k,$r);
return self::sav($rca,$rcb,$p,'taxo');}

static function call($p,$o,$prm=[]){$p=$prm[0]??$p;
if($o==2)$ret=self::build2($p,$o);
else $ret=self::build2($p,$o);
return $ret;}

static function menu($p,$o){$bid='inp';
$j=self::$cb.'_datavue,call_'.$bid.'_2__'.$o;
//$ret=inputj($bid,$p,$j);
$ret=textarea($bid,$p);
$ret.=lj('',$j,picto('ok')).' ';
return $ret;}

static function home($p,$o){
$bt=self::menu($p,$o); $ret='';
if($p)$ret=self::call($p,$o);
return $bt.divd(self::$cb,$ret);}
}
?>