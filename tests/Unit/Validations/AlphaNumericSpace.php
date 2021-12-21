<?php

it('can render alpha_numeric_space validation', function () {
    expect(vr()->alpha_numeric_space())
        ->toEqual('alpha_numeric_space')
    ;
});

it('can render invert alpha_numeric_space validation', function () {
    expect(vr()->not()->alpha_numeric_space())
        ->toEqual('invert_alpha_numeric_space')
    ;
});
