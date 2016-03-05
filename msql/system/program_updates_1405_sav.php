<?php
//philum_microsql_program_updates_1405
$r["_menus_"]=array('date','text');
$r[1]=array('0501','- nouveau plugin \'viewcode\', va remplacer \'cod2base\'
- mise à jour des apps par défaut');
$r[2]=array('0505','- renommages : Admin->admin, set_admin->set
- et rectif des htaccess
- ajout du param \'hover\' dans les lienj() (meilleur contrôle du statut des menus admin)
- la catégorie réservée antique \'user\' est révolue
');
$r[3]=array('0506','- renommages : anciens modules dont on retire la majusule, certaines fonctions du noyau sont harmonisées
- ajout de \'tablet\' dans le user_menu (accessible via une apps) : adapte l\'ui aux les tablettes
- ajout de \'deskboot\' dans les user_menu, pour lancer les apps de la condition \'boot\'
- mise à jour des css par défaut et du global
- fix taille des images d\'un lien pdf
- fix largeur adaptative des scroll');
$r[4]=array('0507','retouches :
- ajout du paramètre ajax 15 : repositionne la popup après une action
- le module \'Home\' était intempestivement activé, ce qui allumait des menus non visités
- sliderJ : position des boutons, des commentaires
- design global : défait de ses déjà antiques shadows, la typo \'microsys\' supprimée');
$r[5]=array('0508','- réorganisation des tables css par défaut : 1=global, 2=défaut, 3=défaut sans couleurs
- ajout de pictos dans les menus de l\'admin
- les boutons du module menusJ deviennent toggle, désactivable en option
- ajout d\'une aide spécifique à l\'option de chaque module');
$r[6]=array('0509','- correctifs dans le htaccess
- option du module system/design : permet de lancer le css classic avant le css utilisateur
- éditeur css : bouton \'design vide\' permet de ne garder que les définitions de couleurs
- design css : bouton \'inverser couleurs\'
');
$r[7]=array('0510','- fusion : le module menusJ prend en charge le mode popup ou surplace, closed ou closeable ; menusP est obsolète
- rendu plus clair : le module popadmin prend en charge les restrictions 51, 52 et 75, qui définissent le type d\'icône et l\'orientation verticale, et sont rendus obsolètes ; seuls quelques boutons peuvent être appelés en option, et la liste d\'articles est déplacée vers l\'admin globale, et le finder dans le menu Actions');
$r[8]=array('0511','- patch filtre url dans le lecteur rss désigné pour spip
- on peut accéder aux modules depuis le menu admin/console/modules
');
$r[9]=array('0512','- menus ajax : tous les boutons suivent les règles de menu, effacement des autres, activité, fermeture au clic
- rstr51 permet d\'activer le menu admin au public
- menu admin : on peut modifier les rstr dans admin/console/restrictions');
$r[10]=array('0513','- dans l\'éditeur css le traitement des couleurs perso l\'éditeur reçoit le paramètre alpha(.2) après la variable : #_4.2
- les css par défaut sont débarrassés de leur rgba absolus
- le paramètre de couleur du desktop reçoit aussi les alpha
- révision du rattachement des options d\'articles venant du plugin
- fix menusJ option closed mais opened d\'une page à l\'autre
- fix tab qui ne restait pas actif au refresh (dans css edit)');
$r[11]=array('0513','- remise en chantier de msql2
- l\'admin msql est intégrée au programme, et mieux isolable');
$r[12]=array('0514','- correctif hiérarchie popadmin, css
- les menus des backoffices console et msql s\'intègrent à popadmin
- mysql2 : patch de conversion des tables lues vers nouvelle architecture');
$r[13]=array('0515','étude du nouveau moteur msql2 (todo) : structure topologique, moteur isolé (philum n\'en n\'est qu\'une application, où on nomme les niveaux, ce qui les fige) ');
$r[14]=array('0516','- réforme des menus url de l\'admin msql (prologue de msql2)
- les très anciens formats de msql forcent la réécriture du nouveau, une fois pour toutes');
$r[15]=array('0517','- nouvelle admin msql, révision du système des urls');
$r[16]=array('0518','- suppression des anciens dispositifs de l\'admin msql
- réorganisation des menus admin phi, destiné à être publique
- réhabilitation des outils madmin
- les menus de msql et de l\'admin sont intégrés au menu admin principal');
$r[17]=array('0519','- fix pb ancien de ciblage de la table msql lors d\'un enregistrement survenant après un changement de page sur une autre fenêtre
- révision architecture de madmin
- les requires passent par une function de ciblage
- révisions css
- fix pb erase css');
$r[18]=array('0520','- une erreur inconnue apparaît quand un fichier du programme existe hors de son répertoire
- correctif affichage popup de qq sélecteurs
- correctif de l\'option ktag de sql()
- amélioration du batch : généralisation des menus de catégories (addart, batch, rss) ; l\'ajout d\'article interroge automatiquement ce menu en cas d\'absence de catégorie
- picto icone/liste de la popup rendu toggle');
$r[19]=array('0521','- suppression de l\'antique \'clbub\' (close bubbles) remplacé par un simple background-click
- révision du menu admin msql : chaque noeud du root renvoie le contenu de son répertoire parent
- ajax/text recçoit params
- slct all dans madmin
- amélioration menu catégorie : se souvient si elle a déjà été sélectionnée dans un autre menu
- résurrection du principe de plugin comme du contexte global (il peut n\'être qu\'un module mais l\'url est plus cool : plug/plugin/p/o) ; modif htaccess');
$r[20]=array('0522','- le menu admin import est placé dans le batch et disparaît
- on peut appeler une ligne d\'une table en plaçant l\'index en position 4 du node : lang/helps_txtx__publish*art
- la table program_plugs est repensée en vue du futur menu plugs, et coreflush ajoute les nouveaux plugins dans la table. 
- fix video daily');
$r[21]=array('0523','- amélioration index des plugins, on peut les éditer
- fix pb root dev avec prog()
- popup image arrive à la taille du resize
- renommage des connecteurs msq_html=>microconn, msq_ads=>microform, msq_template=>microread
- coup de balai sur d\'anciens dispositifs de la popup
- l\'option popup 3 permet d\'allumer le btn \'desktop\'
- l\'éditeur de plugins est en ajax');
$r[22]=array('0525','- renommages : substr_v=>strtopos, bubbles=>bubs
- meilleure gestion de la taille des images non importées
- suppression du fichier système vide \'desktop\'
- réorganisation des menus pour placer les plugins et les connecteurs, modules et template dans admin/global
- les mimes des pictos sont déplacés dans la table program_mimes');
$r[23]=array('0526','- nouvelle console bcp plus compacte, exit le simulateur de design pour présenter les modules
- le menu admin articles est disponible dans popadmin
- [ajout d\'un menu apps \'favs\':k]');
$r[24]=array('0527','- des données de la config server sont placées dans des tables (admin_config, defaults, et lang), et fonctionnent comme admin_params
- modernisation du code de l\'admin, la plupart des actions ayant été externalisées
- les images non aspirées sont rendues adaptatives
- ajout du connecteur msq_lasts : affiche les §n derniers objets de la table');
$r[25]=array('0528','- amélioration de la présentation des listes venues des sélections de catégories et tags (batch, rss, saveiec) : taille du scroll, à la ligne ou pas, comportement des fenêtres parentes
- jointure de saveiec avec slct_cat : les catégories peuvent être présélectionnées, n\'importe quel enregistrement y fait référence');
$r[26]=array('0529','- usage des balises article et nav dans le template, les defs d\'importation sont modifiées
- réglage de la position par défaut du menu admin
- une alerte prévient des modules systèmes vitaux absents dans la console (il y en a déjà au démarrage)
- prise en charge par la nouvelle console de l\'ouverture des blocks de modules et de la newsletter depuis le menu admin
- dsnav (navigation dans répertoires) es externalisé en un plugin system');
$r[27]=array('0530','- la table système apps est divisées en plusieurs, les obligatoires et les optionnelles : la table Apps utilisateur est seulement additionnelle aux tables systèmes lancées
- dans l\'admin msql, ajout des filtres \'add_menus\' et \'merge\'
- les données des connecteurs obsolètes sont placés dans la table system/connectors_old');
$r[28]=array('0531','- le push en prod génère un backup quotidien
- le paramètre \'private\' des apps reçoit le niveau d\'autorisation
- fix pb dossiers vides dans les apps (où les branches topologiques se greffent à d\'autres)
- révision du retape_conn (réparation des connecteurs obsolètes), les antiques conn pub1 pub2 et pub3 ne sont plus corrigés, et les écouteurs sont placés dans et hors des connecteurs.
- ajout du plug \'retape\' pour retaper des articles en série et mettre l\'option à off
- le mod prevnext marche avec les anciens articles (hors cache)');

?>