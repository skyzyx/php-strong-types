<?php
use Symfony\CS\Config\Config;
use Symfony\CS\Finder\DefaultFinder;

return Config::create()
    ->fixers([
        // Enforce
        'align_double_arrow',
        'align_equals',
        'braces',
        'concat_with_spaces',
        'duplicate_semicolon',
        'elseif',
        'encoding',
        'eof_ending',
        'function_call_space',
        'function_declaration',
        'include',
        'indentation',
        'line_after_namespace',
        'linefeed',
        'lowercase_constants',
        'lowercase_keywords',
        'method_argument_space',
        'multiline_array_trailing_comma',
        'multiline_spaces_before_semicolon',
        'multiple_use',
        'namespace_no_leading_whitespace',
        'new_with_braces',
        'object_operator',
        'operators_spaces',
        'ordered_use',
        'parenthesis',
        'php_closing_tag',
        'phpdoc_params',
        'psr0',
        'remove_lines_between_uses',
        'short_array_syntax',
        'short_tag',
        'single_array_no_trailing_comma',
        'spaces_before_semicolon',
        'spaces_cast',
        'standardize_not_equal',
        'strict',
        'strict_param',
        'ternary_spaces',
        'trailing_spaces',
        'unused_use',
        'visibility',
        'whitespacy_lines',

        // Do not enforce
        '-concat_without_spaces',
        '-extra_empty_lines',
        '-return',
    ])
    ->setUsingCache(true)
    ->finder(DefaultFinder::create()
        ->exclude('vendor')
        ->in(__DIR__)
    )
;
