Installation
============


Step 1: Download the Bundle
---------------------------

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

.. code-block:: bash

    $ composer require pehapkari-alpha/inline-editrouble-bundle
..


Step 2: Enable the Bundle
-------------------------

Then, enable the bundle by adding it to the list of registered bundles
in the ``app/AppKernel.php`` file of your project:

.. code-block:: php

    <?php
    // app/AppKernel.php

    // ...
    class AppKernel extends Kernel
    {
        public function registerBundles()
        {
            $bundles = array(
                // ...

                new Pehapkari\InlineEditableBundle\PehapkariInlineEditableBundle(),
            );

            // ...
        }

        // ...
    }

..


Step 3: Set routes
------------------

.. code-block:: yaml

    # app/config/routing.yml

    inline_editable:
        resource: "@PehapkariInlineEditableBundle/Resources/config/routing.xml"

..


Step 4: Add js source file to twig base template
------------------------------------------------

.. code-block:: twig

    <body>
        ...
        {{ inline_editable_source() }}
    </body>
..


Step 5: Create table
--------------------

.. code-block:: sql

    -- mysql
    CREATE TABLE `inline_content` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `namespace` varchar(255) NOT NULL,
      `locale` varchar(2) NOT NULL,
      `name` varchar(255) NOT NULL,
      `content` text NOT NULL,
      PRIMARY KEY (`id`),
      UNIQUE KEY `unique` (`namespace`,`locale`,`name`),
      KEY `index` (`namespace`,`locale`,`name`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    -- postgresql
    CREATE TABLE inline_content (
        id integer NOT NULL,
        namespace character varying NOT NULL,
        locale character(2) NOT NULL,
        name character varying NOT NULL,
        content text NOT NULL
    );

    CREATE SEQUENCE inline_content_id_seq
        START WITH 1
        INCREMENT BY 1
        NO MINVALUE
        NO MAXVALUE
        CACHE 1;

    ALTER TABLE ONLY inline_content ALTER COLUMN id SET DEFAULT nextval('inline_content_id_seq'::regclass);
    SELECT pg_catalog.setval('inline_content_id_seq', 1, false);
    ALTER TABLE ONLY inline_content ADD CONSTRAINT inline_content_id PRIMARY KEY (id);
    ALTER TABLE ONLY inline_content ADD CONSTRAINT inline_content_unique UNIQUE (namespace, locale, name);
    CREATE INDEX inline_content_index ON inline_content USING btree (namespace, locale, name);
..


Step 6: Create symlink for assets
---------------------------------

If you don't have added script *Sensio\Bundle\DistributionBundle\Composer\ScriptHandler::installAssets* in your composer, please link assets:

.. code-block:: bash

    $ cd web/bundles
    $ ln -s  ../../vendor/pehapkari-alpha/inline-editable-bundle/src/Resources/public/ pehapkariinlineeditable
..


Step 7: Add inline enabler (optionally)
---------------------------------------

Add subscriber for allow editing. Fox example:

.. code-block:: php

    class InlineEnablerSubscriber extends AbstractInlineEnablerSubscriber
    {
        /**
         * @var AuthorizationCheckerInterface
         */
        private $authorizationChecker;

        /**
         * @param AuthorizationCheckerInterface $authorizationChecker
         */
        public function __construct(AuthorizationCheckerInterface $authorizationChecker)
        {
            $this->authorizationChecker = $authorizationChecker;
        }

        /**
         * @return bool
         */
        protected function isAllowedForEditation(): bool
        {
            return $this->authorizationChecker->isGranted('ROLE_ADMIN');
        }
    }
..


Step 8: Full configuration (optional)
-------------------------------------

.. code-block:: yaml

    # app/config/config.yml

    pehapkari_inline_editable:
        fallback: 'en' #default false
        table_name: 'super_table' #default inline_content
        url_path: '/ok-go' #default /inline
..


Step 9: How to use it?
----------------------

`Using guide <https://github.com/pehapkari-alpha/inline-editable-bundle/blob/master/src/Resources/doc/using.rst>`_
