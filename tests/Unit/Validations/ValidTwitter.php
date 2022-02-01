<?php

it('can render valid_twitter validation')
    ->expect(vr()->valid_twitter())
    ->toEqual('valid_twitter')
;

it('can render invert valid_twitter validation')
    ->expect(vr()->not->valid_twitter())
    ->toEqual('invert_valid_twitter')
;

// FIXME: api endpoint twitter doest exis enymore
