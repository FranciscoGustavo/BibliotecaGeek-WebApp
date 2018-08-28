function createDataJson(){
  var paragraphs = document.querySelectorAll(".paragraph");
  var images = document.querySelectorAll(".image");

  if (paragraphs.length > images.length) {
    var size = paragraphs.length;
  } else if (images.length > paragraphs.length) {
    size = images.length;
  } else {
    size = images.length;
  }

  var data = new Array();

  for (var i = 0; i < size; i++) {
    if (paragraphs[i] != null) {
      data[(paragraphs[i].getAttribute("id") - 1)] = {
        id: paragraphs[i].getAttribute("id"),
        type: paragraphs[i].getAttribute("data-type"),
        class: paragraphs[i].getAttribute("data-class"),
        title: paragraphs[i].querySelector("input").value,
        content: paragraphs[i].querySelector("textarea").value
      };
    }

    if (images[i] != null) {
      data[(images[i].getAttribute("id") - 1)] = {
        id: images[i].getAttribute("id"),
        type: images[i].getAttribute("data-type"),
        class: images[i].getAttribute("data-class"),
        rute: images[i].querySelector("img").getAttribute("src"),
        figcaption: images[i].querySelector("input").value,
        alt: images[i].querySelector("img").getAttribute("alt")
      };
    }
  }

  var dataJSON = JSON.stringify(data);
  console.log(dataJSON);
}

var save = document.querySelector(".btn-save");

if (save != null) {
  save.addEventListener("click", ()=>{
    /*=======================================================
      VALIDAR LOS DATOS DEL ARTICULO
    =======================================================*/
    var expression = /^[a-z-0-9]*$/;
    var url = document.querySelector(".inputURL");
    var description = document.querySelector(".taDescription");
    var imgaheCover = document.querySelector("#cover");
    var titleArticle = document.querySelector(".article-title input");

    /*=======================================================
      VALIDAR LA URL
    =======================================================*/
    if (url.value != "" ) {
      if (!expression.test(url.value)) {
        alert("No se permiten caracteres especiales Mayusculas o numeros");
        return false;
      }
    } else {
      alert("La url no puede ir vacia");
      return false;
    }

    /*=======================================================
      VALIDAR LA DESCRIPCIÓN
    =======================================================*/
    if (description.value != "") {
      if (description.value.length > 300) {
        alert("No puede escribir mas de 300 caracteres");
        return false;
      }
      expression = /^[a-zA-ZZñÑáéíóúÁÉÍÓÚ¿?¡! 0-9]*$/;
      if (!expression.test(description.value)) {
        alert("No se permiten caracteres especiales como $%&/()");
        return false;
      }
    } else {
      alert("La descripcion no puede ir vacia");
      return false;
    }

    /*=======================================================
      VALIDAR EL COVER
    =======================================================*/
    if (imgaheCover.files[0] == null) {
      alert("Debes agregar una imagen al cover");
      return false;
    }

    if (titleArticle.value != "") {
      expression = /^[a-zA-ZZñÑáéíóúÁÉÍÓÚ¿?¡! 0-9]*$/;
      if (!expression.test(titleArticle.value)) {
        alert("No se permiten caracteres especiales como $%&/()");
        return false;
      }
    } else {
      alert("El titulo no puede ir vacio");
      return false;
    }

    console.log(url.value);
    console.log(description.value);
    console.log(imgaheCover.files[0]);
    console.log(titleArticle.value);

    createDataJson();
  });
}
