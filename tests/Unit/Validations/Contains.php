<?php

it('can render contains validation', function () {
    expect(vr()->contains('one', 'two'))
        ->toEqual('contains,one;two')
    ;
});

it('can render invert contains validation', function () {
    expect(vr()->not()->contains('one', 'two'))
        ->toEqual('invert_contains,one;two')
    ;
});
