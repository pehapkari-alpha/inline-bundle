<?php

/*
 * This file is part of the some package.
 * (c) Jakub Janata <jakubjanata@gmail.com>
 * For the full copyright and license information, please view the LICENSE file.
 */

declare(strict_types = 1);

namespace Pehapkari\InlineEditableBundle\Controller;

use Pehapkari\InlineEditable\Model\ContentProvider;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author Jakub Janata <jakubjanata@gmail.com>
 */
class InlineEditableController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     */
    public function updateAction(Request $request)
    {
        $data = json_decode($request->getContent()) ?: [];

        /** @var ContentProvider $contentProvider */
        $contentProvider = $this->get('pehapkari_inline.model.content_provider');

        foreach ($data as $item) {
            $contentProvider->saveContent(
                $item->namespace ?? '',
                $item->locale ?? $request->getLocale(),
                $item->name ?? '',
                $item->content ?? ''
            );
        }

        return new Response();
    }
}
