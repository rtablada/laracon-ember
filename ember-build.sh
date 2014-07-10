rm -rf public/assets
(cd gallery && ember build --environment production)
cp gallery/dist/index.html app/views/app.php
cp -r gallery/dist/assets public/
rm -rf gallery/dist
