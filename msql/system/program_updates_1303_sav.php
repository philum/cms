<?php
//philum_microsql_program_updates_1303
$r["_menus_"]=array('day','text');
$r[1]=array('0301','- la d�tection des d�finitions g�n�riques est rendue secondaire apr�s les d�finitions locales (c\'est plus logique) ;
- le menu Apps est rendu sensible au param�tre \'hide\'');
$r[2]=array('0302','- petites am�liorations de l\'ordre du confort lors de l\'usage du moteur de recherche ;
- le compteur d\'articles �tait en rade (affich�s dans le menu hubs)');
$r[3]=array('0304','ajout d\'un composant tr�s primitif permettant de dessiner � main lev�e (tools/draw, plugin \'draw\' et nouvelle version de JQuery) : il faut coller le lien dans un connecteur :img afin de l\'enregistrer dans l\'article');
$r[4]=array('0306','ajout du support des images en base 64 (ce qui permet d\'enregistrer les images engendr�es par le plugin \'draw\')');
$r[5]=array('0307','fix pb de \'rien qui s\'affiche\' apr�s usage de l\'�diteur wyswyg, quand un contenu est d�j� plac�');
$r[6]=array('0309','fix pb d\'\'ic�ne \'link\' qui s\'affiche � l\'ext�rieur de la restriction \'link\' (27)');
$r[7]=array('0312','- rub_taxo r�f�re � des donn�es permanentes ; 
- le nombre d\'articles affich� tient compte des inclusions (count_r) ; ');
$r[8]=array('0312','- fix pb addressage d\'image du connecteur :web ;
- fix pb affectation de la rstr 60 aux modules d\'articles ;
- fix faille de s�curit� dans affectation des sessions ;');
$r[9]=array('0312','- am�lioration gestion recherche bool�enne : usage de \'*\' � la fin de la requ�te (commande url) ;
- ajout de rstr 62 (auto dig) : interdit l\'extension de la recherche aux plages temporelles suivantes ;');
$r[10]=array('0313','rstr 63 : edit divs, permet d\'�diter les modules sur place');
$r[11]=array('0313','am�lioration du fonctionnement de Desktop : fix pb de r�activation, interdiction ic�nes contradictoire, non affichage de la fen�tre par d�faut si on d�sire des fen�tres particuli�res (boot) ;');
$r[12]=array('0313','- correctif connecteur \'rss_read\' pour retrouver la source des images ;
- fix emp�chement de l\'affichage des articles des hubs ferm�s ;');
$r[13]=array('0314','�dition des modules : 
- r�novation du g�n�rateur de ligne de commande ;
- ajout d\'un bouton \'preview\' qui affiche le rendu des param�tres courants ;');
$r[14]=array('0314','- fix pb affichage des non-connecteurs (texte simple entre crochets) ;
- fix pb affichage du module \'codeline\' ;
- r�novation module \'contact\' (dans une popup) ;');
$r[15]=array('0315','- fix pb acc�s aux messages depuis le menu admin
- fix mauvais encodage des sauts de lignes dans la version du message envoy� par mail
- fix pas de sujet dans le mail ;
- ajout de la nomination 85 \'message � l\'admin\'');
$r[16]=array('0316','nouvelle interface du moteur de recherche, en ajax');
$r[17]=array('0317','- ajout d\'un composant \'search\' au \'user_menu\' ;
- affichage des r�sultats d\'une recherche vide portant seulement sur les param�tres ;
- possibilit� d\'appeler un article depuis son ID ;
- r�sultats mis en cache ;');
$r[18]=array('0318','- la r�daction du script d\'appel d\'articles utilise le & comme s�parateur de param�tres au lieu ~
- la console propose un bloc modules \'lab\' qui sert pour les tests');
$r[19]=array('0319','- rstr 64 : del blocks, n\'affiche pas le contenu des blocs en mode preview ;
- r�vision des appels mysql, tout passe par la fonction sql() ;');
$r[20]=array('0320','- am�lioration du comportement du Batch, qui propose lacc�s aux articles nouvellement import�s ;
- plusieurs correctifs pour les pb rencontr�s lors du traitement d\'une Url contenant des guillemets (eh oui) ;
- r�vision du flux rss (appel� comme plugin, il chargeait des scripts) ;
- les aides contextuelles pr�sentent syst�matiquement un lien vers msql pour les �diter ;');
$r[21]=array('0321','- l\'importateur ne tente plus d\'acc�der � une page en l\'absence de d�finitions, pour permettre l\'ajout de d�finitions (+ une aide contextuelle) ;
- ajout de filtres au moteur de recherche : ex: \"mot1 mot2:tag mot3:th�me\" va renvoyer les r�sultats commun aux 3 recherches, une litt�rale, une sur les tags, et une sur le tag utilisateur \'th�me\' ;');
$r[22]=array('0322','- correctif pages ajax, support du champ temporel ;
- r�vision du plugin \'book\' : pictos, images qui passaient pas, autoread ;');
$r[23]=array('0323','- petits correctifs de pr�sentation des tableaux (en css), et du d�filement des popup trop grandes (pas de scroll horizontal) ;
- fix pb affichage derni�re page dans \'book\' ;
- la table public_template n\'�tait appel�e par l\'update ;
- correctif d�tection d\'url pour l\'importateur, capable de d�tecter des variantes d\'url (r�pertoires), qui doivent figurer avant dans la table pour �tre prises en compte ;
- ajout du filtre \'titres\' dans le moteur de recherche (limite la recherche aux titres) ;');
$r[24]=array('0324','- les routines du moteur de recherche sont log�es dans un plugin (7Ko) ;
- un changement de protocole oblige � reformuler certains modules de Apps qui utilisent des appels � msql en ajax (se fier � ceux par d�faut) ;
- fix pb images dans book (pas test�) ;
- fix liens coh�rents entre pages ;
- l\'appel des pages active le module content en entier (pour pas voir les titres partir) ;');
$r[25]=array('0325','- le param�tre \'hide\' des scripts de modules n\'est plus ignor� ;
- am�lioration de la pr�sentation du mode \'flap\' du finder ;
- quelques ic�nes system ont �t� ajout�s ;');
$r[26]=array('0326','- modification du fonctionnement de la rstr 60 \'artmod\' : n\'affiche pas les modules d\'articles mais affiche un bouton pour les joindre (comme dans les popups) ;
- am�lioration du fonctionnement et de l\'apparence du syst�me des commentaires (images qui d�passent, r��dition, css, aides) ;');
$r[27]=array('0327','- ajout du connecteur :divtable, qui remplace les tables par d�faut (sans connecteur) et qui renvoie un tableau en css ;
- ajout du connecteur :plup, permet d\'ouvrir un plugin dans une popup (en dev) ;
- le template book est int�gr� aux templates par d�faut, et tous ses styles sont d�port�s dans la table css par d�faut (il faut \'append defaults\' pour les ajouter) ;');
$r[28]=array('0327','- usage de javascript dans le Flap du Finder ;
- le moteur de recherche peut recevoir une ligne de commande d\'articles du style : priority=4~nbdays=30');
$r[29]=array('0328','- ajout du connecteur :popvideo
- la navigation par pages en ajax prend en charge les appels de modules');
$r[30]=array('0328','automatisation de la cha�ne \'suggest\' : 
- la mention \'publi� par\' est ajout�e � l\'article import�
- l\'entr�e est marqu�e comme lue
- les doublons sont d�tect�s
- le visiteur acc�de � un rapport de publication de ses articles identifi�s par son email, auxquels il peut acc�der
- un mail est envoy� au visiteur pour l\'informer de la publication');
$r[31]=array('0329','- petites am�lioration de la compatibilit� lorsqu\'on se contente d\'inverser les couleurs
- les classes de \'book\' passent dans la feuille globale
- fix pb de sauts de lignes dans les commentaires
- ajout d\'un syst�me de surveillance de pr�sence de modules critiques, avec une alerte');
$r[32]=array('0330','- petites am�lioration du book : fix bad fix, css, espacements, affichage d\'une couverture en mode preview, largeur artificielle, d�filement js, multi-affichages
- fix pb de quelques �checs d\'enregistrement d\'article : autor�activation, gestion de la temporalit�
- le bouton \'�pingler\' de la popup sert aussi � la garder au premier plan');
$r[33]=array('0331','- correctifs de la g�n�ration de largeur du constructeur css (content padding compt� deux fois, et ignorer les divs inusit�es dans le module \'blocks\')
- correctifs book : multi-fen�tres, pb de largeur due au scroll
- les icones des tags renvoient le r�sultat dans une popup ;');

?>