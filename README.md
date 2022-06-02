<p>
    To run the application. Laravel/spatie must first be installed.
    If you have not installed Laravel/spatie, follow <a href="https://spatie.be/docs/laravel-permission/v5/installation-laravel">this guide</a>.
</p>
<p>
    Since custom helper functions are added, you need to run <code>composer dump-autoload</code> before running the program to load all helper functions.
</p>
<p>
    You may also need to create the symbolic link using <code>php artisan storage:link</code> Artisan command.
</p>
<p>
    In your <strong>.env</strong> file, config the asset URL by setting the <strong>ASSET_URL</strong> variable to 
    <strong>&ltAPP_URL&gt/assets</strong> with <strong>&ltAPP_URL&gt</strong> is the value of your <strong>APP_URL</strong>
    variable.
</p>
