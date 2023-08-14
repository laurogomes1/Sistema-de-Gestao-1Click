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
        <h1>Minhas Despesas</h1>
        <button class="btn btn-success btn-sm ms-3" data-bs-toggle="modal" data-bs-target="#expensesModal">
            <i class="fas fa-plus text-white"></i> Nova Despesa
        </button>
    </div>

    <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">Minha Empresa</li>
    <li class="breadcrumb-item active" aria-current="page">Despesas</li>
  </ol>
</nav>  

<!-- Adicionando campos de filtro -->
<form method="GET" action="{{ route('expenses.index') }}">
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
            <label for="supplier">Fornecedor:</label>
            <input type="text" id="supplier" name="supplier" value="{{ request('supplier') }}" class="form-control @error('supplier') is-invalid @enderror">
            @error('supplier')
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
            <a href="{{ route('expenses.index') }}" class="btn btn-secondary">Limpar</a>
        </div>
    </div>
</form>


<!-- Modal de Criação -->
<div class="modal fade" id="expensesModal" tabindex="-1" aria-labelledby="expensesModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="expensesModalLabel">Nova Despesa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('expenses.store') }}" id="new-expense-form">
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
                            <label for="store" class="form-label">Categoria</label>
                            <input type="text" class="form-control @error('category') is-invalid @enderror" id="category" name="category">
                            <div class="invalid-feedback"></div>
                            @error('store')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="product" class="form-label">Fornecedor</label>
                            <input type="text" class="form-control @error('supplier') is-invalid @enderror" id="supplier" name="supplier">
                            <div class="invalid-feedback"></div>
                            @error('product')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="store" class="form-label">Filial</label>
                            <input type="text" class="form-control @error('store') is-invalid @enderror" id="store" name="store" placeholder="Padrão">
                            <div class="invalid-feedback"></div>
                            @error('store')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div> 
                        <div class="col-md-4 mb-3">
                            <label for="cc_to" class="form-label">Conta Usada</label>
                            <input type="text" class="form-control @error('cc_from') is-invalid @enderror" id="cc_from" name="cc_from">
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
<div class="modal fade" id="editExpensesModal" tabindex="-1" aria-labelledby="editExpensesModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editExpensesModalLabel">Editar Despesa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="edit-expense-form">
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
                            <label for="edit-store" class="form-label">Categoria</label>
                            <input type="text" class="form-control @error('category') is-invalid @enderror" id="edit-category" name="category">
                            @error('store')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit-supplier" class="form-label">Fornecedor</label>
                            <input type="text" class="form-control @error('supplier') is-invalid @enderror" id="edit-supplier" name="supplier">
                            @error('product')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit-store" class="form-label">Filial</label>
                            <input type="text" class="form-control @error('filial') is-invalid @enderror" id="edit-filial" name="filial">
                            @error('store')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="edit-cc_from" class="form-label">Conta usada</label>
                            <input type="text" class="form-control @error('cc_from') is-invalid @enderror" id="edit-cc_from" name="cc_from">
                            @error('cc_from')
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
                <a class="table-header-link" href="{{ route('expenses.index', ['sort_by' => 'data', 'sort_order' => (request('sort_by') == 'data' && request('sort_order') == 'asc') ? 'desc' : 'asc']) }}">
                    Data{!! request('sort_by', 'data') == 'data' ? (request('sort_order', 'desc') == 'asc' ? '<i class="fa-regular fa-circle-down"></i>' : '<i class="fa-regular fa-circle-up"></i>') : '' !!}
                </a>
            </th>
            <th>
                <a class="table-header-link" href="{{ route('expenses.index', ['sort_by' => 'value', 'sort_order' => (request('sort_by') == 'value' && request('sort_order') == 'asc') ? 'desc' : 'asc']) }}">
                    Valor{!! request('sort_by') == 'value' ? (request('sort_order') == 'asc' ? '<i class="fa-regular fa-circle-down"></i>' : '<i class="fa-regular fa-circle-up"></i>') : '' !!}
                </a>
            </th>
            <th>
                <a class="table-header-link" href="{{ route('expenses.index', ['sort_by' => 'category', 'sort_order' => (request('sort_by') == 'cateegory' && request('sort_order') == 'asc') ? 'desc' : 'asc']) }}">
                    Categoria{!! request('sort_by') == 'category' ? (request('sort_order') == 'asc' ? '<i class="fa-regular fa-circle-down"></i>' : '<i class="fa-regular fa-circle-up"></i>') : '' !!}
                </a>
            </th>
            <th>
                <a class="table-header-link" href="{{ route('expenses.index', ['sort_by' => 'supplier', 'sort_order' => (request('sort_by') == 'supplier' && request('sort_order') == 'asc') ? 'desc' : 'asc']) }}">
                    Fornecedor{!! request('sort_by') == 'supplier' ? (request('sort_order') == 'asc' ? '<i class="fa-regular fa-circle-down"></i>' : '<i class="fa-regular fa-circle-up"></i>') : '' !!}
                </a>
            </th>
            <th>
                <a class="table-header-link" href="{{ route('expenses.index', ['sort_by' => 'store', 'sort_order' => (request('sort_by') == 'store' && request('sort_order') == 'asc') ? 'desc' : 'asc']) }}">
                    Filial{!! request('sort_by') == 'store' ? (request('sort_order') == 'asc' ? '<i class="fa-regular fa-circle-down"></i>' : '<i class="fa-regular fa-circle-up"></i>') : '' !!}
                </a>
            </th>
            <th>
                <a class="table-header-link" href="{{ route('expenses.index', ['sort_by' => 'cc_from', 'sort_order' => (request('sort_by') == 'cc_from' && request('sort_order') == 'asc') ? 'desc' : 'asc']) }}">
                    Conta Usada{!! request('sort_by') == 'cc_from' ? (request('sort_order') == 'asc' ? '<i class="fa-regular fa-circle-down"></i>' : '<i class="fa-regular fa-circle-up"></i>') : '' !!}
                </a>
            </th>
            <th>
                <a class="table-header-link" href="{{ route('expenses.index', ['sort_by' => 'p_method', 'sort_order' => (request('sort_by') == 'p_method' && request('sort_order') == 'asc') ? 'desc' : 'asc']) }}">
                    Forma de Pagamento{!! request('sort_by') == 'p_method' ? (request('sort_order') == 'asc' ? '<i class="fa-regular fa-circle-down"></i>' : '<i class="fa-regular fa-circle-up"></i>') : '' !!}
                </a>
            </th>
            <th>
                <a class="table-header-link" href="{{ route('expenses.index', ['sort_by' => 'note', 'sort_order' => (request('sort_by') == 'note' && request('sort_order') == 'asc') ? 'desc' : 'asc']) }}">
                    Observação{!! request('sort_by') == 'note' ? (request('sort_order') == 'asc' ? '<i class="fa-regular fa-circle-down"></i>' : '<i class="fa-regular fa-circle-up"></i>') : '' !!}
                </a>
            </th>
            <th>Ações</th>
        </tr>
        </thead>

