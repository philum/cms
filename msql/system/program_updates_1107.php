<?php //msql/program_updates_1107
$r=["_menus_"=>['day','txt'],
"1"=>['110702','la fonction media_trap de l\'importateur d\'articles supporte les url encodÃ©es (bÃªtement) en base64'],
"2"=>['110703','l\'option \'nobr\' des modules (qui sert Ã  ne pas ajouter un saut de ligne aprÃ¨s un module) devient conformiste : ajout d\'une colonne dans la table des modules, n\'entre plus en contradiction avec d\'autres options.
Un patch doit Ãªtre exÃ©cutÃ© pour la mise en conformitÃ©'],
"3"=>['110704','correctif pour empÃªcher l\'application des rÃ¨gles typographiques Ã  propos des espaces autour des guillemets si le nombre de guillemets est impair !'],
"4"=>['110704','correctif sur \'tab_mods\' qui ne supportait pas les espaces inopportuns dans la liste des rÃ¨gles Ã  appliquer'],
"5"=>['110704','ajout d\'un bouton \'backup_msql\' dans admin/backup pour faire des sauvegardes, mÃªme quotidiennes, de la base de donnÃ©es microsql (c\'est important car elles sont fragiles et importantes)'],
"6"=>['110705','correctif sur le plugin \'cards\' (qui fabrique des cartes de visites) pour qu\'il prenne en compte la feuille css en cours, qui peut ainsi contenir des typographies personnalisÃ©s'],
"7"=>['110705','correctif sur le systÃ¨me de mise Ã  jour des microbases pour pas effacer les anciennes entrÃ©es si aucune date de mise Ã  jour n\'est spÃ©cifiÃ©e (Ã©tait dÃ©jÃ  sensÃ© faire Ã§a)'],
"8"=>['110705','ajout d\'un bouton \'backup_msql\' dans l\'admin microsql'],
"9"=>['110705','mise Ã  jour des aides contextuelles sur les plug-ins'],
"10"=>['110706','ajout du module \'disk\' permettant de proposer un partage des fichiers de l\'espace disque utilisateurs ; possibilitÃ© de spÃ©cifier un rÃ©pertoire particulier'],
"11"=>['110706','support des css statiques dans la mise Ã  jour'],
"12"=>['110708','rÃ©paration de l\'inscription Ã  la newsletter ; ajout du support des langues'],
"13"=>['110710','rÃ©novation du gestionnaire de fichiers utilisateur :
- confort d\'utilisation ;
- miniatures des images ;
- systÃ¨me de miniatures (aussi gÃ©nÃ©rÃ©es par une navigation cÃ´tÃ© utilisateur dans le module \'disk\') dÃ©placÃ© dans un autre rÃ©pertoire que celui de l\'utilisateur ;
- suppression d\'un rÃ©pertoire et son contenu ;
- sÃ©curitÃ© des systÃ¨mes de suppression ;
- ajout du bouton \'share\' qui propose de partager un fichiers ;
- ajout de la base server/shared_files ;
- amÃ©lioration gestionnaire interne des modifications des microbases (les fonction \'msql_\' sont orientÃ©es utilisateur) ;'],
"14"=>['110714','ajout du plugin \'share\' : permet de naviguer et downloader les fichiers partagÃ©s par les autres hubs dans \'admin/disk\' ; 
La prÃ©sentation peut trier par hubs ou combiner les catÃ©gories ;
Les sons, images, vidÃ©os et textes peuvent Ãªtre visualises ; 
Les fichiers partagÃ©s utilisent un rÃ©pertoire virtuel que l\'administrateur peut gÃ©nÃ©rer pour faciliter le classement et la recherche ;'],
"15"=>['110716','module taxo_nav : comme le module \'taxonomy\', mais les noeuds ne sont pas dÃ©roulÃ©s et peuvent Ãªtre ouverts (en dev)'],
"16"=>['110718','bouton \'inject\' dans Admin/fonts : permet d\'ajouter Ã  la base server/typos les polices contenues dans une archive .tar localisÃ©e dans le rÃ©pertoire \'fonts\' de l\'espace disque utilisateur'],
"17"=>['110722','amÃ©lioration de la prÃ©sentation de la taxonomie (usage des signes ascii associÃ©s Ã  la topologie)'],
"18"=>['110725','ajout du connecteur \'msq_ads\' : permet de confier au visiteur l\'ajout d\'entrÃ©es dans une base msql ; crÃ©e un formulaire de collecte de donnÃ©es publiques.'],
"19"=>['110727','connecteur media/video : permet d\'ajouter une vidÃ©o d\'aprÃ¨s son ID (remplace les boutons associÃ©s Ã  chaque provider)'],
"20"=>['110728','finalisation du plug-in taxo_nav, accessible par le module du mÃªme nom :
- capacitÃ© Ã  ouvrir/fermer les noeuds en ajax ;
- capacitÃ© Ã  creuser dans le temps pour chercher des parents Ã©loignÃ©s et ainsi produire une taxonomie plus dÃ©veloppÃ©e'],
"21"=>['110731','ajout du connecteur msq_template qui permet de lire les donnÃ©es d\'une table microsql en utilisant la mise en forme spÃ©cifiÃ©e dans un template, comme cela : [tableÂ§template:msq_template ]'],
"22"=>['110731','le connecteur \':form\' devient \':formail\' puisqu\'il est dÃ©diÃ© uniquement Ã  l\'envoi de mails, et hÃ©rite des nouvelles dispositions pour la gÃ©nÃ©ration de formulaires']];