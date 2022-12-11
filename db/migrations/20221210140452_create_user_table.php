<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateUserTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $table = $this->table('user');

        $table->addColumn('name', 'string', ['length' => 50]);
        $table->addColumn('email', 'string', ['length' => 50]);
        $table->addColumn('password', 'string', ['length' => 50]);
        $table->addColumn('phone', 'string', ['length' => 50]);
        $table->addColumn('address', 'string', ['length' => 50]);
        $table->addIndex('email', ['unique' => true ]);
        $table->create();
    }
}
