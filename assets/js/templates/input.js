/*=============================================
	INPUT MATERIAL DESING
=============================================*/
class InputMD {
	constructor(selector){
		this.input = document.querySelectorAll(selector);
		this.bindEvents();
	}

	bindEvents(){
		for (let value of this.input) {
			value.addEventListener("keyup",()=>{
			 	if (value.value == "") return value.classList.remove("non-empty");
				value.classList.add("non-empty");
			});
		}
	}
}
