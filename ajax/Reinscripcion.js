function Reinscripcion(url, instancia) {
    this.url = url;
    this.instancia = instancia;
    var grupo;
    var servicios;
    var observaciones;
    var total_pagar;

    this.init = function () {
        this.grupo = $('#REgrupo').val();
        this.observaciones = $('#DescBaja').val();
    }
    
    this.setServicios = function(servicios){
        this.servicios = servicios;
    }

}