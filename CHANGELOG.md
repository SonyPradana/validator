# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/)
and this project adheres to [Semantic Versioning](http://semver.org/).

## [Unreleased]

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
