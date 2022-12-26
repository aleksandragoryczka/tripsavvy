<?php

require_once "Repository.php";
require_once __DIR__."/../models/Expense.php";

class ExpenseRepository extends Repository
{
/*
    public function getExpense(int $id): ?Expense
    {
        $stmt = $this->database->connect()->prepare("
            select se.*, t.title from trips t join single_expenses se
                on t.id_trip = se.id_trip where se.id_trip = :id
            ");
        $stmt->bindParam(":id", $id, PDO::PARAM_STR);
        $stmt->execute();

        $expense = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$expense){
            return null;
        }
        return new Expense(
            $expense['country'],
            $expense['amount'],
            $expense['expense_currency'],
            $expense['category'],
            $expense['expense_date'],
            $expense['notes']
        );
    }*/

    public function addExpense(Expense $expense): void{
        $stmt = $this->database->connect()->prepare(
            "insert into single_expenses(id_trip, country, amount, expense_currency, category, expense_date, notes)
                    values (?,?,?,?,?,?,?)
                    ");

        //TODO: pobranie tej wartosci na podstawie sesji zalogowanego uzytkownika, tak aby zwrocic to ID sesji lub pobrane z bazy danych na podstawie tokenu sesji zpaisnaego w db
        $id_trip = 1;

        $stmt->execute([
            $id_trip,
            $expense->getCountry(),
            $expense->getAmount(),
            $expense->getExpenseCurrency(),
            $expense->getCategory(),
            $expense->getExpenseDate(),
            $expense->getNotes()
        ]);
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