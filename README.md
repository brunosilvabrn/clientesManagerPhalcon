# clientesManagerPhalcon
### Api simples para gerenciamento de clientes feito com Phalcon php.
Sistema feito com Microaplicativos. Os microaplicativos (Micro applications) são adequados para pequenas aplicações que terão uma sobrecarga muito baixa. Esses aplicativos são geralmente APIs, protótipos etc.

### 🔧 Instalação

Importar as tabelas do banco de dados **api_pahlcon.sql** para o Mysql.

Defina as credenciais de acesso ao banco de dados.
<br>
No arquivo app/config/**config.php**

```
'database' => [
        'adapter'    => 'Mysql',
        'host'       => 'localhost',
        'username'   => 'root',
        'password'   => '',
        'dbname'     => 'api_phalcon',
        'charset'    => 'utf8',
    ],
```

## Rotas

### api/clientes
Retorna todos os usuários cadastrados no formato JSON.
Exemplo:
```
[
    {
        "id": "1",
        "id_usuario": "34874",
        "nome": "Fuller Holland",
        "telefone": "(51) 1529-4574",
        "email": "a.sollicitudin.orci@outlook.edu",
        "cidade": "Rajasthan",
        "ativo": "true"
    },
    {
        "id": "2",
        "id_usuario": "58546",
        "nome": "Coby Mosley",
        "telefone": "(63) 6561-7773",
        "email": "vel.turpis@aol.ca",
        "cidade": "Sindh",
        "ativo": "true"
    },
]
```

### api/clientes/{id}
Retorna um json com os dados de um usuário pelo id informado.<br>
Passar o id do usuário via GET pela url.
Exemplo: ***api/clientes/4***
```
[
    {
        "id": "4",
        "id_usuario": "97855",
        "nome": "Ila Guzman",
        "telefone": "(81) 2696-3753",
        "email": "mus.proin@outlook.edu",
        "cidade": "Tomsk Oblast",
        "ativo": "false"
    }
]
```

### api/clientes/{id}/edit
Editar os dados de um usuário. Passar o id do usuário que sera editado via GET pela url. Exemplo: api/clientes/5/edit<br>
Enviar os novos dados via **POST**. Essa rota retorna dois status ***SUCESS*** e ***ERROR*** dependendo se os dados foram enviado corretamente.<br>
Dados via **POST** obrigatórios. 
```
nome     => POST
telefone => POST
email    => POST
ciadade  => POST
ativo    => POST
```

### api/clientes/{id}/delete
Excluir um usuário cadastrado.<br>
Essa rota retorna dois status ***SUCESS*** e ***ERROR*** dependendo se a ação foi concluida ou não.<br>
Exemplo. ***api/clientes/10/delete*** -> ira excluir o usuário de id 10.

### api/cliente/add
Adicionara um novo usuários.
Enviar os novos dados via **POST**. Essa rota retorna dois status ***SUCESS*** e ***ERROR*** dependendo se os dados foram enviado corretamente.<br>
Dados via **POST** obrigatórios. 
```
nome     => POST
telefone => POST
email    => POST
ciadade  => POST
ativo    => POST
```
---

## Podem ser adicionas novas funcionalidades e aprimoradas funcionalidades existentes nessa presentes nessa API.
Api feita para demonstrar conhecimento no **Framework PHALCON PHP**

⌨️ Feito por [Bruno Lopes Silva](https://github.com/brunosilvabrn) 

