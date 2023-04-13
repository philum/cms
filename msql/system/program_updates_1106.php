<?php //msql/program_updates_1106
$r=["_menus_"=>['day','txt'],
"1"=>['110601','rÃ©novation des connecteurs vidÃ©o pour qu\'ils renvoie plutÃ´t des iframe que des embed'],
"2"=>['110602','- dÃ©placement de fonctions pour optimiser les appels ;
- renommage / mise en conformitÃ© des plug-ins ;
- petites modifs sur le module twitter ;
- ajout d\'une classe \'twitter\' dans les css (faire un update dans css_builder pour l\'ajouter) ;
- petits correctifs prÃ©cÃ©dents mouvements sur les tickets ;'],
"3"=>['110603','petites amÃ©liorations css_builder : 
- l\'ajout de css ouvre directement l\'Ã©dition au bon endroit (dÃ©tection-dÃ©duction en cas de dÃ©synchronisation due Ã  la suppression de classes);
- la position est dÃ©signÃ© par les noms au lieu des numÃ©ros ;
- les tables sont rÃ©empilÃ©es automatiquement (pour Ã©viter la dÃ©synchronisation)'],
"4"=>['110604','mise Ã  jour de jwplayer, le lecteur .flv prend dÃ©sormais en charge les .mp4 (et .aac), et les lecteurs QuickTime, windowsmediavideo et real media sont (tout simplement) dÃ©prÃ©ciÃ©s. Les formats suivants ne sont plus supportÃ©s (ils n\'ont jamais servi en huit ans !) : m4a .mov .mpg .wmv .asf .rmv .ram .rm'],
"5"=>['110605','rÃ©paration du systÃ¨me de fabrication des Sliders'],
"6"=>['110606','les liens contenant une image et pointant vers une image se rÃ©duisent Ã  l\'image du lien (souvent la grande) afin de ne pas laisser une miniature dont le lien renvoie vers la grande image (ils sont obligÃ©s de faire Ã§a car leur CMS ne gÃ¨re pas les dimensions)'],
"7"=>['110607','facilitation du bouton \'msql\' dans l\'Ã©diteur externe : quand aucune dÃ©finition d\'importation de site n\'est reconnue, ce bouton va crÃ©er l\'entrÃ©e et afficher le formulaire oÃ¹ il n\'y a plus qu\'Ã  les Ã©diter (mais Ã§a peut encore s\'amÃ©liorer)'],
"8"=>['110608','ajout du paramÃ¨tre \'google\' dans master_admin, qui accepte un identifiant google pour l\'aide au rÃ©fÃ©rencement en produisant une balise meta \'google-site-verification\''],
"9"=>['110608','correctif des rÃ¨gles de transport pendant les opÃ©rations en ajax pour rÃ©soudre un problÃ¨me de caractÃ¨res interdits (rÃ¨gle global, puissante, appliquÃ©e partout)'],
"10"=>['110608','amÃ©lioration du protocole de mise Ã  jour du programme, pour les pages tÃ©lÃ©chargÃ©es une Ã  une : bzcompress n\'Ã©tant pas supportÃ© par tous les serveurs, base64 est utilisÃ© Ã  la place (aurait dÃ» y penser avant !)'],
"11"=>['110608','ajout d\'un plug-in \'sitemap\' : signalÃ© par le robot.txt, sans indication, renvoie la liste des sitemaps des hubs en tenant compte du nom de sous-domaine ; appelÃ© avec la variable \'?hub=x\', renvoie le sitemap du hub, tenant compte de la date et du niveau de prioritÃ© donnÃ© par les tags \'Une\' et \'Stay\''],
"12"=>['110609','l\'ajout d\'ancres automatique rendu capable de mettre en conformitÃ© les rÃ©fÃ©rences pour y appliquer ensuite les ancres'],
"13"=>['110609','le rendu des recherches n\'a plus Ã  Ãªtre prÃ©sentÃ© sous la forme qui sert Ã  la recherche (respect de la casse) ; les mots recherchÃ©s par le moteur ou manuellement par la variable \'&look=\' font appel Ã  la fonction str_detect(), dont le troisiÃ¨me argument, s\'il est prÃ©sent, ne renvoie pas les rÃ©sultats dans lesquels aucune occurrence n\'a Ã©tÃ© trouvÃ©e. '],
"14"=>['110610','les publiÃ©s de trackbacks par l\'utilisateur ou par l\'admin (qui dÃ©modÃ¨re) font appel Ã  la fonction user_mail_r() utilisÃ©e par tous les envois postaux en masse (newsletter, dÃ©ploiement, alertes...) ce qui l\'autorise dÃ©sormais Ã  informer les personnes ayant dÃ©jÃ  participÃ© Ã  une discussion d\'Ãªtre informÃ©es de la publication d\'un nouveau message.'],
"15"=>['110610','mise en conformitÃ© avec html 5 notamment en utilisant la balise <article>, et en utilisant les classes \'entry\' dans le template par dÃ©faut'],
"16"=>['110611','amÃ©liorations fiabilitÃ© : 
- trackbacks : gestion des caractÃ¨res spÃ©ciaux, adaptation de la largeur maximale des images/vidÃ©os ;
- connecteur php : caractÃ¨res interdits, affichage d\'un overflow si nÃ©cessaire Ã§a dÃ©passe, correctifs utiles Ã  highlight_string() (coloration syntaxique) ;
- galerie photo ajax : pas de clignotement entre les images ;
etc...
'],
"17"=>['110612','ajout d\'un Ã©diteur dans le module \'connector\' pour laisser plus d\'amplitude Ã  crÃ©er des objets uniques (la fonctionnalitÃ© Ã©tant puissante il fallait que cela se voit en ouvrant le module !)'],
"18"=>['110612','nouveau dessin de l\'admin, fonctions isolÃ©es pour Ãªtre mieux joignable depuis la home dans le menu # :: penser Ã  \'upload_admin-css\''],
"19"=>['110612','correctifs et amÃ©lioration dÂergonomie dans l\'admin microsql (reorder applique sort() si les clefs ne sont pas numÃ©riques)'],
"20"=>['110612','crÃ©ation d\'une table de rÃ©fÃ©rence pour les fonctions de lib : system/program_functions'],
"21"=>['110613','amÃ©lioration substantielle du plug-in \'[exec:b]\' qui aide Ã  tester du code en ligne (reÃ§oit l\'aide sur les fonctions), depuis que cette appli a dÃ©couvert un nouveau dÃ©bouchÃ©, la prog en ligne...'],
"22"=>['110614','ajout du module [tab_mods:b] qui permet de consulter des modules signalÃ©s par des onglets.
Contrairement Ã  MenusJ qui s\'informe en temps rÃ©el sur l\'Ã©tat des donnÃ©es demandÃ©es, tab_mods utilise celles qui ont Ã©tÃ© chargÃ©es mais pas affichÃ©es.
Donc le chargement est plus long, mais son fonctionnement permet de n\'afficher que les onglets pour lesquels un contenu a Ã©tÃ© trouvÃ©.'],
"23"=>['110624','Ã©chec d\'une fourche Ã©volutive dont on n\'a rÃ©percutÃ© que les amÃ©nagements :
- rÃ©formes de nominations
- rÃ©novation de css_builder, plus prÃ©cis : gestion des conditions
- bouton \'new_from\'
- ajouts d\'aides contextuelles
'],
"24"=>['110624','ajout du javascript GNU/GPL \'live.js\' qui permet de visualiser en temps rÃ©el les changements apportÃ©s aux classes css (dans css_builder, afficher les deux fenÃªtres cÃ´te Ã  cÃ´te)'],
"25"=>['110625','ajout de boutons de contrÃ´le du mode d\'enregistrement dans css_builder : afin de choisir d\'enregistrer ou non les conditions ;
nouvelle fonction \'array_append\' (pour les mises Ã  jour, remplace array_combine_append)'],
"26"=>['110626','augmentation de la portÃ©e de ajax dans css_builder : le css est Ã©ditable sur place dans le site (couleurs et classes). Si la session d\'Ã©dition du design n\'est pas active, ce sont les css publics qui sont affectÃ©s.'],
"27"=>['110628','rÃ©novation du module \'submenus\' qui supplante l\'onglet \'menus\' dans l\'admin : dÃ©sormais on peut Ã©crire des hiÃ©rarchies virtuelles dans chaque module, qui reÃ§oit les moyens d\'en gÃ©nÃ©rer et de les prÃ©visualiser.
Pour l\'utiliser il faut updater les css utilisateur et spÃ©cifiquement \'#menuH ul li\' (qui ne peut Ãªtre rÃ©Ã©crit par l\'updater puisqu\'il existe dÃ©jÃ ), ainsi que les css de l\'admin.'],
"28"=>['110630','rÃ©novation du module \'user_menus\' :
- suppression des 11 restrictions qui servaient Ã  le dÃ©finir ;
- Ã©criture d\'un vrai module capable d\'ordonner et renommer les liens'],
"29"=>['110630','connecteur :microsql
l\'utilisation s\'amÃ©liore d\'un paramÃ¨tre Â§ de sorte Ã  choisir parmi une ligne la donnÃ©e d\'une colonne spÃ©cifique.
syntaxe [directory/hub_node_rowÂ§col:microsql ]
et pour les bases Ã  indicatif Ã§a donne :
syntaxe [directory/hub_node_nb_rowÂ§col:microsql ]
avec \'directory\' optionnel, oÃ¹ \'lang\' choisit la langue par dÃ©faut']];