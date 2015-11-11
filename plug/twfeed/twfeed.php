<?
//philum_plugin_twfeed
#usage twitter feed
#tag 

//widget philum_info
//widget_id 542294835265548288
//CONSUMER_KEY LTq1ZEbts66wULKOrD1yY31eG
//CONSUMER_SECRET lbRnX0w4RRxTDhdBAXr0nTlgdOZet94i6Nhn7EVxrz3bwpPJOc

function plug_twfeed($p='',$o=''){
$ret="<a class='twitter-timeline' href='https://twitter.com/philum_info' data-widget-id='542294835265548288'>Tweets de @philum_info</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
</script>";
return $ret;}

?>