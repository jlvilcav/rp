var dominio = document.domain;
var urlBase = "http://"+ dominio+ "/rp/repAtencion.php";

$(document).ready(function(){

	//alert(urlBase);
   $("#dtDesde1").datetimepicker({
        
    });

    $("#dtHasta2").datetimepicker({
        
    });
});

$(document).on('ready', function(){
	$("#formFiltro").on('submit', function(event){
		
		event.preventDefault();
		
	});

	$("#btnBuscar").on('click', function(){
		var listar = new listadoTickets();
		listar.listaTicket();
	});
});

function listadoTickets(){
	var $el = $("<div>");
	$el.url = urlBase + '?action=listar';

	$el.on('noListo', function(){
		alert('No se listo correctamente')

	});

	$el.listaTicket = function(){
		var pdesde = $("#dtDesde").val();
		var pHasta = $("#dtHasta").val();
		var pAgente = $("#agente").val();
	}
}