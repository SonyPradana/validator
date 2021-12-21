<?php

it('can render guidv4 validation', function () {
    expect(vr()->guidv4())
        ->toEqual('guidv4')
    ;
});

it('can render invert guidv4 validation', function () {
    expect(vr()->not()->guidv4())
        ->toEqual('invert_guidv4')
    ;
});
