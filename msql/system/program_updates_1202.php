<?php //msql/program_updates_1202
$r=["_menus_"=>['day','text'],
"1"=>['0201','correctifs sur le plugin \'share\''],
"2"=>['0202','ajout du module \'share\' pour rendre publics les fichiers partagÃ©s'],
"3"=>['0205','correctif de l\'empÃªcheur de faire des titres en majuscules pour supporter les noms composÃ©s ou apostrophÃ©s'],
"4"=>['0209','- correctif aller-retour vers hub par dÃ©faut quand ?id== ;
- conversion de \'https\' en \'http\' lors de l\'import ; 
- ajout du support de \'& sect\' pour les liens qui contiennent un truc du genre \'& section\' que les entitÃ©s html convertissent inexorablement en \'Â§\' qui est trÃ¨s mal venu ;
- destruction de deux sortes de demi-espaces qui renvoient des \'?\' aprÃ¨s un import, mais il en reste d\'autres ;
- importation des images php ;
- rÃ©Ã©criture de la fonction \'auto_anchor\' - le rendu privilÃ©gie l\'usage des parenthÃ¨ses au lieu des crochets, par soucis esthÃ©tique ;
- correction traitement entitÃ©s html deu module Channel ;'],
"5"=>['0211','- ajout du fantastique module \'suggest\' qui permet de proposer au visiteur de proposer des articles depuis leur Url, et de prÃ©visualiser le contenu, comme dans google+ ;
- l\'ajout d\'une entrÃ©e prÃ©vient l\'admin par mail ;'],
"6"=>['0211','correctif dans l\'importateur html : l\'image d\'un lien qui pointe vers une image (souvent une vignette pointe vers une hd) ne renvoie que la grande image (Ã§a le faisait dÃ©jÃ ) et ne se fait plus leurrer par le texte additionnel (genre \'clic pour agrandir\') lorsqu\'il est bÃªtement posÃ© dans la mÃªme balise de lien que la vignette ; dans ce cas le texte additionnel est supprimÃ©, car on considÃ¨re que le code html est impropre.'],
"7"=>['0212','le module MenusJ peut produire des menus activables au survol de la souris si on met \"1\" en option'],
"8"=>['0213','- un troisiÃ¨me type d\'espace insÃ©cable et une entitÃ© html de plus correctement traitÃ©e par le systÃ¨me de contention d\'erreurs (que les fonctions basiques ne prennent pas en charge) ;
- \'.jpeg\' converti en \'.jpg\' durant l\'importation ;'],
"9"=>['0224','- petits correctifs lors de l\'importation (systÃ¨me de contention d\'erreurs)
- l\'import depuis \'tools/vacuum\' enregistre directement le rÃ©sultat (avant il n\'Ã©tait que proposÃ© Ã  l\'enregistrement)'],
"10"=>['0227','- petits correctifs lors de l\'appel en ajax pour les caractÃ¨res non supportÃ©s ;
- suppression des tirets-longs dans le systÃ¨me de contention (non supportÃ©s en ajax) ;
- ouvrir/fermer un article qui comporte une vidÃ©o de supprime plus l\'instruction \'clear:left\' ;
- le filtre de post-traitement aprÃ¨s import \'del-link\' permet de supprimer les liens non dÃ©sirÃ©s (de faÃ§on radicale et grossiÃ¨re), par exemple pour les sites qui ont la stupide idÃ©e de mettre un lien vers la dÃ©finition de chaque mot utilisÃ©, comme futura-sciences et le monde, depuis peu']];