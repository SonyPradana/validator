<?php

it('can render valid_ip validation')
    ->expect(vr()->valid_ip())
    ->toEqual('valid_ip')
;

it('can render invert valid_ip validation')
    ->expect(vr()->not()->valid_ip())
    ->toEqual('invert_valid_ip')
;

$correct = [
    'test' => '2001:0db8:85a3:08d3:1319:8a2e:0370:7334',
    'test' => '127.0.0.1',
    'test' => '255.255.255.255',
];
$incorrect = [
    'tets1' => '2001:0zb8:85a3:08d3:1319:8a2e:0370:7334',
    'tets1' => '0,0,0,0',
    'tets1' => '256.0.0.0',
];

// validate with correct input field

it('can validate valid_ip with correct input', function () use ($correct) {
    $val = new Validator\Validator($correct);

    $field_name = array_keys($correct);
    $val->field(...$field_name)->valid_ip();

    expect($val->is_valid())->toBeTrue();
});

it('can validate valid_ip (not) with correct input', function () use ($correct) {
    $val = new Validator\Validator($correct);

    $field_name = array_keys($correct);
    $val->field(...$field_name)->not->valid_ip();

    expect($val->is_valid())->toBeFalse();
});

// validate with incorrect input field

it('can validate valid_ip with incorrect input', function () use ($incorrect) {
    $val = new Validator\Validator($incorrect);

    $field_name = array_keys($incorrect);
    $val->field(...$field_name)->valid_ip();

    expect($val->is_valid())->toBeFalse();
});

it('can validate valid_ip (not) with incorrect input', function () use ($incorrect) {
    $val = new Validator\Validator($incorrect);

    $field_name = array_keys($incorrect);
    $val->field(...$field_name)->not->valid_ip();

    expect($val->is_valid())->toBeTrue();
});
