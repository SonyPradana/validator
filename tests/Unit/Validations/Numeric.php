<?php

it('can render numeric validation')
    ->expect(vr()->numeric())
    ->toEqual('numeric')
;

it('can render invert numeric validation')
    ->expect(vr()->not()->numeric())
    ->toEqual('invert_numeric')
;

$correct = [
    'test1' => 123,
    'test2' => 1.2,
    'test3' => 0,
    'test4' => '0',
    'test5' => -1,
    'test6' => '123',
    'test7' => '-1',
    'test8' => '',
];
$incorrect = [
    'test' => 'n0t',
];
// validate with correct input field

it('can validate numeric with correct input', function () use ($correct) {
    $val = new Validator\Validator($correct);

    $field_name = array_keys($correct);
    $val->field(...$field_name)->numeric();

    expect($val->is_valid())->toBeTrue();
});

it('can validate numeric (not) with correct input', function () use ($correct) {
    $val = new Validator\Validator($correct);

    $field_name = array_keys($correct);
    $val->field(...$field_name)->not->numeric();

    expect($val->is_valid())->toBeFalse();
});

// validate with incorrect input field

it('can validate numeric with incorrect input', function () use ($incorrect) {
    $val = new Validator\Validator($incorrect);

    $val->test->numeric();

    expect($val->is_valid())->toBeFalse();
});

it('can validate numeric (not) with incorrect input', function () use ($incorrect) {
    $val = new Validator\Validator($incorrect);

    $val->test->not->numeric();

    expect($val->is_valid())->toBeTrue();
});
