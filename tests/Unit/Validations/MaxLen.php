<?php

it('can render max_len validation')
    ->expect(vr()->max_len(240))
    ->toEqual('max_len,240')
;

it('can render invert max_len validation')
    ->expect(vr()->not()->max_len(240))
    ->toEqual('invert_max_len,240')
;

$correct = [
    'test1' => 'ñándú',
    'test2' => 'ñ',
    'test3' => '',
];
$incorrect = [
    'test' => 'ñán',
];

// validate with correct input field

it('can validate max_len with correct input', function () use ($correct) {
    $val = new Validator\Validator($correct);

    $val->test1->max_len(5);
    $val->test2->max_len(2);
    $val->test3->max_len(2);

    expect($val->is_valid())->toBeTrue();
});

it('can validate max_len (not) with correct input', function () use ($correct) {
    $val = new Validator\Validator($correct);

    $val->test1->not->max_len(5);
    $val->test2->not->max_len(2);
    $val->test3->not->max_len(2);

    expect($val->is_valid())->toBeFalse();
});

// validate with incorrect input field

it('can validate max_len with incorrect input', function () use ($incorrect) {
    $val = new Validator\Validator($incorrect);

    $val->test->max_len(2);

    expect($val->is_valid())->toBeFalse();
});

it('can validate max_len (not) with incorrect input', function () use ($incorrect) {
    $val = new Validator\Validator($incorrect);

    $val->test->not->max_len(2);

    expect($val->is_valid())->toBeTrue();
});
