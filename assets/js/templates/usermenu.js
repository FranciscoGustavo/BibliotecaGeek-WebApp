/*=============================================
	MENU DE USUARIO
=============================================*/
class MenuUser {
	constructor(selector, btnSelector) {
		this.btnMenuUser = document.querySelectorAll(btnSelector);
		this.menuUser = document.querySelector(selector);
		if (this.menuUser != null) {
			this.bindEvents();
		}
	}

	bindEvents(){
    this.btnMenuUser.forEach((element) => {
      element.addEventListener("click", ()=>{
  			this.menuUser.classList.toggle("active");
  		});
    });
	}

}
