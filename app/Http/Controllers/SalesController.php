<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale; // Certifique-se de que o nome do modelo é Sale e ele existe
use Illuminate\Support\Facades\Auth; // Adicione esta linha para usar a classe Auth
use Illuminate\Support\Facades\Validator;


class SalesController extends Controller
{
    public function index(Request $request)
{
    $query = Sale::query()->where('user_id', Auth::id());

    if ($request->dateFrom) {
        $query->where('data', '>=', $request->dateFrom);
    }

    if ($request->dateTo) {
        $query->where('data', '<=', $request->dateTo);
    }

    if ($request->client) {
        $query->where('client', 'like', "%{$request->client}%");
    }

    if ($request->store) {
        $query->where('store', 'like', "%{$request->store}%");
    }

    // Get sort by and sort order from request, default to 'data' and 'desc'
    $sortBy = $request->get('sort_by', 'data');
    $sortOrder = $request->get('sort_order', 'desc');

    $sales = $query->orderBy($sortBy, $sortOrder)->orderBy('id', $sortOrder)->paginate(10);

    return view('cadastrar-venda', compact('sales'));
}


public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'data' => 'nullable|date|max:255',
        'value' => 'nullable|numeric|max:255',
        'store' => 'nullable|string|max:255',
        'product' => 'nullable|string|max:255',
        'client' => 'nullable|string|max:255',
        'cc_from' => 'nullable|string|max:255',
        'cc_to' => 'nullable|string|max:255',
        'p_method' => 'nullable|string|max:255',
        'note' => 'nullable|string|max:255',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }
    $sale = new Sale;
    $sale->data = $request['data'];
    $sale->client = $request['client'] ? $request['client'] : 'Padrão';

    // Se o valor for vazio, definir como 0. Caso contrário, substitua a vírgula por um ponto.
    $sale->value = empty($request['value']) ? 0 : str_replace(',', '.', $request['value']);

    $sale->store = $request['store'];
    $sale->product = $request['product'];
    $sale->cc_from = $request['cc_from'];
    $sale->cc_to = $request['cc_to'];
    $sale->p_method = $request['p_method'];
    $sale->note = $request['note'];
    $sale->user_id = Auth::id();
    $sale->save();

    return redirect()->route('cadastrar-venda');
}


    public function edit($id)
    {
        $sale = Sale::find($id);

        return view('edit-sale', compact('sale'));
    }

    public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'data' => 'nullable|date|max:255',
        'value' => 'nullable|numeric|max:255',
        'store' => 'nullable|string|max:255',
        'product' => 'nullable|string|max:255',
        'client' => 'nullable|string|max:255',
        'cc_from' => 'nullable|string|max:255',
        'cc_to' => 'nullable|string|max:255',
        'p_method' => 'nullable|string|max:255',
        'note' => 'nullable|string|max:255',
    ]);

    $sale = Sale::find($id);
    $sale->data = $request['data'];
    $sale->client = $request['client'] ? $request['client'] : 'Padrão';

    // Se o valor for vazio, definir como 0. Caso contrário, substitua a vírgula por um ponto.
    $sale->value = empty($request['value']) ? 0 : str_replace(',', '.', $request['value']);

    $sale->store = $request['store'];
    $sale->product = $request['product'];
    $sale->cc_from = $request['cc_from'];
    $sale->cc_to = $request['cc_to'];
    $sale->p_method = $request['p_method'];
    $sale->note = $request['note'];
    $sale->user_id = Auth::id();
    $sale->save();

    return redirect()->route('cadastrar-venda');
}

    public function destroy($id)
    {
        $sale = Sale::find($id);
        $sale->delete();

        return redirect()->route('cadastrar-venda');
    }

    public function show($id)
    {
        $sale = Sale::find($id);

        return response()->json($sale);
    }
}
