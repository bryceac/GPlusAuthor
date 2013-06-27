<?php

/*
Copyright (c) 2013 Bryce Campbell

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE. */

// the GPlusAuthor class puts the link element necessary for linking site to Google+ into the header, so that no manual are needed
class GPlusAuthor extends Plugin
{
	
	// the following sets default values upon activation
	public function action_plugin_activation($file)
	{
		// set options
		Options::set('gplus_id', '');
	}
	
	// the following deletes options from database
	public function action_plugin_deactivation($file)
	{
		// delete delete optiond
		Options::delete('gplus_id');
	}
	
	// the following allows plugin configuration
	public function configure()
	{	
		// the following creates the config form
		$ui = new FormUI('feed_config');
		$ui->append('text', 'gplus_profile', 'option:gplus_id', _t('Google+ Profile id:'));
		$ui->gplus_profile = Options::get('gplus_id');
		$ui->append('submit', 'save', _t('Save'));
		$ui->set_option('success_message', _t('Configuration saved'));
		return $ui;
	}
	
	// function used to place things in the header
	public function theme_header()
	{
		$gplus_url = '<link rel="author" href="https://plus.google.com/' . Options::get('gplus_id') . '/posts">'; // create address for Google+ profile based on user input
		return $gplus_url;
	}
	
} // end class
?>