<?php

it('can render alpha_numeric validation', function () {
    expect(vr()->alpha_numeric())
        ->toEqual('alpha_numeric')
    ;
});

it('can render invert alpha_numeric validation', function () {
    expect(vr()->not()->alpha_numeric())
        ->toEqual('invert_alpha_numeric')
    ;
});
