@extends('layouts.app')

@section('content')
<style>
    .table-header-link {
        color: black;
        text-decoration: none;
    }
    .table-header-link:hover {
        color: black;
        text-decoration: none;
    }
    .table-header-link i {
        margin-left: 5px;
    }
    .pagination li a {
    background-color: #eaecef; /* Altere para a cor de fundo desejada */
    color: grey; /* Altere para a cor de texto desejada */
}
.pagination li span {
    background-color: #eaecef; /* Altere para a cor de fundo desejada */
    color: grey; /* Altere para a cor de texto desejada */
}
</style>
<div class="container-fluid">
    <div class="d-flex align-items-center mb-3">
        <h1>Minhas Vendas</h1>
        <button class="btn btn-success btn-sm ms-3" data-bs-toggle="modal" data-bs-target="#salesModal">
            <i class="fas fa-plus text-white"></i> Nova Venda
        </button>
    </div>

    <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">Minha Empresa</li>
    <li class="breadcrumb-item active" aria-current="page">Vendas</li>
  </ol>
</nav>  

<!-- Adicionando campos de filtro -->
<form method="GET" action="{{ route('index-sale') }}">
    <div class="row">
        <div class="col">
            <label for="dateFrom">Data De:</label>
            <input type="date" id="dateFrom" name="dateFrom" value="{{ request('dateFrom') }}" class="form-control @error('dateFrom') is-invalid @enderror">
            @error('dateFrom')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="col">
            <label for="dateTo">Data Até:</label>
            <input type="date" id="dateTo" name="dateTo" value="{{ request('dateTo') }}" class="form-control @error('dateTo') is-invalid @enderror">
            @error('dateTo')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="col">
            <label for="client">Cliente:</label>
            <input type="text" id="client" name="client" value="{{ request('client') }}" class="form-control @error('client') is-invalid @enderror">
            @error('client')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="col">
            <label for="store">Filial:</label>
            <input type="text" id="store" name="store" value="{{ request('store') }}" class="form-control @error('store') is-invalid @enderror">
            @error('store')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="col align-self-end">
            <button type="submit" class="btn btn-primary">Filtrar</button>
            <a href="{{ route('index-sale') }}" class="btn btn-secondary">Limpar</a>
        </div>
    </div>
</form>


<!-- Modal de Criação -->
<div class="modal fade" id="salesModal" tabindex="-1" aria-labelledby="salesModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="salesModalLabel">Nova Venda</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('store-sale') }}" id="new-sale-form">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="data" class="form-label">Data</label>
                            <input type="date" class="form-control @error('data') is-invalid @enderror" id="data" name="data" value="{{ date('Y-m-d') }}">
                            <div class="invalid-feedback"></div>
                            @error('data')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="value" class="form-label">Valor</label>
                            <input type="text" class="form-control @error('value') is-invalid @enderror" id="value" name="value" placeholder="0,00">
                            <div class="invalid-feedback"></div>
                            @error('value')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="store" class="form-label">Filial</label>
                            <input type="text" class="form-control @error('store') is-invalid @enderror" id="store" name="store">
                            <div class="invalid-feedback"></div>
                            @error('store')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="product" class="form-label">Produto</label>
                            <input type="text" class="form-control @error('product') is-invalid @enderror" id="product" name="product">
                            <div class="invalid-feedback"></div>
                            @error('product')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="client" class="form-label">Cliente</label>
                            <input type="text" class="form-control @error('client') is-invalid @enderror" id="client" name="client" placeholder="Padrão">
                            <div class="invalid-feedback"></div>
                            @error('client')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="cc_from" class="form-label">Gateway</label>
                            <input type="text" class="form-control @error('cc_from') is-invalid @enderror" id="cc_from" name="cc_from">
                            <div class="invalid-feedback"></div>
                            @error('cc_from')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="cc_to" class="form-label">Conta Destino</label>
                            <input type="text" class="form-control @error('cc_to') is-invalid @enderror" id="cc_to" name="cc_to">
                            <div class="invalid-feedback"></div>
                            @error('cc_to')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="p_method" class="form-label">Forma de Pagamento</label>
                            <input type="text" class="form-control @error('p_method') is-invalid @enderror" id="p_method" name="p_method">
                            <div class="invalid-feedback"></div>
                            @error('p_method')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="note" class="form-label">Observação</label>
                        <textarea class="form-control @error('note') is-invalid @enderror" id="note" name="note" rows="3"></textarea>
                        <div class="invalid-feedback"></div>
                        @error('note')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

    <!-- Modal de Edição -->
