<?php //msql/program_updates_2105
$r=["1"=>['0501','publication'],
"2"=>['0501','- correctif ra2deg dans maths
- amÃ©lioration starmap4, prend en charge les donnÃ©es ajoutÃ©es Ã  la main dans exo_4'],
"3"=>['0502','- amÃ©lioration de l\'app graph (fractal) pour atomiser le code et permettre de produire des graphiques Ã  Ã©chelles multiples
- amÃ©lioration de starmap4 et 5, sÃ©paration des sources, agencement des titres pour Ã©viter les chevauchements'],
"4"=>['0503','- rÃ©fection de l\'app mÃ©tÃ©o, victime d\'attaques : ajout d\'un systÃ¨me de cache au niveau du client, amÃ©lioration du cache 2 au niveau serveur, et de la gestion des donnÃ©es nulles de l\'api (la nuit,qui, combinÃ© Ã  l\'attaque, a ouvert une brÃ¨che)'],
"5"=>['0504','- amÃ©liorations de svg (bÃ©zier, animations, textpath), ajout d\'exemples, suppression du besoin d\'utiliser des tirets pour simuler les espaces, qui peuvent servir aux valeurs nÃ©gatives
- transposition de starmap sur fractal'],
"6"=>['0505','- amÃ©liorations de star, support des recherches par approximations en diffÃ©rentes unitÃ©s (h, m, d, rad, mas), recherches autour d\'une Ã©toile, changement du protocole par dÃ©faut (ra en heures), gestion interne en degrÃ©s + cosmÃ©tiques'],
"7"=>['0506','- finalisation de starvue, permet de zoomer sur la carte des Ã©toiles
- ajout de starsky, fait des fonds d\'Ã©cran :)
- ajout du support d\'images dans svg'],
"8"=>['0507','- ajout de la dÃ©clinaison du soleil et du plan galactique dans starmap (faut bien rigoler un peu)
- ajout des supports de polyline, path et des transparences dans svg'],
"9"=>['0508','- correctif de corrfast dans codeline pour Ã©viter la confusion de paramÃ¨tres dans les inclusions des connecteurs qui veulent Ãªtre filtrÃ©s par ce dispositif'],
"10"=>['0509','- ajout de bubjs, une simple bubble en js qui est aussi intÃ©grÃ©e au frameork svg sous le connecteur :bub'],
"11"=>['0510','- correctif erreur d\'affichage des tags dans la reconnaissance des tags connus (words)'],
"12"=>['0514','- correctifs html_entity_decode_b() et utf8_decode_a() pour venir au secours de metas() dans le context farfelu de youtube'],
"13"=>['0515','- amÃ©liorations de starmap2, peut afficher les Ã©toiles hors-cadre, peut effectuer une rotation du plan Ã©quatorial'],
"14"=>['0521','- correctif readgz'],
"15"=>['0522','- ajout support twapi dans codeline
- correctif enregistrement des images tw
- fix pbrÃ©cursions impromptues (dues au twit lui-mÃªme citÃ© en retwteet)
- ajout de drapeaux ascii pour les traductions d\'articles'],
"16"=>['0522','- abandon du jeu de drapeaux en gif pour celui donnÃ© par un jeu de ascii (ajout de system/edition_flags_8)'],
"17"=>['0524','- codeline accepte :code
- fix :divtable
- :table peut recevoir Â§esc pour Ã©chapper les Â¬ qui veulent Ãªtre rendus visibles (et se passer de :divtable)']];