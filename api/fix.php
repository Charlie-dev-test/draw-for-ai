<?

$url = "http://192.168.15.169:8086/script/fix";
echo "RESULT:\t".date("d.m.Y H:i:s")."\t".file_get_contents($url);
