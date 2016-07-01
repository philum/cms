<?php
//philum_plugin_book

function scroll_c0($d,$id){$h=$h?$h.'px':'calc(100vh - 220px)';
$cb=' id="scrll'.$id.'" style="overflow:auto; padding-right:10px; max-height:'.$h.';"';
return div($cb,$d);}

function scroll_c($msg,$rid){
return scroll(strlen($msg)/80,$msg,16,'','100%',$rid);}

function bk_rq(){req('api,mod,pop,spe,art,tri');}

function book_css(){
return '
.book {height:calc(100vh - 70px);}
.book a {text-decoration:none;}
.book a .philum {color:white;}
.book a:hover .philum {color:white;}
.book h2 {color:white;}
.book h3 {color:silver;}
.book .panel {text-align:left; border-style:solid; border-width:1px; padding:10px; margin:10px 0 0; border-radius:2px; box-shadow:0px 0px 4px #_7 inset; height:calc(100vh - 220px);}
.book blockquote {background:gray;}
';}

function book_js(){return '
function scrolltxt(n){var v=n==1?1:(-1); doc.scrollTop=doc.scrollTop+v;}
function autoread(id,rid){doc=document.getElementById("scrll"+rid);
	scrolltxt(1); timer=setTimeout("autoread("+id+","+rid+")",100);}
function scrollt(n,rid){doc=document.getElementById("scrll"+rid);
	for(i=0;i<200;i++){timer=setTimeout("scrolltxt("+n+","+rid+")",i*4);}}';}

function book_ifr($d){//frameborder="0"
$d='<iframe src="'.host().'/plug/book/'.$d.'"></iframe>';
return txarea('',htmlentities($d),44,4);}

function book_pages($id,$rid){
$ret.=ljb('','autoread',$id.'\',\''.$rid,picto('play')).' ';
$ret.=ljb('','clearTimeout(timer)','',picto('no')).' ';
$ret.=ljb('','scrollt','2\',\''.$rid,picto('up')).' ';
$ret.=ljb('','scrollt','1\',\''.$rid,picto('down'));
return divs('',$ret);}

function book_cover($t){$t=str_replace(' ',"\n",$t); $w=$_SESSION['prma']['content'];
$t=call_plug('','popup','book',ajx($_SESSION['book']).'_'.$w,$t);//
return div(' class="book" style="background-color:black; padding:10px; width:220px;"',divs('background-color:#222; border:1px solid #fff; padding:5px; margin:auto; color:white; font-size:16px; text-align:center; text-decoration:none;',$t));
return $ret;}

function book_prevnxt($id,$rid){$r=$_SESSION['bookr']; bk_rq();
$j='book'.$rid.'_plug__2_book_book*reload';
$lk='book'.$rid.'_plug__2_book_book*read_'; $n=count($r);
if($r)foreach($r as $k=>$v){$i++;
	if($ok){if($i<=$n)$next=lj('',$lk.$k.'_'.$rid,picto('kright')).' '; $ok='';}
	if($k==$id){if($old)$prev=lj('',$lk.$old.'_'.$rid,picto('kleft')).' ';
		else $prev=btn('grey',picto('kleft')).' '; $ok=1; $nb=$i;
		if($i==$n)$next=btn('grey',picto('kright')).' ';}
	$old=$k;}
return $prev.lj('',$j,picto('home').' '.$nb.'/'.$n).' '.$next;}//

function book_read($id,$rid){bk_rq();
curwidth_set($_SESSION['prma']['content']-60); //[120:setwidth]
$p['back'].=book_prevnxt($id,$rid);
$p['id']=$id;
$r=pecho_arts($id);
$p['date']=mkday($r[0],1); $p['title']=$r[2]; 
$p['opt']=$r[1]; $p['tag']=$r[5];
$p['length']=art_length($r[8]); 
//$p['length'].=' '.lka(urlread($id),picto('articles'));
$p['length'].=' '.popart($id);
$msg=sql('msg','qdm','v','id='.$id);
$msg=format_txt($msg,'nlb',$id);
$p['player']=book_pages($id,$rid);
$p['msg']=scroll_c($msg,$rid);
$ret.=template($p,'book');
$_SESSION['cur_div']='content';//setwidth in template
return $ret;}

function book_reload(){bk_rq();
return plug_book($_SESSION['book'],$_SESSION['read']);}

function book_builder($d){
list($p,$o)=split('§',$d); $r=array(); 
$ra=explode(',',$p); //curwidth_set($_SESSION['prma']['content']-60);
list($t,$or,$tp,$oi)=explode('/',$o); if(!$tp)$tp='book'; $rb['title']=stripslashes($t);
if($_SESSION['read']!=$id)return book_cover($t);
if($ra)foreach($ra as $k=>$v){//build_list
	$rc=api_mod_arts_row($v); if(strpos($v,'=') && $rc)$r+=$rc;
	$rc=array_flip(explode(' ',$v)); if(strpos($v,' ') && $rc)$r+=$rc;}
if($r){if($or==1)ksort($r); if($or==2)krsort($r);} if($r[$id])unset($r[$id]);
return array($r,$rb);}

function plug_book($iq,$id){bk_rq();
Head::add('csscode',book_css());
Head::add('jscode',book_js());
$_SESSION['book']=$iq;
if(!is_numeric($iq))list($r,$rb)=book_builder($iq);
else $r=sql('ib','qdd','k','msg="'.$iq.'" and val="fav"');
if(!$r)return; else $_SESSION['bookr']=$r;
$d=implode(' ',$r);
$here='book'; $id=$id?$id:$_SESSION['read']; $rid=randid();//if(!$id)
$rb['opt']=lj('','popup_plup___book_book*ifr_'.$iq,pictxt('get','iframe'));
foreach($r as $k=>$v){$i++; if($oi)$io=$i.'. ';
	$lk='book'.$rid.'_plug__2_book_book*read_'.$k.'_'.$rid;
	$lgh=art_length(sql('host','qda','v','id="'.$k.'"'));
	$msg.=lj('',$lk,picto('kright').' '.$io.suj_of_id($k).btn('small',' ('.$lgh.')')).br();}
$rb['msg']=scroll_c($msg,$rid);
$ret=divd('book'.$rid,template($rb,'book'));
$_SESSION['cur_div']='content';
return $ret;}

?>