:: Run easy-coding-standard (ecs) via this batch file inside your IDE e.g. PhpStorm (Windows only)
:: Install inside PhpStorm the  "Batch Script Support" plugin
cd..
cd..
cd..
cd..
cd..
cd..
:: src
start vendor\bin\ecs check vendor/markocupic/contao-schule-ettiswil-licenses-bundle/src --config vendor/markocupic/contao-schule-ettiswil-licenses-bundle/.ecs/config/default.php
:: tests
start vendor\bin\ecs check vendor/markocupic/contao-schule-ettiswil-licenses-bundle/tests --config vendor/markocupic/contao-schule-ettiswil-licenses-bundle/.ecs/config/default.php
:: legacy
start vendor\bin\ecs check vendor/markocupic/contao-schule-ettiswil-licenses-bundle/src/Resources/contao --config vendor/markocupic/contao-schule-ettiswil-licenses-bundle/.ecs/config/legacy.php
:: templates
start vendor\bin\ecs check vendor/markocupic/contao-schule-ettiswil-licenses-bundle/src/Resources/contao/templates --config vendor/markocupic/contao-schule-ettiswil-licenses-bundle/.ecs/config/template.php
::
cd vendor/markocupic/contao-schule-ettiswil-licenses-bundle/.ecs./batch/fix
