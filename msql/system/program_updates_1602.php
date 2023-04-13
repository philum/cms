<?php //msql/program_updates_1602
$r=["1"=>['0201','publication'],
"2"=>['0203','- amÃ©lioration du mode pagup, utilisÃ© pour les vidÃ©os
- le module videoplayer prend en compte les connecteurs :popvideo'],
"3"=>['0205','- prÃ©-finalisation de la nouvelle api (prend le relais des principaux appels : load et module articles
- amÃ©lioration des popups d\'images, usage de pagup et retour vers popup, appliquÃ© aussi aux articles'],
"4"=>['0206','- rÃ©forme de la syntaxe d\'appel de l\'API (type Json)
- le loader principal d\'articles est dÃ©sormais branchÃ© sur l\'API, qui offre l\'avantage d\'une navigation par pages en ajax couplable avec un playscroll (dÃ©filement continu). 
- le module \'articles\' est branchÃ© sur l\'API, mais reste connectÃ© Ã  l\'ancien constructeur (dÃ©filement continu de type one-by-one)
- ajout du module api_mod : renvoie un load pour le constructeur d\'articles des modules
- ajout du module api_arts : utilise le constructeur de l\'API ; se substitue au module \'articles\' (mÃªmes paramÃ¨tres)
- ajout d\'un controler dans SaveJ pour reset le tableau exs utilisÃ© par le playscroll'],
"5"=>['0208','- l\'API prend le relais du processus LOAD, appelÃ© pour les requÃªtes dÃ©finies par les variables d\'URL (tags, sources, etc...)
- ajout d\'un menu dig dans le rÃ©sultat de l\'API'],
"6"=>['0209','- dispositif Load rendu obsolÃ¨te (charge et poids en moins)
- rÃ©novation du boot
finalisation de l\'API :
- Ã©lÃ©ments de commande par dÃ©faut (paramÃ¨tres non nulls et non-redondance)
- gestionnaire depuis les modules
- accessible depuis son plugin, et en json valide pour l\'open data
- bouton d\'affichage de la commande, bouton \'dig all\', ajout d\'une var t pour les titres de page (page_titles rendu presque obsolÃ¨te)
- fichier help'],
"7"=>['0210','- petits amÃ©nagements et boutons d\'agrÃ©ment, fix desktop
- ajout d\'un gestionnaire de backup des images (tarim)
- fix codeview'],
"8"=>['0211','- nouveau gestionnaire de couleurs en ajax dans l\'Ã©diteur css
- rÃ©vision du systÃ¨me des conditions, renommÃ© contextes : on peut crÃ©er des contextes additionnels et y faire apparaÃ®tre les modules qui appartiennent Ã  ce contexte. Cela simplifie les liens vers des modules, via l\'url /context/'],
"9"=>['0212','- correctifs et renommages dans l\'api, 
- ajout du plug apicom, commandes pour l\'api
- ajout des boutons d\'exploitation des commandes'],
"10"=>['0213','api
- suppression de la var limit, Ã©mulÃ©e par nbyp+page
- la var file produit un fichier html'],
"11"=>['0215','- suppression des tables like et love, reconvertis en fav et like, entreposÃ©s dans qd_data ; dans la mÃªme table que les options d\'articles, Ã§a produit que les favs ou like dÃ©sactivÃ©s mais reconnus s\'affichent quand mÃªme
- ajout du stockage/edition des commandes api dans les favs'],
"12"=>['0218','- ajout d\'un export de microsql vers mysql
- amÃ©lioration du plugin exec, nous systÃ¨me d\'exÃ©cution du code
(en combinant 1 et 2 par mÃ©garde) - ajout des defs d\'importation les plus usitÃ©es dans le detect de defcon'],
"13"=>['0220','rÃ©paration d\'un pb de balises vides dans les stats :
- fix bug qb=0
- fix anomalie detect get
- ajout d\'un capteur dans ajax pour la lecture des articles (du coup les rÃ©sultats bondissent)'],
"14"=>['0223','- ce matin la config a souffert (sÃ»rement lors d\'un passage en mode lab) : les tags ne rÃ©pondaient plus
- modif protocole api, les | remplacent les - pour scinder en multivars']];