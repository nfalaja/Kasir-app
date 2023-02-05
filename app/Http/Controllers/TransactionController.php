<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionDetail;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $items = Item::doesntHave('cart')->where('stock', '>', 0)->get()->sortby('name');
        $carts = Item::has('cart')->get()->sortByDesc('cart.created_at');
        return view('Transaction', compact('items', 'carts'));
        // return $carts;
    }

    
    public function history()
    {
        $histories = Transaction::all()->sortByDesc('created_at');
        return view('History', compact('histories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function checkout(request $request)
    {
        Transaction::create($request->all());
        foreach(Cart::all() as $item){
            TransactionDetail::create([
                'transaction_id'=>Transaction::latest()->first()->id,
                'item_id'       =>$item->item_id,
                'qty'           =>$item->qty,
                'subtotal'      =>$item->price * $item->qty
            ]);
        }
        Cart::truncate();
        return redirect (route('transaction.show', Transaction::latest()->first()->id));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Cart::create($request->all());
        return redirect()->back()->with('status', 'item Added to Cart');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detail = Transaction::find($id);
        return view('DetailTransaction', compact('detail')) ;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Cart::findorfail($id)->update($request->all());
        return redirect()->back()->with('status1', 'Item qty Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::findorfail($id)->delete();
        return redirect()->back()->with('status1', 'Item removed from cart');
    }
}
