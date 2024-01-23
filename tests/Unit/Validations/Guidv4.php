<?php

it('can render guidv4 validation')
    ->expect(vr()->guidv4())
    ->toEqual('guidv4')
;

it('can render invert guidv4 validation')
    ->expect(vr()->not->guidv4())
    ->toEqual('invert_guidv4')
;

$correct = [
    'test1' => 'A98C5A1E-A742-4808-96FA-6F409E799937',
    'test2' => '7deca41a-3479-4f18-9771-3531f742061b',
];
$incorrect = [
    'test1' => 'A98C5A1EA742480896FA6F409E799937',
    'test2' => '7deca41a-9771-3531f742061b',
];
// validate with correct input field

it('can validate guidv4 with correct input', function () use ($correct) {
    $val = new Validator\Validator($correct);

    $val->test1->guidv4();
    $val->test2->guidv4();

    expect($val->is_valid())->toBeTrue();
});

it('can validate guidv4 (not) with correct input', function () use ($correct) {
    $val = new Validator\Validator($correct);

    $val->test1->not->guidv4();
    $val->test2->not->guidv4();

    expect($val->is_valid())->toBeFalse();
});

// validate with incorrect input field

it('can validate guidv4 with incorrect input', function () use ($incorrect) {
    $val = new Validator\Validator($incorrect);

    $val->test1->guidv4();
    $val->test2->guidv4();

    expect($val->is_valid())->toBeFalse();
});

it('can validate guidv4 (not) with incorrect input', function () use ($incorrect) {
    $val = new Validator\Validator($incorrect);

    $val->test1->not->guidv4();
    $val->test2->not->guidv4();

    expect($val->is_valid())->toBeTrue();
});
