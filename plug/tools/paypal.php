<?php 
class paypal{
static function build($p,$o){
$ret='<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="KXBHH6X89UUTY">
<input type="image" src="https://www.paypalobjects.com/fr_FR/FR/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal, le réflexe sécurité pour payer en ligne">
<img alt="" border="0" src="https://www.paypalobjects.com/fr_FR/i/scr/pixel.gif" width="1" height="1">
</form>';
return $ret;}

static function home($p,$o){$rid=randid('plg');
$ret=self::build($p,$o);
return divd($rid,$ret);}
}
?>