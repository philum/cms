<?php
//philum_microsql_philum_commandes
$r[1]=array('[file.jpg ]  [file.mp3 ]  [file.swf ]  (etc...)','extensions de fichier');
$r[2]=array('[url.com§texte ]','lien avec texte');
$r[3]=array('[ID:video ]','vidéo (reconnaît le provider d\'après l\'ID)');
$r[4]=array('[ID:read ]','autre article importé dans celui en cours d\'édition');
$r[5]=array('[img§140/100:thumb ]','miniature d\'une image à une taille prédéterminée');
$r[6]=array('[Name=entry,Email=email:formail ]','formulaire');
$r[7]=array('[param/title/command/option:modulename:module ] 
[param:modulename:module]
[/title//:modulename:module]
[modulename:module]','connecteur qui appelle un module (notez le \":\" deux fois)');
$r[10]=array('[hour,Home:module ]','plusieurs modules');
$r[11]=array('[param/title/command/option:modulename§button:ajax ] 
[ID:read§button:ajax ]','deux boutons qui renvoient un résultat en ajax');
$r[12]=array('[param/title/command/option:modulename§button->banner:ajax ]','un bouton qui renvoie un résultat en ajax en ciblant une div');
$r[13]=array('[cat=public~nbdays=30/déroulé des articles/cols/3:articles:articles ]','Commande d\'articles : un rendu en trois colonnes des articles de la catégorie \'public\', parus il y a trente jours, et on a ajouté un titre « déroulé des articles »');
$r[14]=array('[philum_functions:microsql ]
[philum_functions§1:microsql ]','un tableau de données ; le paramètre optionnel §1 spécifie la clef');
$r["msql"]=array();

?>