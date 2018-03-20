<?php

/**
 * Copyright 2018 Google Inc.
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

# [START iot_list_devices]
use Google\Cloud\Iot\V1\DeviceManagerClient;

/**
 * List all devices in the registry.
 *
 * @param string $projectId Google Cloud project ID
 * @param string $location (Optional) Google Cloud region
 * @param string $registryId (Optional) Google Cloud region
 */
function list_devices(
    $registryId,
    $projectId = null,
    $location = 'us-central1'
) {
    print('Listing devices' . PHP_EOL);

    // Instantiate a client.
    $deviceManager = new DeviceManagerClient();
    $registryPath = $deviceManager->registryName($projectId, $location, $registryId);

    $response = $deviceManager->listDevices($registryPath);

    foreach ($response->getDevices() as $device) {
        printf('Device: %s : %s',
            $device->getNumId(),
            $device->getId());
    }
}
# [END iot_list_devices]