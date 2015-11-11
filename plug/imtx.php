<?php
//philum_plugin_imtx

function imt_conn($p,$w){ses('out','plug/_data/imtx.png');
return plugin('imgtxt',$p,'Fixedsys','out');}

function imt_j($p,$o,$res=''){list($p,$o)=ajxp($res,$p,$o); 
return plugin('imgtxt',$p,'Fixedsys','out');
return image(ses('out').'?'.randid());}

function plug_imtx($p,$o){$rid='plg'.randid(); ses('out','/plug/_data/imtx.png');
$j=$rid.'_plug__2_imtx_imt*j_'.$w.'_'.$h.'_txtarec'; $sj='SaveJ(\''.$j.'\')';
$ret.=txarea('txtarec" class="console" onkeyup="'.$sj.'" onclick="'.$sj,$p,44,14);
$ret.=lj('',$j,picto('reload')).' ';
return $ret.divd($rid,image(root().ses('out')));}

?>