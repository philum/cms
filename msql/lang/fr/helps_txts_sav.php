<?php
//philum_microsql_helps_txts_sav
$r["_menus_"]=array('description');
$r["philum_pub_txt"]=array('[[http://philum.net/236§[phi1§32::picto]:popart] [v[:ver]§txtsmall2:css] [http://philum.net§[logo:picto]]:center]');
$r["update_ok_alert"]=array('');
$r["conn_help_txt"]=array('Les connecteurs remplacent le code html par des fonctions interrogeables avec une séquence de variables, du type de celles-ci :

Connecteurs de mise en forme :
- [lien§mot] : \'mot\' attaché à un \'lien\' ;
- [mot:b] : \'mot\' en \'bold\' ;
- [[http://lien.com§exemple]:b] ou [http://lien.com§[exemple:b]] : les connecteurs sont itératifs ;
- [lien.extension] : certains médias [.jpg.mp3.flv.pdf.swf] font appel à des lecteurs

Connecteurs logiciels :
- [:connector] : appel minimal
- [value:connector] : indique une valeur
- [value§param:connector] : précise un paramètre
- [value§param1/param2:connector] : paramètre multiple, ex: [img.jpg§140/140:thumb]
- [param1/param2§value.extension] : (param à gauche) ex: [640/480/&flvar=true§MyFlashMovie.swf]
- [ID:read§open:jconn] : un connecteur comme valeur

Codeline (pour le html)
- [_VAR§div:bal] : une balise div qui s\'affiche si _VAR est non vide ;
- [_VAR§div|id|css:balise] : une balise qui s\'affiche même si _VAR est vide ;

Instructions
- [param/title/command/option:module->target§button[,]] : la plus compliquée, appelle une série de modules depuis un connecteur, en précisant leurs paramètres en plus des paramètre du connecteur (\'module\' ou \'ajax\')');
$r["shop_class"]=array('Cette section est laissée à l\'abandon

- créer un article par produit
- le module \'cart\' affiche les éléments ajoutés au panier
- tous les articles affiliés entre eux peuvent être appelés en forme de tableau de produits si on appelle l\'article parent : [ID:shop]
- appeler un ou une série d\'ID de fiches séparés par une virgule : [123,124,125:prod]
- Le connecteur [:form] renvoie un formulaire éditable');
$r["console"]=array('La console administre les données d\'une table dont le préfixe est \'mod\'. Les \"mods\" contiennent la structure des modules du site entier. On peut sélectionner ou interchanger les mods (voir Params 1).

Les modules sont chargés en cascade (comme css) : le dernier efface le précédent. Les conditions sont des itérations : home/cat/art.
Si rien n\'est spécifié le module en All reste affiché en cat et en art (en lecture de catégorie ou d\'article).

[backup / restaurer:b] : sauvegarde et restauration du jeu de modules (à faire avant de travailler dessus)
[défaut:b] : table par défaut
[réactualiser:b] : utile après une modification externe (dans l\'admin Msql, ou pendant la phase de tests avec le constructeur css ouvert dans une autre fenêtre)
[test:b] : pour faire des tests ou obtenir le script d\'un module');
$r["trackbacks"]=array('En attente de modération');
$r["microxml"]=array('envoie/reçoit une table microsql via Xml');
$r["newhub_mail"]=array('Votre inscription a été enregistrée avec succès !

Rappel de vos identifiants :
login : _USER
passe : _PASS

Conservez ce message afin de ne pas perdre vos identifiants
(en cas de 3 Login infructueux vous recevez un email de rappel)');
$r["anchor_select"]=array('Sélectionner la deuxième partie de l\'Ancre :');
$r["anchor_dbclic"]=array('utiliser un double-clic si la référence existe déjà');
$r["anchor_manual"]=array('Ajouter des ancres au texte sélectionné (haut et bas)');
$r["anchor_auto"]=array('le texte doit contenir deux fois (1) ou [1]');
$r["published_art"]=array('Votre article a été publié');
$r["trackmail"]=array('Un nouveau commentaire a été publié');
$r["restrictions"]=array('Accès|Contenu|Articles|art_info|user_menu');
$r["design"]=array('En mode d\'édition les changements ne sont pas visibles par le visiteur, jusqu\'à ce qu\'ils soient \'appliqués\' (Apply).

Le design utilisateur est une déclinaison du design par défaut (nommé \'basic\') et hérite de \'_global.css\'.

:: Save
- [use_design_15:b] :: applique le design sans enregistrer (session)
:: le module \'design\' affiche celui de la session, mais le design réellement enregistré apparaît dans la fenêtre d\'édition du module.
- [save:b] :: enregistre la table des définitions et crée la css, sans affecter les modules courants (contrairement à \'Apply\')
- [backup:b] :: fait une sauvegarde de la table (qui peut être restaurée ensuite)
- [Apply / mods_1:b] :: rend le design visible par les visiteurs
- [exit:b] :: éteint la session d\'édition

:: Select
- [design:15/clrset:15:b] :: sélecteur de tables
- [herit:b] :: enregistre les données d\'une autre table dans la table courante (design ou couleurs)
- [new_from:b] :: crée un design d\'après celui en cours
- [make_public:b] :: publie le design sur le hub public
- [inform_public:b] :: met à jour la table publique du même nom
- [rebuild:b] :: crée un nouveau design d\'après celui en cours

:: Restore / Refresh / Defaults
- [design, clrset:b] :: rétablit la sauvegarde
- [reset: design, clrset:b] :: utilise les définitions par défaut
- [append_defaults:b] :: ajoute les nouvelles définitions du design par défaut (non invasif)
- [inject_globals:b] :: injecte les définitions du design global,  y compris dans les classes existantes (invasif, permet de contrôler le design des éléments du système)
- [refresh: saved_css, dev_css, clrset:b] :: permet de consulter les fichiers fabriqués
- [92 objects:b] : nombre d\'objets dans la table');
$r["designwidths"]=array('La gestion des largeurs permet affecter toutes les classes css concernées.
Certaines largeurs artificielles sont estimées et enregistrées dans des modules système.
Elles déterminent les limites pour les images et vidéos.
Elles peuvent etre affinée en faisant des tests.

Une largeur de zéro signifie qu\'on va ignorer cette colonne et la retirer de la liste des blocs de modules, qui sont spécifiés dans le module \'system\' \'blocks\'.
Si par exemple on permute la colonne de gauche à droite, il faut veiller à ce qu\'il y ait des modules dans \'rightbar\'.

La case \'inform_blocks\' signifie que le résultat va être enregistré dans la table de modules, et donc que les visiteurs du site verront les changements, si on travaille sur les mods publié.

Certains modules sont en cache, si bien que parfois les effets ne sont visibles qu\'en relançant le logiciel (appel de /hub, /?id== ou /reload)');
$r["designcond"]=array('Le démarrage d\'une session d\'édition de design utilise des feuilles css créées spécialement (dev).
Seuls les boutons \'Apply\' vont affecter les css utilisés par les visiteurs.
Le design proposé pour être édité est celui qui est en cours au moment de la navigation.

Ouvrez deux fenêtres pour voir les effets des changements

Pour cibler un css dans un contexte, il faut dupliquer le module design et lui spécifier une condition');
$r["formail"]=array('Merci pour votre message');
$r["userforms"]=array('Vos données ont bien été enregistrées');
$r["fontserver"]=array('Cette disposition permet d\'injecter les nouvelles définitions de typos à la table \'server/edition_typos\', 
car elle n\'est pas concernée par les mises à jour.

Les nouvelles définitions peuvent provenir :
- des mises à jour (de \'system/edition_typos\') ;
- de la présence d\'une archive .tar dans le dossier \'/fonts\' de l\'espace disque utilisateur, contenant les versions .woff, .eot, et .svg d\'une même typo ;
- du plugin \'addfonts\' qui permet d\'importer des fonts depuis le web, en se référant à une classe css \'@font-face\'.');
$r["clbasic"]=array('- Les templates utilisent le \'codeline\' qui sont des connecteurs dédiés à l\'écriture de balises html ;
- Les connecteurs et modules personnalisés peuvent être rédigés en \'codeline_basic\', qui permet d\'appeler des fonctions du noyau.
- Si un connecteur ou un module est écrit en codeline (avec des crochets) le code basic ne sera pas interprété.
- _PARAM est le nom de la variable qui arrive du connecteur. On peut la traiter s\'il y a plusieurs sous-paramètres.
- On peut affecter des variables nommées _1, _2, etc... Elles correspondent aux colonnes d\'un tableau.

[syntaxe du Basic ::b]

Il s\'écrit de droite à gauche sur une ligne. A la différence des connecteurs, le paramètre le plus important est situé après le \'§\'. Son absence signifie toujours \"pas d\'option\").

Un indicatif (premier caractère d\'un ligne) permet certains traitements du résultat :

[/slash : ignore la ligne
/affecte 81 à la var1 si elle n\'existe pas
?_1=81
/stocke <b>81</b>
+_1§b:balise
/see: print_r
/restitue la valeur
/-_1
/§_1:text
/affecte et écrase
!_2=_1
/affiche variable
-_2:code]

[exemples ::b]

[/delare variable si vide
?_PARAM=hello

/Applique css au paramètre reçu du connecteur :
_PARAM§txtit:css ou directement §txtit:css

/itération (premier = value du second)
txtit:css§u:html

/lit la table
+system/edition_typosbrowsers/§msql_read:core
/affiche un tableau 
-make_table:core
/lecture des variables 0 et 1 d\'un tableau :
-_1 _2:text:code]

Quelques exemples sont fournis parmi les connecteurs, templates et modules publics.');
$r["templates"]=array('Les templates d\'articles peuvent être assignés :
- de façon globale dans la console (module system/template), 
- de façon locale dans l\'article lui-même, 
- ou de façon ponctuelle comme option de commande du module \'articles\'.

Pour les autres templates que celui de l\'article, il faut activer la restriction 55 \'user templates\', et enregistrer une version modifiée du template par défaut, du même nom. 
En l\'absence de template utilisateur, le logiciel cherche un template public avant de se réfèrer à celui par défaut.

Si la restriction \'user templates\' (55) est activée, la machine ira chercher le template utilisateur puis le public, avant d\'utiliser celui par défaut. Pour éviter qu\'un template public ne supplante celui par défaut, il suffit de sauver ce dernier pour en faire un template utilisateur.');
$r["track_follow"]=array('Indiquer un mail pour recevoir les autres commentaires');
$r["track_captcha"]=array('copier le code ici');
$r["update_ok"]=array('Le logiciel a été mis a jour');
$r["update_help"]=array('si une erreur survient, entrer en');
$r["upload_folder"]=array('sélectionner le répertoire où envoyer le document ;
pour envoyer un répertoire d\'images il suffit de les contenir dans une archive .tar');
$r["bool"]=array('Méthode booléenne : résultats communs aux recherches faites sur chaque mot');
$r["dev"]=array('Le répertoire /progb contient une copie du programme. Il faut passer en mode Dev (/?dev=dev) pour que les modifs prennent effet.
\'2prod\' copie les fichiers de /progb dans /prog. (les fichiers doivent avoir une permission suffisante)');
$r["blocsystem"]=array('Le bloc \'system\' n\'est pas considéré comme une Div.
Il définit les paramètres globaux. Certains modules sont critiques.');
$r["import_art"]=array('URL de l\'article à importer');
$r["public_design"]=array('Ceci affectera le design visible par le public');
$r["modules"]=array('- content : prévu pour la div du contenu principale ;
- multi : peut être affiché partout plusieurs fois ;
- once : ne peut être affiché qu\'une seule fois (les modules déjà utilisés ne s\'affichent plus) ; 
- connectors : raccourcis vers des connecteurs ;
- articles : affilié à l\'article en cours ;
- user  : modules utilisateur');
$r["rssurl_1"]=array('Renvoie les articles récents des flux rss dont on est sûr de vouloir aspirer tous les articles. Seuls sont concernés les flux marqué 1 à la colonne \'bot\' de la table \'rssurl\'.
L\'opération arrête la recherche au premier article reconnu de chaque flux.
');
$r["words"]=array('Mots connus classés par pertinence');
$r["book"]=array('paramètre multiple [,] : 
- script d\'appel d\'articles ; 
- liste d\'ID [ ] ;
4 options [/] :
- le titre du livre ;
- 1=ID croissant, 2= ordre inverse ;
- un template de mise en forme (\'book\' par défaut) ;
- un template de couverture (\'book_cover\') :

ex: [cat=public~nbdays=30,412 413 414§hello/2/book:book]

Pour créer une liste d\'ID il est possible d\'utiliser le plugin \'favs\' placé dans un module, qui propose d\'exporter la liste ;');
$r["call_arts"]=array('Paramètres du script d\'appel d\'articles :
- cat : catégorie 
- nocat : catégorie à exclure
- tag : (spécifier)
- notag : tag à exclure
- nbdays : \'30-60\' de 30 à 60 jours
- lasts : \'0-10\' les 10 derniers articles
- preview : \'true/false/full\' mode d\'affichage
- priority : niveau de priorité (1 à 4)
- nopriority : niveau de priorité à exclure (1 à 4)
- lenght : \'<4000\' inférieur à 4000 caractères');
$r["htaccess"]=array('Si le code lancé est le même que celui par défaut, alors il n\'y a pas de mise à jour à faire.

Vérifier que le fichier \'.htaccess\' à la racine a les autorisations suffisantes.
Le fichier .htaccess est étudié pour faire de la barre d\'adresse une console de commande d\'activités.
Vérifier les définitions htaccess propres à chaque serveur.
- infomaniak : php_flag \"allow_url_fopen\" \"On\"
php_flag \"allow_url_include\" \"On\"');
$r["favs"]=array('L\'icône Like dans les menus d\'articles permet de les ajouter aux Favoris.
Les collections peuvent être assemblées dans un Book.');
$r["pictos"]=array('Liste des pictogrammes du système, dû à la typo \'philum\'.

Les affectations reçoivent un connecteur, qui spécifie la nature de l\'icône, une typo, une image ou un objet vectoriel svg. 
(les icônes existants sont visiblesdans l\'éditeur)');
$r["finder"]=array('Finder permet de naviguer dans les dossiers, de partager des fichiers, et de leur affecter un répertoire virtuel.
Le répertoire virtuel permet de générer des classements publiques ; \'server/shared_files\' est appelé par d\'autres sites Philum ;

- disk : répertoires utilisateur
- shared : fichiers partagés :
-- local : par l\'utilisateur
-- global : par les hubs du serveur
-- distant : par le réseau de sites Philum

- list : liste déroulante
- panel : liste par répertoires
- icons : mode Desktop
- flap : répertoires à gauche, fichiers à droite

- virtual/real : répertoires réels ou virtuels
- picto/mini : usage de pictogramme ou des miniatures
- update : informe la table \'server/shared_files\'');
$r["comline"]=array('Ligne de commande : Certains modules utilisent une commande de modules comme paramètre (MenusJ, Apps, le connecteur \':module\').');
$r["mod_cond"]=array('contexte par défaut : (rien), home, cat, art
[0-9] : contexte d\'un article précis (ID)
[a-z] : contexte d\'une catégorie existante
[a-z] : contexte déclenché par l\'url /context/nom');
$r["updfonts"]=array('Après avoir téléchargé une typo il faut aller dans admin/fonts et faire un \'inject\' ; ça consiste à décompresser le fichier, l\'installer, et signaler son existence à la table des typos du serveur, qui n\'est pas concerné par les mises à jour, contrairement à celle du système.');
$r["updpictos"]=array('Le système a besoin de pictogrammes, il faut télécharger la police \'philum\' dans l\'onglet \'pictos\'');
$r["breadcrumb"]=array('Le Breadcrumb reçoit le nom de la catégorie, le nombre d\'articles et si besoin, la topologie à laquelle appartient l\'article. 
La restriction Access/user_template (55) permet d\'utiliser le template nommé \'titles\' afin de contrôler l\'ordre et l\'apparence.');
$r["login"]=array('log-in / nouvel utilisateur');
$r["mail_article"]=array('Envoyer l\'article par mail');
$r["log_no"]=array('nom d\'utilisateur requis');
$r["log_nopass"]=array('mauvais mot de passe');
$r["log_nohub"]=array('pas d\'inscription possible');
$r["log_newser"]=array('S\'enregistrer comme nouvel utilisateur, de niveau :');
$r["empty_msg"]=array('Message vide');
$r["meta_related"]=array('ID d\'articles séparés par un espace');
$r["newsletter_ok"]=array('Newsletter envoyée avec succès');
$r["newsletter_ko"]=array('pas de résultat');
$r["newsletter_uns"]=array('se désinscrire');
$r["conn_pub"]=array('Les connecteurs remplacent le html pour gagner de l\'espace et permettent de rédiger des commandes pour des applications');
$r["search"]=array('Astuces : 
- recherche booléenne : * à la fin
- recherche vide : portant seulement sur des paramètres
- filtres : ajouter les termes sous forme de connecteurs 
ex: mot1;mot2:tag;mot3:auteurs (\'auteurs\' est une classe de tags)
- ligne de commande d\'articles : priority=4&from=01-02-13&cat=public (cat, nocat, tag, notag, until, nbdays)
- le bouton \'del\' permet d\'effacer le cache
- le bouton \'creuser\' permet de laisser la recherche continuer sur des périodes antérieures jusqu\'à ce qu\'une réponse soit trouvée
- \'last\' renvoie le dernier article publié');
$r["defcons"]=array('Les définitions d\'importation de sites sont des points d\'ancrage où commence et se termine la copie des parties qui nous intéressent dans la page.

Ce sont le titre et le corps du texte, et en option un chapeau.
Si le point de sortie n\'est pas spécifié c\'est la fin normale de la balise qui sera choisie (ça peut ne pas marcher).

Un post-traitement permet de supprimer la première ligne, le titre, un lien ou une ligne ou lien contenant un mot-clef, ou détruire des balises.');
$r["apps"]=array('la restriction 61 est activée : le menu Apps par défaut est loadé (system/default_apps), vos définitions s\'y ajoutent, et peuvent supplanter celles qui existent.');
$r["apps_add"]=array('Apps prédéfinies : tous les paramètres peuvent en être modifiés (icône, nom, cible, fonction).
Le bouton \"update\" remplacera toutes vos apps ! (faites des backups)
le menu permet de choisir d\'autres tables plus spécialisées');
$r["trackhelp"]=array('- urls, images et vidéos (youtube etc...) sont interprétés automatiquement
- lien vers un article : 1234:pub (renvoie le titre) ou 1234§mot
- 123:track permet un rappel du commentaire 123
- :web affiche un lien + titre + image du lien
- #public : appelle le canal \'public\' du chat');
$r["suggest"]=array('Coller l\'url de l\'article. 
Une prévisualisation tentera de s\'afficher. 
Le champ mail est optionnel et renvoie une mention \"Proposé par [préfixe du mail]\". Vous serez averti lors de la publication.');
$r["suggest_ok"]=array('Votre article a été publié');
$r["console_cond"]=array('[Contexte:b] : Les modules s\'activent en fonction du contexte auquel ils appartiennent.
home, cat et art sont les contextes par défaut. On peut cibler une catégorie précise, un article (ID), ou en créer.

Ainsi quand on appelle la page /context/name tous les modules appartenant à ce contexte s\'affichent.');
$r["console_mods"]=array('Le [menu de mods:b] n\'affecte que la session en cours. Pour que les effets prennent effet pour le visiteur, il faut l\'appliquer, pour que le numéro de version de la table de module figure dans [config/param/modules_table:l].');
$r["scripts"]=array('param/titre/commande/option/en cache/masquer/template/br:module§button[,]');
$r["video"]=array('Youtube, Dailymotion, Vimeo, Rutube, vk.com, Livestream');
$r["popvideo"]=array('- option §1 : lance la vidéo sur place 
- option §440/320 : largeur/hauteur');
$r["pdf"]=array('Le lecteur PDF de Google nécessite d\'y être logué');
$r["art_render"]=array('Le mode de rendu d\'articles est défini par les restrictions 5 et 41 (config arts), et peut être supplanté par un de ces paramètres : false, preview, full, read, auto');
$r["desklr"]=array('attributs du Desktop :
top,#_4,#_2
to bottom,#002594,#06999e,#878787,#bf1755,#4f004f
philum/photo/space/crabhubble.jpg
philum/photo/space (random img du dossier)');
$r["submod_types"]=array('types de sous-modules: mod plug art msql link finder ajax admin');
$r["chatxml"]=array('- ChatXml fonctionne entre serveurs Philum (serveur d\'appel :  \'admin/params\')
- le bouton \'live\' rafraîchit le chat toutes les 4 secondes
- le premier message reste le premier affiché
- un chat nommé comme un hub permet à l\'admin de ce hub d\'effacer tous les messages
- seuls les 20 dernières entrées sont chargées ');
$r["chatcall"]=array('_NAME vous invite chater !');
$r["miniconn"]=array('Syntaxe Miniconn :
- liens, images, vidéos, audios et pdf sont rendus cross-server
- http://site.com§mot = lien vers une page (affiche le mot)
- 1234:pub = appelle l\'article 1234 dans une popup (via Mxml)
- 1234§mot = appelle l\'article 1234 dans une popup (affiche \'mot\')
- canal:room = lien vers un canal
- name:twitter = ouvre un flux Rss Twitter
- mots en gras:b italique:i souligné:u, (q, h, l, k)
- supporte les connecteurs (restreints) : [param§option:connector]');
$r["artstats"]=array('Les stats d\'articles ne sont visibles qu\'après avoir été flushées (toutes les 24 heures)');
$r["track_orth"]=array('Orthographe : 
- infinitif \'er\' au lieu de \'é\' quand on peut remplacer le verbe par un autre du troisième groupe comme \'prendre\'
- conjugaison : le verbe s\'accorde avec le sujet (attention aux é, és ées)

Règles typographiques : 
- espaces après une virgule, pas avant ; sauf pour le point-virgule : et les deux-points, mais pas dans les (parenthèses) ni dans les \"guillemets\".');
$r["tracks_error1"]=array('Captcha mal renseigné');
$r["tracks_error2"]=array('Merci d\'indiquer un nom');
$r["tracks_error3"]=array('Message vide');
$r["retape"]=array('Des connecteurs obsolètes ont été remplacés');
$r["prmb5"]=array('Le param \'auto_design\' (5) est actif : il supplante le design utilisateur');
$r["flog"]=array('fast-log: retenez votre ID pour être reconnu et retrouver vos données');
$r["memstorage"]=array('les contenus sont stockés dans les variables locales de votre navigateur');
$r["blocmenu"]=array('Le bloc \'menu\' a de particulier ses css qui lui permettent de gérer correctement les menus présentés dans des ul<li');
$r["bloctest"]=array('ne s\'affiche pas, permet de tester des modules');
$r["ftext"]=array('le contenu et l\'édition sont publics');
$r["first_user"]=array('Créer le compte Admin');
$r["new_user"]=array('Création de compte');
$r["meta_lang"]=array('ID des versions dans une autre langue. Le menu définit la langue de l\'article.');
$r["tracks_moderation"]=array('les commentaires sont modérés');
$r["twitter_oAuth"]=array('Paramètres d\'authentification de l\'API twitter 1.1 (https://apps.twitter.com/)');
$r["tag_rename"]=array('Renommer un tag va, s\'il existe déjà, le détruire et associer les articles à au tag existant');
$r["usertags"]=array('Ajouter des tags à cet article et retrouvez-les dans vos favoris');
$r["api"]=array('L\'API permet de réaliser des tris complexes via une commande.
- /module/api/{command} : affiche le résultat
- /api/{command] : flux open data en json');
$r["like"]=array('Les Likes sont publics');
$r["overcats"]=array('Une sur-catégorie peut exister avec un champ vide, dans ce cas la catégorie est répertoriée à la racine.');
$r["overcats_menu"]=array('Overcats peut être utilisé comme module, comme menu admin, ou comme objet de bureau, en utilisant une App avec les params type=desktop et process=overcats');
$r["menubub"]=array('types de menububs : 
- (aucun type) : interprète (a-z) = catégorie, (0-9) = article, /module/... = link
- module : ouvre le contenu d\'un module (ex: ///lines/4///1:categories )
- plug : (ouvre un plug)
- ajax : (ex: popup_track___admin)');

?>