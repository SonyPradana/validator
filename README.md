<p align="center">
<img src="https://raw.githubusercontent.com/sonypradana/validator/master/docs/header.png" alt="elegant validator">
    <p align="center">
        <a href="https://packagist.org/packages/sonypradana/validator"><img alt="Total Downloads" src="https://img.shields.io/packagist/dt/sonypradana/validator"></a>
        <a href="https://github.com/sonypradana/validator/actions"><img alt="Latest Version" src="https://img.shields.io/github/stars/SonyPradana/validator"></a>
        <a href="https://github.com/SonyPradana/validator/blob/main/LICENSE.md"><img alt="License" src="https://img.shields.io/github/license/SonyPradana/validator"></a>
    </p>
</p>

# Validation & Filter

Build validation with elegant,
power by [(Wixel/GUMP)](https://github.com/Wixel/GUMP)

## Validation
```php
$val = new Validator($_POST);

$val->field('name')->required()->validName();
// or
$val->name->required()->validName();

$val->if_valid(function() {
    // continue
})->else(function($err) {
    // array of error messages
    var_dump($err);
});
```

### **GUMP support**
```php
$is_valid = GUMP::is_valid(array_merge($_POST, $_FILES), [
    'username' => vr()->required()->alpha_numeric(),
    'password' => vr()->required()->between_len(6, 100),
    'avatar'   => vr()->required_file()->extension('png', 'jpg')
]);

if ($is_valid === true) {
    // continue
} else {
    // array of error messages
    var_dump($is_valid);
}
```
### **Available method**

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
- `valid_twitter()`

And
- `not()`, for invert all available method.
- `where($condition)`, execute rule if condition true.
- `if($condition)`, execute rule if condition true.

## Filter
Fiter field input
```php
$val = new Validator($_POST);

$val->filter('name')->trim()->lowwer_case();

// run filter
$filter = $val->filter_out();
```
validation and filter
```php
$val = new Validator($_POST);

$val->field('name')->required()->valid_name();
$val->filter('name')->trim()->lowwer_case();

// run validation and filter
$filter = $val->failedOrFilter());
```

### **Why use Validator**
Why use valdidator over `GUMP` validator.
- Avoid typo when building validator rule. When using validator may accidentally typing wrong validate rule (typo). It make runtime error.
- Autocomplete out of the box. Auto complete validator rule and maintainable rule.
