<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;  // Certifique-se de ter o modelo Expense

class ExpenseController extends Controller
{
    /**
     * Exibe uma lista das despesas.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Expense::orderBy('data', 'desc')->paginate(10);

        return view('cadastrar-despesa', compact('expenses'));
    }

    /**
     * Mostra o formulário para criar uma nova despesa.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('expenses.create');
    }

    /**
     * Armazena uma despesa recém-criada no banco de dados.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
{
    $expense = new Expense;

    // Adicione os campos do formulário correspondentes ao modelo Expense
    $expense->data = $request->data;
    $expense->user_id = auth()->id(); // ID do usuário autenticado
    $expense->category = $request->category;
    $expense->supplier = $request->supplier;

    // Converte o valor para o formato com ponto
    $value = str_replace(',', '.', $request->value);
    $expense->value = $value;

    $expense->store = $request->store;
    $expense->note = $request->observation; // Assumindo que "note" corresponde a "observation" no formulário
    $expense->cc_from = $request->currentAccount; // Assumindo que "cc_from" corresponde a "currentAccount" no formulário
    $expense->p_method = $request->paymentMethod; // Assumindo que "p_method" corresponde a "paymentMethod" no formulário

    $expense->save();

    return redirect()->route('expenses.index');
}


    /**
     * Exibe a despesa especificada.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $expense = Expense::findOrFail($id);

        return response()->json($expense);
    }

    /**
     * Mostra o formulário para editar a despesa especificada.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $expense = Expense::findOrFail($id);

        return view('expenses.edit', compact('expense'));
    }

    /**
     * Atualiza a despesa especificada no banco de dados.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $expense = Expense::findOrFail($id);

        // Atualize os campos do formulário correspondentes ao modelo Expense
        $expense->data = $request->data;
        $expense->user_id = auth()->id(); // ID do usuário autenticado
        $expense->category = $request->category;
        $expense->supplier = $request->supplier;
        $expense->value = $request->value;
        $expense->store = $request->store;
        $expense->note = $request->observation; // Assumindo que "note" corresponde a "observation" no formulário
        $expense->cc_from = $request->currentAccount; // Assumindo que "cc_from" corresponde a "currentAccount" no formulário
        $expense->p_method = $request->paymentMethod; // Assumindo que "p_method" corresponde a "paymentMethod" no formulário

        $expense->save();

        return redirect()->route('expenses.index');
    }

    /**
     * Remove a despesa especificada do banco de dados.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $expense = Expense::findOrFail($id);
        $expense->delete();

        return redirect()->route('expenses.index');
    }
}
