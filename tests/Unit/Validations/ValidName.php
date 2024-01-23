<?php

it('can render valid_name validation')
    ->expect(vr()->valid_name())
    ->toEqual('valid_name')
;

it('can render invert valid_name validation')
    ->expect(vr()->not()->valid_name())
    ->toEqual('invert_valid_name')
;

$correct = [
    'test1' => 'taylorotwell',
    'tets2' => '',
];
$incorrect = [
    'tets1' => 'sa`ad',
    'tets2' => 's@ad',
    'test3' => 'Mr. Sigurd Heller MD',
];

// validate with correct input field

it('can validate valid_name with correct input', function () use ($correct) {
    $val = new Validator\Validator($correct);

    $field_name = array_keys($correct);
    $val->field(...$field_name)->valid_name();

    expect($val->is_valid())->toBeTrue();
});

it('can validate valid_name (not) with correct input', function () use ($correct) {
    $val = new Validator\Validator($correct);

    $field_name = array_keys($correct);
    $val->field(...$field_name)->not->valid_name();

    expect($val->is_valid())->toBeFalse();
});

// validate with incorrect input field

it('can validate valid_name with incorrect input', function () use ($incorrect) {
    $val = new Validator\Validator($incorrect);

    $field_name = array_keys($incorrect);
    $val->field(...$field_name)->valid_name();

    expect($val->is_valid())->toBeFalse();
});

it('can validate valid_name (not) with incorrect input', function () use ($incorrect) {
    $val = new Validator\Validator($incorrect);

    $field_name = array_keys($incorrect);
    $val->field(...$field_name)->not->valid_name();

    expect($val->is_valid())->toBeTrue();
});
