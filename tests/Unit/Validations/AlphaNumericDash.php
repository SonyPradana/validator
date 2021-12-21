<?php

it('can render alpha_numeric_dash validation', function () {
    expect(vr()->alpha_numeric_dash())
        ->toEqual('alpha_numeric_dash')
    ;
});

it('can render invert alpha_numeric_dash validation', function () {
    expect(vr()->not()->alpha_numeric_dash())
        ->toEqual('invert_alpha_numeric_dash')
    ;
});
