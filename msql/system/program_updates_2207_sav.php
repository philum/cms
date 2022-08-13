<?php //msql/program_updates_2207_sav
$r=["_menus_"=>[''],
"1"=>['0715','ajout du post-traitement d\'importation \"png2jpg\", mais là pour l\'instant ça marche pas'],
"2"=>['0712','fix pb login'],
"3"=>['0714','fix pb attribution de \'iq d\'un ip qui a changé à iqa (prefs des cookies)'],
"4"=>['0714','fix suggest'],
"5"=>['0715','ajout du post-traitement d\'importation \"png2jpg\", mais là pour l\'instant ça marche pas'],
"6"=>['0725','- correctifs pour php8.1 : (erreur playlist_conn) ne vérifie pas $n>2 s\'il est égal à 3, inclue les strings dans les max(), rejette les strpos, substr, str_replace vides, etc...
- grosse rénovation de la conformité des colonnes, en vue d\'installer une machine qui valide les entrées.
- ajout de db, classe de validation des variables
- fix pb enregistrer une nouvelle entrée msql (ici), encore un pb de comparateur de valeurs (lettres prises comme des chiffres par php 8.1)'],
"7"=>['0725','- prise en charge de la mise en cache de la vignette dès l\'import (elle ne se faisait qu\'au moment de l\'édition des titres)'],
"8"=>['0727','- fix qq pb php8.1.8
- le bt preview devient un bt look dans les résultats d\'une recherche'],
"9"=>['0728','- début de l\'intégration du nouveau dispositif de vérification en amont de la validité des variables envoyées à mysql
- ajout de db::sav et db::savk pour des sav protégés
- rénovation de l\'importation d\'articles internes (réactualisation)'],
"10"=>['0729','- correctif comportement connbt dans codeline
- opnart obtient la capacité de discerner le contexte, revue ou recherche, pour afficher les résultats associés en preview ou en full'],
"11"=>['0730','- discernement de playc et playq, le second étant dédié aux captures et à la lecture des quotes
- afin de laisser la latitude à playc de gérer correctement les réponses contextualisées'],
"12"=>['0731','- fix pb discernement entre iq et uid, préalablement et anciennement nommé iq, le second servant de référence à l\'ip ; a causé des récurrences dans la question des préférences des cookies']];