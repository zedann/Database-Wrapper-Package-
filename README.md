# dbWrapper

dbWrapper is a small php wrapper for mysql databases.

## installation

install once with composer:

```
composer require zedan/database-package
```

then add this to your project:

```php
require __DIR__ . '/vendor/autoload.php';
use Zedan\DatabasePackage\DbWrapper;
$db = new DbWrapper();
```

## usage

```php
/* connect to database */
$db->connect('pdo', 'mysql', '127.0.0.1', 'username', 'password', 'database', 3306);
$db = new DbWrapper('127.0.0.1', 'username', 'password', 'database', 3306);


/* insert/update/delete */
$id = $db->insert('tablename', ['col1' => 'foo'])->execute();
$db->update('tablename', ['col1' => 'bar'])->where('id','=',$id)->execute();
$db->delete('tablename')->where('id','=',$id)->execute();
$db->select('tablename',$cols|)->where()->getRow();
$db->select('tablename',$cols|)->getAll()
$db->select('tablename',$cols|)->where()->andWhere()->getRow();
$db->select('tablename',$cols|)->where()->orWhere()->getRow();
```
