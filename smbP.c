/*
 * smbP.c
 * copyleft (>) 2013 Facundo M. Acevedo <Acv2Facundo[AT]gmail[DOT]com>
 *
 * Distributed under terms of the BOLA license.
 */

/*argv[1] = n_usuario
 argv[2] = pass_viejo
 argv[3] = pass_nuevo
 */

#define _POSIX_SOURCE
#include <sys/types.h>
#include <stdio.h>
#include <stdlib.h>
#include <pwd.h>
#include <unistd.h>

#include <sys/wait.h>

uid_t nombre_to_uid(char const *nombre)
{
  if (!nombre)
    return -1;
 
  long const buflen = sysconf(_SC_GETPW_R_SIZE_MAX);
  
  if (buflen == -1)
    return -1;
  
  // requires c99
  char buf[buflen];
  struct passwd pwbuf, *pwbufp;
  
  if (0 != getpwnam_r(nombre, &pwbuf, buf, buflen, &pwbufp)
      || !pwbufp)
    return -1;
  return pwbufp->pw_uid;
}

int main (int argc, char *argv[])
  {
     uid_t uid = nombre_to_uid(argv[1]);

     if (uid == -1)
     		return -1;
     
     setuid ((int) uid);
     
     char prefix[500] = "";
     snprintf(prefix, sizeof(prefix), \
		     "printf \"%s\n%s\n%s\n\" | /usr/bin/smbpasswd -s",\
		     argv[2],argv[3],argv[3]);

    int ret = WEXITSTATUS( system (prefix));

     return ret;
   }



