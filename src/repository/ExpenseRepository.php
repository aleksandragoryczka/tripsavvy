<?php

require_once "Repository.php";
require_once __DIR__."/../models/Expense.php";

class ExpenseRepository extends Repository{

    public function getExpensesViaTrip(int $id_trip){
        $result = [];

        $stmt = $this->database->connect()->prepare(
            "SELECT * from all_trip_expenses_vw a WHERE id_trip = :id_trip"
        );
        $stmt->bindParam(":id_trip", $id_trip, PDO::PARAM_INT);
        $stmt->execute();
        $expenses=$stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($expenses as $expense){
            $result[] = new Expense(
                $expense['country'],
                $expense['amount'],
                $expense['category'],
                $expense['expense_date'],
                $expense['notes'],
                $expense['target_currency']
            );
        }
        return $result;
    }

    public function getAllTripExpenses(int $id_trip): array
    {
        $result = [];

        $stmt = $this->database->connect()->prepare("
            SELECT * from single_expenses where id_trip = :id_trip
        ");

        $stmt->bindParam(":id_trip", $id_trip, PDO::PARAM_INT);
        $stmt->execute();
        $expenses = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($expenses as $expense){
            $result[] = new Expense(
                $expense['country'],
                $expense['amount'],
                $expense['expense_currency'],
                $expense['category'],
                $expense['expense_date'],
                $expense['notes']
            );
        }
        return $result;
    }

}