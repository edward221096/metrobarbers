@extends('layouts.sidebar')

@section('sessions')
    <div class="main_content">
        <div class="header">Manage Upcoming Sessions</div>
        <div class="info">
            <div>Manage Customers Booked Session</div>

            <p></p>

            <form action="/search" method="GET">
                <div class="input-group">
                    <input type="search" class="form-control form-control-sm" name="search"
                           placeholder="Search User">
                    <span class="input-group-prepend">
                        <button type="submit" class="btn btn-primary btn-sm">
                            Search
                        </button>
                    </span>
                </div>
            </form>
            <!-- SHOW DATA IN A TABLE-->
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>Session ID</th>
                    <th>Customer Name</th>
                    <th>Employee Name</th>
                    <th>Service Name</th>
                    <th>Cost</th>
                    <th>Start Date & Time</th>
                    <th>End Date & Time</th>
                    <th>Paid Amount</th>
                    <th>Change Amount</th>
                    <th>Actions</th>
                </tr>
                </thead>

                <tbody>
                @foreach($session as $row)
                    <tr>
                        <td>{{$row->SID}}</td>
                        <td>{{$row->customer_name}}</td>
                        <td>{{$row->employee_name}}</td>
                        <td>{{$row->service_name}}</td>
                        <td>{{$row->cost}}</td>
                        <td>{{$row->start_time}}</td>
                        <td>{{$row->end_time}}</td>
                        <td>{{$row->paid_amount}}</td>
                        <td>{{$row->change_amount}}</td>
                        <td>
                            <!-- EDIT FUNCTIONS TYPE BUTTON -->
                            <a href="#" class="btn btn-primary btn-sm"
                               data-mysessionid="{{$row->SID}}"
                               data-mycustomername="{{$row->customer_name }}"
                               data-myemployeename="{{$row->employee_name}}"
                               data-myservicename="{{$row->service_name}}"
                               data-mycost="{{$row->cost}}"
                               data-myenddate="{{Now()}}"
                               data-toggle="modal" data-target="#editsession">End Session and Pay</a>
                        </td>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- EDIT SESSION Modal -->
    <div class="modal fade" id="editsession" tabindex="-1" role="dialog" aria-labelledby="editsessionlabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editsession">End Session and Payment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('sessions.update', 'test')}}" method="POST">
                    {{method_field('PATCH')}}
                    {{csrf_field()}}
                    <div class="modal-body">
                        <input type="hidden" name="session_id" id="ses_id" value="">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="ses_id">Session ID</label>
                                <input type="text" class="form-control form-control-sm" name="ses_id" id="ses_id" readonly>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="customer_name">Customer Name</label>
                                <input type="text" rows="5" class="form-control form-control-sm" name="customer_name" id="customer_name" readonly>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="employee_name">Barber Name</label>
                                <input type="text" class="form-control form-control-sm" name="employee_name" id="employee_name" readonly>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="service_name">Service Name</label>
                                <input type="text" class="form-control form-control-sm" name="service_name" id="service_name" readonly>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="end_time">End Date & Time </label>
                                <input type="datetime" class="form-control form-control-sm" name="end_time" value="{{now()}}" readonly>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="cost">Cost</label>
                                <input type="number" class="form-control form-control-sm" name="cost" id="cost" readonly>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="paid_amount">Paid Amount</label>
                                <input type="number" class="form-control form-control-sm" name="paid_amount" id="paid_amount" placeholder="0000.00">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="change_amount">Change Amount</label>
                                <input type="number" class="form-control form-control-sm" name="change_amount" id="minus" placeholder="0000.00">
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
        $('#editsession').on('show.bs.modal', function (event) {

            var button = $(event.relatedTarget)
            var ses_id = button.data('mysessionid')
            var customer_name = button.data('mycustomername')
            var employee_name = button.data('myemployeename')
            var service_name = button.data('myservicename')
            var cost = button.data('mycost')
            var endtime = button.data('myenddate')
            var modal = $(this)

            modal.find('.modal-body #ses_id').val(ses_id);
            modal.find('.modal-body #customer_name').val(customer_name);
            modal.find('.modal-body #employee_name').val(employee_name);
            modal.find('.modal-body #service_name').val(service_name)
            modal.find('.modal-body #cost').val(cost);
            modal.find('.modal-body #endtime').val(endtime);
        })

        //ADD TWO INPUT TYPE VALUES
        $(function() {
            $("#paid_amount, #cost").on("keydown keyup", minus);
            function minus() {
                $("#minus").val(Number($("#paid_amount").val()) - Number($("#cost").val()));
            }
        });
    </script>
@endsection
