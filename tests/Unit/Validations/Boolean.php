<?php

it('can render boolean validation', function () {
    expect(vr()->boolean())
        ->toEqual('boolean,strict')
    ;
});

it('can render invert boolean validation', function () {
    expect(vr()->not()->boolean())
        ->toEqual('invert_boolean,strict')
    ;
});
