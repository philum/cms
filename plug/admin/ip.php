<?php //ip

//gethostbyaddr($_SERVER['REMOTE_ADDR'])
function plug_ip(){//pr($_SERVER); 
return 'ip='.hostname().br().' user-agent:'.$_SERVER['HTTP_USER_AGENT'].br().' referer:'.$_SERVER['HTTP_REFERER'].br().' remote:'.$_SERVER['REMOTE_ADDR'];}

?>