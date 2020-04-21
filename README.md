# Guia

Requirements:

- PHP 7.2.24

- composer
- symfony cli (instal·lació al final de tot)



Clonar repositori https://github.com/genis99/symfony_m6

Després des de dins del repositori executem:

```
composer install
```

Modifiquem el fitxer .env per tindre accés a la BBDD.

```
DATABASE_URL=mysql://USUARI:PASSWORD@127.0.0.1:3306/BASE_DE_DADES?serverVersion=5.7
```

Si no existeix la BBDD la creem en:

```
php bin/console doctrine:database:create
```

I per crear l'esquema de taules haurem d'executar:

```
php bin/console doctrine:schema:update --force
```

Finalment per poder iniciar el servidor he utilitzat el cli de symfony que s'instal·la amb

```bash
wget https://get.symfony.com/cli/installer -O - | bash
```

```bash
export PATH="$HOME/.symfony/bin:$PATH"
```



Ja el podem iniciar

```
symfony server:start
```