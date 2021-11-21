<?php
//philum_plugin_book

function scroll_c0($d,$id){$h=$h?$h.'px':'calc(100vh - 220px)';
$cb=' id="scrll'.$id.'" style="overflow:auto; padding-right:10px; max-height:'.$h.';"';
return div($cb,$d);}

function scroll_c($msg,$rid){
return scroll(strlen($msg)/80,$msg,16,'','100%',$rid);}

function bk_rq(){req('mod,pop,spe,art');}

function book_css(){
return '
.book {height:calc(100vh - 70px);}
.book .panel {text-align:left; border-style:solid; border-width:1px; padding:10px; margin:10px 0 0; border-radius:2px; box-shadow:0px 0px 4px #_7 inset; height:calc(100vh - 220px);}
.book blockquote {background:gray;}
.book a {text-decoration:none;}
.book a .philum {color:white;}
.book a:hover .philum {color:white;}
.book h2 {color:white;}
.book h3 {color:silver;}
';}

function book_js(){return '
function scrolltxt(n){var v=n==1?1:(-1); doc.scrollTop=doc.scrollTop+v;}
function autoread(id,rid){doc=document.getElementById("scrll"+rid);
	scrolltxt(1); timer=setTimeout("autoread("+id+","+rid+")",100);}
function scrollt(n,rid){doc=document.getElementById("scrll"+rid);
	for(i=0;i<200;i++){timer=setTimeout("scrolltxt("+n+","+rid+")",i*4);}}';}

function book_ifr($d){//frameborder="0"
$d='<iframe src="'.host().'/plug/book/'.$d.'"></iframe>';
return textarea('',htmlentities($d),44,4);}

function book_pages($id,$rid){
$ret=ljb('','autoread',$id.'\',\''.$rid,picto('play')).' ';
$ret.=ljb('','clearTimeout(timer)','',picto('no')).' ';
$ret.=ljb('','scrollt','2\',\''.$rid,picto('up')).' ';
$ret.=ljb('','scrollt','1\',\''.$rid,picto('down'));
return divs('',$ret);}

function book_cover($t,$id){$t=str_replace(' ',"\n",$t); //$w=$_SESSION['prma']['content'];
$t=lj('','popup_plupin__3_book_'.ajx($_SESSION['book'][$id]).'_'.ses('boko'),$t);
return div(' class="book" style="background-color:black; padding:10px; width:220px;"',divs('background-color:#222; border:1px solid #fff; padding:5px; margin:auto; color:white; font-size:16px; text-align:center; text-decoration:none;',$t));
return $ret;}

function book_prevnxt($id,$rid){$r=$_SESSION['bookr']; bk_rq();
$j='book'.$rid.'_plug__2_book_book*reload_'.$id; $i=0; $ok=0; $old=0;
$lk='book'.$rid.'_plug__2_book_book*read_'; $n=count($r);
if($r)foreach($r as $k=>$v){$i++;
	if($ok){if($i<=$n)$next=lj('',$lk.$k.'_'.$rid,picto('kright')).' '; $ok='';}
	if($k==$id){if($old)$prev=lj('',$lk.$old.'_'.$rid,picto('kleft')).' ';
		else $prev=btn('grey',picto('kleft')).' '; $ok=1; $nb=$i;
		if($i==$n)$next=btn('grey',picto('kright')).' ';}
	$old=$k;}
return $prev.lj('',$j,picto('home').' '.$nb.'/'.$n).' '.$next;}//

function book_read($id,$rid){bk_rq();
cwset($_SESSION['prma']['content']-60); //[120:setwidth]
$p['back']=book_prevnxt($id,$rid);
$p['id']=$id;
$r=pecho_arts($id);
$p['date']=mkday($r[0],1); $p['title']=$r[2]; 
$p['opt']=$r[1]; //$p['tag']=$r[5];
$p['length']=art_length($r[8]); 
//$p['length'].=' '.lka(urlread($id),picto('articles'));
$p['length'].=' '.popart($id);
$msg=sql('msg','qdm','v','id='.$id);
$msg=conn::read($msg,'',$id,1);
$p['player']=book_pages($id,$rid);
$p['msg']=scroll_c($msg,$rid);
$ret=template($p,'book');
$_SESSION['cur_div']='content';//setwidth in template
return $ret;}

function book_reload($id){bk_rq(); //echo $id; //need read or art_id
return plug_book($_SESSION['book'][$id],$_SESSION['boko']);}

function plug_book($p,$id){bk_rq();
Head::add('csscode',book_css());
Head::add('jscode',book_js());
$_SESSION['book'][$id]=$p; $_SESSION['boko']=$id;
//list($r,$rb)=book_builder($p);
if(strpos($p,'§')){list($p,$o)=explode('§',$p);
	list($t,$or,$tp,$oi)=explode('/',$o); if(!$tp)$tp='book'; 
	$rb['title']=stripslashes($t);}
//if(is_numeric($p) && ses('read')!=$p)return book_cover($t,$id);
//if($o=='api')$r=api::callj($p,'','');else
if(strpos($p,'&') && strpos($p,'='))$r=api::mod_rq($p);//old format
elseif(strpos($p,'|') && strpos($p,',')===false)$r=array_flip(explode('|',$p));
if($id=='fav' or $id=='like' or $id=='poll')$r=sql('ib','qdf','k','type="'.$id.'" and iq="'.$p.'"',1);
elseif($id=='visit')$r=array_flip(array_keys(ses('mem')));
elseif(is_numeric($p))$r=sql('ib','qdd','k','msg="'.$p.'" and val="'.$id.'"');
else $r=api::mod($p.'');//.',verbose:1,sql:1'
//if($r[$p])unset($r[$id]);
if(!$r)return; else $_SESSION['bookr']=$r; //p($r);
if(is_array($r))$d=implode(' ',$r); $i=0; $msg='';
$here='book'; $rid=randid();
if($p)$rb['opt']=lj('','popup_plup___book_book*ifr_'.$p,pictxt('get','iframe'));
foreach($r as $k=>$v){$i++; $io=$i.'. ';
	$lk='book'.$rid.'_plug__2_book_book*read_'.$k.'_'.$rid;
	$lgh=art_length(sql('host','qda','v','id="'.$k.'"'));
	$msg.=lj('',$lk,picto('kright').' '.$io.suj_of_id($k).btn('small',' ('.$lgh.')')).br();}
$rb['msg']=scroll_c($msg,$rid);
$ret=divd('book'.$rid,template($rb,'book'));
$_SESSION['cur_div']='content';
return $ret;}

?>