<?php

it('can render phone_number validation')
    ->expect(vr()->phone_number())
    ->toEqual('phone_number')
;

it('can render invert phone_number validation')
    ->expect(vr()->not()->phone_number())
    ->toEqual('invert_phone_number')
;

$correct = [
    'test'  => '555-555-5555',
    'test2' => '5555425555',
    'test3' => '555 555 5555',
    'test4' => '1(222) 555-4444',
    'test5' => '1 (519) 555-4422',
    'test6' => '1-555-555-5555',
    'test7' => '1-(555)-555-5555',
];
$incorrect = [
    'test' => '666111222',
    'test' => '004461234123',
];
// validate with correct input field

it('can validate phone_number with correct input', function () use ($correct) {
    $val = new \Validator\Validator($correct);

    $field_name = array_keys($correct);
    $val->field(...$field_name)->phone_number();

    expect($val->is_valid())->toBeTrue();
});

it('can validate numeric (not) with correct input', function () use ($correct) {
    $val = new \Validator\Validator($correct);

    $field_name = array_keys($correct);
    $val->field(...$field_name)->not->phone_number();

    expect($val->is_valid())->toBeFalse();
});

// validate with incorrect input field

it('can validate phone_number with incorrect input', function () use ($incorrect) {
    $val = new \Validator\Validator($incorrect);

    $field_name = array_keys($incorrect);
    $val->field(...$field_name)->phone_number();

    expect($val->is_valid())->toBeFalse();
});

it('can validate phone_number (not) with incorrect input', function () use ($incorrect) {
    $val = new \Validator\Validator($incorrect);

    $field_name = array_keys($incorrect);
    $val->field(...$field_name)->not->phone_number();

    expect($val->is_valid())->toBeTrue();
});
