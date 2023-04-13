<?php //msql/program_updates_1807
$r=["1"=>['0701','publication'],
"2"=>['0702','- ajout du support de lien vers des pages qui s\'expriment comme des images, alors que ce n\'en sont pas...
- fix pb Ã©dition d\'une cellule msql inexistante prÃ©alablement
- fix ancien .net en nouveau .fr dans pas mal de bases msql
- ajout du bouton \'office\' dans le menu admin, permet d\'afficher l\'intÃ©gralitÃ© de l\'admin sur place'],
"3"=>['0703','- introduction de l\'app \'web\', remplace le systÃ¨me de cache du dispositif web_og, et utilise une table mysql au lieu de la base msql. Les preview d\'articles du connecteur :web s\'affichent sans erreur.
- mise Ã  jour des fichiers install pour ajouter les tables yandex et web.
- mercury profite de la nouvelle table pub_web pour y enregistrer ses rÃ©sultats.'],
"4"=>['0704','instauration de la table pub_twit, qui supplante msql afin d\'Ãªtre prÃªt pour de plus grosses charges. 13 colonnes issues de l\'Api Twitter y sont enregistrÃ©s, Ã  l\'occasion d\'un connecteur :twitter. Mise Ã  jour des fichiers d\'install.'],
"5"=>['0705','- amÃ©lioration du plugin twit, l\'Api Twitter est supplÃ©Ã©e par une manipe manuelle pour obtenir rÃ©ellement l\'intÃ©gralitÃ© du twit (l\'Api Twitter est toujours limitÃ©e Ã  140 caractÃ¨res...). 
- ajout du connecteur :mercury, renvoie une preview du contenu (comme une iframe en plus moderne)
- ajout du connecteur :webview : renvoie le rÃ©sultat du connecteur :web dans une bulle au survol. 
- ajout de la rstr 111 qui active automatiquement les webview pour chaque lien'],
"6"=>['0706','- ajout d\'un gestionnaire qui fait suite Ã  la dÃ©tection de la langue d\'un commentaire, au cas oÃ¹ ce n\'est pas la bonne
- Ã´te dÃ©tecteur de metas dans l\'Ã©diteur de nouvel article (mercury fait le job)
- fix pb usage du champ opt dans Defcon (troisiÃ¨me cible de l\'import)
- fix pb de double menu admin aprÃ¨s le lancement d\'une fonction imprÃ©vue
- ajout du champ import dans le plugin txt
- ajout du bt twitter dans l\'Ã©diteur tracks
- fix pb dÃ©filement des pages en ajax dans msql (500 items/page)
- ajout de l\'outil de suppression d\'un connecteur non spÃ©cifiÃ© :(any)
- fix apparition du bt del cache dans l\'importateur
- correctif comportement de embed_detect_c quand il doit trouver la balise de rÃ©fÃ©rence
- correctif comportement du relai de Defcon Ã  Mercury dans les dÃ©faillances
- correctif url des iframes qui commencent par //'],
"7"=>['0707','- ajout de l\'app capt, permet de capturer des contenus web en forme de liste conduisant vers des pages associÃ©es (dev)'],
"8"=>['0708','- ajout d\'un gestionnaire de DOM
- ajout du connecteur :wiki e son app, renvoie un rÃ©sultat en preview ou en pleine page selon que qu\'il est associÃ© Ã  un texte
- ajout d\'un dÃ©tecteur d\'encodage autonome
- ajout de la compÃ©tence de Mercury Ã  aspirer les images'],
"9"=>['0711','- ajout du plugin wiki, permet de recevoir le flux d\'une page wikipedia, en preview ou en entier selon l\'option'],
"10"=>['0712','- ajout du support du provider video peertube'],
"11"=>['0719','- refonte du gestionnaire vidÃ©o, suppression de tÃ¢ches Ã©parses et centralisation via l\'app web, qui met les preview en cache. DÃ©sormais les vidÃ©os affichent leur titre s\'il n\'est pas confisquÃ© par un texte.'],
"12"=>['0721','- ajout du connecteur :play, permet de lire les vidÃ©o directement
- ajout du dispositif video_img qui enregistre, place dans le catalogue, et utilise la vignette d\'une vidÃ©o
- mise en conformitÃ© de l\'installateur avec un environnement utf8mb4'],
"13"=>['0725','- mise Ã  niveau du batch avec de nouvelles spÃ©cifications, ajout d\'un champ qui permet d\'ajouter manuellement des urls'],
"14"=>['0726','- le paramÃ¨tre \'option\' dans l\'Ã©diteur d\'apps permet est auto-supplÃ¨te le paramÃ¨tre \'command\', en ajoutant un \'/\' Ã  la fin de la commande, avant l\'option. utile pour les apps de type \'mod\'.'],
"15"=>['0728','- ajout du dispositif pictocat, capable de lier des pictos aux catÃ©gories (dans admin/articles)'],
"16"=>['0729','- version 14 de la typo de pictos \'philum\' qui passe de 182 Ã  263 glyphes (la version 13 contient 224 glyphes mais avec la derniÃ¨re version on a changÃ© le pas de la grille de base de 1024 Ã  2048 comme dans une vraie webding).'],
"17"=>['0729','- version 14.19 de la typo \'philum\' qui passe Ã  298 glyphes (merci webdings)'],
"_menus_"=>['date','txt']];