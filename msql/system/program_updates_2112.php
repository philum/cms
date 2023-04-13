<?php //msql/program_updates_2112
$r=["_menus_"=>[''],
"1"=>['1201','publication'],
"2"=>['1205','amÃ©lioration de la gestion des langues, elle n\'impacte plus la recherche par dÃ©faut, mais propose dÃ©sormais d\'afficher les traductions dans les tris.'],
"3"=>['1208','ajout du support de timecode dans le gestionnaire d\'import, url et lecture de youtube'],
"4"=>['1213','correctif gestion des images inimportables'],
"5"=>['1218','correctif ginit'],
"6"=>['1223','ajout du support de conversion des .webp vers .jpg  pourquoi ? parce que webp c\'est google donc c\'est niet.'],
"7"=>['1224','- ajout d\'une sÃ©rie d\'inputs spÃ©cialisÃ©s, rÃ©fection des anciens
- usages de ces nouveaux inputs (recherche, date)
- rÃ©forme de l\'Ã©diteur de date de l\'article (le composant html qui affiche un calendrier remplace le composant manuscrit antique \'calendar\')'],
"8"=>['1227','RÃ©forme critique du moteur ajax.
le troisiÃ¨me param des apps peut Ãªtre, au choix, $res ou $prm.
- $res est issu de l\'ancien dispositif, et renvoie les captures depuis la position 9 du script. Il est rÃ©digÃ© en pseudo-json.
- $prm est issu des captures du param 2, qui peuvent Ãªtre multiples, sÃ©parÃ©es par une virgule.
L\'ancien dispositif p9 ne supporte plus le multithread. Le nouveau dispositif n\'a mÃªme pas besoin du multithread. Ce dispositif antique, nommÃ© AMT, est rendu obsolÃ¨te. Progressivement les captures vont Ãªtre passÃ©es du p9 au p2 du protocole lj();
Les captures de p2 arrivent par un post, les autres params arrivent via get.
- l\'amÃ©nagement antique qui consiste Ã  dÃ©caler les variables d\'arrivÃ©e de un cran quand p2 Ã©tait appelÃ©, est rÃ©volu (heureusement). Elles arrivent dÃ©sormais par prm. Il est impossible qu\'une app puisse avoir besoin simultanÃ©ment de prm et de res. Le tableau res est mis en obsolescence.
En rÃ©sumÃ©, p2 renvoie les captures via post dans prm, p3,p4 etc (Ã  l\'infini) renvoient les variables via get.']];