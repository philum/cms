<?php //philum/a/act
class actions{
static $a=__CLASS__;

static function tit($id,$va,$opt,$optb,$res=''){
req('meta,spe'); $s=480; $tt='meta:'.$id; 
if(get('frm1'))save_tits_j($id); $ret=edit_tits($id,$va);
return $ret;}

static function titsav($id,$va,$opt,$optb,$res=''){
req('art,pop,spe,mod,tri,meta'); save_tits_j($id);//SaveTits
$ret=art_read_d($id,$va,'');
return $ret;}

static function webread($id,$va,$opt,$optb,$res=''){
req('tri,spe'); $ret=web_import($id,1);
return $ret;}

static function websav($id,$va,$opt,$optb,$res=''){
req('tri,spe'); $ret=art_import($id,$va);
return $ret;}

static function reimport($id,$va,$opt,$optb,$res=''){
req('tri,spe,art,pop,mod'); $ret=reimport($id,$va,$opt,$res);
return $ret;}

static function xx($id,$va,$opt,$optb,$res=''){
return $ret;}

}
?>