<div class="modal fade" id="editSalesModal" tabindex="-1" aria-labelledby="editSalesModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSalesModalLabel">Editar Venda</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="edit-sale-form">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit-id" name="id">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit-data" class="form-label">Data</label>
                            <input type="date" class="form-control @error('data') is-invalid @enderror" id="edit-data" name="data">
                            @error('data')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit-value" class="form-label">Valor</label>
                            <input type="text" class="form-control @error('value') is-invalid @enderror" id="edit-value" name="value">
                            @error('value')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit-store" class="form-label">Filial</label>
                            <input type="text" class="form-control @error('store') is-invalid @enderror" id="edit-store" name="store">
                            @error('store')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit-product" class="form-label">Produto</label>
                            <input type="text" class="form-control @error('product') is-invalid @enderror" id="edit-product" name="product">
                            @error('product')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit-client" class="form-label">Cliente</label>
                            <input type="text" class="form-control @error('client') is-invalid @enderror" id="edit-client" name="client">
                            @error('client')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="edit-cc_from" class="form-label">Gateway</label>
                            <input type="text" class="form-control @error('cc_from') is-invalid @enderror" id="edit-cc_from" name="cc_from">
                            @error('cc_from')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="edit-cc_to" class="form-label">Conta Destino</label>
                            <input type="text" class="form-control @error('cc_to') is-invalid @enderror" id="edit-cc_to" name="cc_to">
                            @error('cc_to')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="edit-p_method" class="form-label">Forma de Pagamento</label>
                            <input type="text" class="form-control @error('p_method') is-invalid @enderror" id="edit-p_method" name="p_method">
                            @error('p_method')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="edit-note" class="form-label">Observação</label>
                        <textarea class="form-control @error('note') is-invalid @enderror" id="edit-note" name="note" rows="3"></textarea>
                        @error('note')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    <div class="panel panel-default">   
    <div class="panel-body">
        <div class="table-responsive">
        <table class="table table-striped">
        <thead>
        <tr class="text-center">
            <th>
                <a class="table-header-link" href="{{ route('index-sale', ['sort_by' => 'data', 'sort_order' => (request('sort_by') == 'data' && request('sort_order') == 'asc') ? 'desc' : 'asc']) }}">
                    Data{!! request('sort_by', 'data') == 'data' ? (request('sort_order', 'desc') == 'asc' ? '<i class="fa-regular fa-circle-down"></i>' : '<i class="fa-regular fa-circle-up"></i>') : '' !!}
                </a>
            </th>
            <th>
                <a class="table-header-link" href="{{ route('index-sale', ['sort_by' => 'client', 'sort_order' => (request('sort_by') == 'client' && request('sort_order') == 'asc') ? 'desc' : 'asc']) }}">
                    Cliente{!! request('sort_by') == 'client' ? (request('sort_order') == 'asc' ? '<i class="fa-regular fa-circle-down"></i>' : '<i class="fa-regular fa-circle-up"></i>') : '' !!}
                </a>
            </th>
            <th>
                <a class="table-header-link" href="{{ route('index-sale', ['sort_by' => 'value', 'sort_order' => (request('sort_by') == 'value' && request('sort_order') == 'asc') ? 'desc' : 'asc']) }}">
                    Valor{!! request('sort_by') == 'value' ? (request('sort_order') == 'asc' ? '<i class="fa-regular fa-circle-down"></i>' : '<i class="fa-regular fa-circle-up"></i>') : '' !!}
                </a>
            </th>
            <th>
                <a class="table-header-link" href="{{ route('index-sale', ['sort_by' => 'store', 'sort_order' => (request('sort_by') == 'store' && request('sort_order') == 'asc') ? 'desc' : 'asc']) }}">
                    Filial{!! request('sort_by') == 'store' ? (request('sort_order') == 'asc' ? '<i class="fa-regular fa-circle-down"></i>' : '<i class="fa-regular fa-circle-up"></i>') : '' !!}
                </a>
            </th>
            <th>
                <a class="table-header-link" href="{{ route('index-sale', ['sort_by' => 'product', 'sort_order' => (request('sort_by') == 'product' && request('sort_order') == 'asc') ? 'desc' : 'asc']) }}">
                    Produto{!! request('sort_by') == 'product' ? (request('sort_order') == 'asc' ? '<i class="fa-regular fa-circle-down"></i>' : '<i class="fa-regular fa-circle-up"></i>') : '' !!}
                </a>
            </th>
            <th>
                <a class="table-header-link" href="{{ route('index-sale', ['sort_by' => 'cc_from', 'sort_order' => (request('sort_by') == 'cc_from' && request('sort_order') == 'asc') ? 'desc' : 'asc']) }}">
                    Gateway{!! request('sort_by') == 'cc_from' ? (request('sort_order') == 'asc' ? '<i class="fa-regular fa-circle-down"></i>' : '<i class="fa-regular fa-circle-up"></i>') : '' !!}
                </a>
            </th>
            <th>
                <a class="table-header-link" href="{{ route('index-sale', ['sort_by' => 'cc_to', 'sort_order' => (request('sort_by') == 'cc_to' && request('sort_order') == 'asc') ? 'desc' : 'asc']) }}">
                    Conta Destino{!! request('sort_by') == 'cc_to' ? (request('sort_order') == 'asc' ? '<i class="fa-regular fa-circle-down"></i>' : '<i class="fa-regular fa-circle-up"></i>') : '' !!}
                </a>
            </th>
            <th>
                <a class="table-header-link" href="{{ route('index-sale', ['sort_by' => 'p_method', 'sort_order' => (request('sort_by') == 'p_method' && request('sort_order') == 'asc') ? 'desc' : 'asc']) }}">
                    Forma de Pagamento{!! request('sort_by') == 'p_method' ? (request('sort_order') == 'asc' ? '<i class="fa-regular fa-circle-down"></i>' : '<i class="fa-regular fa-circle-up"></i>') : '' !!}
                </a>
            </th>
            <th>
                <a class="table-header-link" href="{{ route('index-sale', ['sort_by' => 'note', 'sort_order' => (request('sort_by') == 'note' && request('sort_order') == 'asc') ? 'desc' : 'asc']) }}">
                    Observação{!! request('sort_by') == 'note' ? (request('sort_order') == 'asc' ? '<i class="fa-regular fa-circle-down"></i>' : '<i class="fa-regular fa-circle-up"></i>') : '' !!}
                </a>
            </th>
            <th>Ações</th>
        </tr>
        </thead>

