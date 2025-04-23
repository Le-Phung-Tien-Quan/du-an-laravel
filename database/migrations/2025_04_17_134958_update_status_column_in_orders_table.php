<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateStatusColumnInOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Chỉnh sửa cột 'status' thành enum
            $table->enum('status', ['pending', 'shipped', 'completed'])->default('pending')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Phục hồi cột 'status' (có thể bạn muốn quay về kiểu dữ liệu cũ)
            $table->string('status')->default('pending')->change();
        });
    }
}
