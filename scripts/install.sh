#!/bin/bash
set -e

# Downloads arcanist, libphutil, etc and configures your system

LOC_DIR="/usr/local"
BIN_DIR="$LOC_DIR/bin"
PHP_DIR="$LOC_DIR/include/php"

if [ ! -e "$PHP_DIR" ]; then
    mkdir -p $PHP_DIR
fi;

# Install or update libphutil
echo "Updating libphutil.."
if [ -e "$PHP_DIR/libphutil" ]; then
    arc upgrade
else
    git clone git://github.com/facebook/libphutil.git "$PHP_DIR/libphutil"
    git clone git://github.com/facebook/arcanist.git "$PHP_DIR/arcanist"
fi

# Install or update marcanist
echo "Updating marcanist.."
if [ -e "$PHP_DIR/marcanist" ]; then
    cd "$PHP_DIR/marcanist" && git pull origin master
else
    git clone git://github.com/pzinovkin/marcanist.git "$PHP_DIR/marcanist"
fi

# Register arc commands
echo "Registering arc commands.."

## arc
echo "php $PHP_DIR/arcanist/scripts/arcanist.php  --load-phutil-library='$PHP_DIR/marcanist/src' \"\$@\"" > "$BIN_DIR/arc"
chmod +x "$BIN_DIR/arc"

echo "Done!"
