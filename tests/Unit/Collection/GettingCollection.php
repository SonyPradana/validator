<?php

use Validator\Collection;

it('can get item using get', function () {
    $collection = new Collection(['key' => 'item']);

    expect($collection)->get('key')->toEqual('item');
});

it('can get item using get (default) but not exist', function () {
    $collection = new Collection();

    expect($collection)->get('key', 'no item')->toEqual('no item');
});

it('can get item using get (no default set) but not exist', function () {
    $collection = new Collection();

    expect($collection)->get('key')->toBeNull();
});

it('can get item using __get', function () {
    $collection = new Collection(['key' => 'item']);

    expect($collection)->key->toEqual('item');
});

it('can get item using __get (no default set) but not exist', function () {
    $collection = new Collection();

    expect($collection)->item->toBeNull();
});
