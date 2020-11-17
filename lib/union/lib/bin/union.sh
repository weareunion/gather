## Install delegator if it does not yet exist.

if [ ! -f "/bin/union" ]; then
  if [ "$EUID" -ne 0 ]
  then echo "[NOTE] Ready to install binary shortcut. Run again with sudo to proceed."
  else
     echo "Installing toolkit..."
     cp /lib/union/lib/bin/delegator.sh /bin/union
     chmod 777 /bin/union
     echo "Done. You can now access this script with 'union <peram>'"
  fi
fi

php /lib/union/lib/bin/php/scripts/run.php "$1" "$2" "$3" "$4" "$5" "$6" "$7" "$8" "$9" "${10}" "${11}" "${12}" "${13}" "${14}" "${15}" "${16}" "${17}" "${18}" "${19}" "${20}" "${21}" "${22}" "${23}" "${24}" "${25}"