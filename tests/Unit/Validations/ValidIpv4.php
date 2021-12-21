<?php

it('can render valid_ipv4 validation', function () {
    expect(vr()->valid_ipv4())
        ->toEqual('valid_ipv4')
    ;
});

it('can render invert valid_ipv4 validation', function () {
    expect(vr()->not()->valid_ipv4())
        ->toEqual('invert_valid_ipv4')
    ;
});
