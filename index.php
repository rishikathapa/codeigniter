<?php

// Check PHP version.
if (version_compare(PHP_VERSION, '8.1', '<')) {
    exit('Your PHP version must be 8.1 or higher to run CodeIgniter. Current version: ' . PHP_VERSION);
}

// Path to the front controller (this file)
define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);

// Ensure the current directory is pointing to the project root
chdir(__DIR__);

/*
 *---------------------------------------------------------------
 * BOOTSTRAP THE APPLICATION
 *---------------------------------------------------------------
 * This process sets up the path configuration, loads the Vendor
 * class-loader, and kicks off the CodeIgniter setup.
 */

$pathsConfig = 'app/Config/Paths.php';
require realpath($pathsConfig) ?: $pathsConfig;

$paths = new Config\Paths();

// Location of the framework bootstrap file.
require $paths->systemDirectory . '/Boot.php';

// Launch the application!
CodeIgniter\Boot::bootWeb($paths);
