//utils

var slctd=false;
//check browsers//{{
var clientPC=navigator.userAgent.toLowerCase();
var clientVer=parseInt(navigator.appVersion);//browser version
var is_ie=((clientPC.indexOf("msie")!=-1) && (clientPC.indexOf("opera")==-1));
var is_win=((clientPC.indexOf("win")!=-1)||(clientPC.indexOf("16bit")!=-1));

function setSelectionRange(input,selectionStart,selectionEnd){
if(input.setSelectionRange){input.focus();
	input.setSelectionRange(selectionStart,selectionEnd);}
else if(input.createTextRange){
	var range=input.createTextRange();
	range.collapse(true);
	range.moveEnd('character',selectionEnd);
	range.moveStart('character',selectionStart);
	range.select();}}

function storeCaret(textEl){//insert at Caret position
if(textEl.createTextRange)textEl.caretPos=document.selection.createRange().duplicate();}

function findfunc(e,o){var t=e.innerHTML;//codev
var st=e.selectionStart; var end=e.selectionEnd; var lgth=e.textLength;
var p=(e.value).substring(st,end); if(st==end)return;
SaveJ('results_codeview,findfunc__21_'+ajx(p));}
//SaveJ('results_coremap,coremap__14_'+ajx(p));

function detctfunc(e){var t=e.innerHTML;
var t=strreplace('&amp;','&',t);var t=strreplace('&lt;','<',t);var t=strreplace('&gt;','>',t);
var st=e.selectionStart; var one=t.substring(0,st); var two=t.substr(st);
var ptr=[' ','=','(',')',"'",'"','.','[',']','&','|','-','+','/','*',',','{','}'];
var first=0; var last=two.length; var f2=[]; var l2=[];
for(i=0;i<ptr.length;i++){
	var f2=one.lastIndexOf(ptr[i]); if(f2>first)var first=f2;
	var l2=two.indexOf(ptr[i]); if(l2!=-1 && l2<last)var last=l2;}
var pa=one.substr(first); var pb=two.substring(0,last); var p=pa+pb;
//alert(char+' - '+first+' - '+pa); //alert(char+' - '+last+' - '+pb);
var p=(e.value).substring(first+1,st+last); jumphtml('results',p);}
//SaveJ('results_dev,findev___'+ajx(p));

//slctdropmenu
function callSaveJ(tg,e,restore){
SaveJ(tg+e.options[e.selectedIndex].value);
if(restore)e.selectedIndex=0;}

function embedslct(debut,fin,id,act){var id=id?id:'txtarea';
var txtarea=getbyid(id); txtarea.focus();
donotinsert=false; slctd=false;
if((clientVer>=4) && is_ie && is_win){
	slctd=document.selection.createRange().text; // Get text selection
	if(slctd){
	while(slctd.substring(slctd.length-1,slctd.length)==' '){
			slctd=slctd.substring(0,slctd.length-1);}
		// Add tags around selection
		document.selection.createRange().text=debut+slctd+fin;
		txtarea.focus(); slctd=''; return slctd;}}
else if(txtarea.selectionEnd && (txtarea.selectionEnd-txtarea.selectionStart>0)){
	slctd=mozWrap(debut,fin,id,act); return slctd;}}
//else insert(debut+fin,id);

//from http://www.massless.org/mozedit/
function mozWrap(opn,clo,id,action,acm){var id=id?id:'txtarea';
var s1=''; var s2=''; var s3='';
var txtarea=getbyid(id); var vl=1;//
if(typeof txtarea.value==='undefined')var vl=0;
var selLength=txtarea.textLength;
var selStart=txtarea.selectionStart;
var selEnd=txtarea.selectionEnd;
var selTop=txtarea.scrollTop;
if(selEnd==1||selEnd==2)selEnd=selLength;
if(vl)var truend=(txtarea.value).substring(selEnd-1,selEnd);
if(action=='del')truend='';
if(selEnd-selStart>0 && truend==' '){selEnd=selEnd-1;}
if(selEnd-selStart>0 && truend=="\n"){selEnd=selEnd-1;}
if(vl)var s1=(txtarea.value).substring(0,selStart);
	else var s1=(txtarea.innerHTML).substring(0,selStart);
if(vl)var s2=(txtarea.value).substring(selStart,selEnd);
if(action=='del' && !s2){s1=s1.substring(0,selStart-1); selStart-=1;}
if(vl)var s3=(txtarea.value).substring(selEnd,selLength);
if(action=="clean_n"){
	if(s2.indexOf("\n\n")!=-1)var s2=s2.split("\n\n").join("\n");
	else var s2=s2.split("\n").join(" ");}
else if(action=="clean_mail"){var s2=s2.split("\n\n").join("#br#");
		var s2=s2.split("\n").join(" "); var s2=s2.split("#br#").join("\n\n");}
else if(action=="lowercase"){var s2=s2[0].toUpperCase()+s2.substring(1).toLowerCase();}
else if(action=="mktable"){var s2=s2.split("\n").join("¬\n"); s2=s2.split(",").join("|");
	s2='['+s2+':table]';}
else if(action=="delconn"){
	if(s2){var s2=connectors(s2,acm,'delconn');
		if(acm=='list')s2=strreplace('|',"\n",s2);
		if(acm=='table')s2=strreplace(['|','¬'],[' ',"\n"],s2);}
	else if(acm){var s1=s1+s3; s3=''; var s1=connectors(s1,acm,'delconn');}
	else{
		if(s1)var na=find_next(s1,0); if(s3)var nb=find_next(s3,1);
		var s2=s1.substr(na); var s1=s1.substr(0,na);
		var s2=s2+s3.substr(0,nb); var s3=s3.substr(nb);
		//alert("-s1="+s1+"\n-s2="+s2+"\n-s3="+s3);
		var s2=connectors(s2,'','delconn');}}
//else if(action=='editcl'){}
else if(action=='repl'){var s2=opn; opn='';}
else if(action=='del')var s2='';
if(vl)txtarea.value=s1+opn+s2+clo+s3;
else txtarea.innerHTML=s1+opn+s2+clo+s3;
selFin=selEnd+clo.length+opn.length;
if(action=='del'||action=='delconn')selFin=selStart; if(!s2)selStart=selFin;
window.setSelectionRange(txtarea,selStart,selFin);//selStart
txtarea.scrollTop=selTop;
txtarea.focus();
return s2;}

