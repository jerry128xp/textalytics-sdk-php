# Makefile for PHP client to Textalytics.com 1.0
#
# Copyright: Daedalus - Data, Decisions and Language  
# author: zdepablo

CLIENT_VERSION = 1.0
API_VERSION = 1.0
API_NAME = sempub-$(API_VERSION)
NAME = textalytics-sdk-php-$(API_NAME)

# Target directory to perform the build 
TARGET_DIR = target

# Limpia el directorio local donde hace build
clean: 
	rm -rf $(TARGET_DIR)

package: clean
	mkdir -p $(TARGET_DIR)/$(NAME)/domain
	mkdir -p $(TARGET_DIR)/$(NAME)/manage
	mkdir -p $(TARGET_DIR)/$(NAME)/examples
	cp -R domain $(TARGET_DIR)/$(NAME)/
	cp -R manage $(TARGET_DIR)/$(NAME)/
	cp -R examples $(TARGET_DIR)/$(NAME)/
	rm -rf $(TARGET_DIR)/$(NAME)/examples/example.php
	cp *.php $(TARGET_DIR)/$(NAME)/
	cp config.inc $(TARGET_DIR)/$(NAME)/
	cp README.md $(TARGET_DIR)/$(NAME)/
	cp LICENSE $(TARGET_DIR)/$(NAME)/
	cd $(TARGET_DIR); tar -zcvf $(NAME).tar.gz $(NAME)/* 
