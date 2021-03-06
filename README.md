ComponentManagerPhpWebapp
=========================

ComponentManagerPhpWebapp contains the code and data used by the phix commands for creating and maintaining php-webapp components.

To learn more about PHP components, Google for 'Beyond Frameworks'.

Installation
------------

ComponentManagerPhpWebapp is normally installed as a dependency; i.e. it gets installed because something else lists it in a package.xml file.

If you want to install it yourself, you can do so using the [PEAR Installer](http://pear.php.net). This installer is the community's de-facto standard for distributing PHP components.

    sudo pear channel-discover pear.phix-project.org
    sudo pear install --alldeps phix/ComponentManagerPhpWebapp

After installation, you will find the code inside your local PEAR repository, which on Linux systems is normally /usr/share/php.

Documentation
-------------

This component adds the 'php-webapp:' set of commands to phix.

To see all of the commands available, do:

    # phix built-in help
    phix

To get help on the individual php-webapp commands, do:

    # php-webapp built-in help
    phix help php-webapp:init
    phix help php-webapp:status
    phix help php-webapp:version

Development Environment
-----------------------

If you want to patch or enhance this component, you will need to create a suitable development environment:

    # phpunit
    sudo pear channel-discover pear.phpunit.de
    sudo pear channel-discover components.ez.no
    sudo pear channel-discover pear.symfony-project.com
    sudo pear install --alldeps phpunit/PHPUnit

    # phing
    sudo pear channel-discover pear.phing.info
    sudo pear install --alldeps phing/phing

    # pdepend
    sudo pear channel-discover pear.pdepend.org
    sudo pear install --alldeps pdepend/PHP_Depend-beta

    # phpdoc
    sudo pear install --alldeps pear/PhpDocumentor

    # phpmd
    sudo apt-get install php5-imagick
    sudo pear channel-discover pear.phpmd.org
    sudo pear install --alldeps phpmd/PHP_PMD-alpha

    # phpcpd
    sudo pear install --alldeps phpunit/phpcpd

    # phpcs
    sudo pear install --alldeps pear/PHP_CodeSniffer-beta

    # phpcb
    sudo pear install --alldeps phpunit/PHP_CodeBrowser

You can then clone the git repository:

    # ComponentManagerPhpWebapp
    git clone git://github.com/stuartherbert/ComponentManagerPhpWebapp.git

You will then need to populate the vendor folder, to build a local copy of all of the dependencies for 

    # vendor folder
    cd ComponentManagerPhpWebapp
    phing build-vendor

To test your changes, you would do the following:

    # test changes
    phing test
    
    # install changes into vendor folder, for local use
    phing pear-package
    phing install-local
    vendor/bin/phix <command>
