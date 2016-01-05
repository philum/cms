<?php
//philum_plugin_reboot

function plug_reboot(){
echo system('service apache2 restart');
return btn('txtyl','server restarted');}

?>