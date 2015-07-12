DIECTORIES LISTED IN GITIGNORE

application/config
	- Since directory structures and database credentials differ on local and server, it is recommended to exclude this from tracked files.
	- Must contain config.php, which contains directory structures and database credentials. 
public/photos
	- Public photos (i.e., photos that are not used as assets ), should be excluded as they may be too large and are not necessary in development.
 	- Must contain a "_thumbnails" folder which holds the optimised image thumbnails upon upload. Failure to create this folder may result to an error when uploading.


