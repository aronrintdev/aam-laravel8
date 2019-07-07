<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DefaultInstructorIsNull extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
/*
    \DB::statement('
        ALTER TABLE [Accounts]
        DROP CONSTRAINT [DF_Accounts_DefaultInstructor];
');


\DB::statement('
        ALTER TABLE [Accounts]
        ADD CONSTRAINT [DF_Accounts_DefaultInstructor]
        DEFAULT Null for [InstructorID];
');
 */

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
