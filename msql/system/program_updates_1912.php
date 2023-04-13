<?php //msql/program_updates_1912
$r=["1"=>['1201','publication'],
"2"=>['1201','- remplacement des fonctions str_extract, strchr_b, strrchr_b, substrpos, substrrpos (redondantes et peu lisibles) par strdeb et strend, puis ajout de struntil et strfrom'],
"3"=>['1202','- ajout du plug crypt, permet de crypter et dÃ©crypter des messages'],
"4"=>['1203','- amÃ©lioration de vitesse du Desktop, qui peut faire des tris prÃ©liminaires quand des indications le permettent
- img_art est capable de rÃ©cupÃ©rer des images sur le serveur miroir'],
"5"=>['1206','- l\'interprÃ©teur renvoie un mode de sÃ©paration des lignes de liste diffÃ©rent selon qu\'il y a des sauts de lignes ou pas (mode simplifiÃ© auto)
- le bouton d\'Ã©dition \'img\' renvoie \'figure\" quand un commentaire est associÃ© Ã  l\'image'],
"6"=>['1208','- ajout de la variable \'avoid\' dans l\'Api, permet d\'exclure un terme dans une recherche (Ã©viter)'],
"7"=>['1209','- correctif d\'une colonne dans la table des twits et ajout d\'un patch pour corriger le tir
- ajout des mentions des twits'],
"8"=>['1212','- remise Ã  niveau du plug txt'],
"9"=>['1217','- ajout de la rstr118 et du bouton share-api, permet de partager un article au format Api. Fait suite Ã  l\'intÃ©gration de \'web share api\' par le W3C, ce jour-mÃªme. https://www.w3.org/TR/2019/WD-web-share-20191217/'],
"10"=>['1217','- correctif capacitÃ© Ã  dÃ©tecter les ancres dans les liens polluÃ©s par les variables fbclid (de facebook)'],
"11"=>['1218','- le module folders permet dÃ©sormais de spÃ©cifier l\'Ã©tendue temporelle des dossiers d\'articles'],
"12"=>['1222','- le dÃ©tecteur de tags prÃ©sente le nombre d\'occurrences ; zÃ©ro occurrence signifie que le terme est partiel ou non prÃ©cÃ©dÃ© d\'un espace ; aucune mention signifie qu\'il est mÃ©connaissable.'],
"13"=>['1223','- correcteur automatique anti Ã©criture inclusive'],
"14"=>['1224','- amÃ©lioration du comptage d\'occurrences de tags, en prenant en compte la ponctuation de contexte.
- amÃ©lioration du fonctionnement de l\'option de recherche \'mot seul\', qui utilise regexp'],
"15"=>['1224','- prÃ©paration en vue de l\'utilisation de l\'index fulltext (amÃ©lioration substantielle des recherches)'],
"16"=>['1225','- ajout du support du mode de distinction du type de recherche dans la page via l\'url look/ ou find/ (mise Ã  jour du htaccess)
- amÃ©lioration de la mÃ©canique du score de nombre d\'occurrences en mode mot seul
- ajout des variables d\'Api whole_search (permet une recherche en mode mot seul), et fullsearch, engage une procÃ©dure sur l\'index fulltext (s\'il est activÃ©)'],
"17"=>['1226','- rectif de ljb() (peut engendrer des erreurs)
- peaufinage lisibilitÃ© de l\'api
- ajout de l\'extension d\'enquÃªte de rÃ©fÃ©rence dans une autre langue d\'un article par sauts consÃ©cutifs entre versions de diffÃ©rentes langues (par exploration itÃ©rative)'],
"18"=>['1227','- la dÃ©tection des tags de l\'article se rallie au nouveau procÃ©dÃ© de dÃ©tection detect_words()
- amÃ©lioration du nettoyeur specialspace()'],
"19"=>['1230','- rÃ©paration dÃ©tection vignette dailymotion']];