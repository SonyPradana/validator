<?php

it('can render float validation')
    ->expect(vr()->float())
    ->toEqual('float')
;

it('can render invert float validation')
    ->expect(vr()->not()->float())
    ->toEqual('invert_float')
;

$correct = [
    'test1' => 0,
    'test2' => 1.1,
    'test3' => '1.1',
    'test4' => -1.1,
    'test5' => '-1.1',
];
$incorrect = [
    'test1' => '1,1',
    'test2' => '1.0,0',
    'test3' => '1,0.0',
    'test4' => 'text',
];

// validate with correct input field

it('can validate float with correct input', function () use ($correct) {
    $val = new \Validator\Validator($correct);

    $field_name = array_keys($correct);
    $val->field(...$field_name)->float();

    expect($val->is_valid())->toBeTrue();
});

it('can validate float (not) with correct input', function () use ($correct) {
    $val = new \Validator\Validator($correct);

    $field_name = array_keys($correct);
    $val->field(...$field_name)->not->float();

    expect($val->is_valid())->toBeFalse();
});

// validate with incorrect input field

it('can validate float with incorrect input', function () use ($incorrect) {
    $val = new \Validator\Validator($incorrect);

    $field_name = array_keys($incorrect);
    $val->field(...$field_name)->float();

    expect($val->is_valid())->toBeFalse();
});

it('can validate iban (not) with incorrect input', function () use ($incorrect) {
    $val = new \Validator\Validator($incorrect);

    $field_name = array_keys($incorrect);
    $val->field(...$field_name)->not->float();

    expect($val->is_valid())->toBeTrue();
});
