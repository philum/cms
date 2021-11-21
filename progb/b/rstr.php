<?php //philum/b/rstr
class rstr{

static function defaults($u){
if($u)$r=msql_read('users',nod('rstr'),'',1);
else $r=msql_read('system','default_rstr','',1);
return arr($r,140);}

static function edit_rstr(){
$ret=msqbt('users',ses('qb').'_rstr');
$ret.=admactbt('bckp_rstr','backup');
$ret.=admactbt('restore_rstr','restore');
$ret.=msqbt('system','default_rstr');
$ret.=admactbt('reset_rstr','reset');
$ret.=admactbt('mkdefaults_rstr','mkdefaults');
if($bcp=get('backup') && auth(6))self::backup_rstr($bcp);
return $ret;}

static function backup_rstr_msql($r){$rc=[]; $max=max(array_keys($r));
for($i=1;$i<=$max;$i++)$rc[$i]=!empty($r[$i])?[1]:[0];
	if(get('backup')=='mkdflts'){$bs='system'; $nd='default';}
	else{$bs='users'; $nd=ses('qb');}
msql::save($bs,$nd.'_rstr',$rc,['rstr']);}

static function modif_params($slct,$restrict){
$_SESSION['rstr'][$slct]=$restrict;
if($_SESSION['rstr'][63]==1)$_SESSION['negcss']=0;
self::backup_rstr('save');}

static function show_params_cat($r,$h){$ron=1;$fon=0; $j='lang_admin*restrictions_';
foreach($r as $k=>$v){
//$hlp=bubble('txtsmall2','popmsqt',$j.$k.'_description',$k);
$hlp=togbub('popmsqt',$j.$k.'_description',$k,'txtsmall2');
$t=$h[$k][0]??$v; if(rstr($k)){$n=1; $c='';} else {$n=0; $c='active';}
$ret[]=togon($n).' '.btn('',lj('','rstr_params___'.$k.'_'.$n,$t)).$hlp.br();}
//return columns($ret,180);
//return divc('cols',implode('',$ret));
return divc('nbp cols',implode('',$ret));
return divc('nbp',colonize($ret,3,'','',550));}

static function show_params($slct,$restrict){$rb=[];
$r=msql::prep('system','admin_restrictions');
$h=msql::read('lang','admin_restrictions');
if($slct && auth(6))self::modif_params($slct,$restrict);
foreach($r as $k=>$v)$rb[$k]=self::show_params_cat($v,$h);
if(auth(6))$bt=msqbt('system','admin_restrictions','','imgr'); ksort($rb);
//foreach($rb as $k=>$v)$ret.=balb('h4',$k).divc('nbp',$v).br(); return $bt.$ret;
return $bt.make_tabs($rb,'rst');}

static function get_rstr($b){
if($b=='defaults')$_SESSION['rstr']=rstr::defaults(0);
elseif($b=='restore')$_SESSION['rstr']=rstr::defaults(1);
$r=$_SESSION['rstr']; if(!$r)$r=rstr::defaults(0);
return $r;}

static function backup_rstr($b){$r=self::get_rstr($b);
if($b!='restore' && $b!='defaults')self::backup_rstr_msql($r);
if(is_array($r))array_unshift($r,'0');
if($b!='=' && is_array($r))update('qdu','rstr',implode('',$r),'name',ses('qb'));}

static function home(){req('adminx');
$edt=div('',self::edit_rstr()).br();
$prm=self::show_params(get('slct'),get('restrict'),'');
return $edt.divd('rstr',$prm);}

}
?>