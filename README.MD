# RUN 

* STEPS: 
- Run `lando rebuild -y` to start project
- Run `lando composer install ` install all packages
  - Run `lando console doctrine:migrations:migrate` AFTER PULLING FROM GIT
  - Run `lando console doctrine:fixtures:load` if you want to load fixtures
  - Run `lando console make:entity Movie` if you want to create a new entity or fields on entity existing
  - Run `lando composer require symfony/form` if you need forms in symfony
    - `lando console make:form MovieFormType Movie` - `lando console make:form FormName EntityName` Creates form

- Run `lando composer require symfony/security-bundle` to install sec