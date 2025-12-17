#!/bin/bash

# Unix/Linux/Mac Bash Script to Run Package Configuration
# This is a convenience wrapper for configure.php

echo ""
echo "========================================"
echo "   Package Configuration Script"
echo "========================================"
echo ""

php configure.php

if [ $? -ne 0 ]; then
    echo ""
    echo "ERROR: Configuration failed!"
    echo "Make sure PHP is installed and in your PATH."
    exit 1
fi

echo ""
echo "Configuration completed successfully!"

