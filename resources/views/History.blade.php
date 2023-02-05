@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-center">History Transaction</div>
                <div class="card-body">
                    <table>

                    <table class="table table-responsive ">
                        <thead>
                            <td>#</td>
                            <td>Date</td>
                            <td >Served By</td>
                            <td>Grand Total</td>
                            <td>Paytotal</td>
                            <td>Action</td>
                        </thead>
                        @foreach ($histories as $history)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{date('d F Y',  strtotime($history->created_at))}}</td>
                            <td>{{$history->user->name}}</td>
                            <td>{{number_format($history->total)}}</td>
                            <td>{{$history->pay_total}}</td>
                        <td>
                                <a href="transaction/{{$history->id}}" class="btn btn-sm btn-primary">Detail</a>
                            </td>
                        </tr> 
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
