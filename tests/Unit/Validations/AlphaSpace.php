<?php

it('can render alpha_space validation')
    ->expect(vr()->alpha_space())
    ->toEqual('alpha_space')
;

it('can render invert alpha_space validation')
    ->expect(vr()->not()->alpha_space())
    ->toEqual('invert_alpha_space')
;

$correct   = ['test' => ' azÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖßÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ '];
$incorrect = ['test' => '1 azÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖßÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ'];

// validate with correct input field
it('can validate alpha_space with correct input', function () use ($correct) {
    $val = new \Validator\Validator($correct);
    $val->test->alpha_space();

    expect($val->is_valid())->toBeTrue();
});

it('can validate alpha_space (not) with correct input', function () use ($correct) {
    $val = new \Validator\Validator($correct);
    $val->test->not()->alpha_space();

    expect($val->is_valid())->toBeFalse();
});

// validate with incorrect input field
it('can validate alpha_space with incorrect input', function () use ($incorrect) {
    $val = new \Validator\Validator($incorrect);
    $val->test->alpha_space();

    expect($val->is_valid())->toBeFalse();
});

it('can validate alpha_space (not) with incorrect input', function () use ($incorrect) {
    $val = new \Validator\Validator($incorrect);
    $val->test->not()->alpha_space();

    expect($val->is_valid())->toBeTrue();
});
