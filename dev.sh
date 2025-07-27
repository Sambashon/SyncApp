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

startstopcheckXampp(){
  opc2=0
  while [ "$opc2" != 4 ]; do
    echo "Menú de administración Xampp"
    echo "1. Encender o apagar Apache"
    echo "2. Encender o apagar MySql"
    echo "3. Ver status"
    echo "4. Salir"
    echo "Los datos se envían así |opción argumento| "
    echo "Los argumentos son start y stop"
    read -p "Ingrese dos opciones separadas por espacio: " opc2 arg

    case $opc2 in
      1)
        if [[ "$arg" == "start"  ||  "$arg" == "stop" ]]; then
          sudo /opt/lampp/lampp "${arg}apache"
          read -p "Presione enter para continuar"
        else
          echo "Argumento inválido, porfavor utilice 'start' o 'stop'"
        fi
      ;;
      2)
        if [[ "$arg" == "start"  ||  "$arg" == "stop" ]]; then
          sudo /opt/lampp/lampp "${arg}mysql"
          read -p "Presione enter para continuar"
        else
          echo "Argumento inválido, porfavor utilice 'start' o 'stop'"
        fi
      ;;
      3)
        sudo /opt/lampp/lampp status
        read -p "Presione enter para continuar"
      ;;
      4)
        echo "Saliendo..."
        sleep 1
      ;;
      *)
        echo "Argumento inválido intente denuevo"
        read -p "Presione enter para continuar"
      ;;
    esac
  done
}

#TODO: Add a way to start, and stop the server (Apache and MySQL), also it must allow me to view the status of the servers
opc=0
while [ "$opc" != 6 ]; do
  clear
  echo "Menú de administración SyncApp"
  echo "1. Abrir puerto 80 tcp para conexiones http"
  echo "2. Cerrar puerto 80 tcp para conexiones http"
  echo "3. Eliminar todas las sesiones"
  echo "4. Ver status de puertos, si dice inactive entonces esta abierto, active firewall activado"
  echo "5. Menú administración LAMPP"
  echo "6. Salir"
  read opc

  case $opc in
    1)
      echo "Puerto abierto con éxito"
      sudo ufw allow 80/tcp
      read -p "Presione enter para continuar"
    ;;
    2)
      echo "Puerto cerrado con éxito"
      sudo ufw delete  allow 80/tcp
      read -p "Presione enter para continuar"
    ;;
    3)
      elimSession
      read -p "Presione enter para continuar"
    ;;
    4)
      sudo ufw status
      read -p "Presione enter para continuar"
    ;;
    5)
      clear
      startstopcheckXampp
    ;;
    6)
      echo "Saliendo"
      sleep 1
      exit
    ;;
    *)
      echo "Argumento inválido"
    ;;
  esac
done