<?php
//philum_microsql_program_updates_1104

$program_updates_1104["_menus_"]=array('day','txt');
$program_updates_1104["1"]=array('110401','mise en conformit� avec les serveurs sous php4 (backslashes ill�gaux) ;');
$program_updates_1104["2"]=array('110401',"r�forme de plug/rss1, [flux rss alternatif interrogeable par Flash:b]. Il est surtout 'interrogeable' de sorte � produire des tris. Par d�faut il se comporte comme 'rss' en produisant une source issue du cache des articles, sans connexion � MySql. 'rss2' dispara�t.");
$program_updates_1104["3"]=array('110402',"renommage de 'radio' en 'jukebox' pour laisser la place � la future vraie 'radio' (application Flash et nom du connecteur) ;");
$program_updates_1104["4"]=array('110402',"r�forme de 'rss-flash' : 'player' dispara�t et est remplac� par 'rss.swf'. R��crit, il est plus nettement rapide (les articles se chargent un � un), prend en compte les couleurs du site et la banni�re, et peut pr�senter les titres et les rubriques, ou l'un des deux ou aucun des deux, si il est utilis� en mode 'player' d'articles.");
$program_updates_1104["5"]=array('110403',"am�lioration de l'aide � l'�dition pour les url : affiche une popup en ajax � la place de la bo�te de dialogue hideuse ;");
$program_updates_1104["6"]=array('110403',"am�lioration de l'aide � l'�dition de 'microsql' qui propose d�sormais de choisir une table parmi celles existantes au lieu d'avoir � aller chercher cette information dans l'admin des microtables ;");
$program_updates_1104["7"]=array('110405',"petites am�liorations de l'�diteur de 'Slider' : ajout de la fonction 'apply_to_all' (laisser les champs inchang�s vides, seuls les champs renseign�s s'appliquent � toutes les entr�es, de sorte � ajouter une signature par exemple).");
$program_updates_1104["8"]=array('110406',"am�lioration significative de 'publish_site' (qui ne sert qu'aux �diteurs de fourches �volutives du logiciel) : fait un deuxi�me passage en sens inverse (d'abord les �l�ments publi�s et ensuite les �l�ments � publier) de fa�on � effacer les obsol�tes.");
$program_updates_1104["9"]=array('110406',"ajout d'un onglet 'code' dans l'admin pour scruter le code source ;");
$program_updates_1104["10"]=array('110407',"r�paration de 'vacuum' de sorte qu'il sache prendre en compte les sites Philum et importer les articles sans avoir sp�cifiquement inform� les d�finitions ;");
$program_updates_1104["11"]=array('110407',"condamnation de la restriction 'explicit_url' en raison de certaines lacunes qui doivent �tre r�vis�es ;");
$program_updates_1104["12"]=array('110408',"ajout d'un bouton permettant de retrouver les 'restrictions' par d�faut ;");
$program_updates_1104["13"]=array('110408','mise � jour de certaines aides en ligne des restrictions ;');
$program_updates_1104["14"]=array('110409',"raccordement des param�tres et restrictions par d�faut aux microbases 'system/default' (au lieu des antiques param�tres �cris � la main) ;");
$program_updates_1104["15"]=array('110409',"am�lioration du s�lecteur de restrictions qui ne fait qu'un seul appel � la microbase de r�f�rence des noms au lieu de deux ;");
$program_updates_1104["16"]=array('110409',"am�lioration du d�tecteur 'kmax' quand l'article est un connecteur d'importation d'un autre hub : suppression de toute la sp�cification puisque le connecteur lui-m�me se charge de savoir si l'article doit �tre pr�sent� en monde 'preview' ou pas (gain de vitesse) ;");
$program_updates_1104["17"]=array('110409',"ajout d'un coussin pour appeler les modules par d�faut si jamais ils ont �t� d�truits par une op�ration malheureuse (ce qui produisait l'affichage de RIEN) ;");
$program_updates_1104["18"]=array('110410','correctif de s�curit� � propos de la casse des log-in (emp�cher une casse alternative de se loguer) ;');
$program_updates_1104["19"]=array('110410','correctif du destructeur de hubs : accessible au niveau 6, avec une �tape de confirmation ;');
$program_updates_1104["20"]=array('110411',"r�novation du syst�me de [p�tition:b] :
- r��criture compl�te, code beaucoup plus dense ;
- r�vision du fonctionnement : la p�tition est affect�e � l'ID de l'article ;
- intitul�s �ditables pour chaque langue dans 'lang/fr/helps_petition' ;
- bas� sur microsql ;
- enti�rement en ajax ;
- mail de confirmation ;
- option du connecteur : nombre d'�l�ments par page (ex: [20:petition ]).");
$program_updates_1104["21"]=array('110412','[protocole des plug-ins:b] : chaque plug-in appelle une fonction du nom de la page ;');
$program_updates_1104["22"]=array('110412','mise � jour du mod�le de plug-ins, y ajoutant le moyen de faire du ajax facilement ;');
$program_updates_1104["23"]=array('110413','mise en conformit� du flux Rss avec W3c ;');
$program_updates_1104["24"]=array('110414','r�paration (petite) faille de s�curit� au moment de la connexion ;');
$program_updates_1104["25"]=array('110414',"r�novation du syst�me de notes de bas de page : am�lioration substantielle de l'ergonomie. Selon qu'on r�dige du texte (curseur plac�) ou qu'on l'�dite (double-clic) les options sont diff�rentes. Une popup en ajax remplace l'alerte windows. La fen�tre demande se fixer le point d'ancrage du lien s�lectionn� ou propose d'en fixer d'autres.");
$program_updates_1104["26"]=array('110415',"r�vision de l'emploi des liens javascripts : abolition de 'javascript:...' au profit d'un plus moderne 'onClick:' ; (les premiers �tant rendus non fonctionnels par Firefox 4).");
$program_updates_1104["27"]=array('110416',"r�forme dans le module 'channel' : sp�cification d'un nouveau param�tre 'site' afin de r�gler un conflit permettant � ce module d'�tre lanc� au sein d'un connecteur 'ajax' ; (en clair, le connecteur ajax renvoie des modules, et parmi eux on peut d�sormais inclure 'channel' - pour faire cela il a suffit de supprimer 3 lignes de code et de r�former la proc�dure, au lieu de rajouter du code)");
$program_updates_1104["28"]=array('110416',"am�lioration du module 'msql_links' de sorte � remplacer les modules 'rss_urls' et 'links' [rendus obsol�tes:c] :
- msql_links peut faire appel � n'importe quelle base de liens, de flux ou de mails, � condition de pr�ciser dans option la nature de ces donn�es.
- ajout d'une aide contextuelle ;
- l'utilisateur doit activer une microtable d'enregistrement des donn�es de 'links' et de 'rssurls' dans admin/builders/links et /rssurl.");
$program_updates_1104["29"]=array('110417',"deuxi�me am�lioration du syst�me de [notes de bas de pages:b] (ancres) :
- ajout d'un 'auto_anchors' qui va d�tecter et remplacer dans le texte tous les (1) ou les [1] par des ancres. Cela permet de r�diger son texte sans se soucier des ancres et d'appliquer ce filtre � la fin.
- prise en compte du langage pour l'aide contextuelle ;");
$program_updates_1104["30"]=array('110418',"am�lioration substantielle les [filtres de texte:b] (les cases � cocher de l'�diteur disparaissent au profit d'un nouvel onglet d'aide � l'�dition nomm� 'filters' et qui propose de les faire fonctionner en ajax. Ainsi le r�sultat, s'il n'est pas celui d�sir�, au moins s'affiche imm�diatement avant la prochaine sauvegarde, sans risquer d'abimer son contenu.");
$program_updates_1104["31"]=array('110418',"ajout (mais d�sactivation) d'un syst�me pour revenir � la pr�c�dente version d'un enregistrement (inutile dans la pratique) ;");
$program_updates_1104["32"]=array('110419',"augmentation de la pr�cision du [connecteur ':ajax':b] et du [module 'MenusJ':b] qui fonctionnent avec les m�mes algorithmes. (prise en compte du titre du module et de la cible de l'appel). Cela permet de cr�er des menus en ajax qui affichent le r�sultat d'un module (avec param, titre, commande, option) dans une cible (target) en affichant un titre (button).
Pour continuer de fonctionner le param�tre du module MenusJ doit s'adapter au nouveau protocole stipul� dans l'aide contextuelle)");
$program_updates_1104["33"]=array('110419','mise � jour en cons�quence des microbases syst�me.');
$program_updates_1104["34"]=array('110420',"[support des sous-domaines ::b]
- l'option 4 du 'master_config' demande si les hubs cr��s doivent engendrer des noms de domaines sp�cifiques, de sorte � obtenir 'hub.site.com' au lieu de 'site.com/hub' ;
- mise en conformit� de la redirection des liens internes ;
- nombreux am�nagements pour permettre de s'inscrire sur un hub, ce qui fait qu'on s'y logue, et pour rester logu� quand on d�bouche sur la nouvelle Url fra�chement cr��e (on peut dire, un tour de magie...)
- remise � niveau de l'envoi d'un message de confiramation lors de l'enregistrement d'un nouveau hub (ajout de la fonction prep_host() qui choisi par 3 possibilit�s la bonne Url - sous-domaine, htaccess, ou normal) ;");
$program_updates_1104["35"]=array('110420',"javascript d'emp�chement d'affichage des caract�res interdits au moment de la cr�ation du hub ; Le logiciel ne supporte plus les noms de hubs avec '_', '-', ou '.' ;");
$program_updates_1104["36"]=array('110421',"ajout de ['words':b] : utilitaire c�t� utilisateur qui recense les mots d'un article qui sont r�f�renc�s dans chacune des classes de tags, ce qui permet d'avoir une vue rapide de son contenu. Cette option d'articles est d�sactivale dans 'config/restrictions/arts')

[http://philum.net/img/philum_296_editwords.jpg]");
$program_updates_1104["37"]=array('110422',"'vacuum' dans l'onglet du menu d'�dition 'utils' devient en ajax (importation d'un article � la place du courant) ;");
$program_updates_1104["38"]=array('110423',"dans admin / update : bouton 'update_program' permet d�sormais d'updater le logiciel en une seule op�ration (on peut toujours le faire dossier par dossier, fichier par fichier, ou forcer un fichier apparemment � jour � �tre download� � nouveau).");
$program_updates_1104["39"]=array('110424',"ajout d'un syst�me interne pour les patches, qui appara�tront dans 'admin/update' lorsqu'ils seront n�cessaire. Les patches seront cumulatifs, et donc ils seront tous toujours r�f�renc�s (parce que l'utilisateur peut tr�s bien arriver apr�s que plusieurs patches aient eu � �tre appliqu�s...)");
$program_updates_1104["40"]=array('110425',"petit correctif de sauts de lignes d'origine inconnue qui for�ait � interpr�ter une entr�e qui n'avait pas besoin de l'�tre (petite b�tise qui �tait l� depuis s�rement longtemps !)");
$program_updates_1104["41"]=array('110425',"cr�ation du [module 'rssj':b] qui renvoie la liste des flux rss de sorte qu'on puisse consulter le contenu de chacun d'eux sur place en ajax ;
Ce module fait appel � un autre module : rssinput, qui renvoie les titres d'un flux Rss.
- le module d�tecte et renvoie l'Url des articles d�j� enregistr�s sur le Hub (ils apparaissent en moindre opacit�) ;
- Les flux s'ouvrent sur place (les boutons sont des 'toggle') ce qui permet de consulter plusieurs flux simultan�ment ;");
$program_updates_1104["42"]=array('110425',"r�forme du syst�me des num�ro de version : - cr�ation d'une table 'system/program_version' � laquelle se r�f�rent 'plug/distribution' et 'sys.php', et que met � jour automatiquement 'plug/publish_site'.");
$program_updates_1104["43"]=array('110425',"r�forme du syst�me de mises � jour : cr�ation de la table 'system/program_updates_x' (une table chaque mois) qui [recense toutes les modifications de fa�on � ce qu'elles soient relat�es:b] dans admin/update au moment de la mise � jour");
$program_updates_1104["44"]=array('110426','compatibilit� des ancres import�es depuis un autre site Philum');
$program_updates_1104["45"]=array('110427',"le module rssj qui est apparu, rss ayant disparu, le module rssj est renomm� 'rss' (que de chemin parcouru !)");
$program_updates_1104["46"]=array('110427',"int�gration du concept de '[template ponctuel:b]'. Les modules re�oivent une colonne d'information 'template' et le module 'articles', avec l'option 'multi', est capable de traiter les articles issus du tri avec un template d�sign� ponctuellement. Le template ponctuel est le troisi�me niveau de templates, apr�s le local et le global.");
$program_updates_1104["47"]=array('110427',"r�forme de la nomination des tables de modules. Un param�tre dans admin/config/params sp�cifie le num�ro de la table (1 par d�faut).
Cela permettra de d�velopper des mises en pages alternatives et de les sauvegarder sans pour autant les rendre fonctionnelles. (l'�dition cr�e une session de modules qui n'affecte pas la table courante, mais aucune sauvegarde n'�tait possible sans affecter la table d�finitive).
La table de modules est essentielle � la construction de la structure du site, comme c'est un document sensible (autor�parable si effac� par erreur) il �tait important de permettre d'avoir des tables alternatives, ne serait-ce que pour les lier aux tables de design.");
$program_updates_1104["48"]=array('110427','ajout du patch pour informer les modules du nouveau nombre de colonnes, et pour les d�placer vers le nouveau format nominatif');
$program_updates_1104["49"]=array('110428',"petite r�forme de l'appel ajax pour les plug-ins :
- mise en conformit� du d�tecteur d'ID multiples de SaveJ (javascript) ;
- ajout de la fonction d'appel standard 'call_plug_func' : ainsi le cr�ateur de plug-in peut passer par le hangar � fonctions ajax en faisant appel � une fonction �crite dans son propre plug-in ;
- correctif subs�quent apport� au plug-in 'petition' ;");
$program_updates_1104["50"]=array('110428',"am�lioratons du plug-in 'sliders' :
- mise en conformit� avec call_plug_func ;
- r�paration du 'rebuild' ;
- ajout d'un bouton 'delete' ;");
$program_updates_1104["51"]=array('110429',"coh�rence entre les connecteurs, modules et codeline 'url' et 'link' :
- les templates sont modifi�s, url � gauche et title � droite pour �tre conforme avec l'habitude, et le codeline ':link' devient ':url' ;
- 'link' renvoie un lien possiblement abr�g� (ex: 'Home') et 'url' un lien html simple.
- en tant que module, ':link' renvoie (toujours) un lien en forme de liste, c'est pourquoi on a rajout� le module 'url' qui renvoie un lien simple.
- ': link' appel� en tant que connecteur renvoie un lien simple ;");
$program_updates_1104["52"]=array('110429',"ajout du module 'codeline' qui permet d'acc�der � la librairie de construction de balises html imbriqu�es");
$program_updates_1104["53"]=array('110429',"r�forme du Footer, d�sormais branch� sur le tronc principal des modules, est capable de profiter de sa technologie (mise en cache, acc�s � tous les modules existants, prise en compte des options avanc�es) ;
DONC (d�sol�s !) il faut ajouter l'option 'nobr' sur chaque module du Footer pour retrouver la pagination initiale.");
$program_updates_1104["54"]=array('110429',"ajout d'une capsule qui cr�e une table � partir de l'ancienne au moment o� on change le param�tre des modules de la config");
$program_updates_1104["55"]=array('110430',"extension du domaine d'inf�rence des templates ponctuels � tous les tris issus du module 'articles'");
$program_updates_1104["56"]=array('110430',"introduction du concept de miniatures � dimensions choisies par l'utilisateur :
- fonctionnement extra-ordinaire, le traitement est r�alis� � posteriori du traitement, apr�s l'application du codeline.
- ajout du connecteur de codeline ':thumb' :
-- renvoie une miniature pleine largeur de Div (celle qui est en cours) ;
-- syntaxe : '[_IMG1�200/100:thumb] ;
-- impl�mentation : dans les templates ;
-- fonctionnement : '_IMG1' est la premi�re image de l'article, mais on peut aussi sp�cifier n'importe quelle image. Les param�tres sont ceux du redimensionnement (largeur/hauteur), avec un recadrage centr�.
-- la largeur par d�faut est celle de la Div en cours, et (astuce) il est possible de changer ce param�tre dans le bloc de modules 'system'.
- et ajout de la restriction 19 pour emp�cher la pr�paration pour la fabrication de '_IMG1' ;

ajout du connecteur de codeline ':img' qui renvoie une image simple.");
$program_updates_1104["57"]=array('10430','d�placement de la table des connecteurs de codeline avec les autres connecteurs');

?>