
document.querySelectorAll('.delete-btn').forEach(button => {
    button.addEventListener('click', function() {
        // Get the ID of the row to delete
        const rowID = this.getAttribute('data-id');
        
        //confirmation popup
        if (confirm("Are you sure you want to delete this item?")) {
            // If user confirms, send AJAX request to delete the row
            deleteRow(rowID);
        }
    });
});

function deleteRow(rowID) {
    // AJAX request to delete the row
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'delete_item.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status === 200) {
            
            location.reload(); 
        } else {
            
            console.error('Error deleting row.');
        }
    };
    xhr.send('id=' + rowID); // Send the ID of the row to delete
}
