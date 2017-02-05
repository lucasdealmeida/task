### Instruções para rodar a Questão 1 ###
#### Rodar o composer na raiz do projeto ####
```bash
$ composer install
```

#### Subir o servidor pelo PHP #### 
```bash
$ php -S localhost:8000 -t Questao1/
```

#### Acessar pelo naveador ####
[http://localhost:8000](http://localhost:8000)


#### Para rodar os testes da Questão 1 ####
```bash
$ vendor/bin/phpunit --filter Questao1Test
```

##### Instruções para rodar a Questão 3 ####
### Importar o arquivo de SQL ###
```
Questao3/sql.sql
```
#### Para rodar os testes da Questão 3 ####
```bash
$ vendor/bin/phpunit --filter Questao3Test
```

### Para rodar todos os testes ###
```bash
$ vendor/bin/phpunit
```
### Rodar o PHPCodeSniffer para verificar PSR-1 ###
```bash
$ vendor/bin/phpcs --standard=PSR1 Questao1/
$ vendor/bin/phpcs --standard=PSR1 Questao2/
$ vendor/bin/phpcs --standard=PSR1 Questao3/
```
### Instruções para rodar a Questão 4 ###
#### Instalar o Docker ####
```
https://www.docker.com/products/docker
```

#### Subir os container no Docker ####
Rode esse comando dentro da pasta `Questao4`
```bash
$ docker-compose up
```
Após o download de todos os package do composer coloque o processo em background ```bash $ control + z ``` (MAC)

#### Editar o arquivo ```config/app.php``` ####
```php
'host' => 'task_db',
'username' => 'root',
'password' => 'root',
'database' => 'root',
```


#### Rodar os migrations ####
```bash
$ docker exec task_php api/bin/cake migrations migrate
```

##### API: http://localhost:8001 #####
##### FrontEnd: http://localhost:8002 #####
##### Postman Collection https://www.getpostman.com/collections/6f84bd502c766f41f3d6 #####
