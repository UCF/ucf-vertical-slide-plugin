# UCF Vertical Slide Plugin #

Custom vertical slider plugin for UCF.

## Description ##

The Vertical Slide Plugin is a powerful tool for WordPress that allows you to easily create sliders on the frontend of your website. With its custom post type feature, you can seamlessly add and manage sliders with ease.

## Documentation ##

Head over to the [ucf-vertical-slide-plugin wiki](https://github.com/UCF/ucf-vertical-slide-plugin/wiki) for detailed information about this plugin, installation instructions, and more.


## Changelog ##

### 0.2.0 ###
* Added github packagist update action.

### 0.1.0 ###
* Initial release


## Upgrade Notice ##

n/a


## Development ##

Note that compiled, minified css and js files are included within the repo.  Changes to these files should be tracked via git (so that users installing the plugin using traditional installation methods will have a working plugin out-of-the-box.)

[Enabling debug mode](https://codex.wordpress.org/Debugging_in_WordPress) in your `wp-config.php` file is recommended during development to help catch warnings and bugs.

### Requirements ###
* WordPress installation
* node v16+
* gulp-cli
* [Advanced Custom Fields Pro (ACF Pro) plugin](https://www.advancedcustomfields.com/pro/)


### Instructions ###
1. You can download the plugin from [here](https://github.com/UCF/ucf-vertical-slide-plugin/archive/refs/heads/main.zip) and install it in your Wordpress directly or Clone the ucf-vertical-slide-plugin [repo](https://github.com/UCF/ucf-vertical-slide-plugin) into your local development environment, within your WordPress installation's plugins/ directory: git clone https://github.com/UCF/ucf-vertical-slide-plugin.git
2. `cd` into the new ucf-vertical-slide-plugin directory, and run `npm install` to install required packages for development into `node_modules/` within the repo
3. Ensure ACF Pro is installed and activated in your WordPress.
5. Activate this plugin on your development WordPress site.
6. Run `gulp default` to process front-end assets.
7. Run `gulp watch` to continuously watch changes to scss and js files. If you enabled BrowserSync in `gulp-config.json`, it will also reload your browser when plugin files change.

### Other Notes ###
* This plugin's README.md file is automatically generated. Please only make modifications to the README.txt file, and make sure the `gulp readme` command has been run before committing README changes.  See the [contributing guidelines](https://github.com/UCF/ucf-vertical-slide-plugin/blob/master/CONTRIBUTING.md) for more information.


## Contributing ##

Want to submit a bug report or feature request?  Check out our [contributing guidelines](https://github.com/UCF/ucf-vertical-slide-plugin/blob/master/CONTRIBUTING.md) for more information.  We'd love to hear from you!
