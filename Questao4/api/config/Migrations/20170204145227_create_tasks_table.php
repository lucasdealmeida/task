<?php

use Phinx\Migration\AbstractMigration;

class CreateTasksTable extends AbstractMigration
{
    public function up(){
        $table = $this->table('tasks');
        $table->addColumn('name', 'string')
            ->addColumn('description', 'text')
            ->addColumn('priority', 'integer')
            ->create();
    }
 
    public function down(){
        $this->dropTable('tasks');
    }
}