//conn
function find_next(d,p){//alert(d+p);
if(p)var n=d.indexOf("]")+1; else var n=d.lastIndexOf("[");
if(n==-1)return 0;//p?d.length:
var d1=d.substr(0,n); var d2=d.substr(n);
if(p)var n1=substr_count(d1,'['); else var n1=substr_count(d2,']');
	for(var ia=0;ia<n1;ia++){//not global
		if(p)var n=n+find_next(d2,p); else var n=find_next(d1,p);}
return n;}

function delconn(d,cn){
var na=d.lastIndexOf(':'); var nb=d.lastIndexOf('§'); var xt=d.substr(na+1);
if((d.substr(nb)).indexOf(']')!=-1)nb=-1;
if(xt==cn||!cn){
	if(d.substr(0,4)=='http' && !cn){
		if(nb!=-1)return d.substr(nb+1)+' ['+d.substr(0,nb)+']'; else return d;}
	else if(na!=-1){d=d.substr(0,na);if(nb!=-1)d=d.substr(0,nb);}
	else if(nb!=-1)d=d.substr(0,nb);
	if(cn=='list')d=strreplace('|',"\n",d);}
else d='['+d+']';
return d;}

function connectors(msg,cn,act){
var deb=''; var mid=''; var end='';
var ini=msg.indexOf("[");
if(ini!=-1){var deb=msg.substr(0,ini);
var msb=msg.substr(ini+1); var out=msb.indexOf("]");
if(out!=-1){var msb=msg.substr(ini+1,out);
	var nb_in=substr_count(msb,"[");
	if(nb_in>=1){
		for(var ia=1;ia<=nb_in;ia++){
			var out_tmp=ini+1+out+1;
			var msb=msg.substr(out_tmp);
			var out=out+msb.indexOf("]")+1;
			var msb=msg.substr(ini+1,out);
			var nb_in=substr_count(msb,"[");}
		var mid=msg.substr(ini+1,out);
		var mid=connectors(mid,cn,act);}
	else var mid=msb;
	if(act=='delconn')var mid=delconn(mid,cn);
	var end=msg.substr(ini+1+out+1);
	var end=connectors(end,cn,act);}
else var end=msg.substr(ini+1);}
else var end=msg;
return deb+mid+end;}

//embed
function embed(val,bid,id){
var slctd=embedslct('','');
if(val=='video' && slctd)SaveJ('socket_video,extractid__repl_'+ajx(slctd));
else if(val=='url' && slctd)togglebub('mc,conns__'+bid+'_'+val+'_'+ajx(slctd)+'_'+bid+'_'+id);
else if(val=='img' && slctd){
	if(slctd.indexOf('§')!=-1)slctd=embedslct('[',':figure]');
	else slctd=embedslct('[',']',id);}
else slctd=embedslct('[',':'+val+']');
if(!slctd)togglebub('mc,conns__'+bid+'_'+ajx(val)+'__'+bid+'_'+id);}

function captslct(val){
var txt=getbyid('txtarea'); txt.focus(); var s2=false;
if((clientVer>=4) && is_ie && is_win){var s2=document.selection.createRange().text;}
else{var s2=(txt.value).substring(txt.selectionStart,txt.selectionEnd);}
if(!s2)var s2=txt.value; SaveJ('popup_mc,conns___'+val+'_'+encUriJ(s2));}

function edtmode(rid,id){var a=active('edtmd');
if(a)SaveJ(rid+'_mc,wygedt_txtarea_15_'+id+'_txtarea');
else SaveJ(rid+'_mc,wygoff_txtarea_15_'+id+'_txtarea');}

