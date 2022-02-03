<?php

it('can render equalsfield validation')
    ->expect(vr()->equalsfield('other_field_name'))
    ->toEqual('equalsfield,other_field_name')
;

it('can render invert equalsfield validation')
    ->expect(vr()->not->equalsfield('other_field_name'))
    ->toEqual('invert_equalsfield,other_field_name')
;

$correct   = ['test' => 'string', 'other' => 'string'];
$incorrect = ['test' => 'string', 'other' => 'different_string'];

// validate with correct input field

it('can validate equalsfield with correct input', function () use ($correct) {
    $val = new \Validator\Validator($correct);

    $val->test->equalsfield('other');

    expect($val->is_valid())->toBeTrue();
});

it('can validate equalsfield (not) with correct input', function () use ($correct) {
    $val = new \Validator\Validator($correct);

    $val->test->not->equalsfield('other');

    expect($val->is_valid())->toBeFalse();
});

// validate with incorrect input field

it('can validate equalsfield with incorrect input', function () use ($incorrect) {
    $val = new \Validator\Validator($incorrect);

    $val->test->equalsfield('other');

    expect($val->is_valid())->toBeFalse();
});

it('can validate contains (not) with incorrect input', function () use ($incorrect) {
    $val = new \Validator\Validator($incorrect);

    $val->test->not->equalsfield('other');

    expect($val->is_valid())->toBeTrue();
});
