<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Schema\Blueprint;

class TestDatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Schema::disableForeignKeyConstraints();
        \DB::statement("ALTER TABLE [dbo].[AccountAvatars] DROP CONSTRAINT [FK__AccountAv__Accou__001]");
        \DB::statement("TRUNCATE Table AccountAvatars");
        //\DB::statement("TRUNCATE TABLE Accounts");
        \DB::statement("DELETE FROM  Accounts");
        \DB::statement("DBCC CHECKIDENT ('Accounts',RESEED, 0)");
        \DB::statement("TRUNCATE TABLE SwingStatusIDs");
        \DB::statement("TRUNCATE TABLE AcademyStudents");
        //\DB::statement("TRUNCATE TABLE AcademyInstructors");
        \DB::statement("DELETE FROM  AcademyInstructors");
        //\DB::statement("TRUNCATE TABLE Instructors");
        \DB::statement("DELETE FROM Instructors");
        \DB::statement("TRUNCATE TABLE InstructorStudents");
        \DB::statement("TRUNCATE TABLE InstructorStudentsMulti");
        \DB::statement("TRUNCATE TABLE InstructorStudentsFollow");
        \DB::statement("TRUNCATE TABLE Academies_AddOns");
        \DB::statement("ALTER TABLE [dbo].[AccountAvatars]  WITH CHECK ADD  CONSTRAINT [FK__AccountAv__Accou__001] FOREIGN KEY([AccountID]) REFERENCES [dbo].[Accounts] ([AccountID])ALTER TABLE [dbo].[AccountAvatars] CHECK CONSTRAINT [FK__AccountAv__Accou__001]");
        \DB::statement("DELETE FROM  V1GolfPlus");
        $this->call(TestAcademyTableSeeder::class);
        $this->call(TestUser::class);
        $this->call(TestSwingSeeder::class);
/*
    IF EXISTS (SELECT * FROM sys.foreign_keys WHERE object_id = OBJECT_ID(N'[dbo].[FK__AccountAv__Accou__741A2336]') AND parent_object_id = OBJECT_ID(N'[dbo].[AccountAvatars]'))
    ALTER TABLE [dbo].[AccountAvatars] DROP CONSTRAINT [FK__AccountAv__Accou__741A2336]
*/
/*
    ALTER TABLE [dbo].[AccountAvatars]  WITH CHECK ADD  CONSTRAINT [FK__AccountAv__Accou__741A2336] FOREIGN KEY([AccountID]) REFERENCES [dbo].[Accounts] ([AccountID])
    ALTER TABLE [dbo].[AccountAvatars] CHECK CONSTRAINT [FK__AccountAv__Accou__741A2336]
 */
    }
}
