<?php //msql/program_updates_2110
$r=["1"=>['1006','publication'],
"2"=>['1020','- ajout du support de rumble'],
"3"=>['1021','- fix conn edit video (comportement de extractid)
- fix refresh img rÃ©duite
- amÃ©lioration dÃ©tection des liens entourÃ©s de caractÃ¨res inattendus'],
"4"=>['1023','- l\'option panart de la commande panel du module articles peut recevoir des templates distincts'],
"5"=>['1027','- petite rÃ©novation de la console des modules : le dÃ©placement est logÃ© dans l\'Ã©diteur, fix pb refresh global, les app affichent leur nom
- dÃ©placement d\'une sÃ©rie de fonction de collection de hiÃ©rarchies dans son module associÃ© taxonav
- report du correctif Fractal de taxonomy()'],
"6"=>['1031','- et tout d\'un coup le truc a dÃ©cidÃ© de ne plus supporter les trop longs bouts sans sauts de lignes. Ajout de sauts de lignes dans l\'enregistrement des tables msql.
- (le serveur a marquÃ© toutes les pages comme modifiÃ©es Ã  distance, sÃ»rement une migration interne ; depuis le serveur a des lentouilles, dont la prÃ©cÃ©dente erreur)
- rÃ©paration de la capture de figures Ã  travers l\'usage de dd/dt
- rÃ©novation du nettoyeur de balises rejetÃ©es, rendu \"plus itÃ©ratif\"']];