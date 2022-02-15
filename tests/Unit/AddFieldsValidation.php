<?php

use Validator\Validator;

// add field
it('can add field using constructor', function () {
    $fields = [
        'field_1' => 'field_1',
        'field_2' => 'field_3',
        'field_3' => 'field_3',
    ];

    $valid = new Validator($fields);
    expect($valid->get_fields())
        ->toEqual($fields)
    ;
});

it('can add field using static method (make)', function () {
    $fields = [
        'field_1' => 'field_1',
        'field_2' => 'field_3',
        'field_3' => 'field_3',
    ];

    expect(Validator::make($fields)->get_fields())
        ->toEqual($fields)
    ;
});

it('can add field using method fields', function () {
    $fields = [
        'field_1' => 'field_1',
        'field_2' => 'field_3',
        'field_3' => 'field_3',
    ];

    $valid = new Validator();
    $valid->fields($fields);
    expect($valid->get_fields())
        ->toEqual($fields)
    ;
});
