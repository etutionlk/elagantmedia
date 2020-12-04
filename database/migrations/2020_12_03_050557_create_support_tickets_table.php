<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupportTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('support_tickets', function (Blueprint $table) {
            $table->id();
            $table->string("ref_no")->unique();
            $table->string("customer_name");
            $table->string("customer_email");
            $table->string("customer_phone_number");
            $table->text("ticket_description");
            $table->integer("ticket_status")->default(1)
                ->comment("1=open,2=pending,3=resolved,4=closed,5=waiting for customer reply");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('support_tickets');
    }
}
