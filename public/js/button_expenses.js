const button_trip = document.querySelectorAll("button[id_button='more-info']");
//const tripsContainer = document.querySelector(".trips");
const expensesContainer = document.querySelector(".expenses");


function createExpenseWindow(expense){
    console.log("X")
}

function loadExpenses(expenses){
    expenses.forEach(expense => {
        createExpenseWindow(expense);
    });

    //TODO: napisać tu jedna funkcje lub dwie
}


function buttonExpenses(){
    const button = this;
    const container = button.parentElement.parentElement.parentElement;
    const trip_id = container.getAttribute('id');
   // console.log(trip_id)

   // const data = ;
   // console.log(typeof data);
   // console.log(data);

    fetch(`/expenses/${trip_id}`, {
        method: "POST",
        headers : {
            'Content-type': 'application/json'
        },
        body : JSON.stringify({trip_id : trip_id})
    }).then(response => {
        console.log(response);
        return response;
    }).then(expenses => {
        console.log(expenses)
        tripsContainer.innerHTML = "";
        loadExpenses(expenses);
    });

}

button_trip.forEach(button => button.addEventListener("click", buttonExpenses));