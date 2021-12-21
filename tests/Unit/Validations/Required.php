<?php

it('can render required validation', function () {
    expect(vr()->required())
        ->toEqual('required')
    ;
});

it('can render invert required validation', function () {
    expect(vr()->not()->required())
        ->toEqual('invert_required')
    ;
});
