@extends("layouts.app")


@section("content")
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-4">
                <form method="POST" action="{{ route("booking.store") }}">
                    @csrf
                    <fieldset>
                        <h2 class="label">Add Booking </h2>
                        <hr/>
                        <div class="form-group">
                            <label>Room Type</label>
                                <select class="form-control @error('room_name_id') is-invalid @enderror" name="room_name_id" id="room_type_id">
                                    <option value="">Select Room Type</option>
                                    @foreach($rooms as $room)
                                        <option value="<?=$room->room_type->room_type_id?>"><?=$room->room_type->room_name ?></option>
                                    @endforeach
                                </select>
                            @error('room_name_id')
                                <span class="help invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>No. of Rooms</label>
                            <input type="number" name="no_of_room" id="no_of_room" class="form-control @error('no_of_room') is-invalid @enderror"/>
                            @error('no_of_room')
                                <span class="help invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Customer Name</label>
                            <input type="text" name="cus_name" id="cus_name" class="form-control @error('cus_name') is-invalid @enderror"/>
                            @error('cus_name')
                                <span class="help invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>NIC / Passport No.</label>
                            <input type="text" name="nic_no" id="nic_no" class="form-control @error('nic_no') is-invalid @enderror"/>
                            @error('nic_no')
                                <span class="help invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Check In Date</label>
                                    <input type="date" name="check_in_date" id="check_in_date" class="form-control @error('check_in_date') is-invalid @enderror"/>
                                    @error('check_in_date')
                                    <span class="help invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Check Out Date</label>
                                    <input type="date" name="check_out_date" id="check_out_date" class="form-control @error('check_out_date') is-invalid @enderror"/>
                                    @error('check_out_date')
                                    <span class="help invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Number of Adults</label>
                                    <input type="number" min="1" name="adult" id="adult" class="form-control @error('adult') is-invalid @enderror"/>
                                    @error('adult')
                                    <span class="help invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Number of Kids</label>
                                    <input type="number" min="0" name="kids" id="kids" class="form-control @error('kids') is-invalid @enderror"/>
                                    @error('no_of_room')
                                    <span class="help invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>




                        <div class="form-group">
                            <button type="submit" class="btn btn-success" > Add Room Type</button>
                            <a href="{{ route("booking.index") }}" class="btn btn-default" > Cancel</a>
                        </div>

                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@endsection
