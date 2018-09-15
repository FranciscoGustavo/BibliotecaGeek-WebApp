/*=============================================
	MUESTRA LA VENTANA MODAL
=============================================*/
class WindowModal {
  constructor(selector, btnSelector, callback) {

    this.windowModal = document.querySelector(selector);
    this.body = document.querySelector("body");

    this.btnWindowModal = document.querySelector(btnSelector);
    this.btnCloseModal = document.querySelector(selector + " .closeModal");

    callback();

    if (this.btnWindowModal != null) {
      this.bindEvents();
    }
  }

  bindEvents(){
    this.btnWindowModal.addEventListener("click", (event)=>{
      event.preventDefault();
      this.windowModal.classList.add("active");

    });

    this.btnCloseModal.addEventListener("click", ()=>{
    	this.windowModal.classList.remove("active");
    });
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
    if (this.btnChange != null) {
      this.bindEvents();
    }
  }

  bindEvents(){
    this.btnChange.addEventListener("click",(event)=>{
      event.preventDefault();
      this.windowModal.querySelector(".closeModal").click();
      this.newModal.click();
    });
  }
}
