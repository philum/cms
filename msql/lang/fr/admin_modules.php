<?php //msql/admin_modules
$r=["_menus_"=>['description','param','option','command'],
"All"=>['Tous les articles','Donner un titre','prévisualisation : 1,2,3,auto',''],
"LOAD"=>['Composant principal qui reçoit un déroulé d\'articles ou un article entier','','prévisualisation :1,2,3,auto','ordre des articles'],
"BLOCK"=>['Appelle un Bloc de modules','nom du bloc de modules','',''],
"MENU"=>['Appelle un bloc en tant que menu de liens vers des modules','Nommer ce bloc','',''],
"ARTMOD"=>['Appelle un bloc de modules conjointement à un article.
La rstr60 permet de l\'afficher dans un petit bouton \"articles connectés\", au lieu d\'une div sur la page. On préférera y réserver les modules du contexte \"art\".','Nommer ce bloc','',''],
"TABMOD"=>['modules dans des onglets (tabs en anglais)','nom du bloc de modules','',''],
"Banner"=>['texte et image de fond','p=image s\'il y en a une, t=titre, o=hauteur','hauteur',''],
"MenuBub"=>['Menus ouvrables en ajax, fondés sur une table msql (ne dépend pas des sessions)','indiquer un numéro de version alternatif à la table menubub_1','',''],
"Page_titles"=>['Titres de la page (inclue la navigation)','','articles parents',''],
"agenda"=>['articles dont le tag \'agenda\' est dans le futur','Donner un titre','',''],
"api"=>['Renvoie le résultat d\'une requête à l\'Api','commande de l\'Api [a1:p1;a2:p2]','commande de rectifications',''],
"api_arts"=>['Appel de l\'Api en utilisant les constructeurs Load','commande de l\'Api (séparateur \";\" au lieu de \",\")','',''],
"api_chan"=>['chaîne de commandes Api','msql table (1)','',''],
"api_mod"=>['Appel de l\'API en utilisant les constructeurs de l\'API','commande d\'articles de type Json','',''],
"app_popup"=>['lance une app dans une popup','params : button,type,process,param
ex: hello,art,auto,(id article)','',''],
"apps"=>['Apps','Les Apps sont des boutons logiciels. On peut créer des boutons, liens, menus, html, ajax, situés dans le menu admin, dans un article, ouvrant des listes déroulantes, des logiciels, sur place, imbriqués, liés à d\'autres boutons, liés à des icônes, dans une popup, ou ailleurs... Ces possibilités sont classées par type de compétence et d\'emplacement.

Noter : les apps du même nom remplacent les précédentes : pour annuler une apps par défaut, ajouter la même et la hider 

Les contextes : 
menu : menu Apps du menu admin
desk : icônes de bureau
boot : au lancement de la page
home : menu Phi du menu admin
user : menu user du menu admin (activé par rstr48)','',''],
"archives"=>['navigation temporelle','Donner un titre','',''],
"article"=>['simple article','ID','',''],
"articles"=>['Commande de l\'Api spécialisée dans les déroulés d\'articles','paramètres de l\'Api :
tag=Une&nbdays:1,preview:auto,limit:10
- cat/tag : spécifie une catégorie / un tag
- nocat/notag : exclut une catégorie / un tag
- nbdays : champ temporel
- preview : 1, 2, 3, auto','',''],
"ban_art"=>['bannière','(ID) article utilisant la bannière, ou la première image cataloguée de l\'article, en tant que fond de page','',''],
"basic"=>['exécute un connecteur personnalisé (identifié par son titre), ou du code basic','param=valeur input.','',''],
"birthday"=>['article d\'un jour','spécifier une date [jour-mois], ou aucune pour la date courante','',''],
"blocks"=>['détermine les balises DIV de la page html, qui sont autant de blocs de modules (informé par le constructeur css, obligatoire)','liste des blocks de modules, séparés par un espace','',''],
"bridge"=>['pont entre deux sites philum','param : serveur sans le \'http\'','ID de l\'article ou console url (/module/bridge/philum.fr/236)',''],
"calendar"=>['calendrier','Donner un titre','',''],
"cart"=>['Articles ajoutés au panier','Donner un titre','',''],
"cat_arts"=>['articles d\'une catégorie','spécifier la catégorie','',''],
"categories"=>['liste des rubriques','Donner un titre','option de param ou nb = nombre d\'articles, home',''],
"category"=>['articles de la catégorie en cours','','',''],
"cats"=>['liste des catégories','','',''],
"catj"=>['liste des catégories, en ajax','','',''],
"channel"=>['reçoit les flux d\'autres hubs ou sites Philum, incluant des critères de tri','(paramètres séparés par un espace)
Exemple : \'philum.fr:site philum:hub 236:art CMS:tag 10:last\'
Définitions :
:site : (optionnel) sans le \'http\' ;
:cat : (optionnel) une catégorie ;
:art (illogique avec cat) : les articles affiliés ;
:last : les N derniers articles ;
...
Le module Channel peut être appelé depuis un connecteur \':ajax\' ; 
exemple : [site.com:site blog:hub :channel§Titre, close§x:ajax]','autorefresh (secondes)',''],
"chat"=>['module de Chat','nom de la room','autorefresh (secondes) ',''],
"chatxml"=>['discussion entre serveurs','nom du canal','autorefresh (secondes)',''],
"chrono"=>['temps de generation de la page','','',''],
"classtag_arts"=>['Affiche les articles ayant une classe de tags définie','spécifier la classe de tags','',''],
"clear"=>['clear:left annule le flottement à gauche','','',''],
"codeline"=>['Renvoie des balises html imbriquées écrites en Codeline','ex: [[_URL§_SUJ:link]§h2:html] [[_OPT§txtsmall2:css]','',''],
"conn"=>['résultat d\'un connecteur unique','','',''],
"connector"=>['permet de composer du code sous forme de connecteurs','L\'éditeur renvoie son contenu dans le champ param','balise article',''],
"contact"=>['mail à l\'admin','titre','css',''],
"content"=>['détermine la largeur artificielle de la page (informé par le constructeur css, obligatoire)','largeur de content (pour les images et vidéos)','',''],
"context"=>['spécifier un contexte','renvoie les modules appartenant à un contexte','',''],
"cover"=>['couverture d\'article','id ou Api (ex: priority:4,minday:14,random:1)','',''],
"create_art"=>['formulaire d\'ajout d\'articles','','',''],
"credits"=>['philum','','',''],
"csscode"=>['ajoute des css dans le header','','',''],
"deja_vu"=>['articles récemment visités','','',''],
"design"=>['détermine la feuille Css à utiliser (informé par le constructeur css, obligatoire)','spécifier un numéro de feuille css','abonnement css : place les css récents en sous-couche, sur laquelle il est possible d\'utiliser le minimum de personnalisation : classic, default, n>3 pour une table public) ; sinon voir params/auto_design',''],
"desktop"=>['paramètres du bureau','spécifier couleur html, #_var, dégradé ou image','',''],
"desktop_apps"=>['renvoie le contenu du desktop','concerne les apps avec la condition \'desk\', ou celle de l\'option','',''],
"desktop_arts"=>['présente des articles dans le Desktop','script de commande d\'articles (rien = ceux du cache)','',''],
"desktop_files"=>['présente des fichiers partagés dans le Desktop','global|virtual (defaut : local|real)','position du root',''],
"desktop_varts"=>['articles virtuels : construit les répertoires d\'après le meta \'folder\' des articles ','depuis [nombre de jours]','',''],
"disk"=>['Contenu d\'un répertoire de l\'espace disque utilisateur','spécifier un répertoire','',''],
"fav_mod"=>['Affiche les favoris partagés','En spécifiant un titre de favoris, ça affiche le rendu','',''],
"favs"=>['Articles sélectionnés par le visiteur','','',''],
"finder"=>['Ouvre un Finder','param (chemin) : hub/root/dir...','options pour chaque paramètre : 
- 0 = disk/shared/icons
- 1 = local/global/distant
- 2 = virtual/real
- 3 = list/panel/flap/icons/icon-disk
- 4 = normal/recursive/conn
- 5 = alone
- 6 = pictos/mini',''],
"folder"=>['Liste des dossiers virtuels','','',''],
"folders"=>['noeuds d\'articles, par ordre décroissant du nombre de sous-articles (dossiers d\'articles)','nb jours','ordonner par nombre',''],
"folders_varts"=>['Articles classés dans un dossier virtual','spécifier un répertoire','',''],
"frequent_tags"=>['tags les plus fréquents','préciser une classe, aucune = toutes','',''],
"friend_art"=>['renvoie l\'article nommé comme l\'ID de l\'article en cours','','css',''],
"friend_rub"=>['renvoie l\'article nommé comme la rubrique','','css',''],
"gallery"=>['','','',''],
"hierarchics"=>['menus hiérarchiques','Donner un titre','',''],
"hour"=>['date','spécifier : %A %d %B %G %T (optionnel)','css',''],
"hubs"=>['liste des Hubs','Donner un titre','affiche nombre d\'articles',''],
"jscode"=>['ajoute des js dans le header','','',''],
"jslink"=>['ajoute un lien js dans le header ','','',''],
"link"=>['renvoie un lien','home, category, 123, module/...','1 : picto associé ou picto nommé',''],
"last"=>['article le plus récent','','',''],
"last_search"=>['Recherches enregistrées','terme de la recherche','',''],
"last_tags"=>['derniers tags ajoutés','nombre de tags','préciser une classe / command bub : à destination d menubub',''],
"lbar"=>['largeur de leftbar (pour les images et vidéos)','informé par css_builder après un \'save_width\'','',''],
"log-out"=>['déconnexion','','',''],
"login"=>['login','Donner un titre','à droite',''],
"login_popup"=>['login dans une popup','Donner un titre','',''],
"module"=>['ID du module à appeler (utilisé pour simplifier les requêtes)','','',''],
"most_read"=>['articles les plus vus','nb_jours-nb_arts (ex: 7-50)','',''],
"most_read_stat"=>['articles les plus vus, stats consolidées','nb_jours-nb_arts (ex: 7-50) ','',''],
"most_polled"=>['articles les plus votés','définir le type de vote (fav,like,poll,mood)','limite (100)',''],
"score_datas"=>['articles les mieux notés','définir le type d\'évaluation (interest, feasibility, quality,...)','limite (100)',''],
"special_poll"=>['attribue des notes à un article','définir le nom du champ','choix1|choix2',''],
"newsletter"=>['inscription à la newsletter','Donner un titre','bouton vers une popup',''],
"overcats"=>['Menus supérieurs (voir /admin/overcat), auxquels se rattachent les catégories','Affiche un menu ouvrable, de type javascript ou ajax avec la commande bub','',''],
"panel_arts"=>['panneau d\'articles','commande de l\'Api, ou id','',''],
"player"=>['','','',''],
"app"=>['appel d\'une app','nom de l\'app','p et o envoyés à l\'app',''],
"popart"=>['ouvre article (local ou distant) dans une popup','','',''],
"prev_next"=>['affiche lien vers articles précédent et suivant','titres à afficher sur les boutons (|), ex: prev|next ou &amp;lt;|&amp;gt;','css ; commande rub : dans la même rubrique',''],
"priority_arts"=>['Articles ayant pour priorité','définir le niveau pour le tri (0-4)','nb cols ou limite de scroll ',''],
"pub"=>['pub d\'article','renvoie un simple lien si aucune option','1,2,3 : niveau de preview ; 4 : plusieurs id',''],
"pub_art"=>['titre + image','ID_article','niveau de preview',''],
"pub_arts"=>['panneau contenant des articles triés manuellement','123 124 : ID séparés par un espace','',''],
"pub_img"=>['utilise la première image référencée d\'un article','ID_article','',''],
"read"=>['contenu d\'article','ID_article','css',''],
"read_art"=>['contenu d\'un article','ID_article','',''],
"recents"=>['10 derniers articles d\'une rubrique','spécifier la rubrique (1 renvoie la rubrique en cours, toutes dans la Home)','',''],
"related_arts"=>['articles rattachés par l\'option d\'articles \'related\'','Donner un titre','ID ou [vide=auto]','traitement'],
"related_by"=>['articles qui pointent vers celui-ci par l\'option d\'articles \'related\'','Donner un titre','ID ou [vide=auto]','traitement'],
"parent_art"=>['article parent','id ou vide (article courant)','',''],
"child_arts"=>['articles enfants','id ou vide (article courant)','',''],
"rbar"=>['largeur de rightbar (pour les images et vidéos)','informé par css_builder après un \'save_width\'','',''],
"rss"=>['Renvoie un espace de consultation sur place des flux rss','indiquer le nom d\'une table de liens rss (rssurl par défaut)','',''],
"rss_input"=>['reçoit un flux rss, 10 titres les plus récents','spécifier un lien RSS','',''],
"rssin"=>['chaîne de flux rss','','',''],
"rub_tags"=>['tags des articles de la rubrique','classe de tags','',''],
"same_title"=>['articles ayant le même titre','Donner un titre','',''],
"search"=>['moteur de recherche','Donner un titre','aligne à droite',''],
"searched_arts"=>['recherches enregistrées','','',''],
"searched_words"=>['recherche de tags connus','','',''],
"cluster_tags"=>['recherche d\'articles similaires par cluster de tags','paramétrer les clusters dans /app/clusters','',''],
"same_tags"=>['recherche d\'articles ayant les mêmes tags','id','',''],
"see_also-rub"=>['Dans la même rubrique','spécifier la rubrique, 1=auto quand Home=All','',''],
"see_also-source"=>['articles de la même source','Donner un titre','',''],
"see_also-tags"=>['Articles ayant les mêmes Tags que l\'article en cours de lecture','spécifier la classe','',''],
"short_arts"=>['articles courts (brèves)','spécifier le nombre de caractères de l\'article (4000)','',''],
"social"=>['déroulé de publications','Donner un titre','',''],
"sources"=>['source url des articles aspirés','nombre d\'occurences','',''],
"stats"=>['histogramme des visites','nombre de jours (valeur courante par défaut)','avec text',''],
"submenus"=>['menus déroulants','syntaxe :
chaque objet est un connecteur \':link\' (ID, ID§titre, category)
chaque ligne correspond à un bouton
le nombre de tirets signifie la profondeur
les boutons au sommet d\'une hiérarchie ne peuvent pas être des liens

one
- two
three
- four
-- five','horizontal',''],
"suggest"=>['donne au visiteur le moyen de proposer un article depuis une Url','','',''],
"tag_arts"=>['articles ayant pour Tag','spécifier le tag de référence pour le tri ;
si besoin, préciser la classe de tags
ex: tag:classe','',''],
"tags"=>['liste des mots-clefs (tags)','spécifier la classe de tags','nb/taille des cols ou limite de scroll',''],
"clusters"=>['liste des clusters de tags','','',''],
"tags_cloud"=>['liste des mots-clefs (nuage de tags)','spécifier la classe de tags','',''],
"taxo_arts"=>['taxonomie d\'une rubrique / d\'un article (liste d\'articles, utilise le cache)','spécifier 1 (=rubrique en cours/All), une rubrique ou l\'ID d\'un article','',''],
"taxo_nav"=>['liste des noeuds avec menus ouvrables (se réfère au cache, puis cherche les parents dans le temps)','plugin ; spécifier l\'ID d\'un article parent','',''],
"taxonomy"=>['','','',''],
"template"=>['template d\'articles','nom du template','',''],
"text"=>['texte libre','spécifier un texte brut','',''],
"tracks"=>['commentaires des articles','nb de jours','1=sur place, sinon popup',''],
"twits"=>['Affiche tous les twits enregistrés','indiquer une date','nombre de résultats par page',''],
"webs"=>['Affiche les entrées des liens','id','nombre de résultats par page',''],
"twitter"=>['reçoit un flux Twitter','indiquer le hashtag (sans le #) ; option = nb de secondes du rafraîchissement','',''],
"video"=>['affiche une vidéo','id de la vidéo','',''],
"playconn"=>['articles contenant le connecteur spécifié','spécifier le connecteur (img,mp4,twitter,...)','',''],
"video_viewer"=>['viewer vidéo en ajax','règles de tri séparées par \'|\' :
- tag, cat, priority 
- tag1|tag2 ou 5-tag1|tag2 (5=tags)
- priority-2|3|4 ou 11-2|3|4 (11=priority)
- cat-public : articles dans \'public\' ;
- cat-1 : catégorie en cours','',''],
"microarts"=>['micro articles avec un seul champ et la date','nom du thread','',''],
"vacuum"=>['ouvre un article du web via le moteur Vacuum','url','','']];