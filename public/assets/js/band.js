var get = getCookie("acceptCookies");
if (get !== "true") {
   document.getElementById("cookie").style.visibility="visible";  
}
var bottom=document.getElementById("valided");

bottom.onclick= setCookie;

function setCookie()
{
    document.getElementById("cookie").style.visibility = "hidden";
    document.cookie="acceptCookies=true";
}
function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(";");
    for(var i = 0; i <ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) == " ") {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
  }
  
