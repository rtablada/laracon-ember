rm -rf laravel/public/assets
(cd gallery && ember build --environment production)
cp gallery/dist/index.html laravel/app/views/app.php
cp -r gallery/dist/assets laravel/public/
rm -rf gallery/dist
