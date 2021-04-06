# O Desafio

Temos 2 tipos de usuários, os comuns e lojistas, ambos têm carteira com dinheiro e realizam transferências entre eles. Vamos nos atentar **somente** ao fluxo de transferência entre dois usuários.

Requisitos:

- Para ambos tipos de usuário, precisamos do Nome Completo, CPF, e-mail e Senha. CPF/CNPJ e e-mails devem ser únicos no sistema. Sendo assim, seu sistema deve permitir apenas um cadastro com o mesmo CPF ou endereço de e-mail.

- Usuários podem enviar dinheiro (efetuar transferência) para lojistas e entre usuários. 

- Lojistas **só recebem** transferências, não enviam dinheiro para ninguém.

- Antes de finalizar a transferência, deve-se consultar um serviço autorizador externo, use este mock para simular (https://run.mocky.io/v3/8fafdd68-a090-496f-8c9a-3442cf30dae6).

- A operação de transferência deve ser uma transação (ou seja, revertida em qualquer caso de inconsistência) e o dinheiro deve voltar para a carteira do usuário que envia. 

- No recebimento de pagamento, o usuário ou lojista precisa receber notificação enviada por um serviço de terceiro e eventualmente este serviço pode estar indisponível/instável. Use este mock para simular o envio (https://run.mocky.io/v3/b19f7b9f-9cbf-4fc6-ad22-dc30601aec04). 

- Este serviço deve ser RESTFul.

## Payload

POST /transaction

```json
{
    "value" : 100.00,
    "payer" : 4,
    "payee" : 15
}
```
# O Resultado

## Tecnologias utilizadas

- Lumen: Framework PHP utilizado para desenvolvimento da API
- Swagger: Para a documentação da API 
- PHPUnit: Para os testes
- Docker: Ambiente de desenvolvimento com PHP 8, última versão do Mysql, phpmyadmin e composer

## Instalações necessárias

Como o docker já instalou o composer, vamos só executá-lo dentro do container para baixar as dependencias necessárias que estão no composer.json

> composer install

## Alguns comandos necessários (dentro do container)

Gerar swagger
> php artisan swagger-lume:generate

Migration: Para criar tabelas de acordo com o arquivo migration
> php artisan migrate

Seed: Para gerar dados fake
> php artisan db:seed

Executar testes
> vendor/bin/phpunit

## Acessos
- API (http://localhost/public/api/{ENDPOINT})
- Doc Swagger (http://localhost/public/api/documentation)

# Links

[Lumen](https://lumen.laravel.com/docs)

[Swagger para Lumen](https://github.com/DarkaOnLine/SwaggerLume)
