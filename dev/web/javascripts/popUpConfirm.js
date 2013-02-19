function popUpConfirm(url, mensaje)   
{
var r=confirm(mensaje);
if (r==true)
  {
  location.href=url
  }
}