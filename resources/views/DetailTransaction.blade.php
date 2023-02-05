@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header"><a href="/history" class="btn btn-primary">back</a></div>
                <div class="card-header text-center"> Invoice</div>
                <div class="card-body">
                    <table>
                        <tr>
                            <td>Date of Transaction</td>
                            <td>  :  </td>
                            <td>{{date('d F Y',  strtotime($detail->created_at))}}</td>
                        </tr>
                        <tr>
                            <td>Served By</td>
                            <td>  :  </td>
                            <td>{{$detail->user->name}}</td>
                        </tr>
                    </table>

                    <br>

                    <table class="table table-responsive ">
                        <thead>
                            <td>#</td>
                            <td>Item</td>
                            <td >Qty</td>
                            <td>Price</td>
                            <td>Subtotal</td>
                        </thead>
                        @foreach ($detail->detail as $dtl)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$dtl->item->name}}</td>
                            <td>{{$dtl->qty}}</td>
                            <td>{{$dtl->item->price}}</td>
                            <td>{{$dtl->qty*$dtl->item->price}}</td>
                        </tr>
                        @endforeach
                        
                        <tr>
                            <td class="text-end" colspan="4">Grand Total</td>
                            <td colspan="2">{{number_format($detail->total)}}</td>
                        </tr>
                        <tr>
                            <td class="text-end" colspan="4">Payment</td>
                            <td colspan="2">{{number_format($detail->pay_total)}}</td>
                        </tr>
                        <tr>
                            <td class="text-end" colspan="4">Change</td>
                            <td colspan="2">{{number_format($detail->pay_total - $detail->total)}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
