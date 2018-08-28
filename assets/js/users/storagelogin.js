/*=============================================
  ALMACENA LA DIRECCION ACTUAL EN EL NAVEGADOR
=============================================*/
class Storage {
	constructor(selector) {
		this.form = document.querySelector(selector);
		this.bindEvents();
	}

	bindEvents(){
		this.form.addEventListener("click",(event)=>{
			localStorage.setItem("currentRute",location.pathname);
		});
	}
}
