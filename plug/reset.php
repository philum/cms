<?php
//philum_plugin_reset

function plug_reset(){session_destroy(); $_SESSION="";
return btn('txtyl','all sessions were killed');}

?>