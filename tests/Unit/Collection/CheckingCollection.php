<?php

use Validator\Collection;

it('can check item with exist item', function () {
    expect(Collection::make(['key' => 'item']))
        ->has('key')->toBeTrue();
});

it('can check item with not exist item', function () {
    expect(Collection::make())
        ->has('key')->toBeFalse();
});
