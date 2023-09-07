# Aplicação web feita com PHP utilizando as tecnologias Amazon RDS e EC2

O objetivo deste repositório é entregar apresentar e guardar a aplicação da atividade ponderada da semana 5 de programação que consiste em um servidor web Apache feit em PHP com mariaDB

# **Desenvolvendo a Página Web e Configurando a Instância**

1. **Desenvolvendo a Página Web**: Agora, eu desenvolvi a minha aplicação web e configurei a instância EC2:
    - Criei a estrutura de arquivos da minha aplicação web no diretório **`/var/www`** da minha instância EC2.
    - Desenvolvi a página principal da minha aplicação web (**`SamplePage.php`**) para permitir a criação e listagem de registros na tabela do banco de dados.

# **Inserindo Arquivos nas Pastas Correspondentes**

1. **Inserindo Arquivos nas Pastas Correspondentes**: Por fim, eu inseri os arquivos **`dbinfo.inc`** e **`SamplePage.php`** nas pastas apropriadas:
    - Criei uma subpasta chamada **`inc`** dentro de **`/var/www`** para armazenar o arquivo **`dbinfo.inc`**, que contém informações de conexão com o banco de dados.
    - Dentro da pasta **`/var/www/html`**, criei o arquivo **`SamplePage.php`**, que contém a lógica para interagir com o banco de dados e exibir registros em uma tabela HTML.
    - O arquivo **`SamplePage.php`** incluiu a inclusão do arquivo **`dbinfo.inc`** para acessar as informações de conexão com o banco de dados.
**A página web contém:**
    - 4 inputs: Nome = texto, ENDEREÇO = texto, TELEFONE = número, TERMO ACEITO ? = booleano
    - 1 submit: o botão que vai adicionar as informações dos inputs na tabela USER
    - 1 Tabela com as colunas ID(ID), NOME(NAME), ENDEREÇO(ADDRESS), TELEFONE(PHONE) e TERMO ACEITO(TERMS)

Após esses passos, eu consegui criar a minha aplicação web integrada a um banco de dados, com o Amazon RDS como banco de dados e o Amazon EC2 como servidor web. Os arquivos **`dbinfo.inc`** e **`SamplePage.php`** foram configurados corretamente nas pastas apropriadas, permitindo que a minha aplicação web se conecte ao banco de dados e interaja com os registros.
