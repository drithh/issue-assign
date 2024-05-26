# Setup Project

1. Clone the repository
2. Install the dependencies
3. Run the project
4. Copy `.env.example` to `.env`
5. Open the browser and go to http://localhost:8000

### Uses [Filament](https://filamentphp.com/docs/3.x/panels/installation)

-   Modify the APP_URL variable in `.env` file to instantly update the title displayed on website.
-   Uploaded files are stored in `storage/app/public` by default. Adjust this path to your desired location by editing the `config/filesystems.php` file.
-   To change which disks use by file upload, manually modify the input settings in itself [IssueResolutionResource.php at Line 51](./app/Filament/App/Resources/IssueResolutionResource.php#L51)
-   Dont forget to run `php artisan storage:link` to create a symbolic link to the `public/storage` directory.
-   More about file upload go to [Filament Docs](https://filamentphp.com/docs/3.x/forms/fields/file-upload)

## Demo

-   You can access the demo at [https://issue-assign-gztuymsfwq-as.a.run.app](https://issue-assign-gztuymsfwq-as.a.run.app)
-   But you can't upload files because i dockerize the app and the file storage is not persistent unless use a volume or s3.

-   Admin: email: admin@admin.com - pass: coba1234
-   User: email: user@user.com - pass: coba1234 (see DatabaseSeeder.php for more users)
