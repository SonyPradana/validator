<?php

it('can render valid_ip validation', function () {
    expect(vr()->valid_ip())
        ->toEqual('valid_ip')
    ;
});

it('can render invert valid_ip validation', function () {
    expect(vr()->not()->valid_ip())
        ->toEqual('invert_valid_ip')
    ;
});
