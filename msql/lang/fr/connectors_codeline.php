<?php
//philum_microsql_connectors_codeline
$r["_menus_"]=array('value');
$r["balise"]=array('balise html sp�cifiant un ID et une classe : value�balise|id|class ; accepte les contenus vides');
$r["html"]=array('balise');
$r["div"]=array('balise div, params = attributs');
$r["css"]=array('balise span sp�cifiant une classe css');
$r["br"]=array('saut de ligne');
$r["id"]=array('attribut de balises \'id\'');
$r["class"]=array('attribut de balises \'class\'');
$r["style"]=array('attribut de balises \'style\'');
$r["name"]=array('attribut de balises \'name\'');
$r["text"]=array('affiche du texte');
$r["url"]=array('lien html');
$r["link"]=array('lien html incluant le langage de modules');
$r["anchor"]=array('renvoie une ancre (appel�e par un lien avec un attribut \'name\')');
$r["date"]=array('[_DAY�d/m/y:date] (Day Month Yeah I=minute Second - renvoie le timestamp actuel si _DAY est vide');
$r["title"]=array('titre d\'un article, � partir d\'un id ou de l\'�l�ment \'_ID\'');
$r["read"]=array('contenu d\'un article (valeur num�rique ou \'_ID\')');
$r["image"]=array('affiche une image ');
$r["thumb"]=array('fabrique une miniature � partir d\'une image ou de \'_IMG1\' ; sp�cifier largeur/hauteur en param�tre');
$r["split"]=array('renvoie deux variables de la fonction \'split\' (pr�ciser cha�ne et s�parateur)');
$r["cut"]=array('renvoie la partie situ�e entre deux rep�res [abcdef�b/e:cut] (renvoie cd)');
$r["conn"]=array('renvoie un connecteur [hello�b:conn]');
$r["plug"]=array('renvoie un plug-in \'name\' (et sa fonction \'plug_name\') avec ses param�tres [login�register:plug]');
$r["core"]=array('r�sultat d\'un algorithme du noyau');

?>