//ajax
var wait=0; var reloadart=100; var x=0;
var clp=[]; var enc=''; var pos=0; var xch;
if(typeof fixpop==='undefined')var fixpop=0;
if(typeof fulpop==='undefined')var fulpop=0;

function AJAX(url,tg,act,post){
if(url!=undefined)this.url=url;
if(tg!=undefined)this.tg=tg;
if(act!=undefined)this.act=act; else this.act=0;
if(this.m_Request!=undefined){this.m_Request.abort(); delete this.m_Request;}
this.m_Request=this.createReqestObject();
var m_This=this;
this.m_Request.onreadystatechange=function(){m_This.handleResponse();}
//setTimeout(function(){AJAX.m_Request.abort(); delete AJAX.m_Request;},2000);
this.m_Request.open('POST',this.url,true);
if(post)this.m_Request.upload.addEventListener('progress',progressHandler,false);
this.m_Request.send(post instanceof FormData?post:null);}

AJAX.prototype.url=undefined;
AJAX.prototype.tg=undefined;
AJAX.prototype.m_Request=undefined;

AJAX.prototype.createReqestObject=function(){var req;
try{req=new XMLHttpRequest();}//all
catch(error){try{req=new ActiveXObject('Microsoft.XMLHTTP');}//IE
	catch(error){try{req=new ActiveXObject('Msxml2.XMLHTTP');}//IE
		catch(error){req=false;}}}
return req;}

function progressHandler(ev){uploaded=Math.round((ev.loaded/ev.total)*100,2);}

//0-1:fading 2:nofading 4-7:value 5:insert 6:insert-close 7:popup newart 8:multithread
//9: newart 10:confirm ok 11:select text 13:track 14:addiv 16:addcss 17:addjs 18:rebond
//3:loading 7:reload/save 9:reload 12:reload, 15:repos 19:unhide 20:toggle btn 21:autoscroll
AJAX.prototype.handleResponse=function(){
var act=this.act; var tg=this.tg;
//if(tg.indexOf(',')!=-1)var act='json';
if(this.m_Request.readyState==4){wait=0;
	if(this.m_Request.status=='200'){
		var cb=getbyid(tg);
		var res=this.m_Request.responseText;
		if(tg=='popup')popub(res,act);
		else if(tg=='bubble')bubble(res,act);
		else if(tg=='togbub')togbub(res,act);
		else if(tg=='pagup')pagup(res,act);
		else if(tg=='panup')panup(res,act);
		//else if(act==4||act==7||act==9)cb.value=res;
		else if(act==5)insert(stripslashes(ajx(res,1)));
		else if(act==6){insert(res); Close('popup');}
		else if(act==10){cb.style.display='none';}
		else if(act==11){cb.innerHTML=res;
			window.setSelectionRange(tg,res.length,res.length);}
		else if(act==13)addiv(tg,res,'before');
		else if(act==14)addiv(tg,res,'after');
		else if(act=='before')addiv(tg,res,act);
		else if(act=='after')addiv(tg,res,act);
		else if(act=='begin')addiv(tg,res,act);
		else if(act=='atend')addiv(tg,res,act);
		else if(act==16)addcss(res);
		else if(act==17)addjs(res);
		else if(act==18)SaveJc(res);
		else if(act==20){if(res)active_b(tg);}
		else if(act=='self')window.location=document.URL;
		else if(act=='url')window.location=res;
		else if(act=='repl')mozWrap(res,'','','repl');
		else if(act=='arts')poparts(res);
		else if(act=='exec')eval(res);
		else if(act=='json')jsonput(tg,res);
		//else if(res.indexOf('Fatal error')!=-1)popub(res,act);
		else if(cb!=null){var typ=cb.type; //alert(typ);
			if(typ=='text' || typ=='hidden' || typ=='textarea')cb.value=res;
			else cb.innerHTML=res;}
		//deco
		if(res.substr(0,6)=='logon:')window.location=document.URL;
		else if(act<2 && tg.indexOf(',')==-1){opac(100,tg);}
		else if(act==3||act==7||act==9||act==15)Hide('popw');
		if(act==7){var read=getbyid('socket').value;
			if(typeof(curid)!='undefined')Close('popup');
			if(read>0)SaveJ('popup_popart__3_'+read+'_3_1');
			else SaveJ('popup_edit,artform');}
		else if(act==9){var read=getbyid('socket').value;
			if(read>0)read='/'+read; if(read)window.location=read;}
		else if(act==12)popb(curid);
		else if(act==15)poprepos();
		else if(act==19)cb.style.display='block';
		else if(act==21)autoscroll(cb);
		else if(act==23)cb.value=res;
		else if(act==22)setTimeout(function(){falseClose(tg)},2000);
		else if(act==24)setTimeout(function(){poprepos()},1500);
		else if(act==25)setTimeout(function(){poprepos()},500);
		//if(this.onDraw!=undefined)this.onDraw();
	return res;}
	else{
		if(this.onError!=undefined){
			this.onError({status:this.m_Request.status,
			statusText:this.m_Request.statusText});}}
	delete this.m_Request;}
else if(wait==0){wait=1;//wait
	if((act==3||act==7||act==9||act==15) && wait)waitmsg(tg);
	if(act<2 && tg!='popup' && tg!='bubble')opac(10,tg);}
//else if(wait==1){wait=2; setTimeout(function(){delete AJAX.m_Request;},2000);}
}

