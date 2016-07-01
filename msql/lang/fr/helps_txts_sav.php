<?php
//philum_microsql_helps_txts_sav
$r["_menus_"]=array('description');
$r["philum_pub_txt"]=array('[[http://philum.net/236�[phi1�32::picto]:popart] [v[:ver]�txtsmall2:css] [http://philum.net�[logo:picto]]:center]');
$r["update_ok_alert"]=array('');
$r["conn_help_txt"]=array('Les connecteurs remplacent le code html par des fonctions interrogeables avec une s�quence de variables, du type de celles-ci :

Connecteurs de mise en forme :
- [lien�mot] : \'mot\' attach� � un \'lien\' ;
- [mot:b] : \'mot\' en \'bold\' ;
- [[http://lien.com�exemple]:b] ou [http://lien.com�[exemple:b]] : les connecteurs sont it�ratifs ;
- [lien.extension] : certains m�dias [.jpg.mp3.flv.pdf.swf] font appel � des lecteurs

Connecteurs logiciels :
- [:connector] : appel minimal
- [value:connector] : indique une valeur
- [value�param:connector] : pr�cise un param�tre
- [value�param1/param2:connector] : param�tre multiple, ex: [img.jpg�140/140:thumb]
- [param1/param2�value.extension] : (param � gauche) ex: [640/480/&flvar=true�MyFlashMovie.swf]
- [ID:read�open:jconn] : un connecteur comme valeur

Codeline (pour le html)
- [_VAR�div:bal] : une balise div qui s\'affiche si _VAR est non vide ;
- [_VAR�div|id|css:balise] : une balise qui s\'affiche m�me si _VAR est vide ;

Instructions
- [param/title/command/option:module->target�button[,]] : la plus compliqu�e, appelle une s�rie de modules depuis un connecteur, en pr�cisant leurs param�tres en plus des param�tre du connecteur (\'module\' ou \'ajax\')');
$r["shop_class"]=array('Cette section est laiss�e � l\'abandon

- cr�er un article par produit
- le module \'cart\' affiche les �l�ments ajout�s au panier
- tous les articles affili�s entre eux peuvent �tre appel�s en forme de tableau de produits si on appelle l\'article parent : [ID:shop]
- appeler un ou une s�rie d\'ID de fiches s�par�s par une virgule : [123,124,125:prod]
- Le connecteur [:form] renvoie un formulaire �ditable');
$r["console"]=array('La console administre les donn�es d\'une table dont le pr�fixe est \'mod\'. Les \"mods\" contiennent la structure des modules du site entier. On peut s�lectionner ou interchanger les mods (voir Params 1).

Les modules sont charg�s en cascade (comme css) : le dernier efface le pr�c�dent. Les conditions sont des it�rations : home/cat/art.
Si rien n\'est sp�cifi� le module en All reste affich� en cat et en art (en lecture de cat�gorie ou d\'article).

[backup / restaurer:b] : sauvegarde et restauration du jeu de modules (� faire avant de travailler dessus)
[d�faut:b] : table par d�faut
[r�actualiser:b] : utile apr�s une modification externe (dans l\'admin Msql, ou pendant la phase de tests avec le constructeur css ouvert dans une autre fen�tre)
[test:b] : pour faire des tests ou obtenir le script d\'un module');
$r["trackbacks"]=array('En attente de mod�ration');
$r["microxml"]=array('envoie/re�oit une table microsql via Xml');
$r["newhub_mail"]=array('Votre inscription a �t� enregistr�e avec succ�s !

Rappel de vos identifiants :
login : _USER
passe : _PASS

Conservez ce message afin de ne pas perdre vos identifiants
(en cas de 3 Login infructueux vous recevez un email de rappel)');
$r["anchor_select"]=array('S�lectionner la deuxi�me partie de l\'Ancre :');
$r["anchor_dbclic"]=array('utiliser un double-clic si la r�f�rence existe d�j�');
$r["anchor_manual"]=array('Ajouter des ancres au texte s�lectionn� (haut et bas)');
$r["anchor_auto"]=array('le texte doit contenir deux fois (1) ou [1]');
$r["published_art"]=array('Votre article a �t� publi�');
$r["trackmail"]=array('Un nouveau commentaire a �t� publi�');
$r["restrictions"]=array('Acc�s|Contenu|Articles|art_info|user_menu');
$r["design"]=array('En mode d\'�dition les changements ne sont pas visibles par le visiteur, jusqu\'� ce qu\'ils soient \'appliqu�s\' (Apply).

Le design utilisateur est une d�clinaison du design par d�faut (nomm� \'basic\') et h�rite de \'_global.css\'.

:: Save
- [use_design_15:b] :: applique le design sans enregistrer (session)
:: le module \'design\' affiche celui de la session, mais le design r�ellement enregistr� appara�t dans la fen�tre d\'�dition du module.
- [save:b] :: enregistre la table des d�finitions et cr�e la css, sans affecter les modules courants (contrairement � \'Apply\')
- [backup:b] :: fait une sauvegarde de la table (qui peut �tre restaur�e ensuite)
- [Apply / mods_1:b] :: rend le design visible par les visiteurs
- [exit:b] :: �teint la session d\'�dition

:: Select
- [design:15/clrset:15:b] :: s�lecteur de tables
- [herit:b] :: enregistre les donn�es d\'une autre table dans la table courante (design ou couleurs)
- [new_from:b] :: cr�e un design d\'apr�s celui en cours
- [make_public:b] :: publie le design sur le hub public
- [inform_public:b] :: met � jour la table publique du m�me nom
- [rebuild:b] :: cr�e un nouveau design d\'apr�s celui en cours

:: Restore / Refresh / Defaults
- [design, clrset:b] :: r�tablit la sauvegarde
- [reset: design, clrset:b] :: utilise les d�finitions par d�faut
- [append_defaults:b] :: ajoute les nouvelles d�finitions du design par d�faut (non invasif)
- [inject_globals:b] :: injecte les d�finitions du design global,  y compris dans les classes existantes (invasif, permet de contr�ler le design des �l�ments du syst�me)
- [refresh: saved_css, dev_css, clrset:b] :: permet de consulter les fichiers fabriqu�s
- [92 objects:b] : nombre d\'objets dans la table');
$r["designwidths"]=array('La gestion des largeurs permet affecter toutes les classes css concern�es.
Certaines largeurs artificielles sont estim�es et enregistr�es dans des modules syst�me.
Elles d�terminent les limites pour les images et vid�os.
Elles peuvent etre affin�e en faisant des tests.

Une largeur de z�ro signifie qu\'on va ignorer cette colonne et la retirer de la liste des blocs de modules, qui sont sp�cifi�s dans le module \'system\' \'blocks\'.
Si par exemple on permute la colonne de gauche � droite, il faut veiller � ce qu\'il y ait des modules dans \'rightbar\'.

La case \'inform_blocks\' signifie que le r�sultat va �tre enregistr� dans la table de modules, et donc que les visiteurs du site verront les changements, si on travaille sur les mods publi�.

Certains modules sont en cache, si bien que parfois les effets ne sont visibles qu\'en relan�ant le logiciel (appel de /hub, /?id== ou /reload)');
$r["designcond"]=array('Le d�marrage d\'une session d\'�dition de design utilise des feuilles css cr��es sp�cialement (dev).
Seuls les boutons \'Apply\' vont affecter les css utilis�s par les visiteurs.
Le design propos� pour �tre �dit� est celui qui est en cours au moment de la navigation.

Ouvrez deux fen�tres pour voir les effets des changements

Pour cibler un css dans un contexte, il faut dupliquer le module design et lui sp�cifier une condition');
$r["formail"]=array('Merci pour votre message');
$r["userforms"]=array('Vos donn�es ont bien �t� enregistr�es');
$r["fontserver"]=array('Cette disposition permet d\'injecter les nouvelles d�finitions de typos � la table \'server/edition_typos\', 
car elle n\'est pas concern�e par les mises � jour.

Les nouvelles d�finitions peuvent provenir :
- des mises � jour (de \'system/edition_typos\') ;
- de la pr�sence d\'une archive .tar dans le dossier \'/fonts\' de l\'espace disque utilisateur, contenant les versions .woff, .eot, et .svg d\'une m�me typo ;
- du plugin \'addfonts\' qui permet d\'importer des fonts depuis le web, en se r�f�rant � une classe css \'@font-face\'.');
$r["clbasic"]=array('- Les templates utilisent le \'codeline\' qui sont des connecteurs d�di�s � l\'�criture de balises html ;
- Les connecteurs et modules personnalis�s peuvent �tre r�dig�s en \'codeline_basic\', qui permet d\'appeler des fonctions du noyau.
- Si un connecteur ou un module est �crit en codeline (avec des crochets) le code basic ne sera pas interpr�t�.
- _PARAM est le nom de la variable qui arrive du connecteur. On peut la traiter s\'il y a plusieurs sous-param�tres.
- On peut affecter des variables nomm�es _1, _2, etc... Elles correspondent aux colonnes d\'un tableau.

[syntaxe du Basic ::b]

Il s\'�crit de droite � gauche sur une ligne. A la diff�rence des connecteurs, le param�tre le plus important est situ� apr�s le \'�\'. Son absence signifie toujours \"pas d\'option\").

Un indicatif (premier caract�re d\'un ligne) permet certains traitements du r�sultat :

[/slash : ignore la ligne
/affecte 81 � la var1 si elle n\'existe pas
?_1=81
/stocke <b>81</b>
+_1�b:balise
/see: print_r
/restitue la valeur
/-_1
/�_1:text
/affecte et �crase
!_2=_1
/affiche variable
-_2:code]

[exemples ::b]

[/delare variable si vide
?_PARAM=hello

/Applique css au param�tre re�u du connecteur :
_PARAM�txtit:css ou directement �txtit:css

/it�ration (premier = value du second)
txtit:css�u:html

/lit la table
+system/edition_typosbrowsers/�msql_read:core
/affiche un tableau 
-make_table:core
/lecture des variables 0 et 1 d\'un tableau :
-_1 _2:text:code]

Quelques exemples sont fournis parmi les connecteurs, templates et modules publics.');
$r["templates"]=array('Les templates d\'articles peuvent �tre assign�s :
- de fa�on globale dans la console (module system/template), 
- de fa�on locale dans l\'article lui-m�me, 
- ou de fa�on ponctuelle comme option de commande du module \'articles\'.

Pour les autres templates que celui de l\'article, il faut activer la restriction 55 \'user templates\', et enregistrer une version modifi�e du template par d�faut, du m�me nom. 
En l\'absence de template utilisateur, le logiciel cherche un template public avant de se r�f�rer � celui par d�faut.

Si la restriction \'user templates\' (55) est activ�e, la machine ira chercher le template utilisateur puis le public, avant d\'utiliser celui par d�faut. Pour �viter qu\'un template public ne supplante celui par d�faut, il suffit de sauver ce dernier pour en faire un template utilisateur.');
$r["track_follow"]=array('Indiquer un mail pour recevoir les autres commentaires');
$r["track_captcha"]=array('copier le code ici');
$r["update_ok"]=array('Le logiciel a �t� mis a jour');
$r["update_help"]=array('si une erreur survient, entrer en');
$r["upload_folder"]=array('s�lectionner le r�pertoire o� envoyer le document ;
pour envoyer un r�pertoire d\'images il suffit de les contenir dans une archive .tar');
$r["bool"]=array('M�thode bool�enne : r�sultats communs aux recherches faites sur chaque mot');
$r["dev"]=array('Le r�pertoire /progb contient une copie du programme. Il faut passer en mode Dev (/?dev=dev) pour que les modifs prennent effet.
\'2prod\' copie les fichiers de /progb dans /prog. (les fichiers doivent avoir une permission suffisante)');
$r["blocsystem"]=array('Le bloc \'system\' n\'est pas consid�r� comme une Div.
Il d�finit les param�tres globaux. Certains modules sont critiques.');
$r["import_art"]=array('URL de l\'article � importer');
$r["public_design"]=array('Ceci affectera le design visible par le public');
$r["modules"]=array('- content : pr�vu pour la div du contenu principale ;
- multi : peut �tre affich� partout plusieurs fois ;
- once : ne peut �tre affich� qu\'une seule fois (les modules d�j� utilis�s ne s\'affichent plus) ; 
- connectors : raccourcis vers des connecteurs ;
- articles : affili� � l\'article en cours ;
- user  : modules utilisateur');
$r["rssurl_1"]=array('Renvoie les articles r�cents des flux rss dont on est s�r de vouloir aspirer tous les articles. Seuls sont concern�s les flux marqu� 1 � la colonne \'bot\' de la table \'rssurl\'.
L\'op�ration arr�te la recherche au premier article reconnu de chaque flux.
');
$r["words"]=array('Mots connus class�s par pertinence');
$r["book"]=array('param�tre multiple [,] : 
- script d\'appel d\'articles ; 
- liste d\'ID [ ] ;
4 options [/] :
- le titre du livre ;
- 1=ID croissant, 2= ordre inverse ;
- un template de mise en forme (\'book\' par d�faut) ;
- un template de couverture (\'book_cover\') :

ex: [cat=public~nbdays=30,412 413 414�hello/2/book:book]

Pour cr�er une liste d\'ID il est possible d\'utiliser le plugin \'favs\' plac� dans un module, qui propose d\'exporter la liste ;');
$r["call_arts"]=array('Param�tres du script d\'appel d\'articles :
- cat : cat�gorie 
- nocat : cat�gorie � exclure
- tag : (sp�cifier)
- notag : tag � exclure
- nbdays : \'30-60\' de 30 � 60 jours
- lasts : \'0-10\' les 10 derniers articles
- preview : \'true/false/full\' mode d\'affichage
- priority : niveau de priorit� (1 � 4)
- nopriority : niveau de priorit� � exclure (1 � 4)
- lenght : \'<4000\' inf�rieur � 4000 caract�res');
$r["htaccess"]=array('Si le code lanc� est le m�me que celui par d�faut, alors il n\'y a pas de mise � jour � faire.

V�rifier que le fichier \'.htaccess\' � la racine a les autorisations suffisantes.
Le fichier .htaccess est �tudi� pour faire de la barre d\'adresse une console de commande d\'activit�s.
V�rifier les d�finitions htaccess propres � chaque serveur.
- infomaniak : php_flag \"allow_url_fopen\" \"On\"
php_flag \"allow_url_include\" \"On\"');
$r["favs"]=array('L\'ic�ne Like dans les menus d\'articles permet de les ajouter aux Favoris.
Les collections peuvent �tre assembl�es dans un Book.');
$r["pictos"]=array('Liste des pictogrammes du syst�me, d� � la typo \'philum\'.

Les affectations re�oivent un connecteur, qui sp�cifie la nature de l\'ic�ne, une typo, une image ou un objet vectoriel svg. 
(les ic�nes existants sont visiblesdans l\'�diteur)');
$r["finder"]=array('Finder permet de naviguer dans les dossiers, de partager des fichiers, et de leur affecter un r�pertoire virtuel.
Le r�pertoire virtuel permet de g�n�rer des classements publiques ; \'server/shared_files\' est appel� par d\'autres sites Philum ;

- disk : r�pertoires utilisateur
- shared : fichiers partag�s :
-- local : par l\'utilisateur
-- global : par les hubs du serveur
-- distant : par le r�seau de sites Philum

- list : liste d�roulante
- panel : liste par r�pertoires
- icons : mode Desktop
- flap : r�pertoires � gauche, fichiers � droite

- virtual/real : r�pertoires r�els ou virtuels
- picto/mini : usage de pictogramme ou des miniatures
- update : informe la table \'server/shared_files\'');
$r["comline"]=array('Ligne de commande : Certains modules utilisent une commande de modules comme param�tre (MenusJ, Apps, le connecteur \':module\').');
$r["mod_cond"]=array('contexte par d�faut : (rien), home, cat, art
[0-9] : contexte d\'un article pr�cis (ID)
[a-z] : contexte d\'une cat�gorie existante
[a-z] : contexte d�clench� par l\'url /context/nom');
$r["updfonts"]=array('Apr�s avoir t�l�charg� une typo il faut aller dans admin/fonts et faire un \'inject\' ; �a consiste � d�compresser le fichier, l\'installer, et signaler son existence � la table des typos du serveur, qui n\'est pas concern� par les mises � jour, contrairement � celle du syst�me.');
$r["updpictos"]=array('Le syst�me a besoin de pictogrammes, il faut t�l�charger la police \'philum\' dans l\'onglet \'pictos\'');
$r["breadcrumb"]=array('Le Breadcrumb re�oit le nom de la cat�gorie, le nombre d\'articles et si besoin, la topologie � laquelle appartient l\'article. 
La restriction Access/user_template (55) permet d\'utiliser le template nomm� \'titles\' afin de contr�ler l\'ordre et l\'apparence.');
$r["login"]=array('log-in / nouvel utilisateur');
$r["mail_article"]=array('Envoyer l\'article par mail');
$r["log_no"]=array('nom d\'utilisateur requis');
$r["log_nopass"]=array('mauvais mot de passe');
$r["log_nohub"]=array('pas d\'inscription possible');
$r["log_newser"]=array('S\'enregistrer comme nouvel utilisateur, de niveau :');
$r["empty_msg"]=array('Message vide');
$r["meta_related"]=array('ID d\'articles s�par�s par un espace');
$r["newsletter_ok"]=array('Newsletter envoy�e avec succ�s');
$r["newsletter_ko"]=array('pas de r�sultat');
$r["newsletter_uns"]=array('se d�sinscrire');
$r["conn_pub"]=array('Les connecteurs remplacent le html pour gagner de l\'espace et permettent de r�diger des commandes pour des applications');
$r["search"]=array('Astuces : 
- recherche bool�enne : * � la fin
- recherche vide : portant seulement sur des param�tres
- filtres : ajouter les termes sous forme de connecteurs 
ex: mot1;mot2:tag;mot3:auteurs (\'auteurs\' est une classe de tags)
- ligne de commande d\'articles : priority=4&from=01-02-13&cat=public (cat, nocat, tag, notag, until, nbdays)
- le bouton \'del\' permet d\'effacer le cache
- le bouton \'creuser\' permet de laisser la recherche continuer sur des p�riodes ant�rieures jusqu\'� ce qu\'une r�ponse soit trouv�e
- \'last\' renvoie le dernier article publi�');
$r["defcons"]=array('Les d�finitions d\'importation de sites sont des points d\'ancrage o� commence et se termine la copie des parties qui nous int�ressent dans la page.

Ce sont le titre et le corps du texte, et en option un chapeau.
Si le point de sortie n\'est pas sp�cifi� c\'est la fin normale de la balise qui sera choisie (�a peut ne pas marcher).

Un post-traitement permet de supprimer la premi�re ligne, le titre, un lien ou une ligne ou lien contenant un mot-clef, ou d�truire des balises.');
$r["apps"]=array('la restriction 61 est activ�e : le menu Apps par d�faut est load� (system/default_apps), vos d�finitions s\'y ajoutent, et peuvent supplanter celles qui existent.');
$r["apps_add"]=array('Apps pr�d�finies : tous les param�tres peuvent en �tre modifi�s (ic�ne, nom, cible, fonction).
Le bouton \"update\" remplacera toutes vos apps ! (faites des backups)
le menu permet de choisir d\'autres tables plus sp�cialis�es');
$r["trackhelp"]=array('- urls, images et vid�os (youtube etc...) sont interpr�t�s automatiquement
- lien vers un article : 1234:pub (renvoie le titre) ou 1234�mot
- 123:track permet un rappel du commentaire 123
- :web affiche un lien + titre + image du lien
- #public : appelle le canal \'public\' du chat');
$r["suggest"]=array('Coller l\'url de l\'article. 
Une pr�visualisation tentera de s\'afficher. 
Le champ mail est optionnel et renvoie une mention \"Propos� par [pr�fixe du mail]\". Vous serez averti lors de la publication.');
$r["suggest_ok"]=array('Votre article a �t� publi�');
$r["console_cond"]=array('[Contexte:b] : Les modules s\'activent en fonction du contexte auquel ils appartiennent.
home, cat et art sont les contextes par d�faut. On peut cibler une cat�gorie pr�cise, un article (ID), ou en cr�er.

Ainsi quand on appelle la page /context/name tous les modules appartenant � ce contexte s\'affichent.');
$r["console_mods"]=array('Le [menu de mods:b] n\'affecte que la session en cours. Pour que les effets prennent effet pour le visiteur, il faut l\'appliquer, pour que le num�ro de version de la table de module figure dans [config/param/modules_table:l].');
$r["scripts"]=array('param/titre/commande/option/en cache/masquer/template/br:module�button[,]');
$r["video"]=array('Youtube, Dailymotion, Vimeo, Rutube, vk.com, Livestream');
$r["popvideo"]=array('- option �1 : lance la vid�o sur place 
- option �440/320 : largeur/hauteur');
$r["pdf"]=array('Le lecteur PDF de Google n�cessite d\'y �tre logu�');
$r["art_render"]=array('Le mode de rendu d\'articles est d�fini par les restrictions 5 et 41 (config arts), et peut �tre supplant� par un de ces param�tres : false, preview, full, read, auto');
$r["desklr"]=array('attributs du Desktop :
top,#_4,#_2
to bottom,#002594,#06999e,#878787,#bf1755,#4f004f
philum/photo/space/crabhubble.jpg
philum/photo/space (random img du dossier)');
$r["submod_types"]=array('types de sous-modules: mod plug art msql link finder ajax admin');
$r["chatxml"]=array('- ChatXml fonctionne entre serveurs Philum (serveur d\'appel :  \'admin/params\')
- le bouton \'live\' rafra�chit le chat toutes les 4 secondes
- le premier message reste le premier affich�
- un chat nomm� comme un hub permet � l\'admin de ce hub d\'effacer tous les messages
- seuls les 20 derni�res entr�es sont charg�es ');
$r["chatcall"]=array('_NAME vous invite chater !');
$r["miniconn"]=array('Syntaxe Miniconn :
- liens, images, vid�os, audios et pdf sont rendus cross-server
- http://site.com�mot = lien vers une page (affiche le mot)
- 1234:pub = appelle l\'article 1234 dans une popup (via Mxml)
- 1234�mot = appelle l\'article 1234 dans une popup (affiche \'mot\')
- canal:room = lien vers un canal
- name:twitter = ouvre un flux Rss Twitter
- mots en gras:b italique:i soulign�:u, (q, h, l, k)
- supporte les connecteurs (restreints) : [param�option:connector]');
$r["artstats"]=array('Les stats d\'articles ne sont visibles qu\'apr�s avoir �t� flush�es (toutes les 24 heures)');
$r["track_orth"]=array('Orthographe : 
- infinitif \'er\' au lieu de \'�\' quand on peut remplacer le verbe par un autre du troisi�me groupe comme \'prendre\'
- conjugaison : le verbe s\'accorde avec le sujet (attention aux �, �s �es)

R�gles typographiques : 
- espaces apr�s une virgule, pas avant ; sauf pour le point-virgule : et les deux-points, mais pas dans les (parenth�ses) ni dans les \"guillemets\".');
$r["tracks_error1"]=array('Captcha mal renseign�');
$r["tracks_error2"]=array('Merci d\'indiquer un nom');
$r["tracks_error3"]=array('Message vide');
$r["retape"]=array('Des connecteurs obsol�tes ont �t� remplac�s');
$r["prmb5"]=array('Le param \'auto_design\' (5) est actif : il supplante le design utilisateur');
$r["flog"]=array('fast-log: retenez votre ID pour �tre reconnu et retrouver vos donn�es');
$r["memstorage"]=array('les contenus sont stock�s dans les variables locales de votre navigateur');
$r["blocmenu"]=array('Le bloc \'menu\' a de particulier ses css qui lui permettent de g�rer correctement les menus pr�sent�s dans des ul<li');
$r["bloctest"]=array('ne s\'affiche pas, permet de tester des modules');
$r["ftext"]=array('le contenu et l\'�dition sont publics');
$r["first_user"]=array('Cr�er le compte Admin');
$r["new_user"]=array('Cr�ation de compte');
$r["meta_lang"]=array('ID des versions dans une autre langue. Le menu d�finit la langue de l\'article.');
$r["tracks_moderation"]=array('les commentaires sont mod�r�s');
$r["twitter_oAuth"]=array('Param�tres d\'authentification de l\'API twitter 1.1 (https://apps.twitter.com/)');
$r["tag_rename"]=array('Renommer un tag va, s\'il existe d�j�, le d�truire et associer les articles � au tag existant');
$r["usertags"]=array('Ajouter des tags � cet article et retrouvez-les dans vos favoris');
$r["api"]=array('L\'API permet de r�aliser des tris complexes via une commande.
- /module/api/{command} : affiche le r�sultat
- /api/{command] : flux open data en json');
$r["like"]=array('Les Likes sont publics');
$r["overcats"]=array('Une sur-cat�gorie peut exister avec un champ vide, dans ce cas la cat�gorie est r�pertori�e � la racine.');
$r["overcats_menu"]=array('Overcats peut �tre utilis� comme module, comme menu admin, ou comme objet de bureau, en utilisant une App avec les params type=desktop et process=overcats');
$r["menubub"]=array('types de menububs : 
- (aucun type) : interpr�te (a-z) = cat�gorie, (0-9) = article, /module/... = link
- module : ouvre le contenu d\'un module (ex: ///lines/4///1:categories )
- plug : (ouvre un plug)
- ajax : (ex: popup_track___admin)');

?>