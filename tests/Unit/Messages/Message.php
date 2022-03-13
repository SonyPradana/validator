<?php

use Validator\Messages\Message;

it('can add message (__get)', function () {
    $message           = new Message();
    $message->required = 'test';

    expect($message->messages())->toMatchArray([
        'required' => 'test',
    ]);
});

it('can add message (array set)', function () {
    $message             = new Message();
    $message['required'] = 'test';

    expect($message->messages())->toMatchArray([
        'required' => 'test',
    ]);
});

it('can list message (Message())', function () {
    $message            = new Message();
    $message->required  = 'test';
    $message->alpha     = 'test';

    expect($message->messages())->toMatchArray([
        'required' => 'test',
        'alpha'    => 'test',
    ]);
});

it('can get message (array)', function () {
    $message                = new Message();
    $message['required']    = 'test';

    expect($message['required'])->toEqual('test');
});