</tr>

</thead>
<tbody>
    @if($sales->isEmpty())
        <tr>
            <td colspan="9" class="text-center">Nenhuma venda cadastrada</td>
        </tr>
    @else
        @foreach($sales as $sale)
            <tr class="text-center">
                <td>{{ date('d-m-Y', strtotime($sale->data)) }}</td>
                <td>{{ $sale->client }}</td>
                <td>R$ {{ number_format($sale->value, 2, ',', '.') }}</td>
                <td>{{ $sale->store }}</td>
                <td>{{ $sale->product }}</td>
                <td>{{ $sale->cc_from }}</td>
                <td>{{ $sale->cc_to }}</td>
                <td>{{ $sale->p_method }}</td>
                <td>{{ $sale->note }}</td>
                <td>
                    <button class="btn btn-primary btn-sm edit-button" data-bs-toggle="modal" data-bs-target="#editSalesModal" data-id="{{ $sale->id }}" data-data="{{ date('d-m-Y', strtotime($sale->data)) }}" data-client="{{ $sale->client }}" data-value="{{ $sale->value }}" data-store="{{ $sale->store }}" data-cc_from="{{ $sale->cc_from }}" data-cc_to="{{ $sale->cc_to }}" data-p_method="{{ $sale->p_method }}" data-note="{{ $sale->note }}">
                        <i class="fas fa-pencil-alt"></i>
                    </button>
                    <form method="POST" action="{{ route('delete-sale', $sale->id) }}" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    @endif
</tbody>

</table>
<div class="d-flex justify-content-center">
    <ul class="pagination">
       

        <!-- Aqui vem a sua lógica de paginação atual -->
        @include('vendor.pagination.custom', ['paginator' => $sales])

        <!-- Se não estamos na última página, mostramos o botão "Ir para o fim" -->
       
    </ul>
</div>

            </div>
        </div>
    </div>
</div>

<!-- Modal de Erro -->
<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="errorModalLabel">Erro</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="errorModalBody">
        <!-- O conteúdo do erro será preenchido aqui -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
    $('.edit-button').click(function() {
        var saleId = $(this).data('id');

        $.get('/sales/' + saleId, function(sale) {
            // Converte o valor para o formato com vírgula
            var value = sale.value.toString().replace('.', ',');

            $('#edit-id').val(sale.id);
            $('#edit-data').val(sale.data);
            $('#edit-client').val(sale.client);
            $('#edit-value').val(value);
            $('#edit-store').val(sale.store);
            $('#edit-product').val(sale.product);
            $('#edit-cc_from').val(sale.cc_from);
            $('#edit-cc_to').val(sale.cc_to);
            $('#edit-p_method').val(sale.p_method);
            $('#edit-note').val(sale.note);

            $('#edit-sale-form').attr('action', '/sales/' + sale.id);
        });
    });

    // Quando o formulário do modal é submetido
    $('#edit-sale-form').on('submit', function (event) {
        event.preventDefault();

        var value = $(this).find('#edit-value').val();

        // Converte o valor para o formato com ponto
        value = value.replace(',', '.');

        // Atualiza o valor no formulário
        $(this).find('#edit-value').val(value);

        // Agora você pode submeter o formulário
        var form = this;
        var url = $(form).attr('action');

        $.ajax({
            type: "POST",
            url: url,
            data: $(form).serialize(),
            success: function(data) {
                location.reload(); // recarrega a página se a solicitação foi bem sucedida
            },
            error: function(data) {
                var errors = data.responseJSON.errors;
                var errorMessage = "";
                $.each(errors, function(key, value){
                    errorMessage += key + ": " + value[0] + "\n";
                    $('#edit-'+key).addClass('is-invalid');
                    $('#edit-'+key).next('.invalid-feedback').text(value[0]);
                });

                // Preencha o corpo do modal com a mensagem de erro e exiba o modal
                $('#errorModalBody').text(errorMessage);
                $('#errorModal').modal('show');
            }
        });
    });
});
</script>

@endsection
