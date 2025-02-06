<?php

namespace App\Models;
use Core\Model;

class ApiModel extends Model
{

    public function getCarList()
    {
        $query = $this->db->prepare("SELECT * FROM car c JOIN type t ON c.id_type = t.id_type");
        $query->execute();
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function createCar($data)
    {
        $data = [
            'id_type' => $data['id_type'],
            'registration' => $data['registration'],
            'name_car' => $data['name_car'],
            'mark' => $data['mark'],
            'available' => $data['available'],
            'price_day' => $data['price_day']
        ];
        $query = $this->db->prepare("INSERT INTO car (id_type, registration, name_car, mark, available, price_day) VALUES (:id_type, :registration, :name_car, :mark, :available, :price_day)");
        $query->execute($data);
        $lastInsertId = $this->db->lastInsertId();
        $query = $this->db->prepare("SELECT * FROM car WHERE id_car = :id_car");
        $query->execute(['id_car' => $lastInsertId]);
        return $query->fetch(\PDO::FETCH_ASSOC);
    }

    public function getCarById($id)
    {
        $query = $this->db->prepare("SELECT * FROM car WHERE id_car = :id_car");
        $query->execute(['id_car' => $id]);
        return $query->fetch(\PDO::FETCH_ASSOC);
    }

    public function getType()
    {
        $query = $this->db->prepare("SELECT * FROM type");
        $query->execute();
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function updateCarById($id, $data)
    {
        $data = [
            'id_type' => $data['id_type'],
            'registration' => $data['registration'],
            'name_car' => $data['name_car'],
            'mark' => $data['mark'],
            'price_day' => $data['price_day'],
            'id_car' => $id
        ];
        $query = $this->db->prepare("UPDATE car SET id_type = :id_type, registration = :registration, name_car = :name_car, mark = :mark, price_day = :price_day WHERE id_car = :id_car");
        $query->execute($data);
        $query = $this->db->prepare("SELECT * FROM car WHERE id_car = :id_car");
        $query->execute(['id_car' => $id]);
        return $query->fetch(\PDO::FETCH_ASSOC);
    }

    public function deleteCarById($id)
    {
        $query = $this->db->prepare("DELETE FROM car WHERE id_car = :id_car");
        $query->execute(['id_car' => $id]);
        return true;
    }
}
