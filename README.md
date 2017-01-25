# Roles And Permissions For Laravel 5

Powerful package for handling roles and permissions in Laravel 5 (5.*).

## Instalacion

Paquete hecho por geeklopers, con base de romanbican/roles. Para instalarlo solo son los siguientes pasos.

### Composer

Agrega el paquete al archivo de Composer (`composer.json`).

```js
{
    "require": {
        "php": ">=5.5.9",
        "laravel/framework": "5.1.*",
        "geeklopers/roles": "dev-master"
    }
}
```

Ejecuta el siguiente comando en la terminal.

    composer update

### Service Provider

Agrega el paquete a la aplicacion en los service providers ( `config/app.php` ).

```php
'providers' => [
    
    /*
     * Laravel Framework Service Providers...
     */
    Illuminate\Foundation\Providers\ArtisanServiceProvider::class,
    Illuminate\Auth\AuthServiceProvider::class,
    ...
    
    /**
     * Third Party Service Providers...
     */
    Geeklopers\Roles\RolesServiceProvider::class,

],
```

### Configuracion y Migracion

Agrega la configuracion y la migracion a la aplicacion, ejecuta los siguientes comandos en la terminar.

    php artisan vendor:publish --provider="Geeklopers\Roles\RolesServiceProvider" --tag=config
    php artisan vendor:publish --provider="Geeklopers\Roles\RolesServiceProvider" --tag=migrations

Luego ejecuta la migracion.

    php artisan migrate

> Este paquete tiene su propio modelo para usuarios. Borra las migraciones de laravel y deberia estar todo listo para trabajar.

### UsuariosRolesPermisos Trait y Contract

Implementa `UsuariosRolesPermisos` trait y `UsuariosRolesPermisos` contract en el modelo de usuarios si lo quieres cambiar.

```php
use Geeklopers\Roles\Traits\UsuariosRolesPermisos;
use Geeklopers\Roles\Contracts\UsuariosRolesPermisos as UsuariosRolesPermisosContract;

class User extends Model implements AuthenticatableContract, UsuariosRolesPermisosContract
{
    use Authenticatable, UsuariosRolesPermisos;
```

And that's it!

## Config File

You can change connection for models, slug separator, models path and there is also a handy pretend feature. Have a look at config file for more information.

## More Information

For more information, please have a look at [UsuariosRolesPermisos](https://github.com/romanbican/roles/blob/master/src/Bican/Roles/Contracts/UsuariosRolesPermisos.php) contract.

## License

This package is free software distributed under the terms of the MIT license.
