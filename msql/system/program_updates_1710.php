<?php
//philum/microsql/program_updates_1710
$r["_menus_"]=['date','text'];
$r[1]=['1001','publication'];
$r[2]=['1004','fix pb affichage de vignettes dans desktop'];
$r[3]=['1007','- usage de /hub/ pour appeler un hub
- boutons de dev et de lang en ajax'];
$r[4]=['1012','- r�vision syst�me de passage en dev/lab/prod, pour affecter prog()'];
$r[5]=['1014','- ajout d\'un gestionnaire de d�placement de lignes dans l\'�diteur msql'];
$r[6]=['1015','- les modules faisant appel � l\'api n\'ont plus de syntaxe particuli�re, celle de l\'api marche (cela n\'avait pas �t� activ� pour une erreur inconnue)'];
$r[7]=['1015','- rstr104, utilise lowercase pour le titre'];
$r[8]=['1016','- ajout d\'un contr�le pour traiter les images zip�es par le serveur appel�'];
$r[9]=['1018','- ajout du dispositif \'grid\', permet d\'utiliser ce type de css dans les templates. avec rstr88 allum�, deux templates distincts sont utilis�s pour afficher le flux d\'articles et l\'article, alors que sinon, un troisi�me est utilis� pour les deux. Le premier utilise les grid.'];
$r[10]=['1019','- r�novation du cache des twits, qui enregistre 18 colonnes d\'infos � mettre en page au lieu d\'un bloc rendu, afin de faciliter le travail des traducteurs.'];
$r[11]=['1020','- fix pb temps de latence d� au cache des fichiers msql fra�chement enregistr�s (soulagement)
- ajout d\'une colonne del dans l\'admin msql qui apparait avec &del=='];
$r[12]=['1024','- r�novation du syst�me de mise en cache d\'infos avant la publication - tout contenu n\'est absorb� qu\'une seule fois'];
$r[13]=['1024','- r�novation de l\'�dition sur place des cellules d\'une table msql : multi-fen�tres, en mode bubble'];
$r[15]=['1025','- r�novation de l\'�dition msql, on peut �diter la clef, les fonctions sont rapatri�es sur msql (exit admin, plus rapide) et le dispositif utilisant les variables d\'url entre en obsolescence'];
$r[14]=['1026','- r�novation des fonctions input()'];
$r[16]=['1029','le symbole &#8617; (ascii 8617) devient <- apr�s un utf8_decode multibytes, et est confisqu� pour �viter une erreur dans l\'interpr�tateur'];
$r[17]=['1030','l\'admin msql est enti�rement rendue ajax ; tous les anciens dispositifs sont mis en obsolescence (disponibles, plus maintenus, et bient�t supprim�s)'];
$r[18]=['1031','l\'�diteur msql d\'entr�es est remani� pour pouvoir �tre appel� avec une clef inconnue, afin de rendre obsol�tes les fonctions associ�es � l\'ancienne m�thode'];

?>