<?php
//philum_microsql_program_updates_1211
$r["_menus_"]=array('day','text');
$r[1]=array('1101','- r�paration de la restriction 57 \'save_in_popup\', pour ne pas ; - ajout du submodule \'link\', ouvre l\'url dans une iframe ; - ajout du plugin ixquick, permet de faire une recherche ; - fix conflit provoquant erreur d\'enregistrement du param�tre trackback des articles ; - l\'�diteur des commentaires est plac� dans une popup ;');
$r[2]=array('1102','- ajout d\'un �diteur pour les sous-modules ;
- dans user_menu le bouton \'tools\' renvoie un acc�s � la racine du desktop, nomm�e \'tools\' ;
- fix pb dossier vide dans finder ;
- ajout d\'aides dans l\'�dition des sous-modules ;');
$r[3]=array('1103','- le plugin twitter re�oit le hashtag en param�tre rendu �ditable par le visiteur ;
- r�novation plugin exec, usage des popups ;');
$r[4]=array('1104','- ajout de \'text brut\' dans les boutons d\'article propos� au visiteur');
$r[5]=array('1105','- le mode desktop est appel� en ajax et on n\'a plus besoin de exit pour en sortir ;');
$r[6]=array('1106','ajout de classes globales pour avoir des boutons syst�me qui n\'utilisent pas les css de l\'utilisateur ;');
$r[7]=array('1107','centralisation de la prise en charge du scroll des popups ');
$r[8]=array('1108','param�tre autosize de SaveJ obsol�te : prit en charge automatiquement ;');
$r[9]=array('1109','buffer du multithread passe � 1500 car. ');
$r[10]=array('1110','am�lioration de l\'ajout de sous-modules (dans Apps) ;');
$r[11]=array('1111','am�lioration de l\'�dition des lignes de commandes de modules, l\'�diteur passe au second plan, remplac� par des boutons');
$r[12]=array('1112','ajout de pictos dans la borne d\'information sur l\'article \'words\'');
$r[13]=array('1113','- ajout du connecteur \':color\' (re�oit un hexa) ;
- ajout du codeline \':span\' qui se comporte comme \':div\' (re�oit d\'autres connecteurs comme \':style\') ;
- ajout du param�tre serveur \'ajax_buffer\' (admin/params/server) pour ajuster soi-m�me la taille du buffer AMT, 1500 par d�faut ;
- r�habilitation des rss, qu\'on peut appeler comme ceci : /plugin/rss/hub/preview');
$r[14]=array('1114','- r�habilitation de l\'�diteur rapide d\'articles de l\'admin, aussi appel� par l\'ic�ne \'text brut\' disponible au public ; (permet d\'�diter sans r�afficher l\'article)');
$r[15]=array('1115','- ajout d\'une aide � l\'�dition du module \'articles\' ;
- nouvelle pr�sentation du panneau \'ajouter modules\' ;
- introduction des variables d\'article \'jurl\' et \'purl\' pour ouvrir en ajax dans le content ou dans une popup ;
- ajout du codeline \':jurl\' : [_PURL�_SUJ:jurl]
- le module Category accepte les templates ;');
$r[16]=array('1116','- ajout de l\'attribut \'scrold\' (d pour d�file) pour retrouver les barres de d�filement rendues invisibles par l\'esth�tique ;
- ajout de  l\'attribut \'auto\' au mode d\'affichage de l\'article (preview, false, true) : d�fini par le niveau de priorit� de l\'article (2=preview) ;');
$r[17]=array('1117','- le mot \'Home\' fait appel � sa nomination (accueil en fr) ;
- r�novation de la pr�sentation des taxonomies ;
- r�parations sur l\'�diteur de font-faces ;
');
$r[18]=array('1118','parfois le nouvel article ne s\'affichait pas � cause d\'une importation d\'image avort�e : pb fix� ;');
$r[19]=array('1119','fix pb de d�tection de position et �tat d\'un article lors de sa cr�ation ;');
$r[20]=array('1120','l\'appel de la fen�tre \'site\' rendue ind�pendante du desktop');
$r[21]=array('1121','fix pb plein �cran des images seules');
$r[22]=array('1122','r�novation appli sText');
$r[23]=array('1123','le module \'taxo_nav\' qui est si cool, est rendu sensible � la cat�gorie ; il fait concurrence � \'rub_taxo\' car il permet d\'ouvrir les menus et de prendre en compte l\'article parent hors du champ temporel courant ;');
$r[24]=array('1124','ajout d\'aides � l\'�diteur de sous-modules');
$r[25]=array('1125','r�novation de l\'envoi de message � l\'admin');
$r[26]=array('1126','am�lioraton lisibilit� et commodit� des s�lecteurs ajax');
$r[27]=array('1127','finder : correctif renommage, francisation, syst�me d\'ic�nes � bulles');
$r[28]=array('1128','petite r�novation du chat et de l\'outil public de mails');
$r[29]=array('1129','r�novation du login, ajout d\'une option \'rester logu�\' utilisant les cookies, activ�e par une restriction \'permalog\' (59) ;');
$r[30]=array('1130','ajout du module \'bridge\' qui permet d\'importer un article au travers d\'un autre serveur philum ;');

?>