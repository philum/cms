<?php //msql/program_updates_2207_sav
$r=["_menus_"=>[''],
"1"=>['0715','ajout du post-traitement d\'importation \"png2jpg\", mais l� pour l\'instant �a marche pas'],
"2"=>['0712','fix pb login'],
"3"=>['0714','fix pb attribution de \'iq d\'un ip qui a chang� � iqa (prefs des cookies)'],
"4"=>['0714','fix suggest'],
"5"=>['0715','ajout du post-traitement d\'importation \"png2jpg\", mais l� pour l\'instant �a marche pas'],
"6"=>['0725','- correctifs pour php8.1 : (erreur playlist_conn) ne v�rifie pas $n>2 s\'il est �gal � 3, inclue les strings dans les max(), rejette les strpos, substr, str_replace vides, etc...
- grosse r�novation de la conformit� des colonnes, en vue d\'installer une machine qui valide les entr�es.
- ajout de db, classe de validation des variables
- fix pb enregistrer une nouvelle entr�e msql (ici), encore un pb de comparateur de valeurs (lettres prises comme des chiffres par php 8.1)'],
"7"=>['0725','- prise en charge de la mise en cache de la vignette d�s l\'import (elle ne se faisait qu\'au moment de l\'�dition des titres)'],
"8"=>['0727','- fix qq pb php8.1.8
- le bt preview devient un bt look dans les r�sultats d\'une recherche'],
"9"=>['0728','- d�but de l\'int�gration du nouveau dispositif de v�rification en amont de la validit� des variables envoy�es � mysql
- ajout de db::sav et db::savk pour des sav prot�g�s
- r�novation de l\'importation d\'articles internes (r�actualisation)'],
"10"=>['0729','- correctif comportement connbt dans codeline
- opnart obtient la capacit� de discerner le contexte, revue ou recherche, pour afficher les r�sultats associ�s en preview ou en full'],
"11"=>['0730','- discernement de playc et playq, le second �tant d�di� aux captures et � la lecture des quotes
- afin de laisser la latitude � playc de g�rer correctement les r�ponses contextualis�es'],
"12"=>['0731','- fix pb discernement entre iq et uid, pr�alablement et anciennement nomm� iq, le second servant de r�f�rence � l\'ip ; a caus� des r�currences dans la question des pr�f�rences des cookies']];