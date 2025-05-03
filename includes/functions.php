<?php

function logResults($message)
{
    $timestamp = set_precise_time();
    $logMessage = "$timestamp - $message\n";
    file_put_contents('./log.csv', $logMessage, FILE_APPEND);
}

/**
 * Respond with a JSON message
 * 
 * @param string $message The message to return
 * @param int $code HTTP response code
 * @param bool $success Whether the operation was successful
 * @return void
 */


function respondWithJSON(...$args)
{
    header('Content-Type: application/json');

    if (count($args) === 2) {
        [$status, $message] = $args;
        echo json_encode([
            'success' => $status,
            'message' => $message
        ]);
        return;
    }

    if (count($args) === 3) {
        [$message, $code, $success] = $args;
        http_response_code($code);
        echo json_encode([
            'success' => $success ? 'success' : 'error',
            'message' => $message
        ]);
        return;
    }

    // Handle incorrect usage (optional but recommended)
    echo json_encode([
        'success' => false,
        'message' => 'Invalid arguments provided to respondWithJSON'
    ]);
}


/**
 * Sanitize a filename to prevent security issues
 *
 * @param string $fileName Original filename
 * @return string Sanitized filename
 */
function sanitizeFileName($fileName)
{
    // Remove any path information to avoid directory traversal attacks
    $fileName = basename($fileName);

    // Remove special characters that could cause issues
    $sanitized = preg_replace('/[^a-zA-Z0-9_\.-]/', '_', $fileName);

    // Prevent duplicate extensions (e.g., file.php.jpg)
    $sanitized = preg_replace('/\.(?=.*\.)/', '_', $sanitized);

    return $sanitized;
}

/**
 * Upload and process an image file
 *
 * @param array $file The $_FILES array element
 * @param string $uploadPath The target directory for the uploaded file
 * @param int $maxSize Maximum file size in bytes (default 5MB)
 * @param array $allowedTypes Optional array of allowed MIME types (defaults to common image types)
 * @return array Result with status, message and filename if successful
 */
function uploadImage($file, $uploadPath, $maxSize = 5242880, $allowedTypes = null)
{
    // Initialize result array
    $result = [
        'status' => false,
        'message' => '',
        'filename' => '',
        'filepath' => ''
    ];

    // Early validation - check if file exists and there are no errors
    if (!isset($file) || !is_array($file)) {
        $result['message'] = 'No file provided or invalid file data';
        return $result;
    }

    // Check for upload errors
    if ($file['error'] !== UPLOAD_ERR_OK) {
        $errorMessages = [
            UPLOAD_ERR_INI_SIZE => 'File exceeds upload_max_filesize directive in php.ini',
            UPLOAD_ERR_FORM_SIZE => 'File exceeds MAX_FILE_SIZE directive in the HTML form',
            UPLOAD_ERR_PARTIAL => 'File was only partially uploaded',
            UPLOAD_ERR_NO_FILE => 'No file was uploaded',
            UPLOAD_ERR_NO_TMP_DIR => 'Missing temporary folder',
            UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk',
            UPLOAD_ERR_EXTENSION => 'File upload stopped by extension'
        ];
        $result['message'] = $errorMessages[$file['error']] ?? 'Unknown upload error';
        return $result;
    }

    // Check if the uploaded file actually exists
    if (!file_exists($file['tmp_name']) || !is_uploaded_file($file['tmp_name'])) {
        $result['message'] = 'Invalid upload or possible file upload attack';
        return $result;
    }

    // Validate file size
    if ($file['size'] > $maxSize) {
        $result['message'] = 'File size exceeds the maximum limit of ' . round($maxSize / 1048576, 2) . 'MB';
        return $result;
    }

    // Set default allowed types if not provided
    if ($allowedTypes === null) {
        $allowedTypes = [
            'image/jpeg' => ['jpg', 'jpeg'],
            'image/png' => ['png'],
            'image/gif' => ['gif'],
            'image/webp' => ['webp'],
            'image/avif' => ['avif']
        ];
    }

    // Get file type using finfo (more reliable than mime_content_type)
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $file_type = $finfo->file($file['tmp_name']);

    // Get file extension
    $path_parts = pathinfo($file['name']);
    $extension = strtolower($path_parts['extension'] ?? '');

    // Check if file type is allowed
    if (!array_key_exists($file_type, $allowedTypes) || !in_array($extension, $allowedTypes[$file_type])) {
        $allowed_extensions = [];
        foreach ($allowedTypes as $mime => $exts) {
            $allowed_extensions = array_merge($allowed_extensions, $exts);
        }
        $result['message'] = 'Invalid file type. Only ' . strtoupper(implode(', ', array_unique($allowed_extensions))) . ' files are allowed.';
        return $result;
    }

    // Ensure upload directory exists and is writable
    if (!is_dir($uploadPath)) {
        if (!mkdir($uploadPath, 0755, true)) {
            $result['message'] = 'Failed to create upload directory.';
            return $result;
        }
    } elseif (!is_writable($uploadPath)) {
        $result['message'] = 'Upload directory is not writable.';
        return $result;
    }

    // Generate unique filename with secure random string
    $sanitized_name = sanitizeFileName($file['name']);
    $unique_prefix = bin2hex(random_bytes(8)); // More secure than time()
    $unique_name = $unique_prefix . '_' . $sanitized_name;
    $target_file = rtrim($uploadPath, '/') . '/' . $unique_name;

    // Verify image integrity
    if (!verifyImageIntegrity($file['tmp_name'], $file_type)) {
        $result['message'] = 'The file does not appear to be a valid image.';
        return $result;
    }

    // Move the uploaded file to the target directory
    if (move_uploaded_file($file['tmp_name'], $target_file)) {
        // Set proper permissions
        chmod($target_file, 0644);

        $result['status'] = true;
        $result['message'] = 'File uploaded successfully.';
        $result['filename'] = $unique_name;
        $result['filepath'] = $target_file;
    } else {
        $result['message'] = 'Failed to move uploaded file. Check permissions.';
    }

    return $result;
}

