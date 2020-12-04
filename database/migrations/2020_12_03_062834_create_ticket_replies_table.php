<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_replies', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("ticket_id")->unsigned();
            $table->bigInteger("agent_id")->default(0)->comment("0=customer reply, if not agent reply");
            $table->text("reply_description");
            $table->timestamps();

            $table->foreign("ticket_id")->references("id")
                ->on("support_tickets")->onDelete("cascade");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket_replies');
    }
}
