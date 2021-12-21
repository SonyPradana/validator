<?php

it('can render regex validation', function () {
    expect(vr()->regex('/test-[0-9]{3}/'))
        ->toEqual('regex,/test-[0-9]{3}/')
    ;
});

it('can render invert regex validation', function () {
    expect(vr()->not()->regex('/test-[0-9]{3}/'))
        ->toEqual('invert_regex,/test-[0-9]{3}/')
    ;
});
