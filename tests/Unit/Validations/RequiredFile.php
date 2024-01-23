<?php

it('can render required_file validation')
    ->expect(vr()->required_file())
    ->toEqual('required_file')
;

it('can render invert required_file validation')
    ->expect(vr()->not()->required_file())
    ->toEqual('invert_required_file')
;

$correct = [
    'files' => [
        'test' => [
            'name'     => 'screenshot.png',
            'type'     => 'image/png',
            'tmp_name' => '/tmp/phphjatI9',
            'error'    => 0,
            'size'     => 22068,
        ],
    ],
];
$incorrect = [
    'files' => [],
];

function validTest(array $input, bool $use_not = false): bool
{
    $val = new Validator\Validator($input);

    if ($use_not === false) {
        $val->field('files.test')->required_file();

        return $val->is_valid();
    }

    // use not
    $val->field('files.test')->not()->required();

    return $val->is_valid();
}

// validate with correct input field
it('can validate required_file with correct input', function () use ($correct) {
    expect(validTest($correct))->toBeTrue();
});

it('can validate required_file (not) with correct input', function () use ($correct) {
    expect(validTest($correct, true))->toBeFalse();
});

// validate with incorrect input field
it('can validate required_file with incorrect input', function () use ($incorrect) {
    expect(validTest($incorrect))->toBeFalse();
});

it('can validate required_file (not) with incorrect input', function () use ($incorrect) {
    expect(validTest($incorrect, true))->toBeTrue();
});
