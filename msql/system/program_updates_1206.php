<?php
//philum_microsql_program_updates_1206
$r["_menus_"]=array('day','text');
$r[1]=array('0601','- la pubiication d\'un atricle se fait en ajax (l\'article perd sa transparence) ;
- la hauteur du champ texte de l\'�diteur s\'adapte � la quantit� de texte ;
- le codeline (pour les connecteurs utilisateurs) peut recevoir du code sous forme de connecteurs (en codeline il n\'y a pas de crochets et les valeurs sont � la place des options) ;
les connecteurs personnalis�s publics sont rendus disponibles dans l\'�diteur et sont trait�s par les connecteurs, � la suite de ceux qui appartiennent au hub ;
- ajout des connecteurs :idart (id d\'apr�s le titre) et :version (du logiciel) ;
- ajout du connecteur personnalis� public :philum qui renvoie une somme de valeurs sur le logiciel ;');
$r[2]=array('0602','- le batch pr�sente un moyen de consulter la page en m�moire ;
- l\'importateur inclue les images au format textuel base64 ;
- mise � jour de la base des fonctions publiques du noyau et de quelques aides ;');
$r[3]=array('0603','- le champ d\'�dition rev�t le style de l\'article (c\'est tout b�te mais pratique) ;
- ajout du connecteur salvateur \':on\' : affiche le connecteur sans l\'interpr�ter (:no n\'affiche rien) ;');
$r[4]=array('0604','introduction des pictogrammes :
- la feuille css \'_menus.css\' dispara�t et devient \'_global.css\' ; elle contient les �l�ments html qui doivent �tre communs ainsi que les classes requises par le syst�me ;
- la feuille globale contient la typo \'pictos\' ;
- une microbase \'edition_pictos\' contient toutes les r�f�rences nominatives aux pictogrammes (89 entr�es) ;
- le connecteur \':picto\' permet de renvoyer un pictogramme � la taille d�sir�e ;
- un menu de boutons \'pictos\' appara�t dans l\'�diteur ;
');
$r[5]=array('0605','r�forme des css :
- la moiti� des d�finitions passent dans une feuille nomm�e \'_global.css\' ;
- l\'utilisateur n\'a que les d�finitions qui ont une signification graphique (plus rapide plus simple, plus facile � faire �voluer) ;
- refonte des css par d�faut et de l\'admin ;');
$r[6]=array('0606','r�novation de l\'�diteur css : 
- champs sous onglets, auxquels ont �t� ajout� un moyen de consulter les d�finitions de \'global\' (public_design_1), de \'basic\' (public_design_2, et design par d�faut, celui que l\'utilisateur d�cline).
- \'classic\' (public_design_3) est la premi�re d�clinaison un peu travaill�e.
- l\'admin est sur public_design_4.
- De nombreux �l�ments de page ont �t� d�faits de leur css pour se fier aux nouvelles d�finitions.
- les bases global et basic sont compl�mentaires, dans la premi�re figurent les �l�ments qui peuvent �voluer et dans la seconde, seulement les �l�ments de personnalisation.');
$r[7]=array('0607','- le niveau de priorit� affecte la transparence de l\'article ;
- correctif de l\'id unique des onglets ;
- d�poussi�rage s�lecteur rapide de couleurs (nouveaux protocoles des headers)');
$r[8]=array('0608','- nouveau composant pour remplacer les listes d�roulantes de html en objets ajax ;
- application du nouveau composant aux listes de l\'onglet \'meta\', ce qui r�duit beaucoup la charge ;');
$r[9]=array('0609','compl�tion automatique des tags');
$r[10]=array('0610','les css globaux sont d�faits de toute information de couleurs');
$r[11]=array('0611','- ajout du plugin \'notepad\', traitement de texte tr�s basique ;
- finalisation des css globaux et classiques ;
- l\'updateur affiche le nombre de fichiers mis � jours ;');
$r[12]=array('0612','- la table des css globaux est dans system/default_css_1 ;
- correctifs javascript sur l\'encodage de la compl�tion automatique ;
- la compl�tion des tags porte sur l\'ensemble de la base de donn�es ;
- suppression de la feuille externe \'sucks\' pour les menus dynamiques sous IE (pos�e dans utils.js) ;

- le transducteur prend en charge les balises pre et code ;
- le flux rss laisse passer la syntaxe des connecteurs ;
- le connecteur \'thumb\' correctement lu par le rss ;

- la variable de session \'jscode\' permet d\'injecter du js dans le header ;
- l\'appel d\'un plugin dans \'content\' n\'affiche pas le titre ;');
$r[13]=array('0613','m�nage, rangement, d�poussi�rage, et suppression de fonctions devenues obsol�tes dans l\'�dietur externe');
$r[14]=array('0614','ajout du filtre \'replace\' (ne tient pas compte des sauts de lignes)');
$r[15]=array('0615','application des r�cents protocoles � la cr�ation de nouveaux hubs');
$r[16]=array('0616','- javascript prend en charge la normalisation de certaines transactions (ajxget) ;
- r�paration enregistrement donn�e msql en ajax contenant un \'_\' qui provoquait des erreurs
- l\'ajout d\'une entr�e dans msql la place juste apr�s celle prise en r�f�rence et non plus � la fin du tableau, ce qui �vite de faire croire � l\'absence de la nouvelle entr�e ;');
$r[17]=array('0617','- possibilit� d\'utiliser le signe \"+\" dans les entr�es en ajax (interpr�t� comme un espace car elle passe par GET)');
$r[18]=array('0618','d�poussi�rage de l\'alim (rien � voir avec le logiciel !)');
$r[19]=array('0619','dans admin/tools, le mut (modif usertags, qui modifie l\'appartenance d\'un mot-clef � une cat�gorie de tags en masse) prend en charge les d�placements entre les tags et les usertags, ou des utags vers les tags ;
- �vite les doublons ;
- �vite de traiter les tags qui contiennent une portion de celui qui veut �tre d�plac� ou modifi� ;');
$r[20]=array('0620','r�novation du fonctionnement de la s�lection du langage global : 
- la sous-requ�te est centralis�e pour toutes les actions de ce type ;
- le s�lecteur ne reconstruit plus le cache, c\'est moins joli (le bouton \'global\' permet d\'�tendre l\'affectation) mais c\'est plus rapide, par exemple pendant la lecture d\'une cat�gorie ;
- le template est un peu modifi� pour la variable \'lang\' ;');
$r[21]=array('0621','- r�novation du fonctionnement de l\'�diteur de tableaux, pour qu\'il supporte les caract�res sp�ciaux ;
- ajout des fonctions javascript addslashes et stripslashes, et traitement des caract�res sp�ciaux renvoy�s par ajax ;
- r�solution d\'un certain nombre d\'exceptions lorsqu\'on appelle des connecteurs avec param�tres contenant des connecteurs avec param�tres (notamment affichage des tableaux contenant des connecteurs qui doivent �tre affich�s en brut, avec le connecteur \':on\') ;
- filtre \'easytables\' rend les tableaux plus faciles ) �diter ;');
$r[22]=array('0622','ceci est un bon bond (en avant) : ajax devient capable de traiter une requ�te d\'une taille (apparemment) illimit�e (ajax multithread) ; (restriction 53 : save_in_ajax) ');
$r[23]=array('0623','- correctif pour obtenir le bon jeu de couleurs prit en r�f�rence lorsqu\'on enqu�te sur les css globaux et par d�faut ;
- admin/tools re�oit deux outils de renommage de userclasse et de usertags ; ');
$r[24]=array('0624','- am�lioration de la fiabilit� du multithread ajax : les flux simultan�s sont num�rot�s et ordonn�s : plus aucun probl�me signal� m�me avec 100 000 caract�res - 79 min) ;
- le bouton est rendu indisponible durant l\'op�ration pour ne pas la saccager ;
- la temporisation est ordonn�e correctement, l\'article nouvellement enregistr� s\'affiche � la fin des op�rations ;
- cr�ation d\'un socket  o� envoyer les op�rations ajax sans retour ;
- tools/last_saved revient � la derni�re action d\'enregistrement (en cas d\'erreur du multihread) ; \'revert\' revient � la version enregistr�e mais \'last_saved\' revient � la version qui a voulu �tre enregistr�e (utilis� en debug)  ;
-- note : si le Mt (encore nouveau, c\'est une innovation) ne marche pas, �teindre la restriction \'save_in_ajax\' (53) et r�cup�rer les donn�es perdues par \'last_saved\'.
- le multithread se d�clenche � partir de 2136 caract�res, avec un buffer de 2000 ;
- le Mt est appliqu� � la sauvegarde d\'un article depuis l\'admin et au bloc-notes en ajax, qui deviennent illimit�s en taille ;');
$r[25]=array('0625','nouvelle m�thode de temporalit� pour AMT (ajax multi-threads, marqu� pas d�pos�e mais bon) : l\'activit� javascript est d�clench�e par l\'�tat d\'activit� de ajax, et donc (et donc...) l\'enregistrement des articles est plus rapide qu\'il ne l\'a jamais �t� auparavant.');
$r[26]=array('0626','- option du connecteur \':table\' peut recevoir un caracat�re s�parateur de colonnes, \'auto\' pour utiliser les espaces, les lignes �tant utilis�es comme s�parateur vertical ;
- les css ne sont plus exclus de la mise � jour (pas trop t�t) ;
propagation de AMT (et nouveau foisonnement de probl�mes) :
- r�paration notepad (tracer une deuxi�me voie pour AMT) ;
- r�paration de l\'admin msql en ajax ;');
$r[27]=array('0627','propagation de AMT (d�buts du WYSIWYG) :
- dans l\'�diteur et dans tools/paste : la conversion depuis le rendu vers les connecteur n\'est plus limit�es en taille ;
- dans l\'editeur rapide des articles dans l\'admin ;');
$r[28]=array('0628','les trackbacks sont en wysiwyg');
$r[29]=array('0629','correctif AMT supporte le transport du signe + (effac� par le GET)');
$r[30]=array('0630','- r�paration de l\'envoi de message � l\'admin ; 
- le champ temporel est connect� au d�tecteur \'dig\', afin de ne pas renvoyer de champ vide ;
- l\'extension temporelle porte maintenant jusqu\'� 16 ans (la prochaine extension sera ajout�e en 2020 !) ;');

?>