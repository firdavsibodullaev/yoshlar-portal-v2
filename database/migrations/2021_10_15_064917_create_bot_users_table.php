<?php

use App\Constants\UserRoleConstant;
use App\Models\BaseModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBotUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bot_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('chat_id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->text('region_uuid')->nullable();
            $table->text('sub_region_uuid')->nullable();
            $table->date('birthday')->nullable();
            $table->string('language')->nullable();
            $table->boolean('status')->default(false);
            $table->string('role')->default(UserRoleConstant::USER);
            $table->integer('year_filter')->nullable();
            $table->integer('month_filter')->nullable();
            $table->string("youth_book_application_id")->nullable();
            $table->string("youth_book_application_password")->nullable();
            $table->timestamps();
            $table->softDeletes(BaseModel::DELETED_AT);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bot_users');
    }
}
