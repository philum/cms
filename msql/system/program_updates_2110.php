<?php //philum/msql/program_updates_2110
$r=[1=>['1006','publication'],
2=>['1020','- ajout du support de rumble'],
3=>['1021','- fix conn edit video (comportement de extractid)
- fix refresh img réduite
- amélioration détection des liens entourés de caractères inattendus'],
4=>['1023','- l\'option panart de la commande panel du module articles peut recevoir des templates distincts'],
5=>['1027','- petite rénovation de la console des modules : le déplacement est logé dans l\'éditeur, fix pb refresh global, les app affichent leur nom
- déplacement d\'une série de fonction de collection de hiérarchies dans son module associé taxonav
- report du correctif Fractal de taxonomy()'],
6=>['1031','- et tout d\'un coup le truc a décidé de ne plus supporter les trop longs bouts sans sauts de lignes. Ajout de sauts de lignes dans l\'enregistrement des tables msql.
- (le serveur a marqué toutes les pages comme modifiées à distance, sûrement une migration interne ; depuis le serveur a des lentouilles, dont la précédente erreur)
- réparation de la capture de figures à travers l\'usage de dd/dt
- rénovation du nettoyeur de balises rejetées, rendu \"plus itératif\"']];