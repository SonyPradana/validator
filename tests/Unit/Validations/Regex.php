<?php

it('can render regex validation')
    ->expect(vr()->regex('/test-[0-9]{3}/'))
    ->toEqual('regex,/test-[0-9]{3}/')
;

it('can render invert regex validation')
    ->expect(vr()->not()->regex('/test-[0-9]{3}/'))
    ->toEqual('invert_regex,/test-[0-9]{3}/')
;

$correct   = ['test' => 'validation using gump'];
$incorrect = ['test' => 'testing using pest'];
// validate with correct input field

it('can validate regex with correct input', function () use ($correct) {
    $val = new Validator\Validator($correct);

    $val->test->regex('/gump/i');

    expect($val->is_valid())->toBeTrue();
});

it('can validate regex (not) with correct input', function () use ($correct) {
    $val = new Validator\Validator($correct);

    $val->test->not->regex('/gump/i');

    expect($val->is_valid())->toBeFalse();
});

// validate with incorrect input field

it('can validate regex with incorrect input', function () use ($incorrect) {
    $val = new Validator\Validator($incorrect);

    $val->test->regex('/gump/i');

    expect($val->is_valid())->toBeFalse();
});

it('can validate regex (not) with incorrect input', function () use ($incorrect) {
    $val = new Validator\Validator($incorrect);

    $val->test->not()->regex('/gump/i');

    expect($val->is_valid())->toBeTrue();
});
