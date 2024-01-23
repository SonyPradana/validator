<?php

it('can render required validation', function () {
    expect(vr()->required())
        ->toEqual('required')
    ;
});

it('can render invert required validation', function () {
    expect(vr()->not()->required())
        ->toEqual('invert_required')
    ;
});

// validate with correct input field
$correct = [
    'test1' => 'test',
    'test2' => '0',
    'test3' => 0.0,
    'test4' => 0,
    'test5' => false,
];
$incorrect = [
    'test1' => null,
    'test2' => '',
];

it('can validate regex with correct input', function () use ($correct) {
    $val = new Validator\Validator($correct);

    $field_name = array_keys($correct);
    $val->field(...$field_name)->required();

    expect($val->is_valid())->toBeTrue();
});

it('can validate required (not) with correct input', function () use ($correct) {
    $val = new Validator\Validator($correct);

    $field_name = array_keys($correct);
    $val->field(...$field_name)->not->required();

    expect($val->is_valid())->toBeFalse();
});

// validate with incorrect input field

it('can validate required with incorrect input', function () use ($incorrect) {
    $val = new Validator\Validator($incorrect);

    $field_name = array_keys($incorrect);
    $val->field(...$field_name)->required();

    expect($val->is_valid())->toBeFalse();
});

it('can validate regex (not) with incorrect input', function () use ($incorrect) {
    $val = new Validator\Validator($incorrect);

    $field_name = array_keys($incorrect);
    $val->field(...$field_name)->not->required();

    expect($val->is_valid())->toBeTrue();
});
