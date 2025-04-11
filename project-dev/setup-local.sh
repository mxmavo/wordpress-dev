#!/bin/bash

#Double-check you're ready to rock and roll with an update
read -r -p "Are you sure you want to run search-replace to convert productions urls for local? [y/N] " response

if [[ "$response" =~ ^([yY][eE][sS]|[yY])$ ]]; then

	echo "";
	echo "";
	echo "******" ;
	echo "STARTING SEARCH-REPLACE"
	echo "******" ;
	echo "";
	echo "";

	echo "Multisite wp_blogs: client.website.como.com project.test"
	wp search-replace client.website.com project.test wp_blogs --network

	echo "";
	echo "Start: https://client.website.como.com -> http://project.test"
	wp search-replace https://client.website.como.com http://project.test --all-tables

	echo "";
	echo "Start: client.website.como.com -> project.test"
	wp search-replace client.website.com project.test --all-tables

	echo "";
	echo "- - - - - - - - - Enable Project Dev plugin - - - - - - - - -";
	wp plugin activate project-dev --network

	wp cache flush

	echo '';
	echo '';
	echo "*******" ;
	echo "LOCAL SETUP COMPLETE!" ;
	echo "*******" ;
	echo '';
	echo '';

fi