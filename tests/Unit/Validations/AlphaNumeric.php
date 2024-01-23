<?php

it('can render alpha_numeric validation')
    ->expect(vr()->alpha_numeric())
    ->toEqual('alpha_numeric')
;

it('can render invert alpha_numeric validation')
    ->expect(vr()->not()->alpha_numeric())
    ->toEqual('invert_alpha_numeric')
;

$correct   = ['test' => '123azÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖßÙÚÛÜÝÑàáâãäåçèéêëìíîïðòóôõöùúûüýÿñ'];
$incorrect = ['test' => 'hello *(^*^*&\')'];

// validate with correct input field
it('can validate alpha with correct input', function () use ($correct) {
    $val = new Validator\Validator($correct);
    $val->test->alpha_numeric();

    expect($val->is_valid())->toBeTrue();
});

it('can validate alpha (not) with correct input', function () use ($correct) {
    $val = new Validator\Validator($correct);
    $val->test->not()->alpha_numeric();

    expect($val->is_valid())->toBeFalse();
});

// validate with incorrect input field
it('can validate alpha with incorrect input', function () use ($incorrect) {
    $val = new Validator\Validator($incorrect);
    $val->test->alpha_numeric();

    expect($val->is_valid())->toBeFalse();
});

it('can validate alpha (not) with incorrect input', function () use ($incorrect) {
    $val = new Validator\Validator($incorrect);
    $val->test->not()->alpha_numeric();

    expect($val->is_valid())->toBeTrue();
});
