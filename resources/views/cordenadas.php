@extends('layout.app', ["current" => "cordenadas" ])

@section('body')

   <div id="map"></div>
    <!-- Footer -->
	<footer class="page-footer font-small blue pt-4">
		<div class="container-fluid text-center text-md-left footer">
			<div class="row">
				<div class="col-md-6 mt-md-0 mt-3">
					<h5 class="text-uppercase"></h5>
					<p id="foot">Project designed for hackathon NasaSpaceApps</p>
				</div>
			</div>
			<div class="box">
				<img id="imgLogo"src="{{ asset('imagens/capivara.png')}}" alt="">
				<h3>Curitiba 2019</h3>
			</div>
		</div>
	</footer>


	<script type="text/javascript">
		// Initialize and add the map
		function initMap() {

      $.getJSON('/api/getdados', function(data) { 
            cords = JSON.parse(data);
            console.log(cords);
        });

		  // The location of Uluru
		  var uluru = {lat: -25.344, lng: 131.036};
		  // The map, centered at Uluru
		  var map = new google.maps.Map(
			  document.getElementById('map'), {zoom: 4, center: uluru});
		  // The marker, positioned at Uluru
		  var marker = new google.maps.Marker({position: uluru, map: map});
		}
	</script>
	<script async defer
		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAQLLAm_G68rOvnxkUKYTwnh4-w30GCnQQ&callback=initMap">
    </script>

@endsection
     
     
     
@section('javascript')
<script type="text/javascript">
    
   
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        }
    });
    
    function novoReceber() {
        
        $('#dlgReceber').modal('show');
    }
    
    function carregarClientes() {
        $.getJSON('/api/clientes', function(data) { 
            for(i=0;i<data.length;i++) {
                opcao = '<option value ="' + data[i].id + '" id="i'+data[i].id+'">' + 
                    data[i].razao + '</option>';
                $('#cliente').append(opcao);
            }
        });
    }
    
    function montarLinha(r,cli) {
        if(r.baixado==1){
            r.baixado='baixado';
            var baixado= '<td class="baixado" id="' + r.id + '">'  + 'Baixado' + "</td>" ;
        }
        else{
            
            var baixado= '<td class="nbaixado" id="' + r.id + '">' +'Em aberto'+ "</td>" ;
        }
        
        var linha = "<tr>" +
            "<td>" + r.id + "</td>" +
            "<td>" + r.data_inc + "</td>" +
            "<td>" + r.data_venc + "</td>" +
            "<td>" + r.valor + "</td>" +
            "<td>" + r.observacao + "</td>" +
                 baixado+
            "<td>" + r.razao + "</td>" +
            "<td>" +
              '<button class="btn btn-sm btn-primary" onclick="editar(' + r.id + ')"> Editar </button> ' +
              '<button class="btn btn-sm btn-danger" onclick="remover(' + r.id + ')"> Apagar </button> ' +
              '<button class="btn btn-sm btn-secondary" onclick="baixar(' + r.id + ')"> Baixar </button> ' +
            "</td>" +
            "</tr>";
        return linha;
    }

    function montarLinha2(r,cli) {
        if(r.baixado==1){
            r.baixado='baixado';
            var baixado= '<td class="baixado" id="' + r.id + '">'  + 'Baixado' + "</td>" ;
        }
        else{
            
            var baixado= '<td class="nbaixado"id="' + r.id + '">'+ 'Em aberto' + "</td>" ;
        }
        
        var linha = "<tr>" +
            "<td>" + r.id + "</td>" +
            "<td>" + r.data_inc + "</td>" +
            "<td>" + r.data_venc + "</td>" +
            "<td>" + r.valor + "</td>" +
            "<td>" + r.observacao + "</td>" +
                 baixado+
            "<td>" + r.cliente_id + "</td>" +
            "<td>" +
              '<button class="btn btn-sm btn-primary" onclick="editar(' + r.id + ')"> Editar </button> ' +
              '<button class="btn btn-sm btn-danger" onclick="remover(' + r.id + ')"> Apagar </button> ' +
              '<button class="btn btn-sm btn-secondary" onclick="baixar(' + r.id + ')"> Baixar </button> ' +
            "</td>" +
            "</tr>";
        return linha;
    }


    
    function editar(id) {
        $.getJSON('/api/receber/'+id, function(data) { 
            console.log(data);
            $('#id').val(data.id);
            $('#inc').val(data.data_inc);
            $('#venc').val(data.data_venc);
            $('#valor').val(data.valor);
            $('#observacao').val(data.observacao);
            $('#baixado').val(data.baixado);
            $('#dlgReceber').modal('show');            
        });        
    }
    
    function remover(id) {
        $.ajax({
            type: "DELETE",
            url: "/api/receber/" + id,
            context: this,
            success: function() {
                console.log('Apagou OK');
                linhas = $("#tabelaReceber>tbody>tr");
                e = linhas.filter( function(i, elemento) { 
                    return elemento.cells[0].textContent == id; 
                });
                if (e)
                    e.remove();
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    function baixar(id) {
        $.ajax({
            type: "POST",
            url: "/api/receber/baixar/" + id,
            context: this,
            success: function() {

                $('#'+id+'').html('baixado');  
                $('#'+id+'').css({ backgroundColor: "#90EE90" });   

            },
            error: function(error) {
                console.log(error);
            }
        });        
    }
    
    

   
    
    function carregarReceber() {
        $.getJSON('/api/receber', function(rec,cli) { 
            for(i=0;i<rec.length;i++) {
                linha = montarLinha(rec[i],cli[i]);
                $('#tabelaReceber>tbody').append(linha);
            }
        });       
    }
    
    function criarReceber() {
        rec = { 
            inc: $("#inc").val(), 
            venc: $("#venc").val(), 
            valor: $("#valor").val(), 
            cliente:$("#cliente").val(), 
            observacao: $("#observacao").val() 
        };
       
        $.post("/api/receber", rec, function(data) {
            receber = JSON.parse(data);
            console.log(rec.cliente);
            receber.cliente_id=document.getElementById('i'+rec.cliente+'').innerHTML;
            linha = montarLinha2(receber);
            $('#tabelaReceber>tbody').append(linha);            
        });
    }

    
    $("#formReceber").submit( function(event){ 
        event.preventDefault(); 
        if ($("#id").val() != '')
            salvarReceber();
        else
            criarReceber();
            
        $("#dlgReceber").modal('hide');
    });
    
    $(function(){
        carregarClientes();
        carregarReceber();
    })

    


</script>
@endsection
     
     
     
     
     
     
     
     
     