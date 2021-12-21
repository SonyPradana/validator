<?php

it('can render float validation', function () {
    expect(vr()->float())
        ->toEqual('float')
    ;
});

it('can render invert float validation', function () {
    expect(vr()->not()->float())
        ->toEqual('invert_float')
    ;
});
