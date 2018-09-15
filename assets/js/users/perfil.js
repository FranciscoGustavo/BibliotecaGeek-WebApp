btnFavoritesProfile = document.querySelector(".btnfavoritesprofile");
btnoCmmentsprofile = document.querySelector(".btncommentsprofile");
contentFavorites = document.querySelector(".dinamic-content .content-favorites");
contentComments = document.querySelector(".dinamic-content .content-comments");

if (btnFavoritesProfile != null && btnoCmmentsprofile != null) {

  /*=======================================================
    TRAE LOS ARTICULOS GUARDADOS COMO FAVORITOS
  =======================================================*/
  btnFavoritesProfile.addEventListener("click",()=>{

    if (btnFavoritesProfile.getAttribute("data-status") == "wait") {


      data = "loadFavorites=true&userId="+btnFavoritesProfile.getAttribute("data-user");

      if(window.XMLHttpRequest)	{
        xhr = new XMLHttpRequest();
      }	else if(window.ActiveXObject)	{
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
      }

      xhr.onreadystatechange = () => {
        if (xhr.readyState == 4) {
          if (xhr.status == 200) {
            btnFavoritesProfile.setAttribute("data-status","ok");
            favorites = JSON.parse(xhr.responseText);
            contentComments.classList.add("none");
            contentFavorites.classList.add("flex");
            insertFavorites(favorites);
          }
        }
      }

      xhr.open("POST", home + "ajax/user.ajax.php");
      xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
      xhr.send(data);
    } else {
      contentFavorites.classList.add("flex");
      contentFavorites.classList.remove("none");

      contentComments.classList.remove("flex");
      contentComments.classList.add("none");
    }
  });

  /*=======================================================
    TRAE LOS COMENTARIOS QUE EL USUARIO A REALIZADO
  =======================================================*/
  btnoCmmentsprofile.addEventListener("click",()=>{
    if (btnoCmmentsprofile.getAttribute("data-status") == "wait") {
      data = "loadComments=true&userId="+btnFavoritesProfile.getAttribute("data-user");

      if(window.XMLHttpRequest)	{
        xhr = new XMLHttpRequest();
      }	else if(window.ActiveXObject)	{
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
      }

      xhr.onreadystatechange = () => {
        if (xhr.readyState == 4) {
          if (xhr.status == 200) {
            btnoCmmentsprofile.setAttribute("data-status","ok");
            comments = JSON.parse(xhr.responseText);
            insertComments(comments);
            console.log(xhr.responseText);
          }
        }
      }

      xhr.open("POST", home + "ajax/user.ajax.php");
      xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
      xhr.send(data);

    } else {
      contentFavorites.classList.add("none");
      contentFavorites.classList.remove("flex");

      contentComments.classList.remove("none");
      contentComments.classList.add("flex");
    }
  });
}

function insertComments(data){

  contentFavorites.classList.add("none");
  contentFavorites.classList.remove("flex");

  contentComments.classList.remove("none");
  contentComments.classList.add("flex");

  contentComments.innerHTML = "";

  data.forEach((item)=>{
    if (item["commentid"] != null) {
      contentComments.innerHTML += createComments(item["commentid"], item["user"], item["username"], item["photo"], item["comment"]);
    }
  });
  editCommentToFunction();
}

function createComments(commentid, user, username, photo, comment){
  element = "<div class='comment col-12 col-lg-5'>";

    element += "<div class='header-comment p_5 flex ai-center'>";

      element += "<div class='user-image'>";
        element += "<img src='"+photo+"' alt=''>";
      element += "</div>";

      element += "<div class='user-name'>";
        element += "<h5>"+username+"</h5>";
      element += "</div>";

    element += "</div>";

    element += "<div class='body-comment p_5'>";
      element += "<textarea class='comment-"+commentid+"'>"+comment+"</textarea>";
      element += "<input type='hidden' name='' value='"+comment+"'>";
      element += "<p>"+comment+"</p>";
    element += "</div>";

    element += "<div class='footer-comment p_5 flex jc-flex-end'>";

      element += "<div class='container-buttons'>";

        element += "<button id='"+commentid+"' class='btn-edit-comment' type='button'>";
          element += "<i class='fas fa-edit'></i>";
        element += "</button>";

        element += "<button class='btn-delete-comment' type='button'>";
          element += "<i class='fas fa-trash'></i>";
        element += "</button>";

      element += "</div>";

    element += "</div>";

  element += "<div>";
  return element;
}




function insertFavorites(data){
  contentFavorites.classList.add("flex");
  contentFavorites.classList.remove("none");

  contentComments.classList.remove("flex");
  contentComments.classList.add("none");

  contentFavorites.innerHTML = "";

  data.forEach((item)=>{
    if (item["name"] != null) {
      contentFavorites.innerHTML += createArticleFavorite(item["url"], item["image"], item["title"], item["name"], item["time"]);
    }
  });
}

function createArticleFavorite(url, image, title, name, time){
  element = "<div class='col-12 col-xmd-6 col-md-4'>";
    element += "<article class='article-card m-auto'>";

      element += "<div class='article information'>";
        element += "<a href='"+url+"'>";

          element += "<div class='image-container'>";
            element += "<img src='"+dashboard+image+"' alt=''>";
          element += "</div>";

          element += "<div class='article-title p_5'>";
            element += "<h3>"+title+"</h3>";
          element += "</div>";

        element += "</a>";
      element += "</div>";

      element += "<div class='outhor flex jc-sp-between p_5'>";

        element += "<a href='#'>";
          element += "<span>"+name+"</span>";
        element += "</a>";

        element += "<a href='#'>";
          element += "<span>"+time+"</span>";
        element += "</a>";

        element += "</div>";

    element += "</article>";
  element += "</div>";
  return element;
}
