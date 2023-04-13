<?php //msql/program_updates_1206
$r=["_menus_"=>['day','text'],
"1"=>['0601','- la pubiication d\'un atricle se fait en ajax (l\'article perd sa transparence) ;
- la hauteur du champ texte de l\'Ã©diteur s\'adapte Ã  la quantitÃ© de texte ;
- le codeline (pour les connecteurs utilisateurs) peut recevoir du code sous forme de connecteurs (en codeline il n\'y a pas de crochets et les valeurs sont Ã  la place des options) ;
les connecteurs personnalisÃ©s publics sont rendus disponibles dans l\'Ã©diteur et sont traitÃ©s par les connecteurs, Ã  la suite de ceux qui appartiennent au hub ;
- ajout des connecteurs :idart (id d\'aprÃ¨s le titre) et :version (du logiciel) ;
- ajout du connecteur personnalisÃ© public :philum qui renvoie une somme de valeurs sur le logiciel ;'],
"2"=>['0602','- le batch prÃ©sente un moyen de consulter la page en mÃ©moire ;
- l\'importateur inclue les images au format textuel base64 ;
- mise Ã  jour de la base des fonctions publiques du noyau et de quelques aides ;'],
"3"=>['0603','- le champ d\'Ã©dition revÃªt le style de l\'article (c\'est tout bÃªte mais pratique) ;
- ajout du connecteur salvateur \':on\' : affiche le connecteur sans l\'interprÃ©ter (:no n\'affiche rien) ;'],
"4"=>['0604','introduction des pictogrammes :
- la feuille css \'_menus.css\' disparaÃ®t et devient \'_global.css\' ; elle contient les Ã©lÃ©ments html qui doivent Ãªtre communs ainsi que les classes requises par le systÃ¨me ;
- la feuille globale contient la typo \'pictos\' ;
- une microbase \'edition_pictos\' contient toutes les rÃ©fÃ©rences nominatives aux pictogrammes (89 entrÃ©es) ;
- le connecteur \':picto\' permet de renvoyer un pictogramme Ã  la taille dÃ©sirÃ©e ;
- un menu de boutons \'pictos\' apparaÃ®t dans l\'Ã©diteur ;
'],
"5"=>['0605','rÃ©forme des css :
- la moitiÃ© des dÃ©finitions passent dans une feuille nommÃ©e \'_global.css\' ;
- l\'utilisateur n\'a que les dÃ©finitions qui ont une signification graphique (plus rapide plus simple, plus facile Ã  faire Ã©voluer) ;
- refonte des css par dÃ©faut et de l\'admin ;'],
"6"=>['0606','rÃ©novation de l\'Ã©diteur css : 
- champs sous onglets, auxquels ont Ã©tÃ© ajoutÃ© un moyen de consulter les dÃ©finitions de \'global\' (public_design_1), de \'basic\' (public_design_2, et design par dÃ©faut, celui que l\'utilisateur dÃ©cline).
- \'classic\' (public_design_3) est la premiÃ¨re dÃ©clinaison un peu travaillÃ©e.
- l\'admin est sur public_design_4.
- De nombreux Ã©lÃ©ments de page ont Ã©tÃ© dÃ©faits de leur css pour se fier aux nouvelles dÃ©finitions.
- les bases global et basic sont complÃ©mentaires, dans la premiÃ¨re figurent les Ã©lÃ©ments qui peuvent Ã©voluer et dans la seconde, seulement les Ã©lÃ©ments de personnalisation.'],
"7"=>['0607','- le niveau de prioritÃ© affecte la transparence de l\'article ;
- correctif de l\'id unique des onglets ;
- dÃ©poussiÃ©rage sÃ©lecteur rapide de couleurs (nouveaux protocoles des headers)'],
"8"=>['0608','- nouveau composant pour remplacer les listes dÃ©roulantes de html en objets ajax ;
- application du nouveau composant aux listes de l\'onglet \'meta\', ce qui rÃ©duit beaucoup la charge ;'],
"9"=>['0609','complÃ©tion automatique des tags'],
"10"=>['0610','les css globaux sont dÃ©faits de toute information de couleurs'],
"11"=>['0611','- ajout du plugin \'notepad\', traitement de texte trÃ¨s basique ;
- finalisation des css globaux et classiques ;
- l\'updateur affiche le nombre de fichiers mis Ã  jours ;'],
"12"=>['0612','- la table des css globaux est dans system/default_css_1 ;
- correctifs javascript sur l\'encodage de la complÃ©tion automatique ;
- la complÃ©tion des tags porte sur l\'ensemble de la base de donnÃ©es ;
- suppression de la feuille externe \'sucks\' pour les menus dynamiques sous IE (posÃ©e dans utils.js) ;

- le transducteur prend en charge les balises pre et code ;
- le flux rss laisse passer la syntaxe des connecteurs ;
- le connecteur \'thumb\' correctement lu par le rss ;

- la variable de session \'jscode\' permet d\'injecter du js dans le header ;
- l\'appel d\'un plugin dans \'content\' n\'affiche pas le titre ;'],
"13"=>['0613','mÃ©nage, rangement, dÃ©poussiÃ©rage, et suppression de fonctions devenues obsolÃ¨tes dans l\'Ã©dietur externe'],
"14"=>['0614','ajout du filtre \'replace\' (ne tient pas compte des sauts de lignes)'],
"15"=>['0615','application des rÃ©cents protocoles Ã  la crÃ©ation de nouveaux hubs'],
"16"=>['0616','- javascript prend en charge la normalisation de certaines transactions (ajxget) ;
- rÃ©paration enregistrement donnÃ©e msql en ajax contenant un \'_\' qui provoquait des erreurs
- l\'ajout d\'une entrÃ©e dans msql la place juste aprÃ¨s celle prise en rÃ©fÃ©rence et non plus Ã  la fin du tableau, ce qui Ã©vite de faire croire Ã  l\'absence de la nouvelle entrÃ©e ;'],
"17"=>['0617','- possibilitÃ© d\'utiliser le signe \"+\" dans les entrÃ©es en ajax (interprÃ©tÃ© comme un espace car elle passe par GET)'],
"18"=>['0618','dÃ©poussiÃ©rage de l\'alim (rien Ã  voir avec le logiciel !)'],
"19"=>['0619','dans admin/tools, le mut (modif usertags, qui modifie l\'appartenance d\'un mot-clef Ã  une catÃ©gorie de tags en masse) prend en charge les dÃ©placements entre les tags et les usertags, ou des utags vers les tags ;
- Ã©vite les doublons ;
- Ã©vite de traiter les tags qui contiennent une portion de celui qui veut Ãªtre dÃ©placÃ© ou modifiÃ© ;'],
"20"=>['0620','rÃ©novation du fonctionnement de la sÃ©lection du langage global : 
- la sous-requÃªte est centralisÃ©e pour toutes les actions de ce type ;
- le sÃ©lecteur ne reconstruit plus le cache, c\'est moins joli (le bouton \'global\' permet d\'Ã©tendre l\'affectation) mais c\'est plus rapide, par exemple pendant la lecture d\'une catÃ©gorie ;
- le template est un peu modifiÃ© pour la variable \'lang\' ;'],
"21"=>['0621','- rÃ©novation du fonctionnement de l\'Ã©diteur de tableaux, pour qu\'il supporte les caractÃ¨res spÃ©ciaux ;
- ajout des fonctions javascript addslashes et stripslashes, et traitement des caractÃ¨res spÃ©ciaux renvoyÃ©s par ajax ;
- rÃ©solution d\'un certain nombre d\'exceptions lorsqu\'on appelle des connecteurs avec paramÃ¨tres contenant des connecteurs avec paramÃ¨tres (notamment affichage des tableaux contenant des connecteurs qui doivent Ãªtre affichÃ©s en brut, avec le connecteur \':on\') ;
- filtre \'easytables\' rend les tableaux plus faciles ) Ã©diter ;'],
"22"=>['0622','ceci est un bon bond (en avant) : ajax devient capable de traiter une requÃªte d\'une taille (apparemment) illimitÃ©e (ajax multithread) ; (restriction 53 : save_in_ajax) '],
"23"=>['0623','- correctif pour obtenir le bon jeu de couleurs prit en rÃ©fÃ©rence lorsqu\'on enquÃªte sur les css globaux et par dÃ©faut ;
- admin/tools reÃ§oit deux outils de renommage de userclasse et de usertags ; '],
"24"=>['0624','- amÃ©lioration de la fiabilitÃ© du multithread ajax : les flux simultanÃ©s sont numÃ©rotÃ©s et ordonnÃ©s : plus aucun problÃ¨me signalÃ© mÃªme avec 100 000 caractÃ¨res - 79 min) ;
- le bouton est rendu indisponible durant l\'opÃ©ration pour ne pas la saccager ;
- la temporisation est ordonnÃ©e correctement, l\'article nouvellement enregistrÃ© s\'affiche Ã  la fin des opÃ©rations ;
- crÃ©ation d\'un socket  oÃ¹ envoyer les opÃ©rations ajax sans retour ;
- tools/last_saved revient Ã  la derniÃ¨re action d\'enregistrement (en cas d\'erreur du multihread) ; \'revert\' revient Ã  la version enregistrÃ©e mais \'last_saved\' revient Ã  la version qui a voulu Ãªtre enregistrÃ©e (utilisÃ© en debug)  ;
-- note : si le Mt (encore nouveau, c\'est une innovation) ne marche pas, Ã©teindre la restriction \'save_in_ajax\' (53) et rÃ©cupÃ©rer les donnÃ©es perdues par \'last_saved\'.
- le multithread se dÃ©clenche Ã  partir de 2136 caractÃ¨res, avec un buffer de 2000 ;
- le Mt est appliquÃ© Ã  la sauvegarde d\'un article depuis l\'admin et au bloc-notes en ajax, qui deviennent illimitÃ©s en taille ;'],
"25"=>['0625','nouvelle mÃ©thode de temporalitÃ© pour AMT (ajax multi-threads, marquÃ© pas dÃ©posÃ©e mais bon) : l\'activitÃ© javascript est dÃ©clenchÃ©e par l\'Ã©tat d\'activitÃ© de ajax, et donc (et donc...) l\'enregistrement des articles est plus rapide qu\'il ne l\'a jamais Ã©tÃ© auparavant.'],
"26"=>['0626','- option du connecteur \':table\' peut recevoir un caracatÃ¨re sÃ©parateur de colonnes, \'auto\' pour utiliser les espaces, les lignes Ã©tant utilisÃ©es comme sÃ©parateur vertical ;
- les css ne sont plus exclus de la mise Ã  jour (pas trop tÃ´t) ;
propagation de AMT (et nouveau foisonnement de problÃ¨mes) :
- rÃ©paration notepad (tracer une deuxiÃ¨me voie pour AMT) ;
- rÃ©paration de l\'admin msql en ajax ;'],
"27"=>['0627','propagation de AMT (dÃ©buts du WYSIWYG) :
- dans l\'Ã©diteur et dans tools/paste : la conversion depuis le rendu vers les connecteur n\'est plus limitÃ©es en taille ;
- dans l\'editeur rapide des articles dans l\'admin ;'],
"28"=>['0628','les trackbacks sont en wysiwyg'],
"29"=>['0629','correctif AMT supporte le transport du signe + (effacÃ© par le GET)'],
"30"=>['0630','- rÃ©paration de l\'envoi de message Ã  l\'admin ; 
- le champ temporel est connectÃ© au dÃ©tecteur \'dig\', afin de ne pas renvoyer de champ vide ;
- l\'extension temporelle porte maintenant jusqu\'Ã  16 ans (la prochaine extension sera ajoutÃ©e en 2020 !) ;']];