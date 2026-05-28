function showConfirmation() {
    const name = document.forms["frmContact"]["name"].value;
    const email = document.forms["frmContact"]["email"].value;
    const message = document.forms["frmContact"]["message"].value;

    if (name && email && message) {
        document.getElementById("confirmationModal").style.display = "block";
        return false; 
    }
        return false;
}

function closeModal() {
    document.getElementById("confirmationModal").style.display = "none";
}

window.onclick = function(event) {
    const modal = document.getElementById("confirmationModal");
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
