
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="shortcut icon" href="images/icon.png" />

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Marcopolo Transport</title>
<link rel="stylesheet" type="text/css" href="./style1.css">
    <link href="themes/1/tooltip.css" rel="stylesheet" type="text/css" />
    <script src="themes/1/tooltip.js" type="text/javascript"></script>
<script language="javascript">
function verif()
{

 if (document.form.jour.value==-1)
{
alert("veuillez entrer le jour SVP!");
document.form.jour.focus();
return false;
}
 if (document.form.mois.value==-1)
{
alert("veuillez entrer le mois SVP!");
document.form.mois.focus();
return false;
}
 if (document.form.annee.value==-1)
{
alert("veuillez entrer l'année SVP!");
document.form.annee.focus();
return false;
}
j=document.form.jour.value;
m=document.form.mois.value;
a=document.form.annee.value;
date2=a+"-"+m+"-"+j;
document.form.date2.value=date2;
 
 
 if (document.form.jour1.value==-1)
{
alert("veuillez entrer le jour SVP!");
document.form.jour1.focus();
return false;
}
 if (document.form.mois1.value==-1)
{
alert("veuillez entrer le mois SVP!");
document.form.mois1.focus();
return false;
}
 if (document.form.annee1.value==-1)
{
alert("veuillez entrer l'année SVP!");
document.form.annee1.focus();
return false;
}
j2=document.form.jour1.value;
m2=document.form.mois1.value;
a2=document.form.annee1.value;
date1=a2+"-"+m2+"-"+j2;
document.form.date1.value=date1;
}
</script>
<style type="text/css">
<!--
.roue{
background-image:url(images/img11.png);
 width:560px;
  height:285px;
  padding:20px;
}
.a{

color:#ccc;
text-shadow:0 -1px 0 black;
}
.a:hover, .a:focus{
background:rgba(0,0,0,.4);
box-shadow:0 1px 0 rgba(255,255,255,.4);
}
.a span{
position:absolute;
margin-top:23px;
margin-left:-35px;
color: #FFFFFF;
background: #009900;
padding:15px;
border-radius:3px;
box-shadow:0 0 2px rgba(0,0,0,.5);
transform: scale(0) rotate(-12deg);
transition:all .25s;
opacity:0;
}

.a:hover span, .a:focus span{
transform:scale(1) rotate (0);
opacity:1;

}

.aa{

color:#ccc;
text-shadow:0 -1px 0 black;
}
.aa:hover, .aa:focus{
background:rgba(0,0,0,.4);
box-shadow:0 1px 0 rgba(255,255,255,.4);
}
.aa span{
position:absolute;
margin-top:23px;
margin-left:-35px;
color: #FFFFFF;
background: #CC0000;
padding:15px;
border-radius:3px;
box-shadow:0 0 2px rgba(0,0,0,.5);
transform: scale(0) rotate(-12deg);
transition:all .25s;
opacity:0;
}

.aa:hover span, .aa:focus span{
transform:scale(1) rotate (0);
opacity:1;

}


caption {
font-family:sans-serif;
}

.Style1 {
	font-size: 18px;
	font-weight: bold;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
.Style8 {color: #FF0066; font-weight: bold; font-size: 18px; font-family: Verdana, Arial, Helvetica, sans-serif; }
.Style7 {color: #FF0066; font-weight: bold; font-size: 12px; font-family: Verdana, Arial, Helvetica, sans-serif; }
-->
</style>
</head>

<body>
<div class="divbanniere">
<img src="photos/marcopolotravel.png" width="170">
</div>
 <a href="#" class="a">
 <span>Roue  Michelin en bon état</span>
 <img src="images/rouebonetat.png" width="23" style="position:relative; padding-bottom:0px; padding-right:0;" align="top" /> </a>
<div class="roue">
 
 <table>
 <tr>
 <td width="120"> </td>
 <td width="180"><span class="Style7"><font color='#333333'> 27000 km</font></span>
 <br><font size="2" color='#333333' style=" font-family:Verdana, Arial, Helvetica, sans-serif;">Michelin f | <a href="#" class="a">
 <span>Roue  Michelin en bon état</span>
 <img src="images/rouebonetat.png" width="23" style="position:relative; padding-bottom:0px; padding-right:0;" align="top" /> </a></font> 
 </td>
 <td width="200"><span class="Style7"><font color='#333333'> 27000 km</font></span>
 <br><font size="2" color='#333333' style=" font-family:Verdana, Arial, Helvetica, sans-serif;">Michelin f | <a href="#" class="aa">
 <span><img src="photos/amine.png"></span>
 <img src="images/rouemauvaisetat.png" width="23" style="position:relative; padding-bottom:0px; padding-right:0;" align="top" /> </a></font> 
 
 </td>
 <td width="100"></td>
 </tr>
 </table>
 </div>
 
 <span class="tooltip" onmouseover="tooltip.pop(this, '<h3>Lorem ipsum</h3><img src='photos/amine.png'  width='100' >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum in consequat neque, eget tempor ipsum. ')">amine</span>
 
 <a class="tooltip" href="#demo2_tip" onmouseover="tooltip.pop(this, '#demo2_tip')">Hover me</a>
        <div style="display:none;">
            <div id="demo2_tip">
               <img src="photos/amine.png"  width="100" >
                <b>SEO</b><br /><br />
                The tooltip content comes from an element on the page. So this approach is <strong>Search Engine Friendly</strong>.
            </div>
        </div>
        
<a class="tooltip" href="#demo2_tip" onmouseover="tooltip.pop(this, '#demo2_tip')">Hover me</a>
        <div style="display:none;">
            <div id="demo2_tip">
               <img src="images/welcome.png"  width="100" >
                <b>SEO</b><br /><br />
                The tooltip content comes from an element on the page. So this approach is <strong>Search Engine Friendly</strong>.
            </div>
        </div>

