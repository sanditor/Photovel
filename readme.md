<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

<h1 align="center">PhotoVel</h1>

## Requisitos

Antes de comenzar, asegúrate de tener instalado lo siguiente:

- PHP 7.1+
- Composer (https://getcomposer.org/)
- MySQL o el sistema de gestión de bases de datos de tu elección
- Servidor web (por ejemplo, Apache, laragon o Nginx).

## Instrucciones

1. Clona el repositorio en tu máquina local por consola bash: git clone https://github.com/sanditor/Photovel.git.
2. Navega al directorio del proyecto: cd Photovel.
3. Ejecutar la sentencia sql(database.sql) que esta dentro de la carpeta de la raiz del proyecto llamada BBDD en php admin de msql o tu gestor de preferencia.
4. Instalar si no lo tienes composer (https://getcomposer.org/)
5. Instala las dependencias de Laravel utilizando Composer(bash): composer install.
6. Crea un archivo .env en la raíz del proyecto y configúralo con la información de tu base de datos:
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=Proyecto_RedSocial
    DB_USERNAME=root
    DB_PASSWORD=
4. Abrir la consola de windows, linux o la de su preferencia en la carpeta del proyecto descargado en el punto 1.
5. Teclear: composer update. Esto para actualizar las dependencias de composer.json y crear la carpeta vendor
6. Teclear: php artisan key:generate. Esto para generar la llave 
7. Teclear: php artisan serve. Para ejecutar el proyecto.
8. Abir el navegador de su preferencia y teclear en la url: localhost:8000
9. Registrar un usuario y subir fotos, editar, comentar, dar likes, cambiar la preferencias, entre otras funcionalidades

<h3 align="center">Capturas del Aplicativo</h3>

## Previews
<p align="center">
    <img src="public/img//iniciousuario.JPG" /><br/><br/>
    <img src="public/img/inicio.JPG" /><br/><br/>
    <img src="public/img/config_user.JPG" /><br/><br/>
    <img src="public/img/profile_user.JPG" /><br/><br/>
    <img src="public/img/comentar.JPG" /><br/><br/>
    <img src="public/img/favoritas.JPG" /><br/><br/>
</p>

<br/>

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
