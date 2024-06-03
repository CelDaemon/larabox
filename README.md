# Larabox

## Contributing

### Colors

Colors can be exported from [RealtimeColors](https://www.realtimecolors.com), using the following export format:
```
--text: ${text.hslH}, ${text.hslS};
--background: ${bg.hslH}, ${bg.hslS};
--primary: ${primary.hslH}, ${primary.hslS};
--secondary: ${secondary.hslH}, ${secondary.hslS};
--accent: ${accent.hslH}, ${accent.hslS};

--text-light: ${textL.hslL};
--text-dark: ${textD.hslL};
--background-light: ${bgL.hslL};
--background-dark: ${bgD.hslL};
--primary-light: ${primaryL.hslL};
--primary-dark: ${primaryD.hslL};
--secondary-light: ${secondaryL.hslL};
--secondary-dark: ${secondaryD.hslL};
--accent-light: ${accentL.hslL};
--accent-dark: ${accentD.hslL};
```

### Debugging
To enable debugging in the project, use the builtin php web server with the xdebug extension.

#### Step-Through
After using xdebug, set the `xdebug.mode` property to `debug` using an ini file (or `-d xdebug.mode=debug`).
Then, to enable the actual debugging session, set `XDEBUG_SESSION=1` in the environment variables.

### Running Locally
A custom environment may be used, but during development the following command has been used to run the server:
`php -S localhost:5123 -t public -d xdebug.mode=debug`

### Deployment
During deployment, the following steps need to be taken:

1. Pull the server down for maintenance using `artisan down`, possibly using a secret for testing.
2. Retrieving the exact application file state, this may be done in a number of ways, but the currently used mechanism is git with the following commands:
   - `git fetch origin {COMMIT_SHA} --depth 1`
   - `git reset --hard {COMMIT_SHA}`
3. Clean out the remaining files from the previous deployment, excluding required configuration files, `storage`, and `database`, currently also done using git with:
   
    `git clean -xf -e storage -e database -e .env`
4. Install modified composer dependencies, carefully only installing required production files with:

    `composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev`
5. Optimize away routes and configuration files using `artisan optimize`
6. Run pending migrations with `artisan migrate --force`
7. Install changed npm dependencies, using `npm install`
8. Build ts/css resources using `npm build`
9. Bring the server back up with `artisan up`
