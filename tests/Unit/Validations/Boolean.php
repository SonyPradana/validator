<?php

it('can render boolean validation')
    ->expect(vr()->boolean(false))
    ->toEqual('boolean')
;

it('can render boolean validation (strict)')
    ->expect(vr()->boolean(true))
    ->toEqual('boolean,strict')
;

it('can render invert boolean validation')
    ->expect(vr()->not->boolean(false))
    ->toEqual('invert_boolean')
;

it('can render invert boolean validation (strict)')
    ->expect(vr()->not->boolean(true))
    ->toEqual('invert_boolean,strict')
;

$correct = [
    'test1' => 'true',
    'test2' => 'false',
    'test3' => 'on',
    'test4' => 'off',
    'test5' => '1',
    'test6' => '0',
    'test7' => 'yes',
    'test8' => 'no',
];
$correct_strict = [
    'test1' => true,
    'test2' => false,
];
$incorrect = [
    'test1' => 'randomString',
    'test2' => 111,
    'test3' => 'TRUE',
    'test4' => 'False',
];

// validate with correct input field
it('can validate boolean with correct input', function () use ($correct) {
    $val = new \Validator\Validator($correct);

    $field_name = array_keys($correct);
    $val->field(...$field_name)->boolean(false);

    expect($val->is_valid())->toBeTrue();
});

it('can validate boolean with correct input (strict)', function () use ($correct_strict) {
    $val = new \Validator\Validator($correct_strict);

    $val->test1->boolean(true);
    $val->test2->boolean(true);

    expect($val->is_valid())->toBeTrue();
});

it('can validate boolean (not) with correct input', function () use ($correct) {
    $val = new \Validator\Validator($correct);

    $field_name = array_keys($correct);
    $val->field(...$field_name)->not->boolean(false);

    expect($val->is_valid())->toBeFalse();
});

it('can validate boolean (not) with correct input (strict)', function () use ($correct_strict) {
    $val = new \Validator\Validator($correct_strict);

    $val->test1->not->boolean(true);
    $val->test2->not->boolean(true);

    expect($val->is_valid())->toBeFalse();
});

// validate with incorrect input field

it('can validate boolean with incorrect input', function () use ($incorrect) {
    $val = new \Validator\Validator($incorrect);

    $field_name = array_keys($incorrect);
    $val->field(...$field_name)->boolean(false);

    expect($val->is_valid())->toBeFalse();
});

it('can validate boolean (not) with incorrect input', function () use ($incorrect) {
    $val = new \Validator\Validator($incorrect);

    $field_name = array_keys($incorrect);
    $val->field(...$field_name)->not->boolean(false);

    expect($val->is_valid())->toBeTrue();
});
