<?php

/*
 * This file is part of the some package.
 * (c) Jakub Janata <jakubjanata@gmail.com>
 * For the full copyright and license information, please view the LICENSE file.
 */

declare(strict_types = 1);

namespace Pehapkari\InlineEditableBundle\Twig;

use Twig_Node;
use Twig_Compiler;

/**
 * @author Jakub Janata <jakubjanata@gmail.com>
 */
class InlineEditableNamespaceNode extends Twig_Node
{
    /**
     * @param Twig_Compiler $compiler
     */
    public function compile(Twig_Compiler $compiler): void
    {
        $namespace = $this->getAttribute('namespace');

        $compiler
            ->write("\$context['_inline_namespace'] = '$namespace';")
            ->subcompile($this->getNode('body'))
            ->write("unset(\$context['_inline_namespace']);");
    }
}
