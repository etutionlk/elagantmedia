@extends("layouts.app")

<style>
    .new-ticket td{
        color: red;
    }
</style>

@section("content")
    <div class="container">
        <div class="row justify-content-center">
            <h2>Support Tickets</h2>

            <div class="" style="width: 100%">
                <div class="m-2">
                    <form action="{{ route('ticket.index') }}" method="GET" role="search">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <input type="text" name="customer_name" id="customer_name" class="form-control"
                                           value="{{ $customer_name }}"/>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <input type="submit" name="submit_btn" id="submit_btn" class="form-control" value="Search"/>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Ticket No.</th>
                            <th>Customer Name</th>
                            <th>Customer Email</th>
                            <th>Customer Phone Number</th>
                            <th>Ticket Status</th>
                            <th>Create At</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($tickets as $ticket)
                            <tr class="{{ count($ticket->ticket_reply) == 0?"new-ticket":"" }}">
                                <td><?=$ticket->id ?></td>
                                <td><?=$ticket->ticket_id ?></td>
                                <td><?=$ticket->customer_name ?></td>
                                <td><?=$ticket->customer_email ?></td>
                                <td><?=$ticket->customer_phone_number ?></td>
                                <td><?php
                                    if ($ticket->ticket_status == 1) {
                                        echo "Open";
                                    } elseif ($ticket->ticket_status == 2) {
                                        echo "Pending";
                                    } elseif ($ticket->ticket_status == 3) {
                                        echo "Resolved";
                                    } elseif ($ticket->ticket_status == 4) {
                                        echo "Closed";
                                    }else {
                                        echo "Waiting for Customer Reply";
                                    }
                                    ?>
                                </td>
                                <td><?=$ticket->created_at ?></td>

                                <td>
                                    <a href="{{ route("ticket.show",$ticket) }}" class="btn btn-success">Reply</a>

{{--                                    <a href="{{ route("ticket.destroy",$ticket) }}" class="btn btn-danger">Delete</a>--}}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" style="text-align: center">No Records Found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $tickets->links() }}
            </div>
        </div>
    </div>
@endsection
