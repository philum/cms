<?php //philum/msql/program_updates_2112
$r=["_menus_"=>[''],
"1"=>['1201','publication'],
"2"=>['1205','am�lioration de la gestion des langues, elle n\'impacte plus la recherche par d�faut, mais propose d�sormais d\'afficher les traductions dans les tris.'],
"3"=>['1208','ajout du support de timecode dans le gestionnaire d\'import, url et lecture de youtube'],
"4"=>['1213','correctif gestion des images inimportables'],
"5"=>['1218','correctif ginit'],
"6"=>['1223','ajout du support de conversion des .webp vers .jpg  pourquoi ? parce que webp c\'est google donc c\'est niet.'],
"7"=>['1224','- ajout d\'une s�rie d\'inputs sp�cialis�s, r�fection des anciens
- usages de ces nouveaux inputs (recherche, date)
- r�forme de l\'�diteur de date de l\'article (le composant html qui affiche un calendrier remplace le composant manuscrit antique \'calendar\')'],
"8"=>['1227','R�forme critique du moteur ajax.
le troisi�me param des apps peut �tre, au choix, $res ou $prm.
- $res est issu de l\'ancien dispositif, et renvoie les captures depuis la position 9 du script. Il est r�dig� en pseudo-json.
- $prm est issu des captures du param 2, qui peuvent �tre multiples, s�par�es par une virgule.
L\'ancien dispositif p9 ne supporte plus le multithread. Le nouveau dispositif n\'a m�me pas besoin du multithread. Ce dispositif antique, nomm� AMT, est rendu obsol�te. Progressivement les captures vont �tre pass�es du p9 au p2 du protocole lj();
Les captures de p2 arrivent par un post, les autres params arrivent via get.
- l\'am�nagement antique qui consiste � d�caler les variables d\'arriv�e de un cran quand p2 �tait appel�, est r�volu (heureusement). Elles arrivent d�sormais par prm. Il est impossible qu\'une app puisse avoir besoin simultan�ment de prm et de res. Le tableau res est mis en obsolescence.
En r�sum�, p2 renvoie les captures via post dans prm, p3,p4 etc (� l\'infini) renvoient les variables via get.']];