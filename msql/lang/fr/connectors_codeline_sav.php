<?php
//philum_microsql_connectors_codeline
$connectors_codeline["_menus_"]=array('value');
$connectors_codeline["balise"]=array('balise html sp�cifiant un ID et une classe : value�balise|id|class ; accepte les contenus vides');
$connectors_codeline["html"]=array('balise');
$connectors_codeline["div"]=array('balise div, params = attributs');
$connectors_codeline["css"]=array('balise span sp�cifiant une classe css');
$connectors_codeline["br"]=array('saut de ligne');
$connectors_codeline["id"]=array("attribut de balises 'id'");
$connectors_codeline["class"]=array("attribut de balises 'class'");
$connectors_codeline["style"]=array("attribut de balises 'style'");
$connectors_codeline["name"]=array("attribut de balises 'name'");
$connectors_codeline["size"]=array('balise font sp�cifiant la taille des caract�res');
$connectors_codeline["text"]=array('affiche du texte');
$connectors_codeline["url"]=array('lien html');
$connectors_codeline["link"]=array('lien html incluant le langage de modules');
$connectors_codeline["anchor"]=array("renvoie une ancre (appel�e par un lien avec un attribut 'name')");
$connectors_codeline["date"]=array('[_DAY�d/m/y:date] (Day Month Yeah I=minute Second - renvoie le timestamp actuel si _DAY est vide');
$connectors_codeline["title"]=array("titre d'un article, � partir d'un id ou de l'�l�ment '_ID'");
$connectors_codeline["read"]=array("contenu d'un article (valeur num�rique ou '_ID')");
$connectors_codeline["image"]=array('affiche une image ');
$connectors_codeline["thumb"]=array("fabrique une miniature � partir d'une image ou de '_IMG1' ; sp�cifier largeur/hauteur en param�tre");
$connectors_codeline["split"]=array("renvoie deux variables de la fonction 'split' (pr�ciser cha�ne et s�parateur)");
$connectors_codeline["cut"]=array('renvoie la partie situ�e entre deux rep�res [abcdef�b/e:cut] (renvoie cd)');
$connectors_codeline["conn"]=array('renvoie un connecteur [hello�b:conn]');
$connectors_codeline["plug"]=array("renvoie un plug-in 'name' (et sa fonction 'plug_name') avec ses param�tres [login�register:plug]");
$connectors_codeline["core"]=array("r�sultat d'un algorithme du noyau");

?>