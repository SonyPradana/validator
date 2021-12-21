<?php

it('can render valid_array_size_lesser validation', function () {
    expect(vr()->valid_array_size_lesser(1))
        ->toEqual('valid_array_size_lesser,1')
    ;
});

it('can render invert valid_array_size_lesser validation', function () {
    expect(vr()->not()->valid_array_size_lesser(1))
        ->toEqual('invert_valid_array_size_lesser,1')
    ;
});
