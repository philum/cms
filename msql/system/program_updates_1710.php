<?php //msql/program_updates_1710
$r=["_menus_"=>['date','text'],
"1"=>['1001','publication'],
"2"=>['1004','fix pb affichage de vignettes dans desktop'],
"3"=>['1007','- usage de /hub/ pour appeler un hub
- boutons de dev et de lang en ajax'],
"4"=>['1012','- rÃ©vision systÃ¨me de passage en dev/lab/prod, pour affecter prog()'],
"5"=>['1014','- ajout d\'un gestionnaire de dÃ©placement de lignes dans l\'Ã©diteur msql'],
"6"=>['1015','- les modules faisant appel Ã  l\'api n\'ont plus de syntaxe particuliÃ¨re, celle de l\'api marche (cela n\'avait pas Ã©tÃ© activÃ© pour une erreur inconnue)'],
"7"=>['1015','- rstr104, utilise lowercase pour le titre'],
"8"=>['1016','- ajout d\'un contrÃ´le pour traiter les images zipÃ©es par le serveur appelÃ©'],
"9"=>['1018','- ajout du dispositif \'grid\', permet d\'utiliser ce type de css dans les templates. avec rstr88 allumÃ©, deux templates distincts sont utilisÃ©s pour afficher le flux d\'articles et l\'article, alors que sinon, un troisiÃ¨me est utilisÃ© pour les deux. Le premier utilise les grid.'],
"10"=>['1019','- rÃ©novation du cache des twits, qui enregistre 18 colonnes d\'infos Ã  mettre en page au lieu d\'un bloc rendu, afin de faciliter le travail des traducteurs.'],
"11"=>['1020','- fix pb temps de latence dÃ» au cache des fichiers msql fraÃ®chement enregistrÃ©s (soulagement)
- ajout d\'une colonne del dans l\'admin msql qui apparait avec &del=='],
"12"=>['1024','- rÃ©novation du systÃ¨me de mise en cache d\'infos avant la publication - tout contenu n\'est absorbÃ© qu\'une seule fois'],
"13"=>['1024','- rÃ©novation de l\'Ã©dition sur place des cellules d\'une table msql : multi-fenÃªtres, en mode bubble'],
"15"=>['1025','- rÃ©novation de l\'Ã©dition msql, on peut Ã©diter la clef, les fonctions sont rapatriÃ©es sur msql (exit admin, plus rapide) et le dispositif utilisant les variables d\'url entre en obsolescence'],
"14"=>['1026','- rÃ©novation des fonctions input()'],
"16"=>['1029','le symbole &#8617; (ascii 8617) devient <- aprÃ¨s un utf8_decode multibytes, et est confisquÃ© pour Ã©viter une erreur dans l\'interprÃ©tateur'],
"17"=>['1030','l\'admin msql est entiÃ¨rement rendue ajax ; tous les anciens dispositifs sont mis en obsolescence (disponibles, plus maintenus, et bientÃ´t supprimÃ©s)'],
"18"=>['1031','l\'Ã©diteur msql d\'entrÃ©es est remaniÃ© pour pouvoir Ãªtre appelÃ© avec une clef inconnue, afin de rendre obsolÃ¨tes les fonctions associÃ©es Ã  l\'ancienne mÃ©thode']];