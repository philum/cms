<?php
//philum_microsql_program_updates_1606_sav
$r["_menus_"]=array('date','text');
$r[1]=array('0601','publication');
$r[2]=array('0601','- ajout des options csslink, jslink, csscode, jscode au connecteur headers
- les r�sultats de menubub sont mis en cache
- les favs incluent les articles visit�s
- ajout de la commande icons dans plusieurs modules
- fix pb condition de module support ajx
- le menu cond des modules transporte la valeur courante
- ajout d\'un bouton edit dans le preview d\'article avant import, qui renvoie l\'�diteur afin d\'�diter avant import');
$r[3]=array('0602','- r�novation du plugin suggest, ajout d\'un �diteur interm�diaire de l\'article propos� � la publication
- r�habilitation du connecteur :video : par d�faut, ne renvoyait qu\'un lien + miniature + bouton popup. (avant, renvoyait le player, et �1 le bt popup). maintenant �1 renvoie le player, et �440/320 permet de d�finir les dimensions');
$r[4]=array('0603','- correctif gestionnaire d\'�dition par cellule de msql
- r�novation et d�placement dans le plug mail des fonctions d\'envoi de mail');
$r[5]=array('0604','- patch mysql, 3 colonnes supprim�es dans la table des commentaires
- ajout du module app_popup : renvoie une app dans une popup au lancement
- ajout du param 12 dans les modules : popup, fait appara�tre un module dans une popup au lancement');
$r[6]=array('0606','- ajout de l\'option de module popapi : poue les modules de type lin (anc�tre des apps, fabrique des tableaux de donn�es destin�es � fabriquer des liens), l\'option popapi renvoie un lien qui ouvre dans une popup, l\'api avec la requ�te courante ; convertie les menus rendus par des modules en menus de type desktop');
$r[7]=array('0607','- ajout de l\'App toposlides, permet de faire des slides topologiques');
$r[8]=array('0611','- fix pb mise en cache d\'articles datant d\'avant 1970
- mise au rebut de sqlimit, continue, rstr53, tout ce qui permettait de revenir � l\'antique m�thode POST pour l\'enregistrement des articles
- en passant on vire un sleep(1) qui �tait l� depuis longtemps (au reload d\'article apr�s un save)');
$r[9]=array('0615','- fix pb lang undefined des articles import�s d\'un autre hub
- fix pb miniatures css, prend la plus grande image de l\'article en-dessous de 4000px de large (pb m�moire)
- int�gration typos google en dur dans les face-fonts (open sans, lato, merriweather, oswald, raleway, roboto)');
$r[10]=array('0616','- la commande \'last\' du moteur de recherche renvoie le dernier article publi�
- le tableau de commande Api est plac� dans une popup
- ajout d\'un g�n�rateur de titre de la commande Api');
$r[11]=array('0620','- dans l\'�diteur d\'import d\'articles, ajout d\'un bouton vers le d�tecteur de d�finitions pour faciliter leur mise � jour');
$r[12]=array('0621','- ajout de recognize_defcon() suite � verif_defcon() et avant known_defoncs, qui d�duit les defcons inconnus');
$r[13]=array('0623','- save_tits_j() requ�teur utilisant atmrup()
- r�novation de la standardisation des titres pour avoir les majuscules voulues
- r�forme du capteur xml rss, pour intercaler l\'utf8_decode_b(), et recevoir des flux aux langages exotiques
- mise en conformit� avec les rss en https (certains interdisent les http normaux, maintenant !)');
$r[14]=array('0625','- am�lioration �criture de toposlides
- les utags sont sans limite temporelle, et implant�s dans l\'api
- les d�finitions des pictos sont confi�s � _pictos.css');
$r[15]=array('0627','- petite r�novation du module Banner, p=image autre que celle d�finie comme banni�re par d�faut, o=hauteur');
$r[16]=array('0628','- ajout du l\'app slides (utilise une table msql)
- ajout du connecteur slides (cr�e une table � partir des donn�es du connecteur, puis appelle l\'app avec l\'id de l\'article, auquel est associ� la table)');
$r[17]=array('0629','- les options de modules utilisent le m�me s�parateur que les params (l\'espace au lieu de |)
- l\'option template des sub-modules est rendue op�rationnelle, � l\'occasion de 
- l\'ajout d\'un template pubart_b, qui utilise conjointement une miniature de 200 et une largeur de colonne par d�faut de 200 (pubs d\'articles avec grande miniature)');

?>