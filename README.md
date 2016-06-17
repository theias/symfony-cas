symfony-cas
===========

This is a reference implementation of:

  * [Symfony](https://symfony.com/)
  * [Central Authentication Service](https://en.wikipedia.org/wiki/Central_Authentication_Service) (CAS)
  * [BeSimpleSsoAuthBundle](https://github.com/BeSimple/BeSimpleSsoAuthBundle)
  * [Database users with the Entity provider](http://symfony.com/doc/2.8/cookbook/security/entity_provider.html)
  
I made this to sort out the mysterious create_users setting of BeSimpleSsoAuthBundle. There are some crud forms for managing users at /admin/user.

The following are the changes from a default Symfony 2.8 install:

## composer.json

    {
        "require": {
            // ... 
            "besimple/sso-auth-bundle": "@dev"
        }
    }
    
## app/AppKernel.php

```
$bundles = array(
   // ...
   new BeSimple\SsoAuthBundle\BeSimpleSsoAuthBundle(),
);
```
    
## app/config/config.yml

Replace with your CAS server name:

```
be_simple_sso_auth:
    cas_sso:
        protocol:
            id: cas
            version: 2
        server:
            id: cas
            login_url: "%cas_login_url%"
            logout_url: "%cas_logout_url%"
            validation_url: "%cas_validation_url%"

```
    
## app/config/routing.yml

```
logout:
    path: /logout

```


## app/config/security.yml

This configuration protects all pages except the home page.

    encoders:
        AppBundle\Entity\User:
            algorithm: bcrypt
            
    providers:
        app_db_provider:
            entity:
                class: AppBundle:User
                
    firewalls:
        dev:
            pattern: ^/(_(profiler|wdt)|css|images|js)/
            security: false

        main:
            pattern: (^/$|^/login/error$)
            anonymous: true

        secure:
            pattern: ^/.*
            anonymous: false
            provider: app_db_provider
            trusted_sso:
                manager: cas_sso
                login_path: /
                login_action: false # BeSimpleSsoAuthBundle:TrustedSso:login
                logout_action: false # BeSimpleSsoAuthBundle:TrustedSso:logout
                create_users: true
                created_users_roles: [ROLE_USER]
                check_path: /login/check
                failure_path: /login/error
            logout:
                path: /logout
                target: /

    access_control:
        - { path: ^/admin, roles: ROLE_ADMIN }
   

## app/config/services.yml

    parameters:
        doctrine.orm.security.user.provider.class: AppBundle\Security\User\EntityUserProvider
        
## app/config/parameters.yml

    parameters:
        # ...
        cas_login_url: https://sso.example.com/cas/login
        cas_logout_url: https://sso.example.com/cas/logout
        cas_validation_url: https://sso.example.com/cas/serviceValidate

## Important classes and templates

 * src//AppBundle/Controller/DefaultController.php
 * src//AppBundle/Controller/SecurityController.php
 * src//AppBundle/Entity/User.php
 * src//AppBundle/Entity/UserRepository.php
 * src//AppBundle/Resources/views/Security/error.html.twig
 * src//AppBundle/Security/User/EntityUserProvider.php

## Remember to set up your users table

    php app/console doctrine:schema:update --force