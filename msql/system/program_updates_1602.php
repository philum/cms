<?php
//philum_microsql_program_updates_1602
$r[1]=array('0201','publication');
$r[2]=array('0203','- am�lioration du mode pagup, utilis� pour les vid�os
- le module videoplayer prend en compte les connecteurs :popvideo');
$r[3]=array('0205','- pr�-finalisation de la nouvelle api (prend le relais des principaux appels : load et module articles
- am�lioration des popups d\'images, usage de pagup et retour vers popup, appliqu� aussi aux articles');
$r[4]=array('0206','- r�forme de la syntaxe d\'appel de l\'API (type Json)
- le loader principal d\'articles est d�sormais branch� sur l\'API, qui offre l\'avantage d\'une navigation par pages en ajax couplable avec un playscroll (d�filement continu). 
- le module \'articles\' est branch� sur l\'API, mais reste connect� � l\'ancien constructeur (d�filement continu de type one-by-one)
- ajout du module api_mod : renvoie un load pour le constructeur d\'articles des modules
- ajout du module api_arts : utilise le constructeur de l\'API ; se substitue au module \'articles\' (m�mes param�tres)
- ajout d\'un controler dans SaveJ pour reset le tableau exs utilis� par le playscroll');
$r[5]=array('0208','- l\'API prend le relais du processus LOAD, appel� pour les requ�tes d�finies par les variables d\'URL (tags, sources, etc...)
- ajout d\'un menu dig dans le r�sultat de l\'API');
$r[6]=array('0209','- dispositif Load rendu obsol�te (charge et poids en moins)
- r�novation du boot
finalisation de l\'API :
- �l�ments de commande par d�faut (param�tres non nulls et non-redondance)
- gestionnaire depuis les modules
- accessible depuis son plugin, et en json valide pour l\'open data
- bouton d\'affichage de la commande, bouton \'dig all\', ajout d\'une var t pour les titres de page (page_titles rendu presque obsol�te)
- fichier help');
$r[7]=array('0210','- petits am�nagements et boutons d\'agr�ment, fix desktop
- ajout d\'un gestionnaire de backup des images (tarim)
- fix codeview');
$r[8]=array('0211','- nouveau gestionnaire de couleurs en ajax dans l\'�diteur css
- r�vision du syst�me des conditions, renomm� contextes : on peut cr�er des contextes additionnels et y faire appara�tre les modules qui appartiennent � ce contexte. Cela simplifie les liens vers des modules, via l\'url /context/');
$r[9]=array('0212','- correctifs et renommages dans l\'api, 
- ajout du plug apicom, commandes pour l\'api
- ajout des boutons d\'exploitation des commandes');
$r[10]=array('0213','api
- suppression de la var limit, �mul�e par nbyp+page
- la var file produit un fichier html');
$r[11]=array('0215','- suppression des tables like et love, reconvertis en fav et like, entrepos�s dans qd_data ; dans la m�me table que les options d\'articles, �a produit que les favs ou like d�sactiv�s mais reconnus s\'affichent quand m�me
- ajout du stockage/edition des commandes api dans les favs');
$r[12]=array('0218','- ajout d\'un export de microsql vers mysql
- am�lioration du plugin exec, nous syst�me d\'ex�cution du code
(en combinant 1 et 2 par m�garde) - ajout des defs d\'importation les plus usit�es dans le detect de defcon');
$r[13]=array('0220','r�paration d\'un pb de balises vides dans les stats :
- fix bug qb=0
- fix anomalie detect get
- ajout d\'un capteur dans ajax pour la lecture des articles (du coup les r�sultats bondissent)');
$r[14]=array('0223','- ce matin la config a souffert (s�rement lors d\'un passage en mode lab) : les tags ne r�pondaient plus
- modif protocole api, les | remplacent les - pour scinder en multivars');

?>