# CheckPoint - Sistema para Controle de Ponto
###### Projeto esboço para sistema de controle de ponto de funcionários utilizando as stacks: 

* CodeIgniter 4 
* Bootstrap 4 
* Docker 
* MySQL

###### Sistema totalmente responsivo para dispositivos móveis (tablets e smartphones)


## Configurando o projeto
Clone o projeto para o seu localhost
```sh
git clone https://gitlab.com/codeigniter4.4.6/checkpoint.git checkpoint
```
Acesse a pasta do projeto
```sh
cd checkpoint
```


Crie o arquivo *.env* copiando a partir do modelo *env*
```sh
cp env .env
```


As variáveis de ambiente contidas no arquivo _.env_ gerado já estão configuradas para a correta execução via container Docker, <br>
caso queira executar o projeto via localhost (Wamp, Xamp ou PHP Built-In) realize os ajustes necessários
```dosini
CI_ENVIRONMENT=development
appName='CheckPoint'
appPort='8080'
app_baseURL='http://localhost/checkpoint/public/'

database_default_hostname=db
database_default_database=checkpoint
database_default_username=root
database_default_password=root
database_default_DBDriver=MySQLi
database_default_DBPrefix=
database_default_port=3306
```


Suba o container do projeto
```sh
docker-compose up -d
```

Acesse o container do projeto
```sh
docker-compose exec -it app bash
```
Instale as dependências do projeto
```sh
composer install
```
Execute as *migrations* do CodeIgniter para criar as tabelas
```sh
php spark migrate
```
Execute a *Seeder* necessária para uma das tabelas do projeto
```sh
php spark db:seed checkpointtypes
```

### Acesse o sistema através da URL

### [http://localhost:8080](http://localhost:8080)


# Instruções do Sistema

### Acesse a rota de cadastro de usuários e efetue seu cadastro:

### [http://localhost:8080/users/register](http://localhost:8080/users/register)

-----------
### Após se cadastrar, efetue seu login:

### [http://localhost:8080/app/login](http://localhost:8080/app/login)

-----------

### Uma vez dentro da area restrita (Home), faça uma marcação de ponto clicando no botão: 
###### _"Clique aqui para marcar seu ponto"_

-----------

### Para visualizar o histórico de marcações, clique no botão: 
###### _"Histórico de Registro"_

