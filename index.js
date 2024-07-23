function expandDiv(element) {
    
    let accueilItems = document.querySelectorAll('.accueil-item');
    accueilItems.forEach(item => {
        if (item !== element) {
            item.style.width = "500px"; 
            item.style.height = "500px"; 
        }
    });
    
    
    element.style.width = "800px"; 
    element.style.height = "500px"; 
}

function resetDivs() {
    
    let accueilItems = document.querySelectorAll('.accueil-item');
    accueilItems.forEach(item => {
        item.style.width = "500px"; 
        item.style.height = "500px"; 
    });
}