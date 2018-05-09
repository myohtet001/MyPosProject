@extends('layouts.template')
@section('title')
   Add Category
    @endsection
@section('content')
    @include('partials.nav_bar')
    @include('nav_footer')
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                @if(Session('info'))<div class="alert alert-success">{{Session('info')}}</div> @endif
                <div class="panel panel-primary">
                    <div class="panel panel-heading">Add Category</div>
                     <div class="panel panel-body">
                         <form method="post" action="{{route('newCategory')}}">
                             <div class="form-group @if($errors->has('categoryName')) has-error @endif ">
                                 @if($errors->has('categoryName')) <span class="help-block">{{$errors->first('categoryName')}}</span> @endif
                                 <label for="categoryName" class="control-label">Category Name</label>
                                 <input type="text" class="form-control" name="categoryName" id="categoryName">
                             </div>
                             <div class="form-group">
                                 <button type="submit" class="btn btn-primary">Save Change</button>
                             </div>
                             {{csrf_field()}}
                         </form>
                     </div>
                </div>

            </div>
            <div class="col-sm-8">
                @if(Session('message'))<div class="alert alert-success">{{Session('message')}}</div> @endif
                <div class="panel panel-primary">
                    <div class="panel panel-heading">Show Category</div>
                    <div class="panel panel-body">
                        <div class="table table-responsive">
                            <table class="table table-hover">
                                <tr>
                                    <td>No</td>
                                    <td>Category Name</td>
                                    <td>Created Date</td>
                                    <td>Delete</td>
                                </tr>
                                @foreach($cat as $row)
                                    <tr>
                                    <td>{{$row->id}}</td>
                                        <td>{{$row->categoryName}}</td>
                                        <td>{{date('d-m-Y /h:i:s A',strtotime($row->created_at))}}</td>
                                        <td><a onclick="return confirm('Are You Sure  Delete Category')" href="{{route('delete-Category',['categoryName'=>$row->categoryName])}}" class="btn btn-sm btn-danger">Delete</a> </td>
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