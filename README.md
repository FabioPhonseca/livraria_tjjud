<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
    Projeto Laravel 11 com MariaDB<br />
    Um exemplo funcional do projeto está disponível em:
   <a href="https://www.fabiofonseca.com.br/tjjud/public/index.php" target="_blank">Livraria TJJUD</a>
</p>

<p>
Aplicação web desenvolvida como projeto de exemplificação técnica, simulando operações básicas de uma livraria.
Construída com foco em organização de código, boas práticas do framework e ambiente reproduzível.
</p>

<h2>Tecnologias</h2>
<ul>
  <li><strong>PHP / Laravel 11</strong> (arquitetura MVC, rotas, controllers, Eloquent ORM)</li>
  <li><strong>MariaDB</strong> (migrations, relacionamentos e persistência)</li>
  <li><strong>Blade</strong> (camada de views)</li>
  <li><strong>Pest</strong> (testes automatizados)</li>
  <li><strong>Docker</strong> (ambiente containerizado para dev)</li>
</ul>

<h2>O que este projeto demonstra</h2>
<ul>
  <li>Estrutura MVC e convenções do Laravel</li>
  <li>Migrations/seeders para versionamento do schema</li>
  <li>Testes com foco em legibilidade e confiabilidade (Pest)</li>
  <li>Configuração por variáveis de ambiente (<code>.env</code>)</li>
  <li>Ambiente reproduzível com Docker</li>
</ul>

### Instalação

1. Clone o repositório e entre na pasta do projeto:
   ```bash
   git clone https://github.com/FabioPhonseca/livraria_tjjud.git
   cd livraria_tjjud
   ```

2. Instale as dependências do PHP:
   ```bash
   composer install
   ```

3. Crie o arquivo `.env` com base no `.env.example`:
   ```bash
   cp .env.example .env
   ```

4. Configure o banco de dados no `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=nome_do_banco
   DB_USERNAME=seu_usuario
   DB_PASSWORD=sua_senha
   ```

5. Gere a chave da aplicação:
   ```bash
   php artisan key:generate
   ```

6. Execute as migrações:
   ```bash
   php artisan migrate
   ```

7. Inicie o servidor de desenvolvimento:
   ```bash
   php artisan serve
   ```

8. Acesse o projeto:
    O projeto estará disponível em [http://localhost:8000](http://localhost:8000).

### Rodando Testes

O projeto usa Pest como framework de testes. Para rodar os testes, use:
```bash
php artisan test
```

### Docker (Bitnami)
<a href="https://laravel.com" target="_blank"><img src="https://www.gravatar.com/avatar/85bcf547a6bf62b855df2c682af81a4e?s=120&r=g&d=404"></a>
<br />
<p>
Este projeto foi construído utilizando imagens Docker da Bitnami.
<br />
Caso queira reproduzir o ambiente, aqui estão os passos. <br />
Após subir os servidores, será preciso copiar os arquivos do projeto para o diretório `myapp` e executar as etapas da instalação anterior.
</p>

1. Crie uma pasta local que será refletida nos arquivos do container:
   ```bash
   mkdir ~/myapp && cd ~/myapp
   ```

2. Comandos podem ser executados diretamente desta pasta. Exemplo:
   ```bash
   docker exec laravel <command>
   ```

3. Crie uma rede Docker para que os containers possam se comunicar:
   ```bash
   docker network create laravel-network
   ```

4. Crie um volume de dados:
   ```bash
   docker volume create --name mariadb_data
   ```

5. Clone/levante o container MariaDB (docker pull bitnami/mariadb:latest):
   ```bash
   docker run -d --name mariadb \
    --env ALLOW_EMPTY_PASSWORD=yes \
    --env MARIADB_USER=bn_myapp \
    --env MARIADB_DATABASE=bitnami_myapp \
    --network laravel-network \
    -p 3306:3306 \
    --volume mariadb_data:/bitnami/mariadb \
    bitnami/mariadb:latest
   ```

6. Clone/levante a imagem que contém Laravel/servidor da aplicação (docker pull bitnami/laravel):
  ```bash
  docker run -d --name laravel \
    -p 8000:8000 \
    --env DB_HOST=mariadb \
    --env DB_PORT=3306 \
    --env DB_USERNAME=bn_myapp \
    --env DB_DATABASE=bitnami_myapp \
    --network laravel-network \
    --volume ${PWD}/my-project:/app \
    bitnami/laravel:latest
  ```

7. Caso queira parar os containers, utilize:
  ```bash
  docker stop $(docker ps -aq)
  ```

8. Para reiniciar os containers:
  ```bash
  docker start mariadb
  docker start laravel
  ```

9. A aplicação estará acessível na porta 8000 do localhost.
