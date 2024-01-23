<?php

it('can render min_len validation')
    ->expect(vr()->min_len(240))
    ->toEqual('min_len,240')
;

it('can render invert min_len validation')
    ->expect(vr()->not()->min_len(240))
    ->toEqual('invert_min_len,240')
;

$correct = [
    'test1' => 'ñándú',
    'test2' => 'ñán',
    'test3' => '',
];
$incorrect = [
    'test' => 'ñ',
];
// validate with correct input field

it('can validate min_len with correct input', function () use ($correct) {
    $val = new Validator\Validator($correct);

    $val->test1->min_len(5);
    $val->test2->min_len(2);
    $val->test3->min_len(2);

    expect($val->is_valid())->toBeTrue();
});

it('can validate min_len (not) with correct input', function () use ($correct) {
    $val = new Validator\Validator($correct);

    $val->test1->not->min_len(5);
    $val->test2->not->min_len(2);
    $val->test3->not->min_len(2);

    expect($val->is_valid())->toBeFalse();
});

// validate with incorrect input field

it('can validate min_len with incorrect input', function () use ($incorrect) {
    $val = new Validator\Validator($incorrect);

    $val->test->min_len(2);

    expect($val->is_valid())->toBeFalse();
});

it('can validate min_len (not) with incorrect input', function () use ($incorrect) {
    $val = new Validator\Validator($incorrect);

    $val->test->not()->min_len(2);

    expect($val->is_valid())->toBeTrue();
});
