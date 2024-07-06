<?php
function getFileSize($filePath, $useSizeof = true) {
    // Check if the file exists
    if (!file_exists($filePath)) {
        return false; // File does not exist
    }

    $bytesCount = 0;
    if ($useSizeof) {
        // Use the built-in filesize function for efficiency
        $bytesCount = filesize($filePath);
    } else {
        // Manually count the bytes by reading the file
        $handle = fopen($filePath, 'rb');
        if (!$handle) {
            return false; // Unable to open file
        }

        // Read until EOF
        while (!feof($handle)) {
            $read = fread($handle, 1);
            if ($read !== false && $read !== '') {
                $bytesCount++;
            }
        }

        fclose($handle);
    }

    // Calculate the file size in various units and round to 2 decimal places
    $result = [
        'bytes' => $bytesCount,
        'kilobytes' => number_format($bytesCount / 1000, 2),
        'kibibytes' => number_format($bytesCount / 1024, 2),
        'megabytes' => number_format($bytesCount / 1000**2, 2),
        'megibytes' => number_format($bytesCount / 1024**2, 2),
        'gigabytes' => number_format($bytesCount / 1000**3, 2),
        'gibibytes' => number_format($bytesCount / 1024**3, 2),
        'terabytes' => number_format($bytesCount / 1000**4, 2),
        'tibibytes' => number_format($bytesCount / 1024**4, 2),
        'petabytes' => number_format($bytesCount / 1000**5, 2),
        'pebibytes' => number_format($bytesCount / 1024**5, 2),
    ];

    return $result;
}
?>