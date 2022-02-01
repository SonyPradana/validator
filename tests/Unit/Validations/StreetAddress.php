<?php

it('can render street_address validation')
    ->expect(vr()->street_address())
    ->toEqual('street_address')
;

it('can render invert street_address validation')
    ->expect(vr()->not()->street_address())
    ->toEqual('invert_street_address')
;

// provider
$correct = [
    'test'  => '6 Avondans Road',
    'test2' => 'Calle Mediterráneo 2',
];

$incorrect = [
    'test'  => 'Avondans Road',
    'test2' => 'text',
];

// validate with correct input field

it('can validate street_address with correct input', function () use ($correct) {
    $val = new \Validator\Validator($correct);

    $field_name = array_keys($correct);
    $val->field(...$field_name)->street_address();

    expect($val->is_valid())->toBeTrue();
});

it('can validate street_address (not) with correct input', function () use ($correct) {
    $val = new \Validator\Validator($correct);

    $field_name = array_keys($correct);
    $val->field(...$field_name)->not->street_address();

    expect($val->is_valid())->toBeFalse();
});

// validate with incorrect input field

it('can validate street_address with incorrect input', function () use ($incorrect) {
    $val = new \Validator\Validator($incorrect);

    $field_name = array_keys($incorrect);
    $val->field(...$field_name)->street_address();

    expect($val->is_valid())->toBeFalse();
});

it('can validate street_address (not) with incorrect input', function () use ($incorrect) {
    $val = new \Validator\Validator($incorrect);

    $field_name = array_keys($incorrect);
    $val->field(...$field_name)->not->street_address();

    expect($val->is_valid())->toBeTrue();
});
