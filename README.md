# Teste JN2
Desafio Técnico JN2

## Instalação

Baixando o projeto.
```sh
git clone https://github.com/karenyov/testeJN2.git
```

Na raiz do projeto abra o terminal e execute o comando:
```sh
docker-compose up -d --build
```

Alterar o arquivo .env.example (remover o .example) e deixar as configurações do banco conforme o container:
```
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=jn2_db
DB_USERNAME=root
DB_PASSWORD=root
```

Entrar no container e executar o seguintes comandos:
```sh
docker exec -it app bash #entrando no container

composer install #instalar as dependências via composer

#preparando a estrutura do laravel e do database
php artisan key:generate
php artisan migrate
php artisan db:seed
```

## Estrutura do Projeto
```sh
.
├── app
│   ├── Console
│   ├── Exceptions
│   ├── Http
│   |   ├── Controllers
│   |   ├── Middleware
│   |   ├── Requests
│   |   ├── Resources
│   |   └── Kernel.php
│   ├── Providers
│   ├── Repositories
│   └── User.php
├── bootstrap
├── config
├── database
│   ├── factories
│   ├── migrations
│   └── seeds
├── docker-files
│   ├── mysql
│   ├── nginx
│   │   └── default.conf
├── public
├── resources
│   ├── js
│   ├── lang
│   └── sass
├── routes
├── storage
├── tests
├── vendor
├── .editorconfig
├── .env.example
├── .gitattributes
├── .gitignore
├── artisan
├── composer.json
├── composer.lock
├── docker-compose.yml
├── Dockerfile
├── package.json
├── phpunit.xml
├── README.md
├── server.php
└── webpack.mix.js
```

## Estrutura Database
![alt text](https://github.com/karenyov/testeJN2/blob/main/database.jpg)

## ENDPOINTS

### ENDPOINT - `api/cliente`

#### [POST] - `api/cliente`
| Parâmetro | Descrição |
|---|---|
| `nome` | Nome do Cliente |
| `telefone` | Telefone do Cliente |
| `cpf` | CPF do Cliente |
| `placa` | Placa do carro |

+ Request (application/json)

    + Body

            {
                "nome" : "João",
                "telefone" : "122345",
                "cpf" : "12334568223",
                "placa" : "EXX-0981"
            }

+ Response 200 (application/json)

    + Body

            {
                "success": true,
                "data": {
                    "id": 5,
                    "nome": "João V.",
                    "telefone": "122345",
                    "cpf": "12334568223",
                    "placa": "EXX-0981"
                },
                "message": "Cliente criado com sucesso."
            }

#### [GET] - `api/cliente`
+ Request (application/json)

    + Headers

            `api/cliente`

+ Response 200 (application/json)

        {
            "success": true,
            "data": [
                {
                    "id": 1,
                    "nome": "João",
                    "telefone": "122345",
                    "cpf": "12334568",
                    "placa": "EXX-0981"
                },
                {
                    "id": 2,
                    "nome": "Maria V.",
                    "telefone": "122345",
                    "cpf": "456543231",
                    "placa": "TPL-5408"
                }
            ],
            "message": "Clientes carregados com sucesso."
        }

#### [PUT] - `api/cliente/{id}`
| Parâmetro | Descrição |
|---|---|
| `nome` | Nome do Cliente |
| `telefone` | Telefone do Cliente |
| `cpf` | CPF do Cliente |
| `placa` | Placa do carro |

+ Request (application/json)

    + Body

            {
                "nome" : "João",
                "telefone" : "122345",
                "cpf" : "12334568223",
                "placa" : "EXX-0981"
            }

+ Response 200 (application/json)

    + Body

            {
                "success": true,
                "data": {
                    "id": 5,
                    "nome": "João V.",
                    "telefone": "122345",
                    "cpf": "12334568223",
                    "placa": "EXX-0981"
                },
                "message": "Cliente alterada com sucesso."
            }

#### [DELETE] - `api/cliente/{id}`
+ Request (application/json)

    + Headers

            `api/cliente/{id}`

+ Response 200 (application/json)

        {
            "success": true,
            "data": [],
            "message": "Cliente deletado com sucesso."
        }

#### [GET] - `api/final-placa{id}`
+ Request (application/json)

    + Headers

            `api/final-placa{id}`

+ Response 200 (application/json)

        {
            "success": true,
            "data": [
                {
                    "id": 1,
                    "nome": "João",
                    "telefone": "122345",
                    "cpf": "12334568",
                    "placa": "EXX-0981"
                },
            ],
            "message": "Clientes carregados com sucesso."
        }


## Comandos úteis
```sh
# lista os containers dessa aplicação
docker-compose ps
# acessa o terminal do container php
docker container exec -it app bash
# para os containers
docker-compose stop
# para e remove os containers
docker-compose down
```

## Acessando a API
Por padrão a porta configurada no docker é a 8100 (http://localhost:8100/api).