function autoslct(val){var id=val?val:'txtarea';
var txt=getbyid(id); txt.focus();
var s1=(txt.value).substring(0,txt.selectionStart); var sl=parseInt(s1.length);
var s3=(txt.value).substring(txt.selectionEnd);
var selStart=s1.lastIndexOf("["); var selFin=s3.indexOf("]")+1+sl;
window.setSelectionRange(txt,selStart,selFin);}

function embedurl(id,rid){
var p=getbyid('url').value; if(!p)return;
//var slctd=embedslct('','',rid,'');
slctd=embedslct('['+p,']',rid,'repl');
if(slctd==undefined)insert('['+p+']');}

function embedart(id,rid){
var val=getbyid('art').value; //var o=getbyid('cnp').value;
if(!val)embedslct('[',':art]',rid);
else{var slctd=embedslct('['+val+'§',':art]',rid);
	if(slctd==undefined)insert('['+val+':art]');}}

function embedcss(conn){
var val=getbyid('cnn').value;
if(val=="")return;
else embedslct('[','§'+val+':'+conn+']');}
function insert_conn(cnn){
var va=getbyid('cnv').value;
var vp=getbyid('cnp').value;
if(vp!='')val=va+'§'+vp; else val=va;
if(va)insert('['+val+':'+cnn+']');}

//embed|insert
function insertmbd(deb,val,fin){
var slctd=embedslct(deb,fin);
if(slctd==undefined){insert(deb+val+fin);}}
function insert_jc(conn,id){
var val=getbyid(id).value;
if(val=="")return; else insert('['+val+':'+conn+']');}
function insert_jcb(id){//video
var val=getbyid(id).value;
ajaxcall(id,'call_tri_auto*video_'+val,[],'');}
function insert_close(text){insert(text);}

//insert
function insert(text,tg){tg=tg?tg:'txtarea'; var txtarea=getbyid(tg);
if(txtarea.createTextRange && txtarea.caretPos){var caretPos=txtarea.caretPos;
	caretPos.text=caretPos.text+text+caretPos.text.charAt(caretPos.text.length-1);}
 else mozWrap('',text,tg);}

function insert_b(text,tg){tg=tg?tg:'txtarea'; var txtarea=getbyid(tg);
if(txtarea.createTextRange && txtarea.caretPos){var caretPos=txtarea.caretPos;
	caretPos.text=caretPos.text+text+caretPos.text.charAt(caretPos.text.length-1);}
 else mozWrap('',text,tg);}

function insert_photo(txt,conn){
var txtarea=getbyid('txtarea');
if(txt=="manual"){var txt=getbyid('source').value;
txt=clean_entity("\n","",txt);}
if(conn=='slider'||conn=='sliderJ'){mozWrap('','['+txt+':'+conn+']');}
else if(txt!=null){mozWrap('','['+txt+':photo'+conn+']');}
return;}

function insert_html(t,id){var ob=getbyid(id);
var range=window.getSelection().getRangeAt(0);
if(range.startContainer.nodeType===Node.TEXT_NODE){
range.startContainer.insertData(range.startOffset,t);}}

function autochar(e,id){var v,k;
var k=e.keyCode; //pr(k);//call 53.18.17, 52.18.17
//if(k==34)v='"';//lol
if(k==53)v=')';//41
if(k==91)v=']';//93
if(k==123)v='}';//125
if(k==164)v='="";';//=>61,51,51,59
if(v)insert_b(v,id);}

function cmd(e){var k=e.keyCode;//115/s
//if(getbyid('srch').value='')
if(k==110){SaveJ('popup_bubs,root__focus:addsrc_call_addart');}//n //getbyid('addurl').focus();
}
//addEvent(document,'keypress',function(){cmd(event)});

//toggles
function SaveBc(val){var dn=val.split("_");//artopen
var op=active('toggleart'+dn[1]); if(op)var nb=3; else var nb=dn[2];
var gets=dn[0]+"_"+dn[1]+"_"+nb+"_"+undefine(dn[4]);
ajaxcall(dn[0]+dn[1],gets,[],2);}

function active(id,ob,a){if(id)ob=getbyid(id); var op=ob.className;
if(op.indexOf('active')==-1 && !a){ob.classList.add("active"); return 1;}
else{ob.classList.remove("active"); return 0;}}

function active_list_finder(div,n){
var mnu=getbyid(div).getElementsByTagName("li");
for(i=0;i<mnu.length;i++){
var lnk=mnu[i].getElementsByTagName("a"); var chd=mnu[i].getElementsByTagName("ul");
if(i==n-1){
	if(lnk[0].className=='active' && chd[0].style.display=='block'){
		lnk[0].className=''; chd[0].style.display='none';}
	else if(lnk[0].className=='' && chd[0].style.display=='block'){
		lnk[0].className='active';}
	else{lnk[0].className='active'; chd[0].style.display='block';}}
else lnk[0].className='';}}

function active_list_bubble(ul){var li=ul.getElementsByTagName("li"); //change
if(li.length>0)for(i=0;i<li.length;i++){var liul=li[i].getElementsByTagName("ul");
	li[i].className=''; if(liul[0]){liul[0].style.display='none';}}}
