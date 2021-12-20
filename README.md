# Validation

Build validation with beautiful 
power by [Wixel/GUMP] (https://github.com/Wixel/GUMP)

```php
$val = new Validator($_POST);

$val->name->required()->validName();
// or
$val->field('name')->required()->validName();

$val->if_valid(function() {
    // continue
})->else(function($err) {
    var_dump($error);
});
```

GUMP support
```php
$is_valid = GUMP::is_valid(array_merge($_POST, $_FILES), [
    'username' => vr()->required()->alpha_numeric(),
    'password' => vr()->required()->between_len(6, 100),
    'avatar'   => vr()->required_file()->extension('png', 'jpg')
]);

if ($is_valid === true) {
    // continue
} else {
    var_dump($is_valid); // array of error messages
}
```
