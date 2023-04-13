<?php //msql/program_updates_2003
$r=["1"=>['0301','publication'],
"2"=>['0301','- rectification de l\'affichage des traduction - Ã©quivalence ou bien traductions enregistrÃ©es - de sorte Ã  s\'Ã©pargner du calcul ; 
- apparition de lj2(), agit comme un toggle entre deux commandes ajax - en complÃ©tement ) toggle() qui affiche ou Ã©teint une commande
- portÃ©e de dispositif aux traductions de :lang et twits, de sorte Ã  dÃ©placer le menu des traductions disponibles dans le rÃ©sultat plutÃ´t que sur le bouton'],
"3"=>['0302','- finalisation de la rÃ©novation de la commoditÃ© de l\'usage des traductions, dans les art, tracks, :lang, twits, et dans umrec
- amÃ©lioration des articles from twits
- ajout du bouton \'bb\' (titre auto d\'une sÃ©rie d\'articles numÃ©rotÃ©s) dans les mÃ©ta'],
"4"=>['0303','- ajout des filtres \'anti-stupids\' et \'goodfriends\' dans Twits'],
"5"=>['0304','- ajout de jsonadm, admin de la db json
- renforcement de sÃ©curitÃ©
- ajout d\'un sniffer de logs temporaire
- ajout d\'un togbub2, alternatif au premier, qui fonctionne en js au lieu de ajax, durant la maintenance du premier, dont le randid cause des pb de types
- amÃ©lioration de compatibilitÃ© entre les deux moteurs de rendu codeline et vue'],
"6"=>['0305','- ajout d\'une sÃ©rie de fonction de gestion des images, lecture des exif
- correctif importation impromptue d\'images eb b64 lors de la consultation d\'articles importÃ©s
- rÃ©ffection de la classe json, en statique
- rÃ©fection de la classe msql, en statique, et appropriation par elle d\'une grande somme de petites procÃ©dures (on laisse les petites sommes de grandes procÃ©dures Ã  la lib pour l\'instant, mais les temps d\'accÃ¨s sont confortables : 1 milliÃ¨me de seconde)'],
"7"=>['0309','- reconditionnement de la rstr40 en un indicateur pour savoir s\'il faut enregistrer les images (noim)
- branchement de la nouvelle table img pour rÃ©pertorier les images entrantes au moment de leur import (conserve une trace de la source)'],
"8"=>['0310','- rÃ©novation de l\'installateur
- rÃ©fection de tonnes de vieux trucs'],
"9"=>['0312','- rÃ©novation de l\'installateur (fin)
- rÃ©novation des donnÃ©es par dÃ©faut lors d\'une fresh install
- rÃ©solution de rester en full iso-8859-1 : aprÃ¨s deux jours de tests, l\'utf8mb4 engendre plus de problÃ¨mes qu\'il n\'en rÃ©sout (sur ce logiciel), alors que l\'iso est 4 fois plus rapide, et permet de gÃ©rer toutes les langues sans aucun problÃ¨me, y compris les Ã©moticÃ´nes dans les tags par exemple. Dans son Ã©volution, Php a rendu utf-8 automatique la plupart des fonctions, ce qui permet de facilement les convertir en entitÃ©s html, qui ont Ã©tÃ© fabriquÃ©es pour Ã§a, sans avoir aucun besoin d\'utf8mb4, Ã  peine sorti et dÃ©jÃ  dÃ©passÃ©.'],
"10"=>['0312','- ajout de dispositifs en provenance du moteur ajax de Fractal, joignable par bj(). Actuellement connectÃ© Ã  rien, en raison de l\'architecture logicielle. nÃ©cessite une mise Ã  niveau;
- amÃ©lioration de addiv() dans js (after, before, begin, end)
- ajout du bouton \'renove\' dans l\'admin msql, depuis le serveur philum.fr'],
"11"=>['0314','- systÃ¨me de maintenance des images, renommage, mise en conformitÃ©, et Ã©ventuellement listÃ©es dans la nouvelle table img
- ajout d\'un bouton reduce_img, qui invite l\'admin Ã  rÃ©duire la taille d\'une image, inutilement volumineuse, activÃ© par rstr121
- ajout d\'un prms15 (param serveur) \'server img\', pour dÃ©signer un serveur d\'image, appelÃ© en troisiÃ¨me instance en cas d\'absence (aprÃ¨s avoir tentÃ© de l\'importer, ou vÃ©rifiÃ© que l\'image n\'a pas Ã©tÃ© balayÃ©e par une maintenance auto, ce qui arrive quand elles ne sont pas dans le catalogue).
- rÃ©paration wygsav figure, pb de dÃ©tection du root des img'],
"12"=>['0315','- correctifs de l\'installateur
- mises Ã  niveau pour php7.4'],
"13"=>['0316','- suppression des htaccess, logÃ©s dÃ©sormais dans le virtualserver
- importation des vidÃ©os twitter, .mp4 (facile) et m3u8 (fichiers de dÃ©finitions de sources) [astuce non trouvÃ©e sur le net]'],
"14"=>['0317','- amÃ©lioration de transport, permet d\'importer les images du serveur d\'images (srvimg) par blocs en tar.gz'],
"15"=>['0318','- rÃ©forme de getmetas(), qui passe par le dom (plutÃ´t que la fonction php get_meta_tags)
- usage de is_utf(), plus fiable que mb_detect_encoding()
- prÃ©fÃ©rence du choix de dom_extract() [extraction de nodes] plutÃ´t que dom_detect() [recrÃ©ation de dom Ã  partir des nodes dÃ©tectÃ©s] dans l\'importateur web, plus rapide, et capable de cibler des propriÃ©tÃ©s spÃ©cifiques. Ajout du quatriÃ¨me (donc) param au defs : attribut:property:tag:prop (par dÃ©faut, c\'est la nodeValue). L\'importateur web s\'oriente vers un full-dom.'],
"16"=>['0318','- automatisation de la rÃ©ciprocitÃ© de dÃ©claration d\'une Ã©quivalence de langue d\'un article'],
"17"=>['0319','- ajout du support de \'transport\' de dossier utilisateur'],
"18"=>['0320','- rÃ©paration de l\'appel d\'une page dans un dig dans l\'api, depuis l\'url ; modif du htaccess, url de type tag/word/dig/page/1 ; pas d\'appel si dig=7
- simplification d\'url des tags grÃ¢ce Ã  une rÃ©versibilitÃ© de la protection d\'url, via sql
- ajout de tagid, permet de trouver un tag par son id (pas de pb d\'url !)'],
"19"=>['0320','grand mÃ©nage de printemps
- suppression des rÃ©pertoires \'fla\', et \'gallery\'
- \'avatar\' et \'bkg\' se logent dans \'imgb\'
- suppression des msql/gallery et msql/stats
- suppression d\'une sÃ©rie de plugin dans plug/photo'],
"20"=>['0321','- refonte du systÃ¨me de mise Ã  jour du logiciel
- abandon de tout le processus flexible de contrÃ´le point par point
- abandon du concept de rÃ©pertoire _public, on puise dans les fichiers courants
- ajout de l\'app pubdate, en replacement de publish_site, signale une nouvelle mise Ã  jour en informant coreflush et philumsize, et crÃ©e l\'archive
- suppression des condensats du systÃ¨me : publish_site, distribution, zip_prog, et d\'un Ã©norme paquet de fonctions illisibles dans l\'admi,
- ajout de l\'app software, remplace tout le reste en s\'inspirant des techniques de transport et backupim (application client-server via une api) utilisant json. L\'app (client) crÃ©e un Ã©tat des lieux (local+distant), fabrique un rapport, le serveur fabrique l\'archive demandÃ©e, et le client la tÃ©lÃ©charge et l\'installe, puis supprime les fichiers obsolÃ¨tes ou dÃ©placÃ©s. D\'une traite, en une fraction de seconde.'],
"21"=>['0322','- peaufinages et coorectifs de l\'app software
- rÃ©novation des apps tar et svg
- fix pb domextract balise stricte + limite Ã  1 rÃ©ponse (=> dÃ©tecte images daily)'],
"22"=>['0323','amÃ©lioration de la procÃ©dure de rÃ©duction de taille des images : soit la taille est rÃ©duite, soit le png est convertit en jpg, et dans ce cas :
- modif dans l\'article
- modif dans le catalogue
- modif dans la base des images
- suppression de l\'ancienne image
2) affectation des nouveaux dispositifs Ã  ceux qui en ont besoin, les meta et l\'upload'],
"23"=>['0323','- deuxiÃ¨me rÃ©novation de l\'installateur (aprÃ¨s la refonte de l\'updateur), et prÃ©sentation d\'une vidÃ©o de dÃ©monstration, du fameux one-minute-install
- amÃ©lioration (incomplÃ¨te) du simplificateur d\'entitÃ©s dans les urls des variabes de l\'api (url avec des - et des _ Ã  la place des espaces et guillemets). La correction des accents est dÃ©sactivÃ©e.'],
"24"=>['0324','- ajout du bouton mirror dans les mÃ©tas, permet de rapatrier un article prÃ©cis sur le site miroir'],
"25"=>['0325','- fix pb transport sur certains serveurs (debian9 au lieu de 10)
- derniers fixs du nouvel updater, changement de mÃ©thode de dÃ©compression (test sur plusieurs serveurs)
- les mises Ã  jour se font Ã  la seconde (d\'une Ã  l\'autre il peut y en avoir une nouvelle)
- ajout du bt update dans le menu dev'],
"26"=>['0326','- correctif rstr60 noim, inversÃ©e
- correctif amÃ©lioration jointures de langues (pas encore complÃ¨tement capable de se rÃ©percuter, sur des cas de figures pour l\'instant inexistants)
- ajout de fonctions filter_var, pour un meilleur contrÃ´le de validation des urls, mails, nombres hexa'],
"27"=>['0327','- admin sur fond noir
- petite harmonisation avec fractal, strdeb devient strto (demi-centaine de modifs)
- les donnÃ©es des filtres twitter sont placÃ©es dans les tables twit_friends et twit_stupids
- msql::dump rendu capable de mettre en conformitÃ© les arrays 1D
- les defcons statistiquement les plus reconnus vont se loger dans les tables defcons_tx et defcons_tt'],
"28"=>['0328','- prise en charge du format audio .m4a'],
"29"=>['0329','- rÃ©novation de timetravel, qui passe par l\'api'],
"30"=>['0330','- fix pb module twits, qui rÃ©pertorie les twits des articles, hors de la mÃ©thode moderne via le dispositif de mÃ©dias d\'articles play_conn()
- ajout du module webs, permet de rÃ©pertorier les liens web des articles d\'aprÃ¨s la base et l\'app web
- amÃ©liorations de l\'app web, renommages, ajout de filtres, suppressions en masse']];