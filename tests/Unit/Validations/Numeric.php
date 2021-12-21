<?php

it('can render numeric validation', function () {
    expect(vr()->numeric())
        ->toEqual('numeric')
    ;
});

it('can render invert numeric validation', function () {
    expect(vr()->not()->numeric())
        ->toEqual('invert_numeric')
    ;
});
