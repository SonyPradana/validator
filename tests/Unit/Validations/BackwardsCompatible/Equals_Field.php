<?php

it('can render equals_field validation')
    ->expect(vr()->equals_field('other_field_name'))
    ->toEqual('equalsfield,other_field_name')
;

it('can render invert equals_field validation')
    ->expect(vr()->not->equals_field('other_field_name'))
    ->toEqual('invert_equalsfield,other_field_name')
;

$correct   = ['test' => 'string', 'other' => 'string'];
$incorrect = ['test' => 'string', 'other' => 'different_string'];

// validate with correct input field

it('can validate equals_field with correct input', function () use ($correct) {
    $val = new Validator\Validator($correct);

    $val->test->equals_field('other');

    expect($val->is_valid())->toBeTrue();
});

it('can validate equals_field (not) with correct input', function () use ($correct) {
    $val = new Validator\Validator($correct);

    $val->test->not->equals_field('other');

    expect($val->is_valid())->toBeFalse();
});

// validate with incorrect input field

it('can validate equals_field with incorrect input', function () use ($incorrect) {
    $val = new Validator\Validator($incorrect);

    $val->test->equals_field('other');

    expect($val->is_valid())->toBeFalse();
});

it('can validate contains (not) with incorrect input', function () use ($incorrect) {
    $val = new Validator\Validator($incorrect);

    $val->test->not->equals_field('other');

    expect($val->is_valid())->toBeTrue();
});
