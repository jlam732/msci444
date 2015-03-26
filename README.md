# msci444
IT Ticketing System

1. If at home, follow steps here
  * https://uwaterloo.ca/information-systems-technology/services/virtual-private-network-vpn/about-virtual-private-network-vpn

Website
  * http://mansci-db.uwaterloo.ca/~jg2lam/
  * db: mansci-db.uwaterloo.ca/mysqladmin/index.php
To ssh into the box:
 * jg2lam@mansci-db.uwaterloo.ca 
 * password: Winter2015

To clone this repository:
  * git clone git@github.com:jlam732/msci444.git
  * follow a tutorial to get github working on computer

To work on stuff:
  1. in your own repo folder
  2. do some work
  3. `git status` (to see what things you did)
  4. `git diff` (to see what changes you made)
  5. make changes if you didn't expect what you saw (use `git checkout -- <filename>` to revert to old version)
  6. `git add <filename>` to stage file for committing
  7. `git commit -m '<msg>'` to commit to repo with message that we know what you're doing
  8. `git pull` to get all the latest changes
  9. if merge changes, fix them (google how) and then commit a merge (using `git commit`)
  10. `git push` when you're done (ONLY `git push` after you've pulled)
  11. Login to the box
  12. `git pull` in ~/public_html (use `pwd` to figure out where you are)
  13. Look at changes on website (may need to CTRL-F5 force refresh)
