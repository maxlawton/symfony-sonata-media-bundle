Step 1: Install the bundle
==========================

A) Download the Bundle
----------------------

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

.. code-block:: bash

    $ composer require mediamonks/sonata-media-bundle ^2.0

This command requires you to have Composer installed globally, as explained
in the `installation chapter`_ of the Composer documentation.

.. _`installation chapter`: https://getcomposer.org/doc/00-intro.md

If you are using `Symfony Flex`_ a recipe will take care of the next steps automatically
and continue with the configuration in step 2.

.. _`Symfony Flex`: https://github.com/symfony/flex

B) Enable the Bundle
--------------------

Then, enable the bundle by adding the following line in the ``config/bundles.php``
file of your project:

.. code-block:: php

    // app/AppKernel.php
    class AppKernel extends Kernel
    {
        public function registerBundles()
        {
            $bundles = [
                // ...
                new MediaMonks\SonataMediaBundle\MediaMonksSonataMediaBundle(),
            ];

            // ...
        }
    }


C) Load routes
--------------

To make sure the images in the admin are resolved to the controller it is required to load the bundle routes by adding
the following lines to your app's routing.yml:

.. code-block:: yml

    // app/config/routing.yml
    _mediamonks_media_admin:
        resource: "@MediaMonksSonataMediaBundle/Resources/config/routing_admin.yml"

    _mediamonks_media:
        resource: "@MediaMonksSonataMediaBundle/Resources/config/routing.yml"

Important: Admin routes are protected by Sonata automatically but the public routes are only protected by a signature by
default. If you require additional verification you can either use a firewall or load your own routes or override
the MediaController to add your own security layer on top.

D) Create entity
----------------

Currently this bundle only works with Doctrine ORM. Create a file ``Media.php`` in ``src/Entity``
and add these lines to it:

.. code-block:: php

    namespace App\Entity;

    use Doctrine\ORM\Mapping as ORM;
    use MediaMonks\SonataMediaBundle\Entity\Media as BaseMedia;

    /**
     * @ORM\Entity(repositoryClass="MediaMonks\SonataMediaBundle\Repository\MediaRepository")
     * @ORM\Table
     */
    class Media extends BaseMedia
    {
    }

Feel free to add your own custom properties or extensions to it or to put this entity in a different bundle (just make
sure you update the namespace accordingly).

Important: If your entity has a different FQCN than the default ``App\Entity\Media`` you must use the option
 ``model_class`` in the bundle configuration to set the correct FQCN.

E) Update database schema
-------------------------

After creating the entity it's time to update the database schema, as it's assumed you are using Doctrine ORM you can
run the following command from the command line to run the update:

``php bin/console doctrine:schema:update --force``

Alternatively you could use Doctrine Migrations if that is a part of your workflow.
