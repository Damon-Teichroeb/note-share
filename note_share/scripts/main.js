function showNotes(search)
{
  if (search.length == 0)
  {
    document.getElementById("note-hint").innerHTML = "";
  }
  else
  {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function()
    {
      if (this.readyState == 4 && this.status == 200)
      {
        document.getElementById("note-hint").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET", "includes/search.inc.php?search=" + search, true);
    xmlhttp.send();
  }
}

function showContactInfo()
{
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function()
  {
    if (this.readyState == 4 && this.status == 200)
    {
      document.getElementById("contact-us").innerHTML = this.responseText;
    }
  };
  xmlhttp.open("GET", "includes/contact-us.inc.html");
  xmlhttp.send();
}