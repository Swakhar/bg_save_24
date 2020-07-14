<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTgrBeforeMixChildInsertSortNoTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
        CREATE TRIGGER `tgr_before_mix_child_sort_no` BEFORE INSERT ON mix_customize_section_details_child FOR EACH ROW BEGIN 
            DECLARE cur_table_master_id INT;
            DECLARE TYPE VARCHAR(50);
            IF new.label = 'Categories' THEN
                SET new.sort_no = 0;
            ELSE 
                SELECT attributes.type INTO TYPE FROM attribute_translations
                INNER JOIN attributes on attributes.id = attribute_translations.attribute_id
                WHERE name = new.label;
                -- 'boolean', 'checkbox', 'date', 'datetime', 'file', 'image', 'multiselect', 'price', 'select', 'text', 'textarea'
                IF TYPE = 'multiselect' THEN SET new.sort_no = 1;
                ELSEIF TYPE = 'select' THEN SET new.sort_no = 2;
                ELSEIF TYPE = 'checkbox' THEN SET new.sort_no = 3;
                ELSEIF TYPE = 'boolean' THEN SET new.sort_no = 4;
                ELSEIF TYPE = 'price' THEN SET new.sort_no = 5;
                END IF;
                
            END IF;
        END;
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `tgr_before_mix_child_sort_no`');
    }
}

