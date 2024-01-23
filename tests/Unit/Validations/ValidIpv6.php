<?php

it('can render valid_ipv6 validation')
    ->expect(vr()->valid_ipv6())
    ->toEqual('valid_ipv6')
;

it('can render invert valid_ipv6 validation')
    ->expect(vr()->not()->valid_ipv6())
    ->toEqual('invert_valid_ipv6')
;

$correct = [
    'test' => '2001:0db8:85a3:08d3:1319:8a2e:0370:7334',
];
$incorrect = [
    'tets1' => '2001;0db8;85a3;08d3;1319;8a2e;0370;7334',
    'tets1' => '0,0,0,0',
    'tets1' => '256.0.0.0',
];

// validate with correct input field

it('can validate valid_ipv6 with correct input', function () use ($correct) {
    $val = new Validator\Validator($correct);

    $field_name = array_keys($correct);
    $val->field(...$field_name)->valid_ipv6();

    expect($val->is_valid())->toBeTrue();
});

it('can validate valid_ipv6 (not) with correct input', function () use ($correct) {
    $val = new Validator\Validator($correct);

    $field_name = array_keys($correct);
    $val->field(...$field_name)->not->valid_ipv6();

    expect($val->is_valid())->toBeFalse();
});

// validate with incorrect input field

it('can validate valid_ipv6 with incorrect input', function () use ($incorrect) {
    $val = new Validator\Validator($incorrect);

    $field_name = array_keys($incorrect);
    $val->field(...$field_name)->valid_ipv6();

    expect($val->is_valid())->toBeFalse();
});

it('can validate valid_ipv6 (not) with incorrect input', function () use ($incorrect) {
    $val = new Validator\Validator($incorrect);

    $field_name = array_keys($incorrect);
    $val->field(...$field_name)->not->valid_ipv6();

    expect($val->is_valid())->toBeTrue();
});
