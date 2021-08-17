# Modern Journalist Wordpress Theme

WordPress site for Reporting on International Affairs. Developed from the _s starter theme.

## Quick-start Instructions

### If setting up the project for the first time:

1. Follow the instructions in the "Install Local" and "Connect Local to WP Engine" sections in this [blog post](https://wpengine.com/support/local/).
2. Follow the instructions in the "pull to Local from WP Engine" section to pull the "CSIS Journalism Development" Environment to your local machine
3. Navigate to the directory where Local created the site: eg `cd /Users/[YOUR NAME]/Local Sites/csisjournalism/app/public`
4. Initiate git & add remote origin. This will connect your local directory to the Git Repo and create a local `main` branch synced with the remote `main` branch.

```shell
$ git init
$ git remote add origin git@github.com:CSIS-iLab/journalism_wp.git
$ git fetch origin
$ git checkout origin/main -ft
```

### If project is already set up:

To begin development, navigate to the theme directory and start npm.

```shell
$ cd wp-content/themes/modern-journalist
$ npm install
$ npm start
```

This project also includes custom Gutenberg blocks, which can be worked on at:

```shell
$ cd wp-content/plugins/jourblocks
$ npm install
$ npm start
```

### CI/CD

GitHub Actions will automatically build & deploy the theme to the development environment on WPE based on the settings specified in the deployment workflow.

- The `WPE_ENVIRONMENT_NAME: ${{ secrets.WPENGINE_DEV_ENV_NAME }}` setting will be deployed to the WP Engine Development Environment. The Development environment should be used to demo new features.

#### Required Plugins

- Add to Any Share
- Akismet
- Disable Comments
- Enhanced Media Library
- Featured Galleries
- Jetpack
- Fluidbox for WordPress
- Related
  - Related Posts (Doubled Up)
- TinyMCE Advanced
- WPBakery Page Builder
- WPFront User Role Editor
- Yoast SEO

## Copyright / License Info

Copyright © 2021 CSIS iDeas Lab under the [MIT License](https://github.com/CSIS-iLab/journalism/blob/main/LICENSE).
