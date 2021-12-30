<?php

use Validator\Rule\Filter;
use Validator\Rule\Valid;

it('can render validation string using chain method', function () {
    $rule = new Valid();

    $rule
        ->required()
        ->contains('one', 'two')
        ->boolean()
        ->max_len(240)
        ->min_len(240)
        ->exact_len(240)
        ->between_len(3, 11)
        ->alpha()
        ->alpha_numeric()
        ->alpha_dash()
        ->alpha_numeric_dash()
        ->alpha_numeric_space()
        ->alpha_space()
        ->numeric()
        ->integer()
        ->float()
        ->valid_url()
        ->url_exists()
        ->valid_ip()
        ->valid_ipv4()
        ->valid_ipv6()
        ->valid_cc()
        ->valid_name()
        ->street_address()
        ->iban()
        ->date('31/12/1999')
        ->min_age(18)
        ->max_numeric(50)
        ->starts('Z')
        ->required_file()
        ->extension('png', 'jpg', 'gif')
        ->equals_field('other_field_name')
        ->guidv4()
        ->phone_number()
        ->regex('/test-[0-9]{3}/')
        ->valid_json_string()
        ->valid_array_size_greater(1)
        ->valid_array_size_lesser(1)
        ->valid_array_size_equal(1)
        ->valid_twitter()
    ;

    expect($rule)
        ->toEqual('required|contains,one;two|boolean,strict|max_len,240|min_len,240|exact_len,240|between_len,3;11|alpha|alpha_numeric|alpha_dash|alpha_numeric_dash|alpha_numeric_space|alpha_space|numeric|integer|float|valid_url|url_exists|valid_ip|valid_ipv4|valid_ipv6|valid_cc|valid_name|street_address|iban|date,31/12/1999|min_age,18|max_numeric,50|starts,Z|required_file|extension,png;jpg;gif|equalsfield,other_field_name|guidv4|phone_number|regex,/test-[0-9]{3}/|valid_json_string|valid_array_size_greater,1|valid_array_size_lesser,1|valid_array_size_equal,1|valid_twitter')
    ;
});

it('can render invert validation string using chain method', function () {
    $rule = new Valid();

    $rule
        ->not()->required()
        ->not()->contains('one', 'two')
        ->not()->boolean()
        ->not()->max_len(240)
        ->not()->min_len(240)
        ->not()->exact_len(240)
        ->not()->between_len(3, 11)
        ->not()->alpha()
        ->not()->alpha_numeric()
        ->not()->alpha_dash()
        ->not()->alpha_numeric_dash()
        ->not()->alpha_numeric_space()
        ->not()->alpha_space()
        ->not()->numeric()
        ->not()->integer()
        ->not()->float()
        ->not()->valid_url()
        ->not()->url_exists()
        ->not()->valid_ip()
        ->not()->valid_ipv4()
        ->not()->valid_ipv6()
        ->not()->valid_cc()
        ->not()->valid_name()
        ->not()->street_address()
        ->not()->iban()
        ->not()->date('31/12/1999')
        ->not()->min_age(18)
        ->not()->max_numeric(50)
        ->not()->starts('Z')
        ->not()->required_file()
        ->not()->extension('png', 'jpg', 'gif')
        ->not()->equals_field('other_field_name')
        ->not()->guidv4()
        ->not()->phone_number()
        ->not()->regex('/test-[0-9]{3}/')
        ->not()->valid_json_string()
        ->not()->valid_array_size_greater(1)
        ->not()->valid_array_size_lesser(1)
        ->not()->valid_array_size_equal(1)
        ->not()->valid_twitter()
    ;

    expect($rule)
        ->toEqual('invert_required|invert_contains,one;two|invert_boolean,strict|invert_max_len,240|invert_min_len,240|invert_exact_len,240|invert_between_len,3;11|invert_alpha|invert_alpha_numeric|invert_alpha_dash|invert_alpha_numeric_dash|invert_alpha_numeric_space|invert_alpha_space|invert_numeric|invert_integer|invert_float|invert_valid_url|invert_url_exists|invert_valid_ip|invert_valid_ipv4|invert_valid_ipv6|invert_valid_cc|invert_valid_name|invert_street_address|invert_iban|invert_date,31/12/1999|invert_min_age,18|invert_max_numeric,50|invert_starts,Z|invert_required_file|invert_extension,png;jpg;gif|invert_equalsfield,other_field_name|invert_guidv4|invert_phone_number|invert_regex,/test-[0-9]{3}/|invert_valid_json_string|invert_valid_array_size_greater,1|invert_valid_array_size_lesser,1|invert_valid_array_size_equal,1|invert_valid_twitter')
    ;
});

it('can render all filter string using chain method', function () {
    $rule = new Filter();

    $rule
        ->noise_words()
        ->rmpunctuation()
        ->urlencode()
        ->sanitize_email()
        ->sanitize_numbers()
        ->sanitize_floats()
        ->sanitize_string()
        ->boolean()
        ->basic_tags()
        ->whole_number()
        ->ms_word_characters()
        ->lower_case()
        ->upper_case()
        ->slug()
        ->trim()
    ;

    expect($rule)
        ->toEqual('noise_words|rmpunctuation|urlencode|sanitize_email|sanitize_numbers|sanitize_floats|sanitize_string|boolean|basic_tags|whole_number|ms_word_characters|lower_case|upper_case|slug|trim');
});
