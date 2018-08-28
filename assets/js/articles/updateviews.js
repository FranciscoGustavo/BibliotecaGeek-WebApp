/*=======================================================
  ACTUALIZA LAS VISTAS DE CADA ARTICULO
=======================================================*/
class UpdateView {
  constructor(Selector) {
    this.view = document.querySelector(Selector);
    if (this.view != null) {
      this.number = parseInt(this.view.innerHTML) + 1;
      this.READY_STATE_COMPLETE = 4;
      this.OK = 200;
      this.xhr = this.objectAjax();
      this.dataChange();
      this.executeAjax();
    }
  }

  dataChange(){
    this.url = location.pathname;
    this.rute = this.url.split("/");

    this.data = "item=views&value=" + this.number + "&rute=" + this.rute.pop();
  }

  autoInt(){
    this.view.innerHTML = this.number;
  }

  getViewNumber(){
    return this.view.innerHTML;
  }

  objectAjax(){
    if(window.XMLHttpRequest)	{
      return new XMLHttpRequest();

    }	else if(window.ActiveXObject)	{
      return new ActiveXObject("Microsoft.XMLHTTP");
    }
  }

  executeAjax(){
    this.xhr.onreadystatechange = () => {
      if (this.xhr.readyState == 4) {
        if (this.xhr.status == 200) {
          this.autoInt();
        } else {
        }
      }
    }
    this.xhr.open("POST", home + "ajax/article.ajax.php");
    this.xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    this.xhr.send(this.data);
  }
}
