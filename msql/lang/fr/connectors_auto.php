<?php
//philum_microsql_connectors_auto
$r["_menus_"]=array('description');
$r[".jpg,.png,.gif"]=array('affiche l\'image');
$r[".mp3"]=array('renvoie un lecteur mp3');
$r[".mp4,.mov,.wmv,.asf,.rm (etc...)"]=array('reconnus comme vidéo');
$r[".pdf"]=array('renvoie une icône PDF téléchargeable');
$r[".swf"]=array('renvoie une shockwave Flash (dont on peut spécifier la taille. ex: 320/240§objet.swf');
$r["@§texte"]=array(' avec ou sans l\'attribut, renvoie un lien de type \'mailto:\'');
$r["http://"]=array('fait un lien html, ou importe l\'image si ç\'en est une');
$r["lien§texte/image"]=array('fait un lien du texte ou de l\'image. Peut recevoir l\'ID d\'un article');

?>