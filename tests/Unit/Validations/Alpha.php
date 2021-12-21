<?php

it('can render alpha validation', function () {
    expect(vr()->alpha())
        ->toEqual('alpha')
    ;
});

it('can render invert alpha validation', function () {
    expect(vr()->not()->alpha())
        ->toEqual('invert_alpha')
    ;
});
