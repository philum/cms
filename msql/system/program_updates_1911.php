<?php //msql/program_updates_1911
$r=["1"=>['1102','publication'],
"2"=>['1104','ajout du module microarts, permet de faire des brÃ¨ves'],
"3"=>['1106','- activation du processus vue (latent depuis deux ans) : permet de crÃ©er des templates Ã  la volÃ©e, associÃ©s Ã  des donnÃ©es. Le processus Vue est destinÃ© Ã  nodeJs, et permet d\'externaliser la fabrication de html. On rÃªve depuis longtemps de ne plus utiliser que des connecteurs en interne, Vue permet de le faire.'],
"4"=>['1106','- ajout du procÃ©dÃ© \'Â§twit\' au connecteur :msql, permet de lire une liste de personnes captÃ©e par l\'api twitter, via le dispositif Vue.'],
"5"=>['1106','- ajout du module \'cats\', capable de gÃ©rer l\'appel depuis une bub, pour renvoyer une liste au format popapi (sur la base de \'tags\' et au dÃ©triment de \'categories\')'],
"6"=>['1120','- rÃ©forme des transporteurs, qui assument la maintenance entre sites miroirs'],
"9"=>['1128','- unification de deux constructeurs de miniatures (un selon l\'ordre et l\'autre selon la taille) en un seul nommÃ© art_img()'],
"7"=>['1128','- on peut choisir la miniature en spÃ©cifiant son numÃ©ro dans le catalogue des images de l\'article (2/img1/img2) ; par dÃ©faut la plus grande image est prÃ©-sÃ©lectionnÃ©e (gain de 0.1s sur un dÃ©roulÃ©)'],
"8"=>['1129','- ajout du support des formats d\'images et de vidÃ©os de google .webp et .webm'],
"10"=>['1130','- amÃ©lioration du systÃ¨me de rÃ©cupÃ©ration d\'image manquante, qui peut Ãªtre sur un autre serveur ou dans les images relÃ©guÃ©es par un processus de nettoyage']];