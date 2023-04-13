<?php //msql/program_updates_1208
$r=["_menus_"=>['day','text'],
"1"=>['0807','- ajout des filtres de post-traitement \'delblocks\' et \'striplink\', et rÃ©paration du \'deltables\' ;
\'striplink\' est utilisÃ© dans le plugin \'xmlbook\', permet de sÃ©parer le texte de son lien en le mettant en dur entre parenthÃ¨ses Ã  cÃ´tÃ©.'],
"2"=>['0809','- on fait en sorte que la commande \'rebuild_img\' marche quand il s\'agit de reconstruire une miniature crÃ©Ã©e par le connecteur \':thumb\', c\'est Ã  dire pendant la lecture d\'un article ;'],
"3"=>['0815','le bouton \'popen\' (ouvre l\'article dans une popup) ne passe plus par une iframe, c\'est beaucoup plus rapide ;'],
"4"=>['0820','amÃ©lioration de l\'interprÃ©tation pour l\'importation : ignorer les sauts de lignes au milieu des balises, qui rendaient impossible leur localisation ;'],
"5"=>['0822','amÃ©lioration substantielle de l\'interprÃ©tation pour l\'importation : 
- dans les dÃ©finitions d\'importation de sites, indiquer \'auto\' ou aucune information en output fait que le logiciel recherche lui-mÃªme la fin logique de la balise indiquÃ©e en entrÃ©e (input) ;
(donc en terme gÃ©nÃ©ral il n\'y a plus besoin d\'indiquer le output) ;
- certains blocages apparus rÃ©cemment avec les nouvelles versions de firefox ont Ã©tÃ© rÃ©solus en retirant des procÃ©dures obsolÃ¨tes ;
- on empÃªche l\'interprÃ©tateur de se tromper de site, quand le nom d\'un autre site se trouvait dans l\'url (il faut le faire quand mÃªme) ;'],
"6"=>['0827','les popups sont dÃ©plaÃ§ables'],
"7"=>['0830','- usage des termes \'appliquer\' et \'enregistrer\' au lieu de \'sauver\' et \'sauver/fermer\'\' ;
- rÃ©paration champ temporel infini impromptu ;
- petites amÃ©liorations css (relookage de la rentrÃ©e) ;']];