/**
 * Verify image integrity by attempting to create an image resource
 *
 * @param string $file_path Path to the temporary uploaded file
 * @param string $mime_type MIME type of the file
 * @return bool True if the file is a valid image, false otherwise
 */
function verifyImageIntegrity($file_path, $mime_type)
{
    // Try to create an image from the file based on its MIME type
    try {
        switch ($mime_type) {
            case 'image/jpeg':
                $img = imagecreatefromjpeg($file_path);
                break;
            case 'image/png':
                $img = imagecreatefrompng($file_path);
                break;
            case 'image/gif':
                $img = imagecreatefromgif($file_path);
                break;
            case 'image/webp':
                if (function_exists('imagecreatefromwebp')) {
                    $img = imagecreatefromwebp($file_path);
                } else {
                    return false; // WEBP not supported
                }
                break;
            case 'image/avif':
                if (function_exists('imagecreatefromavif')) {
                    $img = imagecreatefromavif($file_path);
                } else {
                    return false; // AVIF not supported
                }
                break;
            default:
                return false;
        }

        // If we got here and $img is a resource or object (for PHP 8+), it's valid
        if ($img) {
            imagedestroy($img);
            return true;
        }
    } catch (Exception $e) {
        // An exception means the image is invalid
        return false;
    }

    return false;
}



function set_precise_time()
{
    date_default_timezone_set('Africa/Johannesburg');
    $hr = date('H');
    $mn = date('i');
    $sc = date('s');

    $date = strtotime('today');
    $today = date('Y-m-d', $date);
    $time = "{$hr}:{$mn}:{$sc}";

    $datetime = "{$today}, {$time}";
    return $datetime;
}


function checkPrivilege($privilege, $requiredPrivilege)
{
    if (empty($privilege) || strtolower($privilege) !== strtolower($requiredPrivilege)) {
        throw new Exception('Access denied: Insufficient privileges');
        header('/_admin_/generic/index.php');
        exit;
    }
}



// ... rest of your functions (updateAdminDeviceCredentials, getUserIP, etc.) remain the same

