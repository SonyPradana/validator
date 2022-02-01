<?php

it('can render valid_json_string validation')
    ->expect(vr()->valid_json_string())
    ->toEqual('valid_json_string')
;

it('can render invert valid_json_string validation')
    ->expect(vr()->not()->valid_json_string())
    ->toEqual('invert_valid_json_string')
;

$correct = [
    'test1' => '{}',
    'test2' => '{"testing": true}',
];
$incorrect = [
    'tets1' => '{}}',
    'tets1' => '{test:true}',
    'tets1' => '{"test":text}',
];

// validate with correct input field

it('can validate valid_json_string with correct input', function () use ($correct) {
    $val = new \Validator\Validator($correct);

    $field_name = array_keys($correct);
    $val->field(...$field_name)->valid_json_string();

    expect($val->is_valid())->toBeTrue();
});

it('can validate valid_json_string (not) with correct input', function () use ($correct) {
    $val = new \Validator\Validator($correct);

    $field_name = array_keys($correct);
    $val->field(...$field_name)->not->valid_json_string();

    expect($val->is_valid())->toBeFalse();
});

// validate with incorrect input field

it('can validate valid_json_string with incorrect input', function () use ($incorrect) {
    $val = new \Validator\Validator($incorrect);

    $field_name = array_keys($incorrect);
    $val->field(...$field_name)->valid_json_string();

    expect($val->is_valid())->toBeFalse();
});

it('can validate valid_json_string (not) with incorrect input', function () use ($incorrect) {
    $val = new \Validator\Validator($incorrect);

    $field_name = array_keys($incorrect);
    $val->field(...$field_name)->not->valid_json_string();

    expect($val->is_valid())->toBeTrue();
});
