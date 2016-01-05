<?php
//philum_microsql_connectors_codeline
$connectors_codeline["_menus_"]=array('value');
$connectors_codeline["balise"]=array('balise html spécifiant un ID et une classe : value§balise|id|class ; accepte les contenus vides');
$connectors_codeline["html"]=array('balise');
$connectors_codeline["div"]=array('balise div, params = attributs');
$connectors_codeline["css"]=array('balise span spécifiant une classe css');
$connectors_codeline["br"]=array('saut de ligne');
$connectors_codeline["id"]=array("attribut de balises 'id'");
$connectors_codeline["class"]=array("attribut de balises 'class'");
$connectors_codeline["style"]=array("attribut de balises 'style'");
$connectors_codeline["name"]=array("attribut de balises 'name'");
$connectors_codeline["size"]=array('balise font spécifiant la taille des caractères');
$connectors_codeline["text"]=array('affiche du texte');
$connectors_codeline["url"]=array('lien html');
$connectors_codeline["link"]=array('lien html incluant le langage de modules');
$connectors_codeline["anchor"]=array("renvoie une ancre (appelée par un lien avec un attribut 'name')");
$connectors_codeline["date"]=array('[_DAY§d/m/y:date] (Day Month Yeah I=minute Second - renvoie le timestamp actuel si _DAY est vide');
$connectors_codeline["title"]=array("titre d'un article, à partir d'un id ou de l'élément '_ID'");
$connectors_codeline["read"]=array("contenu d'un article (valeur numérique ou '_ID')");
$connectors_codeline["image"]=array('affiche une image ');
$connectors_codeline["thumb"]=array("fabrique une miniature à partir d'une image ou de '_IMG1' ; spécifier largeur/hauteur en paramètre");
$connectors_codeline["split"]=array("renvoie deux variables de la fonction 'split' (préciser chaîne et séparateur)");
$connectors_codeline["cut"]=array('renvoie la partie située entre deux repères [abcdef§b/e:cut] (renvoie cd)');
$connectors_codeline["conn"]=array('renvoie un connecteur [hello§b:conn]');
$connectors_codeline["plug"]=array("renvoie un plug-in 'name' (et sa fonction 'plug_name') avec ses paramètres [login§register:plug]");
$connectors_codeline["core"]=array("résultat d'un algorithme du noyau");

?>