function global_actlistbub(){var bubs=document.getElementsByClassName('inline');
for(var i=0;i<bubs.length;i++)active_list_bubble(bubs[i]);}
function findparentbub(ob){var pbub=ob.parentNode; if(pbub==null)return ob;
if(pbub.className=='inline')return pbub; else return findparentbub(pbub);}
function closeotherbubs(ob){
var bubs=document.getElementsByClassName('inline'); var not=findparentbub(ob);
for(var i=0;i<bubs.length;i++)if(bubs[i]!=not)active_list_bubble(bubs[i]);}
function closechild(li){var ul=li.getElementsByTagName("ul"); //desactive
for(i=0;i<ul.length;i++){ul[i].style.display='none';}}
function closebub(e){active_list_bubble(e.parentNode); eb=e.parentNode.parentNode;//btn
if(eb.parentNode)setTimeout(function(){closebub(eb)},100); else clbub(0,'');}
function closepbub(e,id){var pbu=e.parentNode.parentNode; active_list_bubble(pbu);
var li=pbu.getElementsByTagName("li");//if(id)e.parentNode.id=id;
for(i=0;i<li.length;i++){if(li[i]==e.parentNode && li[i].id)li[i].className='active';
	else li[i].className='';}}

//close bub
function clbub(op,bid){var div=getbyid('clbub');
if(op){addEvent(div,'mousedown',function(){clbub(0,bid)});
	div.style.width='100%'; div.style.height='100%';}
else{div.style.width=0; div.style.height=0;
	if(bid)Hide(bid); else{var bub=getbyid('bub');
	active_list_bubble(bub); global_actlistbub();}}}
//close popbub
function clpop(e,id){var n=clp.length; var fix='';
if(id)clp[n]=id; else if(n){if(e)var m=mouse(e); else m={x:0,y:0};
	for(i=0;i<n;i++){if(clp[i]){var bub=getbyid(clp[i]); if(bub){
		var p=getPosition(bub); var top=p.y; var fix=infixed(bub);
		//if(fix){var scr=pageYOffset; top+=scr;}//not relative parent
		if(fix){var scr=scrollinpos(bub); var scb=pageYOffset; top-=scr-scb; var my=m.y-scb;}
		else{var scr=0; var scb=0; var my=m.y;}
		if(m.x<p.x||m.x>(p.x+p.w)||my<top||my>(top+p.h)){//clickoutside
			if(clp[i].substr(0,3)=='pub')cltog(clp[i]);
			else if(clp[i].substr(0,2)=='bb')closechild(bub);
			else Remove(clp[i]);
			clp[i]=undefined;}}}}}}
//close togbub
function cltog(d){var op=getbyid(d); if(op)var ob=op.parentNode; Remove(d);
if(ob){var oa=ob.getElementsByTagName("a")[0]; oa.className=oa.dataset.css?oa.dataset.css:"";}}

//function onclickoutsisde(){}
function rmclp(d){for(i=0;i<clp.length;i++)if(clp[i]==d)clp[i]=undefined;}

function togglebub(j){var dn=j.split('_'); var id=dn[2]; j=j;
var ob=getbyid('bt'+id);
if(ob)var oc=ob.getElementsByTagName('a')[0];
if(ob)var op=ob.parentNode.getElementsByTagName('span');
var act=active('',oc);
if(act==1)SaveJ('togbub_'+j); else Remove('pub'+id);
for(i=0;i<op.length;i++){var pid=op[i].id;
	if(pid && pid.substr(0,2)=='bt' && pid.substr(2)!=id){
		var opa=op[i].getElementsByTagName("a"); if(opa[0])active('',opa[0],1);
		//var bub=op[i].getElementsByTagName("div")[0];
		var bub=getbyid('pub'+(pid.substr(2)));
		if(bub){Remove(bub.id); rmclp(bub.id);}}}}

function togglebub2(id){
var res=getbyid(id).innerHTML;
var ob=getbyid('bt'+id); var act=active('',ob);
if(act==1)togbub(res,id); else Remove('pub'+id);}

function active_list(id,n){//dropmenu_h
var mnu=getbyid(id).getElementsByTagName('a');
//for(i=0;i<mnu.length;i++){if(i==n)mnu[i].classList.add("active"); else mnu[i].classList.remove("active");}
for(i=0;i<mnu.length;i++){if(i==n)mnu[i].className='active'; else mnu[i].className='';}}

function SaveTg(val){var dn=val.split("_");
var mnu=getbyid('mnu'+dn[3]).getElementsByTagName('a');
for(i=0;i<mnu.length;i++){
	if(i==dn[4]){
		if(mnu[i].className=='active' && !dn[5]){//!notclosable
			mnu[i].className=''; falseClose(dn[0]);
			ajaxcall(dn[0],'sesmake_'+dn[0]+'_0_',[],'');}
		else{mnu[i].className='active'; var gets=dn[1]+'_'+encUri(dn[2])+'_'+dn[3];
			ajaxcall(dn[0],gets,[],'');}}
	else mnu[i].className='';}}

function active_tg(val,nb,nob){//tabs
var op=getbyid(val+nb).className;
if(op=='txtab'){var css='txtaa'; var ret=1;
	if(nob){for(i=1;i<=nob;i++){
		if(i!=nb)getbyid(val+'bt'+i).className='txtab';}}}
else{var css='txtab'; var ret=0;}
getbyid(val+nb).className=css;
return ret;}

