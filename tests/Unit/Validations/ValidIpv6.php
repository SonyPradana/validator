<?php

it('can render valid_ipv6 validation', function () {
    expect(vr()->valid_ipv6())
        ->toEqual('valid_ipv6')
    ;
});

it('can render invert valid_ipv6 validation', function () {
    expect(vr()->not()->valid_ipv6())
        ->toEqual('invert_valid_ipv6')
    ;
});
