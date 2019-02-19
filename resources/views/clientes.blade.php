@extends('layout.app', ["current" => "clientes" ])

@section('body')

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Clientes</h5>
        <div class="table-responsive">
        <table class="table table-ordered table-hover" id="tabelaClientes">
            <thead>
                <tr>
                    <th scope="col">Código</th>
                    <th scope="col">Razão</th>
                    <th scope="col">CNPJ</th>
                    <th scope="col">CPF</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Telefone1</th>
                    <th scope="col">Telefone2</th>
                    <th scope="col">Cep</th>
                    <th scope="col">Endereço</th>
                    <th scope="col">Numero</th>
                    <th scope="col">Ações</th>
                    
                </tr>
            </thead>
                
                        <tbody>
                           
                        </tbody>
                
        </table>
        </div>
       
    </div>
    <div class="card-footer">
        <button class="btn btn-sm btn-primary" role="button" onClick="novoCliente()">Novo Cliente</a>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="dlgClientes">
    <div class="modal-dialog" role="document"> 
        <div class="modal-content">
            <form class="form-horizontal" id="formCliente">
                <div class="modal-header">
                    <h5 class="modal-title">Cadastro Cliente</h5>
                </div>
                <div class="modal-body">

                    <input type="hidden" id="id" class="form-control">
                    <div class="form-group">
                        <label for="nomeProduto" class="control-label">Razão social</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="razao" placeholder="Razão social">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="precoProduto" class="control-label">CNPJ</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="cnpj" placeholder="CNPJ">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="precoProduto" class="control-label">CPF</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="cpf" placeholder="CPF">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="quantidadeProduto" class="control-label">E-mail</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="email" placeholder="E-mail">
                        </div>
                    </div>                    

                    <div class="form-group">
                        <label for="quantidadeProduto" class="control-label">Telefone1</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="telefone1" placeholder="Telefone1">
                        </div>
                    </div>     


                    <div class="form-group">
                        <label for="quantidadeProduto" class="control-label">Telefone2</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="telefone2" placeholder="Telefone2">
                        </div>
                    </div>  


                    <div class="form-group">
                        <label for="quantidadeProduto" class="control-label">Cep</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="cep" placeholder="Cep">
                        </div>
                    </div>  


                    <div class="form-group">
                        <label for="quantidadeProduto" class="control-label">Endereço</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="endereço" placeholder="Endereço">
                        </div>
                    </div>  


                    <div class="form-group">
                        <label for="quantidadeProduto" class="control-label">Rua</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="numero" placeholder="numero">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <button type="cancel" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
     
     
     
