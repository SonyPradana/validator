<?php

it('can render url_exists validation', function () {
    expect(vr()->url_exists())
        ->toEqual('url_exists')
    ;
});

it('can render invert url_exists validation', function () {
    expect(vr()->not()->url_exists())
        ->toEqual('invert_url_exists')
    ;
});

// provider
$correct   = ['test'  => 'https://google.com/'];
$incorrect = ['test'  => ''];

// validate with correct input field

it('can validate url_exists with correct input', function () use ($correct) {
    $val = new \Validator\Validator($correct);

    $val->test->url_exists();

    expect($val->is_valid())->toBeTrue();
});

it('can validate url_exists (not) with correct input', function () use ($correct) {
    $val = new \Validator\Validator($correct);

    $val->test->not()->url_exists();

    expect($val->is_valid())->toBeFalse();
});

// validate with incorrect input field

// FIXME: url exis validation for incorrect url always return true
