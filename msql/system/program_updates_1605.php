<?php //msql/program_updates_1605
$r=["1"=>['0501','publication'],
"2"=>['0511','ajout du dispositif overcat :
- /admin/overcat permet d\'affecter un menu hiÃ©rarchique auquel s\'attache une catÃ©gorie d\'articles
- module overcats : affiche un menu ouvrable en javascript ou en bubbles ajax'],
"3"=>['0511','- ajout d\'un convertisseur de catÃ©gorie en tags dans /admin/categories (l\'inverse, de tag vers une catÃ©gorie, est disponible dans Admin/tags)
- ajout d\'un sous-systÃ¨me qui empÃªche les doublons dans la table de liaison des tags
- amÃ©lioration du module \'submenus\', capable de faire comme \'overcats\' mais avec des liens de type du module \'link\'
- amÃ©lioration du gestionnaire de contrÃ´le des bulles pour qu\'elles soient utilisÃ©es ailleurs que pour le menu admin'],
"4"=>['0512','- ajout du plugin ph1, ouvre le logiciel (ph1.fr) dans une iframe'],
"5"=>['0513','- ajout du module menubub, crÃ©e des menus bubbles Ã  partir d\'une table msql (insensible aux sessions)
- ajout du plugin msqedit, permet d\'Ã©diter rapidement des nouvelles tables msql crÃ©Ã©es Ã  la volÃ©e. variables: p=node, o=colonnes,a,b'],
"6"=>['0515','- finalisation de menubub, peut remplacer avantageusement le module submenus
- amÃ©liorations de msqedit
- amÃ©lioration du moteur bubble, qui Ã©tait incapable d\'ouvrir un sous-menu profond sans l\'accompagnement d\'un item dans le niveau infÃ©rieur'],
"7"=>['0516','- ajout du module last_tags, relate les derniers tags ajoutÃ©s
- rÃ©vision d\'overcats de sorte Ã  fonctionner comme menububs : ajout des rstr94 et rstr 95 pour l\'activer dans le menu admin'],
"8"=>['0517','- correctif comportement de l\'Api avec les classements utilisateurs (prms9)
- remise en fonctionnement du rendu des recherches commandÃ©es par la console url (la barre d\'adresse)'],
"9"=>['0519','- nouveau systÃ¨me de reboot auto, dÃ©clenchÃ© Ã  l\'usage d\'ajax aprÃ¨s la fermeture des sessions
- amÃ©lioration de la portÃ©e des paramÃ¨tres par dÃ©faut de l\'api notamment pour ne pas afficher la prÃ©sence des articles dÃ©sactivÃ©s dans les icÃ´nes du desktop
- dÃ©sormais les articles masquÃ©s sont inaccessibles (avant il restait le titre et un contenu rÃ©servÃ©)'],
"10"=>['0520','maintenance du menu admin : 
- comportement javascript bulle au premier plan qui Ã©teint les autres sauf son menu parent)
- en passant au menu vertical le moteur de recherche passe sous un bouton et le tite de l\'article en cours ne s\'affiche plus pendant le scroll
- rÃ©formes css'],
"11"=>['0521','- fix pb en passant par m_apps (oÃ¹ on a installÃ© le support menubub)
- remise Ã  niveau des paramÃ¨tres globaux pour les nouveaux dispositifs, adaptation Ã  l\'api'],
"12"=>['0522','- mise en place du dispositif deskpage, permet de retrouver dans un espace desktop tous les Ã©lÃ©ments de la navigation sur un site normal, c\'est Ã  dire ouvrir depuis l\'url des articles, catÃ©gories, tags, etc...'],
"13"=>['0523','- rendu possible d\'utiliser les contextes en mode desktop : l\'url appelle la sÃ©rie de modules de ce contexte
- amÃ©liorations de pad et txt'],
"14"=>['0524','- ajout d\'une nouvelle mÃ©thode-type \'desktop\', utilisÃ©e pour Ã  peu prÃ¨s tous les modules qu\'on veut voir s\'afficher en mode bureau 
- ajout du support pour desktop de \'explore\', revient Ã  crÃ©er des apps (objets de navigation) d\'aprÃ¨s des dossiers rÃ©els, sans passer par le navigateur \'finder\' (qui se charge dÃ©jÃ  de cela dans une fenÃªtre unique). l\'option \'virtual\' permet d\'utiliser les urls virtuelles plutÃ´t que les fichiers en dur.
- ajout du support pour desktop \'menubub\', qu\'on peut dÃ©clencher en mode deskop depuis une App utilisant la mÃ©thode-type \'menubub\' (il dÃ©duit le type de lien (cat, read, context...) et en fait un appel ajax via ajxlnk2'],
"15"=>['0525','- ajout du support pour desktop \'overcats\', utilise de l\'architecture des catÃ©gories d\'articles
- suppression de certains dispositis du gestionnaire en mode url (Ã  partir d\'ici le Cms ne peut plus rÃ©trograder vers les anciennes mÃ©thodes de type POST pour l\'ajout d\'un nouvel article. AprÃ¨s 6 ans, ok l\'ajax est fiable, l\'ancien dispositif va Ãªtre graduellement supprimÃ©'],
"16"=>['0530','- les articles congÃ©diÃ©s sont placÃ©s sur un _hub
- qq amÃ©liorations du gestionnaire desktop (erreurs js, background img)
- amÃ©lioration module Tracks pour lier les rÃ©sultats avec l\'Ã©tat des articles (dÃ©publiÃ©s ou congÃ©diÃ©s)'],
"17"=>['0531','- dans overcats, ajout de la suppression d\'une oc, ajout d\'aides
- ajout d\'un bouton \'preview\' dans l\'Ã©diteur sub-modules des apps
- rÃ©paration du problÃ¨me (d\'appel d\'un article puis d\'appel du background du desktop) Ã  l\'allumage sur un hub secondaire Ã  partir des dÃ©ductions de l\'appel d\'un article
- petite rÃ©novation de l\'allumage de modules assez rares
- suppression du module cssfonts (permettait de lancer des fontes supplÃ©tives ; se rÃ©fÃ©rer dÃ©sormais au css supplÃ©tif)']];