function tog_j(val,nb,nob){var dn=val.split("_"); dn=undefiner(dn,7);
if(nob)var ac=active_tg(dn[0],nb,nob); else var ac=active(dn[0]+nb);
//dn[2]=undefine(dn[2]); dn[3]=undefine(dn[3]); dn[4]=undefine(dn[4]); dn[5]=undefine(dn[5]);
if(ac)SaveJ(val); else falseClose(dn[0]);}

function tog_jb(ja,jb,rid){
var ac=active(rid);
if(ac)SaveJ(ja); else SaveJ(jb);}

function toggle_block(id,p){//admin_menu
var act=active('bt'+id); var div=getbyid(id); var op=div.style.display;
if(op=='block'||p==1)div.style.display='none'; else div.style.display='block';}

function toggle_hidden(id,p){
var act=active('bt'+id); var div=getbyid(id); var hidden=getbyid('hid'+id).value;
if(act==1)div.innerHTML=hidden; else div.innerHTML='';}

function toggle_content(id,p){
var act=active('bt'+id); var div=getbyid(id);
if(act==1)div.style.display='block'; else div.style.display='none';}

function toggle_tab(tab,obj){//tabs_html
ajaxcall('socket','sesmake_tbmd'+tab+'_'+obj,[],4);
var mnu=getbyid('mnuab'+tab).getElementsByTagName("a");
for(i=1;i<=mnu.length;i++){var b=i-1;
	if(i==obj){mnu[b].className='txtaa';
	getbyid('div'+tab+i).style.display='block';}
	else{mnu[b].className='txtab'; Hide('div'+tab+i);}}}

function swapbt(p,e,ic){
var d=p==1?e.dataset.bt1:e.dataset.bt0;
if(ic==1){e=e.childNodes[0]; e.className='philum ic-'+d;}
else e.innerHTML=d;}

//bubjs
function bubjs(ob,o){
var mp=mouse(event); var pp=getbyid('bubjs'); var res=ob.dataset.tx;
if(pp==null){var pp=document.createElement('div'); pp.id='bubjs';
pp.style='position:absolute; background:white; border;1px solid silver; padding:1px; font-size:12px;';
getbyid('popup').appendChild(pp);}
if(o==1){pp.style.display='inline-block'; pp.style.zIndex+=1; pp.innerHTML=res;
pp.style.top=(mp.y-25)+'px'; pp.style.left=(mp.x-8)+'px';}
else{pp.style.display='none'; pp.innerHTML='';}}

function bubj(ob,o){
var mp=mouse(event); var pp=getbyid('bubj'); var j=ob.dataset.ja;
if(pp==null){var pp=document.createElement('div'); pp.id='bubj';
pp.style='position:absolute; background:white; border;1px solid silver; padding:1px; font-size:12px;';
getbyid('popup').appendChild(pp);}
if(o==1){pp.style.display='inline-block'; pp.style.zIndex+=1; SaveJ('bubj_'+j);
pp.style.top=(mp.y+15)+'px'; pp.style.left=(mp.x-8)+'px';}
else{pp.style.display='none'; pp.innerHTML='';}}

function radiobtj(rid,id,v,n){active_list(rid,n); getbyid(id).value=v;}
function radioj(rid,id,v,n){active_list(rid,n); SaveJ('socket_sesmake___'+id+'_'+v);}

function modedit(arr,tar){
vn=arr.split("|"); var nm=""; var nb=new Array();
for(i=0;i<vn.length;i++){
	if(vn[i]){var val=encUri(getbyid(vn[i]).value);
		var np=(val); nb.push(np); if(i==0)var nm=np;
		else if(i==1||i==2||i==3)var nm=nm+'/'+np;
		else if(i==4){if(nm)var nm=nm+':'+np; else nm=np;}
		else if(i==5 && np)var nm=nm+'§'+np; }}
if(!nb[1] && !nb[2] && !nb[3])nm=nm.replace('///','');
if(!nb[0] && !nb[1] && !nb[2] && !nb[3])nm=nm.replace(':','');
var to=getbyid(tar).value; if(to)nm=to+',\n'+nm;
getbyid(tar).value=utflatin(nm);}


//mkforms
function jumpMenu_addtext(val){var dn=val.split("_");
var old=getbyid(dn[0]).value;
if(!old)var old=''; else var old=old+dn[4];
var dc=getbyid(dn[1]); var slct=dc.options[dc.selectedIndex].innerHTML;
var va=getbyid(dn[2]).value;
if(va){var va=va+dn[3]+slct;} else{var va=slct;}
getbyid(dn[0]).value=old+va;}

function log_finger(id){var va=getbyid(id).value;
var arr=['-',',','?',';','.',':','/','!','§',' ','"',"'",'(',')','_','=','+','$','*','%','<','>',' ','|','~','&','^','¨','é','è','à','ç','ù','£','@','{','}','[',']','`','^','µ','¨','^','²'];
for(i=0;i<arr.length;i++)va=va.replace(arr[i],'');
if(Number(va.substr(0,1)))va=va.substr(1); //var va=va.toLowerCase();
getbyid(id).value=va;
return va;}

