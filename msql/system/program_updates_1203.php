<?php //msql/program_updates_1203
$r=["_menus_"=>['day','text'],
"1"=>['0301','ajout du plugin \'spitable\' qui utilise la table publique des Ã©lÃ©ments atomiques, qui a Ã©tÃ© mise Ã  jour
le paramÃ¨tre limite la croissance, 118 par dÃ©faut'],
"2"=>['0302','l\'index du rÃ©pertoire \'plug\' est destinÃ© Ã  afficher le rÃ©sultat d\'un plugin, dans une iframe, Ã  destination de n\'importe quel site.
Les css classiques, javascript basiques et l\'affichage d\'une popup font partie de ses capacitÃ©s par dÃ©faut.
(on appelle un plugin par \'?call=plugin&p=param1&o=param2\')
ex: http://philum.fr/plug/index.php?call=spitable&p=118'],
"3"=>['0303','la suggestion d\'article Ã  un ami obtient un champ qui permet de rÃ©diger un message'],
"4"=>['0304','plugin \'phi\' renvoie le nombre Phi d\'aprÃ¨s l\'algorithme y=1+1/y dÃ©couvert par Davy'],
"5"=>['0305','tout bÃªte mais l\'ajout d\'un texte sur un lien pdf n\'Ã©tait pas implÃ©mentÃ© [url.pdfÂ§text:on] '],
"6"=>['0305','mise Ã  jour de la base des plugins'],
"7"=>['0306','la taille de formulaires s\'adapte Ã  la quantitÃ© de texte'],
"8"=>['0307','taille de la fenÃªtre de sÃ©lection des face-fonts limitÃ©e Ã  640 et scrollable'],
"9"=>['0308','correctif petit conflit, si un plugin est appelÃ© dans les pages la variable d\'url \'plug\' ne doit pas Ãªtre appelÃ©e dans la navigation entre les pages'],
"10"=>['0308','vidÃ©os et iframes au format 16/9 par dÃ©faut (ratio 0.56)'],
"11"=>['0308','- les vidÃ©os acceptent dÃ©sormais un paramÃ¨tre de dimension de type [width/heightÂ§ID:video:on]
- le module \'video_viewer\' ignore les dimensions'],
"12"=>['0308','le connecteur :thumb renvoie un lien en ajax vers l\'image en pleine rÃ©solution [imgÂ§w/h]'],
"13"=>['0308','les images peuvent recevoir une dimension arbitraire en renvoyer le rÃ©sultat du connecteur \'thumb\' : [w/hÂ§img:on]'],
"14"=>['0308','l\'assistant des connecteurs iframe, swf et thumb propose un champ pour les dimensions '],
"15"=>['0308','ajout du connecteur \'pdf\' : convertir le .pdf en :pdf et Ã§a renvoie le player google'],
"16"=>['0308','le module \'video_viewver\' affiche le titre de l\'article avec la balise \'h3\''],
"17"=>['0315','tous les glyphes (arabe, chinois, et quelque 774 000 autres caractÃ¨res sont supportÃ©s aprÃ¨s une transaction ajax (caractÃ¨res arrivant sous forme de %uxxxx)'],
"18"=>['0325','gestion un peu meilleure de l\'interprÃ©tation des liens vers une images ou des liens redondants (genre spip qui place des \'...\')'],
"19"=>['0327','les video de Ted sont du type \'http://ted.com/.../.mp4&1234 oÃ¹ l\'ID, si elle est spÃ©cifiÃ©e, permet d\'obtenir les sous-titres, qui sont dans la langue de l\'article ; ceci n\'est pas documentÃ© en attendant de trouver une meilleure procÃ©dure']];