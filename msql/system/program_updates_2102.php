<?php //msql/program_updates_2102
$r=["1"=>['0202','publication'],
"2"=>['0202','fix :msql'],
"3"=>['0204','- :mp3 et :audio backup les fichiers comme :mp4 et :vid
- rÃ©paration de la captation des titres des vidÃ©os yt, extrapolÃ©e rÃ©troactivement par automatisme (abandon de la spÃ©cificitÃ© yt dans web::metas)'],
"4"=>['0207','- les articles de niveau 4 sont Ã©galement publiÃ©s sur l\'api tlex en mÃªme temps que la twitletter (ligne 1 de la table tlex)- l\'api tlex est dÃ©placÃ©e temporairement de telex.ovh vers logic.ovh le temps de la rÃ©forme gÃ©nÃ©rale du logiciel Fractal'],
"5"=>['0210','- correctif on laisse passer la balise noscript et ajout de capteurs pour les images dans les a sans contenu (cas des noscript) (ce qui est contradictoire mais bon)'],
"7"=>['0215','- ajout de clean_punct2, spÃ©cialisÃ© dans la correction des mauvais quotes, dÃ©tachÃ© de clean_punct pour ne pas nuire aux textes qui les utilisent comme guillemets'],
"6"=>['0216','- correctif dÃ©filement continu des streams des twits
- amÃ©lioration de jsonam
- ajout d\'un sniffer json pour surveiller les transactions de l\'api twitter
- blocage des requÃªtes de l\'api twitter depuis des crawlers
- et ajout de rÃ©fÃ©rences anti-crawlers (bataille de crawlers ! ouf !)'],
"8"=>['0217','- fix crash server provoquÃ© par les images protÃ©gÃ©e par un firewall (cadtm.org), auxquelles s\'appliquent connecteur :jpg (non-aspiration)'],
"9"=>['0221','- ajout d\'un pont pour utiliser un autre serveur pour rÃ©cupÃ©rer les infos de youtube quand il se met Ã  refuser les connections surabondantes...'],
"10"=>['0222','- ajout de la rstr 132 videoplayer, force Ã  lire les vidÃ©os directement dans l\'article plutÃ´t que d\'appeler le systÃ¨me ajax qui est souvent bloquÃ© par google quand il cherche des donnÃ©es sur la vidÃ©o
- ajout de la rstr 133 pour rendre dÃ©sactivable la recherche de donnÃ©es sur la vidÃ©o via l\'api permettant de faire faire cette opÃ©ration par un autre serveur, pas encore bloquÃ© par google
- ajout d\'un snifer json pour suivre les appels aux vidÃ©os'],
"11"=>['0223','- petite rÃ©fection de transport
- ajout de composants de transport
- ajout du mode json de transport (ne marche pas)'],
"12"=>['0224','- correctifs et rÃ©novation de web::metas agissant sur twits::, rÃ©solution de boucle infinie entre metas et vacuum
- confiscation de la spÃ©cificitÃ© youtube dans metas::
- rÃ©solution de conflits d\'encodage dans vacuum, usant 3 techniques distinctes de parcours du dom
- amÃ©lioration de utmsrc, quand fb place sa variable d\'url au milieu des urls des autres'],
"13"=>['0224','- fix les infos redondantes envoyÃ©es par l\'api twitter depuis hier (dÃ©jÃ  qu\'elle est tj limitÃ©e Ã  140 caractÃ¨res, qu\'il faut passer par un oembed, qui n\'est pas accessible pour les comptes privÃ©s, en plus ils y remettent le nom et la date dans le message. C\'est vraiment n\'importe quoi l\'api tw)'],
"14"=>['0226','- ajout de compÃ©tence du gestionnaire post-traitement d\'images trop lourdes : choix des rÃ©ductions (50% ou limitÃ© en w/h), et rÃ©habilitation de l\'image d\'origine
- rÃ©forme cache_value, qui informe le cache en dur en plus de la session courante'],
"15"=>['0227','- rÃ©forme d\'un des nombreux miniaturiseurs, make_mini_b(), issu du connecteur :mini, pour qu\'il se conforme Ã  img::reduce, avec la nouvelle capacitÃ© Ã  faire des vignettes proportionnelles Ã  h/l limitÃ©e.
- ajout de dÃ©finitions au filtre anti-Ã©criture-inclusive, parce qu\'en plus il y en a de diffÃ©rentes sortes (quelle bande de guedins)'],
"16"=>['0227','- condamnation de tout l\'arsenal liÃ© au dÃ©funt flash, swf, flv, dÃ©tections, importations, mises en forme, etc
- rÃ©forme du nom des miniatures spÃ©ciales (type xsmall)
- rÃ©forme des connecteurs liÃ©s aux galeries d\'images : :photo debient :photos, :slider disparait (il Ã©tait en flash), :sliderJ est mis au banc, :slide aussi, :gallery est rÃ©novÃ©, :photo2 devient :slider (nouveau). Les trois fonctionnels (photos, gallery et slider) ont la mÃªme source de donnÃ©es (catalogue d\'images de l\'article, images sÃ©parÃ©es par un espace, ou rÃ©pertoire utilisateur).']];