function num_finger(id,mx){var va=getbyid(id).value; var n=va.length;
if(!Number(va))va=va.substr(0,n-1);
if(n>mx)va=va.substr(0,mx);
getbyid(id).value=va;}

function num_mail(id){var v=getbyid(id); var va=v.value;//mk::form
if(va.indexOf("@")==-1)v.className='txtred';
else if(va.indexOf(".")==-1)v.className='txtred'; else v.className='';}

function log_goodname(id){va=log_finger(id);
ajaxcall(id,'login,usdhub_'+va,[],4);}

//storage
function locals(id,va){if(localStorage){//,com
//if(com=='x')localStorage.removeItem[id];
if(va)localStorage.setitem(id,va);
else return localStorage.getitem[id];}}

function mem_storage(val){//tar_var_copy_type
var vn=val.split("_"); vn[0]=vn[0]?vn[0]:'txtarea';
var ob=getbyid(vn[0].replace('*','_')); //
if(vn[5])active_list(vn[5],vn[4]);
if(vn[3])var obj=ob.innerHTML; else var obj=ob.value;
if(vn[2]=='x')return mozWrap('','',vn[0],'del');
var txt=embedslct('','',vn[0]);
if(vn[2]){var lc=localStorage[vn[1]];//paste
	if(vn[4])getbyid('cka').value=vn[1];
	if(vn[3])ob.innerHTML=lc; //encode_conn()
	else if(txt==undefined)insert_b(lc,vn[0]);
	else ob.value=obj.replace(txt,lc);}
else{var val=txt?txt:(obj);//copy
	if(vn[1]=='cka')var key=getbyid('cka').value; else var key=vn[1];
	localStorage[key]=val;}
if(vn[4])sav_btn(vn[4],vn[5]);}

function sav_btn(id,div){var mnu=getbyid(div); var rmn=mnu.getElementsByTagName('a');
for(i=0;i<rmn.length;i++)if(rmn[i].id==id)rmn[i].className='active'; else rmn[i].className='';}

function conn(val){
var vn=val.split("_"); vn[0]=vn[0]?vn[0]:'txtarea';
return mozWrap('','',vn[0],vn[1],vn[2]);}

function delconnx(val){var d=getbyid(val).value;
return mozWrap('','','txtarea','delconn',d);}
//drag
var popz=1;
var cpop=0;
var cpop_difx=0;
var cpop_dify=0;
var popnb=0;
var curid=0;
var exs=[];//artlive

//selectable(element,false);
(function(w,u,o){w.selectable=function(a,b){
	if(typeof b==='boolean' && !b){a.setAttribute(u,'on');a.setAttribute(o,'return false;');}
	else{if(a.hasAttribute(u))a.removeAttribute(u); if(a.hasAttribute(o))a.removeAttribute(o);}}})
(window,'unselectable','onselectstart');

function zindex_sup(){
getbyid('pop'+curid).style.zIndex=popz+100;}
function zindex(id){popz++; curid=id;
getbyid('pop'+id).style.zIndex=popz;}

function popslide(ev){
if(cpop!=0){var souris=mouse(ev);
	cpop.style.left=(souris.x-cpop_difx)+'px';
	cpop.style.top=(souris.y-cpop_dify)+'px';}}

function artslide(e,id){var wpos=window.pageXOffset; var met=getbyid('meta'+id);
var pmet=getPosition(met); met.innerHTML=wpos+'-'+pmet.y+'-'+delta;
if(pmet.y<20)met.style.position='fixed';}

function listenart(e,id){addEvent(document,'mousewheel',function(){artslide(e,id)});}

function tagchilds(ob,tag){return ob.getElementsByTagName(tag);}

//quanticscroll
function scrollarts(e,ob){var id; var ia=0; var hz=0;var a=tagchilds(ob,'section');
var ya=document.documentElement.scrollTop; var r=[];
for(i=0;i<a.length;i++){var y=a[i].offsetTop; var h=a[i].offsetHeight;
	if(y-h<ya)var id=a[i].id; r[i]=y; ia=i;}
var delta=Math.max(-1,Math.min(1,(e.wheelDelta||-e.detail)));//-1/+1
kart-=delta; if(kart<0)kart=-1; var yb=kart>-1?r[kart]:0;
if(yb)var hz=window.innerHeight/2-a[kart].offsetHeight/2;
window.scrollTo({top:yb-hz,left:0,behavior:'smooth'});
return false;}

var kart=0;
function initscrollarts(){var ob=getbyid('loadmodart');
if(ob)ob.addEventListener('DOMMouseScroll',function(e){scrollarts(e,ob)},false);}

//book
function scrolltxt(n){var v=n==1?1:(-1); doc.scrollTop=doc.scrollTop+v;}
function autoread(id,rid){doc=getbyid("scrll"+rid);
scrolltxt(1); timer=setTimeout(function(){autoread(id,rid)},100);}
function scrollt(n,rid){doc=getbyid("scrll"+rid);
for(i=0;i<200;i++){timer=setTimeout(function(){scrolltxt(n,rid)},i*4);}}

