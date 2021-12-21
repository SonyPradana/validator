<p align="center">
<img src="https://raw.githubusercontent.com/sonypradana/validator/master/docs/header.png" height="300" alt="Skeleton Php">
    <p align="center">
        <a href="https://packagist.org/packages/sonypradana/validator"><img alt="Total Downloads" src="https://img.shields.io/packagist/dt/sonypradana/validator"></a>
        <a href="https://github.com/sonypradana/validator/actions"><img alt="Latest Version" src="https://img.shields.io/github/stars/SonyPradana/validator"></a>
        <a href="https://github.com/SonyPradana/validator/blob/main/LICENSE.md"><img alt="License" src="https://img.shields.io/github/license/SonyPradana/validator"></a>
    </p>
</p>
# Validation

Build validation with beautiful 
power by [(Wixel/GUMP)](https://github.com/Wixel/GUMP)

```php
$val = new Validator($_POST);

$val->field('name')->required()->validName();
// or
$val->name->required()->validName();

$val->if_valid(function() {
    // continue
})->else(function($err) {
    var_dump($err);
});
```

**GUMP support**
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
**Available method**

- `required()`
- `valid_email()`
- `max_len()`
- `min_len()`
- `exact_len()`
- `between_len()`
- `alpha()`
- `alpha_numeric()`
- `alpha_numeric_space()`
- `alpha_numeric_dash()`
- `alpha_dash()`
- `alpha_space()`
- `numeric()`
- `integer()`
- `boolean()`
- `float()`
- `valid_url()`
- `url_exists()`
- `valid_ip()`
- `valid_ipv4()`
- `valid_ipv6()`
- `guidv4()`
- `valid_cc()`
- `valid_name()`
- `contains()`
- `contains_list()`
- `doesnt_contain_list()`
- `street_address()`
- `date()`
- `min_numeric()`
- `max_numeric()`
- `min_age()`
- `invalid()`
- `starts()`
- `extension()`
- `required_file()`
- `equalsfield()`
- `iban()`
- `phone_number()`
- `regex()`
- `valid_json_string()`
- `valid_array_size_greater()`
- `valid_array_size_lesser()`
- `valid_array_size_equal()`
- `valid_persian_name()`
- `valid_eng_per_pas_name()`
- `valid_persian_digit()`
- `valid_persian_text()`
- `valid_pashtu_text()`
- `valid_twitter()`

And
- `not()`, for invert all available method
