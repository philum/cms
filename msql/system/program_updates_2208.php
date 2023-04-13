<?php //msql/program_updates_2208
$r=["_menus_"=>['date','text'],
"1"=>['0801','publication'],
"2"=>['0801','- fix digger \'all\' (php8.1.8 estime les strings comme des nombres infinis)
- fix notices lors de l\'usage du desktop
- fix ordre de lancement des dÃ©finitions du boot, correction du pb de l\'autolog tardif'],
"3"=>['0808','- correctif non-import des images b64 en mode lecture'],
"4"=>['0811','- correctifs php 8.1.8'],
"5"=>['0814','- :mp4 renvoie le lecteur brut, lÃ  oÃ¹ .mp4 aspire le contenu
- fix massif de environ 284 fichiers et 90% des fichiers sys, des erreurs potentielles de php8.1.8, sur des fonctions qui n\'ont pas Ã©tÃ© utilisÃ©es depuis'],
"6"=>['0816','- rÃ©paration de l\'Ã©diteur de comline, utilisÃ© par les submodules (dont MenusJ, qui va plus tarder Ã  Ãªtre refondu)
- les connecteurs :mp4, :mp3 et :jpg permettent de garder leurs contenus externes, au lieu d\'aspirer les donnÃ©es.'],
"7"=>['0818','- ajout de la compÃ©tence dataviz, cherche toutes les relations d\'un article par extension (parentes, enfants, articles liÃ©s) et produit un jeu de donnÃ©es pour gephy'],
"8"=>['0822','- le module menusJ peutÃªtre positionnÃ© n\'importe oÃ¹ sur la page, le rendu se fera dÃ©sormais dans le module LOAD'],
"9"=>['0824','- la fonction night(), qui faisait appel Ã  une base de donnÃ©e des levers et couchers de soleil, est remplacÃ©e par la nouvelle fonction php date_sun_info(). Secondairement, la gÃ©olocalisation qui lui est nÃ©cessaire peut Ãªtre Ã©tablie par l\'api mÃ©tÃ©o.'],
"10"=>['0825','- rÃ©forme de la faÃ§on de se connecter Ã  mysql, sans passer par une session'],
"11"=>['0826','- rÃ©vision d\'une foultitude de plugins antiques, tris, correctifs, trash.
- l\'objet sql se destine Ã  collecter les fonctions sql
- l\'antique installateur est dÃ©branchÃ©
(rÃ©formes de prÃ©-refonte magistrale)'],
"12"=>['0827','- renomm make_
- rÃ©pare \'local\' dans transport
- Ã©tablit rÃ©novation de l\'admin en forme de player d\'udb ; bcp de vieilleries Ã  Ã©radiquer'],
"13"=>['0831','- la commande vrf est ajoutÃ©e Ã  sqlsav et sqlup : permet de valider en amont la correspondance des entrÃ©es avec les formats de colonnes
- mise en conformitÃ© de sqlup avec fractal
- mise en conformitÃ© de sqldel avec fractal
- mise en conformitÃ© de sql_inner avec fractal
- dÃ©placement des objets sql dans leur classe dÃ©diÃ©e (inusitÃ©s)
- remplacement des fonction antiques insert, update, delete par leur nouveaux Ã©quivalents conformes (meilleure sÃ©curitÃ©)']];