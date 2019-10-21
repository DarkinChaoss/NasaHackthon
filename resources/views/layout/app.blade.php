<html>
    <head>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <title>Sistema de Gestão LIFE ERP</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <style>
            #imgLogo{
              width: 100px;
              height: 100px;
            }
            #title{
              font-size: 25;
            }
            .bi{
              width:1400px;
              height:550; 
            }
            .chat{
              border:2px solid gray;
              height: 200px;
              background-color: rgb(202, 200, 200);;
            }
            .texto{
              height: 200px;
            }
            .mapaqueimada{
              width: 100%;
              height: 400px;
            }
            .box{
              display: flex;
              align-items:center;
            }
            @font-face {
              font-family: pixel;
              src: url('pixel.ttf');
            }
            #map {
              height: 500px;  /* The height is 400 pixels */
              width: 100%;  /* The width is the width of the web page */
            }
            .titleNasa{
              display: flex;
              align-items:center;
              margin-bottom: 25px;
            }
            #inputNumber{
              width: 100px;
            }
            .container {
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
}

.darker {
  border-color: #ccc;
  background-color: #ddd;
}

.container::after {
  content: "";
  clear: both;
  display: table;
}

.container img {
  float: left;
  max-width: 60px;
  width: 100%;
  margin-right: 20px;
  border-radius: 50%;
}

.container img.right {
  float: right;
  margin-left: 20px;
  margin-right:0;
}

.time-right {
  float: right;
  color: #aaa;
}

.time-left {
  float: left;
  color: #999;
}

        
        </style>
    </head>
<body> 
<nav class="navbar navbar-light bg-light">

<a class="navbar-brand logo">
        <div class="box">	
        <img id="imgLogo" src="{{ asset('imagens/fire.png')}}" alt="">
        <h1 id="title">Spot that fire V.2.0</h1>
    </div>
</a>
<a class="nav-link" >API</a>
<a class="nav-link" href="#">Talk to Amazchan</a>
<a class="nav-link" href="#">Information</a>
<form class="form-inline">
    <input class="form-control mr-sm-2" type="search" placeholder="Pesquisar" aria-label="Pesquisar">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
</form>
</nav>

    <div class="titleNasa">	
            <img id="imgLogo" src="{{ asset('imagens/nasaLogo.png')}}" alt="">
            <h1 class="titleNasa">N.A.S.A Data base Burning Points</h1>
    </div>
    <div class="box">
      <form class="form-inline">
        <h3>Filtrar Por data: </h3>
        &nbsp;
        <input type="date" class="form-control" id="dataFiltro" placeholder="Data de vencimento">
        &nbsp;
        <button class="btn btn-outline-warning my-2 my-sm-0" id="filtrarData" type="submit">Filtrar</button>
      </form>
      &nbsp;
      &nbsp;
      &nbsp;
      <form class="form-inline">
        <h3>Filtrar Por Dia ou noite: </h3>
        &nbsp;
        <select class="form-control" id="selectDay" >
            <option value="D" selected>Dia</option>
            <option value="N">Noite</option>
        </select>    
        &nbsp;
        <button class="btn btn-outline-success my-2 my-sm-0" id="btndia" type="submit">Filtrar</button>
      </form>
      &nbsp;
      &nbsp;
      &nbsp;
      <form class="form-inline">
          <h3>Restringir Focos: </h3>
          &nbsp;
          <input type="number" class="form-control" id="inputlimit" placeholder="">
          &nbsp;
          <button class="btn btn-outline-primary my-2 my-sm-0" id="restringir" type="submit">Filtrar</button>
        </form>
    </div>
   <div id="map"></div>

   
    <footer class="page-footer font-small blue pt-4">
      <div class="container-fluid text-center text-md-left">
        <div class="row linhafooter">
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

    <div class="modal fade" id="ModalChat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Nova mensagem</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="chatMessage">
