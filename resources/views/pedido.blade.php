@extends('layout.app', ["current" => "home"])

@section('body')

<div class="jumbotron bg-light border">
<br>
   <h1 class="title">Selecione o Produto</h1>
   <form method="get">
        <div class="input-group">
                <input class="form-control mb-2 mr-sm-2" id="produto" style="max-width:200px;" placeholder="digite o nome ou codigo do produto">
                <input class="form-control mb-2 mr-sm-2" id="qte" style="max-width:170px;" placeholder="digite a quantidade">
                <button id="BuscaProduto" class="btn btn-sm btn-primary"  data-toggle="modal" data-target="#exampleModal" type="submit"> Buscar </button>
        </div>
    </form>
   <br>
   <h3>Produtos Adicionados:</h3>
   		<table class="table table-ordered table-hover" id="tabelaClientes">
            <thead>
                <tr>
                    <th scope="col">Codigo</th>
                    <th scope="col">Descrição do serviço</th>
                    <th scope="col">Valor Unitario</th>
                    <th scope="col">Quantiade</th>
                    <th scope="col">Valor Total</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
                
            <tbody>
			</tbody>
                
        </table>
</div>
<div class="jumbotron bg-light border ">
<h3>Totalizadores do pedido</h3>
<div class="input-group">
    <h5> &ensp; Valor Total: &ensp; </h5>
    <input class="form-control" id="disabledInput" type="text" style="max-width:120px;"  disabled>
    <h5> &ensp; Desconto: &ensp; </h5>
    <input class="form-control mb-2 mr-sm-2" id="produto" style="max-width:80;">
</div>
    <br>
    
	<button class="btn btn-sm btn-primary"> Fechar Pedido </button> 
	<button class="btn btn-sm btn-danger"> Cancelar </button>
</div>

<!-- Modal para selecionar cliente-->

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pedido de Venda</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h5>Inclua as informações do pedido</h5>
            <div class="form-group">
                            <label for="cliente" class="control-label">Cliente:</label>
                            <div class="input-group">
                                <select class="form-control" id="cliente" >
                                </select>    
                            </div>
                        </div>
            </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!--Final Modal-->

@section('javascript')
<script type="text/javascript">



function montarLinha(n,id,preco,qte,valort) {
    var linha = '<tr id="'+id+'">' +
            "<td>" + id+ "</td>" +
            "<td>" + n + "</td>" +
            "<td>" + preco + "</td>" +
            "<td>" + qte + "</td>" +
            "<td>" + valort + "</td>" +
            "<td>" +
              '<button class="btn btn-sm btn-danger" type="submit" id="salvarP"> Apagar </button> ' +
            "</td>" +
            "</tr>";
        return linha;
    }

    function BuscarProduto(produto,qte) {
        $.getJSON('/api/produtos', function(produtos) { 
            for(i=0;i<produtos.length;i++) {
                if(produtos[i].nome == produto | produtos[i].id==produto ){
                    var n=produtos[i].nome;
                    var id=produtos[i].id;
                    var preco=produtos[i].preco;
                    var valort=preco*qte;
                    linha = montarLinha(n,id,preco,qte,valort);
                    $('#tabelaClientes>tbody').append(linha);
                    oldpreco = document.getElementById('disabledInput').value;
                    
                    if(document.getElementById("disabledInput").value == ""){
                        document.getElementById('disabledInput').value = valort;
                    }
                    else{
                        var n1 = parseInt(valort);
                        var n2 = parseInt(oldpreco);
                        var value = n1+n2;
                        document.getElementById('disabledInput').value = value;
                    }
                    
            
                }
            }
           

        });        
    }  

    function salvaItem(){

    }

    // Evento que é executado ao clicar no botão de enviar
    document.getElementById("BuscaProduto").onclick = function(e) { 
        var produto= document.getElementById("produto").value;
        var qte= document.getElementById("qte").value;
        BuscarProduto(produto,qte);
        e.preventDefault();
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


    function SalvarPedido() {
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
    $(function(){
        carregarClientes();
    })

</script>
@endsection

@endsection