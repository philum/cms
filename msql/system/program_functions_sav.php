<?php
//philum_microsql_program_functions
$program_functions["_menus_"]=array('function','variables','usage','return','context');
$program_functions[1]=array('ajx_get','ajx_get($v,$p)','$v=chaîne $p=0/1','mise en conformité ajax (0=encode 1=decode)','ajax');
$program_functions[2]=array('arcsin','arcsin($angle)',"sinus d'un angle exprimé en degrès",'degres(asin($angle))','maths');
$program_functions[3]=array('arctan','arctan($angle)',"arctan d'un angle exprimé en degrès",'degres(arctan($angle))','maths');
$program_functions[4]=array('array_combine_a','array_combine_a($a,$b)','$a=keys $b=values','combined array','mecanics');
$program_functions[5]=array('array_keys_b','array_keys_b($r)','send keys to values and rebuild keys','logically flipped array','mecanics');
$program_functions[6]=array('array_keys_r','array_keys_r($r,$n)','r=array in an array $n=range: key_target','array: values of a range','mecanics');
$program_functions[7]=array('attrb','attrb($d,$v)','make html attribute','$d.\'=\"\'.$v.\'\"\'','html');
$program_functions[8]=array('auto_menus','auto_menus($r)','$r=array of any key of a msql_array (an array)','generated array of _menus_ range in a msql_array','builders');
$program_functions[9]=array('autoclic','autoclic($name,$valu,$size,$maxlenght,$css)','input text auto-hide content','balise input with javascript','html');
$program_functions[10]=array('bal','bal($b,$c,$t)','$b=balise $c=class $t=text','balise html','html');
$program_functions[11]=array('balise','balise($b,$r,$t)','$b=balise $r=attributs $t=text :: 
attributs_rule : array(\"id\"=>1,5=>\'txtx\')
where key=html_attribut=>value
numerical code of attributs is : 
array(1=>\"type\",2=>\"name\",3=>\"id\",4=>\"value\",5=>\"class\",6=>\"size\",7=>\"maxlenght\",8=>\"onKeyPress\",9=>\"cols\",10=>\"rows\",11=>\"wrap\",12=>\"action\",13=>\"method\",14=>\"for\",15=>\"onchange\",16=>\"style\")','html balise from an array of attributes','html');
$program_functions[12]=array('bar','bar($d)','$d=number','a black image of width=20px and height=$d','graphics');
$program_functions[13]=array('batch','batch($r,$func)','$r=array $func=function_name','fill the array with the result of value as param of function $func (maths)
','mecanics');
$program_functions[14]=array('batch_defil','batch_defil($r)','array','string: <option>$k</options>','html');
$program_functions[15]=array('batch_defil_kv','batch_defil_kv($r,$here,$kv)','=array =value of a key of the array $kv=usage of the values of the array :
kk=use and echo k;
kv=use k and echo v;
vv=use and echo v;
vk=use v and echo k
-- used by menuder_form_kv','string: <value>$k</value> <option>$v</options> with a checked value','html');
$program_functions[16]=array('blien','blien($c,$l,$t)','$class $link $text','a href inside a span','html');
$program_functions[17]=array('br','br()','new line','xhtml new line <br />','html');
$program_functions[18]=array('br2nl','br2nl($tx)','string with <br /> <br> <br/>','delete /n and replace <br> by /n','html');
$program_functions[19]=array('btn','btn($c,$t)','$class $txt','span balise','html');
$program_functions[20]=array('calc_date','calc_date($d)','$d=timestamp','timestamp of $d days before','dates');
$program_functions[21]=array('call_plug_func','call_func($css,$r,$val)','$r=array of params in values $val=echo :: params of SaveJ are : targetdiv_function_(id)_(x/xx)_val1_val2_val3_val4_miwedvar1|mixedvar2
where :
targetdiv=where send the result
function=a condition in the hangars of conditions ajax.php
(id)=optionnal, a div where read value
(x/xx)=x close the popup, xx close the popup after 1 second
val1-4=strings prepared for ajax
mixedvar= diferents id where catch values',"classical ajax button callin 'SaveJ'",'ajax');
$program_functions[22]=array('cercle_longueur','cercle_longueur($rayon)','perimeter of a cercle from a rayon','value','maths');
$program_functions[23]=array('cercle_surface','cercle_surface($diametre)','surface of a circle','value','maths');
$program_functions[24]=array('checkbox','checkbox($name,$val,$label,$chk)','$chk=0/1 if checked','checkbox for a form','html');
$program_functions[25]=array('chronotest','chronotest($d)','$d=timestamp','echo the time elapsed from last time this function was called','tools');
$program_functions[26]=array('clean_acc','clean_acc($v)','kill all types of accents','formated string','filters');
$program_functions[27]=array('clean_punct','clean_punct($in)','apply typographic rules','formated string','filters');
$program_functions[28]=array('clean_punct_b','clean_punct_b($v)','apply typographic rules specific to bad spaces around the quote " (slower)','formated string','filters');
$program_functions[29]=array('copy_msql','copy_msql($da,$na,$db,$nb)','$da=directory of a $na=node of a $db=directory of b $nb=node of b','duplicate a msql base using a name (db/nb.php)','microbases');
$program_functions[30]=array('core','core($f,$p,$v1,$v2,$v3,$v4)','call the function p or f with 4 values','depend of the function','maths');
$program_functions[31]=array('cos_rect','cos_rect($ca,$hy)','cosinus=adjacent/hypothenuse in a right triangle','number (maths)','maths');
$program_functions[32]=array('cosinus','cosinus($angle)','give cosinus from an angle in degrees','number (maths): cos(radian($angle))','maths');
$program_functions[33]=array('cotan_rect','cotan_rect($co,$ca)','cotangent from two sides of a right triangle','number (maths)','maths');
$program_functions[34]=array('count_art','count_art($suj,$frm)','$suj=title of article $frm=category','number of published articles found','database');
$program_functions[35]=array('countchars','countchars($v)','count number of characters from count_chars() method (adding range 1) - used by embed_detect','value','utils');
$program_functions[36]=array('create_page','create_page($t,$p)','$t=content $p=name of base','final step for build a msql table before to write it','builders');
$program_functions[37]=array('css_in','css_in($d)','$d=css code','balise style for header with css inside','html');
$program_functions[38]=array('css_spe','css_spe($d)','$d=css url','balise style for header with link to a specific page of css','html');
$program_functions[39]=array('currentwidth','currentwidth()','give the max width available at this moment of the script, inside the current div','number to use as max width in content','utils');
$program_functions[40]=array('data_val','data_val($v,$id,$cat,$val)',"value to recuperate in 'qdd' where id, cat and val are known - use rse()","value from mysql - specific to mysql table 'qdd' (datas)",'database');
$program_functions[41]=array('define_mods_cond','define_mods_cond($vl)','$vl=table of modules','structure of blocks to build for the current condition','internal builders');
$program_functions[42]=array('define_s','define_s($v,$d)','give the the session $s the value $d if session is not set, then give get value to session','value of the session $v','html');
$program_functions[43]=array('degres','degres($radian)','convert radian to degrees','rad2deg(radian)','maths');
$program_functions[44]=array('delete','delete($bs,$id)','delete in $bs where $id','nothing','database');
$program_functions[45]=array('div','div($a,$v)','$a=attributs $value','balise div','html');
$program_functions[46]=array('divc','divc($c,$t)','$c=class $value','balise div','html');
$program_functions[47]=array('divd','divd($c,$t)','id value','balise div','html');
$program_functions[48]=array('dlien','dlien($c,$l,$t)','$class $link $text','a href in a div','html');
$program_functions[49]=array('dump','dump($r,$p)',"array of arrays and name of node like 'hub_table'",'prepared values for create_page()','microbases');
$program_functions[50]=array('echob','echob($v)','echo datas in a textarea','textarea','tools');
$program_functions[51]=array('embed_detect','embed_detect($v,$s,$e,$n)','$string $start-cut $end-cut $cut_from','the part of $v who begin and finish with $s and $e','utils');
$program_functions[52]=array('eradic_acc','eradic_acc($n)','convert all accentuated  characters to normal','formated string','filters');
$program_functions[53]=array('explode_dir','explode_dir($r,$j,$func)','used after scrut_dir() in obtain_from_dir()','array of files in $j directory applied to the function $func','directories');
$program_functions[54]=array('find_id','find_id($id)','give id of an article called by unkwonw parameter as title, id, or "last"','id of existing and published article','internal builders');
$program_functions[55]=array('forbidden_img','forbidden_img($nnm)','eradic words containing one of masks specified in admin/config/params/21 forbidden_images','formated string','internal builders');
$program_functions[56]=array('formcreate','formcreate($go,$fll)','create a form callin the url $go and containing $fll','balise form','html');
$program_functions[57]=array('func','func($d,$k,$v,$n)',"it's an example of func() used  by explode_dir()",'string for array built by explode_dir()','mecanics');
$program_functions[58]=array('funcs','funcs()','not usited','a specific array for histo() with names of all maths functions','maths');
$program_functions[59]=array('good_url','good_url($id,$suj)','deprecated :: build explicit url from formated title ($suj) if present, or $i by default',"url of an article found by htacc('read')",'internal builders');
$program_functions[60]=array('goodarea','goodarea($v,$id,$css,$jv,$n)','$jv=javascripts $n=size or cols','balise input text or a textarea','html');
$program_functions[61]=array('gz_create','gz_create($f,$fb)','$file_url $bz_name of the compressed archive','store a bz archive','internal builders');
$program_functions[62]=array('gz_write','gz_write($d,$f)','$bz_url $file_name of the decompressed archive','store a file from a bz archive','internal builders');
$program_functions[63]=array('headers','headers($title,$css_out,$css_in,$javs)','$title of page $css_url $css stylsheets $javascript balises','headers','html');
$program_functions[64]=array('helice','helice($l,$n,$d,$h)','width nb_spires diameter height','lenght of an helice','maths');
$program_functions[65]=array('histo','histo($r)','create histogram from array $ using bar()','images of dirrefent heights','maths');
$program_functions[66]=array('hostname','hostname()','give the ip of current user','REMOTE_ADDR','utils');
$program_functions[67]=array('hr','hr()','trace an hozontal line','<hr>','html');
$program_functions[68]=array('hrb','hrb($c)','trace an hozontal line using class $c','<hr>','html');
$program_functions[69]=array('htac','htac($d)','part of url knowing htaccess','the param of variable formated','utils');
$program_functions[70]=array('htacc','htacc($d)',"part of url knowing htaccess for 'read' or 'id'",'the param of variable formated','utils');
$program_functions[71]=array('hypothenuse','hypothenuse($ca,$co)','$adjacent side $opposed side','hypothenuse of a right rectangle','maths');
$program_functions[72]=array('id_of_suj','id_of_suj($id)','use title of an article','return id of article','database');
$program_functions[74]=array('image','image($v,$w,$h)','image width height','html embed image','html');
$program_functions[75]=array('imgform','imgform($here,$cl,$oth,$ttl)','$here=url to call $cl=class $oth=text $ttl=title attribut (on rollover)','upload form','html');
$program_functions[76]=array('in_array_b','in_array_b($va,$r)','find key in ranges $r where value=$va','like in_array() ','mecanics');
$program_functions[77]=array('input_with_suggest','input_with_suggest($i,$id,$r,$default)','$i=first paraam of js $id=second param for js $r=list of words $default=saved value','classical input with suggestions loaded is javascript','internal builders');
$program_functions[78]=array('inputcreate','inputcreate($t,$n,$v)','$type $name $value','balise input','html');
$program_functions[79]=array('inputcreate2','inputcreate2($t,$n,$v,$css)','$type $name $value $class','balise input','html');
$program_functions[80]=array('is_image','is_image($doc)','verify if $doc is an image','true','mecanics');
$program_functions[81]=array('javs_in','javs_in($d)','build javascrip from link for headers via $javs','balise script','html');
$program_functions[82]=array('javs_spe','javs_spe($d)','literal javascript code for headers via $javs','balise script','html');
$program_functions[83]=array('jump_btns','jump_btns($id,$v,$add)','buttons of values separated by \"|\" in $v sent by javascript to $id and replacing the input $id if $add=0 or adding the words in $add (like \', \')','buttons who send values in an input','utils');
$program_functions[84]=array('last_art','last_art()','most recent article','id of a published article','database');
$program_functions[85]=array('lien','lien($c,$l,$t)','$class $link $text','a href with class','html');
$program_functions[86]=array('lienb','lienb($c,$l,$t)','$class $link $text','a href in a span with class','html');
$program_functions[87]=array('lienj','lienj($c,$call,$jav,$t)','$class $argument_called for javascript $javascript_function $text','a link for ajax called onClick','html');
$program_functions[88]=array('lienjx','lienjx($c,$call,$jav,$t)','$class $argument_called for javascript $javascript_function $text','a link for ajax called in javascript','html');
$program_functions[89]=array('liensubmit','liensubmit($c,$call,$t)','$class $argument_called for javascript of the current form action ;$text','ajax button for a form','html');
$program_functions[90]=array('lient','lient($c,$l,$t)','$class $link $text','a href opening a new window','html');
$program_functions[91]=array('llien','llien($c,$l,$t)','$class $link $text','a href inside a li balise with class','html');
$program_functions[92]=array('lowercase','lowercase($v)','strtolower but keep ucfirst for each words','formated string','mecanics');
$program_functions[93]=array('lstrc','lstrc($rq)','make array from range 0 in mysql_fetch_array','array','database');
$program_functions[94]=array('make_table','make_table($datas,$csa,$csb)','$datas=array of arrays, $csb is only for the first range','balise table','internal builders');
$program_functions[95]=array('make_tables','make_tables($titles,$datas,$csa,$csb)','$datas=array of arrays, $csb is only for the first range, if it is present in $titles','balise table','internal builders');
$program_functions[96]=array('menuder','menuder($list,$here)','list of options with ckecked range, child of slctmenuder()','sorted options values for select balise','html');
$program_functions[97]=array('menuder_form','menuder_form($r,$d)','call batch_defil() with $r (options) and name the select input $d','input select','html');
$program_functions[98]=array('menuder_form_kv','menuder_form_kv($r,$d,$here,$kv)','build option calling batch_defil_kv() knowing $here=selected value and $kv=key or value to use for value and title of the options','input select','html');
$program_functions[99]=array('meta','meta($d,$v,$c)','meta $d=$v and content=$c','balise meta for header()','html');
$program_functions[100]=array('mkday','mkday($d)','timestamp',"datadav using 'ymd'",'dates');
$program_functions[101]=array('mkdir_r','mkdir_r($u)','build directories topology from a string like dir1/dir11/dir111','nothing','directories');
$program_functions[102]=array('modif_vars','modif_vars($base,$nod,$arr,$k)',"  (like hub_table) =array of arrays ='add' / 'push' / 'del' / value (optionnal)",'the modified microtable with $arr','microbases');
$program_functions[103]=array('msq','msq($ph,$bz)','build sequence for res() from $ph=SELECT attributs and $bz=WHERE attributs','formated string','database');
$program_functions[104]=array('msq_select','msq_select($dr,$qb,$nd)',"select microbases in directory  from user  and table= (in 'bs_') if theses tables are numeroted",'array of needed tables from selection','microbases');
$program_functions[105]=array('msql_read','msql_read($dr,$nod,$in)','$directory $nod=table $i=range (optionnal) :: resolve root problems','array of a table 
or a part of it 
or only the value there is only one range','microbases');
$program_functions[106]=array('msql_save','msql_save($base,$nod,$defs,$dfb)','save array of arrays $defs in $base/$nod adding $dfb as _menus_  :: resolve root problems','nothing','microbases');
$program_functions[107]=array('normalize','normalize($n)','forbid special characters and accept only A-aZ-z0-9','formated string','filters');
$program_functions[108]=array('obtain_from_dir','obtain_from_dir($dr,$func)','call scrut_dir() with $dr and explode_dir() knowing $func','array of result of the function $func on the files found recursively in drectory $dr','directories');
$program_functions[109]=array('on2cols','on2cols($r,$w,$p)','$r is an array with key=label and value=content, $w=total width, with of labels=1/$p','table in divs','internal builders');
$program_functions[110]=array('p','p($r)','print_r','echo array','tools');
$program_functions[111]=array('pagup','pagup($f)','javascript calling a new page from the value of selected option','javascript for header()','html');
$program_functions[112]=array('parse_bal','parse_bal($v)','htmlentities only for balises','formated string','filters');
$program_functions[113]=array('patch_replace','patch_replace($bs,$in,$wh,$repl)','replace $in by $repl where $wh in $bs','confirmation success','database');
$program_functions[114]=array('pecho_arts','pecho_arts($id)','call informations about article $id in cache if possible or in database','array: day,frm,suj,img,nod,thm,lu,re,host,mail,ib','utils');
$program_functions[115]=array('plug_motor','plug_motor($base,$nod,$defsb)','call a microtable $base/$nod or create it using _menus_ $defsb','array of arrays','microbases');
$program_functions[116]=array('pluriel','pluriel($r)','$r=array of objects','letter "s" if $r>1','utils');
$program_functions[117]=array('popup','popup()','let MM_openBrWindow opening popup','javascript for header()','html');
$program_functions[118]=array('powr','powr($n)','power of number','number','maths');
$program_functions[119]=array('prep_host','prep_host($nod)','good url with thttp for hub=$nod if subdomain or htaccess or nothing activated','formated string','internal builders');
$program_functions[120]=array('prep_input','prep_input($r)','parameters used by balise(()','array','internal builders');
$program_functions[121]=array('prep_read_msql','prep_read_msql($b,$d)','treatable datas from a microtable where range 0 is used as a key containing an array with all occurrences of key (sort by range 0)','sorted array','microbases');
$program_functions[122]=array('pytha_cote','pytha_cote($hy,$c)','size of the adjacent side of a right triangle from hypothenuse and first side','number','maths');
$program_functions[123]=array('qr','qr($req)','used by rse() and ser()','mysql_fetch_array','database');
$program_functions[124]=array('quotes','quotes($msg)','clean up all kinds of quotes in one classic \'\"\' and apply clean_punct() and lowercase()','formated string for titles','filters');
$program_functions[125]=array('radian','radian($angle)','convert degree in radians','deg2rad','maths');
$program_functions[126]=array('rcptb','rcptb($db)','show tables','mysql_query','database');
$program_functions[127]=array('read_file','read_file($f)','open datas from fil $f','text','directories');
$program_functions[128]=array('read_rss','read_rss($f,$t,$r)',"system/program_functions.php=file_url =master_balise name (like 'item') =array of sub-balises (like 'title','description')",'array of arrays of an sml or rss source','internal builders');
$program_functions[129]=array('recup_fileinfo','recup_fileinfo($doc)','$file','formated date and size of a file','utils');
$program_functions[130]=array('recup_mails_tosend','recup_mails_tosend($base)','list of mails of published trackbacks in an article $base ','nothing (echo success results)','internal builders');
$program_functions[131]=array('reflush','reflush($bs)','ALTER TABLE $bs ORDER BY id :: used bu delete(()','nothing','database');
$program_functions[132]=array('relod','relod($v)','reload to a page','javascript immediately applied','html');
$program_functions[133]=array('req','req($f,$a,$b,$c,$d)','public database calling function=$f select=a in$b where$c is equal to $d','result depend of user function in $f','database');
$program_functions[134]=array('res','res($ph,$bz)','$ph=asked columns $bz=where condition','object mysql_fetch_array','database');
$program_functions[135]=array('rse','rse($ph,$bz)','$ph=asked column $bz=where condition','string result','database');
$program_functions[136]=array('rss_date','rss_date($date)','find timestamp from rss formated $date','timestamp','filters');
$program_functions[137]=array('save_vars','save_vars($base,$nod,$defs)','save microtable: $directory $table $defs=array of arrays','nothing','microbases');
$program_functions[138]=array('savething','savething($sql)','mysql query','id of the new entry','database');
$program_functions[139]=array('scroll','scroll($obj,$txt,$nb)','$obj=array used to build $txt, $nb is the limit for create a scrool','div with ovrflow if needed','html');
$program_functions[140]=array('scrut_dir','scrut_dir($dr)','explore the files of a directory recursively','multidimensional array','directories');
$program_functions[141]=array('scrut_dir_only','scrut_dir_only($dr)','detect only the directories (not recursive)','array of directories','directories');
$program_functions[142]=array('scrut_files_only','scrut_files_only($dr)','explore the files of a directory (not recursive)','array of files','directories');
$program_functions[143]=array('ser','ser($ph,$bz)','multiple datas of an entry in $ph where $bz','simple array to use in list($a,$b)=ser($ph,$bz)','database');
$program_functions[144]=array('sin_rect','sin_rect($co,$hy)','sinus from side and hypothenus of a right triangle','number','maths');
$program_functions[145]=array('sinus','sinus($angle)','sinus from degrees','number','maths');
$program_functions[146]=array('slct_menus','slct_menus($aff,$lk,$vf,$cs1,$cs2,$kv)',"=array =link (like '/?var=') = (var) =active =normal css",'list of links with detection of activated ','internal builders');
$program_functions[147]=array('slct_menus_tags','slct_menus_tags($aff,$lk,$ct,$css)','','','');
$program_functions[148]=array('slctmenuder','slctmenuder($list,$here)','','','');
$program_functions[149]=array('slctmenusj','slctmenusj($aff,$vf,$lk,$cal)','','','');
$program_functions[150]=array('slien','slien($l,$t)','','','');
$program_functions[151]=array('sphere_surface','sphere_surface($diametre)','','','');
$program_functions[152]=array('sphere_volume','sphere_volume($diametre)','','','');
$program_functions[153]=array('split_one','split_one($s,$v,$n)','','','');
$program_functions[154]=array('split_two','split_two($v,$d,$p)','','','');
$program_functions[155]=array('sre','sre($ph,$bz)','','','');
$program_functions[156]=array('srf','srf($pha,$phb,$bz)','','','');
$program_functions[157]=array('strsplit','strsplit($v)','','','');
$program_functions[158]=array('strstr_b','strstr_b($v,$s)','','','');
$program_functions[159]=array('subdom','subdom($v)','','','');
$program_functions[160]=array('substr_v','substr_v($ret,$posa,$posb)','','','');
$program_functions[161]=array('tan_rect','tan_rect($co,$ca)','','','');
$program_functions[162]=array('tangente','tangente($angle)','','','');
$program_functions[163]=array('temporize','temporize($name,$func,$p)','','','');
$program_functions[164]=array('tests','tests()','','','');
$program_functions[165]=array('time_ago','time_ago($dt,$df)','','','');
$program_functions[166]=array('tri_rect_angle','tri_rect_angle($r)','','','');
$program_functions[167]=array('tri_rect_pythagore','tri_rect_pythagore($r)','','','');
$program_functions[168]=array('tri_tag','tri_tag($v)','','','');
$program_functions[169]=array('tri_tags','tri_tags($r)','','','');
$program_functions[170]=array('triangle_rectangle','triangle_rectangle($r)','','','');
$program_functions[171]=array('txarea','txarea($n,$t,$cl,$rw)','','','');
$program_functions[172]=array('txarea1','txarea1($msg,$idy)','','','');
$program_functions[173]=array('update','update($bs,$in,$v,$col,$id)','','','');
$program_functions[174]=array('which_ext','which_ext($v)','','','');
$program_functions[175]=array('witch_quote','witch_quote($v)','','','');
$program_functions[176]=array('write_file','write_file($f,$t)','','','');
$program_functions[177]=array('','','','','');
$program_functions[178]=array('','','','','');

?>