AJAX.prototype.handleAbort=function(){this.m_Request.abort(); delete this.m_Request;}

//dn2 are posts
function ajaxcall(tg,gets,prm,tp){var fd=''; gets+='&tg='+tg;
if(prm){var fd=new FormData(); for(i=0;i<prm.length;i++)fd.append(i,prm[i]);}
new AJAX(jurl()+gets,tg,tp,fd);}
function sj(o){SaveJ(o.dataset.j);}

//var rk=Object.keys(obj); //
function jsonput(keys,json){var cb,k,typ,val;
	var obj=JSON.parse(json);
	var rk=keys.split(',');
	for(var i in obj){
		if(isNumeric(i))k=rk[i]; else k=i;
		cb=getbyid(k);
		if(cb!=null)typ=cb.type;
		if(typ=='text' || typ=='textarea' || typ=='hidden')cb.value=obj[i];
		else if(cb!=null)cb.innerHTML=obj[i];}}

function mkprm(dn2){var prm=[]; var dna=dn2.split(','); var vl='';
for(i=0;i<dna.length;i++){var tg=dna[i].replace('*','_');
	vl=capture(tg); if(vl!=undefined)prm.push(vl);}
return prm;}

function poparts(d){var r=d.split(',');
for(var i in r)ajaxcall('popup','popart_'+r[i]+'_3','',3);}

//new canal
//target,tg2|app,mth|3|var1,var2|inp1,inp2 //tg;a;tp;g;p
function bj(ob){var val=ob.dataset.bj; bjcall(val);}
function bjcall(val){if(typeof x!='undefined')clearTimeout(x);
var dn=val.split('|'); var tp,g,fd,vl,pp=''; var fd=new FormData();
if(dn[0]=='popup'||dn[0]=='pagup')pp='&'+dn[0]+'==';
//else if(dn[0]=='pop'){dn[0]='pop'+curid; var tp=12;}
else if(dn[0].indexOf(',')!=-1)tp='json';
else if(dn[2]){var dn2=dn[2].split(','); tp=dn2[0]; var tx=dn2[1];}
if(dn[4]){prm=dn[4].split(','); for(i=0;i<prm.length;i++)fd.append(prm[i],capture(prm[i]));}
if(dn[3]!=undefined)g=dn[3];
new AJAX('/ajax.php?_a='+dn[1]+'&_g='+g,dn[0],tp,fd);
if(tx=='x')Close('popup');
else if(tx=='xc')clpop();//autoclose togbub
else if(tx=='xb')cltog(dn[2].split(',')[1]);//close tog
else if(tx=='xx')x=setTimeout(function(){Close('popup')},2500);
else if(tx=='xd')x=setTimeout(function(){falseClose(dn[0])},1500);
else if(tx=='xr')x=setTimeout(function(){poprepos()},1000);
else if(tx=='xs')exs=[];//artlive2()
//else if(tx=='xu')updateurl(dn[1].split(',')[0],val);
//else if(tx=='xj'){var app=dn[1].split(',')[0]; ajaxcall('',app+',js_'+g,'',17);}
}

function capture(tg){var ty,vl,type='';
var ob=getbyid(tg); if(ob==null)ob=document.getElementsByName(tg)[0]; if(ob==null)return;
var ty=ob.type; if(ty)var type=ty.split('-')[0];
if(type=='checkbox')vl=ob.checked?1:0;
else if(type=='select')vl=ob.options[ob.selectedIndex].value;
else if(type=='radio'){var el=document.getElementsByName(tg);
	for(var io=0;io<el.length;io++)if(el[io].checked)vl=el[io].value;}
else if(ty==undefined && ob!=null){vl=ob.innerHTML; localStorage['revert']=vl;}
else if(ob!=null)vl=ob.value;
return vl;}

//document.getElementById('bj').addEventListener('click',function(){bj(this)});
//document.querySelectorAll('[data-bj]').addEventListener('click',function(){bj(this)});

