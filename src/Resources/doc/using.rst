Using guide
===========

Installation
------------

First install bundle and add routes + js file block (`installation <https://github.com/pehapkari-alpha/inline-editable-bundle/blob/master/Resources/doc/installation.rst>`_).


How it works?
-------------

- Template extension is looking for content in php class array -> cache -> database.

- From database and cache script loads full namespace with specific locale. Locale is automatically loaded from request (or you can define it).


Examples
--------

Warning!!! There's no XSS protection. Admin can add XSS and so on...

.. code-block:: twig

    {# basic usage - generate div tag #}
    {{ inline_editrable('name') }}

    {# with html attributes #}
    {{ inline_editrable('name', {attr: {class: 'super-text'}}) }}

    {# generate specifig tag #}
    {{ inline_editrable_h1('name-H1') }}
    {{ inline_editrable_span('name-span') }}
    {{ inline_editrable_strong('name-strong') }}

    {# override locale #}
    {{ inline_editrable('custom-locale', {locale: 'de'}) }}

    {# override namespace #}
    {{ inline_editrable('custom-namespace', {namespace: 'superNamespace'}) }}

    {# using namespace #}
    {% inline_namespace testNamespace %}
        {{ inline_editrable('using-global-namespace') }}
    {% end_inline_namespace %}

    {# using namespace - don't forget add this line to end of body!!!  #}
    {{ inline_editable_source() }}
..
