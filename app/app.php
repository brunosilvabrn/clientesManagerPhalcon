<?php

/**
 * Local variables
 * @var \Phalcon\Mvc\Micro $app
 */

/**
 * Add your routes here
 */
$app->get('/', function () {
    echo $this['view']->render('index');
});

// Retorna todos os clientes cadastrados
$app->get(
    '/api/clientes',
    function () use ($app) {

        $sql = 'SELECT * FROM clientes';
        $resultado = $app->modelsManager->executeQuery($sql);
        $data = [];

        foreach ($resultado as $values) {
            $data[] = [
                'id'   => $values->id,
                'id_usuario' => $values->id_user,
                'nome' => $values->nome,
                'telefone' => $values->telefone,
                'email' => $values->email,
                'cidade' => $values->cidade,
                'ativo' => $values->ativo,
            ];
        }

        echo json_encode($data);
    }
);

// Busca o cliente cadastrado pelo ID
// /api/clientes/{ID do cliente}
$app->get(
    '/api/clientes/{id:[0-9]+}',
    function ($id) use ($app) {

        $sql = Clientes::find($id);

        $data = [];

        if (empty($sql[0])) {
            
            return json_encode(['Error' => 'Usuário Invalido']);

        }

        foreach ($sql as $values) {
            $data[] = [
                'id'   => $values->id,
                'id_usuario' => $values->id_user,
                'nome' => $values->nome,
                'telefone' => $values->telefone,
                'email' => $values->email,
                'cidade' => $values->cidade,
                'ativo' => $values->ativo,
            ];
        }

       echo json_encode($data);
        
    }
);

// Busca o cliente cadastrado pelo nome
// /api/clientes/{nome do cliente}
$app->get(
    '/api/clientes/search/{nome}',
    function ($nome) use ($app) {

        $sql = 'SELECT * FROM clientes WHERE nome LIKE :nome';

        $resultado = $this->db->query($sql, array('nome'=> '%' . $nome . '%')
        )->fetchAll(PDO::FETCH_ASSOC);

        if (empty($resultado)) {
            return json_encode(['Error' => 'Nenhum usuário encontrado']);
        }

        foreach ($resultado as $values) {
            $data[] = [
                'id'   => $values['id'],
                'id_usuario' => $values['id_user'],
                'nome' => $values['nome'],
                'telefone' => $values['telefone'],
                'email' => $values['email'],
                'cidade' => $values['cidade'],
                'ativo' => $values['ativo'],
            ];
        }

        echo json_encode($data);
        
    }
);

// Cadastra um novo cliente
// Dados via POST
$app->post(
    '/api/cliente/add',
    function () use ($app) {
        // Gerador do id de usuario -> id_user 
        $id_user = substr(rand(), 0, 5);

        $robot = $app->request->getPost();
        $phql  = 'INSERT INTO Clientes (id_user, nome, telefone, email, cidade, ativo) VALUES (:id_user, :nome, :telefone, :email, :cidade, :ativo)';

        $resultado = $this->db->query(
                $phql,
                [
                    'id_user' => $id_user,
                    'nome' => $robot['nome'],
                    'email' => $robot['email'],
                    'telefone' => $robot['telefone'],
                    'cidade' => $robot['cidade'],
                    'ativo' => $robot['ativo'],
                ]
            );

        if ($resultado == true) {
            return json_encode(['Sucess' => 'Cliente cadastrado com sucesso']);
        }

        return json_encode(['Error' => 'Erro ao cadastrar cliente']);
        
    }
);

// Edita as informações de um usuario cadastrado
// dados via POST
$app->post(
    '/api/cliente/{id:[0-9]+}/edit',
    function ($id) use ($app) {

        $sql = Clientes::find($id);

        $data = [];

        if (empty($sql[0])) {
            
            return json_encode(['Error' => 'Usuário Invalido']);

        }

        foreach ($sql as $values) {
            $data[] = [
                'id'   => $values->id,
                'id_usuario' => $values->id_user,
                'nome' => $values->nome,
                'telefone' => $values->telefone,
                'email' => $values->email,
                'cidade' => $values->cidade,
                'ativo' => $values->ativo,
            ];
        }

        $respose =  $app->request->getPost();

        // Checa se os dados via post estão vazio 
        // Caso estiver a informação vai ser mantida
        $nome = $respose['nome'] != '' ? $respose['nome'] : $data[0]['nome'];
        $telefone = $respose['telefone'] != '' ? $respose['telefone'] : $data[0]['telefone'];
        $email = $respose['email'] != '' ? $respose['email'] : $data[0]['email'];
        $cidade = $respose['cidade'] != '' ? $respose['cidade'] : $data[0]['cidade'];
        $ativo = $respose['ativo'] != '' ? $respose['ativo'] : $data[0]['ativo'];

        $phql  = 'UPDATE Clientes SET nome = :nome, email = :email, telefone = :telefone, cidade = :cidade, ativo = :ativo WHERE id = :id';

        $resultado = $this->db->query(
                $phql,
                [
                    'id' => $id,
                    'nome' => $nome,
                    'email' => $email,
                    'telefone' => $telefone,
                    'cidade' => $cidade,
                    'ativo' => $ativo,
                ]
            );

        if ($resultado == true) {
            return json_encode(['Sucess' => 'Informações editadas com sucesso']);
        }

        return json_encode(['Error' => 'Erro ao editar Informações']);
        
    }
);

// Excluir cliente cadastrado
$app->get(
    '/api/cliente/{id:[0-9]+}/delete',
    function ($id) use ($app) {

        $phql  = 'DELETE FROM Clientes WHERE id = :id:';

        $status = $app->modelsManager->executeQuery(
                $phql,
                [
                    'id' => $id,
                ]
            )
        ;

        if ($status->success() === true) {
            return json_encode(['Sucess' => 'Cliente excluido com sucesso']);
        }

        return json_encode(['Error' => 'Erro ao excluir cliente']);
        
    }
);

/**
 * Not found handler
 */
$app->notFound(function () use($app) {
    // $app->response->setStatusCode(404, "Not Found")->sendHeaders();
    // echo $app['view']->render('404');
    $resp = ['Error' => 'url invalida'];
    echo json_encode($resp);
});
