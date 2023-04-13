<?php 
class csseditbt{
static function r(){
$r['html5']=['border-radius:7px;','box-shadow:0px 0px 8px -4px #_4;','text-shadow:1px 1px 2px #_4;','background:linear-gradient(to bottom,#_2,#_1) no-repeat fixed;','-moz-box-sizing:border-box;','transition: all 0.2s ease;','color:rgba(0,0,0,0.5);','rgba(255,255,255,0.5)','left:calc(50% + 10px);','-moz-column-count:2; -moz-column-gap:20px;','-webkit-transform: scale(1.2);
  -webkit-transform-origin: 50% 50%;'];
$r['filters']=['-webkit-filter:','blur(5px];','hue-rotate(260deg);','grayscale(0.2);','invert(0.4);','drop-shadow(10px 10px 20px black);','saturate(3.4);','sepia(0.5);','opacity(0.7);','brightness(5.8);','contrast(3.4);'];
$r['grid']=['display:grid;','grid-template-columns:100px 100px 1fr;','grid-gap:10px;','grid-template-columns:repeat(3,1fr);','grid-column:2;','grid-row:1;','grid-template: repeat(3,[row] minmax(120px,1fr)) / repeat(4,[col] 1fr);','grid-column:col 1 / span 4;','grid-row:row 1 / span 3;'];
$r['usual']=['float:left;','margin:0px;','padding:0px;','width:0px;','border-style:solid;','border-width:1px;','list-style-position:inside/none;','position:absolute;','cursor:pointer;','display:block;','overflow:auto;','opacity:0.9;','clear:left;'];
$r['fonts']=['font-size:11px;','font-weight:bold;','font-variant:small-caps;','text-align:center;','text-decoration:underline;','letter-spacing:1px;','line-height:14px;','font:32px/36px "Arial";','word-wrap: break-word;','medium','xx-small','x-small','small','large','x-large','xx-large','smaller','larger','length','initial','font-family:','Verdana','Arial','Georgia','Lucida','Tahoma','Sylfaen','Trebuchet','Times New Roman','Courier New','Geneva','Helvetica','Impact','Arial Black'];
$r['bkg']=['background','-image:url(];','-repeat:repeat-x;','-repeat:no-repeat;','-position:center bottom;','-attachment:fixed;','-size:cover;','-color:#_4;'];
$r['props']=['top','right','bottom','left','color','width','height','style','type','solid','dashed','double','black','white','red','silver','auto','normal','inherit','block','inline','inline-bloc','100%','none'];
return $r;}

static function home($p,$o){$r=self::r();
foreach($r as $k=>$v){$ret[$k]='';
	foreach($v as $ka=>$va)$ret[$k].=ljb('','insert_b',[$va,'cssarea'.$p],$va).br();}
return tabs($ret,'','nbp');}
}
?>