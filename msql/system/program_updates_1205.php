<?php //msql/program_updates_1205
$r=["_menus_"=>['day','text'],
"1"=>['0501','mise Ã  jour de toutes les aides pour les 219 functions publiques du noyau (base program_core)'],
"2"=>['0502','- introduction du paramÃ¨tre \'auto_member\' : permet de dÃ©lÃ©guer des privilÃ¨ges au visiteur (de 1 Ã  4) et faire de lui un membre automatiquement au moment oÃ¹ il poste un article ;
- les privilÃ¨ges ont Ã©tÃ© un peu rÃ©organisÃ©s pour que :
1 : poste des commentaires
2 : poste des articles mais ne peut les publier
3 : peut publier
4 : peut Ã©diter les autres articles
Cela permettra d\'offrir des capacitÃ©s du logiciel Ã  de simples \'membres\' autolguÃ©s.
- le systÃ¨me des membres est indÃ©pendant de celui des utilisateurs, chaque utilisateur ou visiteur pouvant devenir membre d\'un hub.
'],
"3"=>['0505','- nouveaux boutons de la popup ;
- bouton \'import\' remplacÃ© par le mÃªme que celui du menus rapide ;
- champ de recherche aussi, mÃªme systÃ¨me (lance le script dÃ¨s que le texte est collÃ©) ;
- amÃ©nagements en vue d\'accueillir le mode \'auto_member\'  (systÃ¨me sans login)'],
"4"=>['0511','- correctif faille de sÃ©curitÃ© engendrÃ© par le nouveau param \'auto_member\' ;
- continuitÃ© du travail sur \'auto_member\' pour trouver une solution Ã©lÃ©gante Ã  l\'ouverture des autorisations au public ;
- amÃ©lioration des commentaires qui peuvent reconnaÃ®tre un utilisateur ;
- petite amÃ©lioration de la prise en compte des majuscules aprÃ¨s un espace insÃ©cable dans le formatage du titre ;
- ajout d\'un filtre \'del_blocks\' qui efface les blocs Ã©crits avec des crochets ;
- nouvelle rÃ©novation du batch_process, en utilisant une requÃªte mysql une fois les autres conditions remplies, pour ne pas prendre en compte les articles parus Ã  une date antÃ©rieure (c\'est pas encore parfait) ;
- il table utilisÃ©e par le sÃ©lecteur du batch (qui va chercher les nouveaux articles dans un rss) est rss_url_1 ;'],
"5"=>['0512','perfectionnement de la fonction \'auto_member\' :
- le niveau d\'autorisation affectÃ© au paramÃ¨tre est attribuÃ© au visiteur (3 dans l\'idÃ©al, il peut publier ses articles, 2 il ne peut que poster, 4 il peut Ã©diter ceux des autres) ;
- une enquÃªte renvoie l\'identitÃ© du visiteur ;
- s\'il est inconnu il est enregistrÃ© sans nom ;
- au premier commentaire il est connu, au premier article publiÃ© son nom est enregistrÃ© ;
- l\'enregistrement de l\'automember consiste en un message de type commentaire affectÃ© Ã  \'automember\' et Ã  une identification temporaire en tant que membre du hub ;
- le champ \'name\' interdit l\'usage des noms de hubs existants ;
- une Ã©mergence impromptue de cette disposition est que le superadmin est loguÃ© de facto ;'],
"6"=>['0513','- rÃ©paration du sÃ©lecteur d\'onglet (qui doit se souvenir de sa osition d\'une page Ã  l\'autre) ;
- rÃ©vision du systÃ¨me de sÃ©lection du niveau d\'affichage (1,2 ou 3, = false, preview, full) : la restriction est court-circuitÃ©e par l\'option de module (load, All, Category) ou n\'importe quel module d\'article. Ce fonctionnement est rendu uniforme (ce paramÃ¨tre peut Ãªtre introduit tout au long des chaÃ®nes de fonctions)'],
"7"=>['0513','amÃ©lioration du fil rss :
- systÃ¨me de cache en dur ;
- meilleure prise en charge des articles importÃ©s ;
- miniatures et pas d\'images ;
- destruction des balises qui ne sont pas des liens ;
- ajout des balises \'author\' (branchÃ© sur l\'usertag \'author\' et langage ;'],
"8"=>['0514','ajout des modules : 
- \'ajxget\' (nom de la fonction du noyau) qui permet d\'Ã©chapper les caractÃ¨res utilisÃ©s par le connecteur \'module\' ;
- rss_input (alias vers le module) pour Ã©viter de s\'embÃªter avec ajxget...'],
"9"=>['0514','finalisation de la disposition automember :
- l\'utilisateur invitÃ© est enregistrÃ© comme inconnu, identifiÃ© au premier article, peut Ã©diter et voir ses articles non publiÃ©s, ne peut pas prendre le nom d\'un autre membre, peut adopter un avatar.
Si son IP change ses donnÃ©es deviennent inaccessibles...'],
"10"=>['0515','- ajout d\'une temporisation sur le dÃ©tecteur d\'Ã©vÃ©nements lors de la manipulation de champ d\'Ã©dition de l\'article, pour ne pas obtenir le bouton d\'enregistrement ajax alors que le nombre de caractÃ¨res est trop Ã©levÃ©
- temporisation qui referme le menu admin rapide'],
"11"=>['0515','- suppression d\'un trop ancien systÃ¨me de toggle au profit du nouveau, amÃ©liorÃ©, (toggle) qui permet de choisir le mode, appartenant ou non Ã  un groupe de boutons ;
- nouveaux boutons d\'Ã©dition d\'article ;
- dans la console les modules dÃ©sactivÃ©s apparaissent en grisÃ© ;'],
"12"=>['0515','(jour des tralalas)
- suppression d\'un trop ancien systÃ¨me de toggle au profit du nouveau, amÃ©liorÃ©, (toggle) qui permet de choisir le mode, appartenant ou non Ã  un groupe de boutons ;
- nouveaux boutons d\'Ã©dition d\'article ;
- dans la console les modules dÃ©sactivÃ©s apparaissent en grisÃ© ;
- mise Ã  niveau des css par dÃ©faut ;
- rÃ©paration de l\'impossibilitÃ© d\'ouvrir les css 2, 3 et 4 ;
- impossibilitÃ© d\'enregistrer la couleur  bkg1 dans les css (Ã  rÃ©parer) ;
- meilleur fonctionnement des actions du champ de recherche, il commence se recherche quand on a fini de taper le texte ;'],
"13"=>['0516','- Ã©dition d\'articles dans l\'admin : le bouton \'save\' au-dessus de 5000 caractÃ¨res ;
- la \'pop_open\' ouvre dÃ©sormais l\'article dans une fenÃªtre dans une iframe, ce qui permet d\'y continuer l\'Ã©dition ;
- l\'instruction \'smart_edit\' (restriction 17) est activable depuis l\'url, ce qui sert pour l\'Ã©dition dans une iframe ;
- l\'enregistrement des articles depuis le batch devient direct et renvoie sur l\'article publiÃ© prÃªt Ã  Ãªtre Ã©ditÃ© (avant il proposait l\'enregistrement Ã  faire, c\'est nettement plus pratique !) ;
- le batch_process est incorporÃ© au menu admin_rapide, toutes les actions y font rÃ©fÃ©rence, et on peut choisir la catÃ©gorie et si l\'article crÃ©Ã© sera parent de celui en cours ; 
- dernier correctif sur le dÃ©tecteur d\'usage de clavier du champ de recherche ;
- dans l\'admin le bouton (...) sert Ã  lancer le corps du texte de la cellule en entier ;
- correctif caractÃ¨res mal dÃ©codÃ©s dans \'Channel\' ;'],
"14"=>['0517','rÃ©paration erreur des checkbox, qui pouvait provoquer l\'enregistrement systÃ©matique d\'un mauvais Ã©tat du droit de publier des commentaires (l\'erreur semble dater de quelques jours) - donc maj immÃ©diate'],
"15"=>['0517','- rÃ©paration dÃ©tecteur d\'activitÃ© du champ de recherche, pour Ã©muler un \'onpaste\' tout en Ã©vitant les appels rÃ©pÃ©titifs ;
- ajout du connecteur \':weppage\', comme \':web\' mais se rÃ©fÃ¨re au plugin \'suggest\' (pas besoin des dÃ©finitions de sites) pour afficher une page web dans une popup (trÃ¨s pratique !) ;'],
"16"=>['0518','- les \'autotags\' proposÃ©s (et prÃ©sentÃ©s dans le module \'words\') sont classÃ©s par ordre de pertinence (d\'abord les plus nombreux, puis les ressemblances) ;
- rÃ©paration de l\'importateur de tables d\'autres serveurs dans  l\'admin msql ;'],
"17"=>['0519','- ajout restriction 52 : afficher le batch_menu ;
- restriction 53 : empÃªcher l\'enregistrement en ajax des articles courts (certains serveurs sont trop courts !) ;
- ajout procÃ©dure constructeur de listes imbriquÃ©es (trÃ¨s pratique) : make_list_r() ;
- amÃ©lioration du menu admin (techniques mixtes js/css) ;
- mise Ã  jour \'_menus.css\' ;
- on dÃ©cide que les h3, comme les autres balises \'h\' doivent avoir un \'margin:0\' mÃªme s\'ils ne sont pas traitÃ©s comme des paragraphes ;'],
"18"=>['0520','- les css sont prÃ©sentÃ©s par catÃ©gories dans l\'Ã©dition du design ;'],
"19"=>['0521','- rÃ©paration erreur utf8 des tickets ;
- rÃ©paration erreur de format de la newsletter ;
- un bouton apparaÃ®t dans l\'admin rapide si une mise Ã  jour est disponible ;
- le menu \'upload\' renvoie la liste des fichiers mis Ã  jour ;'],
"20"=>['0522','- rÃ©forme des headers (32 fichiers affectÃ©s) ;
- ajout du plugin \'addfonts\' qui permet d\'ajouter des typos trouvÃ©es sur le web depuis la source css @font-face (phase 1) ;'],
"21"=>['0523','- finalisation de \'addfonts\' : 
dans admin/fonts un menu renvoie vers le plugin,
le plugin import les typos dans le rÃ©pÃªrtoire /fonts,
il crÃ©e un package .tar dans le rÃ©pertoire utilisateur,
ensuite il faut faire un \'inject\' dans admin/fonts.
- ajout d\'un champ pour taper du texte dans l\'Ã©diteur  font-face ;
- ajout d\'un \"new_from\" pour crÃ©er une classe css d\'aprÃ¨s une existante (pratique pour ajouter un :hover) ;
- possibilitÃ© d\'Ã©diter le nom de la classe ;
- mise Ã  niveau du design par dÃ©faut ;'],
"22"=>['0524','- ajout d\'un composant \'copier-coller\' multiple et d\'un bouton \'supprimer\' (pour pas lÃ¢cher la souris !) ; la copie fonctionne beaucoup mieux que le bloc-notes en ajax, elle n\'est pas limitÃ©e en quantitÃ©, et les donnÃ©es sont stockÃ©es Ã©ternellement dans le navigateur.'],
"23"=>['0525','- rÃ©paration erreur de fabrication de liens absolus des articles envoyÃ©s par mail ;
- rÃ©paration erreur de fabrication des images en plein-Ã©cran ;
- les boutons \'copier\', \'coller\', \'supprimer\' (\'sÃ©lection/dernier caractÃ¨re\' et \'connecteur\'), et \'sÃ©lectionner tout\' sont ajoutÃ©s dans Ã©diteur ;
- renommage Ascii des boutons de l\'Ã©diteur ;
- correctif dans l\'Ã©diteur externe (code plus propre) ;
- dans admin/css le bouton \'apply\' est mis en surbrillance par rapport Ã  \'save\', imposÃ© par un correctif permettant d\'obtenir les rÃ©sultats de changement de largeurs immÃ©diatement en dev(save ne sert Ã  rien, comme \'rebuild\' sauf si un changement a eu lieu de l\'extÃ©rieur ;
- amÃ©lioration designs par dÃ©faut ;'],
"24"=>['0526','- pas de correcteur orthographique dans les formulaires de l\'admin ;
- relokage de admin.css ;
- mise en route de la fonctionnalitÃ© de dÃ©veloppement en ligne (admin/dev) ;
- liste des fonction Ã©ditÃ©es dans admin/dev (plus rapide de passer de l\'une Ã  l\'autre) ;
- ajout de \'2prod\' qui copie les fichier dev en prod dev) ;
- correctif dans admin/tools ;(bouton dans l\'admin ;
- permutations diverses dans le gÃ©nÃ©rateur html permettant d\'obtenir un code plus aÃ©rÃ© ;

'],
"25"=>['0527','- ajout du composant \'copier-coller\' dans le bloc-notes ;
- nouvelle prÃ©sentation des plugins, par catÃ©gories mixtes ;
'],
"26"=>['0527','par convention les Ã©lÃ©ments \'h1\', \'h2\', \'h3\', \'h4\' doivent recevoir la valeur 0 pour l\'attribut margin : 
margin:0 0 0px 0;
au lieu de margin:0 0 16px 0; (hauteur d\'une ligne),
de faÃ§on Ã  renvoyer des rÃ©sultats comparables en utilisant ou non les balises p'],
"27"=>['0528','ajout d\'une fonction javascript \'connector\', rÃ©plique du noyau central :
- amÃ©lioration du bouton d\'effacement des connecteurs, capable de prendre en compte une sÃ©lection et ses itÃ©rations ;
- tous les filtres d\'effacement deviennent capables de distinguer si Ã§a doit opÃ©rer sur l\'ensemble ou la partie sÃ©lectionnÃ©e du texte ;
- nouveau bloc de filtres nommÃ© \'del\', ce sont les filtres d\'effacements ;
- ajout de fonctions de commoditÃ© msqlink() et ascii() ;'],
"28"=>['0528','suppression de la restriction 48 \'icones_edition\', pas trÃ¨s signifiante ;'],
"29"=>['0529','finalisation la capacitÃ© en javascript Ã  situer les points d\'entrÃ©e et sortie des connecteurs imbriquÃ©s'],
"30"=>['0530','- amÃ©liorations esthÃ©tiques : Ã©diteur externe, boutons standards, iconographie ;
- amÃ©liorations pratiques : listes en ajax, Ã©dition en ajax dans l\'Ã©diteur msql (jonction avec l\'admin) ; '],
"31"=>['0530','- finalisation de la jonction entre l\'admin msql et msql dans l\'admin : l\'Ã©dition peut se faire Ã  la volÃ©e en ajax (Ã§a marche !) ; 
- ajout de la restriction 48 : \'check_update\' pour empÃªcher l\'appel du numÃ©ro de version ;
- confort d\'utilisation du batch : popups Ã©phÃ©mÃ¨res, Ã©gronomie ;
- les dates sont supprimÃ©es des titres ;']];