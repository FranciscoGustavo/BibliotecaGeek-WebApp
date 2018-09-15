/*=============================================
	VALIDA EL FORMULARIO
=============================================*/
class ValidateForm {
	constructor(selector, errorsSelector) {
		this.READY_STATE_COMPLETE = 4;
		this.OK = 200;
		this.xhr = this.objectAjax();
		this.data = "";
		this.ajax;

		this.form = document.querySelector(selector);
		this.errors = document.querySelector(errorsSelector);

		this.expression = null;

		if (this.form != null) {
			this.inputs = this.form.querySelectorAll("input");
			this.bindEvents();
		}
	}

	bindEvents(){
		/*=============================================
			VALIDA EL FORMULARIO DE REGISTRO
		=============================================*/
		this.form.addEventListener("submit",(event)=>{
			event.preventDefault();

			/*=============================================
				VALIDA EL NOMBRE DE USUARIO
			=============================================*/
			if (this.form.logupUsername != null) {
				if (this.form.logupUsername.value != "") {

					this.expression = /^[a-zA-ZñÑáéíóúÁÉÍÓÚ0-9 ]*$/;

					if(!this.expression.test(this.form.logupUsername.value)){
						this.showErrors("warning", "No se permiten números ni caracteres especiales");
						return false;

					}

				} else {
					this.showErrors("error", "Ningun campo puede ir vacio");
					return false;
				}
			}

			/*=============================================
				VALIDA EL CORREO ELECTRONICO
			=============================================*/
			if (this.form.logupEmail.value != "") {

				this.expression = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;

				if(!this.expression.test(this.form.logupEmail.value)){

					this.showErrors("warning", "Ingrese un correo valido");
					return false;

				}

				if (!this.ajax) {
					this.showErrors("error", "Este correo ya fue registrado");
					return false;
				}

			} else {
				this.showErrors("error","Ningun campo puede ir vacio");
				return false;
			}


			/*=============================================
				VALIDAR CONTRASEÑA
			=============================================*/
			if(this.form.logupPassword.value != ""){
				if(this.form.logupPassword.value.length >= 8){

					this.expression = /^[a-zA-Z0-9]*$/;
					if(!this.expression.test(this.form.logupPassword.value)){
						this.showErrors("warning", "No se permiten caracteress especiales");
						return false;
					}

				} else {
					this.showErrors("warning","La contraseña debe tener minimo, 8 caracteres");
					return false;
				}

			} else {
				this.showErrors("error","Ningun campo puede ir vacio");
				return false;
			}

			/*=============================================
				VALIDA TERMINOS DE USUARIO
			=============================================*/
			if (this.form.logupUserTerms != null) {

				if(!this.form.logupUserTerms.checked){
					this.showErrors("error", "Debes aceptar los terminos de usuario");
					return false;
				}

			}

			this.form.submit();

		});

		/*=============================================
			LIMPIA TODOS LOS ERRORES
		=============================================*/
		this.inputs.forEach((input)=>{
			input.addEventListener("focus", ()=>{
				this.errors.classList.remove("active");
				this.errors.innerHTML = "";
			});
		});

		/*=============================================
			BUSCA QUE EL CORREO NO ESTE REGISTRADO
		=============================================*/
		this.form.logupEmail.addEventListener("change",()=>{

			this.data = "logupEmail="+this.form.logupEmail.value;
			this.xhr.onreadystatechange = () => {
				if (this.xhr.readyState == this.READY_STATE_COMPLETE) {
					if (this.xhr.status == this.OK) {
						if (this.xhr.responseText != "true") {
							this.showErrors("error", this.xhr.responseText);
							this.ajax = false;
						} else {
							this.ajax = true;
						}
					}
				}
			}
			this.xhr.open("POST", home + "ajax/user.ajax.php");
			this.xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			this.xhr.send(this.data);
			return this.ajax;

		});
	}

	showErrors(type, message){
		this.errors.classList.add("active");
		this.errors.innerHTML = "<div class=" + type + ">" + message + "</div>";
	}

	objectAjax(){
		if(window.XMLHttpRequest)	{
			return new XMLHttpRequest();

		}	else if(window.ActiveXObject)	{
			return new ActiveXObject("Microsoft.XMLHTTP");
		}
	}

}
