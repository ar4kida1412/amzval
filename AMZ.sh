#!/bin/bash
# Slackerc0de Family Present
# PayPal Valid V9
# 13 July 2K17
# By Malhadi Jr.
# recoded by sm0usy
# last recoded 12 May 2020

clear
cat <<EOF

 ▄▄▄       ███▄ ▄███▓▒███████▒  ▄████  ██▓     ▒█████   ▄▄▄▄    ▄▄▄       ██▓       ▓█████  ███▄ ▄███▓ ▄▄▄       ██▓ ██▓        ██▒   █▓ ▄▄▄       ██▓     ██▓▓█████▄ 
▒████▄    ▓██▒▀█▀ ██▒▒ ▒ ▒ ▄▀░ ██▒ ▀█▒▓██▒    ▒██▒  ██▒▓█████▄ ▒████▄    ▓██▒       ▓█   ▀ ▓██▒▀█▀ ██▒▒████▄    ▓██▒▓██▒       ▓██░   █▒▒████▄    ▓██▒    ▓██▒▒██▀ ██▌
▒██  ▀█▄  ▓██    ▓██░░ ▒ ▄▀▒░ ▒██░▄▄▄░▒██░    ▒██░  ██▒▒██▒ ▄██▒██  ▀█▄  ▒██░       ▒███   ▓██    ▓██░▒██  ▀█▄  ▒██▒▒██░        ▓██  █▒░▒██  ▀█▄  ▒██░    ▒██▒░██   █▌
░██▄▄▄▄██ ▒██    ▒██   ▄▀▒   ░░▓█  ██▓▒██░    ▒██   ██░▒██░█▀  ░██▄▄▄▄██ ▒██░       ▒▓█  ▄ ▒██    ▒██ ░██▄▄▄▄██ ░██░▒██░         ▒██ █░░░██▄▄▄▄██ ▒██░    ░██░░▓█▄   ▌
 ▓█   ▓██▒▒██▒   ░██▒▒███████▒░▒▓███▀▒░██████▒░ ████▓▒░░▓█  ▀█▓ ▓█   ▓██▒░██████▒   ░▒████▒▒██▒   ░██▒ ▓█   ▓██▒░██░░██████▒      ▒▀█░   ▓█   ▓██▒░██████▒░██░░▒████▓ 
 ▒▒   ▓▒█░░ ▒░   ░  ░░▒▒ ▓░▒░▒ ░▒   ▒ ░ ▒░▓  ░░ ▒░▒░▒░ ░▒▓███▀▒ ▒▒   ▓▒█░░ ▒░▓  ░   ░░ ▒░ ░░ ▒░   ░  ░ ▒▒   ▓▒█░░▓  ░ ▒░▓  ░      ░ ▐░   ▒▒   ▓▒█░░ ▒░▓  ░░▓   ▒▒▓  ▒ 
  ▒   ▒▒ ░░  ░      ░░░▒ ▒ ░ ▒  ░   ░ ░ ░ ▒  ░  ░ ▒ ▒░ ▒░▒   ░   ▒   ▒▒ ░░ ░ ▒  ░    ░ ░  ░░  ░      ░  ▒   ▒▒ ░ ▒ ░░ ░ ▒  ░      ░ ░░    ▒   ▒▒ ░░ ░ ▒  ░ ▒ ░ ░ ▒  ▒ 
  ░   ▒   ░      ░   ░ ░ ░ ░ ░░ ░   ░   ░ ░   ░ ░ ░ ▒   ░    ░   ░   ▒     ░ ░         ░   ░      ░     ░   ▒    ▒ ░  ░ ░           ░░    ░   ▒     ░ ░    ▒ ░ ░ ░  ░ 
      ░  ░       ░     ░ ░          ░     ░  ░    ░ ░   ░            ░  ░    ░  ░      ░  ░       ░         ░  ░ ░      ░  ░         ░        ░  ░    ░  ░ ░     ░    
                     ░                                       ░                                                                      ░                          ░      

EOF

usage() {
  echo "Usage: ./myscript.sh COMMANDS: [-i <list.txt>] [-r <folder/>] [-l {1-1000}] [-t {1-10}] OPTIONS: [-d] [-c]

Command:
-i (20k-US.txt)     File input that contain email to check
-r (result/)        Folder to store the result live.txt and die.txt
-l (60|90|110)      How many list you want to send per delayTime
-t (3|5|8)          Sleep for -t when check is reach -l fold

Options:
-d                  Delete the list from input file per check
-c                  Compress result to compressed/ folder and
                    move result folder to haschecked/
-h                  Show this manual to screen
-u                  Check integrity file then update

Report any bugs to: <sm0usy> sm0usy@programmer.net
"
  exit 1
}

# Assign the arguments for each
# parameter to global variable
while getopts ":i:r:l:t:dchu" o; do
    case "${o}" in
        i)
            inputFile=${OPTARG}
            ;;
        r)
            targetFolder=${OPTARG}
            ;;
        l)
            sendList=${OPTARG}
            ;;
        t)
            perSec=${OPTARG}
            ;;
        d)
            isDel='y'
            ;;
        c)
            isCompress='y'
            ;;
        h)
            usage
            ;;
        u)
            updater
            ;;
    esac
done

# Assign false value boolean
# to both options when its null
if [ -z "${isDel}" ]; then
  isDel='n'
fi

if [ -z "${isCompress}" ]; then
  isCompress='n'
