@extends('layouts.sidebar')



@section('home')
    <div class="main_content">
        <div class="header">Book a Services</div>
        <div class="info">
            <div>Select and Pick a Hair Style and Appointment Date</div>

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
                            <!-- EDIT FUNCTIONS TYPE BUTTON -->
                            @if(Auth::User()->role == 'Barber' || Auth::User()->role == 'Receptionist')
                                @else
                                <a href="#" class="btn btn-primary btn-default"
                                   data-myserviceid="{{$row->id}}"
                                   data-myuserid="{{ Auth::user()->id }}"
                                   data-myservicename="{{$row->service_name}}"
                                   data-mydescription="{{$row->description}}"
                                   data-toggle="modal" data-target="#booksession">Book</a>
                                @endif
                        </td>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- EDIT Service Modal -->
    <div class="modal fade" id="booksession" tabindex="-1" role="dialog" aria-labelledby="booksessionlabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="booksession">Book a Session</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/storesession" method="POST">
                    {{csrf_field()}}
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="userid">User ID</label>
                                <input type="text" class="form-control form-control-sm" name="userid" id="userid" readonly>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="servid">Service ID</label>
                                    <input type="text" class="form-control form-control-sm" name="servid" id="servid" readonly>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="description">Description</label>
                                <textarea type="text" rows="5" class="form-control form-control-sm" name="description" id="description" readonly></textarea>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="emp_id">Barber</label>
                                <select name="emp_id" class="form-control form-control-sm" value="text">
                                    @foreach(App\Employee::orderBy('name')->get() as $employee)
                                        <option value="{{$employee->id}}">{{$employee->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="datetime">Date and Time</label>
                                    <input type='datetime-local' class="form-control form-control-sm @error('datetime') is-invalid @enderror" name="datetime"/>
                                        @error('datetime')
                                        <span class="invalid-feedback" role="alert" autofocus>
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

    <script type="text/javascript">

        //EDIT MODAL IN EMPLOYEE
        $('#booksession').on('show.bs.modal', function (event) {

            var button = $(event.relatedTarget)
            var servid = button.data('myserviceid')
            var service_name = button.data('myservicename')
            var description = button.data('mydescription')
            var userid = button.data('myuserid')
            // var role = button.data('myrole')
            // var address = button.data('myaddress')
            // var phonenumber = button.data('myphonenumber')
            var modal = $(this)

            modal.find('.modal-body #servid').val(servid);
            modal.find('.modal-body #service_name').val(service_name);
            modal.find('.modal-body #description').val(description);
            modal.find('.modal-body #userid').val(userid)
            // modal.find('.modal-body #role').val(role);
            // modal.find('.modal-body #address').val(address);
            // modal.find('.modal-body #phonenumber').val(phonenumber);
        })
        //DATE TIME PICKER
        $(function () {
            $('#bookdatetime').datetimepicker();
        });
    </script>
@endsection
