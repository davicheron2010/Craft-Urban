<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Users extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('users', ['id' => false, 'primary_key' => ['id']]);

        $table
            ->addColumn('id', 'biginteger', ['identity' => true])
            ->addColumn('nome', 'text', ['null' => true])
            ->addColumn('sobrenome', 'text', ['null' => true])
            ->addColumn('cpf', 'text', ['null' => true])
            ->addColumn('rg', 'text', ['null' => true])
            ->addColumn('senha', 'text', ['null' => true])
            ->addColumn('ativo', 'boolean', ['default' => false])
            ->addColumn('administrador', 'boolean', ['default' => false])
            ->addColumn('codigo_verificacao', 'text', ['null' => true])
            ->addColumn('data_cadastro', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('data_alteracao', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
            ->create();
    }
}