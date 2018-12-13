# <img src="https://github.com/j84reginato/sistema_atendimento_basico/blob/master/public/img/logo.png" width="36" height="36"> Sistema de Atendimento Básico

## Introdução

>Esta aplicação trata-se de um protótipo de um **Sistema de Atendimento Básico** desenvolvido com o objetivo de contemplar uma etapa do *Processo Seletivo para Analista Desenvolvimento FullStack PHP* da empresa **Madeira Madeira**.

## Começando

>Estas instruções farão com que você tenha uma cópia do projeto em execução em sua máquina local para fins de desenvolvimento e teste.

### Pré-requisitos

A aplicação requer que seu servidor tenha a versão 5.6 (ou posterior) do PHP instalada.

Para instalar as depêndencias e configurar o auto-carregamento das classes, este projeto utiliza o [Composer](https://getcomposer.org/).
Se você não tiver instalado, então por favor o instale conforme procedimentos encontrados na [documentação](https://getcomposer.org/doc/00-intro.md).

Além disso, este projeto utiliza a extensão de reescrita de URL para redirecionar os usuários da web para o script de entrada da aplicação, portanto você precisa ativar o módulo mod_rewrite do Apache.

### Instalando

1) **Banco de dados:**
- O script da estrutura e registros essenciais do banco de dados encontra-se em `ROOT_DIR/data/sql/atendimento.sql`

2) **Configuração:**
- Realize a configuração de acesso ao banco de dados em `ROOT_DIR/config/autoload/global.php`

Uma vez configurado, você pode testá-lo imediatamente usando o servidor web integrado do PHP:

```bash
$ cd ROOT_DIR/public
$ php -S 0.0.0.0:8080 -t ROOT_DIR/public
```

Ou

1 - Configure a seguinte linha do composer.json:
```bash
# ...
"scripts": {
    "serve": "php -S 0.0.0.0:8080 -t ROOT_DIR/public"
}
```

2 - E então use o alias do composer:
```bash
$ cd `ROOT_DIR/public`
$ composer run --timeout 0 serve
```

Isto irá iniciar o servidor-cli na porta 8080 e ligá-lo a interface de rede.
Você pode então visitar o site em http://localhost:8080/ - que abrirá a página inicial da aplicação.

**Nota:** O servidor CLI integrado é *apenas para uso em desenvolvimento*.

## Usando Vagrant

Esta aplicação inclui um `Vagrantfile` baseado no ubuntu 16.04 (bento box) com o Apache2 e o PHP 7.0 configurados. Comece usando:

```bash
$ vagrant up
```

Uma vez construído, você poderá executar o Composer.
O seguinte comando irá instalar dependências:

```bash
$ vagrant ssh -c 'composer install'
```

Enquanto este comando irá atualizá-lo:

```bash
$ vagrant ssh -c 'composer update'
```

Durante a execução, o Vagrant mapeia sua porta do host 8080 para a porta 80 na máquina virtual; você pode visitar o site em http://localhost:8080/

> ### Vagrant e VirtualBox
>
> A imagem do Vagrant é baseada no ubuntu/xenial64.
> Se você estiver usando o VirtualBox como provedor, precisará:
>
> - Vagrant 1.8.5 ou mais recente
> - VirtualBox 5.0.26 ou mais recente

