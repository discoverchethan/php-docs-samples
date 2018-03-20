<?php

/**
 * Copyright 2016 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
namespace Google\Cloud\Samples\Iot;

require __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

$application = new Application('Cloud IOT');

$application->add(new Command('list_devices'))
    ->addArgument('registry', InputArgument::REQUIRED, 'the registry ID')
    ->addOption('project', '', InputOption::VALUE_REQUIRED, 'The Google Cloud project ID')
    ->addOption('location', '', InputOption::VALUE_REQUIRED, 'The location of your device registry', 'us-central1')
    ->setDescription('List all devices in the registry.')
    ->setCode(function ($input, $output) {
        list_devices(
            $input->getArgument('registry'),
            $input->getOption('project'),
            $input->getOption('location')
        );
    });

$application->add(new Command('list_registries'))
    ->addOption('project', '', InputOption::VALUE_REQUIRED, 'The Google Cloud project ID', getenv('GCLOUD_PROJECT'))
    ->addOption('location', '', InputOption::VALUE_REQUIRED, 'The location of your device registries', 'us-central1')
    ->setDescription('List all registries in the project.')
    ->setCode(function ($input, $output) {
        list_registries(
            $input->getOption('project'),
            $input->getOption('location')
        );
    });

// for testing
if (getenv('PHPUNIT_TESTS') === '1') {
    return $application;
}

$application->run();
