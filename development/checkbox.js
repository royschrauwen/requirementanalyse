document.getElementsByName('requirement_checkbox').forEach(item => {
    item.addEventListener('click', event => {
        changeStatus(item.id);
    })
})

function changeStatus(item)
{
    itemData = item.split("_");
    itemId = itemData[1];
    itemOldStatus = itemData[2];
    itemNewStatus = (itemOldStatus == 5) ? 1 : 5;
    console.log('changestatus.php?id=' + itemId + '&status=' + itemNewStatus);
    // Update pagina oproepen
    // Item ID Meegeven
    // Pagina herladen
    // localhost/requirementanalyse/development/changestatus.php?id=21&status=5&return=moscow
    window.location.replace('changestatus.php?id=' + itemId + '&status=' + itemNewStatus);
}


document.getElementsByName('assignToMe').forEach(item => {
    item.addEventListener('click', event => {
        assignToMe(item.id);
    })
})

function assignToMe(item)
{
    itemData = item.split("_");
    itemId = itemData[0];
    userId = itemData[1];
    $url = 'update.php?type=assign&rid=' + itemId + '&uid=' + userId;
    console.log($url);
    window.location.replace($url);
}