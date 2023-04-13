<?php //ssh
class ssh{
static function ssh_j($p,$o,$prm=[]){[$p,$o]=prmp($prm,$p,$o);
mails::send_html('','philum - ssh',hostname().' ssh: '.$p,'root@server.com','');
if(auth(6) && md5($o)=='6ca29d9bb530402bd09fe026ee838148' && $p)return exc($p); 
else return 'no';}

static function home($p,$o){$rid='plg'.randid();
$ret.=input('ssh','service proftpd restart');
$ret.=inpsw('ssb','****',4);
$ret.=lj('',$rid.'_ssh,call_ssh,ssb_xd_',picto('ok')).' ';
return $ret.divd($rid,'');}
}
?>