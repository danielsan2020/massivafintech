<?php
shell_exec('openssl pkcs8 -inform DER -in '.$nombreKey.' -out '.$nombreKey.'.pem -passin pass:'.$password.' 2>&1');