Para a documentação do Vagrant, por favor consulte [vagrantup.com](https://www.vagrantup.com/)

## Usando docker-compose

A aplicação fornece um `docker-compose.yml` para uso com [docker-compose](https://docs.docker.com/compose/).
Será utiliza o `Dockerfile` fornecido.

Construa e inicie a imagem usando:

```bash
$ docker-compose up -d --build
```

Neste ponto, você pode visitar http://localhost:8080 para ver a aplicação em execução.

Você também pode executar o Composer a partir da imagem.
O ambiente do contêiner é denominado "sistemaatendimentobasico", então você passará esse valor para `docker-compose run`:

```bash
$ docker-compose run sistemaatendimentobasico composer install
```

## Configuração do Servidor Web

### Apache

Para configurar o Apache, configure um host virtual que aponte para o diretório `public/` do projeto e você estará pronto para utilizar a aplicação!

```apache
<VirtualHost *:80>
    ServerName sistemaatendimentobasico
    DocumentRoot "/ROOT_DIR/sistemaatendimentobasico"
    ErrorLog "/ROOT_DIR/sistemaatendimentobasico/data/log/error_log"
    CustomLog "/ROOT_DIR/sistemaatendimentobasico/data/log/access_log" common
    <Directory "/ROOT_DIR/sistemaatendimentobasico/">
        DirectoryIndex index.php
        AllowOverride All
        Order allow,deny
        Allow from all
        <IfModule mod_authz_core.c>
        Require all granted
        </IfModule>
    </Directory>
</VirtualHost>
```
No Windows deve-se adicionar a seguinte linha ao final do arquivo `C:\Windows\System32\drivers\etc\hosts`:

```C:\Windows\System32\drivers\etc\hosts
# ...
127.0.0.1       sistemaatendimentobasico
```

### Nginx setup

Para configurar o nginx, abra seu `/ROOT_DIR/nginx/nginx.conf` e adicione uma [include directive](http://nginx.org/en/docs/ngx_core_module.html#include) no bloco `http` abaixo, se ainda não existir:

```nginx
http {
    # ...
    include sites-enabled/*.conf;
}
```

Crie um arquivo de configuração de host virtual para seu projeto em `/ROOT_DIR/nginx/sites-enabled/sistemaatendimentobasico.localhost.conf`.
Deve ser algo como abaixo:

```nginx
server {
    listen       80;
    server_name  sistemaatendimentobasico;
    root         /ROOT_DIR/sistemaatendimentobasico;

    location / {
        index index.php;
        try_files $uri $uri/ @php;
    }

    location @php {
        # Pass the PHP requests to FastCGI server (php-fpm) on 127.0.0.1:9000
        fastcgi_pass   127.0.0.1:9000;
        fastcgi_param  SCRIPT_FILENAME `/ROOT_DIR/sistemaatendimentobasico/public/index.php`;
        include fastcgi_params;
    }
}
```

Reinicie o nginx!
Agora você deve estar pronto para utilizar a aplicação!

## Desenvolvido com

* [Bootstrap](https://getbootstrap.com/) - Kit de ferramentas de código aberto para desenvolvimento com HTML, CSS e JS.
* [Chart.js](https://www.chartjs.org/) - Gráficos JavaScript simples e flexíveis para designers e desenvolvedores.
* [Feather](https://feathericons.com//) - Uma coleção de ícones de código aberto.
* [FontAwesome](https://fontawesome.com/) - Conjunto de ícones e ferramentas.
* [Gregwar/Captcha](https://github.com/Gregwar/Captcha/) - Gerador Captcha.
* [jQuery](https://jquery.com/) - Uma biblioteca de funções JavaScript.
* [OwlCarousel](https://owlcarousel2.github.io/OwlCarousel2/) - plugin jQuery que permite criar controles deslizantes de carrossel.
* [Popper](https://popper.js.org/) - Biblioteca para gerenciar poppers em aplicativos web.

## Contribuição

Por favor, leia [CONTRIBUTING.md](CONTRIBUTING.md) para detalhes sobre o código de conduta, e o processo de envio de *pull requests*.

## Versionamento

Para as versões disponíveis, veja as [tags neste repositório](https://github.com/j84reginato/sistema_atendimento_basico/tags).

## Autor

* **Jonatan Noronha Reginato** - *Trabalho inicial* - [j84reginato](https://github.com/j84reginato)

## Licença

Consulte o arquivo [LICENSE.md](LICENSE.md) para obter detalhes.


> ## .
> ## .
> ## .
> ## .
> **"O homem que trabalha somente pelo que recebe, não merece ser pago pelo que faz"** - *Abraham Lincoln*
