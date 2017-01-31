#!/bin/bash
set -x
if [ $TRAVIS_BRANCH == 'master' ] ; then
    ## Initialize a new git repo in _site, and push it to our server.
    cd _site
    git init

    git remote add deploy "depoloy@138.197.83.56:/var/www/dfwtr"
    git config user.name "Travis CI"
    git config user.email "bws46@cornell.edu"

    git add .
    git commit -m "Deploy"
    git push --force deploy master
else
    echo "Not deploying, since this branch isn't master."
fi