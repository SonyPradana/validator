<?php

it('can render alpha_numeric_space validation')
    ->expect(vr()->alpha_numeric_space())
    ->toEqual('alpha_numeric_space')
;

it('can render invert alpha_numeric_space validation')
    ->expect(vr()->not->alpha_numeric_space())
    ->toEqual('invert_alpha_numeric_space')
;

$correct   = ['test' => 'azÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖßÙÚÛÜÝÑàáâãäåçèéêëìíîïðòóôõöùúûüýÿñ123 '];
$incorrect = ['test' => 'azÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖßÙÚÛÜÝÑàáâãäåçèéêëìíîïðòóôõöùúûüýÿñ123 -'];

// validate with correct input field
it('can validate alpha with correct input', function () use ($correct) {
    $val = new \Validator\Validator($correct);
    $val->test->alpha_numeric_space();

    expect($val->is_valid())->toBeTrue();
});

it('can validate alpha (not) with correct input', function () use ($correct) {
    $val = new \Validator\Validator($correct);
    $val->test->not()->alpha_numeric_space();

    expect($val->is_valid())->toBeFalse();
});

// validate with incorrect input field
it('can validate alpha with incorrect input', function () use ($incorrect) {
    $val = new \Validator\Validator($incorrect);
    $val->test->alpha_numeric_space();

    expect($val->is_valid())->toBeFalse();
});

it('can validate alpha (not) with incorrect input', function () use ($incorrect) {
    $val = new \Validator\Validator($incorrect);
    $val->test->not()->alpha_numeric_space();

    expect($val->is_valid())->toBeTrue();
});
