<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/mediastyle.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/e076f466c1.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./public/js/search.js" defer></script>

    <title>WYDATKI</title>
</head>

<body>
<div class="container-trip-summary-page">
    <?php include("navbar.php"); ?>
    <main>
        <header class="trip-expenses-header">
            <?php if(isset($trip)): ?>
                <h1><strong><?= ($trip->getTitle()); ?></strong></h1>
                <p><strong>Data: </strong><?= $trip->getStartDate() ." - ". $trip->getEndDate(); ?></p>
                <p><strong>Suma wydatków: </strong><?= ($trip->getSumOfExpenses()."   ".$trip->getTargetCurrency()) ?></p>
                <a href="addExpense" class="nav-button"><i class="fa-solid fa-dollar-sign"></i>  Dodaj wydatek</a>
            <?php endif; ?>
        </header>
        <section class="expenses">
            <?php if(isset($expenses)) foreach($expenses as $expense): ?>
                <div class="expense-card">
                    <p><strong>Miejsce: </strong><?= ($expense->getPlace());  ?></p>
                    <p><strong>Kwota: </strong><?= ($expense->getAmount()); ?> </p>
                    <p><strong>Kategoria: </strong><?= ($expense->getCategory());  ?></p>
                    <p><strong>Data wydatku: </strong><?= ($expense->getExpenseDate());  ?></p>
                    <?php if (!empty($expense->getNotes())): ?>
                        <p><strong>Notatka: </strong><?= ($expense->getNotes());  ?></p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </section>
    </main>
</div>
</body>
