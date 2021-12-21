<?php

it('can render street_address validation', function () {
    expect(vr()->street_address())
        ->toEqual('street_address')
    ;
});

it('can render invert street_address validation', function () {
    expect(vr()->not()->street_address())
        ->toEqual('invert_street_address')
    ;
});
