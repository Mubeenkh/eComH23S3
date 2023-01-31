<?php
// Entry point to the Application
// Includethe dependencies
require_once 'app/core/init.php';
// To include external files in PHP we can: include, include_once, require, and require_once
// require is for stuff you need
// include can be less fatal
// _once is to ensure thing only are included once


new app\core\App;