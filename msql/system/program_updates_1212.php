<?php //msql/program_updates_1212
$r=["_menus_"=>['day','text'],
"1"=>['1201','amÃ©liorations de commoditÃ© de l\'interface, 
- des css, 
- du traitement des popups qui ouvrent un objet de l\'admin, 
- du comportement de la fenÃªtre du moteur de recherche,
- et de l\'interface vÃ©cue par les diffÃ©rentes sortes de membres'],
"2"=>['1202','- ajout du module \'columns\' qui permet de mettre des modules sur plusieurs colonnes
- menu apps rÃ©cursif ;'],
"3"=>['1203','- rÃ©novation de l\'installation des bases'],
"4"=>['1204','- le format \'brut\' (connecteurs) renvoie des url absolues pour les images (pour les transactions entre sites) ;
- ajout d\'une balise \'source\' dans le rss de l\'article ;'],
"5"=>['1205','- amÃ©lioration du menu Apps (rÃ©cursivitÃ© et prÃ©sentation) ;
- rÃ©vision du fonctionnement de la dÃ©tection du mode admin (Ã©radication de l\'affichage intempestif d\'une page d\'admin) ;
- changement du mode d\'affichage des menus de l\'admin msql (menus dÃ©roulants) ;'],
"6"=>['1206','- le permalog est rÃ©glÃ© sur 30 jours, 12 requÃªtes par an Ã§a suffit
- on remet le menu normal de l\'admin msql
- francisation des alertes du login'],
"7"=>['1207','- prise en compte serveurs en utf-8 (config serveur) (pas encore complÃ©tÃ©) ;
- rÃ©vision moteur de microsql, les variables ne sont plus nommÃ©es et la propagation de cette mÃ©thode est non intrusive (pas besoin de patch) : baisse de poids des bases ;
- optimisation des quelques requÃªtes mysql (dÃ©marrage et recherche) : lÃ©ger gain de vitesse ;
- amÃ©lioration du plugin \'suggest\' (affichage d\'erreurs) ;'],
"8"=>['1208','- menues amÃ©liorations dans les plugins notepad, sText, htaccess ;
- correctifs dÃ©tection mise Ã  jour (due Ã  la rÃ©cente mutation des mb) ;'],
"9"=>['1209','- ajax.php Ã  racine a Ã©tÃ© modifiÃ© ;
- ajout du composant \'Admin/codev\' pour Ã©diter le code sur place en mode texte ;'],
"10"=>['1210','- rÃ©paration du AMT qui s\'Ã©tait mit Ã  ne plus marcher pour les plugins (sText, htaccess...) ;'],
"11"=>['1211','- rÃ©vision d\'un filtre de protection de ajax, afin de rendre opÃ©rationnelle l\'Ã©dition du code en ligne (qui perdait les antislashes et les %u)'],
"12"=>['1212','- rÃ©vision des apparitions des htmlentities qui posaient problÃ¨me sur certains serveurs ;'],
"13"=>['1213','- on remet youtube en flash, qui propose le fullscreen, et qui est plus vÃ©loce'],
"14"=>['1214','- mise en place de la mise Ã  jour automatique ;
- la restriction \'check updates\' (48) devient \'auto-update\' ;'],
"15"=>['1215','- petite rÃ©vision du comportement du rendu avec ou sans la rstr \'p_balise\' (13) ;'],
"16"=>['1216','- la limite d\'upload par dÃ©faut passe Ã  250Mo, et devient un paramÃ¨tre serveur ;'],
"17"=>['1217','- francisation des titres du menu admin (lang/admin_menus)  ;
-ajout du bouton menu admin \'about\' ;'],
"18"=>['1218','- rÃ©paration du fonctionnement conjoint des restrictions \'save in ajax\' et \'save in popup\' (53 et 57) : popup implique ajax...
- l\'alerte de mise Ã  jour prÃ©sente les notes de dev depuis la derniÃ¨re maj ;'],
"19"=>['1219','- mise Ã  jour du template d\'articles par dÃ©faut ;
- rÃ©paration du comportement des popups qui se ferment en modifiant le contenu d\'une autre ;
- rÃ©paration de l\'Ã©diteur rapide de couleurs du sites ;'],
"20"=>['1220','- amÃ©lioration et francisation de la prÃ©sentation de la mise Ã  jour ;'],
"21"=>['1221','remise Ã  niveau du procÃ©dÃ© des templates : 
- l\'option template du module \'load\' est aussi valable pour la lecture de l\'article seul (comme Ã§a on peut en choisir un diffÃ©rent par condition) ;
- ajout de variables aux templates : les intitulÃ©s des tags utilisateurs, anciennement regroupÃ©s sous \'_usertags\', peuvent Ãªtre dÃ©groupÃ©s comme dans \'_auteurs\' ;
- Enfin Ã§a y est on s\'est dÃ©cidÃ©s : la procÃ©dure \'pubart\' (souvent appelÃ©e, qui se rÃ©fÃ¨re aux donnÃ©es du cache) est rÃ©gie par un template \'pubart\', et qu\'on peut supplanter par une autre table utilisateur ou table publique : cela permet d\'avoir des pubs d\'articles possibles Ã  mettre en forme ;
Par contre les pubs ne sont plus sensibles Ã  la restriction \'ajax mode\' (8) donc il faut Ã©crire le template comme ceci : 
[_PURLÂ§_SUJ:jurl:on] au lieu de [_URLÂ§_SUJ:url:on] pour ouvrir le contenu dans une popup ou sur place avec _jurl ;
- suppression de la rstr 17 (smart edit, obsolÃ¨te) ;'],
"22"=>['1222','- fix pb dÃ©tection de l\'update + apparition de l\'icÃ´ne upload en cas d\'Ã©chec de l\'automate ;
- fix pb variable vide dans le template ;
- rstr 17 : \'fast console\', permet d\'Ã©diter les modules sur place ;
- renommage des restrictions pour plus de clartÃ© ;'],
"23"=>['1223','- fix bug amdin msql'],
"24"=>['1224','- le menu msql de l\'admin renvoie les tables rÃ©elles de l\'utilisateur ;'],
"25"=>['1225','- une sÃ©rie de fonctions sans usage a Ã©tÃ© dÃ©sactivÃ©e temporairement (champs Ã©ditables)'],
"26"=>['1226','- correctif erreur indicatif pour meta robots'],
"27"=>['1227','- correctif compatibilitÃ© du template article avec le module d\'article \'open\' (ouvrir sur place) ;'],
"28"=>['1228','- les menus select de l\'Ã©diteur de meta sont remplacÃ©s par les composants ajax Ã©quivalents ;
- l\'ouverture sur place des articles se souvient du niveau de preview initial (1 ou 2) ;
- l\'intÃ©grateur vidÃ©o supporte l\'url youtu.be ;'],
"29"=>['1229','- rÃ©Ã©criture du plugin de gestion des inscriptions Ã  la newsletter (plugin \'mailist\'), en ajax ;'],
"30"=>['1230','- fix dÃ©calage horaire dans le systÃ¨me d\'envoi de mails ;
- fix stupiderie dans l\'outil de tags ;'],
"31"=>['1231','- rÃ©novation du systÃ¨me d\'envoi de la newsletter (ajout d\'un plugin \'newsletter\') ;']];