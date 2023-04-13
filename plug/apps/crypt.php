<?php //crypt
//https://code.i-harness.com/fr/q/a691bc

class crypt{
static function b64encrypt($d,$n){for($i=0;$i<$n;$i++)$d=base64_encode($d); return $d;}
static function b64decrypt($d,$n){for($i=0;$i<$n;$i++)$d=base64_decode($d); return $d;}

static function encryption_key(){
//$r=msql::val('',nod('crypt'),$p);
return base64_decode('Jde84AB9nUMM9vESFq2FvZpTS2tIwFdoBHYrOTMIkn0=');}

static function mkkey($n){//n=32:256bits,16=128bits
//mcrypt_create_iv(16,MCRYPT_RAND);
$ret=openssl_random_pseudo_bytes($n,$strong);
if($strong)return base64_encode($ret); else return 'not secure';}

//encrypt
static function pkcs7_pad($d,$size){
$length=$size-strlen($d)%$size;
return $d.str_repeat(chr($length),$length);}

static function encrypt_build($d,$iv){$k=self::encryption_key(); $iv=base64_decode($iv);
return openssl_encrypt(self::pkcs7_pad($d,16),'AES-256-CBC',$k,0,$iv);}

//decrypt
static function pkcs7_unpad($d){if($d==false)return;
return substr($d,0,-ord($d[strlen($d)-1]));}

static function pkcs7_unpad0($d){
$n=strlen($d)-1; $d=$d[$n]; $ord=ord($d);
return substr($d,0,0-$ord);}

static function decrypt_build($d,$iv){$k=self::encryption_key(); $iv=base64_decode($iv);
return self::pkcs7_unpad(openssl_decrypt($d,'AES-256-CBC',$k,0,$iv));}

//fast
static function encrypt($d,$iv){$k=self::encryption_key(); $iv=base64_decode($iv);
return openssl_encrypt($d,'AES-256-CBC',$k,0,$iv);}
static function decrypt($d,$iv){$k=self::encryption_key(); $iv=base64_decode($iv);
return openssl_decrypt($d,'AES-256-CBC',$k,0,$iv);}

static function call($p,$o,$prm=[]){$ret='';
[$d,$iv]=arr($prm,2);//init vector
if($p==1)$ret=self::encrypt_build($d,$iv);
elseif($p==2)$ret=self::decrypt_build($d,$iv);
elseif($p==3)$ret=self::mkkey(32);
elseif($p==4)$ret=self::mkkey(16);
elseif($p==5)$ret=self::encrypt($d,$iv);
elseif($p==6)$ret=self::decrypt($d,$iv);
return $ret;}

static function menu($p,$o,$rid){
$ret=input('iv',$o?$o:'public key').br();
$ret.=textarea('txt',$p,'');
$ret.=lj('popbt',$rid.'_crypt,call_txt,iv_2_1_'.$rid.'_','encrypt').' ';
$ret.=lj('popbt',$rid.'_crypt,call_txt,iv_2_2_'.$rid.'_','decrypt').' ';
$ret.=lj('popbt',$rid.'_crypt,call_txt,iv_2_3_'.$rid.'_','private key').' ';
$ret.=lj('popbt',$rid.'_crypt,call_txt,iv_2_4_'.$rid.'_','public key').' ';
$ret.=lj('popbt',$rid.'_crypt,call_txt,iv_2_5_'.$rid.'_','encrypt2').' ';
$ret.=lj('popbt',$rid.'_crypt,call_txt,iv_2_6_'.$rid.'_','decrypt2').' ';
//$ret.=lj('','popup_msqedit,call__crypt*1_id,val',picto('edit'));
return $ret;}

static function home($p,$o){$rid=randid('plg');
$bt=self::menu($p,$o,$rid);
$ret=self::call($p,$o);
//$bt.=msqbt('',nod('crypt'));
return $bt.divd($rid,$ret);}
}

?>