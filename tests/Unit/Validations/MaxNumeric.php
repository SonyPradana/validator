<?php

it('can render max_numeric validation')
    ->expect(vr()->max_numeric(50))
    ->toEqual('max_numeric,50')
;

it('can render invert max_numeric validation')
    ->expect(vr()->not()->max_numeric(50))
    ->toEqual('invert_max_numeric,50')
;

$correct = [
    'test1' => 2,
    'test2' => 1,
    'test3' => '',
];
$incorrect = [
    'test' => 3,
];

// validate with correct input field

it('can validate max_numeric with correct input', function () use ($correct) {
    $val = new Validator\Validator($correct);

    $val->field('test1', 'test2', 'test3')->max_numeric(2);

    expect($val->is_valid())->toBeTrue();
});

it('can validate max_numeric (not) with correct input', function () use ($correct) {
    $val = new Validator\Validator($correct);

    $val->field('test1', 'test2', 'test3')->not->max_numeric(2);

    expect($val->is_valid())->toBeFalse();
});

// validate with incorrect input field

it('can validate max_numeric with incorrect input', function () use ($incorrect) {
    $val = new Validator\Validator($incorrect);

    // more
    $val->test->max_numeric(2);

    expect($val->is_valid())->toBeFalse();
});

it('can validate max_numeric (not) with incorrect input', function () use ($incorrect) {
    $val = new Validator\Validator($incorrect);

    // more
    $val->test->not->max_numeric(2);

    expect($val->is_valid())->toBeTrue();
});
