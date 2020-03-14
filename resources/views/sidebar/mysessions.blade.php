@extends('layouts.sidebar')

@section('mysessions')
    <div class="main_content">
        <div class="header">My Sessions</div>
        <div class="info">
            <div>View My Booked and Upcoming Sessions</div>
            <p></p>

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
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
