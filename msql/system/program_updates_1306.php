<?php //msql/program_updates_1306
$r=["_menus_"=>['day','text'],
"1"=>['0601','nouveau menu ajax dans l\'admin msql'],
"2"=>['0602','suppression d\'un archaÃ¯sme (artefact) qui freinait les requÃªtes Sql (identification du propriÃ©taire d\'un hub anciennement logÃ©e dans la table des articles) : ajout du patch \'patch_userart\' (130602) - il est un peu violent'],
"3"=>['0603','rstr 72 : ajout d\'un systÃ¨me de mise en cache html des articles : les pages s\'affichent en 0.046s'],
"4"=>['0604','correctif \'last_art\' capable d\'enquÃªter pour trouver un paramÃ¨tre occasionnellement non fourni (influe grandement sur les performances du boot)'],
"5"=>['0609','rÃ©novation de l\'installateur : typos, dossiers, htaccess, css par dÃ©faut...
ajout du fichier vps.txt dÃ©crivant toute la dÃ©marche pour installer philum dans un VPS (svp en franÃ§ais...)'],
"6"=>['0612','rÃ©habilitation du plugin \'migration\' qui transporte les dossiers img, users, et msql d\'un serveur Ã  l\'autre'],
"7"=>['0613','rÃ©ctification des champs temporel (time system), espacÃ©s de 1 an (au lieu d\'une progression exponentielle, qui causait des remous lors des recherches portant sur 4 ans...)'],
"8"=>['0615','- rÃ©novation du systÃ¨me de cache du flux rss
- rÃ©paration de la gestion des sous-domaines du systÃ¨me de boot'],
"9"=>['0618','- confiscation d\'un acien protocole devenu obsolÃ¨te dans les plugins (le get \'plug\'=1)
- petite rÃ©paration des stats d\'articles (image qui bypasse le cache)'],
"10"=>['0619','encore un correctif de la gestion des sous-domaines, dans le cas particulier oÃ¹ ils ne sont pas utilisÃ©s...']];