fi

SECONDS=0

# Asking user whenever the
# parameter is blank or null
if [[ $inputFile == '' ]]; then
  # Print available file on
  # current folder
  # clear
  tree
  read -p "Enter mailist file: " inputFile
fi

if [[ $targetFolder == '' ]]; then
  read -p "Enter target folder: " targetFolder
  # Check if result folder exists
  # then create if it didn't
  if [[ ! -d "$targetFolder" ]]; then
    echo "[+] Creating $targetFolder/ folder"
    mkdir $targetFolder
  else
    read -p "$targetFolder/ folder are exists, append to them ? [y/n]: " isAppend
    if [[ $isAppend == 'n' ]]; then
      exit
    fi
  fi
else
  if [[ ! -d "$targetFolder" ]]; then
    echo "[+] Creating $targetFolder/ folder"
    mkdir $targetFolder
  fi
fi

if [[ $isDel == '' ]]; then
  read -p "Delete list per check ? [y/n]: " isDel
fi

if [[ $isCompress == '' ]]; then
  read -p "Compress the result ? [y/n]: " isCompress
fi

if [[ $sendList == '' ]]; then
  read -p "How many list send: " sendList
fi

if [[ $perSec == '' ]]; then
  read -p "Delay time: " perSec
fi

malhadi_appleval() {
  YLW='\033[93m'
  GRN='\033[92m'
  RED='\033[91m'
  BLW='\033[94m'
  CYAN='\033[96m'
  PURP='\033[91m'
  NC='\033[0m'
  SECONDS=0

  # posted=`curl "https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&xo_node_fallback=true&force_sa=true&upload=1&rm=2&business=$1" -D - -L --cookie anjeng.txt --cookie-jar anjeng.txt -s -A "$rand_useragent"`
  posted=`php AMZAPI.php $1`
  # echo "$posted" >> $1.html
  duration=$SECONDS

  live="$(echo "$posted" | grep -c 'LIVE')"
  dead="$(echo "$posted" | grep -c 'DIE')"

  header="`date +%H:%M:%S` from $inputFile to $targetFolder"
  footer="[AMZGlobal Email Validator v1.0 by sm0usy] $(($duration % 60))sec.\n"

	if [[ $dead > 0 ]]; then
	    #echo "$posted" >> $1.html
        printf "${RED}[$header] $2/$3. DIE => $1 ${CYAN} $footer ${NC}"
        echo "DIE => $1" >> $4/die.txt
    elif [[ $live > 0 ]]; then
        printf "${GRN}[$header] $2/$3. LIVE => $1 ${CYAN} $footer ${NC}"
        echo "LIVE => $1" >> $4/live.txt
	else
        printf "${BLW}[$header] $2/$3. UNKNOWN => $1 ${CYAN} $footer ${NC}"
        echo "UNKNOWN => $1" >> $4/unknown.txt
	fi

  printf "${NC} \r"
}

# Preparing file list
# by using email pattern
# every line in $inputFile
echo "[+] Cleaning your mailist file"
grep -Eiorh '([[:alnum:]_.-]+@[[:alnum:]_.-]+?\.[[:alpha:].]{2,6})' $inputFile | tr '[:upper:]' '[:lower:]' | sort | uniq > temp_list && mv temp_list $inputFile

# Finding match mail provider
echo "########################################"
# Print total line of mailist
totalLines=`grep -c "@" $inputFile`
echo "There are $totalLines of list."
echo "########################################"

# Extract email per line
# from both input file
IFS=$'\r\n' GLOBIGNORE='*' command eval  'mailist=($(cat $inputFile))'
con=1

echo "[+] Sending $sendList email per $perSec seconds"

for (( i = 0; i < "${#mailist[@]}"; i++ )); do
  username="${mailist[$i]}"
  indexer=$((con++))
  tot=$((totalLines--))
  fold=`expr $i % $sendList`
  if [[ $fold == 0 && $i > 0 ]]; then
    header="`date +%H:%M:%S`"
    duration=$SECONDS
    echo "[$header] Waiting $perSec second. $(($duration / 3600)) hours $(($duration / 60)) minutes and $(($duration % 60)) seconds elapsed, With $sendList req / $perSec seconds."
    sleep $perSec
  fi

  malhadi_appleval "$username" "$indexer" "$tot" "$targetFolder" "$inputFile" &

  if [[ $isDel == 'y' ]]; then
    grep -v -- "$username" $inputFile > "$inputFile"_temp && mv "$inputFile"_temp $inputFile
  fi
done

# waiting the background process to be done
# then checking list from garbage collector
# located on $targetFolder/unknown.txt
echo "[+] Waiting background process to be done"
wait
wc -l $targetFolder/*

if [[ $isCompress == 'y' ]]; then
  tgl=`date`
  tgl=${tgl// /-}
  zipped="$targetFolder-$tgl.zip"

  echo "[+] Compressing result"
  zip -r "compressed/$zipped" "$targetFolder/die.txt" "$targetFolder/live.txt"
  echo "[+] Saved to compressed/$zipped"
  mv $targetFolder haschecked
  echo "[+] $targetFolder has been moved to haschecked/"
fi
#rm $inputFile
duration=$SECONDS
echo "$(($duration / 3600)) hours $(($duration / 60)) minutes and $(($duration % 60)) seconds elapsed."
echo "+==============+ AMZGlobal Email Validator v1.0 by sm0usy +==============+"