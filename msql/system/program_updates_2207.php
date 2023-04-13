<?php //msql/program_updates_2207
$r=["_menus_"=>[''],
"1"=>['0715','ajout du post-traitement d\'importation \"png2jpg\", mais lÃ  pour l\'instant Ã§a marche pas'],
"2"=>['0712','fix pb login'],
"3"=>['0714','fix pb attribution de \'iq d\'un ip qui a changÃ© Ã  iqa (prefs des cookies)'],
"4"=>['0714','fix suggest'],
"5"=>['0715','ajout du post-traitement d\'importation \"png2jpg\", mais lÃ  pour l\'instant Ã§a marche pas'],
"6"=>['0725','- correctifs pour php8.1 : (erreur playlist_conn) ne vÃ©rifie pas $n>2 s\'il est Ã©gal Ã  3, inclue les strings dans les max(), rejette les strpos, substr, str_replace vides, etc...
- grosse rÃ©novation de la conformitÃ© des colonnes, en vue d\'installer une machine qui valide les entrÃ©es.
- ajout de db, classe de validation des variables
- fix pb enregistrer une nouvelle entrÃ©e msql (ici), encore un pb de comparateur de valeurs (lettres prises comme des chiffres par php 8.1)'],
"7"=>['0725','- prise en charge de la mise en cache de la vignette dÃ¨s l\'import (elle ne se faisait qu\'au moment de l\'Ã©dition des titres)'],
"8"=>['0727','- fix qq pb php8.1.8
- le bt preview devient un bt look dans les rÃ©sultats d\'une recherche'],
"9"=>['0728','- dÃ©but de l\'intÃ©gration du nouveau dispositif de vÃ©rification en amont de la validitÃ© des variables envoyÃ©es Ã  mysql
- ajout de db::sav et db::savk pour des sav protÃ©gÃ©s
- rÃ©novation de l\'importation d\'articles internes (rÃ©actualisation)'],
"10"=>['0729','- correctif comportement connbt dans codeline
- opnart obtient la capacitÃ© de discerner le contexte, revue ou recherche, pour afficher les rÃ©sultats associÃ©s en preview ou en full'],
"11"=>['0730','- discernement de playc et playq, le second Ã©tant dÃ©diÃ© aux captures et Ã  la lecture des quotes
- afin de laisser la latitude Ã  playc de gÃ©rer correctement les rÃ©ponses contextualisÃ©es'],
"12"=>['0731','- fix pb discernement entre iq et uid, prÃ©alablement et anciennement nommÃ© iq, le second servant de rÃ©fÃ©rence Ã  l\'ip ; a causÃ© des rÃ©currences dans la question des prÃ©fÃ©rences des cookies']];