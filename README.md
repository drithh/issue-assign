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
-   More about file upload go to [Filament Docs](https://filamentphp.com/docs/3.x/forms/fields/file-upload)
