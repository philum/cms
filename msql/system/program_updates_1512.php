<?php //msql/program_updates_1512
$r=["_menus_"=>['date','text'],
"1"=>['1202','publication'],
"2"=>['1203','- disjonction du titre depuis son param du module link (optique d\'Ã©claircissement des usage)
- ajout de la commande ajax pagup (full page)'],
"3"=>['1204','nouveau systÃ¨me de tags 1/3'],
"4"=>['1206','correctif gestionnaire restriction visibilitÃ© d\'articles'],
"5"=>['1210','les vidÃ©os ne seront plus lancÃ©es au chargement d\'une page (Ã§a devenait trop lourd) ; apparition d\'un lien pour joindre directement l\'url (par dÃ©faut la vidÃ©o s\'ouvre dans une popup)'],
"6"=>['1211','- ajout d\'un capteur de miniatures de vidÃ©os
- correctifs de modernisation'],
"7"=>['1213','- meilleur rÃ©sultat des recherches des tags (tri des abstractions)'],
"8"=>['1214','- ajout du plugin twit, vraie API twitter'],
"9"=>['1217','intÃ©gration de l\'Api twitter : 
- importation de twits via l\'interface
- dÃ©tection des @utilisateurs
- possibilitÃ© de remonter le fil de discussion
- ajout/reconformation des connecteurs :twitter, :twitter_cached, et :poptwit ; ils savent reconnaitre un utilisateur (renvoie fil des twits) ou un twit ciblÃ© par son id, potentiellement depuis son url.'],
"10"=>['1218','- dÃ©filement continu dans l\'Api twitter
- rÃ©duction du poids de la requÃªte sql des catÃ©gories d\'articles
- ajout d\'un gestionnaire connectÃ© Ã  l\'api pour tweeter des articles
- ajout d\'un gestionnaire des paramÃ¨tres de connexion Ã  l\'App Twitter crÃ©Ã©e par l\'utillisateur'],
"11"=>['1219','- ajout d\'une itÃ©ration sur l\'autocomplÃ©tion de tags (optimisation de la vitesse + recherche Ã©tendue dans le temps)'],
"12"=>['1220','- ajout d\'un 9iÃ¨me paramÃ¨tre au protocole ajax destinÃ© spÃ©cifiquement Ã  rÃ©troinjecter du javascript dans le header avant l\'arrivÃ©e des donnÃ©es : '],
"13"=>['1222','* 2 usages du 9iÃ¨me paramÃ¨tre ajax : 
- id : placer le js Ã  rÃ©cupÃ©rer dans un input hidden
- \'injectjs\' : rÃ©cupÃ¨re le code du plugin \'plug\' dans la fonction nommÃ©e \'plug\'_js();'],
"14"=>['1223','le connecteur :video peut recevoir des liens vers des mp4 (ogg, etc...) ; utile pour les vidÃ©os facebook, quand l\'extension est nooyÃ©e avant le paramÃ¨tre'],
"15"=>['1224','- correctif annulation enregistrement d\'articles ayant des titres trop longs
- correctif gestionnaire dÃ©tection de vidÃ©os (extensions ciblÃ©es)
- le navigateur timesystem affiche l\'annÃ©e au lieu du nombre d\'annÃ©es en arriÃ¨re'],
"16"=>['1229','instauration des nouveaux dispositifs de gestionnaire des tags (part 2/3) : nouvel Ã©diteur de tags'],
"17"=>['1231','- dÃ©roulÃ© des articles plus rapides car nbarts plus rapide + usage de assoc
- affichage d\'article confiÃ© Ã  l\'automate art_read_mecanics()'],
"18"=>['1231','nouveau gestionnaire de tags (part 3/3) : 
- gestionnaire de titres d\'articles ; les templates ne reÃ§oivent plus les utags (ils sont tous dans \"tags\")
- suppression des tags prÃ©parÃ©s dans une session
- gestionnaires des modules']];