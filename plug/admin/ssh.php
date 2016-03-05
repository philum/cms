<?php
//philum_plugin_ssh

function ssh_j($p,$o,$res=''){list($p,$o)=ajxp($res,$p,$o);
send_mail_html('','philum - ssh',hostname().' ssh: '.$p,'root@server.com','');
if(auth(6) && md5($o)=='6ca29d9bb530402bd09fe026ee838148' && $p)return exc($p); 
else return 'no';}

function plug_ssh($p,$o){$rid='plg'.randid();
$ret.=input(1,'ssh','service proftpd restart');
$ret.=input('password','ssb','****','','','4');
$ret.=lj('',$rid.'_plug__xd_ssh_ssh*j___ssh|ssb',picto('reload')).' ';
return $ret.divd($rid,'');}

?>