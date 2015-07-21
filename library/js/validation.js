var marked_row=new Array;function clearerror()
{return true;}
window.onerror=clearerror;function numbersonly(e){var unicode=e.charCode?e.charCode:e.keyCode
if(unicode!=8){if(unicode<48||unicode>57)
return false}}
function nameonly(e){var unicode=e.charCode?e.charCode:e.keyCode;if(unicode!=8){if((unicode>=48&&unicode<=57)||(unicode>=65&&unicode<=90)||(unicode>=97&&unicode<=122)||unicode==32)
return true
else
return false}}
function resetJS()
{if(document.getElementById('sp_err')){var t=document.getElementById('sp_err');t.parentNode.removeChild(t);}}
function selectDeselect(field,isCheck)
{var boxes=document.getElementsByName(field);var boxes_checked=anyChecked();if(isCheck)
{if(document.getElementsByName(isCheck)[0].checked)setChecks(true);else setChecks(false);}
else
{if(!boxes_checked)setChecks(true);else setChecks(false);}
function setChecks(setting)
{for(var j=0;j<boxes.length;j++)
{boxes[j].checked=setting;theObjects=document.getElementsByTagName("tr");if(setting==true)
{for(var i=0;i<theObjects.length;i++)
{if(theObjects[i].id.indexOf('_')!=-1)
{theObjects[i].className='over';}}}
else
{for(var i=0;i<theObjects.length;i++)
{if(theObjects[i].id.indexOf('0_')!=-1)
{theObjects[i].className='evenTr';}
else if(theObjects[i].id.indexOf('1_')!=-1)
{theObjects[i].className='oddTr';}}}}}
function anyChecked()
{for(var i=0;i<boxes.length;i++)
{if(boxes[i].checked==true)
{return(true);}}
return(false);}}
function checkany(field,message)
{var boxes=document.getElementsByName(field);var bol=anyChecked(boxes);if(bol==false){alert(message);return true;}
else
return false;}
function anyChecked(boxes)
{for(var i=0;i<boxes.length;i++){if(boxes[i].checked==true){return(true);}}
return(false);}
function isNull(aStr)
{var index;for(index=0;index<aStr.length;index++)
if(aStr.charAt(index)!=' ')
return false;return true;}
function isEmail(aStr)
{var reEmail=/^[0-9a-zA-Z_\.-]+\@[0-9a-zA-Z_\.-]+\.[0-9a-zA-Z_\.-]+$/;if(!reEmail.test(aStr)){return false;}
return true;}
function countChars(str)
{var reg=new RegExp("[\f\n\r\v]*","g");str=str.replace(reg,"");return str.length;}
function isNum(aStr)
{var reNum=/^[0-9.]+$/;if(!reNum.test(aStr)){return false;}
return true;}
function chknewslatter()
{if(!isEmail(document.subscription.email_add.value)){alert("Please enter valid Email Address.");document.subscription.email_add.focus();return(false);}
return(true);}
function isAlphaNumaric(aStr){var reNum=/^[0-9.a-zA-Z_-]+$/;if(!reNum.test(aStr)){return false;}
return true;}
function isZip(str){if(str.indexOf("-",0)>0)var t=/^\d{5}-\d{4}$/
else var t=/^\d{5}$/
return t.test(str)}
function isURL(argvalue){if(argvalue.indexOf(" ")!=-1)
return false;else if(argvalue.indexOf("http://")==-1||argvalue.indexOf("https://")==-1)
return false;else if(argvalue=="http://")
return false;else if(argvalue.indexOf("http://")>0||argvalue.indexOf("https://")>0)
return false;argvalue=argvalue.substring(7,argvalue.length);if(argvalue.indexOf(".")==-1)
return false;else if(argvalue.indexOf(".")==0)
return false;else if(argvalue.charAt(argvalue.length-1)==".")
return false;if(argvalue.indexOf("/")!=-1){argvalue=argvalue.substring(0,argvalue.indexOf("/"));if(argvalue.charAt(argvalue.length-1)==".")
return false;}
if(argvalue.indexOf(":")!=-1){if(argvalue.indexOf(":")==(argvalue.length-1))
return false;else if(argvalue.charAt(argvalue.indexOf(":")+1)==".")
return false;argvalue=argvalue.substring(0,argvalue.indexOf(":"));if(argvalue.charAt(argvalue.length-1)==".")
return false;}
return true;}
function isValidDate(dateStr){var datePat=/^(\d{1,2})(\/|-)(\d{1,2})\2(\d{2}|\d{4})$/;var matchArray=dateStr.match(datePat);if(matchArray==null){alert("Date is not in a valid format.")
return true;}
month=matchArray[1];day=matchArray[3];year=matchArray[4];if(month<1||month>12){alert("Month must be between 1 and 12.");return true;}
if(day<1||day>31){alert("Day must be between 1 and 31.");return true;}
if((month==4||month==6||month==9||month==11)&&day==31){alert("Month "+month+" doesn't have 31 days!")
return true}
if(month==2){var isleap=(year%4==0&&(year%100!=0||year%400==0));if(day>29||(day==29&&!isleap)){alert("February "+year+" doesn't have "+day+" days!");return true;}}
return false;}
function invalidLength(field,message,intMin,intMax)
{if(countChars(field.value)<intMin||countChars(field.value)>intMax){addMessage(field,message+intMin+" to "+intMax);return true;}
return false;}
function blankField(field,message)
{var html=field.value;var stripped=html.replace(/(<([^>]+)>)/ig,"");var stripped=stripped.replace(/[#$%?\\*\\&^!@|']/ig,"");if(isNull(leftTrim(stripped))||leftTrim(stripped)=="")
{var inputId=field;addMessage(field,message);return true;}
return false;}
function delConfiram()
{if(checkany('delete[]','Please select atleast one record to delete.'))
return false;else if(confirm('Are you sure you want to delete the selected record(s)?'))
return true;else
return false;}
function selectall()
{selectDeselect('delete[]','sel_del');}
function validateFrm(tmpVar)
{with(tmpVar)
{for(i=0;i<elements.length;++i)
{field=elements[i];var strMsg,strArgvalue;myString=new String(field.name);if(myString.substring(0,3)=='md_')
{var strMessage='';strArgvalue=myString.substring(3,myString.length);strMsg=strArgvalue.replace(/_/g,' ');if(field.type=='select-one'){strMessage='Required field can not be left blank.';}
else if(field.type=='file'){strMessage='Required field can not be left blank.';}if(field.name.indexOf("date")!=-1){strMessage='Required field can not be left blank.';}
else{strMessage='Required field can not be left blank.';}
if(blankField(field,strMessage)){return false;}
if(field.type=='file'&&field.name=="db_csvfile")
{if(isCSV(field,'Please browse only CSV file.'))
{return false;}}}
if(field.type=='file'&&field.name.indexOf("image")!=-1)
{if(invalidFileFormat(field,'Please browse only gif, png and jpg.'))
{return false;}}
if(field.name.indexOf("email")!=-1&&field.value!="")
{if(invalidEmail(field,'Plaese enter valid email format.'))
{return false;}}
if(field.name.indexOf("phone")!=-1&&field.value!="")
{if(checkInternationalPhone(field,'Plaese enter valid phone number'))
{return false;}}
if(field.name.indexOf("chk_terms")!=-1&&field.checked==false)
{addMessageCMS(field,'Please check terms & conditions');return false;}}}
return true;}
function addMessage_BC(field1,message)
{var str=field1.parentNode.innerHTML;var field=field1;alert(message);field.focus();}
function addMessage(field1,message)
{if(alert_type==0)
{alert(message);field1.focus();}
else
{var str=field1.parentNode.innerHTML;var field=field1;var pnode=field1.parentNode;if(document.getElementById('sp_err'))
{var t=document.getElementById('sp_err');t.parentNode.removeChild(t);}
var div=document.createElement("div");div.setAttribute('id','sp_err');div.innerHTML="<span style='color:#FF0000;font-family:verdana;font-size:11px;font-weight:bold;padding-top:10px;'>"+message+"</span>";field1.parentNode.appendChild(div);field.focus();}}
function addMessageCMS(field1,message)
{alert(message);}
function blankCMS(field,message)
{var html=field.value;var stripped=html.replace(/(<([^>]+)>)/ig,"");if(isNull(LTrim(stripped))){addMessageCMS(field,message);return true;}
string=validCMS(stripped);if(leftTrim(string)==""){addMessageCMS(field,message);return true;}
return false;}
function invalidEmail(field,message)
{if(isEmail1(field.value)==false)
{addMessage(field,message);field.focus();return true;}
else if(isEmail1(field.value)==3)
{alert(VALID_CHAR_EMAIL);field.focus();return true;}
return false;}
function equalField(field1,field2,message)
{if(field1.value!=field2.value){addMessage(field2,message);return true;}
return false;}
function dateCompare(field1,field2,message)
{d1=new Date(field1.value);d2=new Date(field2.value);if(d1>d2){addMessage(field2,message);return true;}
return false;}
function invalidDate(field1,field2,field3)
{if(isValidDate(field1.value+"/"+field2.value+"/"+field3.value)==false){addMessage(field1,message);return true;}}
function invalidEmailList(field,message)
{var b=field.value;var temp=new Array();temp=b.split(',');for(var i=0;i<temp.length;i++)
{if(!isEmail(temp[i])){alert(message);field.focus();return true;}}
return false;}
function invalidAvailableUsername(field,message)
{if(isNull(field.value)){alert(message);field.focus();return true;}
return false;}
function invalidUrl(field,message)
{if(!isVUrl(field.value)){addMessage(field,message);return true;}}
function invalidNumber(field,message)
{if(!isNum(field.value)){addMessage(field,message);return true;}}
function invalidAlphaNumaric(field,message)
{if(!isAlphaNumaric(field.value)){addMessage(field,message);return true;}}
function invalidFileFormat(field,message)
{if(field.value!=""){myString=new String(field.value);start=myString.lastIndexOf(".");argvalue=myString.substring(start,myString.length);if(argvalue.toLowerCase()!=".gif"&&argvalue.toLowerCase()!=".png"&&argvalue.toLowerCase()!=".jpg"&&argvalue.toLowerCase()!=".jpeg"){addMessage(field,message);return true;}}}
function isCSV(field,message)
{if(field.value!=""){myString=new String(field.value);start=myString.lastIndexOf(".");argvalue=myString.substring(start,myString.length);if(argvalue.toLowerCase()!=".csv"){addMessage(field,message);return true;}}}
function ISPDF(field,message)
{myString=new String(field.value);start=myString.lastIndexOf(".");argvalue=myString.substring(start+1,myString.length);if(argvalue.toLowerCase()!="pdf"){addMessage(field,message);return true;}}
function ISCSV(field,message)
{myString=new String(field.value);start=myString.lastIndexOf(".");argvalue=myString.substring(myString.length-3,myString.length);if(argvalue.toLowerCase()!="xls"){addMessage(field,message);return true;}}
function ISDOC(field,message)
{if(field.value!=""){myString=new String(field.value);start=myString.lastIndexOf(".");argvalue=myString.substring(start,myString.length);if(argvalue.toLowerCase()!="doc"){addMessage(field,message);return true;}}}
function ISFLV(field,message)
{if(field.value!=""){myString=new String(field.value);start=myString.lastIndexOf(".");argvalue=myString.substring(start,myString.length);if(argvalue.toLowerCase()!=".flv"){addMessage(field,message);return false;}}}
function IsFile(field,message,extension)
{if(field.value!=""){myString=new String(field.value);start=myString.lastIndexOf(".");argvalue=myString.substring(start,myString.length);if(argvalue.toLowerCase()!="xml"){addMessage(field,message);return true;}}}
function invalidFromToZip(field1,field2)
{if((isNum(field1.value)&!isNum(field2.value))|(!isNum(field1.value)&isNum(field2.value))){alert(AI_FROMTOZIPCODE);if(isNum(field1.value))
field2.focus();else
field1.focus();return true;}}
function isEmail1(field)
{var atPosition,dotPosition,lastPosition;var c=field.charAt(0);aPosition=field.indexOf("@");dotPosition=field.lastIndexOf(".");lastPosition=field.length-1;if(aPosition<1||dotPosition-aPosition<2||lastPosition-dotPosition>6||lastPosition-dotPosition<2){return(false);}
return(true);}
function compareDates(start_field,end_field,message)
{var start=new Date(start_field.value);var end=new Date(end_field.value);if(start>end){addMessage(end_field,message);return true;}
else{return false;}}
function comparePass(oldVal,newVal,message)
{if(oldVal.value==newVal.value){addMessage(newVal,message);return true;}
return false;}
var digits="0123456789";var phoneNumberDelimiters="()- ";var validWorldPhoneChars=phoneNumberDelimiters+"+"+".";var minDigitsInIPhoneNumber=10;function isInteger(s)
{var i;for(i=0;i<s.length;i++)
{var c=s.charAt(i);if(((c<"0")||(c>"9")))return false;}
return true;}
function stripCharsInBag(s,bag)
{var i;var returnString="";for(i=0;i<s.length;i++)
{var c=s.charAt(i);if(bag.indexOf(c)==-1)returnString+=c;}
return returnString;}
function checkInternationalPhone(field,message){strPhone=field.value;s=stripCharsInBag(strPhone,validWorldPhoneChars);bol=(isInteger(s)&&s.length>=minDigitsInIPhoneNumber);if(bol==false)
{addMessage(field,message);return true;}
else
{return false;}}
function isVUrl(s)
{var regexp=/(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/
return regexp.test(s);}
function validCMS(s)
{str=s.replace(/(&nbsp;)/ig,"");return str;}
function frm_submit(tmp)
{tmp.submit();}
function form_sub(tmp)
{document.headerfrm.page.value=tmp;document.headerfrm.submit();}
function leftTrim(sString)
{while(sString.substring(0,1)==' '||sString.substring(0,1)=="\n"||sString.substring(0,1)=="\r"||sString.substring(0,1)=="\t")
{sString=sString.substring(1,sString.length);}
return sString;}
function LTrim(value){var re=/\s*((\S+\s*)*)/;return value.replace(re,"$1");}
function RTrim(value)
{var re=/((\s*\S+)*)\s*/;return value.replace(re,"$1");}
function trim(value)
{return LTrim(RTrim(value));}
function check_fileSize(field,tmpW)
{var img=new Image();img.src=field.value;var wid=img.width;var hit=img.height;if(wid>tmpW){alert("Banner image width should not be greater than "+tmpW+"");return true;}
return false;}
function setCss(id,ch,css,pre)
{if(ch.checked==true)
{document.getElementById(pre+"_"+id).className='over';}
else
{document.getElementsByName('sel_del').checked=false;document.getElementById(pre+"_"+id).className=css;}}
function check_chars(id,char,field)
{var len=field.value.length;var string=field.value;if(len<char||len==char)
document.getElementById(id).innerHTML=eval(char-len);else
{field.value=string.substring(0,250);id.innerHTML=0;}}
function MM_swapImgRestore(){var i,x,a=document.MM_sr;for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++)x.src=x.oSrc;}
function MM_preloadImages(){var d=document;if(d.images){if(!d.MM_p)d.MM_p=new Array();var i,j=d.MM_p.length,a=MM_preloadImages.arguments;for(i=0;i<a.length;i++)
if(a[i].indexOf("#")!=0){d.MM_p[j]=new Image;d.MM_p[j++].src=a[i];}}}
function MM_findObj(n,d){var p,i,x;if(!d)d=document;if((p=n.indexOf("?"))>0&&parent.frames.length){d=parent.frames[n.substring(p+1)].document;n=n.substring(0,p);}
if(!(x=d[n])&&d.all)x=d.all[n];for(i=0;!x&&i<d.forms.length;i++)x=d.forms[i][n];for(i=0;!x&&d.layers&&i<d.layers.length;i++)x=MM_findObj(n,d.layers[i].document);if(!x&&d.getElementById)x=d.getElementById(n);return x;}
function MM_swapImage(){var i,j=0,x,a=MM_swapImage.arguments;document.MM_sr=new Array;for(i=0;i<(a.length-2);i+=3)
if((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x;if(!x.oSrc)x.oSrc=x.src;x.src=a[i+2];}}
function filesize(field)
{var control=new ActiveXObject("Scripting.FileSystemObject");var d=field;var e=control.GetFile(d);var f=e.size;alert(f+" bytes");}