<?php

use Validator\Validator;

it('submitted from form (not method)', function () {
    unset($_SERVER);

    expect(Validator::make())->submitted()->toBeFalse();
});

it('submitted from form (method GET)', function () {
    $_SERVER['REQUEST_METHOD'] = 'GET';

    expect(Validator::make())->submitted()->toBeFalse();
});

it('submitted from form (method POST)', function () {
    $_SERVER['REQUEST_METHOD'] = 'POST';

    expect(Validator::make())->submitted()->toBeTrue();
});