//setInterval
function Timer(func,id,start,end,t){var timer=0;
if(typeof id==='undefined' || id=='')return;
if(start>end){for(i=start;i>=end;i--){timer++; curi=i;
	x=setTimeout(func+"("+i+",'"+id+"')",timer*t);}}
else if(start<end){for(i=start;i<=end;i++){timer++;
	x=setTimeout(func+"("+i+",'"+id+"')",timer*t);}}}

function getbyid0(id){return document.getElementById(id);}

function getbyid(id,tg){//tg.target.id
if(tg!=undefined){var pa=tg.parentNode;
	if(pa==undefined)return getbyid(id);
	else if(pa.id==id)return pa;
	else{var pc=pa.childNodes;
		for(i=0;i<pc.length;i++)if(pc[i].id==id)return pc[i];}
	return getbyid(id,pa);}
return document.getElementById(id);}

function addEvent(obj,event,func){if(obj!=undefined)obj.addEventListener(event,func,true);}
function opac(op,id){if(id!=null){var ob=getbyid(id); if(ob!=undefined)ob.style.opacity=(op/100);}}
function resiz(op,id){getbyid(id).style.height=op+'px';}
function slide(op,id){getbyid(id).style.marginLeft=op+'px';}
function scrl(op,id){getbyid(id).scrollTo=op;}
function isNumeric(n){return !isNaN(parseFloat(n)) && isFinite(n);}//Number(parseFloat(n))===n;
function isNumber(n){return (n>=0||n<0);}//old

function setit(d,e){popw=getbyid(e);
if(typeof(popw)!='undefined')popw.style.backgroundColor='#'+d;}
function colorwheel(div,a){var rgb=new Array;
var arr=[0,1,2,3,4,5,6,7,8,9,'a','b','c','d','e','f']; //if(a)arr=arr.reverse();
for(i=0;i<arr.length;i++){rgb=String(arr[i])+String(arr[i])+'4444';
	setTimeout(function(){setit(rgb,div)},200*i);}}
