<?php //msql/program_updates_1201
$r=["_menus_"=>['day','text'],
"1"=>['0101','- le module LOAD accepte les options \'preview\', \'full\' et \'false\' pour dÃ©terminer localement le niveau d\'affichage de la prÃ©view qui est dÃ©terminÃ© globalement dans les restrictions ;
- le module \'articles\' avec la commande \'article\' prend en compte le niveau d\'affichage demandÃ© dans le script'],
"2"=>['0102','- les modules \'system\' deviennent sensibles Ã  l\'attribut \'hide\' ; 
- les articles en mode \'preview\' n\'affichent plus la mise en forme des balises : b, i, c et h.
- et une restriction \'destroy_bich\' permet de se passer de cette option
- :msq_html ne renvoie plus de double sauts de lignes ;
- le mode d\'enregistrement des articles (ajax ou post) dÃ©pend du nombre de caractÃ¨res de l\'article (5000)'],
"3"=>['0103','l\'article enregistrÃ© en mode ajax devait Ãªtre capable des mÃªmes traitements sur l\'importation des images que ceux qui ont lieu Ã  la volÃ©e au moment oÃ¹ la page est relancÃ©e'],
"4"=>['0104','- rÃ©solution import d\'images ayant deux extensions
- les commentaires sont dÃ©sormais visibles dans une popup quand on est dans le dÃ©roulÃ©'],
"5"=>['0105','problÃ¨mes de couleur de fond de la popup, fixÃ© sur clr1, dÃ©pend de la derniÃ¨re page visitÃ©e (sessions) et donc, pour diminuer les problÃ¨mes d\'affichages, la couleur de texte est l\'inverse de la couleur de fond (invert_color)'],
"6"=>['0106','partage de fichiers:
- ne fonctionnait plus (rÃ©parÃ©)
- l\'affectation de rÃ©pertoire virtuel aussi
- prÃ©visu fichiers .swf
msql admin:
- la fonction \'repair\' dÃ©sormais les entrÃ©es vides
- le hub en cours est signalÃ© sans Ãªtre activÃ© (plus facile Ã  trouver quand ils sont tous affichÃ©s)'],
"7"=>['0107','- le module \'search\' fonctionne dÃ©sormais en ajax 
- les css par dÃ©faut sont corrigÃ©s en consÃ©quence ;
- le boolÃ©en du moteur de recherche persiste dans la navigation par pages'],
"8"=>['0108','un module \'command\' reÃ§oit les lignes de commandes de script, qui donnent accÃ¨s Ã  n\'importe quelle fonctionnalitÃ© (modules, connecteurs) ; 
le rÃ©sultat est envoyÃ© dans la balise \'content\''],
"9"=>['0111','remaniement de l\'admin et ajout d\'icones ;
l\'admin et l\'admin microsql s\'ouvrent dÃ©sormais dans une iframe dans une popup'],
"10"=>['0112','le menu \'img\' dans l\'Ã©diteur d\'articles renvoie dÃ©sormais directement le rÃ©sultat de l\'image importÃ©e dans l\'article, Ã  la position du curseur, et ferme la popup dans la foulÃ©e (code 6 de ajax)'],
"11"=>['0112','rÃ©vision graphique des popup, qui reÃ§oivent un bouton \'hide\' assez pratique quand la popup est par dessus ce qu\'on veut voir ;'],
"12"=>['0112','dÃ©sormais tous les connecteurs obtiennent la capacitÃ© de choisir entre entourer la sÃ©lection ou afficher un assistant de rÃ©daction du connecteur (dans le cas oÃ¹ aucun texte n\'est sÃ©lectionnÃ©).'],
"13"=>['0113','- les popup sont dÃ©sormais fixÃ©es Ã  l\'Ã©cran, avec une option \"Ã©pingler\" et pour les rÃ©duire ;
- amÃ©lioration du systÃ¨me des assistants de connecteurs, dÃ©tecte la prÃ©sence d\'une option et propose un deuxiÃ¨me champ, et affiche l\'aide ;
- suppression connecteur dÃ©suet \'scrut\' ;'],
"14"=>['0114','- connecteurs \'formail\' et \'msq_ads\' : ajout d\'un assistant de crÃ©ation de formulaires'],
"15"=>['0115','- le bouton \"+\" (ajout d\'article) ouvre en passant un champ qui permet d\'enregistrer directement un article depuis une url ; si les dÃ©finitions d\'importation de site sont prÃ©sentes'],
"16"=>['0116','l\'insertion d\'article par voie directe (quand seule l\'url est indiquÃ©e) acquiert la capacitÃ© d\'aspirer les images dans la foulÃ©e (avant mÃªme la crÃ©ation de l\'article) ce qui permet d\'obtenir un rÃ©sultat dÃ©finitif immÃ©diatement (enfin !) ; car avant les articles importÃ©s devaient Ãªtre lus pour pouvoir opÃ©rer les importations d\'images dans la foulÃ©e, ce qui obligeait Ã  devoir l\'afficher pour terminer le processus.'],
"17"=>['0117','l\'insertion d\'article par voie normale aussi (pourquoi ne pas y avoir pensÃ© avant, on sait pas, ah mais oui il fallait faire des tests)'],
"18"=>['0118','- on dÃ©cide que le bouton \'open\' des articles place le contenu dans une fenÃªtre scrollable, c\'est nettement plus cool ;
- nombreuses petites rÃ©parations comme aprÃ¨s chaque chambardement, sur les faÃ§ons d\'enregistrer ;
- ajout du module \'add_art\' qui permet de placer un bouton \'ajouter un article d\'aprÃ¨s une url\' sur la page, dans l\'optique de rendre ceci accessible au visiteur ;
(anniversaire du 100iÃ¨me module)'],
"19"=>['0119','- rÃ©parations sur les autorisations (prÃ©paration du niveau 4 pour l\'attacher Ã  un hub personnel cadrÃ© par le hub d\'oÃ¹ on est membre) ;
- restriction scroll_preview (35) ;
- amÃ©nagement interne sur les restrictions (74 occurrences) ;'],
"20"=>['0120','- rÃ©paration ajout des images importÃ©es par avance dans le catalogue de l\'article ;
- test pour voir, format vidÃ©o Ã  320px en mode preview ;'],
"21"=>['0121','le composant \'make_tabs\' obtient la capacitÃ© de se repositionner sur le dernier onglet sÃ©lectionnÃ©'],
"22"=>['0122','la restriction \'pub_titles\' affecte le module \'page_titles\''],
"23"=>['0123','- correction faille de sÃ©curitÃ© (auth=7 pour les objets inattendus) ;
- petit correctif template art par dÃ©faut (_EDIT avant _SUJ) ;
- \'page_titles\' utilise un template ;
- rÃ©paration connecteur \'url\' qui avait Ã©chouÃ© ;
- rÃ©paration gestion du mode d\'enregistrement au moment d\'un import'],
"24"=>['0125','l\'Ã©lÃ©ment \'add_art\' est dÃ©sormais enclenchÃ© 1000 millisecondes (1s) aprÃ¨s le clic droit : c\'est un moyen d\'obtenir une rÃ©ponse de type \'onpaste\' dont on est sÃ»r qu\'elle fonctionnera bien partout (Ã  condition de mettre 1s Ã  coller l\'url)'],
"25"=>['0126','- \'login_popup\' est un module qui permet de proposer de s\'inscrire en ouvrant le formulaire de login dans une popup
- le mod add_art obtient la capacitÃ© de garder un article non publiÃ© si le auth est insuffisant'],
"26"=>['0127','- rss_art ne duplique plus les sauts de lignes
- rÃ©novation systÃ¨me de niveau d\'auth de l\'article'],
"27"=>['0128','- rÃ©novation menu admin
- amÃ©lioration systÃ¨me des menus, pour que les submenus ajoutÃ©s aux menus soient parfaitement intÃ©grÃ©s'],
"28"=>['0129','adaptation des css par dÃ©faut des menus dÃ©roulants,
voici les changements apportÃ©s pour mettre les css en conformitÃ© avec le logiciel :

dans msql, changer 
#menuH li ul.vertical
en
#menuH.vertical li ul

ajouter une classe 
#menuH.vertical ul 
avec
float:none; box-shadow: 0px 0px 7px #bbb;

ajouter
float:none;
Ã 
#menuH li ul.vertical

ajouter
position:absolute; 
Ã 
menuH li ul

ajouter
float:left; 
Ã  
menuH ul

effacer
box-shadow: 0px 0px 7px #bbb;
dans menuH ul
et le coller dans menuH li ul
(dÃ©placer aussi le fond blanc)

dÃ©placer le 
float:left;
de menu li a
vers menu li'],
"29"=>['0130','- la page css/_menus contient les aspects par dÃ©faut et est loadÃ©e par dÃ©faut'],
"30"=>['0131','ajout du design \'cloud\' (2) devient celui par dÃ©faut, \'classic\' (1) est entretenu, les designs basiques sont ceux du node \'public\' (accessible Ã  tous les hubs), et parfois le mod associÃ© est celui de mÃªme valeur (design2 va avec mods2) '],
"31"=>['0131','finalisation (beta) de l\'aptitude du plugin \'share\' Ã  inspecter des sites distants ; le partage de fichiers devient capable de chercher les fichiers partagÃ©s sur d\'autres serveurs.']];