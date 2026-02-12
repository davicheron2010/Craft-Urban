<?php

namespace app\controller;

use app\database\builder\InsertQuery;
use app\database\builder\SelectQuery;

class Sale extends Base
{
    public function cadastro($request, $response)
    {
        $dadosTemplate = [
            'titulo' => 'Página inicial',
            'acao'=> 'c'
        ];
        return $this->getTwig()
            ->render($response, $this->setView('sale'), $dadosTemplate)
            ->withHeader('Content-Type', 'text/html')
            ->withStatus(200);
    }
    public function lista($request, $response)
    {
        $dadosTemplate = [
            'titulo' => 'Página inicial'
        ];
        return $this->getTwig()
            ->render($response, $this->setView('listsale'), $dadosTemplate)
            ->withHeader('Content-Type', 'text/html')
            ->withStatus(200);
    }
    public function insert($request, $response)
    {
        $form = $request->getParsedBody();
        $id_produto = $form['pesquisa'];
        if (empty($id_produto) or is_null($id_produto)) {
            return $this->SendJson($response, ['status' => false, 'msg' => 'Restrição O Id do Produto é obrigatório', 'id' => 0], 403);
        }
        $customer = SelectQuery::select('id')
            ->from('customer')
            ->order('id', 'asc')
            ->limit(1)
            ->fetch();
        if (!$customer) {
            return $this->SendJson($response, ['status' => false, 'msg' => 'RESTIÇÃO: Nenhum cliente Encontrado!', 'id' => 0], 403);
        }
        $id_customer = $customer['id'];
        $FieldAndValue = [
            'id_cliente' => $id_customer,
            'total_bruto' => 0,
            'total_liquido' => 0,
            'desconto' => 0,
            'acrescimo' => 0,
            'observacao' => ''
        ];
        try {
            #Tenta inserir a vendar no banco de dados e captura o resultado da inserção
            $IsInserted = InsertQuery::table('sale')->save($FieldAndValue);
            #Verifica se a inserção falhou
            if (!$IsInserted) {
                return $this->SendJson($response, ['status' => false, 'msg' => 'Restrição: ao cadastrar venda', 'id' => 0], 403);
            }
            #Selecionda o id da venda inserida mais recente para retornar na resposta
            $sale = SelectQuery::select('id')
                ->from('sale')
                ->order('id', 'desc')
                ->limit(1)
                ->fetch();
            #Verifcar se a venda não foi encontrada
            if (!$sale) {
                return $this->SendJson($response, ['status' => false, 'msg' => 'Restrição: Nenhuma venda Encontrada!', 'id' => 0], 403);
            }
            $id_sale = $sale['id'];
            return $this->SendJson($response, ['status' => true, 'msg' => 'Venda cadastrada com sucesso!', 'id' => $id_sale], 201);
        } catch (\Exception $e) {
            return $this->SendJson($response, ['status' => false, 'msg' => 'Restrição: ' . $e->getMessage(), 'id' => 0], 500);
        }
    }
}
