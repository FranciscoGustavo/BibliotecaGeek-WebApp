
class AlertModal {
  constructor(txtTitle, txtMessage, txtButton, type, callback) {
    /* INICIALIZAMOS LOS MODULOS DONDE SE INSERTARAN LOS DATOS */
    this.alert = document.querySelector(".alert");
    this.image = this.alert.querySelector(".image-status .container-circle");
    this.title = this.alert.querySelector(".message-title");
    this.message = this.alert.querySelector(".message");
    this.button = this.alert.querySelector(".actions-buttons");

    this.backShadow = document.querySelector(".background-shadow");
    this.body = document.querySelector("body");

    console.log(this.image);

    this.type = type;

    this.insertData(txtTitle, txtMessage, txtButton);
    this.showAlertModal(callback);
  }

  /* SE INCERTAN LOS DATOS */
  insertData(txtTitle, txtMessage, txtButton){
    this.title.innerHTML = "<span class='font-2'>" + txtTitle + "</span>";
    this.message.innerHTML = "<p>"+ txtMessage +"</p>";
    this.button.innerHTML = "<button>" + txtButton + "</button>";

    if (this.type == "ok") {
      this.image.innerHTML = "<i class='fas fa-check'></i>";
    } else if (this.type == "error") {
      this.image.innerHTML = "<i class='fas fa-times'></i>";
    }  else if (this.type == "warning") {
      this.image.innerHTML = "<i class='fas fa-exclamation'></i>";
    }

  }
  /* MUESTRA LA ALERTA */
  showAlertModal(callback){
    this.alert.classList.add(this.type);
    this.alert.classList.add("active");

    this.showBackgroundShadow();

    this.button.querySelector("button").addEventListener("click",()=>{
      callback();
    });
  }

  showBackgroundShadow(){
    this.backShadow.classList.add("active");
    this.body.classList.add("no-scroll");
  }
}
