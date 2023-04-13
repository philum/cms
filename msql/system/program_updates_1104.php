<?php //msql/program_updates_1104
$r=["_menus_"=>['day','txt'],
"1"=>['110401','mise en conformitÃ© avec les serveurs sous php4 (backslashes illÃ©gaux) ;'],
"2"=>['110401','rÃ©forme de plug/rss1, [flux rss alternatif interrogeable par Flash:b]. Il est surtout \'interrogeable\' de sorte Ã  produire des tris. Par dÃ©faut il se comporte comme \'rss\' en produisant une source issue du cache des articles, sans connexion Ã  MySql. \'rss2\' disparaÃ®t.'],
"3"=>['110402','renommage de \'radio\' en \'jukebox\' pour laisser la place Ã  la future vraie \'radio\' (application Flash et nom du connecteur) ;'],
"4"=>['110402','rÃ©forme de \'rss-flash\' : \'player\' disparaÃ®t et est remplacÃ© par \'rss.swf\'. RÃ©Ã©crit, il est plus nettement rapide (les articles se chargent un Ã  un), prend en compte les couleurs du site et la banniÃ¨re, et peut prÃ©senter les titres et les rubriques, ou l\'un des deux ou aucun des deux, si il est utilisÃ© en mode \'player\' d\'articles.'],
"5"=>['110403','amÃ©lioration de l\'aide Ã  l\'Ã©dition pour les url : affiche une popup en ajax Ã  la place de la boÃ®te de dialogue hideuse ;'],
"6"=>['110403','amÃ©lioration de l\'aide Ã  l\'Ã©dition de \'microsql\' qui propose dÃ©sormais de choisir une table parmi celles existantes au lieu d\'avoir Ã  aller chercher cette information dans l\'admin des microtables ;'],
"7"=>['110405','petites amÃ©liorations de l\'Ã©diteur de \'Slider\' : ajout de la fonction \'apply_to_all\' (laisser les champs inchangÃ©s vides, seuls les champs renseignÃ©s s\'appliquent Ã  toutes les entrÃ©es, de sorte Ã  ajouter une signature par exemple).'],
"8"=>['110406','amÃ©lioration significative de \'publish_site\' (qui ne sert qu\'aux Ã©diteurs de fourches Ã©volutives du logiciel) : fait un deuxiÃ¨me passage en sens inverse (d\'abord les Ã©lÃ©ments publiÃ©s et ensuite les Ã©lÃ©ments Ã  publier) de faÃ§on Ã  effacer les obsolÃ¨tes.'],
"9"=>['110406','ajout d\'un onglet \'code\' dans l\'admin pour scruter le code source ;'],
"10"=>['110407','rÃ©paration de \'vacuum\' de sorte qu\'il sache prendre en compte les sites Philum et importer les articles sans avoir spÃ©cifiquement informÃ© les dÃ©finitions ;'],
"11"=>['110407','condamnation de la restriction \'explicit_url\' en raison de certaines lacunes qui doivent Ãªtre rÃ©visÃ©es ;'],
"12"=>['110408','ajout d\'un bouton permettant de retrouver les \'restrictions\' par dÃ©faut ;'],
"13"=>['110408','mise Ã  jour de certaines aides en ligne des restrictions ;'],
"14"=>['110409','raccordement des paramÃ¨tres et restrictions par dÃ©faut aux microbases \'system/default\' (au lieu des antiques paramÃ¨tres Ã©cris Ã  la main) ;'],
"15"=>['110409','amÃ©lioration du sÃ©lecteur de restrictions qui ne fait qu\'un seul appel Ã  la microbase de rÃ©fÃ©rence des noms au lieu de deux ;'],
"16"=>['110409','amÃ©lioration du dÃ©tecteur \'kmax\' quand l\'article est un connecteur d\'importation d\'un autre hub : suppression de toute la spÃ©cification puisque le connecteur lui-mÃªme se charge de savoir si l\'article doit Ãªtre prÃ©sentÃ© en monde \'preview\' ou pas (gain de vitesse) ;'],
"17"=>['110409','ajout d\'un coussin pour appeler les modules par dÃ©faut si jamais ils ont Ã©tÃ© dÃ©truits par une opÃ©ration malheureuse (ce qui produisait l\'affichage de RIEN) ;'],
"18"=>['110410','correctif de sÃ©curitÃ© Ã  propos de la casse des log-in (empÃªcher une casse alternative de se loguer) ;'],
"19"=>['110410','correctif du destructeur de hubs : accessible au niveau 6, avec une Ã©tape de confirmation ;'],
"20"=>['110411','rÃ©novation du systÃ¨me de [pÃ©tition:b] :
- rÃ©Ã©criture complÃ¨te, code beaucoup plus dense ;
- rÃ©vision du fonctionnement : la pÃ©tition est affectÃ©e Ã  l\'ID de l\'article ;
- intitulÃ©s Ã©ditables pour chaque langue dans \'lang/fr/helps_petition\' ;
- basÃ© sur microsql ;
- entiÃ¨rement en ajax ;
- mail de confirmation ;
- option du connecteur : nombre d\'Ã©lÃ©ments par page (ex: [20:petition ]).'],
"21"=>['110412','[protocole des plug-ins:b] : chaque plug-in appelle une fonction du nom de la page ;'],
"22"=>['110412','mise Ã  jour du modÃ¨le de plug-ins, y ajoutant le moyen de faire du ajax facilement ;'],
"23"=>['110413','mise en conformitÃ© du flux Rss avec W3c ;'],
"24"=>['110414','rÃ©paration (petite) faille de sÃ©curitÃ© au moment de la connexion ;'],
"25"=>['110414','rÃ©novation du systÃ¨me de notes de bas de page : amÃ©lioration substantielle de l\'ergonomie. Selon qu\'on rÃ©dige du texte (curseur placÃ©) ou qu\'on l\'Ã©dite (double-clic) les options sont diffÃ©rentes. Une popup en ajax remplace l\'alerte windows. La fenÃªtre demande se fixer le point d\'ancrage du lien sÃ©lectionnÃ© ou propose d\'en fixer d\'autres.'],
"26"=>['110415','rÃ©vision de l\'emploi des liens javascripts : abolition de \'javascript:...\' au profit d\'un plus moderne \'onClick:\' ; (les premiers Ã©tant rendus non fonctionnels par Firefox 4).'],
"27"=>['110416','rÃ©forme dans le module \'channel\' : spÃ©cification d\'un nouveau paramÃ¨tre \'site\' afin de rÃ©gler un conflit permettant Ã  ce module d\'Ãªtre lancÃ© au sein d\'un connecteur \'ajax\' ; (en clair, le connecteur ajax renvoie des modules, et parmi eux on peut dÃ©sormais inclure \'channel\' - pour faire cela il a suffit de supprimer 3 lignes de code et de rÃ©former la procÃ©dure, au lieu de rajouter du code)'],
"28"=>['110416','amÃ©lioration du module \'msql_links\' de sorte Ã  remplacer les modules \'rss_urls\' et \'links\' [rendus obsolÃ¨tes:c] :
- msql_links peut faire appel Ã  n\'importe quelle base de liens, de flux ou de mails, Ã  condition de prÃ©ciser dans option la nature de ces donnÃ©es.
- ajout d\'une aide contextuelle ;
- l\'utilisateur doit activer une microtable d\'enregistrement des donnÃ©es de \'links\' et de \'rssurls\' dans admin/builders/links et /rssurl.'],
"29"=>['110417','deuxiÃ¨me amÃ©lioration du systÃ¨me de [notes de bas de pages:b] (ancres) :
- ajout d\'un \'auto_anchors\' qui va dÃ©tecter et remplacer dans le texte tous les (1) ou les [1] par des ancres. Cela permet de rÃ©diger son texte sans se soucier des ancres et d\'appliquer ce filtre Ã  la fin.
- prise en compte du langage pour l\'aide contextuelle ;'],
"30"=>['110418','amÃ©lioration substantielle les [filtres de texte:b] (les cases Ã  cocher de l\'Ã©diteur disparaissent au profit d\'un nouvel onglet d\'aide Ã  l\'Ã©dition nommÃ© \'filters\' et qui propose de les faire fonctionner en ajax. Ainsi le rÃ©sultat, s\'il n\'est pas celui dÃ©sirÃ©, au moins s\'affiche immÃ©diatement avant la prochaine sauvegarde, sans risquer d\'abimer son contenu.'],
"31"=>['110418','ajout (mais dÃ©sactivation) d\'un systÃ¨me pour revenir Ã  la prÃ©cÃ©dente version d\'un enregistrement (inutile dans la pratique) ;'],
"32"=>['110419','augmentation de la prÃ©cision du [connecteur \':ajax\':b] et du [module \'MenusJ\':b] qui fonctionnent avec les mÃªmes algorithmes. (prise en compte du titre du module et de la cible de l\'appel). Cela permet de crÃ©er des menus en ajax qui affichent le rÃ©sultat d\'un module (avec param, titre, commande, option) dans une cible (target) en affichant un titre (button).
Pour continuer de fonctionner le paramÃ¨tre du module MenusJ doit s\'adapter au nouveau protocole stipulÃ© dans l\'aide contextuelle)'],
"33"=>['110419','mise Ã  jour en consÃ©quence des microbases systÃ¨me.'],
"34"=>['110420','[support des sous-domaines ::b]
- l\'option 4 du \'master_config\' demande si les hubs crÃ©Ã©s doivent engendrer des noms de domaines spÃ©cifiques, de sorte Ã  obtenir \'hub.site.com\' au lieu de \'site.com/hub\' ;
- mise en conformitÃ© de la redirection des liens internes ;
- nombreux amÃ©nagements pour permettre de s\'inscrire sur un hub, ce qui fait qu\'on s\'y logue, et pour rester loguÃ© quand on dÃ©bouche sur la nouvelle Url fraÃ®chement crÃ©Ã©e (on peut dire, un tour de magie...)
- remise Ã  niveau de l\'envoi d\'un message de confiramation lors de l\'enregistrement d\'un nouveau hub (ajout de la fonction prep_host() qui choisi par 3 possibilitÃ©s la bonne Url - sous-domaine, htaccess, ou normal) ;'],
"35"=>['110420','javascript d\'empÃªchement d\'affichage des caractÃ¨res interdits au moment de la crÃ©ation du hub ; Le logiciel ne supporte plus les noms de hubs avec \'_\', \'-\', ou \'.\' ;'],
"36"=>['110421','ajout de [\'words\':b] : utilitaire cÃ´tÃ© utilisateur qui recense les mots d\'un article qui sont rÃ©fÃ©rencÃ©s dans chacune des classes de tags, ce qui permet d\'avoir une vue rapide de son contenu. Cette option d\'articles est dÃ©sactivale dans \'config/restrictions/arts\')

[http://philum.fr/img/philum_296_editwords.jpg]'],
"37"=>['110422','\'vacuum\' dans l\'onglet du menu d\'Ã©dition \'utils\' devient en ajax (importation d\'un article Ã  la place du courant) ;'],
"38"=>['110423','dans admin / update : bouton \'update_program\' permet dÃ©sormais d\'updater le logiciel en une seule opÃ©ration (on peut toujours le faire dossier par dossier, fichier par fichier, ou forcer un fichier apparemment Ã  jour Ã  Ãªtre downloadÃ© Ã  nouveau).'],
"39"=>['110424','ajout d\'un systÃ¨me interne pour les patches, qui apparaÃ®tront dans \'admin/update\' lorsqu\'ils seront nÃ©cessaire. Les patches seront cumulatifs, et donc ils seront tous toujours rÃ©fÃ©rencÃ©s (parce que l\'utilisateur peut trÃ¨s bien arriver aprÃ¨s que plusieurs patches aient eu Ã  Ãªtre appliquÃ©s...)'],
"40"=>['110425','petit correctif de sauts de lignes d\'origine inconnue qui forÃ§ait Ã  interprÃ©ter une entrÃ©e qui n\'avait pas besoin de l\'Ãªtre (petite bÃªtise qui Ã©tait lÃ  depuis sÃ»rement longtemps !)'],
"41"=>['110425','crÃ©ation du [module \'rssj\':b] qui renvoie la liste des flux rss de sorte qu\'on puisse consulter le contenu de chacun d\'eux sur place en ajax ;
Ce module fait appel Ã  un autre module : rssinput, qui renvoie les titres d\'un flux Rss.
- le module dÃ©tecte et renvoie l\'Url des articles dÃ©jÃ  enregistrÃ©s sur le Hub (ils apparaissent en moindre opacitÃ©) ;
- Les flux s\'ouvrent sur place (les boutons sont des \'toggle\') ce qui permet de consulter plusieurs flux simultanÃ©ment ;'],
"42"=>['110425','rÃ©forme du systÃ¨me des numÃ©ro de version : - crÃ©ation d\'une table \'system/program_version\' Ã  laquelle se rÃ©fÃ¨rent \'plug/distribution\' et \'sys.php\', et que met Ã  jour automatiquement \'plug/publish_site\'.'],
"43"=>['110425','rÃ©forme du systÃ¨me de mises Ã  jour : crÃ©ation de la table \'system/program_updates_x\' (une table chaque mois) qui [recense toutes les modifications de faÃ§on Ã  ce qu\'elles soient relatÃ©es:b] dans admin/update au moment de la mise Ã  jour'],
"44"=>['110426','compatibilitÃ© des ancres importÃ©es depuis un autre site Philum'],
"45"=>['110427','le module rssj qui est apparu, rss ayant disparu, le module rssj est renommÃ© \'rss\' (que de chemin parcouru !)'],
"46"=>['110427','intÃ©gration du concept de \'[template ponctuel:b]\'. Les modules reÃ§oivent une colonne d\'information \'template\' et le module \'articles\', avec l\'option \'multi\', est capable de traiter les articles issus du tri avec un template dÃ©signÃ© ponctuellement. Le template ponctuel est le troisiÃ¨me niveau de templates, aprÃ¨s le local et le global.'],
"47"=>['110427','rÃ©forme de la nomination des tables de modules. Un paramÃ¨tre dans admin/config/params spÃ©cifie le numÃ©ro de la table (1 par dÃ©faut).
Cela permettra de dÃ©velopper des mises en pages alternatives et de les sauvegarder sans pour autant les rendre fonctionnelles. (l\'Ã©dition crÃ©e une session de modules qui n\'affecte pas la table courante, mais aucune sauvegarde n\'Ã©tait possible sans affecter la table dÃ©finitive).
La table de modules est essentielle Ã  la construction de la structure du site, comme c\'est un document sensible (autorÃ©parable si effacÃ© par erreur) il Ã©tait important de permettre d\'avoir des tables alternatives, ne serait-ce que pour les lier aux tables de design.'],
"48"=>['110427','ajout du patch pour informer les modules du nouveau nombre de colonnes, et pour les dÃ©placer vers le nouveau format nominatif'],
"49"=>['110428','petite rÃ©forme de l\'appel ajax pour les plug-ins :
- mise en conformitÃ© du dÃ©tecteur d\'ID multiples de SaveJ (javascript) ;
- ajout de la fonction d\'appel standard \'call_plug_func\' : ainsi le crÃ©ateur de plug-in peut passer par le hangar Ã  fonctions ajax en faisant appel Ã  une fonction Ã©crite dans son propre plug-in ;
- correctif subsÃ©quent apportÃ© au plug-in \'petition\' ;'],
"50"=>['110428','amÃ©lioratons du plug-in \'sliders\' :
- mise en conformitÃ© avec call_plug_func ;
- rÃ©paration du \'rebuild\' ;
- ajout d\'un bouton \'delete\' ;'],
"51"=>['110429','cohÃ©rence entre les connecteurs, modules et codeline \'url\' et \'link\' :
- les templates sont modifiÃ©s, url Ã  gauche et title Ã  droite pour Ãªtre conforme avec l\'habitude, et le codeline \':link\' devient \':url\' ;
- \'link\' renvoie un lien possiblement abrÃ©gÃ© (ex: \'Home\') et \'url\' un lien html simple.
- en tant que module, \':link\' renvoie (toujours) un lien en forme de liste, c\'est pourquoi on a rajoutÃ© le module \'url\' qui renvoie un lien simple.
- \': link\' appelÃ© en tant que connecteur renvoie un lien simple ;'],
"52"=>['110429','ajout du module \'codeline\' qui permet d\'accÃ©der Ã  la librairie de construction de balises html imbriquÃ©es'],
"53"=>['110429','rÃ©forme du Footer, dÃ©sormais branchÃ© sur le tronc principal des modules, est capable de profiter de sa technologie (mise en cache, accÃ¨s Ã  tous les modules existants, prise en compte des options avancÃ©es) ;
DONC (dÃ©solÃ©s !) il faut ajouter l\'option \'nobr\' sur chaque module du Footer pour retrouver la pagination initiale.'],
"54"=>['110429','ajout d\'une capsule qui crÃ©e une table Ã  partir de l\'ancienne au moment oÃ¹ on change le paramÃ¨tre des modules de la config'],
"55"=>['110430','extension du domaine d\'infÃ©rence des templates ponctuels Ã  tous les tris issus du module \'articles\''],
"56"=>['110430','introduction du concept de miniatures Ã  dimensions choisies par l\'utilisateur :
- fonctionnement extra-ordinaire, le traitement est rÃ©alisÃ© Ã  posteriori du traitement, aprÃ¨s l\'application du codeline.
- ajout du connecteur de codeline \':thumb\' :
-- renvoie une miniature pleine largeur de Div (celle qui est en cours) ;
-- syntaxe : \'[_IMG1Â§200/100:thumb] ;
-- implÃ©mentation : dans les templates ;
-- fonctionnement : \'_IMG1\' est la premiÃ¨re image de l\'article, mais on peut aussi spÃ©cifier n\'importe quelle image. Les paramÃ¨tres sont ceux du redimensionnement (largeur/hauteur), avec un recadrage centrÃ©.
-- la largeur par dÃ©faut est celle de la Div en cours, et (astuce) il est possible de changer ce paramÃ¨tre dans le bloc de modules \'system\'.
- et ajout de la restriction 19 pour empÃªcher la prÃ©paration pour la fabrication de \'_IMG1\' ;

ajout du connecteur de codeline \':img\' qui renvoie une image simple.'],
"57"=>['10430','dÃ©placement de la table des connecteurs de codeline avec les autres connecteurs']];