chmod 600 /tmp/journalism_rsa
eval "$(ssh-agent -s)" # Start the ssh agent
ssh-add /tmp/journalism_rsa
git remote add journalism git@git.wpengine.com:staging/csisjournalism.git # add remote for staging site
git fetch --unshallow # fetch all repo history or wpengine complain
git status # check git status
git checkout master # switch to master branch
git add wp-content/themes/modern-journalist/*.css -f # force all compiled CSS files to be added
git commit -m "compiled assets" # commit the compiled CSS files
git push -f journalism master:master #deploy to staging site from master to master