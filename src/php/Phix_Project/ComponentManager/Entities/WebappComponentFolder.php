<?php

/**
 * Copyright (c) 2011 Stuart Herbert.
 * Copyright (c) 2010 Gradwell dot com Ltd.
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 *   * Redistributions of source code must retain the above copyright
 *     notice, this list of conditions and the following disclaimer.
 *
 *   * Redistributions in binary form must reproduce the above copyright
 *     notice, this list of conditions and the following disclaimer in
 *     the documentation and/or other materials provided with the
 *     distribution.
 *
 *   * Neither the names of the copyright holders nor the names of the
 *     contributors may be used to endorse or promote products derived
 *     from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
 * FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 * COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
 * ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @package     Phix_Project
 * @subpackage  ComponentManager
 * @author      Stuart Herbert <stuart@stuartherbert.com>
 * @copyright   2011 Stuart Herbert. www.stuartherbert.com
 * @copyright   2010 Gradwell dot com Ltd. www.gradwell.com
 * @license     http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @link        http://www.phix-project.org
 * @version     @@PACKAGE_VERSION@@
 */

namespace Phix_Project\ComponentManager\Entities;

class WebappComponentFolder extends ComponentFolder
{
        const COMPONENT_TYPE = 'php-webapp';
        const LATEST_VERSION = 1;
        const DATA_FOLDER = '@@DATA_DIR@@/ComponentManagerPhpWebapp/php-webapp';

        public function createComponent()
        {
                // step 1: create the folders required
                $this->createFolders();

                // step 2: create the build file
                $this->createBuildFile();
                $this->createBuildProperties();

                // step 3: create the package.xml file
                $this->createPackageXmlFile();

                // step 4: add in the doc files
                $this->createDocFiles();

                // step 5: add in config files for popular source
                // control systems
                $this->createScmIgnoreFiles();

                // step 6: don't forget the bootstrap file for
                // the unit tests
                $this->createBootstrapFile();

                // if we get here, job done
        }

        protected function createFolders()
        {
                $foldersToMake = array
                (
                        'src',
                        'src/php',
                        'src/bin',
                        'src/data',
                        'src/web',
                        'src/tests',
                        'src/tests/unit-tests',
                        'src/tests/unit-tests/bin',
                        'src/tests/unit-tests/php',
                        'src/tests/unit-tests/web',
                        'src/tests/integration-tests',
                        'src/tests/functional-tests',
                );

                foreach ($foldersToMake as $folderToMake)
                {
                        $folder = $this->folder . '/' . $folderToMake;

                        // does the folder already exist?
                        if (is_dir($folder))
                        {
                                // yes it does ... nothing needed
                                continue;
                        }

                        // no it does not ... create it
                        if (!mkdir ($folder))
                        {
                                // it all went wrong
                                throw new \Exception('unable to create folder ' . $this->folder . '/' . $folderToMake);
                        }
                }
        }

        protected function createBuildFile()
        {
                $this->copyFilesFromDataFolder(array('build.xml'));
        }

        protected function createBuildProperties()
        {
                $this->copyFilesFromDataFolder(array('build.properties'));
        }

        protected function createPackageXmlFile()
        {
                $this->copyFilesFromDataFolder(array('package.xml'));
        }

        protected function createDocFiles()
        {
                $this->copyFilesFromDataFolder(array('README.md', 'LICENSE.txt'));
        }

        protected function createScmIgnoreFiles()
        {
                $this->copyFilesFromDataFolder(array('.gitignore', '.hgignore'));
        }

        protected function createBootstrapFile()
        {
                $this->copyFilesFromDataFolder(array('bootstrap.php'), '/src/tests/unit-tests/');
        }
}
