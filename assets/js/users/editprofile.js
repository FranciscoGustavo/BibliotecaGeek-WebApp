/*=============================================
  EDITAR PERFIL
=============================================*/
class BtnEditPorfile {
  constructor(selector) {
    this.btnCoverPage = document.querySelector(".btn-edit-portada");
    this.btnImage = document.querySelector(".btn-edit-image");

    this.username = document.querySelector(".info-username");
    this.email = document.querySelector(".info-email");
    this.password = document.querySelector(".info-password");

    this.btn = document.querySelector(selector);
    this.btnSave = document.querySelector("#saveprofile");
    if (this.btn != null) {
      this.bindEvents();
    }
  }

  bindEvents(){
    this.btn.addEventListener("click", (event)=>{
      event.preventDefault();
      this.changeBtnImage()
      this.changeTitles();
      this.changeInputs();
      this.changeBtn();
    });

  }

  changeBtnImage(){
    this.btnCoverPage.classList.remove("disable");
    this.btnImage.classList.remove("disable");
    this.btnCoverPage.classList.add("active");
    this.btnImage.classList.add("active");
  }

  changeInputs(){
    this.username.querySelector("input").classList.add("active");
    this.email.querySelector("input").classList.add("active");
    this.password.classList.add("active");

    this.username.querySelector("input").classList.remove("disable");
    this.email.querySelector("input").classList.remove("disable");
    this.password.classList.remove("disable");
  }

  changeTitles(){
    this.username.querySelector("h4").classList.add("disable");
    this.email.querySelector("h4").classList.add("disable");
    this.username.querySelector("h4").classList.remove("active");
    this.email.querySelector("h4").classList.remove("active");
  }

  changeBtn(){
    this.btn.classList.remove("active");
    this.btn.classList.add("disable");

    this.btnSave.classList.remove("disable");
    this.btnSave.classList.add("active");
  }
}


var cover = document.querySelector('#editcover');
var image = document.querySelector('#editimage');

if (cover != null) {
  cover.addEventListener("change",()=>{
    var imageCover = cover.files[0];
    preview = document.querySelector(".portada-image");
    validateImage(imageCover,cover, preview);
  });
}

if (image != null) {
  image.addEventListener("change",()=>{
    var imagePhoto = image.files[0];
    console.log("Imagen", imagePhoto);
    preview = document.querySelector(".user-image-tab");
    validateImage(imagePhoto,image, preview);
  });
}


function validateImage (image, input, preview){

  if(image["type"] != "image/jpeg" && image["type"] != "image/png"){

    input.val = "";

    var title = "Error al subir la imagen";
    var message = "¡La imagen debe estar en formato JPG o PNG!";
    var button = "Aceptar";
    var type = "warning";

    new AlertModal(title, message, button, type, ()=>{
      window.location = home + "perfil";
    });
  } else if(Number(image["size"]) > 2000000){

    input.val = "";

    var title = "Error al subir la imagen";
    var message = "¡La imagen no debe pesar más de 2 MB!";
    var button = "Cerrar";
    var type = "error";

    new AlertModal(title, message, button, type, ()=>{
      window.location = home + "perfil";
    });
  } else {

    var dataImage = new FileReader;
    dataImage.readAsDataURL(image);

    dataImage.addEventListener("load", (event)=>{

      var ruteImage = event.target.result;
      preview.setAttribute("src", ruteImage);

    });

  }
}

var userId = document.querySelector("#hiddenuserid");
var notification = document.querySelector("#notifications");
var news = document.querySelector("#news");

if (news != null && notification != null) {
  notification.addEventListener("click", (event)=>{
    if (notification.checked) {
      value = 1;
    } else {
      value = 0;
    }

    console.log(value);

    var data = "notification=notifications&value=" + value + "&user=" + userId.value;
    if(window.XMLHttpRequest)	{
      var xhr = new XMLHttpRequest();
    }	else if(window.ActiveXObject)	{
      var xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xhr.onreadystatechange = () => {
      if (xhr.readyState == 4) {
        if (xhr.status == 200) {
          if (xhr.responseText == "ERROR") {
            if (value == 1) {
              notification.checked = false;
            }
          }
          console.log(xhr.responseText);
        }
      }
    }
    xhr.open("POST", home + "ajax/user.ajax.php");
    xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    xhr.send(data);
  });

  news.addEventListener("click", (event)=>{
    if (news.checked) {
      var value = 1;
    } else {
      var value = 0;
    }

    console.log(value);

    var data = "notification=news&value=" + value + "&user=" + userId.value;
    if(window.XMLHttpRequest)	{
      var xhr = new XMLHttpRequest();
    }	else if(window.ActiveXObject)	{
      var xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xhr.onreadystatechange = () => {
      if (xhr.readyState == 4) {
        if (xhr.status == 200) {
          if (xhr.responseText == "ERROR") {
            if (value == 1) {
              news.checked = false;
            }
          }
          console.log(xhr.responseText);
        }
      }
    }
    xhr.open("POST", home + "ajax/user.ajax.php");
    xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    xhr.send(data);
  });
}
