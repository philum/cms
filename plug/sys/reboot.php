<?php 
class reboot{
static function home(){
echo system('service apache2 restart');
return btn('txtyl','server restarted');}
}
?>