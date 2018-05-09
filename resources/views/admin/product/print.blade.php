@extends('layouts.template')
@section('title')
    Coffee Print
    @endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <h3>My Coffee Shop</h3>
                <h4>09978961902</h4>
                @foreach($cart as $cart)
                    <p>Waiter  :{{$cart->user->name}}</p>
                    <p>Table No {{$cart->tableNo}}</p>
                    <p>Date {{$cart->created_at}}</p>
                    <table class="table">
                        <tr>
                            <td>Name</td>
                            <td>Price</td>
                            <td>Qty</td>
                            <td>Amount</td>
                        </tr>
                        @foreach($cart->cart->items as $item)
                            <tr>
                                <td>{{$item['item']['pName']}}</td>
                                <td>{{$item['item']['price']}}</td>
                                <td>{{$item['qty']}}</td>
                                <td>{{$item['amount']}}</td>

                            </tr>
                        @endforeach
                        <tr>
                            <td>Total Amount</td>
                            <td>{{$cart->cart->totalAmount}}</td>
                        </tr>

                    </table>
                    @endforeach
            </div>
        </div>
    </div>
    @endsection