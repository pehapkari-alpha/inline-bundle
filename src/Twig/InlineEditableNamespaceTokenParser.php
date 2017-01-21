<?php

/*
 * This file is part of the some package.
 * (c) Jakub Janata <jakubjanata@gmail.com>
 * For the full copyright and license information, please view the LICENSE file.
 */

declare(strict_types = 1);

namespace Pehapkari\InlineEditableBundle\Twig;

use Twig_Token;

/**
 * @author Jakub Janata <jakubjanata@gmail.com>
 */
class InlineEditableNamespaceTokenParser extends \Twig_TokenParser
{
    /**
     * @param Twig_Token $token
     * @return InlineEditableNamespaceNode
     */
    public function parse(Twig_Token $token): InlineEditableNamespaceNode
    {
        $stream = $this->parser->getStream();

        $namespace = $stream->expect(Twig_Token::NAME_TYPE)->getValue();

        $stream->expect(Twig_Token::BLOCK_END_TYPE);

        $body = $this->parser->subparse([$this, 'decideWithEnd'], true);

        $stream->expect(Twig_Token::BLOCK_END_TYPE);

        return new InlineEditableNamespaceNode(
            ['body' => $body],
            ['namespace' => $namespace],
            $token->getLine(),
            $this->getTag()
        );
    }

    /**
     * @param Twig_Token $token
     * @return bool
     */
    public function decideWithEnd(Twig_Token $token): bool
    {
        return $token->test('end_inline_namespace');
    }

    /**
     * @return string
     */
    public function getTag(): string
    {
        return 'inline_namespace';
    }
}
