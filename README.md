# Modern Journalist Wordpress Theme

WordPress site for Reporting on International Affairs. Developed from the _s starter theme.

### Contributing

1. New features & updates should be created on individual branches. Branch from master
2. When ready, submit pull request back into master. Rebase the feature branch first.
3. TravisCI will automatically deploy changes on master to the staging site
4. After reviewing your work on the staging site, use WPEngine to move from staging to live

## Development

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

#### Gulp

This project uses Gulp to run tasks like compiling SASS & running Browsersync. To run:

1. Navigate to wp-content/themes/modern-journalist folder
2. Run `npm install`
3. Run `npm start` to start Gulp
