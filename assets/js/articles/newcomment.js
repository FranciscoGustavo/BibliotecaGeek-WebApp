var btnComment = document.querySelector("#btncomment");

var articleId = document.querySelector("#articleid");
var userIdComment = document.querySelector("#useridcomment");
var usename = document.querySelector("#usename");
var comment = document.querySelector("#comment");
var photo = document.querySelector("#photo");

var commentForm = document.querySelector(".comment-form");

if (btnComment != null) {
  btnComment.addEventListener("click", (event)=>{
    event.preventDefault();

    var data = "articleId=" + articleId.value + "&userId=" + userIdComment.value + "&comment=" + comment.value;

    if(window.XMLHttpRequest)	{
      var xhr = new XMLHttpRequest();
    }	else if(window.ActiveXObject)	{
      var xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xhr.onreadystatechange = () => {
      if (xhr.readyState == 4) {
        if (xhr.status == 200) {
          if (xhr.responseText == "OK") {
            insertComment();
          } else if (xhr.responseText == "characters") {
            alert("No se permiten caracteres especiales");
          }
        }
      }
    }
    xhr.open("POST", home + "ajax/article.ajax.php");
    xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    xhr.send(data);
  });
}

function insertComment(){
  var element = "<div class='comment'>";

    element += "<div class='header-comment p_5 flex ai-center'>";

      element += "<div class='user-image'>";
        element += "<img src='" + photo.value + "' alt=''>";
      element += "</div>";

      element += "<div class='user-name'>";
        element += "<h5>" + usename.value + "</h5>";
      element += "</div>";

    element +="</div>";
    element += "<div class='body-comment p_5'>";
      element += comment.value
    element += "</div>";
  element += "</div>";

  commentForm.insertAdjacentHTML("afterend", element);
  comment.value = "";
}
