<?php
//philum_microsql_program_updates_1303
$r["_menus_"]=array('day','text');
$r[1]=array('0301','- la détection des définitions génériques est rendue secondaire après les définitions locales (c\'est plus logique) ;
- le menu Apps est rendu sensible au paramètre \'hide\'');
$r[2]=array('0302','- petites améliorations de l\'ordre du confort lors de l\'usage du moteur de recherche ;
- le compteur d\'articles était en rade (affichés dans le menu hubs)');
$r[3]=array('0304','ajout d\'un composant très primitif permettant de dessiner à main levée (tools/draw, plugin \'draw\' et nouvelle version de JQuery) : il faut coller le lien dans un connecteur :img afin de l\'enregistrer dans l\'article');
$r[4]=array('0306','ajout du support des images en base 64 (ce qui permet d\'enregistrer les images engendrées par le plugin \'draw\')');
$r[5]=array('0307','fix pb de \'rien qui s\'affiche\' après usage de l\'éditeur wyswyg, quand un contenu est déjà placé');
$r[6]=array('0309','fix pb d\'\'icône \'link\' qui s\'affiche à l\'extérieur de la restriction \'link\' (27)');
$r[7]=array('0312','- rub_taxo réfère à des données permanentes ; 
- le nombre d\'articles affiché tient compte des inclusions (count_r) ; ');
$r[8]=array('0312','- fix pb addressage d\'image du connecteur :web ;
- fix pb affectation de la rstr 60 aux modules d\'articles ;
- fix faille de sécurité dans affectation des sessions ;');
$r[9]=array('0312','- amélioration gestion recherche booléenne : usage de \'*\' à la fin de la requête (commande url) ;
- ajout de rstr 62 (auto dig) : interdit l\'extension de la recherche aux plages temporelles suivantes ;');
$r[10]=array('0313','rstr 63 : edit divs, permet d\'éditer les modules sur place');
$r[11]=array('0313','amélioration du fonctionnement de Desktop : fix pb de réactivation, interdiction icônes contradictoire, non affichage de la fenêtre par défaut si on désire des fenêtres particulières (boot) ;');
$r[12]=array('0313','- correctif connecteur \'rss_read\' pour retrouver la source des images ;
- fix empêchement de l\'affichage des articles des hubs fermés ;');
$r[13]=array('0314','édition des modules : 
- rénovation du générateur de ligne de commande ;
- ajout d\'un bouton \'preview\' qui affiche le rendu des paramètres courants ;');
$r[14]=array('0314','- fix pb affichage des non-connecteurs (texte simple entre crochets) ;
- fix pb affichage du module \'codeline\' ;
- rénovation module \'contact\' (dans une popup) ;');
$r[15]=array('0315','- fix pb accès aux messages depuis le menu admin
- fix mauvais encodage des sauts de lignes dans la version du message envoyé par mail
- fix pas de sujet dans le mail ;
- ajout de la nomination 85 \'message à l\'admin\'');
$r[16]=array('0316','nouvelle interface du moteur de recherche, en ajax');
$r[17]=array('0317','- ajout d\'un composant \'search\' au \'user_menu\' ;
- affichage des résultats d\'une recherche vide portant seulement sur les paramètres ;
- possibilité d\'appeler un article depuis son ID ;
- résultats mis en cache ;');
$r[18]=array('0318','- la rédaction du script d\'appel d\'articles utilise le & comme séparateur de paramètres au lieu ~
- la console propose un bloc modules \'lab\' qui sert pour les tests');
$r[19]=array('0319','- rstr 64 : del blocks, n\'affiche pas le contenu des blocs en mode preview ;
- révision des appels mysql, tout passe par la fonction sql() ;');
$r[20]=array('0320','- amélioration du comportement du Batch, qui propose laccès aux articles nouvellement importés ;
- plusieurs correctifs pour les pb rencontrés lors du traitement d\'une Url contenant des guillemets (eh oui) ;
- révision du flux rss (appelé comme plugin, il chargeait des scripts) ;
- les aides contextuelles présentent systématiquement un lien vers msql pour les éditer ;');
$r[21]=array('0321','- l\'importateur ne tente plus d\'accéder à une page en l\'absence de définitions, pour permettre l\'ajout de définitions (+ une aide contextuelle) ;
- ajout de filtres au moteur de recherche : ex: \"mot1 mot2:tag mot3:thème\" va renvoyer les résultats commun aux 3 recherches, une littérale, une sur les tags, et une sur le tag utilisateur \'thème\' ;');
$r[22]=array('0322','- correctif pages ajax, support du champ temporel ;
- révision du plugin \'book\' : pictos, images qui passaient pas, autoread ;');
$r[23]=array('0323','- petits correctifs de présentation des tableaux (en css), et du défilement des popup trop grandes (pas de scroll horizontal) ;
- fix pb affichage dernière page dans \'book\' ;
- la table public_template n\'était appelée par l\'update ;
- correctif détection d\'url pour l\'importateur, capable de détecter des variantes d\'url (répertoires), qui doivent figurer avant dans la table pour être prises en compte ;
- ajout du filtre \'titres\' dans le moteur de recherche (limite la recherche aux titres) ;');
$r[24]=array('0324','- les routines du moteur de recherche sont logées dans un plugin (7Ko) ;
- un changement de protocole oblige à reformuler certains modules de Apps qui utilisent des appels à msql en ajax (se fier à ceux par défaut) ;
- fix pb images dans book (pas testé) ;
- fix liens cohérents entre pages ;
- l\'appel des pages active le module content en entier (pour pas voir les titres partir) ;');
$r[25]=array('0325','- le paramètre \'hide\' des scripts de modules n\'est plus ignoré ;
- amélioration de la présentation du mode \'flap\' du finder ;
- quelques icônes system ont été ajoutés ;');
$r[26]=array('0326','- modification du fonctionnement de la rstr 60 \'artmod\' : n\'affiche pas les modules d\'articles mais affiche un bouton pour les joindre (comme dans les popups) ;
- amélioration du fonctionnement et de l\'apparence du système des commentaires (images qui dépassent, réédition, css, aides) ;');
$r[27]=array('0327','- ajout du connecteur :divtable, qui remplace les tables par défaut (sans connecteur) et qui renvoie un tableau en css ;
- ajout du connecteur :plup, permet d\'ouvrir un plugin dans une popup (en dev) ;
- le template book est intégré aux templates par défaut, et tous ses styles sont déportés dans la table css par défaut (il faut \'append defaults\' pour les ajouter) ;');
$r[28]=array('0327','- usage de javascript dans le Flap du Finder ;
- le moteur de recherche peut recevoir une ligne de commande d\'articles du style : priority=4~nbdays=30');
$r[29]=array('0328','- ajout du connecteur :popvideo
- la navigation par pages en ajax prend en charge les appels de modules');
$r[30]=array('0328','automatisation de la chaîne \'suggest\' : 
- la mention \'publié par\' est ajoutée à l\'article importé
- l\'entrée est marquée comme lue
- les doublons sont détectés
- le visiteur accède à un rapport de publication de ses articles identifiés par son email, auxquels il peut accéder
- un mail est envoyé au visiteur pour l\'informer de la publication');
$r[31]=array('0329','- petites amélioration de la compatibilité lorsqu\'on se contente d\'inverser les couleurs
- les classes de \'book\' passent dans la feuille globale
- fix pb de sauts de lignes dans les commentaires
- ajout d\'un système de surveillance de présence de modules critiques, avec une alerte');
$r[32]=array('0330','- petites amélioration du book : fix bad fix, css, espacements, affichage d\'une couverture en mode preview, largeur artificielle, défilement js, multi-affichages
- fix pb de quelques échecs d\'enregistrement d\'article : autoréactivation, gestion de la temporalité
- le bouton \'épingler\' de la popup sert aussi à la garder au premier plan');
$r[33]=array('0331','- correctifs de la génération de largeur du constructeur css (content padding compté deux fois, et ignorer les divs inusitées dans le module \'blocks\')
- correctifs book : multi-fenêtres, pb de largeur due au scroll
- les icones des tags renvoient le résultat dans une popup ;');

?>