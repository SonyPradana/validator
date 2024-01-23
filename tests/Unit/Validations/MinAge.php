<?php

it('can render min_age validation')
    ->expect(vr()->min_age(18))
    ->toEqual('min_age,18')
;

it('can render invert min_age validation')
    ->expect(vr()->not()->min_age(18))
    ->toEqual('invert_min_age,18')
;

$correct   = ['test' => '1997-06-16'];
$incorrect = ['test' => '2022-01-11'];

// validate with correct input field

it('can validate min_age with correct input', function () use ($correct) {
    $val = new Validator\Validator($correct);

    $val->test->min_age(23);

    expect($val->is_valid())->toBeTrue();
});

it('can validate min_age (not) with correct input', function () use ($correct) {
    $val = new Validator\Validator($correct);

    $val->test->not()->min_age(23);

    expect($val->is_valid())->toBeFalse();
});

// validate with incorrect input field

it('can validate min_age with incorrect input', function () use ($incorrect) {
    $val = new Validator\Validator($incorrect);

    $val->test->min_age(23);

    expect($val->is_valid())->toBeFalse();
});

it('can validate min_age (not) with incorrect input', function () use ($incorrect) {
    $val = new Validator\Validator($incorrect);

    $val->test->not()->min_age(23);

    expect($val->is_valid())->toBeTrue();
});