@section('javascript')
<script type="text/javascript">
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        }
    });
    
    function novoCliente() {
        $('#id').val('');
        $('#razao').val('');
        $('#cnpj').val('');
        $('#cpf').val('');
        $('#email').val('');
        $('#telefone1').val('');
        $('#telefone2').val('');
        $('#cep').val('');
        $('#endereço').val('');
        $('#numero').val('');
        $('#dlgClientes').modal('show');
    }
    
    function carregarCategorias() {
        $.getJSON('/api/categorias', function(data) { 
            for(i=0;i<data.length;i++) {
                opcao = '<option value ="' + data[i].id + '">' + 
                    data[i].nome + '</option>';
                $('#categoriaProduto').append(opcao);
            }
        });
    }
    
    function montarLinha(c) {
        
           if (typeof c.rua == "undefined"){
            c.rua='';
           }
           if (typeof c.razao == "undefined"){
            c.razao='';
           }
           if (typeof c.cnpj == "undefined"){
            c.cnpj='';
           }
           if (typeof c.email == "undefined"){
            c.email='';
           }
           if (typeof c.telefone2 == "undefined"){
            c.telefone2='';
           }
           if (typeof c.cep == "undefined"){
            c.cep='';
           }
           
           if (typeof c.endereço == "undefined"){
            c.endereço='';
           }
           
           if (typeof c.numero == "undefined"){
            c.endereço='';
           }

        var linha = "<tr>" +

            '<td scope="row">' + c.id + "</td>" +
            '<td scope="row">' + c.razao + "</td>" +
            '<td scope="row">' + c.cnpj + "</td>" +
            '<td scope="row">' + c.cpf + "</td>" +
            '<td scope="row">' + c.email + "</td>" +
            '<td scope="row">' + c.telefone1 + "</td>" +
            '<td scope="row">' + c.telefone2 + "</td>" +
            '<td scope="row">' + c.cep + "</td>" +
            '<td scope="row">' + c.endereco + "</td>" +
            '<td scope="row">' + c.numero + "</td>" +
            '<td scope="row">' +
              '<button class="btn btn-sm btn-primary" onclick="editar(' + c.id + ')"> Editar </button> ' +
              '<button class="btn btn-sm btn-danger" onclick="remover(' + c.id + ')"> Apagar </button> ' +
            "</td>" +
            "</tr>";
        return linha;
    }
    
    function editar(id) {
        $.getJSON('/api/clientes/'+id, function(data) { 
            console.log(data);
            $('#id').val(data.id);
            $('#razao').val(data.razao);
            $('#cnpj').val(data.cnpj);
            $('#cpf').val(data.cpf);
            $('#email').val(data.email);
            $('#telefone1').val(data.telefone1);
            $('#telefone2').val(data.telefone2);
            $('#cep').val(data.cep);
            $('#endereço').val(data.endereco);
            $('#numero').val(data.numero);
            $('#dlgClientes').modal('show');            
        });        
    }
    
    function remover(id) {
        $.ajax({
            type: "DELETE",
            url: "/api/clientes/" + id,
            context: this,
            success: function() {
                console.log('Apagou OK');
                linhas = $("#tabelaClientes>tbody>tr");
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
    
    function carregarClientes() {
        $.getJSON('/api/clientes', function(clientes) { 
            for(i=0;i<clientes.length;i++) {
                linha = montarLinha(clientes[i]);
                $('#tabelaClientes>tbody').append(linha);

                       
            }
        });        
    }
    
    function criarClientes() {
        cli = { 
        
                razao:$('#razao').val(),
                cnpj: $('#cnpj').val(),
                cpf: $('#cpf').val(),
                email:$('#email').val(),
                telefone1:$('#telefone1').val(),
                telefone2: $('#telefone2').val(),
                cep: $('#cep').val(),
                endereço: $('#endereço').val(),
                numero: $('#numero').val(),
        };
        $.post("/api/clientes", cli, function(data) {
            cliente = JSON.parse(data);
            linha = montarLinha(cliente);
            $('#tabelaClientes>tbody').append(linha);            
        });
    }
    
    function salvarProduto() {
        cli = { 
                id : $("#id").val(), 
                razao:$('#razao').val(),
                cnpj: $('#cnpj').val(),
                cpf: $('#cpf').val(),
                email:$('#email').val(),
                telefone1:$('#telefone1').val(),
                telefone2: $('#telefone2').val(),
                cep: $('#cep').val(),
                endereço: $('#endereço').val(),
                numero: $('#numero').val(), 
        };
        $.ajax({
            type: "PUT",
            url: "/api/clientes/" + cli.id,
            context: this,
            data: cli,
            success: function(data) {
                cli = JSON.parse(data);
                linhas = $("#tabelaClientes>tbody>tr");
                e = linhas.filter( function(i, e) { 
                    return ( e.cells[0].textContent == cli.id );
                });
                if (e) {
                    e[0].cells[0].textContent = cli.id;
                    e[0].cells[1].textContent = cli.razao;
                    e[0].cells[2].textContent = cli.cnpj;
                    e[0].cells[3].textContent = cli.cpf;
                    e[0].cells[4].textContent = cli.email;
                    e[0].cells[5].textContent = cli.telefone1;
                    e[0].cells[6].textContent = cli.telefone2;
                    e[0].cells[7].textContent = cli.cep;
                    e[0].cells[8].textContent = cli.endereco;
                    e[0].cells[9].textContent = cli.numero;
                }
            },
            error: function(error) {
                console.log(error);
            }
        });        
    }
    
    $("#formCliente").submit( function(event){ 
        event.preventDefault(); 
        if ($("#id").val() != '')
            salvarProduto();
        else
            criarClientes();
            
        $("#dlgClientes").modal('hide');
    });
    
    $(function(){
        carregarCategorias();
        carregarClientes();
    })
    
</script>
@endsection
     
     
     
     
     
     
     
     