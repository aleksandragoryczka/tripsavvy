const search = document.querySelector('input[placeholder="Wyszukaj celu podróży"]')
const tripsContainer = document.querySelector(".trips");

function createTrip(trip) {
    const template = document.querySelector("#trip-template");

    const clone = template.content.cloneNode(true);

    const image = clone.querySelector("img");
    image.src = `/public/uploads/${trip.image}`;
    const title = clone.querySelector("h1");
    title.innerHTML = trip.title;

    const dates = clone.querySelector("#dates")
    const startDate = trip.start_date;
    const endDate = trip.end_date;
    dates.innerText = startDate + " - " + endDate;

    const tripSelectButton = clone.querySelector(".more-info-button");
    tripSelectButton.addEventListener("click",() => goToTrip(trip.id_trip));

    tripsContainer.appendChild(clone);
}

function goToTrip(id){
    window.location.href = "../trips?id_trip=" + id;
    console.log("tutaj");
}

function loadTrips(trips) {
    trips.forEach(trip => {
        createTrip(trip);
    });
}

search.addEventListener("keyup", function (event){
    if(event.key === "Enter"){
        event.preventDefault();

        const data = {search: this.value};

        fetch("/search", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data),
        }).then(function(response){
            return response.json();
        }).then(function (trips){
            tripsContainer.innerHTML = "";
            loadTrips(trips)
        });

    }
});



