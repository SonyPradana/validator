<?php

it('can render valid_array_size_equal validation')
    ->expect(vr()->valid_array_size_equal(1))
    ->toEqual('valid_array_size_equal,1')
;

it('can render invert valid_array_size_equal validation')
    ->expect(vr()->not()->valid_array_size_equal(1))
    ->toEqual('invert_valid_array_size_equal,1')
;

// provider
$correct   = ['test' => [1, 2, 3]];
$incorrect = ['test' => [1, 2]];

// validate with correct input field

it('can validate valid_array_size_equal with correct input', function () use ($correct) {
    $val = new Validator\Validator($correct);

    $val->test->valid_array_size_equal(3);

    expect($val->is_valid())->toBeTrue();
});

it('can validate valid_array_size_equal (not) with correct input', function () use ($correct) {
    $val = new Validator\Validator($correct);

    $val->test->not()->valid_array_size_equal(3);

    expect($val->is_valid())->toBeFalse();
});

// validate with incorrect input field

it('can validate valid_array_size_equal with incorrect input - greate that', function () use ($incorrect) {
    $val = new Validator\Validator($incorrect);

    // greate that
    $val->test->valid_array_size_equal(3);

    expect($val->is_valid())->toBeFalse();
});

it('can validate valid_array_size_equal with incorrect input - less that', function () use ($incorrect) {
    $val = new Validator\Validator($incorrect);

    // less that
    $val->test->valid_array_size_equal(1);

    expect($val->is_valid())->toBeFalse();
});

it('can validate regex (not) with incorrect input - greate that', function () use ($incorrect) {
    $val = new Validator\Validator($incorrect);

    // greate that
    $val->test->not->valid_array_size_equal(3);

    expect($val->is_valid())->toBeTrue();
});

it('can validate regex (not) with incorrect input - less that', function () use ($incorrect) {
    $val = new Validator\Validator($incorrect);

    // less that
    $val->test->not->valid_array_size_equal(1);

    expect($val->is_valid())->toBeTrue();
});
