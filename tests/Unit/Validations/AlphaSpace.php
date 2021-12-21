<?php

it('can render alpha_space validation', function () {
    expect(vr()->alpha_space())
        ->toEqual('alpha_space')
    ;
});

it('can render invert alpha_space validation', function () {
    expect(vr()->not()->alpha_space())
        ->toEqual('invert_alpha_space')
    ;
});
