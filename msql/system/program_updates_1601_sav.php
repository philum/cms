<?php
//philum_microsql_program_updates_1601_sav
$r[1]=array('0101','publication');
$r[2]=array('0101','- ajout d\'une nouvelle admin de tags
- suppression de tous les modules de type usertag (ajour d\'un param aux modules de type \'tag\' pour spécifier la classe)
');
$r[3]=array('0102','finalisation de la mutation du système de tags (1-2/3) :
1 - unification des requêtes des options d\'articles (plus rapide)
- amélioration du système des langues
2 - modification des tables mysql, suppression des données obsolètes, suppression de 2 colonnes
- mise à niveau de l\'enregistrement des options (affichage / enregistrement plus rapides)
- ajout d\'un patch \'Finalize\'
Bilan : 6.8Mo de \'datas\' sont devenus 265Ko, et 340Ko de tags sont devenus 60Ko+7Mo de \'metas\' ; l\'ensemble des activités du logiciel est grandement accélérée : une recherche d\'articles à partir de tags d\'articles qui prenait 13.3s en prend désormais 2.8. ');
$r[4]=array('0103','- suppression des occurrences restantes de usertag et du système de tags en sessions \'interm\' (datant de 2004)
- fix patch type de colonne
- amélioration du match tag/article
- ajout d\'un sélecteur de la totalité des tags dans l\'éditeur de métas');
$r[5]=array('0104','- adaptation du moteur de recherche au nouveau système de tags
- les icônes des tags ouvrent une bulle qui permet de les éditer sur place
- correctifs du gestionnaire de tags (remplacements/suppression)
- fix position des bulles qui dépassent
- réaménagement de sorte à ne plus appeler inutilement ajxf par défaut');
$r[6]=array('0105','- petits correctifs ergonomiques du gestionnaire de meta');
$r[7]=array('0106','- petits correctifs ergonomiques du gestionnaire de meta
- ajout d\'un consolidateur de stats, auquel le lecteur fait désormais référence (sur une table sql inusitée prévue de longue date)');
$r[8]=array('0107','- nombreux renommages et redirections de fonctions sql ancestrales vers les nouvelles
- stats : ajout d\'un spliteur de bases pour la table _live, et pour ne conserver que les actions des 30 derniers jours
- prise en charge des tags dans le moteur de recherche');
$r[9]=array('0108','- nouveau moteur de recherche, plus puissant
- le compteur d\'occurrences est confié au traitement des articles
- fix gestionnaire de pages dans le cadre de search
- réhabilitation de l\'option 2cols');
$r[10]=array('0109','amélioration de la gestion de la taille des images dans le contexte des colonnes :
- >max : 100%
- >semi : auto / 100% (cols)
- <semi-semi : fixed (not 100% cols)');
$r[11]=array('0110','réhabilitation de la disposition des objets de modules sous forme de colonnes :
- les colonnes sont adaptatives (responsive)
- l\'option spécifie le nombre ou la taille des colonnes');
$r[12]=array('0110','- fix get vide pour stats
- fix pb stats detect hub');
$r[13]=array('0111','- fix admin/arts');
$r[14]=array('0117','- fix gestionnaire de positionnement des bulles dans un scroll
- ajout du champ de tags utilisateur ; utilise l\'uid comme classe de tag
- fix gestionnaire de sous-modules (reçoit les nouveaux params)');
$r[15]=array('0121','- petite amélioration du gestionnaire de positionnement des bulles dans un scroll, fixées par rapport à leur bouton (ainsi que le masque de clickoutside)');
$r[16]=array('0122','- nouveau loader de plugins, qui permet de les ranger dans des sous-dossiers (ils sont toujours classés de façon logicielle)');
$r[17]=array('0125','- réparation pb lors de la création d\'un nouveau module selon chaque méthode, prend en compte et réaffiche le block de la même condition
- fix pb cohérence enregistrement des rstr');
$r[18]=array('0127','- dans l\'éditeur de métas, l\'enregistrement de la catégorie est rendue immédiate
- réfection de la présentation des vidéos : les iframes sont éradiqués (avec violence) et un icône renvoie la miniature, un lien vers le lecteur et un autre vers la source, de la vidéo
- réfection de book');
$r[19]=array('0128','- ajout des composants (plugin+table) poll et like, activables globalement (rstr90 et rstr91) ou localement (art_options)
- les poll et les like figurent parmi les favs
- ajout de reconnaissance de l\'iq par cookie, couplée à l\'ip
- réfection de favs, du coup l\'ancien système est abandonné au profit de like');
$r[20]=array('0128','- favs : ajout de catartag(), bien plus rapide pour les tags mineurs ; finalisation de la réfection de favs
- ajout du plus connectors, permet de faire des tests
- réfection de converts
- déportation de channel (module) vers un plus
- tests préliminaires pour le nouveau conscroll
- ajout d\'un début d\'api pour centraliser toutes les requêtes et les rendre accessibles à ajax sans avoir à passer par des requêtes stockées et nommées');

?>