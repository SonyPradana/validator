<?php

it('can rander sanitize_email', function () {
    expect(fr()->sanitize_email())
        ->toEqual('sanitize_email')
    ;
});

it('can filter sanitize_email', function () {
    $fr = new Validator\Validator(['field' => 'john(.doe)@exa//mple.com']);

    $fr->filter('field')->sanitize_email();

    expect($fr->filter_out())
        ->toEqual(['field' => 'john.doe@example.com'])
    ;
});