</tr>

</thead>
<tbody>
    @if($expenses->isEmpty())
        <tr>
            <td colspan="9" class="text-center">Nenhuma despesa cadastrada</td>
        </tr>
    @else
        @foreach($expenses as $expense)
            <tr class="text-center">
                <td>{{ date('d-m-Y', strtotime($expense->data)) }}</td>
                <td>{{ $expense->category }}</td>
                <td>R$ {{ number_format($expense->value, 2, ',', '.') }}</td>
                <td>{{ $expense->store }}</td>
                <td>{{ $expense->note }}</td>
                <td>{{ $expense->cc_from }}</td>
                <td>{{ $expense->p_method }}</td>
                <td>{{ $expense->suppliers }}</td>
                <td>
                    <button class="btn btn-primary btn-sm edit-button" data-bs-toggle="modal" data-bs-target="#editExpensesModal" data-id="{{ $expense->id }}" data-data="{{ date('d-m-Y', strtotime($expense->data)) }}" data-value="{{ $expense->value }}" data-category="{{ $expense->category }}" data-supplier="{{ $expense->supplier }}" data-store="{{ $expense->store }}" data-cc_from="{{ $expense->cc_from }}" data-p_method="{{ $expense->p_method }}" data-note="{{ $expense->note }}">
                        <i class="fas fa-pencil-alt"></i>
                    </button>
                    <form method="POST" action="{{ route('expenses.destroy', $expense->id) }}" style="display: inline;">
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
        @include('vendor.pagination.custom', ['paginator' => $expenses])

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
        var expenseId = $(this).data('id');

        $.get('/expenses/' + expenseId, function(expense) {
            // Converte o valor para o formato com vírgula
            var value = expense.value.toString().replace('.', ',');

            $('#edit-id').val(expense.id);
            $('#edit-data').val(expense.data);
            $('#edit-category').val(expense.category);
            $('#edit-value').val(value);
            $('#edit-store').val(expense.store);
            $('#edit-supplier').val(expense.supplier);
            $('#edit-cc_from').val(expense.cc_from);
            $('#edit-p_method').val(expense.p_method);
            $('#edit-note').val(expense.note);

            $('#edit-expense-form').attr('action', '/expenses/' + expense.id);
        });
    });

    // Quando o formulário do modal é submetido
    $('#edit-expense-form, #create-expense-form').on('submit', function (event) {
        event.preventDefault();

        var valueField = $(this).find('.value-field');

        var value = valueField.val();

        // Converte o valor para o formato com ponto
        value = value.replace(',', '.');

        // Atualiza o valor no formulário
        valueField.val(value);

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
                    $('#' + form.id + '-' + key).addClass('is-invalid');
                    $('#' + form.id + '-' + key).next('.invalid-feedback').text(value[0]);
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
