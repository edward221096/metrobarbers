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
@section('customers')
    <div class="main_content">
        <div class="header">Manage Customer</div>
        <div class="info">
            <div class="form-header">Customer Form</div>

            <p></p>

            <!-- SHOW CUSTOMER DATA IN A TABLE-->
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Address</th>
                    <th>E-mail Address</th>
                    <th>Username</th>
                    <th>Phone Number</th>
                    <th>Gender</th>
                    <th>Membership Type</th>
                    <th>Actions</th>
                </tr>
                </thead>

                <tbody>
                @foreach($customer as $row)
                    <tr>
                        <td>{{$row->id}}</td>
                        <td>{{$row->name}}</td>
                        <td>{{$row->role}}</td>
                        <td>{{$row->address}}</td>
                        <td>{{$row->email}}</td>
                        <td>{{$row->username}}</td>
                        <td>{{$row->phonenumber}}</td>
                        <td>{{$row->gender}}</td>
                        <td>{{$row->membership_type}}</td>

                        <td>
                            <!-- DELETE CUSTOMER DATA BASED FROM ID -->
                            <form action="customers/{{$row->id}}" method="POST">
                            @csrf
                            @method("DELETE")
                            <!-- EDIT DATA BY PASSING THE VALUE TO MODAL BUTTON BASED FROM ID-->
                                <a href="#" class="btn btn-secondary btn-sm"
                                   data-mycustid="{{$row->id}}"
                                   data-myfullname="{{$row->name}}"
                                   data-myrole="{{$row->role}}"
                                   data-myaddress="{{$row->address}}"
                                   data-myemailaddress="{{$row->email}}"
                                   data-myusername="{{$row->username}}"
                                   data-myphonenumber="{{$row->phonenumber}}"
                                   data-mygender="{{$row->gender}}"
                                   data-mymembershiptype="{{$row->membership_type}}"
                                   data-toggle="modal" data-target="#editcustomer">Edit</a>
                                <input class="btn btn-danger btn-sm" type="submit" name="submit" value="Delete">
                            </form>
                        </td>
                @endforeach
                </tbody>
            </table>
            <!-- PAGINATION -->
            {{$customer->links()}}
        </div>
    </div>

    <!-- EDIT CUSTOMER MODAL -->
    <div class="modal fade" id="editcustomer" tabindex="-1" role="dialog" aria-labelledby="editcustomerlabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editcustomer">Edit Customer Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('customers.update', 'test')}}" method="POST">
                    {{method_field('PATCH')}}
                    {{csrf_field()}}
                    <div class="modal-body">
                        <input type="hidden" name="customer_id" id="cust_id" value="">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="full_name">Full Name</label>
                                <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" name="name" id="full_name">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="role">Role</label>
                                <select name="role" class="form-control form-control-sm" id="role">
                                    <option>Barber</option>
                                    <option>Receptionist</option>
                                    <option>User</option>
                                </select>
                            </div>
                        </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control form-control-sm @error('address') is-invalid @enderror" name="address" id="address">
                                    @error('address')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="e-mail">E-mail Address</label>
                                    <input type="text" class="form-control form-control-sm @error('email') is-invalid @enderror" name="email" id="email_address">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="username">Username</label>
                                <input type="text" class="form-control form-control-sm @error('username') is-invalid @enderror" name="username" id="username">
                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="phonenumber">Phonenumber</label>
                                <input type="text" class="form-control form-control-sm" name="phonenumber" id="phonenumber">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="gender">Gender</label>
                                <select name="gender" class="form-control form-control-sm" id="gender">
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="membership_type">Membership</label>
                                <select name="membership_type" class="form-control form-control-sm" id="membership_type">
                                    <option>Non-Member</option>
                                    <option>Member</option>
                                </select>
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

<!-- EDIT MODAL FOR CUSTOMER -->
    <script type="text/javascript">
        //EDIT MODAL IN EMPLOYEE
        $('#editcustomer').on('show.bs.modal', function (event) {

            var button = $(event.relatedTarget)
            var cust_id = button.data('mycustid')
            var full_name = button.data('myfullname')
            var role = button.data('myrole')
            var address = button.data('myaddress')
            var email_address = button.data('myemailaddress')
            var username = button.data('myusername')
            var phonenumber = button.data('myphonenumber')
            var gender = button.data('mygender')
            var membership_type = button.data('mymembershiptype')
            var modal = $(this)

            modal.find('.modal-body #cust_id').val(cust_id);
            modal.find('.modal-body #full_name').val(full_name);
            modal.find('.modal-body #role').val(role);
            modal.find('.modal-body #address').val(address);
            modal.find('.modal-body #email_address').val(email_address);
            modal.find('.modal-body #username').val(username)
            modal.find('.modal-body #phonenumber').val(phonenumber);
            modal.find('.modal-body #gender').val(gender);
            modal.find('.modal-body #membership_type').val(membership_type);
        })
    </script>
@endsection
