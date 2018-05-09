@extends('layouts.template')
@section('title')
    User Management
    @endsection
@section('content')
    @include('partials.nav_bar')
    @include('nav_footer')
    <div class="container">
        <div class="row">
            <div class="col-sm-9">

                <div class="panel panel-primary">

                    <div class="panel panel-heading">User Management</div>
                    <div class="panel panel-body">
                        <div class="table table-responsive">
                            <table class="table table-hover">
                                <tr>
                                    <td>No</td>
                                    <td>Name</td>
                                    <td>Email</td>
                                    <td>Role</td>
                                    <td>Created Date</td>
                                    <td><td>Action</td></td>
                                </tr>

                                @foreach($user as $users)
                                    <tr>
                                        <td>{{$users->id}}</td>
                                        <td>{{$users->name}}</td>
                                        <td>{{$users->email}}</td>
                                        <td>@if($users->hasRole('Admin'))Admin @elseif($users->hasRole('Stuff'))Stuff @else No assign Role @endif</td>
                                        <td>{{date('d-m-Y /h:i:s A',strtotime($users->created_at))}}</td>

                                        <td><a href="{{route('edit-user',['id'=>$users->id])}}" class="btn btn-info btn-sm" data-toggle="modal" data-target="#{{$users->id}}">Edit</a> </td>

                                        <div class="container">
                                            <!-- Trigger the modal with a button -->


                                            <!-- Modal -->
                                            <div class="modal fade" id="{{$users->id}}" role="dialog">
                                                <div class="modal-dialog">

                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title text-center text-primary">Edit User Role</h4>

                                                        <div class="modal-body">
                                                           <form method="post" action="{{route('updateRole')}}">
                                                               <div class="form-group">

                                                                   <input type="hidden" value="{{$users->id}}" name="id" id="id">

                                                               </div>
                                                               <div class="form-group">
                                                                   <label for="roleName" class="control-label"></label>
                                                                   <select name="roleName" id="roleName" class="form-control">
                                                                       @foreach($ro as $ro1)
                                                                           <option>{{$ro1->name}}</option>
                                                                           @endforeach

                                                                   </select>
                                                               </div>

                                                            <div class="form-group">
                                                                <button type="submit" class="btn btn-primary">Update</button>

                                                            <button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    </div>
                                                               {{csrf_field()}}
                                                           </form>

                                                </div>
                                            </div>
                                        <td><a href="" class="btn btn-sm btn-danger">Delete</a> </td>
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