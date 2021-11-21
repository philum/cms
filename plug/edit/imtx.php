<?php
//philum_plugin_imtx

function imt_conn($p,$w){ses('out','_datas/imtx.png');
return plugin('imgtxt',$p,'Fixedsys','out');}

function imt_j($p,$o,$res=''){list($p,$o)=ajxp($res,$p,$o); 
return plugin('imgtxt',$p,'Fixedsys','out');
return image(ses('out').'?'.randid());}

function plug_imtx($p,$o){$rid='plg'.randid(); ses('out','_datas/imtx.png'); $w=400; $h=300;
$j=$rid.'_plug__2_imtx_imt*j_'.$w.'_'.$h.'_txtarec'; $sj='SaveJ(\''.$j.'\')';
$ret=textarea('txtarec',$p,44,14,atc('console').atb('onkeyup',$sj).atb('onclick',$sj));
$ret.=lj('',$j,picto('ok')).' ';
return $ret.divd($rid,image(root().'/'.ses('out')));}

?>