//jtim
function jtimb(j,n){SaveJ(j); jtime(j,n);}
function jtime(j,n){xt=setTimeout(function(){jtimb(j,n)},n?n:1000);}
function jtimbt(id,j,n){var ob=getbyid(id); var a=active(id);
if(a)jtime(j,n); else if(typeof xt!='undefined')clearTimeout(xt);}

//chat
function js_chat(d){
var fa='SaveJ(\'chtx'+d+'_chatxml,call__13_'+d+'\'); ';
var fb='xch=setTimeout(\'chatimer'+d+'()\',3000);';
return 'function chatimer'+d+'(){'+fa+fb+'} chatimer'+d+'();';}

function addjs_old(f,d,p){var head=document.getElementsByTagName('head')[0];
var js=document.createElement('script'); js.id='addjs'; var ob=getbyid('addjs');
if(f=='chatx')js.innerHTML=js_chat(d); else js.innerHTML=d;
if(p==1){if(ob!=null)ob.innerHTML=d; else head.appendChild(js);}
else clearTimeout(xch);}

function offon(f,d){
var v=getbyid('offon'+d); var p=v.value==1?0:1; v.value=p;
SaveJ('socket_sesmake___offon_'+p+'');
setTimeout(function(){addjs_old(f,d,p)},1000);
SaveJ('offonbt'+d+'_offon___'+p);}

function poplist(id){var icon='='; var list='ý';//pictos
var bt=getbyid(id); var popu=getbyid('popu'+curid);
if(bt.innerHTML==icon){var c='pubart'; bt.innerHTML=list; var inl='display:inline;';}
else{var c='icones'; bt.innerHTML=icon; var inl='display:block;';}
var div=popu.getElementsByTagName('a');
for(i=0;i<div.length;i++){var dv=div[i].childNodes[0]; dv.className=c;
	var sp=dv.getElementsByTagName('span')[1]; sp.style=inl;}
poprepos();}

//fixtit
function fixdiv(){var scrl=pageYOffset;
var div=getbyid('fixtit'); //var pdiv=getPosition(div);
//var mnu=getbyid('fixit');
var mnu=document.getElementsByTagName('h1')[0];
if(mnu='undefined')return;
var pmnu=getPosition(mnu);
var bub=getbyid('bub'); var inl=bub.className;
var mna=mnu.getElementsByTagName('a');
if(mna[0]!=undefined)var mnt=mna[0]; else var mnt=mnu;
var bt='<a onclick="scrolltoup(0);" class="small"><span class="philum ic-arrow-top"></span>'+mnt.innerHTML+'</a> ';
if(scrl>pmnu.y && inl=='inline')div.innerHTML=bt; else div.innerHTML='';}
if(typeof read==='string' && read>0)addEvent(document,'scroll',function(event){fixdiv()});
function recuptit(){
var mnu=document.getElementsByTagName('h1')[0];
var mna=mnu.getElementsByTagName('a');
if(mna[0]!=undefined)return mna[0].innerHTML; else return mnu.innerHTML;}

//continuous scroll
function artlive2(div){var ret=''; var ia=0;
var content=getbyid(div);
if(typeof content!=='object'||typeof content==null||!content)return;
var scrl=pageYOffset+innerHeight;
var mnu=content.getElementsByTagName('section');
if(typeof mnu!=='object'||typeof mnu==null)return;
var load=mnu[mnu.length-4];
var pos=getPosition(load);
var last=mnu[mnu.length-1];
if(!last)return;
var id=last.id;
var idx=exs.indexOf(id);
if(idx==-1 && scrl>pos.y){exs.push(id);
	var rq=getbyid('hid'+div);
	if(rq.value!='undefined'){
		SaveJ(div+'_api,callj__after_'+ajx(rq.value)+'_to:'+id);}}}//addiv()
//addEvent(document,'scroll',function(){artlive2('content')});

function artlive(){var ret=''; var ia=0;
var scrl=pageYOffset+innerHeight;
var mnud=getbyid('content');
if(mnud!=undefined){var mnu=mnud.getElementsByTagName("div");
if(mnu.length)for(i=0;i<mnu.length;i++){var did=mnu[i].id; var id=did.substr(1);
	if(parseInt(id)>1){
		if(mnu[i].innerHTML==''){
			var pos=getPosition(mnu[i]); var pos=pos.y;
			if(scrl>pos){ia++;
				var idx=exs.indexOf(id);
				if(ia==20)i=mnu.length;//stop loop
				if(idx==-1 && ia<20){
					exs.push(id); if(mnu[i])var md=mnu[i].dataset.prw;
					SaveJ(did+'_art,playb__2_'+id+'_'+md);}}}}}}}

if(typeof read==='string' && flow==1)
addEvent(document,'scroll',function(){artlive()});

