<?php
//philum_microsql_program_updates_1201
$program_updates_1201["_menus_"]=array('day','text');
$program_updates_1201[1]=array('1201',"- le module LOAD accepte les options 'preview', 'full' et 'false' pour déterminer localement le niveau d'affichage de la préview qui est déterminé globalement dans les restrictions ;
- le module 'articles' avec la commande 'article' prend en compte le niveau d'affichage demandé dans le script");
$program_updates_1201[2]=array('1202',"- les modules 'system' deviennent sensibles à l'attribut 'hide' ; 
- les articles en mode 'preview' n'affichent plus la mise en forme des balises : b, i, c et h.
- et une restriction 'destroy_bich' permet de se passer de cette option
- :msq_html ne renvoie plus de double sauts de lignes ;
- le mode d'enregistrement des articles (ajax ou post) dépend du nombre de caractères de l'article (5000)");
$program_updates_1201[3]=array('1203',"l'article enregistré en mode ajax devait être capable des mêmes traitements sur l'importation des images que ceux qui ont lieu à la volée au moment où la page est relancée");
$program_updates_1201[4]=array('1204',"- résolution import d'images ayant deux extensions
- les commentaires sont désormais visibles dans une popup quand on est dans le déroulé");
$program_updates_1201[5]=array('1205',"problèmes de couleur de fond de la popup, fixé sur clr1, dépend de la dernière page visitée (sessions) et donc, pour diminuer les problèmes d'affichages, la couleur de texte est l'inverse de la couleur de fond (invert_color)");
$program_updates_1201[6]=array('1206',"partage de fichiers:
- ne fonctionnait plus (réparé)
- l'affectation de répertoire virtuel aussi
- prévisu fichiers .swf
msql admin:
- la fonction 'repair' désormais les entrées vides
- le hub en cours est signalé sans être activé (plus facile à trouver quand ils sont tous affichés)");
$program_updates_1201[7]=array('1207',"- le module 'search' fonctionne désormais en ajax 
- les css par défaut sont corrigés en conséquence ;
- le booléen du moteur de recherche persiste dans la navigation par pages");
$program_updates_1201[8]=array('1208',"un module 'command' reçoit les lignes de commandes de script, qui donnent accès à n'importe quelle fonctionnalité (modules, connecteurs) ; 
le résultat est envoyé dans la balise 'content'");
$program_updates_1201[9]=array('1211',"remaniement de l'admin et ajout d'icones ;
l'admin et l'admin microsql s'ouvrent désormais dans une iframe dans une popup");
$program_updates_1201[10]=array('1212',"le menu 'img' dans l'éditeur d'articles renvoie désormais directement le résultat de l'image importée dans l'article, à la position du curseur, et ferme la popup dans la foulée (code 6 de ajax)");
$program_updates_1201[11]=array('1212',"révision graphique des popup, qui reçoivent un bouton 'hide' assez pratique quand la popup est par dessus ce qu'on veut voir ;");
$program_updates_1201[12]=array('1212',"désormais tous les connecteurs obtiennent la capacité de choisir entre entourer la sélection ou afficher un assistant de rédaction du connecteur (dans le cas où aucun texte n'est sélectionné).");
$program_updates_1201[13]=array('1213','- les popup sont désormais fixées à l\'écran, avec une option \"épingler\" et pour les réduire ;
- amélioration du système des assistants de connecteurs, détecte la présence d\'une option et propose un deuxième champ, et affiche l\'aide ;
- suppression connecteur désuet \'scrut\' ;');
$program_updates_1201[14]=array('1214',"- connecteurs 'formail' et 'msq_ads' : ajout d'un assistant de création de formulaires");
$program_updates_1201[15]=array('1215','- le bouton \"+\" (ajout d\'article) ouvre en passant un champ qui permet d\'enregistrer directement un article depuis une url ; si les définitions d\'importation de site sont présentes');
$program_updates_1201[16]=array('1216',"l'insertion d'article par voie directe (quand seule l'url est indiquée) acquiert la capacité d'aspirer les images dans la foulée (avant même la création de l'article) ce qui permet d'obtenir un résultat définitif immédiatement (enfin !) ; car avant les articles importés devaient être lus pour pouvoir opérer les importations d'images dans la foulée, ce qui obligeait à devoir l'afficher pour terminer le processus.");
$program_updates_1201[17]=array('1217',"l'insertion d'article par voie normale aussi (pourquoi ne pas y avoir pensé avant, on sait pas, ah mais oui il fallait faire des tests)");
$program_updates_1201[18]=array('1218',"- on décide que le bouton 'open' des articles place le contenu dans une fenêtre scrollable, c'est nettement plus cool ;
- nombreuses petites réparations comme après chaque chambardement, sur les façons d'enregistrer ;
- ajout du module 'add_art' qui permet de placer un bouton 'ajouter un article d'après une url' sur la page, dans l'optique de rendre ceci accessible au visiteur ;
(anniversaire du 100ième module)");
$program_updates_1201[19]=array('1219',"- réparations sur les autorisations (préparation du niveau 4 pour l'attacher à un hub personnel cadré par le hub d'où on est membre) ;
- restriction scroll_preview (35) ;
- aménagement interne sur les restrictions (74 occurrences) ;");
$program_updates_1201[20]=array('1220',"- réparation ajout des images importées par avance dans le catalogue de l'article ;
- test pour voir, format vidéo à 320px en mode preview ;");
$program_updates_1201[21]=array('1221',"le composant 'make_tabs' obtient la capacité de se repositionner sur le dernier onglet sélectionné");
$program_updates_1201[22]=array('1222',"la restriction 'pub_titles' affecte le module 'page_titles'");
$program_updates_1201[23]=array('1223',"- correction faille de sécurité (auth=7 pour les objets inattendus) ;
- petit correctif template art par défaut (_EDIT avant _SUJ) ;
- 'page_titles' utilise un template ;");

?>