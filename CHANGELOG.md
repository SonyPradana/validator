# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/)
and this project adheres to [Semantic Versioning](http://semver.org/).

## [Unreleased]
### Added
- Add costume validation `valid->valid($closure, $message)` and costume filter `filter->filter($closure)`

## [0.6.2] - 2022-03-13
### Fixed
- Fixed adding new exist rule not overwrite exist rule.

### Added
- Added method `Valid->combine($valid)` and `Filter->combine($filter)` to add combine with other rule.

## [0.6.1] - 2022-03-01
### Fixed
- fixed not exist field method `only` always return true.

## [0.6.0] - 2022-03-01
### Added
- Added method to check form submitted `validator->submitted()`.
- Added method to check validaton and form submitted `validator->passed()`.
- Added method to check validaton and form submitted `validator->fails()`.
- Adding validation from method `Validator::make($field, $closure)` using param `$closure` as `validpool` closuser.
- Added method to filter field rule base on field which need to use. `validator->only()` use specified field, `validator->except()` inverse of only.

## [0.5.1] - 2022-02-18
### Added
- Add method to add error message using `__set`.

### Fixed
- Fix deprecated warning php 8.0.

## [0.5.0] - 2022-02-15
### Added
- Add filter (rule) condition `where()`, only execute rule filter if condition as true (left side filter).
- Add filter (rule) condition `if()`, only execute rule filter if condition as true (right side filter).
- Add new filter `filter_`, does't perform anything. This filter also prevent from error when filter rule is empty.
- Add static to create new instance `Validator::make()`.
- Adding validation rule using callback `Validator->validation($callback)`.
- Adding filter rule using callback `Validator->filters($callback)`.
- Adding new class (`Validator\Collection::class`) to convert array to smart object.
- Adding property to get errors  `Validator->erros` and filter out `Validation->filters`, it will return as `Validator\Collection::class`.
- Adding method to costume field error message `Validator::Message()`.

### Changed
- Change function name from Valid::equals_field() to `Valid::equalsfield()`

## [0.4.0] - 2022-01-15
### Added
- Add property `not` same result with method `not()`.
- Add validation (rule) condition `where()`, only execute rule validation if condition as true (left side validation).
- Add validation (rule) condition `if()`, only execute rule validation if condition as true (right side validation).
- Add new validation `validate_`, check field is contain in input field. This validation also prevent from error when validation rule is empty.

### Fixed
- Fix method `validOrException()` can't throw Exception.
- Prevent error when validation rule is empty, by adding new validation `validate_()`.

## [0.3.0] - 2022-01-09
### Added
- Add costume validation error messaage `Rule::set_error_message` and `Rule::set_error_messages`.
- Add method `is_error()` check validataion have error.
- Support add multy rule field in single method. `$validation->field('field1', 'field2')` and `$validation->filter('field1', 'field2')`. Also work in `validPool::class` and `filterPool::class`

### Fixed
- Costume validator does not have an error message. When using method `not()` on validation.

## [0.2.2] - 2022-01-08
### Added
- Add method `lang()` to change language error message.

### Fixed
- `filter_out()` return merge with fields.

## [0.2.1] - 2022-01-02
### Added
- Add `filter_out(?Closure $rule_filter = null)` param to set filter rule using param.
- Add unit test for every method in `validator::class`.

### Fixed
- Fix `get_error()` does't result anything because validate not run yet.

### Changed
- Change `is_valid` using `Rule->validate()` over `Rule->is_valid()`, because not perform anything for get error.

## [0.2.0] - 2021-12-30
### Added
- Add filter input
- Add filter rule method `noise_words()`, `rmpunctuation()`, `urlencode()`, `sanitize_email()`, `sanitize_numbers()`, `sanitize_floats()`, `sanitize_string()`, `boolean()`, `basic_tags()`, `whole_number()`, `ms_word_characters()`, `lower_case()`, `upper_case()`, `slug()`, `trim()`, 