'                <div class="container">
                    <img src="/w3images/bandmember.jpg" alt="Avatar" style="width:100%;">
                    <p>Hello. How are you today?</p>
                    <span class="time-right">11:00</span>
                  </div>
                  
                  <div class="container darker">
                    <img src="/w3images/avatar_g2.jpg" alt="Avatar" class="right" style="width:100%;">
                    <p>Hey! I'm fine. Thanks for asking!</p>
                    <span class="time-left">11:01</span>
                  </div>
                </div>                
                <div class="form-group">
                  <label for="message-text" id='conteudoMensagem' class="col-form-label">Mensagem:</label>
                  <textarea class="form-control" id="message-text"></textarea>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
              <button type="button"  id="btnNewMessage"class="btn btn-primary">Enviar Mensagem</button>
            </div>
          </div>
        </div>
      </div>

  <script src="{{ asset('js/app.js')}}" type="text/javascript"></script>

	<script>
		// Initialize and add the map
		function initMap() {

         $.ajax({
            type: 'GET', //THIS NEEDS TO BE GET
            url: 'http://127.0.0.1:8000/api/getdados',
            success: function (data) {
                var obj = JSON.parse(data);
                // The map, centered at Uluru

                var map = new google.maps.Map(
                  document.getElementById('map'), {zoom: 5,mapTypeId: 'terrain', center: {lat: -3.2664, lng: -43.50275} });
                // The marker, positioned at Uluru
                var icons = {
                  fire: {
                    icon: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRtNi6jiiCevLtnaEZdRmAkIhJA8yhrzAQ5Rr9mk2Jvx3BSVz4DuQ'
                  }
                };


                for(var k in obj) {
                  var cordenadas = {lat: parseFloat(obj[k]['altitude']), lng: parseFloat(obj[k]['longitude'])}
                  var marker = new google.maps.Marker({position: cordenadas, icon: "{{ asset('imagens/fireIcon.png')}}", map: map});
                }
            },
            error: function() { 
                console.log(data);
            }
        });

		  // The location of Uluru
		  
    }

    $('a').click( function(e) {
      e.preventDefault();
      $('#ModalChat').modal('show');
      return false; 
    });

    $('#dataFiltro').click( function(e) {
      e.preventDefault();
      data = $('#dataFiltro').val()
      $.ajax({
            type: 'GET', //THIS NEEDS TO BE GET
            url: 'http://127.0.0.1:8000/api/dados/data/'+data,
            success: function (data) {
                var obj = JSON.parse(data);
                // The map, centered at Uluru

                var map = new google.maps.Map(
                  document.getElementById('map'), {zoom: 5,mapTypeId: 'terrain', center: {lat: -3.2664, lng: -43.50275} });
                // The marker, positioned at Uluru
                var icons = {
                  fire: {
                    icon: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRtNi6jiiCevLtnaEZdRmAkIhJA8yhrzAQ5Rr9mk2Jvx3BSVz4DuQ'
                  }
                };


                for(var k in obj) {
                  var cordenadas = {lat: parseFloat(obj[k]['altitude']), lng: parseFloat(obj[k]['longitude'])}
                  var marker = new google.maps.Marker({position: cordenadas, icon: "{{ asset('imagens/fireIcon.png')}}", map: map});
                }
            },
            error: function() { 
                console.log(data);
            }
        });
    });

    $('#btndia').click( function(e) {
      e.preventDefault();
      data =  $("#selectDay option:selected").val();
      $.ajax({
            type: 'GET', //THIS NEEDS TO BE GET
            url: 'http://127.0.0.1:8000/api/dados/dianoite/'+data,
            success: function (data) {
                var obj = JSON.parse(data);
                // The map, centered at Uluru

                var map = new google.maps.Map(
                  document.getElementById('map'), {zoom: 5,mapTypeId: 'terrain', center: {lat: -3.2664, lng: -43.50275} });
                // The marker, positioned at Uluru
                var icons = {
                  fire: {
                    icon: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRtNi6jiiCevLtnaEZdRmAkIhJA8yhrzAQ5Rr9mk2Jvx3BSVz4DuQ'
                  }
                };


                for(var k in obj) {
                  var cordenadas = {lat: parseFloat(obj[k]['altitude']), lng: parseFloat(obj[k]['longitude'])}
                  var marker = new google.maps.Marker({position: cordenadas, icon: "{{ asset('imagens/fireIcon.png')}}", map: map});
                }
            },
            error: function() { 
                console.log(data);
            }
        });
    });

    $('#restringir').click( function(e) {
      e.preventDefault();
      data =  $("#inputlimit").val();
      $.ajax({
            type: 'GET', //THIS NEEDS TO BE GET
            url: 'http://127.0.0.1:8000/api/dados/getlimit/'+data,
            success: function (data) {
                var obj = JSON.parse(data);
                // The map, centered at Uluru

                var map = new google.maps.Map(
                  document.getElementById('map'), {zoom: 5,mapTypeId: 'terrain', center: {lat: -3.2664, lng: -43.50275} });
                // The marker, positioned at Uluru
                var icons = {
                  fire: {
                    icon: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRtNi6jiiCevLtnaEZdRmAkIhJA8yhrzAQ5Rr9mk2Jvx3BSVz4DuQ'
                  }
                };


                for(var k in obj) {
                  var cordenadas = {lat: parseFloat(obj[k]['altitude']), lng: parseFloat(obj[k]['longitude'])}
                  var marker = new google.maps.Marker({position: cordenadas, icon: "{{ asset('imagens/fireIcon.png')}}", map: map});
                }
            },
            error: function() { 
                console.log(data);
            }
        });
    });

    $('#btndia').click( function(e) {
      e.preventDefault();
      data =  $("#selectDay option:selected").val();
      $.ajax({
            type: 'GET', //THIS NEEDS TO BE GET
            url: 'http://127.0.0.1:8000/api/dados/dianoite/'+data,
            success: function (data) {
                var obj = JSON.parse(data);
                // The map, centered at Uluru

                var map = new google.maps.Map(
                  document.getElementById('map'), {zoom: 5,mapTypeId: 'terrain', center: {lat: -3.2664, lng: -43.50275} });
                // The marker, positioned at Uluru
                var icons = {
                  fire: {
                    icon: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRtNi6jiiCevLtnaEZdRmAkIhJA8yhrzAQ5Rr9mk2Jvx3BSVz4DuQ'
                  }
                };


                for(var k in obj) {
                  var cordenadas = {lat: parseFloat(obj[k]['altitude']), lng: parseFloat(obj[k]['longitude'])}
                  var marker = new google.maps.Marker({position: cordenadas, icon: "{{ asset('imagens/fireIcon.png')}}", map: map});
                }
            },
            error: function() { 
                console.log(data);
            }
        });
    });


      
  
	</script>
	<script async defer
		src="https://maps.googleapis.com/maps/api/js?key=KEY&callback=initMap">
    </script>
</body>
</html>
