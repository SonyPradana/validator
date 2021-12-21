<?php

it('can render iban validation', function () {
    expect(vr()->iban())
        ->toEqual('iban')
    ;
});

it('can render invert iban validation', function () {
    expect(vr()->not()->iban())
        ->toEqual('invert_iban')
    ;
});
