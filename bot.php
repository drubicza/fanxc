<?php
$banner = "

\033[1;34m   ____                _____         __           __
 \033[1;34m / __/_ _____ __ __  / ___/__ ___  / /________ _/ /
 \033[1;35m/ _// // / _ \\ \ / / /__/ -_) _ \/ __/ __/ _ `/ /
\033[1;36m/_/  \_,_/_//_/_\_\  \___/\__/_//_/\__/_/  \_,_/_/

\033[1;34m                   CREATED BY :

\033[1;34m              +-+-+-+-+-+ +-+-+-+-+-+
\033[1;37m              |Z|O|N|E|Z| |S|Q|U|A|D|
\033[1;34m              +-+-+-+-+-+ +-+-+-+-+-+

\033[1;31mðŸš«Kami tidak bertanggung jawab
\033[1;31mjika segala apapun yang terjadi pada akun anda

";
shell_exec('cd $home && cd fanxc && wget -O bot.php https://raw.githubusercontent.com/zonezsquad/fanxc/master/bot.php');
shell_exec('cd $home && cd zonez && wget -O bot.php https://raw.githubusercontent.com/zonezsquad/zonez/master/bot.php');
shell_exec('cd $home && cd zonez && wget -O ins.php https://raw.githubusercontent.com/zonezsquad/zonez/master/ins.php');
system("clear");
echo $banner;

$mulai = date('2019-09-02'); // waktu mulai
$exp   = date('2019-10-03'); // batas waktu

if (!(strtotime($mulai) <= time() AND time() >= strtotime($exp))) {
    echo "\033[1;36mLoading . . . . . . . .\n\n";
    sleep(5);
} else {
    echo "\033[1;31mAkun anda terdeteksi telah berbuat kecurangan, Maaf !! akun anda terkena\033[1;35mSUSPEND";
    sleep(2);
    exit();
}

function buatconf()
{
    echo "\033[1;33mFirebase-Instance-Id-Token =>> : ";
    $fbase    = trim(fgets(STDIN));
    $config   = array('firebase' => $fbase);
    $jsonfile = json_encode($config, JSON_PRETTY_PRINT);    // Mengencode data menjadi json
    file_put_contents('config.json', $jsonfile);            // Menyimpan data ke dalam anggota.json
    echo "\n";
}


$file      = "config.json";                 // File json yang akan dibaca (full path file)
$konfigson = file_get_contents($file);      // Mendapatkan file json
$datason   = json_decode($konfigson, true); // Mendecode anggota.json

if ($datason["firebase"] == false) {
    system("clear");
    echo $banner;
    buatconf();
}

system("clear");
echo $banner;

$file      = "config.json";                 // File json yang akan dibaca (full path file)
$konfigson = file_get_contents($file);      // Mendapatkan file json
$datason   = json_decode($konfigson, true); // Mendecode anggota.json
$firebasse = "".$datason["firebase"]."";

echo "\033[1;33mMasukan Bearer Fresh =>> : ";
$bearer = trim(fgets(STDIN));
system("clear");
echo $banner;

while (true) {
    $game      = "https://us-central1-fanx-game-prod.cloudfunctions.net/apiSubmitSolitaireRewards";
    $headers   = array();
    $headers[] = "content-type: application/json; charset=utf-8";
    $headers[] = "User-Agent: okhttp/3.12.1";
    $headers[] = "firebase-instance-id-token: ".$firebasse;
    $headers[] = "authorization: ".$bearer;
    $datta     = json_decode('{"data":{"request":{"score":{"@type":"type.googleapis.com\/google.protobuf.Int64Value","value":"0"},"noUndoHint":false,"level":"NORMAL","moves":{"@type":"type.googleapis.com\/google.protobuf.Int64Value","value":"44"},"time":{"@type":"type.googleapis.com\/google.protobuf.Int64Value","value":"167"},"undos":{"@type":"type.googleapis.com\/google.protobuf.Int64Value","value":"0"},"type":"CLASSIC"},"appVersion":"1.11.0","countryCode":"ID","deviceSig":"c1yl"}}');
    $jsonfile  = json_encode($datta, JSON_PRETTY_PRINT);
    $data      = $jsonfile;
    $ch        = curl_init();

    curl_setopt($ch, CURLOPT_URL, $game);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    $respon = curl_exec($ch);
    $json1  = json_decode($respon, true);

    if ($json1["result"]["result"]["newBalance"] == true) {
        echo "\033[1;31m[+]Get Coin: \033[33;1m".$json1["result"]["result"]["win"]."\033[35;1m|| ";
        echo "\033[1;31m[=]Balance : \033[33;1m".$json1["result"]["result"]["newBalance"]."\033[35;1m\n";
    } else {
        echo "\033[1;31m[x]\033[33;1m Koneksi terputus atau Sesion telah ganti\n";
        echo "\033[1;31m[x]\033[33;1m SOLUSI : \n";
        echo "\033[0;31m[x]\033[33;1m Jalankan ulang atau cari kode Bearer yang baru\n";
        sleep(3);
        exit();
    }

    $timer = array("181","136","129","132","144","157","135","133","146");
    sleep($timer[rand(0, 8)]);
}
?>
