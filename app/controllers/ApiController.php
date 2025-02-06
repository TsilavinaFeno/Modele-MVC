<?php

namespace App\Controllers;
use App\Models\ApiModel;
use Core\Controller;


class ApiController extends Controller
{
    private $apiModel;

    public function __construct()
    {
        $this->apiModel = new ApiModel();
    }
    public function carlist()
    {
        try {
            $cars = $this->apiModel->getCarList();
            $this->sendJsonResponse($cars, 200);
        } catch (\Exception $e) {
            $this->sendJsonResponse(['error' => $e->getMessage()], 500);
        }
    }

    public function createCar()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $data = json_decode(file_get_contents('php://input'), true);

                if (json_last_error() !== JSON_ERROR_NONE) {
                    // Invalid JSON, send a 400 response
                    $this->sendJsonResponse(['error' => 'Invalid JSON data.'], 400);
                    return;
                }

                $cars = $this->apiModel->createCar($data);
                $this->sendJsonResponse($cars, 200);
            } else {
                $this->sendJsonResponse(['error' => 'Method not allowed'], 405);
            }
        } catch (\Exception $e) {
            $this->sendJsonResponse(['error' => $e->getMessage()], 500);
        }
    }

    public function getCarById($id)
    {
        try {
            $car = $this->apiModel->getCarById($id);
            $this->sendJsonResponse($car, 200);
        } catch (\Exception $e) {
            $this->sendJsonResponse(['error' => $e->getMessage()], 500);
        }
    }

    public function getType()
    {
        try {
            $types = $this->apiModel->getType();
            $this->sendJsonResponse($types, 200);
        } catch (\Exception $e) {
            $this->sendJsonResponse(['error' => $e->getMessage()], 500);
        }
    }

    public function updateCarById($id)
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
                $data = json_decode(file_get_contents('php://input'), true);

                if (json_last_error() !== JSON_ERROR_NONE) {
                    // Invalid JSON, send a 400 response
                    $this->sendJsonResponse(['error' => 'Invalid JSON data.'], 400);
                    return;
                }

                $update = $this->apiModel->updateCarById($id, $data);
                $this->sendJsonResponse($update, 200);
            } else {
                $this->sendJsonResponse(['error' => 'Method not allowed'], 405);
            }
        } catch (\Exception $e) {
            $this->sendJsonResponse(['error' => $e->getMessage()], 500);
        }
    }

    public function deleteCarById($id)
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {

                if (json_last_error() !== JSON_ERROR_NONE) {
                    // Invalid JSON, send a 400 response
                    $this->sendJsonResponse(['error' => 'Invalid JSON data.'], 400);
                    return;
                }

                $delete = $this->apiModel->deleteCarById($id);
                $this->sendJsonResponse($delete, 200);
            } else {
                $this->sendJsonResponse(['error' => 'Method not allowed'], 405);
            }
        } catch (\Exception $e) {
            $this->sendJsonResponse(['error' => $e->getMessage()], 500);
        }
    }



    /**
     * Sends a JSON response with the given data and HTTP status code.
     *
     * This method sets the HTTP response status code, sets the content type to JSON,
     * encodes the provided data as a JSON string, and outputs it.
     *
     * @param mixed $data The data to be encoded as JSON and sent in the response.
     * @param int $statusCode The HTTP status code for the response (default is 200).
     *
     * @return void
     */
    private function sendJsonResponse($data, $statusCode = 200)
    {
        // Set HTTP response status
        http_response_code($statusCode);

        // Set content type to JSON
        header('Content-Type: application/json');

        // Encode data as JSON and print it
        echo json_encode($data, JSON_PRETTY_PRINT);
        exit;
    }
}