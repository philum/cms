<?php //imtx
class imtx{
static function conn($p,$w){ses('out','_datas/imtx.png');
return imgtxt::home($p,'Fixedsys','out');}

static function call($p,$o,$prm=[]){$d=$prm[0]??'';
return imgtxt::home($d,'Fixedsys','out');
return image(ses('out').'?'.randid());}

static function home($p,$o){$rid='plg'.randid(); ses('out','_datas/imtx.png'); $w=400; $h=300;
$j=$rid.'_imtx,call_txtarec__'.$w.'_'.$h; $sj='SaveJ(\''.$j.'\')';
$ret=textarea('txtarec',$p,44,14,['class'=>'console','onkeyup'=>$sj,'onclick'=>$sj]);
$ret.=lj('',$j,picto('ok')).' ';
return $ret.divd($rid,image(root().'/'.ses('out')));}
}
?>