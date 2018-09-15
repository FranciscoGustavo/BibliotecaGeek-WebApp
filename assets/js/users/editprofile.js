class User {
  constructor() {
    // Inicializar botones
    this.btnEdit = document.querySelector(".btn-edit-profile.edit");
    this.btnSave = document.querySelector(".btn-edit-profile.save")

    this.info = document.querySelector(".info");
    this.infoEdit = document.querySelector(".info-edit");
    this.btnPhoto = document.querySelector(".btn-photo");
    this.inputPhoto = document.querySelector(".inputPhoto");

    if (this.btnEdit != null) this.bindEvents();
  }

  bindEvents(){
    //Cambia los tipos de datos
    this.btnEdit.addEventListener("click",(e)=>{
      this.info.classList.toggle("none");
      this.infoEdit.classList.toggle("none");
      this.btnPhoto.classList.toggle("none");
    });

    this.btnSave.addEventListener("click",(e)=>{
      this.info.classList.toggle("none");
      this.infoEdit.classList.toggle("none");
      this.btnPhoto.classList.toggle("none");
    });

    this.btnPhoto.addEventListener("click",()=>{
      this.inputPhoto.click();
    });

    this.inputPhoto.addEventListener("change", (e)=>{
      let imagePhoto = e.target.files[0];
      let preview = document.querySelector(".photo img");
      this.validateImage(imagePhoto, e.target, preview);
    });
  }

  validateImage (image, input, preview){

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
}

function sendAjax(data){

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

}


function Elements (elements) {
  this._elements = elements || null;
  this._items;

  this.createElements = function(elements = this._elements){

    if (elements == null) return false;

    this._items = elements.map((element)=>{

      // Crear elemento
      if (element.elementType == null) return false;
      let item = document.createElement(element.elementType);

      // Añadiendo Id
      if (element.id != null) {
        item.idName = element.id;
      }

      // Añadiendo Class
      if (element.clasName != null) {
        item.className = element.clasName;
      }

      // Añadiendo Name
      if (element.attrName != null) {
        item.setAttribute("name",element.attrName);
      }

      // Añadiendo Tipo
      if (element.attrType != null) {
        item.setAttribute("type",element.attrType);
      }

      // Añadiendo Text
      if (element.text != null) {
        item.textContent = element.text;
      }

      // Añadiendo HTML
      if (element.html != null) {
        item.innerHTML = element.html;
      }

      return item;
    });

    console.log(this._items);
  }

  this.insertElements = function(content, types = this._items){
    for (item of types) {
      content.appendChild(item);
    }
  }

  this.removeElements = function(types = this._items){
    for (item of types) {
      item.remove(item);
    }
  }


}

new User();
