@extends('layouts.template')
@section('title')
    POS Project
    @endsection
@section('content')
    @include('menu')
    @include('nav_footer')
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
               @foreach($pd as $pds)
                    <div class="col-sm-4">

                        <div class="thumbnail">
                            <img src="{{route('getImage',['image'=>$pds->cover])}}" style="height: auto" >
                            <div class="caption">
                                <h4>Name :{{$pds->pName}}</h4>
                                <h4>Price :{{$pds->price}}</h4>
                                <p> <a href="{{route('add.to.cart',['id'=>$pds->id])}}" class="btn btn-primary btn-block" >Add to Cat</a></p>
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>
            <div class="col-sm-4">
               <div class="table table-responsive">
                   <table class="table table-hover">


                       <tr>
                           <td>Name</td>
                           <td>Price</td>
                           <td>Qty</td>
                           <td>Amount</td>

                       </tr>
                       @if(Session::has('cart'))
                           @foreach(Session::get('cart')->items as $item)
                               <tr>
                                   <td>{{$item['item']['pName']}}</td>
                                   <td>{{$item['item']['price']}}</td>
                                   <td><a href="{{route('decreaseCart',['id'=>$item['item']['id']])}}"><span class="glyphicon glyphicon-minus-sign"></span> </a> {{$item['qty']}}<a href="{{route('increaseCart',['id'=>$item['item']['id']])}}"><span class="glyphicon glyphicon-plus-sign"></span> </a> </td>
                                   <td>{{$item['amount']}}</td>
                               </tr>
                           @endforeach
                           <tr>
                               <td>Total Amount</td>
                               <td>{{Session::get('cart')->totalAmount}}</td>

                               <tr>

                           </tr>


                       @endif


                   </table>
                   <form method="post" action="{{route('order-table')}}">
                   <div class="form-group">

                           <input type="text" class="form-control" name="tableNo" id="tableNo" placeholder="Table No">

                   </div>
                       <div class="form-group">
                           <button type="submit" class="btn btn-info btn-block">Check Out</button>

                       </div>
                       {{csrf_field()}}
                   </form>
                   <a href="{{route('clear-cart')}}" class="text text-danger btn btn-danger pull-right">Clear Cart</a>

               </div>
            </div>
        </div>
    </div>
    @endsection