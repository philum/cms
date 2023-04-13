<?php //publish_software_update

class pubdate{

static function update_msql(){
$tim=time(); $ym=date('ym',$tim); $ymd=date('ymd',$tim); $ymdhi=date('ymd.His',$tim);
msql::modif('system','program_version',[[$ymd],[$ymdhi]],'arr',['current_version']);
file_put_contents('version.txt',$ymdhi);
$ex=msql::read('system','program_updates_'.$ym,'');
$r=[date('md',$tim),'publication']; $rh=['date','text'];
if(!$ex)msql::save('system','program_updates_'.$ym,[1=>$r],$rh);
$k=msql::find_k('system','default_apps','updates',0);
if($k)msql::modif('system','default_apps','msql___system_program_updates*'.$ym,'shot',3,$k);
$k=msql::find_k('system','default_apps','update-notes',0);
if($k)msql::modif('system','default_apps','updates*'.$ym,'shot',4,$k);
return 'version: '.$ymdhi;}

static function installer(){
$f='_backup/install.tar.gz';
$r=['install.php','pub'];
tar::files($f,$r,0);
return lkc('txtx',$f,'installer');}

static function pictos(){
$f='_backup/pictos.tar.gz';
$r=['fonts/philum.woff2','fonts/philum.woff','fonts/philum.ttf','fonts/philum.svg','css/_pictos.css'];
tar::files($f,$r,0);
return lkc('txtx',$f,'pictos');}

static function mkoomo(){
$f='_backup/Oomo.tar.gz';
$r=['fonts/Oomo.woff2','fonts/Oomo.woff','fonts/Oomo.ttf','fonts/Oomo.svg','css/_oomo.css'];
tar::files($f,$r,0);
return lkc('txtx',$f,pictxt('download','Glyphe Oomo'));}

static function call(){
if(!auth(6))return 'no';
$ret=self::update_msql().br();//version infos
$ret.=coreflush::home().br();
$ret.=philumsize::home().br();
$rd=software::build(2);//build full archive
$f='_backup/philum.tar.gz';
$ret.=lkc('txtx',$f,'archive created').br();
if($rd)$ret.=tabler($rd);//diff
$ret.=self::installer();
$ret.=self::pictos();
return $ret;}
}
?>