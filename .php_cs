<?php

declare(strict_types=1);

/*
 * Immobilienscout24 bundle for Contao Open Source CMS
 *
 * @copyright  Copyright © derhaeuptling (https://derhaeuptling.com/)
 * @author     Moritz Vondano
 * @license    MIT
 */

$header = <<<'EOF'
Immobilienscout24 bundle for Contao Open Source CMS

@copyright  Copyright © derhaeuptling (https://derhaeuptling.com/)
@author     Moritz Vondano
@license    MIT
EOF;

$finder = PhpCsFixer\Finder::create()
    ->notPath('languages')
    ->in([__DIR__.'/src'])
;

return PhpCsFixer\Config::create()
    ->setRules([
        '@Symfony' => true,
        '@Symfony:risky' => true,
        '@PHP71Migration' => true,
        '@PHP71Migration:risky' => true,
        '@PHPUnit75Migration:risky' => true,
        'align_multiline_comment' => true,
        'array_indentation' => true,
        'array_syntax' => ['syntax' => 'short'],
        'combine_consecutive_issets' => true,
        'combine_consecutive_unsets' => true,
        'comment_to_phpdoc' => true,
        'compact_nullable_typehint' => true,
        'escape_implicit_backslashes' => true,
        'fully_qualified_strict_types' => true,
        'general_phpdoc_annotation_remove' => [
            'author',
            'expectedException',
            'expectedExceptionMessage',
        ],
        'header_comment' => ['header' => $header],
        'heredoc_to_nowdoc' => true,
        'linebreak_after_opening_tag' => true,
        'list_syntax' => ['syntax' => 'short'],
        'logical_operators' => true,
        'multiline_comment_opening_closing' => true,
        'multiline_whitespace_before_semicolons' => [
            'strategy' => 'new_line_for_chained_calls',
        ],
        'native_function_invocation' => [
            'include' => ['@compiler_optimized'],
            'strict' => true,
        ],
        'no_alternative_syntax' => true,
        'no_binary_string' => true,
        'no_break_comment' => true,
        'no_null_property_initialization' => true,
        'no_superfluous_elseif' => true,
        'no_superfluous_phpdoc_tags' => true,
        'no_unreachable_default_argument_value' => true,
        'no_useless_else' => true,
        'no_useless_return' => true,
        'ordered_class_elements' => true,
        'ordered_imports' => true,
        'php_unit_method_casing' => true,
        'php_unit_set_up_tear_down_visibility' => true,
        'php_unit_strict' => true,
        'php_unit_test_case_static_method_calls' => [
            'call_type' => 'this',
        ],
        'phpdoc_add_missing_param_annotation' => true,
        'phpdoc_order' => true,
        'phpdoc_trim_consecutive_blank_line_separation' => true,
        'phpdoc_types_order' => [
            'null_adjustment' => 'always_last',
            'sort_algorithm' => 'none',
        ],
        'phpdoc_var_annotation_correct_order' => true,
        'return_assignment' => false,
        'static_lambda' => true,
        'strict_comparison' => true,
        'strict_param' => true,
        'string_line_ending' => true,
        'void_return' => true,
    ])
    ->setFinder($finder)
    ->setRiskyAllowed(true)
;
