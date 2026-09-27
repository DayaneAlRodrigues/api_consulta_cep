

# API Consulta CEP

API desenvolvida com **Laravel** para consulta de CEP utilizando a **ViaCEP**. Os dados retornados pela API externa são armazenados em um banco de dados PostgreSQL, permitindo reutilizar informações que já foram consultadas.

## Tecnologias

* PHP
* Laravel
* PostgreSQL
* ViaCEP
* REST API
* Eloquent ORM
* Postman

## Sobre o projeto

O projeto tem como objetivo praticar a criação de uma API REST com Laravel e a integração com uma API externa.

Ao consultar um CEP, a aplicação verifica primeiro se o endereço já está armazenado no banco de dados.

* Se o CEP existir no banco, os dados armazenados são retornados.
* Se o CEP não existir, a aplicação consulta a ViaCEP.
* Os dados retornados pela ViaCEP são armazenados no banco.
* Em seguida, os dados são retornados para o cliente.

O projeto também permite atualizar um endereço. Nesse caso, o novo CEP é consultado na ViaCEP para confirmar os dados antes de atualizar o registro existente.

## Funcionamento

```text
                 Requisição
                     │
                     ▼
              Laravel API
                     │
                     ▼
             Procura no banco
                │       │
              SIM       NÃO
                │        │
                ▼        ▼
          Retorna     Consulta
          do banco    ViaCEP
                         │
                         ▼
                    Salva no
                      banco
                         │
                         ▼
                      Retorna
                       dados
```

## Estrutura

A aplicação utiliza um Controller, um Service e um Model para separar as responsabilidades.

```text
app/
├── Http/
│   └── Controllers/
│       └── EnderecoController.php
│
├── Models/
│   └── Endereco.php
│
└── Services/
    └── CepService.php
```

### Controller

O `EnderecoController` é responsável por receber as requisições, validar os dados e retornar as respostas da API.

### Service

O `CepService` concentra a integração com a ViaCEP.

Principais métodos:

```php
consultarCep()
```

Consulta um CEP na ViaCEP e retorna os dados encontrados.

```php
consultarESalvar()
```

Consulta o CEP na ViaCEP e salva os dados retornados no banco.

### Model

O `Endereco` representa os endereços armazenados no banco de dados e utiliza o Eloquent ORM do Laravel.

## Como baixar o projeto

Clone o repositório:

```bash
git clone URL_DO_REPOSITORIO
```

Entre na pasta:

```bash
cd api_consulta_cep
```

## Instalação das dependências

Instale as dependências do PHP:

```bash
composer install
```

Copie o arquivo `.env.example`:

```bash
cp .env.example .env
```

Gere a chave da aplicação:

```bash
php artisan key:generate
```

## Configuração do banco de dados

Configure as informações do PostgreSQL no arquivo `.env`.

Exemplo:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=api_consulta_cep
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
```

Crie o banco de dados no PostgreSQL e depois execute as migrations:

```bash
php artisan migrate
```

## Executando o projeto

Inicie o servidor Laravel:

```bash
php artisan serve
```

A API estará disponível em:

```text
http://127.0.0.1:8000
```

## Endpoints

### Listar endereços

```http
GET /api/enderecos
```

Retorna todos os endereços armazenados no banco.

### Consultar endereço por CEP

```http
GET /api/enderecos/{cep}
```

Exemplo:

```http
GET /api/enderecos/01001000
```

O sistema primeiro verifica o banco.

Caso o CEP não esteja cadastrado, consulta a ViaCEP e salva o resultado no banco.

### Cadastrar endereço

```http
POST /api/enderecos
```

Body:

```json
{
    "cep": "01001000"
}
```

A aplicação consulta a ViaCEP, salva os dados retornados e devolve o endereço cadastrado.

### Atualizar endereço

```http
PUT /api/enderecos/{id}
```

Body:

```json
{
    "cep": "90010000"
}
```

O novo CEP é consultado na ViaCEP antes da atualização. Os dados retornados pela API externa são utilizados para atualizar o endereço existente.

### Excluir endereço

```http
DELETE /api/enderecos/{id}
```

Remove o endereço do banco de dados.

## Exemplo de resposta

```json
{
    "id": 1,
    "cep": "01001-000",
    "logradouro": "Praça da Sé",
    "bairro": "Sé",
    "localidade": "São Paulo",
    "uf": "SP"
}
```

## Testes

As requisições podem ser realizadas utilizando ferramentas como **Postman**.

Exemplos:

```text
GET     /api/enderecos
GET     /api/enderecos/01001000
POST    /api/enderecos
PUT     /api/enderecos/1
DELETE  /api/enderecos/1
```

## Objetivos de aprendizagem

Este projeto foi desenvolvido para praticar:

* Desenvolvimento de APIs REST com Laravel
* CRUD
* Rotas e Controllers
* Eloquent ORM
* Migrations
* Validação de requisições
* Integração com API externa
* Consumo da API ViaCEP
* Injeção de dependência
* Organização de responsabilidades com Services
* Persistência de dados com PostgreSQL
* Testes de API utilizando Postman

## Autor

**Dayane Rodrigues**

