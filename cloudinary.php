<?php
require __DIR__ . '/vendor/autoload.php';

use Cloudinary\Api\Upload\UploadApi;

// Load environment variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Configure Cloudinary if enabled
if ($_ENV['ENABLE_CLOUDINARY'] === 'true') {
    Cloudinary\Configuration\Configuration::instance([
        'cloud_name' => $_ENV['CLOUDINARY_CLOUD_NAME'],
        'api_key' => $_ENV['CLOUDINARY_API_KEY'],
        'api_secret' => $_ENV['CLOUDINARY_API_SECRET'],
    ]);
}

/**
 * Uploads an image either to Cloudinary or locally.
 * 
 * @param array $image The image file from the form
 * @param string $folder The subdirectory name
 * @param PDO $pdo Database connection
 * @return array The response containing image details
 */
function uploadImage($image, $folder = '', $pdo)
{
    try {
        if ($_ENV['ENABLE_CLOUDINARY'] === 'true') {
            // Upload to Cloudinary
            $uploadResponse = (new UploadApi())->upload($image['tmp_name'], [
                'folder' => 'Updates' . ($folder ? '/' . $folder : ''),
            ]);

            // Insert Cloudinary details into database
            $stmt = $pdo->prepare("INSERT INTO images (cloudinary_url, cloudinary_public_id, local_path) VALUES (?, ?, NULL)");
            $stmt->execute([$uploadResponse['secure_url'], $uploadResponse['public_id']]);

            return ['url' => $uploadResponse['secure_url'], 'public_id' => $uploadResponse['public_id']];
        } else {
            // Save image locally
            $uploadDir = __DIR__ . 'postimages/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $filename = uniqid() . "_" . basename($image['name']);
            $filePath = $uploadDir . $filename;
            
            if (move_uploaded_file($image['tmp_name'], $filePath)) {
                // Insert local image path into database
                $stmt = $pdo->prepare("INSERT INTO images (cloudinary_url, cloudinary_public_id, local_path) VALUES (NULL, NULL, ?)");
                $stmt->execute([$filePath]);

                return ['url' => $filePath, 'public_id' => null];
            } else {
                return ['error' => 'Failed to save the image locally'];
            }
        }
    } catch (Exception $e) {
        return ['error' => $e->getMessage()];
    }
}
