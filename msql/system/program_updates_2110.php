<?php //philum/msql/program_updates_2110
$r=[1=>['1006','publication'],
2=>['1020','- ajout du support de rumble'],
3=>['1021','- fix conn edit video (comportement de extractid)
- fix refresh img r�duite
- am�lioration d�tection des liens entour�s de caract�res inattendus'],
4=>['1023','- l\'option panart de la commande panel du module articles peut recevoir des templates distincts'],
5=>['1027','- petite r�novation de la console des modules : le d�placement est log� dans l\'�diteur, fix pb refresh global, les app affichent leur nom
- d�placement d\'une s�rie de fonction de collection de hi�rarchies dans son module associ� taxonav
- report du correctif Fractal de taxonomy()'],
6=>['1031','- et tout d\'un coup le truc a d�cid� de ne plus supporter les trop longs bouts sans sauts de lignes. Ajout de sauts de lignes dans l\'enregistrement des tables msql.
- (le serveur a marqu� toutes les pages comme modifi�es � distance, s�rement une migration interne ; depuis le serveur a des lentouilles, dont la pr�c�dente erreur)
- r�paration de la capture de figures � travers l\'usage de dd/dt
- r�novation du nettoyeur de balises rejet�es, rendu \"plus it�ratif\"']];