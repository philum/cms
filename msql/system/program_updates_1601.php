<?php
//philum_microsql_program_updates_1601
$r[1]=array('0101','publication');
$r[2]=array('0101','- ajout d\'une nouvelle admin de tags
- suppression de tous les modules de type usertag (ajour d\'un param aux modules de type \'tag\' pour sp�cifier la classe)
');
$r[3]=array('0102','finalisation de la mutation du syst�me de tags (1-2/3) :
1 - unification des requ�tes des options d\'articles (plus rapide)
- am�lioration du syst�me des langues
2 - modification des tables mysql, suppression des donn�es obsol�tes, suppression de 2 colonnes
- mise � niveau de l\'enregistrement des options (affichage / enregistrement plus rapides)
- ajout d\'un patch \'Finalize\'
Bilan : 6.8Mo de \'datas\' sont devenus 265Ko, et 340Ko de tags sont devenus 60Ko+7Mo de \'metas\' ; l\'ensemble des activit�s du logiciel est grandement acc�l�r�e : une recherche d\'articles � partir de tags d\'articles qui prenait 13.3s en prend d�sormais 2.8. ');
$r[4]=array('0103','- suppression des occurrences restantes de usertag et du syst�me de tags en sessions \'interm\' (datant de 2004)
- fix patch type de colonne
- am�lioration du match tag/article
- ajout d\'un s�lecteur de la totalit� des tags dans l\'�diteur de m�tas');
$r[5]=array('0104','- adaptation du moteur de recherche au nouveau syst�me de tags
- les ic�nes des tags ouvrent une bulle qui permet de les �diter sur place
- correctifs du gestionnaire de tags (remplacements/suppression)
- fix position des bulles qui d�passent
- r�am�nagement de sorte � ne plus appeler inutilement ajxf par d�faut');
$r[6]=array('0105','- petits correctifs ergonomiques du gestionnaire de meta');
$r[7]=array('0106','- petits correctifs ergonomiques du gestionnaire de meta
- ajout d\'un consolidateur de stats, auquel le lecteur fait d�sormais r�f�rence (sur une table sql inusit�e pr�vue de longue date)');
$r[8]=array('0107','- nombreux renommages et redirections de fonctions sql ancestrales vers les nouvelles
- stats : ajout d\'un spliteur de bases pour la table _live, et pour ne conserver que les actions des 30 derniers jours
- prise en charge des tags dans le moteur de recherche');
$r[9]=array('0108','- nouveau moteur de recherche, plus puissant
- le compteur d\'occurrences est confi� au traitement des articles
- fix gestionnaire de pages dans le cadre de search
- r�habilitation de l\'option 2cols');
$r[10]=array('0109','am�lioration de la gestion de la taille des images dans le contexte des colonnes :
- >max : 100%
- >semi : auto / 100% (cols)
- <semi-semi : fixed (not 100% cols)');
$r[11]=array('0110','r�habilitation de la disposition des objets de modules sous forme de colonnes :
- les colonnes sont adaptatives (responsive)
- l\'option sp�cifie le nombre ou la taille des colonnes');
$r[12]=array('0110','- fix get vide pour stats
- fix pb stats detect hub');
$r[13]=array('0111','- fix admin/arts');
$r[14]=array('0117','- fix gestionnaire de positionnement des bulles dans un scroll
- ajout du champ de tags utilisateur ; utilise l\'uid comme classe de tag
- fix gestionnaire de sous-modules (re�oit les nouveaux params)');
$r[15]=array('0121','- petite am�lioration du gestionnaire de positionnement des bulles dans un scroll, fix�es par rapport � leur bouton (ainsi que le masque de clickoutside)');
$r[16]=array('0122','- nouveau loader de plugins, qui permet de les ranger dans des sous-dossiers (ils sont toujours class�s de fa�on logicielle)');
$r[17]=array('0125','- r�paration pb lors de la cr�ation d\'un nouveau module selon chaque m�thode, prend en compte et r�affiche le block de la m�me condition
- fix pb coh�rence enregistrement des rstr');
$r[18]=array('0127','- dans l\'�diteur de m�tas, l\'enregistrement de la cat�gorie est rendue imm�diate
- r�fection de la pr�sentation des vid�os : les iframes sont �radiqu�s (avec violence) et un ic�ne renvoie la miniature, un lien vers le lecteur et un autre vers la source, de la vid�o
- r�fection de book');
$r[19]=array('0128','- ajout des composants (plugin+table) poll et like, activables globalement (rstr90 et rstr91) ou localement (art_options)
- les poll et les like figurent parmi les favs
- ajout de reconnaissance de l\'iq par cookie, coupl�e � l\'ip
- r�fection de favs, du coup l\'ancien syst�me est abandonn� au profit de like');
$r[20]=array('0128','- favs : ajout de catartag(), bien plus rapide pour les tags mineurs ; finalisation de la r�fection de favs
- ajout du plus connectors, permet de faire des tests
- r�fection de converts
- d�portation de channel (module) vers un plus
- tests pr�liminaires pour le nouveau conscroll
- ajout d\'un d�but d\'api pour centraliser toutes les requ�tes et les rendre accessibles � ajax sans avoir � passer par des requ�tes stock�es et nomm�es');

?>