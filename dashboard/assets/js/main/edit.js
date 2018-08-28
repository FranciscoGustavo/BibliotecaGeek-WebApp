/*=======================================================
  AFREGAR NUEVO ITEM (IMAGEN O TEXTO)
=======================================================*/
class NewItem {
  constructor(type) {
    this.paragraphs = document.querySelectorAll(".paragraph").length;
    this.images = document.querySelectorAll(".image").length;
    this.idItem = this.paragraphs + this.images + 1;
    if (type == "pharagraph") {
      this.element = this.createItemText();

    } else if (type == "image") {
      this.element = this.createItemImage();

    }

    this.lastItem = document.querySelector(".new-item");

    this.lastItem.insertAdjacentHTML("beforeBegin", this.element);
/*
    if (type == "pharagraph") {
      new ValidateItem(this.idItem, "paragraph");

    } else if (type == "image") {
      new ValidateItem(this.idItem, "image");
    }*/

  }

  createItemText(){
    this.item = '<div id="' + this.idItem + '" class="paragraph p-1" data-type="paragraph" data-class="top-p-none">';
      this.item += '<div class="delete" onclick="deleteItem('+ this.idItem +', \'paragraph\')">';
        this.item += '<i class="fas fa-trash-alt"></i>';
      this.item += '</div>';
      this.item += '<div class="paragraph-title">';
        this.item += '<h4>';
          this.item += '<input type="text" name="" value="" placeholder="Introduce un titulo">';
        this.item += '</h4>';
      this.item += '</div>';
      this.item += '<div class="paragraph-content">';
        this.item += '<p>';
          this.item += '<textarea placeholder="Escribe tu texto">';
          this.item += '</textarea>';
        this.item += '</p>';
      this.item += '</div>';
    this.item += '</div>';
    return this.item;
  }

  createItemImage(){
    this.item = "<div class='image p-1' id='" + this.idItem + "' data-type='image' data-class=''>";
      this.item += '<div class="delete" onclick="deleteItem('+ this.idItem +', \'image\')">';
        this.item += '<i class="fas fa-trash-alt"></i>';
      this.item += '</div>';
      this.item += "<figure>";
        this.item += "<img src='" + dashboard + "assets/images/articlesimage/default.jpg' alt=''>";
        this.item += "<figcaption>";
          this.item += "<input type='text' name='' value='' placeholder='Nombre del autor de la imagen'>";
        this.item += "</figcaption>";
      this.item += "</figure>";
    this.item += "</div>";
    return this.item;
  }
}

var newImage = document.querySelector(".new-image");
var newText = document.querySelector(".new-text");

if (newImage != null && newText != null) {
  newText.addEventListener("click", ()=>{
    new NewItem("pharagraph");
  });

  newImage.addEventListener("click", ()=>{
    new NewItem("image");
  });
}

/*=======================================================
  ELIMINAR ITEM
=======================================================*/
function deleteItem(id, dataType) {
  var item;
  document.querySelectorAll("."+dataType).forEach((element)=>{
    if (element.getAttribute("id") == id) {
      item = element;
    }
  });
  console.log(item);

  var paragraph = document.querySelectorAll(".paragraph");
  var image = document.querySelectorAll(".image");

  var totalItems = paragraph.length + image.length;

  console.log(totalItems);

  paragraph.forEach((element)=>{
    if (element.getAttribute("id") > id) {
      element.setAttribute("id", (element.getAttribute("id") - 1));
      element.querySelector(".delete").setAttribute("onclick","deleteItem(" + element.getAttribute("id") + ", 'paragraph')")
      console.log(element);
    }
  });

  image.forEach((element)=>{
    if (element.getAttribute("id") > id) {
      element.setAttribute("id", (element.getAttribute("id") - 1));
      element.querySelector(".delete").setAttribute("onclick","deleteItem(" + element.getAttribute("id") + ", 'image')")
      console.log(element);
    }
  });

  item.remove()
}

/*=======================================================
  VALIDAR ITEM
=======================================================*/
class ValidateItem {
  constructor(id, selector) {
    this.item;
    this.findItem(id, selector);
    console.log(this.item);
  }

  findItem(id, selector){
    document.querySelectorAll("." + selector).forEach((element)=>{
      if (element.getAttribute("id") == id) {
        this.item = element;
      }
    });
  }

}


/*=======================================================
  CREAR URL A PARTIR DEL TITULO
=======================================================*/
var inputTitle = document.querySelector(".inputTitle");
var inputURL = document.querySelector(".inputURL");

inputTitle.addEventListener("change", ()=>{
  var str = inputTitle.value;
  var expression = /^[a-zA-ZZñÑáéíóúÁÉÍÓÚ 0-9]*$/;

  if(expression.test(str)){
    for (var i = 0; i < inputTitle.value.length; i++) {
      str = str.replace(" ", "-");
      str = str.replace("ñ", "n");
      str = str.replace("Ñ", "N");
      str = str.replace("á", "a");
      str = str.replace("é", "e");
      str = str.replace("í", "i");
      str = str.replace("ó", "o");
      str = str.replace("ú", "u");
      str = str.replace("Á", "A");
      str = str.replace("É", "E");
      str = str.replace("Í", "I");
      str = str.replace("Ó", "O");
      str = str.replace("Ú", "U");
    }
    inputURL.value = str.toLowerCase();
  } else {
    alert("No se permiten caracteres especiales");
  }
});

/*=======================================================
  IMAGEN DE PORTADA
=======================================================*/
var inputCover = document.querySelector("#cover");
inputCover.addEventListener("change",()=>{
  console.log("HOLA");

  var imageCover = inputCover.files[0];
  console.log(imageCover);
  preview = document.querySelector(".cover-img");
  validateImage(imageCover,cover, preview);
});


/*=======================================================
  VALIDA LAS IMAGENES
=======================================================*/
function validateImage (image, input, preview){

  if(image["type"] != "image/jpeg" && image["type"] != "image/png"){

    input.val = "";

    var title = "Error al subir la imagen";
    var message = "¡La imagen debe estar en formato JPG o PNG!";
    var button = "Aceptar";
    var type = "warning";

    /*new AlertModal(title, message, button, type, ()=>{
      window.location = home + "perfil";
    });*/
  } else if(Number(image["size"]) > 2000000){

    input.val = "";

    var title = "Error al subir la imagen";
    var message = "¡La imagen no debe pesar más de 2 MB!";
    var button = "Cerrar";
    var type = "error";

    /*new AlertModal(title, message, button, type, ()=>{
      window.location = home + "perfil";
    });*/
  } else {

    var dataImage = new FileReader;
    dataImage.readAsDataURL(image);

    dataImage.addEventListener("load", (event)=>{

      var ruteImage = event.target.result;
      preview.setAttribute("src", ruteImage);

    });

  }
}

/*=======================================================
  CONTAR CARACTERES EN LA DESCRIPCÓN
=======================================================*/
var txtDescription = document.querySelector(".taDescription");

if (txtDescription != null){
  var countCharter = document.querySelector(".count-charter");
  txtDescription.addEventListener("keyup",(event)=>{
    if (txtDescription.value.length > 300) {
      txtDescription.setAttribute("disabled", true);
      alert("No puede escribir mas de 300 caracteres");
    } else {
      number = 300 - txtDescription.value.length;
      countCharter.innerHTML = number;
    }
  });
}
