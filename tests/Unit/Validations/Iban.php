<?php

it('can render iban validation')
    ->expect(vr()->iban())
    ->toEqual('iban')
;

it('can render invert iban validation')
    ->expect(vr()->not()->iban())
    ->toEqual('invert_iban')
;

$correct = [
    'test1' => 'FR7630006000011234567890189',
    'test2' => 'ES7921000813610123456789',
];
$incorrect = [
    'test1' => 'FR7630006000011234567890181',
    'test2' => 'E7921000813610123456789',
    'test3' => 'text',
];

// validate with correct input field

it('can validate iban with correct input', function () use ($correct) {
    $val = new \Validator\Validator($correct);

    $field_name = array_keys($correct);
    $val->field(...$field_name)->iban();

    expect($val->is_valid())->toBeTrue();
});

it('can validate guidv4 (not) with correct input', function () use ($correct) {
    $val = new \Validator\Validator($correct);

    $field_name = array_keys($correct);
    $val->field(...$field_name)->not->iban();

    expect($val->is_valid())->toBeFalse();
});

// validate with incorrect input field

it('can validate iban with incorrect input', function () use ($incorrect) {
    $val = new \Validator\Validator($incorrect);

    $field_name = array_keys($incorrect);
    $val->field(...$field_name)->iban();

    expect($val->is_valid())->toBeFalse();
});

it('can validate iban (not) with incorrect input', function () use ($incorrect) {
    $val = new \Validator\Validator($incorrect);

    $field_name = array_keys($incorrect);
    $val->field(...$field_name)->not->iban();

    expect($val->is_valid())->toBeTrue();
});
