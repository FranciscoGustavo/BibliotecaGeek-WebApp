/*=============================================
	MUESTRA LA VENTANA MODAL
=============================================*/
class WindowModal {
  constructor(selector, btnSelector, callback) {

    this.windowModal = document.querySelector(selector);
    this.btnWindowModal = document.querySelector(btnSelector);
    this.btnCloseModal = document.querySelector(selector + " .closeModal");
    this.backShadow = document.querySelector(".background-shadow");
    this.body = document.querySelector("body");

    callback();

    if (this.btnWindowModal != null) {
      this.bindEvents();
    }
  }

  bindEvents(){
    this.btnWindowModal.addEventListener("click", (event)=>{
      event.preventDefault();
      this.windowModal.classList.add("active");
      this.showBackgroundShadow();
    });

    this.btnCloseModal.addEventListener("click", ()=>{
    	this.windowModal.classList.remove("active");
      this.hiddenBackgroundShadow();
    });
  }

  showBackgroundShadow(){
    this.backShadow.classList.add("active");
    this.body.classList.add("no-scroll");
  }

  hiddenBackgroundShadow(){
    this.backShadow.classList.remove("active");
    this.body.classList.remove("no-scroll");
  }
}

/*=============================================
	CAMBIO DE VENTANA MODAL
=============================================*/
class ChangeModal {
  constructor(btnChange, windowModal, newModal) {
    this.btnChange = document.querySelector(btnChange);
    this.windowModal = document.querySelector(windowModal);
    this.newModal = document.querySelector(newModal);
    this.bindEvents();
  }

  bindEvents(){
    this.btnChange.addEventListener("click",(event)=>{
      event.preventDefault();
      this.windowModal.querySelector(".closeModal").click();
      this.newModal.click();
    });
  }
}
