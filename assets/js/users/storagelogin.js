/*=============================================
  ALMACENA LA DIRECCION ACTUAL EN EL NAVEGADOR
=============================================*/
class Storage {
	constructor(selector) {
		this.form = document.querySelector(selector);
		
		if (this.form != null) {
			this.bindEvents();
		}
	}

	bindEvents(){
		this.form.addEventListener("click",(event)=>{
			localStorage.setItem("currentRute",location.pathname);
		});
	}
}
