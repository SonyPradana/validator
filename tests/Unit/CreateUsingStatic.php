<?php

use Validator\Validator;

it('can create static', function () {
    expect(Validator::make())->toBeInstanceOf(Validator::class);
});
