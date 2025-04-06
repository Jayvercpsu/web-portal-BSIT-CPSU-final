<?php
require __DIR__ . '/vendor/autoload.php';

use Cloudinary\Api\Upload\UploadApi;

// Load environment variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Configure Cloudinary if enabled
// if ($_ENV['ENABLE_CLOUDINARY'] === 'true') {
//     Cloudinary\Configuration\Configuration::instance([
//         'cloud_name' => $_ENV['CLOUDINARY_CLOUD_NAME'],
//         'api_key' => $_ENV['CLOUDINARY_API_KEY'],
//         'api_secret' => $_ENV['CLOUDINARY_API_SECRET'],
//     ]);
// }
// Configure Cloudinary using environment variables
Cloudinary\Configuration\Configuration::instance($_ENV['CLOUDINARY_URL']);

/**
 * Uploads an image either to Cloudinary or locally.
 * 
 * @param array $image The image file from the form
 * @param string $folder The subdirectory name
 * @param PDO $pdo Database connection
 * @return array The response containing image details
 */
function uploadImage($image, $folder = '')
{
    try {
        // Ensure we are dealing with a single file
        if (is_array($image['tmp_name'])) {
            $image['tmp_name'] = $image['tmp_name'][0]; // Take the first image
        }

        if ($_ENV['ENABLE_CLOUDINARY'] === 'true') {
            // Upload to Cloudinary
            $uploadResponse = (new UploadApi())->upload($image['tmp_name'], [
                'folder' => 'Updates' . ($folder ? '/' . $folder : ''),
            ]);

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
                return ['url' => $filePath, 'public_id' => null];
            } else {
                return ['error' => 'Failed to save the image locally'];
            }
        }
    } catch (Exception $e) {
        return ['error' => $e->getMessage()];
    }
}



/**
 * Deletes an image from Cloudinary
 * 
 * @param string $publicId The public ID of the image to delete
 * @return array The response from Cloudinary's delete API
 */
function deleteImage($publicId)
{
    try {
        // Try deleting with different resource types until successful
        $resourceTypes = ['image', 'video', 'raw']; // Common Cloudinary resource types
        
        foreach ($resourceTypes as $resourceType) {
            $deleteResponse = (new UploadApi())->destroy($publicId, [
                'resource_type' => $resourceType
            ]);
            
            // Check if the deletion was successful
            if ($deleteResponse['result'] === 'ok') {
                return $deleteResponse;
            }
        }
        
        // If none succeeded, return an error
        return ['error' => 'Unable to determine resource type or delete file'];
    } catch (Exception $e) {
        return ['error' => $e->getMessage()];
    }
}