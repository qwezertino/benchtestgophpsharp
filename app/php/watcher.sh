#!/bin/bash
# Get the PID of the Swoole server
# SWOOLE_PID=$!

# Watch for changes in the PHP files
while inotifywait -e modify,create,delete /app/*.php; do
    echo "Changes detected. Restarting OpenSwoole server..."
    echo "reload" | nc 127.0.0.1 8102
    # # Kill the previous Swoole server
    # kill -USR2 $SWOOLE_PID

    # # Start the Swoole server again
    # #php /app/index.php &

    # # Update the PID
    # SWOOLE_PID=$!
done