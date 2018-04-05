<?php

namespace App\Controllers;


use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
use Exception;
use JonnyW\PhantomJs\Client;

class DevtestController extends Controller
{


    public function uploadToS3($request, $response){
        // AWS Info

        $bucketName = 'funiziuploads';
        $IAM_KEY = $_SERVER['FUNUPLOADER_KEY'];
        $IAM_SECRET = $_SERVER['FUNUPLOADER_SECRET'];

        echo $IAM_KEY . '<br>' . $IAM_SECRET;
        // Connect to AWS
        try {
            // You may need to change the region. It will say in the URL when the bucket is open
            // and on creation. us-east-2 is Ohio, us-east-1 is North Virgina

            $s3 = S3Client::factory(
                array(
                    'credentials' => array(
                        'key' => $IAM_KEY,
                        'secret' => $IAM_SECRET
                    ),
                    'version' => 'latest',
                    'region'  => 'us-east-2'
                )
            );
        } catch (Exception $e) {
            // We use a die, so if this fails. It stops here. Typically this is a REST call so this would
            // return a json object.
            die("Error: " . $e->getMessage());
        }

        $fileURL = 'https://weasily.com/uploads/w8UXWC7qq12slar.jpg'; // Change this
// For this, I would generate a unqiue random string for the key name. But you can do whatever.
        $keyName = 'uploads/' . basename($fileURL);
        $pathInS3 = 'https://s3.us-east-2.amazonaws.com/' . $bucketName . '/' . $keyName;
// Add it to S3
        try {
            // You need a local copy of the image to upload.
            // My solution: http://stackoverflow.com/questions/21004691/downloading-a-file-and-saving-it-locally-with-php
            if (!file_exists('/tmp/tmpfile')) {
                mkdir('/tmp/tmpfile');
            }

            $tempFilePath = '/tmp/tmpfile/' . basename($fileURL);
            $tempFile = fopen($tempFilePath, "w") or die("Error: Unable to open file.");
            $fileContents = file_get_contents($fileURL);
            $tempFile = file_put_contents($tempFilePath, $fileContents);
            $res = $s3->putObject(
                array(
                    'Bucket'=>$bucketName,
                    'Key' =>  $keyName,
                    'SourceFile' => $tempFilePath,
                    'StorageClass' => 'REDUCED_REDUNDANCY',
                    'ACL'           => 'public-read',

                )
            );
            var_dump($res);
            // WARNING: You are downloading a file to your local server then uploading
            // it to the S3 Bucket. You should delete it from this server.
            // $tempFilePath - This is the local file path.
        } catch (S3Exception $e) {
            die('Error:' . $e->getMessage());
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
        echo 'Done';
    }
    public function phantomTest($request, $response){

        $client = Client::getInstance();
        $client->getEngine()->setPath(__DIR__ . '/../../bin/phantomjs.exe');
        $client->getEngine()->debug(true);
        $width  = 800;
        $height = 600;
        $top    = 0;
        $left   = 0;

        /**
         * @see JonnyW\PhantomJs\Http\CaptureRequest
         **/
        $req = $client->getMessageFactory()->createCaptureRequest('http://jonnyw.me', 'GET');
        $req->setOutputFile('uploads/capturedfile.jpg');
        $req->setViewportSize($width, $height);
        $req->setCaptureDimensions($width, $height, $top, $left);

        /**
         * @see JonnyW\PhantomJs\Http\Response
         **/
        $res = $client->getMessageFactory()->createResponse();

        // Send the request
        $save = $client->send($req, $res);
        echo  $client->getLog();
         var_dump($save);
    }
}
