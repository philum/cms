<?php //philum/microsql/helps_txts
$r=["_menus_"=>['description'],"philum_pub_txt"=>['[[http://philum.fr/236§[phi1§32::picto]:popart] [v[:ver]§txtsmall2:css] [http://philum.fr§[logo:picto]]:center]'],"update_ok_alert"=>[''],"conn_help_txt"=>['Les connecteurs remplacent le code html par des fonctions interrogeables avec une séquence de variables, du type de celles-ci :

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
- [param/title/command/option:module->target§button[,]] : la plus compliquée, appelle une série de modules depuis un connecteur, en précisant leurs paramètres en plus des paramètre du connecteur (\'module\' ou \'ajax\')'],"shop_class"=>['Cette section est laissée à l\'abandon

- créer un article par produit
- le module \'cart\' affiche les éléments ajoutés au panier
- tous les articles affiliés entre eux peuvent être appelés en forme de tableau de produits si on appelle l\'article parent : [ID:shop]
- appeler un ou une série d\'ID de fiches séparés par une virgule : [123,124,125:prod]
- Le connecteur [:form] renvoie un formulaire éditable'],"console"=>['La console administre les données d\'une table dont le préfixe est \'mod\'. Les \"mods\" contiennent la structure des modules du site entier. On peut sélectionner ou interchanger les mods (voir Params 1).

Les modules sont chargés en cascade (comme css) : le dernier efface le précédent. Les conditions sont des itérations : home/cat/art.
Si rien n\'est spécifié le module en All reste affiché en cat et en art (en lecture de catégorie ou d\'article).

[backup / restaurer:b] : sauvegarde et restauration du jeu de modules (à faire avant de travailler dessus)
[défaut:b] : table par défaut
[réactualiser:b] : utile après une modification externe (dans l\'admin Msql, ou pendant la phase de tests avec le constructeur css ouvert dans une autre fenêtre)
[test:b] : pour faire des tests ou obtenir le script d\'un module'],"trackbacks"=>['En attente de modération'],"microxml"=>['envoie/reçoit une table microsql via Xml'],"newhub_mail"=>['Votre inscription a été enregistrée avec succès !

Rappel de vos identifiants :
login : _USER
passe : _PASS

Conservez ce message afin de ne pas perdre vos identifiants
(en cas de 3 Login infructueux vous recevez un email de rappel)'],"anchor_select"=>['Sélectionner la deuxième partie de l\'Ancre :'],"anchor_dbclic"=>['utiliser un double-clic si la référence existe déjà'],"anchor_manual"=>['Ajouter des ancres au texte sélectionné (haut et bas)'],"anchor_auto"=>['le texte doit contenir deux fois (1) ou [1]'],"published_art"=>['Votre article a été publié'],"trackmail"=>['Un nouveau commentaire a été publié'],"restrictions"=>['Accès|Contenu|Articles|art_info|user_menu'],"design"=>['En mode d\'édition les changements ne sont pas visibles par le visiteur, jusqu\'à ce qu\'ils soient \'appliqués\' (Apply).

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
- [92 objects:b] : nombre d\'objets dans la table'],"designwidths"=>['La gestion des largeurs permet affecter toutes les classes css concernées.
Certaines largeurs artificielles sont estimées et enregistrées dans des modules système.
Elles déterminent les limites pour les images et vidéos.
Elles peuvent etre affinée en faisant des tests.

Une largeur de zéro signifie qu\'on va ignorer cette colonne et la retirer de la liste des blocs de modules, qui sont spécifiés dans le module \'system\' \'blocks\'.
Si par exemple on permute la colonne de gauche à droite, il faut veiller à ce qu\'il y ait des modules dans \'rightbar\'.

La case \'inform_blocks\' signifie que le résultat va être enregistré dans la table de modules, et donc que les visiteurs du site verront les changements, si on travaille sur les mods publié.

Certains modules sont en cache, si bien que parfois les effets ne sont visibles qu\'en relançant le logiciel (appel de /hub, /?id== ou /reload)'],"designcond"=>['Le démarrage d\'une session d\'édition de design utilise des feuilles css créées spécialement (dev).
Seuls les boutons \'Apply\' vont affecter les css utilisés par les visiteurs.
Le design proposé pour être édité est celui qui est en cours au moment de la navigation.

Ouvrez deux fenêtres pour voir les effets des changements

Pour cibler un css dans un contexte, il faut dupliquer le module design et lui spécifier une condition'],"formail"=>['Merci pour votre message'],"userforms"=>['Vos données ont bien été enregistrées'],"fontserver"=>['Cette disposition permet d\'injecter les nouvelles définitions de typos à la table \'server/edition_typos\', 
car elle n\'est pas concernée par les mises à jour.

Les nouvelles définitions peuvent provenir :
- des mises à jour (de \'system/edition_typos\') ;
- de la présence d\'une archive .tar dans le dossier \'/fonts\' de l\'espace disque utilisateur, contenant les versions .woff, .eot, et .svg d\'une même typo ;
- du plugin \'addfonts\' qui permet d\'importer des fonts depuis le web, en se référant à une classe css \'@font-face\'.'],"clbasic"=>['- Les templates utilisent le \'codeline\' qui sont des connecteurs dédiés à l\'écriture de balises html ;
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

Quelques exemples sont fournis parmi les connecteurs, templates et modules publics.'],"templates"=>['Les templates d\'articles peuvent être assignés :
- de façon globale dans la console (module system/template), 
- de façon locale dans l\'article lui-même, 
- ou de façon ponctuelle comme option de commande du module \'articles\'.

Pour les autres templates que celui de l\'article, il faut activer la restriction 55 \'user templates\', et enregistrer une version modifiée du template par défaut, du même nom. 
En l\'absence de template utilisateur, le logiciel cherche un template public avant de se réfèrer à celui par défaut.

Si la restriction \'user templates\' (55) est activée, la machine ira chercher le template utilisateur puis le public, avant d\'utiliser celui par défaut. Pour éviter qu\'un template public ne supplante celui par défaut, il suffit de sauver ce dernier pour en faire un template utilisateur.'],"track_follow"=>['Indiquer un mail pour recevoir les autres commentaires'],"track_captcha"=>['copier le code ici'],"update_ok"=>['Le logiciel a été mis a jour'],"update_help"=>['si une erreur survient, entrer en'],"upload_folder"=>['sélectionner le répertoire où envoyer le document ;
pour envoyer un répertoire d\'images il suffit de les contenir dans une archive .tar'],"bool"=>['Méthode booléenne : résultats communs aux recherches faites sur chaque mot'],"dev"=>['Le répertoire /progb contient une copie du programme. Il faut passer en mode Dev (/?dev=dev) pour que les modifs prennent effet.
\'2prod\' copie les fichiers de /progb dans /prog. (les fichiers doivent avoir une permission suffisante)'],"blocsystem"=>['Le bloc \'system\' n\'est pas considéré comme une Div (un élément de la mise en page).
Il définit les paramètres globaux. Certains modules sont critiques.'],"import_art"=>['URL de l\'article à importer'],"public_design"=>['Ceci affectera le design visible par le public'],"modules"=>['- content : prévu pour la div du contenu principale ;
- multi : peut être affiché partout plusieurs fois ;
- once : ne peut être affiché qu\'une seule fois (les modules déjà utilisés ne s\'affichent plus) ; 
- connectors : raccourcis vers des connecteurs ;
- articles : affilié à l\'article en cours ;
- user  : modules utilisateur'],"rssurl_1"=>['Renvoie les articles récents des flux rss dont on est sûr de vouloir aspirer tous les articles. Seuls sont concernés les flux marqué 1 à la colonne \'bot\' de la table \'rssurl\'.
L\'opération arrête la recherche au premier article reconnu de chaque flux.
'],"words"=>['Mots connus classés par pertinence'],"book"=>['paramètre multiple [,] : 
- script d\'appel d\'articles ; 
- liste d\'ID [ ] ;
4 options [/] :
- le titre du livre ;
- 1=ID croissant, 2= ordre inverse ;
- un template de mise en forme (\'book\' par défaut) ;
- un template de couverture (\'book_cover\') :

ex: [cat=public~nbdays=30,412 413 414§hello/2/book:book]

Pour créer une liste d\'ID il est possible d\'utiliser le plugin \'favs\' placé dans un module, qui propose d\'exporter la liste ;'],"call_arts"=>['Paramètres du script d\'appel d\'articles :
- cat : catégorie 
- nocat : catégorie à exclure
- tag : (spécifier)
- notag : tag à exclure
- nbdays : \'30-60\' de 30 à 60 jours
- lasts : \'0-10\' les 10 derniers articles
- preview : \'true/false/full\' mode d\'affichage
- priority : niveau de priorité (1 à 4)
- nopriority : niveau de priorité à exclure (1 à 4)
- lenght : \'<4000\' inférieur à 4000 caractères'],"htaccess"=>['Si le code lancé est le même que celui par défaut, alors il n\'y a pas de mise à jour à faire.

Vérifier que le fichier \'.htaccess\' à la racine a les autorisations suffisantes.
Le fichier .htaccess est étudié pour faire de la barre d\'adresse une console de commande d\'activités.
Vérifier les définitions htaccess propres à chaque serveur.
- infomaniak : php_flag \"allow_url_fopen\" \"On\"
php_flag \"allow_url_include\" \"On\"'],"favs"=>['L\'icône Like dans les menus d\'articles permet de les ajouter aux Favoris.
Les collections peuvent être assemblées dans un Book.'],"pictos"=>['Liste des pictogrammes du système, dû à la typo \'philum\'.

Les affectations reçoivent un connecteur, qui spécifie la nature de l\'icône, une typo, une image ou un objet vectoriel svg. 
(les icônes existants sont visiblesdans l\'éditeur)'],"finder"=>['Finder permet de naviguer dans les dossiers, de partager des fichiers, et de leur affecter un répertoire virtuel.
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
- update : informe la table \'server/shared_files\''],"comline"=>['Ligne de commande : Certains modules utilisent une commande de modules comme paramètre (MenusJ, Apps, le connecteur \':module\').'],"mod_cond"=>['contexte par défaut : (rien), home, cat, art
[0-9] : contexte d\'un article précis (ID)
[a-z] : contexte d\'une catégorie existante
[a-z] : contexte déclenché par l\'url /context/nom'],"updfonts"=>['Après avoir téléchargé une typo il faut aller dans admin/fonts et faire un \'inject\' ; ça consiste à décompresser le fichier, l\'installer, et signaler son existence à la table des typos du serveur, qui n\'est pas concerné par les mises à jour, contrairement à celle du système.'],"updpictos"=>['Le système a besoin de pictogrammes, il faut télécharger la police \'philum\' dans l\'onglet \'pictos\''],"breadcrumb"=>['Le Breadcrumb reçoit le nom de la catégorie, le nombre d\'articles et si besoin, la topologie à laquelle appartient l\'article. 
La restriction Access/user_template (55) permet d\'utiliser le template nommé \'titles\' afin de contrôler l\'ordre et l\'apparence.'],"login"=>['log-in / nouvel utilisateur'],"mail_article"=>['Envoyer l\'article par mail'],"log_no"=>['nom d\'utilisateur requis'],"log_nopass"=>['mauvais mot de passe'],"log_nohub"=>['pas d\'inscription possible'],"log_newser"=>['S\'enregistrer comme nouvel utilisateur, de niveau :'],"empty_msg"=>['Message vide'],"meta_related"=>['ID d\'articles séparés par un espace'],"newsletter_ok"=>['Newsletter envoyée avec succès'],"newsletter_ko"=>['pas de résultat'],"newsletter_uns"=>['se désinscrire'],"conn_pub"=>['Les connecteurs remplacent le html pour gagner de l\'espace et permettent de rédiger des commandes pour des applications'],"search"=>['Boutons :
- score : classement par quantité de résultats trouvés
- booléen : intersection en cascade des recherches victorieuses
- segment : mot entier
- lang, cat, tag : inclure ou exclure des mots-liés (métas)
- limit : nombre minimum d\'occurrences (attention à la casse)

Astuces :
- recherche vide : porte seulement sur des paramètres
- id : l\'id d\'un article permet de l\'ouvrir immédiatement
- * à la fin : déclenche une recherche booléenne
- date : articles de la période ciblée (Y-m ou Y-m-d)
- bouton \'del\' : efface le cache
- \'last\' renvoie le dernier article publié
- bouton \'avance-rapide\' : recherche continue sur d\'autres champs temporels jusqu\'à trouver une réponse (si cette option est active)
- script de l\'API, ex : \"from:2012-01-01,until:2014-01-01\" (au moins une \',\' et un \':\')'],"defcons"=>['Les définitions d\'importation de sites sont des points d\'ancrage où commence et se termine la copie des parties qui nous intéressent dans la page.

Ce sont le titre et le corps du texte, et en option un chapeau.
Si le point de sortie n\'est pas spécifié c\'est la fin normale de la balise qui sera choisie (ça peut ne pas marcher).

Un post-traitement permet de supprimer la première ligne, le titre, un lien ou une ligne ou lien contenant un mot-clef, ou détruire des balises.'],"apps"=>['la restriction 61 est activée : le menu Apps par défaut est loadé (system/default_apps), vos définitions s\'y ajoutent, et peuvent supplanter celles qui existent.'],"apps_add"=>['Apps prédéfinies : tous les paramètres peuvent en être modifiés (icône, nom, cible, fonction).
Le bouton \"update\" remplacera toutes vos apps ! (faites des backups)
le menu permet de choisir d\'autres tables plus spécialisées'],"trackhelp"=>['- urls, images et vidéos (youtube etc...) sont interprétés automatiquement
- lien vers un article : 1234:pub (renvoie le titre) ou 1234§mot
- 123:track permet un rappel du commentaire 123
- :web affiche un lien + titre + image du lien
- #public : appelle le canal \'public\' du chat'],"suggest"=>['Coller l\'url de l\'article. 
Une prévisualisation tentera de s\'afficher. 
Le champ mail est optionnel et renvoie une mention \"Proposé par [préfixe du mail]\". Vous serez averti lors de la publication.'],"suggest_ok"=>['Votre article a été publié'],"console_cond"=>['Les modules (les éléments de la page) appartiennent à un [contexte:b]. Par défaut, ils sont : \"home\", \"cat\" (pour une catégorie d\'articles) et \"art\" (lecture d\'un article). On peut créer des contextes personnalisés, déclinés de cat et art.

Ainsi quand on appelle la page /context/name tous les modules appartenant à contexte \"name\" s\'affichent.

Le contexte d\'un module se définit dans l\'édition de chaque module. Si un module doit apparaître sous plusieurs contextes, il faut créer autant de modules identiques que nécessaire, à l\'aide du bouton \"nouveau\".'],"console_mods"=>['Le [menu de mods:b] n\'affecte que la session en cours. Pour que les effets prennent effet pour le visiteur, il faut l\'appliquer, pour que le numéro de version de la table de module figure dans [config/param/modules_table:l].'],"scripts"=>['param/titre/commande/option/en cache/masquer/template/br:module§button[,]'],"video"=>['Youtube, Dailymotion, Vimeo, Rutube'],"popvideo"=>['- option §1 : lance la vidéo sur place 
- option §440/320 : largeur/hauteur'],"pdf"=>['Le lecteur PDF de Google nécessite d\'y être logué'],"art_render"=>['Le mode de rendu d\'articles est défini par les restrictions 5 et 41 (config arts), et peut être supplanté par un de ces paramètres : false, preview, full, read, auto'],"desklr"=>['attributs du Desktop :
top,#_4,#_2
to bottom,#002594,#06999e,#878787,#bf1755,#4f004f
philum/photo/space/crabhubble.jpg
philum/photo/space (random img du dossier)'],"submod_types"=>['types de sous-modules: mod plug art msql link finder ajax admin'],"chatxml"=>['- ChatXml fonctionne entre serveurs Philum (serveur d\'appel :  \'admin/params\')
- le bouton \'live\' rafraîchit le chat toutes les 4 secondes
- le premier message reste le premier affiché
- un chat nommé comme un hub permet à l\'admin de ce hub d\'effacer tous les messages
- seuls les 20 dernières entrées sont chargées '],"chatcall"=>['_NAME vous invite chater !'],"miniconn"=>['Syntaxe Miniconn :
- liens, images, vidéos, audios et pdf sont rendus cross-server
- http://site.com§mot = lien vers une page (affiche le mot)
- 1234:pub = appelle l\'article 1234 dans une popup (via Mxml)
- 1234§mot = appelle l\'article 1234 dans une popup (affiche \'mot\')
- canal:room = lien vers un canal
- name:twitter = ouvre un flux Rss Twitter
- mots en gras:b italique:i souligné:u, (q, h, l, k)
- supporte les connecteurs (restreints) : [param§option:connector]'],"artstats"=>['Les stats d\'articles ne sont visibles qu\'après avoir été flushées (toutes les 24 heures)'],"track_orth"=>['Orthographe : 
- infinitif \'er\' au lieu de \'é\' quand on peut remplacer le verbe par un autre du troisième groupe comme \'prendre\'
- conjugaison : le verbe s\'accorde avec le sujet (attention aux é, és ées)

Règles typographiques : 
- espaces après une virgule, pas avant ; sauf pour le point-virgule : et les deux-points, mais pas dans les (parenthèses) ni dans les \"guillemets\".'],"tracks_error1"=>['Captcha mal renseigné'],"tracks_error2"=>['Merci d\'indiquer un nom'],"tracks_error3"=>['Message vide'],"retape"=>['Des connecteurs obsolètes ont été remplacés'],"prmb5"=>['Le param \'auto_design\' (5) est actif : il supplante le design utilisateur'],"flog"=>['fast-log: retenez votre ID pour être reconnu et retrouver vos données'],"memstorage"=>['les contenus sont stockés dans les variables locales de votre navigateur'],"blocmenu"=>['Le bloc \'menu\' a de particulier ses css qui lui permettent de gérer correctement les menus présentés dans des ul<li'],"bloctest"=>['ne s\'affiche pas, permet de tester des modules'],"ftext"=>['le contenu et l\'édition sont publics'],"first_user"=>['Créer le compte Admin'],"new_user"=>['Création de compte'],"meta_lang"=>['ID des versions dans une autre langue.'],"tracks_moderation"=>['les commentaires sont modérés'],"twitter_oAuth"=>['Paramètres d\'authentification de l\'API twitter 1.1 (https://apps.twitter.com/)'],"tag_rename"=>['Renommer un tag va, s\'il existe déjà, le détruire et associer les articles au tag existant'],"usertags"=>['Ajouter des tags à cet article et retrouvez-les dans vos favoris.
Les tags utilisateurs sont publics.'],"api"=>['L\'API permet de réaliser des tris complexes via une commande.
- /module/api/{command} : affiche le résultat
- /api/{command] : flux open data en json'],"like"=>['Les Likes sont publics'],"overcats"=>['Une sur-catégorie peut exister avec un champ vide, dans ce cas la catégorie est répertoriée à la racine.'],"overcats_menu"=>['Overcats peut être utilisé comme module, comme menu admin, ou comme objet de bureau, en utilisant une App avec les params type=desktop et process=overcats'],"menubub"=>['types de menububs : 
- (aucun type) : interprète (a-z) = catégorie, (0-9) = article, /module/... = link
- module : ouvre le contenu d\'un module (ex: ///lines/4///1:categories )
- plug : (ouvre un plug)
- ajax : (ex: popup_track___admin)'],"spitable"=>['On ne pourra jamais dessiner réellement un atome. Une représentation graphique de la réalité ne fait que tenir compte d\'un certain nombre de paramètres.

Les atomes sont représentés au moyen de leur configuration électronique. Le numéro atomique, sur la table, est situé sur le dernier emplacement électronique de l\'atome. C\'est la même table pour dénombrer les atomes que pour dénombrer les électrons de chaque atome.

Les électrons sont répartis en couronnes, et chacune possède potentiellement autant de sous-couronnes que le numéro de cette celle-ci (la 5ième peut posséder 5 sous-couronnes). 
Chaque sous-couronne a une configuration identique, faite d\'un nombre d\'emplacements électroniques qui augmente de 4 à chaque niveau orbital. Le nombre d\'électrons à chaque sous-couronne est la somme des sous-couronnes (ex: 32 est composé de 2+6+10+14).

L\'intérêt de cette représentation est de mettre en évidence le fait que les sous-couronnes sont parlantes des familles chimiques auxquelles appartiennent les atomes qui y sont représentés.

La périodicité (spirale) des éléments est ainsi définie par un algorithme très simple (qui ne tient pas compte de certaines variations sur les gros atomes).
On peut voir que la structure globale (petit - grand - petit) est conservée à toutes les échelles, et que cette table peut s\'étendre indéfiniment.

Dans la version /spigrow ont été représentés la position réelle des électrons sur les couronnes, qui subit parfois quelques variations par rapport au modèle idéal de la table.'],"fav_fav"=>['Articles ajoutés aux favoris'],"fav_tags"=>['Articles référencés par un tag'],"fav_com"=>['Paramètres de génération de flux'],"fav_poll"=>['Articles votés'],"fav_visit"=>['Articles visités'],"fav_shar"=>['Articles partagés'],"fav_edit"=>['Script de l\'Api'],"levenshtein"=>['utilise l\'algorithme de distance de Levenshtein'],"study"=>['Coller un texte dans le champ va créer un tableau composé de chaque phrase du texte dans une cellule associée à d\'autres où on peut ajouter des commentaires'],"tlex"=>['Publier sur Tlex : ajouter le oAuth de l\'Api Tlex dans la table users/(hub)_tlex
Il peut y avoir plusieurs comptes'],"twit"=>['Conditions générales d\'utilisation : les informations obtenues ne doivent pas servir à des fins commerciales ou de nuisance physique ou morale.
Politique de confidentialité : les informations obtenues ne peuvent être relayées sans l\'autorisation des personnes concernées.
'],"meta_abilities"=>['Abilités déléguées aux utilisateurs'],"umrennum"=>['Renumérote les articles par date et en classant les favoris, retweets et status'],"search_cases"=>['Cliquer plusieurs fois dans le menu des métas (lang,cat,tag) pour :
- inclure exclusivement 
- exclure 
- ne pas tenir compte (par défaut)
du ou des mots-liés.'],"star"=>['exemple 1, avec dc (déclinaison), ra (ascension droite) et dist (degrés et AL) : 
dc > -23.432, dc < -21.82, ra > 255.25, ra < 270.83, dist < 100

exemple 2, une liste d\'étoiles nommées (hip par défaut) :
HD 150680, hd150680, hip 99461, 88601, 2021'],"gaia"=>['exemple 1, avec dc (déclinaison), ra (ascension droite) et dist (degrés et AL) : 
dc > -23.432, dc < -21.82, ra > 255.25, ra < 270.83, dist < 100

- une liste d\'étoiles nommées par leur id Gaia (nombre à 19 chiffres) séparés par un espace'],"umrec"=>['- Pour appeler un message précis : 
http://oumo.fr/context/compile/O6-144
- Pour l\'intégrer dans une page web via une iframe (utiliser l\'id) :
http://oumo.fr/plug/umrec/1464
- Depuis l\'éditeur (article ou commentaires) :
[1464:umcom:on]'],"mercury"=>['Lecteur web universel :
permet de lire le contenu brut d\'une page web.
Utilise l\'API Mercury. Si votre site n\'y répond pas, il est préférable de s\'y conformer.'],"mercurykey"=>['Admin : ajouter l\'api_key (mercury.com) dans la table mercury, ligne 1 colonne 0'],"searchlang"=>['recherche multilingue'],"umsearchlang"=>['recherche multilingue']];