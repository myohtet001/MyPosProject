@extends('layouts.template')
@section('title')
    New Product
    @endsection
@section('content')
    @include('partials.nav_bar')
    @include('nav_footer')
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div class="panel panel-primary">
                    <div class="panel panel-heading">Add New Product</div>
                    <form method="post" action="{{route('newProduct')}}" enctype="multipart/form-data">
                        <div class="panel panel-body">
                            <div class="form-group @if($errors->has('pName')) has-error @endif">
                                @if($errors->has('pName')) <span class="help-block">{{$errors->first('pName')}}</span> @endif
                                <input type="text" name="pName" id="pName" class="form-control" placeholder="Product Name">
                            </div>
                            <div class="form-group @if($errors->has('price')) has-error @endif ">
                                @if($errors->has('price'))<span class="help-block">{{$errors->first('price')}}</span> @endif
                                <input type="text" class="form-control" name="price" id="price" placeholder="Price">
                            </div>
                            <div class="form-group @if($errors->has('catName')) has-error @endif">
                               @if($errors->has('catName'))<span class="help-block">{{$errors->first('catName')}}</span> @endif

                                <select name="catName" id="catName"  class="form-control">

                                    <option value="">--Select Category--</option>
                                    @foreach($cat as $cats)

                                    <option value="{{$cats->id}}">{{$cats->categoryName}}</option>
                                        @endforeach

                                </select>
                            </div>
                            <div class="form-group @if($errors->has('cover')) has-error @endif">
                                @if($errors->has('cover')) <span class="help-block">{{$errors->first('cover')}}</span> @endif
                                <input type="file" name="cover" id="cove" class="form-control" placeholder="Product Cover" style="height: auto">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-primary">Save</button>
                            </div>
{{csrf_field()}}
                        </div>
                    </form>
                </div>

            </div>
            <div class="col-sm-8">
                <div class="panel panel-primary">
                    <div class="panel panel-heading">Show All Products</div>
                    <div class="panel panel-body">
                        <div class="table table-responsive">
                            <table class="table table-hover">
                                <tr>
                                    <td>No</td>
                                    <td> Name</td>
                                    <td> Price</td>
                                    <td>Categeory</td>
                                    <td>Created By</td>
                                    <td>Created Date</td>
                                    <td>Image</td>
                                    <td>Action</td>
                                </tr>
                                @foreach($product as $pro)
                                    <tr>
                                        <td>{{$pro->id}}</td>
                                        <td>{{$pro->pName}}</td>
                                        <td>{{$pro->price}}</td>
                                        <td>{{$pro->category->categoryName}}</td>
                                        <td>{{$pro->user->name}}</td>
                                        <td>{{date('d-m-Y ',strtotime($pro->created_at))}}</td>
                                        <td><img src="{{route('coverImage',['cover'=>$pro->cover])}}" style="height: 32px"> </td>
                                        <td><button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#e{{$pro->id}}">Edit</button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="e{{$pro->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title text-center" id="myModalLabel">Edit Product</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="post" action="{{route('updateProduct')}}" enctype="multipart/form-data">
                                                                <div class="form-group">
                                                                    <input type="hidden" class="form-control" name="id" id="id" value="{{$pro->id}}">

                                                        </div>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" name="p-name" id="p-name" value="{{$pro->pName}}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="number" class="form-control" name="price" id="price" value="{{$pro->price}}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <select name="category_id" class="form-control">
                                                                        <option>Select Category</option>
                                                                        @foreach($cat as $cats)
                                                                            <option value="{{$cats->id}}" @if($pro->category_id=$cats->id) selected @endif>{{$cats->categoryName}}</option>
                                                                            @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="file" class="form-control" style="height: auto" name="cover" id="cover" >
                                                                                                                                   </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                                        </div>
                                                                {{csrf_field()}}
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#{{$pro->id}}">Delete</button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="{{$pro->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title text-center text-info" id="myModalLabel">Delete Data</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p class="text text-danger btn btn-block btn btn-danger">Are you Sure to Delete <strong>{{$pro->pName}}</strong></p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            <a href="{{route('delete-product',['id'=>$pro->id])}}" class="btn btn-danger btn-sm">Confirm</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection