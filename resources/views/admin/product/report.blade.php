@extends('layouts.template')
@section('title')
    Report
    @endsection
@section('content')
    @include('partials.nav_bar')
    <div class="container">
        <div class="row">
            @foreach($cart as $cart)
                <div class="panel panel-primary">
                <div class="panel panel-heading">Table No :{{$cart->tableNo}} | Waiter {{$cart->user->name}}<span class="pull-right">{{date('d-m-Y /h:i:s A',strtotime($cart->created_at))}}</span> </div>
                <div class="panel panel-body">
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
                        <tr>
                            <td>

                        </tr>
                    </table>
                </div>
                    <a target="_blank" href="{{route('printOrder',['id'=>$cart->id])}}"><span class="glyphicon glyphicon-print pull-right">Print</span> </a></td>

                @endforeach
        </div>


    </div>
    </div>
    @endsection