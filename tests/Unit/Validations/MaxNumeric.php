<?php

it('can render max_numeric validation', function () {
    expect(vr()->max_numeric(50))
        ->toEqual('max_numeric,50')
    ;
});

it('can render invert max_numeric validation', function () {
    expect(vr()->not()->max_numeric(50))
        ->toEqual('invert_max_numeric,50')
    ;
});
