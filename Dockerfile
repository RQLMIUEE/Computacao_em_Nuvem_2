
*usa a imgaem oficial do php com apache
FROM php:8.2-apache

*copia os arquivos da sua aplicação para o diretorio
COPY ./var/www/html

*habilidade modulos adicioais do apache
RUM docker-php-est-install mysqli pdo pdo_mysqli


*exponha a porta padão do Apache
EXPOSE 80
