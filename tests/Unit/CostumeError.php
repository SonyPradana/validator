<?php

use Validator\Validator;

it('can change supported language', function () {
    $val = new Validator(['test' => null]);

    // change lang before run validation
    $val
        ->lang('id')
        ->field('test')->required()
    ;

    expect($val->get_error())->toBe(['test' => 'Bagian Test harus diisi']);
});

it('change supported language after run validator doesn\'t perform anything', function () {
    $val = new Validator(['test' => null]);

    $val->field('test')->required();
    $err = $val->get_error();
    // change lang after run validation
    $val->lang('id');

    expect($err)->toBe(['test' => 'The Test field is required']);
});
