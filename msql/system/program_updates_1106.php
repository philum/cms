<?php
//philum_microsql_program_updates_1106
$r["_menus_"]=array('day','txt');
$r[1]=array('110601','r�novation des connecteurs vid�o pour qu\'ils renvoie plut�t des iframe que des embed');
$r[2]=array('110602','- d�placement de fonctions pour optimiser les appels ;
- renommage / mise en conformit� des plug-ins ;
- petites modifs sur le module twitter ;
- ajout d\'une classe \'twitter\' dans les css (faire un update dans css_builder pour l\'ajouter) ;
- petits correctifs pr�c�dents mouvements sur les tickets ;');
$r[3]=array('110603','petites am�liorations css_builder : 
- l\'ajout de css ouvre directement l\'�dition au bon endroit (d�tection-d�duction en cas de d�synchronisation due � la suppression de classes);
- la position est d�sign� par les noms au lieu des num�ros ;
- les tables sont r�empil�es automatiquement (pour �viter la d�synchronisation)');
$r[4]=array('110604','mise � jour de jwplayer, le lecteur .flv prend d�sormais en charge les .mp4 (et .aac), et les lecteurs QuickTime, windowsmediavideo et real media sont (tout simplement) d�pr�ci�s. Les formats suivants ne sont plus support�s (ils n\'ont jamais servi en huit ans !) : m4a .mov .mpg .wmv .asf .rmv .ram .rm');
$r[5]=array('110605','r�paration du syst�me de fabrication des Sliders');
$r[6]=array('110606','les liens contenant une image et pointant vers une image se r�duisent � l\'image du lien (souvent la grande) afin de ne pas laisser une miniature dont le lien renvoie vers la grande image (ils sont oblig�s de faire �a car leur CMS ne g�re pas les dimensions)');
$r[7]=array('110607','facilitation du bouton \'msql\' dans l\'�diteur externe : quand aucune d�finition d\'importation de site n\'est reconnue, ce bouton va cr�er l\'entr�e et afficher le formulaire o� il n\'y a plus qu\'� les �diter (mais �a peut encore s\'am�liorer)');
$r[8]=array('110608','ajout du param�tre \'google\' dans master_admin, qui accepte un identifiant google pour l\'aide au r�f�rencement en produisant une balise meta \'google-site-verification\'');
$r[9]=array('110608','correctif des r�gles de transport pendant les op�rations en ajax pour r�soudre un probl�me de caract�res interdits (r�gle global, puissante, appliqu�e partout)');
$r[10]=array('110608','am�lioration du protocole de mise � jour du programme, pour les pages t�l�charg�es une � une : bzcompress n\'�tant pas support� par tous les serveurs, base64 est utilis� � la place (aurait d� y penser avant !)');
$r[11]=array('110608','ajout d\'un plug-in \'sitemap\' : signal� par le robot.txt, sans indication, renvoie la liste des sitemaps des hubs en tenant compte du nom de sous-domaine ; appel� avec la variable \'?hub=x\', renvoie le sitemap du hub, tenant compte de la date et du niveau de priorit� donn� par les tags \'Une\' et \'Stay\'');
$r[12]=array('110609','l\'ajout d\'ancres automatique rendu capable de mettre en conformit� les r�f�rences pour y appliquer ensuite les ancres');
$r[13]=array('110609','le rendu des recherches n\'a plus � �tre pr�sent� sous la forme qui sert � la recherche (respect de la casse) ; les mots recherch�s par le moteur ou manuellement par la variable \'&look=\' font appel � la fonction str_detect(), dont le troisi�me argument, s\'il est pr�sent, ne renvoie pas les r�sultats dans lesquels aucune occurrence n\'a �t� trouv�e. ');
$r[14]=array('110610','les publi�s de trackbacks par l\'utilisateur ou par l\'admin (qui d�mod�re) font appel � la fonction user_mail_r() utilis�e par tous les envois postaux en masse (newsletter, d�ploiement, alertes...) ce qui l\'autorise d�sormais � informer les personnes ayant d�j� particip� � une discussion d\'�tre inform�es de la publication d\'un nouveau message.');
$r[15]=array('110610','mise en conformit� avec html 5 notamment en utilisant la balise <article>, et en utilisant les classes \'entry\' dans le template par d�faut');
$r[16]=array('110611','am�liorations fiabilit� : 
- trackbacks : gestion des caract�res sp�ciaux, adaptation de la largeur maximale des images/vid�os ;
- connecteur php : caract�res interdits, affichage d\'un overflow si n�cessaire �a d�passe, correctifs utiles � highlight_string() (coloration syntaxique) ;
- galerie photo ajax : pas de clignotement entre les images ;
etc...
');
$r[17]=array('110612','ajout d\'un �diteur dans le module \'connector\' pour laisser plus d\'amplitude � cr�er des objets uniques (la fonctionnalit� �tant puissante il fallait que cela se voit en ouvrant le module !)');
$r[18]=array('110612','nouveau dessin de l\'admin, fonctions isol�es pour �tre mieux joignable depuis la home dans le menu # :: penser � \'upload_admin-css\'');
$r[19]=array('110612','correctifs et am�lioration d�ergonomie dans l\'admin microsql (reorder applique sort() si les clefs ne sont pas num�riques)');
$r[20]=array('110612','cr�ation d\'une table de r�f�rence pour les fonctions de lib : system/program_functions');
$r[21]=array('110613','am�lioration substantielle du plug-in \'[exec:b]\' qui aide � tester du code en ligne (re�oit l\'aide sur les fonctions), depuis que cette appli a d�couvert un nouveau d�bouch�, la prog en ligne...');
$r[22]=array('110614','ajout du module [tab_mods:b] qui permet de consulter des modules signal�s par des onglets.
Contrairement � MenusJ qui s\'informe en temps r�el sur l\'�tat des donn�es demand�es, tab_mods utilise celles qui ont �t� charg�es mais pas affich�es.
Donc le chargement est plus long, mais son fonctionnement permet de n\'afficher que les onglets pour lesquels un contenu a �t� trouv�.');
$r[23]=array('110624','�chec d\'une fourche �volutive dont on n\'a r�percut� que les am�nagements :
- r�formes de nominations
- r�novation de css_builder, plus pr�cis : gestion des conditions
- bouton \'new_from\'
- ajouts d\'aides contextuelles
');
$r[24]=array('110624','ajout du javascript GNU/GPL \'live.js\' qui permet de visualiser en temps r�el les changements apport�s aux classes css (dans css_builder, afficher les deux fen�tres c�te � c�te)');
$r[25]=array('110625','ajout de boutons de contr�le du mode d\'enregistrement dans css_builder : afin de choisir d\'enregistrer ou non les conditions ;
nouvelle fonction \'array_append\' (pour les mises � jour, remplace array_combine_append)');
$r[26]=array('110626','augmentation de la port�e de ajax dans css_builder : le css est �ditable sur place dans le site (couleurs et classes). Si la session d\'�dition du design n\'est pas active, ce sont les css publics qui sont affect�s.');
$r[27]=array('110628','r�novation du module \'submenus\' qui supplante l\'onglet \'menus\' dans l\'admin : d�sormais on peut �crire des hi�rarchies virtuelles dans chaque module, qui re�oit les moyens d\'en g�n�rer et de les pr�visualiser.
Pour l\'utiliser il faut updater les css utilisateur et sp�cifiquement \'#menuH ul li\' (qui ne peut �tre r��crit par l\'updater puisqu\'il existe d�j�), ainsi que les css de l\'admin.');
$r[28]=array('110630','r�novation du module \'user_menus\' :
- suppression des 11 restrictions qui servaient � le d�finir ;
- �criture d\'un vrai module capable d\'ordonner et renommer les liens');
$r[29]=array('110630','connecteur :microsql
l\'utilisation s\'am�liore d\'un param�tre � de sorte � choisir parmi une ligne la donn�e d\'une colonne sp�cifique.
syntaxe [directory/hub_node_row�col:microsql ]
et pour les bases � indicatif �a donne :
syntaxe [directory/hub_node_nb_row�col:microsql ]
avec \'directory\' optionnel, o� \'lang\' choisit la langue par d�faut');

?>