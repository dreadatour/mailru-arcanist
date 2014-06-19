#!/bin/bash
set -e

INSTALL_SCRIPT="/tmp/installarcanist.sh"

curl -sL https://raw.githubusercontent.com/dreadatour/mailru-arcanist/master/installarcanist.sh -o $INSTALL_SCRIPT
/bin/bash $INSTALL_SCRIPT
rm $INSTALL_SCRIPT
