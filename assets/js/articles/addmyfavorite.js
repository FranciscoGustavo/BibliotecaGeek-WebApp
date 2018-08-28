class AddMyFavorite {
  constructor(selector) {
    this.addmyfavorite = document.querySelector(selector);
    this.articleid = document.querySelector("#articleid");
    this.userid = document.querySelector("#userid");
    this.favorite = document.querySelector("#favorite");
    this.data = "";
    this.xhr = this.objectAjax();

    if (this.addmyfavorite != null) {
      this.bindEvents();
    }
  }

  bindEvents(){
    this.addmyfavorite.addEventListener("click", (event)=>{
      this.data = "favorite=" + this.favorite.value + "&userid=" + this.userid.value + "&articleid=" + this.articleid.value;
      event.preventDefault();
      this.executeAjax();
    });
  }

  objectAjax(){
    if(window.XMLHttpRequest)	{
      return new XMLHttpRequest();

    }	else if(window.ActiveXObject)	{
      return new ActiveXObject("Microsoft.XMLHTTP");
    }
  }

  executeAjax(){
    this.xhr.onreadystatechange = () => {
      if (this.xhr.readyState == 4) {
        if (this.xhr.status == 200) {
          console.log(this.xhr.responseText);
          if (this.xhr.responseText == "OK") {
            this.addmyfavorite.querySelector("i").classList.add("isfavorite");
            this.favorite.value = 1;
          } else {
            this.addmyfavorite.querySelector("i").classList.remove("isfavorite");
            this.favorite.value = 0;
          }
        } else {
        }
      }
    }
    this.xhr.open("POST", home + "ajax/article.ajax.php");
    this.xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    this.xhr.send(this.data);
  }

}
