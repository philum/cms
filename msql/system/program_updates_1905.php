<?php //msql/program_updates_1905
$r=["1"=>['0501','publication'],
"2"=>['0503','mise en conformitÃ© de  l\'ensemble du logiciel en vue de php7 (centaine de changements, mise Ã  jour critique)
- introduction d\'une sÃ©rie de fonctions de FractalFramework, propres aux gestionnaires de validation de variables et de tableaux'],
"3"=>['0504','phase 2 de la mise en conformitÃ© de l\'ensemble du logiciel en vue de php7 (processus ajax)'],
"4"=>['0505','phase 3 de la mise en conformitÃ© de l\'ensemble du logiciel en vue de php7 (plugins)
=> le logiciel est trÃ¨s sensiblement plus vivace, quel confort, vivement le passage Ã  php 7 !'],
"5"=>['0506','- jour 4 de la mise en conformitÃ© de l\'ensemble du logiciel en vue de php7 (finder)
- ajout d\'un gestionnaire de nom de dossiers virtuels, dans l\'outil d\'Ã©dition de tags. (ce ne sont pas exactement des tags ni des articles apparentÃ©s, ils permettent de dÃ©gager des documentations sur des thÃ¨mes dÃ©finis mentalement ; contrairement aux favoris qui permettent de confectionner des collections d\'aprÃ¨s une combinaison de mÃ©tas)'],
"6"=>['0507','- mise en conformitÃ© de l\'ensemble du logiciel en condition rÃ©elle de php7.2'],
"7"=>['0509','- rÃ©fection du clrset; en vue de l\'utiliser dans la nouvelle version des hubs'],
"8"=>['0511','- mise au banc du dÃ©funt dispositif Mercury, dommage, le code source libÃ©rÃ© est peu utilisable.
- rÃ©fection du systÃ¨me de rapatriement des mÃ©tas d\'un article'],
"9"=>['0512','- ajout d\'un point d\'accÃ¨s \'call.php\' Ã  la racine pour appeler les plugins d\'accÃ¨s direct, de faÃ§on Ã  centraliser les adaptations que cette vieille procÃ©dure de mixitÃ© des usages mixte impose ; condamnation Ã  l\'obsolescence de plug.sys et plug/lib'],
"10"=>['0513','- suppression d\'un systÃ¨me de mise en cache des tags et des options d\'articles, finalement contreproductif avec les grandes masses d\'articles'],
"11"=>['0515','- ajout du dispositif \'cortex\' en remplacement de l\'antique \'brain\', qui s\'occupe de la gestion des templates, connecteurs, et modules personnalisÃ©s'],
"12"=>['0517','- rÃ©forme gÃ©nÃ©ralisÃ©e de l\'indicateur \'nl\' (mode newsletter), provenant de diffÃ©rentes sources et s\'exprimant Ã  n\'importe quelle itÃ©ration : crÃ©ation d\'un passage spÃ©cialisÃ© le distinguant des deux autres valeurs qui n\'en firent qu\'une : niveau de preview, nombre d\'occurrences, et nl = lecture pour un environnement exogÃ¨ne (prÃ©paration Ã  l\'export, url en dur, annulation des tÃ¢ches auto, suppression des activitÃ©s logicielles sur le texte).
- l\'Api se dote de son paramÃ¨tre \'nl\'
*mise Ã  jour critique'],
"13"=>['0519','- correctif negcss, inverseur de couleur auto pour le mode nuit
- correctif folders_varts vs desktop_varts, le second permet la navigation itÃ©rative dans le premier ; les deux renvoient les articles des ou d\'un dossier virtuel(s)
- correctif constructeur de miniatures d\'images de finder dans le desktop'],
"14"=>['0520','- ajout du plugin \'proposal\', une app qui utilise deux tables msql jointes : permet de faire des propositions votÃ©es
- ajout d\'un gestionnaire inputj (ajax onkeyenter)
- ajout d\'un gestionnaire cookie()'],
"15"=>['0521','- nouveau surligneur de mot cherchÃ©, en ajax, qui a la dÃ©licatesse de ne pas surligner les mots situÃ©s Ã  l\'intÃ©rieur d\'une balise'],
"16"=>['0524','- l\'appendice call.php Ã  la racine est utilisÃ© pour les plugins \"externes\" (appelables de l\'extÃ©rieur du systÃ¨me), : vacuum, rss, api, sitemap'],
"17"=>['0525','- correctifs gestionnaire nl lors de l\'appel de l\'Api depuis l\'extÃ©rieur (dans le cas de tlex.fr)'],
"18"=>['0526','- mise au banc de toute une sÃ©rie de connecteurs liÃ©s Ã  msql, rattrapÃ©s par le paramÃ¨tre correspondant Ã  ces spÃ©cificitÃ©s (unification)'],
"20"=>['0527','- introduction du param server 14 \'servimg\', permet de spÃ©cifier un serveur oÃ¹ trouver les images manquantes'],
"19"=>['0528','- rÃ©fection du processus critique \'distribution\', responsable des mises Ã  jour
- rÃ©fection systÃ¨me de backups en vue de faire des sites miroir'],
"21"=>['0529','- mise en marche du dispositif \'transport\', permet de maintenir un site miroir
- jout du support cmd:tracks dans l\'Api, permet d\'obtenir les rÃ©sultats ayant reÃ§u des commentaires et de les afficher ; supplante le module \'tracks\' (en mieux)
- dÃ©but de finalisation de la mise en conformitÃ© php7.3.5 ; page d\'accueil (160k articles) 0.65s->.015s (env. 5x); simple page : 0.05s->0.005s (10x plus rapide) =>fulgurant !'],
"22"=>['0530','- ajout de la possibilitÃ© au menu menubub de recevoir un paramÃ¨tre, afin de permettre plusieurs menus dÃ©roulants de type menubub, destinÃ© Ã  remplacer menusJ
- ajout du type de menu ajax \'ajxlnk\', en addition Ã  ajxlnk2, module et mod, les seconds conduisant vers une popup (Ã  rÃ©viser)
- correctifs de la rÃ©vision du systÃ¨me de mise Ã  jour
- essais avec la classe phar pour remplacer l\'antique mÃ©canique (de 2003), et amÃ©lioration de la classe \'tar\' en vue de la suppression de l\'antique.'],
"23"=>['0531','- ajout des typos modernes de new york times qui sont vraiment pas mal (imperial, cheltenham et frankiln)
- les grands titres de page passe en h1 (au lieu de h2), avec rÃ©vision des css global et admin
- encore qq correctifs de notices php7.3.5 
- rÃ©vision du systÃ¨me de fabrication de pictogrammes']];