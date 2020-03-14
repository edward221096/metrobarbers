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
@section('services')
    <div class="main_content">
        <div class="header">Manage Services</div>
        <div class="info">
            <div class="form-header">Service Form</div>

            <!-- Add Employee Modal -->
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addservice">
                Add
            </button>

            <p></p>

            <!-- SHOW DATA IN A TABLE-->
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Service Name</th>
                    <th>Description</th>
                    <th>Cost</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
                </thead>

                <tbody>
                @foreach($service as $row)
                    <tr>
                        <td>{{$row->id}}</td>
                        <td>{{$row->service_name}}</td>
                        <td>{{$row->description}}</td>
                        <td>{{$row->cost}}</td>
                        <td><img src="{{ asset('uploads/service/' . $row->image) }}" width="100px;" height="100px;" alt="Image"></td>
                        <td>
                            <form action="services/{{$row->id}}" method="POST">
                            @csrf
                            @method("DELETE")
                            <!-- EDIT FUNCTIONS TYPE BUTTON -->
                                <a href="#" class="btn btn-secondary btn-sm"
                                   data-myserviceid="{{$row->id}}"
                                   data-myservicename="{{$row->service_name}}"
                                   data-mydescription="{{$row->description}}"
                                   data-mycost="{{$row->cost}}"
                                   data-myimage="{{$row->image}}"
                                   data-toggle="modal" data-target="#editservice">Edit</a>
                                <input class="btn btn-danger btn-sm" type="submit" name="submit" value="Delete">
                            </form>
                        </td>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- EDIT Service Modal -->
    <div class="modal fade" id="editservice" tabindex="-1" role="dialog" aria-labelledby="editservicelabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editservice">Edit Employee Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('services.update', [$row->id])}}" method="POST" enctype="multipart/form-data">
                    {{method_field('PATCH')}}
                    {{csrf_field()}}
                    <div class="modal-body">
                        <input type="hidden" name="service_id" id="serv_id" value="">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="service_name">Service Name</label>
                                <input type="text" class="form-control form-control-sm @error('service_name') is-invalid @enderror" name="service_name"
                                       placeholder="Service Name" required autocomplete="Service Name" id="service_name" autofocus>
                                @error('service_name')
                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="description">Description</label>
                                <textarea type="text" rows="5" class="form-control form-control-sm @error('description') is-invalid @enderror"
                                          name="description" placeholder="Description" required autocomplete="Description" id="description" autofocus></textarea>
                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="cost">Cost</label>
                                <input type="number" class="form-control form-control-sm @error('cost') is-invalid @enderror" name="cost"
                                       placeholder="Cost" step=".01" required autocomplete="cost" id="cost">
                                @error('cost')
                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="image">Choose a Service Image</label>
                                <p>
                                    <input type="file" class="form-control-sm @error('description') is-invalid @enderror" name="image">
                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </p>
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

    <!-- Add Service Modal -->
    <div class="modal fade" id="addservice" tabindex="-1" role="dialog" aria-labelledby="addservicelabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addservice">Add a new Service</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="/storeservices" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="service_name">Service Name</label>
                                <input type="text" class="form-control form-control-sm @error('service_name') is-invalid @enderror" name="service_name"
                                       placeholder="Service Name" required autocomplete="Service Name" autofocus>
                                @error('service_name')
                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="description">Description</label>
                                <textarea type="text" rows="5" class="form-control form-control-sm @error('description') is-invalid @enderror"
                                          name="description" placeholder="Description" required autocomplete="Description" autofocus></textarea>
                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="cost">Cost</label>
                                <input type="number" class="form-control form-control-sm @error('cost') is-invalid @enderror" name="cost" placeholder="Cost" step=".01" required autocomplete="cost">
                                @error('cost')
                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                    <label for="image">Choose a Service Image</label>
                                <p>
                                    <input type="file" class="form-control-sm @error('description') is-invalid @enderror" name="image">
                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </p>
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
        $('#editservice').on('show.bs.modal', function (event) {

            var button = $(event.relatedTarget)
            var serv_id = button.data('myserviceid')
            var service_name = button.data('myservicename')
            var description = button.data('mydescription')
            var cost = button.data('mycost')
            // var role = button.data('myrole')
            // var address = button.data('myaddress')
            // var phonenumber = button.data('myphonenumber')
            var modal = $(this)

            modal.find('.modal-body #serv_id').val(serv_id);
            modal.find('.modal-body #service_name').val(service_name);
            modal.find('.modal-body #description').val(description);
            modal.find('.modal-body #cost').val(cost)
            // modal.find('.modal-body #role').val(role);
            // modal.find('.modal-body #address').val(address);
            // modal.find('.modal-body #phonenumber').val(phonenumber);
        })
    </script>
</html>
@endsection
