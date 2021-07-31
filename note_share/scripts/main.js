function listNotes(page, search, id, mode)
{
  let xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function()
  {
    if (this.readyState == 4 && this.status == 200)
    {
      document.getElementById("notes").innerHTML = this.responseText;
      if (page == 'favorites')
      {
        if (mode == 'Like')
        {
          like    = 'Liked';
          dislike = 'Dislike';
        }
        else if (mode == 'Dislike')
        {
          dislike = 'Disliked';
          like    = 'Like';
        }
        else
        {
          dislike = 'Dislike';
          like    = 'Like';
        }
        document.getElementById("note" + id).style.border = "#fff solid 8px";
        document.getElementById("option" + id).innerHTML = '\
        <div id="favorites">\
          <a id="' + like + '" href="javascript:favorites(\'' + like + '\', ' + id + ', \'' + search + '\');">' + like + '</a>\
          <a id="' + dislike + '" href="javascript:favorites(\'' + dislike + '\', ' + id + ', \'' + search + '\');">' + dislike + '</a>\
        </div>\
        <a class="view" href="#frame">Preview</a>';
      }
    }
  };
  let sort = document.getElementsByClassName("sort-btn-on")[0].value;
  xmlhttp.open("GET", "includes/browse-notes.inc.php?search=" + search + "&page=" + page + "&sort=" + sort);
  xmlhttp.send();
}

function sortNotes(sort, search, page)
{
  let recent = document.getElementById("sort-recent");
  let old = document.getElementById("sort-old");
  let likes = document.getElementById("sort-likes");
  let dislikes = document.getElementById("sort-dislikes");
  let rated = document.getElementById("sort-rated");
  switch (sort){
    case '1':
      recent.setAttribute("class", "sort-btn-on");
      old.setAttribute("class", "sort-btn");
      likes.setAttribute("class", "sort-btn");
      dislikes.setAttribute("class", "sort-btn");
      rated.setAttribute("class", "sort-btn");
      break;
    case '2':
      recent.setAttribute("class", "sort-btn");
      old.setAttribute("class", "sort-btn-on");
      likes.setAttribute("class", "sort-btn");
      dislikes.setAttribute("class", "sort-btn");
      rated.setAttribute("class", "sort-btn");
      break;
    case '3':
      recent.setAttribute("class", "sort-btn");
      old.setAttribute("class", "sort-btn");
      likes.setAttribute("class", "sort-btn-on");
      dislikes.setAttribute("class", "sort-btn");
      rated.setAttribute("class", "sort-btn");
      break;
    case '4':
      recent.setAttribute("class", "sort-btn");
      old.setAttribute("class", "sort-btn");
      likes.setAttribute("class", "sort-btn");
      dislikes.setAttribute("class", "sort-btn-on");
      rated.setAttribute("class", "sort-btn");
      break;
    case '5':
      recent.setAttribute("class", "sort-btn");
      old.setAttribute("class", "sort-btn");
      likes.setAttribute("class", "sort-btn");
      dislikes.setAttribute("class", "sort-btn");
      rated.setAttribute("class", "sort-btn-on");
  }
  let xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function()
  {
    if (this.readyState == 4 && this.status == 200)
    {
      document.getElementById("notes").innerHTML = this.responseText;
    }
  };
  xmlhttp.open("GET", "includes/browse-notes.inc.php?search=" + search +"&page=" + page + "&sort=" + sort);
  xmlhttp.send();
}

function favorites(mode, id, search)
{
  let xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function()
  {
    if (this.readyState == 4 && this.status == 200)
    {
      listNotes('favorites', search, id, mode);
    }
  };
  xmlhttp.open("GET", "includes/favorites.inc.php?mode=" + mode + '&id=' + id + '&search=' + search);
  xmlhttp.send();
}

var id = ['0'];
function showNote(note, page, login, likedIds, dislikedIds, search)
{
  // Displays a white border around the clicked note box
  id.push(note.split('-')[0]);
  let noteBox = document.getElementById("note" + id[1]);
  let options = document.getElementById("option" + id[1]);
  noteBox.style.border = "#fff solid 8px";

  // Displays options for the selected note box
  if (login == '')
    options.innerHTML = '\
    <div id="favorites">\
      <a href="login.php?login=favorites">Like</a>\
      <a href="login.php?login=favorites">Dislike</a>\
    </div>\
    <a class="view" href="#frame">Preview</a>';
  else if (page == 'mynotes')
  options.innerHTML = '\
  <div>\
    <a href="#" onclick="modifyNotes(\'change\', \'' + note + '\');">Change</a>\
    <a href="#" onclick="modifyNotes(\'delete\', \'' + note + '\');">Delete</a>\
  </div>\
  <a class="view" href="#frame">Preview</a>';
  else
  {
    if (likedIds != '') 
    {
      likedIds = likedIds.split('-');
      if (likedIds.indexOf(id[1]) != -1) like = 'Liked';
      else                               like = 'Like';
    }
    else
      like = 'Like';
      
    if (dislikedIds != '')
    {
      dislikedIds = dislikedIds.split('-');
      if (dislikedIds.indexOf(id[1]) != -1) dislike = 'Disliked';
      else                                  dislike = 'Dislike';
    }
    else
      dislike = 'Dislike';

    options.innerHTML = '\
    <div id="favorites">\
      <a id="' + like + '" href="javascript:favorites(\'' + like + '\', ' + id[1] + ', \'' + search + '\');">' + like + '</a>\
      <a id="' + dislike + '" href="javascript:favorites(\'' + dislike + '\', ' + id[1] + ', \'' + search + '\');">' + dislike + '</a>\
    </div>\
    <a class="view" href="#frame">Preview</a>';
  }

  // Removes previous selection when another note box is selected
  if (id[0] != '0' && id[0] != id[1] && document.getElementById("note" + id[0]) != null)
  {
    document.getElementById("note" + id[0]).style.border = "none";
    document.getElementById("option" + id[0]).innerHTML = '';
  }
  id.shift();

  // Updates the modify form when a new note box is selected
  if      (document.getElementById("change-form") != null) modifyNotes('change', note);
  else if (document.getElementById("delete-form") != null) modifyNotes('delete', note);

  // Displays the pdf of the selected note box
  let xmlhttp = new XMLHttpRequest();
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

function modifyNotes(mode, note)
{
  let modify = document.getElementById("modify-notes");
  let id = note.split(/[-.]/)[0];
    note = note.split(/[-.]/)[1];

  if (mode == 'change')
  {
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function()
    {
      if (this.readyState == 4 && this.status == 200)
      {
        modify.innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET", "includes/change.inc.php?id=" + id);
    xmlhttp.send();
  }
  else if (mode == 'delete')
  {
    modify.innerHTML = '\
    <form id="delete-form" action="includes/delete.inc.php?id=' + id + '" method="post">\
      <h2>Delete Notes</h2>\
      <p style="font-size: 1.3em">Are you sure you want to delete <strong>' + note + '</strong>?</p>\
      <div>\
        <input class="a-btn" type="submit" name="answer" value="No" />\
        <input class="a-btn" type="submit" name="answer" value="Yes" />\
      </div>\
    </form>';
  }
}

function showContactInfo()
{
  document.getElementById("contact").innerHTML = '\
  <h3>Damon Teichroeb</h3>\
  <a href="mailto:damon.teich@outlook.com">damon.teich@outlook.com</a>\
  <address>250 Brent Lane<br>Pensacola, FL 32503-2267<br>#1755</address>';
}