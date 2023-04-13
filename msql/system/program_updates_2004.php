<?php //msql/program_updates_2004
$r=["1"=>['0402','publication'],
"2"=>['0403','les traductions disponibles sont rendues visibles d\'office, plutÃ´t que de n\'Ãªtre sollicitÃ©es que par le contexte de la langue utilisateur'],
"3"=>['0404','rÃ©forme graduelle de msql, pour distinguer les appels entre :
::read (tout, opt menu et row), array 2D
::arr (opt menu et o=colonne), array 1D verticale
::row (opt combine), array 1D horizontale
::val, string'],
"4"=>['0405','rÃ©forme graduelle de msql, phase 2/3 :
- entonnoir de modif_vars vers msql::modif (env. 70 occurrences)
- alignement fonctionnel de msql::modif
- suppression de modif_vars, msql_modif, msql_modif_vars, msq_dump (vers msql::dump), et les trÃ¨s antiques read_vars et save_vars.
pas de push avant plus de dÃ©bug'],
"5"=>['04010','- version 18 de la picto philum, 370 glyphes, classÃ©s par familles'],
"6"=>['04011','- version 18.1 de la picto philum, 388 glyphes'],
"7"=>['04012','- correctif fonctionnement de l\'app wiki, rattachÃ©e au nouveau process de sÃ©lection via le dom (n\'est plus indÃ©pendant des defcons)
- petite rÃ©novation de la gestion des ancres, dÃ©tection d\'ancres qui font comme nous (intÃ©gration de contenu), amÃ©lioration de la mise en forme
- rÃ©novation de l\'app xss, qui donne la liste des articles d\'une page d\'accueil'],
"8"=>['04013','- correctif import rss
- quelques pictos en plus ou remplacÃ©s
- correctif app wiki
- amÃ©lioration substantielle du fonctionnement du sÃ©lecteur de mode de tri des commentaires, selon l\'ordre des articles ou des commentaire. Plus rapide. Petit moteur de recherche en dev.
- amÃ©lioration description d\'article via delconn()'],
"9"=>['04014','- amÃ©lioration de la suppression d\'images, qui affecte le champ catalogue, en plus de la liste des images, de sorte Ã  pouvoir d\'enregistrer les mÃ©tas, afin de voir apparaÃ®tre le changement sur la page
- version 18.2 des pictos : 600 glyphes'],
"10"=>['04015','- rÃ©paration absence de protect_url() des catÃ©gories
- rÃ©paration du module gallery, qui en avait bien besoin ; remplacÃ© par img_playlist, mais toujours utile quand mÃªme'],
"11"=>['04018','- modif mode d\'affichage de la description des vidÃ©os
- rÃ©paration de match_vdir(), qui trie les apps par rÃ©pertoire, et laissait passer une exception (terme rÃ©current dans les itÃ©rations).'],
"12"=>['04019','- pictos version 18.3, ajouts et modifs'],
"13"=>['04024','- dÃ©localisation des codes cryptÃ©s de transport'],
"14"=>['04025','- ajout de subtostr() dans la lib'],
"15"=>['04026','- amÃ©nagements pour recevoir catid
- rstr123, active catid'],
"16"=>['04027','- ajout de l\'outil dump2array dans txt
- rstr124 : special for dev
- ajout module most_polled, renvoie un tri en fonction du nombre de \'fav\', \'like\', \'poll\', \'mood\') affectÃ©s Ã  un article (sans Ã©valuer la qualitÃ©, juste le nombre), depuis qdf'],
"17"=>['04028','- ajout du module catj, permet de naviguer rapidement entre les catÃ©gories
- ajout de quelques pictos dans la font philum'],
"18"=>['04029','- ajout sqlsavup() et sqlup2()
- ajout du module score_datas, renvoie un tri en fonction des scores affectÃ©s Ã  un article depuis d\'autres processus (valeurs simples dans qdd)
- ajout du module special_poll, permet de faire des votes par jugement spÃ©cialisÃ©s
- ajout du module quality_stats, permet de combiner des votes pour renvoyer une note globale (dev)
- amÃ©lioration du comportement de poll et de mood'],
"19"=>['04030','- prmb8 (config) : logo d\'aprÃ¨s un picto
- ajout du gestionnaire \'poll\' dans l\'api, permet de trier les rÃ©sultats selon les diffÃ©rentes sortes de votes d\'articles
- ajout de l\'app score, permet de juguler un tri selon diffÃ©rents paramÃ¨tres mÃ©diamÃ©triques']];