<?php

use Validator\Rule\Filter;

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
