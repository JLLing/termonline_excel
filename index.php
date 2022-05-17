<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
    <title>Title</title>
</head>
<body>
<?php
function getDoubanFileNum()
{
    $path = ".";
    if (!is_dir($path)) {
        return false;
    }
    $data = scandir($path);
    echo "<table>";

    $data = array_reverse($data);

    foreach ($data as $value) {
        $file_path = $path . "\\" . $value;
        if ($value != '.' && $value != '..' && is_dir($file_path)) {
            $doc = scandir($file_path);
            $paths = [];
            foreach ($doc as $file) {
                if (strstr($file, '.xlsx')) {
                    $paths[0] = $file;
                } else if (strstr($file, '.pdf')) {
                    $paths[1] = $path . "\\" . $value . "\\" . $file;
                } else if (strstr($file, '.htm')) {
                    $paths[2] = $file;
                }
            }

            $cdate = date("Y-m-d", filectime($file_path));
            echo "<tr>";
            echo "<td>" . $value . "<td>";
            echo "<td>" . "<a href='" . $paths[1] . "'>pdf</a>" . "<td>";
            echo "<td>" . "<a href='excel.html?path=" . $value . "/" . $paths[0] . "'>xlsx</a>" . "<td>";
            echo "<td>" . ($paths[2] ? "<a href='word.html?path=" . $value . "/" . $paths[2] . "'>htm</a>" : "") . "<td>";
            echo "</tr>";

        }
    }
    echo "</table>";

    // echo json_encode($douban);
    /* foreach ($douban as $date => $count){
        echo $date . " " . $count . "<br>";
    } */
    return "";
}

getDoubanFileNum();
?>

</body>
</html>
