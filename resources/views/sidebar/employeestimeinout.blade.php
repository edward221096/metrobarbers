

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

@extends('layouts.sidebar')
@section('employeestimeinout')
    <div class="main_content">
        <div class="header">Manage Employee Time In and Out</div>
        <div class="info">
            <div class="form-header">Employee Table</div>
            <p>Date and Time: <span id="datetime"></span></p>

            <form method="POST" action="/employeestimeinout">

            {{ csrf_field() }}
            <!-- USER ID -->
                    <label for="id">User ID</label>
                    <div class="form-inline">
                        <input type="text" value="{{ Auth::User()->id }}" class="form-control form-control-sm" name="id" readonly>

                    </div>
            <!-- STATUS ID -->
                    <label for="status">Status</label>
                    <div class="form-inline">
                        <select name="status" class="form-control form-control-sm mr-1" value="status">
                            <option selected>Present</option>
                            <option>Absent</option>
                            <option>On-Training</option>
                        </select>
            <!-- TIME IN BUTTON -->
                        <input class="btn btn-primary btn-sm" name="submit" type="submit" value="Time In">
                    </div>
            </form>

            <table class="table table-striped">
        <thead>
        <tr>
            <th>Timelog ID</th>
            <th>Name</th>
            <th>Role</th>
            <th>Workday</th>
            <th>Status</th>
            <th>Time In</th>
            <th>Time Out</th>
            <th>Actions</th>
        </tr>
        </thead>

        <tbody>
        @foreach($employee as $row)
            <tr>
                <td>{{$row->tid}}</td>
                <td>{{$row->name}}</td>
                <td>{{$row->role}}</td>
                <td>{{$row->day}}</td>
                <td>{{$row->status}}</td>
                <td>{{$row->timein}}</td>
                <td>{{$row->timeout}}</td>
                <td>
                    @if($row->uid <> Auth::User()->id)
                    @else
                    <form method="POST" action="{{url('/employeestimeout').'/'.$row->tid}}">
                        {{csrf_field()}}
                        <input type="hidden" name="_method" value="PATCH"/>
{{--                    <a href="{{action('JoinUserTimelogsController@edit', $row->id)}}" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#editmodal" type="submit">Edit</a>--}}
                        <input class="btn btn-primary btn-sm" type="submit" value="Time Out">
                    </form>
                        @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
            {{ $employee->links() }}
    </div>
    </div>


    <script type="text/javascript">
        var dt = new Date();
        document.getElementById("datetime").innerHTML = dt.toLocaleString();
    </script>

@endsection

