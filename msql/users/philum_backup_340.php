<?php
//philum_microsql_philum_backup_340
$r["_menus_"]=array('val0');
$r[1]=array('Ajax est devenu indispensable au confort d\'utilisation du logiciel mais possède une limitation quant à la quantité de données qui peuvent être reçues par XMLHttpRequest(), qui varie entre 2000 et 8000 caractères.
C\'est suffisant pour la plupart des actions mais pas pour l\'enregistrement des articles. 

En l\'absence de solution déjà existante il a fallu improviser ! Depuis l\'avènement du ajax dans Philum il y a quatre ans on rêvait de pouvoir s\'affranchir de cette limitation.

[Modus operandi:b]

Pendant l\'exécution du code javascript, une commande ajax se projette dans une nouvelle ligne de temps indépendante de la première de sorte que le script initial continue et se termine pendant que les données sont envoyées et reçues (la transaction) afin d\'être ré-envoyées en tant que résultat.

Le Ajax Multithread (AMT) part du constat de cette indépendance temporelle, car ça signifie aussi qu\'on peut démarrer plusieurs actions ajax qui se dérouleront en même temps, y compris l\'accès et l\'envoi de données, de la même manière que le serveur gère également l\'ouverture de plusieurs fichiers simultanément (c\'était une supposition). Ensuite il a fallu déterminer le modus operandi, parmi les nombreux possibles, qui produit un résultat fonctionnel et fiable.

Les données sont toutes envoyées simultanément et numérotées, puis stockées dans un variable de session.
Le fait qu\'on obtienne des valeurs négatives dans le cumul du temps prit pour chaque thread prouve bien que les transactions peuvent être simultanées.

[Tests de vitesse:b]

Voici le temps écoulé en milliseconde (parfois négatif) entre chaque threads, avec à droite l\'heure d\'arrivée: 

[1340637 699.4831
0.01182 699.495
0.01858 699.5135
0.00721 699.528
0.00684 699.5349
0.01047 699.5454
0.01695 699.5623
0.02801 699.5903
0.02804 699.6184
0.03185 699.6502
0.02822 699.6785
0.02847 699.7069
0.02730 699.7342
0.03194 699.7662
0.02803 699.7942
0.02789 699.8221
0.02866 699.8508
0.03193 699.8827
0.02786 699.9106
0.02788 699.9384
0.02100 699.9595§auto:table]
[= 0.43863201141357 s.:table]

On peut voir que le transfert de 22 threads de 2000 cars. (soit 43 546 car., soit 35 min.)  prend [0.44s:b], ce qui est très satisfaisant.

Ensuite on obtient : [131 threads in 3.6401 s:b]. (261 276 chars. / 201 min.)
et : [392 threads in 11.2702 s.:b] (783 828 chars. / 603 min.) 
mais à partir de là le serveur répond : [Allowed memory size of 100663296 bytes exhausted (tried to allocate 406627 bytes):i]. La méthode est donc fiable jusqu\'à la limite du serveur.

Dans l\'usage courant, l\'enregistrement est instantané, bien plus rapide que le fading du rendu qui signale l\'activité. C\'est ce qu\'on appelle un bon bond (technologique) !

[Temporalité:b]

D\'habitude seule l\'action d\'Ajax nous intéresse à partir de l\'embranchement temporel mais ici on a besoin que le script attende que les transactions soient toutes terminées pour continuer son exécution, qui consiste ordonner les résultats logés dans la variable de session (puisqu\'ils n\'arrivent pas forcément dans l\'ordre), à les sauvegarder et à afficher le rendu. Il est impossible de demander à un javascript d\'attendre un indicateur pour redémarrer (seule une alerte permet de le stopper de le continuer) et les techniques trouvées sur le web ne tiennent pas compte du fait qu\'on veuille temporiser le retour du résultat d\'une fonction, ou alors elles sont un peu lourdes.

La première méthode avait consisté à temporiser largement la poursuite de l\'exécution du script de façon à prévoir 99% des cas de figures, mais en plus de ne pas être fiable à 100%, on perd tout l\'avantage de la méthode AMT, qui est sa suprême vitesse.

Une fonction en attente de la poursuite du script est appelée [n:i] fois par ajax à chaque fois qu\'une transaction s\'est terminée avec succès, et lorsque [n:i] est égal au nombre de threads, le script se termine.

[Influence structurelle:b]

- On a rendu obsolètes les différentes contentions qui permettaient de revenir à une sauvegarde par POST au-delà de 5000 caractères ([on peut y revenir en activant la restriction \'save_in_ajax\' (53).:l]).
- Il a aussi fallu rendre le bouton \'[save:l]\' indisponible pendant la durée de l\'opération pour ne pas la saccager, y compris avec un malheureux double-clic (dû aux souris déglinguées !). Et donc il a aussi fallu individualiser les boutons \'save\' et donner un moyen au script de les connaître, mais ce n\'est que le prix progrès !
- un outil nommé \'last_saved\' a été ajouté en cas d\'erreur (improbable) de façon à récupérer le les données qui ont voulu être enregistrées (logées dans une variable locale, dans le navigateur).

[Conclusion:b]

Le confort d\'utilisation devient maximal, et toutes les transactions en ajax qui sont centralisées par la fonction SaveJ passent automatiquement en mode multithread au-delà de 2136 caractères, comme le bloc-notes ou la sauvegarde depuis l\'admin. L\'enregistrement des articles est quasi instantané là où avant ça prenais plusieurs secondes (avec le premier système de temporalité par approximation), et encore avant il fallait recharger toute la page.

Il n\'y a désormais plus aucune limite à l\'utilisation de Ajax, et grâce au AMT les logiciels web vont de plus en plus ressembler aux logiciels de bureau, tout en étant beaucoup volatiles d\'un point de vue évolutif.');

?>