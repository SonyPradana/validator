<?php

it('can render alpha_dash validation', function () {
    expect(vr()->alpha_dash())
        ->toEqual('alpha_dash')
    ;
});

it('can render invert alpha_dash validation', function () {
    expect(vr()->not()->alpha_dash())
        ->toEqual('invert_alpha_dash')
    ;
});
