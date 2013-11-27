#
# Makefile
# Facundo M. Acevedo, 2013-09-23 11:28
#

CC=gcc
CFLAGS=-Wall -std=c99 -O2  

.PHONY: all clean

all: smbP 

smbP: 
	        $(CC) $(CFLAGS)  smbP.c -o smbP



# vim:ft=make
#

