<?php

require_once "Repository.php";
require_once __DIR__."/../models/Expense.php";

class ExpenseRepository extends Repository{

    public function getExpensesViaTrip(int $id_trip){
        $result = [];

        $stmt = $this->database->connect()->prepare(
            "SELECT * from single_expenses WHERE id_trip = :id_trip"
        );
        $stmt->bindParam(":id_trip", $id_trip, PDO::PARAM_INT);
        $stmt->execute();
        $expenses=$stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($expenses as $expense){
            $result[] = new Expense(
                $expense['place'],
                $expense['amount'],
                $expense['category'],
                $expense['expense_date'],
                $expense['notes']
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
                $expense['place'],
                $expense['amount'],
                $expense['category'],
                $expense['expense_date'],
                $expense['notes']
                //$expense['target_currency']
            );
        }
        return $result;
    }


    public function addExpense(Expense $expense, int $id_trip): void{
        $stmt = $this->database->connect()->prepare(
            "insert into single_expenses(id_trip, place, amount, category, expense_date, notes)
                    values (?,?,?,?,?,?)
                    ");

        //TODO: pobranie tej wartosci na podstawie sesji zalogowanego uzytkownika, tak aby zwrocic to ID sesji lub pobrane z bazy danych na podstawie tokenu sesji zpaisnaego w db
        //$id_trip = 1;

        $stmt->execute([
            $id_trip,
            $expense->getPlace(),
            $expense->getAmount(),
            $expense->getCategory(),
            $expense->getExpenseDate(),
            $expense->getNotes()
        ]);
    }
}