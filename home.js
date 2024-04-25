// calls adjustcolumns func when window is resized
window.addEventListener('resize', function() {
    adjustColumns();
});

// when window loaded calls adjustcolumns
window.onload = function() {
    adjustColumns();
};

function adjustColumns() {
    var table = document.getElementById('data-table');
    var items = document.getElementsByClassName('items')[0];
    var itemWidth = items.offsetWidth;
    var windowWidth = window.innerWidth;
    var numColumns = Math.floor(windowWidth / itemWidth);

    var rows = table.getElementsByTagName('tr');
    for (var i = 0; i < rows.length; i++) {
        rows[i].style.display = 'table-row';
    }

    for (var i = numColumns; i < rows[0].getElementsByTagName('td').length; i++) {
        var cells = table.querySelectorAll('td:nth-child(' + (i + 1) + ')');
        for (var j = 0; j < cells.length; j++) {
            cells[j].style.display = 'none';
        }
    }
}
