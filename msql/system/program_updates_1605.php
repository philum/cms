<?php
//philum_microsql_program_updates_1605
$r[1]=array('0501','publication');
$r[2]=array('0511','ajout du dispositif overcat :
- /admin/overcat permet d\'affecter un menu hi�rarchique auquel s\'attache une cat�gorie d\'articles
- module overcats : affiche un menu ouvrable en javascript ou en bubbles ajax');
$r[3]=array('0511','- ajout d\'un convertisseur de cat�gorie en tags dans /admin/categories (l\'inverse, de tag vers une cat�gorie, est disponible dans Admin/tags)
- ajout d\'un sous-syst�me qui emp�che les doublons dans la table de liaison des tags
- am�lioration du module \'submenus\', capable de faire comme \'overcats\' mais avec des liens de type du module \'link\'
- am�lioration du gestionnaire de contr�le des bulles pour qu\'elles soient utilis�es ailleurs que pour le menu admin');
$r[4]=array('0512','- ajout du plugin ph1, ouvre le logiciel (ph1.fr) dans une iframe');
$r[5]=array('0513','- ajout du module menubub, cr�e des menus bubbles � partir d\'une table msql (insensible aux sessions)
- ajout du plugin msqedit, permet d\'�diter rapidement des nouvelles tables msql cr��es � la vol�e. variables: p=node, o=colonnes,a,b');
$r[6]=array('0515','- finalisation de menubub, peut remplacer avantageusement le module submenus
- am�liorations de msqedit
- am�lioration du moteur bubble, qui �tait incapable d\'ouvrir un sous-menu profond sans l\'accompagnement d\'un item dans le niveau inf�rieur');
$r[7]=array('0516','- ajout du module last_tags, relate les derniers tags ajout�s
- r�vision d\'overcats de sorte � fonctionner comme menububs : ajout des rstr94 et rstr 95 pour l\'activer dans le menu admin');
$r[8]=array('0517','- correctif comportement de l\'Api avec les classements utilisateurs (prms9)
- remise en fonctionnement du rendu des recherches command�es par la console url (la barre d\'adresse)');
$r[9]=array('0519','- nouveau syst�me de reboot auto, d�clench� � l\'usage d\'ajax apr�s la fermeture des sessions
- am�lioration de la port�e des param�tres par d�faut de l\'api notamment pour ne pas afficher la pr�sence des articles d�sactiv�s dans les ic�nes du desktop
- d�sormais les articles masqu�s sont inaccessibles (avant il restait le titre et un contenu r�serv�)');
$r[10]=array('0520','maintenance du menu admin : 
- comportement javascript bulle au premier plan qui �teint les autres sauf son menu parent)
- en passant au menu vertical le moteur de recherche passe sous un bouton et le tite de l\'article en cours ne s\'affiche plus pendant le scroll
- r�formes css');
$r[11]=array('0521','- fix pb en passant par m_apps (o� on a install� le support menubub)
- remise � niveau des param�tres globaux pour les nouveaux dispositifs, adaptation � l\'api');
$r[12]=array('0522','- mise en place du dispositif deskpage, permet de retrouver dans un espace desktop tous les �l�ments de la navigation sur un site normal, c\'est � dire ouvrir depuis l\'url des articles, cat�gories, tags, etc...');
$r[13]=array('0523','- rendu possible d\'utiliser les contextes en mode desktop : l\'url appelle la s�rie de modules de ce contexte
- am�liorations de pad et txt');
$r[14]=array('0524','- ajout d\'une nouvelle m�thode-type \'desktop\', utilis�e pour � peu pr�s tous les modules qu\'on veut voir s\'afficher en mode bureau 
- ajout du support pour desktop de \'explore\', revient � cr�er des apps (objets de navigation) d\'apr�s des dossiers r�els, sans passer par le navigateur \'finder\' (qui se charge d�j� de cela dans une fen�tre unique). l\'option \'virtual\' permet d\'utiliser les urls virtuelles plut�t que les fichiers en dur.
- ajout du support pour desktop \'menubub\', qu\'on peut d�clencher en mode deskop depuis une App utilisant la m�thode-type \'menubub\' (il d�duit le type de lien (cat, read, context...) et en fait un appel ajax via ajxlnk2');
$r[15]=array('0525','- ajout du support pour desktop \'overcats\', utilise de l\'architecture des cat�gories d\'articles
- suppression de certains dispositis du gestionnaire en mode url (� partir d\'ici le Cms ne peut plus r�trograder vers les anciennes m�thodes de type POST pour l\'ajout d\'un nouvel article. Apr�s 6 ans, ok l\'ajax est fiable, l\'ancien dispositif va �tre graduellement supprim�');
$r[16]=array('0530','- les articles cong�di�s sont plac�s sur un _hub
- qq am�liorations du gestionnaire desktop (erreurs js, background img)
- am�lioration module Tracks pour lier les r�sultats avec l\'�tat des articles (d�publi�s ou cong�di�s)');
$r[17]=array('0531','- dans overcats, ajout de la suppression d\'une oc, ajout d\'aides
- ajout d\'un bouton \'preview\' dans l\'�diteur sub-modules des apps
- r�paration du probl�me (d\'appel d\'un article puis d\'appel du background du desktop) � l\'allumage sur un hub secondaire � partir des d�ductions de l\'appel d\'un article
- petite r�novation de l\'allumage de modules assez rares
- suppression du module cssfonts (permettait de lancer des fontes suppl�tives ; se r�f�rer d�sormais au css suppl�tif)');

?>