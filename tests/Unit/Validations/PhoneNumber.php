<?php

it('can render phone_number validation', function () {
    expect(vr()->phone_number())
        ->toEqual('phone_number')
    ;
});

it('can render invert phone_number validation', function () {
    expect(vr()->not()->phone_number())
        ->toEqual('invert_phone_number')
    ;
});
