<?php
//philum_microsql_program_updates_1601
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

?>