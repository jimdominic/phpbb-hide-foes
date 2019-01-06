# phpbb-hide-foes
phpBB extension that hides posts made by users on your "Foes" list

Users will have an option under the Board Preferences > Edit Display Options tab to "Wish foe posts into the Cornfield"

Edit the language file "cornfield.php" to change that message to your liking.

When enabled, the extension checks the template variables for whether or not the post author is on the user's Foes list. If yes, then the extension sets a hidden DIV wrapper around the post content.

Installation: upload the files to the ext folder, under a subdirectory named "captain", e.g.

ext > captain > cornfieldfoeposts

This extension was orginally developed for private use--there are no ACP options or functionality beyond the simple methods described.
