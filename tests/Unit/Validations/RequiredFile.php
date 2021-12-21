<?php

it('can render required_file validation', function () {
    expect(vr()->required_file())
        ->toEqual('required_file')
    ;
});

it('can render invert required_file validation', function () {
    expect(vr()->not()->required_file())
        ->toEqual('invert_required_file')
    ;
});
