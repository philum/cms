<?php //model

function parsage_normal($noeud, $contenu_a_inserer=''){
$balise_1=array('gras'=>'<strong>',
'italique'=>'<span class="italique">',
'position'=>'<div class="$1">',
'flottant'=>'<div class="flot_$1">',
'taille'=>'<span class="$1">',
'couleur'=>'<span class="$1">',
'police'=>'<span class="$1">',
'attention'=>'<span class="rmq $1">',
'liste'=>'<ul>',
'puce'=>'<li>',
'lien'=>'<a href="$1">',
'image'=>'<img src="$1" alt="$2" />',
'citation'=>'<span class="citation">',
'#text'=>''); // Tableau des balises ouvrantes
		
$balise_2=array('gras'=>'</strong>',
'italique'=>'</span>',
'position'=>'</div>',
'flottant'=>'</div>',
'taille'=>'</span>',
'couleur'=>'</span>',
'police'=>'</span>',
'attention'=>'</span>',
'information'=>'</span>',
'liste'=>'</ul>',
'puce'=>'</li>',
'lien'=>'</a>',
'image'=>'',
'citation'=>'</span>',
'#text'=>''); // Tableau des balises fermantes

$attributs=array('position'=>'valeur',
'flottant'=>'valeur',
'taille'=>'valeur',
'couleur'=>'nom',
'police'=>'nom',
'lien'=>'url',
'image'=>'legende',
'citation'=>'auteur'); // Tableau des attributs
						
$nom=$noeud->nodeName; // On récupère le nom du noeud

if(!empty($contenu_a_inserer))$contenu=$contenu_a_inserer;
else $contenu=$noeud->nodeValue;

$premiere_balise=$balise_1[$nom];
if($noeud->hasAttributes() and $nom != 'image'){              
$un=$noeud->attributes->getNamedItem($attributs[$nom])->nodeValue;
$premiere_balise=str_replace("$1", $un, $premiere_balise);}

if($nom == 'image'){
$un=$contenu;
$premiere_balise=str_replace("$1", $un, $premiere_balise);

if($noeud->hasAttributes())$deux=$noeud->attributes->getNamedItem('legende')->nodeValue;
else $deux='Image';

$premiere_balise=str_replace("$2", $deux, $premiere_balise);
$intermediaire=$premiere_balise;
}
else{
$intermediaire=$premiere_balise . $contenu . $balise_2[$nom]; // On assemble le tout
if($nom == 'liste'  or $nom == 'puce'){
$intermediaire=preg_replace("#<ul>(\s)*<li>#sU", "<ul><li>", $intermediaire);
$intermediaire=preg_replace("#</li>(\s)*<li>#sU", "</li><li>", $intermediaire);
$intermediaire=preg_replace("#</li>(\s)*</ul>#sU", "</li></ul>", $intermediaire);}

if($nom == 'zcode')$intermediaire=nl2br($intermediaire);
}
return $intermediaire;}

function model_sav($p='',$o='',$res=''){[$p,$o]=ajxr($res);
return $ret;}

function plug_parsexml($p='',$o=''){
}

?>