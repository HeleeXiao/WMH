<?php

namespace TomLingham\Searchy\Matchers;

/**
 * Matches strings that include all the characters in the search relatively position within the string.
 * It also calculates the percentage of characters in the string that are matched and applies the multiplier accordingly.
 *
 * For Example, a search for 'fba' would match; 'Foo Bar' or 'Afraid of bats'
 *
 * Class ConsecutiveCharactersMatcher
 */
class ConsecutiveCharactersMatcher extends BaseMatcher
{
    /**
     * @var string
     */
    protected $operator = 'LIKE';

    /**
     * @param $searchString
     *
     * @return string
     */
    public function formatSearchString($searchString)
    {
        $searchString = preg_replace('/[^0-9a-zA-Z]/', '', $searchString);

        return '%'.implode('%', str_split($searchString)).'%';
    }

    /**
     * @param $column
     * @param $rawString
     *
     * @return mixed|string
     */
    public function buildQueryString($column, $rawString)
    {
        $searchString = $this->formatSearchString($rawString);

        return "IF( REPLACE($column, '\.', '') {$this->operator} '$searchString', ROUND({$this->multiplier} * ( CHAR_LENGTH( '$rawString' ) / CHAR_LENGTH( REPLACE($column, ' ', '') ))), 0)";
    }
}
