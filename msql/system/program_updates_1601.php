<?php //msql/program_updates_1601
$r=["1"=>['0101','publication'],
"2"=>['0101','- ajout d\'une nouvelle admin de tags
- suppression de tous les modules de type usertag (ajour d\'un param aux modules de type \'tag\' pour spÃ©cifier la classe)
'],
"3"=>['0102','finalisation de la mutation du systÃ¨me de tags (1-2/3) :
1 - unification des requÃªtes des options d\'articles (plus rapide)
- amÃ©lioration du systÃ¨me des langues
2 - modification des tables mysql, suppression des donnÃ©es obsolÃ¨tes, suppression de 2 colonnes
- mise Ã  niveau de l\'enregistrement des options (affichage / enregistrement plus rapides)
- ajout d\'un patch \'Finalize\'
Bilan : 6.8Mo de \'datas\' sont devenus 265Ko, et 340Ko de tags sont devenus 60Ko+7Mo de \'metas\' ; l\'ensemble des activitÃ©s du logiciel est grandement accÃ©lÃ©rÃ©e : une recherche d\'articles Ã  partir de tags d\'articles qui prenait 13.3s en prend dÃ©sormais 2.8. '],
"4"=>['0103','- suppression des occurrences restantes de usertag et du systÃ¨me de tags en sessions \'interm\' (datant de 2004)
- fix patch type de colonne
- amÃ©lioration du match tag/article
- ajout d\'un sÃ©lecteur de la totalitÃ© des tags dans l\'Ã©diteur de mÃ©tas'],
"5"=>['0104','- adaptation du moteur de recherche au nouveau systÃ¨me de tags
- les icÃ´nes des tags ouvrent une bulle qui permet de les Ã©diter sur place
- correctifs du gestionnaire de tags (remplacements/suppression)
- fix position des bulles qui dÃ©passent
- rÃ©amÃ©nagement de sorte Ã  ne plus appeler inutilement ajxf par dÃ©faut'],
"6"=>['0105','- petits correctifs ergonomiques du gestionnaire de meta'],
"7"=>['0106','- petits correctifs ergonomiques du gestionnaire de meta
- ajout d\'un consolidateur de stats, auquel le lecteur fait dÃ©sormais rÃ©fÃ©rence (sur une table sql inusitÃ©e prÃ©vue de longue date)'],
"8"=>['0107','- nombreux renommages et redirections de fonctions sql ancestrales vers les nouvelles
- stats : ajout d\'un spliteur de bases pour la table _live, et pour ne conserver que les actions des 30 derniers jours
- prise en charge des tags dans le moteur de recherche'],
"9"=>['0108','- nouveau moteur de recherche, plus puissant
- le compteur d\'occurrences est confiÃ© au traitement des articles
- fix gestionnaire de pages dans le cadre de search
- rÃ©habilitation de l\'option 2cols'],
"10"=>['0109','amÃ©lioration de la gestion de la taille des images dans le contexte des colonnes :
- >max : 100%
- >semi : auto / 100% (cols)
- <semi-semi : fixed (not 100% cols)'],
"11"=>['0110','rÃ©habilitation de la disposition des objets de modules sous forme de colonnes :
- les colonnes sont adaptatives (responsive)
- l\'option spÃ©cifie le nombre ou la taille des colonnes'],
"12"=>['0110','- fix get vide pour stats
- fix pb stats detect hub'],
"13"=>['0111','- fix admin/arts'],
"14"=>['0117','- fix gestionnaire de positionnement des bulles dans un scroll
- ajout du champ de tags utilisateur ; utilise l\'uid comme classe de tag
- fix gestionnaire de sous-modules (reÃ§oit les nouveaux params)'],
"15"=>['0121','- petite amÃ©lioration du gestionnaire de positionnement des bulles dans un scroll, fixÃ©es par rapport Ã  leur bouton (ainsi que le masque de clickoutside)'],
"16"=>['0122','- nouveau loader de plugins, qui permet de les ranger dans des sous-dossiers (ils sont toujours classÃ©s de faÃ§on logicielle)'],
"17"=>['0125','- rÃ©paration pb lors de la crÃ©ation d\'un nouveau module selon chaque mÃ©thode, prend en compte et rÃ©affiche le block de la mÃªme condition
- fix pb cohÃ©rence enregistrement des rstr'],
"18"=>['0127','- dans l\'Ã©diteur de mÃ©tas, l\'enregistrement de la catÃ©gorie est rendue immÃ©diate
- rÃ©fection de la prÃ©sentation des vidÃ©os : les iframes sont Ã©radiquÃ©s (avec violence) et un icÃ´ne renvoie la miniature, un lien vers le lecteur et un autre vers la source, de la vidÃ©o
- rÃ©fection de book'],
"19"=>['0128','- ajout des composants (plugin+table) poll et like, activables globalement (rstr90 et rstr91) ou localement (art_options)
- les poll et les like figurent parmi les favs
- ajout de reconnaissance de l\'iq par cookie, couplÃ©e Ã  l\'ip
- rÃ©fection de favs, du coup l\'ancien systÃ¨me est abandonnÃ© au profit de like'],
"20"=>['0128','- favs : ajout de catartag(), bien plus rapide pour les tags mineurs ; finalisation de la rÃ©fection de favs
- ajout du plus connectors, permet de faire des tests
- rÃ©fection de converts
- dÃ©portation de channel (module) vers un plus
- tests prÃ©liminaires pour le nouveau conscroll
- ajout d\'un dÃ©but d\'api pour centraliser toutes les requÃªtes et les rendre accessibles Ã  ajax sans avoir Ã  passer par des requÃªtes stockÃ©es et nommÃ©es']];