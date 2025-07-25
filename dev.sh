#!/bin/bash

elimSession(){
  TARGET_DIR="/opt/lampp/temp"

  if [ ! -d "$TARGET_DIR" ]; then #seguridad por si los archivos no existen
    echo "Error: Directory '$TARGET_DIR' does not exist."
    exit 1
  fi

  find "$TARGET_DIR" -type f -exec rm -f {} \; #elimina todo

  echo "All files in '$TARGET_DIR' have been deleted."
}


opc=0
while [ "$opc" != 5 ]; do
  clear
  echo "Menú de administración SyncApp"
  echo "1. Abrir puerto 80 tcp para conexiones http"
  echo "2. Cerrar puerto 80 tcp para conexiones http"
  echo "3. Eliminar todas las sesiones"
  echo "4. Ver status de puertos, si dice inactive entonces esta abierto, active firewall activa"
  echo "5. Salir"
  read opc

  case $opc in
    1)
      echo "Puerto abierto con éxito"
      sudo ufw allow 80/tcp
      read -p ""
    ;;
    2)
      echo "Puerto cerrado con éxito"
      sudo ufw delete  allow 80/tcp
      read -p ""
    ;;
    3)
      elimSession
      read -p ""
    ;;
    4)
      sudo ufw status
      read -p ""
    ;;
    5)
      echo "Saliendo"
      sleep 1
      exit
    ;;
    *)
      echo "Argumento inválido"
    ;;
  esac
done