function updateAdminDeviceCredentials($pdo, $admin_id)
{
    $IP_address = getUserIP();
    $HostName = getUserHostName($IP_address);
    $DeviceType = getDeviceType();

    $cmd =  $pdo->prepare(
        "UPDATE gen_backoffice SET 
                last_login = NOW(), 
                ip_address = :ip, 
                hostname = :host, 
                device_type = :device
                WHERE id = :id"
    );
    $cmd->execute([
        ':id' => $admin_id,
        ':ip' => $IP_address,
        ':host' => $HostName,
        ':device' => $DeviceType
    ]);
}


function getUserIP()
{
    // Check for shared internet/ISP IP
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    }
    // Check for IPs passing through proxies
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    // Get the remote IP address
    return $_SERVER['REMOTE_ADDR'] ?? 'Unknown';
}

// Function to get the hostname (optional)
function getUserHostName($ip)
{
    return gethostbyaddr($ip) ?: 'Unknown';
}

function getDeviceType()
{
    // Basic device type detection based on User-Agent
    $userAgent = $_SERVER['HTTP_USER_AGENT'];
    if (stripos($userAgent, 'mobile') !== false) {
        return 'Mobile';
    } elseif (stripos($userAgent, 'tablet') !== false) {
        return 'Tablet';
    } else {
        return 'Desktop';
    }
}


// Function to detect device type and name
function getDeviceInfo()
{
    $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';
    $deviceInfo = ['type' => 'Unknown', 'name' => 'Unknown'];

    // Common mobile device patterns
    $mobilePatterns = [
        '/iPhone/i' => 'iPhone',
        '/iPad/i' => 'iPad',
        '/Android.*Mobile/i' => 'Android Phone',
        '/Android/i' => 'Android Device', // Fallback for Android tablets
        '/Windows Phone/i' => 'Windows Phone',
        '/BlackBerry/i' => 'BlackBerry',
        '/SM-[A-Za-z0-9]+/i' => 'Samsung Device', // Samsung model codes (e.g., SM-G950)
        '/Pixel/i' => 'Google Pixel',
    ];

    // Check device type and name
    if (preg_match('/mobile/i', $userAgent)) {
        $deviceInfo['type'] = 'Mobile';
    } elseif (preg_match('/tablet/i', $userAgent) || preg_match('/iPad/i', $userAgent)) {
        $deviceInfo['type'] = 'Tablet';
    } else {
        $deviceInfo['type'] = 'Desktop';
    }

    // Attempt to extract device name
    foreach ($mobilePatterns as $pattern => $name) {
        if (preg_match($pattern, $userAgent, $matches)) {
            $deviceInfo['name'] = $name;
            // If a specific model code is matched (e.g., SM-G950), append it
            if (isset($matches[0]) && strpos($matches[0], 'SM-') === 0) {
                $deviceInfo['name'] = "Samsung {$matches[0]}";
            }
            break;
        }
    }

    // Desktop-specific OS detection (not exact device name, but useful context)
    if ($deviceInfo['type'] === 'Desktop') {
        if (preg_match('/Windows/i', $userAgent)) {
            $deviceInfo['name'] = 'Windows PC';
        } elseif (preg_match('/Macintosh|Mac OS/i', $userAgent)) {
            $deviceInfo['name'] = 'Mac';
        } elseif (preg_match('/Linux/i', $userAgent)) {
            $deviceInfo['name'] = 'Linux PC';
        }
    }

    // Browser info as a fallback or additional context
    if ($deviceInfo['name'] === 'Unknown') {
        if (preg_match('/Chrome/i', $userAgent)) {
            $deviceInfo['name'] = 'Chrome Device';
        } elseif (preg_match('/Safari/i', $userAgent)) {
            $deviceInfo['name'] = 'Safari Device';
        } elseif (preg_match('/Firefox/i', $userAgent)) {
            $deviceInfo['name'] = 'Firefox Device';
        }
    }

    return $deviceInfo;
}


//! NOT USED /////////////////////////////////////////////////////////

// Function to generate UUID v4
function generateUUID()
{
    return sprintf(
        '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0x0fff) | 0x4000,
        mt_rand(0, 0x3fff) | 0x8000,
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff)
    );
}