function upload(id){
var form=getbyid("upl"+id);
var type=getbyid("typ"+id).value;
var opt=type=='disk'?getbyid("opt"+id).value:'';
var jo=type=='art'?'':'14';//portfolio
var fileSelect=getbyid("upfile"+id);
var files=fileSelect.files;
uploaded=0;
for(var i=0;i<files.length;i++){//1
	var fd=new FormData();
	var time=Math.floor(Date.now()/1000);
	var file=files[i];
	var filename=file.name;
	//if(!file.type.match("image.*"))continue;
	fd.append("upfile"+id,file,filename);
	//waitmsg(id+'up');
	if(filename)upload_progress(id);
	var gets='sav,uploadsav_'+id+'_'+type+'_'+opt;
	new AJAX(jurl()+gets,id+'up',jo,fd);}}

function cancelupload(rid){clearTimeout(xb); uploaded=0; jumphtml(rid+'prg','');}

function upload_progress(rid){
if(uploaded==100)var div=''; else
var div='<progress value=\"'+uploaded+'\" max=\"100\"></progress><a onclick=\"cancelupload(\''+rid+'\')\" class=\"txtyl\">x</a>';
jumphtml(rid+'prg',div);
xb=setTimeout(function(){upload_progress(rid)},100);}

//apicom
function apijumptoarea(d,id){var res=[]; var ok=0;
var p=d.substr(3); var o=getbyid(d); var k=o.id; var v=o.value;
var content=getbyid(id);
var r=(content.value).split(',');
for(i=0;i<r.length;i++){var kv=r[i].split(':'); //if(r[i]=='undefined')r[i]='';
	if(kv[0]==p){if(v)res.push(p+':'+v); var ok=1;} else if(r[i])res.push(r[i]);}
if(!ok && v)res.push(p+':'+v);
var ret=res.join(','); if(ret!=undefined)content.value=ret;}

function apijumptoinputs(id){
var content=getbyid(id);
var r=(content.value).split(',');
for(i=0;i<r.length;i++){var kv=r[i].split(':');
	var ob=getbyid(id+kv[0]);
	if(ob!=undefined && kv[1]!=undefined)ob.value=kv[1];}}

/*function apijumpall(arr){
if(arr)var r=arr.split(','); var res=[]; var content=getbyid('inp');
if(r!=undefined)for(i=0;i<r.length;i++)if(r[i]){
	var v=r[i].split(':')[0];
	var ob=getbyid('inp'+v);
	if(ob!=undefined && ob.value)res.push(v+':'+ob.value);}
var ret=res.join(','); if(ret)content.value=ret;}*/

//stabilo
function getrange(id){
var ob=getbyid(id);
elStart=0; elEnd=0;
var doc=ob.ownerDocument||ob.document;
var win=doc.defaultView||doc.parentWindow;
var sel;
if(typeof win.getSelection!="undefined"){
	sel=win.getSelection(); //sel=encode_utf8(sel);
	if(sel.rangeCount>0){
		var range=win.getSelection().getRangeAt(0);
		var preCaretRange=range.cloneRange();
		preCaretRange.selectNodeContents(ob);
		preCaretRange.setEnd(range.endContainer,range.endOffset);
		elEnd=preCaretRange.toString().length;}}
else if((sel=doc.selection) && sel.type!="Control"){
	var textRange=sel.createRange();
	var preCaretTextRange=doc.body.createTextRange();
	preCaretTextRange.moveToElementText(ob);
	preCaretTextRange.setEndPoint("EndToEnd",textRange);
	elEnd=preCaretTextRange.text.length;}
slct=sel.toString();
if(slct.substring(slct.length-1,slct.length)==' '){slct=slct.substring(0,slct.length-1); elEnd-=1;}
var elStart=elEnd-slct.length;
return{start:elStart,end:elEnd,txt:slct};}

function useslct(e,id){var d=getrange('art'+id);
if(d.txt){var ex=getbyid('edtrk'+id);
	if(ex)insert('['+d.txt+'§'+d.start+':callquote]'+"\n\n",'edtrk'+id);
	else SaveJ('popup_tracks,form___'+id+'_'+encUriJ(d.txt)+'_'+d.start);}}

function callquote(id,s,pad,idt){
var ob=getbyid('art'+id); var t=ob.innerHTML;
SaveJ('art'+id+'_art,playq___'+id+'_'+s+'_'+pad+'_'+idt);
setTimeout(function(){scrolltoob('qnh'+s,200)},300);}

function xltags(e,id,cnn){var d=getrange('art'+id);
if(d.txt){var tg=cnn=='all'?'popup':'art'+id; if(cnn=='all')cnn='';
	//var ob=getbyid('art'+id); var t=ob.innerHTML;
	//var s1=t.substr(0,d.start); var s2=t.substr(d.start,d.end-d.start); var s3=t.substr(d.end);
	//ob.innerHTML=s1+'<span id="slct1'+id+'"></span>'+s2+'<span id="slct2'+id+'"></span>'+s3; pr(s2);
	SaveJ(tg+'_mk,slctconn___'+id+'_'+encUriJ(d.txt)+'_'+d.start+'_'+cnn);}}

function dec2hex(n){var hex=n.toString(16); if(hex.length==1)hex="0"+hex; return hex;}//255
