<?php //htaccess
class htaccess{

static function update(){
$txt=msql::val('system','default_htaccess',1);
$ok=write_file('.htaccess',$txt);
if($ok)return btn('txtyl',$ok).' '.hlpbt('htaccess');
return btn('txtyl',lkc('txtx','/admin/htaccess','htaccess'));}

static function mkdefault($var1,$var2,$prm=[]){
$r=msql::modif('system','default_htaccess',$prm,'one',[],1);
return btn('txtyl','saved');}

static function default(){
return stripslashes(msql::val('system','default_htaccess',1));}

static function call($var1,$var2,$prm){$txt=$prm[0]??'';
$ok=write_file('.htaccess',$txt);
if($ok)return btn('txtyl',$ok).' '.hlpbt('htaccess');
return lkc('txtyl','.htaccess','saved');}

static function home($d){$here='htaccess';
$default=msql::val('system','default_htaccess',1); $ret='';
if(is_file('.'.$here))$actual=read_file('.'.$here); else $actual='';
if(!$actual or $d){$actual=$default; $ret=btn('txtyl','default_loaded').br();}
$ret.=picto('alert§24').' '.btn('txtcadr','critical_operations').' ';
$ret.=lj('txtbox','txt_htaccess,default__xd','default').' ';
$ret.=lj('txtbox','cbk_htaccess,mkdefault_txt_xd','backup').' ';
$ret.=msqbt('system','default_htaccess').' ';
$ret.=lkc('txtx','.htaccess','link').' ';
$ret.=hlpbt('htaccess').' '.btd('cbk','').' ';
$ret.=lj('txtbox','cbk_htaccess,call_txt','save').br().br();
$ret.=textarea('txt',$actual,120,26).br();
$ret.=lkt('txtblc','http://htaccess.madewithlove.be/','tests');
return $ret;}
}
?>