## Uservel - Laravel User Management Package

### Installation

#### Using Composer

```comopser install soltmar/uservel```

Define User model class in uservel.php config file

change user provider class in auth.php conifg to:

```
'providers' => [
           'users' => [
               'driver' => 'eloquent',
               'model' => \User::class,
           ],
           ...
]
```
