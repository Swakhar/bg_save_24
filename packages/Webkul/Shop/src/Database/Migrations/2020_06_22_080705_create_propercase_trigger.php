<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropercaseTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $dbPrefix = DB::getTablePrefix();

        $functionSQL = <<< SQL
            DROP FUNCTION IF EXISTS `proper`;
            CREATE FUNCTION `proper` ( `str` VARCHAR ( 255 ) ) RETURNS VARCHAR ( 255 ) CHARSET latin1 BEGIN
            DECLARE
                chr VARCHAR ( 1 );
            DECLARE
                lStr VARCHAR ( 255 );
            DECLARE
                oStr VARCHAR ( 255 ) DEFAULT '';
            DECLARE
                i INT DEFAULT 1;
            DECLARE
                bool INT DEFAULT 1;
            DECLARE
                punct CHAR ( 17 ) DEFAULT ' ()[]{},.-_!@;:?/';
            WHILE
                i <= LENGTH( str ) DO BEGIN SET chr = SUBSTRING( str, i, 1 ); IF LOCATE( chr, punct ) > 0 THEN
            BEGIN
                
                SET bool = 1;
            
            SET oStr = concat( oStr, chr );
            
            END;
            
            ELSEIF bool = 1 THEN
            BEGIN
                
                SET oStr = concat( oStr, UCASE( chr ) );
            
            SET bool = 0;
            
            END;
            ELSE BEGIN
                    
                    SET oStr = concat( oStr, LCASE( chr ) );
                
            END;
            
            END IF;
            
            SET i = i + 1;
            
            END;
            
            END WHILE;
            RETURN oStr;
            
            END;
SQL;

        DB::unprepared($functionSQL);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP FUNCTION IF EXISTS `proper`;');
    }
}
