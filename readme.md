php bin/console messenger:consume async -vv



php bin/console messenger:failed:show


php bin/console messenger:failed:show 20 -vv


php bin/console messenger:failed:retry -vv


php bin/console messenger:failed:retry 20 30 --force


php bin/console messenger:failed:remove 20


php bin/console messenger:failed:remove 20 30 --show-messages
