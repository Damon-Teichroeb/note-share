function showContactInfo()
{
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function()
  {
    if (this.readyState == 4 && this.status == 200)
    {
      document.getElementById("contact").innerHTML = this.responseText;
    }
  };
  xmlhttp.open("GET", "includes/contact.inc.html");
  xmlhttp.send();
}

function listNotes(search)
{
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function()
  {
    if (this.readyState == 4 && this.status == 200)
    {
      document.getElementById("notes").innerHTML = this.responseText;
    }
  };
  xmlhttp.open("GET", "includes/browse-notes.inc.php?search=" + search);
  xmlhttp.send();
}

function showNote(note)
{
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function()
  {
    if (this.readyState == 4 && this.status == 200)
    {
      document.getElementById("preview-notes").innerHTML = this.responseText;
    }
  };
  xmlhttp.open("GET", "includes/preview-notes.inc.php?note=" + note);
  xmlhttp.send();
}