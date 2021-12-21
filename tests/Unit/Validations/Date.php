<?php

it('can render date validation', function () {
    expect(vr()->date('31/12/1999'))
        ->toEqual('date,31/12/1999')
    ;
});

it('can render invert date validation', function () {
    expect(vr()->not()->date('31/12/1999'))
        ->toEqual('invert_date,31/12/1999')
    ;
});
