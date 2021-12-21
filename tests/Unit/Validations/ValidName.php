<?php

it('can render valid_name validation', function () {
    expect(vr()->valid_name())
        ->toEqual('valid_name')
    ;
});

it('can render invert valid_name validation', function () {
    expect(vr()->not()->valid_name())
        ->toEqual('invert_valid_name')
    ;
});
