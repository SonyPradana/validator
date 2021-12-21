<?php

it('can render valid_json_string validation', function () {
    expect(vr()->valid_json_string())
        ->toEqual('valid_json_string')
    ;
});

it('can render invert valid_json_string validation', function () {
    expect(vr()->not()->valid_json_string())
        ->toEqual('invert_valid_json_string')
    ;
});
