<?
//philum_plugin_twfeed
#usage twitter feed
#tag
ini_set('display_errors',1);

//widget philum_info
//widget_id 542294835265548288//nfo
//widget_id 545578453945552896//dav

function plug_twfeed($p='',$o=''){
echo 'ee';
$ret='<a class="twitter-timeline"  href="https://twitter.com/philum_info" data-widget-id="545578453945552896">Tweets de @philum_info</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?"http":"https";if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>';

$ret='<a class="twitter-timeline" data-dnt="true" href="https://twitter.com/dav8119" data-widget-id="">Tweets de @dav8119</a>
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?\'http\':\'https\';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>';

return $ret;}

?>