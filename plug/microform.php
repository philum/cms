<?php
//philum_plugin_microform

function mform_j($p,$id,$res){$r=ajxr($res);//form
if(!$r[0])return lj('txtbox',ses('mformj'),pictxt('reload','error')); 
reqp('msql'); $msq=new msql('',ses('mform')); //$rb=mform_mr($p);
$msq->load();//$msq->format($r);
$msq->modif('add','',$r);
$msq->save();//p($msq->ret);
return lj('txtbox',ses('mformj'),pictxt('smile',nms(139)));
return lj('txtbox','mfr'.$id.'_plug___microform_mform*read_'.$id,pictxt('smile',nms(139)));}

function mform_tab(){}

function mform_mr($d){$r=explode(",",$d);$n=count($r);
for($i=0;$i<$n;$i++){
	list($v,$type)=explode("=",$r[$i]); $vb=normalize($v); 
	if($type!='button')$rb[]=$vb;}
//$rb[]='day';
return $rb;}

function mform_read($id){
reqp('msql'); $msq=new msql('',ses('mform')); $msq->read('i'); //p($msq->ret);
//if(auth(6))$ret.=lj('','mfr'.$id.'_plug___microform_mform*read_'.$id,picto('reload'));
if(auth(6))$ret.=lj('',ses('mformj'),picto('reload'));
$ret.=make_table($msq->ret,'txtcadr','').br();
return $ret;}

function plug_microform($p,$id){$rid='mfr'.randid(); //echo $p.'-'.$id;
$nod=ses('mform',ses('qb').'_microform_'.$id); req('pop');
ses('mformj',$rid.'_plug___microform_plug*microform_'.ajx($p).'_'.$id);
reqp('msql'); $msq=new msql('',$nod);//table
list($p,$tp)=explode('§',$p); $rb=mform_mr($p); //p($rb);
$msq->create($rb);
$ret.=make_form($p,'mfr'.$id,'_plug___microform_mform*j_'.ajx($p,'').'_'.$id.'_').br();
if(auth(4))$ret.=msqlink('users',ses('mform')).' '.btn('txtsmall2',$nod).' ';
if($tp==1)$ret.=mform_read($id); elseif($tp)$ret.=plugin('msqtemplate',$nod,$tp);
return divd($rid,$ret.$bt);}

?>