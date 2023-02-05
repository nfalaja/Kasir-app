@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">{{ __('Transaction') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="card-body">

                            <table class="table table-responsive table-striped">
                                <thead>
                                    <td>#</td>
                                    <td>Category</td>
                                    <td>Item</td>
                                    <td>Price</td>
                                    <td>Stock</td>
                                    <td>Action</td>
                                </thead>

                                @if ($items->isEmpty())
                                    <tr>
                                        <td class="text-center" colspan="6">semua item sudah di keranjang!!!!!!!!!!!!
                                        </td>
                                    </tr>
                                @else
                                    @foreach ($items as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->category->name }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ number_format($item->price) }}</td>
                                            <td>{{ $item->stock }}</td>
                                            <form action="{{ route('transaction.store') }}" method="POST">
                                                @csrf
                                                <td>
                                                    <input type="hidden" value="{{ $item->id }}" name="item_id">
                                                    <input type="hidden" name="qty" value="1">
                                                    <input value="cart" type="submit"
                                                        class="btn btn-sm btn-success text-light">
                                                </td>
                                            </form>
                                        </tr>
                                    @endforeach
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        Cart
                    </div>
                    @if (session('status1'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status1') }}
                        </div>
                    @endif
                    <table class="table table-responsive">
                        <thead>
                            <td>#</td>
                            <td>Item</td>
                            <td class="col-md-2">Qty</td>
                            <td>Subtotal</td>
                            <td>Action</td>
                        </thead>

                        @if ($carts->isEmpty())
                            <tr>
                                <td class="text-center" colspan="5">No Item in Cart</td>
                            </tr>
                        @else
                            @foreach ($carts as $cart)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $cart->name }}</td>

                                    {{-- form update --}}
                                    <form action="{{ route('transaction.update', $cart->cart->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <td><input type="number" min="1" name="qty"
                                                max="{{ $cart->stock + $cart->cart->qty }}" class="form-control"
                                                value="{{ $cart->cart->qty }}" onchange="ubah{{ $loop->iteration }}()">
                                        </td>
                                        <td>{{ number_format($cart->price * $cart->cart->qty) }}</td>
                                        <td>
                                            <button id="update{{ $loop->iteration }}" class="btn btn-sm btn-primary"
                                                style="display: none">Update</button>
                                    </form>

                                    {{-- form balik ke item --}}
                                    <form action="{{ route('transaction.destroy', $cart->cart->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" id="hapus{{ $loop->iteration }}"
                                            class="btn btn-sm btn-danger" style="display: ">Hapus</button>
                                        </td>
                                    </form>
                                </tr>
                                <script>
                                    function ubah{{ $loop->iteration }}() {
                                        document.getElementById("update{{ $loop->iteration }}").style.display = "inline";
                                        document.getElementById("hapus{{ $loop->iteration }}").style.display = "none";
                                    }
                                </script>
                            @endforeach
                        @endif
                        <form action="{{ route('transaction.checkout') }}" method="POST">
                            @csrf
                            <tr>
                                <input type="hidden" name="users_id" value="{{ Auth::user()->id }}">
                                <td class="text-end" colspan="3">Grand Total</td>
                                <td colspan="2"><input type="number" class="form-control" name="total"
                                        value="{{ $carts->sum(function ($item) {
                                            return $item->price * $item->cart->qty;
                                        }) }}">
                                </td>
                            </tr>
                            <tr>
                                <td class="text-end" colspan="3">Payment</td>
                                <td colspan="2"><input type="number" required class="form-control"
                                        min="{{ $carts->sum(function ($item) {
                                            return $item->price * $item->cart->qty;
                                        }) }}"
                                        name="pay_total"></td>
                            </tr>
                            <tr>
                                <td class="text-end " colspan="3"></td>
                                <td><input type="submit" class="btn btn-primary form-control" value="checkout"></td>
                                <td><input type="reset" class="btn btn-danger form-control" value="Reset"></td>
                            </tr>
                        </form>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
