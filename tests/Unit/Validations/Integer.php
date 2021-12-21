<?php

it('can render integer validation', function () {
    expect(vr()->integer())
        ->toEqual('integer')
    ;
});

it('can render invert integer validation', function () {
    expect(vr()->not()->integer())
        ->toEqual('invert_integer')
    ;
});
