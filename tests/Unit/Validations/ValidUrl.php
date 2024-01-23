<?php

it('can render valid_url validation')
    ->expect(vr()->valid_url())
    ->toEqual('valid_url')
;

it('can render invert valid_url validation')
    ->expect(vr()->not->valid_url())
    ->toEqual('invert_valid_url')
;

$correct = [
    'test1' => 'http://test.com/',
    'test2' => 'http://test.com',
    'test3' => 'https://test.com',
    'test4' => 'tcp://test.com',
    'test5' => 'ftp://test.com',
];
$incorrect = [
    'test1' => 'example.com',
    'test2' => 'text',
];

// validate with correct input field

it('can validate valid_url with correct input', function () use ($correct) {
    $val = new Validator\Validator($correct);

    $field_name = array_keys($correct);
    $val->field(...$field_name)->valid_url();

    expect($val->is_valid())->toBeTrue();
});

it('can validate valid_url (not) with correct input', function () use ($correct) {
    $val = new Validator\Validator($correct);

    $field_name = array_keys($correct);
    $val->field(...$field_name)->not->valid_url();

    expect($val->is_valid())->toBeFalse();
});

// validate with incorrect input field

it('can validate valid_url with incorrect input', function () use ($incorrect) {
    $val = new Validator\Validator($incorrect);

    $field_name = array_keys($incorrect);
    $val->field(...$field_name)->valid_url();

    expect($val->is_valid())->toBeFalse();
});

it('can validate iban (not) with incorrect input', function () use ($incorrect) {
    $val = new Validator\Validator($incorrect);

    $field_name = array_keys($incorrect);
    $val->field(...$field_name)->not->valid_url();

    expect($val->is_valid())->toBeTrue();
});
