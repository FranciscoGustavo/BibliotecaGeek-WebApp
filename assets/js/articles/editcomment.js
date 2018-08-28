var btnEditComment = document.querySelectorAll(".btn-edit-comment");
var btnDelete = document.querySelectorAll(".btn-delete-comment");

if (btnEditComment != null || btnDelete != null) {

  btnEditComment.forEach((comment) => {

    comment.addEventListener("click", (event)=>{
      event.preventDefault();
        var id = comment.getAttribute("id");
        var textarea = document.querySelector(".comment-" + id);

        textarea.classList.add("active");
        textarea.parentElement.querySelector("p").classList.add("disable");
        comment.classList.add("none");
        var element = '<button class="btn-save-comment-' + id + '" onclick="saveComment(' + id + ');">Guardar</button>';
        comment.insertAdjacentHTML("afterend", element);
    });

  });

  btnDelete.forEach((deleteComment) => {

    deleteComment.addEventListener("click", (event)=>{
      var id = deleteComment.parentElement.querySelector(".btn-edit-comment").getAttribute("id");
      var data = "deleteComment=" + id;

      if(window.XMLHttpRequest)	{
        var xhr = new XMLHttpRequest();
      }	else if(window.ActiveXObject)	{
        var xhr = new ActiveXObject("Microsoft.XMLHTTP");
      }

      xhr.onreadystatechange = () => {
        if (xhr.readyState == 4) {
          if (xhr.status == 200) {
            if (xhr.responseText == "OK") {
              deleteComment.parentElement.parentElement.remove()
            }
          }
        }
      }
      xhr.open("POST", home + "ajax/article.ajax.php");
      xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
      xhr.send(data);
    });

  });

}

function saveComment(id){
  var textarea = document.querySelector(".comment-" + id);
  var btnContent = document.querySelector(".footer-comment .btn-save-comment-"+ id);
  var data = "commentId=" + id + "&commentUpdate=" + textarea.value;

  if(window.XMLHttpRequest)	{
    var xhr = new XMLHttpRequest();
  }	else if(window.ActiveXObject)	{
    var xhr = new ActiveXObject("Microsoft.XMLHTTP");
  }

  xhr.onreadystatechange = () => {
    if (xhr.readyState == 4) {
      if (xhr.status == 200) {
        console.log(xhr.responseText);
        if (xhr.responseText == "OK") {
          textarea.classList.remove("active");
          textarea.parentElement.querySelector("p").classList.remove("disable");
          textarea.parentElement.querySelector("p").innerHTML = textarea.value;
          btnContent.classList.add("none");
          btnContent.parentElement.querySelector("button:nth-child(1)").classList.remove("none");
        } else if (xhr.responseText == "characters") {
          alert("No se permiten caracteres especiales");
        }
      }
    }
  }
  xhr.open("POST","http://localhost/bibliotecageek/ajax/article.ajax.php");
  xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  xhr.send(data);
}
