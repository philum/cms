<?php //msql/program_updates_1405
$r=["_menus_"=>['date','text'],
"1"=>['0501','- nouveau plugin \'viewcode\', va remplacer \'cod2base\'
- mise Ã  jour des apps par dÃ©faut'],
"2"=>['0505','- renommages : Admin->admin, set_admin->set
- et rectif des htaccess
- ajout du param \'hover\' dans les lienj() (meilleur contrÃ´le du statut des menus admin)
- la catÃ©gorie rÃ©servÃ©e antique \'user\' est rÃ©volue
'],
"3"=>['0506','- renommages : anciens modules dont on retire la majusule, certaines fonctions du noyau sont harmonisÃ©es
- ajout de \'tablet\' dans le user_menu (accessible via une apps) : adapte l\'ui aux les tablettes
- ajout de \'deskboot\' dans les user_menu, pour lancer les apps de la condition \'boot\'
- mise Ã  jour des css par dÃ©faut et du global
- fix taille des images d\'un lien pdf
- fix largeur adaptative des scroll'],
"4"=>['0507','retouches :
- ajout du paramÃ¨tre ajax 15 : repositionne la popup aprÃ¨s une action
- le module \'Home\' Ã©tait intempestivement activÃ©, ce qui allumait des menus non visitÃ©s
- sliderJ : position des boutons, des commentaires
- design global : dÃ©fait de ses dÃ©jÃ  antiques shadows, la typo \'microsys\' supprimÃ©e'],
"5"=>['0508','- rÃ©organisation des tables css par dÃ©faut : 1=global, 2=dÃ©faut, 3=dÃ©faut sans couleurs
- ajout de pictos dans les menus de l\'admin
- les boutons du module menusJ deviennent toggle, dÃ©sactivable en option
- ajout d\'une aide spÃ©cifique Ã  l\'option de chaque module'],
"6"=>['0509','- correctifs dans le htaccess
- option du module system/design : permet de lancer le css classic avant le css utilisateur
- Ã©diteur css : bouton \'design vide\' permet de ne garder que les dÃ©finitions de couleurs
- design css : bouton \'inverser couleurs\'
'],
"7"=>['0510','- fusion : le module menusJ prend en charge le mode popup ou surplace, closed ou closeable ; menusP est obsolÃ¨te
- rendu plus clair : le module popadmin prend en charge les restrictions 51, 52 et 75, qui dÃ©finissent le type d\'icÃ´ne et l\'orientation verticale, et sont rendus obsolÃ¨tes ; seuls quelques boutons peuvent Ãªtre appelÃ©s en option, et la liste d\'articles est dÃ©placÃ©e vers l\'admin globale, et le finder dans le menu Actions'],
"8"=>['0511','- patch filtre url dans le lecteur rss dÃ©signÃ© pour spip
- on peut accÃ©der aux modules depuis le menu admin/console/modules
'],
"9"=>['0512','- menus ajax : tous les boutons suivent les rÃ¨gles de menu, effacement des autres, activitÃ©, fermeture au clic
- rstr51 permet d\'activer le menu admin au public
- menu admin : on peut modifier les rstr dans admin/console/restrictions'],
"10"=>['0513','- dans l\'Ã©diteur css le traitement des couleurs perso l\'Ã©diteur reÃ§oit le paramÃ¨tre alpha(.2) aprÃ¨s la variable : #_4.2
- les css par dÃ©faut sont dÃ©barrassÃ©s de leur rgba absolus
- le paramÃ¨tre de couleur du desktop reÃ§oit aussi les alpha
- rÃ©vision du rattachement des options d\'articles venant du plugin
- fix menusJ option closed mais opened d\'une page Ã  l\'autre
- fix tab qui ne restait pas actif au refresh (dans css edit)'],
"11"=>['0513','- remise en chantier de msql2
- l\'admin msql est intÃ©grÃ©e au programme, et mieux isolable'],
"12"=>['0514','- correctif hiÃ©rarchie popadmin, css
- les menus des backoffices console et msql s\'intÃ¨grent Ã  popadmin
- mysql2 : patch de conversion des tables lues vers nouvelle architecture'],
"13"=>['0515','Ã©tude du nouveau moteur msql2 (todo) : structure topologique, moteur isolÃ© (philum n\'en n\'est qu\'une application, oÃ¹ on nomme les niveaux, ce qui les fige) '],
"14"=>['0516','- rÃ©forme des menus url de l\'admin msql (prologue de msql2)
- les trÃ¨s anciens formats de msql forcent la rÃ©Ã©criture du nouveau, une fois pour toutes'],
"15"=>['0517','- nouvelle admin msql, rÃ©vision du systÃ¨me des urls'],
"16"=>['0518','- suppression des anciens dispositifs de l\'admin msql
- rÃ©organisation des menus admin phi, destinÃ© Ã  Ãªtre publique
- rÃ©habilitation des outils madmin
- les menus de msql et de l\'admin sont intÃ©grÃ©s au menu admin principal'],
"17"=>['0519','- fix pb ancien de ciblage de la table msql lors d\'un enregistrement survenant aprÃ¨s un changement de page sur une autre fenÃªtre
- rÃ©vision architecture de madmin
- les requires passent par une function de ciblage
- rÃ©visions css
- fix pb erase css'],
"18"=>['0520','- une erreur inconnue apparaÃ®t quand un fichier du programme existe hors de son rÃ©pertoire
- correctif affichage popup de qq sÃ©lecteurs
- correctif de l\'option ktag de sql()
- amÃ©lioration du batch : gÃ©nÃ©ralisation des menus de catÃ©gories (addart, batch, rss) ; l\'ajout d\'article interroge automatiquement ce menu en cas d\'absence de catÃ©gorie
- picto icone/liste de la popup rendu toggle'],
"19"=>['0521','- suppression de l\'antique \'clbub\' (close bubbles) remplacÃ© par un simple background-click
- rÃ©vision du menu admin msql : chaque noeud du root renvoie le contenu de son rÃ©pertoire parent
- ajax/text recÃ§oit params
- slct all dans madmin
- amÃ©lioration menu catÃ©gorie : se souvient si elle a dÃ©jÃ  Ã©tÃ© sÃ©lectionnÃ©e dans un autre menu
- rÃ©surrection du principe de plugin comme du contexte global (il peut n\'Ãªtre qu\'un module mais l\'url est plus cool : plug/plugin/p/o) ; modif htaccess'],
"20"=>['0522','- le menu admin import est placÃ© dans le batch et disparaÃ®t
- on peut appeler une ligne d\'une table en plaÃ§ant l\'index en position 4 du node : lang/helps_txtx__publish*art
- la table program_plugs est repensÃ©e en vue du futur menu plugs, et coreflush ajoute les nouveaux plugins dans la table. 
- fix video daily'],
"21"=>['0523','- amÃ©lioration index des plugins, on peut les Ã©diter
- fix pb root dev avec prog()
- popup image arrive Ã  la taille du resize
- renommage des connecteurs msq_html=>microconn, msq_ads=>microform, msq_template=>microread
- coup de balai sur d\'anciens dispositifs de la popup
- l\'option popup 3 permet d\'allumer le btn \'desktop\'
- l\'Ã©diteur de plugins est en ajax'],
"22"=>['0525','- renommages : substr_v=>strtopos, bubbles=>bubs
- meilleure gestion de la taille des images non importÃ©es
- suppression du fichier systÃ¨me vide \'desktop\'
- rÃ©organisation des menus pour placer les plugins et les connecteurs, modules et template dans admin/global
- les mimes des pictos sont dÃ©placÃ©s dans la table program_mimes'],
"23"=>['0526','- nouvelle console bcp plus compacte, exit le simulateur de design pour prÃ©senter les modules
- le menu admin articles est disponible dans popadmin
- [ajout d\'un menu apps \'favs\':k]'],
"24"=>['0527','- des donnÃ©es de la config server sont placÃ©es dans des tables (admin_config, defaults, et lang), et fonctionnent comme admin_params
- modernisation du code de l\'admin, la plupart des actions ayant Ã©tÃ© externalisÃ©es
- les images non aspirÃ©es sont rendues adaptatives
- ajout du connecteur msq_lasts : affiche les Â§n derniers objets de la table'],
"25"=>['0528','- amÃ©lioration de la prÃ©sentation des listes venues des sÃ©lections de catÃ©gories et tags (batch, rss, saveiec) : taille du scroll, Ã  la ligne ou pas, comportement des fenÃªtres parentes
- jointure de saveiec avec slct_cat : les catÃ©gories peuvent Ãªtre prÃ©sÃ©lectionnÃ©es, n\'importe quel enregistrement y fait rÃ©fÃ©rence'],
"26"=>['0529','- usage des balises article et nav dans le template, les defs d\'importation sont modifiÃ©es
- rÃ©glage de la position par dÃ©faut du menu admin
- une alerte prÃ©vient des modules systÃ¨mes vitaux absents dans la console (il y en a dÃ©jÃ  au dÃ©marrage)
- prise en charge par la nouvelle console de l\'ouverture des blocks de modules et de la newsletter depuis le menu admin
- dsnav (navigation dans rÃ©pertoires) es externalisÃ© en un plugin system'],
"27"=>['0530','- la table systÃ¨me apps est divisÃ©es en plusieurs, les obligatoires et les optionnelles : la table Apps utilisateur est seulement additionnelle aux tables systÃ¨mes lancÃ©es
- dans l\'admin msql, ajout des filtres \'add_menus\' et \'merge\'
- les donnÃ©es des connecteurs obsolÃ¨tes sont placÃ©s dans la table system/connectors_old'],
"28"=>['0531','- le push en prod gÃ©nÃ¨re un backup quotidien
- le paramÃ¨tre \'private\' des apps reÃ§oit le niveau d\'autorisation
- fix pb dossiers vides dans les apps (oÃ¹ les branches topologiques se greffent Ã  d\'autres)
- rÃ©vision du retape_conn (rÃ©paration des connecteurs obsolÃ¨tes), les antiques conn pub1 pub2 et pub3 ne sont plus corrigÃ©s, et les Ã©couteurs sont placÃ©s dans et hors des connecteurs.
- ajout du plug \'retape\' pour retaper des articles en sÃ©rie et mettre l\'option Ã  off
- le mod prevnext marche avec les anciens articles (hors cache)']];