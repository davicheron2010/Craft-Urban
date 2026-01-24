<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Contacts extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('contacts', ['id' => false, 'primary_key' => ['id']]);

        $table
            ->addColumn('id', 'biginteger', ['identity' => true])
            ->addColumn('id_usuario', 'biginteger', ['null' => true])
            ->addColumn('id_cliente', 'biginteger', ['null' => true])
            ->addColumn('id_fornecedor', 'biginteger', ['null' => true])
            ->addColumn('id_empresa', 'biginteger', ['null' => true])
            ->addColumn('tipo', 'text', ['null' => true])
            ->addColumn('contato', 'text', ['null' => true])
            ->addColumn('data_cadastro', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('data_alteracao', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])

            ->addForeignKey('id_usuario', 'users', 'id', ['delete'=> 'CASCADE', 'update'=> 'CASCADE'])
            ->addForeignKey('id_cliente', 'clients', 'id', ['delete'=> 'CASCADE', 'update'=> 'CASCADE'])
            ->addForeignKey('id_fornecedor', 'suppliers', 'id', ['delete'=> 'CASCADE', 'update'=> 'CASCADE'])
            ->addForeignKey('id_empresa', 'companies', 'id', ['delete'=> 'CASCADE', 'update'=> 'CASCADE'])

            ->create();
    }
}