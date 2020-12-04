@extends("layouts.app")

<style>
    .customer-reply {
        text-align: justify;
    }

    .agent-reply {
        text-align: justify;
        background-color: #f5f5ef;
        padding: 5px;
        border-radius: 10px;
    }

    .agent-reply > p {
        text-align: justify;
    }

</style>

@section("content")
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-6">
                @if (!Auth::guest())
                    <div class="col-lg-3">
                        <a class="btn btn-primary form-control" href="{{ route("ticket.index") }}"><i class="fa fa-backward"></i> Back to Tickets </a>
                    </div>
                    <hr/>
                @endif

                <h2 class="label">Support Ticket - #{{ $ticket->ref_no }}</h2>
                <hr/>

                <!-- customer reply -->
                <div class="customer-reply">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="pull-left"><label><i class="fa fa-user"></i> <b><?= $ticket->customer_name ?></b></label></div>
                            <div class="pull-right"><label><i class="fa fa-clock-o"></i>
                                    <?php
                                    $date=date_create($ticket->created_at);
                                    echo date_format($date,"H:i:s d-m-Y");
                                    ?>
                                </label></div>

                        </div>
                    </div>
                    <div class="row">
                        <p ><?= $ticket->ticket_description ?></p>
                    </div>
                </div>
                <hr/>
                <!-- customer reply ends -->

                @foreach($ticket->ticket_reply as $reply)

                    @if($reply->agent_id == 0)
                        <!-- customer reply -->
                            <div class="customer-reply">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="pull-left"><label><i class="fa fa-user"></i> <b><?= $ticket->customer_name ?></b></label></div>
                                        <div class="pull-right"><label><i class="fa fa-clock-o"></i>
                                                <?php
                                                $date=date_create($reply->created_at);
                                                echo date_format($date,"H:i:s d-m-Y");
                                                ?>
                                            </label></div>

                                    </div>
                                </div>
                                <div class="row">
                                    <p ><?= $reply->reply_description ?></p>
                                </div>
                            </div>
                            <hr/>
                            <!-- customer reply ends -->

                    @else
                        <!-- agent reply -->
                            <div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="pull-right"><label><i class="fa fa-reply"></i> <b><?= $reply->agent["name"] ?></b></label></div>
                                        <div class="pull-left"><label><i class="fa fa-clock-o"></i>
                                                <?php
                                                $date=date_create($reply->created_at);
                                                echo date_format($date,"H:i:s d-m-Y");
                                                ?>
                                            </label></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <p class="agent-reply"><?= $reply->reply_description ?></p>
                                </div>
                            </div>
                            <hr/>
                    @endif


                @endforeach

                <!-- agent reply ends-->

                <div class="row">
                    <div class="col-lg-12">
                        <form method="POST" action="{{ route("ticketreply.store") }}" id="reply_form">
                            <fieldset>
                                @csrf
                                <div class="form-group">
                                    <input type="hidden" name="ticket_id" id="ticket_id" value="{{ $ticket->id }}"/>
                                    <textarea rows="4" name="ticket_reply" id="ticket_reply" class="form-control"></textarea>
                                </div>

                                <div class="form-group pull-right">
                                    <input type="submit" name="submit" id="submit1" class="btn btn-success" value="Reply"/>
                                </div>

                            </fieldset>
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection


<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js" >
    $(document).ready(function() {alert("Dssd");
        $("#ticket_reply").onkeyup(function () {

            if ($(this).text().length > 0) {
                $("#submit").attr("disabled",false);
            }
        });

        $("#submit1").click(function(e){
            alert();
            e.preventDefault();

            var _token = $("input[name='_token']").val();
            var ticket_reply = $("#ticket_reply").text();

            $.ajax({
                url: "{{ route("ticketreply.store") }}",
                type:'POST',
                data: $("#reply_form").serialize(),
                success: function(data) {
                    // printMsg(data);
                }
            });
        });
    });
</script>
