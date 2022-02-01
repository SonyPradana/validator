<?php

it('can render exact_len validation')
    ->expect(vr()->exact_len(240))
    ->toEqual('exact_len,240')
;

it('can render invert exact_len validation')
    ->expect(vr()->not()->exact_len(240))
    ->toEqual('invert_exact_len,240')
;

$correct   = ['test' => 'ñándú'];
$incorrect = ['test' => 'ñán'];
// validate with correct input field

it('can validate exact_len with correct input', function () use ($correct) {
    $val = new \Validator\Validator($correct);

    $val->test->exact_len(5);

    expect($val->is_valid())->toBeTrue();
});

it('can validate exact_len (not) with correct input', function () use ($correct) {
    $val = new \Validator\Validator($correct);

    $val->test->not->exact_len(5);

    expect($val->is_valid())->toBeFalse();
});

// validate with incorrect input field

it('can validate exact_len with incorrect input - less that', function () use ($incorrect) {
    $val = new \Validator\Validator($incorrect);

    // less that
    $val->test->exact_len(2);

    expect($val->is_valid())->toBeFalse();
});

it('can validate exact_len with incorrect input - more that', function () use ($incorrect) {
    $val = new \Validator\Validator($incorrect);

    // more that
    $val->test->exact_len(4);

    expect($val->is_valid())->toBeFalse();
});

it('can validate exact_len (not) with incorrect input - less that', function () use ($incorrect) {
    $val = new \Validator\Validator($incorrect);

    // less that
    $val->test->not->exact_len(2);

    expect($val->is_valid())->toBeTrue();
});

it('can validate exact_len (not) with incorrect input - more that', function () use ($incorrect) {
    $val = new \Validator\Validator($incorrect);

    // more that
    $val->test->not->exact_len(4);

    expect($val->is_valid())->toBeTrue();
});
