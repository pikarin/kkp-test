<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ships', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'user_id');
            $table->foreignIdFor(User::class, 'verified_by')->nullable();
            $table->string('code');
            $table->string('name');
            $table->string('owner_name');
            $table->string('owner_address');
            $table->integer('size');
            $table->string('captain_name');
            $table->integer('crew_size');
            $table->string('picture_path');
            $table->string('license_number');
            $table->string('permit_document_path');
            $table->string('status')->default('pending');
            $table->text('remarks')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('ships');
    }
};
