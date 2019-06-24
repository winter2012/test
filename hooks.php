<?php
print_r(shell_exec("cd $_GET[project] && git pull"));