# Makefile for PHP client to Textalytics.com 1.0
#
# Copyright: Daedalus - Data, Decisions and Language  
# author: zdepablo

CLIENT_VERSION = 1.0
API_VERSION = 1.0
API_NAME = media-$(API_VERSION)
NAME = textalytics-sdk-php-$(API_NAME)

# Target directory to perform the build 
TARGET_DIR = target

# Limpia el directorio local donde hace build
clean: 
	rm -rf $(TARGET_DIR)

package: clean
	mkdir -p $(TARGET_DIR)/$(NAME)/domain
	cp -R domain $(TARGET_DIR)/$(NAME)/
	cp *.php $(TARGET_DIR)/$(NAME)/
	cp example.txt $(TARGET_DIR)/$(NAME)/
	cp config.inc $(TARGET_DIR)/$(NAME)/
	cp README $(TARGET_DIR)/$(NAME)/
	cp LICENSE $(TARGET_DIR)/$(NAME)/
	cd $(TARGET_DIR); tar -zcvf $(NAME).tar.gz $(NAME)/* 
