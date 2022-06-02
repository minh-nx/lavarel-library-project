<p>
    To run the application. Laravel/spatie must first be installed.
    If you have not installed Laravel/spatie, follow <a href="https://spatie.be/docs/laravel-permission/v5/installation-laravel">this guide</a>.
</p>
<p>
    The application assumes that the default asset URL host is <strong>&ltAPP_URL&gt/assets</strong>. To set default asset URL host, in your <strong>.env</strong> file,       set the <strong>ASSET_URL</strong> variable to <strong>&ltAPP_URL&gt/assets</strong>, where <strong>&ltAPP_URL&gt</strong> is the value of 
    <strong>APP_URL</strong> variable.
</p>
<p>
    You may need to run these Artisan command in order to properly run the application:
    <ul> 
        <li>
            <code>composer dump-autoload</code> Artisan command to load global helper functions.
        </li>
        <li>
            <code>php artisan storage:link</code> Artisan command to create the symbolic link. You can read more about symbolic link <a                                               href="https://laravel.com/docs/9.x/filesystem#the-public-disk">here</a>.
        </li>
    </ul>
</p>
<p>
    <strong>Note:</strong> you must config your own mail related setting in your <strong>.env</strong> to use any services relating to mailing.
</p>
