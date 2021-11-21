<?php
//philum_microsql_program_updates_1605_sav
$r[1]=array('0501','publication');
$r[2]=array('0511','ajout du dispositif overcat :
- /admin/overcat permet d\'affecter un menu hiérarchique auquel s\'attache une catégorie d\'articles
- module overcats : affiche un menu ouvrable en javascript ou en bubbles ajax');
$r[3]=array('0511','- ajout d\'un convertisseur de catégorie en tags dans /admin/categories (l\'inverse, de tag vers une catégorie, est disponible dans Admin/tags)
- ajout d\'un sous-système qui empêche les doublons dans la table de liaison des tags
- amélioration du module \'submenus\', capable de faire comme \'overcats\' mais avec des liens de type du module \'link\'
- amélioration du gestionnaire de contrôle des bulles pour qu\'elles soient utilisées ailleurs que pour le menu admin');
$r[4]=array('0512','- ajout du plugin ph1, ouvre le logiciel (ph1.fr) dans une iframe');
$r[5]=array('0513','- ajout du module menubub, crée des menus bubbles à partir d\'une table msql (insensible aux sessions)
- ajout du plugin msqedit, permet d\'éditer rapidement des nouvelles tables msql créées à la volée. variables: p=node, o=colonnes,a,b');
$r[6]=array('0515','- finalisation de menubub, peut remplacer avantageusement le module submenus
- améliorations de msqedit
- amélioration du moteur bubble, qui était incapable d\'ouvrir un sous-menu profond sans l\'accompagnement d\'un item dans le niveau inférieur');
$r[7]=array('0516','- ajout du module last_tags, relate les derniers tags ajoutés
- révision d\'overcats de sorte à fonctionner comme menububs : ajout des rstr94 et rstr 95 pour l\'activer dans le menu admin');
$r[8]=array('0517','- correctif comportement de l\'Api avec les classements utilisateurs (prms9)
- remise en fonctionnement du rendu des recherches commandées par la console url (la barre d\'adresse)');
$r[9]=array('0519','- nouveau système de reboot auto, déclenché à l\'usage d\'ajax après la fermeture des sessions
- amélioration de la portée des paramètres par défaut de l\'api notamment pour ne pas afficher la présence des articles désactivés dans les icônes du desktop
- désormais les articles masqués sont inaccessibles (avant il restait le titre et un contenu réservé)');
$r[10]=array('0520','maintenance du menu admin : 
- comportement javascript bulle au premier plan qui éteint les autres sauf son menu parent)
- en passant au menu vertical le moteur de recherche passe sous un bouton et le tite de l\'article en cours ne s\'affiche plus pendant le scroll
- réformes css');
$r[11]=array('0521','- fix pb en passant par m_apps (où on a installé le support menubub)
- remise à niveau des paramètres globaux pour les nouveaux dispositifs, adaptation à l\'api');
$r[12]=array('0522','- mise en place du dispositif deskpage, permet de retrouver dans un espace desktop tous les éléments de la navigation sur un site normal, c\'est à dire ouvrir depuis l\'url des articles, catégories, tags, etc...');
$r[13]=array('0523','- rendu possible d\'utiliser les contextes en mode desktop : l\'url appelle la série de modules de ce contexte
- améliorations de pad et txt');
$r[14]=array('0524','- ajout d\'une nouvelle méthode-type \'desktop\', utilisée pour à peu près tous les modules qu\'on veut voir s\'afficher en mode bureau 
- ajout du support pour desktop de \'explore\', revient à créer des apps (objets de navigation) d\'après des dossiers réels, sans passer par le navigateur \'finder\' (qui se charge déjà de cela dans une fenêtre unique). l\'option \'virtual\' permet d\'utiliser les urls virtuelles plutôt que les fichiers en dur.
- ajout du support pour desktop \'menubub\', qu\'on peut déclencher en mode deskop depuis une App utilisant la méthode-type \'menubub\' (il déduit le type de lien (cat, read, context...) et en fait un appel ajax via ajxlnk2');
$r[15]=array('0525','- ajout du support pour desktop \'overcats\', utilise de l\'architecture des catégories d\'articles
- suppression de certains dispositis du gestionnaire en mode url (à partir d\'ici le Cms ne peut plus rétrograder vers les anciennes méthodes de type POST pour l\'ajout d\'un nouvel article. Après 6 ans, ok l\'ajax est fiable, l\'ancien dispositif va être graduellement supprimé');
$r[16]=array('0530','- les articles congédiés sont placés sur un _hub
- qq améliorations du gestionnaire desktop (erreurs js, background img)
- amélioration module Tracks pour lier les résultats avec l\'état des articles (dépubliés ou congédiés)');
$r[17]=array('0531','- dans overcats, ajout de la suppression d\'une oc, ajout d\'aides
- ajout d\'un bouton \'preview\' dans l\'éditeur sub-modules des apps
- réparation du problème (d\'appel d\'un article puis d\'appel du background du desktop) à l\'allumage sur un hub secondaire à partir des déductions de l\'appel d\'un article
- petite rénovation de l\'allumage de modules assez rares
- suppression du module cssfonts (permettait de lancer des fontes supplétives ; se référer désormais au css supplétif)');

?>