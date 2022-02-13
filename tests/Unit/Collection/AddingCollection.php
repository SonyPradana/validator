<?php

use Validator\Collection;

it('can add array using __construct', function () {
    $collection = new Collection(['key' => 'value']);

    expect($collection)->key->toEqual('value');
});

it('can add array using make', function () {
    expect(Collection::make(['key' => 'value']))->key->toEqual('value');
});

it('can add array using replace', function () {
    $collection = new Collection();

    expect($collection)
        ->replace(['key' => 'value'])
        ->key->toEqual('value');
});

it('can add array using set', function () {
    $collection = new Collection();

    expect($collection)
        ->set('key', 'value')
        ->key->toEqual('value');
});

it('can edit exist array using set', function () {
    $collection = new Collection(['key' => 'value']);

    expect($collection)
        ->set('key', 'new value')
        ->key->toEqual('new value');
});

it('can add array using __set', function () {
    $collection = new Collection();

    $collection->key = 'value';

    expect($collection)
        ->key->toEqual('value');
});

it('can edit exist array using __set', function () {
    $collection = new Collection(['key' => 'value']);

    $collection->key = 'new value';

    expect($collection)
        ->key->toEqual('new value');
});
