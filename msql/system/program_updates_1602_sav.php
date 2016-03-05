<?php
//philum_microsql_program_updates_1602_sav
$r[1]=array('0201','publication');
$r[2]=array('0203','- amélioration du mode pagup, utilisé pour les vidéos
- le module videoplayer prend en compte les connecteurs :popvideo');
$r[3]=array('0205','- pré-finalisation de la nouvelle api (prend le relais des principaux appels : load et module articles
- amélioration des popups d\'images, usage de pagup et retour vers popup, appliqué aussi aux articles');
$r[4]=array('0206','- réforme de la syntaxe d\'appel de l\'API (type Json)
- le loader principal d\'articles est désormais branché sur l\'API, qui offre l\'avantage d\'une navigation par pages en ajax couplable avec un playscroll (défilement continu). 
- le module \'articles\' est branché sur l\'API, mais reste connecté à l\'ancien constructeur (défilement continu de type one-by-one)
- ajout du module api_mod : renvoie un load pour le constructeur d\'articles des modules
- ajout du module api_arts : utilise le constructeur de l\'API ; se substitue au module \'articles\' (mêmes paramètres)
- ajout d\'un controler dans SaveJ pour reset le tableau exs utilisé par le playscroll');
$r[5]=array('0208','- l\'API prend le relais du processus LOAD, appelé pour les requêtes définies par les variables d\'URL (tags, sources, etc...)
- ajout d\'un menu dig dans le résultat de l\'API');
$r[6]=array('0209','- dispositif Load rendu obsolète (charge et poids en moins)
- rénovation du boot
finalisation de l\'API :
- éléments de commande par défaut (paramètres non nulls et non-redondance)
- gestionnaire depuis les modules
- accessible depuis son plugin, et en json valide pour l\'open data
- bouton d\'affichage de la commande, bouton \'dig all\', ajout d\'une var t pour les titres de page (page_titles rendu presque obsolète)
- fichier help');
$r[7]=array('0210','- petits aménagements et boutons d\'agrément, fix desktop
- ajout d\'un gestionnaire de backup des images (tarim)
- fix codeview');
$r[8]=array('0211','- nouveau gestionnaire de couleurs en ajax dans l\'éditeur css
- révision du système des conditions, renommé contextes : on peut créer des contextes additionnels et y faire apparaître les modules qui appartiennent à ce contexte. Cela simplifie les liens vers des modules, via l\'url /context/');
$r[9]=array('0212','- correctifs et renommages dans l\'api, 
- ajout du plug apicom, commandes pour l\'api
- ajout des boutons d\'exploitation des commandes');
$r[10]=array('0213','api
- suppression de la var limit, émulée par nbyp+page
- la var file produit un fichier html');
$r[11]=array('0215','- suppression des tables like et love, reconvertis en fav et like, entreposés dans qd_data ; dans la même table que les options d\'articles, ça produit que les favs ou like désactivés mais reconnus s\'affichent quand même
- ajout du stockage/edition des commandes api dans les favs');
$r[12]=array('0218','- ajout d\'un export de microsql vers mysql
- amélioration du plugin exec, nous système d\'exécution du code
(en combinant 1 et 2 par mégarde) - ajout des defs d\'importation les plus usitées dans le detect de defcon');
$r[13]=array('0220','réparation d\'un pb de balises vides dans les stats :
- fix bug qb=0
- fix anomalie detect get
- ajout d\'un capteur dans ajax pour la lecture des articles (du coup les résultats bondissent)');
$r[14]=array('0223','modif protocole api, les | remplacent les - pour scinder en multivars');

?>