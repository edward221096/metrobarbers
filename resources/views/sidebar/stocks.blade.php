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
@section('stocks')
    <div class="main_content">
        <div class="header">Manage Item Stocks</div>
        <div class="info">
            <div class="form-header">Item Stocks</div>

            <!-- Add Employee Modal -->
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addstock">
                Add
            </button>

            <p></p>

            <!-- SHOW DATA IN A TABLE-->
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Stock Item Name</th>
                    <th>Quantity</th>
                    <th>Actions</th>
                </tr>
                </thead>

                <tbody>
                @foreach($stock as $row)
                    <tr>
                        <td>{{$row->id}}</td>
                        <td>{{$row->stock_item_name}}</td>
                        <td>{{$row->quantity}}</td>
                        <td>
                            <form action="stocks/{{$row->id}}" method="POST">
                            @csrf
                            @method("DELETE")
                            <!-- EDIT FUNCTIONS TYPE BUTTON -->
                                <a href="#" class="btn btn-secondary btn-sm"
                                   data-mystockid="{{$row->id}}"
                                   data-mystockitemname="{{$row->stock_item_name}}"
                                   data-myquantity="{{$row->quantity}}"
                                   data-toggle="modal" data-target="#editstock">Edit</a>
                                <input class="btn btn-danger btn-sm" type="submit" name="submit" value="Delete">
                            </form>
                        </td>
                @endforeach
                </tbody>
            </table>
            {{$stock->links()}}
        </div>
    </div>

    <!-- EDIT Service Modal -->
    <div class="modal fade" id="editstock" tabindex="-1" role="dialog" aria-labelledby="editstocklabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editstock">Edit Stock and Quantity Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('stocks.update', 'test')}}" method="POST">
                    {{method_field('PATCH')}}
                    {{csrf_field()}}
                    <div class="modal-body">
                        <input type="hidden" name="stock_id" id="stk_id" value="">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="stock_item_name">Stock Item Name</label>
                                <input type="text" class="form-control form-control-sm @error('stock_item_name') is-invalid @enderror"
                                       name="stock_item_name" id="stk_item_name" required>
                                @error('stock_item_name')
                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="quantity">Quantity</label>
                                <input type="number" class="form-control form-control-sm @error('quantity') is-invalid @enderror" name="quantity" id="qty" required>
                                @error('quantity')
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

    <!-- Add Service Modal -->
    <div class="modal fade" id="addstock" tabindex="-1" role="dialog" aria-labelledby="addstocklabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addstock">Add a new Stock Item and Quantity</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="/storestock" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="stock_item_name">Item Stock Name</label>
                                <input type="text" class="form-control form-control-sm" name="stock_item_name" placeholder="Stock Item Name" required autocomplete="Stock Item Name">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="quantity">Quantity</label>
                                <input type="number" class="form-control form-control-sm" name="quantity" placeholder="Quantity" required autocomplete="Quantity">
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
        $('#editstock').on('show.bs.modal', function (event) {

            var button = $(event.relatedTarget)
            var stk_id = button.data('mystockid')
            var stk_item_name = button.data('mystockitemname')
            var qty = button.data('myquantity')
            // var cost = button.data('mycost')
            // var role = button.data('myrole')
            // var address = button.data('myaddress')
            // var phonenumber = button.data('myphonenumber')
            var modal = $(this)

            modal.find('.modal-body #stk_id').val(stk_id);
            modal.find('.modal-body #stk_item_name').val(stk_item_name);
            modal.find('.modal-body #qty').val(qty);
            // modal.find('.modal-body #cost').val(cost)
            // modal.find('.modal-body #role').val(role);
            // modal.find('.modal-body #address').val(address);
            // modal.find('.modal-body #phonenumber').val(phonenumber);
        })
    </script>
</html>
@endsection
