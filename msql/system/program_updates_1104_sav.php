<?php
//philum_microsql_program_updates_1104

$program_updates_1104["_menus_"]=array('day','txt');
$program_updates_1104["1"]=array('110401','mise en conformité avec les serveurs sous php4 (backslashes illégaux) ;');
$program_updates_1104["2"]=array('110401',"réforme de plug/rss1, [flux rss alternatif interrogeable par Flash:b]. Il est surtout 'interrogeable' de sorte à produire des tris. Par défaut il se comporte comme 'rss' en produisant une source issue du cache des articles, sans connexion à MySql. 'rss2' disparaît.");
$program_updates_1104["3"]=array('110402',"renommage de 'radio' en 'jukebox' pour laisser la place à la future vraie 'radio' (application Flash et nom du connecteur) ;");
$program_updates_1104["4"]=array('110402',"réforme de 'rss-flash' : 'player' disparaît et est remplacé par 'rss.swf'. Réécrit, il est plus nettement rapide (les articles se chargent un à un), prend en compte les couleurs du site et la bannière, et peut présenter les titres et les rubriques, ou l'un des deux ou aucun des deux, si il est utilisé en mode 'player' d'articles.");
$program_updates_1104["5"]=array('110403',"amélioration de l'aide à l'édition pour les url : affiche une popup en ajax à la place de la boîte de dialogue hideuse ;");
$program_updates_1104["6"]=array('110403',"amélioration de l'aide à l'édition de 'microsql' qui propose désormais de choisir une table parmi celles existantes au lieu d'avoir à aller chercher cette information dans l'admin des microtables ;");
$program_updates_1104["7"]=array('110405',"petites améliorations de l'éditeur de 'Slider' : ajout de la fonction 'apply_to_all' (laisser les champs inchangés vides, seuls les champs renseignés s'appliquent à toutes les entrées, de sorte à ajouter une signature par exemple).");
$program_updates_1104["8"]=array('110406',"amélioration significative de 'publish_site' (qui ne sert qu'aux éditeurs de fourches évolutives du logiciel) : fait un deuxième passage en sens inverse (d'abord les éléments publiés et ensuite les éléments à publier) de façon à effacer les obsolètes.");
$program_updates_1104["9"]=array('110406',"ajout d'un onglet 'code' dans l'admin pour scruter le code source ;");
$program_updates_1104["10"]=array('110407',"réparation de 'vacuum' de sorte qu'il sache prendre en compte les sites Philum et importer les articles sans avoir spécifiquement informé les définitions ;");
$program_updates_1104["11"]=array('110407',"condamnation de la restriction 'explicit_url' en raison de certaines lacunes qui doivent être révisées ;");
$program_updates_1104["12"]=array('110408',"ajout d'un bouton permettant de retrouver les 'restrictions' par défaut ;");
$program_updates_1104["13"]=array('110408','mise à jour de certaines aides en ligne des restrictions ;');
$program_updates_1104["14"]=array('110409',"raccordement des paramètres et restrictions par défaut aux microbases 'system/default' (au lieu des antiques paramètres écris à la main) ;");
$program_updates_1104["15"]=array('110409',"amélioration du sélecteur de restrictions qui ne fait qu'un seul appel à la microbase de référence des noms au lieu de deux ;");
$program_updates_1104["16"]=array('110409',"amélioration du détecteur 'kmax' quand l'article est un connecteur d'importation d'un autre hub : suppression de toute la spécification puisque le connecteur lui-même se charge de savoir si l'article doit être présenté en monde 'preview' ou pas (gain de vitesse) ;");
$program_updates_1104["17"]=array('110409',"ajout d'un coussin pour appeler les modules par défaut si jamais ils ont été détruits par une opération malheureuse (ce qui produisait l'affichage de RIEN) ;");
$program_updates_1104["18"]=array('110410','correctif de sécurité à propos de la casse des log-in (empêcher une casse alternative de se loguer) ;');
$program_updates_1104["19"]=array('110410','correctif du destructeur de hubs : accessible au niveau 6, avec une étape de confirmation ;');
$program_updates_1104["20"]=array('110411',"rénovation du système de [pétition:b] :
- réécriture complète, code beaucoup plus dense ;
- révision du fonctionnement : la pétition est affectée à l'ID de l'article ;
- intitulés éditables pour chaque langue dans 'lang/fr/helps_petition' ;
- basé sur microsql ;
- entièrement en ajax ;
- mail de confirmation ;
- option du connecteur : nombre d'éléments par page (ex: [20:petition ]).");
$program_updates_1104["21"]=array('110412','[protocole des plug-ins:b] : chaque plug-in appelle une fonction du nom de la page ;');
$program_updates_1104["22"]=array('110412','mise à jour du modèle de plug-ins, y ajoutant le moyen de faire du ajax facilement ;');
$program_updates_1104["23"]=array('110413','mise en conformité du flux Rss avec W3c ;');
$program_updates_1104["24"]=array('110414','réparation (petite) faille de sécurité au moment de la connexion ;');
$program_updates_1104["25"]=array('110414',"rénovation du système de notes de bas de page : amélioration substantielle de l'ergonomie. Selon qu'on rédige du texte (curseur placé) ou qu'on l'édite (double-clic) les options sont différentes. Une popup en ajax remplace l'alerte windows. La fenêtre demande se fixer le point d'ancrage du lien sélectionné ou propose d'en fixer d'autres.");
$program_updates_1104["26"]=array('110415',"révision de l'emploi des liens javascripts : abolition de 'javascript:...' au profit d'un plus moderne 'onClick:' ; (les premiers étant rendus non fonctionnels par Firefox 4).");
$program_updates_1104["27"]=array('110416',"réforme dans le module 'channel' : spécification d'un nouveau paramètre 'site' afin de régler un conflit permettant à ce module d'être lancé au sein d'un connecteur 'ajax' ; (en clair, le connecteur ajax renvoie des modules, et parmi eux on peut désormais inclure 'channel' - pour faire cela il a suffit de supprimer 3 lignes de code et de réformer la procédure, au lieu de rajouter du code)");
$program_updates_1104["28"]=array('110416',"amélioration du module 'msql_links' de sorte à remplacer les modules 'rss_urls' et 'links' [rendus obsolètes:c] :
- msql_links peut faire appel à n'importe quelle base de liens, de flux ou de mails, à condition de préciser dans option la nature de ces données.
- ajout d'une aide contextuelle ;
- l'utilisateur doit activer une microtable d'enregistrement des données de 'links' et de 'rssurls' dans admin/builders/links et /rssurl.");
$program_updates_1104["29"]=array('110417',"deuxième amélioration du système de [notes de bas de pages:b] (ancres) :
- ajout d'un 'auto_anchors' qui va détecter et remplacer dans le texte tous les (1) ou les [1] par des ancres. Cela permet de rédiger son texte sans se soucier des ancres et d'appliquer ce filtre à la fin.
- prise en compte du langage pour l'aide contextuelle ;");
$program_updates_1104["30"]=array('110418',"amélioration substantielle les [filtres de texte:b] (les cases à cocher de l'éditeur disparaissent au profit d'un nouvel onglet d'aide à l'édition nommé 'filters' et qui propose de les faire fonctionner en ajax. Ainsi le résultat, s'il n'est pas celui désiré, au moins s'affiche immédiatement avant la prochaine sauvegarde, sans risquer d'abimer son contenu.");
$program_updates_1104["31"]=array('110418',"ajout (mais désactivation) d'un système pour revenir à la précédente version d'un enregistrement (inutile dans la pratique) ;");
$program_updates_1104["32"]=array('110419',"augmentation de la précision du [connecteur ':ajax':b] et du [module 'MenusJ':b] qui fonctionnent avec les mêmes algorithmes. (prise en compte du titre du module et de la cible de l'appel). Cela permet de créer des menus en ajax qui affichent le résultat d'un module (avec param, titre, commande, option) dans une cible (target) en affichant un titre (button).
Pour continuer de fonctionner le paramètre du module MenusJ doit s'adapter au nouveau protocole stipulé dans l'aide contextuelle)");
$program_updates_1104["33"]=array('110419','mise à jour en conséquence des microbases système.');
$program_updates_1104["34"]=array('110420',"[support des sous-domaines ::b]
- l'option 4 du 'master_config' demande si les hubs créés doivent engendrer des noms de domaines spécifiques, de sorte à obtenir 'hub.site.com' au lieu de 'site.com/hub' ;
- mise en conformité de la redirection des liens internes ;
- nombreux aménagements pour permettre de s'inscrire sur un hub, ce qui fait qu'on s'y logue, et pour rester logué quand on débouche sur la nouvelle Url fraîchement créée (on peut dire, un tour de magie...)
- remise à niveau de l'envoi d'un message de confiramation lors de l'enregistrement d'un nouveau hub (ajout de la fonction prep_host() qui choisi par 3 possibilités la bonne Url - sous-domaine, htaccess, ou normal) ;");
$program_updates_1104["35"]=array('110420',"javascript d'empêchement d'affichage des caractères interdits au moment de la création du hub ; Le logiciel ne supporte plus les noms de hubs avec '_', '-', ou '.' ;");
$program_updates_1104["36"]=array('110421',"ajout de ['words':b] : utilitaire côté utilisateur qui recense les mots d'un article qui sont référencés dans chacune des classes de tags, ce qui permet d'avoir une vue rapide de son contenu. Cette option d'articles est désactivale dans 'config/restrictions/arts')

[http://philum.fr/img/philum_296_editwords.jpg]");
$program_updates_1104["37"]=array('110422',"'vacuum' dans l'onglet du menu d'édition 'utils' devient en ajax (importation d'un article à la place du courant) ;");
$program_updates_1104["38"]=array('110423',"dans admin / update : bouton 'update_program' permet désormais d'updater le logiciel en une seule opération (on peut toujours le faire dossier par dossier, fichier par fichier, ou forcer un fichier apparemment à jour à être downloadé à nouveau).");
$program_updates_1104["39"]=array('110424',"ajout d'un système interne pour les patches, qui apparaîtront dans 'admin/update' lorsqu'ils seront nécessaire. Les patches seront cumulatifs, et donc ils seront tous toujours référencés (parce que l'utilisateur peut très bien arriver après que plusieurs patches aient eu à être appliqués...)");
$program_updates_1104["40"]=array('110425',"petit correctif de sauts de lignes d'origine inconnue qui forçait à interpréter une entrée qui n'avait pas besoin de l'être (petite bêtise qui était là depuis sûrement longtemps !)");
$program_updates_1104["41"]=array('110425',"création du [module 'rssj':b] qui renvoie la liste des flux rss de sorte qu'on puisse consulter le contenu de chacun d'eux sur place en ajax ;
Ce module fait appel à un autre module : rssinput, qui renvoie les titres d'un flux Rss.
- le module détecte et renvoie l'Url des articles déjà enregistrés sur le Hub (ils apparaissent en moindre opacité) ;
- Les flux s'ouvrent sur place (les boutons sont des 'toggle') ce qui permet de consulter plusieurs flux simultanément ;");
$program_updates_1104["42"]=array('110425',"réforme du système des numéro de version : - création d'une table 'system/program_version' à laquelle se réfèrent 'plug/distribution' et 'sys.php', et que met à jour automatiquement 'plug/publish_site'.");
$program_updates_1104["43"]=array('110425',"réforme du système de mises à jour : création de la table 'system/program_updates_x' (une table chaque mois) qui [recense toutes les modifications de façon à ce qu'elles soient relatées:b] dans admin/update au moment de la mise à jour");
$program_updates_1104["44"]=array('110426','compatibilité des ancres importées depuis un autre site Philum');
$program_updates_1104["45"]=array('110427',"le module rssj qui est apparu, rss ayant disparu, le module rssj est renommé 'rss' (que de chemin parcouru !)");
$program_updates_1104["46"]=array('110427',"intégration du concept de '[template ponctuel:b]'. Les modules reçoivent une colonne d'information 'template' et le module 'articles', avec l'option 'multi', est capable de traiter les articles issus du tri avec un template désigné ponctuellement. Le template ponctuel est le troisième niveau de templates, après le local et le global.");
$program_updates_1104["47"]=array('110427',"réforme de la nomination des tables de modules. Un paramètre dans admin/config/params spécifie le numéro de la table (1 par défaut).
Cela permettra de développer des mises en pages alternatives et de les sauvegarder sans pour autant les rendre fonctionnelles. (l'édition crée une session de modules qui n'affecte pas la table courante, mais aucune sauvegarde n'était possible sans affecter la table définitive).
La table de modules est essentielle à la construction de la structure du site, comme c'est un document sensible (autoréparable si effacé par erreur) il était important de permettre d'avoir des tables alternatives, ne serait-ce que pour les lier aux tables de design.");
$program_updates_1104["48"]=array('110427','ajout du patch pour informer les modules du nouveau nombre de colonnes, et pour les déplacer vers le nouveau format nominatif');
$program_updates_1104["49"]=array('110428',"petite réforme de l'appel ajax pour les plug-ins :
- mise en conformité du détecteur d'ID multiples de SaveJ (javascript) ;
- ajout de la fonction d'appel standard 'call_plug_func' : ainsi le créateur de plug-in peut passer par le hangar à fonctions ajax en faisant appel à une fonction écrite dans son propre plug-in ;
- correctif subséquent apporté au plug-in 'petition' ;");
$program_updates_1104["50"]=array('110428',"amélioratons du plug-in 'sliders' :
- mise en conformité avec call_plug_func ;
- réparation du 'rebuild' ;
- ajout d'un bouton 'delete' ;");
$program_updates_1104["51"]=array('110429',"cohérence entre les connecteurs, modules et codeline 'url' et 'link' :
- les templates sont modifiés, url à gauche et title à droite pour être conforme avec l'habitude, et le codeline ':link' devient ':url' ;
- 'link' renvoie un lien possiblement abrégé (ex: 'Home') et 'url' un lien html simple.
- en tant que module, ':link' renvoie (toujours) un lien en forme de liste, c'est pourquoi on a rajouté le module 'url' qui renvoie un lien simple.
- ': link' appelé en tant que connecteur renvoie un lien simple ;");
$program_updates_1104["52"]=array('110429',"ajout du module 'codeline' qui permet d'accéder à la librairie de construction de balises html imbriquées");
$program_updates_1104["53"]=array('110429',"réforme du Footer, désormais branché sur le tronc principal des modules, est capable de profiter de sa technologie (mise en cache, accès à tous les modules existants, prise en compte des options avancées) ;
DONC (désolés !) il faut ajouter l'option 'nobr' sur chaque module du Footer pour retrouver la pagination initiale.");
$program_updates_1104["54"]=array('110429',"ajout d'une capsule qui crée une table à partir de l'ancienne au moment où on change le paramètre des modules de la config");
$program_updates_1104["55"]=array('110430',"extension du domaine d'inférence des templates ponctuels à tous les tris issus du module 'articles'");
$program_updates_1104["56"]=array('110430',"introduction du concept de miniatures à dimensions choisies par l'utilisateur :
- fonctionnement extra-ordinaire, le traitement est réalisé à posteriori du traitement, après l'application du codeline.
- ajout du connecteur de codeline ':thumb' :
-- renvoie une miniature pleine largeur de Div (celle qui est en cours) ;
-- syntaxe : '[_IMG1§200/100:thumb] ;
-- implémentation : dans les templates ;
-- fonctionnement : '_IMG1' est la première image de l'article, mais on peut aussi spécifier n'importe quelle image. Les paramètres sont ceux du redimensionnement (largeur/hauteur), avec un recadrage centré.
-- la largeur par défaut est celle de la Div en cours, et (astuce) il est possible de changer ce paramètre dans le bloc de modules 'system'.
- et ajout de la restriction 19 pour empêcher la préparation pour la fabrication de '_IMG1' ;

ajout du connecteur de codeline ':img' qui renvoie une image simple.");
$program_updates_1104["57"]=array('10430','déplacement de la table des connecteurs de codeline avec les autres connecteurs');

?>