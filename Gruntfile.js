module.exports = function(grunt) {

    // 1. All configuration goes here
    grunt.initConfig({

	compass: {
            dist: {
		options: {
		    config: 'library/config.rb'
		}
            }
	},

	watch: {
            css: {
		files: '**/*.scss',
		tasks: ['compass']
            }
	}

    });

    // 3. Where we tell Grunt we plan to use this plug-in.
    grunt.loadNpmTasks('grunt-contrib-compass');
    grunt.loadNpmTasks('grunt-contrib-watch');

    // 4. Where we tell Grunt what to do when we type "grunt" into the terminal.
    grunt.registerTask('default', ['compass', 'watch']);
    grunt.registerTask('dev', ['watch']);
};
