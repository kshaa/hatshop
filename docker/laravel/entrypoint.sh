#!/usr/bin/env bash

scriptdir="$( cd "$( dirname "${BASH_SOURCE[0]}" )" >/dev/null 2>&1 && pwd )"
rundir="$( pwd )"

action_command="$1"
action_file="$scriptdir/${action_command}.sh"

# Set Workdir
echo "Running at $rundir"
cd $rundir

# Run appropriate command
if [ "${action_command}" == "artisan" ]
then
    # Ignore the first given parameter for this script (the bash script name)
    shift

    # Run artisan w/ given commands
    bash -c "php artisan $*"
elif [ -f "${action_file}" ]
then
    # Ignore the first given parameter for this script (the bash script name)
    shift

    # Run the bash script and pass all extra parameters 
    bash -c "${action_file} \"$*\""
else
    # Run something else
    bash -c "$*"
fi

