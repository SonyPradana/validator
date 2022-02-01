<?php

it('can render contains validation')
    ->expect(vr()->contains('one', 'two'))
    ->toEqual('contains,one;two')
;

it('can render invert contains validation')
    ->expect(vr()->not()->contains('one', 'two'))
    ->toEqual('invert_contains,one;two')
;

$correct = [
    'test1' => 'one',
    'test2' => 'with space',
];
$incorrect = [
    'test1' => 'two',
    'test2' => 'with space',
];

// validate with correct input field

it('can validate contains with correct input', function () use ($correct) {
    $val = new \Validator\Validator($correct);

    $val->test->contains('one', 'two');
    $val->test2->contains('one', 'two', 'with space');

    expect($val->is_valid())->toBeTrue();
});

it('can validate contains (not) with correct input', function () use ($correct) {
    $val = new \Validator\Validator($correct);

    $val->test->not->contains('one', 'two');
    $val->test2->not->contains('one', 'two', 'with space');

    expect($val->is_valid())->toBeFalse();
});

// validate with incorrect input field

it('can validate contains with incorrect input', function () use ($incorrect) {
    $val = new \Validator\Validator($incorrect);

    $val->test->contains('one');
    $val->test2->contains('one', 'with spac');

    expect($val->is_valid())->toBeFalse();
});

it('can validate contains (not) with incorrect input', function () use ($incorrect) {
    $val = new \Validator\Validator($incorrect);

    $val->test->not->contains('one');
    $val->test2->not->contains('one', 'with spec');

    expect($val->is_valid())->toBeTrue();
});
