@extends("layouts.app")


@section("content")
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-4">
                <h2 class="label">Search Your Ticket</h2>
                <hr/>
                <div class="" style="width: 100%">
                    <div class="m-2">
                        <form action="{{ route('ticket.search') }}" method="GET" role="search">
                            <fieldset>
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <input type="text" name="ticket_id" id="ticket_id" class="form-control"
                                                   placeholder="Type your Ticket ID here..." />
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <input type="submit" name="submit_btn" id="submit_btn" class="form-control" value="Search"/>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
            </div>

                <div class="col-lg-6">
                    @if(isset($ticket))
                        <p>this dsd osdsds</p>
                    @endif
                </div>
        </div>

            <div class="col-lg-6 col-md-4">
                <form method="POST" action="{{ route("ticket.store") }}">
                    @csrf
                    <fieldset>
                        <h2 class="label">Support Ticket Form </h2>
                        <hr/>
                        <div class="form-group">
                            <label>Customer Name</label>
                            <input type="text" name="customer_name" id="customer_name"
                                   class="form-control @error('customer_name') is-invalid @enderror"
                                   value="{{ ( !empty(old('customer_name')) ? old('customer_name') : '' )  }} "/>
                            @error('customer_name')
                            <span class="help invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Customer Phone Number</label>
                            <input type="text" name="customer_phone_number" id="customer_phone_number"
                                   class="form-control @error('customer_phone_number') is-invalid @enderror"
                                   value="{{ ( !empty(old('customer_phone_number')) ? old('customer_phone_number') : '' ) }}"/>
                            @error('customer_phone_number')
                            <span class="help invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Customer Email Address</label>
                            <input type="email" name="customer_email" id="customer_email"
                                   class="form-control @error('customer_email') is-invalid @enderror"
                                   value="{{ ( !empty(old('customer_email')) ? old('customer_email') : '' ) }}"/>
                            @error('customer_email')
                            <span class="help invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Problem Description</label>
                            <textarea rows="5" name="ticket_description" id="ticket_description"
                                      class="form-control @error('ticket_description') is-invalid @enderror"
                            >{{ ( !empty(old('ticket_description')) ? old('ticket_description') : '' ) }}</textarea>
                            @error('ticket_description')
                            <span class="help invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success" > Submit Ticket</button>
                        </div>

                    </fieldset>
                </form>
            </div>
    </div>
@endsection
