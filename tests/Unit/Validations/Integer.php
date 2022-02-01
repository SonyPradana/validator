<?php

it('can render integer validation')
    ->expect(vr()->integer())
    ->toEqual('integer')
;

it('can render invert integer validation')
    ->expect(vr()->not()->integer())
    ->toEqual('invert_integer')
;

$correct = [
    'test1' => '123',
    'test2' => 123,
    'test3' => -1,
    'test4' => 0,
    'test5' => '0',
];
$incorrect = [
    'test1' => 'text',
    'test2' => true,
    'test3' => null,
    'test4' => 1.1,
    'test5' => '1.1',
    'test6' => ['array'],
];

// validate with correct input field

it('can validate integer with correct input', function () use ($correct) {
    $val = new \Validator\Validator($correct);

    $field_name = array_keys($correct);
    $val->field(...$field_name)->integer();

    expect($val->is_valid())->toBeTrue();
});

it('can validate integer (not) with correct input', function () use ($correct) {
    $val = new \Validator\Validator($correct);

    $field_name = array_keys($correct);
    $val->field(...$field_name)->not->integer();

    expect($val->is_valid())->toBeFalse();
});

// validate with incorrect input field

it('can validate integer with incorrect input', function () use ($incorrect) {
    $val = new \Validator\Validator($incorrect);

    $field_name = array_keys($incorrect);
    $val->field(...$field_name)->integer();

    expect($val->is_valid())->toBeFalse();
});

it('can validate iban (not) with incorrect input', function () use ($incorrect) {
    $val = new \Validator\Validator($incorrect);

    $field_name = array_keys($incorrect);
    $val->field(...$field_name)->not->integer();

    expect($val->is_valid())->toBeTrue();
});
