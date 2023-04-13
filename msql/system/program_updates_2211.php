<?php //msql/program_updates_2211
$r=["_menus_"=>['date','text'],
"1"=>['1101','publication'],
"2"=>['1101','- rÃ©fection de tracks : on peut envoyer l\'Ã©diteur dans une colonne fixe pour continuer Ã  prendre des notes pendant la lecture de l\'article. Cela invoque les nouveaux indicateurs xk et 14xk, qui sont dÃ©diÃ©s Ã  l\'utilisation du nouveau contenant \"trkdsk\". Il avait dÃ©jÃ  Ã©tÃ© prÃ©mÃ©ditÃ© pour y faire apparaÃ®tre les notes de bas de page Ã  cÃ´tÃ© du texte.
- extension de la compÃ©tence de la navigation par Ã©tats, Ã  /art*, /cat, /search, et en principe /n. On supprime le service des diez (cibler l\'article parmi ses frÃ¨res), pas souvent  fonctionnel, mais qui complique trop la mÃ©canique. Seul /look reste encore Ã  tester, puisqu\'il utilise les diez.
- todo : fix Ã©tablissement du contexte lors d\'un appel direct. En principe, dÃ©sormais, les pages s\'affichent toujours dans un contexte.
- (*) /art est utilisÃ© en plus de /read (implicite) pour cibler un article depuis son url longue'],
"3"=>['1103','- confiscation de rstr9 : images flottantes, Ã§a sert Ã  rien, on fait en sorte que la position de l\'image soit rÃ©gie par le fait d\'Ãªtre seule ou non sur une ligne.'],
"4"=>['1104','- annulation du chantier qui consiste Ã  avoir un systÃ¨me de routes, laissant un faille Ã  la forme brute du cms, alors que le but des rÃ©novations est d\'en faire un bundle. (todo later)
- connecteur :aud devient :audio, ne capture pas le contenu.'],
"5"=>['1107','- fix inputj() qui s\'amusait Ã  lancer une requÃªte Ã  chaque frappe du clavier, en raison d\'une bÃªte redondance'],
"6"=>['1108','- le param de config \'utf\' est rendu inutile par le fait que le charset est dÃ©sormais dÃ©terminÃ© en amont lors de l\'allumage de sql
- fix qq dÃ©sagrÃ©ments de la crÃ©ation d\'un traduction par rÃ©plication, dÃ©sormais sensÃ©e tenir compte des tags (pas encore opÃ©rationnel apparemment)
- ajustement des nouveaux htaccess, on aimerait bien avoir l\'Ã©tat des hashes'],
"7"=>['1109','- mise Ã  jour laborieuse des nouveaux htaccess
- correctifs associÃ©s aux nouveaux htaccess
- ajout d\'une app cron'],
"8"=>['1110','- correctif bouton des dossiers virtuels
- fix prise en compte des tags lors d\'une traduction
- finalisation du cronjob, gÃ©nÃ©ralisÃ©. Les changements sur les comptes twitter de la table cron sont rÃ©percutÃ©s dans les sous-tables associÃ©es.'],
"9"=>['1111','- ajout du reader de cron
- ses(\'enc)->sesr(\'prmb\',\'enc\')->ses::$enc
- fix cluster reader
- amÃ©lioration cluster editor'],
"10"=>['1112','- amÃ©liorations cron
- ajout jtim(), qui gÃ©nÃ©ralise les appels chroniques (old school method kept by default)'],
"11"=>['1114','- mise en service de la classification par clusters de tags. Les clusters sont une Ã©mergence de type Ã©ditoriale issue des comptages de tags associÃ©s (les tags Ã©tant non-sujets Ã  une reprÃ©sentation mentale). Cela permet d\'avoir un indicateurs d\'ordre sÃ©mantique sur le contenu.'],
"12"=>['1115','- amÃ©liorations de l\'Ã©diteur de clusters ; ajout d\'un accÃ¨s depuis l\'Ã©diteur des mÃ©tas d\'un article'],
"13"=>['1116','- amÃ©liorations du cron, qui s\'embellit d\'un effet sonore quand une modification a lieu, si on allume la surveillance. Mais bon le cron n\'agit qu\'une fois par heure, alors la surveillance permet de diminuer cet intervalle.'],
"14"=>['1117','- il manquait le connecteur :search au codeline, mais bon un jour il va falloir uniformiser tout Ã§a, comme Ã§a a Ã©tÃ© fait sur fractal, qui mÃ©rite un dÃ©poussiÃ©rage
- amÃ©liorations de l\'Ã©diteur de clusters
- rÃ©paration des mots connus, qui ne donnaient que les tags inusitÃ©s'],
"15"=>['1119','- correctif d\'un correctif abusivement zÃ©lÃ© de sesmake()
- correctifs et amÃ©liorations de umrec
- :img devient :gim (usage unique) et :img permet juste d\'afficher une image en dur
- support de .mp23, .mp4, :img et :w dans le templater (mais il faudra gÃ©nÃ©raliser tout Ã§a)'],
"16"=>['1124','- rÃ©novation du login'],
"17"=>['1125','- rÃ©novation des css : tailles relatives, frame_clr remplace les txtalert, abandon de la typo Georgia'],
"18"=>['1125','- rÃ©novation du login lors d\'un fresh-install
- rÃ©fection des valeurs de config par dÃ©faut
- rstr150 Ã©teint les clusters'],
"19"=>['1126','- rÃ©fection du systÃ¨me de traductions, \'yandex\' est divisÃ© en trois parties : \'translations\', \'trans_yandex\' et \'trans_deepl\'.'],
"20"=>['1127','- troisiÃ¨me tentative infructueuse de faire passer l\'ensemble du systÃ¨me en utf8']];