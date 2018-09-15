
class AlertModal {
  constructor(txtTitle, txtMessage, txtButton, type, callback) {
    /* INICIALIZAMOS LOS MODULOS DONDE SE INSERTARAN LOS DATOS */
    this.type = type;
    this.alert = document.querySelector(".alert");
    this.closed = this.alert.querySelector(".closeModal");
    this.image = this.alert.querySelector(".image-status .container-circle");
    this.title = this.alert.querySelector(".message-title");
    this.message = this.alert.querySelector(".message");
    this.button = this.alert.querySelector(".actions-buttons");

    this.insertData(txtTitle, txtMessage, txtButton);
    this.showAlertModal(callback);
    this.bindEvents();
  }

  bindEvents(){
    this.closed.addEventListener("click", ()=>{
      this.alert.parentNode.classList.remove("active");
    });
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
    this.alert.parentNode.classList.add("active");
    this.alert.classList.add(this.type);

    this.button.querySelector("button").addEventListener("click",()=>{
      callback(this.alert);
    });
  }

}
