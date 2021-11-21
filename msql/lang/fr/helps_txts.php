<?php //philum/msql/helps_txts
$r=["_menus_"=>['description'],"philum_pub_txt"=>['[http://philum.fr/2�[phi1�32::picto]:popart] [v[:ver]�txtsmall2:css] [http://philum.fr�[philum:picto]]'],"update_ok_alert"=>[''],"conn_help_txt"=>['Principe g�n�ral

Les connecteurs sont r�dig�s entre des crochets contenant un \":\".
Ils sont situ�s � droite et non � gauche pour des raisons d\'optimisation.
[param�option:conn]

Connecteurs de mise en forme :
- [http://url.com�mot] : \'mot\' attach� � une url
- [mot:b] : \'mot\' en \'bold\'
- [[http://lien.com�exemple]:b] ou [http://lien.com�[exemple:b]] : les connecteurs sont ont des connecteurs associ�s : .jpg, .mp3, .mp4, .pdf, .webm etc.

Certains connecteurs acceptent des options multiples (largeur/hauteur) :
[img.jpg�140/140:thumb]

Pour afficher un connecteur en deuxi�me instance d\'un bouton, il suffit de faire :
[param�option:conn�button]

Pour ouvrir un connecteur sur place, dans un menu ouvrable, il y a un connecteur sp�cial pour cela :
- [ID:read�open:jconn]

Le connecteur pour appeler un module (objets de pagination) :
Les 4 premiers param�tres d\'un module sont : \"param/title/mode/option\"
Module \"recents\" pour une cat�gorie \"public\", un titre \"hello\", un mode d\'affichage \"panel\" et une limite � 10 entr�es :
- [public/hello/panel/10:recents:module]

Connecteurs pour appeler un plugin :
Les plugins ne re�oivent qu\'un param�tre et une option :
- [microarts:plug]
- [hello�1:connectors:plug] //ici l\'option rajoute des crochets
Pour cr�er un bouton :
- [hello�1:connectors:plug�bt] //mais �a ne marche pas si \"hello\" est remplac� par \"hello:b\" parce qu\'il sera interpr�t� en premi�re instance, et renverra son code html

On peut appeler un plugin � travers un module : 
- [microarts:plug:module]

Connecteur de l\'Api :
[minday:14,order:id DESC,lang:all:api]

Le principe des connecteurs est d�clin� en quatre autres dispositifs :
- Les Templates, qui re�oivent des variables pr�-nomm�es (pour les op�rations lourdes qui n�cessite une grande vitesse d\'ex�cution) ;
- Le micro-template Vue, qui peut recevoir un connecteur [varable_name:var] et renvoyer des r�sultats r�currents (une liste d\'objets) ;
- Le Codeline : permet de concevoir des connecteurs simples, en utilisant _VAR et _OPT qui proviennent de la commande du connecteur personnalis� ;
- Le Basic, un langage de connecteur concat�n�s (et sans crochets), qui peut �galement servir pour fabriquer des connecteurs et des modules, en utilisant les ressources de la librairie du Framework.'],"shop_class"=>['Cette section est laiss�e � l\'abandon

- cr�er un article par produit
- le module \'cart\' affiche les �l�ments ajout�s au panier
- tous les articles affili�s entre eux peuvent �tre appel�s en forme de tableau de produits si on appelle l\'article parent : [ID:shop]
- appeler un ou une s�rie d\'ID de fiches s�par�s par une virgule : [123,124,125:prod]
- Le connecteur [:form] renvoie un formulaire �ditable'],"console"=>['La console administre les donn�es d\'une table dont le pr�fixe est \'mod\'. Les \"mods\" contiennent la structure des modules du site entier. On peut s�lectionner ou interchanger les mods (voir Params 1).

Les modules sont charg�s en cascade (comme css) : le dernier efface le pr�c�dent. Les conditions sont des it�rations : home/cat/art.
Si rien n\'est sp�cifi� le module en All reste affich� en cat et en art (en lecture de cat�gorie ou d\'article).

[backup / restaurer:b] : sauvegarde et restauration du jeu de modules (� faire avant de travailler dessus)
[d�faut:b] : table par d�faut
[r�actualiser:b] : utile apr�s une modification externe (dans l\'admin Msql, ou pendant la phase de tests avec le constructeur css ouvert dans une autre fen�tre)
[test:b] : pour faire des tests ou obtenir le script d\'un module'],"trackbacks"=>['En attente de mod�ration'],"microxml"=>['envoie/re�oit une table microsql via Xml'],"newhub_mail"=>['Votre inscription a �t� enregistr�e avec succ�s !

Rappel de vos identifiants :
login : _USER
passe : _PASS

Conservez ce message afin de ne pas perdre vos identifiants
(en cas de 3 Login infructueux vous recevez un email de rappel)'],"anchor_select"=>['S�lectionner la deuxi�me partie de l\'Ancre :'],"anchor_dbclic"=>['utiliser un double-clic si la r�f�rence existe d�j�'],"anchor_manual"=>['Ajouter des ancres au texte s�lectionn� (haut et bas)'],"anchor_auto"=>['le texte doit contenir deux fois (1) ou [1]'],"published_art"=>['Votre article a �t� publi�'],"trackmail"=>['Un nouveau commentaire a �t� publi�'],"restrictions"=>['Acc�s|Contenu|Articles|art_info|user_menu'],"design"=>['En mode d\'�dition les changements ne sont pas visibles par le visiteur, jusqu\'� ce qu\'ils soient \'appliqu�s\' (Apply).

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
- [92 objects:b] : nombre d\'objets dans la table'],"designwidths"=>['La gestion des largeurs permet affecter toutes les classes css concern�es.
Certaines largeurs artificielles sont estim�es et enregistr�es dans des modules syst�me.
Elles d�terminent les limites pour les images et vid�os.
Elles peuvent etre affin�e en faisant des tests.

Une largeur de z�ro signifie qu\'on va ignorer cette colonne et la retirer de la liste des blocs de modules, qui sont sp�cifi�s dans le module \'system\' \'blocks\'.
Si par exemple on permute la colonne de gauche � droite, il faut veiller � ce qu\'il y ait des modules dans \'rightbar\'.

La case \'inform_blocks\' signifie que le r�sultat va �tre enregistr� dans la table de modules, et donc que les visiteurs du site verront les changements, si on travaille sur les mods publi�.

Certains modules sont en cache, si bien que parfois les effets ne sont visibles qu\'en relan�ant le logiciel (appel de /hub, /?id== ou /reload)'],"designcond"=>['Le d�marrage d\'une session d\'�dition de design utilise des feuilles css cr��es sp�cialement (dev).
Seuls les boutons \'Apply\' vont affecter les css utilis�s par les visiteurs.
Le design propos� pour �tre �dit� est celui qui est en cours au moment de la navigation.

Ouvrez deux fen�tres pour voir les effets des changements

Pour cibler un css dans un contexte, il faut dupliquer le module design et lui sp�cifier une condition'],"formail"=>['Merci pour votre message'],"userforms"=>['Vos donn�es ont bien �t� enregistr�es'],"fontserver"=>['Cette disposition permet d\'injecter les nouvelles d�finitions de typos � la table \'server/edition_typos\', 
car elle n\'est pas concern�e par les mises � jour.

Les nouvelles d�finitions peuvent provenir :
- des mises � jour (de \'system/edition_typos\') ;
- de la pr�sence d\'une archive .tar dans le dossier \'/fonts\' de l\'espace disque utilisateur, contenant les versions .woff, .eot, et .svg d\'une m�me typo ;
- du plugin \'addfonts\' qui permet d\'importer des fonts depuis le web, en se r�f�rant � une classe css \'@font-face\'.'],"clbasic"=>['- Les templates utilisent le \'codeline\' qui sont des connecteurs d�di�s � l\'�criture de balises html ;
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

Quelques exemples sont fournis parmi les connecteurs, templates et modules publics.'],"templates"=>['Les templates d\'articles peuvent �tre assign�s :
- de fa�on globale dans la console (module system/template), 
- de fa�on locale dans l\'article lui-m�me, 
- ou de fa�on ponctuelle comme option de commande du module \'articles\'.

Pour les autres templates que celui de l\'article, il faut activer la restriction 55 \'user templates\', et enregistrer une version modifi�e du template par d�faut, du m�me nom. 
En l\'absence de template utilisateur, le logiciel cherche un template public avant de se r�f�rer � celui par d�faut.

Si la restriction \'user templates\' (55) est activ�e, la machine ira chercher le template utilisateur puis le public, avant d\'utiliser celui par d�faut. Pour �viter qu\'un template public ne supplante celui par d�faut, il suffit de sauver ce dernier pour en faire un template utilisateur.'],"track_follow"=>['Indiquer un mail pour recevoir les autres commentaires'],"track_captcha"=>['copier le code ici'],"update_ok"=>['Le logiciel est � jour'],"update_help"=>['Si une erreur survient, t�l�charger l\'image compl�te depuis l\'installateur'],"upload_folder"=>['s�lectionner le r�pertoire o� envoyer le document ;
pour envoyer un r�pertoire d\'images il suffit de les contenir dans une archive .tar'],"bool"=>['M�thode bool�enne : r�sultats communs aux recherches faites sur chaque mot'],"dev"=>['Le r�pertoire /progb contient une copie du programme. Il faut passer en mode Dev (/?dev=dev) pour que les modifs prennent effet.
\'2prod\' copie les fichiers de /progb dans /prog. (les fichiers doivent avoir une permission suffisante)'],"blocsystem"=>['Le bloc \'system\' n\'est pas consid�r� comme une Div (un �l�ment de la mise en page).
Il d�finit les param�tres globaux. Certains modules sont critiques.'],"import_art"=>['URL de l\'article � importer'],"public_design"=>['Ceci affectera le design visible par le public'],"modules"=>['- content : pr�vu pour la div du contenu principale ;
- multi : peut �tre affich� partout plusieurs fois ;
- once : ne peut �tre affich� qu\'une seule fois (les modules d�j� utilis�s ne s\'affichent plus) ; 
- connectors : raccourcis vers des connecteurs ;
- articles : affili� � l\'article en cours ;
- user  : modules utilisateur'],"rssurl_1"=>['Renvoie les articles r�cents des flux rss dont on est s�r de vouloir aspirer tous les articles. Seuls sont concern�s les flux marqu� 1 � la colonne \'bot\' de la table \'rssurl\'.
L\'op�ration arr�te la recherche au premier article reconnu de chaque flux.
'],"words"=>['Mots connus class�s par pertinence'],"book"=>['param�tre multiple [,] : 
- script d\'appel d\'articles ; 
- liste d\'ID [ ] ;
4 options [/] :
- le titre du livre ;
- 1=ID croissant, 2= ordre inverse ;
- un template de mise en forme (\'book\' par d�faut) ;
- un template de couverture (\'book_cover\') :

ex: [cat=public~nbdays=30,412 413 414�hello/2/book:book]

Pour cr�er une liste d\'ID il est possible d\'utiliser le plugin \'favs\' plac� dans un module, qui propose d\'exporter la liste ;'],"call_arts"=>['Param�tres du script d\'appel d\'articles :
- cat : cat�gorie 
- nocat : cat�gorie � exclure
- tag : (sp�cifier)
- notag : tag � exclure
- nbdays : \'30-60\' de 30 � 60 jours
- lasts : \'0-10\' les 10 derniers articles
- preview : \'true/false/full\' mode d\'affichage
- priority : niveau de priorit� (1 � 4)
- nopriority : niveau de priorit� � exclure (1 � 4)
- lenght : \'<4000\' inf�rieur � 4000 caract�res'],"htaccess"=>['Si le code lanc� est le m�me que celui par d�faut, alors il n\'y a pas de mise � jour � faire.

V�rifier que le fichier \'.htaccess\' � la racine a les autorisations suffisantes.
Le fichier .htaccess est �tudi� pour faire de la barre d\'adresse une console de commande d\'activit�s.
V�rifier les d�finitions htaccess propres � chaque serveur.
- infomaniak : php_flag \"allow_url_fopen\" \"On\"
php_flag \"allow_url_include\" \"On\"'],"favs"=>['L\'ic�ne Like dans les menus d\'articles permet de les ajouter aux Favoris.
Les collections peuvent �tre assembl�es dans un Book.'],"pictos"=>['Liste des pictogrammes du syst�me, d� � la typo \'philum\'.

Les affectations re�oivent un connecteur, qui sp�cifie la nature de l\'ic�ne, une typo, une image ou un objet vectoriel svg. 
(les ic�nes existants sont visiblesdans l\'�diteur)'],"finder"=>['Finder permet de naviguer dans les dossiers, de partager des fichiers, et de leur affecter un r�pertoire virtuel.
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
- update : informe la table \'server/shared_files\''],"comline"=>['Ligne de commande : Certains modules utilisent une commande de modules comme param�tre (MenusJ, Apps, le connecteur \':module\').'],"mod_cond"=>['contexte par d�faut : (rien), home, cat, art
[0-9] : contexte d\'un article pr�cis (ID)
[a-z] : contexte d\'une cat�gorie existante
[a-z] : contexte d�clench� par l\'url /context/nom'],"updfonts"=>['Apr�s avoir t�l�charg� une typo il faut aller dans admin/fonts et faire un \'inject\' ; �a consiste � d�compresser le fichier, l\'installer, et signaler son existence � la table des typos du serveur, qui n\'est pas concern� par les mises � jour, contrairement � celle du syst�me.'],"updpictos"=>['Le syst�me a besoin de pictogrammes, il faut t�l�charger la police \'philum\' dans l\'onglet \'pictos\''],"breadcrumb"=>['Le Breadcrumb re�oit le nom de la cat�gorie, le nombre d\'articles et si besoin, la topologie � laquelle appartient l\'article. 
La restriction Access/user_template (55) permet d\'utiliser le template nomm� \'titles\' afin de contr�ler l\'ordre et l\'apparence.'],"login"=>['log-in / nouvel utilisateur'],"mail_article"=>['Envoyer l\'article par mail'],"log_no"=>['nom d\'utilisateur requis'],"log_nopass"=>['mauvais mot de passe'],"log_nohub"=>['pas d\'inscription possible'],"log_newser"=>['S\'enregistrer comme nouvel utilisateur, de niveau :'],"empty_msg"=>['Message vide'],"meta_related"=>['ID d\'articles s�par�s par un espace'],"newsletter_ok"=>['Newsletter envoy�e avec succ�s'],"newsletter_ko"=>['pas de r�sultat'],"newsletter_uns"=>['se d�sinscrire'],"conn_pub"=>['Les connecteurs remplacent le html pour gagner de l\'espace et permettent de r�diger des commandes pour des applications'],"search"=>['Boutons :
- score : classement par quantit� de r�sultats
- segment : mot entier
- bool�en : plusieurs mots (s�par�s par un espace)
- lang, cat, tag : inclure ou exclure des mots-li�s (m�tas)
- limit : nombre minimum d\'occurrences (attention � la casse)

Astuces :
- recherche vide : porte seulement sur des param�tres
- id : l\'id d\'un article permet de l\'ouvrir imm�diatement
- date : articles avant le Y-m ou Y-m-d : \"2000-01\"
- bouton \'del\' : efface le cache
- \'1\' renvoie le dernier article publi�
- bouton \'avance-rapide\' : recherche continue sur d\'autres champs temporels jusqu\'� trouver une r�ponse (si cette option est active)
- script de l\'API, (utiliser un \':\' et une \',\') ex : \"search:mot1|mot2,avoid:mot3,cat:Justice,tag:justice|injustice\"
- date pr�cise (API) : \"date:1967,\" ou \"date:-08-15\" (tous les 15 ao�ts)'],"defcons"=>['Les d�finitions d\'importation de sites sont des points d\'ancrage o� commence et se termine la copie des parties qui nous int�ressent dans la page.

Ce sont le titre et le corps du texte, et en option un chapeau.
Si le point de sortie n\'est pas sp�cifi� c\'est la fin normale de la balise qui sera choisie (�a peut ne pas marcher).

Un post-traitement permet de supprimer la premi�re ligne, le titre, un lien ou une ligne ou lien contenant un mot-clef, ou d�truire des balises.'],"apps"=>['la restriction 61 est activ�e : le menu Apps par d�faut est load� (system/default_apps), vos d�finitions s\'y ajoutent, et peuvent supplanter celles qui existent.'],"apps_add"=>['Apps pr�d�finies : tous les param�tres peuvent en �tre modifi�s (ic�ne, nom, cible, fonction).
Le bouton \"update\" remplacera toutes vos apps ! (faites des backups)
le menu permet de choisir d\'autres tables plus sp�cialis�es'],"trackhelp"=>['- urls, images et vid�os (youtube etc...) sont interpr�t�s automatiquement
- lien vers un article : 1234:pub (renvoie le titre) ou 1234�mot
- 123:track permet un rappel du commentaire 123
- :web affiche un lien + titre + image du lien
- #public : appelle le canal \'public\' du chat'],"suggest"=>['Vous pouvez importer un contenu web � partir de l\'url de l\'article, une pr�visualisation tentera de s\'afficher. Ne vous inqui�tez pas si la page ne s\'affiche pas correctement.

Le champ mail permet d\'ajouter une mention \"Propos� par [pr�fixe du mail]\". Vous serez averti lors de la publication.

Merci pour votre contribution !'],"suggest_ok"=>['Votre article a �t� publi�'],"console_cond"=>['Les modules (les �l�ments de la page) appartiennent � un [contexte:b]. Par d�faut, ils sont : \"home\", \"cat\" (pour une cat�gorie d\'articles) et \"art\" (lecture d\'un article). On peut cr�er des contextes personnalis�s, d�clin�s de cat et art.

Ainsi quand on appelle la page /context/name tous les modules appartenant � contexte \"name\" s\'affichent.

Le contexte d\'un module se d�finit dans l\'�dition de chaque module. Si un module doit appara�tre sous plusieurs contextes, il faut cr�er autant de modules identiques que n�cessaire, � l\'aide du bouton \"nouveau\".'],"console_mods"=>['Le [menu de mods:b] n\'affecte que la session en cours. Pour que les effets prennent effet pour le visiteur, il faut l\'appliquer, pour que le num�ro de version de la table de module figure dans [config/param/modules_table:l].'],"scripts"=>['param/titre/commande/option/en cache/masquer/template/br:module�button[,]'],"video"=>['Youtube, Dailymotion, Vimeo, Rutube'],"popvideo"=>['- option �1 : lance la vid�o sur place 
- option �440/320 : largeur/hauteur'],"pdf"=>['Le lecteur PDF de Google n�cessite d\'y �tre logu�'],"art_render"=>['Le mode de rendu d\'articles est d�fini par les restrictions 5 et 41 (config arts), et peut �tre supplant� par un de ces param�tres : false, preview, full, read, auto'],"desklr"=>['attributs du Desktop :
top,#_4,#_2
to bottom,#002594,#06999e,#878787,#bf1755,#4f004f
philum/photo/space/crabhubble.jpg
philum/photo/space (random img du dossier)'],"submod_types"=>['types de sous-modules: mod plug art msql link finder ajax admin'],"chatxml"=>['- ChatXml fonctionne entre serveurs Philum (serveur d\'appel :  \'admin/params\')
- le bouton \'live\' rafra�chit le chat toutes les 4 secondes
- le premier message reste le premier affich�
- un chat nomm� comme un hub permet � l\'admin de ce hub d\'effacer tous les messages
- seuls les 20 derni�res entr�es sont charg�es '],"chatcall"=>['_NAME vous invite chater !'],"miniconn"=>['Syntaxe Miniconn :
- liens, images, vid�os, audios et pdf sont rendus cross-server
- http://site.com�mot = lien vers une page (affiche le mot)
- 1234:pub = appelle l\'article 1234 dans une popup (via Mxml)
- 1234�mot = appelle l\'article 1234 dans une popup (affiche \'mot\')
- canal:room = lien vers un canal
- name:twitter = ouvre un flux Rss Twitter
- mots en gras:b italique:i soulign�:u, (q, h, l, k)
- supporte les connecteurs (restreints) : [param�option:connector]'],"artstats"=>['Les stats d\'articles ne sont visibles qu\'apr�s avoir �t� flush�es (toutes les 24 heures)'],"track_orth"=>['Orthographe : 
- infinitif \'er\' au lieu de \'�\' quand on peut remplacer le verbe par un autre du troisi�me groupe comme \'prendre\'
- conjugaison : le verbe s\'accorde avec le sujet (attention aux �, �s �es)

R�gles typographiques : 
- espaces apr�s une virgule, pas avant ; sauf pour le point-virgule : et les deux-points, mais pas dans les (parenth�ses) ni dans les \"guillemets\".'],"tracks_error1"=>['Captcha mal renseign�'],"tracks_error2"=>['Merci d\'indiquer un nom'],"tracks_error3"=>['Message vide'],"retape"=>['Des connecteurs obsol�tes ont �t� remplac�s'],"prmb5"=>['Le param \'auto_design\' (5) est actif : il supplante le design utilisateur'],"flog"=>['Retenez votre num�ro de jeton pour retrouver vos donn�es'],"memstorage"=>['les contenus sont stock�s dans les variables locales de votre navigateur et ne sont accessibles que par vous'],"blocmenu"=>['Le bloc \'menu\' a de particulier ses css qui lui permettent de g�rer correctement les menus pr�sent�s dans des ul<li'],"bloctest"=>['ne s\'affiche pas, permet de tester des modules'],"ftext"=>['le contenu et l\'�dition sont publics'],"first_user"=>['Cr�er le compte Admin'],"new_user"=>['Cr�ation de compte'],"meta_lang"=>['ID des versions dans une autre langue.'],"tracks_moderation"=>['les commentaires sont mod�r�s'],"twitter_oAuth"=>['Param�tres d\'authentification de l\'API twitter 1.1 (https://developer.twitter.com/)'],"tag_rename"=>['Renommer un tag va, s\'il existe d�j�, le d�truire et associer les articles au tag existant'],"usertags"=>['Ajouter des tags � cet article et retrouvez-les dans vos favoris.
Les tags utilisateurs sont publics.'],"api"=>['L\'API permet de r�aliser des tris complexes via une commande.
- /module/api/{command} : affiche le r�sultat
- /api/{command] : flux open data en json'],"like"=>['Les Likes sont publics'],"overcats"=>['Une sur-cat�gorie peut exister avec un champ vide, dans ce cas la cat�gorie est r�pertori�e � la racine.'],"overcats_menu"=>['Overcats peut �tre utilis� comme module, comme menu admin, ou comme objet de bureau, en utilisant une App avec les params type=desktop et process=overcats'],"menubub_edit"=>['types de menububs : 
- (aucun type) : interpr�te (a-z) = cat�gorie, (0-9) = article, /module/... = link
- module : ouvre le contenu d\'un module (ex: ///lines/4///1:categories )
- plug : (ouvre un plug)
- ajax : (ex: popup_track___admin)'],"spitable"=>['On ne pourra jamais dessiner r�ellement un atome. Une repr�sentation graphique de la r�alit� ne fait que tenir compte d\'un certain nombre de param�tres.

Sur cette table on peut voir les couronnes et les sous-couronnes.
Chaque sous-couronne exprime une famille chimique.
Chaque couronne contient un nombre de sous-couronnes �gal au rang de la couronne (1:1, 2:2, ...).

Chaque atome est repr�sent� par sa configuration �lectronique. Le plus souvent le nombre atomique correspond � la position du dernier �lectron de cet atome.

Le nombre d\'emplacement de chaque sous-couronne augment de 4 � chaque sous-couronne.

L\'int�r�t de cette repr�sentation est de mettre en �vidence le fait que les sous-couronnes sont parlantes des familles chimiques auxquelles appartiennent les atomes qui y sont repr�sent�s.

La p�riodicit� (spirale) des �l�ments est ainsi d�finie par un algorithme tr�s simple (utilis� pour dessiner les cases).
On peut voir que la construction que produit cet algorithme permet une croissance infinie.

Les anomalies par rapport � l\'algorithme de remplissage �lectronique sont signal�es graphiquement, de sorte � visualiser la configuration �lectronique r�elle de chaque atome.'],"fav_fav"=>['Articles favoris'],"fav_tags"=>['Articles r�f�renc�s par un tag'],"fav_com"=>['Param�tres de g�n�ration de flux'],"fav_poll"=>['Articles vot�s'],"fav_visit"=>['Articles visit�s'],"fav_shar"=>['Articles partag�s'],"fav_edit"=>['Script de l\'Api'],"fav_like"=>['Articles Lik�s'],"levenshtein"=>['utilise l\'algorithme de distance de Levenshtein'],"study"=>['Permet de cr�er une �tude de texte, phrase par phrase.'],"tlex"=>['Publier sur Tlex : ajouter le oAuth de l\'Api Tlex dans la table users/(hub)_tlex
Il peut y avoir plusieurs comptes'],"twit"=>['Conditions g�n�rales d\'utilisation : les informations obtenues ne doivent pas servir � des fins commerciales ou de nuisance physique ou morale.
Politique de confidentialit� : les informations obtenues ne peuvent �tre relay�es sans l\'autorisation des personnes concern�es.
'],"meta_abilities"=>['Abilit�s d�l�gu�es aux utilisateurs'],"umrennum"=>['Renum�rote les articles par date et en classant les favoris, retweets et status'],"search_cases"=>['Cliquer plusieurs fois dans le menu des m�tas (lang,cat,tag) pour :
- inclure exclusivement 
- exclure 
- ne pas tenir compte (par d�faut)
du ou des mots-li�s.'],"star"=>['- ra (ascension droite en heures), dc (d�clinaison en degr�s), et dist (distance en AL)
ex: ra>15,ra<21,dc>-1,dc<5,dist>13,dist<19

- param�tre radius (degr�s par d�faut, h, m, rad, mas)
ex: ra=18,dc=2,dist=16,radius=3

- autour d\'une �toile
ex: 88601,dist<30,radius=1h

- une liste d\'�toiles nomm�es (HIP par d�faut) :
HD 150680, hd150680, hip99461, 88601, 2021'],"gaia"=>['exemple 1, avec dc (d�clinaison), ra (ascension droite) et dist (degr�s et AL) : 
dc > -23.432, dc < -21.82, ra > 255.25, ra < 270.83, dist < 100

- une liste d\'�toiles nomm�es par leur id Gaia (nombre � 19 chiffres) s�par�s par un espace'],"umrec"=>['- Pour appeler un message pr�cis : 
http://oumo.fr/context/compile/O6-144
- Pour l\'int�grer dans une page web via une iframe (utiliser l\'id) :
http://oumo.fr/plug/umrec/1464
- Depuis l\'�diteur (article ou commentaires) :
[1464:umcom:on] affiche le bloc
[1464�1:umcom:on] affiche un lien vers le bloc'],"mercury"=>['Lecteur web universel :
permet de lire le contenu brut d\'une page web.
Utilise l\'API Mercury. Si votre site n\'y r�pond pas, il est pr�f�rable de s\'y conformer.'],"mercurykey"=>['Admin : ajouter l\'api_key (mercury.com) dans la table mercury, ligne 1 colonne 0'],"searchlang"=>['recherche multilingue'],"umsearchlang"=>['recherche multilingue'],"not_published"=>['Article indisponible'],"tables"=>['S�parateurs : 
- colonnes :\"|\" ou virgules
- lignes : \"�\" ou saut de ligne'],"menubub"=>['N� de table des menus'],"tweetfeed"=>['Diffusion Twitter'],"tweetfeed_help"=>['Utiliser uniquement un ou plusieurs modules \'api_arts\' ;
la clef twitter utilis�e est la N�4'],"purpose"=>['Ajoutez et votez des propositions ; vous ne pouvez effacer votre entr�e que le jour courant.'],"nodes"=>['Ceci permettra de cr�er une nouvelle couche de Hubs (un Node).
Url du node : /?qd=nodename
�crivez $qd=\"pub2\" ; dans _connectx pour attribuer un nom de domaine au n&oelig;ud \"pub2\".'],"updatenotes"=>['notes de mise � jour'],"lastupdate"=>['Derni�re synchronisation en date du'],"softwareupdated"=>['Le logiciel a �t� mis � jour'],"softwarever"=>['version locale'],"softwaredist"=>['version distante'],"updatedetails"=>['d�tails de la derni�re mise � jour'],"updateno"=>['Ce serveur n\'est pas configur� pour recevoir des mises � jour'],"cookie"=>['Le cookie nomm� \"iq\" contient l\'id de votre IP, ce qui permet de ne consid�rer qu\'un seul visiteur m�me si votre IP change. Voir [privacy:help�politique de confidentialit� des donn�es].'],"privacy"=>['Le site ne proc�de � aucune utilisation ni revente des donn�es li�es aux visiteurs, hormis pour les statistiques de fr�quentation du site.
Toutes les activit�s sur le site sont supprim�es tous les ans en moyenne.'],"umrsrch"=>['Rechercher :
- un id (1873)
- un titre (Oay-126)
- une date ymd (150706)
- un terme dans n\'importe quelle langue
- une liste d\'id ou de titres (ot-100,1873,312-14) (aussi en mode tableur)'],"starmap"=>['�toiles HD ou HIP (HIP par d�faut)
ex : HD 150680, hd150680, hip99461, 88601, 2021
commandes pr�-�tablies : knownstars, allstars
Accepte les requ�tes de Star (ra, dc, dist, radius)']];