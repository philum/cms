<?php //philum/msql/program_updates_2109_sav
$r=[1=>['0904','publication'],2=>['0911','ajout de treat_img en suppl�tif � treat_links dans conv'],3=>['0912','- correctif de msql_read vers msql::col
- ajout du conn :math et des balises associt�es � matl.ml
- suppression du :svg et de :svgcode, qui devient :svg ; les .svg sont trait�s comme les images, et :svg fait appel au constructeur svg
- suggestions auto des defcons connues au moment o� est propos� d\'ajouter une nouvelle d�finition d\'importation de contenu, d\'apr�s une base des defs les plus usit�es'],4=>['0912','- petite r�novation de l\'inusit� lecteur xss
- la suggestion des defcons peut �tre appel�e depuis l\'�diteur de d�finitions
- la reconnaissance de defcons �tant obsol�te (on utilise une codification du ciblage des balises), elle est remplac�e par le nouveau dispositif known_defcons() (voir hier) : cette enqu�te occasionne directement un nouvel enregistrement. La consultation des pages externes peut �tre g�n�ralis�e. C\'est cool. Todo : mise � jour des defs qui ne marchent pas
- fix pb inconnu d\'importation d\'images b64 sans faire expr�s lors de la consultation de pages externes ; cette commodit� est confisqu�e et confi�e � l\'�tape ult�rieure, la lecture, qui conna�t l\'id.
- ajout de la rstr139, r�duit automatiquement les images >1000px'],5=>['0916','- r�fection de starmap2'],6=>['0917','ajout des conn :
- bt : appelle un connecteur sur place (remplace la commodit� conflictuelle qui consistait � rajouter �bt apr�s le connecteur habituel)
- appbt :lien vers une app']];