<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTriggerMixDetailsChildBeforeInsert extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER `tgr_before_mix_tbl_child` BEFORE INSERT ON mix_customize_section_details_child FOR EACH ROW BEGIN   
            DECLARE cur_table_master_id INT;
            SELECT id
            INTO cur_table_master_id
            FROM mix_customize_section_details WHERE slug = new.parent_slug;
            set new.details_row_id = cur_table_master_id;
        END;
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `tgr_before_mix_tbl_child`');
    }
}
