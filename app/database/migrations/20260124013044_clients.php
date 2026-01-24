<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Clients extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('clients', ['id' => false, 'primary_key' => ['id']]);

        $table
            ->addColumn('id', 'biginteger', ['identity' => true])
            ->addColumn('nome_fantasia', 'text', ['null' => true])
            ->addColumn('sobrenome_razao', 'text', ['null' => true])
            ->addColumn('cpf_cnpj', 'text', ['null' => true])
            ->addColumn('rg_ie', 'text', ['null' => true])
            ->addColumn('senha', 'text', ['null' => true])
            ->addColumn('ativo', 'boolean', ['default' => false])
            ->addColumn('codigo_verificacao', 'text', ['null' => true])
            ->addColumn('data_cadastro', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('data_alteracao', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
            ->create();
    }
}