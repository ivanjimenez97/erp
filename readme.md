# werp

**werp** Es un [ERP](https://en.wikipedia.org/wiki/Enterprise_resource_planning) hecho en CodeIgniter.

## Requerimientos

- php7+
- mysql ó mariadb

## Instalación

- Clona este repo
- Crea una base de datos con el nombre `werp`
- importa en la bd el archivo [resources/latest.sql.gz](resources/latest.sql.gz)
- Apunta un vhost al root
- Copia [application/config/database.local.php](application/config/database.local.php) a `application/config/database.php`
- Edita los campos de la base de datos de `application/config/database.php` como el `username`, `password` y `database`
- go to http://erp.test

## Workflow

**La branch `master` deberá considerarse como la que se encuentra en producción y todas las ramas de desarrollo deberán basarse en esa**

Es buena práctica hacer commits seguidos, de esa forma se registran los avances. Si vas a trabajar en una tarea ("menus del admin" por poner un ejemplo), los pasos a seguir son los siguientes:

- Pasarte a `master` con: `git checkout master`
- Trae nuevos cambios de `master` con: `git pull origin master`
- Crear una nueva branch describiendo la tarea: `git branch -b admin-menus`
- PROGRAMAR!
- Commitear frecuentemente [ayuda con git](https://rogerdudler.github.io/git-guide/index.es.html)
- Cuando termines, sube tu branch con: `git push origin admin-menus`
- en gitlab, crear un **Merge Request** de tu branch a `dev`


