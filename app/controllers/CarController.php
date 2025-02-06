<?php

namespace App\Controllers;
use App\Models\CarModel;
use Core\Controller;

class CarController extends Controller
{

    private $carModel;

    public function __construct()
    {
        $this->carModel = new CarModel();
    }
    public function index()
    {
        session_start();
        if (!isset($_SESSION['user'])) {
            header('location:' . BASE_URL . 'home?msg=2');
        }
        $this->view('car/index');
    }

    public function addcar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $data = [
                "id_type" => $_POST['type'],
                "registration" => $_POST['registration'],
                "name_car" => $_POST['name'],
                "mark" => $_POST['mark'],
                "price_day" => $_POST['price_day'],
                "available" => true
            ];

            $url = BASE_URL . 'api/createCar';
            $cars = $this->postDataToApi($url, $data);

        } else {
            echo "No data found";
        }
    }

    public function carlist()
    {
        $url = BASE_URL . 'api/carlist';
        $cars = $this->fetchCarDataFromApi($url);
        $this->view('car/list', ['cars' => $cars]);
    }

    public function update($id)
    {
        $carUrl = BASE_URL . 'api/getCarById/' . $id;
        $typeUrl = BASE_URL . 'api/getType/';
        $car = $this->fetchCarDataFromApi($carUrl);
        $types = $this->fetchCarDataFromApi($typeUrl);
        $this->view('car/modif', ['car' => $car, 'types' => $types]);
    }

    public function carupdate($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $data = [
                "id_type" => $_POST['type'],
                "registration" => $_POST['registration'],
                "name_car" => $_POST['name'],
                "mark" => $_POST['mark'],
                "price_day" => $_POST['price_day']
            ];

            $url = BASE_URL . 'api/updateCarById/' . $id;
            $update = $this->putDataToApi($url, $data);


            if ($update) {
                header('location: ' . BASE_URL . 'car/carlist');
            } else {
                echo "ERROR inserting data";
            }

        } else {
            echo "No data sent";
        }
    }

    public function delete($id)
    {
        $url = BASE_URL . 'api/deleteCarById/' . $id;
        $delete = $this->fetchCarDataFromApi($url);

        if ($delete) {
            header('location: ' . BASE_URL . 'car/carlist');
        } else {
            echo "ERROR deleting data";
        }
    }

    /**
     * Fetches car data from the given API URL.
     *
     * This method initializes a cURL session, sets the URL, and retrieves the data.
     * If an error occurs during the cURL execution, it will be displayed.
     * The method returns the decoded JSON response as an associative array.
     *
     * @param string $url The API URL to fetch car data from.
     * @return array|null The decoded JSON response as an associative array, or null on failure.
     */
    public function fetchCarDataFromApi($url)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $output = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }

        curl_close($ch);

        return json_decode($output, true);
    }

    /**
     * Sends a POST request to the specified API URL with the given data.
     *
     * @param string $url The API endpoint URL to which the POST request is sent.
     * @param array $data The data to be sent in the POST request body.
     * 
     * @return array|null The response from the API, decoded from JSON to an associative array. 
     *                    Returns null if the response cannot be decoded.
     */
    public function postDataToApi($url, $data)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

        $output = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }

        curl_close($ch);

        return json_decode($output, true);
    }

    public function putDataToApi ($url, $data)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

        $output = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }

        curl_close($ch);

        return json_decode($output, true);
    }

    public function deleteDataToApi ($url, $data)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');

        $output = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }

        curl_close($ch);

        return json_decode($output, true);
    }

}
