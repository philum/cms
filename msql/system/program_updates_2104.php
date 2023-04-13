<?php //msql/program_updates_2104
$r=["1"=>['0401','publication'],
"2"=>['0401','- le contenu du commentaire reste ouverte aprÃ¨s une modif'],
"3"=>['0402','- ajout des connecteurs, modules de playlist, et autres supports de gestion de :fact, :speech et :citation. Ces balises \"xlhtml\" sont des supports de contenu, qui permettent de crÃ©er des catalogues.
- deuxiÃ¨me grosse phase de transposition du gestionnaire des connecteurs dans une classe dÃ©diÃ©e, en laissant les subalternes dans pop. 20Ko de masse en moins au boot, Ã§a se sent !
- vu son amÃ©lioration, le codeline devient responsable du parse des connecteurs des commentaires (bcp plus rapide)
- renommages (\"99 files updated\")'],
"4"=>['0403','- correction : suppression des connecteurs et modules :speech et :citation; remplacÃ©s par le connecteur et module :quote
- l\'ancien :quote devient :callquote, il apparaissait dans les commentaires pour localiser une citation.
- le dispositif de prise de notes (callquotes) est reliÃ© avec la novelle balise :quote
- amÃ©lioration du parser codeline pour supporter des liens spÃ©ciaux divers, comme les connecteurs grandioses (qui eux sont trÃ¨s multitÃ¢ches et polycontextes)
- amÃ©lioration du dispositif de renvoi d\'un connecteur Ã  l\'intÃ©rieur d\'un lien, appliquÃ© aussi Ã  codeline (on peut afficher n\'importe quel connecteur dans une popup en le plaÃ§ant comme paramÃ¨tre : [hello:bÂ§bouton] au lieu de [helloÂ§option:b] et Ã§a marche mÃªme avec [helloÂ§option:bÂ§bouton] (lÃ  il faut suivre)'],
"5"=>['0403','- note de dev : le truc de ouf c\'est qu\'Ã  l\'intÃ©rieur d\'une classe, impossible de dÃ©tecter le caractÃ¨re Â§, alors il faut sortir la fonction de la classe pour que Ã§a remarche. Ce dÃ©limiteur Ã©tant central dans Philum, son intuition de se passer autant que possible des classes Ã©tait correcte.'],
"6"=>['0404','- ajout de l\'app star3d, supplÃ©tive de starmap (carte des Ã©toiles) et star, qui renvoie les donnÃ©es d\'une Ã©toile. Permet de faire une projection 3d d\'une sÃ©rie d\'Ã©toiles.
- correctifs lÃ©gitimes de codeline et conn, aprÃ¨s les prÃ©cÃ©dents chamboulements'],
"7"=>['0405','- remise Ã  niveau du fonctionnement des prises de notes sur place. Permet d\'ajouter des sÃ©lections au formulaire de commentaire, qui ensuite affiche un bouton qui allume la citation et dÃ©roule la page jusqu\'Ã  elle, qui allume un bouton qui permet de redescendre.'],
"8"=>['0407','- amÃ©lioration substancielle du gestionnaire des nouveaux tags xlhtml, qui s\'appuie sur le dispositif quote, qui crÃ©e un connecteur Ã©phÃ©mÃ¨re pour repÃ©rer une partie du texte citÃ© dans le commentaire : 
ajout des boutons d\'allumage du mode surlignement pour les :fact et les :quote ; permet d\'enregistrer directement la sÃ©lection.
En gros on peut stabilobosser un texte en live.
(tien, bonne idÃ©e, je le rajoute)'],
"9"=>['0408','- rÃ©novation du batch d\'importation d\'articles en masse : il en Ã©tait encore Ã  utiliser les modules d\'avant l\'arrivÃ©e de l\'api'],
"10"=>['0409','- suppression depuis la table des connecteurs des connecteurs associÃ©s Ã  la suppression des connecteurs, ben oui, au profit d\'une mÃ©canique qui se rÃ©fÃ¨re simplement aux connecteurs existant. 19 connecteurs supprimÃ©s.'],
"11"=>['0409','- suppression depuis la table des connecteurs des connecteurs associÃ©s Ã  la suppression des connecteurs, ben oui, au profit d\'une mÃ©canique qui se rÃ©fÃ¨re simplement aux connecteurs existant. 19 connecteurs supprimÃ©s.
- rÃ©paration de modsee
- unification des modules de playlist en un seul en utilisant un paramÃ¨tre, suppression des 7 modules (video,audio,img,pdf,twit,fact,quote)_playlist. Le systÃ¨me n\'est pas rendu capable de s\'Ã©tendre Ã  n connecteurs (pas utile).
- bon ok, le systÃ¨me est rendu capable de s\'Ã©tendre Ã  n connecteurs (c\'est quand mÃªme pratique de filtrer des connecteurs spÃ©cifiques). disparition des indicateurs de preview vd-ad-pd-tw-qt-fc-im'],
"12"=>['0411','- amÃ©liorations du moteur svg (from Fractal)
- ajout de la rstr136 : choisit le mode d\'ouverture secondaire de l\'article, en popup ou pagup'],
"13"=>['0412','- amÃ©lioration de la dÃ©tection des citations logÃ©es dans les commentaires (:callquote), au moyen d\'un filtrage des entitÃ©s html'],
"14"=>['0413','- ajout de la rstr137, permet de choisir si on Ã©crase les balises h1,h2,h3,h4;h5 en :h. Par dÃ©faut, il vaut mieux, mais parfois on a besoin de les garder pour crÃ©er un plan (connecteur :plan)'],
"15"=>['0414','- ajout de la rstr138 : permet de switcher le contenu en plein-Ã©cran
- ajout du support replacestate ; appliquÃ© Ã  prevnext, on peut commander une page en ajax et changer l\'url a posteriori (dÃ©filement des articles sans avoir Ã  recharger la page, bcp plus rapide)'],
"16"=>['0415','- systÃ¨mes de cache svg (fractal)'],
"17"=>['0416','- rÃ©paration/rÃ©novation de Amt
- introduction de la capacitÃ© Ã  passer les inp par dn2 au lieu de dn8
- usage du mode dataset pour lj()
- remise Ã  niveau comme apps de txt, pad, converts et exec'],
"18"=>['0417','- amÃ©lioration de la gestion des colonnes et du dÃ©placement des lignes dans l\'explorer de fractal, pour atteindre le niveau de l\'admin msql de philum'],
"19"=>['0418','- correctifs de codeline (lecture des :msql et des boutons allant vers des connecteurs)
- correctifs du gestionnaires de types de tracks (couleurs valables en pagup)
- ajout du plug sconn, comme le plug connectors, permet de tester les sconn
- ajout de l\'import de lien json dans msqladmin'],
"20"=>['0419','- rÃ©fection de explorer (fractal)
- nouveaux logos de philum et fractal
- ajouts de del_backup, rename et duplicate dans msqladm'],
"21"=>['0420','- ajout d\'un gestionnaire des Ã©quivalences de tags dans des langues diffÃ©rentes pour les mettre Ã  jour, et prÃ©parer les termes Ã  traduire et Ã  insÃ©rer en csv dans la table msql Ã©quivalente dans users/(user)/_tags_(n) oÃ¹ n = numÃ©ro de la classe de tags, par ordre d\'apparition dans prmb18'],
"22"=>['0421','- ajout d\'un gestionnaire des synonymes de tags afin d\'affecter des termes proches ou des pluriels Ã  des tags existants lors de leur dÃ©tection'],
"23"=>['0422','- adaptation du match_tags aux tags multilingues (Ã§a c\'est facile) et aux synonymes (pour Ã§a il a fallu tout rÃ©Ã©crire)
- mise en place de la traduction de tags pour les articles dans une autre langue
- modification du gestionnaire de tags appelÃ©s par leur id dans l\'api
- conversion de umrec en app'],
"24"=>['0423','- correctifs de dÃ©tection des images et de goodroot()
- le conn :appin devien :app
- ajout de stars3, carte des Ã©toiles en mode Ã©quatorial'],
"25"=>['0424','- chasse aux png : le bouton de conversion est dissociÃ© de ceux de la rÃ©duction de taille des gros fichiers, pour les png>500k
- correctif (annulÃ©) sur ecar() : limitation des rÃ©cursions
- umrec reÃ§oit des listes et peut les afficher sous forme de tableaux (compilateur)'],
"26"=>['0425','- listes et tables sont mis dans un p
- ajout du conn :nms (nominations multilingues)
- les iframes sont automatiquement placÃ©es sont un bouton d\'ouverture sÃ©parÃ©e (marre des vidÃ©os Ã  lancement auto)
- correctifs app star (rendu plus propre des nombreuses expositions des rÃ©sultats)
- umcom reÃ§oit les listes (id ou suj)
- ajout de supports de des apps par connecteur, et de :stabilo Ã  codeline (dans les tracks mais pas dans l\'Ã©dition wyg)
- correctif dÃ©tection :stabilo dans conv
- :toggle_quote devient :toggle (relÃ©guant les autres variantes Ã  des spÃ©cialitÃ©s)
- correctif make_thumb_c() pour capturer les vignettes des profiles tw'],
"27"=>['0426','- ajout des outils d\'Ã©dition cita_italics et cita_quotes, permettent ce placer les guillemets typographiques dans des blocs ou des italiques
- amÃ©liorations de stars et starmap3 et 4'],
"28"=>['0427','- amÃ©liorations du gestionnaire mysql
- (fractal) introduction de :gp dans svg, pont entre algo et graphics, amÃ©liorations de upsql'],
"29"=>['0428','- rÃ©novation du gestionnaire mysql pour les bases subalternes (sur le modÃ¨le de fractal : industrialisation de la maintenance de la structure des tables)
- rÃ©novation du gestionnaire de clusters de tags
- ajout du support des clusters dans l\'api
- ajout du module :cluster, joint naturellement par les systÃ¨mes de menus
- remise en service (du coup) du module cluster_tags, qui permet de cherche des articles d\'aprÃ¨s les tags d\'un cluster des tags d\'un article... (pour la recherche d\'articles reliÃ©s par la sÃ©mantique)'],
"30"=>['0429','- ajout du connecteur de service :imgdata
- correctifs starmap4'],
"31"=>['0430','- ajout du contrÃ´leur until_error() dans conv, permet de prÃ©venir l\'impairitÃ© des balises html, Ã©vitant une erreur de rÃ©cursion infinie dans ecar()
- correctifs de navs(), boutons d\'Ã©dition, pour compatibilitÃ© entre l\'Ã©dition des arts et des tracks (usage de insert_b uniforme), ajout de boutons dans l\'Ã©diteur de tracks
- retrait d\'un critÃ¨re inusitÃ© de pictos
- ajout d\'un intermÃ©diaire Ã  l\'ouverture des apps via les connecteurs, proposant d\'office que le Â§1 renvoie un bouton (au lieu de confier cela aux apps) ;
- les pictos des apps via les conn sont ceux dÃ©finis dans les mimes
- ajout de picto2() qui passe par le mime']];