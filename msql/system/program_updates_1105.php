<?php
//philum_microsql_program_updates_1105
$r["_menus_"]=array('day','txt');
$r[1]=array('110501','syst�me de sauvegardes multiples d\'un article : ajout de l\'onglet \'backup\' (dans l\'�dition d\'articles) qui propose \'backup\', \'restore\' et \'delete\', valable pour chacune des sauvegardes d\'un articles, qui sont d\'un nombre illimit�.
Initiation d\'une nouvelle architecture pour d�passer certains probl�mes de ajax (impossibilit� de modifier un document qu\'on a modifi� !)');
$r[2]=array('110501','am�lioration du filtre automatique \'clean_punct\' (qui applique les r�gles typographiques) : d�sormais capable d\'interpr�ter le texte pour r�parer les guillemets pr�c�d�s et suivis d\'un espace (la r�gle c\'est pas d\'espaces � l\'int�rieur des guillemets)');
$r[3]=array('110502','ajout du support des Font-faces : 
- s�lection de 87 typos (.eot, .woff, .otf et m�me .ttf) qui soient web, gratuites et supportent les accents) ;
- ajout d\'un s�lecteur avec pr�visualisation de typos dans css_builder ;
C\'est une r�volution, le web ne sera plus jamais comme avant !');
$r[4]=array('110502','ajout d\'un s�lecteur rapide de balises css qui permette de s\'y habituer rapidement ;');
$r[5]=array('110503','am�lioration de fiabilit� pour css_builder (s�lection automatique des tables courantes quand on change de Hub) ; ajout d\'un menu de s�lection des tables de modules');
$r[6]=array('110503','s�lection de 1200 typos libres de droits pour font-face, dans les 3 formats (web, explorer et mobiles)');
$r[7]=array('110504','faire �viter qu\'un tag s�lectionn� n\'envoie un r�sultat alors qu\'on le d�s�ctionne � la derni�re seconde...');
$r[8]=array('110504','auto-dig_tags : s\'il n\'y a pas assez de tags pour le menus \'see_also_tags\' (le seul � ne se r�f�rer qu\'� la table du cache), la recherche s\'approfondit dans le temps jusqu\'aux 20 derniers articles');
$r[9]=array('110504','retour � la premi�re version de Filters (�dition d\'articles) : le texte trait� est toujours celui en m�moire et il ne faut pas le modifier pour que �a marche ; l\'autre version permettait de le modifier et de faire se succ�der les filtres, mais ajax ne prend pas en charge les documents longs ; pour �viter la confusion, une seule r�gle est conserv�e');
$r[10]=array('110504','r�paration pour que l\'envoi par mail et le d�ploiement d\'un article l\'envoie en entier');
$r[11]=array('110504','r�paration activation bouton de menu \'link\' pour les cat�gories');
$r[12]=array('110504','variable $sbdm dans _connectx pour interdire les sous-domaines quand un site est appel� par une Url propri�taire');
$r[13]=array('110504','sophistication du module see_also-tags et see_also-usertags pour qu\'il profite puisse produire des \'pubs\' (titre+img) ou des articles, incluant un template ponctuel');
$r[14]=array('110504','connecteur \'form\' peut recevoir un \'button\' pour nommer le bouton d\'envoi');
$r[15]=array('110504','ajout du support de nom de cat�gorie dans le module \'tag_arts\' et \'usertag_arts\' de sorte �... obtenir les articles ayant pour tag le nom de la rubrique en cours.
Cela permet la g�n�ration de cat�gories floues !');
$r[16]=array('110505','am�lioration substantielle du s�lecteur de typos : s�lection par cat�gories, par famille, par accents et par favoris, affichage des tailles, toutes ces options �tant commutatives');
$r[17]=array('110505','ajout d\'une centaines de typos de la famille \'myfonts.com\'');
$r[18]=array('110506','cr�ation d\'une nouvelle base de donn�es microsql \'server\' destin�e � concerner tous les hubs d\'un site sans pour autant �tre affect� par les mises � jour (contrairement � \'system\'');
$r[19]=array('110506','sophistication du fonctionnement des typos : elles sont r�f�renc�es dans une table publique qui arrive dans \'system/edition_typos\', puis cette table doit �tre copi�e dans \'server/edition_typos\' depuis le nouvel onglet dans admin/builders/fonts ; passer par l� permet d\'informer la table en fonction des polices pr�sentes sur le serveur et d\'alimenter la table avec des typos qui appartiennent seulement � l\'utilisateur.');
$r[20]=array('110507','prise en compte des vid�o flv lors du transport d\'article entre deux sites philum ; correctif sur l\'import en passant par \'rss1\' : un nouvel indicateur d\'option de lecteure \'nlb\' (\'nl\' pour newsletter sert � produire des url absolues) \'nlb\' fait la m�me chose mais sp�cifie que l\'article est en mode \'preview=full\' ;');
$r[21]=array('110508','ajout d\'un s�lecteur qui permet de choisir la condition � affecter � un nouveau module, afin d\'�viter d\'avoir � le faire apr�s coup, car la condition en cours n\'est pas forc�ment celle � laquelle on destine le nouveau module');
$r[22]=array('110508','renommage des connecteurs :binvalues et :graph en msql_bin et msql_graph ; cr�ation d\'un gestionnaire pour s�lectionner la base d\'apr�s des syntaxes qui peuvent �tre confuses (le 4i�me �l�ment peut �tre une ligne ou un indicateur) ; cr�ation des connecteurs :msql_html et :msql_count, le premier pour renvoyer un rendu html des connecteurs qui sont dans les donn�es de la table, le second, juste pour renvoyer le nombre d\'objets de la table (tr�s utile !)');
$r[23]=array('110508','ajout d\'une distinction �l�mentaire permettant de consid�rer des signes < et > comme n\'�tant pas les objets d\'une balise, au moment de l\'importation');
$r[24]=array('110509','ajout d\'un champ de post-traitement des articles nomm� \'linenolink\' : \'del-link\' �tait capable de suprimer un lien contenant des caract�res attendus, \'linenolink\' est capable de supprimer un lien inattendu en conservant le contenant � un num�ro de ligne connu. (les noms des auteurs d\'articles sont parfois li�s � une page sans aucun int�r�t)');
$r[25]=array('110509','ajout du support font-face qui permet d\'affecter la nouvelle d�finition � une classe css existante, plut�t que d\'avoir � aller ouvrir un panneau et y coller manuellement le nom de la typo');
$r[26]=array('110510','abandon de la classe \'t\' (titres) lors de l\'importation au profit des h2, h3 (c\'est tr�s important que la mise en forme soit confi�e � html et que les css ne servent qu\'� la pagination)');
$r[27]=array('110512','apparition de \'radio\', syst�me de lecture audio par playliste administr�e dans une base microsql :
- construction de la playliste d\'apr�s un r�pertoire ;
- redimensionnable ;
- exportable ;
- algorithmes d�ductifs ; 
- d�filement auto ;
- support d\'information connexe � chaque fichier audio (texte, images) ;
- ergonomique ;');
$r[28]=array('110512','r�troinjection de nouvelles avanc�es techniques dans \'jukebox\' : d�filement auto am�lior� (fonction infinie), scroller remani� (puret� de l\'�criture)');
$r[29]=array('110515','fonction array_flip_b qui fabrique les index (array_flip de php �crase les index identiques) ;
function array_keys_r qui vide une colonne d\'un tableau multidimensionnel (array_keys de php ne prend pas en compte les tableaux multidimensionnels) ;
fonction commune (librairie) de recherche de table microsql ;');
$r[30]=array('110516','ajout du connecteur \'ted.com\' dans l\'onglet \'medias\'');
$r[31]=array('110517','ajout de 400 typos, minutieusement class�es');
$r[32]=array('110518','am�lioration de la gestion des typos : possibilit� de les classer sur place et de cr�er des cat�gories, moteur de recherche, petites r�parations');
$r[33]=array('110519','intervention dans \'treat_links\' pour qu\'il soit capable (lors de l\'importation d\'article) de conserver le contenu d\'un lien de type javascript (o� donc, rien n\'est � prendre en compte)');
$r[34]=array('110520','am�lioration pr�sentation du menu admin ; apparition d\'un embryon de menu de gestion de l\'admin sur place pour acc�der rapidement aux fonctions courantes, comme la console, newsletter, restrictions, space_disk, hubs et css');
$r[35]=array('110521','renommage des cat�gories des modules qui servent � n\'afficher que celles qui sont compatibles avec le type de bloc de modules ; r�affectation de certaines devenues entre temps capables d\'�tre affich�es � d\'autres endroits');
$r[36]=array('110522','le module \'best_arts\' est renomm� \'most_read\' (il faut mettre � jour la console) ; \'most_read\' est plus puissant, capable de prendre en param�tre le nombre de jours et le nombre d\'articles du rendu, et capable de les faire s\'assembler par le tronc logiciel central, avec les commandes habituelles (scroll, cols ou articles)');
$r[37]=array('110523','r�novation du connecteur \'rsstwitter\' qui est renomm� \'twitter\' : ne demande en param�tre que le mot-clef au lieu du flux rss entier, et le flux est rafra�chi toutes les 5 secondes ; 
- ajout du module \'twitter\' qui relaie le connecteur du m�me nom mais en laissant la possibilit�  de r�gler manuellement les param�tres, la commande \'scroll\' et l\'option \'autorefresh\'');
$r[38]=array('110524','le module \'twitter\' �tant d�sormais capable de se rafra�chir toutes les n secondes :
ajout du plug-in \'twitter\' qui ne fait que reprendre les fonctions existantes de 3 pages, de sortes � n\'appeler que 9Ko � chaque appel au lieu de 113Ko.
Sur notre serveur, le test a montr� que le temps de chargement �tait de 1/100 de seconde par tranche de 40Ko.');
$r[39]=array('110524','ajout du connecteur html \'code\' (balise)');
$r[40]=array('110524','am�lioration du lecteur twitter : conformit� des liens @ et # (hashtags), modification du template twitter ;');
$r[41]=array('110524','admin/update offre d�sormais aux utilisateurs de niveau 6 d\'�tre tenu inform� des mises � jour');
$r[42]=array('110525','les nouveaux commentaires sont signal�s � l\'admin par mail');
$r[43]=array('110525','les r�dacteurs (niveau 3) ne peuvent plus modifier leur article une fois qu\'il a �t� publi� par un utilisateur de niveau >4');
$r[44]=array('110525','les r�dacteurs re�oivent par mail les commentaires � leur article');
$r[45]=array('110525','les r�dacteurs re�oivent un mail de confirmation quand leur article a �t� publi� (qui d�pend de la langue, �ditable dans msql/lang/?/help_txts/published_art)');
$r[46]=array('110525','remise � niveau du bouton \'twitter\', qui permet de faire circuler un article (twitter ayant chang� son fonctionnement)');
$r[47]=array('110526','possibilit� d\'appeler des connecteurs :/n (o� n est un nombre) en plus de :/2 et :/3 (largeur de colonne par rapport au bloc courant) ;
r�novation de :2cols et :3cols (texte sur plusieurs colonnes) pour accepter les petits textes (sans sauts de lignes)
suppression des classes htab et htab 3 ;');
$r[48]=array('110527','meilleure gestion des ancres non reconnues : pr�paration des donn�es pour application du filtre \'auto_anchors\'');
$r[49]=array('110528','ajout du support de transport group� : les fichiers multiples sont stock�s en .tar.gz et d�compact�s � leur arriv�e ;
d�sormais le transport des typos par updates est disponibles (aux formats .woff, .oet et .svg)');
$r[50]=array('110529','correctif d\'�radication des apostrophes typographiques ;
gestion globale des syst�mes de protection des caract�res joker de mysql (dont les apostrophes)');
$r[51]=array('110529','emp�cher l\'affichage des colonnes en mode preview');
$r[52]=array('110530','- les transports de fichiers se font au format .gz : gain de fiabilit� et de vitesse lors des mises � jour ;
- la fonction \'update_all\' transporte les fichiers r�cents au format GNU .tar.gz : la mise a jour du logiciel peut devenir enti�rement automatique');
$r[53]=array('110531','mise � niveau de l�installateur avec les nouveaux protocoles de transport de donn�es : l\'ensemble du logiciel se t�l�charge sur le serveur d\'une traite.');
$r[54]=array('110531','am�lioration des tickets : possibilit� de r�pondre � un message');

?>