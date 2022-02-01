<?php

it('can render alpha validation')
    ->expect(vr()->alpha())
    ->toEqual('alpha');

it('can render invert alpha validation')
    ->expect(vr()->not()->alpha())
    ->toEqual('invert_alpha');

$correct   = ['test' => 'azÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖßÙÚÛÜÝÑàáâãäåçèéêëìíîïðòóôõöùúûüýÿñ'];
$incorrect = ['test' => '123azÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖßÙÚÛÜÝÑàáâãäåçèéêëìíîïðòóôõöùúûüýÿñ'];

// validate with correct input field
it('can validate alpha with correct input', function () use ($correct) {
    $val = new \Validator\Validator($correct);
    $val->test->alpha();

    expect($val->is_valid())->toBeTrue();
});

it('can validate alpha (not) with correct input', function () use ($correct) {
    $val = new \Validator\Validator($correct);
    $val->test->not()->alpha();

    expect($val->is_valid())->toBeFalse();
});

// validate with incorrect input field
it('can validate alpha with incorrect input', function () use ($incorrect) {
    $val = new \Validator\Validator($incorrect);
    $val->test->alpha();

    expect($val->is_valid())->toBeFalse();
});

it('can validate alpha (not) with incorrect input', function () use ($incorrect) {
    $val = new \Validator\Validator($incorrect);
    $val->test->not()->alpha();

    expect($val->is_valid())->toBeTrue();
});
