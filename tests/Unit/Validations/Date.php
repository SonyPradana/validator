<?php

it('can render date validation')
    ->expect(vr()->date('d/m/Y'))
    ->toEqual('date,d/m/Y')
;

it('can render invert date validation')
    ->expect(vr()->not()->date('d/m/Y'))
    ->toEqual('invert_date,d/m/Y')
;

$correct = [
    'test1' => '2022/11/01',
    'test2' => '31-12-2019 10:10',
];
$incorrect = [
    'test1' => '2022/12/32',
    'test2' => '31-12-2019 10:70',
];

// validate with correct input field

it('can validate date with correct input', function () use ($correct) {
    $val = new \Validator\Validator($correct);

    $val->test1->date('Y/m/d');
    $val->test2->date('d-m-Y H:i');

    expect($val->is_valid())->toBeTrue();
});

it('can validate date (not) with correct input', function () use ($correct) {
    $val = new \Validator\Validator($correct);

    $val->test1->not->date('Y/m/d');
    $val->test2->not->date('d-m-Y H:i');

    expect($val->is_valid())->toBeFalse();
});

// validate with incorrect input field

it('can validate date with incorrect input', function () use ($incorrect) {
    $val = new \Validator\Validator($incorrect);

    $val->test1->date('Y/m/d');
    $val->test2->date('d-m-Y H:i');

    expect($val->is_valid())->toBeFalse();
});

it('can validate contains (not) with incorrect input', function () use ($incorrect) {
    $val = new \Validator\Validator($incorrect);

    $val->test1->not->date('Y/m/d');
    $val->test2->not->date('d-m-Y H:i');

    expect($val->is_valid())->toBeTrue();
});
