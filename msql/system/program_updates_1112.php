<?php
//philum_microsql_program_updates_1112
$r["_menus_"]=array('day','text');
$r[1]=array('111201','- bouton twitter envoie titre bien format�
- modif template (bouton open float right)
- ic�nes non r��crites si dimensions inf�rieures � la celle des miniatures, dans l\'inspecteur d\'ic�nes, dans l\'�diteur
- ic�nes accessibles depuis l\'�diteur externe');
$r[2]=array('111202','- une id�e surgie soudainement a permit d\'acc�l�rer encore la vitesse du moteur de recherche de 1/3 sur les tr�s gros volumes ;
- un choix prit permet de faire que les articles d\'une cat�gorie prise comme condition pour un design particulier h�ritent de ce design (c\'est plus dr�le que l\'inverse)');
$r[3]=array('111203','introduction d\'un plugin \'text\' pr�sent� par un post-it qui permet de prendre des notes � la vol�e');
$r[4]=array('111204','r�forme du syst�me des popup en ajax, progr�s, fiabilit�, pr�cision... et r�vision des �critures devenues obsol�tes (35 lignes de code supprim�es)');
$r[5]=array('111205','r�vision du viewer qui permet d\'afficher une image trop grande en plein �cran : le zoom est accessible avec la roulette sans avoir � se mettre en plein-�cran.');
$r[6]=array('111207','ajout d\'un restriction � la possibilit� d\'�tendre le contexte \'cat\' dans \'art\' nomm�e \'herit_cat\' (20)');
$r[7]=array('111208','r�forme de la nomination de la priorit� des articles : au d�but \'Une\', puis ensuite \'Stay\' �taient des nominations maladroites. La priorit� des articles est d�sormais reconnue par les termes \'*\', \'**\', voire \'***\'. Au niveau du sitemap, rien ne change, aucun argument renvoie 1, \'*\' renvoie 5 et \'**\' renvoie 10.');
$r[8]=array('111208','correctif d\'un imbroglio avec le syst�me de protection des caract�res sp�ciaux lors des transactions javascript (souvent le trop simple est l\'ennemi du fonctionnel)');
$r[9]=array('111209','- ajout du module \'plug\' qui sert � appeler un plugin, comme avec le connecteur \':plug\'
- ajout du plugin \'favs\' qui permet au visiteur de m�moriser une liste d\'articles ;
- structure am�lior�e de l\'int�gration du plugin : un �l�ment du plugin peut �tre ajout� aux options propos�es par l\'article, si la variable de session \'plgs\' est utilis�e.
- abolition de l\'usage de \'display:block\' dans les css:link (� part la d�co, �a emp�che trop de choses)');
$r[10]=array('111210','- condamnation d\'une clique de fonctions pr�historiques (10Ko), supplant�es par les routines microsql, auxquelles font d�sormais r�f�rence les tables mails, rss et url ;
- r�organisation des menus de l\'admin');
$r[11]=array('111211','petites am�liorations dans l\'admin microsql : fonctionnements, aides, pr�sentation');
$r[12]=array('111212','int�gration de l\'�diteur de nouvelles d�finitions de sites dans l\'�diteur d\'articles (de fa�on un peu brutale), et d\'un bouton \'edit\' quand ces d�finitions existent, de fa�on � r�aliser ces op�rations sur place quand se pr�sente le cas d\'une importation d\'article dont les d�finitions sont inexistantes. Elles sont cr��es � la vol�es, vierges, pr�ts � �tre �dit�es.');
$r[13]=array('111215','ajout du support de priorit� des articles, de fa�on � ne plus avoir � loger cette information parmi les tags. 
- la priorit� se d�finit dans les m�ta de l\'article
- le module \'articles\' accepte un param�tre suppl�mentaire : \'priority=0-4\' : 
A z�ro l\'article est hors-ligne, � 1 l\'article est publi� normalement, les trois niveaux sup�rieurs (2, 3, 4) conf�rent une priorit� de 5,7 et 10 dans sitemap.
- ajout du module \'priority_arts\', param 0-4');
$r[14]=array('111216','ajout du bouton \'img\' dans l\'�diteur d\'articles, qui permet de :
- placer une image connue du portfolio dans l\'article ;
- uploader une image
- importer une image depuis une url ');
$r[15]=array('111216','ajout d\'un gestionnaire de cr�ation de tableaux en ajax, beaucoup plus pratique que l\'antique syst�me d\'alertes en s�rie (30 lignes supprim�es, 20 ajout�es) ;
usage: indiquer le nombre de colonnes et de lignes, remplir les cases, et \'insert\'.');
$r[16]=array('111217','l\'assistant du connecteur :video d�sormais capable de recevoir l\'url compl�te au lieu de l\'ID (trop long � expliquer ce qu\'est l\'ID), l\'ID est extrait et le connecteur ins�r� dans le texte');
$r[17]=array('111218','- ajout param 4 et 5 dans SaveJ, 4 renvoie la value, 5 insert() le r�sultat (utilis� par l\'assistant du connecteur video)
- r�paration de l\'assistant de r�daction de commande d\'articles en s�rie
- support de uftlatin dans js');
$r[18]=array('111218','- ajout d\'un gestionnaire de plugins (program_plugs), qui permet d\'affecter des types de plugin, de fa�on � rendre disponibles ceux qui sont sp�cifiquement destin�s � �tre utilis�s par le connecteur \':plug\'.
- index des types de plugins dans la table program_plugs_type ;
- types de plugin : 
external	call directly the page
system	used by software
plug	connector [value�param:plug]
module	used by module
plgbtn	added in options of each articles
callable	iframe src : /plug/index.php?call=plugin&p=param&o=option
server	client-server application
internal	php library
dev	php example');
$r[19]=array('111219','- nouveaux boutons plus pratiques que le menu d�roulant pour d�signer la priorit� d\'un article ;
- nouveau patch \'priority\' programm� pour le 111220 qui va convertir les *, **, et *** en niveau de priorit� ;
- module \'board\' r��crit pour faire appara�tre les articles en fonction de leur niveau de priorit� ;
- emplacement \'priority\' dans l\'article ;
- video_viewer capable de discerner le type de tri (cat, tag, priority) ;');
$r[20]=array('111220','- popup d�pla�able (dev) ;
- popup fix�e � l\'�cran quand c\'est pour afficher des images plein-�cran (option d\'appel ajax=1) ;
- ajout du connecteur \'popmsq\', fonctionne comme \'poptxt\' ou \'popread\', renvoie le contenu d\'une entr�e msql dans une popup (permet d\'afficher un contenu du calepin)
- petite r�paration SliderJ qui n\'arrivait pas � afficher la derni�re image (ajout d\'une marge d\'erreur) ;');
$r[21]=array('111220','r�forme du commentaire d\'images, (img�txt) renvoie d�sormais un simple lien vers l\'image en popup, au lieu d\'une image avec un commentaire. Pour commenter une image, c\'est mieux d\'utiliser le blockquote.');
$r[22]=array('111221','- ajout du connecteur \':comment\' qui permet d\'ajouter un commentaire � une image : [img�txt:comment ]
- le texte et l\'image sont plac�s � l\'int�rieur d\'un div de la largeur de l\'image.
- utilise une nouvelle d�finition css \'blocktext\'
- ajout de \'blocktext\' dans le design par d�faut');
$r[23]=array('111222','- r�paration connecteur :comment pour les images de taille interm�diaire ;
- r�paration taille de l\'image renvoy�e en popup par un lien ;
- r�apparition du bouton \'fermer\' sur l\'image en popup pour se sortir des erreurs possibles (impossibles en fait mais on sait jamais)
- le connecteur [--] ne renvoie plus de class=\'tabc\', le hr se g�re dans le css
- correctif tableaux : ne pas afficher de lignes vides ;
- ajout de tr et td au design par d�faut (updater le design courant) ;
- petite am�lioration import vid�o
- le connecteur :comment accepte de n\'�tre pas li� � une image, dans ce cas il se souvient de la largeur de l\'image pr�c�dente.');
$r[24]=array('111223','- am�lioration sliderJ pour permettre de reconstruire les tabbles en mode manuel ;
- correctif suppression des espaces ind�sirables dans l\'interpr�tation des tableaux ;
- correctif d�tection sites philum dans l\'auto-updater de d�finitions de sites ;
- les stats affichent le r�sultat de la recherche (avant il �tait dans le graphique mais disparaissait dans les graphiques trop denses)
- ajout du module \'stats\' qui renvoie un histogramme');
$r[25]=array('111224','- le connecteur \'articles\' (qui renvoie vers le module du m�me nom) accepte trois param�tres en plus, de quoi utiliser un template personnalis� (on en a eu besoin pour pouvoir g�n�rer un texte au format spip)
- r�initialisation des sessions inattendues lors du passage d\'un \'mod\' � l\'autre (mode GSM notamment)
- ajout d\'une petite somme d�ic�nes en 16px');
$r[26]=array('111226','- ajout d\'un menu des variables existantes dans l\'�diteur de templates
- r�forme du nom \'textarea_1\' qui �tait antique pour \'txtarea\' (commodit� de dev)
- ajout du plugin \'dev\' visible dans admin/code (auth 7), permet de d\'�diter le code php, et de sauvegarder des versions dans \'history\' (version beta)');
$r[27]=array('111227','- l\'ajout de d�finitions � la vol�e n\'affiche plus que la partie utile
- nettoyage javascript : f�d�ration, suppressions et renommages
- fonction \'toggle\' plus �labor�e, sur le mod�le SaveJ (qui est la star) et application � divers endroits');
$r[28]=array('111228','- ajout du filtre \'lowcase\' qui met le texte s�lectionn� en minuscules et la premi�re lettre en majuscule
- accessibilit� des menus dans le plugin \'dev\' (admin/code)');
$r[29]=array('111229','- refonte r�gles internes de transport en js
- mise en conformit� des nouveaux protocoles dans le plugin \'dev\'');
$r[30]=array('111230','- le plugin \'dev\' m�morise les pages ouvertes (ainsi que leur r�pertoire) tandis que les fonctions utilis�es sont list�es dans le menu \'history\' ;
- connecteurs \'table\', \'table1\' et \'table2\' (1=en-t�te, 2=lignes diff�renci�es)
- relookings divers (chat, css, tableaux)
- bug connu : la largeur de colonne retourne � \'content\' (par d�faut) et y reste apr�s l\'usage d\'un \'MenusJ\' (incapable de conna�tre son contexte � cause de son ind�pendance fonctionnelle) ;');
$r[31]=array('111231','- nettoyages dus aux pr�c�dentes mutations, suppression de \'_mbr\' (r�pertoire et r�f�rences dans le css, remplac� par \'shadows\'), aides contextuelles ;
- finalement le connecteur microsql ne renvoie plus de tableau hors de la lecture de l\'article ;
- r�novation des css, anciens inspir�s de nouveaux ;
- correctif li� au renouveau de la fonction tri_rqt (beaucoup de modules y font r�f�rence, fait des tri dans les articles en cache) ;');

?>