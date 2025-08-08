<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
 // Create status table
        Schema::create('status', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status_type', 255);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate();
        });

        // Create users table
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 255);
            $table->string('email', 255)->unique();
            $table->string('password', 255);
            $table->string('role', 50)->default(2); // commented out as per original SQL
            $table->timestamps();
        });

        // Create service_type table
        Schema::create('service_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('service_type_name', 255);
            $table->timestamps();
        });

        // Create warranty table
        Schema::create('warranty', function (Blueprint $table) {
            $table->increments('id');
            $table->string('warranty_status', 255);
            $table->timestamps();
        });

        // Create service_logs table
        Schema::create('service_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('techlog_id', 12)->default('N/A')->unique();
            $table->date('date_in')->nullable();
            $table->string('received_from', 255)->nullable();
            $table->string('alamat', 255)->nullable();
            $table->string('mobile_number', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('contact_person', 255)->nullable();
            $table->string('serial_number', 255)->nullable();
            $table->string('part_number', 255)->nullable();
            $table->string('SKU', 255)->nullable();
            $table->string('brand_type', 255)->nullable();
            $table->text('description_product')->nullable();
            $table->text('problem')->nullable();
            $table->text('pre_diagnostic')->nullable();
            $table->text('add_on')->nullable();
            $table->string('sales_order', 255)->nullable();
            $table->date('invoice_date')->nullable();
            // $table->date('warranty_expired')->nullable(); // commented out as per original SQL
            $table->string('warranty_status', 255);
            $table->integer('create_by')->unsigned();
            $table->integer('service_type')->unsigned()->nullable();
            $table->integer('status_id')->unsigned()->default(1);
            // $table->integer('teknisi_id')->unsigned()->nullable(); // commented out as per original SQL
            $table->date('part_ready')->nullable();
            $table->date('completed_date')->nullable();
            $table->date('return_date')->nullable();
            // notes fields commented out as per original SQL
            $table->timestamps();

            // Foreign keys
            $table->foreign('service_type')->references('id')->on('service_type')->onDelete('cascade');
            $table->foreign('status_id')->references('id')->on('status')->onDelete('cascade');
            $table->foreign('create_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('warranty_status')->references('id')->on('warranty')->onDelete('cascade');
            // $table->foreign('teknisi_id')->references('id')->on('users')->onDelete('cascade'); // commented out
        });

        // Create status_updatelog table
        Schema::create('status_updatelog', function (Blueprint $table) {
            $table->increments('id');
            $table->string('service_logs_id', 255);
            $table->integer('status_id')->unsigned()->nullable();
            $table->integer('teknisi_id')->unsigned()->nullable();
            $table->text('status_note')->nullable();
            $table->timestamp('created_at')->useCurrent();

            // Foreign keys
            $table->foreign('service_logs_id')->references('techlog_id')->on('service_logs')->onDelete('cascade');
            $table->foreign('status_id')->references('id')->on('status')->onDelete('cascade');
            $table->foreign('teknisi_id')->references('id')->on('users')->onDelete('cascade');
        });

        // Create notes table
        Schema::create('notes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('service_logs_id', 255);
            $table->integer('teknisi_id')->unsigned()->nullable();
            $table->string('note_content', 255);
            $table->timestamp('created_at')->useCurrent();

            // Foreign keys
            $table->foreign('service_logs_id')->references('techlog_id')->on('service_logs')->onDelete('cascade');
            $table->foreign('teknisi_id')->references('id')->on('users')->onDelete('cascade');
        });

        // Add trigger and function for techlog_id generation
        // DB::unprepared('
        //     DELIMITER //
        //     CREATE FUNCTION techlogIdGenerate (input INT)
        //     RETURNS VARCHAR(250)
        //     BEGIN
        //         DECLARE NumStr VARCHAR(250);
        //         DECLARE MonStr VARCHAR(250);
        //         DECLARE YearStr VARCHAR(250);
        //         DECLARE pad INT DEFAULT 6;
        //         DECLARE MonthPad INT DEFAULT 2;

        //         SET NumStr = CAST(input AS CHAR);
        //         SET MonStr = LPAD(MONTH(NOW()), MonthPad, \'0\');
        //         SET YearStr = SUBSTRING(YEAR(NOW()), 3, 2);

        //         IF (LENGTH(NumStr) < pad) THEN
        //             SET NumStr = CONCAT(\'TL\', YearStr, MonStr, LPAD(NumStr, pad, \'0\'));
        //         ELSE
        //             SET NumStr = CONCAT(\'TL\', YearStr, MonStr, NumStr);
        //         END IF;

        //         RETURN NumStr;
        //     END //
        //     DELIMITER ;

        //     DELIMITER $$
        //     CREATE TRIGGER techlog_id_insertion
        //     BEFORE insert ON service_logs
        //     FOR EACH ROW
        //     BEGIN
        //         SET @auto_id := ( SELECT AUTO_INCREMENT
        //                         FROM INFORMATION_SCHEMA.TABLES
        //                         WHERE TABLE_NAME=\'service_logs\'
        //                         AND TABLE_SCHEMA=DATABASE() );

        //         IF (NEW.techlog_id = \'N/A\') THEN
        //             SET NEW.techlog_id = techlogIdGenerate(@auto_id);
        //         END IF;
        //     END$$
        //     DELIMITER ;
        // ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
        Schema::dropIfExists('status_updatelog');
        Schema::dropIfExists('service_logs');
        Schema::dropIfExists('warranty');
        Schema::dropIfExists('service_type');
        Schema::dropIfExists('users');
        Schema::dropIfExists('status');
    }
};
