/*=======================================================
  MEMU INTERACTIVO EN DISPOSITIVOS MOBILES
=======================================================*/
class OpenMenu {
  constructor(btnSelector, selector) {
    this.btnMenu = document.querySelector(btnSelector);
    this.Menu = document.querySelector(selector);
    if (this.Menu != null && this.btnMenu != null) {
      this.bindEvents();
    }
  }

  bindEvents(){
    this.btnMenu.addEventListener("click", ()=>{
      this.Menu.classList.toggle("active");
    });
  }

}
