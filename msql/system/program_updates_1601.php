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

?>