function waitmsg(div){var popw=getbyid('popw');
if(div && div!='popup' && div!='socket')var dv=getbyid(div);
var loadn='<a onclick="Hide(\'popw\');">Loading...</a>';//t
if(dv!=undefined){dv.innerHTML=loadn;} else{popw.innerHTML=loadn;
popw.style.display='block'; popw.style.position='fixed'; popw.className='loading';
var l=(innerW()-100)/2; var t=((innerH()-10)/2)-16; colorwheel('popw');
popw.style.left=l+'px'; popw.style.top=t+'px'; popw.style.zIndex=popz;}}
function jurl(){return '/ajax.php?callj=';}
//enc//encodeURI():utf8 error with �//not enc to utf8
function encUri(val){return enc!='utf-8'?encodeURIComponent(val):val;}
function decUri(val){return unescape(val);}//SaveJm//decodeURIComponent
function encUriJ(val){val=ajx(val); if(enc!='utf-8')val=encodeURIComponent(val);
return val;}// else var val=encodeURI(val);
function decUriJ(val){return unescape(ajx(val));}//decodeURI
function utf8_enc(v){return unescape(encodeURIComponent(v));}
function utf8_dec(v){return decodeURIComponent(escape(v));}
function addslashes(val){var val=clean_entity(/\"/g,'\\"',val);
return clean_entity(/\'/g,'\\\'',val);}
function stripslashes(val){var val=clean_entity(/\\"/g,'"',val);
return clean_entity(/\\'/g,'\'',val);}
function strreplace(rep,by,val){if(!val)return ''; return val.split(rep).join(by);}
//var repl=function(rep,by){return this.split(rep).join(by);}
function clean_entity(a,b,v){var vn=v.split(a); var nb=vn.length;
for(var i=0;i<nb;i++){var v=v.replace(a,b);} return v;}
function ajx(val,n){
var arr=["\n","\r",'*',"\'",'�','�','_','/',':','#','�','&','+','=','.','�','�','�'];//euro inusited,'@','%3F','?',"'",'%26sect',' ','%u','<','>'
var arb=['(nl)','(nl)','(star)','(aslash)','(euro)','(by)','(und)','(slash)','(ddot)','(diez)','(mic)','(and)','(add)','(equal)','(dot)','(dquote)','(dquote)','(quote)'];//,'(arob)','(qmark)','(qmark)','(quote)','(sect)','(space)','(pu)','(htop)','(htcl)'
if(n){for(var i=0;i<arr.length;i++){val=strreplace(arb[i],arr[i],val);}}//decode
else{for(var i=0;i<arr.length;i++){val=strreplace(arr[i],arb[i],val);}}
return val;}
function undefine(d){return typeof d=='undefined'?'':d;}//
function undefiner(r,n){for(i=0;i<n;i++)r[i]=undefine(r[i]); return r;}

function innerW(){return parseInt(window.innerWidth);}
function innerH(){return parseInt(window.innerHeight);}

function poph(popu,pageup){if(popu==null)return;
popu.style.maxHeight=''; var adjust=60;
var ha=innerH(); var hb=popu.offsetHeight;
if(hb>ha){
	if(pageup)popu.style.height='calc(100vh - '+popa.offsetHeight+'px)';//36
	else popu.style.maxHeight=(ha-adjust)+'px';
	popu.style.overflowY='scroll';}
else{popu.style.overflowY='auto';}
popu.style.maxWidth='';
var wa=innerW(); var wb=popu.offsetWidth;
if(wb>wa){
	if(pageup)popu.style.width='100vw';
	else popu.style.maxWidth=wa+'px';
	popu.style.overflowX='visible';}
else popu.style.overflowX='auto';}

function poprepos(){//popnb;
if(getbyid('popu'+curid)==undefined)return;
var popu=getbyid('popu'+curid); poph(popu);
var popup=getbyid('pop'+curid);
var pos=ppos(popu,0);
popup.style.left=pos.x+'px'; popup.style.top=pos.y+'px';}

function autoscroll(popu){var p=getPosition(popu); var ha=innerH();
if(p.y+p.h>ha){var nh=ha-p.y-20;
	if(nh>140){popu.style.height=nh+'px';
		popu.style.overflowY='scroll'; popu.style.overflowX='hidden';}}}

function bpos(id,nb,p){//bubblepop
var bt=getbyid(id); var pos=getPosition(bt);
var bl=getbyid(nb); var pob=getPosition(bl);
var px=pos.x+bt.offsetWidth; var py=pos.y;
var wa=innerW(); var ha=innerH();
if(px+pob.w>wa)px=wa-pob.w; if(py+pob.h>ha)py=ha-pob.h;
if(py+pob.h>ha){bl.style.maxHeight=(ha-py-60)+'px'; bl.style.overflowY='auto';}
if(p){px=pos.x; py=pos.y+bt.offsetHeight;}
bl.style.minWidth=pos.w+'px';
bl.style.position='fixed';
if(px<0)px=0; if(py<0)py=0;
return {x:px,y:py};}

function ppos(popu,decal){if(popu==null)return;
var sw=innerW(); var w=popu.offsetWidth; var l=(sw-w)/2-20;
var sh=innerH(); var h=popu.offsetHeight; var t=(sh-h)/2-20;
if(l+decal+w>sw)decal=0; var px=(l>0?l:0)+decal; if(px<10)px=0;
if(t+decal+h>sh)decal=0; var py=(t>0?t:0)+decal;
if(fixpop==1){var px=px+window.pageXOffset; var py=py+window.pageYOffset;}
return {x:px,y:py};}

function popf(popup){
popup.style.width='100%'; popup.style.height='100%';
return {x:0,y:0};}

function popub(res,act){popnb+=1;
var nb=popnb; var ab,as=''; var decal=0;
var content=getbyid('popup');
var popup=document.createElement('div');
popup.id='pop'+nb; popup.style.position='fixed';
addEvent(popup,'mousedown',function(){zindex(nb)});
popup.innerHTML=res;
content.appendChild(popup); zindex(nb);
var popa=getbyid('popa');
addEvent(popa,'mousedown',function(event){start_drag(event,nb); selectable(popa,false);});
addEvent(popa,'mouseup',function(event){stop_drag(event); selectable(popa,true);});
var popu=getbyid('popu'); poph(popu);//before ppos
var pos=ppos(popu,decal);
if(act>100)var pos=bpos('bt'+act,'pop'+nb,0);
else if(!isNumeric(act)){
	if(act.substr(0,4)=='bpop'){var ab=1; var pos=bpos('btpop'+act,nb,1);}
	else if(act.substr(0,2)=='bt'){var ab=0; var pos=bpos(act,'pop'+nb,1);
		clpop('','pop'+nb); if(popa)popa.style.display='none'; var as=1;}
	//else if(act){var ab=0; var pos=bpos(act,'bb'+nb,1);}
	}
//else if(fulpop)var pos=popf(popup);
popup.style.left=pos.x+'px'; popup.style.top=pos.y+'px';
if(fixpop==1 || ab)popup.style.position='absolute';
if(as)autoscroll(popu);
popa.id='popa'+nb; popu.id='popu'+nb;}

function popb(nb){//reload
var popup=getbyid('pop'+nb);
addEvent(popup,'mousedown',function(){zindex(nb)});
var popa=getbyid('popa');
addEvent(popa,'mousedown',function(event){start_drag(event,nb)});
var popu=getbyid('popu');
popa.id='popa'+nb; popu.id='popu'+nb;
poprepos();}

//pagup
function pagpos(){
var popup=getbyid('pop'+curid);
//popup.style.left=0; popup.style.top=0;
popup.style.width='calc(100vw - 16px)';
popup.style.height='100%';popup.style.left='0';
popup.style.top='0'; popup.style.bottom='0';
popup.style.backgroundColor='rgba(0,0,0,0.7)';
popup.style.boxShadow='0px 0px #000;';}

function pagup(res,method){popnb+=1; var nb=popnb;
var content=getbyid('popup');
var popup=document.createElement('div');
popup.id='pop'+nb; popup.style.position='fixed';
addEvent(popup,'mousedown',function(){zindex(nb)});
popup.innerHTML=res;
content.appendChild(popup); zindex(nb); //clpop('','pop'+nb);
var popu=getbyid('popu');
poph(popu,1);//before ppos
pagpos();
popu.id='popu'+nb;}

//bubbles (inside a div)
function bubpos(bub,id,li,liul){var indic=id.substr(0,1);
if(indic=='d'){var tw=innerW(); var pos=getPosition(li);
	var left=li.offsetLeft; bub.style.minWidth='200px'; //bub.style.maxWidth='340px';
	bub.style.top=li.parentNode.offsetTop+li.parentNode.offsetHeight+'px';
	if(liul[0])var wei=liul[0].offsetWidth; else var wei=bub.offsetWidth;
	if(left+wei>tw)left=tw-wei-li.parentNode.offsetLeft;
	bub.style.left=left+'px';}
else{var th=innerH(); var top=li.offsetTop; var lih=li.parentNode.offsetTop;
	bub.style.left=li.offsetLeft+li.offsetWidth+'px';
	if(liul[0])var hei=liul[0].offsetHeight; else var hei=bub.offsetHeight;
	if(top+hei>th){top=th-hei-lih; if(top<0)top=0;
		bub.style.minWidth='180px'; //bub.style.maxWidth='480px';
		bub.style.maxHeight=(th-top-100)+'px'; //alert(th+'-'+top);
		bub.style.overflowY='auto'; bub.style.overflowX='hidden';}
	bub.style.top=top+'px';}}

function bubopac(op,id){var li=getbyid(id);
var liul=li.getElementsByTagName('ul'); liul[0].style.opacity=(op/100);}

function bubble(res,id){clbub(1,'');//onclickout
var idb='bb'+id; var li=getbyid(idb); li.style.zIndex=popz+1;
var liul=li.getElementsByTagName('ul');
var bub=document.createElement('ul');
if(id.substr(0,1)=='c')bub.className='nob';
if(li.className=='act'){li.className=''; closechild(li);}
else{closeotherbubs(li.parentNode); active_list_bubble(li.parentNode);
	bub.style.position='absolute'; popz+=1;
	if(liul[0]){//aex
		liul[0].style.display='block'; liul[0].style.zIndex=popz;
		liul[0].innerHTML=res; poph(liul[0]); li=liul[0]; bub=liul; idb=liul[0].id;}
	else{bub.innerHTML=res; li.appendChild(bub); (li.parentNode).style.zIndex=popz;}
	//bubopac(0,idb); Timer('bubopac',idb,10,100,2);
	bubpos(bub,id,li,liul);}}

//panup
function panh(bub,top){
if(bub)bub.style.maxHeight=''; var adjust=60;
var ha=innerH(); var hb=bub.offsetHeight; //alert(hb+'-'+top);
if(top+hb>ha){//var newH=(ha-top-adjust); if(newH>320)
	bub.style.maxHeight=(ha-top-adjust)+'px';
	bub.style.overflowY='auto';}
else{bub.style.overflowY='visible';}}

function panpos(bub,li){
var w=li.parentNode.offsetWidth; if(w<240)w=240;
if(bub.style!=undefined){bub.style.width=w+'px';
bub.style.top=li.parentNode.offsetHeight+'px';
bub.style.left=li.parentNode.offsetLeft+'px';}
panh(bub,li.parentNode.offsetTop);}

function panup(res,id){clbub(1,'');//onclickout
var indic=id.substr(0,1); var idb='bb'+id;
var li=getbyid(idb); li.style.zIndex=popz+1;
closeotherbubs(li.parentNode);
active_list_bubble(li.parentNode);
li.className='active';
var liul=li.getElementsByTagName('ul');
var bub=document.createElement('ul');
bub.style.position='absolute'; popz+=1;
//if(indic=='d')var bck=li.innerHTML; else res=bck+res;
if(liul[0]){//second call
	liul[0].style.display='block'; liul[0].style.zIndex=popz;
	liul[0].innerHTML=res; li=liul[0]; bub=liul; idb=liul[0].id;}
else if(indic!='d'){li=li.parentNode; li.innerHTML=res;
	bub=li; li=li.parentNode; idb=li.id;}
else{bub.innerHTML=res; li.appendChild(bub); (li.parentNode).style.zIndex=popz;}
//if(idb)bubopac(0,idb); Timer('bubopac',idb,10,100,3);//bad id, bad h
if(bub!=undefined)panpos(bub,li);}

//togbub
function togbub(res,id){popnb+=1; popz+=100;
var div=getbyid('bt'+id); var pid='pop'+popnb; var pos=get_dim(div);
div.style.position='relative';//parent need to be relative
var bub=document.createElement('div'); bub.innerHTML=res; bub.style.zIndex=popz;
bub.className='popup'; bub.style.position='absolute';
bub.style.minWidth='240px'; bub.style.maxWidth='480px'; bub.style.lineHeight='normal';
bub.style.padding='4px'; bub.style.marginRight='4px'; bub.id='pub'+id;
div.appendChild(bub); bub.style.left=(0-pos.x)+'px';//to measure width
var pob=get_dim(bub); var mxw=innerW();
if(pos.x+pob.w>mxw)bub.style.left=(pos.w-pob.w)+'px';
else bub.style.left='0px';
var e=infixed(div); if(e){var poc=get_dim(e);
	if(pos.x+pob.w>poc.w)bub.style.left=(pos.w-pob.w)+'px';}
autoscroll(bub); clpop('','pub'+id);}

//SaveJ
function SaveJb(a,b){SaveJ(a); //var t=typeof laps==='undefined'?500:laps;
setTimeout(function(){SaveJ(b)},laps||1000);}
function SaveJc(val){var dn=val.split(';');
for(i=0;i<dn.length;i++)if(dn[i])setTimeout('SaveJ("'+dn[i]+'")',100*i);}
function revert(){getbyid('txtarea').value=localStorage['revert'];}
function SaveJtim(j){if(typeof x!='undefined')clearTimeout(x);
x=setTimeout(function(){SaveJ(j)},1000);}//open bub
function clbubtim(e){if(typeof xc!='undefined')clearTimeout(xc);
xc=setTimeout(function(){closebub(e)},10000);}//close bub

//multipass
function SaveJm(dn,n){
var vn=dn[n].split('|'); var vl=''; var rs=new Array();
for(i=0;i<vn.length;i++){var tg=vn[i].replace('*','_');
	if(tg)vl=capture(tg); if(vl)vl=encUriJ(vl); rs[i]=vl;}
var res=rs.join('_');
return res;}

//SaveJ
//var urlbar={burl:''};
function SaveJ(val){//target_app_post1,post2_indic_v1_v2_v3_v4_multival
var opt=''; var res=''; var tp=''; var pp=''; laps=0; nt=0; na=0; var prm=[];
dn=val.split('_'); var ns=8; dn2=''; dn8=''; if(dn[2]==undefined)dn[2]='';
if(dn[3]=='3x' || dn[3]=='3xx' || dn[3]=='4x' || dn[3]=='5x'){var tp=dn[3].substr(0,1); dn[3]=dn[3].substr(1);}
if(dn[3]=='14x'){var tp='after'; dn[3]='x';}
else if(dn[3]=='exs')var tp='1';
else if(dn[3]!='pop'|'x'|'xx'|'xd'|'tg')var tp=dn[3];
if(dn[0]=='pop'){dn[0]='pop'+curid; var tp=12;}
else if(dn[0].indexOf(',')!=-1){tp='json'; dn[3]=tp;}
if(dn[2])prm=mkprm(dn[2]);
for(i=4;i<ns;i++){if(dn[i])opt+=encUri(dn[i])+'_'; else opt+='_';}
if(dn[7]=='autosize'||dn[1]=='msql')opt+='&sz='+innerW()+'-'+innerH();
if(dn[7]=='autowidth'){var ob=getbyid('content'); opt+='&sz='+(ob.offsetWidth);}
if(dn[8])res='&res='+SaveJm(dn,8);//obs
var gets=dn[1]+'_'+opt+res+pp; if(dn[2])gets+='&dn2='+dn[2];
ajaxcall(dn[0],gets,prm,tp);
//if(dn[1]=='popart')history.pushState(urlbar,dn[4],dn[4]);
if(dn[3]=='pop')Close('pop');
else if(dn[3]=='y')window.location=dn[4];
else if(dn[3]=='x')Close('popup');
else if(dn[3]=='xb')cltog(dn[2]);//close tog
else if(dn[3]=='xc')clpop();//autoclose togbub
else if(dn[3]=='jx'){Close('popup'); jumpvalue(dn[4],dn[5]);}
else if(dn[3]=='xx')setTimeout(function(){Close('popup')},2500);
else if(dn[3]=='xd')setTimeout(function(){falseClose(dn[0])},1500);
else if(dn[3]=='xr')setTimeout(function(){poprepos()},1000);
else if(dn[3]=='tg'){var op=active(getbyid(dn[2])); if(op==0)Close(dn[0]);}
else if(dn[3]=='exs')exs=[];//artlive2()
else if(dn[3]=='u')updateurl(dn[7],val);
else if(dn[3]=='js'){var da=dn[1].split(','); ajaxcall('',da[0]+',js_'+dn[4]+'_'+dn[5],[],17);}
else if(dn[3]=='css'){var da=dn[1].split(','); ajaxcall('',da[0]+',css_'+dn[4],[],16);}
else if(dn[3]=='jsxr'){var da=dn[1].split(','); ajaxcall('',da[0]+',js_'+dn[4],[],17);
	setTimeout(function(){poprepos()},1000);}}

//states
function updateurl(u,j){
var n=u.indexOf('/'); var a='read';
var r={urlPath:u,'app':a,'j':j}; if(u!='/')u='/'+u;
//window.history.replaceState(r,a,u);
window.history.pushState(r,a,u);
setTimeout(function(){document.title=recuptit();},500);}

window.onpopstate=function(e){var j=e.state.j; if(j)SaveJ(j);}

//saves
function preload(){var images=new Array();
for(i=0;i<preload.arguments.length;i++){images[i]=new Image();
	images[i].src=preload.arguments[i];}}

function SaveBf(val){//photo
var dn=val.split('_'); var w=dn[1]; var h=dn[2];
var sw=innerW(); var sh=innerH(); var py=window.pageYOffset;
var th=getbyid('page').clientHeight; sh-=30; if(th>sh)sw-=20;
var URL=dn[0]+'_'+w+'-'+h+'_'+sw+'-'+sh+'_'+dn[3];
ajaxcall('popup','usg,photo_'+URL,[],25);}
//ajaxcall('pagup','usg,overim_'+URL,[],'');}

function SaveTits(id,ids,prw){var dn=ids.split('|'); var get='';
for(i=0;i<dn.length;i++){var val=getbyid(dn[i]+id).value;
	var get=get+'&'+dn[i]+'='+encUriJ(val);}//Close('popup');
ajaxcall(id,'meta,titsav_'+id+'_'+prw+get,[],'');}

//import-edit
function SaveI(val){
var src=getbyid(val).value;
if(src=='' || src.indexOf('.')==-1)return;
var gets='sav,webread_'+encUriJ(src);
ajaxcall('suj1,txtarea,urledt',gets,[],'json');}
function SaveIt(){setTimeout(function(){SaveI('urlsrc')},2000);}

function SaveIb(id){//import art//call_url
var src=getbyid('urlsrc').value;
var URL='sav,websav_'+id+'_'+encUriJ(src);
ajaxcall('txtarea',URL,[],4);
Close('popup');}

function SaveIe(){//addurl_fastmenu
var src=getbyid('addsrc').value; src=encUriJ(src);
if(src.substr(0,4)!='http')return;
inform_field('addsrc','adb');
if(src)ajaxcall('popup','sav,batchpreview_'+src,[],''); Close('popup');}
function SaveIeb(){if(x)clearTimeout(x); x=setTimeout(function(){SaveIe()},1500);}

function SaveIec(src,cat,cid,cib,x,suj){//batch
if(!cat && cid)var cat=getbyid(cid).value;
if(!cat){SaveJ('popup_sav,newartcat__'+x+'_'+encUri(src)+'_'+suj); return;}
if(cib)var ib=getbyid(cib).value; else var ib='';
var gets='sav,addurlsav_'+encUri(src)+'_'+encUri(cat)+'_1_'+ib;
ajaxcall('socket',gets,[],7);}

function inform_field(id,di){
var ob=getbyid(id); ob.value='loading...';
setTimeout(function(){getbyid(id).value="";},700);
if(di){clbub(0,''); setTimeout(function(){getbyid(di).parentNode.style.display="none";},1000);}}

function Search2(id){var prm=[];
var r=[id?id:'search','srdig','srbol','srord','srtit','srseg','srpag','srcat','srtag','limit','srlng','srpri','srlen'];
for(i=0;i<r.length;i++)prm.push(getbyid(r[i]).value);
ajaxcall('popup','search,home',prm,3);
Close('popup');}

function Search1(id){
var ob=getbyid(id); if(ob!=null)var src=encUriJ(ob.value);
if(src){inform_field(id,''); ajaxcall('popup','search_'+src,[],3);}}

function Search(old,id){
var ob=getbyid(id); if(ob!=null)var src=encUriJ(ob.value);
if((!src||src.length<2)&& src!='1')return;
if(src!=old){if(!old)return SearchT(id); else return;}
if(src){inform_field(id,(id=='srchb'?'ada':''));
	ajaxcall('popup','search,home_'+src,[],3);}}

function SearchT(id){var ob=getbyid(id);
if(ob!=null)var old=encUriJ(ob.value); else var old='';
setTimeout(function(){Search(old,id)},1000);}

//edit
function editart(id){var ob=getbyid('art'+id);
SaveJ('art'+id+',edt'+id+',adt'+id+',adt2'+id+'_mc,wygopn__json_'+id);
ob.contentEditable='true'; ob.designMode='on'; ob.focus();}

function saveart(id){var ob=getbyid('art'+id); getbyid('edt'+id).innerHTML='';
SaveJ('art'+id+',edt'+id+',adt'+id+',adt2'+id+'_mc,wygsav_art'+id+'_json_'+id);
ob.contentEditable='false'; ob.designMode='off';}

function sjtimb(old,id,j){
var ob=getbyid(id); if(ob!=null)var src=encUri(ob.value);
if(!src||src.length<=3)return;
if(src!=old){if(!old)return sjtime(id,j); else return;}//paste
if(src)SaveJ(j);}
function sjtime(id,j){var ob=getbyid(id);
if(ob!=null)var old=encUri(ob.value); else var old='';
setTimeout(function(){sjtimb(old,id,j)},1000);}

function autocomp_call(old,id,cats){vn=cats.split(' '); var cur=getbyid('inp'+id).value;
if(old==''){for(i=0;i<vn.length;i++)getbyid('slct'+normalize(vn[i])+id).innerHTML='';}
else if(cur!=old||cur.length<2)return;
else for(i=0;i<vn.length;i++){var tg='slct'+normalize(vn[i])+id;
	var gets='meta,slctag_'+id+'_'+encUri(vn[i])+'_'+encUriJ(cur);
	//ajaxcall(tg,gets,[],2);//bigcrash of all
	new AJAX(jurl()+gets,tg,2);}}

function autocomp(id,cats){
var old=getbyid('inp'+id).value; if(x)clearTimeout(x);
x=setTimeout(function(){autocomp_call(old,id,cats)},500);}

//keyPressEnter
function checkEnter(e,frm){var character;
	if(e && e.which){e=e; characterCode=e.which;}
	else{e=event; characterCode=e.keyCode;}
if(characterCode==13){document.forms[frm].submit(); return false;}
else return true;}

function login(id){var mail='';
var usr=document.forms[id]['user'].value;
var pass=document.forms[id]['pass'].value;
var cook=getbyid('cook').value;
if(id=='create_hub')var mail=document.forms[id]['mail'].value;
var gets='login,call_'+encUri(usr)+'_'+pass+'_'+mail+'_'+cook;
ajaxcall('valid',gets,[],'');}//self

function Close(val){
if(val=='popup' && curid){
	var pp=getbyid('popup');
	var ppa=getbyid('pop'+curid); //alert(ppa.innerHTML);
	//var ppa=pp.getElementById('pop'+curid); alert(ppa);
	if(ppa)pp.removeChild(ppa); curid=0;}
else if(val=='pop')falseClose('popup'); else if(val)falseClose(val);}
function Remove(val){var e=getbyid(val); if(e){var a=e.parentNode; if(a)a.removeChild(e);}}
function Hide(val){getbyid(val).style.display='none';}
function falseClose(val){getbyid(val).innerHTML='';}

//menus
function jumpslct(val,e){
var add=e.options[e.selectedIndex].value;
getbyid(val).value=add;}

function jumpMenu_text(val){var dn=val.split('_');//
if(dn[2]){var va=getbyid(dn[0]).value;
	if(va && va!=' '){var va=va+(dn[2]!=1?dn[2]:'')+dn[1];} else{var va=dn[1];}}
else {var va=dn[1];}
getbyid(dn[0]).value=ajx(va,1);}

function jumpval(val){var dn=val.split('_'); getbyid(dn[0]).value=dn[1];}
function jumpvalue(id,v){getbyid(id).value=ajx(v,1);}
function jumphtml(id,v){getbyid(id).innerHTML=v;}
function transvalue(id,to){var tx=getbyid(id).value; getbyid(to).value=tx;}
function transhtml(id,to){var tx=getbyid(id).innerHTML; getbyid(to).innerHTML=tx;}
function insert_value(to,id){insert_b(getbyid(id).value,to);}
function strcount(id){var ob=getbyid(id).value; var to=getbyid('strcount'); to.innerHTML=ob.length;}
function execom(d){var u=null; if(d=='createLink')u=prompt('Url'); document.execCommand(d,false,u);}
function execom2(d){document.execCommand('formatBlock',false,'<'+d+'>'); getbyid('wygs').value='no';}
