<?php
//philum_microsql_program_updates_1202
$program_updates_1202["_menus_"]=array('day','text');
$program_updates_1202[1]=array('0201',"correctifs sur le plugin 'share'");
$program_updates_1202[2]=array('0202',"ajout du module 'share' pour rendre publics les fichiers partag�s");
$program_updates_1202[3]=array('0205',"correctif de l'emp�cheur de faire des titres en majuscules pour supporter les noms compos�s ou apostroph�s");
$program_updates_1202[4]=array('0209',"- correctif aller-retour vers hub par d�faut quand ?id== ;
- conversion de 'https' en 'http' lors de l'import ; 
- ajout du support de '&sect' pour les liens qui contiennent un truc du genre '&section' que les entit�s html convertissent inexorablement en '�' qui est tr�s mal venu ;
- destruction de deux sortes de demi-espaces qui renvoient des '?' apr�s un import, mais il en reste d'autres ;
- importation des images php ;
- r��criture de la fonction 'auto_anchor' - le rendu privil�gie l'usage des parenth�ses au lieu des crochets, par soucis esth�tique ;
- correction traitement entit�s html deu module Channel ;");
$program_updates_1202[5]=array('0211',"- ajout du fantastique module 'suggest' qui permet de proposer au visiteur de proposer des articles depuis leur Url, et de pr�visualiser le contenu, comme dans google+ ;
- l'ajout d'une entr�e pr�vient l'admin par mail ;");
$program_updates_1202[6]=array('0211',"correctif dans l'importateur html : l'image d'un lien qui pointe vers une image (souvent une vignette pointe vers une hd) ne renvoie que la grande image (�a le faisait d�j�) et ne se fait plus leurrer par le texte additionnel (genre 'clic pour agrandir') lorsqu'il est b�tement pos� dans la m�me balise de lien que la vignette ; dans ce cas le texte additionnel est supprim�, car on consid�re que le code html est impropre.");
$program_updates_1202[7]=array('0212','le module MenusJ peut produire des menus activables au survol de la souris si on met "1" en option');
$program_updates_1202[8]=array('0213',"un troisi�me type d'espace ins�cable et une entit� html de plus correctement trait�e par le syst�me de contention d'erreurs (que les fonctions basiques ne prennent pas en charge)");

?>