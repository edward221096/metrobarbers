<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<style>
        .form-header{
            font-size: 17px;
        }

        .info{
            font-size: 15px;

        }
        .form-row{
            margin: 0px;
        }
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

@extends('layouts.sidebar')
@section('employees')
    <div class="main_content">
        <div class="header">Manage Employees</div>
        <div class="info">
            <div class="form-header">Employee Form</div>

            <!-- Add Employee Modal -->
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addemployeemodal">
                Add
            </button>


        <p></p>

            <!-- SHOW DATA IN A TABLE-->
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>E-mail</th>
                        <th>Address</th>
                        <th>Phone Number</th>
                        <th>Actions</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($users as $row)
                        <tr>
                            <td>{{$row->id}}</td>
                            <td>{{$row->name}}</td>
                            <td>{{$row->username}}</td>
                            <td>{{$row->role}}</td>
                            <td>{{$row->email}}</td>
                            <td>{{$row->address}}</td>
                            <td>{{$row->phonenumber}}</td>
                            <td>
                                <form action="employees/{{$row->id}}" method="POST">
                                        @csrf
                                        @method("DELETE")
                                        <!-- EDIT FUNCTIONS TYPE BUTTON -->
                                            <a href="#" class="btn btn-secondary btn-sm"
                                               data-myempid="{{$row->id}}"
                                               data-myfullname="{{$row->name}}"
                                               data-myemailaddress="{{$row->email}}"
                                               data-myusername="{{$row->username}}"
                                               data-myrole="{{$row->role}}"
                                               data-myaddress="{{$row->address}}"
                                               data-myphonenumber="{{$row->phonenumber}}"
                                               data-toggle="modal" data-target="#editemployee">Edit</a>
                                    <input class="btn btn-danger btn-sm" type="submit" name="submit" value="Delete">
                                    </form>
                            </td>
                    @endforeach
                    </tbody>
{{--                    <script type="text/javascript">--}}
{{--                        $('#search').on('keyup',function(){--}}
{{--                            $value=$(this).val();--}}
{{--                            $.ajax({--}}
{{--                                type : 'get',--}}
{{--                                url : '{{URL::to('search')}}',--}}
{{--                                data:{'search':$value},--}}
{{--                                success:function(data){--}}
{{--                                    $('tbody').html(data);--}}
{{--                                }--}}
{{--                            });--}}
{{--                        })--}}
{{--                    </script>--}}
{{--                    <script type="text/javascript">--}}
{{--                        $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });--}}
{{--                    </script>--}}
                </table>
    {{$users->links()}}
    </div>

    </div>

    <!-- EDIT Employee Modal -->
    <div class="modal fade" id="editemployee" tabindex="-1" role="dialog" aria-labelledby="editemployeelabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editemployee">Edit Employee Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('employees.update', 'test')}}" method="POST">
                    {{method_field('PATCH')}}
                    {{csrf_field()}}
                    <div class="modal-body">
                        <input type="hidden" name="employee_id" id="emp_id" value="">
                        <!-- FULL NAME TEXTBOX -->
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">Full Name</label>
                                <input type="text" class="form-control form-control-sm  @error('name') is-invalid @enderror"
                                       name="name" placeholder="Full Name" required autocomplete="name" id="full_name">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                @enderror

                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">E-mail Address</label>
                                <input type="text" class="form-control form-control-sm @error('email') is-invalid @enderror"
                                       name="email" placeholder="E-mail Address" required autocomplete="email" autofocus id="email_address">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                @enderror

                            </div>
                        </div>

                        <!-- USERNAME TEXTBOX -->
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="username">Username</label>
                                <input type="text" class="form-control form-control-sm @error('username') is-invalid @enderror"
                                       name="username" placeholder="Username" required autocomplete="username" autofocus id="username">
                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                @enderror
                            </div>
                            <!-- ADDRESS TEXTBOX -->
                                <div class="form-group col-md-6">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control form-control-sm"
                                           name="address" placeholder="Address" id="address">
                                </div>
                            </div>

                        <div class="form-row">
                            <!-- PHONENUMBER TEXTBOX -->
                            <div class="form-group col-md-6">
                                <label for="phonenumber">Phone Number</label>
                                <input type="number" class="form-control form-control-sm"
                                       name="phonenumber" placeholder="Phone Number" id="phonenumber">
                            </div>
                            <!-- POSITION COMBOBOX-->
                            <div class="form-group col-md-6">
                                <label for="role">Role</label>
                                <select name="role" class="form-control form-control-sm @error('role') is-invalid @enderror"
                                        id="role" autofocus >
                                    <option selected>Barber</option>
                                    <option>Receptionist</option>
                                    <option>User</option>
                                </select>
                                @error('role')
                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary btn-sm">Save Changes</button>
                        </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add Employee Modal -->
    <div class="modal fade" id="addemployeemodal" tabindex="-1" role="dialog" aria-labelledby="addemployeemodallabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addemployeemodal">Add a new Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="/employees">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <!-- FULL NAME TEXTBOX -->
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">Full Name</label>
                                <input type="text" class="form-control form-control-sm  @error('name') is-invalid @enderror" name="name" placeholder="Full Name" required autocomplete="name" autofocus>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                @enderror

                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">E-mail Address</label>
                                <input type="text" class="form-control form-control-sm @error('email') is-invalid @enderror" name="email" placeholder="E-mail Address" required autocomplete="email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                @enderror

                            </div>
                        </div>

                        <!-- USERNAME TEXTBOX -->
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="username">Username</label>
                                <input type="text" class="form-control form-control-sm @error('username') is-invalid @enderror" name="username" placeholder="Username" required autocomplete="username">
                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                @enderror
                            </div>
                            <!-- PASSWORD TEXTBOX -->
                            <div class="form-group col-md-6">
                                <label for="password">Password</label>
                                <input type="password" class="form-control form-control-sm @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                @enderror
                            </div>
                        </div>
                        <!-- ADDRESS TEXTBOX -->
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="address">Address</label>
                                <input type="text" class="form-control form-control-sm @error('address') is-invalid @enderror" name="address" placeholder="Address" required autocomplete="address">
                                @error('addrees')
                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                @enderror
                            </div>
                            <!-- PHONENUMBER TEXTBOX -->
                            <div class="form-group col-md-4">
                                <label for="phonenumber">Phone Number</label>
                                <input type="number" class="form-control form-control-sm @error('phonenumber') is-invalid @enderror" name="phonenumber" placeholder="Phone Number" required autocomplete="phonenumber">
                                @error('phonenumber')
                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                @enderror
                            </div>
                            <!-- POSITION COMBOBOX-->
                            <div class="form-group col-md-2">
                                <label for="role">Role</label>
                                <select name="role" class="form-control form-control-sm @error('role') is-invalid @enderror">
                                    <option selected>Barber</option>
                                    <option>Receptionist</option>
                                    <option>User</option>
                                </select>
                                @error('role')
                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <!-- Add Employee Button-->
                        <input class="btn btn-primary btn-sm" type="submit" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    //EDIT MODAL IN EMPLOYEE
    $('#editemployee').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)
    var emp_id = button.data('myempid')
    var full_name = button.data('myfullname')
    var email_address = button.data('myemailaddress')
    var username = button.data('myusername')
    var role = button.data('myrole')
    var address = button.data('myaddress')
    var phonenumber = button.data('myphonenumber')
    var modal = $(this)

    modal.find('.modal-body #emp_id').val(emp_id);
    modal.find('.modal-body #full_name').val(full_name);
    modal.find('.modal-body #email_address').val(email_address);
    modal.find('.modal-body #username').val(username)
    modal.find('.modal-body #role').val(role);
    modal.find('.modal-body #address').val(address);
    modal.find('.modal-body #phonenumber').val(phonenumber);
    })
    </script>

</html>
@endsection

