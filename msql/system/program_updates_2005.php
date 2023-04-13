<?php //msql/program_updates_2005
$r=["1"=>['0501','publication'],
"4"=>['0502','introduction de l\'app score, permet de crÃ©er des classements Ã  partir de paramÃ¨tres multiples, telles que les apprÃ©ciations (like, poll, agree), les rÃ©actions (trkagree), le nombre et la portÃ©e des tags.'],
"2"=>['0503','- ajout de rstr125 agree, approbation (+ ou -) d\'un article
- ajout de rstr126 trkagree, approbation des commentaires
- rÃ©vision du transport de paramÃ¨tre via un dataset lors d\'un dÃ©roulÃ© continu ; permet de conserver une propriÃ©tÃ© de lecture des articles- rÃ©habilitation de agree, qui fut transformÃ© en poll (par jugement), permet un like/dislike simple'],
"3"=>['0504','- ajout d\'un gestionnaire read/write csv
- rÃ©fome de mood, utilise des asci plutÃ´t que les pictos'],
"5"=>['0505','- ajout de l\'app clusters (et de la table associÃ©e), permet de centraliser les tags autour de thÃ¨mes communs, afin d\'Ãªtre utilisÃ©s dans une recherche sÃ©mantique ; il faut se taper le remplissage manuel de la base Ã  partir des tags existants dans /app/clusters, et donner des noms thÃ©matiques Ã  des sÃ©ries de tags.'],
"6"=>['0506','- ajout de la rstr122 autonight : passe le design en mode nuit aux heures nocturnes
- ajout de la rstr127 tags-clusters : ajoute un bouton vers le module cluster_tags
- ajout du module cluster_tags : recherche d\'articles similaires via les clusters'],
"7"=>['0507','- ajout du module same_tags : recherche d\'articles ayant des tags similaires (remplace cluster_tags, dans la rstr127)'],
"8"=>['0526','- on a calÃ© le temps de lecture d\'un article sur le mÃªme que Medium.com, 2000 signes par minute, au lieu de 1300.'],
"9"=>['0529','- implÃ©mentation du gestionnaire d\'autorisation d\'envoyer des cookies, en respect de la loi made in fr.- - ajout de la table pub_iq (qdk) gestionnaire des prÃ©fÃ©rences sur les cookies
- patch pub_iq']];