<?php
//philum_plugin_model

#pour joindre un plugin:
#connecteur: [model§param:plug] or : [param:model]
#iframe: /plug/index.php?call=plug&p=&o=
#url: /plugin/model/p/o
#php: plugin('model','p','o'); //call+param+option
#button: call_plug('css','popup','model','j','button'); //appelle la fonction model_j()
#link: lj('txtbox','id_func_getid_close_p1_p2_p3_p4_mv'),'Call');//css,j,text
#protocole à 9 variables de lj(): target_app_(unused)_method(3)_p_o_ob_oc_multivars|var1|var2
#using app "call" : require pages pop, spe, tri; format_txt_r ; return in a popup :
//lj('txtbox','popup_call___pop-tri-spe_format*txt*r___textarea'),'ok');

#headers
//Head::add('name',array('description','model'));
//Head::add('csslink','../css/_global.css');
//Head::add('csslink','../css/'.ses('qb').'_design_'.ses('prmd'));
//Head::add('jslink','../progb/ajx.js');
//Head::add('jslink','../progb/utils.js');
//Head::add('csscode','');
//Head::add('jscode','');

/*$msq=new msql;
$msq->def('','public_mods_1');
//$msq->create(array(1,2,3));
$msq->read();
$msq->modif('app','mdf',$r);
$r=$msq->ret;*/

/*class model($p,$o){var $ret;
function __construct(){$this->ret=plug_model($p,$o);}
}*/

/*define table, show form, save and show datas*/

function model_com($p,$o){list($p,$o)=ajxp($res,$p,$o);
return $ret;}

function model_j($p,$o,$res){$r=ajxr($res);//form
reqp('msql'); $msq=new msql('',$p?$p:'model');
$msq->load();//$msq->format($r);
$msq->modif('add','',$r);
$msq->save();//p($msq->ret);
return make_table(msq_invert($msq->ret),'txtblc','txtx');}

function plug_model($p,$o){$rid='plg'.randid(); $p=$p?$p:'model'; reqp('msql');
$msq=new msql('',$p);//table
$rb=array('title','text'); $msq->create($rb);//cols
$ret.=input(1,$rb[0],'','',20);
$ret.=lj('txtbox',$rid.'_plug___model_model*j_'.$p.'__'.implode('|',$rb),'save').br();
$ret.=txarea($rb[1],'',40,4);
$ret.=msqlink('users',ses('qb').'_'.$p);
$msq->read('i');
return $ret.divd($rid,make_table($msq->ret,'txtblc','txtx'));}

?>